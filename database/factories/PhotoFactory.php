<?php

namespace Database\Factories;

use App\Models\KosPlace;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoFactory extends Factory
{
    public function definition(): array
    {
        return [
            // kos_place_id dan photo_type_id akan ditentukan di Seeder agar lebih rapi
            'kos_place_id' => KosPlace::inRandomOrder()->first()->id,
            'photo_type_id' => fake()->numberBetween(1, 10), 
            'image_url' => 'https://picsum.photos/seed/' . fake()->uuid() . '/800/600', // Gambar random
            'caption' => fake()->sentence(5), // Judul foto
            'is_primary' => false, // Default false[cite: 10]
        ];
    }
}