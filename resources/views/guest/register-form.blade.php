<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Surat Menyurat Bina Desa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #1e5799 0%, #207cca 51%, #2989d8 100%);
            padding: 20px;
        }

        .container {
            display: flex;
            max-width: 900px;
            width: 100%;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .left-panel {
            flex: 1;
            background: linear-gradient(rgba(30, 87, 153, 0.8), rgba(32, 124, 202, 0.8)),
                        url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect fill="%231e5799" width="100" height="100"/><path fill="%23207cca" d="M0 0h50v50H0z"/></svg>');
            background-size: cover;
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .left-panel h1 {
            font-size: 28px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .left-panel p {
            font-size: 16px;
            line-height: 1.6;
            max-width: 300px;
        }

        .right-panel {
            flex: 1;
            padding: 40px;
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo h2 {
            color: #1e5799;
            font-size: 24px;
            font-weight: 600;
        }

        .form-container {
            max-width: 350px;
            margin: 0 auto;
        }

        h3 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
            font-size: 22px;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 15px;
            transition: all 0.3s;
        }

        input:focus {
            border-color: #1e5799;
            box-shadow: 0 0 0 2px rgba(30, 87, 153, 0.2);
            outline: none;
        }

        .password-hint {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }

        .btn-register {
            width: 100%;
            padding: 12px;
            background: #1e5799;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
        }

        .btn-register:hover {
            background: #16457a;
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #666;
        }

        .login-link a {
            color: #1e5799;
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
            font-size: 14px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
            font-size: 14px;
        }

        .text-error {
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .left-panel {
                padding: 30px 20px;
            }

            .right-panel {
                padding: 30px 20px;
            }
        }
    </style>
</head>

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

                    <button type="submit" class="btn-register">Daftar</button>
                </form>

                <div class="login-link">
                    Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
