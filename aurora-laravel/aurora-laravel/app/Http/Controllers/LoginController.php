<?php

// app/Http/Controllers/LoginController.php
namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function autenticar(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->password)) {
            return back()->withErrors(['email' => 'Credenciales incorrectas']);
        }

        // Equivale a: session->set('userID'), session->set('username'), etc.
        session([
            'userID'        => $usuario->userID,
            'username'      => $usuario->username,
            'nombreCompleto'=> $usuario->nombre,
            'foto'          => '/img/pfp/' . $usuario->fotodeperfil,
            'acl'           => $usuario->acl,
        ]);

        return redirect()->route('home');
    }

    public function logout()
    {
        session()->flush();   // Equivale a session->destroy()
        return redirect()->route('login.form');
    }
}
