@extends('layouts.guest.app')

@section('content')
    {{-- HEADER MODERN --}}
    <div class="page-header">
        <div class="container text-center">
            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">
                <i class="fas fa-file-contract me-2 opacity-50"></i>Berkas Persyaratan
            </h1>
            <p class="lead text-white animate__animated animate__fadeInUp">
                Kelola Dokumen Persyaratan & Lampiran
            </p>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container py-5">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Statistik Ringkas --}}
            <div class="row mb-5">
                <div class="col-md-3 mb-4">
                    <div class="card card-stat bg-primary text-white shadow h-100 stats-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3"><i class="fas fa-folder-open fa-3x"></i></div>
                            <div>
                                <h4 class="mb-0">{{ $data->count() }}</h4>
                                <p class="mb-0">Total Berkas</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card card-stat bg-warning text-white shadow h-100 stats-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3"><i class="fas fa-clock fa-3x"></i></div>
                            <div>
                                <h4 class="mb-0">{{ $data->where('valid', 0)->count() }}</h4>
                                <p class="mb-0">Perlu Validasi</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card card-stat bg-success text-white shadow h-100 stats-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3"><i class="fas fa-check-double fa-3x"></i></div>
                            <div>
                                <h4 class="mb-0">{{ $data->where('valid', 1)->count() }}</h4>
                                <p class="mb-0">Sudah Valid</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card card-stat bg-info text-white shadow h-100 stats-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3"><i class="fas fa-layer-group fa-3x"></i></div>
                            <div>
                                {{-- Menghitung Permohonan Unik yang Aman --}}
                                <h4 class="mb-0">{{ $data->unique('permohonan_id')->count() }}</h4>
                                <p class="mb-0">Permohonan Terkait</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tombol Tambah --}}
            <div class="row mb-4">
                <div class="col-md-8">
                    {{-- Form Pencarian Sederhana --}}
                    <form action="{{ route('berkas.index') }}" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control me-2"
                            placeholder="Cari nama berkas atau nomor permohonan..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </form>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('berkas.create') }}" class="btn btn-primary floating-action-btn shadow">
                        <i class="fas fa-plus me-2"></i>Tambah Berkas
                    </a>
                </div>
            </div>

            {{-- Grid Data --}}
            <div class="row">
                @forelse($data as $item)
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card widget-card h-100 shadow-sm border-0">
                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 text-truncate" title="{{ $item->nama_berkas }}">
                                    <i class="fas fa-file-alt me-2"></i>{{ Str::limit($item->nama_berkas, 20) }}
                                </h6>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light dropdown-toggle action-btn" type="button"
                                        data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('berkas.edit', $item->berkas_id) }}">
                                                <i class="fas fa-edit me-2 text-warning"></i>Edit
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('berkas.destroy', $item->berkas_id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Hapus berkas ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="fas fa-trash-alt me-2"></i>Hapus
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card-body">
                                {{-- Info Permohonan --}}
                                <div class="mb-3">
                                    <small class="text-muted d-block">Asal Permohonan</small>
                                    @if ($item->permohonan)
                                        <span class="fw-bold text-dark">
                                            <i class="fas fa-hashtag me-1"></i>{{ $item->permohonan->nomor_permohonan }}
                                        </span>
                                    @else
                                        <span class="text-danger small fst-italic">Data Permohonan Terhapus</span>
                                    @endif
                                </div>

                                {{-- Info Jenis Surat (Nested Relation Check) --}}
                                <div class="mb-3">
                                    <small class="text-muted d-block">Jenis Surat</small>
                                    @if ($item->permohonan && $item->permohonan->jenisSurat)
                                        <span class="text-dark">
                                            <i class="fas fa-envelope-open-text me-1 text-primary"></i>
                                            {{ $item->permohonan->jenisSurat->nama_jenis }}
                                        </span>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted d-block">Pemohon</small>
                                        <span class="small">
                                            @if ($item->permohonan && $item->permohonan->warga)
                                                {{ Str::limit($item->permohonan->warga->nama, 10) }}
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Status</small>
                                        @if ($item->valid)
                                            <span class="badge bg-success"><i class="fas fa-check me-1"></i>Valid</span>
                                        @else
                                            <span class="badge bg-warning text-dark"><i
                                                    class="fas fa-clock me-1"></i>Pending</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-white border-top-0 pb-3">
                                <small class="text-secondary fw-bold d-block mb-2" style="font-size: 0.75rem;">FILE
                                    LAMPIRAN</small>
                                @if ($item->media)
                                    <a href="{{ asset('uploads/' . $item->media->file_url) }}" target="_blank"
                                        class="btn btn-sm btn-outline-light text-dark border w-100 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-file me-2"></i> Lihat File
                                    </a>
                                @else
                                    <div class="text-center py-1 border rounded bg-light text-muted small">
                                        <i class="fas fa-ban me-1"></i> Tidak ada file
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-light text-center py-5 border dashed">
                            <i class="fas fa-folder-open fa-3x text-muted mb-3 opacity-50"></i>
                            <h5 class="text-muted">Belum ada data berkas</h5>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @include ('layouts.guest.css')
@endsection
