@extends('layouts.guest.app')

@section('content')
    {{-- main content --}}
    <div class="page-header">
        <div class="container text-center">
            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Edit Permohonan Surat</h1>
            <p class="lead text-white animate__animated animate__fadeInUp">Edit Permohonan Surat ke sistem</p>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    {{-- CARD FORM --}}
                    <div class="card form-card animate__animated animate__fadeInUp">
                        <div class="form-header text-center">
                            <div class="form-icon-wrapper">
                                <i class="fas fa-edit form-main-icon"></i>
                            </div>
                            <h3 class="mb-0">
                                Formulir Edit Permohonan Surat
                            </h3>
                            <p class="text-muted mt-2">Perbarui informasi permohonan surat</p>
                        </div>
                        <div class="form-body">
                            {{-- Form Action --}}
                            <form method="POST"
                                  action="{{ route('permohonan-surat.update', $permohonan->permohonan_id ?? $permohonan->id) }}"
                                  enctype="multipart/form-data"
                                  id="editPermohonanForm">
                                @csrf
                                @method('PUT')

                                {{-- Alert Error --}}
                                @if ($errors->any())
                                    <div class="alert alert-danger animate__animated animate__shakeX" role="alert">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-exclamation-triangle me-3 fa-lg"></i>
                                            <div>
                                                <h5 class="alert-heading mb-2">Terjadi Kesalahan</h5>
                                                <ul class="mb-0 ps-3">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Alert Success --}}
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-check-circle me-3 fa-lg"></i>
                                            <div>
                                                <h5 class="alert-heading mb-2">Berhasil!</h5>
                                                <p class="mb-0">{{ session('success') }}</p>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                {{-- Baris 1: Nomor & Tanggal --}}
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="nomor_permohonan" class="form-label">
                                            <i class="fas fa-hashtag me-2"></i>Nomor Permohonan *
                                        </label>
                                        <div class="input-group-icon">
                                            <input type="text" class="form-control input-focus-effect"
                                                id="nomor_permohonan"
                                                value="{{ $permohonan->nomor_permohonan }}"
                                                readonly>
                                            <i class="fas fa-hashtag form-icon"></i>
                                        </div>
                                        <div class="form-text">Nomor unik permohonan (Tidak dapat diubah)</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tanggal_pengajuan" class="form-label">
                                            <i class="fas fa-calendar me-2"></i>Tanggal Pengajuan *
                                        </label>
                                        <div class="input-group-icon">
                                            <input type="date" class="form-control input-focus-effect"
                                                id="tanggal_pengajuan"
                                                value="{{ $permohonan->tanggal_pengajuan }}"
                                                readonly>
                                            <i class="fas fa-calendar form-icon"></i>
                                        </div>
                                        <div class="form-text">Tanggal pengajuan awal</div>
                                    </div>
                                </div>

                                {{-- Baris 2: Jenis Surat & Pemohon (DIPERBAIKI) --}}
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="jenis_surat_id" class="form-label">
                                            <i class="fas fa-envelope me-2"></i>Jenis Surat *
                                        </label>
                                        <div class="input-group-icon">
                                            <select class="form-select input-focus-effect" id="jenis_surat_id"
                                                name="jenis_id" required>
                                                <option value="">Pilih Jenis Surat</option>
                                                @foreach ($dataJenisSurat as $jenis)
                                                    @php
                                                        // AMBIL ID DARI RELASI (LEBIH AMAN)
                                                        $currentJenisId = $permohonan->jenisSurat ? $permohonan->jenisSurat->jenis_id : $permohonan->jenis_id;
                                                        // CEK OLD INPUT ATAU DATA DATABASE
                                                        $selected = old('jenis_id', $currentJenisId) == $jenis->jenis_id ? 'selected' : '';
                                                    @endphp
                                                    <option value="{{ $jenis->jenis_id }}" {{ $selected }}>
                                                        {{ $jenis->nama_jenis }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <i class="fas fa-envelope form-icon"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="warga_id" class="form-label">
                                            <i class="fas fa-user me-2"></i>Pemohon *
                                        </label>
                                        <div class="input-group-icon">
                                            <select class="form-select input-focus-effect" id="warga_id" name="warga_id" required>
                                                <option value="">Pilih Nama Pemohon</option>
                                                @foreach($dataWarga as $warga)
                                                    @php
                                                        // AMBIL ID DARI RELASI 'warga' (LEBIH AMAN DARIPADA KOLOM ID)
                                                        $currentWargaId = $permohonan->warga ? $permohonan->warga->warga_id : $permohonan->warga_id;
                                                        // CEK OLD INPUT ATAU DATA DATABASE
                                                        $selected = old('warga_id', $currentWargaId) == $warga->warga_id ? 'selected' : '';
                                                    @endphp
                                                    <option value="{{ $warga->warga_id }}" {{ $selected }}>
                                                        {{ $warga->nama }}
                                                        @if ($warga->nik) - {{ $warga->nik }} @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                            <i class="fas fa-user form-icon"></i>
                                        </div>
                                    </div>
                                </div>

                                {{-- Baris 3: Status --}}
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <label for="status" class="form-label">
                                            <i class="fas fa-tasks me-2"></i>Status *
                                        </label>
                                        <div class="input-group-icon">
                                            <select class="form-select input-focus-effect" id="status" name="status" required>
                                                @foreach(['DRAFT', 'DIAJUKAN', 'DIPROSES', 'SELESAI', 'DIAMBIL', 'DITOLAK'] as $st)
                                                    <option value="{{ $st }}"
                                                        {{ old('status', $permohonan->status) == $st ? 'selected' : '' }}>
                                                        {{ $st }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <i class="fas fa-tasks form-icon"></i>
                                        </div>
                                    </div>
                                </div>

                                {{-- File Upload --}}
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="mb-2"><strong>Kelola Berkas Persyaratan</strong></label>
                                        <div class="mb-3">
                                            <div class="alert alert-info py-2 px-3 small">
                                                <i class="fas fa-info-circle me-2"></i>
                                                File lama sudah tersimpan. Upload file baru hanya jika ingin menambah lampiran.
                                                <a href="{{ route('permohonan-surat.show', $permohonan->permohonan_id ?? $permohonan->id) }}" class="fw-bold text-decoration-underline">Lihat File</a>
                                            </div>
                                        </div>
                                        <div class="custom-file mt-2">
                                            <input type="file" class="form-control" name="files[]" id="files" multiple>
                                        </div>
                                    </div>
                                </div>

                                {{-- Catatan --}}
                                <div class="mb-4 mt-4">
                                    <label for="catatan" class="form-label">
                                        <i class="fas fa-sticky-note me-2"></i>Catatan
                                    </label>
                                    <div class="input-group-icon">
                                        <textarea class="form-control input-focus-effect" id="catatan" name="catatan" rows="3"
                                            placeholder="Catatan tambahan...">{{ old('catatan', $permohonan->catatan) }}</textarea>
                                        <i class="fas fa-sticky-note form-icon"></i>
                                    </div>
                                </div>

                                {{-- Tombol Aksi --}}
                                <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                                    <a href="{{ route('permohonan-surat.index') }}" class="btn btn-outline-secondary btn-back">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali
                                    </a>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('permohonan-surat.index') }}" class="btn btn-outline-danger btn-cancel">
                                            <i class="fas fa-times me-2"></i>Batal
                                        </a>
                                        <button type="submit" class="btn btn-primary btn-submit" id="submitButton">
                                            <span class="submit-text">
                                                <i class="fas fa-save me-2"></i>Perbarui Permohonan
                                            </span>
                                            <span class="loading-spinner" style="display: none;">
                                                <i class="fas fa-spinner fa-spin me-2"></i>Memperbarui...
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- CARD INFO DATA SAAT INI --}}
                    <div class="card info-card mt-4 animate__animated animate__fadeInUp" data-aos-delay="200">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle text-info me-3 fa-2x"></i>
                                <div>
                                    <h5 class="card-title mb-2">Data Saat Ini</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="card-text mb-1 small">
                                                <strong>No. Tiket:</strong>
                                                <span class="badge bg-primary">{{ $permohonan->nomor_permohonan }}</span>
                                            </p>
                                            <p class="card-text mb-1 small">
                                                <strong>Pemohon:</strong>
                                                {{ $permohonan->warga->nama ?? 'Data Terhapus' }}
                                            </p>
                                            <p class="card-text mb-1 small">
                                                <strong>Jenis:</strong>
                                                {{ $permohonan->jenisSurat->nama_jenis ?? 'Data Terhapus' }}
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="card-text mb-1 small">
                                                <strong>Status:</strong>
                                                @php
                                                    $bg = match($permohonan->status) {
                                                        'SELESAI' => 'success',
                                                        'DITOLAK' => 'danger',
                                                        'DIPROSES' => 'warning',
                                                        'DIAJUKAN' => 'info',
                                                        default => 'secondary'
                                                    };
                                                @endphp
                                                <span class="badge bg-{{ $bg }}">{{ $permohonan->status }}</span>
                                            </p>
                                            <p class="card-text mb-0 small">
                                                <strong>Tgl:</strong> {{ \Carbon\Carbon::parse($permohonan->tanggal_pengajuan)->format('d M Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <p class="card-text mb-0 small mt-2">
                                        <strong>Terakhir Update:</strong> {{ $permohonan->updated_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- end content --}}

    <style>
        .form-card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .form-card:hover { transform: translateY(-5px); box-shadow: 0 15px 40px rgba(0,0,0,0.15); }
        .form-header { background: linear-gradient(135deg, var(--bs-warning), #ffc107); color: white; padding: 2.5rem 2rem; position: relative; overflow: hidden; }
        .form-header::before { content: ''; position: absolute; top: -50%; right: -50%; width: 100%; height: 200%; background: rgba(255,255,255,0.1); transform: rotate(30deg); }
        .form-icon-wrapper { margin-bottom: 1rem; }
        .form-main-icon { font-size: 3rem; background: rgba(255,255,255,0.2); padding: 1rem; border-radius: 50%; margin-bottom: 1rem; }
        .form-body { padding: 2.5rem 2rem; }
        .input-group-icon { position: relative; }
        .form-icon { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: var(--bs-primary); transition: all 0.3s ease; }
        .input-focus-effect { border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; transition: all 0.3s ease; }
        .input-focus-effect:focus { border-color: var(--bs-primary); box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25); transform: translateY(-2px); }
        .input-focus-effect:focus + .form-icon { color: var(--bs-primary); transform: translateY(-50%) scale(1.1); }
        .form-label { font-weight: 600; color: #495057; margin-bottom: 0.5rem; display: flex; align-items: center; }
        .form-text { font-size: 0.85rem; color: #6c757d; margin-top: 0.5rem; display: flex; align-items: center; }
        .btn-back { border-radius: 10px; padding: 10px 20px; transition: all 0.3s ease; border: 2px solid #6c757d; }
        .btn-back:hover { background-color: #6c757d; color: white; transform: translateX(-5px); }
        .btn-cancel { border-radius: 10px; padding: 10px 20px; transition: all 0.3s ease; border: 2px solid var(--bs-danger); }
        .btn-cancel:hover { background-color: var(--bs-danger); color: white; transform: translateY(-2px); }
        .btn-submit { border-radius: 10px; padding: 10px 25px; font-weight: 600; transition: all 0.3s ease; position: relative; overflow: hidden; }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        .btn-submit:active { transform: translateY(0); }
        .alert { border: none; border-radius: 10px; }
        .alert-danger { border-left: 4px solid var(--bs-danger); }
        .alert-success { border-left: 4px solid var(--bs-success); }
        .info-card { border: none; border-radius: 15px; background: linear-gradient(135deg, #f8f9fa, #e9ecef); box-shadow: 0 5px 15px rgba(0,0,0,0.08); transition: transform 0.3s ease; }
        .info-card:hover { transform: translateY(-3px); }
        .badge { font-size: 0.75em; padding: 0.35em 0.65em; }
        .form-select { border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; transition: all 0.3s ease; }
        .form-select:focus { border-color: var(--bs-primary); box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25); transform: translateY(-2px); }
        textarea.input-focus-effect { resize: vertical; min-height: 100px; }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Perhatikan ID form disesuaikan: editPermohonanForm
            const form = document.getElementById('editPermohonanForm');
            const submitButton = document.getElementById('submitButton');
            const submitText = submitButton.querySelector('.submit-text');
            const loadingSpinner = submitButton.querySelector('.loading-spinner');

            // Efek loading saat submit form
            if(form){
                form.addEventListener('submit', function() {
                    submitText.style.display = 'none';
                    loadingSpinner.style.display = 'inline';
                    submitButton.disabled = true;
                    submitButton.classList.add('loading');
                });
            }

            // Efek hover untuk semua input
            const inputs = document.querySelectorAll('.input-focus-effect');
            inputs.forEach(input => {
                input.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                input.addEventListener('mouseleave', function() {
                    if (document.activeElement !== this) {
                        this.style.transform = 'translateY(0)';
                    }
                });
            });

            // Efek hover untuk select
            const selects = document.querySelectorAll('.form-select');
            selects.forEach(select => {
                select.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                select.addEventListener('mouseleave', function() {
                    if (document.activeElement !== this) {
                        this.style.transform = 'translateY(0)';
                    }
                });
            });

            // Auto-hide success alert
            const successAlert = document.querySelector('.alert-success');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.classList.add('animate__fadeOut');
                    setTimeout(() => {
                        successAlert.remove();
                    }, 1000);
                }, 5000);
            }

            // Real-time validation visual untuk status
            const statusSelect = document.getElementById('status');
            if(statusSelect){
                statusSelect.addEventListener('change', function() {
                    if (this.value) {
                        this.style.borderColor = 'var(--bs-success)';
                    } else {
                        this.style.borderColor = 'var(--bs-danger)';
                    }
                });
            }
        });
    </script>
@endsection
