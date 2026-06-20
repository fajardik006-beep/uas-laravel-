<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('turnamens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Penyelenggara
            $table->string('nama_turnamen');
            $table->string('game_name');
            $table->string('hadiah'); // Contoh: "Rp 5.000.000" atau "10.000 Diamond"
            $table->date('tanggal_pelaksanaan');
            $table->text('deskripsi');
            $table->string('link_daftar')->nullable(); // Link gform atau web lain
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('turnamens');
    }
};