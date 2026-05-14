@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<div class="container py-4" style="max-width:720px">

    {{-- Mensajes flash --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    {{-- Cabecera --}}
    <div class="d-flex align-items-center gap-4 mb-4">
        <img src="{{ asset($fotodeperfil) }}"
             alt="Foto de perfil"
             class="rounded-circle border"
             style="width:90px; height:90px; object-fit:cover">
        <div>
            <h2 class="mb-0">{{ $nombre }} {{ $apellido1 }} {{ $apellido2 }}</h2>
            <span class="text-muted">{{ $usuario }}</span>
            <span class="badge bg-secondary ms-2">{{ $acl }}</span>
        </div>
    </div>

    {{-- Datos ── card --}}
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title mb-3">Datos personales</h5>

            <div class="row mb-2">
                <div class="col-4 text-muted">Email</div>
                <div class="col-8">{{ $email }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-4 text-muted">Hospital</div>
                <div class="col-8">
                    {{ $hospital ? $hospital['nombre'] . ' — ' . $hospital['ubicacion'] : '—' }}
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4 text-muted">Rol</div>
                <div class="col-8">{{ $acl }}</div>
            </div>
        </div>
    </div>

    {{-- Acciones --}}
    <div class="d-flex gap-2">
        <a href="{{ route('perfil.configurar') }}" class="btn btn-primary">
            ✎ Editar perfil
        </a>
    </div>

</div>
@endsection