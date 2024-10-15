<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class RegistrationService implements RegistrationServiceContract
{
    public function register(array $data): User
    {
        //   TODO: Improvement - utilize repository instead of
        //         directly using the Eloquent model
        $user = User::create($data);

        event(new Registered($user));

        return $user;
    }
}
