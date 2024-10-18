<?php

namespace App\Services;

interface AuthServiceContract
{
    public function authenticate(array $data): bool;
}
