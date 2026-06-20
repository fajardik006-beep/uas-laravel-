<?php

namespace App\Http\Controllers;

use App\Models\TokoPoint; // Pastikan nama Model Toko-mu sesuai
use Illuminate\Http\Request;

class TokoPointController extends Controller
{
    // 1. MENAMPILKAN DAFTAR BARANG DI TOKO (Semua Player Bisa Melihat)
    public function index()
    {
        $items = TokoPoint::latest()->get();
        
        // UBAH BAGIAN INI: Sesuaikan dengan nama file toko.blade.php kamu
        return view('toko', compact('items')); 
    }

    // 2. MENAMPILKAN FORM TAMBAH BARANG (HANYA ADMIN)
    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Akses Ditolak! Hanya Admin yang boleh menambah barang ke toko.');
        }
        return view('tokopoint.create');
    }

    // 3. MENYIMPAN BARANG BARU KE DATABASE (HANYA ADMIN)
    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Akses Ditolak!');
        }

        $request->validate([
            'nama_item' => 'required|string|max:255',
            'harga_poin' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string',
            'gambar_url' => 'nullable|string'
        ]);

        TokoPoint::create($request->all());

        return redirect()->route('tokopoint.index')->with('success', 'Barang baru berhasil ditambahkan ke Toko!');
    }

   // HANYA ADMIN YANG BISA EDIT BARANG TOKO
    public function edit($id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Akses Ditolak! Hanya Admin yang boleh mengedit barang toko.');
        }

        $item = \App\Models\TokoPoint::findOrFail($id);
        return view('tokopoint_edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Akses Ditolak!');
        }

        $item = \App\Models\TokoPoint::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('toko.point')->with('success', 'Barang toko berhasil diperbarui!');
    }

    // ADMIN BISA HAPUS, ATAU USER PEMBUATNYA BISA HAPUS
    public function destroy($id)
    {
        $item = \App\Models\TokoPoint::findOrFail($id);

        if (auth()->user()->isAdmin() || auth()->id() === $item->user_id) {
            $item->delete();
            return redirect()->back()->with('success', 'Barang berhasil dihapus dari Toko!');
        }

        abort(403, 'Akses Ditolak! Kamu bukan Admin atau pemilik barang ini.');
    }
}