@extends('layouts.guest.app')

@section('content')
    {{-- main content --}}
    <!-- Content Start -->
    <div class="page-header">
        <div class="container text-center">
            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Data Warga</h1>
            <p class="lead text-white animate__animated animate__fadeInUp">Menampilkan Data Warga Bina Desa</p>
        </div>
    </div>
    <div class="container-fluid py-5">
        <div class="container py-5">
            <!-- Success/Error Messages -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle me-3 fa-lg"></i>
                        <div class="flex-grow-1">
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeIn"
                    role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle me-3 fa-lg"></i>
                        <div class="flex-grow-1">
                            {{ session('error') }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="row mb-5">
                <div class="col-md-3 mb-4">
                    <div class="card card-stat bg-primary text-white shadow h-100 stats-card" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-users fa-3x"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 counter" data-target="{{ $warga->count() }}">0</h4>
                                <p class="mb-0">Total Warga</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card card-stat bg-success text-white shadow h-100 stats-card" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-male fa-3x"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 counter" data-target="{{ $warga->where('jenis_kelamin', 'L')->count() }}">0
                                </h4>
                                <p class="mb-0">Laki-laki</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card card-stat bg-info text-white shadow h-100 stats-card" data-aos="fade-up"
                        data-aos-delay="300">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-female fa-3x"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 counter" data-target="{{ $warga->where('jenis_kelamin', 'P')->count() }}">0
                                </h4>
                                <p class="mb-0">Perempuan</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card card-stat bg-warning text-white shadow h-100 stats-card" data-aos="fade-up"
                        data-aos-delay="400">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-briefcase fa-3x"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 counter" data-target="{{ $warga->pluck('pekerjaan')->unique()->count() }}">0
                                </h4>
                                <p class="mb-0">Jenis Pekerjaan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Bar -->
            <div class="row mb-4">
                <div class="col-md-8">
                    <form method="GET" action="{{ route('warga.index') }}" class="d-flex">
                        <div class="search-box me-3 flex-grow-1">
                            <div class="input-group search-container">
                                <input type="text" class="form-control border-0 input-focus-effect"
                                    placeholder="Cari warga..." name="search" value="{{ request('search') }}">
                                <button class="btn btn-primary search-btn" type="submit">
                                    <i class="fas fa-search me-2"></i>Cari
                                </button>
                            </div>
                        </div>
                        <div class="dropdown me-3">
                            <button class="btn btn-outline-secondary dropdown-toggle filter-btn" type="button"
                                data-bs-toggle="dropdown" data-bs-toggle="tooltip" title="Filter data warga">
                                <i class="fas fa-filter me-2"></i>Filter
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item {{ request('filter_gender') == 'all' || !request('filter_gender') ? 'active' : '' }}"
                                        href="{{ request()->fullUrlWithQuery(['filter_gender' => 'all', 'page' => 1]) }}">
                                        <i class="fas fa-list me-2"></i>Semua
                                    </a></li>
                                <li><a class="dropdown-item {{ request('filter_gender') == 'L' ? 'active' : '' }}"
                                        href="{{ request()->fullUrlWithQuery(['filter_gender' => 'L', 'page' => 1]) }}">
                                        <i class="fas fa-male me-2"></i>Laki-laki
                                    </a></li>
                                <li><a class="dropdown-item {{ request('filter_gender') == 'P' ? 'active' : '' }}"
                                        href="{{ request()->fullUrlWithQuery(['filter_gender' => 'P', 'page' => 1]) }}">
                                        <i class="fas fa-female me-2"></i>Perempuan
                                    </a></li>
                            </ul>
                        </div>
                        @if (request('search') || request('filter_gender'))
                            <a href="{{ route('warga.index') }}" class="btn btn-outline-danger">
                                <i class="fas fa-times me-2"></i>Reset
                            </a>
                        @endif
                    </form>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('warga.create') }}" class="btn btn-primary floating-action-btn"
                        data-bs-toggle="tooltip" title="Tambah data warga baru">
                        <i class="fas fa-user-plus me-2"></i>Tambah Warga
                    </a>
                </div>
            </div>

            <!-- Widget Cards untuk Data Warga -->
            <div class="row" id="wargaContainer">
                @forelse($warga as $index => $data)
                    <div class="col-xl-4 col-md-6 mb-4 warga-card animate__animated animate__fadeInUp"
                        data-gender="{{ $data->jenis_kelamin }}" data-name="{{ strtolower($data->nama) }}"
                        data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                        <div class="card widget-card h-100">
                            <div
                                class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">
                                    <i class="fas fa-user me-2"></i>{{ $data->nama }}
                                </h6>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light dropdown-toggle action-btn" type="button"
                                        data-bs-toggle="dropdown" data-bs-toggle="tooltip" title="Aksi">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('warga.edit', $data->warga_id) }}">
                                                <i class="fas fa-edit me-2"></i>Edit
                                            </a>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item text-danger delete-btn"
                                                data-warga-id="{{ $data->warga_id }}"
                                                data-warga-name="{{ $data->nama }}">
                                                <i class="fas fa-trash-alt me-2"></i>Hapus
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <small class="text-muted">NIK</small>
                                        <p class="mb-2"><i
                                                class="fas fa-id-card text-primary me-2"></i>{{ $data->no_ktp }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted">Jenis Kelamin</small>
                                        <p class="mb-2">
                                            @if ($data->jenis_kelamin == 'L')
                                                <span class="badge gender-badge bg-primary"><i
                                                        class="fas fa-male me-1"></i>Laki-laki</span>
                                            @else
                                                <span class="badge gender-badge bg-pink"><i
                                                        class="fas fa-female me-1"></i>Perempuan</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Agama</small>
                                        <p class="mb-2"><i class="fas fa-pray me-2"></i>{{ $data->agama }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <small class="text-muted">Pekerjaan</small>
                                        <p class="mb-2"><i
                                                class="fas fa-briefcase text-warning me-2"></i>{{ $data->pekerjaan }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-light">
                                <div class="row text-center">
                                    <div class="col-6 border-end">
                                        <a href="tel:{{ $data->telp }}" class="text-secondary contact-link"
                                            title="Telepon" data-bs-toggle="tooltip">
                                            <i class="fas fa-phone-alt"></i>
                                            <small class="d-block mt-1">Telepon</small>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="mailto:{{ $data->email }}" class="text-secondary contact-link"
                                            title="Email" data-bs-toggle="tooltip">
                                            <i class="fas fa-envelope"></i>
                                            <small class="d-block mt-1">Email</small>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card text-center py-5 empty-state-card" data-aos="fade-up">
                            <div class="card-body">
                                <i class="fas fa-users fa-4x text-muted mb-3"></i>
                                <h4 class="text-muted">Belum ada data warga</h4>
                                <p class="text-muted mb-4">Mulai dengan menambahkan data warga pertama</p>
                                <a href="{{ route('warga.create') }}" class="btn btn-primary">
                                    <i class="fas fa-user-plus me-2"></i>Tambah Warga Pertama
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Info jumlah data -->
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <p class="text-muted" id="dataInfo">
                        <i class="fas fa-info-circle me-2"></i>Menampilkan <span
                            id="filtered-count">{{ $warga->count() }}</span> data warga
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
@if($warga->hasPages())
<div class="row mt-4">
    <div class="col-12">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                {{-- Previous Page Link --}}
                @if($warga->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">«</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $warga->previousPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}" rel="prev">«</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach($warga->getUrlRange(1, $warga->lastPage()) as $page => $url)
                    @if($page == $warga->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if($warga->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $warga->nextPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}" rel="next">»</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">»</span>
                    </li>
                @endif
            </ul>
        </nav>
        <div class="text-center text-muted mt-2">
            Menampilkan {{ $warga->firstItem() }} - {{ $warga->lastItem() }} dari {{ $warga->total() }} data
        </div>
    </div>
</div>
@endif
    <!-- Content End -->
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas fa-trash-alt fa-4x text-danger mb-3 animate__animated animate__pulse"></i>
                    <h5>Apakah Anda yakin ingin menghapus data warga ini?</h5>
                    <p class="text-muted">Data yang sudah dihapus tidak dapat dikembalikan</p>
                    <p><strong id="deleteWargaName"></strong></p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt me-2"></i>Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- end content --}}

    <style>
        /* Animasi untuk kartu statistik */
        .stats-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            border: none;
            border-radius: 15px;
        }

        .stats-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15) !important;
        }

        /* Animasi untuk kartu warga */
        .widget-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .widget-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            border-radius: 15px 15px 0 0 !important;
            padding: 1rem 1.25rem;
        }

        /* Efek untuk badge jenis kelamin */
        .gender-badge {
            transition: all 0.3s ease;
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
        }

        .widget-card:hover .gender-badge {
            transform: scale(1.1);
        }

        /* Styling untuk tombol aksi */
        .action-btn {
            transition: all 0.3s ease;
            border: none;
            border-radius: 8px;
            padding: 0.25rem 0.5rem;
        }

        .action-btn:hover {
            background-color: rgba(255, 255, 255, 0.2) !important;
            transform: scale(1.1);
        }

        /* Styling untuk tombol tambah */
        .floating-action-btn {
            transition: all 0.3s ease;
            border-radius: 10px;
            padding: 10px 20px;
            position: relative;
            overflow: hidden;
        }

        .floating-action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        /* Styling untuk pencarian */
        .search-container {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .search-container:focus-within {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }

        .input-focus-effect {
            border: 2px solid transparent;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .input-focus-effect:focus {
            border-color: var(--bs-primary);
            box-shadow: none;
        }

        .search-btn {
            border-radius: 0 8px 8px 0;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            background-color: var(--bs-primary-dark);
            transform: scale(1.05);
        }

        /* Styling untuk filter button */
        .filter-btn {
            border-radius: 10px;
            padding: 12px 20px;
            transition: all 0.3s ease;
            border: 2px solid #6c757d;
        }

        .filter-btn:hover {
            background-color: #6c757d;
            color: white;
            transform: translateY(-2px);
        }

        /* Styling untuk contact links */
        .contact-link {
            transition: all 0.3s ease;
            padding: 0.5rem;
            border-radius: 8px;
            text-decoration: none;
            display: block;
        }

        .contact-link:hover {
            background-color: rgba(0, 0, 0, 0.05);
            transform: scale(1.1);
            color: var(--bs-primary) !important;
        }

        /* Styling untuk empty state */
        .empty-state-card {
            border: 2px dashed #dee2e6;
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .empty-state-card:hover {
            border-color: var(--bs-primary);
            transform: translateY(-3px);
        }

        /* Animasi untuk alert */
        .alert {
            border: none;
            border-radius: 10px;
            border-left: 4px solid;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .alert-success {
            border-left-color: var(--bs-success);
        }

        .alert-danger {
            border-left-color: var(--bs-danger);
        }

        /* Modal styling */
        .modal-content {
            border: none;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            border-radius: 15px 15px 0 0;
            background: linear-gradient(135deg, var(--bs-danger), #dc3545);
            color: white;
        }

        /* Animasi untuk kartu yang difilter */
        .warga-card.hidden {
            display: none;
            animation: fadeOut 0.3s ease;
        }

        .warga-card.visible {
            display: block;
            animation: fadeInUp 0.5s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateY(0);
            }

            to {
                opacity: 0;
                transform: translateY(20px);
            }
        }

        /* Counter animation */
        .counter {
            transition: all 0.5s ease;
        }

        /* Badge pink untuk perempuan */
        .bg-pink {
            background-color: #e83e8c !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animasi counter untuk statistik
            const counters = document.querySelectorAll('.counter');
            const speed = 200;

            const animateCounter = (counter) => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const increment = target / speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(() => animateCounter(counter), 10);
                } else {
                    counter.innerText = target;
                }
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.5
            });

            counters.forEach(counter => {
                observer.observe(counter);
            });

            // Fungsi pencarian dan filter
            const searchInput = document.getElementById('searchInput');
            const searchButton = document.getElementById('searchButton');
            const filterOptions = document.querySelectorAll('.filter-option');
            const wargaCards = document.querySelectorAll('.warga-card');
            const filteredCount = document.getElementById('filtered-count');
            const dataInfo = document.getElementById('dataInfo');

            // Delete modal functionality
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const deleteForm = document.getElementById('deleteForm');
            const deleteWargaName = document.getElementById('deleteWargaName');

            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const wargaId = this.getAttribute('data-warga-id');
                    const wargaName = this.getAttribute('data-warga-name');

                    deleteWargaName.textContent = wargaName;
                    deleteForm.action = `{{ url('warga') }}/${wargaId}`;
                    deleteModal.show();
                });
            });

            function updateFilteredCount() {
                const visibleCards = document.querySelectorAll('.warga-card:not(.hidden)').length;
                if (filteredCount) {
                    filteredCount.textContent = visibleCards;
                }
            }

            function filterCards() {
                const searchTerm = searchInput.value.toLowerCase();
                const activeFilter = document.querySelector('.filter-option.active')?.getAttribute('data-filter') ||
                    'all';

                wargaCards.forEach(card => {
                    const cardName = card.getAttribute('data-name');
                    const cardGender = card.getAttribute('data-gender');

                    const matchesSearch = cardName.includes(searchTerm);
                    const matchesFilter = activeFilter === 'all' || cardGender === activeFilter;

                    if (matchesSearch && matchesFilter) {
                        card.classList.remove('hidden');
                        card.classList.add('visible');
                    } else {
                        card.classList.add('hidden');
                        card.classList.remove('visible');
                    }
                });

                updateFilteredCount();
            }

            // Event listener untuk pencarian
            searchInput.addEventListener('input', filterCards);
            searchButton.addEventListener('click', filterCards);

            // Event listener untuk filter
            filterOptions.forEach(option => {
                option.addEventListener('click', function(e) {
                    e.preventDefault();

                    filterOptions.forEach(opt => opt.classList.remove('active'));
                    this.classList.add('active');

                    filterCards();
                });
            });

            // Set filter "Semua" sebagai aktif secara default
            document.querySelector('.filter-option[data-filter="all"]').classList.add('active');

            // Auto-hide alerts setelah 5 detik
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.classList.add('animate__fadeOut');
                    setTimeout(() => {
                        alert.remove();
                    }, 1000);
                }, 5000);
            });

            // Efek hover untuk kartu
            wargaCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection
