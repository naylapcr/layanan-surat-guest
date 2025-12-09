@extends('layouts.guest.app')

@section('content')
    {{-- Content Start --}}
    <div class="page-header">
        <div class="container text-center">
            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Data User</h1>
            <p class="lead text-white animate__animated animate__fadeInUp">Data User Bina Desa</p>
        </div>
    </div>
    <div class="container-fluid py-5">
        <div class="container py-5">
            <!-- Stats Cards -->
            <div class="row mb-5">
                <div class="col-md-4 mb-4">
                    <div class="card card-stat bg-primary text-white shadow h-100 stats-card" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="card-body text-center">
                            <div class="stats-number counter" data-target="{{ $users->count() }}">0</div>
                            <div class="stats-label">
                                <i class="fas fa-users me-2"></i>Total User
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-stat bg-success text-white shadow h-100 stats-card" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="card-body text-center">
                            <div class="stats-number counter" data-target="{{ $users->count() }}">0</div>
                            <div class="stats-label">
                                <i class="fas fa-user-check me-2"></i>User Aktif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-stat bg-info text-white shadow h-100 stats-card" data-aos="fade-up"
                        data-aos-delay="300">
                        <div class="card-body text-center">
                            <div class="stats-number counter"
                                data-target="{{ $users->where('created_at', '>=', now()->subDays(7))->count() }}">0</div>
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
                    <form method="GET" action="{{ route('user.index') }}" class="d-flex">
                        <div class="search-box me-3 flex-grow-1">
                            <div class="input-group search-container">
                                <input type="text" class="form-control border-0 input-focus-effect"
                                    placeholder="Cari user..." name="search" value="{{ request('search') }}"
                                    id="searchInput">
                                <button class="btn btn-primary search-btn" type="submit" id="searchButton">
                                    <i class="fas fa-search me-2"></i>Cari
                                </button>
                            </div>
                        </div>
                        <div class="dropdown me-3">
                            <button class="btn btn-outline-secondary dropdown-toggle filter-btn" type="button"
                                data-bs-toggle="dropdown" data-bs-toggle="tooltip" title="Filter data user">
                                <i class="fas fa-filter me-2"></i>Filter
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item {{ request('filter_recent') == 'all' || !request('filter_recent') ? 'active' : '' }}"
                                        href="{{ request()->fullUrlWithQuery(['filter_recent' => 'all', 'page' => 1]) }}"><i
                                            class="fas fa-list me-2"></i>Semua</a></li>
                                <li><a class="dropdown-item {{ request('filter_recent') == 'recent' ? 'active' : '' }}"
                                        href="{{ request()->fullUrlWithQuery(['filter_recent' => 'recent', 'page' => 1]) }}"><i
                                            class="fas fa-star me-2"></i>User Baru</a></li>
                                <li><a class="dropdown-item {{ request('filter_recent') == 'old' ? 'active' : '' }}"
                                        href="{{ request()->fullUrlWithQuery(['filter_recent' => 'old', 'page' => 1]) }}"><i
                                            class="fas fa-history me-2"></i>User Lama</a></li>
                            </ul>
                        </div>
                        @if (request('search') || request('filter_recent'))
                            <a href="{{ route('user.index') }}" class="btn btn-outline-danger">
                                <i class="fas fa-times me-2"></i>Reset
                            </a>
                        @endif
                    </form>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('user.create') }}" class="btn btn-primary floating-action-btn"
                        data-bs-toggle="tooltip" title="Tambah user baru">
                        <i class="fas fa-plus me-2"></i>Tambah User
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn"
                    role="alert">
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
                        <i class="fas fa-exclamation-circle me-3 fa-lg"></i>
                        <div class="flex-grow-1">
                            {{ session('error') }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            <!-- Widget Cards untuk User -->
            <div class="row" id="userContainer">
                @forelse($users as $index => $user)
                    <div class="col-xl-4 col-md-6 mb-4 user-card-item animate__animated animate__fadeInUp"
                        data-name="{{ strtolower($user->name) }}" data-email="{{ strtolower($user->email) }}"
                        data-recent="{{ $user->created_at->gte(now()->subDays(7)) ? 'recent' : 'old' }}"
                        data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                        <div class="card user-card h-100">
                            <div
                                class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-3">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h6 class="mb-1 text-white">
                                            <i class="fas fa-user me-2"></i>{{ $user->name }}
                                        </h6>
                                        <span class="role-badge">
                                            {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light dropdown-toggle action-btn" type="button"
                                        data-bs-toggle="dropdown" data-bs-toggle="tooltip" title="Aksi">
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
                                            <button type="button" class="dropdown-item text-danger delete-btn"
                                                data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}">
                                                <i class="fas fa-trash me-2"></i>Hapus
                                            </button>
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
                                        <strong class="text-end text-truncate"
                                            style="max-width: 150px;">{{ $user->email }}</strong>
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
                                        <div class="input-group password-input-group">
                                            <input type="password" class="form-control form-control-sm password-field"
                                                value="{{ $user->password }}" readonly
                                                id="password-{{ $user->id }}">
                                            <button class="btn btn-outline-secondary btn-sm password-toggle"
                                                type="button" onclick="togglePassword({{ $user->id }})"
                                                data-bs-toggle="tooltip" title="Tampilkan/Sembunyikan">
                                                <i class="fas fa-eye" id="eye-icon-{{ $user->id }}"></i>
                                            </button>
                                            <button class="btn btn-outline-info btn-sm copy-btn" type="button"
                                                onclick="copyPassword({{ $user->id }})" data-bs-toggle="tooltip"
                                                title="Salin hash password">
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
                                        <a href="{{ route('user.show', $user->id) }}" class="text-secondary action-link"
                                            title="Lihat Detail" data-bs-toggle="tooltip">
                                            <i class="fas fa-eye"></i>
                                            <small class="d-block mt-1">Detail</small>
                                        </a>
                                    </div>
                                    <div class="col-4 border-end">
                                        <a href="{{ route('user.edit', $user->id) }}" class="text-secondary action-link"
                                            title="Edit User" data-bs-toggle="tooltip">
                                            <i class="fas fa-edit"></i>
                                            <small class="d-block mt-1">Edit</small>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <button type="button" class="btn btn-link text-danger p-0 delete-footer-btn"
                                            data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}"
                                            title="Hapus User" data-bs-toggle="tooltip">
                                            <i class="fas fa-trash"></i>
                                            <small class="d-block mt-1">Hapus</small>
                                        </button>
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

            <!--user info -->
            <div class="user-info-item d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-user-shield text-primary me-2"></i>
                    <span class="text-muted">Role:</span>
                </div>
                <span class="badge bg-info">{{ ucfirst(str_replace('_', ' ', $user->role)) }}</span>
            </div>

            <!-- Info jumlah data -->
            @if ($users->count() > 0)
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <p class="text-muted" id="dataInfo">
                            <i class="fas fa-info-circle me-2"></i>Menampilkan {{ $users->count() }} dari
                            {{ $users->total() }} user
                        </p>
                    </div>
                </div>
            @endif

            <!-- Pagination -->
            @if ($users->hasPages())
                <div class="row mt-4">
                    <div class="col-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                {{-- Previous Page Link --}}
                                @if ($users->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">«</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link"
                                            href="{{ $users->previousPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}"
                                            rel="prev">«</a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                    @if ($page == $users->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $url }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($users->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link"
                                            href="{{ $users->nextPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}"
                                            rel="next">»</a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link">»</span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                        <div class="text-center text-muted mt-2">
                            Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }}
                            data
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

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
                    <h5>Apakah Anda yakin ingin menghapus user ini?</h5>
                    <p class="text-muted">Data yang sudah dihapus tidak dapat dikembalikan</p>
                    <p><strong id="deleteUserName"></strong></p>
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
    {{-- Content End --}}

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

        .stats-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            transition: all 0.5s ease;
        }

        .stats-label {
            font-size: 1rem;
            opacity: 0.9;
        }

        /* Animasi untuk kartu user */
        .user-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            border-radius: 15px 15px 0 0 !important;
            padding: 1rem 1.25rem;
        }

        /* User avatar styling */
        .user-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--bs-warning), var(--bs-orange));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            font-size: 1.2rem;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .user-card:hover .user-avatar {
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        /* Role badge styling */
        .role-badge {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 500;
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

        /* User info list styling */
        .user-info-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .user-info-item {
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .user-info-item:hover {
            background-color: rgba(0, 0, 0, 0.03);
            transform: translateX(5px);
        }

        /* Password input group styling */
        .password-input-group {
            transition: all 0.3s ease;
        }

        .password-input-group:focus-within {
            transform: translateY(-2px);
        }

        .password-toggle,
        .copy-btn {
            transition: all 0.3s ease;
        }

        .password-toggle:hover,
        .copy-btn:hover {
            transform: scale(1.1);
        }

        /* Action links in footer */
        .action-link {
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
            padding: 0.5rem;
            border-radius: 8px;
        }

        .action-link:hover {
            background-color: rgba(0, 0, 0, 0.05);
            transform: scale(1.1);
            color: var(--bs-primary) !important;
        }

        .delete-footer-btn {
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
            padding: 0.5rem;
            border-radius: 8px;
        }

        .delete-footer-btn:hover {
            background-color: rgba(220, 53, 69, 0.1);
            transform: scale(1.1);
            color: var(--bs-danger) !important;
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

        /* Counter animation */
        .counter {
            transition: all 0.5s ease;
        }

        /* Pagination styling */
        .pagination .page-link {
            border-radius: 8px;
            margin: 0 2px;
            border: none;
            color: var(--bs-primary);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
        }

        .pagination .page-link:hover {
            background-color: #e9ecef;
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

            // Delete modal functionality
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const deleteForm = document.getElementById('deleteForm');
            const deleteUserName = document.getElementById('deleteUserName');

            function setupDeleteButtons() {
                document.querySelectorAll('.delete-btn, .delete-footer-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const userId = this.getAttribute('data-user-id');
                        const userName = this.getAttribute('data-user-name');

                        deleteUserName.textContent = userName;
                        deleteForm.action = `{{ url('user') }}/${userId}`;
                        deleteModal.show();
                    });
                });
            }

            setupDeleteButtons();

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
            const userCards = document.querySelectorAll('.user-card-item');
            userCards.forEach(card => {
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

        // Password toggle function
        function togglePassword(userId) {
            const passwordField = document.getElementById(`password-${userId}`);
            const eyeIcon = document.getElementById(`eye-icon-${userId}`);

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.className = 'fas fa-eye-slash';
            } else {
                passwordField.type = 'password';
                eyeIcon.className = 'fas fa-eye';
            }
        }

        // Copy password function
        function copyPassword(userId) {
            const passwordField = document.getElementById(`password-${userId}`);
            passwordField.select();
            document.execCommand('copy');

            // Show temporary feedback
            const originalText = passwordField.value;
            passwordField.value = 'Tersalin!';
            setTimeout(() => {
                passwordField.value = originalText;
            }, 1000);
        }
    </script>

@endsection
