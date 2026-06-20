<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komunitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_squad',
        'game_name',
        'deskripsi',
        'link_grup', // INI WAJIB ADA BIAR BISA DI-SAVE
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}