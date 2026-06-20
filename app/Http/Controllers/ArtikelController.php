<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        // Menampilkan artikel dari yang paling baru
        $artikels = Artikel::with('user')->latest()->get();
        return view('artikel', compact('artikels'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
        abort(403, 'Akses ditolak! Hanya Admin yang boleh membuat Turnamen.');
    }
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'konten' => 'required|string',
            'gambar_url' => 'nullable|url'
        ]);

        Artikel::create([
            'user_id' => auth()->id(),
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'konten' => $request->konten,
            'gambar_url' => $request->gambar_url,
        ]);

        return redirect()->back()->with('success', 'Artikel berhasil diterbitkan!');
    }
   // HANYA ADMIN YANG BISA EDIT
    public function edit($id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Akses Ditolak! Hanya Admin yang boleh mengedit artikel.');
        }

        $artikel = \App\Models\Artikel::findOrFail($id);
        return view('artikel_edit', compact('artikel'));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Akses Ditolak!');
        }

        $artikel = \App\Models\Artikel::findOrFail($id);
        $artikel->update($request->all());

        return redirect()->route('artikel')->with('success', 'Artikel berhasil diperbarui!');
    }

    // ADMIN BISA HAPUS, ATAU USER PEMBUATNYA BISA HAPUS
    public function destroy($id)
    {
        $artikel = \App\Models\Artikel::findOrFail($id);

        if (auth()->user()->isAdmin() || auth()->id() === $artikel->user_id) {
            $artikel->delete();
            return redirect()->back()->with('success', 'Artikel berhasil dihapus!');
        }

        abort(403, 'Akses Ditolak! Kamu bukan Admin atau pembuat artikel ini.');
    }
}