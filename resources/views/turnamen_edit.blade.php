@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto pb-12">
    <h2 class="text-2xl font-bold text-white mb-6">✏️ Edit Turnamen</h2>

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

    <div class="bg-brand-card p-6 rounded-xl border border-gray-800 shadow-xl">
        
        <form action="{{ route('turnamen.update', $turnamen->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT') 

            <div>
                <label class="block text-gray-400 text-xs font-medium mb-1">Nama Turnamen</label>
                <input type="text" name="nama_turnamen" value="{{ old('nama_turnamen', $turnamen->nama_turnamen) }}" required class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">
            </div>

            <div>
                <label class="block text-gray-400 text-xs font-medium mb-1">Game</label>
                <select name="game_name" required class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">
                    <option value="Mobile Legends" {{ old('game_name', $turnamen->game_name) == 'Mobile Legends' ? 'selected' : '' }}>Mobile Legends</option>
                    <option value="Valorant" {{ old('game_name', $turnamen->game_name) == 'Valorant' ? 'selected' : '' }}>Valorant</option>
                    <option value="PUBG Mobile" {{ old('game_name', $turnamen->game_name) == 'PUBG Mobile' ? 'selected' : '' }}>PUBG Mobile</option>
                    <option value="Free Fire" {{ old('game_name', $turnamen->game_name) == 'Free Fire' ? 'selected' : '' }}>Free Fire</option>
                    <option value="Genshin Impact" {{ old('game_name', $turnamen->game_name) == 'Genshin Impact' ? 'selected' : '' }}>Genshin Impact</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-400 text-xs font-medium mb-1">Prize Pool / Hadiah</label>
                <input type="text" name="hadiah" value="{{ old('hadiah', $turnamen->hadiah) }}" required class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">
            </div>

            <div>
                <label class="block text-gray-400 text-xs font-medium mb-1">Tanggal Pelaksanaan</label>
                <input type="date" name="tanggal_pelaksanaan" value="{{ old('tanggal_pelaksanaan', \Carbon\Carbon::parse($turnamen->tanggal_pelaksanaan)->format('Y-m-d')) }}" required class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">
            </div>

            <div>
                <label class="block text-gray-400 text-xs font-medium mb-1">Deskripsi & Syarat</label>
                <textarea name="deskripsi" required rows="4" class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">{{ old('deskripsi', $turnamen->deskripsi) }}</textarea>
            </div>

            <div>
                <label class="block text-gray-400 text-xs font-medium mb-1">Link Pendaftaran (Opsional)</label>
                <input type="url" name="link_daftar" value="{{ old('link_daftar', $turnamen->link_daftar) }}" class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">
            </div>

            <div class="mt-8 flex gap-3 pt-4 border-t border-gray-800">
                <button type="submit" class="bg-yellow-600 hover:bg-yellow-500 text-white px-6 py-2.5 rounded-lg font-bold transition shadow-lg shadow-yellow-600/20">
                    💾 Simpan Perubahan
                </button>
                <a href="{{ route('turnamen') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-2.5 rounded-lg font-bold transition">
                    Batal
                </a>
            </div>
        </form>
        
    </div>
</div>
@endsection