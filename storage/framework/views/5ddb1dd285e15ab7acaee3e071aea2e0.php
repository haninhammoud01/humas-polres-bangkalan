

<?php $__env->startSection('title', 'Kelola Slider'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4">
    
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="text-muted mb-0">Manage slider gambar untuk homepage</p>
        </div>
    </div>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <?php if($sliders->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4" width="80">Urutan</th>
                            <th width="150">Preview</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th width="100">Status</th>
                            <th width="180" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="ps-4 align-middle">
                                <span class="badge bg-secondary"><?php echo e($slider->urutan); ?></span>
                            </td>
                            <td class="align-middle">
                                <?php if($slider->file_path): ?>
                                <img src="<?php echo e($slider->file_path); ?>" 
                                     alt="<?php echo e($slider->judul); ?>" 
                                     class="img-thumbnail"
                                     style="max-height: 60px; max-width: 100px; object-fit: cover;">
                                <?php else: ?>
                                <div class="bg-light d-flex align-items-center justify-content-center" 
                                     style="width: 100px; height: 60px;">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                                <?php endif; ?>
                            </td>
                            <td class="align-middle">
                                <strong><?php echo e($slider->judul ?? '-'); ?></strong>
                            </td>
                            <td class="align-middle">
                                <small class="text-muted">
                                    <?php echo e(Str::limit($slider->deskripsi ?? '-', 50)); ?>

                                </small>
                            </td>
                            <td class="align-middle">
                                <?php if($slider->is_active): ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                            <td class="align-middle text-center">
                                <div class="btn-group" role="group">
                                    <a href="<?php echo e(route('admin.slider.edit', $slider->id_slider)); ?>" 
                                       class="btn btn-sm btn-dark"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.slider.destroy', $slider->id_slider)); ?>" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus slider ini?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            
            <?php if($sliders->hasPages()): ?>
            <div class="p-3">
                <?php echo e($sliders->links()); ?>

            </div>
            <?php endif; ?>

            <?php else: ?>
            
            <div class="text-center py-5">
                <i class="fas fa-sliders-h fa-4x text-muted mb-3"></i>
                <h5 class="text-muted">Belum ada slider</h5>
                <p class="text-muted mb-4">Tambahkan slider pertama Anda</p>
                <a href="<?php echo e(route('admin.slider.create')); ?>" class="btn btn-dark">
                    <i class="fas fa-plus me-2"></i>Tambah Slider
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.btn-dark {
    background: #1a1a1a !important;
    border-color: #1a1a1a !important;
    transition: all 0.3s;
}

.btn-dark:hover {
    background: #dc3545 !important;
    border-color: #dc3545 !important;
    transform: translateY(-2px);
}

.card {
    border-radius: 12px;
}

.table thead th {
    font-weight: 600;
    color: #666;
    border-bottom: 2px solid #dee2e6;
    padding: 12px 8px;
}

.table tbody td {
    padding: 12px 8px;
    vertical-align: middle;
}

.btn-group .btn {
    padding: 6px 12px;
}
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\LENOVO\Documents\humas-polres-bangkalan\resources\views/admin/slider/index.blade.php ENDPATH**/ ?>