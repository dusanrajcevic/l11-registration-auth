<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

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
}
