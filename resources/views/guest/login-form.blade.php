<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Layanan Surat</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
            animation: gradientAnimation 15s ease infinite;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            transform-style: preserve-3d;
            perspective: 1000px;
            transition: all 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        }

        .login-container:hover {
            transform: translateY(-10px) rotateX(2deg) rotateY(2deg);
        }

        h2 {
            background: linear-gradient(45deg, #007bff, #17a2b8);
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            margin: -60px -40px 30px -40px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }

        h2:hover {
            transform: scale(1.05);
        }

        .form-group {
            margin-bottom: 2em;
            text-align: left;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 0.5em;
            font-weight: bold;
            color: #555;
            transition: all 0.3s ease;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.75em;
            border: 2px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            background-color: #f9f9f9;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.3);
            background-color: white;
            outline: none;
            transform: scale(1.01);
        }

        .error {
            color: #e74c3c;
            background-color: #fdf5f5;
            border-left: 4px solid #e74c3c;
            padding: 10px;
            margin-bottom: 1.5em;
            border-radius: 5px;
            font-size: 0.9em;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        button[type="submit"] {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            background: linear-gradient(45deg, #17a2b8, #007bff);
            color: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        button[type="submit"]:hover {
            background: linear-gradient(45deg, #007bff, #17a2b8);
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
            transform: translateY(-3px);
        }

        button[type="submit"]:active {
            transform: translateY(0);
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
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
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
