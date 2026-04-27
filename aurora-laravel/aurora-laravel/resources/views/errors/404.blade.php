{{--
    MIGRACIÓN: ViewError.inc.php → errors/404.blade.php

    En Laravel, los errores van en resources/views/errors/
    El archivo 404.blade.php se carga automáticamente para errores 404.

    Cambios clave:
    - $http->getUrlBase() → url('/')
    - Laravel detecta automáticamente este archivo para errores 404
--}}

@extends('layouts.app')

@section('title', 'Error 404')

@section('content')
<h1>Error 404</h1>
<main>
    <p class="error">
        No tienes permisos para acceder a esta página o la página que buscas no existe.
    </p>

    {{-- Tu: href="<?= $http->getUrlBase();?>" --}}
    <a href="{{ url('/') }}">
        <button class="actions">Volver</button>
    </a>
</main>
@endsection