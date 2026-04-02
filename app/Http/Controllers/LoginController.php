<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Where to redirect after login
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        // Jika sudah login, redirect ke dashboard
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('auth.login');
    }

    /**
     * Handle a login request
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',  // Bisa email atau username
            'password' => 'required|string',
        ]);

        // Try login with email
        if (Auth::attempt(['email' => $credentials['login'], 'password' => $credentials['password']])) {
            return redirect()->intended('/admin/dashboard');
        }

        // Try login with username
        if (Auth::attempt(['username' => $credentials['login'], 'password' => $credentials['password']])) {
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'login' => 'These credentials do not match our records.',
        ])->withInput();
    }

    /**
     * Log the user out
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
                       ->with('success', 'Anda telah berhasil logout');
    }
}
