@extends('layouts.guest.app')

@section('content')
<div class="page-header">
    <div class="container text-center">
        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Detail User</h1>
        <p class="lead text-white animate__animated animate__fadeInUp">Informasi lengkap pengguna</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg animate__animated animate__fadeInUp">
                <div class="card-body p-5">
                    <div class="text-center mb-5">
                        <div class="position-relative d-inline-block">
                            @if($user->foto_profil)
                                <img src="{{ asset('uploads/profile/' . $user->foto_profil) }}"
                                     class="rounded-circle img-thumbnail shadow"
                                     style="width: 150px; height: 150px; object-fit: cover;"
                                     alt="{{ $user->name }}">
                            @else
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto shadow"
                                     style="width: 150px; height: 150px; font-size: 4rem;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                            <span class="position-absolute bottom-0 end-0 badge rounded-pill bg-warning text-dark border border-white p-2">
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>
                        <h2 class="mt-3 fw-bold">{{ $user->name }}</h2>
                        <p class="text-muted">{{ $user->email }}</p>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-3 border rounded bg-light">
                                <small class="text-uppercase text-muted fw-bold d-block mb-1">Tanggal Bergabung</small>
                                <h6 class="mb-0"><i class="fas fa-calendar-alt me-2 text-primary"></i>{{ $user->created_at->format('d F Y') }}</h6>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded bg-light">
                                <small class="text-uppercase text-muted fw-bold d-block mb-1">Terakhir Diperbarui</small>
                                <h6 class="mb-0"><i class="fas fa-history me-2 text-primary"></i>{{ $user->updated_at->diffForHumans() }}</h6>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-3 mt-5">
                        <a href="{{ route('user.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary px-4">
                            <i class="fas fa-edit me-2"></i>Edit Profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
