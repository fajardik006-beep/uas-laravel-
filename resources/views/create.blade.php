@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('dashboard') }}" class="w-10 h-10 bg-brand-card border border-gray-800 rounded-xl flex items-center justify-center text-gray-400 hover:text-white hover:border-brand-purple transition">
            ⬅️
        </a>
        <div>
            <h2 class="text-2xl font-bold text-white">Buat Posting Mabar</h2>
            <p class="text-gray-400 text-sm">Cari teman main yang pas untuk push rank hari ini.</p>
        </div>
    </div>

    <div class="bg-brand-card rounded-2xl border border-gray-800 p-8">
        <form action="{{ route('posting.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-white text-sm font-medium mb-2">Game 🎮</label>
                    <select name="game_name" class="w-full bg-brand-dark text-gray-300 rounded-xl px-4 py-3 border border-gray-700 focus:outline-none focus:border-brand-purple">
                        <option value="Mobile Legends" {{ old('game_name') == 'Mobile Legends' ? 'selected' : '' }}>Mobile Legends</option>
                        <option value="Valorant" {{ old('game_name') == 'Valorant' ? 'selected' : '' }}>Valorant</option>
                        <option value="PUBG Mobile" {{ old('game_name') == 'PUBG Mobile' ? 'selected' : '' }}>PUBG Mobile</option>
                        <option value="Free Fire" {{ old('game_name') == 'Free Fire' ? 'selected' : '' }}>Free Fire</option>
                    </select>
                    @error('game_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-white text-sm font-medium mb-2">Rank Kamu Saat Ini 🏆</label>
                    <input type="text" name="rank" value="{{ old('rank') }}" placeholder="Contoh: Epic IV, Platinum II" class="w-full bg-brand-dark text-gray-300 rounded-xl px-4 py-3 border @error('rank') border-red-500 @else border-gray-700 @enderror focus:outline-none focus:border-brand-purple">
                    @error('rank') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-white text-sm font-medium mb-2">Role yang Dibutuhkan 🎭</label>
                    <input type="text" name="role_needed" value="{{ old('role_needed') }}" placeholder="Contoh: Roamer, Jungler, Controller" class="w-full bg-brand-dark text-gray-300 rounded-xl px-4 py-3 border @error('role_needed') border-red-500 @else border-gray-700 @enderror focus:outline-none focus:border-brand-purple">
                    @error('role_needed') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-white text-sm font-medium mb-2">Butuh Berapa Orang? 👥</label>
                    <input type="number" name="players_needed" min="1" max="4" value="{{ old('players_needed') }}" class="w-full bg-brand-dark text-gray-300 rounded-xl px-4 py-3 border @error('players_needed') border-red-500 @else border-gray-700 @enderror focus:outline-none focus:border-brand-purple">
                    @error('players_needed') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-white text-sm font-medium mb-2">Judul Mabar 📢</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Contoh: Push rank ke Mythic malam ini, no toxic!" class="w-full bg-brand-dark text-gray-300 rounded-xl px-4 py-3 border @error('title') border-red-500 @else border-gray-700 @enderror focus:outline-none focus:border-brand-purple">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-white text-sm font-medium mb-2">Link Room (Discord/WA) atau ID Game 🔗 (Opsional)</label>
                <input type="text" name="contact_link" value="{{ old('contact_link') }}" placeholder="Contoh: https://discord.gg/... atau ID: 123456" class="w-full bg-brand-dark text-gray-300 rounded-xl px-4 py-3 border @error('contact_link') border-red-500 @else border-gray-700 @enderror focus:outline-none focus:border-brand-purple">
                @error('contact_link') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-white text-sm font-medium mb-2">Deskripsi / Aturan Main 📝</label>
                <textarea name="description" rows="4" placeholder="Tuliskan syarat spesifik, jam main, atau link discord jika ada..." class="w-full bg-brand-dark text-gray-300 rounded-xl px-4 py-3 border @error('description') border-red-500 @else border-gray-700 @enderror focus:outline-none focus:border-brand-purple resize-none">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="pt-4 flex justify-end gap-4">
                <a href="{{ route('dashboard') }}" class="bg-gray-800 hover:bg-gray-700 text-white px-8 py-3 rounded-xl font-bold transition">
                    Batal
                </a>
                <button type="submit" class="bg-brand-purple hover:bg-brand-purple-hover text-white px-8 py-3 rounded-xl font-bold transition shadow-lg shadow-brand-purple/20">
                    🚀 Posting Sekarang
                </button>
            </div>
        </form>
    </div>
</div>
@endsection