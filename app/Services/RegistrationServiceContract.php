<?php

namespace App\Services;

use App\Models\User;

interface RegistrationServiceContract
{
    public function register(array $data): User;
}
