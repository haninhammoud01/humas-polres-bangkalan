

<?php $__env->startSection('title', 'Kelola Layanan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="<?php echo e(route('admin.layanan.create')); ?>" class="btn btn-dark">
            <i class="fas fa-plus me-2"></i>Tambah Layanan
        </a>
    </div>

    <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="5%">Icon</th>
                            <th width="25%">Nama Layanan</th>
                            <th width="15%">Slug</th>
                            <th width="10%">Urutan</th>
                            <th width="10%">Status</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $layanans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $layanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($layanans->firstItem() + $index); ?></td>
                            <td>
                                <?php if($layanan->icon): ?>
                                    <i class="fas <?php echo e($layanan->icon); ?> fa-2x text-primary"></i>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong><?php echo e($layanan->nama_layanan); ?></strong>
                                <br><small class="text-muted"><?php echo e(Str::limit($layanan->deskripsi, 50)); ?></small>
                            </td>
                            <td><code><?php echo e($layanan->slug); ?></code></td>
                            <td><span class="badge bg-secondary"><?php echo e($layanan->urutan); ?></span></td>
                            <td>
                                <?php if($layanan->is_active): ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="<?php echo e(route('admin.layanan.edit', $layanan->id_layanan)); ?>" 
                                       class="btn btn-sm btn-dark">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?php echo e(route('public.layanan.show', $layanan->slug)); ?>" 
                                       class="btn btn-sm btn-outline-dark" 
                                       target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.layanan.destroy', $layanan->id_layanan)); ?>" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin hapus layanan ini?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada layanan</p>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                <?php echo e($layanans->links()); ?>

            </div>
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
.btn-outline-dark:hover {
    background: #1a1a1a !important;
    border-color: #1a1a1a !important;
}
.card {
    border-radius: 12px;
}
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\LENOVO\Documents\humas-polres-bangkalan\resources\views/admin/layanan/index.blade.php ENDPATH**/ ?>