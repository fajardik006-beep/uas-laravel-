@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto pb-12">
    
    <div class="mb-8 flex items-center gap-4">
        <div class="w-12 h-12 bg-brand-card border border-brand-purple rounded-xl flex items-center justify-center text-2xl shadow-[0_0_15px_rgba(139,92,246,0.2)]">🤝</div>
        <div>
            <h2 class="text-2xl font-bold text-white">Komunitas & Squad</h2>
            <p class="text-gray-400 text-sm">Cari teman mabar, gabung ke squad impianmu, atau bentuk tim-mu sendiri.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-500/20 border border-green-500/50 text-green-400 px-6 py-4 rounded-xl flex items-center justify-between">
            <span class="font-medium">✅ {{ session('success') }}</span>
            <button onclick="this.parentElement.style.display='none'" class="text-green-400 hover:text-white">✖</button>
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 bg-red-500/20 border border-red-500/50 text-red-400 px-6 py-4 rounded-xl">
            <p class="font-bold mb-2">Ups! Ada yang salah:</p>
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-4">
            <h3 class="text-xl font-bold text-white mb-4 border-l-4 border-brand-purple pl-3">Daftar Squad Aktif</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @forelse($komunitas as $squad)
                <div class="bg-brand-card rounded-xl border border-gray-800 p-5 hover:border-blue-500/50 transition duration-300 relative overflow-hidden flex flex-col h-full">
                    
                    <div class="flex-1 relative z-10">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-[10px] font-bold text-blue-400 uppercase bg-blue-500/10 px-2 py-0.5 rounded border border-blue-500/20">{{ $squad->game_name }}</span>
                        </div>
                        <h4 class="text-white font-bold text-lg mb-1">{{ $squad->nama_squad }}</h4>
                        <p class="text-gray-400 text-xs mb-4 line-clamp-2">{{ $squad->deskripsi }}</p>
                        
                        <div class="flex items-center gap-2 text-xs text-gray-500 mb-4">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($squad->user->name ?? 'Leader') }}&background=random" class="w-5 h-5 rounded-full"> 
                            <span>Leader: <strong class="text-gray-300">{{ $squad->user->name ?? 'Unknown' }}</strong></span>
                        </div>
                    </div>
                    
                    <div class="flex gap-2 mt-4 w-full">
                        
                        @if($squad->link_grup)
                            <a href="{{ $squad->link_grup }}" target="_blank" class="flex-1 text-center text-xs bg-blue-600/20 text-blue-400 border border-blue-500/30 px-2 py-2 rounded-lg hover:bg-blue-600 hover:text-white transition font-bold">
                                🎮 Gabung
                            </a>
                        @else
                            <button disabled class="flex-1 text-center text-xs bg-gray-800 text-gray-500 border border-gray-700 px-2 py-2 rounded-lg cursor-not-allowed font-bold">
                                🔒 Tertutup
                            </button>
                        @endif

                        @if(auth()->check() && auth()->user()->isAdmin())
                            <a href="{{ route('komunitas.edit', $squad->id) }}" class="flex-1 text-center text-xs bg-yellow-600/20 text-yellow-500 border border-yellow-500/30 px-2 py-2 rounded-lg hover:bg-yellow-600 hover:text-white transition font-bold">
                                ✏️ Edit
                            </a>
                        @endif

                        @if(auth()->check() && (auth()->user()->isAdmin() || auth()->id() === $squad->user_id))
                            <form action="{{ route('komunitas.destroy', $squad->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus squad ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full h-full bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white border border-red-500/30 px-2 py-2 rounded-lg text-xs font-bold transition">
                                    🗑️ Hapus
                                </button>
                            </form>
                        @endif

                    </div>
                </div>
                @empty
                <div class="col-span-full bg-brand-card rounded-xl border border-gray-800 p-10 text-center flex flex-col items-center">
                    <span class="text-4xl mb-3">🕸️</span>
                    <p class="text-gray-300 font-bold mb-1">Belum ada squad yang terbentuk.</p>
                    <p class="text-gray-500 text-sm">Jadilah leader pertama yang membuat squad!</p>
                </div>
                @endforelse
            </div>
        </div>

        <div>
            <div class="bg-brand-card rounded-xl border border-gray-800 p-6 shadow-xl h-fit sticky top-6">
                <h3 class="text-lg font-bold text-white mb-1">🛡️ Bentuk Squad Baru</h3>
                <p class="text-xs text-gray-400 mb-6">Jadilah kapten dan rekrut player tangguh.</p>
                
                <form action="{{ route('komunitas.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-gray-400 text-xs font-medium mb-1">Nama Squad / Tim</label>
                        <input type="text" name="nama_squad" required placeholder="Cth: EVOS Legends" class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">
                    </div>
                    <div>
                        <label class="block text-gray-400 text-xs font-medium mb-1">Fokus Game</label>
                        <select name="game_name" required class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">
                            <option value="Mobile Legends">Mobile Legends</option>
                            <option value="Valorant">Valorant</option>
                            <option value="PUBG Mobile">PUBG Mobile</option>
                            <option value="Free Fire">Free Fire</option>
                            <option value="Genshin Impact">Genshin Impact</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-400 text-xs font-medium mb-1">Link Grup (WA / Discord)</label>
                        <input type="url" name="link_grup" required placeholder="https://chat.whatsapp.com/..." class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">
                    </div>
                    <div>
                        <label class="block text-gray-400 text-xs font-medium mb-1">Deskripsi & Syarat Rekrutmen</label>
                        <textarea name="deskripsi" required rows="3" placeholder="Cth: Minimal Rank Mythic..." class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm"></textarea>
                    </div>
                    
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white px-4 py-3 rounded-lg font-bold transition mt-6 shadow-lg shadow-blue-600/20">
                        🔥 Bentuk Squad Sekarang
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection