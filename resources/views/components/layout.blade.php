<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title }} :: Refood</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

</head>

<body>
    <div class="wrapper">
        <!-- Contenido de navegación -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/marca.jpg') }}" alt="Refood Logo" height="40">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link text-success" href="{{ url('/') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link text-success" href="{{ url('servicios') }}">Servicios</a></li>
                        <li class="nav-item"><a class="nav-link text-success" href="{{ url('blog') }}">Blog</a></li>
                        <li class="nav-item"><a class="nav-link text-success" href="{{ url('quienes-somos') }}">Quiénes Somos</a></li>
                        <li class="nav-item"><a class="nav-link text-success" href="{{ route('donate.index') }}">Donar un plato</a></li>
                        <li class="nav-item"><a class="nav-link text-success" href="{{ url('contact') }}">Contacto</a></li>

                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item"><a class="nav-link text-success" href="{{ route('login') }}">Iniciar Sesión</a></li>
                        @endif
                        @if (Route::has('register'))
                        <li class="nav-item"><a class="nav-link text-success" href="{{ route('register') }}">Registrarse</a></li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li class="nav-item"><a class="nav-link text-success" href="{{ route('profile.show') }}">Mi Perfil</a></li>
                                @if(Auth::user()->hasRole('admin'))
                                <li><a class="dropdown-item" href="{{ route('blog.admin') }}">Administrar Entradas del Blog</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.users') }}">Administrar Usuarios</a></li>
                                @endif
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                            </ul>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Contenido principal -->
        <main class="content container p-4">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('images/marca.jpg') }}" alt="Refood Logo" class="footer-logo">
                        <p>Cada plato cuenta</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <h2>Contacto</h2>
                        <p><strong>11 3312 4697</strong></p>
                        <p><strong>refood@refood.com.ar</strong></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Stacks para scripts específicos de vistas -->
    @stack('scripts')
</body>

</html>