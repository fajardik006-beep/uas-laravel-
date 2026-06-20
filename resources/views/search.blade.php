@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto pb-12">
    
    <!-- Header Halaman -->
    <div class="mb-8 flex items-center gap-4">
        <div class="w-12 h-12 bg-brand-card border border-brand-purple rounded-xl flex items-center justify-center text-2xl shadow-[0_0_15px_rgba(139,92,246,0.2)]">
            🔍
        </div>
        <div>
            <h2 class="text-2xl font-bold text-white">Advanced Search</h2>
            <p class="text-gray-400 text-sm">Cari rekan mabar super spesifik sesuai kebutuhan tim kamu.</p>
        </div>
    </div>

    <!-- Kotak Form Filter -->
    <div class="bg-brand-card rounded-2xl border border-gray-800 p-6 mb-8 shadow-xl">
        <form action="{{ route('cari.mabar') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            
            <!-- Filter Game -->
            <div>
                <label class="block text-white text-xs font-medium mb-2">Game 🎮</label>
                <select name="game_name" class="w-full bg-brand-dark text-gray-300 rounded-xl px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">
                    <option value="">Semua Game</option>
                    <option value="Mobile Legends" {{ request('game_name') == 'Mobile Legends' ? 'selected' : '' }}>Mobile Legends</option>
                    <option value="Valorant" {{ request('game_name') == 'Valorant' ? 'selected' : '' }}>Valorant</option>
                    <option value="PUBG Mobile" {{ request('game_name') == 'PUBG Mobile' ? 'selected' : '' }}>PUBG Mobile</option>
                    <option value="Free Fire" {{ request('game_name') == 'Free Fire' ? 'selected' : '' }}>Free Fire</option>
                </select>
            </div>

            <!-- Filter Role -->
            <div>
                <label class="block text-white text-xs font-medium mb-2">Role Dibutuhkan 🎭</label>
                <input type="text" name="role_needed" value="{{ request('role_needed') }}" placeholder="Cth: Roamer, Duelist" class="w-full bg-brand-dark text-gray-300 rounded-xl px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">
            </div>

            <!-- Filter Rank -->
            <div>
                <label class="block text-white text-xs font-medium mb-2">Rank 🏆</label>
                <input type="text" name="rank" value="{{ request('rank') }}" placeholder="Cth: Mythic, Diamond" class="w-full bg-brand-dark text-gray-300 rounded-xl px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">
            </div>

            <!-- Tombol Cari -->
            <div>
                <button type="submit" class="w-full bg-brand-purple hover:bg-brand-purple-hover text-white px-4 py-2.5 rounded-xl font-bold transition flex items-center justify-center gap-2 shadow-lg shadow-brand-purple/20">
                    Saring Data 🚀
                </button>
            </div>
            
        </form>
        
        <!-- Tombol Reset Filter -->
        @if(request()->has('game_name'))
            <div class="mt-4 pt-4 border-t border-gray-800 text-right">
                <a href="{{ route('cari.mabar') }}" class="text-xs text-gray-400 hover:text-white transition">✖ Hapus Semua Filter</a>
            </div>
        @endif
    </div>

    <!-- HASIL PENCARIAN -->
    <div>
        <h3 class="text-xl font-bold text-white mb-6 border-l-4 border-brand-purple pl-3">
            Hasil Pencarian: <span class="text-brand-accent">{{ $posts->count() }} Postingan Ditemukan</span>
        </h3>

        <div class="space-y-4">
            @forelse($posts as $post)
                <div class="bg-brand-card rounded-xl border border-gray-800 p-5 flex flex-col sm:flex-row items-start sm:items-center gap-6 hover:border-gray-600 transition">
                    <div class="flex sm:flex-col gap-2 min-w-[150px]">
                        <span class="bg-brand-purple/20 text-brand-accent px-2.5 py-1 rounded text-xs border border-brand-purple/30 text-center truncate">Rank: {{ $post->rank }}</span>
                        <span class="bg-gray-800 text-gray-300 px-2.5 py-1 rounded text-xs border border-gray-700 text-center truncate">Butuh: {{ $post->players_needed }} Player</span>
                    </div>
                    
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xs font-bold text-brand-accent uppercase bg-brand-accent/10 px-2 py-0.5 rounded">{{ $post->game_name }}</span>
                            <span class="text-xs text-gray-500">Role: {{ $post->role_needed }}</span>
                        </div>
                        <h4 class="text-white font-bold text-lg mb-1">{{ $post->title }}</h4>
                        <p class="text-gray-400 text-sm mb-3 line-clamp-2">{{ $post->description }}</p>
                        <div class="flex items-center gap-4 text-xs text-gray-400">
                            <span class="flex items-center gap-1">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name ?? 'User') }}&background=random" class="w-4 h-4 rounded-full"> 
                                {{ $post->user->name ?? 'Pengguna' }}
                            </span>
                            <span>• {{ $post->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    <div class="mt-4 sm:mt-0 w-full sm:w-auto flex flex-wrap gap-2 justify-end">
                        @if($post->contact_link)
                            <button onclick="navigator.clipboard.writeText('{{ $post->contact_link }}'); alert('ID Tersalin!');" class="bg-brand-purple hover:bg-brand-purple-hover text-white px-6 py-2.5 rounded-lg font-medium transition cursor-pointer text-sm">📋 Salin ID</button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-brand-card rounded-xl border border-gray-800 p-12 text-center flex flex-col items-center justify-center">
                    <span class="text-4xl mb-4">🏜️</span>
                    <h3 class="text-white font-bold text-lg mb-2">Yah, datanya kosong!</h3>
                    <p class="text-gray-500 text-sm">Tidak ada postingan mabar yang cocok dengan kriteria filter kamu. Coba kurangi syarat filternya.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection