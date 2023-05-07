<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function addService()
    {
        return view("admin.service.add_service");
    }

    public function saveService(Request $request)
    {
        $request->validate([
            'name' => 'required|max:60|',
            'price' => 'required|integer'
        ]);
        Service::create($request->all());
        return redirect(route("service.view"));
    }

    public function getAllService(Request $request)
    {
        $data = array(
            'list' => DB::table('services')->get()
        );
        return view("admin.service.all_service", $data);
    }

    public function getEditService(Request $request, $id)
    {
        $data = array(
            'service' => DB::table('services')->where('id', $id)->first()
        );
        //return $data;
        $id1 = Service::findOrFail($id);
        //return $id1;
        return view("admin.service.edit_service", $id1, $data);
    }

    public function UpdateService(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:60|',
            'price' => 'required|integer'
        ]);
        DB::table('services')->where('id', $id)->update([
            "name" => $request->name,
            'price' => $request->price,
            'unit_price' => $request->unit_price
        ]);
        $data = array(
            'list' => DB::table('services')->get()
        );
        return redirect(route("service.view", $data));
    }

    public function DeleteService($id)
    {
        DB::table('services')->where('id', $id)->delete();
        $data = array(
            'list' => DB::table('services')->get()
        );
        return redirect(route("service.view", $data));
    }

    public function testPay(Request $request)
    {
        session(['cost_id' => $request->id]);
        session(['url_prev' => url()->previous()]);
        $vnp_TmnCode = config('config.vnp_TmnCode'); //Mã website tại VNPAY
        $vnp_HashSecret = config('config.vnp_HashSecret'); //Chuỗi bí mật
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = config('config.vnp_Returnurl');
        $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = 500000*100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.0.0",
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
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        return redirect($vnp_Url);
    }

    public function returnUrl(Request $request)
    {
        $url = session('url_prev', '/');
        if ($request->vnp_ResponseCode == "00") {
            return redirect($url)->with('success', 'Đã thanh toán phí dịch vụ');
        }
        session()->forget('url_prev');
        return redirect($url)->with('errors', 'Lỗi trong quá trình thanh toán phí dịch vụ');
    }
}
