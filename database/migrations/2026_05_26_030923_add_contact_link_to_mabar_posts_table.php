<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('mabar_posts', function (Blueprint $table) {
            // Menambahkan kolom contact_link setelah kolom description
            $table->string('contact_link')->nullable()->after('description');
        });
    }

    public function down()
    {
        Schema::table('mabar_posts', function (Blueprint $table) {
            $table->dropColumn('contact_link');
        });
    }
};