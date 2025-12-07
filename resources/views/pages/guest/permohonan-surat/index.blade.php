@extends('layouts.guest.app')

@section('content')
{{-- main content --}}
    <!-- Content Start -->
<div class="page-header">
    <div class="container text-center">
        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Permohonan Surat</h1>
        <p class="lead text-white animate__animated animate__fadeInUp">Data Permohonan Surat Bina Desa</p>
    </div>
</div>
<div class="container-fluid py-5">
    <div class="container py-5">
        <!-- Success/Error Messages -->
        @if(session('success'))
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

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
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
                <div class="card card-stat bg-primary text-white shadow h-100 stats-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-envelope-open fa-3x"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 counter" data-target="{{ $dataPermohonan->count() }}">0</h4>
                            <p class="mb-0">Total Permohonan</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card card-stat bg-warning text-white shadow h-100 stats-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-clock fa-3x"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 counter" data-target="{{ $dataPermohonan->where('status', 'DRAFT')->count() }}">0</h4>
                            <p class="mb-0">Draft</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card card-stat bg-success text-white shadow h-100 stats-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-check-circle fa-3x"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 counter" data-target="{{ $dataPermohonan->where('status', 'SELESAI')->count() }}">0</h4>
                            <p class="mb-0">Selesai</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card card-stat bg-info text-white shadow h-100 stats-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-file-alt fa-3x"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 counter" data-target="{{ $dataPermohonan->unique('jenis_surat_id')->count() }}">0</h4>
                            <p class="mb-0">Jenis Surat</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Bar -->
        <div class="row mb-4">
            <div class="col-md-8">
                <form method="GET" action="{{ route('permohonan-surat.index') }}" class="d-flex">
                    <div class="search-box me-3 flex-grow-1">
                        <div class="input-group search-container">
                            <input type="text" class="form-control border-0 input-focus-effect" placeholder="Cari nomor permohonan atau nama pemohon..." name="search" value="{{ request('search') }}" id="searchInput">
                            <button class="btn btn-primary search-btn" type="submit" id="searchButton">
                                <i class="fas fa-search me-2"></i>Cari
                            </button>
                        </div>
                    </div>
                    <div class="dropdown me-3">
                        <button class="btn btn-outline-secondary dropdown-toggle filter-btn" type="button" data-bs-toggle="dropdown" data-bs-toggle="tooltip" title="Filter data permohonan">
                            <i class="fas fa-filter me-2"></i>Filter
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{ request('filter_status') == 'all' || !request('filter_status') ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['filter_status' => 'all', 'page' => 1]) }}"><i class="fas fa-list me-2"></i>Semua</a></li>
                            <li><a class="dropdown-item {{ request('filter_status') == 'DRAFT' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['filter_status' => 'DRAFT', 'page' => 1]) }}"><i class="fas fa-clock me-2"></i>Draft</a></li>
                            <li><a class="dropdown-item {{ request('filter_status') == 'DIAJUKAN' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['filter_status' => 'DIAJUKAN', 'page' => 1]) }}"><i class="fas fa-paper-plane me-2"></i>Diajukan</a></li>
                            <li><a class="dropdown-item {{ request('filter_status') == 'DIPROSES' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['filter_status' => 'DIPROSES', 'page' => 1]) }}"><i class="fas fa-cog me-2"></i>Diproses</a></li>
                            <li><a class="dropdown-item {{ request('filter_status') == 'SELESAI' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['filter_status' => 'SELESAI', 'page' => 1]) }}"><i class="fas fa-check-circle me-2"></i>Selesai</a></li>
                            <li><a class="dropdown-item {{ request('filter_status') == 'DIAMBIL' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['filter_status' => 'DIAMBIL', 'page' => 1]) }}"><i class="fas fa-hand-holding me-2"></i>Diambil</a></li>
                            <li><a class="dropdown-item {{ request('filter_status') == 'DITOLAK' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['filter_status' => 'DITOLAK', 'page' => 1]) }}"><i class="fas fa-times me-2"></i>Ditolak</a></li>
                        </ul>
                    </div>
                    @if(request('search') || request('filter_status'))
                        <a href="{{ route('permohonan-surat.index') }}" class="btn btn-outline-danger">
                            <i class="fas fa-times me-2"></i>Reset
                        </a>
                    @endif
                </form>
            </div>
            <div class="col-md-4 text-md-end">
                <!-- TOMBOL TAMBAH PERMOHONAN SURAT -->
                <a href="{{ route('permohonan-surat.create') }}" class="btn btn-primary floating-action-btn" data-bs-toggle="tooltip" title="Tambah permohonan surat baru">
                    <i class="fas fa-plus me-2"></i>Tambah Permohonan
                </a>
            </div>
        </div>

        <!-- Widget Cards untuk Data Permohonan Surat -->
        <div class="row" id="permohonanContainer">
            @forelse($dataPermohonan as $index => $dataPermohonan)
            <div class="col-xl-4 col-md-6 mb-4 permohonan-card animate__animated animate__fadeInUp" data-status="{{ $permohonan->status }}" data-search="{{ strtolower($permohonan->nomor_permohonan . ' ' . ($permohonan->warga ? $permohonan->warga->nama : 'Tidak Diketahui')) }}" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                <div class="card widget-card h-100">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">
                            <i class="fas fa-envelope me-2"></i>{{ $permohonan->nomor_permohonan }}
                        </h6>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light dropdown-toggle action-btn" type="button" data-bs-toggle="dropdown" data-bs-toggle="tooltip" title="Aksi">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('permohonan-surat.show', $permohonan->permohonan_id) }}">
                                        <i class="fas fa-eye me-2"></i>Detail
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('permohonan-surat.edit', $permohonan->permohonan_id) }}">
                                        <i class="fas fa-edit me-2"></i>Edit
                                    </a>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item text-danger delete-btn" data-permohonan-id="{{ $permohonan->permohonan_id }}" data-permohonan-name="{{ $permohonan->nomor_permohonan }}">
                                        <i class="fas fa-trash-alt me-2"></i>Hapus
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <small class="text-muted">Pemohon</small>
                                <p class="mb-2">
                                    <i class="fas fa-user text-primary me-2"></i>
                                    @if($permohonan->warga)
                                        {{ $permohonan->warga->nama }}
                                    @else
                                        <span class="text-muted">Data pemohon tidak ditemukan</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <small class="text-muted">Jenis Surat</small>
                                <p class="mb-2">
                                    @if($permohonan->jenisSurat)
                                        <i class="fas fa-file-alt me-2"></i>{{ $permohonan->jenisSurat->nama_jenis }}
                                    @else
                                        <span class="text-muted">Jenis surat tidak ditemukan</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-6">
                                <small class="text-muted">Status</small>
                                <p class="mb-2">
                                    @php
                                        $statusClass = [
                                            'DRAFT' => 'secondary',
                                            'DIAJUKAN' => 'info',
                                            'DIPROSES' => 'warning',
                                            'SELESAI' => 'success',
                                            'DIAMBIL' => 'primary',
                                            'DITOLAK' => 'danger'
                                        ][$permohonan->status] ?? 'secondary';

                                        $statusIcon = [
                                            'DRAFT' => 'clock',
                                            'DIAJUKAN' => 'paper-plane',
                                            'DIPROSES' => 'cog',
                                            'SELESAI' => 'check-circle',
                                            'DIAMBIL' => 'hand-holding',
                                            'DITOLAK' => 'times'
                                        ][$permohonan->status] ?? 'clock';
                                    @endphp
                                    <span class="badge status-badge bg-{{ $statusClass }}">
                                        <i class="fas fa-{{ $statusIcon }} me-1"></i>{{ $permohonan->status }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <small class="text-muted">Tanggal Pengajuan</small>
                                <p class="mb-2"><i class="fas fa-calendar text-warning me-2"></i>{{ \Carbon\Carbon::parse($permohonan->tanggal_pengajuan)->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="row text-center">
                            <div class="col-6 border-end">
                                <a href="{{ route('permohonan-surat.show', $permohonan->permohonan_id) }}" class="text-secondary detail-link" title="Lihat Detail" data-bs-toggle="tooltip">
                                    <i class="fas fa-eye"></i>
                                    <small class="d-block mt-1">Detail</small>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('permohonan-surat.edit', $permohonan->permohonan_id) }}" class="text-secondary edit-link" title="Edit" data-bs-toggle="tooltip">
                                    <i class="fas fa-edit"></i>
                                    <small class="d-block mt-1">Edit</small>
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
                        <i class="fas fa-envelope-open fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">Belum ada data permohonan surat</h4>
                        <p class="text-muted mb-4">Mulai dengan menambahkan permohonan surat pertama</p>
                        <a href="{{ route('permohonan-surat.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Tambah Permohonan Pertama
                        </a>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Info jumlah data -->
        @if($dataPermohonan->count() > 0)
        <div class="row mt-4">
            <div class="col-12 text-center">
                <p class="text-muted" id="dataInfo">
                    <i class="fas fa-info-circle me-2"></i>Menampilkan {{ $dataPermohonan->count() }} dari {{ $dataPermohonan->total() }} permohonan surat
                </p>
            </div>
        </div>
        @endif

        <!-- Pagination -->
        @if($dataPermohonan->hasPages())
        <div class="row mt-4">
            <div class="col-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        {{-- Previous Page Link --}}
                        @if($dataPermohonan->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">«</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $dataPermohonan->previousPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}" rel="prev">«</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach($dataPermohonan->getUrlRange(1, $dataPermohonan->lastPage()) as $page => $url)
                            @if($page == $dataPermohonan->currentPage())
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
                        @if($dataPermohonan->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $dataPermohonan->nextPageUrl() }}{{ request()->getQueryString() ? '&' . http_build_query(request()->except('page')) : '' }}" rel="next">»</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">»</span>
                            </li>
                        @endif
                    </ul>
                </nav>
                <div class="text-center text-muted mt-2">
                    Menampilkan {{ $dataPermohonan->firstItem() }} - {{ $dataPermohonan->lastItem() }} dari {{ $dataPermohonan->total() }} data
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
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
                <h5>Apakah Anda yakin ingin menghapus permohonan surat ini?</h5>
                <p class="text-muted">Data yang sudah dihapus tidak dapat dikembalikan</p>
                <p><strong id="deletePermohonanName"></strong></p>
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
        box-shadow: 0 12px 25px rgba(0,0,0,0.15) !important;
    }

    /* Animasi untuk kartu permohonan */
    .widget-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .widget-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .card-header {
        border-radius: 15px 15px 0 0 !important;
        padding: 1rem 1.25rem;
    }

    /* Efek untuk badge status */
    .status-badge {
        transition: all 0.3s ease;
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
    }

    .widget-card:hover .status-badge {
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
        background-color: rgba(255,255,255,0.2) !important;
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
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    /* Styling untuk pencarian */
    .search-container {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .search-container:focus-within {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
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

    /* Styling untuk detail dan edit links */
    .detail-link, .edit-link {
        transition: all 0.3s ease;
        padding: 0.5rem;
        border-radius: 8px;
        text-decoration: none;
        display: block;
    }

    .detail-link:hover {
        background-color: rgba(0,0,0,0.05);
        transform: scale(1.1);
        color: var(--bs-info) !important;
    }

    .edit-link:hover {
        background-color: rgba(0,0,0,0.05);
        transform: scale(1.1);
        color: var(--bs-warning) !important;
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
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
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
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
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
        }, { threshold: 0.5 });

        counters.forEach(counter => {
            observer.observe(counter);
        });

        // Delete modal functionality
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        const deleteForm = document.getElementById('deleteForm');
        const deletePermohonanName = document.getElementById('deletePermohonanName');

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const permohonanId = this.getAttribute('data-permohonan-id');
                const permohonanName = this.getAttribute('data-permohonan-name');

                deletePermohonanName.textContent = permohonanName;
                deleteForm.action = `{{ url('permohonan-surat') }}/${permohonanId}`;
                deleteModal.show();
            });
        });

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
        const permohonanCards = document.querySelectorAll('.permohonan-card');
        permohonanCards.forEach(card => {
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
