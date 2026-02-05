<?php

namespace App\Http\Controllers;

use App\Models\AlbumFoto;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        // Tambahkan ->with('fotos') untuk memuat relasinya
        // Sehingga $alb->fotos tidak null saat di-count()
        $albums = AlbumFoto::with('fotos')->latest()->get();
        return view('admin.album.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.album.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_album' => 'required|max:200',
            'deskripsi' => 'required',
        ]);

        $validated['id_pembuat'] = auth()->id();
        AlbumFoto::create($validated);

        return redirect()->route('admin.album.index')->with('success', 'Album berhasil dibuat!');
    }

    public function show($id)
    {
        // Pastikan relasi foto juga dimuat
        $album = AlbumFoto::with('fotos')->findOrFail($id);
        return view('admin.galeri-foto.index', compact('album', 'fotos')); // Catatan: Di sini aku ubah sedikit nama variabel jadi $fotos agar tidak bingung
    }

    public function edit($id)
    {
        $album = AlbumFoto::findOrFail($id);
        return view('admin.album.edit', compact('album'));
    }

    public function update(Request $request, $id)
    {
        $album = AlbumFoto::findOrFail($id);
        $album->update($request->validate([
            'nama_album' => 'required|max:200',
            'deskripsi' => 'required',
        ]));

        return redirect()->route('admin.album.index')->with('success', 'Album berhasil diperbarui!');
    }
}
