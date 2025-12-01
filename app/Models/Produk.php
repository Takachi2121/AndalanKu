<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Produk extends Model
{
    use Notifiable, HasFactory;

    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'kategori_id',
        'harga',
        'gambar',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
