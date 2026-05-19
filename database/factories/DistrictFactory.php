<?php

namespace Database\Factories;
use App\Models\District;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<District>
 */
class DistrictFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'city_id' => City::inRandomOrder()->first()->id, 
            'name' => fake()->city(), // Mengisi kolom name
        ];
    }
}
