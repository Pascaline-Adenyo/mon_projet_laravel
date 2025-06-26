<?php

 use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\VisiteurController;
 use App\Http\Controllers\LocataireController;

// Route::get('/', function () {
//     return view('accueil');
// });
use App\Http\Controllers\AuthController;

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


Route::get('/locataire/historique/{id}', [LocataireController::class, 'historique'])
     ->name('locataire.historique');


     Route::get('/locataire/visites/{id}', [VisiteurController::class, 'afficherVisite'])->name('locataire.visite');
Route::put('/locataire/visites/{id}/confirmer', [VisiteurController::class, 'confirmer'])->name('visite.confirmer');
Route::put('/locataire/visites/{id}/refuser', [VisiteurController::class, 'refuser'])->name('visite.refuser');

Route::get('/test-notif', function () {
    return view('test_notif');
});







