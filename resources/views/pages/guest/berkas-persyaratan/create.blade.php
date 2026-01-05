@extends('layouts.guest.app')

@section('content')
    {{-- Header Halaman --}}
    <div class="page-header">
        <div class="container text-center">
            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">
                <i class="fas fa-file-upload me-2 opacity-50"></i>Tambah Berkas
            </h1>
            <p class="lead text-white animate__animated animate__fadeInUp">
                Upload dokumen persyaratan untuk permohonan surat
            </p>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    {{-- Form Card --}}
                    <div class="card form-card animate__animated animate__fadeInUp">
                        <div class="form-header">
                            <h4 class="mb-0 fw-bold"><i class="fas fa-paperclip me-2"></i>Formulir Upload</h4>
                        </div>

                        <div class="form-body">
                            <form action="{{ route('berkas.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                {{-- Pilihan Permohonan (LOGIKA YANG SUDAH DIPERBAIKI) --}}
                                <div class="mb-4 input-group-icon">
                                    <label for="permohonan_id" class="form-label">
                                        <i class="fas fa-envelope-open-text text-primary me-2"></i>Pilih Permohonan
                                    </label>
                                    <select name="permohonan_id" id="permohonan_id"
                                            class="form-select input-focus-effect @error('permohonan_id') is-invalid @enderror">
                                        <option value="">-- Pilih Nomor Permohonan --</option>
                                        @foreach($permohonan as $p)
                                            <option value="{{ $p->permohonan_id }}" {{ old('permohonan_id') == $p->permohonan_id ? 'selected' : '' }}>
                                                #{{ $p->nomor_permohonan }} - {{ $p->warga->nama ?? 'Tanpa Nama' }} ({{ $p->jenisSurat->nama_jenis ?? '-' }})
                                            </option>
                                        @endforeach
                                    </select>
                                    {{-- Icon panah absolute position dari CSS partial --}}
                                    <i class="fas fa-chevron-down form-icon" style="pointer-events: none;"></i>

                                    @error('permohonan_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Nama Berkas --}}
                                <div class="mb-4 input-group-icon">
                                    <label for="nama_berkas" class="form-label">
                                        <i class="fas fa-tag text-primary me-2"></i>Nama Berkas
                                    </label>
                                    <input type="text" name="nama_berkas" id="nama_berkas"
                                           class="form-control input-focus-effect @error('nama_berkas') is-invalid @enderror"
                                           placeholder="Contoh: KTP, KK, atau Surat Pengantar"
                                           value="{{ old('nama_berkas') }}">
                                    <i class="fas fa-pen form-icon"></i>
                                    @error('nama_berkas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Upload File --}}
                                <div class="mb-5">
                                    <label for="file" class="form-label">
                                        <i class="fas fa-cloud-upload-alt text-primary me-2"></i>Upload File
                                    </label>
                                    <div class="input-group">
                                        <input type="file" name="file" id="file"
                                               class="form-control input-focus-effect @error('file') is-invalid @enderror"
                                               accept=".pdf,.jpg,.jpeg,.png">
                                        <label class="input-group-text bg-light" for="file">
                                            <i class="fas fa-folder-open"></i>
                                        </label>
                                    </div>
                                    <div class="form-text text-muted small mt-2">
                                        <i class="fas fa-info-circle me-1"></i>Format: PDF, JPG, PNG (Maks. 2MB)
                                    </div>
                                    @error('file')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Tombol Aksi --}}
                                <div class="d-flex justify-content-between pt-3 border-top">
                                    <a href="{{ route('berkas.index') }}" class="btn btn-back">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-submit text-white">
                                        <i class="fas fa-save me-2"></i>Simpan Berkas
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
