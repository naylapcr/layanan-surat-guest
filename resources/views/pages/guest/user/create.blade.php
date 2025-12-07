@extends('layouts.guest.app')

@section('content')
{{-- start main content --}}
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
                                    </div>
                                </div>

                                {{-- Bagian Tambahan: Opsi Role User --}}
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <label for="role" class="form-label">
                                            <i class="fas fa-user-tag me-2"></i>Role User *
                                        </label>
                                        <div class="input-group-icon">
                                            <select name="role" id="role" class="form-control input-focus-effect @error('role') is-invalid @enderror" required>
                                                <option value="" disabled selected>Pilih Role User</option>
                                                <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                                <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                                                <option value="guest" {{ old('role') == 'guest' ? 'selected' : '' }}>Guest</option>
                                            </select>
                                        </div>
                                        @error('role')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Tentukan hak akses sesuai tingkatan user
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
                                    </div>
                                    <div class="col-md-6">
                                        <label for="password_confirmation" class="form-label">
                                            <i class="fas fa-lock me-2"></i>Konfirmasi Password *
                                        </label>
                                        <div class="input-group-icon">
                                            <input type="password" class="form-control input-focus-effect"
                                                   id="password_confirmation" name="password_confirmation" required
                                                   placeholder="Konfirmasi password">
                                            <i class="fas fa-lock form-icon"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                                    <a href="{{ route('user.index') }}" class="btn btn-outline-secondary btn-back">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali
                                    </a>
                                    <div class="d-flex gap-2">
                                        <button type="reset" class="btn btn-outline-danger btn-reset">
                                            <i class="fas fa-undo me-2"></i>Reset
                                        </button>
                                        <button type="submit" class="btn btn-primary btn-submit" id="submitButton">
                                            <span class="submit-text">
                                                <i class="fas fa-save me-2"></i>Simpan User
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
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
