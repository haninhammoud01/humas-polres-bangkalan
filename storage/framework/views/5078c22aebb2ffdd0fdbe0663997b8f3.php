

<?php $__env->startSection('title', 'Kategori Berita'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4">
    
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="text-muted mb-0">Kelola kategori untuk mengorganisir berita</p>
        </div>
        <a href="<?php echo e(route('admin.kategori-berita.create')); ?>" class="btn btn-dark">
            <i class="fas fa-plus me-2"></i>Tambah Kategori
        </a>
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
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3" width="5%">No</th>
                            <th class="py-3" width="25%">Nama Kategori</th>
                            <th class="py-3" width="30%">Deskripsi</th>
                            <th class="py-3 text-center" width="12%">Jumlah Berita</th>
                            <th class="py-3 text-center" width="10%">Status</th>
                            <th class="py-3 text-center" width="18%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-4"><?php echo e($kategoris->firstItem() + $index); ?></td>
                            <td>
                                <div class="fw-bold" style="color: #1a1a1a;"><?php echo e($kategori->nama_kategori); ?></div>
                                <small class="text-muted"><?php echo e($kategori->slug); ?></small>
                            </td>
                            <td>
                                <small class="text-muted">
                                    <?php echo e($kategori->deskripsi ? Str::limit($kategori->deskripsi, 100) : '-'); ?>

                                </small>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-primary"><?php echo e($kategori->beritas_count); ?></span>
                            </td>
                            <td class="text-center">
                                <?php if($kategori->is_active): ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    
                                    <form action="<?php echo e(route('admin.kategori-berita.toggle-active', $kategori->id_kategori)); ?>" 
                                          method="POST" 
                                          class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-<?php echo e($kategori->is_active ? 'warning' : 'success'); ?>" 
                                                title="<?php echo e($kategori->is_active ? 'Nonaktifkan' : 'Aktifkan'); ?>">
                                            <i class="fas fa-<?php echo e($kategori->is_active ? 'eye-slash' : 'eye'); ?>"></i>
                                        </button>
                                    </form>

                                    
                                    <a href="<?php echo e(route('admin.kategori-berita.edit', $kategori->id_kategori)); ?>" 
                                       class="btn btn-sm btn-outline-primary"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    
                                    <form action="<?php echo e(route('admin.kategori-berita.destroy', $kategori->id_kategori)); ?>" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin hapus kategori <?php echo e($kategori->nama_kategori); ?>?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger"
                                                title="Hapus"
                                                <?php echo e($kategori->beritas_count > 0 ? 'disabled' : ''); ?>>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">Belum ada kategori</p>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <?php if($kategoris->hasPages()): ?>
            <div class="p-3 border-top">
                <?php echo e($kategoris->links()); ?>

            </div>
            <?php endif; ?>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.btn-dark {
    background: #1a1a1a;
    border: none;
    transition: all 0.3s;
}

.btn-dark:hover {
    background: #dc3545;
    transform: translateY(-2px);
}

.table thead th {
    font-weight: 600;
    color: #1a1a1a;
    border-bottom: 2px solid #dee2e6;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

.btn-group .btn {
    border-radius: 0;
}

.btn-group .btn:first-child {
    border-radius: 6px 0 0 6px;
}

.btn-group .btn:last-child {
    border-radius: 0 6px 6px 0;
}

.card {
    border-radius: 12px;
}
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\LENOVO\Documents\humas-polres-bangkalan\resources\views/admin/kategori-berita/index.blade.php ENDPATH**/ ?>