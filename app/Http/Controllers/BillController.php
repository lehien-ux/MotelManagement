<?php

namespace App\Http\Controllers;

use App\Enums\Constant;
use App\Models\Bill;
use App\Models\Contract;
use App\Models\Customer;
use App\Models\Room;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;

class BillController extends Controller
{
    public function list(Request $request)
    {
        $request->flash();
        $bills = Bill::orderBy('bills.id', 'desc')->join('rooms', 'rooms.id', '=', 'bills.room_id')
            ->join('customers', 'customers.id', '=', 'bills.customer_id')
            ->select('bills.*', 'name', 'number', 'phone');

        if ($request->has('room_id') && $request->room_id) {
            $bills->where('bills.room_id', $request->room_id);
        }

        if ($request->has('customer') && $request->customer) {
            $bills->where('name', 'like', "%$request->customer%");
        }

        if ($request->has('month') && $request->month) {
            $bills->whereMonth('start_date', $request->month);
        }

        $rooms = Room::all();

        return view('admin.bills.list')->with([
            'bills' => $bills->paginate(15)->appends(request()->query()),
            'rooms' => $rooms
        ]);
    }

    public function viewCreate()
    {
        $rooms = Contract::with('room')->where('status', Constant::CONTRACT_ACTIVE)->get();
        $customers = Customer::all();
        $services = Service::all();

        return view('admin.bills.create')->with([
            'rooms' => $rooms,
            'customers' => $customers,
            'services' => $services
        ]);
    }

