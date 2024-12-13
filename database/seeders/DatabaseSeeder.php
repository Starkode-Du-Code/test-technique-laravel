<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,         // Seeder pour les utilisateurs aléatoires
            AdminAndUserSeeder::class, // Seeder pour l'administrateur et l'utilisateur spécifique
        ]);
    }
}
