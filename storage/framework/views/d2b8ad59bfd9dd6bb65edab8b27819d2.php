

<?php $__env->startSection('title', 'Kelola Pengumuman'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4">
    
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="text-muted mb-0">Manage pengumuman dan informasi penting</p>
        </div>
        <a href="<?php echo e(route('admin.pengumuman.create')); ?>" class="btn btn-dark">
            <i class="fas fa-plus me-2"></i>Tambah Pengumuman
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
            <?php if($pengumumans->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4" width="60">No</th>
                            <th width="150">Media</th>
                            <th>Judul & Isi</th>
                            <th width="120">Tanggal</th>
                            <th width="100">Status</th>
                            <th width="180" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $pengumumans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $pengumuman): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="ps-4 align-middle">
                                <span class="text-muted"><?php echo e($pengumumans->firstItem() + $index); ?></span>
                            </td>
                            <td class="align-middle">
                                <?php if($pengumuman->media): ?>
                                    <img src="<?php echo e($pengumuman->media); ?>" 
                                         alt="Media" 
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
                                <strong><?php echo e(Str::limit($pengumuman->judul, 50)); ?></strong>
                                <br>
                                <small class="text-muted">
                                    <?php echo e(Str::limit(strip_tags($pengumuman->isi_pengumuman), 80)); ?>

                                </small>
                            </td>
                            <td class="align-middle">
                                <small>
                                    <?php if($pengumuman->tanggal_pengumuman): ?>
                                        <?php if(is_string($pengumuman->tanggal_pengumuman)): ?>
                                            <?php echo e(\Carbon\Carbon::parse($pengumuman->tanggal_pengumuman)->format('d M Y')); ?>

                                        <?php else: ?>
                                            <?php echo e($pengumuman->tanggal_pengumuman->format('d M Y')); ?>

                                        <?php endif; ?>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </small>
                            </td>
                            <td class="align-middle">
                                <?php if($pengumuman->prioritas == 'High'): ?>
                                    <span class="badge bg-danger">High</span>
                                <?php elseif($pengumuman->prioritas == 'Medium'): ?>
                                    <span class="badge bg-warning text-dark">Medium</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Low</span>
                                <?php endif; ?>
                            </td>
                            <td class="align-middle">
                                <?php if($pengumuman->is_active): ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                            <td class="align-middle text-center">
                                <div class="btn-group" role="group">
                                    <a href="<?php echo e(route('public.pengumuman.show', $pengumuman->id_pengumuman)); ?>" 
                                       class="btn btn-sm btn-outline-secondary"
                                       title="Lihat"
                                       target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('admin.pengumuman.edit', $pengumuman->id_pengumuman)); ?>" 
                                       class="btn btn-sm btn-dark"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.pengumuman.destroy', $pengumuman->id_pengumuman)); ?>" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')">
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

            
            <?php if($pengumumans->hasPages()): ?>
            <div class="p-3">
                <?php echo e($pengumumans->links()); ?>

            </div>
            <?php endif; ?>

            <?php else: ?>
            
            <div class="text-center py-5">
                <i class="fas fa-bullhorn fa-4x text-muted mb-3"></i>
                <h5 class="text-muted">Belum ada pengumuman</h5>
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

.badge {
    padding: 6px 10px;
    border-radius: 6px;
}
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\LENOVO\Documents\humas-polres-bangkalan\resources\views/admin/pengumuman/index.blade.php ENDPATH**/ ?>