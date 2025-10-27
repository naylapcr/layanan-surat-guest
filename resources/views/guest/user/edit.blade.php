{{-- start css --}}
@include('layouts.guest.css')
{{-- end css --}}

{{-- start header --}}
@include('layouts.guest.header')
{{-- end header --}}
    <!-- Content Start -->
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
                            <h3 class="mb-0">
                                <i class="fas fa-user-edit me-2"></i>
                                Formulir Edit User
                            </h3>
                        </div>
                        <div class="form-body">
                            <form action="{{ route('user.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" value="{{ old('name', $user->name) }}"
                                               placeholder="Masukkan nama lengkap" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-4">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               id="email" name="email" value="{{ old('email', $user->email) }}"
                                               placeholder="Masukkan alamat email" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="position-relative">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                   id="password" name="password"
                                                   placeholder="Kosongkan jika tidak ingin mengubah">
                                            <span class="password-toggle" onclick="togglePassword('password')">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="password-note">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Biarkan kosong jika tidak ingin mengubah password
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                        <div class="position-relative">
                                            <input type="password" class="form-control"
                                                   id="password_confirmation" name="password_confirmation"
                                                   placeholder="Konfirmasi password baru">
                                            <span class="password-toggle" onclick="togglePassword('password_confirmation')">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('user.index') }}" class="btn btn-secondary">
                                                <i class="fas fa-arrow-left me-2"></i>Kembali
                                            </a>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-2"></i>Perbarui User
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content End -->

    {{-- start footer --}}
    @include('layouts.guest.footer')
{{-- end footer --}}

{{-- start js --}}
    @include('layouts.guest.js')
</body>
</html>
{{-- end js --}}
