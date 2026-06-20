<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Leaderboard;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
  // 1. MENAMPILKAN KLASEMEN (Semua Player Bisa Melihat)
   public function index()
    {
        // SEKARANG KITA AMBIL DARI TABEL LEADERBOARD, BUKAN USER
        // Dan kita urutkan berdasarkan kolom 'points' dari yang tertinggi
        $leaderboards = Leaderboard::with('user')->orderBy('points', 'desc')->get();
        
        return view('leaderboard', compact('leaderboards'));
    }
    // FUNGSI UNTUK MENYIMPAN DATA DARI FORM (HANYA ADMIN)
    public function store(Request $request)
    {
        // Gembok Admin: Pastikan hanya admin yang bisa memproses ini
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Akses Ditolak! Hanya Admin yang boleh menambahkan data leaderboard.');
        }

        // Validasi data yang dikirim dari form
        $request->validate([
            'game_name' => 'required|string',
            'in_game_nickname' => 'required|string',
            'role_andalan' => 'required|string',
            'points' => 'required|integer',
            'win_rate' => 'nullable|string',
        ]);

        // Karena form ini sepertinya tidak dikaitkan langsung dengan satu user tertentu,
        // kita perlu membuat model Leaderboard baru (pastikan kamu punya modelnya!)
        
        // CATATAN PENTING:
        // Jika kamu belum membuat Model Leaderboard dan tabelnya di database,
        // kamu perlu membuatnya dulu. Kode di bawah berasumsi kamu sudah punya.
        
        \App\Models\Leaderboard::create([
            'user_id' => auth()->id(), // Atau biarkan null jika tidak perlu dikaitkan
            'game_name' => $request->game_name,
            'in_game_nickname' => $request->in_game_nickname,
            'role_andalan' => $request->role_andalan,
            'points' => $request->points,
            'win_rate' => $request->win_rate,
        ]);

        return redirect()->back()->with('success', 'Statistik player berhasil ditambahkan ke Leaderboard!');
    }

    // 4. RESET POIN PLAYER (HANYA ADMIN)
  // HANYA ADMIN YANG BISA EDIT
    public function edit($id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Akses Ditolak! Hanya Admin yang boleh mengedit statistik leaderboard.');
        }

        $board = \App\Models\Leaderboard::findOrFail($id);
        return view('leaderboard_edit', compact('board'));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Akses Ditolak!');
        }

        $board = \App\Models\Leaderboard::findOrFail($id);
        $board->update($request->all());

        return redirect()->route('leaderboard.index')->with('success', 'Statistik leaderboard berhasil diperbarui!');
    }

    // ADMIN BISA HAPUS, ATAU USER PEMBUATNYA BISA HAPUS
    public function destroy($id)
    {
        $board = \App\Models\Leaderboard::findOrFail($id);

        if (auth()->user()->isAdmin() || auth()->id() === $board->user_id) {
            $board->delete();
            return redirect()->back()->with('success', 'Data player berhasil dihapus dari leaderboard!');
        }

        abort(403, 'Akses Ditolak! Kamu bukan Admin atau pemilik statistik ini.');
    }
}