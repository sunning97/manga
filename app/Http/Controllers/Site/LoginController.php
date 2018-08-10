<?php

namespace App\Http\Controllers\Site;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    protected $guard = 'site';
    public function __construct()
    {
        $this->middleware('guest:site')->except(['logout']);
    }

    public function showLoginForm(){
        return view('site.auth.login');
    }

    public function login(Request $request)
    {
        $this->getValidateLogin($request);

        if(!$this->checkAccount($request)) {
            return $this->loginFailedResponse(
                [
                    'no-account' => 'Tài khoản chưa được đăng kí'
                ],
                [
                    'email' => $request->email
                ]
            );
        }
        if(!$this->checkState($request,'ACTIVE')) {
            return $this->loginFailedResponse(
                [
                'user-inactive' => 'Tài khoản chưa được kích hoạt, vui lòng kiểm tra email của bạn hoặc liên hệ với admin để được hỗ trợ'
                ],
                [
                    'email' => $request->email
                ]);
        }
        if($this->checkBanned($request)) {
            return $this->loginFailedResponse(
                [
                    'user-banned' => 'Tài khoản đã bị cấm, vui lòng liên hệ với admin để được hỗ trợ'
                ],
                [
                    'email' => $request->email
                ]);
        }

        if($this->attemptLogin($request)){
            return $this->loginSuccessResponse();
        }
        return $this->loginFailedResponse(
            [
                'password' => 'Mật khẩu không đúng'
            ],
            [
                'email' => $request->email
            ]
        );
    }

    protected function getValidateLogin(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6'
        ],[
            'email.required' => 'Vui lòng nhập email!',
            'email.email' => 'Định dạng email không đúng!',
            'password.required' => 'Mật khẩu không được để trống!',
            'password.min' => 'Mật khẩu không được ít hơn 6 kí tự!'
        ]);
    }

    protected function checkState(Request $request,$state)
    {
        return (User::where(function ($query) use($request,$state){
            $query->where('email','=',$request->email)
                ->where('state','=',$state);
        })->get()->first()) ? true : false;
    }

    protected function checkBanned(Request $request)
    {
        return (User::where(function ($query) use($request){
            $query->where('email','=',$request->email)
                ->where('banned','=','T');
        })->get()->first()) ? true : false;
    }
    protected function checkAccount(Request$request)
    {
        return (
            User::where('email','=',$request->email)->first()
        ) ? true :false;
    }

    protected function attemptLogin(Request $request)
    {
        if(Auth::guard($this->guard)->attempt(['email'=> $request->email,'password'=>$request->password],$request->remember ? true : false))
        {
            return true;
        }
        return false;
    }

    protected function loginSuccessResponse()
    {
        return redirect()
            ->route('home')
            ->withSuccess(['mess' => 'Đăng nhập thành công']);
    }


    protected function loginFailedResponse($mess,$input = ['no' => ''])
    {
        return redirect()
            ->back()
            ->withErrors($mess)->withInput($input);
    }
    public function logout()
    {
        Auth::guard('site')->logout();
        return redirect()->route('login');
    }
}
