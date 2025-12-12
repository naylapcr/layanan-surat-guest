@extends('layouts.guest.app')

@section('content')
    {{-- main content --}}
    <div class="page-header">
        <div class="container text-center">
            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Edit Data User</h1>
            <p class="lead text-white animate__animated animate__fadeInUp">Edit Data User ke sistem</p>
        </div>
    </div>
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card form-card animate__animated animate__fadeInUp">
                        <div class="form-header text-center">
                            <div class="form-icon-wrapper">
                                <i class="fas fa-user-edit form-main-icon"></i>
                            </div>
                            <h3 class="mb-0">
                                Formulir Edit User
                            </h3>
                            <p class="text-muted mt-2">Perbarui informasi data user</p>
                        </div>
                        <div class="form-body">
                            <form action="{{ route('user.update', $user->id) }}" method="POST" id="editUserForm"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

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

                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn"
                                        role="alert">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-check-circle me-3 fa-lg"></i>
                                            <div>
                                                <h5 class="alert-heading mb-2">Berhasil!</h5>
                                                <p class="mb-0">{{ session('success') }}</p>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <label for="name" class="form-label">
                                            <i class="fas fa-user me-2"></i>Nama Lengkap *
                                        </label>
                                        <div class="input-group-icon">
                                            <input type="text"
                                                class="form-control input-focus-effect @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name', $user->name) }}"
                                                placeholder="Masukkan nama lengkap" required>
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
                                            <input type="email"
                                                class="form-control input-focus-effect @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email', $user->email) }}"
                                                placeholder="Masukkan alamat email" required>
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
                                    <div class="col-md-12">
                                        <label for="role" class="form-label">
                                            <i class="fas fa-user-tag me-2"></i>Role User *
                                        </label>
                                        <div class="input-group-icon">
                                            <select name="role" id="role"
                                                class="form-control input-focus-effect @error('role') is-invalid @enderror"
                                                required>
                                                <option value="">-- Pilih Role --</option>
                                                <option value="super_admin"
                                                    {{ old('role', $user->role) == 'super_admin' ? 'selected' : '' }}>Super
                                                    Admin</option>
                                                <option value="staff"
                                                    {{ old('role', $user->role) == 'staff' ? 'selected' : '' }}>Staff
                                                </option>
                                                <option value="guest"
                                                    {{ old('role', $user->role) == 'guest' ? 'selected' : '' }}>Guest
                                                </option>
                                            </select>
                                            <i class="fas fa-user-tag form-icon"></i>
                                        </div>
                                        @error('role')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="password" class="form-label">
                                            <i class="fas fa-lock me-2"></i>Password
                                        </label>
                                        <div class="input-group-icon">
                                            <input type="password"
                                                class="form-control input-focus-effect @error('password') is-invalid @enderror"
                                                id="password" name="password"
                                                placeholder="Kosongkan jika tidak ingin mengubah">
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
                                            Biarkan kosong jika tidak ingin mengubah password
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="password_confirmation" class="form-label">
                                            <i class="fas fa-lock me-2"></i>Konfirmasi Password
                                        </label>
                                        <div class="input-group-icon">
                                            <input type="password" class="form-control input-focus-effect"
                                                id="password_confirmation" name="password_confirmation"
                                                placeholder="Konfirmasi password baru">
                                            <i class="fas fa-lock form-icon"></i>
                                            <span class="password-toggle"
                                                onclick="togglePassword('password_confirmation')">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                        </div>
                                        <div class="form-text">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Ulangi password baru untuk konfirmasi
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <label for="foto_profil" class="form-label">
                                            <i class="fas fa-camera me-2"></i>Foto Profil
                                        </label>

                                        @if ($user->foto_profil)
                                            <div class="mb-3">
                                                <img src="{{ asset('uploads/profile/' . $user->foto_profil) }}"
                                                    alt="Foto Profil" class="img-thumbnail rounded-circle"
                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                                <p class="small text-muted mt-1">Foto saat ini</p>
                                            </div>
                                        @endif

                                        <div class="input-group-icon">
                                            <input type="file"
                                                class="form-control input-focus-effect @error('foto_profil') is-invalid @enderror"
                                                id="foto_profil" name="foto_profil" accept="image/*">
                                            <i class="fas fa-image form-icon"></i>
                                        </div>
                                        <div class="form-text">Biarkan kosong jika tidak ingin mengubah foto profil.</div>
                                        @error('foto_profil')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                                    <a href="{{ route('user.index') }}" class="btn btn-outline-secondary btn-back">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                                    </a>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('user.index') }}" class="btn btn-outline-danger btn-cancel">
                                            <i class="fas fa-times me-2"></i>Batal
                                        </a>
                                        <button type="submit" class="btn btn-primary btn-submit" id="submitButton">
                                            <span class="submit-text">
                                                <i class="fas fa-save me-2"></i>Perbarui User
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

                    <!-- Current Data Card -->
                    <div class="card info-card mt-4 animate__animated animate__fadeInUp" data-aos-delay="200">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle text-info me-3 fa-2x"></i>
                                <div>
                                    <h5 class="card-title mb-2">Data Saat Ini</h5>
                                    <p class="card-text mb-1 small">
                                        <strong>Nama:</strong> {{ $user->name }}
                                    </p>
                                    <p class="card-text mb-1 small">
                                        <strong>Email:</strong> {{ $user->email }}
                                    </p>
                                    <p class="card-text mb-0 small">
                                        <strong>Terakhir diperbarui:</strong> {{ $user->updated_at->format('d M Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Content End --}}

    <style>
        /* Styling untuk form card */
        .form-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .form-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        /* Header form styling */
        .form-header {
            background: linear-gradient(135deg, var(--bs-warning), #ffc107);
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
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(30deg);
        }

        .form-icon-wrapper {
            margin-bottom: 1rem;
        }

        .form-main-icon {
            font-size: 3rem;
            background: rgba(255, 255, 255, 0.2);
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

        .input-focus-effect:focus+.form-icon {
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

        .btn-cancel {
            border-radius: 10px;
            padding: 10px 20px;
            transition: all 0.3s ease;
            border: 2px solid var(--bs-danger);
        }

        .btn-cancel:hover {
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-3px);
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
            const form = document.getElementById('editUserForm');
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

            // Real-time validation untuk email
            const emailInput = document.getElementById('email');
            emailInput.addEventListener('blur', function() {
                if (this.value && !this.checkValidity()) {
                    this.style.borderColor = 'var(--bs-danger)';
                } else if (this.value) {
                    this.style.borderColor = 'var(--bs-success)';
                }
            });

            // Password strength indicator
            const passwordInput = document.getElementById('password');
            if (passwordInput) {
                passwordInput.addEventListener('input', function() {
                    const value = this.value;
                    if (value.length > 0) {
                        if (value.length < 6) {
                            this.style.borderColor = 'var(--bs-danger)';
                        } else if (value.length < 8) {
                            this.style.borderColor = 'var(--bs-warning)';
                        } else {
                            this.style.borderColor = 'var(--bs-success)';
                        }
                    } else {
                        this.style.borderColor = '#e9ecef';
                    }
                });
            }
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
