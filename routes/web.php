<?php

use Illuminate\Support\Facades\Route;

Route::resource('register', \App\Http\Controllers\RegistrationController::class)
    ->only(['index', 'store']);

Route::get('login', [\App\Http\Controllers\AuthController::class, 'index'])
    ->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', [\App\Http\Controllers\VerificationController::class, 'notice'])
        ->middleware('unverified')
        ->name('verification.notice');

    Route::get('home', fn() => 'Logged in and verified')
        ->middleware(['verified'])
        ->name('home');
});
