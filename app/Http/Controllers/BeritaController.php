<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    // ========================================
    // ADMIN METHODS
    // ========================================

    /**
     * Admin: List all berita
     */
    public function index(Request $request)
    {
        $query = Berita::with(['kategori', 'penulis']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'ILIKE', "%{$search}%")
                  ->orWhere('konten', 'ILIKE', "%{$search}%");
            });
        }

        // Filter by kategori
        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $beritas = $query->orderBy('created_at', 'desc')->paginate(10);
        $kategoris = KategoriBerita::where('is_active', true)->get();

        return view('admin.berita.index', compact('beritas', 'kategoris'));
    }

    /**
     * Admin: Show create form
     */
    public function create()
    {
        $kategoris = KategoriBerita::where('is_active', true)->get();
        return view('admin.berita.create', compact('kategoris'));
    }

    /**
     * Admin: Store new berita
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori_berita,id_kategori',
            'konten' => 'required|string',
            'ringkasan' => 'nullable|string',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', // 5MB
            'caption_gambar' => 'nullable|string',
            'tanggal_publish' => 'required|date',
            'status' => 'required|in:Published,Draft',
        ]);

        $data = [
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'id_kategori' => $request->id_kategori,
            'id_penulis' => Auth::id(),
            'konten' => $request->konten,
            'ringkasan' => $request->ringkasan,
            'caption_gambar' => $request->caption_gambar,
            'tanggal_publish' => $request->tanggal_publish,
            'status' => $request->status,
            'is_active' => true,
            'views' => 0,
        ];

        // Duplicate berita
        $slug = Str::slug($request->judul);

        if (Berita::where('slug',$slug)->exists()) {
            $slug .= '-' . time();
        }

        // Upload gambar
        if ($request->hasFile('gambar_utama')) {
            $filename = uniqid().'_'.time().'.'.$request->file('gambar_utama')->extension();

            $path = $request->file('gambar_utama')->storeAs(
                'berita',
                $filename,
                'public'
            );
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dibuat!');
    }

    /**
     * Admin: Show edit form
     */
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        $kategoris = KategoriBerita::where('is_active', true)->get();
        return view('admin.berita.edit', compact('berita', 'kategoris'));
    }

    /**
     * Admin: Update berita
     */
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori_berita,id_kategori',
            'konten' => 'required|string',
            'ringkasan' => 'nullable|string',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'delete_gambar' => 'nullable',
            'caption_gambar' => 'nullable|string',
            'tanggal_publish' => 'required|date',
            'status' => 'required|in:Published,Draft',
        ]);

        $data = [
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'id_kategori' => $request->id_kategori,
            'konten' => $request->konten,
            'ringkasan' => $request->ringkasan,
            'caption_gambar' => $request->caption_gambar,
            'tanggal_publish' => $request->tanggal_publish,
            'status' => $request->status,
        ];

        // Handle delete checkbox
        if ($request->has('delete_gambar') && $request->delete_gambar == '1') {
            if ($berita->gambar_utama && !str_starts_with($berita->gambar_utama, 'http')) {
                Storage::disk('public')->delete($berita->gambar_utama);
            }
            $data['gambar_utama'] = null;
        }

        // Upload gambar baru
        if ($request->hasFile('gambar_utama')) {
            // Delete old image if exists and not URL
            if ($berita->gambar_utama && !str_starts_with($berita->gambar_utama, 'http')) {
                Storage::disk('public')->delete($berita->gambar_utama);
            }

            $path = $request->file('gambar_utama')->store('berita', 'public');
            $data['gambar_utama'] = $path;
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diupdate!');
    }

    /**
     * Admin: Delete berita
     */
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        // Delete image from storage if exists and not URL
        if ($berita->gambar_utama && !str_starts_with($berita->gambar_utama, 'http')) {
            Storage::disk('public')->delete($berita->gambar_utama);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus!');
    }

    // ========================================
    // PUBLIC METHODS
    // ========================================

    /**
     * Public: List berita
     */
    public function publicList(Request $request)
    {
        $query = Berita::with(['kategori', 'penulis'])
            ->where('status', 'Published')
            ->where('tanggal_publish', '<=', now())
            ->where('is_active', true);

        // Filter by kategori
        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'ILIKE', "%{$search}%")
                  ->orWhere('konten', 'ILIKE', "%{$search}%");
            });
        }

        $beritas = $query->orderBy('tanggal_publish', 'desc')->paginate(12);
        $kategoris = KategoriBerita::where('is_active', true)->get();

        return view('public.berita-list', compact('beritas', 'kategoris'));
    }

    /**
     * Public: Show single berita
     */
    public function show($slug)
    {
        $berita = Berita::with(['kategori', 'penulis'])
            ->where('slug', $slug)
            ->where('status', 'Published')
            ->where('is_active', true)
            ->firstOrFail();

        // Increment views
        $berita->increment('views');

        // Get related berita (same kategori)
        $relatedBerita = Berita::where('id_kategori', $berita->id_kategori)
            ->where('id_berita', '!=', $berita->id_berita)
            ->where('status', 'Published')
            ->where('is_active', true)
            ->orderBy('tanggal_publish', 'desc')
            ->take(3)
            ->get();

        return view('public.berita-detail', compact('berita', 'relatedBerita'));
    }

    /**
     * Get image URL (for both local and external)
     */
    public function getImageUrl($imagePath)
    {
        if (!$imagePath) {
            return null;
        }

        // If already full URL
        if (str_starts_with($imagePath, 'http')) {
            return $imagePath;
        }

        // Local storage
        return asset('storage/' . $imagePath);
    }
}
