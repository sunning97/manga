<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function checkPermission($permission)
    {
        return Auth::guard('admin')->user()->hasPermission($permission);
    }
    protected function returnError($messages,$input = null)
    {
        return $input == null ?
            redirect()->back()->withErrors($messages)
            : redirect()->back()->withErrors($messages)->withInput($input);
    }
}
