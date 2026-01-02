@extends('layouts.guest.app')

@section('content')
    {{-- 1. HEADER MODERN --}}
    <div class="page-header-modern animate__animated animate__fadeIn">
        <div class="container text-center">
            <h1 class="display-4 text-white mb-3 animate__animated animate__slideInDown">
                Detail Berkas
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-modern justify-content-center mb-0 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fas fa-home me-1"></i>Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('berkas.index') }}">Berkas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">

                {{-- KOLOM KIRI: Preview File --}}
                <div class="col-lg-8 animate__animated animate__fadeInUp" data-wow-delay="0.1s">

                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-shape bg-primary text-white rounded-circle me-3 p-3 shadow-sm">
                            <i class="fas fa-file-contract fa-2x"></i>
                        </div>
                        <div>
                            <h2 class="mb-0 fw-bold">{{ $berkas->nama_berkas }}</h2>
                            <small class="text-muted">Diunggah {{ $berkas->created_at->isoFormat('D MMMM Y, HH:mm') }} WIB</small>
                        </div>
                    </div>

                    {{-- Card Preview File --}}
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                        <div class="card-header bg-white py-3 border-bottom">
                            <h5 class="m-0 text-primary"><i class="fas fa-eye me-2"></i>Pratinjau Dokumen</h5>
                        </div>
                        <div class="card-body p-0 bg-light text-center">
                            @if($berkas->media && $berkas->media->count() > 0)
                                @php
                                    $media = $berkas->media->first();
                                    $fileUrl = asset('uploads/' . $media->file_url);
                                    $ext = pathinfo($media->file_url, PATHINFO_EXTENSION);
                                    $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif']);
                                    $isPdf = strtolower($ext) == 'pdf';
                                @endphp

                                <div class="p-4">
                                    @if($isImage)
                                        <img src="{{ $fileUrl }}" alt="Preview" class="img-fluid rounded shadow-sm" style="max-height: 500px;">
                                    @elseif($isPdf)
                                        <iframe src="{{ $fileUrl }}" style="width:100%; height:500px; border:none;" class="rounded shadow-sm"></iframe>
                                    @else
                                        <div class="py-5">
                                            <i class="fas fa-file-alt fa-5x text-secondary mb-3"></i>
                                            <p class="text-muted">File ini tidak dapat dipratinjau langsung.</p>
                                            <a href="{{ $fileUrl }}" class="btn btn-primary mt-2" download>
                                                <i class="fas fa-download me-2"></i>Download File
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                {{-- Footer Card untuk Info File --}}
                                <div class="bg-white p-3 border-top text-start">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="text-muted d-block">Nama File Fisik</small>
                                            <span class="fw-bold text-dark">{{ $media->file_url }}</span>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Tipe</small>
                                            <span class="badge bg-secondary">{{ strtoupper($ext) }}</span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="py-5">
                                    <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                                    <p class="text-muted">File fisik tidak ditemukan di server.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Tombol Navigasi --}}
                    <div class="mt-4">
                        <a href="{{ route('berkas.index') }}" class="btn btn-outline-secondary me-2">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

                {{-- KOLOM KANAN: Status & Info --}}
                <div class="col-lg-4 animate__animated animate__fadeInUp" data-wow-delay="0.3s">

                    {{-- Card Status --}}
                    <div class="card border-0 shadow rounded-3 mb-4 overflow-hidden">
                        <div class="card-header py-3 text-center
                            @if($berkas->valid) bg-success @else bg-warning @endif">
                            <h5 class="text-white m-0">Status Validasi</h5>
                        </div>
                        <div class="card-body text-center p-4">
                            <div class="status-icon mb-3">
                                @if($berkas->valid)
                                    <i class="fas fa-check-circle fa-4x text-success"></i>
                                @else
                                    <i class="fas fa-hourglass-half fa-4x text-warning"></i>
                                @endif
                            </div>
                            <h3 class="fw-bold @if($berkas->valid) text-success @else text-warning @endif">
                                {{ $berkas->valid ? 'VALID' : 'BELUM VALID' }}
                            </h3>
                            <p class="text-muted small mb-4">
                                {{ $berkas->valid ? 'Dokumen ini telah disetujui.' : 'Dokumen ini perlu diperiksa.' }}
                            </p>

                            {{-- Tombol Aksi Cepat (Ubah Status) --}}
                            <form action="{{ route('berkas.update', $berkas->id ?? $berkas->berkas_id) }}" method="POST">
                                @csrf @method('PUT')
                                <input type="hidden" name="nama_berkas" value="{{ $berkas->nama_berkas }}">

                                @if(!$berkas->valid)
                                    <input type="hidden" name="valid" value="1">
                                    <button type="submit" class="btn btn-success w-100 shadow-sm">
                                        <i class="fas fa-check me-2"></i>Validasi Sekarang
                                    </button>
                                @else
                                    <input type="hidden" name="valid" value="0">
                                    <button type="submit" class="btn btn-outline-warning w-100">
                                        <i class="fas fa-times me-2"></i>Batalkan Validasi
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>

                    {{-- Card Informasi Terkait --}}
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h6 class="m-0 fw-bold"><i class="fas fa-info-circle me-2"></i>Informasi Terkait</h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0 pb-3">
                                    <small class="text-muted d-block mb-1">Nomor Permohonan</small>
                                    <div class="d-flex align-items-center">
                                        <div class="icon-square bg-light text-primary rounded me-2" style="width:30px;height:30px;display:flex;align-items:center;justify-content:center;">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        @if($berkas->permohonan)
                                            <a href="{{ route('permohonan-surat.show', $berkas->permohonan_id) }}" class="fw-bold text-decoration-none">
                                                {{ $berkas->permohonan->nomor_permohonan }}
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </div>
                                </li>
                                <li class="list-group-item px-0 py-3">
                                    <small class="text-muted d-block mb-1">Nama Pemohon</small>
                                    <span class="fw-bold">
                                        {{ $berkas->permohonan->warga->nama ?? 'Tidak Diketahui' }}
                                    </span>
                                </li>
                                <li class="list-group-item px-0 pt-3 border-bottom-0">
                                    <div class="d-grid">
                                        <a href="{{ route('berkas.edit', $berkas->id ?? $berkas->berkas_id) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-edit me-2"></i>Edit Informasi
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Style Tambahan untuk Icon --}}
    <style>
        .icon-shape {
            width: 60px; height: 60px;
            display: flex; align-items: center; justify-content: center;
        }
        /* Header Gradient (Sama dengan halaman lain) */
        .page-header-modern {
            background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%);
            padding: 5rem 0;
            margin-bottom: 3rem;
            position: relative;
            border-radius: 0 0 50px 50px;
            box-shadow: 0 10px 30px rgba(13, 110, 253, 0.15);
        }
    </style>
@endsection
