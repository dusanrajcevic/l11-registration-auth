<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Services\RegistrationServiceContract;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegistrationServiceTest extends TestCase
{
    use RefreshDatabase;

    private RegistrationServiceContract $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = app(RegistrationServiceContract::class);
        Event::fake();
    }

    public function test_registration_successful_if_user_does_not_exist(): void
    {
        $data = [
            'username' => 'someusername',
            'password' => 'somepassword',
            'email' => 'email@example.com',
            'agreement' => '1',
        ];

        $user = $this->service->register($data);

        Event::assertDispatched(Registered::class, fn(Registered $e) => $e->user === $user);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($user->username, $data['username']);
        $this->assertTrue(Hash::check($data['password'], $user->password));
        $this->assertEquals($user->email, $data['email']);
        $this->assertEquals($user->agreement, $data['agreement']);
    }

    public function test_registration_fails_if_user_exists(): void
    {
        User::factory()->create([
            'username' => 'someusername',
            'email' => 'email@example.com'
        ]);

        $data = [
            'username' => 'someusername',
            'password' => 'somepassword',
            'email' => 'email@example.com',
            'agreement' => 'agree',
        ];

        $this->expectException(UniqueConstraintViolationException::class);

        $this->service->register($data);
    }
}
