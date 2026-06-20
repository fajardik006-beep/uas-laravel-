<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Penulis Artikel
            $table->string('judul');
            $table->string('kategori'); // Cth: Berita, Tips & Trik, Review
            $table->text('konten'); // Isi artikel
            $table->string('gambar_url')->nullable(); // Link gambar dari internet (opsional)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artikels');
    }
};