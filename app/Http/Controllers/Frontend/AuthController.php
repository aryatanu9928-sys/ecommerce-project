<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('frontend.login');
    }

    public function registerForm()
    {
        return view('frontend.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'phone'      => 'required|string|max:15',
            'password'   => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name'     => $request->first_name . ' ' . $request->last_name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('login.form')->with('success', 'Account created successfully. Please login.');
    }


    public function loginSubmit(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt to login
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Regenerate session to prevent fixation
            $request->session()->regenerate();

            // Redirect to intended page or home
            return redirect()->intended('/');
        }


        // Return back with error
        return back()->withErrors([
            'email' => 'Invalid email or password',
        ])->withInput();
    }




    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
