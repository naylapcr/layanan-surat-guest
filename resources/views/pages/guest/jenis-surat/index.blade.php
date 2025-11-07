@extends('layouts.guest.app')

@section('content')
{{-- main content --}}
    <!-- Content Start -->
<div class="page-header">
    <div class="container text-center">
        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Jenis Surat</h1>
        <p class="lead text-white animate__animated animate__fadeInUp">Jenis Surat Bina Desa</p>
    </div>
</div>
<div class="container-fluid py-5">
    <div class="container py-5">
        <!-- Stats Cards -->
        <div class="row mb-5">
            <div class="col-md-4 mb-4">
                <div class="card card-stat bg-primary text-white shadow h-100 stats-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-file-alt fa-3x"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 counter" data-target="{{ $dataJenisSurat->count() }}">0</h4>
                            <p class="mb-0">Total Jenis Surat</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-stat bg-success text-white shadow h-100 stats-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-code fa-3x"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 counter" data-target="{{ $dataJenisSurat->unique('kode')->count() }}">0</h4>
                            <p class="mb-0">Kode Unik</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-stat bg-info text-white shadow h-100 stats-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-clipboard-list fa-3x"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 counter" data-target="{{ $dataJenisSurat->where('syarat_json', '!=', '')->count() }}">0</h4>
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
                        <div class="input-group search-container">
                            <input type="text" class="form-control border-0 input-focus-effect" placeholder="Cari jenis surat..." id="searchInput">
                            <button class="btn btn-primary search-btn" type="button" id="searchButton">
                                <i class="fas fa-search me-2"></i>Cari
                            </button>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle filter-btn" type="button" data-bs-toggle="dropdown" data-bs-toggle="tooltip" title="Filter data jenis surat">
                            <i class="fas fa-filter me-2"></i>Filter
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item filter-option" href="#" data-filter="all"><i class="fas fa-list me-2"></i>Semua</a></li>
                            <li><a class="dropdown-item filter-option" href="#" data-filter="with-syarat"><i class="fas fa-clipboard-check me-2"></i>Dengan Syarat</a></li>
                            <li><a class="dropdown-item filter-option" href="#" data-filter="without-syarat"><i class="fas fa-file me-2"></i>Tanpa Syarat</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-md-end">
                <!-- TOMBOL TAMBAH JENIS SURAT -->
                <a href="{{ route('jenis-surat.create') }}" class="btn btn-primary floating-action-btn" data-bs-toggle="tooltip" title="Tambah jenis surat baru">
                    <i class="fas fa-plus me-2"></i>Tambah Jenis Surat
                </a>
            </div>
        </div>

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

        <!-- Widget Cards untuk Jenis Surat -->
        <div class="row" id="jenisSuratContainer">
            @forelse($dataJenisSurat as $index => $jenis)
            <div class="col-xl-4 col-md-6 mb-4 jenis-surat-card-item animate__animated animate__fadeInUp" data-name="{{ strtolower($jenis->nama_jenis) }}" data-syarat="{{ $jenis->syarat_json ? 'with-syarat' : 'without-syarat' }}" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                <div class="card jenis-surat-card h-100">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">
                                <i class="fas fa-file-contract me-2"></i>{{ $jenis->nama_jenis }}
                            </h6>
                            <span class="badge kode-badge bg-light text-dark">{{ $jenis->kode }}</span>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light dropdown-toggle action-btn" type="button" data-bs-toggle="dropdown" data-bs-toggle="tooltip" title="Aksi">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('jenis-surat.edit', $jenis->jenis_id) }}">
                                        <i class="fas fa-edit me-2"></i>Edit
                                    </a>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item text-danger delete-btn" data-jenis-id="{{ $jenis->jenis_id }}" data-jenis-name="{{ $jenis->nama_jenis }}">
                                        <i class="fas fa-trash me-2"></i>Hapus
                                    </button>
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
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i>
                                    Terakhir diperbarui: {{ $jenis->updated_at->format('d M Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="card text-center py-5 empty-state-card" data-aos="fade-up">
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
                <p class="text-muted" id="dataInfo">
                    <i class="fas fa-info-circle me-2"></i>Menampilkan <span id="filtered-count">{{ $dataJenisSurat->count() }}</span> jenis surat
                </p>
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
                <h5>Apakah Anda yakin ingin menghapus jenis surat ini?</h5>
                <p class="text-muted">Data yang sudah dihapus tidak dapat dikembalikan</p>
                <p><strong id="deleteJenisName"></strong></p>
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
{{-- end main content --}}

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

    /* Animasi untuk kartu jenis surat */
    .jenis-surat-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .jenis-surat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .card-header {
        border-radius: 15px 15px 0 0 !important;
        padding: 1rem 1.25rem;
    }

    /* Efek untuk badge kode */
    .kode-badge {
        transition: all 0.3s ease;
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
    }

    .jenis-surat-card:hover .kode-badge {
        transform: scale(1.1);
        background-color: var(--bs-warning) !important;
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

    /* Styling untuk item syarat */
    .syarat-item {
        transition: all 0.3s ease;
        padding: 0.5rem;
        border-radius: 8px;
    }

    .syarat-item:hover {
        background-color: rgba(0,0,0,0.05);
        transform: translateX(5px);
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

    /* Animasi untuk kartu yang difilter */
    .jenis-surat-card-item.hidden {
        display: none;
        animation: fadeOut 0.3s ease;
    }

    .jenis-surat-card-item.visible {
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

        // Fungsi pencarian dan filter
        const searchInput = document.getElementById('searchInput');
        const searchButton = document.getElementById('searchButton');
        const filterOptions = document.querySelectorAll('.filter-option');
        const jenisSuratCards = document.querySelectorAll('.jenis-surat-card-item');
        const filteredCount = document.getElementById('filtered-count');

        // Delete modal functionality
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        const deleteForm = document.getElementById('deleteForm');
        const deleteJenisName = document.getElementById('deleteJenisName');

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const jenisId = this.getAttribute('data-jenis-id');
                const jenisName = this.getAttribute('data-jenis-name');

                deleteJenisName.textContent = jenisName;
                deleteForm.action = `{{ url('jenis-surat') }}/${jenisId}`;
                deleteModal.show();
            });
        });

        function updateFilteredCount() {
            const visibleCards = document.querySelectorAll('.jenis-surat-card-item:not(.hidden)').length;
            if (filteredCount) {
                filteredCount.textContent = visibleCards;
            }
        }

        function filterCards() {
            const searchTerm = searchInput.value.toLowerCase();
            const activeFilter = document.querySelector('.filter-option.active')?.getAttribute('data-filter') || 'all';

            jenisSuratCards.forEach(card => {
                const cardName = card.getAttribute('data-name');
                const cardSyarat = card.getAttribute('data-syarat');

                const matchesSearch = cardName.includes(searchTerm);
                const matchesFilter = activeFilter === 'all' || cardSyarat === activeFilter;

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
        jenisSuratCards.forEach(card => {
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
