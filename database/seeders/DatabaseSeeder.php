<?php

namespace Database\Seeders;

use App\Models\MabarPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat 10 postingan mabar acak secara otomatis
        MabarPost::factory(10)->create();
    }
}