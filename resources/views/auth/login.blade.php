@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 pb-12">
    <div class="bg-brand-card rounded-xl border border-gray-800 p-8 shadow-2xl relative overflow-hidden">
        
        <!-- Efek Cahaya di Belakang -->
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-brand-purple/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="text-center mb-8 relative z-10">
            <span class="text-5xl block mb-4">🎮</span>
            <h2 class="text-2xl font-bold text-white">Welcome Back!</h2>
            <p class="text-gray-400 text-sm mt-1">Login untuk mulai mabar, kumpulkan point, dan raih rank tertinggi.</p>
        </div>

        <!-- Notifikasi Error Jika Password Salah -->
        @if ($errors->any())
            <div class="mb-6 bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-lg text-sm text-center">
                ⚠️ Email atau password tidak sesuai.
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5 relative z-10">
            @csrf
            <div>
                <label class="block text-gray-400 text-xs font-medium mb-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="player@mabar.id" class="w-full bg-brand-dark text-white rounded-lg px-4 py-3 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm transition">
            </div>

            <div>
                <label class="block text-gray-400 text-xs font-medium mb-1">Password</label>
                <input type="password" name="password" required placeholder="••••••••" class="w-full bg-brand-dark text-white rounded-lg px-4 py-3 border border-gray-700 focus:outline-none focus:border-brand-purple text-sm transition">
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center text-xs text-gray-400 cursor-pointer hover:text-gray-300">
                    <input type="checkbox" name="remember" class="mr-2 rounded border-gray-700 bg-brand-dark text-brand-purple focus:ring-brand-purple">
                    Remember me
                </label>
            </div>

            <button type="submit" class="w-full bg-brand-purple hover:bg-brand-purple-hover text-white px-4 py-3 rounded-lg font-bold transition shadow-lg shadow-brand-purple/20 mt-2">
                🚀 Login Sekarang
            </button>
        </form>

        <div class="mt-8 text-center text-xs text-gray-500 relative z-10 border-t border-gray-800 pt-5">
            Belum tergabung di MABAR.ID? <br>
            <a href="{{ route('register') }}" class="text-brand-accent font-bold hover:underline mt-1 inline-block">Daftar Akun Baru</a>
        </div>
    </div>
</div>
@endsection