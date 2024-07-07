<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() // Get pedidos
    {
        return Pedidos::all();
    }

    public function obtenerPedidoPorId($id) // Finds Pedido by ID
    {
        $pedido = Pedidos::find($id);
        if ($pedido) {
            return response()->json($pedido, 200);
        } else {
            return response()->json(['No se encontró el pedido'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // Creates a new Pedido
    {
        $pedido = Pedidos::create($request->all());

        return response()->json(['El pedido fue creado con exito', $pedido], 201);
    }

}
