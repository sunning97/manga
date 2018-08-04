<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:site')->except(['logout']);
    }

    public function showLoginForm(){
        return view('site.auth.login');
    }

    public function login(Request $request)
    {
        $all = $request->only(['email','password','remember']);

        $notice = Validator::make($all,[
            'email' => 'required|email',
            'password' => 'required|min:6'
        ],[
            'email.required' => 'Vui lòng nhập email!',
            'email.email' => 'Định dạng email không đúng!',
            'password.required' => 'Mật khẩu không được để trống!',
            'password.min' => 'Mật khẩu không được ít hơn 6 kí tự!'
        ]);
        if($notice->fails()) return redirect()->back()->withInput($request->only(['email','remember']))->withErrors($notice);

        if(Auth::guard('site')->attempt(['email' => $request->email, 'password' => $request->password],$request->remember))
        {
            return redirect()->route('home');
        } else
        {
            return redirect()->back()->withErrors(['mess' => 'Email/mật khẩu không đúng']);
        }
    }

    public function logout()
    {
        Auth::guard('site')->logout();
        return redirect()->route('login');
    }
}
