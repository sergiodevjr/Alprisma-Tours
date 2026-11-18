@props(['titulo' => 'Alprisma Tours'])
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $titulo }} - Alprisma Tours</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --bs-primary: #13a5a5;
            --bs-primary-rgb: 15, 118, 110;
        }

        /* Fondo de toda la página */
        body {
            background: linear-gradient(160deg, #ecf0fd 0%, #f0fdfa 45%, #fff7ed 100%) fixed;
        }

        /* Barra de navegación */
        .navbar.bg-primary {
            background: linear-gradient(90deg, #070c0c 0%, #1e927e 100%) !important;
        }
        .navbar-nav .nav-link {
            border-radius: 50rem;
            padding-left: 0.9rem;
            padding-right: 0.9rem;
        }
        .navbar-nav .nav-link.active {
            background: rgba(7, 5, 5, 0.22);
            color: #fff !important;
        }

        /* Títulos */
        main h3 {
            color: #0f766e;
            font-weight: 700;
        }

        /* Tarjetas */
        .card {
            border: 0;
            border-radius: 1rem;
            box-shadow: 0 4px 14px rgba(15, 118, 110, 0.12) !important;
        }
        .card-header {
            background-image: linear-gradient(90deg, #0f766e, #14b8a6) !important;
            color: #fff !important;
            border: 0;
            border-radius: 1rem 1rem 0 0 !important;
        }

        /* Tarjetas con borde de color (dashboard y catálogo) */
        .card.border-top {
            border-top: 5px solid #0f766e !important;
            transition: transform 0.2s ease;
        }
        .card.border-top:hover {
            transform: translateY(-5px);
        }
        .card.border-top .display-6 { color: #0f766e; }
        .card.border-top .fs-3 { color: #0f766e; }

        .resumen > [class*="col-"]:nth-child(4n+2) > .card.border-top { border-top-color: #f59e0b !important; }
        .resumen > [class*="col-"]:nth-child(4n+2) > .card.border-top .display-6 { color: #d97706; }

        .resumen > [class*="col-"]:nth-child(4n+3) > .card.border-top { border-top-color: #0ea5e9 !important; }
        .resumen > [class*="col-"]:nth-child(4n+3) > .card.border-top .display-6 { color: #0284c7; }

        .resumen > [class*="col-"]:nth-child(4n+4) > .card.border-top { border-top-color: #e11d48 !important; }
        .resumen > [class*="col-"]:nth-child(4n+4) > .card.border-top .display-6 { color: #be123c; }

        /* Botones */
        .btn-primary {
            --bs-btn-bg: #0f766e;
            --bs-btn-border-color: #0f766e;
            --bs-btn-hover-bg: #115e59;
            --bs-btn-hover-border-color: #115e59;
            --bs-btn-active-bg: #134e4a;
            --bs-btn-active-border-color: #134e4a;
            --bs-btn-disabled-bg: #0f766e;
            --bs-btn-disabled-border-color: #0f766e;
        }
        .btn-outline-primary {
            --bs-btn-color: #0f766e;
            --bs-btn-border-color: #0f766e;
            --bs-btn-hover-bg: #0f766e;
            --bs-btn-hover-border-color: #0f766e;
            --bs-btn-active-bg: #0f766e;
            --bs-btn-active-border-color: #0f766e;
        }
        .btn-dark {
            --bs-btn-bg: #f59e0b;
            --bs-btn-border-color: #f59e0b;
            --bs-btn-color: #fff;
            --bs-btn-hover-bg: #d97706;
            --bs-btn-hover-border-color: #d97706;
            --bs-btn-hover-color: #fff;
            --bs-btn-active-bg: #b45309;
            --bs-btn-active-border-color: #b45309;
            --bs-btn-active-color: #fff;
        }

        /* Tablas */
        .table thead.table-light {
            --bs-table-bg: #0f766e;
            --bs-table-color: #fff;
            --bs-table-border-color: #0f766e;
        }
        .table thead.table-light th {
            background-color: #0f766e !important;
            color: #fff !important;
        }
        .table-hover > tbody > tr:hover > * {
            --bs-table-bg-state: #ccfbf1;
        }

        /* Formularios */
        .form-control:focus,
        .form-select:focus {
            border-color: #14b8a6;
            box-shadow: 0 0 0 0.25rem rgba(20, 184, 166, 0.25);
        }

        /* Pie de página */
        .pie {
            background: #134e4a;
            color: #fff;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 {{ auth()->user()->esAdmin() ? 'tema-admin' : 'tema-usuario' }}">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">Alprisma Tours</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                       href="{{ route('dashboard') }}">Dashboard</a>
                </li>

                @if (auth()->user()->esAdmin())
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('destinos.*') ? 'active' : '' }}"
                           href="{{ route('destinos.index') }}">Destinos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('paquetes.*') ? 'active' : '' }}"
                           href="{{ route('paquetes.index') }}">Paquetes</a>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('catalogo', 'reservaciones.create') ? 'active' : '' }}"
                       href="{{ route('catalogo') }}">Paquetes disponibles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('reservaciones.index') ? 'active' : '' }}"
                       href="{{ route('reservaciones.index') }}">
                        {{ auth()->user()->esAdmin() ? 'Reservaciones' : 'Mis reservaciones' }}
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item">Cerrar sesión</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container py-4 flex-grow-1">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{ $slot }}
</main>

<footer class="pie text-center py-3">
    <small>© {{ date('Y') }} Alprisma Tours. Todos los derechos reservados.</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>