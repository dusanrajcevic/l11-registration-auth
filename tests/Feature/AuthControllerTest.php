<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;
    CONST PASSWORD = 'D3a5S#lpK';
    private User $user;

    public function setup(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'password' => self::PASSWORD,
        ]);
    }

    public function test_login_page_is_accessible_to_unauthenticated_users_and_contains_proper_fields(): void
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
        $response->assertSeeHtml('<form action="' . route('authenticate') . '" method="post"');
        $response->assertSeeHtml('<input type="text" name="login" required');
        $response->assertSeeHtml('<input type="password" name="password" required');
        $response->assertSeeHtml('<input type="checkbox" name="remember"');
        $response->assertSeeHtml('<button type="submit"');
    }

    public function test_login_page_redirects_authenticated_users_to_home(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('login'));

        $response->assertRedirect(route('home'));
    }

    public function test_login_successfully_authenticates_user_with_username_and_redirects_to_home(): void
    {
        $this->get(route('login'))->assertStatus(200);

        $data = [
            'login' => $this->user->username,
            'password' => self::PASSWORD,
        ];

        $response = $this->post(route('authenticate'), $data);

        $this->assertAuthenticatedAs($this->user);
        $response->assertRedirect(route('home'));
    }

    public function test_login_successfully_authenticates_user_with_email_and_redirects_to_home(): void
    {
        $this->get(route('login'))->assertStatus(200);

        $data = [
            'login' => $this->user->email,
            'password' => self::PASSWORD,
        ];

        $response = $this->post(route('authenticate'), $data);

        $this->assertAuthenticatedAs($this->user);
        $response->assertRedirect(route('home'));
    }

    public function test_login_unsuccessfully_does_not_authenticate_and_redirects_to_login_page(): void
    {
        $this->get(route('login'))->assertStatus(200);

        $data = [
            'login' => $this->user->email,
            'password' => 'wrongpassword'
        ];
        $response = $this->post(route('authenticate'), $data);
        $this->assertNull(auth()->user());
        $response->assertRedirectToRoute('login');
    }
}
