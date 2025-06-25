<?php

 use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\VisiteurController;

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





