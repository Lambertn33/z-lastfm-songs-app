<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function index()
    {
        return inertia('Auth');
    }
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $socialUser = Socialite::driver('google')->user();

        // Check if the user already exists
        $user = User::where('email', $socialUser->email)->first();

        if (!$user) {
            // User does not exist, create a new user
            $user = User::create([
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'avatar' => $socialUser->avatar,
                'token' => $socialUser->token,
                'refresh_token' => $socialUser->refresh_token
            ]);
        }

        // Log in the user
        Auth::login($user);
        return redirect("/");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("auth.index");
    }
}
