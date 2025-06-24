<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validation des données
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Authentification
        if (Auth::attempt($credentials)) {
            return redirect()->route('accueil');
        }

        // Retour avec erreur
        return back()->withErrors([
            'email' => 'Nom d’utilisateur ou mot de passe incorrect.',
        ]);
    }
    
}
