<?php

// app/Models/Locataire.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 use Illuminate\Notifications\Notifiable;



class Locataire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'appartement',
        'etage',
        'actif',
        'photo',
        'password',
    ];

    protected $casts = [
        'actif' => 'boolean',
    ];

    public function visites()
    {
        return $this->hasMany(Visite::class);
    }

    public function getNomCompletAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }

    public function getAdresseCompleteAttribute()
    {
        return 'Appartement ' . $this->appartement . 
               ($this->etage ? ' - Étage ' . $this->etage : '');
    }

      use Notifiable; // <= AJOUTE cette ligne
}



