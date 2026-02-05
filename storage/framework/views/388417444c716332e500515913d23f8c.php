

<?php $__env->startSection('title', 'Semua Berita - Polres Bangkalan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">Arsip Berita</h2>
        <p class="text-muted">Kumpulan informasi terkini seputar Polres Bangkalan</p>
    </div>

    <div class="row g-4">
        <?php $__empty_1 = true; $__currentLoopData = $beritas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div style="height: 200px; overflow: hidden;" class="card-img-top bg-light">
                    <?php if($item->gambar_utama): ?>
                        <!-- PASTIKAN PATH INI SUDAH FOTO_BERITA -->
                        <img src="<?php echo e(asset('foto_berita/' . $item->gambar_utama)); ?>" class="w-100 h-100 object-fit-cover" alt="<?php echo e($item->judul); ?>">
                    <?php else: ?>
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light text-muted">
                            <i class="fas fa-image fa-3x opacity-25"></i>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-body d-flex flex-column">
                    <div class="mb-2">
                        <span class="badge bg-primary"><?php echo e($item->kategori->nama_kategori); ?></span>
                    </div>
                    <h5 class="card-title fw-bold mb-3">
                        <a href="<?php echo e(route('public.berita.show', $item->slug)); ?>" class="text-decoration-none text-dark stretched-link">
                            <?php echo e(Str::limit($item->judul, 50)); ?>

                        </a>
                    </h5>
                    <div class="mt-auto pt-2 border-top">
                        <small class="text-muted">
                            <i class="far fa-calendar-alt me-1"></i> <?php echo e(optional($item->tanggal_publish)->format('d F Y')); ?>

                        </small>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12 text-center">
            <p>Belum ada berita.</p>
        </div>
        <?php endif; ?>
    </div>

    <div class="d-flex justify-content-center mt-5">
        <?php echo e($beritas->links()); ?>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\LENOVO\Documents\humas-polres-bangkalan\resources\views/public/berita-list.blade.php ENDPATH**/ ?>