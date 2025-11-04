{{-- start css --}}
@include('layouts.guest.css')
{{-- end css --}}

{{-- start header --}}
        <!-- Topbar Start -->
        <div class="container-fluid bg-primary px-5 d-none d-lg-block">
            <div class="row gx-0 align-items-center">
                <div class="col-lg-5 text-center text-lg-start mb-lg-0">
                    <div class="d-flex">
                        <a href="#" class="text-white me-4"><i class="fas fa-envelope text-light me-2"></i>admin@binadesa.com</a>
                        <a href="#" class="text-white me-0"><i class="fas fa-phone-alt text-light me-2"></i>+01234567890</a>
                    </div>
                </div>
                <div class="col-lg-3 row-cols-1 text-center mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center" style="height: 45px;">
                        <a class="btn btn-sm btn-outline-light btn-square rounded-circle me-2" href=""><i class="fab fa-twitter fw-normal text-light"></i></a>
                        <a class="btn btn-sm btn-outline-light btn-square rounded-circle me-2" href=""><i class="fab fa-facebook-f fw-normal text-light"></i></a>
                        <a class="btn btn-sm btn-outline-light btn-square rounded-circle me-2" href=""><i class="fab fa-linkedin-in fw-normal text-light"></i></a>
                        <a class="btn btn-sm btn-outline-light btn-square rounded-circle me-2" href=""><i class="fab fa-instagram fw-normal text-light"></i></a>
                        <a class="btn btn-sm btn-outline-light btn-square rounded-circle" href=""><i class="fab fa-youtube fw-normal text-light"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <div class="d-inline-flex align-items-center" style="height: 45px;">
                        <a href="#" class="text-white me-2"><i class="fas fa-question-circle me-1"></i> Bantuan</a><small class="text-white"> / </small>
                        <a href="#" class="text-white mx-2"><i class="fas fa-headset me-1"></i> Dukungan</a><small class="text-white"> / </small>
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
                    <h1 class="display-5 text-secondary m-0"><img src="{{ asset('assets-guest/img/brand-logo.png') }}" class="img-fluid" alt="">Bina Desa</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="{{ url('/') }}" class="nav-item nav-link active"><i class="fas fa-home me-1"></i>Beranda</a>
                        <a href="{{ route ('about') }}" class="nav-item nav-link"><i class="fas fa-info-circle me-1"></i>Tentang</a>
                        <a href="{{ route('warga.index') }}" class="nav-item nav-link"><i class="fas fa-users me-1"></i>Data Warga</a>
                        <a href="{{ route('jenis-surat.index') }}" class="nav-item nav-link"><i class="fas fa-envelope me-1"></i>Jenis Surat</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-bs-toggle="dropdown"><i class="fas fa-concierge-bell me-1"></i><span class="dropdown-toggle">Layanan</span></a>
                            <div class="dropdown-menu m-0">
                                <a href="feature.html" class="dropdown-item"><i class="fas fa-file-import me-2"></i>Pengajuan Surat</a>
                                <a href="countries.html" class="dropdown-item"><i class="fas fa-tasks me-2"></i>Status Surat</a>
                                <a href="testimonial.html" class="dropdown-item"><i class="fas fa-question-circle me-2"></i>Bantuan</a>
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link"><i class="fas fa-address-book me-1"></i>Kontak</a>
                        <a href="{{ route('user.index') }}" class="nav-item nav-link"><i class="fas fa-user-cog me-1"></i>Data User</a>

                        <!-- Profile Dropdown -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i>Profile
                            </a>
                            <div class="dropdown-menu m-0">
                                <a href="#" class="dropdown-item"><i class="fas fa-user me-2"></i>Profil Saya</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-cog me-2"></i>Pengaturan</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-history me-2"></i>Riwayat</a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('login') }}" class="dropdown-item"><i class="fas fa-sign-in-alt me-2"></i>Login</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-md-square border-secondary mb-3 mb-md-3 mb-lg-0 me-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search"></i></button>
                    <a href="" class="btn btn-primary border-secondary rounded-pill py-2 px-4 px-lg-3 mb-3 mb-md-3 mb-lg-0"><i class="fas fa-paper-plane me-2"></i>Ajukan Surat</a>
                </div>
            </nav>
        </div>
        <!-- Navbar & Hero End -->

        {{-- main content --}}
        <!-- Carousel Start -->
        <div class="carousel-header">
            <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img src="{{ asset('assets-guest/img/carousel-1.jpg') }}" class="img-fluid" alt="Image">
                        <div class="carousel-caption">
                            <div class="text-center p-4" style="max-width: 900px;">
                                <h4 class="text-white text-uppercase fw-bold mb-3 mb-md-4 wow fadeInUp" data-wow-delay="0.1s"><i class="fas fa-mail-bulk me-2"></i>Layanan Surat Menyurat Terpadu</h4>
                                <h1 class="display-1 text-capitalize text-white mb-3 mb-md-4 wow fadeInUp" data-wow-delay="0.3s">Sistem Surat Bina Desa</h1>
                                <p class="text-white mb-4 mb-md-5 fs-5 wow fadeInUp" data-wow-delay="0.5s"><i class="fas fa-check-circle me-2"></i>Melayani berbagai kebutuhan administrasi surat menyurat untuk warga desa dengan cepat, mudah, dan terpercaya.
                                </p>
                                <a class="btn btn-primary border-secondary rounded-pill text-white py-3 px-5 wow fadeInUp" data-wow-delay="0.7s" href="#"><i class="fas fa-paper-plane me-2"></i>Ajukan Sekarang</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets-guest/img/carousel-2.jpg') }}" class="img-fluid" alt="Image">
                        <div class="carousel-caption">
                            <div class="text-center p-4" style="max-width: 900px;">
                                <h5 class="text-white text-uppercase fw-bold mb-3 mb-md-4 wow fadeInUp" data-wow-delay="0.1s"><i class="fas fa-award me-2"></i>Pelayanan Terbaik Untuk Warga</h5>
                                <h1 class="display-1 text-capitalize text-white mb-3 mb-md-4 wow fadeInUp" data-wow-delay="0.3s">Administrasi Digital Desa</h1>
                                <p class="text-white mb-4 mb-md-5 fs-5 wow fadeInUp" data-wow-delay="0.5s"><i class="fas fa-digital-tachograph me-2"></i>Transformasi layanan administrasi desa menuju digitalisasi untuk kemudahan dan transparansi.
                                </p>
                                <a class="btn btn-primary border-secondary rounded-pill text-white py-3 px-5 wow fadeInUp" data-wow-delay="0.7s" href="#"><i class="fas fa-info-circle me-2"></i>Pelajari Lebih Lanjut</a>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-secondary wow fadeInLeft" data-wow-delay="0.2s" aria-hidden="false"></span>
                    <span class="visually-hidden-focusable">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-secondary wow fadeInRight" data-wow-delay="0.2s" aria-hidden="false"></span>
                    <span class="visually-hidden-focusable">Next</span>
                </button>
            </div>
        </div>
        <!-- Carousel End -->


        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title text-secondary mb-0" id="exampleModalLabel"><i class="fas fa-search me-2"></i>Cari layanan</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="Ketik kata kunci..." aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->



        <!-- About Start -->
        <div class="container-fluid py-5" id="about">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-xl-5 wow fadeInLeft" data-wow-delay="0.1s">
                        <div class="bg-light rounded">
                            <img src="{{ asset('assets-guest/img/about-2.png') }}" class="img-fluid w-100" style="margin-bottom: -7px;" alt="Image">
                            <img src="{{ asset('assets-guest/img/about-3.jpg') }}" class="img-fluid w-100 border-bottom border-5 border-primary" style="border-top-right-radius: 300px; border-top-left-radius: 300px;" alt="Image">
                        </div>
                    </div>
                    <div class="col-xl-7 wow fadeInRight" data-wow-delay="0.3s">
                        <h5 class="sub-title pe-3"><i class="fas fa-info-circle me-2"></i>Tentang Kami</h5>
                        <h1 class="display-5 mb-4">Sistem Surat Menyurat Bina Desa.</h1>
                        <p class="mb-4"><i class="fas fa-check text-primary me-2"></i>Kami hadir untuk mempermudah proses administrasi surat menyurat di Desa Bina. Dengan sistem yang terintegrasi, warga dapat mengajukan berbagai jenis surat dengan mudah dan cepat.</p>
                        <div class="row gy-4 align-items-center">
                            <div class="col-12 col-sm-6 d-flex align-items-center">
                                <i class="fas fa-map-marked-alt fa-3x text-secondary"></i>
                                <h5 class="ms-4"><i class="fas fa-check text-primary me-2"></i>Layanan Terpadu</h5>
                            </div>
                            <div class="col-12 col-sm-6 d-flex align-items-center">
                                <i class="fas fa-passport fa-3x text-secondary"></i>
                                <h5 class="ms-4"><i class="fas fa-check text-primary me-2"></i>Proses Cepat</h5>
                            </div>
                            <div class="col-4 col-md-3">
                                <div class="bg-light text-center rounded p-3">
                                    <div class="mb-2">
                                        <i class="fas fa-ticket-alt fa-4x text-primary"></i>
                                    </div>
                                    <h1 class="display-5 fw-bold mb-2">5</h1>
                                    <p class="text-muted mb-0">Tahun Pengalaman</p>
                                </div>
                            </div>
                            <div class="col-8 col-md-9">
                                <div class="mb-5">
                                    <p class="text-primary h6 mb-3"><i class="fa fa-check-circle text-secondary me-2"></i> Pelayanan 24 Jam</p>
                                    <p class="text-primary h6 mb-3"><i class="fa fa-check-circle text-secondary me-2"></i> Proses Lebih Cepat</p>
                                    <p class="text-primary h6 mb-3"><i class="fa fa-check-circle text-secondary me-2"></i> Bimbingan Langsung</p>
                                </div>
                                <div class="d-flex flex-wrap">
                                    <div id="phone-tada" class="d-flex align-items-center justify-content-center me-4">
                                        <a href="" class="position-relative wow tada" data-wow-delay=".9s">
                                            <i class="fa fa-phone-alt text-primary fa-3x"></i>
                                            <div class="position-absolute" style="top: 0; left: 25px;">
                                                <span><i class="fa fa-comment-dots text-secondary"></i></span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <span class="text-primary"><i class="fas fa-question-circle me-1"></i>Punya pertanyaan?</span>
                                        <span class="text-secondary fw-bold fs-5" style="letter-spacing: 2px;"><i class="fas fa-phone me-1"></i>+0123 456 7890</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Counter Facts Start -->
        <div class="container-fluid counter-facts py-5">
            <div class="container py-5">
                <div class="row g-4">
                    <div class="col-12 col-sm-6 col-md-6 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="counter">
                            <div class="counter-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="counter-content">
                                <h3>Warga Terdaftar</h3>
                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="counter-value" data-toggle="counter-up">1500</span>
                                    <h4 class="text-secondary mb-0" style="font-weight: 600; font-size: 25px;">+</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="counter">
                            <div class="counter-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="counter-content">
                                <h3>Surat Diproses</h3>
                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="counter-value" data-toggle="counter-up">1250</span>
                                    <h4 class="text-secondary mb-0" style="font-weight: 600; font-size: 25px;">+</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="counter">
                            <div class="counter-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="counter-content">
                                <h3>Jenis Surat</h3>
                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="counter-value" data-toggle="counter-up">8</span>
                                    <h4 class="text-secondary mb-0" style="font-weight: 600; font-size: 25px;"></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="counter">
                            <div class="counter-icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <div class="counter-content">
                                <h3>Kepuasan</h3>
                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="counter-value" data-toggle="counter-up">98</span>
                                    <h4 class="text-secondary mb-0" style="font-weight: 600; font-size: 25px;">%</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Counter Facts End -->


        <!-- Services Start -->
        <div class="container-fluid service overflow-hidden pt-5">
            <div class="container py-5">
                <div class="section-title text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="sub-style">
                        <h5 class="sub-title text-primary px-3"><i class="fas fa-concierge-bell me-2"></i>Jenis Layanan</h5>
                    </div>
                    <h1 class="display-5 mb-4">Layanan Surat Yang Tersedia</h1>
                    <p class="mb-0"><i class="fas fa-info-circle me-2"></i>Berbagai jenis surat administrasi dapat diajukan melalui sistem kami. Pilih layanan yang sesuai dengan kebutuhan Anda.</p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item">
                            <div class="service-inner">
                                <div class="service-img">
                                    <img src="{{ asset('assets-guest/img/service-1.jpg') }}" class="img-fluid w-100 rounded" alt="Image">
                                </div>
                                <div class="service-title">
                                    <div class="service-title-name">
                                        <div class="bg-primary text-center rounded p-3 mx-5 mb-4">
                                            <a href="#" class="h4 text-white mb-0"><i class="fas fa-home me-2"></i>Surat Domisili</a>
                                        </div>
                                        <a class="btn bg-light text-secondary rounded-pill py-3 px-5 mb-4" href="#"><i class="fas fa-paper-plane me-2"></i>Ajukan Sekarang</a>
                                    </div>
                                    <div class="service-content pb-4">
                                        <a href="#"><h4 class="text-white mb-4 py-3"><i class="fas fa-home me-2"></i>Surat Keterangan Domisili</h4></a>
                                        <div class="px-4">
                                            <p class="mb-4"><i class="fas fa-check-circle me-2"></i>Surat keterangan tempat tinggal untuk keperluan administrasi.</p>
                                            <a class="btn btn-primary border-secondary rounded-pill py-3 px-5" href="#"><i class="fas fa-paper-plane me-2"></i>Ajukan Sekarang</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="service-item">
                            <div class="service-inner">
                                <div class="service-img">
                                    <img src="{{ asset('assets-guest/img/service-2.jpg') }}" class="img-fluid w-100 rounded" alt="Image">
                                </div>
                                <div class="service-title">
                                    <div class="service-title-name">
                                        <div class="bg-primary text-center rounded p-3 mx-5 mb-4">
                                            <a href="#" class="h4 text-white mb-0"><i class="fas fa-hand-holding-heart me-2"></i>Surat Tidak Mampu</a>
                                        </div>
                                        <a class="btn bg-light text-secondary rounded-pill py-3 px-5 mb-4" href="#"><i class="fas fa-paper-plane me-2"></i>Ajukan Sekarang</a>
                                    </div>
                                    <div class="service-content pb-4">
                                        <a href="#"><h4 class="text-white mb-4 py-3"><i class="fas fa-hand-holding-heart me-2"></i>Surat Keterangan Tidak Mampu</h4></a>
                                        <div class="px-4">
                                            <p class="mb-4"><i class="fas fa-check-circle me-2"></i>Surat untuk keperluan bantuan sosial dan pendidikan.</p>
                                            <a class="btn btn-primary border-secondary rounded-pill text-white py-3 px-5" href="#"><i class="fas fa-paper-plane me-2"></i>Ajukan Sekarang</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="service-item">
                            <div class="service-inner">
                                <div class="service-img">
                                    <img src="{{ asset('assets-guest/img/service-3.jpg') }}" class="img-fluid w-100 rounded" alt="Image">
                                </div>
                                <div class="service-title">
                                    <div class="service-title-name">
                                        <div class="bg-primary text-center rounded p-3 mx-5 mb-4">
                                            <a href="#" class="h4 text-white mb-0"><i class="fas fa-briefcase me-2"></i>Surat Usaha</a>
                                        </div>
                                        <a class="btn bg-light text-secondary rounded-pill py-3 px-5 mb-4" href="#"><i class="fas fa-paper-plane me-2"></i>Ajukan Sekarang</a>
                                    </div>
                                    <div class="service-content pb-4">
                                        <a href="#"><h4 class="text-white mb-4 py-3"><i class="fas fa-briefcase me-2"></i>Surat Keterangan Usaha</h4></a>
                                        <div class="px-4">
                                            <p class="mb-4"><i class="fas fa-check-circle me-2"></i>Surat untuk keperluan perizinan dan pengembangan usaha.</p>
                                            <a class="btn btn-primary border-secondary rounded-pill text-white py-3 px-5" href="#"><i class="fas fa-paper-plane me-2"></i>Ajukan Sekarang</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Services End -->

        {{-- end main content --}}

        {{-- start footer --}}
        @include('layouts.guest.footer')
        {{-- end footer --}}



        {{-- start js --}}
        @include('layouts.guest.js')
        {{-- end js --}}
