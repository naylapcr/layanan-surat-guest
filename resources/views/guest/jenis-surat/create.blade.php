<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Tambah Jenis Surat - Bina Desa</title>
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
            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Tambah Jenis Surat</h1>
            <p class="lead text-white animate__animated animate__fadeInUp">Tambahkan jenis surat baru ke sistem</p>
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
                                <i class="fas fa-file-alt me-2"></i>
                                Formulir Jenis Surat Baru
                            </h3>
                        </div>
                        <div class="form-body">
                            <form method="POST" action="{{ route('jenis-surat.store') }}">
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
                                        <label for="kode" class="form-label">Kode Surat *</label>
                                        <div class="input-group-icon">
                                            <input type="text" class="form-control" id="kode" name="kode"
                                                   value="{{ old('kode') }}" required
                                                   placeholder="Contoh: SKD, SKTM">
                                            <i class="fas fa-code form-icon"></i>
                                        </div>
                                        <div class="form-text">Kode unik untuk jenis surat (contoh: SKD, SKTM, SKU)</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nama_jenis" class="form-label">Nama Jenis Surat *</label>
                                        <div class="input-group-icon">
                                            <input type="text" class="form-control" id="nama_jenis" name="nama_jenis"
                                                   value="{{ old('nama_jenis') }}" required
                                                   placeholder="Contoh: Surat Keterangan Domisili">
                                            <i class="fas fa-file-signature form-icon"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="syarat_json" class="form-label">Syarat-syarat</label>
                                    <div class="input-group-icon">
                                        <textarea class="form-control" id="syarat_json" name="syarat_json" rows="4"
                                                  placeholder="Masukkan syarat-syarat yang diperlukan, pisahkan dengan koma">{{ old('syarat_json') }}</textarea>
                                        <i class="fas fa-clipboard-list form-icon" style="top: 20px;"></i>
                                    </div>
                                    <div class="form-text">Pisahkan setiap syarat dengan koma (contoh: Fotokopi KTP, Fotokopi KK, Surat Pengantar RT)</div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-5">
                                    <a href="{{ route('jenis-surat.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-submit">
                                        <i class="fas fa-save me-2"></i>Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="text-light mb-4">Kontak</h4>
                        <a href="" class="text-white mb-2"><i class="fa fa-map-marker-alt me-2"></i> Jl. Desa No. 123, Bina Desa</a>
                        <a href="" class="text-white mb-2"><i class="fas fa-envelope me-2"></i> admin@binadesa.com</a>
                        <a href="" class="text-white mb-2"><i class="fas fa-phone me-2"></i> +012 345 67890</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid bg-primary py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6 text-center text-md-start mb-md-0">
                    <span class="text-white">© 2024 Bina Desa. All right reserved.</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <script>
        window.addEventListener('load', function() {
            document.getElementById('spinner').style.display = 'none';
        });
    </script>
</body>
</html>
