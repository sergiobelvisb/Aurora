{{--
    MIGRACIÓN: ViewProfesionales.inc.php → public-pages/profesionales.blade.php

    Cambios clave:
    - $http->getUrlBase().'/public/img/panel-control.png' → asset('img/panel-control.png')
    - Sin variables PHP dinámicas, migración directa
--}}

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
                    <h5>Informes Exportables</h5>
                    <p>Genera reportes clínicos en PDF o CSV para compartir fácilmente con otros profesionales o sistemas hospitalarios.</p>
                </div>
            </div>
        </div>

        <div class="row g-4 align-items-center">
            <div class="col-md-6 text-center">
                {{-- Tu: src="<?=$http->getUrlBase()?>/public/img/panel-control.png" --}}
                <img src="{{ asset('img/panel-control.png') }}"
                     alt="Panel de Control Médico"
                     class="img-fluid"
                     style="max-height: 400px;">
            </div>
            <div class="col-md-6">
                <h3>Panel de Control Médico</h3>
                <p>
                    Interfaz intuitiva que permite visualizar métricas cerebrales de pacientes en tiempo real.
                    Filtra por edad, historial o condición para un análisis detallado y toma de decisiones rápida.
                </p>
                <ul>
                    <li>✔ Visualización clara de métricas EEG</li>
                    <li>✔ Filtros avanzados y gráficos interactivos</li>
                    <li>✔ Gestión de múltiples pacientes simultáneamente</li>
                    <li>✔ Exportación de datos y reportes completos</li>
                </ul>
            </div>
        </div>

        <div class="row g-4 mt-5">
            <div class="col-md-4">
                <div class="card p-4 h-100">
                    <h5>Alertas Automatizadas</h5>
                    <p>Recibe notificaciones inmediatas sobre anomalías detectadas en el EEG para actuar de manera proactiva.</p>
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