{{-- 
    Component: Image Upload with Preview & Crop
    Usage: @include('components.image-upload', [
        'name' => 'gambar_utama',
        'label' => 'Gambar Berita',
        'ratio' => '1:1',
        'required' => true,
        'current' => $berita->gambar_utama ?? null
    ])
--}}

@php
use Intervention\Image\Facades\Image; {{-- Import agar Intelephense tidak warning --}}
@endphp

@props([
    'name' => 'image',
    'label' => 'Upload Gambar',
    'ratio' => '1:1',
    'required' => false,
    'current' => null,
    'folder' => 'images',
    'maxSize' => 10
])

<div class="image-upload-wrapper mb-4">
    <label class="form-label fw-bold">
        {{ $label }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    
    {{-- Current Image Preview --}}
    @if($current)
    <div class="current-image-preview mb-3">
        <div class="d-flex align-items-center gap-3 p-3 bg-light rounded">
            <img src="{{ asset($folder . '/' . $current) }}" 
                 alt="Current" 
                 style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
            <div>
                <p class="mb-1 fw-bold">Gambar Saat Ini</p>
                <small class="text-muted">{{ $current }}</small>
            </div>
        </div>
    </div>
    @endif

    {{-- Upload Input --}}
    <input type="file" 
           class="form-control image-input" 
           id="{{ $name }}"
           name="{{ $name }}"
           accept="image/jpeg,image/jpg,image/png,image/webp"
           {{ $required && !$current ? 'required' : '' }}>
    
    {{-- Info Text --}}
    <div class="form-text">
        <i class="fas fa-info-circle me-1"></i>
        Format: JPG, PNG, WebP | Maksimal: {{ $maxSize }}MB | 
        Ratio: {{ $ratio }} | Auto-resize & compress ke ~5KB
    </div>

    {{-- Preview Container --}}
    <div class="image-preview-container mt-3" style="display: none;">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h6 class="mb-0">
                    <i class="fas fa-eye me-2"></i>Preview Gambar
                    <span class="badge bg-primary ms-2">{{ $ratio }}</span>
                </h6>
            </div>
            <div class="card-body text-center">
                <img class="image-preview" 
                     src="" 
                     alt="Preview"
                     style="max-width: 400px; max-height: 400px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                
                {{-- Image Info --}}
                <div class="image-info mt-3 p-3 bg-light rounded">
                    <div class="row text-start">
                        <div class="col-md-4">
                            <small class="text-muted d-block">Ukuran File</small>
                            <strong class="file-size">-</strong>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted d-block">Dimensi</small>
                            <strong class="file-dimensions">-</strong>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted d-block">Format</small>
                            <strong class="file-format">-</strong>
                        </div>
                    </div>
                </div>

                {{-- Warning if too large --}}
                <div class="alert alert-warning mt-3" style="display: none;" id="size-warning-{{ $name }}">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    File akan di-compress otomatis saat upload
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.image-upload-wrapper .form-control:focus {
    border-color: #1a1a1a;
    box-shadow: 0 0 0 0.25rem rgba(26, 26, 26, 0.1);
}

.image-preview-container {
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.current-image-preview {
    animation: slideIn 0.3s ease;
}

@keyframes slideIn {
    from { opacity: 0; transform: translateX(-20px); }
    to { opacity: 1; transform: translateX(0); }
}
</style>
@endpush

@push('scripts')
@verbatim
<script>
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('image'); // gunakan nama default, Blade tidak parsing di dalam @verbatim
        if (!input) return;
        
        const previewContainer = input.closest('.image-upload-wrapper').querySelector('.image-preview-container');
        const previewImage = previewContainer.querySelector('.image-preview');
        const fileSizeEl = previewContainer.querySelector('.file-size');
        const fileDimensionsEl = previewContainer.querySelector('.file-dimensions');
        const fileFormatEl = previewContainer.querySelector('.file-format');
        const sizeWarning = document.getElementById('size-warning-image');
        
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            
            if (!file) {
                previewContainer.style.display = 'none';
                return;
            }
            
            const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
            if (!validTypes.includes(file.type)) {
                alert('Format file tidak didukung. Gunakan JPG, PNG, atau WebP');
                input.value = '';
                return;
            }
            
            const maxSizeBytes = 10 * 1024 * 1024; // default maxSize 10MB
            if (file.size > maxSizeBytes) {
                alert('Ukuran file terlalu besar. Maksimal 10MB');
                input.value = '';
                return;
            }
            
            // @ts-ignore - FileReader is a built-in browser API
            const reader = new FileReader();
            // @ts-ignore - FileReader is a built-in browser API
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
                
                // @ts-ignore - Image is a built-in browser API
                const img = new Image();
                img.onload = function() {
                    fileDimensionsEl.textContent = this.width + ' x ' + this.height + ' px';
                    if (this.width < 200 || this.height < 200) {
                        alert('Dimensi gambar terlalu kecil. Minimal 200x200 pixel');
                        input.value = '';
                        previewContainer.style.display = 'none';
                    }
                };
                img.src = e.target.result;
                
                const sizeKB = (file.size / 1024).toFixed(2);
                const sizeMB = (file.size / 1024 / 1024).toFixed(2);
                fileSizeEl.textContent = sizeKB > 1024 ? sizeMB + ' MB' : sizeKB + ' KB';
                
                if (file.size > 100 * 1024) {
                    sizeWarning.style.display = 'block';
                } else {
                    sizeWarning.style.display = 'none';
                }
                
                fileFormatEl.textContent = file.type.split('/')[1].toUpperCase();
            };
            reader.readAsDataURL(file);
        });
    });
})();
</script>
@endverbatim
@endpush

