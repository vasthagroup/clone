<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    // ── Show the login/register page ─────────────────────────────
    public function showLogin(): View|RedirectResponse
    {
        // If already logged in, skip straight to dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        
        return view('auth.login');
    }
    
    // ── Handle registration ───────────────────────────────────────
    public function register(RegisterRequest $request): RedirectResponse
    {
        // $request->validated() only returns fields that passed the rules.
        // The User model's 'hashed' cast on password automatically bcrypts it.
        $user = User::create($request->validated());
        
        // Log the new user in straight away
        Auth::login($user);
        
        return redirect()->route('dashboard')->with('success', 'Welcome! Your account has been created.');
    }
    
    // ── Handle login ──────────────────────────────────────────────
    public function login(LoginRequest $request): RedirectResponse
    {
        User::create([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        
        return back()->with('success', 'Data saved successfully');
    }
    
    // ── Handle logout ─────────────────────────────────────────────
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}
