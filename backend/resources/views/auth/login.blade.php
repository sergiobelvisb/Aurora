@extends('layouts.app')

@section('title', 'Iniciar sesión')

@section('content')
<div class="login-container d-flex justify-content-center align-items-center">
    <div class="login-card p-5 shadow-sm rounded">
        <h2 class="text-center mb-4">Iniciar sesión</h2>

        @if ($errors->any())
            <div class="alert alert-danger text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       id="email"
                       name="email"
                       placeholder="usuario@ejemplo.com"
                       value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password"
                       class="form-control"
                       id="password"
                       name="password"
                       placeholder="********">
            </div>

            <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
        </form>

        <div class="mt-4 text-center">
            <p>¿No tienes cuenta? <a href="{{ url('/registro') }}">Regístrate aquí</a></p>
        </div>
    </div>
</div>
@endsection