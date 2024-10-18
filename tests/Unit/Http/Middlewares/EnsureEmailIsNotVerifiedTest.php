<?php

namespace Tests\Unit\Http\Middlewares;

use App\Http\Middleware\EnsureEmailIsNotVerified;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tests\TestCase;

class EnsureEmailIsNotVerifiedTest extends TestCase
{
    use RefreshDatabase;

    private EnsureEmailIsNotVerified $middleware;
    private Request $request;

    protected function setUp(): void
    {
        parent::setUp();
        $this->middleware = new EnsureEmailIsNotVerified();
        $this->request = Request::create('test-uri');
    }

    public function test_redirect_if_email_is_verified(): void
    {
        $user = User::factory()->create();
        $this->request->setUserResolver(fn() => $user);

        $response = $this->middleware->handle($this->request, fn() => new Response());

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals(route('home'), $response->headers->get('Location'));
    }

    public function test_proceed_if_email_unverified(): void
    {
        $user = User::factory()->unverified()->create();
        $this->request->setUserResolver(fn() => $user);

        $response = $this->middleware->handle($this->request, fn() => new Response('Proceed'));

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Proceed', $response->getContent());
    }

    public function test_proceed_if_unauthenticated(): void
    {
        $response = $this->middleware->handle($this->request, fn() => new Response('Proceed'));

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Proceed', $response->getContent());
    }
}
