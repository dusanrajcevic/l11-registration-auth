<?php

namespace App\Services;

class AuthService implements AuthServiceContract
{
    public function authenticate(array $data): bool
    {
        return auth()->attempt($this->credentials($data), $data['remember']);
    }

    private function credentials(array $data): array
    {
        return [
            $this->loginField($data['login']) => $data['login'],
            'password' => $data['password'],
        ];
    }

    private function loginField(string $loginValue): string
    {
        return filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    }
}
