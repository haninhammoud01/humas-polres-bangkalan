<?php use \Illuminate\Support\Str; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Humas Polres Bangkalan</title>

    <link rel="icon" type="image/png" href="<?php echo e(asset('assets/images/Logo.png')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/welcome.css')); ?>">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    integrity="sha512-..."
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <style>
        /* --- DARK MODE CSS (REALISTIS) --- */
        body { transition: background-color 0.3s, color 0.3s; }
        
        body.dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }
        body.dark-mode .media-update-section, 
        body.dark-mode .layanan-section,
        body.dark-mode .social-media-section {
            background-color: #1a1a1a;
        }
        body.dark-mode .media-card, 
        body.dark-mode .layanan-card {
            background-color: #242424;
            color: #fff;
        }
        body.dark-mode .media-info h3, 
        body.dark-mode .layanan-card h3,
        body.dark-mode .section-title {
            color: #ffffff;
        }
        body.dark-mode .layanan-icon-box {
            background-color: #333;
        }

        /* --- LAYANAN GRID --- */
        .layanan-grid-2x2{
            display:grid;
            grid-template-columns:repeat(2,1fr);
            gap:30px;
            max-width:700px;
            margin:40px auto;
        }
        .layanan-card{
            background:#fff;
            border-radius:16px;
            padding:30px 20px;
            text-align:center;
            text-decoration:none;
            box-shadow:0 10px 25px rgba(0,0,0,0.08);
            transition:all .3s ease;
        }
        .layanan-icon-box{
            width:90px; height:90px; margin:0 auto 15px;
            display:flex; align-items:center; justify-content:center;
            background:#f5f5f5; border-radius:18px;
        }
        .layanan-icon-img{ width:60px; height:60px; object-fit:contain; }

        /* --- RUNNING TEXT --- */
        .rt-wrapper {
            position: fixed; bottom: 0; left: 0; width: 100%;
            background: #1a1a1a; color: white; z-index: 9999;
            border-top: 3px solid #ffc107;
        }
        .rt-container { display: flex; align-items: center; height: 50px; }
        .rt-label {
            background: #dc3545; color: white; padding: 0 20px;
            height: 100%; display: flex; align-items: center;
            font-weight: bold; font-size: 13px; white-space: nowrap;
        }
        .rt-content { flex: 1; overflow: hidden; }
        .rt-content marquee a { color: #fff; text-decoration: none; margin-right: 60px; }
        .rt-close { background: none; border: none; color: #aaa; padding: 0 15px; cursor: pointer; font-size: 20px; }

        /* --- WHATSAPP POSITION --- */
        .whatsapp-float { bottom: 75px !important; transition: all 0.3s ease; }
    </style>
</head>

<body>

<section class="hero-section">
    <div class="hero-overlay"></div>
    <div class="top-bar">
        <div class="logo-wrapper">
            <img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="Logo" class="hero-logo">
        </div>
        <div class="top-menu-wrapper">
            <div class="menu-dropdown">
                <button class="menu-btn" id="menuBtn"><span>Menu</span><i class="fas fa-chevron-down"></i></button>
                <div class="dropdown-content" id="dropdownContent">
                    <a href="<?php echo e(route('profil.index')); ?>">Tentang Kami</a>
                    <a href="<?php echo e(route('berita.index')); ?>">Informasi Publik</a>
                    <a href="<?php echo e(route('public.layanan.index')); ?>">Layanan</a>
                    <a href="<?php echo e(route('public.pengumuman.index')); ?>">Pengumuman</a>
                    <a href="<?php echo e(route('public.galeri.index')); ?>">Galeri</a>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-content">
        <h1>SELAMAT DATANG DI WEBSITE RESMI<br>HUMAS POLRES BANGKALAN</h1>
        <p class="hero-subtitle">Informatif - Transparan - Terpercaya</p>
    </div>
    <div class="social-media-hero">
        <a href="https://www.facebook.com/humasPolresBKL" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="https://www.instagram.com/polresbangkalan/" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
        <a href="https://x.com/HumasResBKL" class="social-icon"><i class="fa-brands fa-x-twitter"></i></a>
        <a href="https://www.tiktok.com/@polresbangkalan" class="social-icon"><i class="fa-brands fa-tiktok"></i></a>
        <a href="https://www.youtube.com/@humaspolresbangkalan" class="social-icon"><i class="fa-brands fa-youtube"></i></a>
        <a id="theme-toggle" class="social-icon" style="cursor: pointer;"><i class="fa-solid fa-moon"></i></a>
    </div>
</section>

<section class="media-update-section">
    <div class="container">
        <h2 class="section-title">Media Update</h2>
        <div class="media-grid">
            <?php $__empty_1 = true; $__currentLoopData = $beritas->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $berita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="media-card">
                <div class="media-image">
                    <?php if($berita->gambar_utama): ?> <img src="<?php echo e(asset('storage/'.$berita->gambar_utama)); ?>" alt="<?php echo e($berita->judul); ?>"> <?php else: ?> <div class="media-placeholder"></div> <?php endif; ?>
                </div>
                <div class="media-info">
                    <h3><?php echo e(Str::limit($berita->judul, 60)); ?></h3>
                    <p><?php echo e(Str::limit(strip_tags($berita->ringkasan ?? $berita->konten), 100)); ?></p>
                    <a href="<?php echo e(route('berita.show', $berita->slug)); ?>" class="read-more">Baca Selengkapnya →</a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="media-card placeholder"><div class="media-placeholder"></div></div>
            <?php endif; ?>
        </div>
        <div class="text-center"><a href="<?php echo e(route('berita.index')); ?>" class="btn-primary">Lihat Lebih Banyak</a></div>
    </div>
</section>

<section class="layanan-section">
    <div class="container">
        <h2 class="section-title">Informasi dan Layanan Digital</h2>
        <?php if($layanans && $layanans->count() > 0): ?>
        <div class="layanan-grid-2x2">
            <?php $__currentLoopData = $layanans->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $layanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('public.layanan.show', $layanan->slug)); ?>" class="layanan-card">
                <div class="layanan-icon-box">
                    <?php $name = Str::lower($layanan->nama_layanan); ?>
                    <?php if(Str::contains($name, 'skck')): ?> <img src="<?php echo e(asset('assets/icons/skck.png')); ?>" class="layanan-icon-img">
                    <?php elseif(Str::contains($name, 'samsat')): ?> <img src="<?php echo e(asset('assets/icons/samsat.png')); ?>" class="layanan-icon-img">
                    <?php elseif(Str::contains($name, 'sim')): ?> <img src="<?php echo e(asset('assets/icons/sim.jpg')); ?>" class="layanan-icon-img">
                    <?php elseif(Str::contains($name, '110')): ?> <img src="<?php echo e(asset('assets/icons/Layanan110.png')); ?>" class="layanan-icon-img">
                    <?php endif; ?>
                </div>
                <h3><?php echo e($layanan->nama_layanan); ?></h3>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Media Sosial Humas Section -->

<section class="social-media-section">

    <div class="container">



        <h2 class="section-title">Media Sosial Humas</h2>



        <!-- Social Media Tabs -->

        <div class="social-tabs">

            <button class="social-tab active" data-social="facebook">

                <i class="fa-brands fa-facebook-f"></i> Facebook

            </button>



            <button class="social-tab" data-social="instagram">

                <i class="fa-brands fa-instagram"></i> Instagram

            </button>



            <button class="social-tab" data-social="x">

                <i class="fa-brands fa-x-twitter"></i> Twitter

            </button>



            <button class="social-tab" data-social="tiktok">

                <i class="fa-brands fa-tiktok"></i> TikTok

            </button>



            <button class="social-tab" data-social="youtube">

                <i class="fa-brands fa-youtube"></i> YouTube

            </button>

        </div>





        <!-- Social Media Content Slider -->

        <div class="social-content">



            <!-- Facebook Panel -->

            <div class="social-panel" id="facebook-panel">

                <div class="swiper social-swiper">

                    <div class="swiper-wrapper">



                        <div class="swiper-slide">

                            <div class="social-post">

                                <a href="https://www.facebook.com/humasPolresBKL" target="_blank" rel="noopener">

                                    <div class="social-post-image"></div>

                                    <p class="social-caption">Kunjungi Facebook kami untuk update terbaru</p>

                                </a>

                            </div>

                        </div>



                        <div class="swiper-slide">

                            <div class="social-post">

                                <a href="https://www.facebook.com/humasPolresBKL" target="_blank" rel="noopener">

                                    <div class="social-post-image"></div>

                                    <p class="social-caption">Ikuti aktivitas Polres Bangkalan</p>

                                </a>

                            </div>

                        </div>



                        <div class="swiper-slide">

                            <div class="social-post">

                                <a href="https://www.facebook.com/humasPolresBKL" target="_blank" rel="noopener">

                                    <div class="social-post-image"></div>

                                    <p class="social-caption">Berita dan kegiatan terkini</p>

                                </a>

                            </div>

                        </div>



                    </div>



                    <div class="swiper-button-next"></div>

                    <div class="swiper-button-prev"></div>

                </div>

            </div>





            <!-- Instagram Panel -->

            <div class="social-panel active" id="instagram-panel">

                <div class="swiper social-swiper">

                    <div class="swiper-wrapper">



                        <div class="swiper-slide">

                            <div class="social-post">

                                <a href="https://www.instagram.com/polresbangkalan/" target="_blank" rel="noopener">

                                    <div class="social-post-image"></div>

                                    <p class="social-caption">Follow Instagram @polresbangkalan</p>

                                </a>

                            </div>

                        </div>



                        <div class="swiper-slide">

                            <div class="social-post">

                                <a href="https://www.instagram.com/polresbangkalan/" target="_blank" rel="noopener">

                                    <div class="social-post-image"></div>

                                    <p class="social-caption">Foto dan video kegiatan</p>

                                </a>

                            </div>

                        </div>



                        <div class="swiper-slide">

                            <div class="social-post">

                                <a href="https://www.instagram.com/polresbangkalan/" target="_blank" rel="noopener">

                                    <div class="social-post-image"></div>

                                    <p class="social-caption">Update terbaru setiap hari</p>

                                </a>

                            </div>

                        </div>



                    </div>



                    <div class="swiper-button-next"></div>

                    <div class="swiper-button-prev"></div>

                </div>

            </div>





            <!-- Twitter Panel -->

            <div class="social-panel" id="x-panel">

                <div class="swiper social-swiper">

                    <div class="swiper-wrapper">



                        <div class="swiper-slide">

                            <div class="social-post">

                                <a href="https://x.com/HumasResBKL" target="_blank" rel="noopener">

                                    <div class="social-post-image"></div>

                                    <p class="social-caption">Follow Twitter @HumasResBKL</p>

                                </a>

                            </div>

                        </div>



                        <div class="swiper-slide">

                            <div class="social-post">

                                <a href="https://x.com/HumasResBKL" target="_blank" rel="noopener">

                                    <div class="social-post-image"></div>

                                    <p class="social-caption">Tweet dan informasi terkini</p>

                                </a>

                            </div>

                        </div>



                        <div class="swiper-slide">

                            <div class="social-post">

                                <a href="https://x.com/HumasResBKL" target="_blank" rel="noopener">

                                    <div class="social-post-image"></div>

                                    <p class="social-caption">Berita cepat dan update</p>

                                </a>

                            </div>

                        </div>



                    </div>



                    <div class="swiper-button-next"></div>

                    <div class="swiper-button-prev"></div>

                </div>

            </div>





            <!-- TikTok Panel -->

            <div class="social-panel" id="tiktok-panel">

                <div class="swiper social-swiper">

                    <div class="swiper-wrapper">



                        <div class="swiper-slide">

                            <div class="social-post">

                                <a href="https://www.tiktok.com/@polresbangkalan" target="_blank" rel="noopener">

                                    <div class="social-post-image"></div>

                                    <p class="social-caption">Follow TikTok @polresbangkalan</p>

                                </a>

                            </div>

                        </div>



                        <div class="swiper-slide">

                            <div class="social-post">

                                <a href="https://www.tiktok.com/@polresbangkalan" target="_blank" rel="noopener">

                                    <div class="social-post-image"></div>

                                    <p class="social-caption">Video edukatif dan informatif</p>

                                </a>

                            </div>

                        </div>



                        <div class="swiper-slide">

                            <div class="social-post">

                                <a href="https://www.tiktok.com/@polresbangkalan" target="_blank" rel="noopener">

                                    <div class="social-post-image"></div>

                                    <p class="social-caption">Konten menarik setiap hari</p>

                                </a>

                            </div>

                        </div>



                    </div>



                    <div class="swiper-button-next"></div>

                    <div class="swiper-button-prev"></div>

                </div>

            </div>





            <!-- YouTube Panel -->

            <div class="social-panel" id="youtube-panel">

                <div class="swiper social-swiper">

                    <div class="swiper-wrapper">



                        <div class="swiper-slide">

                            <div class="social-post">

                                <a href="https://www.youtube.com/@humaspolresbangkalan" target="_blank" rel="noopener">

                                    <div class="social-post-image"></div>

                                    <p class="social-caption">Subscribe YouTube kami</p>

                                </a>

                            </div>

                        </div>



                        <div class="swiper-slide">

                            <div class="social-post">

                                <a href="https://www.youtube.com/@humaspolresbangkalan" target="_blank" rel="noopener">

                                    <div class="social-post-image"></div>

                                    <p class="social-caption">Video dokumentasi kegiatan</p>

                                </a>

                            </div>

                        </div>



                        <div class="swiper-slide">

                            <div class="social-post">

                                <a href="https://www.youtube.com/@humaspolresbangkalan" target="_blank" rel="noopener">

                                    <div class="social-post-image"></div>

                                    <p class="social-caption">Liputan lengkap dan edukasi</p>

                                </a>

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

<footer class="footer">

    <div class="container">



        <div class="footer-content">



            <div class="footer-section footer-about">

                <div class="footer-logo">

                    <img src="<?php echo e(asset('assets/images/logo.png')); ?>">

                </div>

                <p>

                Website Resmi Humas Polres Bangkalan.<br>

                Melayani dengan hati, melindungi dengan peduli,<br>

                informasi resmi terpercaya dari Polres Bangkalan

                </p>

            </div>



            <div class="footer-section footer-subscribe">

                <h4>Ikuti kami via Email<br>untuk anda oleh kami langsung</h4>



                <form class="subscribe-form" action="mailto:hanonhanun@gmail.com" method="GET">

                    <input type="email" name="subject" placeholder="Email anda" required>

                    <button type="submit">Kirim</button>

                </form>



                <div class="footer-links">

                    <a href="tel:110">CALL CENTER 110</a>

                </div>

            </div>



            <div class="footer-section footer-contact">

                <h4>Hubungi Kami</h4>



                <div class="contact-info">

                    <p><i class="fas fa-map-marker-alt"></i> Jl. Soekarno Hatta No.45</p>

                    <p><i class="fas fa-phone"></i> (031) 3095266</p>

                    <p><i class="fas fa-clock"></i> Buka 24 Jam</p>

                    <p><i class="fas fa-map"></i> Bangkalan, Jawa Timur 69116</p>

                </div>

            </div>



            <div class="footer-section footer-map">

                <iframe src="https://www.google.com/maps?q=polres+bangkalan&output=embed"

                        width="100%" height="200"

                        style="border:0;border-radius:8px;">

                </iframe>

            </div>



        </div>



        <div class="footer-bottom">

            <p>&copy; <?php echo e(date('Y')); ?> Polres Bangkalan. All rights reserved.</p>

        </div>



    </div>

</footer>

<a href="https://wa.me/6281223456110" class="whatsapp-float">
    <i class="fa-brands fa-whatsapp"></i><span>Hubungi Kami</span>
</a>

<?php if(isset($pengumumans) && $pengumumans->count() > 0): ?>
<div class="rt-wrapper" id="rtBox">
    <div class="rt-container">
        <div class="rt-label">PENGUMUMAN</div>
        <div class="rt-content">
            <marquee onmouseover="this.stop();" onmouseout="this.start();">
                <?php $__currentLoopData = $pengumumans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('public.pengumuman.index')); ?>">
                        <i class="fas fa-bullhorn text-warning me-2"></i><strong><?php echo e($p->judul); ?>:</strong> <?php echo e(Str::limit(strip_tags($p->isi_pengumuman), 100)); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </marquee>
        </div>
        <button class="rt-close" onclick="document.getElementById('rtBox').remove()">×</button>
    </div>
