<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Manajemen User - Bina Desa</title>
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
        .user-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            overflow: hidden;
            height: 100%;
        }

        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .user-card .card-header {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            border-bottom: none;
            padding: 20px;
            color: white;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #0d6efd, #0a58ca) !important;
        }

        .user-info-list {
            max-height: 300px;
            overflow-y: auto;
        }

        .user-info-item {
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .user-info-item:last-child {
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

        .password-field {
            font-family: monospace;
            font-size: 0.8rem;
        }

        .status-badge {
            font-size: 0.7em;
        }

        .action-buttons .btn {
            padding: 6px 12px;
            margin: 2px;
        }

        .user-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.5rem;
        }

        /* User role badge */
        .role-badge {
            background: rgba(255,255,255,0.2);
            color: white;
            font-size: 0.7em;
            padding: 4px 8px;
            border-radius: 20px;
        }

        /* Info list styling */
        .info-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .info-list li {
            padding: 8px 0;
            border-bottom: 1px solid #f8f9fa;
            display: flex;
            align-items: center;
        }

        .info-list li:last-child {
            border-bottom: none;
        }

        .info-list .info-icon {
            width: 24px;
            text-align: center;
            margin-right: 10px;
            color: #0d6efd;
        }

        /* Stats card improvements */
        .stats-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .stats-label {
            font-size: 0.9rem;
            color: rgba(255,255,255,0.8);
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
                    <a href="{{ route('user.index') }}" class="nav-item nav-link {{ Request::is('user*') ? 'active' : '' }}">Manajemen User</a>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container text-center">
            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Manajemen User</h1>
            <p class="lead text-white animate__animated animate__fadeInUp">Kelola pengguna sistem Bina Desa dengan mudah dan efisien</p>
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
                        <div class="card-body text-center">
                            <div class="stats-number">{{ $users->count() }}</div>
                            <div class="stats-label">
                                <i class="fas fa-users me-2"></i>Total User
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-stat bg-success text-white shadow h-100" data-aos="fade-up" data-aos-delay="200">
                        <div class="card-body text-center">
                            <div class="stats-number">{{ $users->count() }}</div>
                            <div class="stats-label">
                                <i class="fas fa-user-check me-2"></i>User Aktif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-stat bg-info text-white shadow h-100" data-aos="fade-up" data-aos-delay="300">
                        <div class="card-body text-center">
                            <div class="stats-number">{{ $users->where('created_at', '>=', now()->subDays(7))->count() }}</div>
                            <div class="stats-label">
                                <i class="fas fa-clock me-2"></i>User Baru (7 hari)
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
                                <input type="text" class="form-control border-0" placeholder="Cari user..." id="searchInput">
                                <button class="btn btn-primary" type="button" id="searchButton">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-toggle="tooltip" title="Filter data user">
                                <i class="fas fa-filter me-2"></i>Filter
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item filter-option" href="#" data-filter="all">Semua</a></li>
                                <li><a class="dropdown-item filter-option" href="#" data-filter="recent">User Baru</a></li>
                                <li><a class="dropdown-item filter-option" href="#" data-filter="old">User Lama</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('user.create') }}" class="btn btn-primary" data-bs-toggle="tooltip" title="Tambah user baru">
                        <i class="fas fa-plus me-2"></i>Tambah User
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Widget Cards untuk User -->
            <div class="row" id="userContainer">
                @forelse($users as $index => $user)
                <div class="col-xl-4 col-md-6 mb-4 user-card-item" data-name="{{ strtolower($user->name) }}" data-email="{{ strtolower($user->email) }}" data-recent="{{ $user->created_at->gte(now()->subDays(7)) ? 'recent' : 'old' }}" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                    <div class="card user-card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="user-avatar me-3">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h5 class="mb-1 text-white">
                                        <i class="fas fa-user me-2"></i>{{ $user->name }}
                                    </h5>
                                    <span class="role-badge">Administrator</span>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-toggle="tooltip" title="Aksi">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('user.show', $user->id) }}">
                                            <i class="fas fa-eye me-2"></i>Lihat Detail
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('user.edit', $user->id) }}">
                                            <i class="fas fa-edit me-2"></i>Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                <i class="fas fa-trash me-2"></i>Hapus
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="user-info-list">
                                <!-- Email -->
                                <div class="user-info-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-envelope text-primary me-2"></i>
                                        <span class="text-muted">Email:</span>
                                    </div>
                                    <strong class="text-end">{{ $user->email }}</strong>
                                </div>

                                <!-- ID User -->
                                <div class="user-info-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-id-card text-primary me-2"></i>
                                        <span class="text-muted">ID User:</span>
                                    </div>
                                    <strong>#{{ $user->id }}</strong>
                                </div>

                                <!-- Status -->
                                <div class="user-info-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-circle text-primary me-2"></i>
                                        <span class="text-muted">Status:</span>
                                    </div>
                                    <span class="badge bg-success status-badge">
                                        <i class="fas fa-check-circle me-1"></i>Aktif
                                    </span>
                                </div>

                                <!-- Password Hash -->
                                <div class="user-info-item">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-lock text-primary me-2"></i>
                                        <span class="text-muted">Password (Terenkripsi):</span>
                                    </div>
                                    <div class="input-group">
                                        <input type="password"
                                               class="form-control form-control-sm password-field"
                                               value="{{ $user->password }}"
                                               readonly
                                               id="password-{{ $user->id }}">
                                        <button class="btn btn-outline-secondary btn-sm" type="button" onclick="togglePassword({{ $user->id }})">
                                            <i class="fas fa-eye" id="eye-icon-{{ $user->id }}"></i>
                                        </button>
                                        <button class="btn btn-outline-info btn-sm" type="button" onclick="copyPassword({{ $user->id }})" data-bs-toggle="tooltip" title="Salin hash password">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </div>
                                    <small class="text-muted mt-1 d-block">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Hash: {{ Str::limit($user->password, 20) }}...
                                    </small>
                                </div>

                                <!-- Tanggal Bergabung -->
                                <div class="user-info-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-plus text-primary me-2"></i>
                                        <span class="text-muted">Bergabung:</span>
                                    </div>
                                    <strong>{{ $user->created_at->format('d M Y') }}</strong>
                                </div>

                                <!-- Terakhir Diperbarui -->
                                <div class="user-info-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-sync-alt text-primary me-2"></i>
                                        <span class="text-muted">Diperbarui:</span>
                                    </div>
                                    <strong>{{ $user->updated_at->format('d M Y') }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-light">
                            <div class="row text-center">
                                <div class="col-4 border-end">
                                    <a href="{{ route('user.show', $user->id) }}" class="text-secondary" title="Lihat Detail" data-bs-toggle="tooltip">
                                        <i class="fas fa-eye"></i>
                                        <small class="d-block mt-1">Detail</small>
                                    </a>
                                </div>
                                <div class="col-4 border-end">
                                    <a href="{{ route('user.edit', $user->id) }}" class="text-secondary" title="Edit User" data-bs-toggle="tooltip">
                                        <i class="fas fa-edit"></i>
                                        <small class="d-block mt-1">Edit</small>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')" title="Hapus User" data-bs-toggle="tooltip">
                                            <i class="fas fa-trash"></i>
                                            <small class="d-block mt-1">Hapus</small>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="card text-center py-5" data-aos="fade-up">
                        <div class="card-body">
                            <i class="fas fa-users fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">Belum ada data user</h4>
                            <p class="text-muted mb-4">Mulai dengan menambahkan user pertama</p>
                            <a href="{{ route('user.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Tambah User Pertama
                            </a>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Info jumlah data -->
            @if($users->count() > 0)
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <p class="text-muted">Menampilkan {{ $users->count() }} user</p>
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
                    Sistem Manajemen User Bina Desa
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
            const userCards = document.querySelectorAll('.user-card-item');

            function filterUsers() {
                const searchTerm = searchInput.value.toLowerCase();

                userCards.forEach(card => {
                    const name = card.getAttribute('data-name');
                    const email = card.getAttribute('data-email');

                    if (name.includes(searchTerm) || email.includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Update count display
                updateUserCount();
            }

            if (searchInput) {
                searchInput.addEventListener('input', filterUsers);
            }

            // Filter functionality
            const filterOptions = document.querySelectorAll('.filter-option');
            let currentFilter = 'all';

            filterOptions.forEach(option => {
                option.addEventListener('click', function(e) {
                    e.preventDefault();
                    currentFilter = this.getAttribute('data-filter');

                    userCards.forEach(card => {
                        const recent = card.getAttribute('data-recent');

                        if (currentFilter === 'all' ||
                            (currentFilter === 'recent' && recent === 'recent') ||
                            (currentFilter === 'old' && recent === 'old')) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    // Update dropdown text
                    const dropdownButton = document.querySelector('.dropdown-toggle');
                    const filterText = this.textContent;
                    dropdownButton.innerHTML = `<i class="fas fa-filter me-2"></i>${filterText}`;

                    // Update count display
                    updateUserCount();
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
                        filterUsers();
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
            document.querySelectorAll('.user-card-item').forEach(card => {
                observer.observe(card);
            });

            // Update user count display
            function updateUserCount() {
                const visibleCards = document.querySelectorAll('.user-card-item[style="display: block"]').length;
                const totalCards = document.querySelectorAll('.user-card-item').length;
                const countDisplay = document.querySelector('.text-muted:last-child');

                if (countDisplay) {
                    if (visibleCards === totalCards) {
                        countDisplay.textContent = `Menampilkan ${totalCards} user`;
                    } else {
                        countDisplay.textContent = `Menampilkan ${visibleCards} dari ${totalCards} user`;
                    }
                }
            }
        });

        // Password toggle functionality
        function togglePassword(userId) {
            const passwordField = document.getElementById(`password-${userId}`);
            const eyeIcon = document.getElementById(`eye-icon-${userId}`);

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }

        // Copy password hash functionality
        function copyPassword(userId) {
            const passwordField = document.getElementById(`password-${userId}`);
            passwordField.select();
            passwordField.setSelectionRange(0, 99999); // For mobile devices

            try {
                navigator.clipboard.writeText(passwordField.value);

                // Show success message
                const originalTitle = event.currentTarget.getAttribute('title');
                event.currentTarget.setAttribute('title', 'Hash berhasil disalin!');
                event.currentTarget.querySelector('i').classList.remove('fa-copy');
                event.currentTarget.querySelector('i').classList.add('fa-check');

                setTimeout(() => {
                    event.currentTarget.setAttribute('title', originalTitle);
                    event.currentTarget.querySelector('i').classList.remove('fa-check');
                    event.currentTarget.querySelector('i').classList.add('fa-copy');
                }, 2000);

            } catch (err) {
                console.error('Failed to copy: ', err);
            }
        }
    </script>
</body>
</html>
