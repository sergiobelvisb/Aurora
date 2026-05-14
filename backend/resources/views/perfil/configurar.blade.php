@extends('layouts.app')

@section('title', 'Configuración de Perfil')

@section('content')
<div class="login-container d-flex justify-content-center align-items-center py-5">
    <div class="login-card p-5 shadow-sm rounded" style="max-width:580px; width:100%">

        <h2 class="text-center mb-4">Configuración de Perfil</h2>

        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger text-center">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('perfil.actualizar') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            {{-- ── FOTO ── --}}
            <div class="text-center mb-4">
                <img src="{{ asset($fotodeperfil) }}"
                     alt="Foto de perfil"
                     id="preview-foto"
                     class="rounded-circle border mb-3"
                     style="width:110px; height:110px; object-fit:cover">
                <div>
                    <label class="form-label d-block text-muted" style="font-size:0.85rem">
                        Foto de perfil (JPG/JPEG · máx. 2 MB)
                    </label>
                    <input type="file" name="foto_perfil" id="input-imagen"
                           accept=".jpg,.jpeg,image/jpeg"
                           class="form-control @error('foto_perfil') is-invalid @enderror"
                           onchange="previewFoto(event)">
                    @error('foto_perfil')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr class="mb-4">

            {{-- ── NOMBRE COMPLETO ── --}}
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control"
                           value="{{ $nombre }}" placeholder="Nombre">
                </div>
                <div class="col">
                    <label class="form-label">Primer apellido</label>
                    <input type="text" name="apellido1" class="form-control"
                           value="{{ $apellido1 }}" placeholder="Primer apellido">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Segundo apellido</label>
                <input type="text" name="apellido2" class="form-control"
                       value="{{ $apellido2 }}" placeholder="Segundo apellido (opcional)">
            </div>

            {{-- ── EMAIL ── --}}
            <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <input type="email" name="email" class="form-control"
                       value="{{ $email }}" placeholder="correo@ejemplo.com">
            </div>

            {{-- ── USUARIO ── --}}
            <div class="mb-3">
                <label for="username" class="form-label">Nombre de usuario</label>
                <input type="text" id="username" name="username"
                       class="form-control @error('username') is-invalid @enderror"
                       value="{{ $usuario }}" required>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- ── CONTRASEÑA ── --}}
            <div class="mb-3">
                <label for="password" class="form-label">Nueva contraseña</label>
                <input type="password" id="password" name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Dejar vacío para no cambiar">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- ── HOSPITAL ── --}}
            <div class="mb-3">
                <label for="hospitalID" class="form-label">Hospital</label>
                <select name="hospitalID" id="hospitalID" class="form-control">
                    <option value="">— Sin hospital —</option>
                    @foreach ($hospitales as $h)
                        <option value="{{ $h['hospitalID'] }}"
                            {{ ($hospital && $hospital['hospitalID'] == $h['hospitalID']) ? 'selected' : '' }}>
                            {{ $h['nombre'] }} — {{ $h['ubicacion'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- ── ACL solo admins ── --}}
            @if ($admin)
            <div class="mb-4">
                <label for="acl" class="form-label">Rol ACL</label>
                <select id="acl" name="acl" class="form-control">
                    @foreach (['Administrador', 'Medico', 'Tecnico'] as $rol)
                        <option value="{{ $rol }}" {{ $acl === $rol ? 'selected' : '' }}>
                            {{ $rol }}
                        </option>
                    @endforeach
                </select>
            </div>
            @endif

            {{-- ── BOTONES principales ── --}}
            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('perfil.show') }}" class="btn btn-outline-secondary w-50">← Cancelar</a>
                <button type="submit" class="btn btn-primary w-50">Guardar cambios</button>
            </div>

            {{-- ── Eliminar cuenta solo admins ── --}}
            @if ($admin)
            <div class="mt-3">
                <a href="{{ url('/aviso') }}" class="btn btn-outline-danger w-100">Eliminar cuenta</a>
            </div>
            @endif

        </form>
    </div>
</div>

@push('scripts')
<script>
function previewFoto(event) {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => document.getElementById('preview-foto').src = e.target.result;
    reader.readAsDataURL(file);
}
</script>
@endpush

@endsection