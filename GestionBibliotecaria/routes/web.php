<?php

use App\Http\Controllers\LectorController;
use App\Http\Controllers\UserController;
use App\Models\User;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class,'showlogin'])->name('login');
Route::post('identificacion/', [UserController::class,'verificarlogin'])->name('identificacion');

Route::get('inicio/',[UserController::class,'inicio'])->name('home')->Middleware('auth');
Route::post('salir/', [UserController::class,'salir'])->name('logout');
Route::get('/registrousuario',[UserController::class,'registrousuario'])->name('registrousuario');
Route::resource('usuario', UserController::class);

Route::get('/salirregistro',function(){
    return redirect()->route('login');})->name('usuario.salir');

Route::resource('lector', LectorController::class);
Route::get('/cancelar',function(){
    return redirect()->route('lector.index')->with('datos','Acción Cancelada...!');
  })->name('lector.cancelar');

