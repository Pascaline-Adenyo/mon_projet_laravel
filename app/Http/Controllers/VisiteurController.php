<?php


namespace App\Http\Controllers;

use App\Models\Visite;
use Illuminate\Http\Request;
use App\Models\Locataire;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
  
   use App\Notifications\VisiteANotifier; 
   

class VisiteurController extends Controller
{
    
   

        public function create(){

            $locataires = Locataire::all(); // on récupère tous les locataires
                return view('accueil', compact('locataires'));
        }
 
  
   public function index(Request $request)
{
    $query = Visite::query();

    // Filtrage par statut si présent
    if ($request->has('statut') && !empty($request->statut)) {
        $query->where('statut', $request->statut);
    }

    $visiteurs = $query->with('locataire')->get();

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
        'photo' => 'nullable|image|max:2048', // validation de la photo
    ]);

    // Enregistrement de la photo si fournie
    $photoPath = null;
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('photos/visites', 'public');
    }

    // Création de la visite
    $visite = Visite::create([
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
        'gardien_id' => Auth::user()->id,
        'observations' => $request->observations,
        'photo' => $photoPath, // chemin photo stockée
    ]);

   // Trouver le locataire et lui envoyer la notification
    $locataire = Locataire::find ($request->locataire_id);
    
// dd([
//     'ID reçu du formulaire' => $request->locataire_id,
//     'Nom du locataire trouvé' => $locataire ? $locataire->nom : 'Non trouvé',
// ]);


    if ($locataire) {
        $locataire->notify(new VisiteANotifier($visite));
    }

    return redirect()->route('notifications.show', ['id' => $locataire->id])
    ->with('success', 'Visite enregistrée et notification envoyée.');


}

public function notifications($id)
{
    $locataire = Locataire::findOrFail($id);
    return view('notifications', compact('locataire'));
}





public function voirVisite($id)
{
    $visite = Visite::findOrFail($id);
    return view('visites.detail', compact('visite'));
}


public function confirmer($id)
{
    $visite = Visite::findOrFail($id);
    $visite->statut = 'confirmée';
    $visite->save();

    return redirect()->back()->with('success', 'Visite confirmée.');
}

public function refuser($id)
{
    $visite = Visite::findOrFail($id);
    $visite->statut = 'refusée';
    $visite->save();

    return redirect()->back()->with('success', 'Visite refusée.');
}

public function bannir($id)
{
    $visite = Visite::findOrFail($id);
    $visite->statut = 'bannie';
    $visite->save();

    return redirect()->back()->with('success', 'Visiteur banni.');
}



public function valider($id)
{
    $visite = Visite::findOrFail($id);
    $visite->statut = 'validé';
    $visite->heure_sortie = Carbon::now(); // enregistre l'heure actuelle
    $visite->save();

    return redirect()->back()->with('success', 'Visite validée avec succès.');
}





}