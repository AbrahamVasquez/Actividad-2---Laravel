<?php

use App\Http\Controllers\PedidoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ConsultaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// Rutas para probar usuarios
Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::post('/usuarios', [UsuarioController::class, 'store']);

// Rutas para pedidos
Route::get('/pedidos', [PedidoController::class, 'index']);
Route::get('/pedidos/{id}', [PedidoController::class, 'obtenerPedidoPorId']);
Route::post('/pedidos', [PedidoController::class, 'store']);


// Rutas para las consultas especificas
Route::get('/add-user', [ConsultaController::class, 'addUsers']);
Route::get('/pedidos-usuario-2', [ConsultaController::class, 'getPedidoByUserId']);
Route::get('/pedidos-con-usuario', [ConsultaController::class, 'getInfoPedido']); // * TODO
Route::get('/pedidos-en-rango', [ConsultaController::class, 'getPedidoByPriceRange']);
Route::get('/usuarios-con-r', [ConsultaController::class, 'getUserByLetter']);
Route::get('/total-pedidos-usuario-5', [ConsultaController::class, 'getTotalPedidosByUser']);
Route::get('/pedidos-ordenados', [ConsultaController::class, 'getPedidosByOrder']);
Route::get('/suma-total-pedidos', [ConsultaController::class, 'getSumaTotalPedidos']);
Route::get('/pedido-mas-economico', [ConsultaController::class, 'pedidoMasEconomico']); // * TODO
Route::get('/pedidos-agrupados-por-usuario', [ConsultaController::class, 'getAllPedidoInfo']);
