<?php
// database/migrations/xxxx_create_visites_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('visites', function (Blueprint $table) {
            $table->id();
            $table->string('visiteur_nom');
            $table->string('visiteur_prenom');
            $table->string('visiteur_telephone')->nullable();
            $table->string('visiteur_piece_identite')->nullable(); // Type de pièce d'identité
            $table->string('visiteur_numero_piece')->nullable();
            $table->text('motif_visite')->nullable();
            $table->datetime('heure_entree');
            $table->datetime('heure_sortie')->nullable();
            $table->string('statut')->default('en_cours'); // en_cours, terminee
            $table->foreignId('locataire_id')->constrained('locataires');
            $table->foreignId('gardien_id')->constrained('users');
            $table->text('observations')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visites');
    }
};