<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Services\RegistrationServiceContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function __construct(
        private readonly RegistrationServiceContract $service
    ) {
    }

    /**
     * Show the registration form.
     */
    public function index(): View
    {
        return view('pages.register');
    }

    /**
     * Register the user and redirect it to the login form.
     */
    public function store(RegistrationRequest $request): RedirectResponse
    {
        $this->service->register($request->validated());

        return redirect()
            ->action([AuthController::class, 'index'])
            ->with(['success' => __('registration.success')]);
    }
}
