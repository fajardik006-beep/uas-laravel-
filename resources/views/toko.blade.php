@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto pb-12">
    
    <div class="mb-8 flex items-center gap-4">
        <div class="w-12 h-12 bg-brand-card border border-brand-purple rounded-xl flex items-center justify-center text-2xl shadow-[0_0_15px_rgba(139,92,246,0.2)]">🛍️</div>
        <div>
            <h2 class="text-2xl font-bold text-white">Toko Point Mabar</h2>
            <p class="text-gray-400 text-sm">Tukarkan point hasil mabar kamu dengan berbagai hadiah menarik secara gratis!</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-500/20 border border-green-500/50 text-green-400 px-6 py-4 rounded-xl flex items-center justify-between">
            <span class="font-medium">✅ {{ session('success') }}</span>
            <button onclick="this.parentElement.style.display='none'" class="text-green-400 hover:text-white">✖</button>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 bg-red-500/20 border border-red-500/50 text-red-400 px-6 py-4 rounded-xl flex items-center justify-between">
            <span class="font-medium">❌ {{ session('error') }}</span>
            <button onclick="this.parentElement.style.display='none'" class="text-red-400 hover:text-white">✖</button>
        </div>
    @endif

    <h3 class="text-xl font-bold text-white mb-6 border-l-4 border-brand-purple pl-3">Hadiah Tersedia</h3>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <div class="bg-brand-card rounded-xl border border-gray-800 overflow-hidden hover:border-brand-purple transition duration-300 flex flex-col">
            <div class="h-40 bg-gray-900 flex items-center justify-center text-4xl">💎</div>
            <div class="p-5 flex-1 flex flex-col justify-between">
                <div>
                    <span class="text-[10px] bg-blue-500/10 text-blue-400 border border-blue-500/20 px-2 py-0.5 rounded font-bold uppercase">Mobile Legends</span>
                    <h4 class="text-white font-bold text-lg mt-2">86 Diamonds</h4>
                    <p class="text-gray-500 text-xs mt-1">Stok tersedia: 15 item</p>
                </div>
                <div class="mt-5">
                    <div class="text-yellow-500 font-black text-xl mb-3">250 <span class="text-xs font-normal text-gray-400">Pts</span></div>
                    <form action="#" method="POST" onsubmit="alert('Demo: Redeem Berhasil!'); return false;">
                        <button type="submit" class="w-full bg-brand-purple hover:bg-brand-purple-hover text-white text-xs font-bold py-2.5 rounded-lg transition shadow-lg shadow-brand-purple/20">🛍️ Tukar Poin</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="bg-brand-card rounded-xl border border-gray-800 overflow-hidden hover:border-brand-purple transition duration-300 flex flex-col">
            <div class="h-40 bg-gray-900 flex items-center justify-center text-4xl">💠</div>
            <div class="p-5 flex-1 flex flex-col justify-between">
                <div>
                    <span class="text-[10px] bg-blue-500/10 text-blue-400 border border-blue-500/20 px-2 py-0.5 rounded font-bold uppercase">Free Fire</span>
                    <h4 class="text-white font-bold text-lg mt-2">100 Diamonds</h4>
                    <p class="text-gray-500 text-xs mt-1">Stok tersedia: 15 item</p>
                </div>
                <div class="mt-5">
                    <div class="text-yellow-500 font-black text-xl mb-3">250 <span class="text-xs font-normal text-gray-400">Pts</span></div>
                    <form action="#" method="POST" onsubmit="alert('Demo: Redeem Berhasil!'); return false;">
                        <button type="submit" class="w-full bg-brand-purple hover:bg-brand-purple-hover text-white text-xs font-bold py-2.5 rounded-lg transition shadow-lg shadow-brand-purple/20">🛍️ Tukar Poin</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="bg-brand-card rounded-xl border border-gray-800 overflow-hidden hover:border-brand-purple transition duration-300 flex flex-col">
            <div class="h-40 bg-gray-900 flex items-center justify-center text-4xl">✨</div>
            <div class="p-5 flex-1 flex flex-col justify-between">
                <div>
                    <span class="text-[10px] bg-blue-500/10 text-blue-400 border border-blue-500/20 px-2 py-0.5 rounded font-bold uppercase">genshin impact</span>
                    <h4 class="text-white font-bold text-lg mt-2">300 Genesis Crystals</h4>
                    <p class="text-gray-500 text-xs mt-1">Stok tersedia: 15 item</p>
                </div>
                <div class="mt-5">
                    <div class="text-yellow-500 font-black text-xl mb-3">250 <span class="text-xs font-normal text-gray-400">Pts</span></div>
                    <form action="#" method="POST" onsubmit="alert('Demo: Redeem Berhasil!'); return false;">
                        <button type="submit" class="w-full bg-brand-purple hover:bg-brand-purple-hover text-white text-xs font-bold py-2.5 rounded-lg transition shadow-lg shadow-brand-purple/20">🛍️ Tukar Poin</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="bg-brand-card rounded-xl border border-gray-800 overflow-hidden hover:border-brand-purple transition duration-300 flex flex-col">
            <div class="h-40 bg-gray-900 flex items-center justify-center text-4xl">🎯</div>
            <div class="p-5 flex-1 flex flex-col justify-between">
                <div>
                    <span class="text-[10px] bg-blue-500/10 text-blue-400 border border-blue-500/20 px-2 py-0.5 rounded font-bold uppercase">Pubg Mobile</span>
                    <h4 class="text-white font-bold text-lg mt-2">325 UC</h4>
                    <p class="text-gray-500 text-xs mt-1">Stok tersedia: 15 item</p>
                </div>
                <div class="mt-5">
                    <div class="text-yellow-500 font-black text-xl mb-3">250 <span class="text-xs font-normal text-gray-400">Pts</span></div>
                    <form action="#" method="POST" onsubmit="alert('Demo: Redeem Berhasil!'); return false;">
                        <button type="submit" class="w-full bg-brand-purple hover:bg-brand-purple-hover text-white text-xs font-bold py-2.5 rounded-lg transition shadow-lg shadow-brand-purple/20">🛍️ Tukar Poin</button>
                    </form>
                </div>
            </div>
        </div>


        <div class="bg-brand-card rounded-xl border border-gray-800 overflow-hidden hover:border-brand-purple transition duration-300 flex flex-col">
            <div class="h-40 bg-gray-900 flex items-center justify-center text-4xl">🪙</div>
            <div class="p-5 flex-1 flex flex-col justify-between">
                <div>
                    <span class="text-[10px] bg-red-500/10 text-red-400 border border-red-500/20 px-2 py-0.5 rounded font-bold uppercase">Valorant</span>
                    <h4 class="text-white font-bold text-lg mt-2">125 Points</h4>
                    <p class="text-gray-500 text-xs mt-1">Stok tersedia: 8 item</p>
                </div>
                <div class="mt-5">
                    <div class="text-yellow-500 font-black text-xl mb-3">400 <span class="text-xs font-normal text-gray-400">Pts</span></div>
                    <form action="#" method="POST" onsubmit="alert('Demo: Redeem Berhasil!'); return false;">
                        <button type="submit" class="w-full bg-brand-purple hover:bg-brand-purple-hover text-white text-xs font-bold py-2.5 rounded-lg transition shadow-lg shadow-brand-purple/20">🛍️ Tukar Poin</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="bg-brand-card rounded-xl border border-gray-800 overflow-hidden hover:border-brand-purple transition duration-300 flex flex-col">
            <div class="h-40 bg-gray-900 flex items-center justify-center text-4xl">👕</div>
            <div class="p-5 flex-1 flex flex-col justify-between">
                <div>
                    <span class="text-[10px] bg-yellow-500/10 text-yellow-500 border border-yellow-500/20 px-2 py-0.5 rounded font-bold uppercase">Merchandise</span>
                    <h4 class="text-white font-bold text-lg mt-2">Kaos MABAR.ID Exclusive</h4>
                    <p class="text-gray-500 text-xs mt-1">Stok tersedia: 3 item</p>
                </div>
                <div class="mt-5">
                    <div class="text-yellow-500 font-black text-xl mb-3">1.200 <span class="text-xs font-normal text-gray-400">Pts</span></div>
                    <form action="#" method="POST" onsubmit="alert('Demo: Redeem Berhasil!'); return false;">
                        <button type="submit" class="w-full bg-brand-purple hover:bg-brand-purple-hover text-white text-xs font-bold py-2.5 rounded-lg transition shadow-lg shadow-brand-purple/20">🛍️ Tukar Poin</button>
                    </form>
                </div>
            </div>
        </div>

        @foreach($items as $item)
        <div class="bg-brand-card rounded-xl border border-gray-800 overflow-hidden hover:border-brand-purple transition duration-300 flex flex-col">
            <div class="h-40 bg-gray-900 relative">
                @if($item->gambar_url)
                    <img src="{{ $item->gambar_url }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-3xl bg-gray-950">🎁</div>
                @endif
            </div>
            <div class="p-5 flex-1 flex flex-col justify-between">
                <div>
                    <span class="text-[10px] bg-brand-accent/10 text-brand-accent border border-brand-accent/20 px-2 py-0.5 rounded font-bold uppercase">{{ $item->kategori }}</span>
                    <h4 class="text-white font-bold text-lg mt-2">{{ $item->nama_item }}</h4>
                    <p class="text-gray-500 text-xs mt-1">Stok tersedia: {{ $item->stok }} item</p>
                </div>
                <div class="mt-5">
                    <div class="text-yellow-500 font-black text-xl mb-3">{{ number_format($item->harga_point, 0, ',', '.') }} <span class="text-xs font-normal text-gray-400">Pts</span></div>
                    
                    @if($item->stok > 0)
                        <form action="{{ route('toko.redeem', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-brand-purple hover:bg-brand-purple-hover text-white text-xs font-bold py-2.5 rounded-lg transition shadow-lg shadow-brand-purple/20">🛍️ Tukar Poin</button>
                        </form>
                    @else
                        <button class="w-full bg-gray-800 text-gray-500 text-xs font-bold py-2.5 rounded-lg cursor-not-allowed" disabled>❌ Habis</button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection