<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita; 

class BeritaController extends Controller
{
    public function index()
    {
        // Mengambil berita, diurutkan dari yang terbaru, dan dibagi per 10 halaman
        $beritas = \App\Models\Berita::latest('tanggal_publish')->paginate(10);
        
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        // Ambil semua kategori untuk dropdown
        $kategori = \App\Models\KategoriBerita::all(); 
        return view('admin.berita.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Data
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'id_kategori' => 'required',
            'ringkasan' => 'required',
            'konten' => 'required',
            'status' => 'required',
            'gambar_utama' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Maksimal 2MB
        ]);

        // 2. Handle Upload Gambar Utama
        if ($request->hasFile('gambar_utama')) {
            $image = $request->file('gambar_utama');
            // Buat nama file unik: waktu_sekarang_nama_asli_file.jpg
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            // Simpan file ke folder public/berita
            $image->move(public_path('berita'), $imageName);
            
            // Masukkan nama file ke array validated
            $validated['gambar_utama'] = $imageName;
        }

        // 3. Isi Data Tambahan Secara Otomatis
        $validated['id_penulis'] = auth()->id(); // Ambil ID user yang sedang login
        
        // Buat slug dari judul (misal: "Kapolres Resmikan Pos Polisi" -> "kapolres-resmikan-pos-polisi")
        $validated['slug'] = \Illuminate\Support\Str::slug($request->judul);
        
        // Set tanggal publish jika statusnya Published, jika Draft biarkan NULL
        if ($request->status == 'Published') {
            $validated['tanggal_publish'] = now(); // Ambil waktu sekarang
        }

        // 4. Simpan ke Database
        Berita::create($validated);

        // 5. Redirect ke halaman list dengan pesan sukses
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diterbitkan!');
    }

    public function edit($id)
    {
        // Cari berita berdasarkan ID
        $berita = Berita::findOrFail($id);
        
        // Ambil semua kategori untuk dropdown
        $kategori = \App\Models\KategoriBerita::all();
        
        return view('admin.berita.edit', compact('berita', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        // 1. Validasi
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'id_kategori' => 'required',
            'ringkasan' => 'required',
            'konten' => 'required',
            'status' => 'required',
            'gambar_utama' => 'image|mimes:jpg,jpeg,png|max:2048', // Optional saat edit
        ]);

        // 2. Handle Update Gambar
        if ($request->hasFile('gambar_utama')) {
            // Hapus foto lama (Opsional: kalau mau bersih)
            if ($berita->gambar_utama) {
                $oldImage = public_path('berita/' . $berita->gambar_utama);
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }

            // Simpan foto baru
            $image = $request->file('gambar_utama');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('berita'), $imageName);
            $validated['gambar_utama'] = $imageName;
        }

        // 3. Update Data Lain
        $validated['slug'] = \Illuminate\Support\Str::slug($request->judul); // Update slug kalau judul berubah
        
        if ($request->status == 'Published' && is_null($berita->tanggal_publish)) {
            $validated['tanggal_publish'] = now();
        }

        $berita->update($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // 1. Cari data berita
        $berita = Berita::findOrFail($id);

        // 2. Hapus Gambar Fisik dari Folder public/berita
        // Ini agar folder tidak penuh dengan foto sampah
        if ($berita->gambar_utama) {
            $imagePath = public_path('berita/' . $berita->gambar_utama);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Menghapus file
            }
        }

        // 3. Hapus Data dari Database
        $berita->delete();

        // 4. Redirect dengan pesan
        return redirect()->route('admin.berita.index')->with('delete', 'Berita berhasil dihapus dari database.');
    }

    public function show($slug)
    {
        // Cari berita berdasarkan slug. Jika tidak ada, otomatis ke halaman 404
        $berita = Berita::where('slug', $slug)->firstOrFail();

        // Ambil juga berita terbaru lainnya (opsional) untuk samping kanan
        $beritaTerbaru = Berita::latest('tanggal_publish')->take(5)->get();

        // Tambahkan view counter (opsional)
        $berita->increment('views');

        return view('public.berita', compact('berita', 'beritaTerbaru'));
    }

}
