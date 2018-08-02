<?php
/**
 * Created by PhpStorm.
 * User: Giang Nguyen
 * Date: 02/08/2018
 * Time: 21:21
 */

namespace App\Classes;


use Illuminate\Support\Facades\Mail;
use App\Models\UserActivation;
use App\Mail\UserActivationEmail;
use App\Models\Admin;

class ActivationService
{
    protected $userActivation;

    public function __construct(UserActivation $userActivation)
    {
        $this->userActivation = $userActivation;
    }

    public function sendActivationMail($user)
    {
        if ($user->state == 'ACTIVE' || !$this->shouldSend($user)) return;
        $token = $this->userActivation->createActivation($user);
        if(class_basename($user) == 'Admin')
            $user->activation_link = route('admin.activate', $token);
        else $user->activation_link = route('site.activate', $token);
        $mailable = new UserActivationEmail($user);
        Mail::to($user->email)->send($mailable);
    }

    public function activateUser($token)
    {
        $activation = $this->userActivation->getActivationByToken($token);
        if ($activation === null) return null;
        $user = Admin::find($activation->user_id);
        $user->state = 'ACTIVE';
        $user->save();
        $this->userActivation->deleteActivation($token);
        return $user;
    }

    private function shouldSend($user)
    {
        $activation = $this->userActivation->getActivation($user);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }

}