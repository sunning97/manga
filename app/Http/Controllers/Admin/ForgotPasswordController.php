<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('guest:admin');
    }
    protected function broker(){
        return Password::broker('admins');
    }
    public function sendResetLink(Request $request){
        $email = $request->only('email');
        $notice = Validator::make($email,[
            'email' => 'email'
        ],[
            'email' => 'Định dạng email không đúng!'
        ]);
        if($notice->fails()) return response()->json($notice->customMessages,200);
        else {

            return response()->json('ok',200);
        }
    }
}
