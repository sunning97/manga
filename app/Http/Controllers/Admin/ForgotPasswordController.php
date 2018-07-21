<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }
    protected function guard()
    {
        return Auth::guard('admin');
    }
    protected function broker(){
        return Password::broker('admins');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $email = $request->only('email');
        $notice = Validator::make($email,[
            'email' => 'email'
        ],[
            'email' => 'Định dạng email không đúng!'
        ]);
        if($notice->fails()) return response()->json('Định dạng email không đúng!',200);
        else if(!Admin::where('email',$email)->get()->all())
        {
            return response()->json('Email không tồn tại hoặc chưa được đăng kí!',200);
        }
        else
        {
            $response = $this->broker()->sendResetLink(
                $request->only('email')
            );

            return $response == Password::RESET_LINK_SENT
                ? response()->json('ok',200)
                : response()->json('error',401);
        }
    }

    protected function validateEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
    }

    protected function sendResetLinkResponse($response)
    {
        return back()->with('status', trans($response));
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return back()->withErrors(
            ['email' => trans($response)]
        );
    }
}
