{{-- start css --}}
@include('layouts.guest.authcss')
{{-- end css --}}

{{-- start main content --}}

<body>
    <div class="container">
        <div class="left-panel">
            <h1>Sistem Surat Menyurat</h1>
            <p>Bina Desa - Layanan pengelolaan surat menyurat untuk masyarakat desa secara digital dan terintegrasi.</p>
        </div>

        <div class="right-panel">
            <div class="logo">
                <h2>Bina Desa</h2>
            </div>

            <div class="form-container">
                <h3>Daftar Akun Baru</h3>

                @if ($errors->any())
                    <div class="alert-error">
                        <ul style="margin-left: 15px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="text-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="text-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="role">Daftar Sebagai</label>
                        <select id="role" name="role" required
                            style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                            <option value="" disabled selected>-- Pilih Role --</option>
                            <option value="guest">Guest (Tamu)</option>
                            <option value="staff">Staff</option>
                            <option value="super_admin">Super Admin</option>
                        </select>
                        @error('role')
                            <span class="text-error">{{ $message }}</span>
                        @enderror
                    </div>
                
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" value="{{ old('username') }}" required>
                            @error('username')
                                <span class="text-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required>
                            @error('password')
                                <span class="text-error">{{ $message }}</span>
                            @enderror
                            <div class="password-hint">Minimal 3 karakter & harus mengandung huruf kapital</div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required>
                        </div>



                        <button type="submit" class="btn-login">Daftar</button>
                </form>

                <div class="login-link">
                    Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
{{-- end main content --}}
