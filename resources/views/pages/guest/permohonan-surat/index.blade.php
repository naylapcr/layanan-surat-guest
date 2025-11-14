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
        <!-- Stats Cards -->
        <div class="row mb-5">
            <div class="col-md-3 mb-4">
                <div class="card card-stat bg-primary text-white shadow h-100 stats-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-envelope-open fa-3x"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 counter" data-target="{{ $dataPermohonanSurat->count() }}">0</h4>
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
                            <h4 class="mb-0 counter" data-target="{{ $dataPermohonanSurat->where('status', 'pending')->count() }}">0</h4>
                            <p class="mb-0">Pending</p>
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
                            <h4 class="mb-0 counter" data-target="{{ $dataPermohonanSurat->where('status', 'completed')->count() }}">0</h4>
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
                            <h4 class="mb-0 counter" data-target="{{ $dataPermohonanSurat->unique('jenis_id')->count() }}">0</h4>
                            <p class="mb-0">Jenis Surat</p>
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
                            <input type="text" class="form-control border-0 input-focus-effect" placeholder="Cari nomor permohonan atau nama pemohon..." id="searchInput">
                            <button class="btn btn-primary search-btn" type="button" id="searchButton">
                                <i class="fas fa-search me-2"></i>Cari
                            </button>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle filter-btn" type="button" data-bs-toggle="dropdown" data-bs-toggle="tooltip" title="Filter data permohonan">
                            <i class="fas fa-filter me-2"></i>Filter
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item filter-option" href="#" data-filter="all"><i class="fas fa-list me-2"></i>Semua</a></li>
                            <li><a class="dropdown-item filter-option" href="#" data-filter="pending"><i class="fas fa-clock me-2"></i>Pending</a></li>
                            <li><a class="dropdown-item filter-option" href="#" data-filter="approved"><i class="fas fa-check me-2"></i>Disetujui</a></li>
                            <li><a class="dropdown-item filter-option" href="#" data-filter="rejected"><i class="fas fa-times me-2"></i>Ditolak</a></li>
                            <li><a class="dropdown-item filter-option" href="#" data-filter="completed"><i class="fas fa-check-circle me-2"></i>Selesai</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-md-end">
                <!-- TOMBOL TAMBAH PERMOHONAN SURAT -->
                <a href="{{ route('permohonan-surat.create') }}" class="btn btn-primary floating-action-btn" data-bs-toggle="tooltip" title="Tambah permohonan surat baru">
                    <i class="fas fa-plus me-2"></i>Tambah Permohonan
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

        <!-- Table untuk Permohonan Surat -->
        <div class="card animate__animated animate__fadeInUp">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="permohonanTable">
                        <thead class="table-primary">
                            <tr>
                                <th>No.</th>
                                <th>Nomor Permohonan</th>
                                <th>Nama Pemohon</th>
                                <th>Jenis Surat</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dataPermohonanSurat as $index => $permohonan)
                            <tr class="permohonan-card-item" data-search="{{ strtolower($permohonan->nomor_permohonan . ' ' . $permohonan->pemohon->nama) }}" data-status="{{ $permohonan->status }}">
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $permohonan->nomor_permohonan }}</strong>
                                </td>
                                <td>{{ $permohonan->pemohon->nama }}</td>
                                <td>{{ $permohonan->jenisSurat->nama_jenis }}</td>
                                <td>{{ \Carbon\Carbon::parse($permohonan->tanggal_pengajuan)->format('d M Y') }}</td>
                                <td>
                                    @php
                                        $statusClass = [
                                            'pending' => 'warning',
                                            'approved' => 'success',
                                            'rejected' => 'danger',
                                            'completed' => 'info'
                                        ][$permohonan->status] ?? 'secondary';

                                        $statusText = [
                                            'pending' => 'Pending',
                                            'approved' => 'Disetujui',
                                            'rejected' => 'Ditolak',
                                            'completed' => 'Selesai'
                                        ][$permohonan->status] ?? $permohonan->status;
                                    @endphp
                                    <span class="badge bg-{{ $statusClass }}">{{ $statusText }}</span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-info view-btn" data-bs-toggle="tooltip" title="Lihat Detail" onclick="viewPermohonan({{ $permohonan->permohonan_id }})">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="{{ route('permohonan-surat.edit', $permohonan->permohonan_id) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger delete-btn" data-bs-toggle="tooltip" title="Hapus" data-permohonan-id="{{ $permohonan->permohonan_id }}" data-permohonan-name="{{ $permohonan->nomor_permohonan }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="empty-state-card">
                                        <i class="fas fa-envelope-open fa-4x text-muted mb-3"></i>
                                        <h4 class="text-muted">Belum ada data permohonan surat</h4>
                                        <p class="text-muted mb-4">Mulai dengan menambahkan permohonan surat pertama</p>
                                        <a href="{{ route('permohonan-surat.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-2"></i>Tambah Permohonan Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Info jumlah data -->
        @if($dataPermohonanSurat->count() > 0)
        <div class="row mt-4">
            <div class="col-12 text-center">
                <p class="text-muted" id="dataInfo">
                    <i class="fas fa-info-circle me-2"></i>Menampilkan <span id="filtered-count">{{ $dataPermohonanSurat->count() }}</span> permohonan surat
                </p>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- View Detail Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewModalLabel">
                    <i class="fas fa-eye me-2"></i>Detail Permohonan Surat
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="detail-group mb-3">
                            <label class="form-label fw-bold text-primary">Nomor Permohonan</label>
                            <p id="detailNomor" class="mb-0">-</p>
                        </div>
                        <div class="detail-group mb-3">
                            <label class="form-label fw-bold text-primary">Nama Pemohon</label>
                            <p id="detailPemohon" class="mb-0">-</p>
                        </div>
                        <div class="detail-group mb-3">
                            <label class="form-label fw-bold text-primary">Jenis Surat</label>
                            <p id="detailJenis" class="mb-0">-</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-group mb-3">
                            <label class="form-label fw-bold text-primary">Tanggal Pengajuan</label>
                            <p id="detailTanggal" class="mb-0">-</p>
                        </div>
                        <div class="detail-group mb-3">
                            <label class="form-label fw-bold text-primary">Status</label>
                            <p id="detailStatus" class="mb-0">-</p>
                        </div>
                        <div class="detail-group mb-3">
                            <label class="form-label fw-bold text-primary">Catatan</label>
                            <p id="detailCatatan" class="mb-0 text-muted">-</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Tutup
                </button>
            </div>
        </div>
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

    /* Animasi untuk tabel */
    .table-responsive {
        border-radius: 10px;
        overflow: hidden;
    }

    .table th {
        border-top: none;
        font-weight: 600;
        background-color: var(--bs-primary);
        color: white;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,0.02);
        transform: scale(1.01);
        transition: all 0.2s ease;
    }

    /* Styling untuk tombol aksi */
    .action-buttons {
        display: flex;
        gap: 5px;
    }

    .action-buttons .btn {
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .action-buttons .btn:hover {
        transform: translateY(-2px);
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

    /* Styling untuk empty state */
    .empty-state-card {
        border: 2px dashed #dee2e6;
        border-radius: 15px;
        padding: 2rem;
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
    }

    /* Detail group styling */
    .detail-group label {
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .detail-group p {
        font-size: 1rem;
        padding: 0.5rem 0;
        border-bottom: 1px solid #f0f0f0;
    }

    /* Badge styling */
    .badge {
        font-size: 0.75rem;
        padding: 0.5rem 0.75rem;
        border-radius: 20px;
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
        const permohonanRows = document.querySelectorAll('.permohonan-card-item');
        const filteredCount = document.getElementById('filtered-count');

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

        function updateFilteredCount() {
            const visibleRows = document.querySelectorAll('.permohonan-card-item:not(.d-none)').length;
            if (filteredCount) {
                filteredCount.textContent = visibleRows;
            }
        }

        function filterRows() {
            const searchTerm = searchInput.value.toLowerCase();
            const activeFilter = document.querySelector('.filter-option.active')?.getAttribute('data-filter') || 'all';

            permohonanRows.forEach(row => {
                const rowSearch = row.getAttribute('data-search');
                const rowStatus = row.getAttribute('data-status');

                const matchesSearch = rowSearch.includes(searchTerm);
                const matchesFilter = activeFilter === 'all' || rowStatus === activeFilter;

                if (matchesSearch && matchesFilter) {
                    row.classList.remove('d-none');
                } else {
                    row.classList.add('d-none');
                }
            });

            updateFilteredCount();
        }

        // Event listener untuk pencarian
        searchInput.addEventListener('input', filterRows);
        searchButton.addEventListener('click', filterRows);

        // Event listener untuk filter
        filterOptions.forEach(option => {
            option.addEventListener('click', function(e) {
                e.preventDefault();

                filterOptions.forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');

                filterRows();
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

        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });

    // Fungsi untuk melihat detail permohonan
    function viewPermohonan(id) {
        // Implementasi AJAX untuk mengambil data detail
        fetch(`/permohonan-surat/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('detailNomor').textContent = data.nomor_permohonan;
                document.getElementById('detailPemohon').textContent = data.pemohon.nama;
                document.getElementById('detailJenis').textContent = data.jenis_surat.nama_jenis;
                document.getElementById('detailTanggal').textContent = new Date(data.tanggal_pengajuan).toLocaleDateString('id-ID');

                const statusText = {
                    'pending': 'Pending',
                    'approved': 'Disetujui',
                    'rejected': 'Ditolak',
                    'completed': 'Selesai'
                }[data.status] || data.status;

                document.getElementById('detailStatus').textContent = statusText;
                document.getElementById('detailCatatan').textContent = data.catatan || '-';

                const viewModal = new bootstrap.Modal(document.getElementById('viewModal'));
                viewModal.show();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengambil data detail');
            });
    }
</script>

@endsection
