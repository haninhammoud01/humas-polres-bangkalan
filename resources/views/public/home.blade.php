<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Humas Polres Bangkalan</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .hero-section {
            background: url("{{ asset('assets/images/hero-banner.jpg') }}") no-repeat center center/cover;
            min-height: 100vh;
            position: relative;
            color: white;
        }
        
        :root {
            --bg-primary: #ffffff;
            --text-primary: #333333;
            --primary-color: #d92323;
            --card-bg: #ffffff;
        }
        
        .dark-mode {
            --bg-primary: #121212;
            --text-primary: #f0f0f0;
            --card-bg: #1e1e1e;
        }
    </style>
</head>
<body>
    <section class="hero-section">
        <div class="hero-overlay">
            <div class="container">
                <div class="hero-menu">
                    <a href="#layanan" class="menu-item active">Layanan</a>
                    <a href="#media" class="menu-item">Media</a>
                    <a href="#kontak" class="menu-item">Kontak</a>
                </div>
                
                <div class="hero-content">
                    <h1>SELAMAT DATANG DI WEBSITE RESMI DIVISI HUMAS POLRES BANGKALAN</h1>
                    <p>Informasi - Transparansi - Terpercaya</p>
                    
                    <div class="social-icons">
                        <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" title="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="#" title="TikTok"><i class="fab fa-tiktok"></i></a>
                    </div>
                    
                    <a href="#layanan" class="btn-primary">Lihat Layanan</a>
                </div>
            </div>
        </div>
    </section>

    <section id="media" class="content-section">
        <h2>Media Update</h2>
        <div class="media-grid">
            <div class="media-card"></div>
            <div class="media-card"></div>
            <div class="media-card"></div>
        </div>
        <a href="#" class="btn-primary" style="background: #c01a1a; max-width: 250px;">Lihat Lebih Banyak</a>
    </section>

    <a href="https://wa.me/6281234567890" class="whatsapp-btn" title="Hubungi via WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <button class="dark-mode-toggle" id="darkModeToggle">
        <i class="fas fa-moon"></i>
    </button>

    <script>
        document.getElementById('darkModeToggle').addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            localStorage.setItem('theme', document.body.classList.contains('dark-mode') ? 'dark' : 'light');
            this.innerHTML = document.body.classList.contains('dark-mode') 
                ? '<i class="fas fa-sun"></i>' 
                : '<i class="fas fa-moon"></i>';
        });

        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
            document.getElementById('darkModeToggle').innerHTML = '<i class="fas fa-sun"></i>';
        }
    </script>
</body>
</html>
