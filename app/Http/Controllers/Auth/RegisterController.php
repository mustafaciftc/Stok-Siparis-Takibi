<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User; // User modelini ekleyin
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Şifre hashleme için

class RegisterController extends Controller
{
    public function __construct()
    {
        // Laravel 11'de middleware tanımlaması router seviyesinde yapılır
        // Bu satırı silebilirsiniz
    }

    /**
     * Kayıt formunu gösterir.
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Kullanıcı kaydını işler.
     */
    public function register(Request $request)
    {
        // Gelen verileri doğrula
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Kullanıcı oluştur
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // Şifreyi hashle
            'role' => 0, // Varsayılan olarak normal kullanıcı (admin = 1)

        ]);

        // Kullanıcıyı otomatik olarak giriş yaptırmak istemiyorsanız bu satırı kaldırın
        // Auth::login($user);

        // Başarılı kayıt sonrası login sayfasına yönlendir
        return redirect()->route('login')->with('success', 'Kayıt işlemi başarılı. Giriş yapabilirsiniz.');
    }

    /**
     * Kullanıcı çıkışını işler.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}