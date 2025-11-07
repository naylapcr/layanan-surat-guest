@extends('layouts.guest.app')

@section('content')
<!-- Content Start -->
    <div class="page-header">
        <div class="container text-center">
            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Tambah Data Warga</h1>
            <p class="lead text-white animate__animated animate__fadeInUp">Tambahkan Data Warga baru ke sistem</p>
        </div>
    </div>
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card form-card animate__animated animate__fadeInUp">
                    <div class="form-header text-center">
                        <div class="form-icon-wrapper">
                            <i class="fas fa-user-plus form-main-icon"></i>
                        </div>
                        <h3 class="mb-0">
                            Formulir Data Warga Baru
                        </h3>
                        <p class="text-muted mt-2">Isi informasi data warga dengan lengkap</p>
                    </div>
                    <div class="form-body">
                        <form method="POST" action="{{ route('warga.store') }}" id="tambahWargaForm">
                            @csrf

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

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="no_ktp" class="form-label">
                                    <i class="fas fa-id-card me-2"></i>Nomor KTP *
                                </label>
                                <div class="input-group-icon">
                                    <input type="text" class="form-control input-focus-effect" id="no_ktp" name="no_ktp"
                                        value="{{ old('no_ktp') }}" required placeholder="Masukkan nomor KTP">
                                    <i class="fas fa-id-card form-icon"></i>
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Nomor KTP harus unik dan belum terdaftar
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="nama" class="form-label">
                                    <i class="fas fa-user me-2"></i>Nama Lengkap *
                                </label>
                                <div class="input-group-icon">
                                    <input type="text" class="form-control input-focus-effect" id="nama" name="nama"
                                        value="{{ old('nama') }}" required placeholder="Masukkan nama lengkap">
                                    <i class="fas fa-user form-icon"></i>
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Nama lengkap sesuai KTP
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="jenis_kelamin" class="form-label">
                                    <i class="fas fa-venus-mars me-2"></i>Jenis Kelamin *
                                </label>
                                <div class="input-group-icon">
                                    <select class="form-select input-focus-effect" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                                            Laki-laki
                                        </option>
                                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                                            Perempuan
                                        </option>
                                    </select>
                                    <i class="fas fa-venus-mars form-icon"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="agama" class="form-label">
                                    <i class="fas fa-pray me-2"></i>Agama *
                                </label>
                                <div class="input-group-icon">
                                    <select class="form-select input-focus-effect" id="agama" name="agama" required>
                                        <option value="">Pilih Agama</option>
                                        <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam
                                        </option>
                                        <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>
                                            Kristen</option>
                                        <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>
                                            Katolik</option>
                                        <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu
                                        </option>
                                        <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>
                                            Buddha</option>
                                        <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>
                                            Konghucu
                                        </option>
                                    </select>
                                    <i class="fas fa-pray form-icon"></i>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="pekerjaan" class="form-label">
                                    <i class="fas fa-briefcase me-2"></i>Pekerjaan *
                                </label>
                                <div class="input-group-icon">
                                    <input type="text" class="form-control input-focus-effect" id="pekerjaan" name="pekerjaan"
                                        value="{{ old('pekerjaan') }}" required placeholder="Masukkan pekerjaan">
                                    <i class="fas fa-briefcase form-icon"></i>
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Pekerjaan saat ini
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-2"></i>Email
                                </label>
                                <div class="input-group-icon">
                                    <input type="email" class="form-control input-focus-effect" id="email" name="email"
                                        value="{{ old('email') }}" placeholder="Masukkan email">
                                    <i class="fas fa-envelope form-icon"></i>
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Alamat email (opsional)
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="no_telpon" class="form-label">
                                    <i class="fas fa-phone me-2"></i>No Telepon *
                                </label>
                                <div class="input-group-icon">
                                    <input type="text" class="form-control input-focus-effect" id="no_telpon" name="telp"
                                        value="{{ old('telp') }}" required placeholder="Masukkan nomor telepon">
                                    <i class="fas fa-phone form-icon"></i>
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Nomor telepon yang aktif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-step-indicator">
                                    <div class="step-progress">
                                        <div class="step-circle active">1</div>
                                        <div class="step-circle">2</div>
                                        <div class="step-circle">3</div>
                                    </div>
                                    <small class="text-muted mt-2">Langkah 1 dari 3 - Data Pribadi</small>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                            <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary btn-back">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                            </a>
                            <div class="d-flex gap-2">
                                <button type="reset" class="btn btn-outline-danger btn-reset">
                                    <i class="fas fa-undo me-2"></i>Reset
                                </button>
                                <button type="submit" class="btn btn-primary btn-submit" id="submitButton">
                                    <span class="submit-text">
                                        <i class="fas fa-save me-2"></i>Simpan Data Warga
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

                <!-- Info Card -->
                <div class="card info-card mt-4 animate__animated animate__fadeInUp" data-aos-delay="200">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-lightbulb text-warning me-3 fa-2x"></i>
                            <div>
                                <h5 class="card-title mb-2">Tips Pengisian</h5>
                                <p class="card-text mb-0 small">
                                    Pastikan semua data yang diisi sesuai dengan dokumen asli.
                                    Nomor KTP harus valid dan belum terdaftar sebelumnya.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content End -->

