<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Locataire;
use App\Models\Visite;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class LocataireController extends Controller
{
    // Affiche le formulaire de création
    public function create()
    {
        return view('form_loca');
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
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:locataires,email',
            'telephone' => 'required|string|max:20',
            'appartement' => 'required|string|max:50',
            'etage' => 'required|string|max:10',
            'actif' => 'required|in:0,1',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'required|string|min:3',
        ]);

        // Gestion de la photo
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos/locataires', 'public');
            $validated['photo'] = $path;
        }

        // Hachage du mot de passe
        $validated['password'] = Hash::make($validated['password']);

        // Enregistrement
        Locataire::create($validated);

        // Redirection
        return redirect()->route('locataires.index')->with('success', 'Locataire enregistré avec succès.');
    }

    // Méthode pour afficher le formulaire d'édition
    public function edit($id)
    {
        $locataire = Locataire::findOrFail($id);
        return view('edit_loca', compact('locataire'));
    }

    // Méthode pour mettre à jour un locataire
    public function update(Request $request, $id)
    {
        $locataire = Locataire::findOrFail($id);
        
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:locataires,email,'.$locataire->id,
            'telephone' => 'required|string|max:20',
            'appartement' => 'required|string|max:50',
            'etage' => 'required|string|max:10',
            'actif' => 'required|in:0,1',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|string|min:8',
        ]);

        // Gestion de la photo
        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo si elle existe
            if ($locataire->photo) {
                Storage::disk('public')->delete($locataire->photo);
            }
            
            // Stocker la nouvelle photo
            $path = $request->file('photo')->store('photos/locataires', 'public');
            $validated['photo'] = $path;
        } else {
            // Garder la photo existante si aucune nouvelle n'est fournie
            $validated['photo'] = $locataire->photo;
        }

        // Mise à jour du mot de passe seulement si fourni
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Mise à jour
        $locataire->update($validated);

        return redirect()->route('locataires.index')->with('success', 'Locataire mis à jour avec succès.');
    }

    // Méthode pour supprimer un locataire
    public function destroy($id)
    {
        $locataire = Locataire::findOrFail($id);
        
        // Supprimer la photo associée
        if ($locataire->photo) {
            Storage::disk('public')->delete($locataire->photo);
        }
        
        $locataire->delete();
        
        return redirect()->route('locataires.index')->with('success', 'Locataire supprimé avec succès.');
    }

    public function historique($id)
    {
        $locataire = Locataire::findOrFail($id);
        
        $visites = Visite::where('locataire_id', $id)
                        ->orderBy('heure_entree', 'desc')
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