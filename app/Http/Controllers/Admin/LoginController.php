<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('guest:admin',['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request){
        $all = $request->only(['email','password','remember']);

        $remember = false;

        if($request->remember){
            $remember = true;
        }
        $notice = Validator::make($all,[
            'email'=>'required|email',
            'password' => 'required|min:6'
        ],[
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Password không được để trống',
            'password.min'=>'Password không được ngắn hơn 6 kí tự'
        ]);

        if($this->checkEmail($request->email))
            return $this->returnError(['mess' =>'Tài khoản chưa được kích hoạt,Vui lòng kiểm tra email để xác thực tài khoản'],$request->only(['email']));

        if($notice->fails())
            return $this->returnError($notice,$request->only(['email','remember']));

        if(Auth::guard('admin')->attempt(['email' => $request->email,'password' => $request->password],$remember)){
            return redirect()->route('admin.dashboard')->withSuccess(['mess'=>'Đăng nhập thành công']);
        } else {
            return $this->returnError(['mess'=>'Email/mật khẩu không đúng!'],$request->only(['email','remember']));
        }
    }

    private function checkEmail($email)
    {
        return Admin::where('email',$email)->first() ?
            Admin::where('email',$email)->first()->state == 'INACTIVE' :
            null;
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

}
