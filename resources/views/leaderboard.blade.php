@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto pb-12">
    
    <div class="mb-8 flex items-center gap-4">
        <div class="w-12 h-12 bg-brand-card border border-brand-purple rounded-xl flex items-center justify-center text-2xl shadow-[0_0_15px_rgba(139,92,246,0.2)]">📊</div>
        <div>
            <h2 class="text-2xl font-bold text-white">Global Leaderboard</h2>
            <p class="text-gray-400 text-sm">Papan peringkat player terbaik berdasarkan koleksi point MABAR.ID.</p>
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
        
        <div class="lg:col-span-2 space-y-3">
            <h3 class="text-xl font-bold text-white mb-4 border-l-4 border-brand-purple pl-3">Top Global Players</h3>
            
            @forelse($leaderboards as $board)
            <div class="bg-brand-card rounded-xl border {{ $loop->iteration <= 3 ? 'border-yellow-600/50 shadow-[0_0_15px_rgba(202,138,4,0.15)]' : 'border-gray-800' }} p-4 hover:border-brand-purple transition duration-300 flex items-center gap-5">
                
                <div class="w-12 text-center">
                    @if($loop->iteration == 1)
                        <span class="text-4xl drop-shadow-lg">🥇</span>
                    @elseif($loop->iteration == 2)
                        <span class="text-4xl drop-shadow-lg">🥈</span>
                    @elseif($loop->iteration == 3)
                        <span class="text-4xl drop-shadow-lg">🥉</span>
                    @else
                        <span class="text-2xl font-bold text-gray-500">#{{ $loop->iteration }}</span>
                    @endif
                </div>

                <div class="flex-1">
                    <h4 class="text-white font-bold text-lg flex items-center gap-2">
                        {{ $board->in_game_nickname }}
                        <span class="text-[10px] bg-brand-dark px-2 py-0.5 rounded border border-gray-700 text-gray-400 font-normal">
                            {{ $board->user->name ?? 'Unknown' }}
                        </span>
                    </h4>
                    <div class="flex items-center gap-3 text-xs text-gray-400 mt-1">
                        <span class="text-brand-accent bg-brand-accent/10 px-2 py-0.5 rounded">{{ $board->game_name }}</span>
                        <span>Role: {{ $board->role_andalan }}</span>
                        <span>WR: {{ $board->win_rate ?? '0%' }}</span>
                    </div>
                </div>

                <div class="text-right">
                    <p class="text-2xl font-black text-yellow-500 drop-shadow-md">{{ number_format($board->points, 0, ',', '.') }}</p>
                    <p class="text-[10px] text-gray-500 uppercase tracking-widest">Points</p>
                </div>

                <!-- TAMBAHAN: TOMBOL ACTION KHUSUS ADMIN DI SINI -->
                @if(auth()->check() && auth()->user()->isAdmin())
                <div class="border-l border-gray-700 pl-4 ml-2 flex flex-col gap-2">
                    <form action="{{ route('leaderboard.destroy', $board->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menendang player ini dari Leaderboard?')" class="text-xs bg-red-600/20 text-red-500 px-2 py-1 rounded hover:bg-red-600 hover:text-white transition w-full text-center">
                            Hapus
                        </button>
                    </form>
                </div>
                @endif

            </div>
            @empty
            <div class="bg-brand-card rounded-xl border border-gray-800 p-10 text-center flex flex-col items-center">
                <span class="text-4xl mb-3">🏅</span>
                <p class="text-gray-300 font-bold mb-1">Leaderboard masih kosong.</p>
                <p class="text-gray-500 text-sm">Jadilah penguasa peringkat pertama sekarang!</p>
            </div>
            @endforelse
        </div>

        @if(auth()->check() && auth()->user()->isAdmin())
        <div>
            <div class="bg-brand-card rounded-xl border border-gray-800 p-6 shadow-xl h-fit">
                <h3 class="text-lg font-bold text-white mb-1">📈 Masuk Ranking (Admin Only)</h3>
                <p class="text-xs text-gray-400 mb-6">Daftarkan statistik akunmu untuk bersaing di papan peringkat.</p>
                
                <form action="{{ route('leaderboard.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-gray-400 text-xs font-medium mb-1">Game</label>
                        <select name="game_name" required class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">
                            <option value="Mobile Legends">Mobile Legends</option>
                            <option value="Valorant">Valorant</option>
                            <option value="PUBG Mobile">PUBG Mobile</option>
                            <option value="Free Fire">Free Fire</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-400 text-xs font-medium mb-1">In-Game Nickname</label>
                        <input type="text" name="in_game_nickname" required placeholder="Cth: RRQ Lemon" class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">
                    </div>
                    <div>
                        <label class="block text-gray-400 text-xs font-medium mb-1">Role Andalan</label>
                        <input type="text" name="role_andalan" required placeholder="Cth: Mage / Duelist" class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-400 text-xs font-medium mb-1">Total Point</label>
                            <input type="number" name="points" required placeholder="Cth: 1500" class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">
                        </div>
                        <div>
                            <label class="block text-gray-400 text-xs font-medium mb-1">Win Rate</label>
                            <input type="text" name="win_rate" placeholder="Cth: 75%" class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white px-4 py-3 rounded-lg font-bold transition mt-6 shadow-lg shadow-blue-600/20">
                        🚀 Submit Statistik
                    </button>
                </form>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection