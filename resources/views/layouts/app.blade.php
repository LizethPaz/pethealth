<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PetHealth') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/mascotas') }}">
                    {{ config('app.name', 'PetHealth') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('mascotas.index') }}">Mascotas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('duenos.index') }}">Dueños</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('veterinarios.index') }}">Veterinarios</a>
                        </li>                       
                        <li class="nav-item dropdown">
    <a id="citasDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        Citas
    </a>

    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="citasDropdown">
        <a class="dropdown-item" href="{{ route('citas.index') }}"> Lista de Citas</a>
        <a class="dropdown-item" href="{{ route('citas.calendar') }}"> Calendario</a>
        <a class="dropdown-item" href="{{ route('citas.create') }}"> Nueva Cita</a>
        <a class ="dropdown-item" href ="{{ route('citas.historial')}}">
            Historial de citas </a>
    </div>
</li>
                        <!-- Puedes agregar más elementos de navegación aquí -->
                    </ul>
                    <!-- En resources/views/layouts/app.blade.php -->
<!-- Dentro del <nav> o donde tengas tu menú de navegación -->
    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Aquí puedes agregar elementos de autenticación si los necesitas -->
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="mt-5 py-3 bg-light">
            <div class="container text-center">
                <p>&copy; {{ date('Y') }} PetHealth. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>