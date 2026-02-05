<?php

namespace App\Http\Controllers;

use App\Models\GaleriFoto;
use App\Models\AlbumFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriFotoController extends Controller
{
    // --- ADMIN AREA ---

    public function index()
    {
        // Menampilkan semua foto gabungan (opsional)
        $fotos = GaleriFoto::latest()->paginate(20);
        return view('admin.galeri-foto.all', compact('fotos'));
    }

    public function create()
    {
        // Ambil album untuk dropdown
        $albums = AlbumFoto::all();
        return view('admin.galeri-foto.create', compact('albums'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_album' => 'required',
            'path_foto' => 'required|array', // Validasi array (banyak file)
            'path_foto.*' => 'image|mimes:jpg,jpeg,png|max:2048', // Validasi setiap file
            'deskripsi' => 'nullable',
        ]);

        // Loop setiap file yang diupload
        if ($request->hasFile('path_foto')) {
            $images = $request->file('path_foto');

            foreach ($images as $image) {
                // Nama file unik: waktu_timestamp_namafile
                $imageName = time() . '_' . $image->getClientOriginalName();
                
                // Simpan ke folder public/galeri
                $image->move(public_path('galeri'), $imageName);

                // Simpan ke database
                GaleriFoto::create([
                    'id_album' => $validated['id_album'],
                    'id_uploader' => auth()->id(),
                    'path_foto' => $imageName,
                    'deskripsi' => $validated['deskripsi'], // Deskripsi umum sama untuk semua foto ini
                    'ukuran_file' => $image->getSize(),
                    'tanggal_upload' => now(),
                ]);
            }
        }

        return back()->with('success', count($images) . ' foto berhasil diupload ke album!');
    }

    public function show($id)
    {
        $foto = GaleriFoto::findOrFail($id);
        return view('admin.galeri-foto.show', compact('foto'));
    }

    public function destroy($id)
    {
        $foto = GaleriFoto::findOrFail($id);
        
        // Hapus file fisik
        if ($foto->path_foto) {
            unlink(public_path('galeri/' . $foto->path_foto));
        }

        $foto->delete();
        return back()->with('delete', 'Foto berhasil dihapus.');
    }

    // --- ROUTE PUBLIK ---

    // Menampilkan Daftar Album (Halaman Depan /galeri)
    public function indexPublic()
    {
        // Ambil album beserta jumlah fotonya
        $albums = AlbumFoto::withCount('fotos')->latest()->get();
        return view('public.galeri-list', compact('albums'));
    }

    // Menampilkan Detail Album + Isi Fotonya (Halaman Depan /galeri/{id})
    public function showPublic($id)
    {
        // Cari album, dan load relasi 'fotos'
        $album = AlbumFoto::with('fotos')->findOrFail($id);
        return view('public.galeri-detail', compact('album'));
    }
}
