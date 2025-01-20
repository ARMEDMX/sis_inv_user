<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            
        if (auth()->user()->is_admin) {
            
            $productos = Producto::paginate(5);
        } else {
            
            $productos = Producto::where('user_id', auth()->id())->paginate(5);
    }

    return view('productos.index', ['productos' => $productos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $producto = new Producto();
        return view('productos.formulario', ['producto' => $producto]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
        ]);

        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('productos.index')->with('mensaje', 'Producto creado con éxito.');
   
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return view('productos.show', ['producto'=>$producto]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('productos.formulario', ['producto'=>$producto]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $productoValidado = request()->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
        ]);
    
        $producto->update($productoValidado);
        return redirect()->route('productos.index')->with('mensaje', 'El producto se actualizo correctamente ');
    
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
             
    $producto->delete();
    return redirect()->route('productos.index')->with('mensaje', 'Producto eliminado exitosamente.');
    }
}
