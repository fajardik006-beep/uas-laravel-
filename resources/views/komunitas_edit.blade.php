@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto pb-12">
    <h2 class="text-2xl font-bold text-white mb-6">✏️ Edit Squad</h2>

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
        
        <form action="{{ route('komunitas.update', $komunitas->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT') 

            <div>
                <label class="block text-gray-400 text-xs font-medium mb-1">Nama Squad / Tim</label>
                <input type="text" name="nama_squad" value="{{ old('nama_squad', $komunitas->nama_squad) }}" required placeholder="Cth: EVOS Legends" class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">
            </div>

            <div>
                <label class="block text-gray-400 text-xs font-medium mb-1">Fokus Game</label>
                <select name="game_name" required class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">
                    <option value="Mobile Legends" {{ old('game_name', $komunitas->game_name) == 'Mobile Legends' ? 'selected' : '' }}>Mobile Legends</option>
                    <option value="Valorant" {{ old('game_name', $komunitas->game_name) == 'Valorant' ? 'selected' : '' }}>Valorant</option>
                    <option value="PUBG Mobile" {{ old('game_name', $komunitas->game_name) == 'PUBG Mobile' ? 'selected' : '' }}>PUBG Mobile</option>
                    <option value="Free Fire" {{ old('game_name', $komunitas->game_name) == 'Free Fire' ? 'selected' : '' }}>Free Fire</option>
                    <option value="Genshin Impact" {{ old('game_name', $komunitas->game_name) == 'Genshin Impact' ? 'selected' : '' }}>Genshin Impact</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-400 text-xs font-medium mb-1">Link Grup (WA / Discord)</label>
                <input type="url" name="link_grup" value="{{ old('link_grup', $komunitas->link_grup) }}" required placeholder="https://chat.whatsapp.com/..." class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">
            </div>

            <div>
                <label class="block text-gray-400 text-xs font-medium mb-1">Deskripsi & Syarat Rekrutmen</label>
                <textarea name="deskripsi" required rows="4" placeholder="Cth: Minimal Rank Mythic..." class="w-full bg-brand-dark text-white rounded-lg px-4 py-2.5 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm">{{ old('deskripsi', $komunitas->deskripsi) }}</textarea>
            </div>
            
            <div class="mt-8 flex gap-3 pt-4 border-t border-gray-800">
                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-2.5 rounded-lg font-bold transition shadow-lg shadow-blue-600/20">
                    💾 Simpan Perubahan
                </button>
                <a href="{{ route('komunitas') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-2.5 rounded-lg font-bold transition">
                    Batal
                </a>
            </div>
        </form>
        
    </div>
</div>
@endsection