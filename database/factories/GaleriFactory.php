<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Galeri>
 */
class GaleriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'caption' => $this->faker->sentence(),
            'thumbnail' => $this->faker->imageUrl(),
            'dokumentasi' => $this->faker->imageUrl(),
            'rancangan' => $this->faker->imageUrl(),
        ];
    }
}
