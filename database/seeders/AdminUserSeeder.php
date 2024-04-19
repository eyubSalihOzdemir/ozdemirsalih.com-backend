<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Salih Ozdemir',
            'email' => 'eyubsalihozdemir@gmail.com',
            'password' => Hash::make('Kasa_2_mana'),
            'email_verified_at' => now(),
            //'api_token' => null, // initially
        ]);
    }
}
