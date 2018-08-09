<?php

namespace App\Http\Controllers\Site;

use App\Classes\ActivationService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivationController extends Controller
{
    public $activationService;
    public function __construct(ActivationService $activationService)
    {
        $this->activationService =$activationService;
    }

    public function activateUser($token)
    {
        if ($user = $this->activationService->activateUser($token)) {
            return view('site.auth.activation');
        }
        abort(404);
    }
}
