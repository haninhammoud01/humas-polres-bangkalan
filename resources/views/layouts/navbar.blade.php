<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <div class="container">
        <!-- Logo & Brand -->
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <i class="fas fa-shield-alt fa-2x me-2"></i>
            <div>
                <div class="fw-bold">POLRES BANGKALAN</div>
                <small style="font-size: 0.75rem;">Humas Polres Bangkalan</small>
            </div>
        </a>
        
        <!-- Toggle Button Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                        <i class="fas fa-home me-1"></i> Beranda
                    </a>
                </li>
                
                <!-- Dropdown Profil -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <i class="fas fa-building me-1"></i> Profil
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Sambutan Kapolres</a></li>
                        <li><a class="dropdown-item" href="#">Visi & Misi</a></li>
                        <li><a class="dropdown-item" href="#">Sejarah</a></li>
                        <li><a class="dropdown-item" href="#">Struktur Organisasi</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-newspaper me-1"></i> Berita
                    </a>
                </li>
                
                <!-- Dropdown Galeri -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <i class="fas fa-images me-1"></i> Galeri
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Galeri Foto</a></li>
                        <li><a class="dropdown-item" href="#">Galeri Video</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-hands-helping me-1"></i> Layanan
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-bullhorn me-1"></i> Pengumuman
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-phone me-1"></i> Kontak
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
