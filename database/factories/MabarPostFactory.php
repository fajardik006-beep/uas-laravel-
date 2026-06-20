<?php

namespace App\Http\Controllers;

use App\Models\MabarPost;
use Illuminate\Http\Request;

class MabarPostController extends Controller
{
    // 1. Menampilkan Halaman Utama & Filter Pencarian
    public function index(Request $request)
    {
        $query = MabarPost::with('user')->latest();

        // Logika mesin pencari
        if ($request->has('search') && $request->search != '') {
            $keyword = $request->search;
            $query->where('title', 'like', '%' . $keyword . '%')
                  ->orWhere('game_name', 'like', '%' . $keyword . '%');
        }

        $posts = $query->get();

        return view('dashboard', compact('posts'));
    }

    // 2. Form Buat Posting
    public function create()
    {
        return view('create');
    }

    // 3. Simpan Posting Baru
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

    // 4. Form Edit Posting
    public function edit($id)
    {
        $post = MabarPost::findOrFail($id);
        if ($post->user_id !== auth()->id()) abort(403);
        return view('edit', compact('post'));
    }

    // 5. Simpan Editan
    public function update(Request $request, $id)
    {
        $post = MabarPost::findOrFail($id);
        if ($post->user_id !== auth()->id()) abort(403);

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

    // 6. Hapus Posting
    public function destroy($id)
    {
        $post = MabarPost::findOrFail($id);
        if ($post->user_id !== auth()->id()) abort(403);
        $post->delete();
        return redirect()->route('dashboard')->with('success', 'Postingan berhasil dihapus!');
    }
}