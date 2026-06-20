<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MABAR.ID - Komunitas Gamer</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-brand-dark text-gray-200 h-screen overflow-hidden flex">

    <!-- ================= SIDEBAR KIRI ================= -->
<aside class="w-64 bg-brand-dark border-r border-gray-800 hidden md:flex flex-col h-screen sticky top-0 overflow-y-auto pb-4">
    
    <!-- 1. Logo & Judul -->
    <div class="p-6 flex items-center gap-3">
        <div class="w-10 h-10 bg-brand-purple rounded-xl flex items-center justify-center text-white text-xl shadow-lg shadow-brand-purple/20">🎮</div>
        <div>
            <h1 class="text-xl font-bold text-white tracking-wide">MABAR.ID</h1>
            <p class="text-[10px] text-gray-400">Komunitas Gamer Indonesia</p>
        </div>
    </div>

    <!-- 2. Main Menu (Navigasi Utama) -->
    <nav class="flex-1 px-4 space-y-1 mt-2">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 {{ request()->routeIs('dashboard') ? 'bg-brand-purple text-white shadow-md shadow-brand-purple/20' : 'text-gray-400 hover:text-white hover:bg-gray-800/50' }} px-4 py-3 rounded-xl text-sm font-medium transition">
            🏠 Beranda
        </a>
        <a href="{{ route('komunitas') }}" class="flex items-center gap-3 {{ request()->routeIs('komunitas') ? 'bg-brand-purple text-white shadow-md' : 'text-gray-400 hover:text-white hover:bg-gray-800/50' }} px-4 py-3 rounded-xl text-sm font-medium transition">
            👥 Komunitas
        </a>
        <a href="{{ route('cari.mabar') }}" class="flex items-center gap-3 {{ request()->routeIs('cari.mabar') ? 'bg-brand-purple text-white shadow-md' : 'text-gray-400 hover:text-white hover:bg-gray-800/50' }} px-4 py-3 rounded-xl text-sm font-medium transition">
            🔍 Cari Mabar
        </a>
        <a href="{{ route('posting.create') }}" class="flex items-center gap-3 {{ request()->routeIs('posting.create') ? 'bg-brand-purple text-white shadow-md' : 'text-gray-400 hover:text-white hover:bg-gray-800/50' }} px-4 py-3 rounded-xl text-sm font-medium transition">
            📝 Posting Mabar
        </a>
        <a href="{{ route('turnamen') }}" class="flex items-center gap-3 {{ request()->routeIs('turnamen') ? 'bg-brand-purple text-white shadow-md' : 'text-gray-400 hover:text-white hover:bg-gray-800/50' }} px-4 py-3 rounded-xl text-sm font-medium transition">
            🏆 Turnamen
        </a>
        <a href="{{ route('leaderboard.index') }}" class="flex items-center gap-3 {{ request()->routeIs('leaderboard') ? 'bg-brand-purple text-white shadow-md' : 'text-gray-400 hover:text-white hover:bg-gray-800/50' }} px-4 py-3 rounded-xl text-sm font-medium transition">
            📊 Leaderboard
        </a>
        <a href="{{ route('artikel') }}" class="flex items-center gap-3 {{ request()->routeIs('artikel') ? 'bg-brand-purple text-white shadow-md' : 'text-gray-400 hover:text-white hover:bg-gray-800/50' }} px-4 py-3 rounded-xl text-sm font-medium transition">
            📰 Artikel
        </a>
        <a href="{{ route('toko.point') }}" class="flex items-center gap-3 {{ request()->routeIs('toko.point') ? 'bg-brand-purple text-white shadow-md' : 'text-gray-400 hover:text-white hover:bg-gray-800/50' }} px-4 py-3 rounded-xl text-sm font-medium transition">
            🛍️ Toko Point
        </a>
    </nav>

    <!-- 3. Game Populer -->
    <div class="px-4 py-6">
        <h3 class="text-white font-bold mb-3 px-4 text-sm">Game Populer</h3>
        <div class="space-y-1">
            <a href="?search=Mobile Legends" class="flex items-center gap-3 text-gray-400 hover:text-white hover:bg-gray-800/50 px-4 py-2 rounded-xl transition text-sm">
                <img src="https://tse2.mm.bing.net/th/id/OIP.inPCTea3kysI-8E16XBeMAHaHa?pid=Api&P=0&h=180" class="w-6 h-6 rounded" alt="ML"> Mobile Legends
            </a>
            <a href="?search=Valorant" class="flex items-center gap-3 text-gray-400 hover:text-white hover:bg-gray-800/50 px-4 py-2 rounded-xl transition text-sm">
                <img src="https://tse4.mm.bing.net/th/id/OIP.TWSo_lejU0wlsp6jut5LOwHaEK?pid=Api&P=0&h=180" class="w-6 h-6 rounded" alt="Valo"> Valorant
            </a>
            <a href="?search=PUBG Mobile" class="flex items-center gap-3 text-gray-400 hover:text-white hover:bg-gray-800/50 px-4 py-2 rounded-xl transition text-sm">
                <img src="https://tse4.mm.bing.net/th/id/OIP.RTNHagKsDJ8NjozSdMtdNQHaD4?pid=Api&P=0&h=180" class="w-6 h-6 rounded" alt="PUBG"> PUBG Mobile
            </a>
            <a href="?search=Free Fire" class="flex items-center gap-3 text-gray-400 hover:text-white hover:bg-gray-800/50 px-4 py-2 rounded-xl transition text-sm">
                <img src="https://tse2.mm.bing.net/th/id/OIP.WVGLBnbNhMlsgbPGNK7xSQHaEK?pid=Api&P=0&h=180" class="w-6 h-6 rounded" alt="FF"> Free Fire
            </a>
            <a href="?search=Genshin Impact" class="flex items-center gap-3 text-gray-400 hover:text-white hover:bg-gray-800/50 px-4 py-2 rounded-xl transition text-sm">
                <img src="https://tse2.mm.bing.net/th/id/OIP.S7yQJux8m0WzTmbi_6f-BgHaDt?pid=Api&P=0&h=180" class="w-6 h-6 rounded" alt="GI"> Genshin Impact
            </a>            
        </div>
       <!-- Tombol Lihat Semua (Aktif) -->
    <a href="{{ route('dashboard') }}" class="block w-full text-center border border-gray-700 hover:border-brand-purple text-gray-400 hover:text-white py-2.5 rounded-xl text-xs font-bold transition mt-4">
        Lihat Semua
    </a>
    </div>

    <!-- 4. Banner Ajak Teman (Dengan Gambar Background) -->
    <div class="mx-4 mt-2 mb-2 p-5 rounded-2xl border border-brand-purple/30 relative overflow-hidden group">
        
        <!-- Gambar Background (Bisa kamu ganti link-nya sesuai selera) -->
        <img src="https://images.unsplash.com/photo-1511512578047-dfb367046420?q=80&w=600&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover z-0 opacity-50 group-hover:scale-110 transition duration-700" alt="Mabar Banner">
        
        <!-- Gradien gelap agar teks tetap terbaca -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#1e1b4b]/95 to-[#312e81]/60 z-0"></div>

        <h4 class="text-white font-bold text-sm mb-2 relative z-10 drop-shadow-md">Ajak Temanmu Mabar!</h4>
        <p class="text-gray-300 text-xs mb-4 relative z-10 leading-relaxed drop-shadow-md">
            Undang teman dan dapatkan <br><strong class="text-white text-sm text-yellow-400">100 Point.</strong>
        </p>
        
        <!-- Tombol Copy Link -->
        <button onclick="navigator.clipboard.writeText(window.location.origin + '/register?ref={{ auth()->id() ?? 0 }}'); alert('🔗 Tautan undangan berhasil disalin! Bagikan ke temanmu untuk dapat 100 Point.');" class="w-full bg-[#4c1d95] hover:bg-brand-purple text-white py-2.5 rounded-lg text-xs font-bold transition relative z-10 shadow-lg shadow-black/40 active:scale-95 border border-brand-purple/50">
            Undang Sekarang
        </button>
    </div>

