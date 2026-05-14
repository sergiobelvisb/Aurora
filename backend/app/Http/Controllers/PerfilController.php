<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    // ── GET /perfil ────────────────────────────────────────────
    public function show()
    {
        $user = $this->getUser();
        return view('perfil.perfil_show', $this->viewData($user));
    }

    // ── GET /perfil/configurar ─────────────────────────────────
    public function configurar()
    {
        $user = $this->getUser();
        return view('perfil.configurar', $this->viewData($user));
    }

    // ── PATCH /perfil ──────────────────────────────────────────
    public function actualizar(Request $request)
    {
        $userID = session('userID');

        $request->validate([
            'username'    => 'required|string|max:50',
            'nombre'      => 'required|string|max:100',
            'apellido1'   => 'required|string|max:100',
            'apellido2'   => 'nullable|string|max:100',
            'email'       => 'required|email|max:100',
            'password'    => 'nullable|string|min:6',
            'foto_perfil' => 'nullable|file|mimetypes:image/jpeg,image/jpg|max:2048',
        ]);

        // Foto
        if ($request->hasFile('foto_perfil') && $request->file('foto_perfil')->isValid()) {
            $foto       = $request->file('foto_perfil');
            $nombreFoto = $userID . '_' . time() . '.jpg';
            $foto->move(public_path('img/pfp'), $nombreFoto);
            DB::update('UPDATE usuarios_medicos SET fotodeperfil = ? WHERE userID = ?', [$nombreFoto, $userID]);
            session(['foto' => 'img/pfp/' . $nombreFoto]);
        }

        // Un solo UPDATE para todos los campos de texto
        DB::update(
            'UPDATE usuarios_medicos
             SET username = ?, nombre = ?, apellido1 = ?, apellido2 = ?, email = ?, hospitalID = ?
             WHERE userID = ?',
            [
                $request->input('username'),
                $request->input('nombre'),
                $request->input('apellido1'),
                $request->input('apellido2'),
                $request->input('email'),
                $request->input('hospitalID') ?: null,
                $userID,
            ]
        );

        session(['username' => $request->input('username')]);

        // Password (solo si se rellena)
        if ($request->filled('password')) {
            DB::update(
                'UPDATE usuarios_medicos SET password = ? WHERE userID = ?',
                [Hash::make($request->input('password')), $userID]
            );
        }

        // ACL (solo admins)
        if (session('acl') === 'Administrador' && $request->filled('acl')) {
            DB::update(
                'UPDATE usuarios_medicos SET acl = ? WHERE userID = ?',
                [$request->input('acl'), $userID]
            );
        }

        return redirect()->route('perfil.show')->with('success', 'Perfil actualizado correctamente.');
    }

    // ── POST /perfil/foto ──────────────────────────────────────
    public function cambiarFoto(Request $request)
    {
        $userID = session('userID');
        $request->validate(['foto_perfil' => 'required|file|mimetypes:image/jpeg,image/jpg|max:2048']);

        $foto       = $request->file('foto_perfil');
        $nombreFoto = $userID . '_' . time() . '.jpg';
        $foto->move(public_path('img/pfp'), $nombreFoto);
        DB::update('UPDATE usuarios_medicos SET fotodeperfil = ? WHERE userID = ?', [$nombreFoto, $userID]);
        session(['foto' => 'img/pfp/' . $nombreFoto]);

        return redirect()->route('perfil.show')->with('success', 'Foto actualizada.');
    }

    // ── PATCH /perfil/nombre ───────────────────────────────────
    public function actualizarNombre(Request $request)
    {
        $request->validate([
            'nombre'    => 'required|string|max:100',
            'apellido1' => 'required|string|max:100',
            'apellido2' => 'nullable|string|max:100',
        ]);
        DB::update(
            'UPDATE usuarios_medicos SET nombre = ?, apellido1 = ?, apellido2 = ? WHERE userID = ?',
            [$request->input('nombre'), $request->input('apellido1'), $request->input('apellido2'), session('userID')]
        );
        return redirect()->route('perfil.show')->with('success', 'Nombre actualizado.');
    }

    // ── PATCH /perfil/email ────────────────────────────────────
    public function actualizarEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|max:100']);
        DB::update(
            'UPDATE usuarios_medicos SET email = ? WHERE userID = ?',
            [$request->input('email'), session('userID')]
        );
        return redirect()->route('perfil.show')->with('success', 'Email actualizado.');
    }

    // ── PATCH /perfil/password ─────────────────────────────────
    public function actualizarPassword(Request $request)
    {
        $request->validate([
            'password'              => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);
        DB::update(
            'UPDATE usuarios_medicos SET password = ? WHERE userID = ?',
            [Hash::make($request->input('password')), session('userID')]
        );
        return redirect()->route('perfil.show')->with('success', 'Contraseña actualizada.');
    }

    // ── PATCH /perfil/hospital ─────────────────────────────────
    public function actualizarHospital(Request $request)
    {
        DB::update(
            'UPDATE usuarios_medicos SET hospitalID = ? WHERE userID = ?',
            [$request->input('hospitalID') ?: null, session('userID')]
        );
        return redirect()->route('perfil.show')->with('success', 'Hospital actualizado.');
    }

    // ── Helpers ────────────────────────────────────────────────
    private function getUser(): array
    {
        $user = DB::select('SELECT * FROM usuarios_medicos WHERE userID = ?', [session('userID')]);
        return $user ? (array) $user[0] : [];
    }

    private function viewData(array $user): array
    {
        $hospital = null;
        if (!empty($user['hospitalID'])) {
            $h = DB::select('SELECT * FROM hospitales WHERE hospitalID = ?', [$user['hospitalID']]);
            $hospital = $h ? (array) $h[0] : null;
        }
        $hospitales = array_map(
            fn($h) => (array) $h,
            DB::select('SELECT hospitalID, nombre, ubicacion FROM hospitales ORDER BY nombre')
        );

        return [
            'usuario'      => $user['username']     ?? '',
            'nombre'       => $user['nombre']       ?? '',
            'apellido1'    => $user['apellido1']    ?? '',
            'apellido2'    => $user['apellido2']    ?? '',
            'email'        => $user['email']        ?? '',
            'fotodeperfil' => 'img/pfp/' . ($user['fotodeperfil'] ?? 'default.png'),
            'acl'          => $user['acl']          ?? 'Medico',
            'admin'        => ($user['acl']         ?? '') === 'Administrador',
            'hospital'     => $hospital,
            'hospitales'   => $hospitales,
        ];
    }
}