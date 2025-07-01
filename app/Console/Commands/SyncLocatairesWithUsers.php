<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncLocatairesWithUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-locataires-with-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
   public function handle()
{
    $this->info("Synchronisation des locataires avec la table users...");

    \App\Models\Locataire::all()->each(function($loc) {
        if (!\App\Models\User::where('email', $loc->email)->exists()) {
            \App\Models\User::create([
                'name' => $loc->nom,
                'email' => $loc->email,
                'password' => \Illuminate\Support\Facades\Hash::make('motdepassepardefaut'),
                'type' => 'locataire',
            ]);
        }
    });

    $this->info("Synchronisation terminée !");
}

}