<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Création manuelle de l'utilisateur Pascaline
        User::create([
            'nom_utilisateur' => 'pascaline',
            'nom' => 'ADENYO',
            'prenom' => 'Pascaline',
            'telephone' => '70680199',
            'email' => 'pascaline@gmail.com',
            'password' => Hash::make('1234'),
        ]);
    }
}