</div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // --- DARK MODE LOGIC ---
    const themeToggle = document.getElementById('theme-toggle');
    const body = document.body;
    const icon = themeToggle.querySelector('i');

    if (localStorage.getItem('theme') === 'dark') {
        body.classList.add('dark-mode');
        icon.classList.replace('fa-moon', 'fa-sun');
    }

    themeToggle.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        const isDark = body.classList.contains('dark-mode');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        
        if (isDark) {
            icon.classList.replace('fa-moon', 'fa-sun');
        } else {
            icon.classList.replace('fa-sun', 'fa-moon');
        }
    });

    // --- DROPDOWN & TABS (KODE ANDA) ---
    const menuBtn = document.getElementById('menuBtn');
    const dropdownContent = document.getElementById('dropdownContent');
    menuBtn.onclick = (e) => { e.stopPropagation(); dropdownContent.classList.toggle('show'); };
    window.onclick = () => dropdownContent.classList.remove('show');

    const tabs = document.querySelectorAll(".social-tab");
    tabs.forEach(tab => {
        tab.onclick = function() {
            tabs.forEach(t => t.classList.remove("active"));
            document.querySelectorAll(".social-panel").forEach(p => p.style.display = "none");
            this.classList.add("active");
            document.getElementById(this.getAttribute("data-social") + "-panel").style.display = "block";
        }
    });

    new Swiper('.social-swiper', { slidesPerView: 1, spaceBetween: 20, navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' }, breakpoints: { 640: { slidesPerView: 2 }, 1024: { slidesPerView: 3 } } });
});
</script>
</body>
</html>
<?php /**PATH C:\Users\LENOVO\Documents\humas-polres-bangkalan\resources\views/welcome.blade.php ENDPATH**/ ?>