<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::resource('Producto', ProductoController::class)->middleware('auth');
Route::resource('Pedido', PedidoController::class)->middleware('auth');

Auth::routes(['reset'=>false]);

Route::get('/home', [PedidoController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'], function () 
{
    Route::get('/', [PedidoController::class, 'index'])->name('home');
});
