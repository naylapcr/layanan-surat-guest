@extends('layouts.guest.app')

@section('content')
{{-- start main content --}}

     <div class="page-header">
        <div class="container text-center">
            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Edit Jenis Surat</h1>
            <p class="lead text-white animate__animated animate__fadeInUp">Edit jenis surat dalam sistem</p>
        </div>
    </div>
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card form-card animate__animated animate__fadeInUp">
                        <div class="form-header text-center">
                            <div class="form-icon-wrapper">
                                <i class="fas fa-edit form-main-icon"></i>
                            </div>
                            <h3 class="mb-0">
                                Formulir Edit Jenis Surat
                            </h3>
                            <p class="text-muted mt-2">Perbarui informasi jenis surat</p>
                        </div>
                        <div class="form-body">
                            <form method="POST" action="{{ route('jenis-surat.update', $dataJenisSurat->jenis_id) }}" id="editJenisSuratForm">
                                @csrf
                                @method('PUT')

                                @if($errors->any())
                                    <div class="alert alert-danger animate__animated animate__shakeX" role="alert">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-exclamation-triangle me-3 fa-lg"></i>
                                            <div>
                                                <h5 class="alert-heading mb-2">Terjadi Kesalahan</h5>
                                                <ul class="mb-0 ps-3">
                                                    @foreach($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-check-circle me-3 fa-lg"></i>
                                            <div>
                                                <h5 class="alert-heading mb-2">Berhasil!</h5>
                                                <p class="mb-0">{{ session('success') }}</p>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="kode" class="form-label">
                                            <i class="fas fa-code me-2"></i>Kode Surat *
                                        </label>
                                        <div class="input-group-icon">
                                            <input type="text" class="form-control input-focus-effect" id="kode" name="kode"
                                                   value="{{ old('kode', $dataJenisSurat->kode) }}" required
                                                   placeholder="Contoh: SKD, SKTM">
                                            <i class="fas fa-code form-icon"></i>
                                        </div>
                                        <div class="form-text">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Kode unik untuk jenis surat (contoh: SKD, SKTM, SKU)
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nama_jenis" class="form-label">
                                            <i class="fas fa-file-signature me-2"></i>Nama Jenis Surat *
                                        </label>
                                        <div class="input-group-icon">
                                            <input type="text" class="form-control input-focus-effect" id="nama_jenis" name="nama_jenis"
                                                   value="{{ old('nama_jenis', $dataJenisSurat->nama_jenis) }}" required
                                                   placeholder="Contoh: Surat Keterangan Domisili">
                                            <i class="fas fa-file-signature form-icon"></i>
                                        </div>
                                        <div class="form-text">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Nama lengkap jenis surat
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="syarat_json" class="form-label">
                                        <i class="fas fa-clipboard-list me-2"></i>Syarat-syarat
                                    </label>
                                    <div class="input-group-icon">
                                        <textarea class="form-control input-focus-effect" id="syarat_json" name="syarat_json" rows="4"
                                                  placeholder="Masukkan syarat-syarat yang diperlukan, pisahkan dengan koma">{{ old('syarat_json', $dataJenisSurat->syarat_json) }}</textarea>
                                        <i class="fas fa-clipboard-list form-icon" style="top: 20px;"></i>
                                    </div>
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Pisahkan setiap syarat dengan koma (contoh: Fotokopi KTP, Fotokopi KK, Surat Pengantar RT)
                                    </div>
                                    <div class="syarat-preview mt-3" id="syaratPreview" style="display: none;">
                                        <h6 class="text-primary mb-2">
                                            <i class="fas fa-eye me-2"></i>Pratinjau Syarat:
                                        </h6>
                                        <div class="preview-content" id="previewContent"></div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                                    <a href="{{ route('jenis-surat.index') }}" class="btn btn-outline-secondary btn-back">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                                    </a>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('jenis-surat.index') }}" class="btn btn-outline-danger btn-cancel">
                                            <i class="fas fa-times me-2"></i>Batal
                                        </a>
                                        <button type="submit" class="btn btn-primary btn-submit" id="submitButton">
                                            <span class="submit-text">
                                                <i class="fas fa-save me-2"></i>Perbarui
                                            </span>
                                            <span class="loading-spinner" style="display: none;">
                                                <i class="fas fa-spinner fa-spin me-2"></i>Memperbarui...
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Current Data Card -->
                    <div class="card info-card mt-4 animate__animated animate__fadeInUp" data-aos-delay="200">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle text-info me-3 fa-2x"></i>
                                <div>
                                    <h5 class="card-title mb-2">Data Saat Ini</h5>
                                    <p class="card-text mb-1 small">
                                        <strong>Kode:</strong> <span class="badge bg-primary">{{ $dataJenisSurat->kode }}</span>
                                    </p>
                                    <p class="card-text mb-1 small">
                                        <strong>Nama:</strong> {{ $dataJenisSurat->nama_jenis }}
                                    </p>
                                    <p class="card-text mb-0 small">
                                        <strong>Terakhir diperbarui:</strong> {{ $dataJenisSurat->updated_at->format('d M Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- end main content --}}

@include('layouts.guest.css')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('editJenisSuratForm');
        const submitButton = document.getElementById('submitButton');
        const submitText = submitButton.querySelector('.submit-text');
        const loadingSpinner = submitButton.querySelector('.loading-spinner');
        const syaratTextarea = document.getElementById('syarat_json');
        const syaratPreview = document.getElementById('syaratPreview');
        const previewContent = document.getElementById('previewContent');

        // Real-time preview untuk syarat
        syaratTextarea.addEventListener('input', function() {
            const syaratValue = this.value.trim();

            if (syaratValue) {
                const syaratArray = syaratValue.split(',').map(item => item.trim()).filter(item => item !== '');

                if (syaratArray.length > 0) {
                    previewContent.innerHTML = '';
                    syaratArray.forEach(syarat => {
                        if (syarat) {
                            const badge = document.createElement('div');
                            badge.className = 'syarat-badge';
                            badge.innerHTML = `<i class="fas fa-check-circle"></i>${syarat}`;
                            previewContent.appendChild(badge);
                        }
                    });
                    syaratPreview.style.display = 'block';
                } else {
                    syaratPreview.style.display = 'none';
                }
            } else {
                syaratPreview.style.display = 'none';
            }
        });

        // Efek loading saat submit form
        form.addEventListener('submit', function() {
            submitText.style.display = 'none';
            loadingSpinner.style.display = 'inline';
            submitButton.disabled = true;
            submitButton.classList.add('loading');
        });

        // Validasi real-time untuk kode
        const kodeInput = document.getElementById('kode');
        kodeInput.addEventListener('input', function() {
            this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
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

        // Auto-hide success alert setelah 5 detik
        const successAlert = document.querySelector('.alert-success');
        if (successAlert) {
            setTimeout(() => {
                successAlert.classList.add('animate__fadeOut');
                setTimeout(() => {
                    successAlert.remove();
                }, 1000);
            }, 5000);
        }

        // Trigger input event untuk menampilkan preview jika ada data
        if (syaratTextarea.value.trim()) {
            syaratTextarea.dispatchEvent(new Event('input'));
        }

        // Add character counter for textarea
        const updateCharacterCount = () => {
            const count = syaratTextarea.value.length;
            const counter = document.getElementById('charCount') || (() => {
                const counterEl = document.createElement('div');
                counterEl.id = 'charCount';
                counterEl.className = 'form-text text-end';
                syaratTextarea.parentNode.appendChild(counterEl);
                return counterEl;
            })();

            counter.textContent = `${count} karakter`;
        };

        syaratTextarea.addEventListener('input', updateCharacterCount);
        updateCharacterCount(); // Initial call
    });
</script>

@endsection
