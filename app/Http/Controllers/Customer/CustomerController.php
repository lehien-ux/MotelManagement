<?php

namespace App\Http\Controllers\Customer;

use App\Enums\Constant;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Contract;
use App\Models\Customer;
use App\Models\Room;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!Auth::guard('customers')->attempt($credentials)) {
            return back()->with('message', 'Sai tài khoản hoặc mật khẩu');
        }

        return redirect()->route('home')->with('message', 'Đăng nhập thành công');
    }

    public function register(Request $request)
    {
        $request->validate([
            'password' => 'required',
            're_password' => 'required|same:password'
        ]);

        try {
            $request['password'] = bcrypt($request->password);

            $customer = Customer::create($request->all());

            Auth::guard('customers')->login($customer);

            return redirect()->route('home')->with('message', 'Đăng ký thành công');
        } catch (\Exception $exception) {
            return back()->with('message', 'Đã có lỗi xảy ra');
        }
    }

    public function logout()
    {
        Auth::guard('customers')->logout();

        return redirect()->route('home')->with('message', 'Đăng xuất thành công');
    }

    public function show()
    {
        return view('customer.auth.info')->with([
            'customer' => Auth::guard('customers')->user()
        ]);
    }

    public function update(Request $request)
    {
        try {
            Auth::guard('customers')->user()->update($request->all());

            return back()->with('message', 'Cập nhật thông tin thành công');
        } catch (\Exception $exception) {
            abort(500);
        }
    }

    public function getContract($id)
    {
        $contract = Contract::where('id', $id)->with(['customer', 'room'])->first();

        return view('customer.contract')->with([
            'contract' => $contract
        ]);
    }

    public function getContracts()
    {
        $contracts = Contract::where('customer_id', Auth::guard('customers')->user()->id)->with('room')->get();

        return view('customer.contracts')->with([
            'contracts' => $contracts
        ]);
    }

    public function getBills()
    {
        $bills = Bill::where('customer_id', Auth::guard('customers')->user()->id)->with(['room', 'customer'])->get();

        return view('customer.bills')->with([
            'bills' => $bills
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'newPassword' => 'required',
            'rePassword' => 'required|same:newPassword'
        ]);

        $user = \auth()->guard('customers')->user();
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('message', 'Sai mật khẩu');
        }

        $user->password = bcrypt($request->newPassword);
        $user->save();

        return back()->with('message', 'Đổi mật khẩu thành công');
    }

    public function detailBill($id)
    {
        $bill = Bill::where('id', $id)->with(['room', 'detailBills' => function ($q) {
            $q->with('service');
        }])->first();

        return view('customer.detailBill')->with([
            'bill' => $bill
        ]);
    }

    public function payment($id)
    {
        $bill = Bill::findOrFail($id);
        $url = $this->paymethod($bill->total_price, url('/bills/vnpay/callback'), $bill->id);

        return redirect($url);
    }

    public function paymethod($price, $callback, $orderInfo)
    {
        $vnp_TmnCode = config('config.vnp_TmnCode'); //Mã website tại VNPAY
        $vnp_HashSecret = config('config.vnp_HashSecret'); //Chuỗi bí mật
        $vnp_Url = config('config.vnp_Url');
        $vnp_Returnurl = $callback;
        $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $orderInfo;
        $vnp_OrderType = 'billPayment';
        $vnp_Amount = $price * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();
        $vnp_BankCode = 'NCB';

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return $vnp_Url;
    }

    public function callbackPayment(Request $request)
    {
        if ($request->vnp_ResponseCode == "00") {
            Bill::find($request->vnp_OrderInfo)->update([
                'status' => Constant::PAID,
                'payment_at' => Carbon::now(),
                'deposited' => $request->vnp_Amount / 100
            ]);

            return redirect()->route('customer.bills-show')->with('success', 'Đã thanh toán phí dịch vụ');
        }

        return redirect()->route('customer.bills-show')->with('errors', 'Lỗi trong quá trình thanh toán phí dịch vụ');
    }

    public function book($id)
    {
        return view('customer.createContract')->with([
            'room' => Room::where('id', $id)->with('images')->first(),
            'services' => Service::all()
        ]);
    }

    public function createBook(Request $request)
    {
        $startDay = strtotime(Carbon::parse($request->start_date));
        $endDay = strtotime(Carbon::parse($request->end_date));

        if ($endDay - $startDay < Constant::MIN_DAY_OF_CONTRACT) {
            return back()->with('message', 'Hợp đồng không được nhỏ hơn 1 tháng');
        }

        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required|after:Carbon::start_date()->addDay(30)'
        ], [
            'end_date.after' => 'Hạn ngày hợp đồng phải lớn hơn ngày bắt đầu'
        ]);
        $user = \auth()->guard('customers')->user();
        //        $checkContract = Contract::where('customer_id', $user->id)
        //            ->where('status', '!=', Constant::CONTRACT_EXPIRED)
        //            ->first();
        //        if ($checkContract) {
        //            return redirect()->back()->with('message', 'Khách hàng đã có 1 hợp đồng khác');
        //        }

        $data = [
            'room_id' => $request->room_id,
            'customer_id' => $user->id,
            'deposited' => 500000,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => Constant::WAIT_ADMIN_CONFIRM,
            'services' => $request->service_id,
            'transplant' => $request->transplant
        ];

        session(['contract' => $data]);

        $url = $this->paymethod(500000, url('contracts/vnpay/callback'), 'book');

        return redirect($url);
    }

    public function getRooms(Request $request)
    {
        $request->flash();
        if ($request->transplant) {
            if (!auth()->guard('customers')->check()) {
                return back()->with('message', 'Hãy đăng nhập để xem');
            }

            $rooms = Room::join('contracts', 'contracts.room_id', '=', 'rooms.id')
                ->join('customers', 'customers.id', '=', 'contracts.customer_id')
                ->where('is_transplant', Constant::TRANSPLANT)
                ->where('sex', \auth()->guard('customers')->user()->sex)
                ->select('rooms.*', 'sex', 'name', 'phone');
        } else {
            $rooms = Room::where('status', Constant::ROOM_FREE);
        }

        if ($request->has('number') && $request->number) {
            $rooms->where('number', 'like', "%$request->number%");
        }

        if ($request->has('size') && $request->size) {
            $rooms->Where('size', 'like', "%$request->size%");
        }

        if ($request->has('price_start') && $request->price_start) {
            $rooms->where('price', '>=', $request->price_start);
        }

        if ($request->has('price_end') && $request->price_end) {
            $rooms->where('price', '<=', $request->price_end);
        }

        return view('customer.rooms')->with([
            'rooms' => $rooms->paginate(10)->appends(request()->query())
        ]);
    }

    public function createBookCallback(Request $request)
    {
        $data = session('contract');
        if ($request->vnp_ResponseCode == "00") {
            DB::beginTransaction();
            try {
                $contract = Contract::create($data);
                if ($data['transplant']) {
                    Room::where('id', $data['room_id'])->update([
                        'status' => Constant::ROOM_NOT_FREE, 'is_transplant' => Constant::TRANSPLANT
                    ]);
                } else {
                    Room::where('id', $data['room_id'])->update(['status' => Constant::ROOM_NOT_FREE]);
                }

                DB::table('customer_rooms')->insert([
                    'customer_id' => $data['customer_id'],
                    'room_id' => $data['room_id']
                ]);

                $useService = [];
                foreach ($data['services'] as $service) {
                    $useService[] = [
                        'service_id' => $service,
                        'contract_id' => $contract->id
                    ];
                }
                DB::table('contract_services')->insert($useService);

                DB::commit();

                return redirect()->route('home')->with('message', 'Đặt phòng thành công');
            } catch (\Exception $exception) {
                DB::rollBack();

                abort(500);
            }
        } else {
            return redirect()->route('home')->with('message', 'Đặt phòng thất bại');
        }
    }

    public function returnRoom($id)
    {
        $contract = Contract::find($id);

        $contract->return_room = 1;
        $contract->save();

        return redirect()->route('home')->with('message', 'Gửi yêu của trả phòng thành công');
    }

    public function transplant($id)
    {
        $room = Room::where('id', $id)->with('customers', 'images')->first();

        return view('customer.transplant')->with([
            'room' => $room
        ]);
    }

    public function transplantUpdate($id)
    {
        $transplants = Room::find($id);

        if ($transplants->is_transplant) {
            $transplants->is_transplant = 0;
            $message = 'Tắt thành công';
        } else {
            $transplants->is_transplant = Constant::TRANSPLANT;
            $message = 'Bật thành công';
        }

        $transplants->save();

        return back()->with('message', $message);
    }
}