@extends('layouts.guest')

@section('title', isset($dataWarga) ? 'Edit Warga - Bina Desa' : 'Tambah Warga - Bina Desa')

@section('content')
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="display-5 mb-0">{{ isset($dataWarga) ? 'Edit Data Warga' : 'Tambah Data Warga' }}</h1>
                <p class="mb-0">{{ isset($dataWarga) ? 'Ubah data warga yang sudah ada' : 'Tambahkan data warga baru' }}</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <form method="POST" action="{{ isset($dataWarga) ? route('warga.update', $dataWarga->warga_id) : route('warga.store') }}">
                            @csrf
                            @if(isset($dataWarga))
                                @method('PUT')
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="no_ktp" class="form-label">Nomor KTP *</label>
                                    <input type="text" class="form-control" id="no_ktp" name="no_ktp"
                                           value="{{ old('no_ktp', $dataWarga->no_ktp ?? '') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap *</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                           value="{{ old('nama', $dataWarga->nama ?? '') }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin *</label>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L" {{ (old('jenis_kelamin', $dataWarga->jenis_kelamin ?? '') == 'L') ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ (old('jenis_kelamin', $dataWarga->jenis_kelamin ?? '') == 'P') ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="agama" class="form-label">Agama *</label>
                                    <input type="text" class="form-control" id="agama" name="agama"
                                           value="{{ old('agama', $dataWarga->agama ?? '') }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="pekerjaan" class="form-label">Pekerjaan *</label>
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                           value="{{ old('pekerjaan', $dataWarga->pekerjaan ?? '') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="telp" class="form-label">Nomor Telepon *</label>
                                    <input type="text" class="form-control" id="telp" name="telp"
                                           value="{{ old('telp', $dataWarga->telp ?? '') }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{{ old('email', $dataWarga->email ?? '') }}" required>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('warga.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>{{ isset($dataWarga) ? 'Update' : 'Simpan' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
