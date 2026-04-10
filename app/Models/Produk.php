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

    protected $with = ['kategori'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function scopeRekomendasi($query, $produk)
    {
        return $query->where('kategori_id', $produk->kategori_id)
                     ->where('id', '!=', $produk->id)
                     ->latest();
    }
}
