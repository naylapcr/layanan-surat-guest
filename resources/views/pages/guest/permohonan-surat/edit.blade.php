@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Permohonan Surat</h4>
                </div>

                <div class="card-body">
                    <!-- Debug Info -->
                    @php
                        // Debug: Cek data yang diterima
                        // dd($dataJenisSurat, $dataWarga);
                    @endphp

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Debug Alert -->
                    @if($dataJenisSurat->isEmpty())
                        <div class="alert alert-warning">
                            <strong>Peringatan:</strong> Data jenis surat tidak ditemukan.
                            Pastikan tabel <code>jenis_surat</code> memiliki data.
                        </div>
                    @endif

                    @if($dataWarga->isEmpty())
                        <div class="alert alert-warning">
                            <strong>Peringatan:</strong> Data warga tidak ditemukan.
                            Pastikan tabel <code>warga</code> memiliki data.
                        </div>
                    @endif

                    <form action="{{ route('permohonan-surat.update', $permohonanSurat->permohonan_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nomor Permohonan (readonly) -->
                        <div class="form-group mb-3">
                            <label for="nomor_permohonan" class="form-label">Nomor Permohonan *</label>
                            <input type="text" class="form-control" id="nomor_permohonan"
                                   value="{{ $permohonanSurat->nomor_permohonan }}" readonly>
                            <small class="form-text text-muted">Nomor unik permohonan surat</small>
                        </div>

                        <!-- Jenis Surat -->
                        <div class="form-group mb-3">
                            <label for="jenis_surat_id" class="form-label">Jenis Surat *</label>
                            <select name="jenis_surat_id" id="jenis_surat_id" class="form-control @error('jenis_surat_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Jenis Surat --</option>
                                @forelse($dataJenisSurat as $jenis)
                                    <option value="{{ $jenis->jenis_surat_id }}"
                                        {{ $permohonanSurat->jenis_surat_id == $jenis->jenis_surat_id ? 'selected' : '' }}>
                                        {{ $jenis->nama_jenis_surat }} ({{ $jenis->kode_jenis_surat ?? 'No Code' }})
                                    </option>
                                @empty
                                    <option value="" disabled>Tidak ada data jenis surat</option>
                                @endforelse
                            </select>
                            @error('jenis_surat_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                @if($dataJenisSurat->isNotEmpty())
                                    Contoh: Pilih "{{ $dataJenisSurat->first()->nama_jenis_surat }}"
                                @else
                                    Tidak ada data jenis surat tersedia
                                @endif
                            </small>
                        </div>

                        <!-- Pemohon -->
                        <div class="form-group mb-3">
                            <label for="warga_id" class="form-label">Pemohon *</label>
                            <select name="warga_id" id="warga_id" class="form-control @error('warga_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Nama Pemohon --</option>
                                @forelse($dataWarga as $warga)
                                    <option value="{{ $warga->warga_id }}"
                                        {{ $permohonanSurat->warga_id == $warga->warga_id ? 'selected' : '' }}>
                                        {{ $warga->nama }}
                                        @if($warga->nik)
                                            - {{ $warga->nik }}
                                        @endif
                                    </option>
                                @empty
                                    <option value="" disabled>Tidak ada data warga</option>
                                @endforelse
                            </select>
                            @error('warga_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                @if($dataWarga->isNotEmpty())
                                    Contoh: Pilih "{{ $dataWarga->first()->nama }}"
                                @else
                                    Tidak ada data warga tersedia
                                @endif
                            </small>
                        </div>

                        <!-- Status -->
                        <div class="form-group mb-3">
                            <label for="status" class="form-label">Status *</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="DRAFT" {{ $permohonanSurat->status == 'DRAFT' ? 'selected' : '' }}>DRAFT - Masih dalam proses pengisian</option>
                                <option value="DIAJUKAN" {{ $permohonanSurat->status == 'DIAJUKAN' ? 'selected' : '' }}>DIAJUKAN - Sudah diajukan ke admin</option>
                                <option value="DIPROSES" {{ $permohonanSurat->status == 'DIPROSES' ? 'selected' : '' }}>DIPROSES - Sedang diproses oleh admin</option>
                                <option value="SELESAI" {{ $permohonanSurat->status == 'SELESAI' ? 'selected' : '' }}>SELESAI - Surat sudah selesai</option>
                                <option value="DIAMBIL" {{ $permohonanSurat->status == 'DIAMBIL' ? 'selected' : '' }}>DIAMBIL - Surat sudah diambil pemohon</option>
                                <option value="DITOLAK" {{ $permohonanSurat->status == 'DITOLAK' ? 'selected' : '' }}>DITOLAK - Permohonan ditolak</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Contoh: Pilih "DIAJUKAN" untuk mengajukan permohonan</small>
                        </div>

                        <!-- Tanggal Pengajuan -->
                        <div class="form-group mb-3">
                            <label for="tanggal_pengajuan" class="form-label">Tanggal Pengajuan *</label>
                            <input type="date" name="tanggal_pengajuan" id="tanggal_pengajuan"
                                   class="form-control @error('tanggal_pengajuan') is-invalid @enderror"
                                   value="{{ $permohonanSurat->tanggal_pengajuan }}" required readonly>
                            @error('tanggal_pengajuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Tanggal pengajuan permohonan (tidak dapat diubah)</small>
                        </div>

                        <!-- Catatan -->
                        <div class="form-group mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea name="catatan" id="catatan" class="form-control @error('catatan') is-invalid @enderror"
                                      rows="3" placeholder="Masukkan catatan tambahan jika diperlukan">{{ $permohonanSurat->catatan }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Contoh: "Untuk keperluan pengajuan beasiswa" atau "Lampiran: FC KTP dan KK"</small>
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update Permohonan</button>
                            <a href="{{ route('permohonan-surat.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
