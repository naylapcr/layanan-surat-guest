@extends('layouts.guest.app')

@section('content')
<div class="page-header">
    <div class="container text-center">
        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Catat Riwayat</h1>
        <p class="lead text-white animate__animated animate__fadeInUp">Tambahkan log aktivitas baru secara manual</p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card form-card animate__animated animate__fadeInUp">
                    {{-- Header Form --}}
                    <div class="form-header text-center">
                        <div class="form-icon-wrapper">
                            <i class="fas fa-clipboard-list form-main-icon"></i>
                        </div>
                        <h3 class="mb-0">Formulir Pencatatan Log</h3>
                        <p class="text-muted mt-2">Isi detail perubahan status surat</p>
                    </div>

                    {{-- Body Form --}}
                    <div class="form-body">
                        <form method="POST" action="{{ route('riwayat.store') }}" id="tambahRiwayatForm">
                            @csrf

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
                            @if(session('success'))
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

                            {{-- Field: Pilih Permohonan --}}
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label for="permohonan_id" class="form-label">
                                        <i class="fas fa-envelope-open-text me-2"></i>Nomor Permohonan Surat *
                                    </label>
                                    <div class="input-group-icon">
                                        <select name="permohonan_id" id="permohonan_id" class="form-select input-focus-effect" required>
                                            <option value="">-- Pilih Permohonan --</option>
                                            @foreach($permohonan as $p)
                                                <option value="{{ $p->permohonan_id }}" {{ old('permohonan_id') == $p->permohonan_id ? 'selected' : '' }}>
                                                    {{ $p->nomor_permohonan }}
                                                    {{-- Tampilkan nama warga jika relasi tersedia --}}
                                                    @if($p->warga) - {{ $p->warga->nama }} @endif
                                                </option>
                                            @endforeach
                                        </select>
                                        <i class="fas fa-chevron-down form-icon" style="font-size: 0.8rem;"></i>
                                    </div>
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Pilih surat yang statusnya akan diperbarui.
                                    </div>
                                </div>
                            </div>

                            {{-- Field: Status Baru & Petugas --}}
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="status" class="form-label">
                                        <i class="fas fa-tasks me-2"></i>Status Baru *
                                    </label>
                                    <div class="input-group-icon">
                                        <select name="status" id="status" class="form-select input-focus-effect" required>
                                            <option value="">-- Pilih Status --</option>
                                            <option value="DIAJUKAN" {{ old('status') == 'DIAJUKAN' ? 'selected' : '' }}>DIAJUKAN</option>
                                            <option value="DIPROSES" {{ old('status') == 'DIPROSES' ? 'selected' : '' }}>DIPROSES</option>
                                            <option value="SELESAI" {{ old('status') == 'SELESAI' ? 'selected' : '' }}>SELESAI</option>
                                            <option value="DITOLAK" {{ old('status') == 'DITOLAK' ? 'selected' : '' }}>DITOLAK</option>
                                        </select>
                                        <i class="fas fa-chevron-down form-icon" style="font-size: 0.8rem;"></i>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3 mt-md-0">
                                    <label for="petugas_warga_id" class="form-label">
                                        <i class="fas fa-user-shield me-2"></i>Petugas Pencatat *
                                    </label>
                                    <div class="input-group-icon">
                                        <select name="petugas_warga_id" id="petugas_warga_id" class="form-select input-focus-effect" required>
                                            <option value="">-- Pilih Petugas --</option>
                                            @foreach($warga as $w)
                                                {{-- Filter hanya warga tertentu jika perlu, atau tampilkan semua --}}
                                                <option value="{{ $w->warga_id }}" {{ old('petugas_warga_id') == $w->warga_id ? 'selected' : '' }}>
                                                    {{ $w->nama }} (NIK: {{ $w->nik ?? '-' }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <i class="fas fa-chevron-down form-icon" style="font-size: 0.8rem;"></i>
                                    </div>
                                </div>
                            </div>

                            {{-- Field: Keterangan --}}
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label for="keterangan" class="form-label">
                                        <i class="fas fa-comment-dots me-2"></i>Keterangan / Catatan *
                                    </label>
                                    <div class="input-group-icon">
                                        <textarea name="keterangan" class="form-control input-focus-effect" id="keterangan"
                                            rows="4" placeholder="Contoh: Berkas telah diverifikasi lengkap." required>{{ old('keterangan') }}</textarea>
                                        <i class="fas fa-align-left form-icon" style="top: 20px; transform: none;"></i>
                                    </div>
                                </div>
                            </div>

                            {{-- Footer Buttons --}}
                            <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                                <a href="{{ route('riwayat.index') }}" class="btn btn-outline-secondary btn-back">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                                <div class="d-flex gap-2">
                                    <button type="reset" class="btn btn-outline-danger btn-reset">
                                        <i class="fas fa-undo me-2"></i>Reset
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-submit" id="submitButton">
                                        <span class="submit-text">
                                            <i class="fas fa-save me-2"></i>Simpan Riwayat
                                        </span>
                                        <span class="loading-spinner" style="display: none;">
                                            <i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card info-card mt-4 animate__animated animate__fadeInUp" data-aos-delay="200">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-lightbulb text-warning me-3 fa-2x"></i>
                            <div>
                                <h5 class="card-title mb-2">Informasi Sistem</h5>
                                <p class="card-text mb-0 small">
                                    Pencatatan manual ini berguna jika terjadi kesalahan sistem atau pembaruan status susulan.
                                    Waktu pencatatan akan otomatis diisi dengan waktu saat ini.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- STYLE CSS (Konsisten dengan halaman lain) --}}
