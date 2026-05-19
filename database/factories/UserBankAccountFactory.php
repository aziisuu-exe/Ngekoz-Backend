<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Bank;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserBankAccountFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Mengambil user_id secara acak dari tabel users yang sudah ada
            'user_id' => User::inRandomOrder()->first()->id,
            
            // Mengambil bank_id secara acak dari tabel banks yang sudah ada
            'bank_id' => Bank::inRandomOrder()->first()->id,
            
            // Mengisi nomor rekening random[cite: 6]
            'account_number' => fake()->unique()->bankAccountNumber(),
            
            // Mengisi nama pemilik rekening[cite: 6]
            'account_holder_name' => fake()->name(),
        ];
    }
}