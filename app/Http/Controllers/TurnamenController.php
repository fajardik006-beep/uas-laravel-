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
    // 1. Validasi semua field yang ada di form
    $request->validate([
        'nama_turnamen' => 'required|string',
        'game_name'     => 'required|string',
        'hadiah'        => 'required',
        'tanggal_pelaksanaan' => 'required|date',
        'deskripsi'     => 'required|string',
        // 'link_daftar' bersifat opsional jadi tidak wajib
    ]);

    // 2. Simpan semua data yang dikirim dari form
    Turnamen::create([
        'user_id'             => auth()->id(),
        'nama_turnamen'       => $request->nama_turnamen,
        'game_name'           => $request->game_name,
        'hadiah'              => $request->hadiah,
        'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
        'deskripsi'           => $request->deskripsi,
        'link_daftar'         => $request->link_daftar,
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