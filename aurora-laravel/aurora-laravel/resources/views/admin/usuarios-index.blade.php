@extends('layouts.app')

@section('title', 'Administrar Usuarios')

@section('content')
<h1>Administrar Usuarios</h1>

<main>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>ACL</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            {{-- foreach ($this->data['usuarios'] as $reg) --}}
            @forelse ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario['userID'] ?? $usuario->userID }}</td>
                    <td>
                        {{-- href='$http->getUrlBase()."/AdminUsuarios/Usuario/{id}"' --}}
                        <a href="{{ route('admin.usuarios.show', $usuario['userID'] ?? $usuario->userID) }}">
                            {{ $usuario['username'] ?? $usuario->username }}
                        </a>
                    </td>
                    <td>{{ $usuario['acl'] ?? $usuario->acl }}</td>
                    <td>
                        <a href="{{ route('admin.usuarios.show', $usuario['userID'] ?? $usuario->userID) }}"
                           class="btn btn-sm btn-outline-primary">
                            Ver
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No hay usuarios registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{-- href="<?= $http->getUrlBase();?>/VistasAdministrador" --}}
        <a href="{{ url('/vistas-administrador') }}">
            <button class="actions">Volver</button>
        </a>
    </div>
</main>
@endsection
