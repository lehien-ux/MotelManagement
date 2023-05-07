<?php

namespace App\Http\Controllers;

use App\Exports\CustomerExport;
use App\Models\Customer;
use Carbon\Carbon;
use App\Models\CustomerRoom;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function saveCustomer(Request $request)
    {
        // dd($requestData);
        $request->validate([
            'name' => 'required|max:60|',
            'id_card' => 'required|max:15|',
            'date_of_birth' => 'required|date',
            'job' => 'required|max:20|',
            'address' => 'required|max:60|',
            'sex' => 'required',
            'phone' => 'required',
            'password' => 'required',
            're_password' => 'same:password'
        ], [
            'name.required' => 'Vui lòng nhập họ và tên Không quá 60 ký tự ',
            'id_card.required' => 'Vui lòng nhập Chứng minh thư Không quá 15 ký tự',
            'date_of_birth.required' => 'Vui lòng nhập ngày tháng năm sinh',
            'job.required' => 'Vui lòng nhập công việc hiện tại Không quá 20 ký tự',
            'address.required' => 'Vui lòng nhập địa chỉ Không quá 60 Ký tự',
            'sex.required' => 'Giới tính không được bỏ trống',
            'phone.required' => 'Số điện thoại không được bỏ trống',
            'password.required' => 'Mật khẩu không được để trống',
            're_password.same' => 'Mật khẩu nhập lại không đúng'
        ]);

        $request['password'] = bcrypt($request->password);
        Customer::create($request->all());

        Session::flash('success', 'Thêm mới thành công');
        return response()->json(['success' => true]);
    }

    public function getAllCustomer(Request $request)
    {
        $request->flash();
        $customers = Customer::with(['contract' => function ($q) {
            $q->with('room');
        }]);

        if ($request->has('name') && $request->name) {
            $customers->where('name', 'like', "%$request->name%");
        }

        if ($request->has('job') && $request->job) {
            $customers->where('job', 'like', "%$request->job%");
        }

        if ($request->has('address') && $request->address) {
            $customers->where('address', 'like', "%$request->address%");
        }

        if ($request->has('date_of_birth') && $request->date_of_birth) {
            $customers->where('date_of_birth', $request->date_of_birth);
        }

        if ($request->has('sex') && $request->sex || $request->sex == '0') {
            $customers->where('sex', $request->sex);
        }

        return view('admin.customer.all_customer')->with([
            'list' => $customers->paginate(5)->appends(request()->query())
        ]);
    }

    //lấy id của khách hàng
    public function getIDCustomer(Request $request)
    {
        $data = DB::table('customers')->where('id', $request["id"])->first();
        $data_room = DB::table('customers')->join('customer_rooms', 'customer_rooms.customer_id', '=', 'customers.id')->where('customers.id', $request["id"])->select('customer_rooms.room_id')->get();

        $respon['status'] = true;
        $respon['data'] = $data;
        $respon['data_room'] = $data_room;
        $respon['id'] = $request["id"];
        return response()->json($respon);
    }

    //lấy tất cả các phòng đổ vào select2
    public function getRoom(Request $request)
    {
        $data = DB::table('rooms')->get();
        $respon['data'] = $data;
        // $respon['data_cusRoom'] = $data_room_customer;
        return response()->json($respon);
    }

    public function UpdateCustomer(Request $request)
    {
        $requestData = $request->all();
        $id = $request->id_edit;
        $request->validate([
            'name' => 'required|max:60|',
            'id_card' => 'required|max:15|',
            'date_of_birth' => 'required|date',
            'job' => 'required|max:20|',
            'address' => 'required|max:60|',
        ], [
            'name.required' => 'Vui lòng nhập họ và tên Không quá 60 ký tự ',
            'id_card.required' => 'Vui lòng nhập Chứng minh thư Không quá 15 ký tự',
            'date_of_birth.required' => 'Vui lòng nhập ngày tháng năm sinh',
            'job.required' => 'Vui lòng nhập công việc hiện tại Không quá 20 ký tự',
            'address.required' => 'Vui lòng nhập địa chỉ Không quá 60 Ký tự'
        ]);

        if ($request->password && $request->password != $request->re_password) {
            return response('Nhập lại mật khẩu không chính xác', 422);
        }

        $data = [
            "name" => $requestData["name"],
            "id_card" => $requestData["id_card"],
            "date_of_birth" => $requestData["date_of_birth"],
            'email' => $request->email,
            "job" => $requestData["job"],
            "address" => $requestData["address"],
            'sex' => $request->sex
        ];

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        Customer::where('id', $id)->update($data);

        Session::flash('success', 'Cập nhật thành công');
        return response()->json(['success' => true]);
    }

    public function DeleteCustomer($id)
    {
        DB::table('customers')->where('id', $id)->delete();
        $data = array(
            'list' => DB::table('customers')->get()
        );
        return redirect(route("customer.view", $data));
    }

    public function export()
    {
        return Excel::download(new CustomerExport(), 'customer.xlsx');
    }
}
