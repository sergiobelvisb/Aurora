@extends('layouts.app')

@section('title', 'Página no encontrada - Error 404')

@section('content')
<div class="min-h-[80vh] flex flex-col items-center justify-center px-4 text-center">

    <h1 class="text-9xl font-extrabold text-blue-600 tracking-tight">
        404
    </h1>

    <p class="text-2xl font-bold text-gray-900 mt-4">
        Página no encontrada
    </p>

    <p class="text-gray-500 mt-2 mb-8 max-w-sm">
        La página que buscas no existe o no tienes permisos para acceder a ella.
    </p>

    <div class="flex items-center gap-3">
        <a href="{{ url('/') }}"
           class="btn btn-primary">
            Volver al inicio
        </a>
    </div>

</div>
@endsection