@extends('layouts.app')

@section('title', 'Configuración de Perfil')

@section('content')
<h1>Configuración de Perfil</h1>

<main>
    <form action="{{ route('perfil.actualizar') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="perfil-container">

            {{-- FOTO --}}
            <div class="perfil-imagen">
                {{-- Tu: src="<?=$this->data['fotodeperfil']?>" --}}
                <img src="{{ asset($fotodeperfil) }}" alt="Foto de perfil">
                <br><br>
                <input type="file" name="foto_perfil" id="input-imagen" accept=".jpg">
            </div>

            {{-- DATOS --}}
            <div class="perfil-datos">
                <label for="username">Nombre de usuario:</label>
                {{-- Tu: value= <?=$this->data['usuario'] ?> (faltaban comillas) --}}
                <input type="text" id="username" name="username" value="{{ $usuario }}" required>

                <label for="password">Nueva contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Dejar vacío para no cambiar">

                {{--
                    if($this->data['admin']) { echo "<input...></input>"; }
                --}}
                @if($admin)
                    <label for="acl">Rol ACL:</label>
                    <input type="text" id="acl" name="acl" value="{{ $acl }}">
                @endif

                <div class="guardar-boton">
                    <button type="submit">Guardar cambios</button>
                </div>
            </div>
        </div>

        <div>
            @if(!$admin)
                {{-- echo "<a href='Aviso'>..." --}}
                <a href="{{ url('/aviso') }}">
                    <button type="button" class="actions">Eliminar cuenta</button>
                </a>
            @endif

            {{-- href="../Perfil" — relativo reemplazado por ruta nombrada --}}
            <a href="{{ route('perfil.show') }}">
                <button type="button" class="actions">Volver</button>
            </a>
        </div>
    </form>
</main>
@endsection
