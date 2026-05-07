@extends('layouts.app')

@section('title', 'Error 404')

@section('content')
<h1>Error 404</h1>
<main>
    <p class="error">
        No tienes permisos para acceder a esta página o la página que buscas no existe.
    </p>

    {{-- href="<?= $http->getUrlBase();?>" --}}
    <a href="{{ url('/') }}">
        <button class="actions">Volver</button>
    </a>
</main>
@endsection
