<?php

namespace Database\Factories;

use App\Models\Bank;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Bank>
 */
class BankFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'bank_name' => fake()->randomElement(['Bank Central Asia', 'Bank Mandiri', 'BNI']),
            'bank_code' => fake()->unique()->swiftCode(),
        ];
    }
}
