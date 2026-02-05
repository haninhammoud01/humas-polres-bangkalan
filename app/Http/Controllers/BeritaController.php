<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest('tanggal_publish')->paginate(10);
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        $kategori = \App\Models\KategoriBerita::all();
        return view('admin.berita.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'id_kategori' => 'required',
            'ringkasan' => 'required',
            'konten' => 'required',
            'status' => 'required',
            'gambar_utama' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar_utama')) {
            $image = $request->file('gambar_utama');
            $imageName = time() . '_' . $image->getClientOriginalName();
            // DISINI YANG DIUBAH: 'berita' JADI 'foto_berita'
            $image->move(public_path('foto_berita'), $imageName);
            $validated['gambar_utama'] = $imageName;
        }

        $validated['id_penulis'] = auth()->id();
        $validated['slug'] = \Illuminate\Support\Str::slug($request->judul);

        if ($request->status == 'Published') {
            $validated['tanggal_publish'] = now();
        }

        Berita::create($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diterbitkan!');
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        $beritaTerbaru = Berita::latest('tanggal_publish')->take(5)->get();
        $berita->increment('views');

        return view('public.berita', compact('berita', 'beritaTerbaru'));
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        $kategori = \App\Models\KategoriBerita::all();
        return view('admin.berita.edit', compact('berita', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|max:255',
            'id_kategori' => 'required',
            'ringkasan' => 'required',
            'konten' => 'required',
            'status' => 'required',
            'gambar_utama' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar_utama')) {
            if ($berita->gambar_utama) {
                $oldImage = public_path('foto_berita/' . $berita->gambar_utama); // DIUBAH JUGA DISINI
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }

            $image = $request->file('gambar_utama');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('foto_berita'), $imageName); // DAN DISINI
            $validated['gambar_utama'] = $imageName;
        }

        $validated['slug'] = \Illuminate\Support\Str::slug($request->judul);

        if ($request->status == 'Published' && is_null($berita->tanggal_publish)) {
            $validated['tanggal_publish'] = now();
        }

        $berita->update($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->gambar_utama) {
            $imagePath = public_path('foto_berita/' . $berita->gambar_utama); // DAN DISINI
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')->with('delete', 'Berita berhasil dihapus.');
    }
    
    public function publicList()
    {
        $beritas = Berita::published()->latest('tanggal_publish')->paginate(9);
        return view('public.berita-list', compact('beritas'));
    }
}
