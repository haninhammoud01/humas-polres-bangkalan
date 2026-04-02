<?php

namespace App\Http\Controllers;

use App\Models\ProfilPolres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilPolresController extends Controller
{
    /**
     * Public: Display profil
     */
    public function index()
    {
        $profil = ProfilPolres::getInstance();
        return view('public.profil', compact('profil'));
    }

    /**
     * Admin: Show edit form
     */
    public function edit()
    {
        $profil = ProfilPolres::getInstance();
        return view('admin.profil.edit', compact('profil'));
    }

    /**
     * Admin: Update profil (LOGO ONLY + Basic Info)
     */
    public function update(Request $request)
    {
        $profil = ProfilPolres::getInstance();

        $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'website' => 'nullable|url|max:255',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'motto' => 'nullable|string',
            'wilayah_hukum' => 'nullable|string',
            'luas_wilayah' => 'nullable|string|max:100',
            'jumlah_kecamatan' => 'nullable|integer',
            'jumlah_desa' => 'nullable|integer',
            
            // Logo only
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'delete_logo' => 'nullable',
            
            // Kapolres info
            'nama_kapolres' => 'nullable|string|max:255',
            'pangkat_kapolres' => 'nullable|string|max:100',
            'nrp_kapolres' => 'nullable|string|max:50',
            'sambutan_kapolres' => 'nullable|string',
        ]);

        // Get data without logo and delete_logo
        $data = $request->except(['logo', 'delete_logo', '_token', '_method']);

        // Handle Logo
        if ($request->has('delete_logo') && $request->delete_logo == '1') {
            // Delete existing logo
            if ($profil->logo && !str_starts_with($profil->logo, 'http')) {
                Storage::disk('public')->delete($profil->logo);
            }
            $data['logo'] = null;
        }
        
        // Upload new logo (akan replace otomatis jika ada logo lama)
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($profil->logo && !str_starts_with($profil->logo, 'http')) {
                Storage::disk('public')->delete($profil->logo);
            }
            
            // Upload new
            $path = $request->file('logo')->store('profil/logo', 'public');
            $data['logo'] = $path;
        }

        // Update
        $profil->update($data);

        return redirect()->route('admin.profil.edit')
            ->with('success', 'Profil berhasil diupdate!');
    }

    /**
     * Admin: Show struktur organisasi edit form
     */
    public function editStruktur()
    {
        $profil = ProfilPolres::getInstance();
        return view('admin.profil.struktur-organisasi', compact('profil'));
    }

    /**
     * Admin: Update struktur organisasi
     */
    public function updateStruktur(Request $request)
    {
        $profil = ProfilPolres::getInstance();

        $request->validate([
            'struktur_organisasi_text' => 'nullable|string',
            'struktur_organisasi_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'delete_struktur_image' => 'nullable',
        ]);

        $data = [];

        // Update text
        if ($request->filled('struktur_organisasi_text')) {
            $data['struktur_organisasi_text'] = $request->struktur_organisasi_text;
        }

        // Handle Struktur Image
        if ($request->has('delete_struktur_image') && $request->delete_struktur_image == '1') {
            if ($profil->struktur_organisasi_image && !str_starts_with($profil->struktur_organisasi_image, 'http')) {
                Storage::disk('public')->delete($profil->struktur_organisasi_image);
            }
            $data['struktur_organisasi_image'] = null;
        } elseif ($request->hasFile('struktur_organisasi_image')) {
            if ($profil->struktur_organisasi_image && !str_starts_with($profil->struktur_organisasi_image, 'http')) {
                Storage::disk('public')->delete($profil->struktur_organisasi_image);
            }
            $path = $request->file('struktur_organisasi_image')->store('profil/struktur', 'public');
            $data['struktur_organisasi_image'] = $path;
        }

        if (!empty($data)) {
            $profil->update($data);
        }

        return redirect()->route('admin.profil.struktur')
            ->with('success', 'Struktur organisasi berhasil diupdate!');
    }
}
