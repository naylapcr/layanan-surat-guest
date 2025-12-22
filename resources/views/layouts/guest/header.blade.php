{{-- start header --}}
<!-- Topbar Start -->
<div class="container-fluid bg-primary px-5 d-none d-lg-block">
    <div class="row gx-0 align-items-center">
        <div class="col-lg-5 text-center text-lg-start mb-lg-0">
            <div class="d-flex">
                <a href="#" class="text-white me-4"><i
                        class="fas fa-envelope text-light me-2"></i>admin@layanansurat.com</a>
                <a href="#" class="text-white me-0"><i class="fas fa-phone-alt text-light me-2"></i>+01234567890</a>
            </div>
        </div>
        <div class="col-lg-3 row-cols-1 text-center mb-2 mb-lg-0">
            <div class="d-inline-flex align-items-center" style="height: 45px;">
                <a class="btn btn-sm btn-outline-light btn-square rounded-circle me-2" href=""><i
                        class="fab fa-twitter fw-normal text-light"></i></a>
                <a class="btn btn-sm btn-outline-light btn-square rounded-circle me-2" href=""><i
                        class="fab fa-facebook-f fw-normal text-light"></i></a>
                <a class="btn btn-sm btn-outline-light btn-square rounded-circle me-2" href=""><i
                        class="fab fa-linkedin-in fw-normal text-light"></i></a>
                <a class="btn btn-sm btn-outline-light btn-square rounded-circle me-2" href=""><i
                        class="fab fa-instagram fw-normal text-light"></i></a>
                <a class="btn btn-sm btn-outline-light btn-square rounded-circle" href=""><i
                        class="fab fa-youtube fw-normal text-light"></i></a>
            </div>
        </div>
        <div class="col-lg-4 text-center text-lg-end">
            <div class="d-inline-flex align-items-center" style="height: 45px;">
                <a href="#" class="text-white me-2"><i class="fas fa-question-circle me-1"></i> Bantuan</a><small
                    class="text-white"> / </small>
                <a href="#" class="text-white mx-2"><i class="fas fa-headset me-1"></i> Dukungan</a><small
                    class="text-white"> / </small>
                <a href="#" class="text-white ms-2"><i class="fas fa-phone me-1"></i> Kontak</a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar & Hero Start -->
<div class="container-fluid nav-bar p-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 px-lg-5 py-3 py-lg-0">
        <a href="{{ url('/') }}" class="navbar-brand p-0">
            <h1 class="display-5 text-secondary m-0"><img src="{{ asset('assets-guest/img/logo-website.png') }}"
                    class="img-fluid" alt=""></h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="{{ url('/dashboard') }}"
                    class="nav-item nav-link {{ request()->is('/dashboard') ? 'active' : '' }}"><i
                        class="fas fa-home me-1"></i>Beranda</a>
                <a href="{{ route('about') }}"
                    class="nav-item nav-link {{ request()->routeIs('about') ? 'active' : '' }}"><i
                        class="fas fa-info-circle me-1"></i>Tentang</a><a href="{{ route('warga.index') }}"
                    class="nav-item nav-link {{ request()->routeIs('warga.index') ? 'active' : '' }}"><i
                        class="fas fa-users me-1"></i>Data Warga</a>
                <a href="{{ route('jenis-surat.index') }}"
                    class="nav-item nav-link {{ request()->routeIs('jenis-surat.index') ? 'active' : '' }}"><i
                        class="fas fa-envelope me-1"></i>Jenis Surat</a>
                <a href="{{ route('permohonan-surat.index') }}"
                    class="nav-item nav-link {{ request()->routeIs('permohonan-surat.index') ? 'active' : '' }}"><i
                        class="fas fa-file-import me-1"></i>Permohonan Surat</a>
                <div class="nav-item dropdown">
                    <a href="#"
                        class="nav-link dropdown-toggle {{ request()->is('feature', 'countries', 'testimonial') ? 'active' : '' }}"
                        data-bs-toggle="dropdown"><i class="fas fa-concierge-bell me-1"></i><span
                            class="dropdown-toggle">Layanan</span></a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ route('permohonan-surat.create') }}" class="dropdown-item"><i
                                class="fas fa-file-import me-2"></i>Ajukan Permohonan</a>
                        <a href="{{ route('permohonan-surat.index') }}" class="dropdown-item"><i
                                class="fas fa-tasks me-2"></i>Status Permohonan</a>
                        <a href="testimonial.html" class="dropdown-item"><i
                                class="fas fa-question-circle me-2"></i>Bantuan</a>
                    </div>
                </div>
                <a href="contact.html" class="nav-item nav-link {{ request()->is('contact') ? 'active' : '' }}"><i
                        class="fas fa-address-book me-1"></i>Kontak</a>
                <a href="{{ route('user.index') }}"
                    class="nav-item nav-link {{ request()->routeIs('user.index') ? 'active' : '' }}"><i
                        class="fas fa-user-cog me-1"></i>Data User</a>

                <!-- Profile Dropdown -->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center"
                        data-bs-toggle="dropdown">

                        {{-- LOGIKA TAMPILAN FOTO --}}
                        @if (Auth::check() && Auth::user()->foto_profil)
                            {{-- Jika user login & punya foto, tampilkan gambarnya --}}
                            <img src="{{ asset('uploads/profile/' . Auth::user()->foto_profil) }}" alt="Profile"
                                class="rounded-circle me-2"
                                style="width: 30px; height: 30px; object-fit: cover; border: 2px solid #fff;">
                        @else
                            {{-- Jika tidak ada foto/belum login, tampilkan icon default --}}
                            <i class="fas fa-user-circle me-2" style="font-size: 1.5rem;"></i>
                        @endif

                        {{-- TAMPILKAN NAMA --}}
                        <span class="text-truncate" style="max-width: 100px;">
                            {{ Auth::user()->name ?? 'Guest' }}
                        </span>
                    </a>
                    <div class="dropdown-menu m-0">
                        @auth
                            <a href="{{ route('user.show', Auth::user()->id) }}" class="dropdown-item">
                                <i class="fas fa-user me-2"></i>Profil Saya
                            </a>
                        @endauth
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('login') }}" class="dropdown-item"><i
                                class="fas fa-sign-in-alt me-2"></i>Login</a>
                        {{-- Tombol Logout dengan Script --}}
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a>

                        {{-- Form Tersembunyi untuk Handle POST Request --}}
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-md-square border-secondary mb-3 mb-md-3 mb-lg-0 me-3"
                data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search"></i></button>
            <a href="{{ route('permohonan-surat.create') }}"
                class="btn btn-primary border-secondary rounded-pill py-2 px-4 px-lg-3 mb-3 mb-md-3 mb-lg-0"><i
                    class="fas fa-paper-plane me-2"></i>Ajukan Surat</a>
        </div>
    </nav>
</div>

<!-- Navbar & Hero End -->
{{-- End header --}}
