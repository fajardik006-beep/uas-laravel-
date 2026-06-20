@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto flex flex-col items-center justify-center min-h-[60vh] text-center">
    
    <!-- Animasi Sederhana -->
    <div class="w-32 h-32 bg-brand-card border border-brand-purple rounded-3xl flex items-center justify-center text-6xl mb-8 shadow-[0_0_50px_rgba(139,92,246,0.3)] animate-pulse">
        {{ $icon }}
    </div>

    <!-- Teks Utama -->
    <h1 class="text-4xl font-bold text-white mb-4">Fitur <span class="text-brand-accent">{{ $title }}</span></h1>
    <p class="text-gray-400 text-lg mb-8 max-w-lg">
        Sabar ya, kapten! Fitur ini sedang dikembangkan oleh tim developer kami dan akan segera hadir di update MABAR.ID selanjutnya.
    </p>

    <!-- Tombol Kembali -->
    <a href="{{ route('dashboard') }}" class="bg-brand-purple hover:bg-brand-purple-hover text-white px-8 py-3 rounded-xl font-bold transition flex items-center gap-2 shadow-lg shadow-brand-purple/20">
        ⬅️ Kembali ke Beranda
    </a>

</div>
@endsection