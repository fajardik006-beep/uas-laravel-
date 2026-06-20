<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mabar_posts', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel users (siapa yang memposting)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            
            // Info spesifik game
            $table->string('game_name')->default('Mobile Legends'); // Bisa dikembangkan jadi foreign key nanti
            $table->string('rank'); // Contoh: 'Epic IV', 'Platinum II'
            $table->integer('players_needed'); // Contoh: 1, 2
            $table->string('role_needed'); // Contoh: 'Roamer, Jungler'
            
            // Konten postingan
            $table->string('title');
            $table->text('description');
            
            // Status mabar (apakah masih mencari atau sudah penuh)
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mabar_posts');
    }
};