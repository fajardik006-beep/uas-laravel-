@extends('layouts.app')

@section('content')

    <!-- NOTIFIKASI SUKSES -->
    @if(session('success'))
        <div class="mb-6 bg-green-500/20 border border-green-500/50 text-green-400 px-6 py-4 rounded-xl flex items-center justify-between">
            <span class="font-medium">✅ {{ session('success') }}</span>
            <button onclick="this.parentElement.style.display='none'" class="text-green-400 hover:text-white">✖</button>
        </div>
    @endif

    <!-- CEK APAKAH SEDANG MENCARI ATAU TIDAK -->
    @if(request()->has('search') && request('search') != '')
        <div class="mb-8 p-6 bg-brand-card border border-brand-purple/30 rounded-2xl">
            <h2 class="text-2xl font-bold text-white mb-2">🔍 Hasil Pencarian: <span class="text-brand-accent">"{{ request('search') }}"</span></h2>
            <p class="text-gray-400">Menampilkan postingan mabar yang sesuai dengan kata kunci.</p>
            <a href="{{ route('dashboard') }}" class="inline-block mt-4 text-sm text-brand-purple hover:text-white transition">✖ Hapus Pencarian & Kembali ke Beranda</a>
        </div>
    @else
        <!-- HERO BANNER (KINI DENGAN GAMBAR!) -->
        <div class="relative bg-brand-card rounded-2xl overflow-hidden mb-8 border border-gray-800 flex items-center min-h-[320px]">
            <!-- Gambar Background dari Internet -->
            <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=2070&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover z-0 opacity-40 mix-blend-screen" alt="Gaming Banner">
            <!-- Gradien penutup biar teks tetap terbaca -->
            <div class="absolute inset-0 bg-gradient-to-r from-[#0f111a] via-[#0f111a]/90 to-[#4c1d95]/30 z-0"></div>
            
            <div class="relative z-10 p-10 max-w-2xl">
                <h2 class="text-4xl font-bold text-white mb-2">Komunitas Gamer,</h2>
                <h2 class="text-4xl font-bold text-brand-purple-hover drop-shadow-md mb-6">Tempat Para Player Bersatu!</h2>
                <p class="text-gray-300 mb-8 leading-relaxed">
                    Gabung komunitas, cari teman mabar, bangun tim, dan raih kemenangan bersama di MABAR.ID!
                </p>
                <div class="flex gap-4">
                    <a href="{{ route('posting.create') }}" class="bg-brand-purple hover:bg-brand-purple-hover text-white px-6 py-3 rounded-xl font-bold transition flex items-center gap-2 shadow-lg shadow-brand-purple/30">
                        ➕ Buat Posting Mabar
                    </a>
                    <a href="{{ route('komunitas') }}" class="bg-gray-800/80 backdrop-blur hover:bg-gray-700 text-white px-6 py-3 rounded-xl font-bold transition flex items-center gap-2 border border-gray-600">
                        👥 Jelajahi Komunitas
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- MAIN GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- ================= KOLOM KIRI ================= -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- KOMUNITAS POPULER -->
            @if(!request()->has('search') || request('search') == '')
            <section>
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-white">Komunitas Populer</h3>
                    <!-- Link Lihat Semua Komunitas Diaktifkan -->
                    <a href="{{ route('komunitas') }}" class="text-brand-accent text-sm hover:underline font-medium">Lihat Semua</a>
                </div>
                
                <!-- Diubah menjadi 5 Kolom (lg:grid-cols-5) untuk memuat Genshin Impact -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                    
                    <!-- MLBB -->
                    <div class="bg-brand-card rounded-xl border border-gray-800 overflow-hidden hover:border-brand-purple transition duration-300 group">
                        <div class="relative h-28 overflow-hidden">
                            <img src="https://tse2.mm.bing.net/th/id/OIP.inPCTea3kysI-8E16XBeMAHaHa?pid=Api&P=0&h=180" class="w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="Mobile Legends">
                            <div class="absolute inset-0 bg-gradient-to-t from-brand-card to-transparent"></div>
                        </div>
                        <div class="p-4 relative z-10 -mt-6">
                            <h4 class="text-white font-bold text-sm mb-1 truncate drop-shadow-md">Mythic Squad ID</h4>
                            <p class="text-gray-400 text-xs mb-4">Mobile Legends</p>
                            <a href="?search=Mobile Legends" class="block text-center w-full py-2 rounded-lg bg-brand-purple/20 text-brand-accent text-sm font-medium hover:bg-brand-purple hover:text-white transition">Lihat Pos</a>
                        </div>
                    </div>

                    <!-- Valorant -->
                    <div class="bg-brand-card rounded-xl border border-gray-800 overflow-hidden hover:border-brand-purple transition duration-300 group">
                        <div class="relative h-28 overflow-hidden">
                            <img src="https://tse4.mm.bing.net/th/id/OIP.TWSo_lejU0wlsp6jut5LOwHaEK?pid=Api&P=0&h=180" class="w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="Valorant">
                            <div class="absolute inset-0 bg-gradient-to-t from-brand-card to-transparent"></div>
                        </div>
                        <div class="p-4 relative z-10 -mt-6">
                            <h4 class="text-white font-bold text-sm mb-1 truncate drop-shadow-md">Valorant Indonesia</h4>
                            <p class="text-gray-400 text-xs mb-4">Valorant</p>
                            <a href="?search=Valorant" class="block text-center w-full py-2 rounded-lg bg-brand-purple/20 text-brand-accent text-sm font-medium hover:bg-brand-purple hover:text-white transition">Lihat Pos</a>
                        </div>
                    </div>
                    
                    <!-- PUBG -->
                    <div class="bg-brand-card rounded-xl border border-gray-800 overflow-hidden hover:border-brand-purple transition duration-300 group">
                        <div class="relative h-28 overflow-hidden">
                            <img src="https://tse4.mm.bing.net/th/id/OIP.RTNHagKsDJ8NjozSdMtdNQHaD4?pid=Api&P=0&h=180" class="w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="PUBG">
                            <div class="absolute inset-0 bg-gradient-to-t from-brand-card to-transparent"></div>
                        </div>
                        <div class="p-4 relative z-10 -mt-6">
                            <h4 class="text-white font-bold text-sm mb-1 truncate drop-shadow-md">PUBG Pro Indo</h4>
                            <p class="text-gray-400 text-xs mb-4">PUBG Mobile</p>
                            <a href="?search=PUBG Mobile" class="block text-center w-full py-2 rounded-lg bg-brand-purple/20 text-brand-accent text-sm font-medium hover:bg-brand-purple hover:text-white transition">Lihat Pos</a>
                        </div>
                    </div>

                    <!-- Free Fire -->
                    <div class="bg-brand-card rounded-xl border border-gray-800 overflow-hidden hover:border-brand-purple transition duration-300 group">
                        <div class="relative h-28 overflow-hidden">
                            <img src="https://tse2.mm.bing.net/th/id/OIP.WVGLBnbNhMlsgbPGNK7xSQHaEK?pid=Api&P=0&h=180" class="w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="Free Fire">
                            <div class="absolute inset-0 bg-gradient-to-t from-brand-card to-transparent"></div>
                        </div>
                        <div class="p-4 relative z-10 -mt-6">
                            <h4 class="text-white font-bold text-sm mb-1 truncate drop-shadow-md">FF Nusantara</h4>
                            <p class="text-gray-400 text-xs mb-4">Free Fire</p>
                            <a href="?search=Free Fire" class="block text-center w-full py-2 rounded-lg bg-brand-purple/20 text-brand-accent text-sm font-medium hover:bg-brand-purple hover:text-white transition">Lihat Pos</a>
                        </div>
                    </div>

                    <!-- Genshin Impact  -->
                    <div class="bg-brand-card rounded-xl border border-gray-800 overflow-hidden hover:border-brand-purple transition duration-300 group">
                        <div class="relative h-28 overflow-hidden">
                            <img src="https://tse2.mm.bing.net/th/id/OIP.S7yQJux8m0WzTmbi_6f-BgHaDt?pid=Api&P=0&h=180" class="w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="Genshin Impact">
                            <div class="absolute inset-0 bg-gradient-to-t from-brand-card to-transparent"></div>
                        </div>
                        <div class="p-4 relative z-10 -mt-6">
                            <h4 class="text-white font-bold text-sm mb-1 truncate drop-shadow-md">Teyvat Travelers</h4>
                            <p class="text-gray-400 text-xs mb-4">Genshin Impact</p>
                            <a href="?search=Genshin Impact" class="block text-center w-full py-2 rounded-lg bg-brand-purple/20 text-brand-accent text-sm font-medium hover:bg-brand-purple hover:text-white transition">Lihat Pos</a>
                        </div>
                    </div>

                </div>
            </section>
            @endif

            <!-- POSTINGAN MABAR TERBARU -->
            <section>
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-white">Postingan Mabar Terbaru</h3>
                </div>

                <div class="space-y-4">
                    @forelse($posts as $post)
                        <div class="bg-brand-card rounded-xl border border-gray-800 p-5 flex flex-col sm:flex-row items-start sm:items-center gap-6 hover:border-gray-600 transition">
                            <!-- Thumbnail Kiri -->
                            <div class="flex sm:flex-col gap-2 min-w-[150px]">
                                <div class="w-20 h-20 bg-gradient-to-br from-brand-purple to-indigo-900 rounded-xl mb-1 flex items-center justify-center text-3xl hidden sm:flex shadow-inner">🎮</div>
                                <span class="bg-brand-purple/20 text-brand-accent px-2.5 py-1 rounded text-xs border border-brand-purple/30 text-center truncate">Rank: {{ $post->rank }}</span>
                                <span class="bg-gray-800 text-gray-300 px-2.5 py-1 rounded text-xs border border-gray-700 text-center truncate">Butuh: {{ $post->players_needed }} Player</span>
                            </div>
                            
                            <!-- Isi Postingan -->
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-xs font-bold text-brand-accent uppercase bg-brand-accent/10 px-2 py-0.5 rounded">{{ $post->game_name }}</span>
                                    <span class="text-xs text-gray-500">Role: {{ $post->role_needed }}</span>
                                </div>
                                <h4 class="text-white font-bold text-lg mb-1">{{ $post->title }}</h4>
                                <p class="text-gray-400 text-sm mb-3 line-clamp-2">{{ $post->description }}</p>
                                <div class="flex items-center gap-4 text-xs text-gray-400">
                                    <span class="flex items-center gap-1">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name ?? 'User') }}&background=random" class="w-5 h-5 rounded-full"> 
                                        Oleh <span class="text-gray-300 font-medium">{{ $post->user->name ?? 'Pengguna' }}</span>
                                    </span>
                                    <span>• {{ $post->created_at->diffForHumans() }}</span>
                                    <span class="text-green-500 flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> Online</span>
                                </div>
                            </div>

                            <!-- TOMBOL AKSI -->
                            <div class="mt-4 sm:mt-0 w-full sm:w-auto flex flex-wrap gap-2 justify-end">
                                @if(auth()->check() && (auth()->id() === $post->user_id || auth()->user()->isAdmin()))
                                    <a href="{{ route('posting.edit', $post->id) }}" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition cursor-pointer">
                                        ✏️ Edit {{ auth()->user()->isAdmin() && auth()->id() !== $post->user_id ? '(Admin)' : '' }}
                                    </a>
                                    <form action="{{ route('posting.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus postingan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="bg-red-900/50 hover:bg-red-700 text-red-200 px-4 py-2.5 rounded-lg text-sm font-medium transition cursor-pointer">
                                            🗑️ Hapus {{ auth()->user()->isAdmin() && auth()->id() !== $post->user_id ? '(Admin)' : '' }}
                                        </button>
                                    </form>
                                @else
                                    @if($post->contact_link)
                                        @if(str_starts_with($post->contact_link, 'http'))
                                            <a href="{{ $post->contact_link }}" target="_blank" class="bg-brand-purple hover:bg-brand-purple-hover text-white px-6 py-2.5 rounded-lg font-medium transition cursor-pointer">Gabung via Link</a>
                                        @else
                                            <button onclick="navigator.clipboard.writeText('{{ $post->contact_link }}'); alert('ID Tersalin: {{ $post->contact_link }}');" class="bg-brand-accent hover:bg-brand-purple-hover text-white px-6 py-2.5 rounded-lg font-medium transition cursor-pointer">📋 Salin ID</button>
                                        @endif
                                    @else
                                        <button class="bg-gray-700 text-gray-400 px-6 py-2.5 rounded-lg font-medium cursor-not-allowed">Belum Ada ID</button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="bg-brand-card rounded-xl border border-gray-800 p-8 text-center text-gray-500">
                            Belum ada postingan mabar. Jadilah yang pertama!
                        </div>
                    @endforelse
                </div>

                <!-- TOMBOL SLIDE (PAGINATION) -->
                <div class="mt-6">
                    {{ $posts->links() }}
                </div>
            </section>
        </div>

        <!-- ================= KOLOM KANAN ================= -->
        <div class="space-y-6">
            
            <!-- Turnamen -->
            <section class="bg-brand-card rounded-xl p-5 border border-gray-800">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="font-bold text-white">Turnamen Terdekat</h3>
                    <a href="{{ route('turnamen') }}" class="text-brand-accent text-xs hover:underline">Lihat Semua</a>
                </div>
                
                <div class="space-y-4">
                    @forelse($turnamens as $turnamen)
                        <div class="flex gap-4 items-center">
                            <div class="w-20 h-24 bg-gradient-to-b from-yellow-900 to-brand-dark rounded-lg flex flex-col items-center justify-center border border-yellow-700/30 shadow-inner">
                                <span class="text-4xl drop-shadow-md">🏆</span>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-white font-bold text-sm mb-1 line-clamp-1">{{ $turnamen->nama_turnamen }}</h4>
                                <p class="text-gray-400 text-xs mb-1">{{ $turnamen->game_name }}</p>
                                <p class="text-yellow-500 text-xs font-medium mb-2">{{ $turnamen->hadiah }}</p>
                                <a href="{{ route('turnamen') }}" class="inline-block text-center bg-brand-purple/20 hover:bg-brand-purple text-brand-accent hover:text-white px-4 py-1.5 text-xs rounded-lg font-bold transition w-full">Daftar</a>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-xs text-center py-2">Belum ada turnamen terjadwal.</p>
                    @endforelse
                </div>
            </section>

            <!-- Artikel Terbaru -->
            <section class="bg-brand-card rounded-xl p-5 border border-gray-800">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="font-bold text-white">Artikel Terbaru</h3>
                    <a href="{{ route('artikel') }}" class="text-brand-accent text-xs hover:underline">Lihat Semua</a>
                </div>
                
                <div class="space-y-4">
                    @forelse($artikels as $artikel)
                        <a href="{{ route('artikel') }}" class="flex gap-3 items-start hover:bg-gray-800/50 p-2 -mx-2 rounded-lg transition cursor-pointer">
                            <!-- Jika tidak ada gambar di database, pakai gambar bawaanmu (unsplash/bing) -->
                            <img src="{{ $artikel->gambar_url ?? ($loop->first ? 'https://images.unsplash.com/photo-1542751371-adc38448a05e?w=100&h=100&fit=crop' : 'https://tse2.mm.bing.net/th/id/OIP.inPCTea3kysI-8E16XBeMAHaHa?pid=Api&P=0&h=180') }}" class="w-16 h-16 rounded-lg object-cover" alt="Cover Artikel">
                            <div>
                                <h4 class="text-white font-bold text-sm leading-tight mb-1 line-clamp-2">{{ $artikel->judul }}</h4>
                                <p class="text-gray-500 text-xs">{{ $artikel->created_at->diffForHumans() }}</p>
                            </div>
                        </a>
                    @empty
                        <p class="text-gray-500 text-xs text-center py-2">Belum ada artikel diterbitkan.</p>
                    @endforelse
                </div>
            </section>

        </div>
    </div>
@endsection