@extends('menu.menu')

@section('contenido1')

<div class="container-form" style="margin: 50px;">
    @if(isset($user->id))
        <h2 class="text-center mb-4" style="background: linear-gradient(90deg, #ff6f61, #ffb400); color: white; padding: 20px; border-radius: 10px; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);">
            EDITAR <i class="fa-solid fa-pen-to-square fa-lg"></i>
        </h2>
        <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')   
    @else
        <h2 class="text-center mb-4" style="background: linear-gradient(90deg, #ff6f61, #ffb400); color: white; padding: 20px; border-radius: 10px; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);">
            REGISTRO <i class="fa-solid fa-pen fa-lg"></i>
        </h2>
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
    @endif    

    @csrf
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Campo Nombre -->
            <x-input1 nombre="Nombre: " valorcampo="{{ old('name', $user->name ?? '') }}" campo="name" holder="Escriba el nombre completo" />

            <!-- Campo Email -->
            <x-input1 nombre="Email: " valorcampo="{{ old('email', $user->email ?? '') }}" campo="email" holder="Escriba el correo electrónico" />

            <!-- Campo Contraseña -->
            <x-input-password nombre="Contraseña: " valorcampo="{{ old('password') }}" campo="password" holder="Escriba la contraseña" />

            <!-- Campo Confirmar Contraseña -->
            <x-input-password nombre="Confirmar Contraseña: " valorcampo="{{ old('password_confirmation') }}" campo="password_confirmation" holder="Confirme la contraseña" />

            <!-- Campo Rol de Administrador -->
            <div class="mb-3 row">
                <label for="is_admin" class="col-4 col-form-label" style="font-weight: bold; color: #4e73df;">¿Es Administrador?:</label>
                <div class="col-8">
                    <select name="is_admin" id="is_admin" class="form-select form-select-lg" style="border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <option value="0" {{ (old('is_admin', $user->is_admin ?? 0) == 0) ? 'selected' : '' }}>No</option>
                        <option value="1" {{ (old('is_admin', $user->is_admin ?? 0) == 1) ? 'selected' : '' }}>Sí</option>
                    </select>

                    <div class="error">
                        @error('is_admin')
                            <span style="color: brown;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón de Enviar -->
    <div class="mb-3 text-center">
        <button type="submit" class="btn btn-lg" style="background-color: #ff6f61; color: white; border-radius: 8px; padding: 12px 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            Guardar Usuario
        </button>
    </div>
    </form>  
</div>

@endsection
