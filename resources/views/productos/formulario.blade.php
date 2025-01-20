@extends('menu.menu')

@section('contenido1')

<div class="container-form" style="margin: 50px;">
    @if(isset($producto->id))
        <h2 class="text-center mb-4" style="background: linear-gradient(90deg, #ff6f61, #ffb400); color: white; padding: 20px; border-radius: 10px; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);">
            EDITAR <i class="fa-solid fa-pen-to-square fa-lg"></i>
        </h2>
        <form action="{{ route('productos.update', ['producto' => $producto->id]) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')   
    @else
        <h2 class="text-center mb-4" style="background: linear-gradient(90deg, #ff6f61, #ffb400); color: white; padding: 20px; border-radius: 10px; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);">
            REGISTRO <i class="fa-solid fa-pen fa-lg"></i>
        </h2>
        <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
    @endif    

    @csrf
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Campo Nombre -->
            <x-input1 nombre="Nombre: " valorcampo="{{ old('nombre', $producto->nombre ?? '') }}" campo="nombre" holder="Escriba el nombre del producto" />

            <!-- Campo Email -->
            <x-input2 nombre="Descripcion: " valorcampo="{{ old('descripcion', $producto->descripcion ?? '') }}" campo="descripcion" holder="Describa brevemente el producto" />

            <x-input3 nombre="Precio: " valorcampo="{{$producto->precio ?? ''}}" campo="precio" holder="Ingrese el monto" />

           
        </div>
    </div>

    <!-- Botón de Enviar -->
    <div class="mb-3 text-center">
        <button type="submit" class="btn btn-lg" style="background-color: #ff6f61; color: white; border-radius: 8px; padding: 12px 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            Guardar Producto
        </button>
    </div>
    </form>  
</div>

@endsection
