<div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
    <div class="container py-5">
        <div class="row g-5">

            {{-- Kolom 1: Kontak Info --}}
            <div class="col-md-6 col-lg-3">
                <div class="footer-item d-flex flex-column">
                    {{-- UBAH WARNA JUDUL DISINI (text-secondary -> text-white) --}}
                    <h4 class="text-white mb-4"><i class="fas fa-info-circle me-2"></i>Kontak Info</h4>
                    <a href="" class="mb-2"><i class="fa fa-map-marker-alt me-2"></i> Jl. Desa Bina No. 123</a>
                    <a href="" class="mb-2"><i class="fas fa-envelope me-2"></i> admin@layanansurat.com</a>
                    <a href="" class="mb-2"><i class="fas fa-phone me-2"></i> +012 345 67890</a>
                    <div class="d-flex align-items-center mt-3">
                        <a class="btn btn-square btn-outline-light me-2" href=""><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-light me-2" href=""><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-light me-2" href=""><i
                                class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>

            {{-- Kolom 2: Jam Layanan --}}
            <div class="col-md-6 col-lg-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-white mb-4"><i class="fas fa-clock me-2"></i>Jam Layanan</h4>
                    <div class="mb-3">
                        <h6 class="text-light mb-0"><i class="fas fa-calendar-day me-2"></i>Senin - Jumat:</h6>
                        <p class="text-white mb-0">08.00 - 16.00</p>
                    </div>
                    <div class="mb-3">
                        <h6 class="text-light mb-0"><i class="fas fa-calendar-day me-2"></i>Sabtu:</h6>
                        <p class="text-white mb-0">08.00 - 14.00</p>
                    </div>
                </div>
            </div>

            {{-- Kolom 3: Layanan Kami --}}
            <div class="col-md-6 col-lg-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-white mb-4"><i class="fas fa-concierge-bell me-2"></i>Layanan Kami</h4>
                    <a href="#" class="mb-2"><i class="fas fa-angle-right me-2"></i>Surat Domisili</a>
                    <a href="#" class="mb-2"><i class="fas fa-angle-right me-2"></i>Surat Tidak Mampu</a>
                    <a href="#" class="mb-2"><i class="fas fa-angle-right me-2"></i>Surat Usaha</a>
                    <a href="#" class="mb-2"><i class="fas fa-angle-right me-2"></i>Surat Pengantar</a>
                </div>
            </div>

            {{-- Kolom 4: IDENTITAS PENGEMBANG --}}
            <div class="col-md-6 col-lg-3">
                <div class="footer-item">
                    <h4 class="text-white mb-4"><i class="fas fa-code me-2"></i>Pengembang</h4>
                    <div class="d-flex align-items-center mb-3">
                        {{-- FOTO PROFIL --}}
                        <img src="{{ asset('assets-guest/img/2457301112.jpg') }}"
                            alt="Foto Pengembang" class="img-fluid rounded-circle border border-2 border-white me-3"
                            style="width: 60px; height: 60px; object-fit: cover;">

                        <div>
                            <h6 class="text-white mb-0">Nayla Saffana Chalisa</h6>
                            <small class="text-white-50">NIM: 2457301112</small>
                        </div>
                    </div>
                    <p class="text-white-50 small mb-3"><i class="fas fa-university me-2"></i>Prodi Sistem Informasi</p>

                    {{-- SOSIAL MEDIA --}}
                    <div class="d-flex">
                        <a class="btn btn-sm btn-outline-light btn-square rounded-circle me-2"
                            href="https://instagram.com/naylasfn" target="_blank"><i
                                class="fab fa-instagram"></i></a>
                        <a class="btn btn-sm btn-outline-light btn-square rounded-circle me-2"
                            href="https://linkedin.com/in/nayla-saffana-74223639a" target="_blank"><i
                                class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-sm btn-outline-light btn-square rounded-circle"
                            href="https://github.com/naylapcr" target="_blank"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="container-fluid copyright py-4">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-md-6 text-center text-md-start mb-md-0">
                <span class="text-white"><a href="#" class="border-bottom text-white"><i
                            class="fas fa-copyright text-light me-2"></i>Layanan Surat</a>, All right reserved.</span>
            </div>
            <div class="col-md-6 text-center text-md-end text-white">
                <i class="fas fa-envelope me-2"></i>Sistem Surat Menyurat Desa
            </div>
        </div>
    </div>
</div>
<a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>
