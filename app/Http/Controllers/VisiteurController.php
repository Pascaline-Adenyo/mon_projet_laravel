<?php


namespace App\Http\Controllers;

use App\Models\Visite;
use Illuminate\Http\Request;

class VisiteurController extends Controller
{
    // Affiche la liste des visiteurs
    public function index()
    {
        $visiteurs = Visite::all();
      
        return view('list_visiteur', compact('visiteurs'));
    }

    // Enregistre un nouveau visiteur
    public function store(Request $request)
    {
        $request->validate([
            'visiteur_nom' => 'required|string',
            'visiteur_prenom' => 'required|string',
            'visiteur_telephone' => 'required|string',
            'visiteur_piece_identite' => 'required|string',
            'visiteur_numero_piece' => 'required|string',
            'motif_visite' => 'required|string',
            'heure_entree' => 'nullable',
            'heure_sortie' => 'nullable',
            'statut' => 'nullable|string',
            'locataire_id' => 'required|integer',
            'gardien_id' => 'required|integer',
            'observations' => 'nullable|string',
        ]);

        Visite::create($request->all());

        return redirect()->route('visiteurs.index')->with('success', 'Visiteur enregistré avec succès.');
    }
}

