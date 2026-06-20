<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turnamen extends Model
{
    use HasFactory;

    protected $guarded = []; // Buka gembok keamanan

    // Relasi ke User (Penyelenggara)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}