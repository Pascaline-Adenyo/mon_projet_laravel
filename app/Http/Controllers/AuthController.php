<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'user_type' => 'required|string', // Très important !
    ]);

    $credentials = [
        'email' => $request->email,
        'password' => $request->password,
        'type' => $request->user_type, // Vérifie que le type correspond bien
    ];
           

    if (Auth::attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();

        if ($request->user_type === 'gardien') {
            return redirect()->route('home');
        } elseif ($request->user_type === 'locataire') {
            return redirect()->route('locataire_home');
        } elseif ($request->user_type === 'admin') {
            return redirect()->route('admin_home'); 
        } else {
            return redirect()->route('default_dashboard');
        }
    }

    return back()->with('error', 'Email, mot de passe ou rôle incorrect.');
}

    



    
}
