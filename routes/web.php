<?php

use App\Http\Controllers\CargoController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('empleados', EmpleadoController::class);
Route::get('/empleados/ciudades/{paisId}', [EmpleadoController::class, 'getCiudades']);

Route::resource('cargos', CargoController::class);
Route::resource('ciudads', CiudadController::class);

