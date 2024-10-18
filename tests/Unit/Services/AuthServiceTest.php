<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Services\AuthServiceContract;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthServiceTest extends TestCase
{
    use RefreshDatabase;

    private AuthServiceContract $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = app(AuthServiceContract::class);
    }

    public function test_auth_returns_true_and_authenticates_user_for_valid_username_and_password(): void
    {
        $user = User::factory()->create([
            'username' => 'someusername',
            'password' => 'B37#klCtd'
        ]);
        $data = [
            'login' => 'someusername',
            'password' => 'B37#klCtd'
        ];

        $data['remember'] = true;
        $this->assertTrue($this->service->authenticate($data));

        $data['remember'] = false;
        $this->assertTrue($this->service->authenticate($data));
        $this->assertEquals(auth()->id(), $user->id);
    }

    public function test_auth_returns_true_and_authenticates_user_for_valid_email_and_password(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => 'B37#klCtd'
        ]);

        $data = [
            'login' => 'test@example.com',
            'password' => 'B37#klCtd',
            'remember' => true
        ];
        $this->assertTrue($this->service->authenticate($data));

        $data['remember'] = false;
        $this->assertTrue($this->service->authenticate($data));
        $this->assertEquals(auth()->id(), $user->id);
    }

    public function test_auth_returns_false_for_wrong_credentials(): void
    {
        User::factory()->create([
            'username' => 'someuser',
            'email' => 'test@example.com',
            'password' => 'B37#klCtd',
        ]);

        $data = [
            'login' => 'someuser',
            'password' => 'wrongpass',
            'remember' => true,
        ];
        $this->assertFalse($this->service->authenticate($data));
        $this->assertNull(auth()->id());

        $data['remember'] = false;
        $this->assertFalse($this->service->authenticate($data));
        $this->assertNull(auth()->id());

        $data['login'] = 'test@example.com';
        $this->assertFalse($this->service->authenticate($data));
        $this->assertNull(auth()->id());

        $data['remember'] = true;
        $this->assertFalse($this->service->authenticate($data));
        $this->assertNull(auth()->id());
    }
}
