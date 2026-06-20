<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('komunitas', function (Blueprint $table) {
        // Menambah kolom link_grup setelah kolom deskripsi
        $table->string('link_grup')->nullable()->after('deskripsi');
    });
}

public function down()
{
    Schema::table('komunitas', function (Blueprint $table) {
        $table->dropColumn('link_grup');
    });
}
};
