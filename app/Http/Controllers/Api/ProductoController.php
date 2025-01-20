<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Obtener todos los productos
    public function index()
    {
        $productos = Producto::all();
        return response()->json($productos);
    }

    // Obtener un producto específico
    public function show(Producto $producto)
    {
        return response()->json($producto);
    }

    // Crear un nuevo producto
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
        ]);

        $producto = Producto::create($validated);

        return response()->json($producto, 201);
    }

    // Actualizar un producto existente
    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'nombre' => 'string|max:255',
            'descripcion' => 'string',
            'precio' => 'numeric',
        ]);

        $producto->update($validated);

        return response()->json($producto);
    }

    // Eliminar un producto
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return response()->json(null, 204);
    }
}
