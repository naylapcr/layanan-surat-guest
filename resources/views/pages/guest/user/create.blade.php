@extends('layouts.guest.app')

@section('content')
{{-- start main content --}}
    <!-- Content Start -->
     <div class="page-header">
        <div class="container text-center">
            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Data User</h1>
            <p class="lead text-white animate__animated animate__fadeInUp">Tambahkan Data User baru ke sistem</p>
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
                                Formulir Tambah User Baru
                            </h3>
                            <p class="text-muted mt-2">Isi informasi data user dengan lengkap</p>
                        </div>
                        <div class="form-body">
                            <form method="POST" action="{{ route('user.store') }}" id="tambahUserForm">
                                @csrf

                                @if($errors->any())
                                    <div class="alert alert-danger animate__animated animate__shakeX" role="alert">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-exclamation-triangle me-3 fa-lg"></i>
                                            <div>
                                                <h5 class="alert-heading mb-2">Terjadi Kesalahan</h5>
                                                <ul class="mb-0 ps-3">
                                                    @foreach($errors->all() as $error)
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
                                    <div class="col-md-12">
                                        <label for="name" class="form-label">
                                            <i class="fas fa-user me-2"></i>Nama Lengkap *
                                        </label>
                                        <div class="input-group-icon">
                                            <input type="text" class="form-control input-focus-effect @error('name') is-invalid @enderror"
                                                   id="name" name="name" value="{{ old('name') }}" required
                                                   placeholder="Masukkan nama lengkap user">
                                            <i class="fas fa-user form-icon"></i>
                                        </div>
                                        @error('name')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Nama lengkap user
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <label for="email" class="form-label">
                                            <i class="fas fa-envelope me-2"></i>Email *
                                        </label>
                                        <div class="input-group-icon">
                                            <input type="email" class="form-control input-focus-effect @error('email') is-invalid @enderror"
                                                   id="email" name="email" value="{{ old('email') }}" required
                                                   placeholder="Masukkan alamat email">
                                            <i class="fas fa-envelope form-icon"></i>
                                        </div>
                                        @error('email')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Alamat email yang aktif
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="password" class="form-label">
                                            <i class="fas fa-lock me-2"></i>Password *
                                        </label>
                                        <div class="input-group-icon">
                                            <input type="password" class="form-control input-focus-effect @error('password') is-invalid @enderror"
                                                   id="password" name="password" required
                                                   placeholder="Masukkan password">
                                            <i class="fas fa-lock form-icon"></i>
                                            <span class="password-toggle" onclick="togglePassword('password')">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Minimal 8 karakter dengan kombinasi huruf dan angka
                                        </div>
                                        <div class="password-strength mt-2">
                                            <div class="strength-bar">
                                                <div class="strength-fill" id="passwordStrength"></div>
                                            </div>
                                            <small class="text-muted" id="passwordText">Kekuatan password</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="password_confirmation" class="form-label">
                                            <i class="fas fa-lock me-2"></i>Konfirmasi Password *
                                        </label>
                                        <div class="input-group-icon">
                                            <input type="password" class="form-control input-focus-effect @error('password_confirmation') is-invalid @enderror"
                                                   id="password_confirmation" name="password_confirmation" required
                                                   placeholder="Konfirmasi password">
                                            <i class="fas fa-lock form-icon"></i>
                                            <span class="password-toggle" onclick="togglePassword('password_confirmation')">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                        </div>
                                        @error('password_confirmation')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Ulangi password untuk konfirmasi
                                        </div>
                                        <div class="password-match mt-2">
                                            <small class="text-muted" id="passwordMatchText">Password belum cocok</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-info">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle me-3 fa-lg"></i>
                                        <div>
                                            <h6 class="alert-heading mb-2">Informasi Penting</h6>
                                            <p class="mb-0">Pastikan password memiliki minimal 8 karakter dan mengandung kombinasi huruf besar, huruf kecil, dan angka untuk keamanan yang lebih baik.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <!-- Spacer untuk alignment -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-step-indicator">
                                            <div class="step-progress">
                                                <div class="step-circle active">1</div>
                                                <div class="step-circle">2</div>
                                                <div class="step-circle">3</div>
                                            </div>
                                            <small class="text-muted mt-2">Langkah 1 dari 3 - Data User</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                                    <a href="{{ route('user.index') }}" class="btn btn-outline-secondary btn-back">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                                    </a>
                                    <div class="d-flex gap-2">
                                        <button type="reset" class="btn btn-outline-danger btn-reset">
                                            <i class="fas fa-undo me-2"></i>Reset
                                        </button>
                                        <button type="submit" class="btn btn-primary btn-submit" id="submitButton">
                                            <span class="submit-text">
                                                <i class="fas fa-save me-2"></i>Simpan User
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
                                        Gunakan email yang aktif untuk verifikasi dan pemulihan akun.
                                        Buat password yang kuat dengan kombinasi huruf besar, huruf kecil, angka, dan simbol.
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
{{-- end main content --}}

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

    /* Password toggle styling */
    .password-toggle {
        position: absolute;
        right: 45px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #6c757d;
        transition: all 0.3s ease;
        z-index: 3;
    }

    .password-toggle:hover {
        color: var(--bs-primary);
        transform: translateY(-50%) scale(1.1);
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

    .alert-info {
        border-left: 4px solid var(--bs-info);
        background: rgba(13, 202, 240, 0.05);
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
        background: #e9ecef;
        border: 2px solid #dee2e6;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #6c757d;
        transition: all 0.3s ease;
    }

    .step-circle.active {
        background: var(--bs-primary);
        border-color: var(--bs-primary);
        color: white;
        transform: scale(1.1);
    }

    /* Password strength indicator */
    .password-strength {
        margin-top: 0.5rem;
    }

    .strength-bar {
        width: 100%;
        height: 6px;
        background: #e9ecef;
        border-radius: 3px;
        overflow: hidden;
        margin-bottom: 0.25rem;
    }

    .strength-fill {
        height: 100%;
        width: 0%;
        border-radius: 3px;
        transition: all 0.3s ease;
    }

    .strength-weak {
        background: var(--bs-danger);
        width: 33%;
    }

    .strength-medium {
        background: var(--bs-warning);
        width: 66%;
    }

    .strength-strong {
        background: var(--bs-success);
        width: 100%;
    }

    /* Password match indicator */
    .password-match {
        margin-top: 0.5rem;
    }

    .match-success {
        color: var(--bs-success) !important;
        font-weight: 600;
    }

    .match-error {
        color: var(--bs-danger) !important;
        font-weight: 600;
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
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('tambahUserForm');
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

        // Password strength indicator
        const passwordInput = document.getElementById('password');
        const passwordStrength = document.getElementById('passwordStrength');
        const passwordText = document.getElementById('passwordText');

        passwordInput.addEventListener('input', function() {
            const value = this.value;
            let strength = 0;
            let text = 'Kekuatan password';

            if (value.length >= 8) strength += 1;
            if (value.match(/[a-z]/)) strength += 1;
            if (value.match(/[A-Z]/)) strength += 1;
            if (value.match(/[0-9]/)) strength += 1;
            if (value.match(/[^a-zA-Z0-9]/)) strength += 1;

            // Reset classes
            passwordStrength.className = 'strength-fill';

            if (value.length === 0) {
                passwordStrength.style.width = '0%';
                passwordText.textContent = 'Kekuatan password';
            } else if (strength <= 2) {
                passwordStrength.classList.add('strength-weak');
                passwordText.textContent = 'Lemah';
            } else if (strength <= 4) {
                passwordStrength.classList.add('strength-medium');
                passwordText.textContent = 'Sedang';
            } else {
                passwordStrength.classList.add('strength-strong');
                passwordText.textContent = 'Kuat';
            }
        });

        // Password match indicator
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const passwordMatchText = document.getElementById('passwordMatchText');

        confirmPasswordInput.addEventListener('input', function() {
            const password = passwordInput.value;
            const confirmPassword = this.value;

            if (confirmPassword.length === 0) {
                passwordMatchText.textContent = 'Password belum cocok';
                passwordMatchText.className = 'text-muted';
            } else if (password === confirmPassword) {
                passwordMatchText.textContent = 'Password cocok';
                passwordMatchText.className = 'match-success';
            } else {
                passwordMatchText.textContent = 'Password tidak cocok';
                passwordMatchText.className = 'match-error';
            }
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

        // Reset form confirmation
        const resetButton = document.querySelector('.btn-reset');
        resetButton.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin mengosongkan semua data yang telah diisi?')) {
                form.reset();
                passwordStrength.style.width = '0%';
                passwordText.textContent = 'Kekuatan password';
                passwordMatchText.textContent = 'Password belum cocok';
                passwordMatchText.className = 'text-muted';
            }
        });
    });

    // Password toggle function
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = field.parentNode.querySelector('.password-toggle i');

        if (field.type === 'password') {
            field.type = 'text';
            icon.className = 'fas fa-eye-slash';
        } else {
            field.type = 'password';
            icon.className = 'fas fa-eye';
        }
    }
</script>

@endsection


