@extends('layouts.guest.app')

@section('content')
    {{-- main content --}}
    <!-- Content Start -->
    <div class="page-header">
        <div class="container text-center">
            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Ajukan Permohonan Surat</h1>
            <p class="lead text-white animate__animated animate__fadeInUp">Ajukan permohonan surat baru untuk keperluan
                administrasi</p>
        </div>
    </div>
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card form-card animate__animated animate__fadeInUp">
                        <div class="form-header text-center">
                            <div class="form-icon-wrapper">
                                <i class="fas fa-envelope-open-text form-main-icon"></i>
                            </div>
                            <h3 class="mb-0">
                                Formulir Permohonan Surat Baru
                            </h3>
                            <p class="text-muted mt-2">Isi informasi detail tentang permohonan surat baru</p>
                        </div>

                        <div class="form-body">
                            <form method="POST" action="{{ route('permohonan-surat.store') }}"
                                enctype="multipart/form-data">
                                @csrf

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

                                <!-- Debug Info -->
                                @php
                                    // Debug informasi
                                    $jenisSuratCount = isset($dataJenisSurat) ? $dataJenisSurat->count() : 0;
                                    $wargaCount = isset($dataWarga) ? $dataWarga->count() : 0;
                                @endphp

                                <!-- Debug Alert -->
                                @if ($jenisSuratCount === 0)
                                    <div class="alert alert-warning animate__animated animate__fadeIn">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-exclamation-triangle me-3 fa-lg"></i>
                                            <div>
                                                <h5 class="alert-heading mb-2">Data Jenis Surat Tidak Ditemukan</h5>
                                                <p class="mb-0">Silakan tambahkan data jenis surat terlebih dahulu atau
                                                    hubungi administrator.</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Nomor Permohonan -->
                                <div class="mb-4">
                                    <label for="nomor_permohonan" class="form-label">
                                        <i class="fas fa-hashtag me-2"></i>Nomor Permohonan *
                                    </label>
                                    <div class="input-group-icon">
                                        <input type="text" class="form-control input-focus-effect" id="nomor_permohonan"
                                            value="PMH-{{ date('Ymd') }}-{{ str_pad((App\Models\PermohonanSurat::max('permohonan_id') ?? 0) + 1, 3, '0', STR_PAD_LEFT) }}"
                                            readonly>
                                        <i class="fas fa-hashtag form-icon"></i>
                                    </div>
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Nomor unik permohonan surat (otomatis)
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="jenis_surat_id" class="form-label">
                                            <i class="fas fa-file-alt me-2"></i>Jenis Surat *
                                        </label>
                                        <div class="input-group-icon">
                                            <select name="jenis_surat_id" id="jenis_surat_id"
                                                class="form-control input-focus-effect @error('jenis_surat_id') is-invalid @enderror"
                                                required>
                                                <option value="">-- Pilih Jenis Surat --</option>
                                                @if (isset($dataJenisSurat) && $dataJenisSurat->count() > 0)
                                                    @foreach ($dataJenisSurat as $jenis)
                                                        <option value="{{ $jenis->jenis_id }}"
                                                            {{ old('jenis_surat_id') == $jenis->jenis_id ? 'selected' : '' }}>
                                                            {{ $jenis->nama_jenis }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <!-- Fallback options jika data tidak tersedia -->
                                                    <option value="1">Surat Keterangan Domisili</option>
                                                    <option value="2">Surat Keterangan Tidak Mampu</option>
                                                    <option value="3">Surat Keterangan Usaha</option>
                                                    <option value="4">Surat Pengantar</option>
                                                    <option value="5">Surat Keterangan Kelahiran</option>
                                                    <option value="6">Surat Keterangan Kematian</option>
                                                @endif
                                            </select>
                                            <i class="fas fa-file-alt form-icon"></i>
                                        </div>
                                        @error('jenis_surat_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">
                                            <i class="fas fa-info-circle me-1"></i>
                                            @if (isset($dataJenisSurat) && $dataJenisSurat->count() > 0)
                                                Tersedia {{ $dataJenisSurat->count() }} jenis surat
                                            @else
                                                Data jenis surat tidak tersedia, menggunakan data default
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status" class="form-label">
                                            <i class="fas fa-tasks me-2"></i>Status *
                                        </label>
                                        <div class="input-group-icon">
                                            <select name="status" id="status"
                                                class="form-control input-focus-effect @error('status') is-invalid @enderror"
                                                required>
                                                <option value="">-- Pilih Status --</option>
                                                <option value="DRAFT" {{ old('status') == 'DRAFT' ? 'selected' : '' }}>
                                                    DRAFT</option>
                                                <option value="DIAJUKAN"
                                                    {{ old('status') == 'DIAJUKAN' ? 'selected' : '' }}>DIAJUKAN</option>
                                                <option value="DIPROSES"
                                                    {{ old('status') == 'DIPROSES' ? 'selected' : '' }}>DIPROSES</option>
                                                <option value="SELESAI" {{ old('status') == 'SELESAI' ? 'selected' : '' }}>
                                                    SELESAI</option>
                                                <option value="DIAMBIL" {{ old('status') == 'DIAMBIL' ? 'selected' : '' }}>
                                                    DIAMBIL</option>
                                                <option value="DITOLAK" {{ old('status') == 'DITOLAK' ? 'selected' : '' }}>
                                                    DITOLAK</option>
                                            </select>
                                            <i class="fas fa-tasks form-icon"></i>
                                        </div>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Status permohonan surat
                                        </div>
                                    </div>
                                </div>

                                {{-- FITUR BARU: MULTIPLE UPLOAD FILES --}}
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="files"><strong>Upload Berkas Persyaratan</strong></label>
                                        <div class="custom-file mt-2">
                                            {{-- name="files[]" dan attribute "multiple" wajib ada --}}
                                            <input type="file" class="form-control" name="files[]" id="files"
                                                multiple>
                                        </div>
                                        <small class="text-muted d-block mt-1">
                                            * Format yang diizinkan: JPG, JPEG, PNG, PDF, DOC, DOCX. Maks 2MB per file.
                                        </small>

                                        {{-- Error handling khusus untuk file --}}
                                        @error('files')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                        @error('files.*')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- AKHIR FITUR UPLOAD --}}

                                <!-- Pemohon -->
                                <div class="mb-4">
                                    <label for="warga_id" class="form-label">
                                        <i class="fas fa-user me-2"></i>Pemohon *
                                    </label>
                                    <div class="input-group-icon">
                                        <select name="warga_id" id="warga_id"
                                            class="form-control input-focus-effect @error('warga_id') is-invalid @enderror"
                                            required>
                                            <option value="">-- Pilih Nama Pemohon --</option>
                                            @if (isset($dataWarga) && $dataWarga->count() > 0)
                                                @foreach ($dataWarga as $warga)
                                                    <option value="{{ $warga->warga_id }}"
                                                        {{ old('warga_id') == $warga->warga_id ? 'selected' : '' }}>
                                                        {{ $warga->nama }} - {{ $warga->nik }}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="" disabled>Data warga tidak tersedia</option>
                                            @endif
                                        </select>
                                        <i class="fas fa-user form-icon"></i>
                                    </div>
                                    @error('warga_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        @if (isset($dataWarga) && $dataWarga->count() > 0)
                                            Tersedia {{ $dataWarga->count() }} data warga
                                        @else
                                            Data warga tidak tersedia
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="tanggal_pengajuan" class="form-label">
                                            <i class="fas fa-calendar-alt me-2"></i>Tanggal Pengajuan *
                                        </label>
                                        <div class="input-group-icon">
                                            <input type="date" name="tanggal_pengajuan" id="tanggal_pengajuan"
                                                class="form-control input-focus-effect @error('tanggal_pengajuan') is-invalid @enderror"
                                                value="{{ old('tanggal_pengajuan', date('Y-m-d')) }}" required>
                                            <i class="fas fa-calendar-alt form-icon"></i>
                                        </div>
                                        @error('tanggal_pengajuan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Tanggal pengajuan permohonan
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            <i class="fas fa-info-circle me-2"></i>Informasi Status
                                        </label>
                                        <div class="status-info p-3 bg-light rounded">
                                            <small class="text-muted">
                                                <strong>DRAFT:</strong> Masih dalam proses<br>
                                                <strong>DIAJUKAN:</strong> Sudah diajukan<br>
                                                <strong>DIPROSES:</strong> Sedang diproses<br>
                                                <strong>SELESAI:</strong> Surat selesai<br>
                                                <strong>DIAMBIL:</strong> Sudah diambil<br>
                                                <strong>DITOLAK:</strong> Permohonan ditolak
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Catatan -->
                                <div class="mb-4">
                                    <label for="catatan" class="form-label">
                                        <i class="fas fa-sticky-note me-2"></i>Catatan
                                    </label>
                                    <div class="input-group-icon">
                                        <textarea class="form-control input-focus-effect" id="catatan" name="catatan" rows="4"
                                            placeholder="Masukkan catatan tambahan jika diperlukan">{{ old('catatan') }}</textarea>
                                        <i class="fas fa-sticky-note form-icon" style="top: 20px;"></i>
                                    </div>
                                    @error('catatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Contoh: "Untuk keperluan pengajuan beasiswa" atau "Lampiran: FC KTP dan KK"
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                                    <a href="{{ route('permohonan-surat.index') }}"
                                        class="btn btn-outline-secondary btn-back">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-submit" id="submitButton"
                                        {{ $jenisSuratCount === 0 || $wargaCount === 0 ? 'disabled' : '' }}>
                                        <span class="submit-text">
                                            <i class="fas fa-paper-plane me-2"></i>Ajukan Permohonan
                                        </span>
                                        <span class="loading-spinner" style="display: none;">
                                            <i class="fas fa-spinner fa-spin me-2"></i>Mengajukan...
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="card info-card mt-4 animate__animated animate__fadeInUp" data-aos-delay="200">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-lightbulb text-warning me-3 fa-2x"></i>
                                <div>
                                    <h5 class="card-title mb-2">Tips Pengajuan</h5>
                                    <p class="card-text mb-0 small">
                                        Pastikan memilih jenis surat yang sesuai dengan kebutuhan.
                                        Untuk permohonan baru, pilih status "DIAJUKAN" agar langsung diproses oleh admin.
                                    </p>
                                    @if ($jenisSuratCount === 0 || $wargaCount === 0)
                                        <div class="alert alert-warning mt-3 mb-0 small">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            <strong>Perhatian:</strong>
                                            @if ($jenisSuratCount === 0)
                                                Data jenis surat tidak tersedia.
                                            @endif
                                            @if ($wargaCount === 0)
                                                Data warga tidak tersedia.
                                            @endif
                                            Silakan hubungi administrator.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content End -->
    {{-- end main content --}}

    <style>
        /* Styling untuk form card */
        .form-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .form-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        /* Header form styling */
        .form-header {
            background: linear-gradient(135deg, var(--bs-primary), #4a6bdf);
            color: white;
            padding: 2.5rem 2rem;
            position: relative;
            overflow: hidden;
        }

        .form-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(30deg);
        }

        .form-icon-wrapper {
            margin-bottom: 1rem;
        }

        .form-main-icon {
            font-size: 3rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 1rem;
            border-radius: 50%;
            margin-bottom: 1rem;
        }

        /* Form body styling */
        .form-body {
            padding: 2.5rem 2rem;
        }

        /* Input group dengan icon */
        .input-group-icon {
            position: relative;
        }

        .form-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--bs-primary);
            transition: all 0.3s ease;
        }

        /* Efek focus pada input */
        .input-focus-effect {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .input-focus-effect:focus {
            border-color: var(--bs-primary);
            box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25);
            transform: translateY(-2px);
        }

        .input-focus-effect:focus+.form-icon {
            color: var(--bs-primary);
            transform: translateY(-50%) scale(1.1);
        }

        /* Select styling */
        select.input-focus-effect {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }

        /* Label styling */
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }

        /* Form text styling */
        .form-text {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
        }

        /* Button styling */
        .btn-back {
            border-radius: 10px;
            padding: 10px 20px;
            transition: all 0.3s ease;
            border: 2px solid #6c757d;
        }

        .btn-back:hover {
            background-color: #6c757d;
            color: white;
            transform: translateX(-5px);
        }

        .btn-submit {
            border-radius: 10px;
            padding: 10px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Alert styling */
        .alert {
            border: none;
            border-radius: 10px;
        }

        .alert-danger {
            border-left: 4px solid var(--bs-danger);
        }

        .alert-warning {
            border-left: 4px solid var(--bs-warning);
        }

        .alert-success {
            border-left: 4px solid var(--bs-success);
        }

        /* Info card styling */
        .info-card {
            border: none;
            border-radius: 15px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-3px);
        }

        /* Status info box */
        .status-info {
            border-left: 4px solid var(--bs-info);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Loading animation */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .loading {
            animation: pulse 1.5s ease-in-out infinite;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .form-body {
                padding: 2rem 1rem;
            }

            .form-header {
                padding: 2rem 1rem;
            }

            .row.mb-4 {
                margin-bottom: 1rem !important;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('permohonanSuratForm');
            const submitButton = document.getElementById('submitButton');
            const submitText = submitButton.querySelector('.submit-text');
            const loadingSpinner = submitButton.querySelector('.loading-spinner');

            // Efek loading saat submit form
            form.addEventListener('submit', function() {
                submitText.style.display = 'none';
                loadingSpinner.style.display = 'inline';
                submitButton.disabled = true;
                submitButton.classList.add('loading');
            });

            // Efek hover untuk semua input
            const inputs = document.querySelectorAll('.input-focus-effect');
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

            // Auto-set tanggal hari ini jika kosong
            const tanggalInput = document.getElementById('tanggal_pengajuan');
            if (!tanggalInput.value) {
                tanggalInput.value = new Date().toISOString().split('T')[0];
            }

            // Validasi real-time
            const jenisSuratSelect = document.getElementById('jenis_surat_id');
            const statusSelect = document.getElementById('status');
            const wargaSelect = document.getElementById('warga_id');

            [jenisSuratSelect, statusSelect, wargaSelect].forEach(select => {
                select.addEventListener('change', function() {
                    if (this.value) {
                        this.classList.remove('is-invalid');
                        this.classList.add('is-valid');
                    } else {
                        this.classList.remove('is-valid');
                    }
                });
            });

            // Character counter untuk catatan
            const catatanTextarea = document.getElementById('catatan');
            const updateCharacterCount = () => {
                const count = catatanTextarea.value.length;
                const counter = document.getElementById('charCount') || (() => {
                    const counterEl = document.createElement('div');
                    counterEl.id = 'charCount';
                    counterEl.className = 'form-text text-end';
                    catatanTextarea.parentNode.appendChild(counterEl);
                    return counterEl;
                })();

                counter.textContent = `${count} karakter`;
            };

            catatanTextarea.addEventListener('input', updateCharacterCount);
            updateCharacterCount(); // Initial call

            // Debug info di console
            console.log('Jenis Surat Options:', document.getElementById('jenis_surat_id').options.length);
            console.log('Warga Options:', document.getElementById('warga_id').options.length);
        });
    </script>

@endsection
