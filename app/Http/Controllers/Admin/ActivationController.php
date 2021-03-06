<?php

namespace App\Http\Controllers\Admin;

use App\Classes\ActivationService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivationController extends Controller
{
    protected $activationService;
    public function __construct(ActivationService $activationService)
    {
        $this->activationService = $activationService;
    }

    public function activateUser($token)
    {
        if ($user = $this->activationService->activateAdmin($token)) {
            return view('admin.auth.activation');
        }
        abort(404);
    }
}
