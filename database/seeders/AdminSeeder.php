<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     public function run()
{
    \App\Models\User::updateOrCreate(
        ['email' => 'admin@neostart.com'],
        [
            'nom_utilisateur' => 'Admin Principal',
            'nom' => 'Admin',
            'prenom' => 'Principal',
            'password' => Hash::make('admin1234'),
            'type' => 'admin',
            'actif' => 1,
        ]
    );
}

}
