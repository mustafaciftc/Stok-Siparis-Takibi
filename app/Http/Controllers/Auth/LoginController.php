<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;


class LoginController extends Controller
{
    public function __construct()
    {
        // Laravel 11'de middleware tanımlaması router seviyesinde yapılır
        // Bu satırı silebilirsiniz
    }

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

        $remember = $request->has('remember'); // Checkbox kontrolü

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
    
            // Eğer kullanıcı "Beni Hatırla" seçtiyse bilgileri cookie'ye kaydediyoruz.
            if ($remember) {
                Cookie::queue('email', $request->email, 60 * 24 * 30); // 30 gün saklar
                Cookie::queue('password', $request->password, 60 * 24 * 30);
            } else {
                Cookie::queue(Cookie::forget('email'));
                Cookie::queue(Cookie::forget('password'));
            }
    
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