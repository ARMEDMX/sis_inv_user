<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ URL::asset('css/styles.css?1.0') }}" media="all" />
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.2.1-web/css/all.css') }}">
    <link rel="icon" type="images" href="images/logo.jpeg">
    <script src="https://kit.fontawesome.com/089c7c9b8e.js" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Aplicación Web de Prueba Técnica</title>
</head>
<body>

    <div class="container-fluid">
        <div class="row">

            <!-- Barra Lateral -->
            <div id="sidebar" class="d-flex flex-column justify-content-between col-2 min-vh-100">
                <div class="mt-4">

                    <div class="logo text-white text-center">
                        <img src="{{ asset('images/logo-cecy.png') }}" alt="Logo SIS_INV_USER" style="width: 160px; height: auto;">
                    </div>

                    <hr class="text-white d-none d-md-block">

                    <ul class="nav flex-column mt-2 mt-sm-0" id="menu">
                        <li class="nav-item my-md-1 my-2">
                            <a href="/" class="nav-link text-white text-center text-sm-start" aria-current="page">
                                <i class="fa fa-house"></i>
                                <span class="ms-2 d-none d-lg-inline">Home</span>
                            </a>
                        </li>

                        <li class="nav-item my-md-1 my-2">
                            <a href="{{ route('users.index') }}" class="nav-link text-white text-center text-sm-start" aria-current="page">
                                <i class="fa-solid fa-users-gear"></i>
                                @if(auth()->check() && auth()->user()->is_admin)
                                <span class="ms-2 d-none d-lg-inline">Gestión de <b class="text-warning">Usuarios</b></span>
                                @else
                                    <p>Acceso restringido.</p>
                                @endif
                            </a>
                        </li>

                        <li class="nav-item my-md-1 my-2">
                            <a href="{{ route('productos.index') }}" class="nav-link text-white text-center text-sm-start" aria-current="page">
                                <i class="fa-solid fa-bag-shopping"></i>
                                <span class="ms-2 d-none d-lg-inline">Gestión de <b class="text-success">Productos</b></span>
                            </a>
                        </li>
                    </ul>

                </div>

                <div>
                    @auth
                        <div class="dropdown open">
                            <button class="btn text-white dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user"></i>
                                <span class="ms-1 d-none d-md-inline">
                                    {{ current(explode(' ', Auth::user()->name)) }}
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li>
                                    <form action="{{ route(
                                    'logout') }}" method="post">
                                        @csrf
                                        <a class="dropdown-item text-white" href=""
                                            onclick="event.preventDefault(); this.closest('form').submit();">Cerrar Sesión</a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endauth
                    @guest
                        <div>
                            <a href="/login" class="btn text-white">
                                <i class="fa fa-user"></i>
                                <span class="ms-1 d-none d-md-inline">Iniciar Sesión</span>
                            </a>
                        </div>
                    @endguest
                </div>
            </div>

            <!-- Contenido Principal -->
            <div id="plantilla" class="col-10">
                <div class="p-4">
                    @yield('contenido1')
                </div>
            </div>
        </div>
    </div>
    
    <script src="/public/js/app.js"></script>

</body>
</html>
