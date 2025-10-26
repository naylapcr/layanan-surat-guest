<!DOCTYPE html>
<html>
<head>
    <title>Login Berhasil - Layanan Surat</title>
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

        .success-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
            transform-style: preserve-3d;
            perspective: 1000px;
            transition: all 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        }

        .success-container:hover {
            transform: translateY(-10px) rotateX(2deg) rotateY(2deg);
        }

        .success-header {
            background: linear-gradient(45deg, #007bff, #17a2b8);
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            margin: -60px -40px 30px -40px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }

        .success-header:hover {
            transform: scale(1.05);
        }

        .user-info {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin: 30px 0;
            text-align: left;
            border: 1px solid #ddd;
        }

        .user-info p {
            margin: 8px 0;
        }

        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .btn-primary {
            background: linear-gradient(45deg, #17a2b8, #007bff);
            color: white;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #007bff, #17a2b8);
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
            transform: translateY(-3px);
        }

        .btn-primary:active {
            transform: translateY(0);
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .btn-secondary:hover {
            background: #545b62;
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
            transform: translateY(-3px);
        }

        .btn-secondary:active {
            transform: translateY(0);
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-header">
            <h2>Login Berhasil!</h2>
        </div>

        <div style="font-size: 18px; margin-bottom: 20px; margin-top: 20px;">
            <p><strong>Selamat, anda sudah berhasil login!!</strong></p>
            <p>Silahkan Akses Layanan Surat Anda.</p>
        </div>

        <div class="user-info">
            <h3>Informasi Login:</h3>
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>Password:</strong> {{ $password }}</p>
        </div>

        <div class="button-group">
            <a href="{{ route('auth.index') }}" class="btn btn-secondary">Kembali ke Login</a>
            <a href="{{ route('home') }}" class="btn btn-primary">Beranda Utama</a>
        </div>
    </div>
</body>
</html>
