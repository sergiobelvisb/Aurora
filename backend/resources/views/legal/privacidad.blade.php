@extends('layouts.app')

@section('title', 'Política de Privacidad')

@section('content')

<section class="py-5 bg-light">
    <div class="container">

        <div class="text-center mb-5">
            <h1 style="color:#355a6d;">Política de Privacidad</h1>
            <p class="text-muted">
                Protección de datos y cumplimiento RGPD
            </p>
        </div>

        <div class="card shadow-sm border-0 p-4">

            <p class="text-muted">
                Última actualización: 16 de mayo de 2026
            </p>

            <hr>

            <h3 style="color:#355a6d;">1. Responsable del tratamiento</h3>
            <p>
                En cumplimiento del Reglamento (UE) 2016/679 (RGPD) y la
                Ley Orgánica 3/2018 (LOPDGDD), se informa que los datos
                personales tratados a través de Aurora serán responsabilidad de:
            </p>

            <ul>
                <li><strong>Aurora</strong></li>
                <li>Email: contacto@aurora-eeg.com</li>
            </ul>

            <hr>

            <h3 style="color:#355a6d;">2. Finalidad del tratamiento</h3>

            <p>Los datos tratados mediante esta plataforma se utilizarán para:</p>

            <ul>
                <li>Gestión de usuarios médicos y técnicos autorizados.</li>
                <li>Gestión de pacientes y sesiones clínicas.</li>
                <li>Procesamiento y almacenamiento de datos EEG.</li>
                <li>Control de acceso y autenticación.</li>
                <li>Garantizar la seguridad e integridad del sistema.</li>
                <li>Cumplimiento de obligaciones legales.</li>
            </ul>

            <hr>

            <h3 style="color:#355a6d;">3. Datos recopilados</h3>

            <ul>
                <li>Nombre y apellidos</li>
                <li>Correo electrónico</li>
                <li>Información clínica y sanitaria</li>
                <li>Datos técnicos y de sesión</li>
                <li>Dirección IP y registros de acceso</li>
            </ul>

            <hr>

            <h3 style="color:#355a6d;">4. Base legal</h3>

            <p>
                El tratamiento de datos se basa en:
            </p>

            <ul>
                <li>Consentimiento explícito del usuario.</li>
                <li>Prestación de servicios sanitarios.</li>
                <li>Cumplimiento de obligaciones legales.</li>
                <li>Interés legítimo en la seguridad del sistema.</li>
            </ul>

            <hr>

            <h3 style="color:#355a6d;">5. Conservación de datos</h3>

            <p>
                Los datos se conservarán mientras exista relación activa
                con la plataforma y durante los plazos legalmente exigidos.
            </p>

            <hr>

            <h3 style="color:#355a6d;">6. Seguridad</h3>

            <p>
                Aurora aplica medidas técnicas y organizativas para proteger
                la información:
            </p>

            <ul>
                <li>Contraseñas cifradas.</li>
                <li>Control de acceso por roles.</li>
                <li>Sesiones seguras.</li>
                <li>Conexiones HTTPS/TLS.</li>
                <li>Infraestructura cloud segura.</li>
                <li>Copias de seguridad cifradas.</li>
            </ul>

            <hr>

            <h3 style="color:#355a6d;">7. Derechos del usuario</h3>

            <p>
                Los usuarios podrán ejercer:
            </p>

            <ul>
                <li>Derecho de acceso.</li>
                <li>Derecho de rectificación.</li>
                <li>Derecho de supresión.</li>
                <li>Derecho de oposición.</li>
                <li>Derecho a la limitación del tratamiento.</li>
                <li>Derecho a la portabilidad.</li>
            </ul>

            <p>
                Para ejercer estos derechos:
                <strong>admin@aurora.com</strong>
            </p>

            <hr>

            <h3 style="color:#355a6d;">8. Consentimiento</h3>

            <p>
                Al utilizar Aurora, el usuario declara haber leído y aceptado
                esta Política de Privacidad y consiente expresamente el
                tratamiento de sus datos personales y sanitarios.
            </p>

            <hr>

            <h3 style="color:#355a6d;">9. Cambios en la política</h3>

            <p>
                Aurora podrá actualizar esta Política de Privacidad para
                adaptarla a cambios legales o técnicos.
            </p>

        </div>
    </div>
</section>

@endsection