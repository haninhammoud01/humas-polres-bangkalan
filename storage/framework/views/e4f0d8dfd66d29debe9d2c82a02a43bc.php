<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Admin'); ?> - Humas Polres Bangkalan</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo e(asset('assets/images/Logo.png')); ?>">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <?php echo $__env->yieldPushContent('styles'); ?>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f5f5;
        }
        
        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: white;
            position: fixed;
            width: 250px;
            top: 0;
            left: 0;
            bottom: 0;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 3px;
        }
        
        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            background: rgba(0,0,0,0.2);
        }
        
        .sidebar-header h5 {
            font-weight: 700;
            margin: 10px 0 0 0;
            font-size: 18px;
        }
        
        .sidebar-header small {
            color: rgba(255,255,255,0.7);
            font-size: 12px;
        }
        
        .sidebar-logo {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }
        
        /* Navigation */
        .sidebar .nav {
            padding: 15px 10px;
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 3px 0;
            border-radius: 8px;
            transition: all 0.3s;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            text-decoration: none;
        }
        
        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(5px);
        }
        
        .sidebar .nav-link.active {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
        }
        
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 12px;
            text-align: center;
            font-size: 16px;
        }
        
        .sidebar hr {
            border-color: rgba(255,255,255,0.1);
            margin: 15px 0;
        }
        
        /* Logout Button */
        .sidebar .btn-logout {
            background: none;
            border: none;
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 3px 0;
            border-radius: 8px;
            transition: all 0.3s;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            text-decoration: none;
            width: 100%;
            text-align: left;
        }
        
        .sidebar .btn-logout:hover {
            background: rgba(220, 53, 69, 0.2);
            color: #dc3545;
        }
        
        .sidebar .btn-logout i {
            width: 20px;
            margin-right: 12px;
            text-align: center;
        }
        
        /* Main Content Area */
        .main-wrapper {
            margin-left: 250px;
            min-height: 100vh;
            background: #f5f5f5;
        }
        
        /* Top Navbar */
        .navbar-admin {
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            padding: 15px 30px;
            position: sticky;
            top: 0;
            z-index: 999;
        }
        
        .navbar-admin .navbar-brand {
            font-weight: 600;
            color: #1a1a1a;
            font-size: 20px;
        }
        
        .navbar-admin .navbar-text {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #666;
            font-size: 14px;
        }
        
        .navbar-admin .navbar-text i {
            font-size: 24px;
            color: #1a1a1a;
        }
        
        .user-info {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }
        
        .user-name {
            font-weight: 600;
            color: #1a1a1a;
        }
        
        .user-role {
            font-size: 12px;
            color: #999;
        }
        
        /* Content Area */
        .main-content {
            padding: 30px;
            min-height: calc(100vh - 70px);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 80px;
            }
            
            .sidebar-header h5,
            .sidebar-header small,
            .sidebar .nav-link span {
                display: none;
            }
            
            .sidebar .nav-link {
                justify-content: center;
                padding: 12px;
            }
            
            .sidebar .nav-link i {
                margin: 0;
            }
            
            .main-wrapper {
                margin-left: 80px;
            }
        }
        
        /* Badges */
        .badge-new {
            background: #dc3545;
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 10px;
            margin-left: auto;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <img src="<?php echo e(asset('assets/images/Logo.png')); ?>" alt="Logo" class="sidebar-logo">
                <h5>Admin Panel</h5>
                <small>Humas Polres Bangkalan</small>
            </div>
            
            <nav class="nav flex-column">
                
                <a class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>" 
                   href="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                
                
                <?php if(Route::has('admin.profil.edit')): ?>
                <a class="nav-link <?php echo e(request()->routeIs('admin.profil.*') ? 'active' : ''); ?>" 
                   href="<?php echo e(route('admin.profil.edit')); ?>">
                    <i class="fas fa-building"></i>
                    <span>Profil Polres</span>
                </a>
                <?php endif; ?>
                
                
                <a class="nav-link <?php echo e(request()->routeIs('admin.berita.*') ? 'active' : ''); ?>" 
                   href="<?php echo e(route('admin.berita.index')); ?>">
                    <i class="fas fa-newspaper"></i>
                    <span>Berita</span>
                </a>

                
                <a class="nav-link <?php echo e(request()->routeIs('admin.kategori-berita.*') ? 'active' : ''); ?>" 
                   href="<?php echo e(route('admin.kategori-berita.index')); ?>">
                    <i class="fas fa-tags"></i>
                    <span>Kategori Berita</span>
                </a>
                
                
                <a class="nav-link <?php echo e(request()->routeIs('admin.pengumuman.*') ? 'active' : ''); ?>" 
                   href="<?php echo e(route('admin.pengumuman.index')); ?>">
                    <i class="fas fa-bullhorn"></i>
                    <span>Pengumuman</span>
                </a>
                
                
                <a class="nav-link <?php echo e(request()->routeIs('admin.album.*') ? 'active' : ''); ?>" 
                   href="<?php echo e(route('admin.album.index')); ?>">
                    <i class="fas fa-images"></i>
                    <span>Album Foto</span>
                </a>
                
                
                <a class="nav-link <?php echo e(request()->routeIs('admin.layanan.*') ? 'active' : ''); ?>" 
                   href="<?php echo e(route('admin.layanan.index')); ?>">
                    <i class="fas fa-concierge-bell"></i>
                    <span>Layanan</span>
                </a>
                
                
                <a class="nav-link <?php echo e(request()->routeIs('admin.slider.*') ? 'active' : ''); ?>" 
                   href="<?php echo e(route('admin.slider.index')); ?>">
                    <i class="fas fa-sliders-h"></i>
                    <span>Slider</span>
                </a>
                
                <hr>
                
                
                <a class="nav-link" href="<?php echo e(route('home')); ?>" target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                    <span>Lihat Website</span>
                </a>
                
                
                <form method="POST" action="<?php echo e(route('logout')); ?>" class="m-0">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </nav>
        </div>

        <!-- Main Content Wrapper -->
        <div class="main-wrapper flex-fill">
            <!-- Top Navbar -->
            <nav class="navbar navbar-admin">
                <div class="container-fluid p-0">
                    <span class="navbar-brand mb-0"><?php echo $__env->yieldContent('title', 'Dashboard'); ?></span>
                    <div class="navbar-text">
                        <i class="fas fa-user-circle"></i>
                        <div class="user-info">
                            <span class="user-name"><?php echo e(Auth::user()->nama ?? Auth::user()->name ?? 'Admin'); ?></span>
                            <span class="user-role"><?php echo e(Auth::user()->role ?? 'Administrator'); ?></span>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Content -->
            <div class="main-content">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto hide alerts
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\LENOVO\Documents\humas-polres-bangkalan\resources\views/layouts/admin.blade.php ENDPATH**/ ?>