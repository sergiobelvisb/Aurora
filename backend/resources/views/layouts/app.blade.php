<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AURORA – @yield('title', 'Plataforma EEG')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @stack('styles')
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('img/Logo.png') }}" alt="Aurora EEG" height="40">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/tecnologia') }}">Tecnología</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/profesionales') }}">Profesionales</a>
                    </li>
                    @if(session('acl') === 'Administrador' || session('acl') === 'Medico')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('panel.index') }}">Panel de control</a>
                        </li>
                    @endif
                    @if(session('acl') === 'Administrador')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Administración</a>
                        </li>
                    @endif
                    @if(session('userID'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/perfil') }}">
                                <img src="{{ asset('img/pfp/' . session('foto')) }}" class="rounded-circle"
                                    width="32" height="32" alt="Foto de perfil">
                                {{ session('username') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-sm ms-2 px-3" href="{{ url('/logout') }}">
                                Cerrar sesión
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login.form') }}">Iniciar sesión</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <main class="flex-grow-1"> 
        @yield('content')
    </main>

    <footer class="footer mt-auto py-5">
        <div class="container">
            <div class="row gy-4">

                {{-- Columna 1: Info --}}
                <div class="col-md-4 text-center text-md-start">
                    <h6 class="fw-bold mb-3">Aurora EEG</h6>
                    <p class="mb-1 small">contacto@aurora-eeg.com</p>
                    <p class="mb-0 small">+34 915 401 626</p>
                </div>

                {{-- Columna 2: Proyecto --}}
                <div class="col-md-4 text-center">
                    <h6 class="fw-bold mb-3">Proyecto</h6>
                    <a href="https://github.com/sergiobelvisb/Aurora" target="_blank" class="d-block small mb-1 text-decoration-none">
                        Repositorio GitHub
                    </a>
                    <a href="{{ route('privacidad') }}" class="d-block small mb-1 text-decoration-none">Política de Privacidad</a>
                    <a href="{{ route('legal') }}" class="d-block small text-decoration-none">Aviso Legal</a>
                </div>

                {{-- Columna 3: Equipo --}}
                <div class="col-md-4 text-center text-md-end">
                    <h6 class="fw-bold mb-3">Equipo</h6>
                    <a href="https://www.linkedin.com/in/sergiobelvisb/" target="_blank" class="d-block small mb-1 text-decoration-none">
                        Sergio Belvís Barba
                    </a>
                    <a href="https://www.linkedin.com/in/brian-camba-hip%C3%B3lito-7aaa5133b/" target="_blank" class="d-block small mb-1 text-decoration-none">
                        Brian Camba Hipólito
                    </a>
                    <a href="https://www.linkedin.com/in/damiemrave/" target="_blank" class="d-block small text-decoration-none">
                        Damiem Rave Grizales
                    </a>
                </div>

            </div>

            <hr class="my-4">

            <p class="text-center mb-0 small">&copy; {{ date('Y') }} Aurora EEG. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>