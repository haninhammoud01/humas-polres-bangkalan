

<?php $__env->startSection('title', 'Edit Profil Polres'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4">
    
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="text-muted mb-0">Kelola informasi profil Polres Bangkalan</p>
        </div>
        <a href="<?php echo e(route('admin.profil.struktur')); ?>" class="btn btn-dark">
            <i class="fas fa-sitemap me-2"></i>Edit Struktur Organisasi
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

    
    <?php if(config('app.debug')): ?>
    <div class="alert alert-info">
        <strong>DEBUG:</strong><br>
        Logo: <?php echo e($profil->logo ?? 'null'); ?><br>
        Logo URL: <?php echo e($profil->logo_url ?? 'null'); ?><br>
        Storage Link: <?php echo e(public_path('storage')); ?> → <?php echo e(storage_path('app/public')); ?>

    </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.profil.update')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="row g-4">
            
            <div class="col-lg-8">
                
                
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-info-circle me-2 text-primary"></i>Informasi Dasar
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Nama Instansi <span class="text-danger">*</span></label>
                                <input type="text" name="nama_instansi" class="form-control <?php $__errorArgs = ['nama_instansi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       value="<?php echo e(old('nama_instansi', $profil->nama_instansi)); ?>" required>
                                <?php $__errorArgs = ['nama_instansi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Alamat <span class="text-danger">*</span></label>
                                <textarea name="alamat" rows="3" class="form-control <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required><?php echo e(old('alamat', $profil->alamat)); ?></textarea>
                                <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Telepon</label>
                                <input type="text" name="telepon" class="form-control" value="<?php echo e(old('telepon', $profil->telepon)); ?>">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo e(old('email', $profil->email)); ?>">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Website</label>
                                <input type="url" name="website" class="form-control" value="<?php echo e(old('website', $profil->website)); ?>">
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-bullseye me-2 text-success"></i>Visi & Misi
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Visi</label>
                            <textarea name="visi" rows="3" class="form-control"><?php echo e(old('visi', $profil->visi)); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Misi</label>
                            <textarea name="misi" rows="5" class="form-control"><?php echo e(old('misi', $profil->misi)); ?></textarea>
                            <small class="text-muted">Pisahkan dengan enter untuk beberapa poin</small>
                        </div>

                        <div>
                            <label class="form-label fw-semibold">Motto</label>
                            <input type="text" name="motto" class="form-control" value="<?php echo e(old('motto', $profil->motto)); ?>">
                        </div>
                    </div>
                </div>

                
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-user-tie me-2 text-info"></i>Sambutan Kapolres
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Kapolres</label>
                                <input type="text" name="nama_kapolres" class="form-control" value="<?php echo e(old('nama_kapolres', $profil->nama_kapolres)); ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Pangkat</label>
                                <input type="text" name="pangkat_kapolres" class="form-control" value="<?php echo e(old('pangkat_kapolres', $profil->pangkat_kapolres)); ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">NRP</label>
                                <input type="text" name="nrp_kapolres" class="form-control" value="<?php echo e(old('nrp_kapolres', $profil->nrp_kapolres)); ?>">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Sambutan Kapolres</label>
                                <textarea name="sambutan_kapolres" rows="5" class="form-control"><?php echo e(old('sambutan_kapolres', $profil->sambutan_kapolres)); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-map-marked-alt me-2 text-danger"></i>Wilayah Hukum
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Deskripsi Wilayah</label>
                                <textarea name="wilayah_hukum" rows="3" class="form-control"><?php echo e(old('wilayah_hukum', $profil->wilayah_hukum)); ?></textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Luas Wilayah</label>
                                <input type="text" name="luas_wilayah" class="form-control" 
                                       value="<?php echo e(old('luas_wilayah', $profil->luas_wilayah)); ?>" placeholder="1.260,84 km²">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Jumlah Kecamatan</label>
                                <input type="number" name="jumlah_kecamatan" class="form-control" 
                                       value="<?php echo e(old('jumlah_kecamatan', $profil->jumlah_kecamatan)); ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Jumlah Desa</label>
                                <input type="number" name="jumlah_desa" class="form-control" 
                                       value="<?php echo e(old('jumlah_desa', $profil->jumlah_desa)); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-lg-4">
                
                
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-image me-2 text-warning"></i>Logo Polres
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php if($profil->logo): ?>
                        <div class="mb-3">
                            <img src="<?php echo e(asset('storage/' . $profil->logo)); ?>" alt="Logo" class="img-thumbnail w-100" style="max-height: 200px; object-fit: contain;">
                            <div class="text-muted small mt-1">
                                File: <?php echo e(basename($profil->logo)); ?>

                            </div>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="delete_logo" id="delete_logo" value="1">
                            <label class="form-check-label text-danger fw-semibold" for="delete_logo">
                                <i class="fas fa-trash me-1"></i>Hapus logo saat ini
                            </label>
                        </div>
                        <?php else: ?>
                        <div class="alert alert-warning mb-3">
                            <i class="fas fa-exclamation-triangle me-2"></i>Belum ada logo
                        </div>
                        <?php endif; ?>
                        
                        <label class="form-label fw-semibold">Upload Logo Baru</label>
                        <input type="file" name="logo" class="form-control mb-2" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG, SVG (Max 2MB)</small>
                    </div>
                </div>

                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-dark btn-lg">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                    <a href="<?php echo e(route('profil.index')); ?>" class="btn btn-outline-secondary" target="_blank">
                        <i class="fas fa-eye me-2"></i>Lihat Halaman Publik
                    </a>
                </div>
            </div>
        </div>
    </form>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.card { border-radius: 12px; }
.btn-dark {
    background: #1a1a1a !important;
    border: none !important;
    transition: all 0.3s;
}
.btn-dark:hover {
    background: #dc3545 !important;
    transform: translateY(-2px);
}
.form-control { border-radius: 8px; }
.form-check-input:checked {
    background-color: #dc3545;
    border-color: #dc3545;
}
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\LENOVO\Documents\humas-polres-bangkalan\resources\views/admin/profil/edit.blade.php ENDPATH**/ ?>