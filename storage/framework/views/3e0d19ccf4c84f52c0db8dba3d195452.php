

<?php $__env->startSection('title', $layanan->nama_layanan); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('public.layanan.index')); ?>">Layanan</a></li>
            <li class="breadcrumb-item active"><?php echo e($layanan->nama_layanan); ?></li>
        </ol>
    </nav>

    <div class="row g-5">
        
        <div class="col-lg-8">
            <div class="layanan-detail">
                
                <div class="d-flex align-items-center gap-4 mb-4">
                    <?php if($layanan->icon_image): ?>
                    <div class="layanan-icon-large flex-shrink-0">
                        <img src="<?php echo e(asset($layanan->icon_image)); ?>" 
                             alt="<?php echo e($layanan->nama_layanan); ?>" 
                             class="img-fluid"
                             style="max-height: 100px; width: auto;">
                    </div>
                    <?php endif; ?>
                    <div>
                        <h1 class="display-6 fw-bold mb-2"><?php echo e($layanan->nama_layanan); ?></h1>
                        <?php if($layanan->deskripsi_singkat): ?>
                            <p class="lead text-muted mb-0"><?php echo e($layanan->deskripsi_singkat); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                
                <?php if($layanan->deskripsi): ?>
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">
                            <i class="fas fa-info-circle text-primary me-2"></i>
                            Tentang Layanan
                        </h5>
                        <p class="mb-0"><?php echo e($layanan->deskripsi); ?></p>
                    </div>
                </div>
                <?php endif; ?>

                
                <?php if($layanan->persyaratan): ?>
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">
                            <i class="fas fa-clipboard-list text-success me-2"></i>
                            Persyaratan
                        </h5>
                        <div class="requirements">
                            <?php echo nl2br(e($layanan->persyaratan)); ?>

                        </div>
                    </div>
                </div>
                <?php endif; ?>

                
                <?php if($layanan->prosedur): ?>
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">
                            <i class="fas fa-list-ol text-info me-2"></i>
                            Prosedur
                        </h5>
                        <div class="procedure">
                            <?php echo nl2br(e($layanan->prosedur)); ?>

                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="col-lg-4">
            
            <div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Informasi Singkat</h5>

                    <?php if($layanan->biaya): ?>
                    <div class="info-item mb-3">
                        <div class="d-flex align-items-start gap-3">
                            <i class="fas fa-money-bill-wave text-success mt-1"></i>
                            <div>
                                <strong class="d-block mb-1">Biaya</strong>
                                <span class="text-muted"><?php echo e($layanan->biaya); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if($layanan->waktu_proses): ?>
                    <div class="info-item mb-3">
                        <div class="d-flex align-items-start gap-3">
                            <i class="fas fa-clock text-warning mt-1"></i>
                            <div>
                                <strong class="d-block mb-1">Waktu Proses</strong>
                                <span class="text-muted"><?php echo e($layanan->waktu_proses); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="info-item mb-3">
                        <div class="d-flex align-items-start gap-3">
                            <i class="fas fa-map-marker-alt text-danger mt-1"></i>
                            <div>
                                <strong class="d-block mb-1">Lokasi</strong>
                                <span class="text-muted">Polres Bangkalan<br>Jl. Soekarno Hatta No.45</span>
                            </div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="d-flex align-items-start gap-3">
                            <i class="fas fa-phone text-primary mt-1"></i>
                            <div>
                                <strong class="d-block mb-1">Kontak</strong>
                                <span class="text-muted">(031) 3095266</span>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-grid gap-2">
                        <a href="tel:031-3095266" class="btn btn-dark">
                            <i class="fas fa-phone me-2"></i>
                            Hubungi Kami
                        </a>
                        <a href="https://wa.me/6281223456110" target="_blank" class="btn btn-success">
                            <i class="fab fa-whatsapp me-2"></i>
                            Chat WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="mt-5">
        <a href="<?php echo e(route('public.layanan.index')); ?>" class="btn btn-outline-dark">
            <i class="fas fa-arrow-left me-2"></i>
            Kembali ke Daftar Layanan
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.requirements,
.procedure {
    line-height: 1.8;
}

.info-item i {
    font-size: 1.25rem;
}

.btn-dark {
    background: #1a1a1a;
    border: none;
    transition: all 0.3s;
}

.btn-dark:hover {
    background: #dc3545;
}

.card {
    border-radius: 12px;
}
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\LENOVO\Documents\humas-polres-bangkalan\resources\views/public/layanan-detail.blade.php ENDPATH**/ ?>