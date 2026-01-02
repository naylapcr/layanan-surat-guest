@extends('layouts.guest.app')

@section('content')
<div class="page-header">
    <div class="container text-center">
        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Edit Riwayat</h1>
        <p class="lead text-white animate__animated animate__fadeInUp">Perbarui data log aktivitas surat</p>
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
                            <i class="fas fa-history form-main-icon"></i>
                        </div>
                        <h3 class="mb-0">Edit Status Log</h3>
                        <p class="text-muted mt-2">Ubah waktu, status, atau keterangan riwayat</p>
                    </div>

                    {{-- Body Form --}}
                    <div class="form-body">
                        {{-- Gunakan riwayat_id sebagai parameter route --}}
                        <form action="{{ route('riwayat.update', $riwayat->riwayat_id) }}" method="POST">
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

                            {{-- INFO READ-ONLY (Agar petugas tidak salah edit) --}}
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="bg-light p-3 rounded border">
                                        <small class="text-muted d-block mb-1">Nomor Surat</small>
                                        <span class="fw-bold text-dark">
                                            <i class="fas fa-envelope-open-text me-2 text-primary"></i>
                                            {{ $riwayat->permohonan->nomor_permohonan ?? 'Data Terhapus' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3 mt-md-0">
                                    <div class="bg-light p-3 rounded border">
                                        <small class="text-muted d-block mb-1">Petugas Pencatat</small>
                                        <span class="fw-bold text-dark">
                                            <i class="fas fa-user-shield me-2 text-primary"></i>
                                            {{ $riwayat->petugas->nama ?? 'Sistem' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4 text-muted opacity-25">

                            {{-- Field: Waktu (Datetime Local) --}}
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label for="waktu" class="form-label">
                                        <i class="fas fa-clock me-2"></i>Waktu Pencatatan *
                                    </label>
                                    <div class="input-group-icon">
                                        {{-- Format value harus Y-m-d\TH:i agar terbaca di input datetime-local --}}
                                        <input type="datetime-local" class="form-control input-focus-effect" id="waktu" name="waktu"
                                            value="{{ old('waktu', \Carbon\Carbon::parse($riwayat->waktu)->format('Y-m-d\TH:i')) }}" required>
                                        <i class="fas fa-calendar-alt form-icon"></i>
                                    </div>
                                </div>
                            </div>

                            {{-- Field: Status --}}
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label for="status" class="form-label">
                                        <i class="fas fa-tasks me-2"></i>Status Surat *
                                    </label>
                                    <div class="input-group-icon">
                                        <select name="status" id="status" class="form-select input-focus-effect">
                                            <option value="">-- Pilih Status --</option>
                                            @foreach(['DIAJUKAN', 'DIPROSES', 'SELESAI', 'DITOLAK'] as $st)
                                                <option value="{{ $st }}" {{ old('status', $riwayat->status) == $st ? 'selected' : '' }}>
                                                    {{ $st }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <i class="fas fa-chevron-down form-icon" style="font-size: 0.8rem;"></i>
                                    </div>
                                </div>
                            </div>

                            {{-- Field: Keterangan --}}
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label for="keterangan" class="form-label">
                                        <i class="fas fa-align-left me-2"></i>Keterangan / Catatan *
                                    </label>
                                    <div class="input-group-icon">
                                        <textarea name="keterangan" class="form-control input-focus-effect" id="keterangan"
                                            rows="4" required placeholder="Tuliskan detail perubahan status...">{{ old('keterangan', $riwayat->keterangan) }}</textarea>
                                        <i class="fas fa-comment-dots form-icon" style="top: 20px; transform: none;"></i>
                                    </div>
                                </div>
                            </div>

                            {{-- Footer Buttons --}}
                            <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                                <a href="{{ route('riwayat.index') }}" class="btn btn-outline-secondary btn-back">
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
{{-- STYLE CSS (Konsisten dengan halaman Create/Edit lainnya) --}}
<style>
    /* Page Header Gradient */
    .page-header {
        background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%);
        padding: 5rem 0 3rem 0;
        border-radius: 0 0 50px 50px;
        box-shadow: 0 10px 30px rgba(13, 110, 253, 0.15);
        margin-bottom: 0;
    }

    /* Form Card Styling */
    .form-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-top: -50px;
        transition: transform 0.3s ease;
    }
    .form-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }

    /* Header Form */
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

    /* Inputs & Icons */
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

    /* Buttons */
    .btn-submit {
        border-radius: 10px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.3s;
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    .btn-back {
        border-radius: 10px;
        padding: 10px 20px;
    }

    /* Alert */
    .alert {
        border: none;
        border-radius: 10px;
        border-left: 4px solid var(--bs-danger);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Efek hover untuk input
        const inputs = document.querySelectorAll('.input-focus-effect, .form-select');
        inputs.forEach(input => {
            input.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            input.addEventListener('mouseleave', function() {
                if (document.activeElement !== this) {
                    this.style.transform = 'translateY(0)';
                }
            });
        });
    });
</script>
@endsection
