@extends('layouts.guest.app')

@section('content')
    {{-- start main content --}}
    <!-- About Section - Layanan Surat -->
    <div class="container-fluid py-5 bg-light">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-xl-5 wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="image-container position-relative rounded overflow-hidden shadow-lg">
                        <img src="https://placehold.co/600x400/0d6efd/ffffff?text=Layanan+Surat+Bina+Desa" class="img-fluid w-100 hover-zoom" alt="Layanan Surat Bina Desa">
                        <div class="position-absolute bottom-0 start-0 bg-primary text-white p-3 rounded-end floating-card">
                            <h5 class="mb-0"><i class="fas fa-heart me-2"></i>Melayani dengan Hati</h5>
                        </div>
                        <div class="image-overlay"></div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="stat-card animate-on-scroll" data-delay="100">
                                <div class="stat-icon mb-3">
                                    <i class="fas fa-envelope-open-text fa-3x text-primary floating-icon"></i>
                                </div>
                                <h2 class="fw-bold mb-1 counter" data-target="500">0</h2>
                                <p class="text-muted mb-0">Surat Diproses</p>
                                <div class="progress-bar-container mt-2">
                                    <div class="progress-bar-fill" data-width="85"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-card animate-on-scroll" data-delay="200">
                                <div class="stat-icon mb-3">
                                    <i class="fas fa-users fa-3x text-primary floating-icon"></i>
                                </div>
                                <h2 class="fw-bold mb-1 counter" data-target="300">0</h2>
                                <p class="text-muted mb-0">Warga Terlayani</p>
                                <div class="progress-bar-container mt-2">
                                    <div class="progress-bar-fill" data-width="75"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-7 wow fadeInRight" data-wow-delay="0.3s">
                    <div class="section-header mb-4">
                        <span class="sub-title badge bg-primary-subtle text-primary fs-6 fw-normal px-3 py-2">
                            <i class="fas fa-star me-2"></i>Layanan Surat
                        </span>
                        <h1 class="display-5 fw-bold mb-3 gradient-text">Sistem Surat Menyurat Digital Bina Desa</h1>
                        <p class="lead mb-4">Kami hadir untuk mempermudah proses administrasi surat menyurat di Desa Bina. Dengan sistem yang terintegrasi, warga dapat mengajukan berbagai jenis surat dengan mudah dan cepat tanpa harus datang ke kantor desa.</p>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-6 mb-4">
                            <div class="service-card hover-lift">
                                <div class="feature-icon mx-auto pulse-animation">
                                    <i class="fas fa-file-contract fa-2x text-white"></i>
                                </div>
                                <h5 class="text-center mb-3 fw-semibold">Surat Keterangan</h5>
                                <p class="text-center text-muted">Pengajuan surat keterangan domisili, tidak mampu, usaha, dan lainnya.</p>
                                <div class="service-badge">Populer</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="service-card hover-lift">
                                <div class="feature-icon mx-auto pulse-animation">
                                    <i class="fas fa-user-check fa-2x text-white"></i>
                                </div>
                                <h5 class="text-center mb-3 fw-semibold">Surat Pengantar</h5>
                                <p class="text-center text-muted">Pengajuan surat pengantar untuk keperluan administrasi lainnya.</p>
                                <div class="service-badge">Cepat</div>
                            </div>
                        </div>
                    </div>

                    <div class="features-grid mb-5">
                        <div class="row g-4">
                            <div class="col-12 col-sm-6">
                                <div class="feature-item slide-in-left">
                                    <div class="feature-icon-wrapper">
                                        <i class="fas fa-map-marked-alt fa-2x text-primary"></i>
                                    </div>
                                    <div class="feature-content">
                                        <h5 class="mb-2">Layanan Terpadu</h5>
                                        <p class="text-muted mb-0 small">Semua layanan dalam satu platform</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="feature-item slide-in-right">
                                    <div class="feature-icon-wrapper">
                                        <i class="fas fa-passport fa-2x text-primary"></i>
                                    </div>
                                    <div class="feature-content">
                                        <h5 class="mb-2">Proses Cepat</h5>
                                        <p class="text-muted mb-0 small">Maksimal 2x24 jam proses</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="process-timeline mb-5">
                        <h4 class="fw-bold mb-4 text-center"><i class="fas fa-list-ol me-2 text-primary"></i>Proses Pengajuan Surat</h4>
                        <div class="timeline">
                            <div class="timeline-item bounce-in">
                                <div class="timeline-marker">
                                    <span>1</span>
                                </div>
                                <div class="timeline-content">
                                    <h6 class="fw-semibold">Daftar / Login</h6>
                                    <p class="text-muted mb-0 small">Akses sistem dengan akun terdaftar</p>
                                </div>
                            </div>
                            <div class="timeline-item bounce-in" data-delay="100">
                                <div class="timeline-marker">
                                    <span>2</span>
                                </div>
                                <div class="timeline-content">
                                    <h6 class="fw-semibold">Pilih Jenis Surat</h6>
                                    <p class="text-muted mb-0 small">Tentukan jenis surat yang dibutuhkan</p>
                                </div>
                            </div>
                            <div class="timeline-item bounce-in" data-delay="200">
                                <div class="timeline-marker">
                                    <span>3</span>
                                </div>
                                <div class="timeline-content">
                                    <h6 class="fw-semibold">Isi Formulir</h6>
                                    <p class="text-muted mb-0 small">Lengkapi data yang diperlukan</p>
                                </div>
                            </div>
                            <div class="timeline-item bounce-in" data-delay="300">
                                <div class="timeline-marker">
                                    <span>4</span>
                                </div>
                                <div class="timeline-content">
                                    <h6 class="fw-semibold">Submit & Tunggu Konfirmasi</h6>
                                    <p class="text-muted mb-0 small">Surat akan diproses maksimal 2x24 jam</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center">
                        <div class="col-4 col-md-3">
                            <div class="achievement-card scale-on-hover">
                                <div class="trophy-icon mb-3">
                                    <i class="fas fa-trophy fa-3x text-warning"></i>
                                </div>
                                <h1 class="display-6 fw-bold mb-2 counter" data-target="5">0</h1>
                                <p class="text-muted mb-0 small">Tahun Pengalaman</p>
                            </div>
                        </div>
                        <div class="col-8 col-md-9">
                            <div class="benefits-list mb-4">
                                <div class="benefit-item fade-in-up">
                                    <i class="fas fa-check-circle text-success me-3 fa-lg"></i>
                                    <span class="h6 mb-0">Pelayanan 24 Jam Online</span>
                                </div>
                                <div class="benefit-item fade-in-up" data-delay="100">
                                    <i class="fas fa-check-circle text-success me-3 fa-lg"></i>
                                    <span class="h6 mb-0">Proses Lebih Cepat & Mudah</span>
                                </div>
                                <div class="benefit-item fade-in-up" data-delay="200">
                                    <i class="fas fa-check-circle text-success me-3 fa-lg"></i>
                                    <span class="h6 mb-0">Bimbingan Langsung dari Admin</span>
                                </div>
                                <div class="benefit-item fade-in-up" data-delay="300">
                                    <i class="fas fa-check-circle text-success me-3 fa-lg"></i>
                                    <span class="h6 mb-0">Notifikasi Status Pengajuan</span>
                                </div>
                            </div>
                            <div class="action-buttons">
                                <a href="#" class="btn btn-primary btn-lg me-3 mb-3 pulse-button">
                                    <i class="fas fa-file-alt me-2"></i>Ajukan Surat Sekarang
                                </a>
                                <div class="contact-widget d-inline-flex align-items-center mb-3">
                                    <div class="phone-animation-container me-3">
                                        <a href="tel:+01234567890" class="phone-link">
                                            <i class="fas fa-phone-alt fa-2x text-primary tada-animation"></i>
                                            <div class="notification-dot"></div>
                                        </a>
                                    </div>
                                    <div class="contact-info">
                                        <span class="d-block text-primary small">Punya pertanyaan?</span>
                                        <span class="d-block text-secondary fw-bold fs-5">+0123 456 7890</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end main content --}}

