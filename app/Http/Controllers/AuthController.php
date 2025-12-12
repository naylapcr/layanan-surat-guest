<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login (method index untuk konsistensi)
     */
    public function index()
    {
        return view('pages.guest.auth.login-form');
    }

    /**
     * Menampilkan form login untuk guest
     */
    public function showLoginForm()
    {
        return view('pages.guest.auth.login-form');
    }

    /**
     * Menampilkan form registrasi
     */
    public function showRegistrationForm()
    {
        return view('pages.guest.auth.register-form');
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

        // 2. Coba Login
        if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // 3. Redirect jika sukses
        return redirect()->intended('/dashboard'); // Ganti '/dashboard' sesuai halaman tujuanmu
    }

        // 4. Kembali jika gagal
        return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
    }

    /**
     * Memproses registrasi user baru
     */
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3|confirmed|regex:/[A-Z]/',
            'role' => 'required|in:super_admin,staff,guest',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 3 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'password.regex' => 'Password harus mengandung setidaknya satu huruf kapital',
            'role.required' => 'Silakan pilih role pengguna'
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Login user setelah registrasi
        Auth::login($user);

        return redirect('/dashboard')->with('success', 'Registrasi berhasil!');
    }



    /**
     * Proses logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout');
    }



    /**
     * Menampilkan halaman respon form (jika masih diperlukan)
     */
    public function showResponseForm()
    {
        return view('guest.respon-form');
    }
}
