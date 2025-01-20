@extends('menu.menu')

@section('contenido1')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-lg" style="max-width: 40rem; width: 100%; border-radius: 10px;">
            <div class="card-header text-center" style="background-color: #007bff; color: white; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                <h3 class="mb-0">{{ $user->name }}</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h5 class="card-title">Detalles del Usuario</h5>
                    <p class="card-text"><strong>ID:</strong> {{ $user->id }}</p>
                    <p class="card-text"><strong>Nombre:</strong> {{ $user->name }}</p>
                    <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="card-text"><strong>Rol:</strong> {{ $user->is_admin ? 'Administrador' : 'Usuario' }}</p>
                    <p class="card-text"><strong>Creado el:</strong> {{ $user->created_at->format('d-m-Y H:i') }}</p>
                    <p class="card-text"><strong>Última actualización:</strong> {{ $user->updated_at->format('d-m-Y H:i') }}</p>
                </div>
            </div>
            <div class="card-footer text-center" style="background-color: #f8f9fa;">
                <a href="{{ route('users.index') }}" class="btn btn-primary">Volver a la lista</a>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-secondary">Editar Usuario</a>
                
            </div>
        </div>
    </div>
@endsection
