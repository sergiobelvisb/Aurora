<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AURORA – @yield('title', 'Plataforma EEG')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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
                            <a class="nav-link" href="{{ url('/panel-control') }}">Panel de control</a>
                        </li>
                    @endif
                    {{-- si hay sesión activa muestra perfil, si no login --}}
                    @if(session('userID'))
                        <li class="nav-item">
                            {{-- session->get('nombreCompleto') --}}
                            <a class="nav-link" href="{{ url('/perfil') }}">
                                <img src="{{ asset(session('foto', 'img/pfp/default.png')) }}" class="rounded-circle"
                                    width="32" height="32" alt="Foto de perfil">
                                {{ session('username') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-danger btn-sm ms-2 px-3" href="{{ url('/logout') }}">
                                Cerrar sesión
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login.form') }}">Iniciar sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary btn-sm ms-2 px-3 text-white" href="{{ url('/registro') }}">
                                Registrarse
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <main class="flex-grow-1"> 
        @yield('content')
    </main>

    <footer class="footer mt-auto py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Aurora EEG. Todos los derechos reservados.</p>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>