<?php

use App\Http\Controllers\BibliotecarioController;
use App\Http\Controllers\ControlPrestamoController;
use App\Http\Controllers\DevolucionController;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\GraficoAbastecimientoController;
use App\Http\Controllers\LectorController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\LibrooController;
use App\Http\Controllers\MultaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\TipoMultaController;
use App\Http\Controllers\TipoprestamoController;
use App\Http\Controllers\UserController;
use App\Models\Prestamo;
use App\Models\Proveedor;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
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
Route::post('/identificacion', [UserController::class,'verificarlogin'])->name('identificacion');

Route::get('/inicio',[UserController::class,'inicio'])->name('home')->Middleware('auth');
Route::post('/salir', [UserController::class,'salir'])->name('logout');
Route::get('/registrousuario',[UserController::class,'registrousuario'])->name('registrousuario');
Route::resource('usuario', UserController::class);
Route::get('/registrousuario2',[UserController::class,'create2'])->name('usuario.create2');
Route::get('/cancelarusuario',function(){
  return redirect()->route('usuario.index')->with('datos','Acción Cancelada...!');
})->name('usuario.cancelar');

Route::post('/store2', [UserController::class,'store2'])->name('usuario.store2');

Route::resource('perfil', PerfilController::class);
Route::get('/cancelarperfil',function(){
  return redirect()->route('perfil.index')->with('datos','Acción Cancelada...!');
})->name('perfil.cancelar');

Route::get('/salirperfil',function(){
  return redirect()->route('home');})->name('perfil.salir');

Route::get('/salirregistro',function(){
    return redirect()->route('login');})->name('usuario.salir');

Route::resource('lector', LectorController::class);
Route::get('/cancelarlector',function(){
  return redirect()->route('lector.index')->with('datos','Acción Cancelada...!');
})->name('lector.cancelar');

Route::resource('rol', RolController::class);
Route::get('/cancelarrol',function(){
  return redirect()->route('rol.index')->with('datos','Acción Cancelada...!');
})->name('rol.cancelar');


Route::resource('prestamo', PrestamoController::class);
Route::get('/cancelarprestamo',function(){
  return redirect()->route('prestamo.index')->with('datos','Acción Cancelada...!');
})->name('prestamo.cancelar');

Route::post('/guardarlector', [PrestamoController::class,'store2'])->name('prestamo.store2');
Route::get('/crearlector',[PrestamoController::class,'crearlector'])->name('prestamo.crearlector');
Route::get('/verDetallePrestamos/{id}',[PrestamoController::class,'ver'])->name('prestamo.ver');

Route::resource('tipoprestamo', TipoprestamoController::class);
Route::get('/cancelartipoprestamo',function(){
  return redirect()->route('tipoprestamo.index')->with('datos','Acción Cancelada...!');
})->name('tipoprestamo.cancelar');

Route::resource('tipomulta', TipoMultaController::class);
Route::get('/cancelartipomulta',function(){
  return redirect()->route('tipomulta.index')->with('datos','Acción Cancelada...!');
})->name('tipomulta.cancelar');

Route::resource('entrega', EntregaController::class);
Route::resource('devolucion', DevolucionController::class);

Route::get('/cancelardevolucion',function(){
  return redirect()->route('devolucion.index')->with('datos','Acción Cancelada...!');
})->name('devolucion.cancelar');

Route::post('/agregarDevolucion/{id}',[DevolucionController::class,'agregar'])->name('devolucion.agregar');
Route::get('/verDetalleDevolucions/{id}',[DevolucionController::class,'ver'])->name('devolucion.ver');
Route::get('/agregarMultaLector/{id}',[DevolucionController::class,'multalector'])->name('devolucion.multalector');

Route::resource('controlPrestamo', ControlPrestamoController::class);

Route::get('/ticket/{id}',[PrestamoController::class,'pdf'])->name('ticket');

Route::get('/report/{id}',[ReporteController::class,'pdf'])->name('reportepdf');
Route::resource('multa', MultaController::class);


