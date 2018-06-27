<?php

namespace App\Http\Controllers\Manga;

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
    public function index()
    {
        if(Auth::check()){
            return redirect()->route('manga.dashboard');
        }
        return view('admin.auth.login');
    }

    public function login_process(Request $request){
        $all = $request->only(['email','password']);
        $remember_me = false;

        if($request->remember_me){
            $remember_me = true;
        }
        $noite = Validator::make($all,[
            'email'=>'required|email',
            'password' => 'required|min:6'
        ],[
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Password không được để trống',
            'password.min'=>'Password không được ngắn hơn 6 kí tự'
        ]);

        if($noite->fails()) return redirect()->back()->withErrors($noite);

        if(Auth::attempt(['email' => $request->email,'password' => $request->password],$remember_me)){
            Auth::user()->state = 'ONLINE';
            Auth::user()->save();
            return redirect()->route('manga.dashboard')->withSuccess(['mess'=>'Đăng nhập thành công']);
        } else {
            return redirect()->back()->withErrors(['mess'=>'Email/mật khẩu không đúng!']);
        }
    }

    public function logout()
    {
        Auth::user()->state = 'OFFLINE';
        Auth::user()->save();
        Auth::logout();
        return redirect()->route('manga.login');
    }

}
