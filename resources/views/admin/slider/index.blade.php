@extends('layouts.app')
@section('title', 'Kelola Slider')
@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between mb-4">
        <h3>Hero Slider</h3>
        <a href="{{ route('admin.slider.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Slider
        </a>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr><th>Gambar</th><th>Judul</th><th>Urutan</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @foreach($sliders as $s)
                <tr>
                    <td><img src="{{ asset('sliders/' . $s->gambar) }}" width="150" height="80" class="object-fit-cover rounded"></td>
                    <td>{{ $s->judul }}</td>
                    <td>{{ $s->urutan }}</td>
                    <td><span class="badge bg-{{ $s->status == 'Aktif' ? 'success' : 'secondary' }}">{{ $s->status }}</span></td>
                    <td>
                        <a href="{{ route('admin.slider.edit', $s->id_slider) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.slider.destroy', $s->id_slider) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
