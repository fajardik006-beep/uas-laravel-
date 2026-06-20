<?php

namespace App\Http\Controllers;

use App\Models\MabarPost;
use Illuminate\Http\Request;

class MabarPostController extends Controller
{

   // 1. Menampilkan Halaman Utama (Dengan Fitur Search & Filter)
    public function index(Request $request)
    {
        // Siapkan query dasar
        $query = MabarPost::with('user')->latest();

        // Cek apakah ada request pencarian
        if ($request->has('search') && $request->search != '') {
            $keyword = $request->search;
            $query->where('title', 'like', '%' . $keyword . '%')
                  ->orWhere('game_name', 'like', '%' . $keyword . '%');
        }

        // UBAH: Pakai paginate(5) agar data terbagi jadi beberapa slide (5 postingan per halaman)
        $posts = $query->paginate(5);

        // TAMBAHAN: Tarik data Turnamen dan Artikel agar sinkron dengan database
        $turnamens = \App\Models\Turnamen::latest()->take(2)->get(); // Ambil 2 turnamen terbaru
        $artikels = \App\Models\Artikel::with('user')->latest()->take(3)->get(); // Ambil 3 artikel terbaru

        // Kirim semua datanya ke halaman dashboard
        return view('dashboard', compact('posts', 'turnamens', 'artikels'));
    }

    // 2. Menampilkan Halaman Form
    public function create()
    {
        return view('create');
    }

    // 3. Menyimpan Data dari Form ke Database
    public function store(Request $request)
    {
        $request->validate([
            'game_name' => 'required',
            'rank' => 'required|string|max:50',
            'role_needed' => 'required|string|max:100',
            'players_needed' => 'required|integer|min:1|max:4',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'contact_link' => 'nullable|string|max:255', 
        ]);

        MabarPost::create([
            'user_id' => auth()->id(), 
            'game_name' => $request->game_name,
            'rank' => $request->rank,
            'players_needed' => $request->players_needed,
            'role_needed' => $request->role_needed,
            'title' => $request->title,
            'description' => $request->description,
            'contact_link' => $request->contact_link, 
            'is_active' => true,
        ]);

        return redirect()->route('dashboard')->with('success', 'Postingan mabar berhasil dibuat!');
    }

    // --- FUNGSI MENGAMBIL DATA UNTUK DIEDIT ---
    public function edit($id)
    {
        $post = MabarPost::findOrFail($id);

        // PROTEKSI GANDA: Cek apakah yang mau ngedit adalah pemilik asli ATAU Admin
        if ($post->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak berhak mengedit postingan ini.');
        }

        return view('edit', compact('post'));
    }

    // --- FUNGSI MENYIMPAN HASIL EDITAN ---
    public function update(Request $request, $id)
    {
        $post = MabarPost::findOrFail($id);

        // PROTEKSI GANDA SAAT MENYIMPAN
        if ($post->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak berhak mengubah postingan ini.');
        }

        $request->validate([
            'game_name' => 'required',
            'rank' => 'required|string|max:50',
            'role_needed' => 'required|string|max:100',
            'players_needed' => 'required|integer|min:1|max:4',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'contact_link' => 'nullable|string|max:255',
        ]);

        $post->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Postingan mabar berhasil diperbarui!');
    }

    // --- FUNGSI MENGHAPUS DATA ---
    public function destroy($id)
    {
        $post = MabarPost::findOrFail($id);

        // PROTEKSI GANDA SAAT MENGHAPUS
        if ($post->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak berhak menghapus postingan ini.');
        }

        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Postingan berhasil dihapus!');
    }

    // 7. Halaman Advanced Search (Cari Mabar)
    public function search(Request $request)
    {
        // Mulai query dasar
        $query = MabarPost::with('user')->latest();

        // Filter berdasarkan Game
        if ($request->filled('game_name')) {
            $query->where('game_name', $request->game_name);
        }

        // Filter berdasarkan Role yang dibutuhkan
        if ($request->filled('role_needed')) {
            $query->where('role_needed', 'like', '%' . $request->role_needed . '%');
        }

        // Filter berdasarkan Rank
        if ($request->filled('rank')) {
            $query->where('rank', 'like', '%' . $request->rank . '%');
        }

        // Ambil hasil filter
        $posts = $query->get();

        // Kirim data ke tampilan search.blade.php
        return view('search', compact('posts'));
    }
}