<?php

namespace App\Http\Controllers;

use App\Models\ProfilPolres;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        // Ambil profil pertama (biasanya cuma ada 1 data profil di DB)
        $profil = ProfilPolres::firstOrFail();
        return view('public.profil', compact('profil'));
    }

    // Fungsi Edit untuk Admin (Opsional, nanti kalau sempat)
    public function edit()
    {
        $profil = ProfilPolres::firstOrFail();
        return view('admin.profil.edit', compact('profil'));
    }
    
    // Fungsi Update untuk Admin
    public function update(Request $request)
    {
        $profil = ProfilPolres::firstOrFail();
        
        $validated = $request->validate([
            'sambutan_kapolres' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        $profil->update($validated);
        return redirect()->route('profil.index')->with('success', 'Profil diperbarui!');
    }
}
