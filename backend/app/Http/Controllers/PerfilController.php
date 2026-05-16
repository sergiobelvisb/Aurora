<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Usuario;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function show()
    {
        return view('perfil.perfil_show', $this->viewData($this->getUsuario()));
    }

    public function configurar()
    {
        return view('perfil.configurar', $this->viewData($this->getUsuario()));
    }

    // Actualiza los cambios del usuario 

    public function actualizar(Request $request)
    {
        $request->validate([
            'username'    => 'required|string|max:50',
            'nombre'      => 'required|string|max:100',
            'apellido1'   => 'required|string|max:100',
            'apellido2'   => 'nullable|string|max:100',
            'email'       => 'required|email|max:100',
            'password'    => 'nullable|string|min:6',
            'foto_perfil' => 'nullable|file|mimetypes:image/jpeg,image/jpg|max:2048',
        ]);

        $usuario = $this->getUsuario();

        if ($request->hasFile('foto_perfil') && $request->file('foto_perfil')->isValid()) {
            $nombreFoto = $usuario->actualizarFoto($request->file('foto_perfil'));
            session(['foto' => 'img/pfp/' . $nombreFoto]);
        }

        $usuario->username  = $request->input('username');
        $usuario->nombre    = $request->input('nombre');
        $usuario->apellido1 = $request->input('apellido1');
        $usuario->apellido2 = $request->input('apellido2');
        $usuario->email     = $request->input('email');
        $usuario->hospitalID = $request->input('hospitalID') ?: null;

        if ($usuario->esAdministrador() && $request->filled('acl')) {
            $usuario->acl = $request->input('acl');
        }

        $usuario->save();
        session(['username' => $usuario->username]);

        if ($request->filled('password')) {
            $usuario->actualizarPassword($request->input('password'));
        }

        return redirect()->route('perfil.show')->with('success', 'Perfil actualizado correctamente.');
    }

    // Cambia la foto del usuario
    public function cambiarFoto(Request $request)
    {
        $request->validate(['foto_perfil' => 'required|file|mimetypes:image/jpeg,image/jpg|max:2048']);

        $usuario    = $this->getUsuario();
        $nombreFoto = $usuario->actualizarFoto($request->file('foto_perfil'));
        session(['foto' => 'img/pfp/' . $nombreFoto]);

        return redirect()->route('perfil.show')->with('success', 'Foto actualizada.');
    }

    // Actualiza el nombre

    public function actualizarNombre(Request $request)
    {
        $request->validate([
            'nombre'    => 'required|string|max:100',
            'apellido1' => 'required|string|max:100',
            'apellido2' => 'nullable|string|max:100',
        ]);

        $usuario = $this->getUsuario();
        $usuario->nombre    = $request->input('nombre');
        $usuario->apellido1 = $request->input('apellido1');
        $usuario->apellido2 = $request->input('apellido2');
        $usuario->save();

        return redirect()->route('perfil.show')->with('success', 'Nombre actualizado.');
    }


    // Actualiza el email
    public function actualizarEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|max:100']);

        $usuario = $this->getUsuario();
        $usuario->email = $request->input('email');
        $usuario->save();

        return redirect()->route('perfil.show')->with('success', 'Email actualizado.');
    }

    // Actualiza el password
    public function actualizarPassword(Request $request)
    {
        $request->validate([
            'password'              => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        $this->getUsuario()->actualizarPassword($request->input('password'));

        return redirect()->route('perfil.show')->with('success', 'Contraseña actualizada.');
    }


    // Actualiza el hospital
    public function actualizarHospital(Request $request)
    {
        $usuario = $this->getUsuario();
        $usuario->hospitalID = $request->input('hospitalID') ?: null;
        $usuario->save();

        return redirect()->route('perfil.show')->with('success', 'Hospital actualizado.');
    }

    // Helpers privados 

    private function getUsuario(): Usuario
    {
        return Usuario::with('hospital')->findOrFail(session('userID'));
    }

    private function viewData(Usuario $usuario): array
    {
        return [
            'usuario'      => $usuario->username,
            'nombre'       => $usuario->nombre,
            'apellido1'    => $usuario->apellido1,
            'apellido2'    => $usuario->apellido2,
            'email'        => $usuario->email,
            'fotodeperfil' => 'img/pfp/' . ($usuario->fotodeperfil ?? 'default.png'),
            'acl'          => $usuario->acl ?? 'Medico',
            'admin'        => $usuario->esAdministrador(),
            'hospital'     => $usuario->hospital,
            'hospitales'   => Hospital::paraSelector(),
        ];
    }
}