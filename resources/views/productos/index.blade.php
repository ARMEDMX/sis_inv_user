@extends('menu.menu')

@section('contenido1')
    <div class="container my-5">
        <!-- Título con fondo colorido y sombra -->
        <h1 class="text-center mb-4" style="background: linear-gradient(90deg, #ff6f61, #ffb400); color: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            Productos Disponibles
        </h1>
        <hr>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Botón para nuevo usuario -->
            <a href="{{ route('productos.create') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-plus"></i> Nuevo Producto
            </a>
            
            <!-- Botón para exportar productos -->
            <a href="{{ route('export.productos') }}" class="btn btn-success btn-lg">
                <i class="fas fa-file-excel"></i> Exportar Productos
            </a>
        </div>
        

        <!-- Tabla de usuarios -->
        <div class="table-responsive">
            @if ($productos->isEmpty())
            <h1>No se encontraron productos existentes.</h1>
            @else
            <table id="table" class="table table-hover table-bordered table-custom align-middle">
                <thead class="table-custom-header">
                    <caption>Listado de Productos</caption>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Registrado Por:</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                     @foreach ($productos as $producto) 
                        <tr class="table-item">
                            <td>{{ $producto->id }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->descripcion }}</td>
                            <td>${{ number_format($producto->precio, 2) }}</td>
                            <td>{{ $producto->user->name }}</td>
                            <td class="accion-btn">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-success">Ver</a>
                                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-secondary">Editar</a>
                                    
                                    
                                    @if(auth()->check() && auth()->user()->is_admin)
                                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                                                Eliminar
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </td>
                            
                        </tr>
                     @endforeach 
                     @endif
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="row justify-content-lg-start">
            <div class="col-auto">
                {{-- $productos->links() --}}
            </div>
        </div>
    </div>

    <!-- Alerta de éxito -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        let mensaje = "{{ session('mensaje') }}";
        if (mensaje) {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: mensaje
            });
        }
    </script>
    
@endsection
