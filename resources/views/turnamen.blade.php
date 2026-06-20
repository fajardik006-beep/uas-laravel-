@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto pb-12">
    
    <div class="mb-8 flex items-center gap-4">
        <div class="w-12 h-12 bg-brand-card border border-brand-purple rounded-xl flex items-center justify-center text-2xl shadow-[0_0_15px_rgba(139,92,246,0.2)]">🏆</div>
        <div>
            <h2 class="text-2xl font-bold text-white">Bursa Turnamen</h2>
            <p class="text-gray-400 text-sm">Ikuti turnamen bergengsi atau gelar kompetisi E-Sports milikmu sendiri.</p>
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
            <h3 class="text-xl font-bold text-white mb-4 border-l-4 border-brand-purple pl-3">Jadwal Turnamen</h3>
            
            @forelse($turnamens as $turnamen)
            <div class="bg-brand-card rounded-xl border border-gray-800 p-6 hover:border-yellow-600/50 transition duration-300 relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-32 h-32 bg-yellow-500/10 rounded-full blur-2xl pointer-events-none"></div>

                <div class="flex flex-col sm:flex-row items-start justify-between gap-4 relative z-10">
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <span class="text-xs font-bold text-brand-accent uppercase bg-brand-accent/10 px-2 py-0.5 rounded">{{ $turnamen->game_name }}</span>
                            <span class="text-xs text-yellow-500 bg-yellow-500/10 px-2 py-0.5 rounded font-bold border border-yellow-500/20">🎁 {{ $turnamen->hadiah }}</span>
                            <span class="text-xs text-blue-400 bg-blue-500/10 px-2 py-0.5 rounded border border-blue-500/20">📅 {{ \Carbon\Carbon::parse($turnamen->tanggal_pelaksanaan)->format('d M Y') }}</span>
                        </div>
                        <h4 class="text-white font-bold text-xl mb-2">{{ $turnamen->nama_turnamen }}</h4>
                        <p class="text-gray-400 text-sm mb-4 leading-relaxed">{{ $turnamen->deskripsi }}</p>
                        
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <span class="flex items-center gap-1">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($turnamen->user->name ?? 'User') }}&background=random" class="w-4 h-4 rounded-full"> 
                                Penyelenggara: <strong class="text-gray-300">{{ $turnamen->user->name ?? 'Unknown' }}</strong>
                            </span>
                        </div>
                    </div>
                    
                    <div class="w-full sm:w-auto mt-2 sm:mt-0 flex flex-col gap-2 min-w-[140px]">
                        @if($turnamen->link_daftar)
                            <a href="{{ $turnamen->link_daftar }}" target="_blank" class="bg-gradient-to-r from-yellow-600 to-yellow-500 hover:from-yellow-500 hover:to-yellow-400 text-black px-6 py-2.5 rounded-lg text-sm font-bold transition block text-center shadow-lg shadow-yellow-600/20">Daftar Sekarang</a>
                        @else
                            <button class="bg-gray-700 text-gray-400 px-6 py-2.5 rounded-lg text-sm font-bold cursor-not-allowed w-full">Ditutup</button>
                        @endif

                        <div class="flex gap-2 w-full mt-1">
                            @if(auth()->check() && auth()->user()->isAdmin())
                                <a href="{{ route('turnamen.edit', $turnamen->id) }}" class="flex-1 text-center text-xs bg-yellow-600/20 text-yellow-500 border border-yellow-500/30 px-2 py-2 rounded-lg hover:bg-yellow-600 hover:text-white transition font-bold">
                                    ✏️ Edit
                                </a>
                            @endif

                            @if(auth()->check() && (auth()->user()->isAdmin() || auth()->id() === $turnamen->user_id))
                                <form action="{{ route('turnamen.destroy', $turnamen->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus turnamen ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full h-full bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white border border-red-500/30 px-2 py-2 rounded-lg text-xs font-bold transition">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            @endif
                        </div>
                        
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-brand-card rounded-xl border border-gray-800 p-10 text-center flex flex-col items-center">
                <span class="text-4xl mb-3">🕸️</span>
                <p class="text-gray-300 font-bold mb-1">Belum ada turnamen yang dijadwalkan.</p>
                <p class="text-gray-500 text-sm">Jadilah yang pertama menggelar turnamen di sini!</p>
            </div>
            @endforelse
        </div>

        <div>
            @if(auth()->user()->isAdmin())
                <div class="bg-brand-card rounded-xl border border-gray-800 p-6 shadow-xl h-fit">
                    <h3 class="text-lg font-bold text-white mb-1">📢 Gelar Turnamen</h3>
                    <p class="text-xs text-gray-400 mb-6">Publikasikan kompetisimu dan undang para player tangguh.</p>
                    
                    <form action="{{ route('turnamen.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-gray-400 text-xs font-medium mb-1">Nama Turnamen</label>
                            <input type="text" name="nama_turnamen" required placeholder="Cth: MLBB Championship" class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">
                        </div>
                        <div>
                            <label class="block text-gray-400 text-xs font-medium mb-1">Game</label>
                            <select name="game_name" required class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">
                                <option value="Mobile Legends">Mobile Legends</option>
                                <option value="Valorant">Valorant</option>
                                <option value="PUBG Mobile">PUBG Mobile</option>
                                <option value="Free Fire">Free Fire</option>
                                <option value="Genshin Impact">Genshin Impact</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-400 text-xs font-medium mb-1">Prize Pool / Hadiah</label>
                            <input type="text" name="hadiah" required placeholder="Cth: Rp 10.000.000" class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">
                        </div>
                        <div>
                            <label class="block text-gray-400 text-xs font-medium mb-1">Tanggal Pelaksanaan</label>
                            <input type="date" name="tanggal_pelaksanaan" required class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">
                        </div>
                        <div>
                            <label class="block text-gray-400 text-xs font-medium mb-1">Deskripsi & Syarat</label>
                            <textarea name="deskripsi" required rows="3" placeholder="Jelaskan rules..." class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm"></textarea>
                        </div>
                        <div>
                            <label class="block text-gray-400 text-xs font-medium mb-1">Link Pendaftaran (Opsional)</label>
                            <input type="url" name="link_daftar" placeholder="https://..." class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">
                        </div>
                        
                        <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-400 text-black px-4 py-3 rounded-lg font-bold transition mt-6 shadow-lg shadow-yellow-500/20">
                            🏆 Gelar Turnamen
                        </button>
                    </form>
                </div>
            @else
                <div class="bg-brand-card rounded-xl border border-gray-800 p-6 text-center shadow-xl">
                    <span class="text-4xl block mb-3">🛡️</span>
                    <h3 class="text-white font-bold mb-1">Ingin Gelar Turnamen?</h3>
                    <p class="text-gray-400 text-xs leading-relaxed">
                        Hak akses dibatasi. Hanya Admin MABAR.ID yang dapat mendaftarkan event kompetitif ke dalam sistem untuk menjaga kualitas E-Sports.
                    </p>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection