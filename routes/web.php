<?php

use Illuminate\Support\Facades\Route;

Route::resource('register', \App\Http\Controllers\RegistrationController::class)
    ->only(['index', 'store']);
