<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bienvenido a TecnoServi</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .hero {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            color: white;
            padding: 120px 0;
            text-align: center;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
        }
        .hero p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }
        .hero .btn {
            padding: 0.75rem 2rem;
            font-size: 1.1rem;
            margin: 0.25rem;
        }

        .card {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .card .card-header i {
            margin-bottom: 15px;
        }

        footer {
            background-color: #1f2937;
            color: #f3f4f6;
            padding: 20px 0;
        }
        footer a {
            color: #f3f4f6;
            transition: color 0.3s;
        }
        footer a:hover {
            color: #6366f1;
        }

        .main-header.navbar {
            background: transparent;
            transition: 0.3s;
        }
        .main-header.navbar.scrolled {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="hold-transition layout-top-nav">

<div class="wrapper">

    <nav class="main-header navbar navbar-expand-md navbar-light">
        <div class="container">
            <a href="#" class="navbar-brand">
                <span class="brand-text font-weight-bold">TecnoServi</span>
            </a>
            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/home') }}" class="nav-link">Home</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">Login</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="hero">
        <div class="container">
            <h1 class="animate__animated animate__fadeInDown">Bienvenido a TecnoServi</h1>
            <p class="animate__animated animate__fadeInUp">
                Transformamos la gestión de servicios de internet por cable para residenciales y empresas, optimizando procesos, stock, personal y vehículos.
            </p>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg animate__animated animate__zoomIn">Registrarse</a>
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg animate__animated animate__zoomIn">Iniciar Sesión</a>
        </div>
    </div>

    <div class="content py-5">
        <div class="container">
            <div class="row">

                <div class="col-md-4">
                    <div class="card text-center border-0 shadow-sm rounded-lg p-4 mb-4 animate__animated animate__fadeInUp">
                        <div class="card-header">
                            <i class="fas fa-tasks fa-3x text-indigo-500"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">Gestión de Órdenes</h5>
                            <p class="card-text">
                                Administra solicitudes de clientes de forma rapida, asigna móviles según tus requerimientos y sigue el estado de tu pedido en todo momento.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card text-center border-0 shadow-sm rounded-lg p-4 mb-4 animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="card-header">
                            <i class="fas fa-user-cog fa-3x text-green-500"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">Gestión de Personal</h5>
                            <p class="card-text">
                                Administra vacaciones, licencias y pool de tareas según skills. Evalúa rendimiento y asigna prioridades a clientes críticos.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card text-center border-0 shadow-sm rounded-lg p-4 mb-4 animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="card-header">
                            <i class="fas fa-truck fa-3x text-yellow-500"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">Control de Vehículos y Stock</h5>
                            <p class="card-text">
                                Gestiona rodados, mantenimiento, inventario y alertas de materiales próximos a agotarse, garantizando operaciones eficientes.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <footer class="text-center">
        <strong>&copy; 2025 TecnoServi.</strong> Todos los derechos reservados.
        <div class="mt-2">
            <a href="#" class="mx-2">Facebook</a>
            <a href="#" class="mx-2">Twitter</a>
            <a href="#" class="mx-2">LinkedIn</a>
        </div>
    </footer>

</div>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

<script>
$(window).scroll(function() {
    if($(window).scrollTop() > 50) {
        $('.main-header.navbar').addClass('scrolled');
    } else {
        $('.main-header.navbar').removeClass('scrolled');
    }
});
</script>

</body>
</html>
