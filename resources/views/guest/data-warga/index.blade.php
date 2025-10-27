


@section('content')
{{-- start main content --}}
    <!-- main content -->
    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container text-center">
            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Data Warga</h1>
            <p class="lead text-white animate__animated animate__fadeInUp">Kelola data warga desa dengan mudah dan efisien</p>
        </div>
    </div>
    <!-- Page Header End -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <!-- Stats Cards -->
            <div class="row mb-5">
                <div class="col-md-3 mb-4">
                    <div class="card card-stat bg-primary text-white shadow h-100" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-users fa-3x"></i>
                            </div>
                            <div>
                                <h4 class="mb-0">{{ $dataWarga->count() }}</h4>
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
                                <h4 class="mb-0">{{ $dataWarga->where('jenis_kelamin', 'L')->count() }}</h4>
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
                                <h4 class="mb-0">{{ $dataWarga->where('jenis_kelamin', 'P')->count() }}</h4>
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
                                <h4 class="mb-0">{{ $dataWarga->unique('pekerjaan')->count() }}</h4>
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
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-toggle="tooltip" title="Filter data warga">
                                <i class="fas fa-filter me-2"></i>Filter
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item filter-option" href="#" data-filter="all">Semua</a></li>
                                <li><a class="dropdown-item filter-option" href="#" data-filter="L">Laki-laki</a></li>
                                <li><a class="dropdown-item filter-option" href="#" data-filter="P">Perempuan</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('warga.create') }}" class="btn btn-primary" data-bs-toggle="tooltip" title="Tambah data warga baru">
                        <i class="fas fa-plus me-2"></i>Tambah Warga
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Widget Cards untuk Data Warga -->
            <div class="row" id="wargaContainer">
                @forelse($dataWarga as $index => $warga)
                <div class="col-xl-4 col-md-6 mb-4 warga-card" data-gender="{{ $warga->jenis_kelamin }}" data-name="{{ strtolower($warga->nama) }}" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                    <div class="card widget-card h-100">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">
                                <i class="fas fa-user me-2"></i>{{ $warga->nama }}
                            </h6>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-toggle="tooltip" title="Aksi">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('warga.edit', $warga->warga_id) }}">
                                            <i class="fas fa-edit me-2"></i>Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('warga.destroy', $warga->warga_id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data warga ini?')">
                                                <i class="fas fa-trash me-2"></i>Hapus
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
                                    <p class="mb-2"><i class="fas fa-id-card text-primary me-2"></i>{{ $warga->no_ktp }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <small class="text-muted">Jenis Kelamin</small>
                                    <p class="mb-2">
                                        @if($warga->jenis_kelamin == 'L')
                                            <span class="badge bg-primary"><i class="fas fa-male me-1"></i>Laki-laki</span>
                                        @else
                                            <span class="badge bg-pink"><i class="fas fa-female me-1"></i>Perempuan</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Agama</small>
                                    <p class="mb-2">{{ $warga->agama }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <small class="text-muted">Pekerjaan</small>
                                    <p class="mb-2"><i class="fas fa-briefcase text-warning me-2"></i>{{ $warga->pekerjaan }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-light">
                            <div class="row text-center">
                                <div class="col-6 border-end">
                                    <a href="tel:{{ $warga->telp }}" class="text-secondary" title="Telepon" data-bs-toggle="tooltip">
                                        <i class="fas fa-phone"></i>
                                        <small class="d-block mt-1">Telepon</small>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="mailto:{{ $warga->email }}" class="text-secondary" title="Email" data-bs-toggle="tooltip">
                                        <i class="fas fa-envelope"></i>
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
                                <i class="fas fa-plus me-2"></i>Tambah Data Warga Pertama
                            </a>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Info jumlah data -->
            @if($dataWarga->count() > 0)
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <p class="text-muted">Menampilkan {{ $dataWarga->count() }} data warga</p>
                </div>
            </div>
            @endif
        </div>
    </div>
{{-- End main content --}}

@endsection
