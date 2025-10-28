<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Surat - Bina Desa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    
    <style>
        :root {
            --primary: #0d6efd;
            --secondary: #6c757d;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #198754;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
        }

        .sub-title {
            color: var(--primary);
            font-weight: 600;
            letter-spacing: 1px;
            position: relative;
            display: inline-block;
        }

        .sub-title::after {
            content: '';
            position: absolute;
            width: 60px;
            height: 2px;
            background: var(--primary);
            bottom: -8px;
            left: 0;
        }

        .display-5 {
            font-weight: 700;
            color: var(--dark);
        }

        .bg-light {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .feature-icon {
            background: linear-gradient(135deg, var(--primary), #0a58ca);
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .stat-box {
            background: linear-gradient(135deg, var(--light), #e9ecef);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .stat-box:hover {
            transform: translateY(-5px);
        }

        .service-card {
            border-radius: 10px;
            padding: 25px;
            height: 100%;
            transition: all 0.3s;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-color: var(--primary);
        }

        .phone-animation {
            animation: ring 2s infinite;
        }

        @keyframes ring {
            0% { transform: rotate(0); }
            5% { transform: rotate(15deg); }
            10% { transform: rotate(-15deg); }
            15% { transform: rotate(15deg); }
            20% { transform: rotate(-15deg); }
            25% { transform: rotate(0); }
            100% { transform: rotate(0); }
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), #0a58ca);
            border: none;
            padding: 10px 25px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
        }

        .process-step {
            position: relative;
            padding-left: 30px;
            margin-bottom: 25px;
        }

        .process-step::before {
            content: '';
            position: absolute;
            width: 15px;
            height: 15px;
            background: var(--primary);
            border-radius: 50%;
            left: 0;
            top: 5px;
        }

        .process-step::after {
            content: '';
            position: absolute;
            width: 2px;
            height: 100%;
            background: var(--primary);
            left: 7px;
            top: 20px;
        }

        .process-step:last-child::after {
            display: none;
        }
    </style>
</head>
<body>
    <!-- About Section - Layanan Surat -->
    <div class="container-fluid py-5 bg-light">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-xl-5 wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="bg-light rounded position-relative">
                        <img src="https://placehold.co/600x400/0d6efd/ffffff?text=Layanan+Surat+Bina+Desa" class="img-fluid w-100 rounded" style="margin-bottom: -7px;" alt="Layanan Surat Bina Desa">
                        <div class="position-absolute bottom-0 start-0 bg-primary text-white p-3 rounded-end">
                            <h5 class="mb-0">Melayani dengan Hati</h5>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="stat-box">
                                <div class="mb-2">
                                    <i class="fas fa-envelope-open-text fa-3x text-primary"></i>
                                </div>
                                <h2 class="fw-bold mb-1">500+</h2>
                                <p class="text-muted mb-0">Surat Diproses</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-box">
                                <div class="mb-2">
                                    <i class="fas fa-users fa-3x text-primary"></i>
                                </div>
                                <h2 class="fw-bold mb-1">300+</h2>
                                <p class="text-muted mb-0">Warga Terlayani</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-7 wow fadeInRight" data-wow-delay="0.3s">
                    <h5 class="sub-title pe-3">Layanan Surat</h5>
                    <h1 class="display-5 mb-4">Sistem Surat Menyurat Digital Bina Desa</h1>
                    <p class="mb-4">Kami hadir untuk mempermudah proses administrasi surat menyurat di Desa Bina. Dengan sistem yang terintegrasi, warga dapat mengajukan berbagai jenis surat dengan mudah dan cepat tanpa harus datang ke kantor desa.</p>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="service-card">
                                <div class="feature-icon mx-auto">
                                    <i class="fas fa-file-contract fa-2x text-white"></i>
                                </div>
                                <h5 class="text-center mb-3">Surat Keterangan</h5>
                                <p class="text-center text-muted">Pengajuan surat keterangan domisili, tidak mampu, usaha, dan lainnya.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="service-card">
                                <div class="feature-icon mx-auto">
                                    <i class="fas fa-user-check fa-2x text-white"></i>
                                </div>
                                <h5 class="text-center mb-3">Surat Pengantar</h5>
                                <p class="text-center text-muted">Pengajuan surat pengantar untuk keperluan administrasi lainnya.</p>
                            </div>
                        </div>
                    </div>

                    <div class="row gy-4 align-items-center">
                        <div class="col-12 col-sm-6 d-flex align-items-center">
                            <i class="fas fa-map-marked-alt fa-3x text-secondary"></i>
                            <h5 class="ms-4">Layanan Terpadu</h5>
                        </div>
                        <div class="col-12 col-sm-6 d-flex align-items-center">
                            <i class="fas fa-passport fa-3x text-secondary"></i>
                            <h5 class="ms-4">Proses Cepat</h5>
                        </div>

                        <div class="col-12 mt-4">
                            <h5 class="mb-3">Proses Pengajuan Surat</h5>
                            <div class="process-step">
                                <h6>1. Daftar / Login</h6>
                                <p class="text-muted mb-0">Akses sistem dengan akun terdaftar</p>
                            </div>
                            <div class="process-step">
                                <h6>2. Pilih Jenis Surat</h6>
                                <p class="text-muted mb-0">Tentukan jenis surat yang dibutuhkan</p>
                            </div>
                            <div class="process-step">
                                <h6>3. Isi Formulir</h6>
                                <p class="text-muted mb-0">Lengkapi data yang diperlukan</p>
                            </div>
                            <div class="process-step">
                                <h6>4. Submit & Tunggu Konfirmasi</h6>
                                <p class="text-muted mb-0">Surat akan diproses maksimal 2x24 jam</p>
                            </div>
                        </div>

                        <div class="col-4 col-md-3">
                            <div class="bg-light text-center rounded p-3 shadow-sm">
                                <div class="mb-2">
                                    <i class="fas fa-trophy fa-4x text-primary"></i>
                                </div>
                                <h1 class="display-5 fw-bold mb-2">5</h1>
                                <p class="text-muted mb-0">Tahun Pengalaman</p>
                            </div>
                        </div>
                        <div class="col-8 col-md-9">
                            <div class="mb-4">
                                <p class="text-primary h6 mb-3"><i class="fa fa-check-circle text-secondary me-2"></i> Pelayanan 24 Jam Online</p>
                                <p class="text-primary h6 mb-3"><i class="fa fa-check-circle text-secondary me-2"></i> Proses Lebih Cepat & Mudah</p>
                                <p class="text-primary h6 mb-3"><i class="fa fa-check-circle text-secondary me-2"></i> Bimbingan Langsung dari Admin</p>
                                <p class="text-primary h6 mb-3"><i class="fa fa-check-circle text-secondary me-2"></i> Notifikasi Status Pengajuan</p>
                            </div>
                            <div class="d-flex flex-wrap align-items-center">
                                <a href="#" class="btn btn-primary me-3 mb-3">
                                    <i class="fas fa-file-alt me-2"></i>Ajukan Surat Sekarang
                                </a>
                                <div id="phone-tada" class="d-flex align-items-center justify-content-center me-4 mb-3">
                                    <a href="" class="position-relative">
                                        <i class="fa fa-phone-alt text-primary fa-2x phone-animation"></i>
                                        <div class="position-absolute" style="top: -5px; left: 20px;">
                                            <span><i class="fa fa-comment-dots text-secondary"></i></span>
                                        </div>
                                    </a>
                                </div>
                                <div class="d-flex flex-column justify-content-center mb-3">
                                    <span class="text-primary">Punya pertanyaan?</span>
                                    <span class="text-secondary fw-bold fs-6" style="letter-spacing: 1px;">+0123 456 7890</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap & JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
</body>
</html>