    public function getRoom($id) // id room
    {
        $room = Room::findOrFail($id);
        $contract = Contract::with('customer')
            ->where('room_id', $id)->where('status', Constant::CONTRACT_ACTIVE)->first();

        if (!$contract) {
            return response('error', 400);
        }

        return response([
            'room' => $room,
            'customer' => $contract->customer
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required|after:start_date'
        ], [
            'start_date.required' => 'Vui lòng nhập ngày bắt đầu',
            'end_date.required' => 'Vui lòng nhập ngày kết thức',
            'end_date.after' => 'Ngày kết thúc phải lớn hơn ngày bắt đầu'
        ]);
        DB::beginTransaction();
        try {
            $total = 0;
            $startDate = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date);
            $monthsSpanned = $this->diffInMonths($startDate, $endDate);

            $logMessage = 'HIENLOG: startDate: ' . $startDate . ', endDate: ' . $endDate . ', monthsSpanned: ' . $monthsSpanned;
            info($logMessage);

            $services = Service::all();
            foreach ($request->all() as $key => $service) {
                if (is_numeric($key)) {
                    foreach ($services as $item) {
                        if ($item->id == $key) {
                            if ($item->service_type == 2) {
                                $total += $item->price * $monthsSpanned;
                                info('HIENLOG: Service ' . $item->service_type . ', price ' . $item->price . ', monthsSpanned ' . $monthsSpanned . 'Total service cost ' . $total);
                            } else {
                                $total += $item->price * $request[$key];
                                info('HIENLOG: Service ' . $item->service_type . ', price ' . $item->price . ', requestKey ' . $request[$key] . 'Total service cost ' . $total);
                            }
                        }
                    }
                }
            }

            $message = 'Tạo hóa đơn thành công';

            $total = ceil($total + $request->room_price * $monthsSpanned);

            $total = $total - $total % 1000;
            info('HIENLOG: total ' . $total);
            info('HIENLOG: deposited' . $request->deposited . $request->deposited == $total);

            $status = 0;
            $paymentAt = null;
            if ($request->deposited == $total) {
                $status = 1;
                $paymentAt = now();
            }

            $bill = Bill::create([
                'room_id' => $request->room_id,
                'customer_id' => $request->customer_id,
                'status' => $status,
                'deposited' => $request->deposited,
                'total_price' => $total,
                'month' => $request->start_date,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'payment_at' => $paymentAt
            ]);

            $detailBill = [];
            foreach ($request->all() as $key => $service) {
                if (is_numeric($key)) {
                    foreach ($services as $item) {
                        if ($item->id == $key) {
                            $detailBill[] = [
                                'bill_id' => $bill->id,
                                'service_id' => $item->id,
                                'usage' => $item->service_type == 2 ? round($monthsSpanned, 5) : $request[$key],
                                'unit_price' => $item->price
                            ];
                        }
                    }
                }
            }

            DB::table('detail_bills')->insert($detailBill);

            DB::commit();
            return redirect()->route('bills.list')
                ->with('message', $message);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function viewUpdate($id)
    {
        $bill = Bill::where('id', $id)->with(['room', 'customer', 'detailBills'])->first();
        $rooms = Room::all();
        $customers = Customer::all();
        $services = Service::all();
        $useService = collect($bill->detailBills)->mapWithKeys(function ($item) {
            return [$item->service_id => $item];
        });

        return view('admin.bills.update')->with([
            'bill' => $bill,
            'rooms' => $rooms,
            'customers' => $customers,
            'services' => $services,
            'useService' => $useService
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([  
            'end_date' => 'after:start_date'
        ], [
            'end_date.after' => 'Ngày kết thúc phải lớn hơn ngày bắt đầu'
        ]);
        $total = 0;
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $monthsSpanned = $this->diffInMonths($startDate, $endDate);


        $services = Service::all();
        foreach ($request->all() as $key => $service) {
            if (is_numeric($key)) {
                foreach ($services as $item) {
                    if ($item->id == $key) {
                        if ($item->service_type == 2) {
                            $total += $item->price * $monthsSpanned;
                        } else {
                            $total += $item->price * $request[$key];
                        }
                    }
                }
            }
        }

        $total = ceil($total + $request->room_price * $monthsSpanned);


        $total = $total - $total % 1000;

        $status = 0;
        $paymentAt = null;
        if ($request->deposited == $total) {
            $status = 1;
            $paymentAt = now();
        }

        $data = [
            'room_id' => $request->room_id,
            'customer_id' => $request->customer_id,
            'status' => $status,
            'deposited' => $request->deposited,
            'total_price' => $total,
            'month' => $request->start_date,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'payment_at' => $paymentAt
        ];

        try {
            Bill::where('id', $id)->update($data);

            DB::table('detail_bills')->where('bill_id', $id)->delete();
            $detailBill = [];
            foreach ($request->all() as $key => $service) {
                if (is_numeric($key)) {
                    foreach ($services as $item) {
                        if ($item->id == $key) {
                        info('HIENLOG: service_id ' . $item->id . ',service ' . $service);
                            $detailBill[] = [
                                'bill_id' => $id,
                                'service_id' => $item->id,
                                'usage' => $item->service_type == 2 ? round($monthsSpanned, 5) : $request[$key],
                                'unit_price' => $item->price
                            ];
                        }
                    }
                }
            }

            DB::table('detail_bills')->insert($detailBill);

            return redirect()->route('bills.list')->with('message', 'Cập nhật thành công');
        } catch (\Exception $exception) {
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        Bill::findOrFail($id)->delete();
        DB::table('detail_bills')->where('bill_id', $id)->delete();

        return redirect()->route('bills.list')->with('message', 'Xóa hóa đơn thành công');
    }

    public function statistic()
    {

    }

    public function computedBill(Request $request)
    {
        $total = 0;
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $monthsSpanned = $this->diffInMonths($startDate, $endDate);

        $services = Service::all();
        foreach ($request->all() as $key => $service) {
            if (is_numeric($key)) {
                foreach ($services as $item) {
                    if ($item->id == $key) {
                        if ($item->service_type == 2) {
                            $total += $item->price * $monthsSpanned;
                        } else {
                            $total += $item->price * $request[$key];
                        }
                    }
                }
            }
        }

        $total = ceil($total + $request->room_price * $monthsSpanned);

        $total = $total - $total % 1000;

        return response($total);
    }

    public function getUseService($id)
    {
        $contract = Contract::where('room_id', $id)
            ->where('status', Constant::CONTRACT_ACTIVE)
            ->with('services')
            ->first();

        return response($contract);
    }

    
    public function diffInMonths(\DateTime $date1, \DateTime $date2)
    {
        $startMonthDays = (int) $date1->format('t');
        $endMonthDays = (int) $date2->format('t');
        $daysInStartMonth = $startMonthDays - $date1->format('j') + 1;
        $daysInEndMonth = $date2->format('j');
        $fullMonths = ($date2->format('Y') - $date1->format('Y')) * 12 + ($date2->format('n') - $date1->format('n') - 1);
        $partialStartMonth = $daysInStartMonth / $startMonthDays;
        $partialEndMonth = $daysInEndMonth / $endMonthDays;
        info('HIENLOG: fullMonths ' . $fullMonths);
        info('HIENLOG: partialStartMonth ' . $partialStartMonth);
        info('HIENLOG: partialEndMonth ' . $partialEndMonth);
    
        return $fullMonths + $partialStartMonth + $partialEndMonth;
    }
}