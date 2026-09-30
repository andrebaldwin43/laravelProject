<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Display the login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle the authentication attempt
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to log the user in
        if (Auth::attempt($credentials, $request->remember)) {
            // Regenerate session to protect against session fixation attacks
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        // Return back with an error if authentication fails
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Log the user out
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // Show the registration form
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Handle the registration submission
    public function register(Request $request)
    {
        // 1. Validate the form inputs
        $fields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // requires password_confirmation
        ]);

        // 2. Create and save the user
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
        ]);

        // 3. Log the user in
        Auth::login($user);

        // 4. Redirect to a protected page
        return redirect()->route('dashboard')->with('success', 'Account created successfully!');
    }
}
