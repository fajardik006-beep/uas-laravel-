<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('toko_points', function (Blueprint $table) {
            $table->id();
            $table->string('nama_item');
            $table->string('kategori'); // Cth: Diamond, Skin, Merchandise
            $table->integer('harga_point'); // Jumlah point yang dibutuhkan
            $table->integer('stok')->default(10);
            $table->string('gambar_url')->nullable(); // Link gambar item hadiah
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('toko_points');
    }
};