<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::paginate(5);
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = new User();
        return view('users.formulario', ['user' => $user]);

    }

    public function store(Request $request)
    {
        $userValidado = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',// Confirmación de la contraseña
            'is_admin' => 'required|boolean'
        ]);

        $user = new User();
        $user->name = $userValidado['name'];
        $user->email = $userValidado['email'];
        $user->password = Hash::make($userValidado['password']); 
        $user->is_admin = $userValidado['is_admin'];
        $user->save();

        return redirect()->route('users.index')->with('mensaje', 'Usuario creado exitosamente');


    }

  
    public function show(User $user)
    {
        return view('users.show', ['user'=>$user]);
    }

  
    public function edit(User $user)
    {
        return view('users.formulario', ['user'=>$user]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        
        $userValidado = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed', // Confirmación de la contraseña
            'is_admin' => 'required|boolean',
        ]);

        
        $user->name = $userValidado['name'];
        $user->email = $userValidado['email'];

        if ($userValidado['password']) {
            $user->password = Hash::make($userValidado['password']); // Cifrado de la contraseña
        }

        $user->is_admin = $userValidado['is_admin'];
        $user->save();

        
        return redirect()->route('users.index')->with('mensaje', 'Usuario actualizado exitosamente');
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
          
    $user->delete();
    return redirect()->route('users.index')->with('mensaje', 'Usuario eliminado exitosamente.');

    }
}
