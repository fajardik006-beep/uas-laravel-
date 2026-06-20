<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MabarPost extends Model
{
    use HasFactory;

    // Mengizinkan kolom-kolom ini diisi data
   protected $fillable = [
        'user_id',
        'game_name',
        'rank',
        'players_needed',
        'role_needed',
        'title',
        'description',
        'contact_link', 
        'is_active',
    ];

    // Relasi: Satu postingan dimiliki oleh satu User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}