</aside>
<!-- ================= AKHIR SIDEBAR ================= -->

    <div class="flex-1 flex flex-col h-full">
        
        <header class="h-20 bg-brand-dark flex items-center justify-between px-8 border-b border-gray-800 shrink-0">
            <form action="{{ route('dashboard') }}" method="GET" class="w-96 relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul postingan atau game..." 
                       class="w-full bg-brand-card text-sm text-gray-300 rounded-full py-2.5 pl-5 pr-10 border border-gray-700 focus:outline-none focus:border-brand-purple">
                <button type="submit" class="absolute right-4 top-2.5 text-gray-500 hover:text-brand-accent transition">🔍</button>
            </form>

            <div class="flex items-center gap-6">
                @auth
                    <button class="text-gray-400 hover:text-white">🔔</button>
                    <div class="relative group cursor-pointer flex items-center gap-3">
                        <img src="https://i.pravatar.cc/150?u={{ auth()->user()->id }}" alt="Profile" class="w-10 h-10 rounded-full border-2 border-brand-purple">
                        <span class="text-sm font-medium">{{ auth()->user()->name }} ⬇️</span>
                        
                        <div class="absolute right-0 top-full mt-2 w-48 bg-brand-card border border-gray-800 rounded-xl shadow-lg hidden group-hover:block overflow-hidden z-50">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-3 text-sm text-red-400 hover:bg-gray-800 hover:text-red-300">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium hover:text-brand-accent transition">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-brand-purple hover:bg-brand-purple-hover text-white px-5 py-2.5 rounded-xl text-sm font-bold transition">Daftar Sekarang</a>
                @endauth
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8">
            @yield('content')
        </main>
        
    </div>

</body>
</html>