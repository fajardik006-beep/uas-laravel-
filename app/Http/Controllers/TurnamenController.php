<?php

namespace App\Http\Controllers;

use App\Models\Turnamen;
use Illuminate\Http\Request;

class TurnamenController extends Controller
{
    // 1. MENAMPILKAN SEMUA DATA
    public function index()
    {
        $turnamens = Turnamen::latest()->get(); 
        return view('turnamen', compact('turnamens'));
    }

    // 2. MENYIMPAN DATA BARU
    public function store(Request $request)
    {
        // Pastikan nama validasinya sesuai dengan kolom di databasemu
        $request->validate([
            'nama_turnamen' => 'required|string',
            // tambahkan validasi lain jika ada...
        ]);

        Turnamen::create([
            'user_id' => auth()->id(), // Mencatat siapa yang membuat
            'nama_turnamen' => $request->nama_turnamen,
            // tambahkan kolom lain jika ada...
        ]);

        return redirect()->back()->with('success', 'Turnamen berhasil dibuat!');
    }

    // 3. HALAMAN EDIT (HANYA ADMIN)
    public function edit($id)
    {
        // Kunci Pintu: Cek apakah yang akses ini Admin
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Akses Ditolak! Hanya Admin yang boleh mengedit data.');
        }

        $turnamen = Turnamen::findOrFail($id);
        return view('turnamen_edit', compact('turnamen'));
    }

    // 4. MENYIMPAN PERUBAHAN EDIT (HANYA ADMIN)
    public function update(Request $request, $id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Akses Ditolak!');
        }

        $turnamen = Turnamen::findOrFail($id);
        $turnamen->update($request->all());

        return redirect()->route('turnamen')->with('success', 'Turnamen berhasil diperbarui!');
    }

    // 5. MENGHAPUS DATA (ADMIN ATAU SI PEMBUAT)
    public function destroy($id)
    {
        $turnamen = Turnamen::findOrFail($id);

        // Kunci Pintu: Hanya Admin ATAU User yang ID-nya sama dengan pembuat turnamen ini
        if (auth()->user()->isAdmin() || auth()->id() === $turnamen->user_id) {
            $turnamen->delete();
            return redirect()->route('turnamen')->with('success', 'Turnamen berhasil dihapus!');
        }

        abort(403, 'Akses Ditolak! Kamu bukan Admin atau pembuat turnamen ini.');
    }
}