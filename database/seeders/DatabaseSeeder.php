<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear 5 usuarios con ideas asociadas
        \App\Models\User::factory(5)->create()->each(function ($user) {
            \App\Models\Idea::factory(3)->create(['user_id' => $user->id]);
        });
    }
}
