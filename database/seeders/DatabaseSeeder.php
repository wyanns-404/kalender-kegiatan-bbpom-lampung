<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Wayan Santie Arif',
            'email' => 'wayan@example.com',
            'password' => bcrypt('11111111'),
            'email_verified_at' => now(),
        ]);
    }
}
