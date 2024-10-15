<?php

namespace Tests\Feature;

use App\Http\Controllers\RegistrationController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationControllerTest extends TestCase
{
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
}