<style>
    /* Styling untuk form card */
    .form-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
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

    .btn-submit:active {
        transform: translateY(0);
    }

    /* Alert styling */
    .alert {
        border: none;
        border-radius: 10px;
    }

    .alert-danger {
        border-left: 4px solid var(--bs-danger);
    }

    .alert-success {
        border-left: 4px solid var(--bs-success);
    }

    /* Info card styling */
    .info-card {
        border: none;
        border-radius: 15px;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: transform 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-3px);
    }

    /* Step indicator styling */
    .form-step-indicator {
        text-align: center;
        padding: 1rem;
    }

    .step-progress {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 1rem;
        margin-bottom: 0.5rem;
    }

    .step-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #6c757d;
        transition: all 0.3s ease;
    }

    .step-circle.active {
        background: var(--bs-primary);
        color: white;
        transform: scale(1.1);
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Loading animation */
    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
        }
    }

    .loading {
        animation: pulse 1.5s ease-in-out infinite;
    }

    /* Select styling */
    .form-select {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }

    .form-select:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25);
        transform: translateY(-2px);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('tambahWargaForm');
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

        // Validasi real-time untuk NIK (hanya angka)
        const nikInput = document.getElementById('no_ktp');
        nikInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // Validasi real-time untuk telepon (hanya angka)
        const telpInput = document.getElementById('no_telpon');
        telpInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9+]/g, '');
        });

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

        // Auto-hide success alert setelah 5 detik
        const successAlert = document.querySelector('.alert-success');
        if (successAlert) {
            setTimeout(() => {
                successAlert.classList.add('animate__fadeOut');
                setTimeout(() => {
                    successAlert.remove();
                }, 1000);
            }, 5000);
        }

        // Real-time validation feedback
        const emailInput = document.getElementById('email');
        emailInput.addEventListener('blur', function() {
            if (this.value && !this.checkValidity()) {
                this.style.borderColor = 'var(--bs-danger)';
            } else if (this.value) {
                this.style.borderColor = 'var(--bs-success)';
            }
        });

        // Character counter untuk NIK
        const updateNikCount = () => {
            const count = nikInput.value.length;
            const counter = document.getElementById('nikCount') || (() => {
                const counterEl = document.createElement('div');
                counterEl.id = 'nikCount';
                counterEl.className = 'form-text text-end';
                nikInput.parentNode.appendChild(counterEl);
                return counterEl;
            })();

            counter.textContent = `${count} digit`;

            if (count === 16) {
                counter.style.color = 'var(--bs-success)';
            } else if (count > 0) {
                counter.style.color = 'var(--bs-warning)';
            } else {
                counter.style.color = '#6c757d';
            }
        };

        nikInput.addEventListener('input', updateNikCount);
        updateNikCount(); // Initial call

        // Reset form confirmation
        const resetButton = document.querySelector('.btn-reset');
        resetButton.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin mengosongkan semua data yang telah diisi?')) {
                form.reset();
                updateNikCount();
            }
        });
    });
</script>

@endsection
