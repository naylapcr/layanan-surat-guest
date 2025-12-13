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

                    {{-- FILE LAMPIRAN (FITUR YANG DIMINTA) --}}
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="m-0 text-primary"><i class="fas fa-paperclip me-2"></i>Berkas Lampiran</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                @php
                                    // Asumsi: File disimpan dalam kolom 'lampiran' format JSON atau string comma-separated
                                    // Sesuaikan logika ini dengan cara kamu menyimpan file di database
                                    $files = [];
                                    if(isset($permohonan->lampiran)) {
                                        $files = is_array($permohonan->lampiran) ? $permohonan->lampiran : json_decode($permohonan->lampiran, true);
                                    }
                                @endphp

                                @if(!empty($files))
                                    @foreach($files as $key => $file)
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center border rounded p-3 file-item">
                                                <div class="flex-shrink-0 me-3">
                                                    @if(Str::endsWith(strtolower($file), ['.jpg', '.jpeg', '.png']))
                                                        <i class="fas fa-file-image fa-2x text-warning"></i>
                                                    @elseif(Str::endsWith(strtolower($file), ['.pdf']))
                                                        <i class="fas fa-file-pdf fa-2x text-danger"></i>
                                                    @else
                                                        <i class="fas fa-file fa-2x text-secondary"></i>
                                                    @endif
                                                </div>
                                                <div class="flex-grow-1 text-truncate me-3">
                                                    {{-- Menampilkan nama file asli atau label --}}
                                                    <h6 class="mb-0 text-truncate" title="{{ $file }}">
                                                        Dokumen {{ $loop->iteration }}
                                                    </h6>
                                                    <small class="text-muted">{{ Str::limit($file, 20) }}</small>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    {{-- Tombol Lihat/Download --}}
                                                    {{-- Sesuaikan path 'uploads/lampiran/' dengan folder penyimpananmu --}}
                                                    <a href="{{ asset('uploads/lampiran/' . $file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12 text-center py-4">
                                        <i class="fas fa-folder-open fa-3x text-light mb-3"></i>
                                        <p class="text-muted">Tidak ada berkas lampiran yang diunggah.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

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
        .file-item {
            transition: all 0.2s ease;
        }
        .file-item:hover {
            background-color: #f8f9fa;
            border-color: var(--bs-primary) !important;
        }
    </style>
@endsection
