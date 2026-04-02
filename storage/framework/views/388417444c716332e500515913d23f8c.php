

<?php $__env->startSection('title', 'Berita - Humas Polres Bangkalan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    
    
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
            <li class="breadcrumb-item active">Berita</li>
        </ol>
    </nav>

    
    <div class="text-center mb-5">
        <h1 class="fw-bold mb-2" style="color: #1a1a1a;">Berita</h1>
        <p class="text-muted">Berita terkini dari Humas Polres Bangkalan</p>
    </div>

    
    <div class="row justify-content-center">
        <div class="col-md-10">
            <?php $__empty_1 = true; $__currentLoopData = $beritas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $berita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="card shadow-sm mb-4 berita-card">
                <div class="row g-0">
                    
                    <?php if($berita->gambar_utama): ?>
                    <div class="col-md-4">
                        
                        <img src="<?php echo e($berita->gambar_utama_url); ?>" 
                             class="img-fluid h-100 berita-img" 
                             alt="<?php echo e($berita->judul); ?>"
                             onerror="this.src='<?php echo e(asset('assets/images/placeholder.jpg')); ?>'">
                    </div>
                    <?php endif; ?>

                    
                    <div class="<?php echo e($berita->gambar_utama ? 'col-md-8' : 'col-md-12'); ?>">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                
                                <span class="badge bg-dark mb-2">
                                    <?php echo e($berita->kategori->nama_kategori ?? 'Umum'); ?>

                                </span>
                                
                                
                                <small class="text-muted">
                                    <i class="far fa-calendar"></i>
                                    <?php echo e($berita->tanggal_publish->format('d M Y')); ?>

                                </small>
                            </div>

                            
                            <h4 class="card-title fw-bold mb-3">
                                <a href="<?php echo e(route('berita.show', $berita->slug)); ?>" 
                                   class="text-decoration-none"
                                   style="color: #1a1a1a;">
                                    <?php echo e($berita->judul); ?>

                                </a>
                            </h4>

                            
                            <div class="card-text text-muted mb-3">
                                <?php echo e(Str::limit(strip_tags($berita->ringkasan ?? $berita->konten), 200)); ?>

                            </div>

                            
                            <a href="<?php echo e(route('berita.show', $berita->slug)); ?>" 
                               class="btn btn-dark btn-sm">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>

                            
                            <div class="border-top mt-3 pt-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="fas fa-user"></i> 
                                        <?php echo e($berita->penulis->name ?? 'Admin Humas'); ?>

                                    </small>
                                    <small class="text-muted">
                                        <i class="fas fa-eye"></i> 
                                        <?php echo e(number_format($berita->views)); ?> views
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-5">
                <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Belum Ada Berita</h4>
                <p class="text-muted">Berita akan ditampilkan di sini</p>
            </div>
            <?php endif; ?>
        </div>
    </div>

    
    <?php if($beritas->hasPages()): ?>
        <div class="d-flex justify-content-center mt-4">
            <?php echo e($beritas->links()); ?>

        </div>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.berita-card {
    border-radius: 12px;
    transition: all 0.3s;
    border: 1px solid #e0e0e0;
    overflow: hidden;
}

.berita-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}

.berita-img {
    object-fit: cover;
    border-radius: 12px 0 0 12px;
    min-height: 250px;
}

.card-title a {
    transition: color 0.3s;
}

.card-title a:hover {
    color: #dc3545 !important;
}

.badge {
    font-size: 12px;
    padding: 6px 12px;
    border-radius: 20px;
}

.btn-dark {
    background: #1a1a1a;
    border: none;
    padding: 8px 20px;
    border-radius: 6px;
    transition: all 0.3s;
}

.btn-dark:hover {
    background: #dc3545;
    transform: translateX(3px);
}

.breadcrumb {
    background: transparent;
    padding: 0;
}

.breadcrumb-item a {
    color: #1a1a1a;
    text-decoration: none;
}

.breadcrumb-item a:hover {
    color: #dc3545;
}

/* Dark mode */
body.dark-mode .berita-card {
    background: #2d2d2d;
    border-color: #444;
}

body.dark-mode .card-title a {
    color: #fff !important;
}

body.dark-mode .card-title a:hover {
    color: #dc3545 !important;
}
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\LENOVO\Documents\humas-polres-bangkalan\resources\views/public/berita-list.blade.php ENDPATH**/ ?>