@extends('layouts.app')

@section('title', 'Para Profesionales')

@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Diseñado para Profesionales Médicos</h2>
            <p>Aurora permite a hospitales y clínicas integrar análisis EEG en sus protocolos de prevención y diagnóstico temprano.</p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card p-4 h-100">
                    <h5>Historiales Centralizados</h5>
                    <p>Todos los registros de pacientes se almacenan de forma centralizada, permitiendo un acceso rápido y seguro.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 h-100">
                    <h5>Acceso Seguro y Cifrado</h5>
                    <p>Datos sensibles protegidos con protocolos de seguridad de última generación para garantizar confidencialidad.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 h-100">
                    <h5>Mejora en la toma de decisiones clínicas</h5>
                    <p>La visualización en tiempo real de la actividad cerebral permite al personal sanitario disponer de información inmediata durante la monitorización, facilitando la observación del estado del paciente en cada momento.</p>
                </div>
            </div>
        </div>

        <div class="row g-4 align-items-center">
            <div class="col-md-6 text-center">
                <img src="{{ asset('img/panel_de_control.png') }}"
                     alt="Panel de Control Médico"
                     class="img-fluid"
                     style="max-height: 400px;">
            </div>
            <div class="col-md-6">
                <h3>Panel de Control Médico</h3>
                <p>
                    Interfaz intuitiva que centraliza todas las sesiones EEG de tus pacientes. 
                    Accede al historial de análisis, consulta métricas cerebrales detalladas y añade notas clínicas en cada sesión.
                </p>
                <ul>
                    <li>✔ Visualización clara de métricas EEG</li>
                    <li>✔ Gráficos interactivos</li>
                    <li>✔ Gestión de múltiples pacientes simultáneamente</li>
                </ul>
            </div>
        </div>

        <div class="row g-4 mt-5">
            <div class="col-md-4">
                <div class="card p-4 h-100">
                    <h5>Seguimiento contínuo del estado del paciente</h5>
                    <p>La plataforma proporciona una visualización constante de los datos cerebrales durante la sesión, permitiendo al personal sanitario observar la evolución del paciente en tiempo real.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 h-100">
                    <h5>Compatibilidad Multiusuario</h5>
                    <p>Permite múltiples perfiles y roles dentro del hospital para que médicos, técnicos y administrativos trabajen de forma colaborativa.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 h-100">
                    <h5>Integración con Sistemas Hospitalarios</h5>
                    <p>Se conecta con sistemas internos de los hospitales para importar y exportar datos sin duplicidades ni errores.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
