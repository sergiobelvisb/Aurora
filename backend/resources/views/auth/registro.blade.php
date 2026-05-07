@extends('layouts.app')

@section('title', 'Crear cuenta')

@section('content')
<div class="register-container">
    <div class="register-card">
        <h2 class="register-title">Crear cuenta</h2>

        {{-- if (!empty($data['error'])) --}}
        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        {{--
            action="<?=$http->getUrlBase()?>/Registro/registrarUsuario"
        --}}
        <form action="{{ route('registro.post') }}" method="POST" class="register-form">
            @csrf

            <div class="form-row">
                <input type="text"
                       name="username"
                       placeholder="Usuario"
                       value="{{ old('username') }}">
                @error('username')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row two-columns">
                <input type="text"
                       name="nombre"
                       placeholder="Nombre"
                       value="{{ old('nombre') }}">
                <input type="text"
                       name="apellidos"
                       placeholder="Apellidos"
                       value="{{ old('apellidos') }}">
            </div>

            <div class="form-row">
                <input type="email"
                       name="email"
                       placeholder="Correo electrónico"
                       value="{{ old('email') }}">
                @error('email')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row two-columns">
                <input type="password" name="password" placeholder="Contraseña">
                <input type="password" name="password_confirmation" placeholder="Repetir contraseña">
            </div>

            <div class="form-row">
                {{-- foreach ($data['hospitales'] as $hospital) --}}
                <select name="hospital" id="hospital-select">
                    <option value="">Selecciona un hospital</option>
                    @foreach ($hospitales as $hospital)
                        <option value="{{ $hospital['hospitalID'] }}"
                                {{ old('hospital') == $hospital['hospitalID'] ? 'selected' : '' }}>
                            {{ $hospital['nombre'] }}
                        </option>
                    @endforeach
                </select>
                @error('hospital')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row">
                <button type="submit" class="register-button">Registrarse</button>
            </div>
        </form>

        <div class="mt-4 text-center">
            {{-- href="<?=$http->getUrlBase()?>/Login" --}}
            <p>¿Ya tienes una cuenta? <a href="{{ route('login.form') }}">Inicia Sesión aquí</a></p>
        </div>
    </div>
</div>
@endsection
