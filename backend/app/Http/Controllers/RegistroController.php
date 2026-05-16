<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{
    public function index()
    {
        $hospitales = Hospital::all();
        return view('auth.registro', compact('hospitales'));
    }

    // Registra al nuevo usuario

    public function registrar(Request $request)
    {
        $request->validate([
            'username'  => 'required|string|max:100|unique:usuarios_medicos,username',
            'nombre'    => 'required|string|max:100',
            'apellidos' => 'required|string|max:200',
            'email'     => 'required|email|unique:usuarios_medicos,email',
            'password'  => 'required|min:8|confirmed',
            'hospital'  => 'required|integer|exists:hospitales,hospitalID',
        ]);

        $partes = explode(' ', trim($request->apellidos), 2);

        Usuario::create([
            'username'  => $request->username,
            'nombre'    => $request->nombre,
            'apellido1' => $partes[0],
            'apellido2' => $partes[1] ?? null,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'acl'       => 'Medico',
            'hospitalID'=> $request->hospital,
        ]);

        return redirect()->route('login.form')
            ->with('success', 'Cuenta creada. Inicia sesión.');
    }
}