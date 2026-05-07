@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<h1>Administrar Usuarios</h1>

<main>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('admin.usuarios.actualizar', $usuario->userID) }}" method="POST">
        @csrf
        @method('PATCH')

        <fieldset>
            <legend>Datos del Usuario</legend>

            <label for="user">Usuario: </label>
            {{-- Tu: value="<?=$this->data['nombre']?>" --}}
            <input type="text" id="user" name="user" value="{{ $usuario->username }}">
            <br>

            <label for="acl">ACL: </label>
            <input type="text" id="acl" name="acl" value="{{ $usuario->acl }}" placeholder="custom">
            <br>

            <label for="delete">
                Delete Virtual:
                <input type="checkbox" id="delete" name="delete">
            </label>
            <br><br>

            <input class="btnLogSign" type="submit" id="submit" name="submit" value="Enviar">
        </fieldset>
    </form>

    <div>
        {{-- href="../../AdminUsuarios" --}}
        <a href="{{ route('admin.usuarios.index') }}">
            <button type="button" class="actions">Volver</button>
        </a>
    </div>
</main>
@endsection
