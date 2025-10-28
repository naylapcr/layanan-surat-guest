{{-- start css --}}
@include('layouts.guest.css')
{{-- end css --}}

{{-- start header --}}
@include('layouts.guest.header')
{{-- end header --}}
    <!-- Content Start -->
     <div class="page-header">
        <div class="container text-center">
            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Edit Data Warga</h1>
            <p class="lead text-white animate__animated animate__fadeInUp">Edit Data Warga ke sistem</p>
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
                                Formulir Edit Data Warga
                            </h3>
                        </div>
                        <div class="form-body">
                            <form method="POST" action="{{ route('warga.update', $warga->warga_id) }}">
                                @csrf
                                @method('PUT')

                                @if($errors->any())
                                    <div class="alert alert-danger animate__animated animate__shakeX">
                                        <h5><i class="fas fa-exclamation-triangle me-2"></i>Terjadi Kesalahan</h5>
                                        <ul class="mb-0 mt-2">
                                            @foreach($errors->all() as $error)
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
                                                   value="{{ old('no_ktp', $warga->no_ktp) }}" required
                                                   placeholder="Masukkan nomor KTP">
                                            <i class="fas fa-id-card form-icon"></i>
                                        </div>
                                        <div class="form-text">Nomor KTP harus unik dan belum terdaftar</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nama" class="form-label">Nama Lengkap *</label>
                                        <div class="input-group-icon">
                                            <input type="text" class="form-control" id="nama" name="nama"
                                                   value="{{ old('nama', $warga->nama) }}" required
                                                   placeholder="Masukkan nama lengkap">
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
                                                <option value="L" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="P" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                            <i class="fas fa-venus-mars form-icon"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="agama" class="form-label">Agama *</label>
                                        <div class="input-group-icon">
                                            <select class="form-select" id="agama" name="agama" required>
                                                <option value="">Pilih Agama</option>
                                                <option value="Islam" {{ old('agama', $warga->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                                <option value="Kristen" {{ old('agama', $warga->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                <option value="Katolik" {{ old('agama', $warga->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                                <option value="Hindu" {{ old('agama', $warga->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                <option value="Buddha" {{ old('agama', $warga->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                                <option value="Konghucu" {{ old('agama', $warga->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
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
                                                   value="{{ old('pekerjaan', $warga->pekerjaan) }}" required
                                                   placeholder="Masukkan pekerjaan">
                                            <i class="fas fa-briefcase form-icon"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="telp" class="form-label">Nomor Telepon *</label>
                                        <div class="input-group-icon">
                                            <input type="text" class="form-control" id="telp" name="telp"
                                                   value="{{ old('telp', $warga->telp) }}" required
                                                   placeholder="Masukkan nomor telepon">
                                            <i class="fas fa-phone form-icon"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group-icon">
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="{{ old('email', $warga->email) }}"
                                               placeholder="Masukkan alamat email">
                                        <i class="fas fa-envelope form-icon"></i>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-5">
                                    <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-submit">
                                        <i class="fas fa-save me-2"></i>Perbarui Data
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

    {{-- footer start --}}
    @include('layouts.guest.footer')
    {{-- footer end --}}

    {{-- start js --}}
    @include('layouts.guest.js')
</body>
</html>
    {{-- end js --}}
