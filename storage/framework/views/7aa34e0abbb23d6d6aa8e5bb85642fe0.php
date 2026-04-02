<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Humas Polres Bangkalan'); ?></title>
    
    <link rel="icon" type="image/png" href="<?php echo e(asset('assets/images/Logo.png')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/welcome.css')); ?>">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Poppins', sans-serif; 
            overflow-x: hidden;
            transition: background-color 0.3s, color 0.3s;
        }
        
        /* DARK MODE - SYNC with welcome.blade.php */
        body.dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }
        body.dark-mode .navbar {
            background-color: #1a1a1a !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.5);
        }
        body.dark-mode .navbar-brand .brand-text h5,
        body.dark-mode .nav-link {
            color: #e0e0e0 !important;
        }
        body.dark-mode .navbar-brand .brand-text small {
            color: #999 !important;
        }
        body.dark-mode .nav-link:hover,
        body.dark-mode .nav-link.active {
            color: #dc3545 !important;
            background: rgba(220, 53, 69, 0.2);
        }
        
        /* MINIMALIST NAVBAR - SUPER CLEAN */
        .navbar {
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            padding: 12px 0;
            transition: all 0.3s;
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        
        .navbar-brand img {
            width: 45px;
            height: 45px;
            object-fit: contain;
        }
        
        .navbar-brand .brand-text h5 {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
            color: #1a1a1a;
            letter-spacing: -0.3px;
        }
        
        .navbar-brand .brand-text small {
            font-size: 11px;
            color: #666;
            font-weight: 400;
        }
        
        .nav-link {
            color: #444 !important;
            font-weight: 500;
            font-size: 14px;
            padding: 8px 16px !important;
            transition: all 0.2s;
            border-radius: 6px;
            margin: 0 2px;
        }
        
        .nav-link i {
            font-size: 13px;
            opacity: 0.8;
        }
        
        .nav-link:hover,
        .nav-link.active {
            color: #dc3545 !important;
            background: rgba(220, 53, 69, 0.08);
        }
        
        .nav-link.active {
            font-weight: 600;
        }
        
        /* Dark Mode Toggle Button - MINIMALIST */
        .theme-toggle-btn {
            background: transparent;
            border: 1px solid #ddd;
            color: #666;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            margin-left: 8px;
        }
        
        .theme-toggle-btn:hover {
            background: #f8f9fa;
            border-color: #dc3545;
            color: #dc3545;
            transform: rotate(180deg);
        }
        
        body.dark-mode .theme-toggle-btn {
            border-color: #444;
            color: #ffc107;
        }
        
        body.dark-mode .theme-toggle-btn:hover {
            background: #2d2d2d;
            border-color: #ffc107;
        }
        
        /* Running Text */
        .running-text-wrapper {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            position: sticky;
            top: 66px;
            z-index: 999;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .running-text-container {
            display: flex;
            align-items: center;
            max-width: 100%;
            overflow: hidden;
        }
        
        .running-text-label {
            background: #1a1a1a;
            color: white;
            padding: 10px 18px;
            font-weight: 700;
            font-size: 12px;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .running-text-content {
            flex: 1;
            padding: 10px 0;
            color: white;
            font-weight: 500;
            font-size: 13px;
        }
        
        .running-text-content marquee {
            padding: 0 20px;
        }
        
        .running-text-item {
            color: white;
            text-decoration: none;
            margin: 0 30px;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .running-text-item:hover {
            color: #ffc107;
            text-shadow: 0 0 10px rgba(255,193,7,0.5);
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .running-text-item i {
            animation: spin 2s linear infinite;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .navbar-brand img { width: 40px; height: 40px; }
            .navbar-brand .brand-text h5 { font-size: 14px; }
            .navbar-brand .brand-text small { font-size: 10px; }
            .nav-link { font-size: 13px; padding: 6px 12px !important; }
            .running-text-label { padding: 8px 12px; font-size: 11px; }
            .running-text-content { font-size: 12px; }
            .theme-toggle-btn { width: 32px; height: 32px; }
        }
    </style>
    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    
    
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                <img src="<?php echo e(asset('assets/images/Logo.png')); ?>" alt="Logo">
                <div class="brand-text">
                    <h5>Polres Bangkalan</h5>
                    <small>Humas Polres Bangkalan</small>
                </div>
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>">
                            <i class="fas fa-home"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('profil.index') ? 'active' : ''); ?>" href="<?php echo e(route('profil.index')); ?>">
                            <i class="fas fa-building"></i> Profil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('berita.*') ? 'active' : ''); ?>" href="<?php echo e(route('berita.index')); ?>">
                            <i class="fas fa-newspaper"></i> Berita
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('public.layanan.*') ? 'active' : ''); ?>" href="<?php echo e(route('public.layanan.index')); ?>">
                            <i class="fas fa-concierge-bell"></i> Layanan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('public.pengumuman.*') ? 'active' : ''); ?>" href="<?php echo e(route('public.pengumuman.index')); ?>">
                            <i class="fas fa-bullhorn"></i> Pengumuman
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('public.galeri.*') ? 'active' : ''); ?>" href="<?php echo e(route('public.galeri.index')); ?>">
                            <i class="fas fa-images"></i> Galeri
                        </a>
                    </li>
                    <li class="nav-item">
                        <button id="themeToggle" class="theme-toggle-btn">
                            <i class="fas fa-moon" id="themeIcon"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    
    <?php if (! (request()->is('admin*'))): ?>
        <?php
            try {
                $runningPengumumans = \App\Models\Pengumuman::where('is_active', true)
                    ->where('prioritas', 'High')
                    ->orderBy('tanggal_pengumuman', 'desc')
                    ->take(5)
                    ->get();
            } catch (\Exception $e) {
                $runningPengumumans = collect();
            }
        ?>
        
        <?php if($runningPengumumans->count() > 0): ?>
        <div class="running-text-wrapper">
            <div class="running-text-container">
                <div class="running-text-label">
                    <i class="fas fa-bullhorn"></i>
                    <span>PENGUMUMAN</span>
                </div>
                <div class="running-text-content">
                    <marquee behavior="scroll" direction="left" scrollamount="5">
                        <?php $__currentLoopData = $runningPengumumans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pengumuman): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('public.pengumuman.show', $pengumuman->id_pengumuman)); ?>" class="running-text-item">
                                <i class="fas fa-circle-notch fa-xs"></i> <?php echo e($pengumuman->judul); ?>

                            </a>
                            <?php if(!$loop->last): ?> • <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </marquee>
                </div>
            </div>
        </div>
        <?php endif; ?>
    <?php endif; ?>
    
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
    
    
    <?php if (! (request()->is('admin*'))): ?>
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
    <?php endif; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = document.getElementById('themeIcon');
            const body = document.body;

            // Load saved theme from localStorage
            if (localStorage.getItem('theme') === 'dark') {
                body.classList.add('dark-mode');
                themeIcon.classList.replace('fa-moon', 'fa-sun');
            }

            // Toggle theme
            themeToggle.addEventListener('click', () => {
                body.classList.toggle('dark-mode');
                const isDark = body.classList.contains('dark-mode');
                
                // Save to localStorage
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
                
                // Change icon
                if (isDark) {
                    themeIcon.classList.replace('fa-moon', 'fa-sun');
                } else {
                    themeIcon.classList.replace('fa-sun', 'fa-moon');
                }
            });
        });
    </script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\LENOVO\Documents\humas-polres-bangkalan\resources\views/layouts/app.blade.php ENDPATH**/ ?>