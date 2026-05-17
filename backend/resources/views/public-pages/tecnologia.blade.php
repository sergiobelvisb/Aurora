@extends('layouts.app')

@section('title', 'Tecnología')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Tecnología de Aurora EEG</h2>
            <p>Monitorización cerebral avanzada mediante dispositivos EEG de última generación.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card p-4 h-100">
                    <h5>Dispositivos EEG Portátiles</h5>
                    <p>Diseñados para registrar la actividad cerebral en cualquier entorno con máxima comodidad y precisión.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 h-100">
                    <h5>Visualización y Gestión de Datos en Tiempo Real</h5>
                    <p>El sistema permite recibir y representar en tiempo real las ondas cerebrales captadas por el dispositivo EEG mediante gráficas dinámicas accesibles desde la aplicación web. Esto facilita al personal médico observar la evolución de la actividad cerebral de forma inmediata y organizada durante cada sesión de monitorización.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 h-100">
                    <h5>Visualización Clara</h5>
                    <p>Interfaz intuitiva para profesionales, mostrando gráficos, métricas y reportes clínicos en tiempo real, accesibles desde cualquier dispositivo.</p>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-5 align-items-center">
            <div class="col-md-6 text-center">
                <img src="{{ asset('img/Logo.png') }}" alt="Aurora EEG" class="img-fluid" style="max-height: 400px;">
            </div>
            <div class="col-md-6">
                <h3>Integración con Hospitales y Clínicas</h3>
                <p>
                    Aurora se integra fácilmente con los sistemas de hospitales y clínicas, permitiendo registrar,
                    almacenar y analizar información de manera segura y cifrada.
                </p>
                <ul>
                    <li>✔ Dispositivos certificados</li>
                    <li>✔ Interfaz segura y cifrada</li>
                    <li>✔ Gestión multiusuario y roles diferenciados</li>
                </ul>
            </div>
        </div>

        <div class="row g-4 mt-5">
            <div class="col-md-4">
                <div class="card p-4 h-100">
                    <h5>Seguridad de Datos</h5>
                    <p>Toda la información se almacena siguiendo estrictos protocolos de privacidad y cifrado, garantizando confidencialidad de pacientes.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 h-100">
                    <h5>Gestión de Sesiones de Monitorización</h5>
                    <p>La plataforma permite iniciar y gestionar sesiones de monitorización cerebral asociadas a cada paciente, almacenando las mediciones realizadas y facilitando su posterior consulta desde la aplicación web.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 h-100">
                    <h5>Escalabilidad</h5>
                    <p>Compatible con hospitales grandes o pequeños, y adaptable a nuevas tecnologías de monitorización y análisis EEG.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
