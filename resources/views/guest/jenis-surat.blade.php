<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Jenis Surat - Bina Desa</title>
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

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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

        /* Widget Card Styles */
        .jenis-surat-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            overflow: hidden;
            height: 100%;
        }

        .jenis-surat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .jenis-surat-card .card-header {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            border-bottom: none;
            padding: 20px;
            color: white;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #0d6efd, #0a58ca) !important;
        }

        .bg-pink {
            background-color: #e83e8c !important;
        }

        .syarat-list {
            max-height: 200px;
            overflow-y: auto;
        }

        .syarat-item {
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .syarat-item:last-child {
            border-bottom: none;
        }

        /* Search box improvements */
        .search-box {
            border-radius: 50px;
            padding: 0;
            border: 1px solid #dee2e6;
            overflow: hidden;
        }

        .search-box .form-control {
            border: none;
            box-shadow: none;
        }

        .search-box .btn {
            border-radius: 0 50px 50px 0;
        }

        /* Animation improvements */
        .animate__animated {
            animation-duration: 0.5s;
        }

        /* Badge improvements */
        .badge {
            font-size: 0.75em;
            padding: 0.4em 0.6em;
        }

        /* Button improvements */
        .btn-action {
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        /* Card hover effects */
        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .card-stat {
            border-radius: 15px;
            transition: transform 0.3s;
        }

        .card-stat:hover {
            transform: translateY(-5px);
        }

        .empty-state {
            padding: 60px 20px;
            text-align: center;
        }

        .empty-state i {
            font-size: 80px;
            margin-bottom: 20px;
            color: #6c757d;
        }

        /* Loading animation */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .kode-badge {
            font-size: 0.9em;
            background: rgba(255,255,255,0.2);
            color: white;
        }
    </style>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-secondary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

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
            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Jenis Surat</h1>
            <p class="lead text-white animate__animated animate__fadeInUp">Kelola jenis-jenis surat yang tersedia di sistem</p>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Content Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <!-- Stats Cards -->
            <div class="row mb-5">
                <div class="col-md-4 mb-4">
                    <div class="card card-stat bg-primary text-white shadow h-100" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-file-alt fa-3x"></i>
                            </div>
                            <div>
                                <h4 class="mb-0">{{ $dataJenisSurat->count() }}</h4>
                                <p class="mb-0">Total Jenis Surat</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-stat bg-success text-white shadow h-100" data-aos="fade-up" data-aos-delay="200">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-code fa-3x"></i>
                            </div>
                            <div>
                                <h4 class="mb-0">{{ $dataJenisSurat->unique('kode')->count() }}</h4>
                                <p class="mb-0">Kode Unik</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-stat bg-info text-white shadow h-100" data-aos="fade-up" data-aos-delay="300">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-clipboard-list fa-3x"></i>
                            </div>
                            <div>
                                <h4 class="mb-0">{{ $dataJenisSurat->where('syarat_json', '!=', '')->count() }}</h4>
                                <p class="mb-0">Dengan Syarat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Bar -->
            <div class="row mb-4">
                <div class="col-md-8">
                    <div class="d-flex">
                        <div class="search-box me-3 flex-grow-1">
                            <div class="input-group">
                                <input type="text" class="form-control border-0" placeholder="Cari jenis surat..." id="searchInput">
                                <button class="btn btn-primary" type="button" id="searchButton">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-toggle="tooltip" title="Filter data jenis surat">
                                <i class="fas fa-filter me-2"></i>Filter
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item filter-option" href="#" data-filter="all">Semua</a></li>
                                <li><a class="dropdown-item filter-option" href="#" data-filter="with-syarat">Dengan Syarat</a></li>
                                <li><a class="dropdown-item filter-option" href="#" data-filter="without-syarat">Tanpa Syarat</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('jenis-surat.create') }}" class="btn btn-primary" data-bs-toggle="tooltip" title="Tambah jenis surat baru">
                        <i class="fas fa-plus me-2"></i>Tambah Jenis Surat
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Widget Cards untuk Jenis Surat -->
            <div class="row" id="jenisSuratContainer">
                @forelse($dataJenisSurat as $index => $jenis)
                <div class="col-xl-4 col-md-6 mb-4 jenis-surat-card-item" data-name="{{ strtolower($jenis->nama_jenis) }}" data-syarat="{{ $jenis->syarat_json ? 'with-syarat' : 'without-syarat' }}" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                    <div class="card jenis-surat-card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">
                                    <i class="fas fa-file-contract me-2"></i>{{ $jenis->nama_jenis }}
                                </h5>
                                <span class="badge kode-badge">{{ $jenis->kode }}</span>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-toggle="tooltip" title="Aksi">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('jenis-surat.edit', $jenis->jenis_id) }}">
                                            <i class="fas fa-edit me-2"></i>Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('jenis-surat.destroy', $jenis->jenis_id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus jenis surat ini?')">
                                                <i class="fas fa-trash me-2"></i>Hapus
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            @if($jenis->syarat_json)
                            <h6 class="text-primary mb-3">
                                <i class="fas fa-clipboard-check me-2"></i>Syarat-syarat:
                            </h6>
                            <div class="syarat-list">
                                @php
                                    // Parse syarat_json jika berupa JSON array, atau split by comma jika string biasa
                                    try {
                                        $syarat = json_decode($jenis->syarat_json, true);
                                        if (json_last_error() !== JSON_ERROR_NONE) {
                                            throw new Exception('Not JSON');
                                        }
                                    } catch (Exception $e) {
                                        $syarat = array_map('trim', explode(',', $jenis->syarat_json));
                                    }
                                @endphp

                                @if(is_array($syarat) && count($syarat) > 0)
                                    @foreach($syarat as $item)
                                    <div class="syarat-item d-flex align-items-start">
                                        <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                        <span class="small">{{ is_array($item) ? ($item['syarat'] ?? $item) : $item }}</span>
                                    </div>
                                    @endforeach
                                @else
                                    <div class="text-center text-muted py-2">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <span class="small">Tidak ada syarat khusus</span>
                                    </div>
                                @endif
                            </div>
                            @else
                            <div class="text-center text-muted py-4">
                                <i class="fas fa-info-circle fa-2x mb-3"></i>
                                <p class="mb-0 small">Tidak ada syarat khusus yang ditentukan</p>
                            </div>
                            @endif
                        </div>
                        <div class="card-footer bg-light">
                            <div class="row text-center">
                                <div class="col-12">
                                    <small class="text-muted">Terakhir diperbarui: {{ $jenis->updated_at->format('d M Y') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="card text-center py-5" data-aos="fade-up">
                        <div class="card-body">
                            <i class="fas fa-file-alt fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">Belum ada data jenis surat</h4>
                            <p class="text-muted mb-4">Mulai dengan menambahkan jenis surat pertama</p>
                            <a href="{{ route('jenis-surat.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Tambah Jenis Surat Pertama
                            </a>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Info jumlah data -->
            @if($dataJenisSurat->count() > 0)
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <p class="text-muted">Menampilkan {{ $dataJenisSurat->count() }} jenis surat</p>
                </div>
            </div>
            @endif
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
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="text-light mb-4">Jam Layanan</h4>
                        <div class="mb-3">
                            <h6 class="text-muted mb-0">Senin - Jumat:</h6>
                            <p class="text-white mb-0">08.00 - 16.00</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="text-muted mb-0">Sabtu:</h6>
                            <p class="text-white mb-0">08.00 - 14.00</p>
                        </div>
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
                <div class="col-md-6 text-center text-md-end text-white">
                    Sistem Surat Menyurat Bina Desa
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Simple spinner hide
        window.addEventListener('load', function() {
            document.getElementById('spinner').style.display = 'none';
        });

        // Back to top button
        document.addEventListener('DOMContentLoaded', function() {
            const backToTopButton = document.querySelector('.back-to-top');

            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTopButton.style.display = 'block';
                } else {
                    backToTopButton.style.display = 'none';
                }
            });

            backToTopButton.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({top: 0, behavior: 'smooth'});
            });

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const cards = document.querySelectorAll('.jenis-surat-card');

            function filterJenisSurat() {
                const searchTerm = searchInput.value.toLowerCase();

                cards.forEach(card => {
                    const text = card.textContent.toLowerCase();
                    const cardItem = card.closest('.jenis-surat-card-item');

                    if (text.includes(searchTerm)) {
                        cardItem.style.display = 'block';
                    } else {
                        cardItem.style.display = 'none';
                    }
                });
            }

            if (searchInput) {
                searchInput.addEventListener('input', filterJenisSurat);
            }

            // Filter functionality
            const filterOptions = document.querySelectorAll('.filter-option');
            let currentFilter = 'all';

            filterOptions.forEach(option => {
                option.addEventListener('click', function(e) {
                    e.preventDefault();
                    currentFilter = this.getAttribute('data-filter');

                    const jenisSuratCards = document.querySelectorAll('.jenis-surat-card-item');
                    jenisSuratCards.forEach(card => {
                        const syarat = card.getAttribute('data-syarat');

                        if (currentFilter === 'all' ||
                            (currentFilter === 'with-syarat' && syarat === 'with-syarat') ||
                            (currentFilter === 'without-syarat' && syarat === 'without-syarat')) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    // Update dropdown text
                    const dropdownButton = document.querySelector('.dropdown-toggle');
                    const filterText = this.textContent;
                    dropdownButton.innerHTML = `<i class="fas fa-filter me-2"></i>${filterText}`;
                });
            });

            // Smooth animations
            AOS.init({
                duration: 1000,
                once: true,
                offset: 100
            });

            // Enhanced search with Enter key
            if (searchInput) {
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        filterJenisSurat();
                    }
                });
            }

            // Add loading animation to cards
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('fade-in');
                    }
                });
            }, observerOptions);

            // Observe all cards
            document.querySelectorAll('.jenis-surat-card-item').forEach(card => {
                observer.observe(card);
            });
        });
    </script>
</body>
</html>
