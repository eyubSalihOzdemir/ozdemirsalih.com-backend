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
        // Check if admin user already exists
        $adminUser = User::where('email', 'eyubsalih.ozdemir@gmail.com')->first();

        if (!$adminUser) {
            // Create admin user
            $adminUser = User::create([
                'name' => 'Salih Ozdemir',
                'email' => 'eyubsalih.ozdemir@gmail.com',
                'password' => Hash::make('Kasa_2_mana'),
                'email_verified_at' => now(),
            ]);

            // Generate and assign API token using Sanctum
            $token = $adminUser->createToken('admin-token')->plainTextToken;
            // $adminUser->api_token = $token;
            $adminUser->save();

            $this->command->info("API token for admin user: $token");
        } else {
            $this->command->info("There is already an admin user.");
        }
    }
}
