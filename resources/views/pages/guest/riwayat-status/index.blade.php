@extends('layouts.guest.app')

@section('content')
    {{-- 1. HEADER MODERN --}}
    <div class="page-header">
        <div class="container text-center">
            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">
                <i class="fas fa-history me-2 opacity-50"></i>Log Riwayat
            </h1>
            <p class="lead text-white animate__animated animate__fadeInUp">
                Jejak aktivitas perubahan status permohonan surat
            </p>
            {{-- Breadcrumb simpel --}}
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0 animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="text-white">Beranda</a></li>
                    <li class="breadcrumb-item active text-white-50" aria-current="page">Riwayat</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container py-5">

            {{-- 2. ACTION BAR & SEARCH --}}
            <div class="row mb-4 align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0 text-primary fw-bold">
                        <i class="fas fa-list-ul me-2"></i>Daftar Aktivitas Terbaru
                    </h5>
                    <p class="text-muted small mb-0">Total {{ $data->count() }} catatan riwayat ditemukan</p>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <a href="{{ route('riwayat.create') }}" class="btn btn-primary floating-action-btn shadow">
                        <i class="fas fa-plus-circle me-2"></i>Catat Manual
                    </a>
                </div>
            </div>

            {{-- 3. TABEL DATA MODERN --}}
            <div class="card border-0 shadow-lg rounded-3 overflow-hidden animate__animated animate__fadeInUp">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 custom-table">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3 text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Waktu & Tanggal</th>
                                    <th class="py-3 text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Nomor Surat</th>
                                    <th class="py-3 text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Status Perubahan</th>
                                    <th class="py-3 text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Keterangan</th>
                                    <th class="py-3 text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Oleh Petugas</th>
                                    <th class="text-end pe-4 py-3 text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $item)
                                    <tr>
                                        {{-- KOLOM WAKTU --}}
                                        <td class="ps-4">
                                            <div class="d-flex px-2 py-1">
                                                <div class="me-3 d-flex align-items-center justify-content-center bg-primary-soft rounded-circle" style="width: 40px; height: 40px;">
                                                    <i class="fas fa-clock text-primary"></i>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm font-weight-bold">
                                                        {{ \Carbon\Carbon::parse($item->waktu)->format('H:i') }} WIB
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ \Carbon\Carbon::parse($item->waktu)->translatedFormat('d F Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- KOLOM PERMOHONAN --}}
                                        <td>
                                            @if($item->permohonan)
                                                <div class="d-flex flex-column">
                                                    <span class="text-dark fw-bold text-sm">
                                                        {{ $item->permohonan->nomor_permohonan }}
                                                    </span>
                                                    {{-- Link ke detail (Opsional) --}}
                                                    <a href="{{ route('permohonan-surat.show', $item->permohonan_id) }}" class="text-xs text-primary text-decoration-none">
                                                        Lihat Detail <i class="fas fa-arrow-right ms-1" style="font-size: 8px;"></i>
                                                    </a>
                                                </div>
                                            @else
                                                <span class="badge bg-light text-muted border">Data Terhapus</span>
                                            @endif
                                        </td>

                                        {{-- KOLOM STATUS --}}
                                        <td>
                                            @php
                                                $status = strtoupper($item->status);
                                                $badgeClass = match($status) {
                                                    'SELESAI', 'VALID' => 'bg-success-gradient',
                                                    'DITOLAK' => 'bg-danger-gradient',
                                                    'DIPROSES' => 'bg-warning-gradient',
                                                    'DIAJUKAN' => 'bg-info-gradient',
                                                    default => 'bg-secondary-gradient'
                                                };
                                                $icon = match($status) {
                                                    'SELESAI', 'VALID' => 'fa-check-circle',
                                                    'DITOLAK' => 'fa-times-circle',
                                                    'DIPROSES' => 'fa-spinner fa-spin-hover',
                                                    'DIAJUKAN' => 'fa-paper-plane',
                                                    default => 'fa-info-circle'
                                                };
                                            @endphp
                                            <span class="badge {{ $badgeClass }} py-2 px-3 rounded-pill text-white shadow-sm status-badge">
                                                <i class="fas {{ $icon }} me-1"></i> {{ $item->status }}
                                            </span>
                                        </td>

                                        {{-- KOLOM KETERANGAN --}}
                                        <td>
                                            <p class="text-xs text-secondary mb-0 text-wrap" style="max-width: 250px;">
                                                {{ Str::limit($item->keterangan, 60) }}
                                            </p>
                                        </td>

                                        {{-- KOLOM PETUGAS --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                {{-- Avatar Inisial --}}
                                                @php
                                                    $namaPetugas = $item->petugas->nama ?? 'Sistem';
                                                    $inisial = strtoupper(substr($namaPetugas, 0, 1));
                                                    $color = ['bg-primary', 'bg-info', 'bg-success', 'bg-warning'][rand(0,3)];
                                                @endphp
                                                <div class="avatar-sm {{ $color }} rounded-circle text-white d-flex align-items-center justify-content-center me-2 shadow-sm" style="width: 30px; height: 30px; font-size: 12px;">
                                                    {{ $inisial }}
                                                </div>
                                                <span class="text-sm font-weight-bold text-dark">{{ $namaPetugas }}</span>
                                            </div>
                                        </td>

                                        {{-- KOLOM AKSI --}}
                                        <td class="text-end pe-4">
                                            <div class="dropdown">
                                                <button class="btn btn-link text-secondary mb-0" type="button" data-bs-toggle="dropdown">
                                                    <i class="fas fa-ellipsis-v text-xs"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                                    <li>
                                                        {{-- PERBAIKAN: Menggunakan riwayat_id --}}
                                                        <a class="dropdown-item" href="{{ route('riwayat.edit', $item->riwayat_id) }}">
                                                            <i class="fas fa-edit me-2 text-warning"></i>Edit Data
                                                        </a>
                                                    </li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        {{-- PERBAIKAN: Menggunakan riwayat_id --}}
                                                        <form action="{{ route('riwayat.destroy', $item->riwayat_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus log riwayat ini?');">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-danger">
                                                                <i class="fas fa-trash-alt me-2"></i>Hapus Permanen
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="d-flex flex-column align-items-center justify-content-center">
                                                <div class="bg-light rounded-circle p-4 mb-3">
                                                    <i class="fas fa-history fa-3x text-muted opacity-50"></i>
                                                </div>
                                                <h5 class="text-muted fw-bold">Belum Ada Riwayat</h5>
                                                <p class="text-muted small">Aktivitas perubahan status surat akan muncul di sini.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- Pagination (Opsional jika controller pakai paginate) --}}
                @if($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <div class="card-footer bg-white py-3 border-0 d-flex justify-content-center">
                        {{ $data->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('layouts.guest.css')
@endsection
