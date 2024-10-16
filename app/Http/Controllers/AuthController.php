<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function index(): View
    {
        return view('auth.login');
    }
}
