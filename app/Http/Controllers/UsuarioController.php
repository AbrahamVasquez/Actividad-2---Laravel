<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index() // Gets all users
    {
        $usuarios = Usuarios::all();
        return response()->json($usuarios);
    }

    public function store(Request $request) // Creates a new user
    {
        // $usuario = new Usuarios();
        // $usuario->nombre = $request->nombre;
        // $usuario->correo = $request->correo;
        // $usuario->telefono = $request->telefono;
        // $usuario->save();
        $usuario = Usuarios::create($request->all());

        return response()->json(['Usuario creado con exito', $usuario], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = Usuarios::find($id);
        if ($usuario) {
            $pedidos = $usuario->pedidos;
            return response()->json(['Usuario' => $usuario, 'Pedidos: ' => $pedidos], 200);
        } else {
            return response()->json(['Usuario no encontrado'], 404);
        }
    }

}
