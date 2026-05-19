<?php

namespace Database\Factories;

use App\Models\Owner;
use App\Models\District;
use Illuminate\Database\Eloquent\Factories\Factory;

class KosPlaceFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Mengambil ID dari data yang sudah ada
            'owner_id' => Owner::inRandomOrder()->first()->id,
            'district_id' => District::inRandomOrder()->first()->id,
            
            // Mengisi data identitas kos
            'name' => 'Kos ' . fake()->firstName() . ' ' . fake()->city(),
            'address' => fake()->address(),
            'type' => fake()->randomElement(['Putra', 'Putri', 'Campur']), // Contoh kategori
            'price_start_from' => fake()->numberBetween(500000, 2500000), // Range harga[cite: 7]
            
            // Data tambahan[cite: 7]
            'description' => fake()->paragraph(),
            'rules' => fake()->sentence(),
            'latitude' => fake()->latitude(-7.7, -7.5), // Contoh koordinat area tertentu
            'longitude' => fake()->longitude(110.3, 110.5),
            'rating_avg' => fake()->randomFloat(1, 3, 5), // Rating antara 3.0 - 5.0[cite: 7]
            'is_verified' => fake()->boolean(70), // 70% peluang terverifikasi[cite: 7]
        ];
    }
}