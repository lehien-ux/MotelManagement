<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function login()
    {
        return view('login');
    }
    public function execute_login(Request $req)
    {
        $request = $req->all();
        $req->validate([
            'email' => 'required|max:60|',
            'password' => 'required',
        ], [
            'email.required' => 'Vui lòng nhập tài khoản',
            'password.required' => 'Vui lòng nhập mật khẩu'

        ]);
        if (Auth::attempt(['email' => $request["email"], 'password' => $request["password"]])) {
            // $getAccount = User::where(['email' => $request["email"], 'password' => $request["password"]]);
            // $data = [
            //     'account' => $getAccount
            // ];
            return redirect(route('admin.index'));
        } else {
            return redirect('/admin')->with('error', 'Đăng nhập không thành công');
        }
    }
    public function register()
    {
        return view("sign_up");
    }
    public function execute_register(Request $request)
    {
        $requestData = $request->all();
        if (!isset($requestData["active"])) {
            $requestData["active"] = 0;
        }
        $request->validate([
            "name" => "required|string|max:50",
            'email' => 'required|max:60|',
            'password' => 'required|min:8',
            "password_confirmation" => "required|same:password"
        ], [
            "name.required" => "Vui lòng nhập tên",
            'email.required' => 'Vui lòng nhập tài khoản',
            'password.required' => 'Vui lòng nhập mật khẩu'

        ]);
        if (User::where("email", $requestData["email"])->first()) {
            return redirect(route("register"))->with("error", "this email had already been existed");
        }
        User::create(["email" => $requestData["email"], "password" => bcrypt($requestData["password"]), "name" => $requestData["name"]]);
        return redirect(route("admin.index"))->with("message", "create User successfully");
    }
    // public function getAccount(Request $request, $id){
    //     User::where()
    // }
}