

<?php $__env->startSection('title', $berita->judul); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-5 mb-5">
    <div class="row">
        
        <!-- Kolom Utama -->
        <div class="col-lg-8">
            <article>
                <h1 class="display-5 fw-bold mb-3"><?php echo e($berita->judul); ?></h1>
                
                <div class="d-flex align-items-center text-muted mb-4 border-bottom pb-3">
                    <span class="badge bg-primary me-2"><?php echo e($berita->kategori->nama_kategori); ?></span>
                    <span class="me-3"><i class="far fa-calendar-alt"></i> <?php echo e(optional($berita->tanggal_publish)->format('d F Y')); ?></span>
                    <span><i class="far fa-user"></i> <?php echo e($berita->penulis->nama ?? 'Admin'); ?></span>
                </div>

                <!-- GAMBAR DETAIL: PASTIKAN PATH FOTO_BERITA -->
                <?php if($berita->gambar_utama): ?>
                    <img src="<?php echo e(asset('foto_berita/' . $berita->gambar_utama)); ?>" class="img-fluid rounded shadow-sm w-100 mb-4" alt="<?php echo e($berita->judul); ?>">
                <?php endif; ?>

                <div class="blog-post-content mb-5" style="line-height: 1.8; font-size: 1.1rem;">
                    <p><?php echo $berita->konten; ?></p>
                </div>
            </article>
        </div>

        <!-- Kolom Kanan (Sidebar) -->
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h6 class="mb-0 fw-bold">Berita Terbaru</h6>
                </div>
                <div class="list-group list-group-flush">
                    <?php $__empty_1 = true; $__currentLoopData = $beritaTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(route('public.berita.show', $item->slug)); ?>" class="list-group-item list-group-item-action d-flex gap-3 py-3 align-items-center">
                        <!-- GAMBAR THUMBNAIL: PASTIKAN PATH FOTO_BERITA -->
                        <?php if($item->gambar_utama): ?>
                            <img src="<?php echo e(asset('foto_berita/' . $item->gambar_utama)); ?>" alt="thumb" width="60" height="60" class="rounded object-fit-cover">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/60" class="rounded">
                        <?php endif; ?>
                        
                        <div>
                            <h6 class="mb-0 text-dark text-truncate" style="max-width: 200px;"><?php echo e($item->judul); ?></h6>
                            <small class="text-muted"><?php echo e(optional($item->tanggal_publish)->format('d M')); ?></small>
                        </div>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="list-group-item text-center text-muted">Belum ada berita lain.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\LENOVO\Documents\humas-polres-bangkalan\resources\views/public/berita.blade.php ENDPATH**/ ?>