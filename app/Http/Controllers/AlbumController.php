<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class AlbumController extends Controller
{
    // ========================================
    // ADMIN METHODS
    // ========================================

    /**
     * Admin: List all albums
     */
    public function index()
    {
        $albums = Album::with('pembuat')
            ->withCount('photos')
            ->orderByRaw('COALESCE(tanggal_dibuat, created_at) DESC NULLS LAST')
            ->paginate(10);

        return view('admin.album.index', compact('albums'));
    }

    /**
     * Admin: Show create form
     */
    public function create()
    {
        return view('admin.album.create');
    }

    /**
     * Admin: Store new album with photos
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_album' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_dibuat' => 'required|date',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', // 5MB
            'keterangan.*' => 'nullable|string',
        ]);

        // Create album
        $album = Album::create([
            'nama_album' => $request->nama_album,
            'deskripsi' => $request->deskripsi,
            'tanggal_dibuat' => $request->tanggal_dibuat,
            'id_pembuat' => Auth::id(),
            'is_active' => true,
        ]);

        // Upload photos
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photo) {
                $path = $photo->store('galeri', 'public');
                
                Foto::create([
                    'id_album' => $album->id_album,
                    'file_path' => $path,
                    'keterangan' => $request->keterangan[$index] ?? null,
                    'urutan' => $index + 1,
                    'is_active' => true,
                ]);
            }

            // Set first photo as cover
            $firstPhoto = Foto::where('id_album', $album->id_album)->first();
            if ($firstPhoto) {
                $album->update(['cover_photo' => $firstPhoto->file_path]);
            }
        }

        return redirect()->route('admin.album.index')
            ->with('success', 'Album berhasil dibuat!');
    }

    /**
     * Admin: Show edit form
     */
    public function edit($id)
    {
        $album = Album::with('photos')->findOrFail($id);
        return view('admin.album.edit', compact('album'));
    }

    /**
     * Admin: Update album
     */
    public function update(Request $request, $id)
    {
        $album = Album::findOrFail($id);

        $request->validate([
            'nama_album' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_dibuat' => 'required|date',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'keterangan.*' => 'nullable|string',
        ]);

        $album->update([
            'nama_album' => $request->nama_album,
            'deskripsi' => $request->deskripsi,
            'tanggal_dibuat' => $request->tanggal_dibuat,
        ]);

        // Upload new photos
        if ($request->hasFile('photos')) {
            $existingCount = Foto::where('id_album', $album->id_album)->count();
            
            foreach ($request->file('photos') as $index => $photo) {
                $path = $photo->store('galeri', 'public');
                
                Foto::create([
                    'id_album' => $album->id_album,
                    'file_path' => $path,
                    'keterangan' => $request->keterangan[$index] ?? null,
                    'urutan' => $existingCount + $index + 1,
                    'is_active' => true,
                ]);
            }
        }

        return redirect()->route('admin.album.index')
            ->with('success', 'Album berhasil diupdate!');
    }

    /**
     * Admin: Delete album
     */
    public function destroy($id)
    {
        $album = Album::findOrFail($id);

        // Delete all photos from storage
        $photos = Foto::where('id_album', $album->id_album)->get();
        foreach ($photos as $photo) {
            if ($photo->file_path && !str_starts_with($photo->file_path, 'http')) {
                Storage::disk('public')->delete($photo->file_path);
            }
        }

        // Delete photos from database
        Foto::where('id_album', $album->id_album)->delete();

        // Delete album
        $album->delete();

        return redirect()->route('admin.album.index')
            ->with('success', 'Album berhasil dihapus!');
    }

    /**
     * Admin: Delete single photo
     */
    public function deletePhoto($albumId, $photoId)
    {
        $photo = Foto::where('id_foto', $photoId)
            ->where('id_album', $albumId)
            ->firstOrFail();

        // Delete from storage
        if ($photo->file_path && !str_starts_with($photo->file_path, 'http')) {
            Storage::disk('public')->delete($photo->file_path);
        }

        $photo->delete();

        return back()->with('success', 'Foto berhasil dihapus!');
    }

    // ========================================
    // PUBLIC METHODS
    // ========================================

    /**
     * Public: List albums (galeri)
     */
    public function indexPublic()
    {
        $albums = Album::active()
            ->withPhotoCount()
            ->with(['activePhotos' => function($query) {
                $query->take(1); // Get first photo for cover
            }])
            ->orderByRaw('COALESCE(tanggal_dibuat, created_at) DESC NULLS LAST')
            ->paginate(12);

        // Add cover_photo URL to each album
        foreach ($albums as $album) {
            $album->cover_photo_url = $album->cover_photo_url;
        }

        return view('public.galeri-list', compact('albums'));
    }

    /**
     * Public: Show album detail
     */
    public function showPublic($id)
    {
        $album = Album::active()
            ->with(['activePhotos' => function($query) {
                $query->ordered();
            }])
            ->findOrFail($id);

        $photos = $album->activePhotos;

        return view('public.galeri-detail', compact('album', 'photos'));
    }

    /**
     * Public: Download album as ZIP
     */
    public function download($id)
    {
        $album = Album::active()->findOrFail($id);
        $photos = Foto::where('id_album', $album->id_album)
            ->where('is_active', true)
            ->get();

        if ($photos->isEmpty()) {
            return back()->with('error', 'Album tidak memiliki foto');
        }

        // Create ZIP
        $zipFileName = 'album_' . $album->id_album . '_' . time() . '.zip';
        $zipPath = storage_path('app/public/temp/' . $zipFileName);

        // Create temp directory if not exists
        if (!file_exists(storage_path('app/public/temp'))) {
            mkdir(storage_path('app/public/temp'), 0755, true);
        }

        $zip = new ZipArchive;
        if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
            foreach ($photos as $index => $photo) {
                if ($photo->file_path && !str_starts_with($photo->file_path, 'http')) {
                    $filePath = storage_path('app/public/' . $photo->file_path);
                    if (file_exists($filePath)) {
                        $zip->addFile($filePath, ($index + 1) . '_' . basename($photo->file_path));
                    }
                }
            }
            $zip->close();
        }

        // Download and delete temp file
        return response()->download($zipPath)->deleteFileAfterSend(true);
    }
}
