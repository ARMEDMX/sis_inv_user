@extends('menu.menu')

@section('contenido1')
@auth
<div class="container-one d-flex justify-content-center align-items-center flex-column">
    <!-- Contenedor principal centrado -->
    <div class="text-center mb-4">
        <h2 class="display-6 text-white">Sistema de Registro de Beneficiarios y Apoyos</h2>
        <p class="mt-3 lead text-secondary text-white">
            Bienvenido al Sistema de Prueba Técnica para Gestionar Usuarios y Productos.
        </p>

        <figcaption class="blockquote-footer text-light">
            Realizado por <cite title="Source Title" class="text-warning">Keneth Salomon Conde Cruz</cite>
        </figcaption>
    </div>

    <!-- Contenedor de las tarjetas, debajo del contenedor text-center -->
    <div class="d-flex justify-content-center gap-5 mb-5">
        <!-- Tarjeta de Usuarios -->
        <div class="card text-center shadow" style="width: 18rem; border-radius: 15px;">
            <div class="card-body">
                <i class="fa-solid fa-users fa-3x text-primary mb-3"></i>
                <h5 class="card-title">Gestión de Usuarios</h5>
                <p class="card-text">Registra, edita y administra usuarios en el sistema.</p>
                <a href="{{ route('users.index') }}" class="btn btn-primary">Ir a Usuarios</a>
            </div>
        </div>

        <!-- Tarjeta de Productos -->
        <div class="card text-center shadow" style="width: 18rem; border-radius: 15px;">
            <div class="card-body">
                <i class="fa-solid fa-boxes-stacked fa-3x text-success mb-3"></i>
                <h5 class="card-title">Gestión de Productos</h5>
                <p class="card-text">Registra, edita y administra productos en el sistema.</p>
                <a href="{{ route('productos.index') }}" class="btn btn-success">Ir a Productos</a>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center gap-4 mt-5">
        <!-- Enlace a GitHub -->
        <a href="https://github.com/ARMEDMX" target="_blank" class="btn btn-dark">
            <i class="fa-brands fa-github fa-2x"></i> GitHub
        </a>

        <!-- Enlace a LinkedIn -->
        <a href="https://www.linkedin.com/in/keneth-salomon-conde-cruz-679a99239/" target="_blank" class="btn btn-primary">
            <i class="fa-brands fa-linkedin fa-2x"></i> LinkedIn
        </a>

        <!-- Enlace a TikTok -->
        <a href="https://www.tiktok.com/@armedcondemx" target="_blank" class="btn btn-danger">
            <i class="fa-brands fa-tiktok fa-2x"></i> TikTok
        </a>
    </div>
</div>
@endauth

@guest
<div class="container-one d-flex justify-content-center align-items-center flex-column" style="min-height: 100vh; background: linear-gradient(135deg, #ff6f61, #ffb400); color: white; text-align: center;">
    <!-- Contenedor principal centrado -->
    <div class="text-center">
        <!-- Ícono grande representando acceso denegado -->
        <i class="fas fa-lock fa-5x mb-4" style="color: white; opacity: 0.8;"></i>
        
        <!-- Mensaje principal -->
        <h2 class="display-4 fw-bold">Acceso Denegado</h2>
        
        <!-- Mensaje descriptivo -->
        <p class="mt-3 lead">
            Lo sentimos, no tienes acceso a este contenido.<br> 
            Por favor, <a href="/login" class="text-warning fw-bold" style="text-decoration: underline;">inicia sesión</a> o 
            <a href="/register" class="text-warning fw-bold" style="text-decoration: underline;">regístrate</a> para continuar.
        </p>
        
        <!-- Pie de página -->
        <figcaption class="blockquote-footer text-light mt-4">
            Sistema de Registro de Beneficiarios y Apoyos
        </figcaption>
    </div>
</div>

@endguest


@endsection