Route::get('/ListadoProveedor',[ProveedorController::class,'Tabla'])->name('listado');
Route::get('/RegistroProveedor',[ProveedorController::class,'Form'])->name('registro');
Route::post('/storeP',[ProveedorController::class,'store'])->name('ProveedorStore'); 
Route::get('/EditarProveedor/{id}',[ProveedorController::class,'Edit'])->name('editar');
Route::post('/update',[ProveedorController::class,'update'])->name('update'); 
Route::post('/eliminar/{id}',[ProveedorController::class,'eliminar'])->name('eliminar'); 

Route::get('/RegistroBibliotecario',[BibliotecarioController::class,'createB'])->name('registroB');
Route::get('/DatosBibliotecario',[BibliotecarioController::class,'tablaB'])->name('listadoB');
Route::post('/StoreBibliotecario',[BibliotecarioController::class,'storeB'])->name('storeBb'); 
Route::get('/EditarBibliotecario/{id}',[BibliotecarioController::class,'editarB'])->name('editarB');
Route::post('/updateBibliotecario',[BibliotecarioController::class,'updateB'])->name('updateB'); 
Route::post('/eliminarBibliotecario/{ide}',[BibliotecarioController::class,'eliminarB'])->name('eliminarB'); 


Route::get('/RegistroPedido',[PedidoController::class,'createP'])->name('registroP');
Route::get('/ListadoPedido',[PedidoController::class,'tablaP'])->name('listadoP');
Route::post('/StorePedido',[PedidoController::class,'storeP'])->name('storeP'); 
Route::get('/EditarPedidoo/{id}',[PedidoController::class,'editarP'])->name('editarP');
Route::post('/updatePedido',[PedidoController::class,'updateP'])->name('updateP'); 
Route::post('/eliminarPedido/{ide}',[PedidoController::class,'eliminarP'])->name('eliminarP'); 



Route::get('/RegistroDetallePedido',[PedidoController::class,'createDp'])->name('registroDP');
Route::get('/ListadoDetallePedido',[PedidoController::class,'tablaDp'])->name('listadoDP');
Route::post('/StoreDetallePedido',[PedidoController::class,'storeDp'])->name('storeDP'); 
Route::get('/EditarDetallePedidoo/{id}',[PedidoController::class,'editarDP'])->name('editarDP');
Route::post('/updateDetallePedido',[PedidoController::class,'updateDP'])->name('updateDP'); 
Route::post('/eliminarDetallePedido/{ide}',[PedidoController::class,'eliminarDP'])->name('eliminarDP'); 


Route::get('/RegistroLibro',[LibroController::class,'createL'])->name('registroL');
Route::get('/ListadoLibro',[LibroController::class,'tablaL'])->name('listadoL');
route::post('/storeLibro',[LibroController::class,'storeL'])->name('storeL');


Route::resource('reporte', ReporteController::class);
route::post('/reporte/all',[ReporteController::class,'all'])->name('all');


Route::get('/EditarLibro/{id}',[LibroController::class,'editarL'])->name('editarL');
Route::post('/updateLibro',[LibroController::class,'updateL'])->name('updateL'); 
Route::post('/eliminarLibr/{id}',[LibroController::class,'eliminarL'])->name('eliminarLi');


Route::get('/graficos/',[GraficoAbastecimientoController::class,'index'])->name('graficoA');

Route::get('/pdff',[PedidoController::class,'prueba'])->name('prueba');

Route::get('/tienda',[TiendaController::class,'index'])->name('tienda');

Route::post('/verificar/{id}',[TiendaController::class,'verificar'])->name('verificar');


Route::get('/stripe', 'App\Http\Controllers\StripeController@index')->name('index');
Route::post('/checkout/{id}', 'App\Http\Controllers\StripeController@checkout')->name('checkout');
Route::get('/success', 'App\Http\Controllers\StripeController@success')->name('success');