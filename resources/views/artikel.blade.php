@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto pb-12">
    
    <div class="mb-8 flex items-center gap-4">
        <div class="w-12 h-12 bg-brand-card border border-brand-purple rounded-xl flex items-center justify-center text-2xl shadow-[0_0_15px_rgba(139,92,246,0.2)]">📰</div>
        <div>
            <h2 class="text-2xl font-bold text-white">Portal Artikel</h2>
            <p class="text-gray-400 text-sm">Baca berita e-sports terkini atau tulis artikel tips & trik versimu sendiri.</p>
        </div>
    </div>

    <!-- NOTIFIKASI SUKSES -->
    @if(session('success'))
        <div class="mb-6 bg-green-500/20 border border-green-500/50 text-green-400 px-6 py-4 rounded-xl flex items-center justify-between">
            <span class="font-medium">✅ {{ session('success') }}</span>
            <button onclick="this.parentElement.style.display='none'" class="text-green-400 hover:text-white">✖</button>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- KOLOM KIRI: DAFTAR ARTIKEL -->
        <div class="lg:col-span-2 space-y-6">
            <h3 class="text-xl font-bold text-white mb-4 border-l-4 border-brand-purple pl-3">Artikel Terbaru</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($artikels as $artikel)
                <div class="bg-brand-card rounded-xl border border-gray-800 overflow-hidden hover:border-brand-purple transition duration-300 group flex flex-col h-full">
                    
                    <!-- Thumbnail Gambar -->
                    <div class="h-40 bg-gray-900 relative overflow-hidden">
                        @if($artikel->gambar_url)
                            <img src="{{ $artikel->gambar_url }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="Thumbnail">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-gray-700">
                                <span class="text-4xl mb-2">🖼️</span>
                                <span class="text-xs">Tanpa Gambar</span>
                            </div>
                        @endif
                        <div class="absolute top-3 left-3 bg-brand-purple text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                            {{ $artikel->kategori }}
                        </div>
                    </div>

                    <!-- Isi Artikel -->
                    <div class="p-5 flex-1 flex flex-col">
                        <h4 class="text-white font-bold text-lg mb-2 line-clamp-2 hover:text-brand-accent cursor-pointer transition">{{ $artikel->judul }}</h4>
                        <p class="text-gray-400 text-sm mb-4 line-clamp-3 flex-1">{{ $artikel->konten }}</p>
                        
                        <div class="flex flex-col gap-3 mt-auto pt-4 border-t border-gray-800">
                            <!-- Info Penulis & Tanggal -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2 text-xs text-gray-500">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($artikel->user->name ?? 'User') }}&background=random" class="w-5 h-5 rounded-full"> 
                                    <span class="truncate max-w-[100px]">{{ $artikel->user->name ?? 'Unknown' }}</span>
                                </div>
                                <span class="text-xs text-gray-500">{{ $artikel->created_at->format('d M Y') }}</span>
                            </div>

                            <!-- Tombol Hapus (Hanya Muncul Jika Admin) -->
                            @if(auth()->user()->isAdmin())
                                <form action="{{ route('artikel.destroy', $artikel->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus artikel ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white border border-red-500/30 px-3 py-1.5 rounded-lg text-xs font-bold transition">
                                        🗑️ Hapus Artikel (Admin)
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full bg-brand-card rounded-xl border border-gray-800 p-10 text-center flex flex-col items-center">
                    <span class="text-4xl mb-3">🗞️</span>
                    <p class="text-gray-300 font-bold mb-1">Belum ada artikel diterbitkan.</p>
                    <p class="text-gray-500 text-sm">Jadilah penulis pertama di MABAR.ID!</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- KOLOM KANAN: FORM TULIS ARTIKEL -->
        <div>
            @if(auth()->user()->isAdmin())
                <div class="bg-brand-card rounded-xl border border-gray-800 p-6 shadow-xl h-fit">
                    <h3 class="text-lg font-bold text-white mb-1">✍️ Tulis Artikel Baru</h3>
                    <p class="text-xs text-gray-400 mb-6">Bagikan informasi menarik seputar game.</p>
                    
                    <form action="{{ route('artikel.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-gray-400 text-xs font-medium mb-1">Judul Artikel</label>
                            <input type="text" name="judul" required class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:border-brand-purple text-sm">
                        </div>
                        <div>
                            <label class="block text-gray-400 text-xs font-medium mb-1">Kategori</label>
                            <select name="kategori" required class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:border-brand-purple text-sm">
                                <option value="Berita Game">Berita Game</option>
                                <option value="Tips & Trik">Tips & Trik</option>
                                <option value="Review">Review</option>
                                <option value="E-Sports">E-Sports</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-400 text-xs font-medium mb-1">Link Gambar Banner (Opsional)</label>
                            <input type="url" name="gambar_url" class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:border-brand-purple text-sm">
                        </div>
                        <div>
                            <label class="block text-gray-400 text-xs font-medium mb-1">Isi Artikel</label>
                            <textarea name="konten" required rows="6" class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:border-brand-purple text-sm"></textarea>
                        </div>
                        
                        <button type="submit" class="w-full bg-brand-purple hover:bg-brand-purple-hover text-white px-4 py-3 rounded-lg font-bold transition mt-6 shadow-lg shadow-brand-purple/20">
                            🚀 Terbitkan Artikel
                        </button>
                    </form>
                </div>
            @else
                <div class="bg-brand-card rounded-xl border border-gray-800 p-6 text-center shadow-xl">
                    <span class="text-4xl block mb-3">🔒</span>
                    <h3 class="text-white font-bold mb-1">Fitur Terkunci</h3>
                    <p class="text-gray-400 text-xs leading-relaxed">
                        Hanya Jurnalis atau Admin MABAR.ID yang dapat menerbitkan artikel.
                    </p>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection