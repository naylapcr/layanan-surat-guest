{{-- start css --}}
@include('layouts.guest.authcss')
{{-- end css --}}

{{-- main content --}}

<body>
    <div class="container">
        {{-- Panel Kiri (Deskripsi) --}}
        <div class="left-panel">
            <h1>Sistem Surat Menyurat</h1>
            <p>Bina Desa - Layanan pengelolaan surat menyurat untuk masyarakat desa secara digital dan terintegrasi.</p>
        </div>

        {{-- Panel Kanan (Form Login) --}}
        <div class="right-panel">
            <div class="logo">
                {{-- Anda bisa mengganti ini dengan img logo jika ada, sesuai desain baru --}}
                <img src="{{ asset('assets-guest/img/logo-login.png') }}" alt="Logo" style="width: 50px;">
                <h2>Bina Desa</h2>
            </div>

            <div class="form-container">
                <h3>Login Layanan Surat</h3>

                {{-- Menampilkan Error Validasi (Style Lama Anda) --}}
                @if ($errors->any())
                    <div class="alert-error" style="color: red; background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                        <ul style="margin-left: 15px; margin-bottom: 0;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Menampilkan Pesan Sukses (Jika ada) --}}
                @if (session('success'))
                    <div class="alert-success" style="color: green; background-color: #d4edda; border: 1px solid #c3e6cb; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- FORM LOGIN (Logika Backend Diperbaiki) --}}
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf  {{-- Token Keamanan Wajib --}}

                    <div class="form-group">
                        <label for="email">Email:</label>
                        {{-- Value old('email') agar tidak hilang saat salah password --}}
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <span class="text-error" style="color: red; font-size: 0.8em;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                        @error('password')
                            <span class="text-error" style="color: red; font-size: 0.8em;">{{ $message }}</span>
                        @enderror
                        <div class="password-hint">Minimal 3 karakter</div>
                    </div>

                    <button type="submit" class="btn-login">Login</button>
                </form>

                <div class="register-link">
                    {{-- Pastikan route ini sesuai dengan route register Anda (bisa 'register' atau 'auth.register') --}}
                    Belum punya akun? <a href="{{ route('auth.register') }}">Daftar di sini</a>
                </div>

                <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
                    <p style="color: #666; font-size: 14px;">Sistem Surat Menyurat Bina Desa</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Script JS dihapus karena mengganggu proses login ke server --}}
    {{-- Jika Anda butuh script untuk animasi visual, boleh ditambahkan,
         TAPI JANGAN GUNAKAN 'e.preventDefault()' pada form submit --}}
</body>

</html>
