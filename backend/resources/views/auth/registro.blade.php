@extends('layouts.app')

@section('title', 'Crear cuenta')

@section('content')
<div class="login-container d-flex justify-content-center align-items-center">
    <div class="login-card p-5 shadow-sm rounded">
        <h2 class="text-center mb-4">Crear cuenta</h2>

        @if ($errors->any())
            <div class="alert alert-danger text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ url()->secure(route('registro.post', [], false)) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="username" class="form-label">Usuario</label>
                <input type="text"
                       class="form-control @error('username') is-invalid @enderror"
                       id="username" name="username"
                       placeholder="Nombre de usuario"
                       value="{{ old('username') }}">
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre"
                           placeholder="Nombre" value="{{ old('nombre') }}">
                </div>
                <div class="col">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos"
                           placeholder="Apellidos" value="{{ old('apellidos') }}">
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       id="email" name="email"
                       placeholder="usuario@ejemplo.com"
                       value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control"
                           id="password" name="password" placeholder="********">
                </div>
                <div class="col">
                    <label for="password_confirmation" class="form-label">Repetir contraseña</label>
                    <input type="password" class="form-control"
                           id="password_confirmation" name="password_confirmation" placeholder="********">
                </div>
            </div>

            <div class="mb-3">
                <label for="hospital-select" class="form-label">Hospital</label>
                <select class="form-control @error('hospital') is-invalid @enderror"
                        name="hospital" id="hospital-select">
                    <option value="">Selecciona un hospital</option>
                    @foreach ($hospitales as $hospital)
                        <option value="{{ $hospital['hospitalID'] }}"
                                {{ old('hospital') == $hospital['hospitalID'] ? 'selected' : '' }}>
                            {{ $hospital['nombre'] }}
                        </option>
                    @endforeach
                </select>
                @error('hospital')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Registrarse</button>
        </form>

        <div class="mt-4 text-center">
            <p>¿Ya tienes una cuenta? <a href="{{ route('login.form') }}">Inicia sesión aquí</a></p>
        </div>
    </div>
</div>
@endsection