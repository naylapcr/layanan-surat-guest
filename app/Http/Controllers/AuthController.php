<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login (method index untuk konsistensi)
     */
    public function index()
    {
        return view('guest.login-form');
    }

    /**
     * Menampilkan form login untuk guest
     */
    public function showLoginForm()
    {
        return view('guest.login-form'); // Diubah dari 'guests' menjadi 'guest' untuk konsistensi
    }

    /**
     * Memproses form login
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3|regex:/[A-Z]/',
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 3 karakter',
            'password.regex' => 'Password harus mengandung setidaknya satu huruf kapital'
        ]);

        // Coba login dengan authentication Laravel
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Login berhasil
            $request->session()->regenerate();
            return redirect()->intended('/dashboard'); // Redirect ke halaman setelah login sukses
        }

        // Login gagal - tampilkan halaman respon dengan data login (seperti sebelumnya)
        $data['email'] = $request->email;
        $data['password'] = $request->password;
        $data['error'] = 'Login gagal. Email atau password salah.';

        return view('guest.respon-form', $data);
    }

    /**
     * Proses logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login'); // Redirect ke halaman login setelah logout
    }

    /**
     * Menampilkan halaman respon form (jika masih diperlukan)
     */
    public function showResponseForm()
    {
        return view('guest.respon-form');
    }
}
