{{-- start css --}}
@include('layouts.guest.css')
<body>
{{-- end css --}}

{{-- start header --}}
@include('layouts.guest.header')
{{-- end header --}}
    <!-- Content Start -->
     <div class="page-header">
        <div class="container text-center">
            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Edit Jenis Surat</h1>
            <p class="lead text-white animate__animated animate__fadeInUp">Edit jenis surat baru ke sistem</p>
        </div>
    </div>
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card form-card animate__animated animate__fadeInUp">
                        <div class="form-header text-center">
                            <h3 class="mb-0">
                                <i class="fas fa-file-alt me-2"></i>
                                Formulir Edit Jenis Surat
                            </h3>
                        </div>
                        <div class="form-body">
                            <form method="POST" action="{{ route('jenis-surat.update', $dataJenisSurat->jenis_id) }}">
                                @csrf
                                @method('PUT')

                                @if($errors->any())
                                    <div class="alert alert-danger animate__animated animate__shakeX">
                                        <h5><i class="fas fa-exclamation-triangle me-2"></i>Terjadi Kesalahan</h5>
                                        <ul class="mb-0 mt-2">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="kode" class="form-label">Kode Surat *</label>
                                        <div class="input-group-icon">
                                            <input type="text" class="form-control" id="kode" name="kode"
                                                   value="{{ old('kode', $dataJenisSurat->kode) }}" required
                                                   placeholder="Contoh: SKD, SKTM">
                                            <i class="fas fa-code form-icon"></i>
                                        </div>
                                        <div class="form-text">Kode unik untuk jenis surat (contoh: SKD, SKTM, SKU)</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nama_jenis" class="form-label">Nama Jenis Surat *</label>
                                        <div class="input-group-icon">
                                            <input type="text" class="form-control" id="nama_jenis" name="nama_jenis"
                                                   value="{{ old('nama_jenis', $dataJenisSurat->nama_jenis) }}" required
                                                   placeholder="Contoh: Surat Keterangan Domisili">
                                            <i class="fas fa-file-signature form-icon"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="syarat_json" class="form-label">Syarat-syarat</label>
                                    <div class="input-group-icon">
                                        <textarea class="form-control" id="syarat_json" name="syarat_json" rows="4"
                                                  placeholder="Masukkan syarat-syarat yang diperlukan, pisahkan dengan koma">{{ old('syarat_json', $dataJenisSurat->syarat_json) }}</textarea>
                                        <i class="fas fa-clipboard-list form-icon" style="top: 20px;"></i>
                                    </div>
                                    <div class="form-text">Pisahkan setiap syarat dengan koma (contoh: Fotokopi KTP, Fotokopi KK, Surat Pengantar RT)</div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-5">
                                    <a href="{{ route('jenis-surat.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-submit">
                                        <i class="fas fa-save me-2"></i>Perbarui
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content End -->

    {{-- start footer --}}
@include('layouts.guest.footer')
    {{-- end footer --}}

    {{-- start js --}}
@include('layouts.guest.js')
</body>
</html>
{{-- end js --}}
