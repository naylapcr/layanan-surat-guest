<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background: #f0f2f5; }
        .login-container { background: #fff; padding: 2em; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .error { color: red; margin-bottom: 1em; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login Layanan Surat</h2>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('auth.login') }}">
            @csrf
            <div>
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" value="{{ old('username') }}">
            </div>
            <br>
            <div>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password">
            </div>
            <br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
