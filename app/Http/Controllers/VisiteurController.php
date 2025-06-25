<?php


namespace App\Http\Controllers;

use App\Models\Visite;
use Illuminate\Http\Request;
use App\Models\Locataire;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VisiteurController extends Controller
{
    
   


 
  
    public function index()
    {
        $visiteurs = Visite::all();
      
        return view('list_visiteur', compact('visiteurs'));
    }

    
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
           
            'observations' => 'nullable|string',
        ]);

        Visite::create([
            'visiteur_nom' => $request->visiteur_nom,
            'visiteur_prenom' => $request->visiteur_prenom,
            'visiteur_telephone' => $request->visiteur_telephone,
            'visiteur_piece_identite' => $request->visiteur_piece_identite,
            'visiteur_numero_piece' => $request->visiteur_numero_piece,
            'motif_visite' => $request->motif_visite,
            'heure_entree' => $request->heure_entree,
            'heure_sortie' => $request->heure_sortie,
            'statut' => $request->statut,
            'locataire_id' => $request->locataire_id,
           'gardien_id'=>Auth::user()->id,
            'observations' => $request->observations,
        ]);

        return redirect()->route('visiteurs.index')->with('success', 'Visiteur enregistré avec succès.');
    }

  




public function valider($id)
{
    $visiteur = Visite::findOrFail($id);
    $visiteur->heure_sortie = Carbon::now()->format('H:i'); // heure actuelle
    $visiteur->statut = 'validé';
    $visiteur->save();

    return redirect()->route('visiteurs.index')->with('success', 'Visiteur validé avec succès.');
}




    public function create()
{
 
    $locataires = Locataire::all(); 
    return view('accueil', compact('locataires'));
}

}

