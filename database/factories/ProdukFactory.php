<?php

namespace Database\Factories;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    protected $model = Produk::class;
    public function definition(): array
    {
        return [
            'nama_produk' => $this->faker->word,
            'deskripsi' => $this->faker->sentence,
            'kategori_id' => Kategori::factory(),
            'harga' => $this->faker->numberBetween(10000, 100000),
            'gambar' => $this->faker->imageUrl(640, 480, 'products'),
        ];
    }
}
