{{-- start css --}}
@include('layouts.guest.css')
{{-- end css --}}

{{-- start header --}}
@include('layouts.guest.header')
{{-- end header --}}

{{-- main content --}}
        <!-- Content Start -->
     <div class="page-header">
        <div class="container text-center">
            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Data Warga</h1>
            <p class="lead text-white animate__animated animate__fadeInUp">Menampilkan Data Warga Bina Desa</p>
        </div>
    </div>
    <div class="container-fluid py-5">
        <div class="container py-5">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="row mb-5">
                <div class="col-md-3 mb-4">
                    <div class="card card-stat bg-primary text-white shadow h-100" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-users fa-3x"></i>
                            </div>
                            <div>
                                <h4 class="mb-0">{{ $warga->count() }}</h4>
                                <p class="mb-0">Total Warga</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card card-stat bg-success text-white shadow h-100" data-aos="fade-up" data-aos-delay="200">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-male fa-3x"></i>
                            </div>
                            <div>
                                <h4 class="mb-0">{{ $warga->where('jenis_kelamin', 'L')->count() }}</h4>
                                <p class="mb-0">Laki-laki</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card card-stat bg-info text-white shadow h-100" data-aos="fade-up" data-aos-delay="300">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-female fa-3x"></i>
                            </div>
                            <div>
                                <h4 class="mb-0">{{ $warga->where('jenis_kelamin', 'P')->count() }}</h4>
                                <p class="mb-0">Perempuan</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card card-stat bg-warning text-white shadow h-100" data-aos="fade-up" data-aos-delay="400">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-briefcase fa-3x"></i>
                            </div>
                            <div>
                                <h4 class="mb-0">{{ $warga->pluck('pekerjaan')->unique()->count() }}</h4>
                                <p class="mb-0">Jenis Pekerjaan</p>
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
                                <input type="text" class="form-control border-0" placeholder="Cari warga..." id="searchInput">
                                <button class="btn btn-primary" type="button" id="searchButton">
                                    <i class="fas fa-search me-2"></i>Cari
                                </button>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-toggle="tooltip" title="Filter data warga">
                                <i class="fas fa-filter me-2"></i>Filter
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item filter-option" href="#" data-filter="all">
                                    <i class="fas fa-list me-2"></i>Semua
                                </a></li>
                                <li><a class="dropdown-item filter-option" href="#" data-filter="L">
                                    <i class="fas fa-male me-2"></i>Laki-laki
                                </a></li>
                                <li><a class="dropdown-item filter-option" href="#" data-filter="P">
                                    <i class="fas fa-female me-2"></i>Perempuan
                                </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('warga.create') }}" class="btn btn-primary" data-bs-toggle="tooltip" title="Tambah data warga baru">
                        <i class="fas fa-user-plus me-2"></i>Tambah Warga
                    </a>
                </div>
            </div>

            <!-- Widget Cards untuk Data Warga -->
            <div class="row" id="wargaContainer">
                @forelse($warga as $data)
                <div class="col-xl-4 col-md-6 mb-4 warga-card" data-gender="{{ $data->jenis_kelamin }}" data-name="{{ strtolower($data->nama) }}">
                    <div class="card widget-card h-100">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">
                                <i class="fas fa-user me-2"></i>{{ $data->nama }}
                            </h6>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-toggle="tooltip" title="Aksi">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('warga.edit', $data->warga_id) }}">
                                            <i class="fas fa-edit me-2"></i>Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form id="delete-form-{{ $data->warga_id }}" action="{{ route('warga.destroy', $data->warga_id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data warga ini?')">
                                                <i class="fas fa-trash-alt me-2"></i>Hapus
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <small class="text-muted">NIK</small>
                                    <p class="mb-2"><i class="fas fa-id-card text-primary me-2"></i>{{ $data->no_ktp }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <small class="text-muted">Jenis Kelamin</small>
                                    <p class="mb-2">
                                        @if($data->jenis_kelamin == 'L')
                                            <span class="badge bg-primary"><i class="fas fa-male me-1"></i>Laki-laki</span>
                                        @else
                                            <span class="badge bg-pink"><i class="fas fa-female me-1"></i>Perempuan</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Agama</small>
                                    <p class="mb-2"><i class="fas fa-pray me-2"></i>{{ $data->agama }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <small class="text-muted">Pekerjaan</small>
                                    <p class="mb-2"><i class="fas fa-briefcase text-warning me-2"></i>{{ $data->pekerjaan }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-light">
                            <div class="row text-center">
                                <div class="col-6 border-end">
                                    <a href="tel:{{ $data->telp }}" class="text-secondary" title="Telepon" data-bs-toggle="tooltip">
                                        <i class="fas fa-phone-alt"></i>
                                        <small class="d-block mt-1">Telepon</small>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="mailto:{{ $data->email }}" class="text-secondary" title="Email" data-bs-toggle="tooltip">
                                        <i class="fas fa-envelope-open"></i>
                                        <small class="d-block mt-1">Email</small>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="card text-center py-5" data-aos="fade-up">
                        <div class="card-body">
                            <i class="fas fa-users fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">Belum ada data warga</h4>
                            <p class="text-muted mb-4">Mulai dengan menambahkan data warga pertama</p>
                            <a href="{{ route('warga.create') }}" class="btn btn-primary">
                                <i class="fas fa-user-plus me-2"></i>Tambah Warga Pertama
                            </a>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Info jumlah data -->
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <p class="text-muted" id="dataInfo">
                        <i class="fas fa-info-circle me-2"></i>Menampilkan {{ $warga->count() }} data warga
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Content End -->
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas fa-trash-alt fa-4x text-danger mb-3"></i>
                    <h5>Apakah Anda yakin ingin menghapus data warga ini?</h5>
                    <p class="text-muted">Data yang sudah dihapus tidak dapat dikembalikan</p>
                    <p><strong id="deleteWargaName"></strong></p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt me-2"></i>Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- end content --}}

    {{-- end content --}}
{{-- start footer --}}
@include('layouts.guest.footer')
   {{-- end footer --}}

   {{-- start js --}}
  @include('layouts.guest.js')
</body>
</html>
{{-- end js --}}
