@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<style>
    .aurora-admin {
        font-family: 'Inter', 'Segoe UI', sans-serif;
        background: #F8FAFC;
        min-height: calc(100vh - 64px);
        padding: 2.5rem 1.5rem;
    }
    .aurora-page-header { margin-bottom: 1.75rem; }
    .aurora-page-header h1 {
        font-size: 1.75rem; font-weight: 700; color: #0F172A;
        margin: 0 0 0.2rem; letter-spacing: -0.02em;
    }
    .aurora-page-header p { font-size: 0.9rem; color: #64748B; margin: 0; }

    .aurora-alert {
        border-radius: 10px; padding: 0.85rem 1rem; font-size: 0.875rem;
        display: flex; align-items: center; gap: 0.6rem; margin-bottom: 1.25rem;
    }
    .aurora-alert svg { width: 18px; height: 18px; stroke: currentColor; flex-shrink: 0; }
    .aurora-alert-success { background: #F0FDF4; border: 1px solid #BBF7D0; color: #15803D; }
    .aurora-alert-danger  { background: #FFF1F2; border: 1px solid #FECDD3; color: #BE123C; }

    .aurora-layout {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 1.5rem;
        align-items: start;
    }
    @media (max-width: 768px) { .aurora-layout { grid-template-columns: 1fr; } }

    .aurora-card { background: #fff; border: 1px solid #E2E8F0; border-radius: 14px; overflow: hidden; }
    .aurora-card-header {
        padding: 1.25rem 1.5rem; border-bottom: 1px solid #F1F5F9;
        display: flex; align-items: center; gap: 0.75rem;
    }
    .aurora-card-header-icon {
        width: 36px; height: 36px; background: #EFF6FF; border-radius: 8px;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .aurora-card-header-icon svg { width: 18px; height: 18px; stroke: #2563EB; }
    .aurora-card-header h2 { font-size: 1rem; font-weight: 600; color: #0F172A; margin: 0; }
    .aurora-card-body { padding: 1.5rem; }

    .aurora-field { margin-bottom: 1.25rem; }
    .aurora-label {
        display: block; font-size: 0.8rem; font-weight: 600;
        color: #374151; margin-bottom: 0.4rem; letter-spacing: 0.01em;
    }
    .aurora-input {
        width: 100%; padding: 0.6rem 0.875rem; border: 1px solid #E2E8F0;
        border-radius: 8px; font-size: 0.875rem; color: #0F172A; background: #fff;
        transition: border-color 0.15s, box-shadow 0.15s; box-sizing: border-box; outline: none;
    }
    .aurora-input:hover  { border-color: #CBD5E1; }
    .aurora-input:focus  { border-color: #2563EB; box-shadow: 0 0 0 3px rgba(37,99,235,0.1); }
    .aurora-input::placeholder { color: #CBD5E1; }

    .aurora-divider { height: 1px; background: #F1F5F9; margin: 1.25rem 0; }

    /* Acciones principales */
    .aurora-actions { display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap; }

    .aurora-btn {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.6rem 1.25rem; border-radius: 8px; font-size: 0.875rem;
        font-weight: 600; cursor: pointer; text-decoration: none;
        border: none; transition: all 0.15s ease;
    }
    .aurora-btn svg { width: 16px; height: 16px; stroke: currentColor; flex-shrink: 0; }
    .aurora-btn-primary  { background: #2563EB; color: #fff; }
    .aurora-btn-primary:hover  { background: #1D4ED8; }
    .aurora-btn-outline  { background: #fff; color: #374151; border: 1px solid #E2E8F0; }
    .aurora-btn-outline:hover  { background: #F8FAFC; border-color: #CBD5E1; }
    .aurora-btn-danger   { background: #FFF1F2; color: #BE123C; border: 1px solid #FECDD3; }
    .aurora-btn-danger:hover   { background: #FFE4E6; border-color: #FDA4AF; }

    /* Panel lateral */
    .aurora-info-card { background: #fff; border: 1px solid #E2E8F0; border-radius: 14px; overflow: hidden; }
    .aurora-user-summary { padding: 1.5rem; text-align: center; border-bottom: 1px solid #F1F5F9; }
    .aurora-user-avatar-lg {
        width: 60px; height: 60px; border-radius: 50%; background: #EFF6FF; color: #2563EB;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.25rem; font-weight: 700; margin: 0 auto 0.75rem; text-transform: uppercase;
    }
    .aurora-user-summary h3 { font-size: 1rem; font-weight: 600; color: #0F172A; margin: 0 0 0.2rem; }
    .aurora-user-summary p  { font-size: 0.8rem; color: #94A3B8; margin: 0; }

    .aurora-meta-list { list-style: none; margin: 0; padding: 0; }
    .aurora-meta-list li {
        display: flex; align-items: center; justify-content: space-between;
        padding: 0.75rem 1.25rem; border-bottom: 1px solid #F8FAFC; font-size: 0.8rem;
    }
    .aurora-meta-list li:last-child { border-bottom: none; }
    .aurora-meta-label { color: #94A3B8; font-weight: 500; }
    .aurora-meta-value { color: #374151; font-weight: 600; }

    .aurora-badge { display: inline-block; padding: 0.2rem 0.6rem; border-radius: 999px; font-size: 0.72rem; font-weight: 600; }
    .aurora-badge-blue { background: #EFF6FF; color: #1D4ED8; }
    .aurora-badge-gray { background: #F1F5F9; color: #475569; }

    /* ── Zona de peligro ── */
    .aurora-danger-zone {
        margin-top: 1.5rem;
        border: 1px solid #FECDD3;
        border-radius: 14px;
        overflow: hidden;
        background: #fff;
    }
    .aurora-danger-zone-header {
        padding: 1rem 1.25rem;
        background: #FFF1F2;
        border-bottom: 1px solid #FECDD3;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }
    .aurora-danger-zone-header svg { width: 16px; height: 16px; stroke: #BE123C; flex-shrink: 0; }
    .aurora-danger-zone-header span { font-size: 0.85rem; font-weight: 700; color: #BE123C; }
    .aurora-danger-zone-body {
        padding: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .aurora-danger-zone-body p { font-size: 0.8rem; color: #64748B; margin: 0; flex: 1; min-width: 160px; }

    /* ── Modal de confirmación ── */
    .aurora-modal-backdrop {
        display: none;
        position: fixed; inset: 0;
        background: rgba(15, 23, 42, 0.45);
        backdrop-filter: blur(2px);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }
    .aurora-modal-backdrop.is-open { display: flex; }

    .aurora-modal {
        background: #fff;
        border-radius: 16px;
        width: 100%;
        max-width: 400px;
        margin: 1rem;
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        animation: modalIn 0.18s ease;
    }
    @keyframes modalIn {
        from { opacity: 0; transform: scale(0.95) translateY(8px); }
        to   { opacity: 1; transform: scale(1)    translateY(0);   }
    }
    .aurora-modal-icon {
        width: 52px; height: 52px;
        background: #FFF1F2; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 1.75rem auto 0;
    }
    .aurora-modal-icon svg { width: 26px; height: 26px; stroke: #DC2626; }
    .aurora-modal-body { padding: 1.25rem 1.75rem 0; text-align: center; }
    .aurora-modal-body h3 { font-size: 1.05rem; font-weight: 700; color: #0F172A; margin: 0.75rem 0 0.4rem; }
    .aurora-modal-body p  { font-size: 0.875rem; color: #64748B; margin: 0; line-height: 1.5; }
    .aurora-modal-body strong { color: #0F172A; }
    .aurora-modal-footer {
        display: flex; gap: 0.75rem;
        padding: 1.5rem 1.75rem;
        justify-content: flex-end;
    }
</style>

<div class="aurora-admin">

    <div class="aurora-page-header">
        <h1>Editar Usuario</h1>
        <p>Modifica los datos y permisos de acceso</p>
    </div>

    @if (session('success'))
        <div class="aurora-alert aurora-alert-success">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                <polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="aurora-alert aurora-alert-danger">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            {{ $errors->first() }}
        </div>
    @endif

    <div class="aurora-layout">

        {{-- Columna izquierda --}}
        <div>
            {{-- Formulario principal --}}
            <form action="{{ route('admin.usuarios.actualizar', $usuario->userID) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="aurora-card">
                    <div class="aurora-card-header">
                        <div class="aurora-card-header-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                        </div>
                        <h2>Datos del usuario</h2>
                    </div>

                    <div class="aurora-card-body">

                        <div class="aurora-field">
                            <label class="aurora-label" for="user">Nombre de usuario</label>
                            <input class="aurora-input" type="text" id="user" name="user"
                                value="{{ old('user', $usuario->username) }}"
                                placeholder="nombre de usuario" autocomplete="off">
                        </div>

                        <div class="aurora-field">
                            <label class="aurora-label" for="acl">Nivel de acceso (ACL)</label>
                            <input class="aurora-input" type="text" id="acl" name="acl"
                                value="{{ old('acl', $usuario->acl) }}"
                                placeholder="ej: admin, custom, viewer…" autocomplete="off">
                        </div>

                        <div class="aurora-divider"></div>

                        <div class="aurora-actions">
                            <button type="submit" class="aurora-btn aurora-btn-primary">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                    <polyline points="17 21 17 13 7 13 7 21"/>
                                    <polyline points="7 3 7 8 15 8"/>
                                </svg>
                                Guardar cambios
                            </button>

                            <a href="{{ route('admin.usuarios.index') }}" class="aurora-btn aurora-btn-outline">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="15 18 9 12 15 6"/>
                                </svg>
                                Volver
                            </a>
                        </div>

                    </div>
                </div>
            </form>

            {{-- Zona de peligro --}}
            <div class="aurora-danger-zone">
                <div class="aurora-danger-zone-header">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                        <line x1="12" y1="9" x2="12" y2="13"/>
                        <line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                    <span>Zona de peligro</span>
                </div>
                <div class="aurora-danger-zone-body">
                    <p>Eliminar este usuario es una acción permanente y no se puede deshacer.</p>
                    <button type="button" class="aurora-btn aurora-btn-danger" onclick="openDeleteModal()">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 6 5 6 21 6"/>
                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                            <path d="M10 11v6M14 11v6"/>
                            <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                        </svg>
                        Eliminar usuario
                    </button>
                </div>
            </div>
        </div>

        {{-- Panel lateral con info del usuario --}}
        <div class="aurora-info-card">
            <div class="aurora-user-summary">
                <div class="aurora-user-avatar-lg">
                    {{ strtoupper(substr($usuario->username, 0, 2)) }}
                </div>
                <h3>{{ $usuario->username }}</h3>
                <p>ID #{{ $usuario->userID }}</p>
            </div>
            <ul class="aurora-meta-list">
                <li>
                    <span class="aurora-meta-label">ID</span>
                    <span class="aurora-meta-value">#{{ $usuario->userID }}</span>
                </li>
                <li>
                    <span class="aurora-meta-label">ACL actual</span>
                    <span class="aurora-badge {{ $usuario->acl === 'admin' ? 'aurora-badge-blue' : 'aurora-badge-gray' }}">
                        {{ $usuario->acl }}
                    </span>
                </li>
            </ul>
        </div>

    </div>
</div>

{{-- ── Modal de confirmación de eliminado ── --}}
<div class="aurora-modal-backdrop" id="deleteModal" onclick="handleBackdropClick(event)">
    <div class="aurora-modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">

        <div class="aurora-modal-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="3 6 5 6 21 6"/>
                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                <path d="M10 11v6M14 11v6"/>
                <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
            </svg>
        </div>

        <div class="aurora-modal-body">
            <h3 id="modalTitle">¿Eliminar usuario?</h3>
            <p>
                Estás a punto de eliminar a <strong>{{ $usuario->username }}</strong>.
                Esta acción no se puede deshacer.
            </p>
        </div>

        <div class="aurora-modal-footer">
            <button type="button" class="aurora-btn aurora-btn-outline" onclick="closeDeleteModal()">
                Cancelar
            </button>

            {{-- Formulario DELETE oculto --}}
            <form action="{{ route('admin.usuarios.eliminar', $usuario->userID) }}" method="POST" style="margin:0">
                @csrf
                @method('DELETE')
                <button type="submit" class="aurora-btn aurora-btn-danger">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="3 6 5 6 21 6"/>
                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                        <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                    </svg>
                    Sí, eliminar
                </button>
            </form>
        </div>

    </div>
</div>

<script>
    function openDeleteModal()  {
        document.getElementById('deleteModal').classList.add('is-open');
        document.body.style.overflow = 'hidden';
    }
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('is-open');
        document.body.style.overflow = '';
    }
    // Cierra si se hace click en el fondo oscuro
    function handleBackdropClick(e) {
        if (e.target === document.getElementById('deleteModal')) closeDeleteModal();
    }
    // Cierra con Escape
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeDeleteModal();
    });
</script>

@endsection