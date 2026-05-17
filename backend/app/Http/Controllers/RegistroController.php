<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UsuarioMedico;
use App\Models\Hospital;
use Illuminate\Support\Facades\DB;

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
        $apellido1 = $partes[0];
        $apellido2 = $partes[1] ?? null;

        DB::insert(
            'INSERT INTO usuarios_medicos (username, nombre, apellido1, apellido2, email, password, acl, hospitalID)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)',
            [
                $request->username,
                $request->nombre,
                $apellido1,
                $apellido2,
                $request->email,
                Hash::make($request->password),
                'Medico',
                $request->hospital,
            ]
        );

        return redirect()->route('login.form')
            ->with('success', 'Cuenta creada. Inicia sesión.');
    }
}