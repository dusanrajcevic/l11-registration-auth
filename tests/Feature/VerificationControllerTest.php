<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\URL;
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

    public function test_verifies_email_and_redirects_to_home(): void
    {
        $user = User::factory()->unverified()->create();

        $response = $this->actingAs($user)->get($this->verificationUrl($user));

        $this->assertTrue($user->fresh()->hasVerifiedEmail());
        $response->assertRedirect(route('home'));
        $response->assertSessionHas('message', __('registration.verification.success'));
    }

    public function test_does_not_verify_if_not_authenticated(): void
    {
        $user = User::factory()->unverified()->create();

        $response = $this->get($this->verificationUrl($user));

        $this->assertFalse($user->fresh()->hasVerifiedEmail());
        $response->assertRedirect();
    }

    public function test_does_not_verify_if_verified(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get($this->verificationUrl($user));

        $response->assertRedirect(route('home'));
        $response->assertSessionMissing('message');
    }

    private function verificationURL(User $user): string
    {
        return URL::signedRoute(
            'verification.verify',
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );
    }
}
