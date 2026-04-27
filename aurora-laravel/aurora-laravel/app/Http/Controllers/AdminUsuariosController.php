<?php

// app/Http/Controllers/AdminUsuariosController.php
namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class AdminUsuariosController extends Controller
{
    // Tu: public function index() { loadModel::load('Usuario'); ... new Layout('AdminUsuarios', $data); }
    public function index()
    {
        $usuarios = Usuario::all(); // Eloquent reemplaza LoadModel + query manual

        return view('admin.usuarios.index', compact('usuarios'));
        // Equivale a: new Layout('AdminUsuarios', $data)
    }

    // Tu: public function Usuario() { ... $id = $this->http->getRequest()->getGet('id'); }
    public function usuario(Request $request, int $id)
    {
        // $id viene de la ruta /AdminUsuarios/Usuario/{id}, no de $_GET
        $usuario = Usuario::findOrFail($id);

        return view('admin.usuarios.show', compact('usuario'));
    }
}
