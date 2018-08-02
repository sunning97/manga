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
        if ($user = $this->activationService->activateUser($token)) {
            return 'xac thuc thanh cong';
        }
        abort(404);
    }
}
