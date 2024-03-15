<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia as Assert;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\AbstractProvider;
use Mockery;
use Laravel\Socialite\Two\User as SocialiteUser;

class AuthTest extends TestCase
{
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
}
