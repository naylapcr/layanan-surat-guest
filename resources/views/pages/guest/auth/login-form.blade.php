{{-- start css --}}
@include('layouts.guest.authcss')
{{-- end css --}}

{{-- main content --}}
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
                <h3>Login Layanan Surat</h3>

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


                <form action="{{ url('/dashboard') }}" method="GET">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="text-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                        @error('password')
                            <span class="text-error">{{ $message }}</span>
                        @enderror
                        <div class="password-hint">Minimal 3 karakter & harus mengandung huruf kapital</div>
                    </div>

                    <button type="submit" class="btn-login">Login</button>
                </form>

                <div class="register-link">
                    Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
                </div>

                <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
                    <p style="color: #666; font-size: 14px;">Sistem Surat Menyurat Bina Desa</p>
                </div>
            </div>
        </div>
    </div>

    <script>

        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.querySelector('form');

            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();


                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;

                if (email && password) {

                    window.location.href = "{{ url('/dashboard') }}";
                }
            });
        });
    </script>
</body>
</html>
{{-- end main content --}}

