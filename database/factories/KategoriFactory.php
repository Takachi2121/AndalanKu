<?php

namespace Database\Factories;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kategori::class>
 */
class KategoriFactory extends Factory
{
    protected $model = Kategori::class;
    public function definition(): array
    {
        return [
            'nama_kategori' => $this->faker->word,
            'icon_kategori' => $this->faker->word,
            'thumbnail' => $this->faker->imageUrl(640, 480, 'products'),
        ];
    }
}
