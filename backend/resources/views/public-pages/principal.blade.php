@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

{{-- HERO --}}
<section class="hero text-center">
    <div class="container">
        {{-- src="public/img/NombreyLogo.png" --}}
        <img src="{{ asset('img/NombreyLogo.png') }}" alt="Aurora EEG" class="hero-logo">
        <h1>Monitorización cerebral avanzada</h1>
        <p class="hero-slogan mt-2">Detectando el futuro de la salud neurológica</p>
        <a href="{{ route('login.form') }}" class="btn btn-primary btn-lg mt-4">
            Acceder a la plataforma
        </a>
    </div>
</section>

{{-- MÉTRICAS --}}
<section class="py-5 text-center bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2 class="fw-bold" style="color:#355a6d;">+12.000</h2>
                <p>Registros EEG analizados</p>
            </div>
            <div class="col-md-4">
                <h2 class="fw-bold" style="color:#355a6d;">98%</h2>
                <p>Precisión en detección temprana</p>
            </div>
            <div class="col-md-4">
                <h2 class="fw-bold" style="color:#355a6d;">24/7</h2>
                <p>Monitorización continua</p>
            </div>
        </div>
    </div>
</section>

{{-- CÓMO FUNCIONA --}}
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 style="color:#355a6d;">¿Cómo funciona Aurora?</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card p-4 h-100">
                    <h5>1. Captación EEG</h5>
                    <p>Dispositivos certificados registran actividad cerebral con alta precisión.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 h-100">
                    <h5>2. Procesamiento Inteligente</h5>
                    <p>Algoritmos analizan patrones y detectan anomalías tempranas.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 h-100">
                    <h5>3. Informe Clínico</h5>
                    <p>Profesionales acceden a reportes detallados y visualizaciones claras.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- PROFESIONALES --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 style="color:#355a6d;">Diseñado para profesionales médicos</h2>
                <p class="mt-3">
                    Aurora permite a hospitales y clínicas integrar análisis EEG en sus
                    protocolos de prevención y diagnóstico temprano.
                </p>
                <ul>
                    <li>✔ Historiales centralizados</li>
                    <li>✔ Acceso seguro cifrado</li>
                    <li>✔ Informes exportables</li>
                    <li>✔ Gestión de pacientes</li>
                </ul>
            </div>
           {{-- TESTIMONIOS --}}
            <div class="col-md-6">
                <div class="card p-4 mb-3 shadow-sm border-0">
                    <div class="d-flex align-items-start gap-3">
                        <div class="fs-2">🧠</div>
                        <div>
                            <p class="mb-1 fst-italic text-muted">
                                "Aurora ha reducido nuestro tiempo de diagnóstico en un 40%.
                                La visualización de patrones EEG es clara e inmediata."
                            </p>
                            <strong style="color:#355a6d;">Dra. Carmen Ruiz</strong>
                            <small class="text-muted d-block">Neuróloga – Hospital Clínic de Barcelona</small>
                        </div>
                    </div>
                </div>
                <div class="card p-4 shadow-sm border-0">
                    <div class="d-flex align-items-start gap-3">
                        <div class="fs-2">🩺</div>
                        <div>
                            <p class="mb-1 fst-italic text-muted">
                                "La integración con nuestros protocolos fue sencilla.
                                Ahora detectamos epilepsia focal en fases muy tempranas."
                            </p>
                            <strong style="color:#355a6d;">Dr. Marcos Ibáñez</strong>
                            <small class="text-muted d-block">Jefe de Neurología – Clínica Universidad de Navarra</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CONTACTO --}}
<section class="py-5">
    <div class="container">
        <div class="text-center mb-4">
            <h2 style="color:#355a6d;">Contacto Institucional</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ url('/contacto') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mensaje</label>
                        <textarea name="mensaje" class="form-control" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Enviar solicitud</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
