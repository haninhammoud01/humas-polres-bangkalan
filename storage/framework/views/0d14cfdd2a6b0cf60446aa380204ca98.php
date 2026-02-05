

<?php $__env->startSection('title', 'Profil Polres Bangkalan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    
    <!-- Judul Halaman -->
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">Profil Polres Bangkalan</h2>
        <p class="text-muted">Mengenal lebih dekat Kepolisian Resor Bangkalan</p>
    </div>

    <div class="row g-5">
        
        <!-- KOLOM KIRI: Sambutan, Visi, Misi -->
        <div class="col-lg-8">
            
            <!-- Sambutan Kapolres -->
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-3 border-bottom pb-2">
                        <i class="fas fa-quote-left text-primary me-2"></i>Sambutan Kapolres
                    </h4>
                    <div class="text-justify" style="white-space: pre-wrap;">
                        <?php echo $profil->sambutan_kapolres; ?>

                    </div>
                </div>
            </div>

            <!-- Visi -->
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 text-success">
                        <i class="fas fa-eye me-2"></i>Visi
                    </h5>
                    <p class="lead fst-italic">"<?php echo e($profil->visi); ?>"</p>
                </div>
            </div>

            <!-- Misi -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 text-info">
                        <i class="fas fa-bullseye me-2"></i>Misi
                    </h5>
                    <ul class="list-group list-group-flush">
                        <!-- Ubah baris baru menjadi bullet point -->
                        <?php $__currentLoopData = explode("\n", $profil->misi); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(trim($line)): ?>
                        <li class="list-group-item bg-transparent border-0 ps-0">
                            <?php echo e($line); ?>

                        </li>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: Info Kontak -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 bg-primary text-white sticky-top" style="top: 100px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Hubungi Kami</h5>
                    
                    <div class="mb-3 d-flex">
                        <i class="fas fa-map-marker-alt mt-1 me-3 fa-lg"></i>
                        <div>
                            <strong>Alamat</strong>
                            <p class="mb-0 small"><?php echo e($profil->alamat); ?></p>
                        </div>
                    </div>

                    <div class="mb-3 d-flex">
                        <i class="fas fa-phone-alt mt-1 me-3 fa-lg"></i>
                        <div>
                            <strong>Telepon</strong>
                            <p class="mb-0 small"><?php echo e($profil->telepon); ?></p>
                        </div>
                    </div>

                    <div class="mb-3 d-flex">
                        <i class="fas fa-envelope mt-1 me-3 fa-lg"></i>
                        <div>
                            <strong>Email</strong>
                            <p class="mb-0 small"><?php echo e($profil->email); ?></p>
                        </div>
                    </div>

                    <hr class="border-light">

                    <h6 class="fw-bold mb-3">Media Sosial</h6>
                    <div class="d-flex gap-3">
                        <?php if($profil->facebook): ?>
                        <a href="https://<?php echo e($profil->facebook); ?>" class="text-white text-decoration-none"><i class="fab fa-facebook fa-2x"></i></a>
                        <?php endif; ?>
                        <?php if($profil->twitter): ?>
                        <a href="https://<?php echo e($profil->twitter); ?>" class="text-white text-decoration-none"><i class="fab fa-twitter fa-2x"></i></a>
                        <?php endif; ?>
                        <?php if($profil->instagram): ?>
                        <a href="https://<?php echo e($profil->instagram); ?>" class="text-white text-decoration-none"><i class="fab fa-instagram fa-2x"></i></a>
                        <?php endif; ?>
                        <?php if($profil->youtube): ?>
                        <a href="https://<?php echo e($profil->youtube); ?>" class="text-white text-decoration-none"><i class="fab fa-youtube fa-2x"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\LENOVO\Documents\humas-polres-bangkalan\resources\views/public/profil.blade.php ENDPATH**/ ?>