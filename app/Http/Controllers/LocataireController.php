<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Locataire;
use App\Models\Visite;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class LocataireController extends Controller
{
    // Affiche le formulaire de création
    public function create()
    {
        return view('form_loca');
    }

    // Liste tous les locataires
    public function index()
    {
        $locataires = Locataire::all();
        return view('list_loca', compact('locataires'));
    }

    // Enregistre un locataire + crée un utilisateur lié
    public function store(Request $request)
    {
        // Validation manuelle pour vérifier l'email unique dans 2 tables
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('locataires')->where(function ($query) use ($request) {
                    return $query->where('email', $request->email);
                }),
                Rule::unique('users')->where(function ($query) use ($request) {
                    return $query->where('email', $request->email);
                }),
            ],
            'telephone' => 'required|string|max:20',
            'appartement' => 'required|string|max:50',
            'etage' => 'required|string|max:10',
            'actif' => 'required|in:0,1',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'required|string|min:3',
        ]);

        $data = $request->all();

        // Gestion de la photo
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos/locataires', 'public');
        }

        // Hash du mot de passe
        $hashedPassword = Hash::make($data['password']);
        $data['password'] = $hashedPassword;

        // Création du locataire
        $locataire = Locataire::create($data);

        // Création de l'utilisateur lié avec le même mot de passe hashé
        User::create([
            'nom_utilisateur' => $data['nom'] . ' ' . $data['prenom'],
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'password' => $hashedPassword, // <-- Utiliser le mot de passe hashé une seule fois
            'type' => 'locataire', // IMPORTANT : définir le type
        ]);

        return redirect()->route('locataires.index')->with('success', 'Locataire et compte utilisateur créés avec succès.');
    }

    // Formulaire d'édition
    public function edit($id)
    {
        $locataire = Locataire::findOrFail($id);
        return view('edit_loca', compact('locataire'));
    }

    // Mise à jour du locataire (avec option mise à jour mot de passe)
    public function update(Request $request, $id)
    {
        $locataire = Locataire::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('locataires')->ignore($locataire->id),
                Rule::unique('users')->ignore($locataire->id),
            ],
            'telephone' => 'required|string|max:20',
            'appartement' => 'required|string|max:50',
            'etage' => 'required|string|max:10',
            'actif' => 'required|in:0,1',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|string|min:8',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            if ($locataire->photo) {
                Storage::disk('public')->delete($locataire->photo);
            }
            $data['photo'] = $request->file('photo')->store('photos/locataires', 'public');
        } else {
            $data['photo'] = $locataire->photo;
        }

        // Si un nouveau mot de passe est fourni, on le hash
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $locataire->update($data);

        // Mise à jour du User associé (si nécessaire)
        $user = User::where('email', $locataire->email)->first();
        if ($user) {
            $user->nom_utilisateur = $data['nom'] . ' ' . $data['prenom'];
            $user->nom = $data['nom'];
            $user->prenom = $data['prenom'];
            $user->email = $data['email'];
            if (isset($data['password'])) {
                $user->password = $data['password'];
            }
            $user->save();
        }

        return redirect()->route('locataires.index')->with('success', 'Locataire mis à jour avec succès.');
    }

    // Suppression du locataire + photo
    public function destroy($id)
    {
        $locataire = Locataire::findOrFail($id);

        if ($locataire->photo) {
            Storage::disk('public')->delete($locataire->photo);
        }

        // Supprimer aussi l'utilisateur lié
        $user = User::where('email', $locataire->email)->first();
        if ($user) {
            $user->delete();
        }

        $locataire->delete();

        return redirect()->route('locataires.index')->with('success', 'Locataire supprimé avec succès.');
    }

    // Historique des visites du locataire
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
