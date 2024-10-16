<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VerificationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_notice_page_is_accessible_to_authenticated_users_without_verified_email(): void
    {
        $user = User::factory()->unverified()->create();
        $response = $this->actingAs($user)->get(route('verification.notice'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.verify-email');
    }

    public function test_notice_page_redirects_authenticated_users_with_verified_email()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('verification.notice'));

        $response->assertRedirect(route('home'));
    }

    public function test_notice_page_redirects_unauthenticated_users_to_login()
    {
        $response = $this->get(route('verification.notice'));

        $response->assertRedirect(route('login'));
    }
}
