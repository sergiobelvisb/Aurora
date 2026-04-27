{{--
    MIGRACIÓN: ViewVistasAdministrador.inc.php → admin/dashboard.blade.php

    Cambios clave:
    - $this->data['usuario'] → session('username')
    - href "AdminUsuarios" relativo → route('admin.usuarios.index')
    - href "LogOut" → route('logout')
--}}

@extends('layouts.app')

@section('title', 'Panel Administrador')

@section('content')
<h1>Listado de vistas</h1>

<main>
    {{-- Tu: $this->data['usuario'] — viene directamente de sesión --}}
    <h2><strong>¡Hola {{ session('username') }}! ¿A dónde te quieres redirigir?</strong></h2>

    <ol>
        <li>
            {{-- Tu: href="AdminUsuarios" --}}
            <a href="{{ route('admin.usuarios.index') }}">
                Administrar Usuarios
            </a>
        </li>
        <li>
            <a href="{{ url('/admin/productos') }}">
                Administrar Productos
            </a>
        </li>
        <li>
            <a href="{{ url('/tienda') }}">
                Tienda
            </a>
        </li>
    </ol>
    <br>

    {{-- Tu: href="LogOut" --}}
    <a href="{{ route('logout') }}">
        <button class="actions">Cerrar Sesión</button>
    </a>
</main>
@endsection