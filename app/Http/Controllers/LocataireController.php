<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Locataire;
use App\Models\Visite;

class LocataireController extends Controller
{
    // Affiche le formulaire de création
    public function create()
    {
        return view('form_loca'); // Crée cette vue ensuite
    }

     public function index()
    {
        $locataires = Locataire::all();
      
        return view('list_loca', compact('locataires'));
    }

    // Enregistre un locataire dans la base de données
  public function store(Request $request)
{  
     
    // Valider les données reçues
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|unique:locataires,email',
        'telephone' => 'required|string|max:20',
        'appartement' => 'required|string|max:50',
        'etage' => 'required|string|max:10',
        'actif' => 'required|in:0,1',
    ]);

    // Enregistrement
    Locataire::create($request->all());

    // Redirection
    return redirect()->route('locataires.index')->with('success', 'Locataire enregistré avec succès.');
}

public function historique($id)
{
    $locataire = Locataire::findOrFail($id);
    
    $visites = Visite::where('locataire_id', $id)
                    ->orderBy('heure_entree', 'desc') // Correction: heure_entree au lieu de date_visite
                    ->get([
                        'visiteur_nom',
                        'visiteur_prenom',
                        'visiteur_telephone',
                        'visiteur_piece_identite',
                        'visiteur_numero_piece',
                        'motif_visite',
                        'heure_entree',
                        'heure_sortie',
                        'statut',
                        'gardien_id',
                        'observations',
                        'created_at',
                        'updated_at'
                    ]);
    
    return view('historique', compact('locataire', 'visites'));
}

}
