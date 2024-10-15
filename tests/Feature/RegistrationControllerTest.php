<?php

namespace Tests\Feature;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrationController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegistrationControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_registration_form_contains_all_the_fields(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSeeHtml('<form action="' . action([RegistrationController::class, 'store']) . '" method="post"');
        $response->assertSeeHtml('<input type="text" name="username" required');
        $response->assertSeeHtml('<input type="email" name="email" required');
        $response->assertSeeHtml('<input type="password" name="password" required');
        $response->assertSeeHtml('<input type="password" name="password_confirmation" required');
        $response->assertSeeHtml('<input type="checkbox" name="agreement" required');
        $response->assertSeeHtml('<button type="submit"');
    }

    public function test_register_successfully_redirects_to_login_form(): void
    {
        $this->get('/register')->assertStatus(200);

        $data = [
            'username' => 'test',
            'email' => 'test@test.com',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
            'agreement' => '1',
        ];

        $response = $this->post('/register', $data);

        $user = User::where('email', $data['email'])->first();

        $this->assertNotNull($user);
        $this->assertEquals($user['username'], $user->username);
        $this->assertEquals($user['email'], $user->email);
        $this->assertTrue(Hash::check($data['password'], $user->password));
        $this->assertNull($user->email_verified_at);
        $response->assertRedirect(action([AuthController::class, 'index']));
    }

    public function test_register_fails_redirects_back(): void
    {
        $this->get('/register')->assertStatus(200);

        $data = [
            'username' => '',
            'email' => 'test@test.com',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
            'agreement' => '1',
        ];

        $response = $this->post('/register', $data);

        $user = User::where('email', $data['email'])->first();

        $this->assertNull($user);
        $response->assertRedirect(action([RegistrationController::class, 'index']));
    }
}
