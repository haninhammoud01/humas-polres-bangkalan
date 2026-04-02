@extends('layouts.admin')

@section('title', 'Menu Navigasi')

@section('content')
<div class="container-fluid px-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Menu Navigasi</h2>
            <p class="text-muted mb-0">Kelola menu dropdown di homepage</p>
        </div>
        <a href="{{ route('admin.menu.create') }}" class="btn btn-dark">
            <i class="fas fa-plus me-2"></i>Tambah Menu
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3" width="5%">
                                <i class="fas fa-grip-vertical text-muted"></i>
                            </th>
                            <th class="py-3" width="5%">No</th>
                            <th class="py-3" width="25%">Nama Menu</th>
                            <th class="py-3" width="30%">URL</th>
                            <th class="py-3" width="10%">Icon</th>
                            <th class="py-3 text-center" width="10%">Status</th>
                            <th class="py-3 text-center" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="sortable-menu">
                        @forelse($menus as $index => $menu)
                        <tr data-id="{{ $menu->id_menu }}" style="cursor: move;">
                            <td class="px-4 drag-handle">
                                <i class="fas fa-grip-vertical text-muted"></i>
                            </td>
                            <td>{{ $menu->urutan }}</td>
                            <td>
                                <strong>{{ $menu->nama_menu }}</strong>
                            </td>
                            <td>
                                <code>{{ $menu->url }}</code>
                            </td>
                            <td>
                                @if($menu->icon)
                                    <i class="fas {{ $menu->icon }} fa-lg"></i>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($menu->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <form action="{{ route('admin.menu.toggle', $menu->id_menu) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-{{ $menu->is_active ? 'warning' : 'success' }}"
                                                title="{{ $menu->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                            <i class="fas fa-{{ $menu->is_active ? 'eye-slash' : 'eye' }}"></i>
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.menu.edit', $menu->id_menu) }}" 
                                       class="btn btn-sm btn-outline-primary"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.menu.destroy', $menu->id_menu) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin hapus menu {{ $menu->nama_menu }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger"
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="fas fa-list fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">Belum ada menu</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
.drag-handle {
    cursor: move;
}

.sortable-ghost {
    opacity: 0.4;
    background: #f8f9fa;
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
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sortable = document.getElementById('sortable-menu');
    
    if (sortable) {
        new Sortable(sortable, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            onEnd: function(evt) {
                const order = [];
                document.querySelectorAll('#sortable-menu tr[data-id]').forEach((row, index) => {
                    order.push(row.dataset.id);
                    row.querySelector('td:nth-child(2)').textContent = index + 1;
                });

                // Save order via AJAX
                fetch('{{ route("admin.menu.reorder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ order: order })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message (optional)
                        console.log('Order updated');
                    }
                });
            }
        });
    }
});
</script>
@endpush
