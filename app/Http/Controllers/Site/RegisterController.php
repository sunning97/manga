<?php

namespace App\Http\Controllers\Site;

use App\Classes\ActivationService;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public $activationService;
    public function __construct(ActivationService $activationService)
    {
        $this->middleware('guest:site');
        $this->activationService = $activationService;
    }

    public function showRegistrationForm()
    {
        return view('site.auth.register');
    }

    public function register(Request $request)
    {

        $this->getValidateRegister($request);

        if($this->checkEmail($request))
            return $this->registerFailedResponse(
                [
                    'email' => 'Email đã được đăng kí vui lòng chọn email hợp lệ khác'
                ],
                [
                    'l_name' => $request->l_name,
                    'f_name' => $request->f_name,
                    'email' => $request->email
                ]
            );

        if(!$this->checkAgreeTerm($request))
            return $this->registerFailedResponse(
                [
                    'term' => 'Bạn chưa đồng ý với điều khoản của hệ thống'
                ],
                $request->all()
            );

        $user = new User();
        $user->f_name =$request->f_name;
        $user->l_name =$request->l_name;
        $user->email =$request->email;
        $user->password = Hash::make($request->password);
        $user->avatar = 'default.png';
        $user->save();

        $this->activationService->sendActivationMail($user);
        $request->session()->reflash();
        $request->session()->keep(['user', $user]);
        return $this->registerSuccessResponse();

    }

    protected function getValidateRegister(Request $request)
    {
        $this->validate($request,[
            'f_name' => 'required|string',
            'l_name' => 'required|string',
            'email' => 'required|email|string',
            'password' => 'required|min:7|confirmed|string'
        ],[
            'f_name.required' => 'Vui lòng nhập vào trường này',
            'f_name.string' => 'Vui lòng nhập chữ',
            'l_name.required' => 'Vui lòng nhập vào trường này',
            'l_name.string' => 'Vui lòng nhập chữ',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.string' => 'Email không đúng định dạng',
            'password.string' => 'Vui lòng nhập chuỗi~',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 7 kí tự',
            'password.confirmed' => 'Mật khẩu không khớp'
        ]);

    }

    protected function checkEmail(Request $request)
    {
        return (User::where('email','=',$request->email)->first()) ? true : false;
    }

    protected function checkAgreeTerm(Request $request)
    {
        return ($request->agree_term) ? true : false ;
    }

    protected function registerSuccessResponse()
    {
        return redirect()
            ->route('register.success');
    }

    protected function registerFailedResponse($mess,$input=['no' => ''])
    {
        return redirect()
            ->back()
            ->withErrors($mess)
            ->withInput($input);
    }

    public function registerSuccess()
    {
        return view('site.auth.register-success');
    }
}
