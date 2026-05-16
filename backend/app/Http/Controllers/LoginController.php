<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class LoginController extends Controller
{


    public function index()
    {
        return view('auth.login');
    }

    // Comprobacion de credenciales

    public function autenticar(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $usuario = Usuario::autenticar($request->email, $request->password);

        if (!$usuario) {
            return back()->withErrors(['email' => 'Credenciales incorrectas']);
        }

        session($usuario->datosDeSesion());

        return redirect()->route('home');
    }

    // Cierre de sesion
    public function logout()
    {
        session()->flush();
        return redirect()->route('home');
    }
}