@extends('layouts.guest.app')

@section('content')
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white mb-4 animated slideInDown">Detail Permohonan</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="text-white">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('permohonan-surat.index') }}" class="text-white">Riwayat</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">

                {{-- KOLOM KIRI: Detail Surat & Berkas --}}
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">

                    {{-- Header Kartu --}}
                    <div class="d-flex align-items-center mb-4">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary rounded-circle me-3"
                             style="width: 50px; height: 50px;">
                            <i class="fa fa-envelope-open-text text-white"></i>
                        </div>
                        <div>
                            <h2 class="mb-0">{{ $permohonan->jenisSurat->nama_jenis }}</h2>
                            <small class="text-muted">Nomor Tiket: <span class="text-primary fw-bold">{{ $permohonan->nomor_permohonan }}</span></small>
                        </div>
                    </div>

                    {{-- Informasi Utama --}}
                    <div class="bg-light rounded p-4 mb-4">
                        <h5 class="mb-3 text-primary"><i class="fas fa-info-circle me-2"></i>Informasi Pengajuan</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="text-muted small">Tanggal Pengajuan</label>
                                <p class="fw-bold text-dark">{{ \Carbon\Carbon::parse($permohonan->tanggal_pengajuan)->isoFormat('D MMMM Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Update Terakhir</label>
                                <p class="fw-bold text-dark">{{ $permohonan->updated_at->diffForHumans() }}</p>
                            </div>
                            <div class="col-12">
                                <label class="text-muted small">Keperluan / Catatan</label>
                                <p class="fw-bold text-dark bg-white p-3 rounded border">
                                    {{ $permohonan->catatan ?? 'Tidak ada catatan khusus.' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- FILE LAMPIRAN (DENGAN PLACEHOLDER IMAGE) --}}
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="m-0 text-primary"><i class="fas fa-paperclip me-2"></i>Berkas Lampiran</h5>
                        </div>
                        <div class="card-body">
                            {{-- Container Flex --}}
                            <div class="d-flex flex-wrap gap-2">
                                @forelse($permohonan->files as $file)
                                    @php
                                        // Deteksi tipe file untuk ikon
                                        $isPdf = Str::endsWith(strtolower($file->filename), '.pdf');
                                    @endphp
                                    <a href="{{ asset('uploads/' . $file->filename) }}" target="_blank"
                                       class="btn btn-outline-light text-dark border shadow-sm rounded-pill px-3 py-2 d-flex align-items-center file-chip"
                                       style="text-decoration: none;"
                                       data-bs-toggle="tooltip" title="{{ $file->filename }}">

                                        @if($isPdf)
                                            <i class="fas fa-file-pdf text-danger me-2 fa-lg"></i>
                                        @else
                                            <i class="fas fa-file-image text-success me-2 fa-lg"></i>
                                        @endif

                                        <span class="fw-medium">Dokumen {{ $loop->iteration }}</span>
                                    </a>
                                @empty
                                    {{-- BAGIAN PLACEHOLDER IMAGE JIKA KOSONG --}}
                                    <div class="w-100 text-center py-4">
                                        {{-- Ganti 'empty-file.png' dengan nama file gambar Anda --}}
                                        {{-- Pastikan gambar ada di public/assets-guest/img/ --}}
                                        <img src="{{ asset('assets-guest/img/placeholder.jpg') }}"
                                             alt="Tidak ada lampiran"
                                             class="img-fluid mb-3 opacity-75"
                                             style="max-width: 150px;">

                                        <p class="text-muted small mb-0">
                                            Tidak ada berkas lampiran yang diunggah.
                                        </p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    {{-- AKHIR FILE LAMPIRAN --}}

                    <a href="{{ route('permohonan-surat.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Riwayat
                    </a>
                </div>

                {{-- KOLOM KANAN: Status & Data Pemohon --}}
                <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.5s">

                    {{-- Card Status --}}
                    <div class="card border-0 shadow rounded-3 mb-4 overflow-hidden">
                        <div class="card-header py-3 text-center
                            @if($permohonan->status == 'SELESAI') bg-success
                            @elseif($permohonan->status == 'DITOLAK') bg-danger
                            @elseif($permohonan->status == 'DIPROSES') bg-info
                            @else bg-secondary @endif">
                            <h5 class="text-white m-0">Status Permohonan</h5>
                        </div>
                        <div class="card-body text-center p-4">
                            <div class="status-icon mb-3">
                                @if($permohonan->status == 'SELESAI')
                                    <i class="fas fa-check-circle fa-4x text-success"></i>
                                @elseif($permohonan->status == 'DITOLAK')
                                    <i class="fas fa-times-circle fa-4x text-danger"></i>
                                @elseif($permohonan->status == 'DIPROSES')
                                    <i class="fas fa-sync fa-spin fa-4x text-info"></i>
                                @else
                                    <i class="fas fa-clock fa-4x text-secondary"></i>
                                @endif
                            </div>
                            <h3 class="fw-bold
                                @if($permohonan->status == 'SELESAI') text-success
                                @elseif($permohonan->status == 'DITOLAK') text-danger
                                @elseif($permohonan->status == 'DIPROSES') text-info
                                @else text-secondary @endif">
                                {{ $permohonan->status }}
                            </h3>
                            <p class="text-muted small">Status saat ini</p>
                        </div>
                    </div>

                    {{-- Card Data Pemohon --}}
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h6 class="m-0 fw-bold"><i class="fas fa-user me-2"></i>Data Pemohon</h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0 d-flex justify-content-between">
                                    <span class="text-muted small">Nama Lengkap</span>
                                    <span class="fw-bold text-end">{{ $permohonan->warga->nama }}</span>
                                </li>
                                <li class="list-group-item px-0 d-flex justify-content-between">
                                    <span class="text-muted small">NIK / No KTP</span>
                                    <span class="fw-bold text-end">{{ $permohonan->warga->no_ktp ?? $permohonan->warga->nik }}</span>
                                </li>
                                <li class="list-group-item px-0 d-flex justify-content-between">
                                    <span class="text-muted small">No. Telepon</span>
                                    <span class="fw-bold text-end">{{ $permohonan->warga->telp }}</span>
                                </li>
                                <li class="list-group-item px-0 d-flex justify-content-between">
                                    <span class="text-muted small">Pekerjaan</span>
                                    <span class="fw-bold text-end">{{ $permohonan->warga->pekerjaan }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        /* Efek hover untuk chip file agar interaktif */
        .file-chip {
            transition: all 0.2s ease;
            background-color: #fff;
        }
        .file-chip:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0,0,0,0.1) !important;
            border-color: var(--bs-primary) !important;
            background-color: #f8f9fa;
        }
    </style>
@endsection
