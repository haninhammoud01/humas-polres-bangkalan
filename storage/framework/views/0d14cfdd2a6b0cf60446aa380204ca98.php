

<?php $__env->startSection('title', 'Profil Polres Bangkalan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    
    
    <div class="text-center mb-5">
        <?php if($profil->logo): ?>
        <img src="<?php echo e($profil->logo ? asset('storage/'.$profil->logo) : ''); ?>" alt="Logo" style="max-height: 100px;" class="mb-3">
        <?php endif; ?>
        <h1 class="fw-bold mb-2"><?php echo e($profil->nama_instansi); ?></h1>
        <p class="text-muted"><?php echo e($profil->alamat); ?></p>
    </div>

    
    <?php if($profil->visi || $profil->misi): ?>
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="row">
                <?php if($profil->visi): ?>
                <div class="col-md-6 mb-3 mb-md-0">
                    <h4 class="fw-bold mb-3 text-primary">
                        <i class="fas fa-eye me-2"></i>Visi
                    </h4>
                    <p class="text-muted"><?php echo e($profil->visi); ?></p>
                </div>
                <?php endif; ?>
                
                <?php if($profil->misi): ?>
                <div class="col-md-6">
                    <h4 class="fw-bold mb-3 text-success">
                        <i class="fas fa-bullseye me-2"></i>Misi
                    </h4>
                    <div class="text-muted" style="white-space: pre-line;"><?php echo e($profil->misi); ?></div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    
    <?php if($profil->sejarah): ?>
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <h4 class="fw-bold mb-3">
                <i class="fas fa-history me-2 text-warning"></i>Sejarah
            </h4>
            <p class="text-muted" style="white-space: pre-line;"><?php echo e($profil->sejarah); ?></p>
        </div>
    </div>
    <?php endif; ?>

    
    <?php if($profil->hasStrukturOrganisasi()): ?>
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <h4 class="fw-bold mb-4">
                <i class="fas fa-sitemap me-2 text-info"></i>Struktur Organisasi
            </h4>
            
            <?php if($profil->struktur_organisasi_text): ?>
            <div class="mb-4 text-muted" style="white-space: pre-line;">
                <?php echo e($profil->struktur_organisasi_text); ?>

            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h4 class="fw-bold mb-4">
                <i class="fas fa-phone me-2 text-danger"></i>Hubungi Kami
            </h4>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <i class="fas fa-map-marker-alt text-danger me-2"></i>
                    <strong>Alamat:</strong><br>
                    <span class="text-muted"><?php echo e($profil->alamat); ?></span>
                </div>
                <?php if($profil->telepon): ?>
                <div class="col-md-4 mb-3">
                    <i class="fas fa-phone text-danger me-2"></i>
                    <strong>Telepon:</strong><br>
                    <span class="text-muted"><?php echo e($profil->telepon); ?></span>
                </div>
                <?php endif; ?>
                <?php if($profil->email): ?>
                <div class="col-md-4 mb-3">
                    <i class="fas fa-envelope text-danger me-2"></i>
                    <strong>Email:</strong><br>
                    <span class="text-muted"><?php echo e($profil->email); ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\LENOVO\Documents\humas-polres-bangkalan\resources\views/public/profil.blade.php ENDPATH**/ ?>