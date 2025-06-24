<?php
// app/Models/Visite.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visite extends Model
{
    use HasFactory;

    protected $fillable = [
        'visiteur_nom',
        'visiteur_prenom',
        'visiteur_telephone',
        'visiteur_piece_identite',
        'visiteur_numero_piece',
        'motif_visite',
        'heure_entree',
        'heure_sortie',
        'statut',
        'locataire_id',
        'gardien_id',
        'observations',
    ];

    protected $casts = [
        'heure_entree' => 'datetime',
        'heure_sortie' => 'datetime',
    ];

    public function locataire()
    {
        return $this->belongsTo(Locataire::class);
    }

    // public function gardien()
    // {
    //     return $this->belongsTo(Gardien::class);
    // }

    public function getVisiteurNomCompletAttribute()
    {
        return $this->visiteur_prenom . ' ' . $this->visiteur_nom;
    }

    public function getDureeVisiteAttribute()
    {
        if ($this->heure_sortie) {
            return $this->heure_entree->diffForHumans($this->heure_sortie, true);
        }
        return $this->heure_entree->diffForHumans(now(), true);
    }

    public function scopeEnCours($query)
    {
        return $query->where('statut', 'en_cours');
    }

    public function scopeTerminees($query)
    {
        return $query->where('statut', 'terminee');
    }
}