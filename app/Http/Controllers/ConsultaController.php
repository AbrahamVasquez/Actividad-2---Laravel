<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function addUsers() { // Insert usuarios examples
        $usuarios = [
            ["nombre" => 'Josh V', "correo" => 'josh@mail.com', "telefono" => '23242356',],
            ["nombre" => 'Ana C', "correo" => 'ana@mail.com', "telefono" => '34354678',],
            ["nombre" => 'Pedro G', "correo" => 'pedro@mail.com', "telefono" => '12345678',],
            ["nombre" => 'Lucia P', "correo" => 'lucia@mail.com', "telefono" => '98765432',],
            ["nombre" => 'Maria R', "correo" => 'maria@mail.com', "telefono" => '76543210',],
            // ["nombre" => 'Rodri de Paul', "correo" => 'rodri@mail.com', "telefono" => '76503958',],
        ];

        foreach ($usuarios as $usuario) {
            Usuarios::create($usuario);
        }

        $pedidos = [ // Insert Pedidos examples
            ["id_usuario" => 1, "producto" => "camisa",  'cantidad' => 5, "total" => 123.45,],
            ["id_usuario" => 2, "producto" => "pantalon", 'cantidad' => 10, "total" => 67.89,],
            ["id_usuario" => 3, "producto" => "zapatos", 'cantidad' => 20, "total" => 45.67,],
            ["id_usuario" => 4, "producto" => "pizza", 'cantidad' => 90, "total" => 90.12,],
            ["id_usuario" => 5, "producto" => "chuches", 'cantidad' => 500, "total" => 200,],
        ];

        foreach ($pedidos as $pedido) {
            Pedidos::create($pedido);
        }

        return response()->json(['Registros se agregaron con exito']);
    }

    public function getPedidoByUserId() // Gets user by ID 2
    {
        $pedidos = Pedidos::where('id_usuario', 2)->get();
        return response()->json($pedidos);
    }

    public function getInfoPedido() // Gets information about Pedidos with users included
    {
        $pedidos = Pedidos::with('usuarios')->get();
        return response()->json($pedidos);
    }

    public function getPedidoByPriceRange() // Will get items that are between the price range stated
    {
        $pedidos = Pedidos::whereBetween('total', [100, 250])->get();
        return response()->json($pedidos);
    }

    public function getUserByLetter() // Will find user with the given letter
    {
        $usuarios = Usuarios::where('nombre', 'LIKE', 'R%')->get();
        return response()->json($usuarios);
    }

    public function getTotalPedidosByUser() // Returns total of items requested by user 
    {
        $total = Pedidos::where('id_usuario', 5)->count();
        return response()->json(['Total pedidos' => $total]);
    }

    public function getPedidosByOrder() // Will order pedidos based on its total in descendent order
    {
        $pedidos = Pedidos::with('usuarios')->orderBy('total', 'desc')->get();
        return response()->json($pedidos);
    }

    public function getSumaTotalPedidos() // A total sum of all pedidos
    {
        $sumaTotal = Pedidos::sum('cantidad');
        return response()->json(['Suma total de los productos es: ' => $sumaTotal]);
    }

    public function pedidoMasEconomico() // Will find the item with the lowest price/rate
    {
        $pedido = Pedidos::with('usuarios')->orderBy('total', 'asc')->first();
        return response()->json($pedido);
    }

    // * TODO / Obtener el producto, la cantidad y el total de cada pedido, agrupándolos por usuario.
    public function getAllPedidoInfo() 
    {
        $pedidos = Pedidos::select('id_usuario', 'producto', 'cantidad', 'total')
        ->with('usuarios')
        ->get()
        ->groupBy('id_usuario');

        return response()->json($pedidos);
    }


}
