{{-- start css --}}
@include('layouts.guest.css')
{{-- end css --}}

{{-- start header --}}
@include('layouts.guest.header')
{{-- end header --}}
<!-- Content Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card form-card animate__animated animate__fadeInUp">
                    <div class="form-header text-center">
                        <h3 class="mb-0">
                            <i class="fas fa-user-plus me-2"></i>
                            Formulir Data Warga Baru
                        </h3>
                    </div>
                    <div class="form-body">
                        <form method="POST" action="{{ route('warga.store') }}">
                            @csrf
                        </form>
                        @if ($errors->any())
                            <div class="alert alert-danger animate__animated animate__shakeX">
                                <h5><i class="fas fa-exclamation-triangle me-2"></i>Terjadi Kesalahan</h5>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="no_ktp" class="form-label">Nomor KTP *</label>
                                <div class="input-group-icon">
                                    <input type="text" class="form-control" id="no_ktp" name="no_ktp"
                                        value="{{ old('no_ktp') }}" required placeholder="Masukkan nomor KTP">
                                    <i class="fas fa-id-card form-icon"></i>
                                </div>
                                <div class="form-text">Nomor KTP harus unik dan belum terdaftar</div>
                            </div>
                            <div class="col-md-6">
                                <label for="nama" class="form-label">Nama Lengkap *</label>
                                <div class="input-group-icon">
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ old('nama') }}" required placeholder="Masukkan nama lengkap">
                                    <i class="fas fa-user form-icon"></i>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin *</label>
                                <div class="input-group-icon">
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
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
                                <label for="agama" class="form-label">Agama *</label>
                                <div class="input-group-icon">
                                    <select class="form-select" id="agama" name="agama" required>
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
                                <label for="pekerjaan" class="form-label">Pekerjaan *</label>
                                <div class="input-group-icon">
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                        value="{{ old('pekerjaan') }}" required placeholder="Masukkan pekerjaan">
                                    <i class="fas fa-briefcase form-icon"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group-icon">
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" placeholder="Masukkan email">
                                    <i class="fas fa-envelope form-icon"></i>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="no_telpon" class="form-label">No Telpon *</label>
                                <div class="input-group-icon">
                                    <input type="text" class="form-control" id="no_telpon" name="telp"
                                        value="{{ old('telp') }}" required placeholder="Masukkan nomor telpon">
                                    <i class="fas fa-phone form-icon"></i>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                            </a>
                            <button type="submit" class="btn btn-primary btn-submit">
                                <i class="fas fa-save me-2"></i>Simpan Data Warga
                            </button>
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
{{-- end js --}}
