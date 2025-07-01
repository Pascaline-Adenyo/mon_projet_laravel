<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use App\Models\Visite;
use App\Models\Locataire;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
   

public function index()
{
    $aujourdHui = Carbon::today();
    $visitesAujourdHui = Visite::whereDate('created_at', $aujourdHui)->count();

    $visitesSemaine = Visite::whereBetween('created_at', [
        Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()
    ])->count();

    $visitesEnCours = Visite::where('statut', 'confirmé')->count();

    $locataires = Locataire::count();

    $visitesRecentes = Visite::latest()->take(5)->get();

    return view('home', compact(
        'visitesAujourdHui',
        'visitesSemaine',
        'visitesEnCours',
        'locataires',
        'visitesRecentes'
    ));
}
public function locataire()
{
    $locataireId = Auth::id();

    $mesVisites = Visite::where('locataire_id', $locataireId)->orderBy('created_at', 'desc')->get();

    $nombreTotal = $mesVisites->count();
    $visitesEnCours = $mesVisites->where('statut', 'Confirmé')->count();
    $visitesTerminees = $mesVisites->where('statut', 'Validé')->count();
    $visitesAujourdHui = $mesVisites->where('created_at', '>=', \Carbon\Carbon::today())->count();
    $visitesSemaine = $mesVisites->whereBetween('created_at', [
        Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()
    ])->count();

    return view('locataire_home', compact(
        'mesVisites',
        'nombreTotal',
        'visitesEnCours',
        'visitesTerminees',
        'visitesAujourdHui',
        'visitesSemaine'
    ));
}


public function admin()
{
   
        $visitesAujourdHui = Visite::whereDate('created_at', today())->count();
        $visitesSemaine = Visite::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $visitesEnCours = Visite::where('statut', 'En cours')->count();
        $locataires = Locataire::count();
        $visitesRecentes = Visite::latest()->take(5)->get();

        return view('admin_home', compact(
            'visitesAujourdHui',
            'visitesSemaine',
            'visitesEnCours',
            'locataires',
            'visitesRecentes'
        ));
    
}



 

}
