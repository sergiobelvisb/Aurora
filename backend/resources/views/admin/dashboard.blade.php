@extends('layouts.app')

@section('title', 'Panel Administrador')

@section('content')
<style>
    .aurora-admin {
        font-family: 'Inter', 'Segoe UI', sans-serif;
        background: #F8FAFC;
        min-height: calc(100vh - 64px);
        padding: 2.5rem 1.5rem;
    }

    .aurora-page-header {
        margin-bottom: 2rem;
    }

    .aurora-page-header h1 {
        font-size: 1.75rem;
        font-weight: 700;
        color: #0F172A;
        margin: 0 0 0.25rem;
        letter-spacing: -0.02em;
    }

    .aurora-page-header p {
        color: #64748B;
        font-size: 0.95rem;
        margin: 0;
    }

    .aurora-welcome-card {
        background: linear-gradient(135deg, #1D4ED8 0%, #2563EB 60%, #3B82F6 100%);
        border-radius: 16px;
        padding: 2rem 2rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 1.25rem;
    }

    .aurora-welcome-icon {
        width: 52px;
        height: 52px;
        background: rgba(255,255,255,0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .aurora-welcome-icon svg {
        width: 28px;
        height: 28px;
        stroke: #fff;
    }

    .aurora-welcome-text h2 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #fff;
        margin: 0 0 0.2rem;
    }

    .aurora-welcome-text p {
        font-size: 0.875rem;
        color: rgba(255,255,255,0.75);
        margin: 0;
    }

    .aurora-section-title {
        font-size: 0.75rem;
        font-weight: 600;
        color: #94A3B8;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        margin-bottom: 0.75rem;
    }

    .aurora-nav-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 1rem;
    }

    .aurora-nav-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 1.25rem 1.25rem;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: all 0.18s ease;
        cursor: pointer;
    }

    .aurora-nav-card:hover {
        border-color: #2563EB;
        box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
        transform: translateY(-1px);
    }

    .aurora-nav-card-icon {
        width: 44px;
        height: 44px;
        background: #EFF6FF;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .aurora-nav-card-icon svg {
        width: 22px;
        height: 22px;
        stroke: #2563EB;
    }

    .aurora-nav-card-content h3 {
        font-size: 0.9rem;
        font-weight: 600;
        color: #0F172A;
        margin: 0 0 0.15rem;
    }

    .aurora-nav-card-content p {
        font-size: 0.78rem;
        color: #94A3B8;
        margin: 0;
    }

    .aurora-nav-card-arrow {
        margin-left: auto;
        color: #CBD5E1;
        flex-shrink: 0;
    }

    .aurora-nav-card-arrow svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
    }
</style>

<div class="aurora-admin">

    <div class="aurora-page-header">
        <h1>Panel de Administración</h1>
        <p>Gestiona los recursos del sistema Aurora</p>
    </div>

    <div class="aurora-welcome-card">
        <div class="aurora-welcome-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
        </div>
        <div class="aurora-welcome-text">
            <h2>Bienvenido, {{ session('username') }}</h2>
            <p>Accede a las herramientas de administración desde aquí.</p>
        </div>
    </div>

    <div class="aurora-section-title">Accesos rápidos</div>

    <div class="aurora-nav-grid">
        <a href="{{ route('admin.usuarios.index') }}" class="aurora-nav-card">
            <div class="aurora-nav-card-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <div class="aurora-nav-card-content">
                <h3>Administrar Usuarios</h3>
                <p>Gestión de cuentas y permisos</p>
            </div>
            <div class="aurora-nav-card-arrow">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </div>
        </a>

    </div>

</div>
@endsection