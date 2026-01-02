@extends('layouts.guest.app')

@section('content')
<div class="page-header">
    <div class="container text-center">
        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Edit Berkas</h1>
        <p class="lead text-white animate__animated animate__fadeInUp">Perbarui status validasi berkas</p>
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
                            <i class="fas fa-edit form-main-icon"></i>
                        </div>
                        <h3 class="mb-0">Edit Data Berkas</h3>
                        <p class="text-muted mt-2">Ubah nama atau status validasi</p>
                    </div>

                    {{-- Body Form --}}
                    <div class="form-body">
                        {{--
                            PERBAIKAN PENTING:
                            Menggunakan $berkas->berkas_id karena Primary Key di Model Anda adalah 'berkas_id'.
                            Jika menggunakan $berkas->id akan error karena nilainya null.
                        --}}
                        <form action="{{ route('berkas.update', $berkas->berkas_id) }}" method="POST">
                            @csrf
                            @method('PUT')

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

                            {{-- Field: Nama Berkas (Sesuai Controller: $request->nama_berkas) --}}
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label for="nama_berkas" class="form-label">
                                        <i class="fas fa-file-signature me-2"></i>Nama Berkas *
                                    </label>
                                    <div class="input-group-icon">
                                        <input type="text" class="form-control input-focus-effect" id="nama_berkas" name="nama_berkas"
                                            value="{{ old('nama_berkas', $berkas->nama_berkas) }}" required>
                                        <i class="fas fa-pen form-icon"></i>
                                    </div>
                                </div>
                            </div>

                            {{-- Field: Status Validasi (Sesuai Controller: $request->valid) --}}
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label for="valid" class="form-label">
                                        <i class="fas fa-check-circle me-2"></i>Status Validasi *
                                    </label>
                                    <div class="input-group-icon">
                                        <select name="valid" id="valid" class="form-select input-focus-effect">
                                            <option value="0" {{ old('valid', $berkas->valid) == 0 ? 'selected' : '' }}>
                                                Belum Valid / Perlu Perbaikan
                                            </option>
                                            <option value="1" {{ old('valid', $berkas->valid) == 1 ? 'selected' : '' }}>
                                                Valid (Disetujui)
                                            </option>
                                        </select>
                                        <i class="fas fa-chevron-down form-icon" style="font-size: 0.8rem;"></i>
                                    </div>
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Ubah status menjadi Valid jika berkas sudah sesuai.
                                    </div>
                                </div>
                            </div>

                            {{-- Tampilkan Link File (Opsional, hanya untuk melihat) --}}
                            @if($berkas->media)
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <label class="form-label">File Terlampir</label>
                                        <div class="bg-light p-3 rounded border border-dashed text-center">
                                            <a href="{{ asset('uploads/' . $berkas->media->file_url) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-download me-2"></i>Lihat File Saat Ini
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- Footer Buttons --}}
                            <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                                <a href="{{ route('berkas.index') }}" class="btn btn-outline-secondary btn-back">
                                    <i class="fas fa-arrow-left me-2"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-primary btn-submit">
                                    <i class="fas fa-save me-2"></i>Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- STYLE CSS (Sama dengan halaman Create) --}}
<style>
    .page-header {
        background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%);
        padding: 5rem 0 3rem 0;
        margin-bottom: 0;
        border-radius: 0 0 50px 50px;
        box-shadow: 0 10px 30px rgba(13, 110, 253, 0.15);
    }
    .form-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-top: -50px;
    }
    .form-header {
        background: linear-gradient(135deg, var(--bs-primary), #4a6bdf);
        color: white;
        padding: 2.5rem 2rem;
    }
    .form-main-icon {
        font-size: 3rem;
        background: rgba(255,255,255,0.2);
        padding: 1rem;
        border-radius: 50%;
        margin-bottom: 1rem;
    }
    .form-body {
        padding: 2.5rem 2rem;
    }
    .input-group-icon {
        position: relative;
    }
    .form-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--bs-primary);
        pointer-events: none;
    }
    .input-focus-effect {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }
    .input-focus-effect:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25);
    }
    .btn-submit {
        border-radius: 10px;
        padding: 10px 25px;
        font-weight: 600;
    }
    .btn-back {
        border-radius: 10px;
        padding: 10px 20px;
    }
    .alert {
        border: none;
        border-radius: 10px;
        border-left: 4px solid var(--bs-danger);
    }
</style>
@endsection
