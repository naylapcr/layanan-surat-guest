@extends('layouts.guest.app')

@section('content')
<div class="page-header">
    <div class="container text-center">
        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Tambah Persyaratan</h1>
        <p class="lead text-white animate__animated animate__fadeInUp">Tambahkan dokumen persyaratan baru ke sistem</p>
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
                            <i class="fas fa-file-circle-plus form-main-icon"></i>
                        </div>
                        <h3 class="mb-0">Formulir Persyaratan Baru</h3>
                        <p class="text-muted mt-2">Atur dokumen yang wajib dilampirkan warga</p>
                    </div>

                    {{-- Body Form --}}
                    <div class="form-body">
                        <form method="POST" action="{{ route('berkas.store') }}" id="tambahBerkasForm">
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

                            {{-- Field: Jenis Surat --}}
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label for="jenis_surat_id" class="form-label">
                                        <i class="fas fa-envelope-open-text me-2"></i>Berlaku untuk Surat
                                    </label>
                                    <div class="input-group-icon">
                                        <select name="jenis_surat_id" id="jenis_surat_id" class="form-select input-focus-effect">
                                            <option value="">-- Berlaku untuk Semua Jenis Surat (Umum) --</option>
                                            @foreach($jenisSurat as $jenis)
                                                <option value="{{ $jenis->id }}" {{ old('jenis_surat_id') == $jenis->id ? 'selected' : '' }}>
                                                    {{ $jenis->nama_jenis }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <i class="fas fa-chevron-down form-icon" style="font-size: 0.8rem;"></i>
                                    </div>
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Kosongkan jika persyaratan ini berlaku untuk semua jenis surat.
                                    </div>
                                </div>
                            </div>

                            {{-- Field: Nama Berkas --}}
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label for="nama_berkas" class="form-label">
                                        <i class="fas fa-file-signature me-2"></i>Nama Berkas Persyaratan *
                                    </label>
                                    <div class="input-group-icon">
                                        <input type="text" class="form-control input-focus-effect" id="nama_berkas" name="nama_berkas"
                                            value="{{ old('nama_berkas') }}" required placeholder="Contoh: Fotokopi KTP / Surat Pengantar RT">
                                        <i class="fas fa-pen form-icon"></i>
                                    </div>
                                </div>
                            </div>

                            {{-- Field: Deskripsi --}}
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label for="deskripsi" class="form-label">
                                        <i class="fas fa-align-left me-2"></i>Deskripsi / Keterangan
                                    </label>
                                    <div class="input-group-icon">
                                        <textarea name="deskripsi" class="form-control input-focus-effect" id="deskripsi"
                                            rows="3" placeholder="Contoh: Format PDF/JPG, maksimal 2MB">{{ old('deskripsi') }}</textarea>
                                        <i class="fas fa-comment-alt form-icon" style="top: 20px; transform: none;"></i>
                                    </div>
                                </div>
                            </div>

                            {{-- Field: Wajib / Tidak (Switch) --}}
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="bg-light p-3 rounded-3 border border-dashed d-flex align-items-center justify-content-between">
                                        <div>
                                            <label class="form-label mb-0 text-dark">
                                                <i class="fas fa-exclamation-circle me-2 text-danger"></i>Wajib Diupload?
                                            </label>
                                            <small class="text-muted d-block">Jika aktif, warga tidak bisa mengajukan surat tanpa file ini.</small>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="is_required" name="is_required" value="1"
                                                {{ old('is_required') ? 'checked' : '' }} style="width: 3em; height: 1.5em; cursor: pointer;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Footer Buttons --}}
                            <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                                <a href="{{ route('berkas.index') }}" class="btn btn-outline-secondary btn-back">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                                <div class="d-flex gap-2">
                                    <button type="reset" class="btn btn-outline-danger btn-reset">
                                        <i class="fas fa-undo me-2"></i>Reset
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-submit" id="submitButton">
                                        <span class="submit-text">
                                            <i class="fas fa-save me-2"></i>Simpan Data
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
                                    Persyaratan yang Anda tambahkan di sini akan muncul di formulir pengajuan surat warga.
                                    Pastikan nama berkas jelas agar warga mudah memahaminya.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- STYLE CSS (Sama persis dengan Data Warga) --}}
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
        margin-top: -50px; /* Overlap header effect */
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

    .form-icon-wrapper {
        margin-bottom: 1rem;
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
        transition: all 0.3s ease;
        pointer-events: none; /* Agar klik tembus ke input */
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
        transform: translateY(-2px);
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

    /* Form text styling */
    .form-text {
        font-size: 0.85rem;
        color: #6c757d;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
    }

    /* Button styling */
    .btn-back {
        border-radius: 10px;
        padding: 10px 20px;
        transition: all 0.3s ease;
        border: 2px solid #6c757d;
    }

    .btn-back:hover {
        background-color: #6c757d;
        color: white;
        transform: translateX(-5px);
    }

    .btn-reset {
        border-radius: 10px;
        padding: 10px 20px;
        transition: all 0.3s ease;
        border: 2px solid var(--bs-danger);
    }

    .btn-reset:hover {
        background-color: var(--bs-danger);
        color: white;
        transform: translateY(-2px);
    }

    .btn-submit {
        border-radius: 10px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    /* Alert styling */
    .alert {
        border: none;
        border-radius: 10px;
    }
    .alert-danger { border-left: 4px solid var(--bs-danger); }
    .alert-success { border-left: 4px solid var(--bs-success); }

    /* Info card styling */
    .info-card {
        border: none;
        border-radius: 15px;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: transform 0.3s ease;
    }
    .info-card:hover { transform: translateY(-3px); }

    /* Animations */
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    .loading { animation: pulse 1.5s ease-in-out infinite; }
</style>

{{-- JAVASCRIPT LOGIC --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('tambahBerkasForm');
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

        // Efek hover untuk semua input
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

        // Reset form confirmation
        const resetButton = document.querySelector('.btn-reset');
        resetButton.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin mengosongkan formulir?')) {
                form.reset();
            }
        });
    });
</script>
@endsection
