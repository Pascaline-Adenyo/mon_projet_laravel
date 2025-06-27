<?php

 use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\VisiteurController;
 use App\Http\Controllers\LocataireController;

// Route::get('/', function () {
//     return view('accueil');
// });
use App\Http\Controllers\AuthController;

use App\Models\Locataire;

Route::get('/authentification', function () {
    return view('authentification');
})->name('login');

Route::post('/authentifications', [AuthController::class, 'login'])->name('login.custom');


Route::middleware('auth')->group(function(){
Route::get('/accueil',[VisiteurController::class,'create'])->name('accueil');
});
// Route::get('/accueil', function () {
//     return view('accueil');
// })->name('accueil')->middleware('auth');



Route::get('/visiteurs', [VisiteurController::class, 'index'])->name('visiteurs.index');
Route::post('/visiteurs', [VisiteurController::class, 'store'])->name('visiteurs.store');

Route::put('/visiteurs/{id}/valider', [VisiteurController::class, 'valider'])->name('visiteurs.valider');



Route::get('/locataires/create', [LocataireController::class, 'create'])->name('locataires.create');
Route::post('/locataires', [LocataireController::class, 'store'])->name('locataires.store');
Route::get('/locataires', [LocataireController::class, 'index'])->name('locataires.index');




Route::get('/notifications', function () {
    $locataire = \App\Models\Locataire::first();
    return view('notifications', compact('locataire'));
})->name('notifications');




Route::get('/locataire/historique/{id}', [LocataireController::class, 'historique'])
     ->name('locataire.historique');


     Route::get('/locataire/visites/{id}', [VisiteurController::class, 'afficherVisite'])->name('locataire.visite');
     Route::get('/locataire/visites/{id}', [App\Http\Controllers\VisiteurController::class, 'voirVisite'])->name('visite.voir');

     Route::put('/visites/{id}/confirmer', [VisiteurController::class, 'confirmer'])->name('visite.confirmer');
Route::put('/visites/{id}/refuser', [VisiteurController::class, 'refuser'])->name('visite.refuser');
Route::put('/visites/{id}/bannir', [VisiteurController::class, 'bannir'])->name('visite.bannir');
Route::get('/notifications/{id}', [VisiteurController::class, 'notifications'])->name('notifications.show');
Route::get('/home', function () {
    return view('home');
})->name('home');
Route::redirect('/', '/home');

















