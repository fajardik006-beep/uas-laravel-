<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leaderboards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pemilik Akun
            $table->string('game_name');
            $table->string('in_game_nickname');
            $table->string('role_andalan'); // Cth: Jungler, Sniper, dll
            $table->integer('points'); // Jumlah point untuk menentukan ranking
            $table->string('win_rate')->nullable(); // Cth: 75.5%
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leaderboards');
    }
};