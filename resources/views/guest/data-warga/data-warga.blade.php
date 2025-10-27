<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Data Warga - Bina Desa</title>
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
        .widget-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .widget-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .widget-card .card-header {
            border-bottom: none;
            padding: 15px 20px;
        }

        .service-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .service-card .card-header {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            border-bottom: none;
            padding: 15px 20px;
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
            <a href="/" class="navbar-brand p-0">
                <h1 class="display-5 text-secondary m-0">Bina Desa</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="/dashboard" class="nav-item nav-link">Beranda</a>
                    <a href="#" class="nav-item nav-link active">Data Warga</a>
                    <a href="#" class="nav-item nav-link">Jenis Surat</a>
                    <a href="#" class="nav-item nav-link">Data User</a>
                    <a href="#" class="nav-item nav-link">Login</a>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container text-center">
            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Data Warga</h1>
            <p class="lead text-white animate__animated animate__fadeInUp">Kelola data warga desa dengan mudah dan efisien</p>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Content Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <!-- Stats Cards -->
            <div class="row mb-5">
                <div class="col-md-3 mb-4">
                    <div class="card card-stat bg-primary text-white shadow h-100" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-users fa-3x"></i>
                            </div>
                            <div>
                                <h4 class="mb-0" id="totalWarga">6</h4>
                                <p class="mb-0">Total Warga</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card card-stat bg-success text-white shadow h-100" data-aos="fade-up" data-aos-delay="200">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-male fa-3x"></i>
                            </div>
                            <div>
                                <h4 class="mb-0" id="totalLaki">3</h4>
                                <p class="mb-0">Laki-laki</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card card-stat bg-info text-white shadow h-100" data-aos="fade-up" data-aos-delay="300">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-female fa-3x"></i>
                            </div>
                            <div>
                                <h4 class="mb-0" id="totalPerempuan">3</h4>
                                <p class="mb-0">Perempuan</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card card-stat bg-warning text-white shadow h-100" data-aos="fade-up" data-aos-delay="400">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-briefcase fa-3x"></i>
                            </div>
                            <div>
                                <h4 class="mb-0" id="totalPekerjaan">5</h4>
                                <p class="mb-0">Jenis Pekerjaan</p>
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
                                <input type="text" class="form-control border-0" placeholder="Cari warga..." id="searchInput">
                                <button class="btn btn-primary" type="button" id="searchButton">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-toggle="tooltip" title="Filter data warga">
                                <i class="fas fa-filter me-2"></i>Filter
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item filter-option" href="#" data-filter="all">Semua</a></li>
                                <li><a class="dropdown-item filter-option" href="#" data-filter="L">Laki-laki</a></li>
                                <li><a class="dropdown-item filter-option" href="#" data-filter="P">Perempuan</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="#" class="btn btn-primary" data-bs-toggle="tooltip" title="Tambah data warga baru">
                        <i class="fas fa-plus me-2"></i>Tambah Warga
                    </a>
                </div>
            </div>

            <!-- Widget Cards untuk Data Warga -->
            <div class="row" id="wargaContainer">
                <!-- Data warga akan dimuat di sini -->
            </div>

            <!-- Info jumlah data -->
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <p class="text-muted" id="dataInfo">Menampilkan 6 data warga</p>
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
        // Data warga contoh (gantikan dengan data dari backend)
        const dataWarga = [
            {
                id: 1,
                nama: "Ahmad Fauzi",
                no_ktp: "1234567890123456",
                jenis_kelamin: "L",
                agama: "Islam",
                pekerjaan: "Petani",
                telp: "081234567890",
                email: "ahmad@example.com"
            },
            {
                id: 2,
                nama: "Siti Rahayu",
                no_ktp: "2345678901234567",
                jenis_kelamin: "P",
                agama: "Islam",
                pekerjaan: "Ibu Rumah Tangga",
                telp: "081234567891",
                email: "siti@example.com"
            },
            {
                id: 3,
                nama: "Budi Santoso",
                no_ktp: "3456789012345678",
                jenis_kelamin: "L",
                agama: "Kristen",
                pekerjaan: "Wiraswasta",
                telp: "081234567892",
                email: "budi@example.com"
            },
            {
                id: 4,
                nama: "Maya Sari",
                no_ktp: "4567890123456789",
                jenis_kelamin: "P",
                agama: "Islam",
                pekerjaan: "Guru",
                telp: "081234567893",
                email: "maya@example.com"
            },
            {
                id: 5,
                nama: "Rudi Hermawan",
                no_ktp: "5678901234567890",
                jenis_kelamin: "L",
                agama: "Islam",
                pekerjaan: "PNS",
                telp: "081234567894",
                email: "rudi@example.com"
            },
            {
                id: 6,
                nama: "Dewi Anggraini",
                no_ktp: "6789012345678901",
                jenis_kelamin: "P",
                agama: "Katolik",
                pekerjaan: "Perawat",
                telp: "081234567895",
                email: "dewi@example.com"
            }
        ];

        // Fungsi untuk menampilkan data warga
        function renderWargaData(wargaData = dataWarga) {
            const container = document.getElementById('wargaContainer');
            container.innerHTML = '';

            if (wargaData.length === 0) {
                container.innerHTML = `
                    <div class="col-12">
                        <div class="card text-center py-5" data-aos="fade-up">
                            <div class="card-body">
                                <i class="fas fa-users fa-4x text-muted mb-3"></i>
                                <h4 class="text-muted">Tidak ada data warga ditemukan</h4>
                                <p class="text-muted mb-4">Coba ubah kata kunci pencarian atau filter</p>
                            </div>
                        </div>
                    </div>
                `;
                return;
            }

            wargaData.forEach((warga, index) => {
                const card = document.createElement('div');
                card.className = `col-xl-4 col-md-6 mb-4 warga-card fade-in`;
                card.setAttribute('data-gender', warga.jenis_kelamin);
                card.setAttribute('data-name', warga.nama.toLowerCase());
                card.setAttribute('data-aos', 'fade-up');
                card.setAttribute('data-aos-delay', (index % 3) * 100);

                card.innerHTML = `
                    <div class="card widget-card h-100">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">
                                <i class="fas fa-user me-2"></i>${warga.nama}
                            </h6>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-toggle="tooltip" title="Aksi">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-edit me-2"></i>Edit
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="#" onclick="return confirm('Apakah Anda yakin ingin menghapus data warga ini?')">
                                            <i class="fas fa-trash me-2"></i>Hapus
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <small class="text-muted">NIK</small>
                                    <p class="mb-2"><i class="fas fa-id-card text-primary me-2"></i>${warga.no_ktp}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <small class="text-muted">Jenis Kelamin</small>
                                    <p class="mb-2">
                                        ${warga.jenis_kelamin === 'L' ?
                                            '<span class="badge bg-primary"><i class="fas fa-male me-1"></i>Laki-laki</span>' :
                                            '<span class="badge bg-pink"><i class="fas fa-female me-1"></i>Perempuan</span>'}
                                    </p>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Agama</small>
                                    <p class="mb-2">${warga.agama}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <small class="text-muted">Pekerjaan</small>
                                    <p class="mb-2"><i class="fas fa-briefcase text-warning me-2"></i>${warga.pekerjaan}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-light">
                            <div class="row text-center">
                                <div class="col-6 border-end">
                                    <a href="tel:${warga.telp}" class="text-secondary" title="Telepon" data-bs-toggle="tooltip">
                                        <i class="fas fa-phone"></i>
                                        <small class="d-block mt-1">Telepon</small>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="mailto:${warga.email}" class="text-secondary" title="Email" data-bs-toggle="tooltip">
                                        <i class="fas fa-envelope"></i>
                                        <small class="d-block mt-1">Email</small>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                container.appendChild(card);
            });

            // Update info jumlah data
            document.getElementById('dataInfo').textContent = `Menampilkan ${wargaData.length} data warga`;
        }

        // Fungsi untuk menghitung statistik
        function updateStats(wargaData = dataWarga) {
            const totalWarga = wargaData.length;
            const totalLaki = wargaData.filter(w => w.jenis_kelamin === 'L').length;
            const totalPerempuan = wargaData.filter(w => w.jenis_kelamin === 'P').length;
            const totalPekerjaan = [...new Set(wargaData.map(w => w.pekerjaan))].length;

            document.getElementById('totalWarga').textContent = totalWarga;
            document.getElementById('totalLaki').textContent = totalLaki;
            document.getElementById('totalPerempuan').textContent = totalPerempuan;
            document.getElementById('totalPekerjaan').textContent = totalPekerjaan;
        }

        // Inisialisasi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Render data warga
            renderWargaData();
            updateStats();

            // Back to top button
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

            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    const filteredData = dataWarga.filter(warga =>
                        warga.nama.toLowerCase().includes(searchTerm) ||
                        warga.no_ktp.includes(searchTerm) ||
                        warga.pekerjaan.toLowerCase().includes(searchTerm)
                    );

                    renderWargaData(filteredData);
                    updateStats(filteredData);
                });
            }

            // Filter functionality
            const filterOptions = document.querySelectorAll('.filter-option');
            let currentFilter = 'all';

            filterOptions.forEach(option => {
                option.addEventListener('click', function(e) {
                    e.preventDefault();
                    currentFilter = this.getAttribute('data-filter');

                    let filteredData;
                    if (currentFilter === 'all') {
                        filteredData = dataWarga;
                    } else {
                        filteredData = dataWarga.filter(warga => warga.jenis_kelamin === currentFilter);
                    }

                    renderWargaData(filteredData);
                    updateStats(filteredData);

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
        });
    </script>
</body>
</html>
