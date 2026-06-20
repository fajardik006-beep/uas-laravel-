<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // 1. TAMBAHKAN 'role' DI SINI AGAR BISA DISIMPAN KE DATABASE
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', 
        'poin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // 2. PASTIKAN FUNGSI CEK ADMIN INI TETAP ADA DI BAWAH
    public function isAdmin()
{
    // Menggunakan tiga sama dengan (===) agar pengecekannya mutlak dan ketat
    return $this->role === 'admin';
}
}