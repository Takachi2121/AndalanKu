<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Kategori extends Model
{
    use Notifiable, HasFactory;

    protected $fillable = [
        'nama_kategori',
        'thumbnail',
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
}
