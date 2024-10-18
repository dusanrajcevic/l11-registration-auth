<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthServiceContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function __construct(
        private AuthServiceContract $service
    ) {

    }
    /**
     * Show the login form.
     */
    public function index(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        if ($this->service->authenticate($request->validated())) {
            return redirect()->intended(route('home'));
        }

        return redirect()->route('login')->withErrors(['Wrong credentials']);
    }
}
