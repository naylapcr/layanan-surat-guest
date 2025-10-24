<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Tambah Data Warga - Bina Desa</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Poppins:wght@200;300;400;500;600&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

    <style>
        .navbar-nav .nav-link.active {
            color: #0d6efd !important;
            font-weight: bold;
            position: relative;
        }

        .navbar-nav .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #0d6efd;
        }

        .page-header {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://via.placeholder.com/1920x600') center/cover no-repeat;
            padding: 120px 0 80px;
            color: white;
        }

        .form-card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: none;
            overflow: hidden;
        }

        .form-header {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            color: white;
            padding: 20px;
        }

        .form-body {
            padding: 30px;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .btn-submit {
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
        }

        .form-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .input-group-icon {
            position: relative;
        }
    </style>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-primary px-5 d-none d-lg-block">
        <div class="row gx-0 align-items-center">
            <div class="col-lg-8 text-center text-lg-start mb-lg-0">
                <div class="d-flex">
                    <a href="#" class="text-white me-4"><i class="fas fa-envelope text-light me-2"></i>admin@binadesa.com</a>
                    <a href="#" class="text-white me-0"><i class="fas fa-phone-alt text-light me-2"></i>+01234567890</a>
                </div>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <a href="#" class="text-white me-2">Bantuan</a><small class="text-white"> / </small>
                    <a href="#" class="text-white mx-2">Dukungan</a><small class="text-white"> / </small>
                    <a href="#" class="text-white ms-2">Kontak</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid nav-bar p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 px-lg-5 py-3 py-lg-0">
            <a href="{{ url('/') }}" class="navbar-brand p-0">
                <h1 class="display-5 text-secondary m-0">Bina Desa</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="{{ url('/') }}" class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}">Beranda</a>
                    <a href="{{ route('warga.index') }}" class="nav-item nav-link {{ Request::is('warga*') ? 'active' : '' }}">Data Warga</a>
                    <a href="{{ route('jenis-surat.index') }}" class="nav-item nav-link {{ Request::is('jenis-surat*') ? 'active' : '' }}">Jenis Surat</a>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container text-center">
            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Tambah Data Warga</h1>
            <p class="lead text-white animate__animated animate__fadeInUp">Tambahkan data warga baru ke sistem</p>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Content Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card form-card animate__animated animate__fadeInUp">
                        <div class="form-header text-center">
                            <h3 class="mb-0">
                                <i class="fas fa-user-plus me-2"></i>
                                Formulir Data Warga Baru
                            </h3>
                        </div>
                        <div class="form-body">
                            <form method="POST" action="{{ route('warga.store') }}">
                                @csrf

                                @if($errors->any())
                                    <div class="alert alert-danger animate__animated animate__shakeX">
                                        <h5><i class="fas fa-exclamation-triangle me-2"></i>Terjadi Kesalahan</h5>
                                        <ul class="mb-0 mt-2">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="no_ktp" class="form-label">Nomor KTP *</label>
                                        <div class="input-group-icon">
                                            <input type="text" class="form-control" id="no_ktp" name="no_ktp"
                                                   value="{{ old('no_ktp') }}" required
                                                   placeholder="Masukkan nomor KTP">
                                            <i class="fas fa-id-card form-icon"></i>
                                        </div>
                                        <div class="form-text">Nomor KTP harus unik dan belum terdaftar</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nama" class="form-label">Nama Lengkap *</label>
                                        <div class="input-group-icon">
                                            <input type="text" class="form-control" id="nama" name="nama"
                                                   value="{{ old('nama') }}" required
                                                   placeholder="Masukkan nama lengkap">
                                            <i class="fas fa-user form-icon"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin *</label>
                                        <div class="input-group-icon">
                                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                            <i class="fas fa-venus-mars form-icon"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="agama" class="form-label">Agama *</
