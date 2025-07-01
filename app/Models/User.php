<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
    'nom_utilisateur',
    'nom',
    'prenom',
    'email',
    'password',
];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function visiteur(){
        return $this->hasMany(Visite::class);
    }

    // Surcharge du champ de connexion
    // public function getAuthIdentifierName()
    // {
    //     return 'nom_utilisateur';
    // }
}