<style>
    /* Global Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: scale(0.3);
        }
        50% {
            opacity: 1;
            transform: scale(1.05);
        }
        70% {
            transform: scale(0.9);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
        }
    }

    @keyframes tada {
        0% {
            transform: scale(1);
        }
        10%, 20% {
            transform: scale(0.9) rotate(-3deg);
        }
        30%, 50%, 70%, 90% {
            transform: scale(1.1) rotate(3deg);
        }
        40%, 60%, 80% {
            transform: scale(1.1) rotate(-3deg);
        }
        100% {
            transform: scale(1) rotate(0);
        }
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    @keyframes gradientShift {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    /* Image Container */
    .image-container {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
    }

    .hover-zoom {
        transition: transform 0.5s ease;
    }

    .image-container:hover .hover-zoom {
        transform: scale(1.05);
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(13, 110, 253, 0.1), transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .image-container:hover .image-overlay {
        opacity: 1;
    }

    .floating-card {
        animation: float 3s ease-in-out infinite;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    /* Stat Cards */
    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: left 0.5s ease;
    }

    .stat-card:hover::before {
        left: 100%;
    }

    .floating-icon {
        animation: float 2s ease-in-out infinite;
    }

    .progress-bar-container {
        width: 100%;
        height: 4px;
        background: #e9ecef;
        border-radius: 2px;
        overflow: hidden;
    }

    .progress-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--bs-primary), var(--bs-info));
        border-radius: 2px;
        width: 0%;
        transition: width 1.5s ease-in-out;
    }

    /* Section Header */
    .section-header {
        position: relative;
    }

    .gradient-text {
        background: linear-gradient(135deg, var(--bs-primary), var(--bs-info));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        background-size: 200% 200%;
        animation: gradientShift 3s ease infinite;
    }

    /* Service Cards */
    .service-card {
        background: white;
        padding: 2rem 1.5rem;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        position: relative;
        border: 1px solid transparent;
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        border-color: var(--bs-primary);
    }

    .hover-lift {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--bs-primary), var(--bs-info));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
    }

    .pulse-animation {
        animation: pulse 2s infinite;
    }

    .service-badge {
        position: absolute;
        top: -10px;
        right: 20px;
        background: var(--bs-warning);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 15px;
        font-size: 0.75rem;
        font-weight: 600;
        animation: tada 2s infinite;
    }

    /* Features Grid */
    .feature-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        background: white;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }

    .feature-item:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.12);
    }

    .feature-icon-wrapper {
        width: 60px;
        height: 60px;
        background: rgba(13, 110, 253, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        transition: all 0.3s ease;
    }

    .feature-item:hover .feature-icon-wrapper {
        background: var(--bs-primary);
        transform: scale(1.1);
    }

    .feature-item:hover .feature-icon-wrapper i {
        color: white !important;
    }

    /* Process Timeline */
    .process-timeline {
        position: relative;
    }

    .timeline {
        position: relative;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 30px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(to bottom, var(--bs-primary), var(--bs-info));
    }

    .timeline-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 2rem;
        position: relative;
    }

    .timeline-marker {
        width: 60px;
        height: 60px;
        background: white;
        border: 3px solid var(--bs-primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: var(--bs-primary);
        margin-right: 1.5rem;
        position: relative;
        z-index: 2;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .timeline-item:hover .timeline-marker {
        background: var(--bs-primary);
        color: white;
        transform: scale(1.1);
    }

    .timeline-content {
        flex: 1;
        padding-top: 0.5rem;
    }

    /* Achievement Card */
    .achievement-card {
        background: white;
        padding: 1.5rem;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }

    .scale-on-hover:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .trophy-icon {
        animation: float 3s ease-in-out infinite;
    }

    /* Benefits List */
    .benefits-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .benefit-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        background: rgba(25, 135, 84, 0.05);
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .benefit-item:hover {
        background: rgba(25, 135, 84, 0.1);
        transform: translateX(5px);
    }

    /* Action Buttons */
    .pulse-button {
        animation: pulse 2s infinite;
        position: relative;
        overflow: hidden;
    }

    .pulse-button:hover {
        animation: none;
        transform: translateY(-2px);
    }

    .phone-animation-container {
        position: relative;
    }

    .tada-animation {
        animation: tada 2s infinite;
    }

    .notification-dot {
        position: absolute;
        top: -5px;
        right: -5px;
        width: 12px;
        height: 12px;
        background: var(--bs-danger);
        border-radius: 50%;
        animation: pulse 1s infinite;
    }

    .contact-widget {
        background: white;
        padding: 1rem 1.5rem;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }

    .contact-widget:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }

    /* Animation Classes */
    .animate-on-scroll {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }

    .animate-on-scroll.animated {
        opacity: 1;
        transform: translateY(0);
    }

    .slide-in-left {
        opacity: 0;
        transform: translateX(-30px);
        transition: all 0.6s ease;
    }

    .slide-in-left.animated {
        opacity: 1;
        transform: translateX(0);
    }

    .slide-in-right {
        opacity: 0;
        transform: translateX(30px);
        transition: all 0.6s ease;
    }

    .slide-in-right.animated {
        opacity: 1;
        transform: translateX(0);
    }

    .bounce-in {
        opacity: 0;
        transform: scale(0.3);
        transition: all 0.6s ease;
    }

    .bounce-in.animated {
        opacity: 1;
        transform: scale(1);
    }

    .fade-in-up {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.6s ease;
    }

    .fade-in-up.animated {
        opacity: 1;
        transform: translateY(0);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Counter Animation
        const counters = document.querySelectorAll('.counter');
        const speed = 200;

        const animateCounter = (counter) => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText;
            const increment = target / speed;

            if (count < target) {
                counter.innerText = Math.ceil(count + increment);
                setTimeout(() => animateCounter(counter), 10);
            } else {
                counter.innerText = target;
            }
        };

        // Progress Bar Animation
        const progressBars = document.querySelectorAll('.progress-bar-fill');
        progressBars.forEach(bar => {
            const width = bar.getAttribute('data-width');
            setTimeout(() => {
                bar.style.width = width + '%';
            }, 500);
        });

        // Scroll Animation
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.animate-on-scroll, .slide-in-left, .slide-in-right, .bounce-in, .fade-in-up');

            elements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const elementBottom = element.getBoundingClientRect().bottom;
                const delay = element.getAttribute('data-delay') || 0;

                if (elementTop < window.innerHeight - 100 && elementBottom > 0) {
                    setTimeout(() => {
                        element.classList.add('animated');
                    }, delay);
                }
            });
        };

        // Initialize animations
        window.addEventListener('scroll', animateOnScroll);
        animateOnScroll(); // Run once on load

        // Start counters when they come into view
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(counter => {
            counterObserver.observe(counter);
        });

        // Hover effects for interactive elements
        const serviceCards = document.querySelectorAll('.service-card');
        serviceCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Phone animation interaction
        const phoneLink = document.querySelector('.phone-link');
        phoneLink.addEventListener('mouseenter', function() {
            this.querySelector('i').style.animation = 'tada 0.6s ease';
        });

        phoneLink.addEventListener('mouseleave', function() {
            this.querySelector('i').style.animation = 'tada 2s infinite';
        });

        // Pulse button interaction
        const pulseButton = document.querySelector('.pulse-button');
        pulseButton.addEventListener('mouseenter', function() {
            this.style.animation = 'none';
        });

        pulseButton.addEventListener('mouseleave', function() {
            this.style.animation = 'pulse 2s infinite';
        });
    });
</script>

@endsection
