<?php

namespace App\Http\Controllers;

use App\Models\Komunitas;
use Illuminate\Http\Request;

class KomunitasController extends Controller
{
    // 1. MENAMPILKAN SEMUA DATA SQUAD (HALAMAN UTAMA)
    public function index()
    {
        // Mengambil semua data komunitas beserta relasi user pembuatnya
        $komunitas = Komunitas::with('user')->latest()->get(); 
        return view('komunitas', compact('komunitas'));
    }

    // 2. MENYIMPAN SQUAD BARU
    public function store(Request $request)
    {
        $request->validate([
            'nama_squad' => 'required|string',
            'game_name'  => 'required|string',
            'link_grup'  => 'required|url', // Wajib berupa link http/https
            'deskripsi'  => 'required|string',
        ]);

        Komunitas::create([
            'user_id'    => auth()->id(), // Mencatat siapa user yang membuat
            'nama_squad' => $request->nama_squad,
            'game_name'  => $request->game_name,
            'link_grup'  => $request->link_grup,
            'deskripsi'  => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Squad baru berhasil dibentuk!');
    }

    // 3. HALAMAN EDIT (HANYA ADMIN)
    public function edit($id)
    {
        // Proteksi: Hanya Admin yang boleh masuk
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Akses Ditolak! Hanya Admin yang boleh mengedit komunitas.');
        }

        $komunitas = Komunitas::findOrFail($id);
        return view('komunitas_edit', compact('komunitas'));
    }

    // 4. MENYIMPAN PERUBAHAN EDIT (HANYA ADMIN)
    public function update(Request $request, $id)
    {
        // Proteksi
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Akses Ditolak!');
        }

        // Validasi disesuaikan dengan form
        $request->validate([
            'nama_squad' => 'required|string',
            'game_name'  => 'required|string',
            'link_grup'  => 'required|url',
            'deskripsi'  => 'required|string',
        ], [
            // Pesan error custom jika format link salah
            'link_grup.url' => 'Link grup harus berupa URL yang valid (menggunakan http:// atau https://)',
        ]);

        $komunitas = Komunitas::findOrFail($id);
        
        $komunitas->update([
            'nama_squad' => $request->nama_squad,
            'game_name'  => $request->game_name,
            'link_grup'  => $request->link_grup,
            'deskripsi'  => $request->deskripsi,
        ]);

        return redirect()->route('komunitas')->with('success', 'Data Squad berhasil diperbarui!');
    }

    // 5. MENGHAPUS DATA (ADMIN ATAU SI PEMBUAT)
    public function destroy($id)
    {
        $komunitas = Komunitas::findOrFail($id);

        // Cek apakah dia Admin ATAU dia adalah orang yang membuat komunitas ini
        if (auth()->user()->isAdmin() || auth()->id() === $komunitas->user_id) {
            $komunitas->delete();
            return redirect()->back()->with('success', 'Squad berhasil dibubarkan/dihapus!');
        }

        abort(403, 'Akses Ditolak! Kamu bukan Admin atau pembuat squad ini.');
    }
}