@extends('layouts.guest.app')

@section('content')
{{-- main content --}}
    <!-- Content Start -->
<div class="page-header">
    <div class="container text-center">
        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Jenis Surat</h1>
        <p class="lead text-white animate__animated animate__fadeInUp">Jenis Surat Bina Desa</p>
    </div>
</div>
<div class="container-fluid py-5">
    <div class="container py-5">
        <!-- Stats Cards -->
        <div class="row mb-5">
            <div class="col-md-4 mb-4">
                <div class="card card-stat bg-primary text-white shadow h-100" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-file-alt fa-3x"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">{{ $dataJenisSurat->count() }}</h4>
                            <p class="mb-0">Total Jenis Surat</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-stat bg-success text-white shadow h-100" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-code fa-3x"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">{{ $dataJenisSurat->unique('kode')->count() }}</h4>
                            <p class="mb-0">Kode Unik</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-stat bg-info text-white shadow h-100" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-clipboard-list fa-3x"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">{{ $dataJenisSurat->where('syarat_json', '!=', '')->count() }}</h4>
                            <p class="mb-0">Dengan Syarat</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Bar -->
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="d-flex">
                    <div class="search-box me-3 flex-grow-1">
                        <div class="input-group">
                            <input type="text" class="form-control border-0" placeholder="Cari jenis surat..." id="searchInput">
                            <button class="btn btn-primary" type="button" id="searchButton">
                                <i class="fas fa-search me-2"></i>Cari
                            </button>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-toggle="tooltip" title="Filter data jenis surat">
                            <i class="fas fa-filter me-2"></i>Filter
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item filter-option" href="#" data-filter="all"><i class="fas fa-list me-2"></i>Semua</a></li>
                            <li><a class="dropdown-item filter-option" href="#" data-filter="with-syarat"><i class="fas fa-clipboard-check me-2"></i>Dengan Syarat</a></li>
                            <li><a class="dropdown-item filter-option" href="#" data-filter="without-syarat"><i class="fas fa-file me-2"></i>Tanpa Syarat</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-md-end">
                <!-- TOMBOL TAMBAH JENIS SURAT -->
                <a href="{{ route('jenis-surat.create') }}" class="btn btn-primary" data-bs-toggle="tooltip" title="Tambah jenis surat baru">
                    <i class="fas fa-plus me-2"></i>Tambah Jenis Surat
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Widget Cards untuk Jenis Surat -->
        <div class="row" id="jenisSuratContainer">
            @forelse($dataJenisSurat as $index => $jenis)
            <div class="col-xl-4 col-md-6 mb-4 jenis-surat-card-item" data-name="{{ strtolower($jenis->nama_jenis) }}" data-syarat="{{ $jenis->syarat_json ? 'with-syarat' : 'without-syarat' }}" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                <div class="card jenis-surat-card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">
                                <i class="fas fa-file-contract me-2"></i>{{ $jenis->nama_jenis }}
                            </h5>
                            <span class="badge kode-badge">{{ $jenis->kode }}</span>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-toggle="tooltip" title="Aksi">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('jenis-surat.edit', $jenis->jenis_id) }}">
                                        <i class="fas fa-edit me-2"></i>Edit
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('jenis-surat.destroy', $jenis->jenis_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus jenis surat ini?')">
                                            <i class="fas fa-trash me-2"></i>Hapus
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($jenis->syarat_json)
                        <h6 class="text-primary mb-3">
                            <i class="fas fa-clipboard-check me-2"></i>Syarat-syarat:
                        </h6>
                        <div class="syarat-list">
                            @php
                                try {
                                    $syarat = json_decode($jenis->syarat_json, true);
                                    if (json_last_error() !== JSON_ERROR_NONE) {
                                        throw new Exception('Not JSON');
                                    }
                                } catch (Exception $e) {
                                    $syarat = array_map('trim', explode(',', $jenis->syarat_json));
                                }
                            @endphp

                            @if(is_array($syarat) && count($syarat) > 0)
                                @foreach($syarat as $item)
                                <div class="syarat-item d-flex align-items-start">
                                    <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                    <span class="small">{{ is_array($item) ? ($item['syarat'] ?? $item) : $item }}</span>
                                </div>
                                @endforeach
                            @else
                                <div class="text-center text-muted py-2">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <span class="small">Tidak ada syarat khusus</span>
                                </div>
                            @endif
                        </div>
                        @else
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-info-circle fa-2x mb-3"></i>
                            <p class="mb-0 small">Tidak ada syarat khusus yang ditentukan</p>
                        </div>
                        @endif
                    </div>
                    <div class="card-footer bg-light">
                        <div class="row text-center">
                            <div class="col-12">
                                <small class="text-muted">Terakhir diperbarui: {{ $jenis->updated_at->format('d M Y') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="card text-center py-5" data-aos="fade-up">
                    <div class="card-body">
                        <i class="fas fa-file-alt fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">Belum ada data jenis surat</h4>
                        <p class="text-muted mb-4">Mulai dengan menambahkan jenis surat pertama</p>
                        <a href="{{ route('jenis-surat.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Tambah Jenis Surat Pertama
                        </a>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Info jumlah data -->
        @if($dataJenisSurat->count() > 0)
        <div class="row mt-4">
            <div class="col-12 text-center">
                <p class="text-muted"><i class="fas fa-info-circle me-2"></i>Menampilkan {{ $dataJenisSurat->count() }} jenis surat</p>
            </div>
        </div>
        @endif
    </div>
</div>
{{-- end main content --}}

@endsection
