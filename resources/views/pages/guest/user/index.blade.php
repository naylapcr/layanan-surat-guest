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
            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Data User</h1>
            <p class="lead text-white animate__animated animate__fadeInUp">Data User Bina Desa</p>
        </div>
    </div>
    <div class="container-fluid py-5">
        <div class="container py-5">
            <!-- Stats Cards -->
            <div class="row mb-5">
                <div class="col-md-4 mb-4">
                    <div class="card card-stat bg-primary text-white shadow h-100" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-body text-center">
                            <div class="stats-number">{{ $users->count() }}</div>
                            <div class="stats-label">
                                <i class="fas fa-users me-2"></i>Total User
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-stat bg-success text-white shadow h-100" data-aos="fade-up" data-aos-delay="200">
                        <div class="card-body text-center">
                            <div class="stats-number">{{ $users->count() }}</div>
                            <div class="stats-label">
                                <i class="fas fa-user-check me-2"></i>User Aktif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-stat bg-info text-white shadow h-100" data-aos="fade-up" data-aos-delay="300">
                        <div class="card-body text-center">
                            <div class="stats-number">{{ $users->where('created_at', '>=', now()->subDays(7))->count() }}</div>
                            <div class="stats-label">
                                <i class="fas fa-clock me-2"></i>User Baru (7 hari)
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
                                <input type="text" class="form-control border-0" placeholder="Cari user..." id="searchInput">
                                <button class="btn btn-primary" type="button" id="searchButton">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-toggle="tooltip" title="Filter data user">
                                <i class="fas fa-filter me-2"></i>Filter
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item filter-option" href="#" data-filter="all">Semua</a></li>
                                <li><a class="dropdown-item filter-option" href="#" data-filter="recent">User Baru</a></li>
                                <li><a class="dropdown-item filter-option" href="#" data-filter="old">User Lama</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('user.create') }}" class="btn btn-primary" data-bs-toggle="tooltip" title="Tambah user baru">
                        <i class="fas fa-plus me-2"></i>Tambah User
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Widget Cards untuk User -->
            <div class="row" id="userContainer">
                @forelse($users as $index => $user)
                <div class="col-xl-4 col-md-6 mb-4 user-card-item" data-name="{{ strtolower($user->name) }}" data-email="{{ strtolower($user->email) }}" data-recent="{{ $user->created_at->gte(now()->subDays(7)) ? 'recent' : 'old' }}" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                    <div class="card user-card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="user-avatar me-3">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h5 class="mb-1 text-white">
                                        <i class="fas fa-user me-2"></i>{{ $user->name }}
                                    </h5>
                                    <span class="role-badge">Administrator</span>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-toggle="tooltip" title="Aksi">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('user.show', $user->id) }}">
                                            <i class="fas fa-eye me-2"></i>Lihat Detail
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('user.edit', $user->id) }}">
                                            <i class="fas fa-edit me-2"></i>Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                <i class="fas fa-trash me-2"></i>Hapus
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="user-info-list">
                                <!-- Email -->
                                <div class="user-info-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-envelope text-primary me-2"></i>
                                        <span class="text-muted">Email:</span>
                                    </div>
                                    <strong class="text-end">{{ $user->email }}</strong>
                                </div>

                                <!-- ID User -->
                                <div class="user-info-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-id-card text-primary me-2"></i>
                                        <span class="text-muted">ID User:</span>
                                    </div>
                                    <strong>#{{ $user->id }}</strong>
                                </div>

                                <!-- Status -->
                                <div class="user-info-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-circle text-primary me-2"></i>
                                        <span class="text-muted">Status:</span>
                                    </div>
                                    <span class="badge bg-success status-badge">
                                        <i class="fas fa-check-circle me-1"></i>Aktif
                                    </span>
                                </div>

                                <!-- Password Hash -->
                                <div class="user-info-item">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-lock text-primary me-2"></i>
                                        <span class="text-muted">Password (Terenkripsi):</span>
                                    </div>
                                    <div class="input-group">
                                        <input type="password"
                                               class="form-control form-control-sm password-field"
                                               value="{{ $user->password }}"
                                               readonly
                                               id="password-{{ $user->id }}">
                                        <button class="btn btn-outline-secondary btn-sm" type="button" onclick="togglePassword({{ $user->id }})">
                                            <i class="fas fa-eye" id="eye-icon-{{ $user->id }}"></i>
                                        </button>
                                        <button class="btn btn-outline-info btn-sm" type="button" onclick="copyPassword({{ $user->id }})" data-bs-toggle="tooltip" title="Salin hash password">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </div>
                                    <small class="text-muted mt-1 d-block">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Hash: {{ Str::limit($user->password, 20) }}...
                                    </small>
                                </div>

                                <!-- Tanggal Bergabung -->
                                <div class="user-info-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-plus text-primary me-2"></i>
                                        <span class="text-muted">Bergabung:</span>
                                    </div>
                                    <strong>{{ $user->created_at->format('d M Y') }}</strong>
                                </div>

                                <!-- Terakhir Diperbarui -->
                                <div class="user-info-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-sync-alt text-primary me-2"></i>
                                        <span class="text-muted">Diperbarui:</span>
                                    </div>
                                    <strong>{{ $user->updated_at->format('d M Y') }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-light">
                            <div class="row text-center">
                                <div class="col-4 border-end">
                                    <a href="{{ route('user.show', $user->id) }}" class="text-secondary" title="Lihat Detail" data-bs-toggle="tooltip">
                                        <i class="fas fa-eye"></i>
                                        <small class="d-block mt-1">Detail</small>
                                    </a>
                                </div>
                                <div class="col-4 border-end">
                                    <a href="{{ route('user.edit', $user->id) }}" class="text-secondary" title="Edit User" data-bs-toggle="tooltip">
                                        <i class="fas fa-edit"></i>
                                        <small class="d-block mt-1">Edit</small>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')" title="Hapus User" data-bs-toggle="tooltip">
                                            <i class="fas fa-trash"></i>
                                            <small class="d-block mt-1">Hapus</small>
                                        </button>
                                    </form>
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
                            <h4 class="text-muted">Belum ada data user</h4>
                            <p class="text-muted mb-4">Mulai dengan menambahkan user pertama</p>
                            <a href="{{ route('user.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Tambah User Pertama
                            </a>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Info jumlah data -->
            @if($users->count() > 0)
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <p class="text-muted">Menampilkan {{ $users->count() }} user</p>
                </div>
            </div>
            @endif
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
