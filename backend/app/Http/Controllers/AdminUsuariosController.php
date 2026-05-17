<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class AdminUsuariosController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('admin.usuarios-index', compact('usuarios'));
    }


    // Carga la vista con las acciones que desee hacer el administrador

    public function dashboard()
    {
        $totalUsuarios   = Usuario::count();
        $totalMedicos    = Usuario::medicos()->count();
        $totalAdmins     = Usuario::administradores()->count();
        $ultimosUsuarios = Usuario::recientes(5)->get();

        return view('admin.dashboard', compact(
            'totalUsuarios',
            'totalMedicos',
            'totalAdmins',
            'ultimosUsuarios'
        ));
    }

    // Muestra los usuarios o medicos del sistema
    public function show(int $id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('admin.usuarios-show', compact('usuario'));
    }

    // Carga la vista persinalizada de dicho usuario que se quiere editar
    public function edit(int $id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('admin.usuarios-edit', compact('usuario'));
    }


    // Actualiza a usuario
    public function update(Request $request, int $id)
    {
        $request->validate([
            'user' => 'required|string|max:255',
            'acl'  => 'required|string|max:100',
        ]);

        $usuario = Usuario::findOrFail($id);
        $usuario->username = $request->input('user');
        $usuario->acl      = $request->input('acl');
        $usuario->save();

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }


    // Elimina el usuario
    public function destroy(int $id)
    {
        Usuario::findOrFail($id)->delete();

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}