<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserDemoSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Membuat Akun Khusus Admin
        User::updateOrCreate(
            ['email' => 'admin@mabar.id'],
            [
                'name' => 'Admin MABAR.ID',
                'password' => Hash::make('password123'),
                'role' => 'admin'
            ]
        );

        // 2. Membuat Akun Khusus User Publik umum
        User::updateOrCreate(
            ['email' => 'player@mabar.id'],
            [
                'name' => 'Gamer Publik',
                'password' => Hash::make('password123'),
                'role' => 'user'
            ]
        );
    }
}