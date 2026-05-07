<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UsuarioMedico;
use App\Models\Hospital;

class RegistroController extends Controller
{
    // Mostrar formulario de registro
    public function index()
    {
        $hospitales = Hospital::all();
        return view('auth.registro', compact('hospitales'));
    }

    public function registrar(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:100|unique:usuarios_medicos,username',
            'nombre' => 'required|string|max:100',
            'apellidos' => 'required|string|max:200',
            'email' => 'required|email|unique:usuarios_medicos,email',
            'password' => 'required|min:8|confirmed',
            'hospital' => 'required|integer|exists:hospitales,hospitalID',
        ]);

        $partes = explode(' ', trim($request->apellidos), 2);
        $apellido1 = $partes[0];
        $apellido2 = $partes[1] ?? null;

        UsuarioMedico::create([
            'username' => $request->username,
            'nombre' => $request->nombre,
            'apellido1' => $apellido1,
            'apellido2' => $apellido2,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'acl' => 'Medico',
            'hospitalID' => $request->hospital,
        ]);

        return redirect()->route('login.form')
            ->with('success', 'Cuenta creada. Inicia sesión.');
    }
}