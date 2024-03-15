<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia as Assert;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\AbstractProvider;
use Mockery;
use Laravel\Socialite\Two\User as SocialiteUser;
use Mockery\MockInterface;

class AuthTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Mock Google client ID and client secret for testing
        config(['services.google.client_id' => 'mock_client_id']);
        config(['services.google.client_secret' => 'mock_client_secret']);
    }

    public function test_index_method_returns_view()
    {
        $this->get('/auth')->assertInertia(fn (Assert $page) => $page->component('Auth'));
    }

    public function test_redirect_method_redirects_to_google_auth()
    {
        $response = $this->get('/auth/redirect');

        $response->assertRedirect();

        $redirectUrl = $response->headers->get('Location');

        $this->assertStringStartsWith('https://accounts.google.com/o/oauth2', $redirectUrl);
    }


    public function test_logout_method()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post('/auth/logout');

        $this->assertGuest();

        $response->assertRedirect(route('auth.index'));
    }
}
