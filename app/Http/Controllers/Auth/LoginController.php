<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            // Admin ise admin paneline yönlendir
            if (Auth::user()->role) {
                return redirect()->intended('admin');
            }
 
            // Normal kullanıcı ise ana sayfaya yönlendir
            return redirect()->intended('/');
        }
 
        return back()->withErrors([
            'email' => 'Verilen bilgiler kayıtlarımızla eşleşmiyor.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
 
        return redirect('/login');
    }
}