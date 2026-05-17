@extends('layouts.app')

@section('title', 'Aviso Legal')

@section('content')

<section class="py-5 bg-light">
    <div class="container">

        <div class="text-center mb-5">
            <h1 style="color:#355a6d;">Aviso Legal</h1>
            <p class="text-muted">
                Información legal y condiciones de uso
            </p>
        </div>

        <div class="card shadow-sm border-0 p-4">

            <h3 style="color:#355a6d;">1. Titular del sitio web</h3>

            <p>
                Este sitio web y plataforma tecnológica pertenecen a
                <strong>Aurora</strong>.
            </p>

            <hr>

            <h3 style="color:#355a6d;">2. Finalidad</h3>

            <p>
                Aurora proporciona herramientas de monitorización,
                almacenamiento y gestión de información neurológica
                y clínica mediante tecnología EEG.
            </p>

            <hr>

            <h3 style="color:#355a6d;">3. Condiciones de uso</h3>

            <p>
                El acceso a la plataforma implica la aceptación de
                las presentes condiciones legales.
            </p>

            <ul>
                <li>No utilizar la plataforma con fines ilícitos.</li>
                <li>No intentar acceder a información no autorizada.</li>
                <li>Garantizar la confidencialidad de las credenciales.</li>
            </ul>

            <hr>

            <h3 style="color:#355a6d;">4. Propiedad intelectual</h3>

            <p>
                Todo el contenido, diseño, código y estructura de Aurora
                están protegidos por derechos de propiedad intelectual.
            </p>

            <hr>

            <h3 style="color:#355a6d;">5. Responsabilidad</h3>

            <p>
                Aurora no será responsable de interrupciones del servicio,
                errores derivados de terceros o uso indebido por parte
                de usuarios autorizados o no autorizados.
            </p>

            <hr>

            <h3 style="color:#355a6d;">6. Legislación aplicable</h3>

            <p>
                Este sitio web se rige por la legislación española
                y europea vigente.
            </p>

        </div>
    </div>
</section>

@endsection