<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Humas Polres Bangkalan</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Swiper CSS for slider -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
</head>
<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        
        <!-- Logo Kiri Atas -->
        <div class="logo-wrapper">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo Polres Bangkalan" class="hero-logo">
        </div>

        <!-- Menu Kanan Atas -->
        <div class="top-menu-wrapper">
            <div class="menu-dropdown">
                <button class="menu-btn" id="menuBtn">
                    <span>Menu</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-content" id="dropdownContent">
                    <a href="{{ route('home') }}">Beranda</a>
                    <a href="{{ route('profil.index') }}">Tentang Kami</a>
                    <a href="{{ route('berita.index') }}">Informasi Publik</a>
                    <a href="{{ route('public.pengumuman.index') }}">Pengumuman</a>
                    <a href="{{ route('profil.index') }}">Profil</a>
                </div>
            </div>
        </div>

        <!-- Hero Content Center -->
        <div class="hero-content">
            <h1>SELAMAT DATANG DI WEBSITE RESMI<br>DIVISI HUMAS POLRES BANGKALAN</h1>
            <p class="hero-subtitle">Informatif - Transparan - Terpercaya</p>
        </div>

        <!-- Social Media Icons Kiri Bawah -->
        <div class="social-media-hero">

            <a href="https://www.facebook.com/polresbangkalan"
            class="social-icon"
            title="Facebook"
            target="_blank"
            rel="noopener noreferrer">
                <i class="fa-brands fa-facebook-f"></i>
            </a>

            <a href="https://www.instagram.com/polresbangkalan/"
            class="social-icon"
            title="Instagram"
            target="_blank"
            rel="noopener noreferrer">
                <i class="fa-brands fa-instagram"></i>
            </a>

            <a href="https://x.com/polresbangkalan"
            class="social-icon"
            title="X (Twitter)"
            target="_blank"
            rel="noopener noreferrer">
                <i class="fa-brands fa-x-twitter"></i>
            </a>

            <a href="https://www.youtube.com/@polresbangkalan"
            class="social-icon"
            title="YouTube"
            target="_blank"
            rel="noopener noreferrer">
                <i class="fa-brands fa-youtube"></i>
            </a>

            <a href="https://www.tiktok.com/@polresbangkalan"
            class="social-icon"
            title="TikTok"
            target="_blank"
            rel="noopener noreferrer">
                <i class="fa-brands fa-tiktok"></i>
            </a>

            <a id="theme-toggle"
            class="social-icon"
            title="Toggle Theme"
            href="#">
                <i class="fa-solid fa-moon"></i>
            </a>
        </div>
    </section>

    <!-- Media Update Section -->
    <section class="media-update-section">
        <div class="container">
            <h2 class="section-title">Media Update</h2>
            
            <div class="media-grid">
                @forelse($beritas->take(3) as $berita)
                <div class="media-card">
                    <div class="media-image">
                        @if($berita->gambar_utama)
                            <img src="{{ asset('foto_berita/' . $berita->gambar_utama) }}" alt="{{ $berita->judul }}">
                        @else
                            <div class="media-placeholder"></div>
                        @endif
                    </div>
                    <div class="media-info">
                        <h3>{{ Str::limit($berita->judul, 60) }}</h3>
                        <p>{{ Str::limit(strip_tags($berita->ringkasan ?? $berita->konten), 100) }}</p>
                        <a href="{{ route('berita.show', $berita->slug) }}" class="read-more">Baca Selengkapnya →</a>
                    </div>
                </div>
                @empty
                <div class="media-card placeholder">
                    <div class="media-placeholder"></div>
                </div>
                <div class="media-card placeholder">
                    <div class="media-placeholder"></div>
                </div>
                <div class="media-card placeholder">
                    <div class="media-placeholder"></div>
                </div>
                @endforelse
            </div>

            <div class="text-center">
                <a href="{{ route('berita.index') }}" class="btn-primary">Lihat Lebih Banyak</a>
            </div>
        </div>
    </section>

    <!-- Informasi dan Layanan Digital -->
    <section class="layanan-section">
        <div class="container">
            <h2 class="section-title">Informasi dan Layanan Digital</h2>
            
            <div class="layanan-grid-2x2">
                <a href="#" class="layanan-card">
                    <div class="layanan-icon">
                        <img src="{{ asset('assets/icons/skck.png') }}" alt="SKCK" class="layanan-img">
                    </div>
                    <h3>SKCK</h3>
                </a>

                <a href="#" class="layanan-card">
                    <div class="layanan-icon">
                        <img src="{{ asset('assets/icons/samsat.png') }}" alt="SAMSAT" class="layanan-img">
                    </div>
                    <h3>SAMSAT</h3>
                </a>

                <a href="#" class="layanan-card">
                    <div class="layanan-icon">
                        <img src="{{ asset('assets/icons/sim.jpg') }}" alt="SIM" class="layanan-img">
                    </div>
                    <h3>SIM</h3>
                </a>

                <a href="#" class="layanan-card">
                    <div class="layanan-icon">
                        <img src="{{ asset('assets/icons/Layanan110.png') }}" alt="Layanan 110" class="layanan-img">
                    </div>
                    <h3>Layanan 110</h3>
                </a>
            </div>
        </div>
    </section>

    <!-- Media Sosial Humas Section -->
    <section class="social-media-section">
        <div class="container">
            <h2 class="section-title">Media Sosial Humas</h2>
            
            <!-- Social Media Tabs -->
            <div class="social-tabs">
                <button class="social-tab active" data-social="instagram">
                    <i class="fa-brands fa-instagram"></i>
                    Instagram
                </button>
                <button class="social-tab" data-social="tiktok">
                    <i class="fa-brands fa-tiktok"></i>
                    TikTok
                </button>
                <button class="social-tab" data-social="facebook">
                    <i class="fa-brands fa-facebook-f"></i>
                    Facebook
                </button>
                <button class="social-tab" data-social="x">
                    <i class="fa-brands fa-x-twitter"></i>
                    Twitter
                </button>
            </div>

            <!-- Social Media Content Slider -->
            <div class="social-content">
                <div class="social-panel active" id="instagram-panel">
                    <div class="swiper social-swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="social-post">
                                    <div class="social-post-image"></div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="social-post">
                                    <div class="social-post-image"></div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="social-post">
                                    <div class="social-post-image"></div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>

                <div class="social-panel" id="tiktok-panel">
                    <div class="swiper social-swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="social-post">
                                    <div class="social-post-image"></div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="social-post">
                                    <div class="social-post-image"></div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="social-post">
                                    <div class="social-post-image"></div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>

                <div class="social-panel" id="facebook-panel">
                    <div class="swiper social-swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="social-post">
                                    <div class="social-post-image"></div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="social-post">
                                    <div class="social-post-image"></div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="social-post">
                                    <div class="social-post-image"></div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>

                <div class="social-panel" id="x-panel">
                    <div class="swiper social-swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="social-post">
                                    <div class="social-post-image"></div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="social-post">
                                    <div class="social-post-image"></div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="social-post">
                                    <div class="social-post-image"></div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section footer-about">
                    <div class="footer-logo">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo Polres Bangkalan">
                    </div>
                    <p>Website Resmi Humas Polres Bangkalan<br>
                    Melayani dengan hati, Melindungi dengan peduli<br>
                    Informasi resmi terpercaya dari Polres Bangkalan</p>
                </div>

                <div class="footer-section footer-subscribe">
                    <h4>Visi, sosialisasi dan pelaporan terkini<br>untuk anda oleh kami langsung</h4>
                    <form class="subscribe-form" action="#" method="POST">
                        @csrf
                        <input type="email" name="email" placeholder="Email anda" required>
                        <button type="submit">Kirim</button>
                    </form>
                    <div class="footer-links">
                        <a href="#hubungi">Hubungi Kami</a>
                        <span>•</span>
                        <a href="#informasi">Informasi Umum</a>
                        <span>•</span>
                        <a href="mailto:faq@polresbangkalan.id">faq@polresbangkalan.id</a>
                    </div>
                </div>

                <div class="footer-section footer-contact">
                    <h4>Hubungi Kami</h4>
                    <div class="contact-info">
                        <p><i class="fas fa-map-marker-alt"></i> Jl. Soekarno Hatta No.45, Wr 08, Mlajah</p>
                        <p><i class="fas fa-phone"></i> (031) 3095266</p>
                        <p><i class="fas fa-clock"></i> Buka 24 Jam</p>
                        <p><i class="fas fa-map"></i> Bangkalan, Jawa Timur 69116</p>
                    </div>
                    <div class="footer-social">
                        <a href="https://www.facebook.com/polresbangkalan"
                        title="Facebook"
                        target="_blank"
                        rel="noopener">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>

                        <a href="https://www.instagram.com/polresbangkalan/"
                        title="Instagram"
                        target="_blank"
                        rel="noopener">
                            <i class="fa-brands fa-instagram"></i>
                        </a>

                        <a href="https://www.x.com/polresbangkalan"
                        title="X (Twitter)"
                        target="_blank"
                        rel="noopener">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>

                        <a href="https://www.youtube.com/@polresbangkalan"
                        title="YouTube"
                        target="_blank"
                        rel="noopener">
                            <i class="fa-brands fa-youtube"></i>
                        </a>

                        <a href="https://www.tiktok.com/@polresbangkalan"
                        title="TikTok"
                        target="_blank"
                        rel="noopener">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                    </div>
                </div>

                <div class="footer-section footer-map">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.5445889284675!2d112.73527931477422!3d-7.045821194880997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd807f0c8c0c0c3%3A0x5030bfbca832b00!2sPolres%20Bangkalan!5e0!3m2!1sid!2sid!4v1234567890123!5m2!1sid!2sid" 
                        width="100%" 
                        height="200" 
                        style="border:0; border-radius: 8px;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Polres Bangkalan. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Float Button -->
    <a href="https://wa.me/6287795080182" class="whatsapp-float" target="_blank" title="Hubungi via WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
        <span>Hubungi Kami</span>
    </a>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /* ===============================
            MENU DROPDOWN
            =============================== */
            const menuBtn = document.getElementById('menuBtn');
            const dropdownContent = document.getElementById('dropdownContent');

            menuBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdownContent.classList.toggle('show');
                const icon = menuBtn.querySelector('i');
                icon.classList.toggle('fa-chevron-down');
                icon.classList.toggle('fa-chevron-up');
            });

            document.addEventListener('click', function(e) {
                if (!menuBtn.contains(e.target) && !dropdownContent.contains(e.target)) {
                    dropdownContent.classList.remove('show');
                    const icon = menuBtn.querySelector('i');
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                }
            });

            /* ===============================
            DARK MODE TOGGLE
            =============================== */
            const themeToggle = document.getElementById("theme-toggle");
            const body = document.body;
            const themeIcon = themeToggle.querySelector("i");

            // Load saved theme
            if (localStorage.getItem("theme") === "dark") {
                body.classList.add("dark-mode");
                themeIcon.classList.remove("fa-moon");
                themeIcon.classList.add("fa-sun");
            }

            themeToggle.addEventListener("click", function(e) {
                e.preventDefault();

                body.classList.toggle("dark-mode");

                if (body.classList.contains("dark-mode")) {
                    localStorage.setItem("theme", "dark");
                    themeIcon.classList.remove("fa-moon");
                    themeIcon.classList.add("fa-sun");
                } else {
                    localStorage.setItem("theme", "light");
                    themeIcon.classList.remove("fa-sun");
                    themeIcon.classList.add("fa-moon");
                }
            });

            /* ===============================
            IMAGE FALLBACK
            =============================== */
            const defaultIcon = '{{ asset("assets/images/default-icon.png") }}';
            const layananImages = document.querySelectorAll('.layanan-img');

            layananImages.forEach(img => {
                img.addEventListener('error', function() {
                    this.src = defaultIcon;
                });
            });

            /* ===============================
            SWIPER INIT
            =============================== */
            const swipers = document.querySelectorAll('.social-swiper');
            swipers.forEach(swiper => {
                new Swiper(swiper, {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    breakpoints: {
                        640: { slidesPerView: 2 },
                        1024: { slidesPerView: 3 },
                    },
                });
            });

            /* ===============================
            SOCIAL TABS
            =============================== */
            const socialTabs = document.querySelectorAll('.social-tab');
            const socialPanels = document.querySelectorAll('.social-panel');

            socialTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const targetSocial = this.getAttribute('data-social');

                    socialTabs.forEach(t => t.classList.remove('active'));
                    socialPanels.forEach(p => p.classList.remove('active'));

                    this.classList.add('active');
                    document.getElementById(targetSocial + '-panel').classList.add('active');
                });
            });

        });
    </script>
</body>
</html>