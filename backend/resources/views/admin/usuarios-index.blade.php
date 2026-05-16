@extends('layouts.app')

@section('title', 'Administrar Usuarios')

@section('content')
<style>
    .aurora-admin {
        font-family: 'Inter', 'Segoe UI', sans-serif;
        background: #F8FAFC;
        min-height: calc(100vh - 64px);
        padding: 2.5rem 1.5rem;
    }

    .aurora-page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.75rem;
    }

    .aurora-page-header-left h1 {
        font-size: 1.75rem;
        font-weight: 700;
        color: #0F172A;
        margin: 0 0 0.2rem;
        letter-spacing: -0.02em;
    }

    .aurora-page-header-left p {
        font-size: 0.9rem;
        color: #64748B;
        margin: 0;
    }

    .aurora-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.55rem 1.1rem;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        border: none;
        transition: all 0.15s ease;
    }

    .aurora-btn-primary {
        background: #2563EB;
        color: #fff;
    }

    .aurora-btn-primary:hover {
        background: #1D4ED8;
    }

    .aurora-btn-outline {
        background: #fff;
        color: #374151;
        border: 1px solid #E2E8F0;
    }

    .aurora-btn-outline:hover {
        background: #F8FAFC;
        border-color: #CBD5E1;
    }

    .aurora-btn-sm {
        padding: 0.35rem 0.75rem;
        font-size: 0.8rem;
        border-radius: 6px;
    }

    .aurora-alert {
        border-radius: 10px;
        padding: 0.85rem 1rem;
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        margin-bottom: 1.25rem;
    }

    .aurora-alert-success {
        background: #F0FDF4;
        border: 1px solid #BBF7D0;
        color: #15803D;
    }

    .aurora-alert svg {
        width: 18px;
        height: 18px;
        stroke: currentColor;
        flex-shrink: 0;
    }

    .aurora-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        overflow: hidden;
    }

    .aurora-table {
        width: 100%;
        border-collapse: collapse;
    }

    .aurora-table thead {
        background: #F8FAFC;
        border-bottom: 1px solid #E2E8F0;
    }

    .aurora-table th {
        text-align: left;
        padding: 0.9rem 1.25rem;
        font-size: 0.72rem;
        font-weight: 600;
        color: #94A3B8;
        letter-spacing: 0.07em;
        text-transform: uppercase;
    }

    .aurora-table td {
        padding: 1rem 1.25rem;
        font-size: 0.875rem;
        color: #374151;
        border-bottom: 1px solid #F1F5F9;
        vertical-align: middle;
    }

    .aurora-table tbody tr:last-child td {
        border-bottom: none;
    }

    .aurora-table tbody tr:hover td {
        background: #FAFBFF;
    }

    .aurora-user-cell {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .aurora-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #EFF6FF;
        color: #2563EB;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 700;
        flex-shrink: 0;
        text-transform: uppercase;
    }

    .aurora-user-link {
        color: #2563EB;
        text-decoration: none;
        font-weight: 500;
    }

    .aurora-user-link:hover {
        text-decoration: underline;
    }

    .aurora-badge {
        display: inline-block;
        padding: 0.2rem 0.6rem;
        border-radius: 999px;
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.03em;
    }

    .aurora-badge-blue {
        background: #EFF6FF;
        color: #1D4ED8;
    }

    .aurora-badge-gray {
        background: #F1F5F9;
        color: #475569;
    }

    .aurora-empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #94A3B8;
        font-size: 0.9rem;
    }

    .aurora-empty-state svg {
        width: 40px;
        height: 40px;
        stroke: #CBD5E1;
        margin-bottom: 0.75rem;
    }

    .aurora-footer-bar {
        display: flex;
        justify-content: flex-start;
        padding-top: 1.25rem;
    }
</style>

<div class="aurora-admin">

    <div class="aurora-page-header">
        <div class="aurora-page-header-left">
            <h1>Usuarios</h1>
            <p>Gestión de cuentas y niveles de acceso</p>
        </div>
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

    <div class="aurora-card">
        <table class="aurora-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>ACL</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($usuarios as $usuario)
                    @php
                        $uid      = $usuario['userID']  ?? $usuario->userID;
                        $uname    = $usuario['username'] ?? $usuario->username;
                        $uacl     = $usuario['acl']     ?? $usuario->acl;
                        $initials = strtoupper(substr($uname, 0, 2));
                    @endphp
                    <tr>
                        <td style="color:#94A3B8; font-size:0.8rem;">#{{ $uid }}</td>
                        <td>
                            <div class="aurora-user-cell">
                                <div class="aurora-avatar">{{ $initials }}</div>
                                <a href="{{ route('admin.usuarios.show', $uid) }}" class="aurora-user-link">
                                    {{ $uname }}
                                </a>
                            </div>
                        </td>
                        <td>
                            <span class="aurora-badge {{ $uacl === 'admin' ? 'aurora-badge-blue' : 'aurora-badge-gray' }}">
                                {{ $uacl }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.usuarios.show', $uid) }}" class="aurora-btn aurora-btn-outline aurora-btn-sm">
                                Ver perfil
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <div class="aurora-empty-state">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                                <p>No hay usuarios registrados.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="aurora-footer-bar">
        <a href="{{ url('/vistas-administrador') }}" class="aurora-btn aurora-btn-outline">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
            Volver al panel
        </a>
    </div>

</div>
@endsection