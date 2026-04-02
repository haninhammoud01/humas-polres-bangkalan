

<?php $__env->startSection('title', 'Kelola Berita'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4">
    
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="text-muted mb-0">Manage semua berita dan artikel</p>
        </div>
        <a href="<?php echo e(route('admin.berita.create')); ?>" class="btn btn-dark">
            <i class="fas fa-plus me-2"></i>Tambah Berita
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

    
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="<?php echo e(route('admin.berita.index')); ?>" method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Cari Berita</label>
                        <input type="text" 
                               name="search" 
                               class="form-control" 
                               placeholder="Cari judul atau konten..."
                               value="<?php echo e(request('search')); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select name="kategori" class="form-select">
                            <option value="">Semua Kategori</option>
                            <?php $__currentLoopData = $kategoris ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($kat->id_kategori); ?>" 
                                        <?php echo e(request('kategori') == $kat->id_kategori ? 'selected' : ''); ?>>
                                    <?php echo e($kat->nama_kategori); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="Published" <?php echo e(request('status') == 'Published' ? 'selected' : ''); ?>>
                                Published
                            </option>
                            <option value="Draft" <?php echo e(request('status') == 'Draft' ? 'selected' : ''); ?>>
                                Draft
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-dark w-100">
                            <i class="fas fa-search me-2"></i>Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <?php if($beritas->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4" width="150">Gambar</th>
                            <th>Judul</th>
                            <th width="150">Kategori</th>
                            <th width="120">Penulis</th>
                            <th width="120">Tanggal</th>
                            <th width="100">Status</th>
                            <th width="180" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $beritas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $berita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="ps-4 align-middle">
                                <?php if($berita->gambar_utama): ?>
                                <img src="<?php echo e($berita->gambar_utama); ?>" 
                                     alt="<?php echo e($berita->judul); ?>" 
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
                                <strong><?php echo e(Str::limit($berita->judul, 50)); ?></strong>
                                <br>
                                <small class="text-muted">
                                    <?php echo e(Str::limit(strip_tags($berita->ringkasan ?? $berita->konten), 80)); ?>

                                </small>
                            </td>
                            <td class="align-middle">
                                <?php if($berita->kategori): ?>
                                    <span class="badge bg-secondary">
                                        <?php echo e($berita->kategori->nama_kategori); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="align-middle">
                                <small><?php echo e($berita->penulis->nama ?? $berita->penulis->name ?? '-'); ?></small>
                            </td>
                            <td class="align-middle">
                                <small><?php echo e($berita->tanggal_publish ? $berita->tanggal_publish->format('d M Y') : '-'); ?></small>
                            </td>
                            <td class="align-middle">
                                <?php if($berita->status == 'Published'): ?>
                                    <span class="badge bg-success">Published</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Draft</span>
                                <?php endif; ?>
                            </td>
                            <td class="align-middle text-center">
                                <div class="btn-group" role="group">
                                    <a href="<?php echo e(route('berita.show', $berita->slug)); ?>" 
                                       class="btn btn-sm btn-outline-secondary"
                                       title="Lihat"
                                       target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('admin.berita.edit', $berita->id_berita)); ?>" 
                                       class="btn btn-sm btn-dark"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.berita.destroy', $berita->id_berita)); ?>" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
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

            
            <?php if($beritas->hasPages()): ?>
            <div class="p-3">
                <?php echo e($beritas->appends(request()->query())->links()); ?>

            </div>
            <?php endif; ?>

            <?php else: ?>
            
            <div class="text-center py-5">
                <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                <h5 class="text-muted">
                    <?php if(request('search') || request('kategori') || request('status')): ?>
                        Tidak ada berita ditemukan
                    <?php else: ?>
                        Belum ada berita
                    <?php endif; ?>
                </h5>
                <p class="text-muted mb-4">
                    <?php if(request('search') || request('kategori') || request('status')): ?>
                        Coba ubah filter pencarian
                    <?php else: ?>
                        Tambahkan berita pertama Anda
                    <?php endif; ?>
                </p>
                <?php if(!request('search') && !request('kategori') && !request('status')): ?>
                <a href="<?php echo e(route('admin.berita.create')); ?>" class="btn btn-dark">
                    <i class="fas fa-plus me-2"></i>Tambah Berita
                </a>
                <?php else: ?>
                <a href="<?php echo e(route('admin.berita.index')); ?>" class="btn btn-outline-secondary">
                    <i class="fas fa-times me-2"></i>Reset Filter
                </a>
                <?php endif; ?>
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

.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #dee2e6;
}

.form-control:focus, .form-select:focus {
    border-color: #1a1a1a;
    box-shadow: 0 0 0 0.2rem rgba(26, 26, 26, 0.1);
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\LENOVO\Documents\humas-polres-bangkalan\resources\views/admin/berita/index.blade.php ENDPATH**/ ?>