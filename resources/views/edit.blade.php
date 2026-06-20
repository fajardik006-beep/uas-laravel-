@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('dashboard') }}" class="w-10 h-10 bg-brand-card border border-gray-800 rounded-xl flex items-center justify-center text-gray-400 hover:text-white hover:border-brand-purple transition">
            ⬅️
        </a>
        <div>
            <h2 class="text-2xl font-bold text-white">Edit Posting Mabar</h2>
            <p class="text-gray-400 text-sm">Ada yang salah ketik? Perbaiki di sini.</p>
        </div>
    </div>

    <div class="bg-brand-card rounded-2xl border border-gray-800 p-8">
        <form action="{{ route('posting.update', $post->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-white text-sm font-medium mb-2">Game 🎮</label>
                    <select name="game_name" class="w-full bg-brand-dark text-gray-300 rounded-xl px-4 py-3 border border-gray-700 focus:outline-none focus:border-brand-purple">
                        <option value="Mobile Legends" {{ $post->game_name == 'Mobile Legends' ? 'selected' : '' }}>Mobile Legends</option>
                        <option value="Valorant" {{ $post->game_name == 'Valorant' ? 'selected' : '' }}>Valorant</option>
                        <option value="PUBG Mobile" {{ $post->game_name == 'PUBG Mobile' ? 'selected' : '' }}>PUBG Mobile</option>
                        <option value="Free Fire" {{ $post->game_name == 'Free Fire' ? 'selected' : '' }}>Free Fire</option>
                    </select>
                </div>
                <div>
                    <label class="block text-white text-sm font-medium mb-2">Rank Kamu Saat Ini 🏆</label>
                    <input type="text" name="rank" value="{{ $post->rank }}" class="w-full bg-brand-dark text-gray-300 rounded-xl px-4 py-3 border border-gray-700 focus:outline-none focus:border-brand-purple">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-white text-sm font-medium mb-2">Role yang Dibutuhkan 🎭</label>
                    <input type="text" name="role_needed" value="{{ $post->role_needed }}" class="w-full bg-brand-dark text-gray-300 rounded-xl px-4 py-3 border border-gray-700 focus:outline-none focus:border-brand-purple">
                </div>
                <div>
                    <label class="block text-white text-sm font-medium mb-2">Butuh Berapa Orang? 👥</label>
                    <input type="number" name="players_needed" min="1" max="4" value="{{ $post->players_needed }}" class="w-full bg-brand-dark text-gray-300 rounded-xl px-4 py-3 border border-gray-700 focus:outline-none focus:border-brand-purple">
                </div>
            </div>

            <div>
                <label class="block text-white text-sm font-medium mb-2">Judul Mabar 📢</label>
                <input type="text" name="title" value="{{ $post->title }}" class="w-full bg-brand-dark text-gray-300 rounded-xl px-4 py-3 border border-gray-700 focus:outline-none focus:border-brand-purple">
            </div>

            <div>
                <label class="block text-white text-sm font-medium mb-2">Link Room (Discord/WA) atau ID Game 🔗</label>
                <input type="text" name="contact_link" value="{{ $post->contact_link }}" class="w-full bg-brand-dark text-gray-300 rounded-xl px-4 py-3 border border-gray-700 focus:outline-none focus:border-brand-purple">
            </div>

            <div>
                <label class="block text-white text-sm font-medium mb-2">Deskripsi / Aturan Main 📝</label>
                <textarea name="description" rows="4" class="w-full bg-brand-dark text-gray-300 rounded-xl px-4 py-3 border border-gray-700 focus:outline-none focus:border-brand-purple resize-none">{{ $post->description }}</textarea>
            </div>

            <div class="pt-4 flex justify-end gap-4">
                <a href="{{ route('dashboard') }}" class="bg-gray-800 hover:bg-gray-700 text-white px-8 py-3 rounded-xl font-bold transition">
                    Batal
                </a>
                <button type="submit" class="bg-brand-purple hover:bg-brand-purple-hover text-white px-8 py-3 rounded-xl font-bold transition shadow-lg shadow-brand-purple/20">
                    💾 Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection