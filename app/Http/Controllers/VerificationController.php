<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class VerificationController extends Controller
{
    public function notice(): RedirectResponse|View
    {
        return view('auth.verify-email');
    }
}
