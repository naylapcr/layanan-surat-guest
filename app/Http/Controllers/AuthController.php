<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function index()
    {
        return view('guest.login-form');
    }

    /**
     * Memproses form login
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:3|regex:/[A-Z]/',
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 3 karakter',
            'password.regex' => 'Password harus mengandung setidaknya satu huruf kapital'
        ]);

        // Ambil data dari request
        $email = $request->email;
        $password = $request->password;

        // Simpan data dalam session atau array untuk ditampilkan
        $data['email'] = $email;
        $data['password'] = $password;

        // Tampilkan halaman respon dengan data login
        return view('guest.respon-form', $data);
    }
}
