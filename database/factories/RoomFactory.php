<?php

namespace Database\Factories;

use App\Models\KosPlace;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Mengambil ID dari kos_places yang sudah ada
            'kos_place_id' => KosPlace::inRandomOrder()->first()->id,
            
            // Mengisi nomor kamar (misal: A1, B2, 101)
            'room_number' => fake()->bothify('Kamar ##??'), 
            
            // Status ketersediaan kamar
            'is_available' => fake()->boolean(80), // 80% kemungkinan tersedia
            
            // Harga khusus (opsional), bisa null atau harga tertentu[cite: 8]
            'price_custom' => fake()->optional(0.3)->numberBetween(600000, 2000000), 
            
            // Deskripsi tambahan mengenai kamar[cite: 8]
            'description' => fake()->sentence(10),
        ];
    }
}