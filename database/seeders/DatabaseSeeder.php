<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'email' => 'test@example.com',
            'password' => 'admin',
            'role' => 'admin',
        ]);
        \App\Models\User::factory(14)->create();
    }
}
