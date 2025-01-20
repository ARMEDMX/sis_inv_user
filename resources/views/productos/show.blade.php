@extends('menu.menu')

@section('contenido1')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-lg" style="max-width: 40rem; width: 100%; border-radius: 10px;">
            <div class="card-header text-center" style="background-color: #28a745; color: white; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                <h3 class="mb-0">{{ $producto->nombre }}</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h5 class="card-title">Detalles del Producto</h5>
                    <p class="card-text"><strong>ID:</strong> {{ $producto->id }}</p>
                    <p class="card-text"><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
                    <p class="card-text"><strong>Precio:</strong> ${{ number_format($producto->precio, 2) }}</p>
                    <p class="card-text"><strong>Registrado por:</strong> {{ $producto->user->name }}</p>
                    <p class="card-text"><strong>Creado el:</strong> {{ $producto->created_at->format('d-m-Y H:i') }}</p>
                    <p class="card-text"><strong>Última actualización:</strong> {{ $producto->updated_at->format('d-m-Y H:i') }}</p>
                </div>
            </div>
            <div class="card-footer text-center" style="background-color: #f8f9fa;">
                <a href="{{ route('productos.index') }}" class="btn btn-primary">Volver a la lista</a>
                <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-secondary">Editar Producto</a>
            </div>
        </div>
    </div>
@endsection