<style>
    /* Page Header Gradient */
    .page-header {
        background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%);
        padding: 5rem 0 3rem 0;
        margin-bottom: 0;
        border-radius: 0 0 50px 50px;
        box-shadow: 0 10px 30px rgba(13, 110, 253, 0.15);
    }

    /* Styling untuk form card */
    .form-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-top: -50px; /* Overlap effect */
    }
    .form-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }

    /* Header form styling */
    .form-header {
        background: linear-gradient(135deg, var(--bs-primary), #4a6bdf);
        color: white;
        padding: 2.5rem 2rem;
        position: relative;
        overflow: hidden;
    }
    .form-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 200%;
        background: rgba(255,255,255,0.1);
        transform: rotate(30deg);
    }

    .form-main-icon {
        font-size: 3rem;
        background: rgba(255,255,255,0.2);
        padding: 1rem;
        border-radius: 50%;
        margin-bottom: 1rem;
    }

    /* Form body styling */
    .form-body {
        padding: 2.5rem 2rem;
    }

    /* Input group dengan icon */
    .input-group-icon {
        position: relative;
    }
    .form-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--bs-primary);
        pointer-events: none;
        transition: all 0.3s ease;
    }

    /* Efek focus pada input */
    .input-focus-effect {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }
    .input-focus-effect:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25);
    }
    .input-focus-effect:focus + .form-icon {
        color: var(--bs-primary);
        transform: translateY(-50%) scale(1.1);
    }

    /* Label styling */
    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }
    .form-text {
        font-size: 0.85rem;
        color: #6c757d;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
    }

    /* Buttons */
    .btn-back {
        border-radius: 10px;
        padding: 10px 20px;
        border: 2px solid #6c757d;
    }
    .btn-back:hover {
        background-color: #6c757d;
        color: white;
    }

    .btn-reset {
        border-radius: 10px;
        padding: 10px 20px;
        border: 2px solid var(--bs-danger);
    }
    .btn-reset:hover {
        background-color: var(--bs-danger);
        color: white;
    }

    .btn-submit {
        border-radius: 10px;
        padding: 10px 25px;
        font-weight: 600;
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    /* Alert */
    .alert {
        border: none;
        border-radius: 10px;
    }
    .alert-danger { border-left: 4px solid var(--bs-danger); }
    .alert-success { border-left: 4px solid var(--bs-success); }

    /* Info Card */
    .info-card {
        border: none;
        border-radius: 15px;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: transform 0.3s ease;
    }
    .info-card:hover { transform: translateY(-3px); }

    /* Animation Loading */
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    .loading { animation: pulse 1.5s ease-in-out infinite; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('tambahRiwayatForm');
        const submitButton = document.getElementById('submitButton');
        const submitText = submitButton.querySelector('.submit-text');
        const loadingSpinner = submitButton.querySelector('.loading-spinner');

        // Efek loading saat submit form
        form.addEventListener('submit', function() {
            submitText.style.display = 'none';
            loadingSpinner.style.display = 'inline';
            submitButton.disabled = true;
            submitButton.classList.add('loading');
        });

        // Efek hover untuk semua input & select
        const inputs = document.querySelectorAll('.input-focus-effect, .form-select');
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

        // Reset form confirmation
        const resetButton = document.querySelector('.btn-reset');
        resetButton.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin mengosongkan semua isian form?')) {
                form.reset();
            }
        });
    });
</script>
@endsection
