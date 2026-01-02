@extends('layouts.guest.app')

@section('content')
    {{-- main content --}}
    <div class="page-header">
        <div class="container text-center">
            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Berkas Persyaratan</h1>
            <p class="lead text-white animate__animated animate__fadeInUp">Kelola Dokumen Persyaratan & Lampiran Warga</p>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container py-5">
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

            {{-- STATISTIK CARDS --}}
            <div class="row mb-5">
                <div class="col-md-3 mb-4">
                    <div class="card card-stat bg-primary text-white shadow h-100 stats-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-folder-open fa-3x"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 counter" data-target="{{ $data->total() }}">0</h4>
                                <p class="mb-0">Total Berkas</p>
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
                                {{-- Menghitung yang belum valid --}}
                                <h4 class="mb-0 counter" data-target="{{ $data->where('valid', 0)->count() }}">0</h4>
                                <p class="mb-0">Perlu Validasi</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card card-stat bg-success text-white shadow h-100 stats-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-check-double fa-3x"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 counter" data-target="{{ $data->where('valid', 1)->count() }}">0</h4>
                                <p class="mb-0">Sudah Valid</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card card-stat bg-info text-white shadow h-100 stats-card" data-aos="fade-up" data-aos-delay="400">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-envelope-open-text fa-3x"></i>
                            </div>
                            <div>
                                {{-- Menghitung jumlah permohonan unik (karena 1 permohonan bisa punya banyak berkas) --}}
                                <h4 class="mb-0 counter" data-target="{{ $data->unique('permohonan_id')->count() }}">0</h4>
                                <p class="mb-0">Permohonan Terkait</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ACTION BAR --}}
            <div class="row mb-4">
                <div class="col-md-8">
                    <form method="GET" action="{{ route('berkas.index') }}" class="d-flex">
                        <div class="search-box me-3 flex-grow-1">
                            <div class="input-group search-container">
                                <input type="text" class="form-control border-0 input-focus-effect"
                                    placeholder="Cari nama berkas..." name="search"
                                    value="{{ request('search') }}" id="searchInput">
                                <button class="btn btn-primary search-btn" type="submit" id="searchButton">
                                    <i class="fas fa-search me-2"></i>Cari
                                </button>
                            </div>
                        </div>
                        <div class="dropdown me-3">
                            <button class="btn btn-outline-secondary dropdown-toggle filter-btn" type="button"
                                data-bs-toggle="dropdown" data-bs-toggle="tooltip" title="Filter Data">
                                <i class="fas fa-filter me-2"></i>Filter
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('berkas.index') }}">Semua</a></li>
                            </ul>
                        </div>
                        @if (request('search'))
                            <a href="{{ route('berkas.index') }}" class="btn btn-outline-danger">
                                <i class="fas fa-times me-2"></i>Reset
                            </a>
                        @endif
                    </form>
                </div>

                <div class="col-md-4 text-md-end">
                    <a href="{{ route('berkas.create') }}" class="btn btn-primary floating-action-btn"
                        data-bs-toggle="tooltip" title="Tambah berkas persyaratan baru">
                        <i class="fas fa-plus me-2"></i>Tambah Berkas
                    </a>
                </div>
            </div>

            {{-- GRID DATA --}}
            <div class="row" id="berkasContainer">
                @forelse($data as $index => $item)
                    <div class="col-xl-4 col-md-6 mb-4 berkas-card animate__animated animate__fadeInUp"
                        data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                        <div class="card widget-card h-100">
                            {{-- CARD HEADER --}}
                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 text-truncate" title="{{ $item->nama_berkas }}">
                                    <i class="fas fa-file-contract me-2"></i>{{ Str::limit($item->nama_berkas, 20) }}
                                </h6>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light dropdown-toggle action-btn" type="button"
                                        data-bs-toggle="dropdown" data-bs-toggle="tooltip" title="Aksi">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            {{-- Pastikan menggunakan berkas_id sebagai parameter --}}
                                            <a class="dropdown-item" href="{{ route('berkas.edit', $item->berkas_id) }}">
                                                <i class="fas fa-edit me-2"></i>Edit
                                            </a>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item text-danger delete-btn"
                                                data-id="{{ $item->berkas_id }}"
                                                data-name="{{ $item->nama_berkas }}">
                                                <i class="fas fa-trash-alt me-2"></i>Hapus
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            {{-- CARD BODY --}}
                            <div class="card-body">
                                {{-- Row 1: Permohonan Info --}}
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <small class="text-muted">Nomor Permohonan</small>
                                        <p class="mb-2">
                                            @if ($item->permohonan)
                                                <i class="fas fa-hashtag text-primary me-2"></i>
                                                {{ $item->permohonan->nomor_permohonan }}
                                            @else
                                                <span class="text-muted"><i class="fas fa-exclamation-circle me-2"></i>Data Terhapus</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                {{-- Row 2: Jenis Surat (Diakses via Permohonan) --}}
                                <div class="row">
                                    <div class="col-12">
                                        <small class="text-muted">Jenis Surat</small>
                                        <p class="mb-2">
                                            @if($item->permohonan && $item->permohonan->jenisSurat)
                                                <i class="fas fa-envelope-open-text me-2"></i>
                                                {{ $item->permohonan->jenisSurat->nama_jenis }}
                                            @else
                                                <span class="text-muted small">-</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                {{-- Row 3: Status & Pemohon --}}
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <small class="text-muted">Pemohon</small>
                                        <p class="mb-2 small">
                                            @if($item->permohonan && $item->permohonan->warga)
                                                <i class="fas fa-user me-1"></i> {{ Str::limit($item->permohonan->warga->nama, 8) }}
                                            @else
                                                -
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Status</small>
                                        <p class="mb-2">
                                            @if($item->valid)
                                                <span class="badge status-badge bg-success">
                                                    <i class="fas fa-check-circle me-1"></i>VALID
                                                </span>
                                            @else
                                                <span class="badge status-badge bg-warning">
                                                    <i class="fas fa-clock me-1"></i>PENDING
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- CARD FOOTER (FILE VIEW) --}}
                            <div class="card-footer bg-white border-top-0 pt-0 pb-3">
                                <div class="d-flex align-items-center mb-2 mt-2">
                                    <i class="fas fa-paperclip text-secondary small me-2"></i>
                                    <small class="text-secondary fw-bold" style="font-size: 0.75rem;">FILE LAMPIRAN</small>
                                </div>

                                <div class="d-flex flex-wrap gap-2">
                                    {{-- Menggunakan relasi Media yang dimiliki Berkas --}}
                                    @if($item->media)
                                        @php
                                            // Asumsi model Media punya field 'file_url' atau semacamnya
                                            // Kita gunakan accessor atau field langsung
                                            $filename = $item->media->file_url ?? $item->media->file_path ?? '';
                                            $isPdf = str_ends_with(strtolower($filename), '.pdf');
                                            $isDoc = str_ends_with(strtolower($filename), '.doc') || str_ends_with(strtolower($filename), '.docx');
                                            $isImg = preg_match('/\.(jpg|jpeg|png|gif)$/i', $filename);
                                        @endphp

                                        @if($filename)
                                            <a href="{{ asset('uploads/' . $filename) }}" target="_blank"
                                               class="btn btn-sm btn-outline-light text-dark border shadow-sm rounded-pill px-3 py-1 d-flex align-items-center file-chip"
                                               style="font-size: 0.8rem; text-decoration: none;"
                                               data-bs-toggle="tooltip" title="{{ $filename }}">
                                                @if($isPdf)
                                                    <i class="fas fa-file-pdf text-danger me-2"></i>
                                                @elseif($isDoc)
                                                    <i class="fas fa-file-word text-primary me-2"></i>
                                                @elseif($isImg)
                                                    <i class="fas fa-file-image text-success me-2"></i>
                                                @else
                                                    <i class="fas fa-file me-2"></i>
                                                @endif
                                                <span class="fw-medium">Lihat File</span>
                                            </a>
                                        @else
                                            <span class="text-muted small fst-italic ms-1">
                                                <i class="fas fa-ban me-1 opacity-50"></i>File rusak/hilang
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-muted small fst-italic ms-1">
                                            <i class="fas fa-ban me-1 opacity-50"></i>Tidak ada file
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- CARD ACTIONS --}}
                            <div class="card-footer bg-light">
                                <div class="row text-center">
                                    <div class="col-6 border-end">
                                        <a href="{{ route('berkas.edit', $item->berkas_id) }}"
                                            class="text-secondary edit-link" title="Edit Data"
                                            data-bs-toggle="tooltip">
                                            <i class="fas fa-edit"></i>
                                            <small class="d-block mt-1">Edit</small>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-link text-secondary delete-btn w-100 p-0 text-decoration-none edit-link"
                                            data-id="{{ $item->berkas_id }}"
                                            data-name="{{ $item->nama_berkas }}"
                                            title="Hapus Data"
                                            data-bs-toggle="tooltip">
                                            <i class="fas fa-trash-alt"></i>
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
                                <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                                <h4 class="text-muted">Belum ada data berkas</h4>
                                <p class="text-muted mb-4">Silakan tambahkan berkas baru untuk memulai</p>
                                <a href="{{ route('berkas.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Tambah Berkas Pertama
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            @if ($data->count() > 0)
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <p class="text-muted" id="dataInfo">
                            <i class="fas fa-info-circle me-2"></i>Menampilkan {{ $data->count() }} data
                            {{-- Jika menggunakan pagination standard Laravel --}}
                            @if(method_exists($data, 'total'))
                                dari {{ $data->total() }} berkas
                            @endif
                        </p>
                    </div>
                </div>
            @endif

            {{-- PAGINATION --}}
            @if(method_exists($data, 'hasPages') && $data->hasPages())
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-center">
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- MODAL HAPUS --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas fa-trash-alt fa-4x text-danger mb-3 animate__animated animate__pulse"></i>
                    <h5>Apakah Anda yakin ingin menghapus berkas ini?</h5>
                    <p class="text-muted">Data yang sudah dihapus tidak dapat dikembalikan</p>
                    <p><strong id="deleteItemName"></strong></p>
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

    {{-- STYLES & SCRIPTS --}}
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
        /* Animasi untuk kartu widget */
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
        /* Styling untuk detail dan edit links */
        .edit-link {
            transition: all 0.3s ease;
            padding: 0.5rem;
            border-radius: 8px;
            text-decoration: none;
            display: block;
        }
        .edit-link:hover {
            background-color: rgba(0, 0, 0, 0.05);
            transform: scale(1.1);
            color: var(--bs-primary) !important;
        }
        /* Styling untuk file chips */
        .file-chip {
            transition: all 0.2s ease;
        }
        .file-chip:hover {
            transform: translateY(-2px);
            box-shadow: 0 3px 8px rgba(0,0,0,0.1) !important;
            background-color: #f8f9fa;
            border-color: var(--bs-primary) !important;
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
        .alert-success { border-left-color: var(--bs-success); }
        .alert-danger { border-left-color: var(--bs-danger); }
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
        .counter { transition: all 0.5s ease; }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animasi counter
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
            counters.forEach(counter => { observer.observe(counter); });

            // Delete modal functionality
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const deleteForm = document.getElementById('deleteForm');
            const deleteItemName = document.getElementById('deleteItemName');
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    deleteItemName.textContent = name;
                    deleteForm.action = `{{ url('berkas') }}/${id}`;
                    deleteModal.show();
                });
            });

            // Auto-hide alerts
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.classList.add('animate__fadeOut');
                    setTimeout(() => { alert.remove(); }, 1000);
                }, 5000);
            });

            // Efek hover untuk kartu
            const cards = document.querySelectorAll('.berkas-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() { this.style.transform = 'translateY(-5px)'; });
                card.addEventListener('mouseleave', function() { this.style.transform = 'translateY(0)'; });
            });

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>
@endsection
