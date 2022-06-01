<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Models\Categoria;

/*v81V04gl
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
    //return view('logout',['mensaje' => 'Registro Exitoso.', 'dir' => '/']);
    return view('login');
});
  
Route::post('/', [EmpresaController::class, 'login']);

Route::post('/cliente3', [ClienteController::class,'loginCandidato2'])->name('cliente3');

Route::get('/registrar', function () {
    return view('registro');
});

Route::get('/dashboard',[DashboardController::class,'inicio']);
Route::get('/home',[DashboardController::class,'home']);

Route::get('/aceptarContrato',[ClienteController::class,'aceptarContratacion']);

Route::get('/nolog', function () {
    return view('logout', ['mensaje' => 'Por favor inicie sesión para poder utilizar el sistema.', 'dir' => '/']);
})->name('nolog');

Route::get('/logout', [EmpresaController::class, 'logout']);

Route::get('/recuperarContra', function () {
    return view('recuperarContra');
});

Route::post('/recuperarContra', [EmpresaController::class, 'recuperarContra']);

Route::get('/cambioContra', function () {
    return view('cambioContrasena');
})->name('cambioContra');

Route::post('/cambioContra', [EmpresaController::class, 'cambiarContra'])->name('cambiarContra');

Route::get('/empresa/registro', [EmpresaController::class, 'create'])->name('empresa.create');
Route::post('/empresa/registro',  [EmpresaController::class, 'store'])->name('empresa.store');

Route::put('/empresa/perfil', [EmpresaController::class, 'update'])->name('empresa.update');
Route::get('/empresa/perfil', [EmpresaController::class, 'edit2'])->name('empresa.editar');

Route::get('/categorias',[CategoriaController::class, 'index']);

Route::post('/categoria',[CategoriaController::class, 'mostrarCategoria'])->name('categoria');
Route::post('/cotizar',[CategoriaController::class, 'cotizar']);

Route::post('/contactar', [EmpresaController::class, 'contactar']);
Route::post('/notificarEmpresa', [EmpresaController::class, 'notificarEmpresa']);
Route::post('/notificarEmpresaXCandidato', [EmpresaController::class, 'notificarEmpresaXCandidato']);

Route::get('/pagoComision', function () {
    session_start();
    $emp = $_SESSION['empresa'];
    $comision = Categoria::obtenerPrecioComision();
    return view('paypal/opcionPago2',['idEmpresa'=>$emp->id,'comision'=>$comision]);
    //return view('paypal/paypal',['idEmpresa'=>$emp->id,'comision'=>$comision]);
})->name('pagoComision');

Route::post('/tipoPago',[EmpresaController::class, 'tipoPago'])->name('tipoPago');

Route::post('/paypal',[EmpresaController::class, 'paypal'])->name('paypal');
Route::post('/paypal2',[EmpresaController::class, 'paypal2'])->name('paypal2');
Route::post('/pagoDeposito',[EmpresaController::class, 'pagoDepositoRegistro'])->name('pagoDeposito');

Route::post('/obtenerCliente',[CategoriaController::class, 'obtenerCliente'])->name('obtenerCliente');

//edcr
Route::post('/contratar',[ClienteController::class,'aceptarContratacion'])->name('contratar')->middleware('signed');
//candidato
Route::post('/contratar2',[ClienteController::class,'aceptarContratacion2'])->name('contratar2')->middleware('signed');
Route::post('/realizarPago',[ClienteController::class,'realizarPago'])->name('realizarPago')->middleware('signed');
Route::post('/realizarPago2',[ClienteController::class,'realizarPago2'])->name('realizarPago2')->middleware('signed');

Route::get('/contact2',[ClienteController::class,'mostrarContact2'])->name('contact2');
Route::post('/contact',[ClienteController::class,'contact'])->name('contact');
Route::post('/aceptarContactar',[ClienteController::class,'aceptarContactar'])->name('aceptarContactar')->middleware('signed');

Route::get('/notificacion',[ClienteController::class, 'conversionPHP']);/*function () {
    return view('contact2');
 });*/


Route::get('/correo',function (){
    return view('correos/cambioContra', ['nombreEmpresa'=>'Nueva Empresa','contra'=>'SJSje9']);
    /*return view('correos/notificacionEmpresa',[
        'nombreCliente'=>'Cristhian',
        'nombreEvento'=>'Evento',
        'fechaEvento'=>'lunes',
        'horaEvento'=>'4:3',
        'nombreLugar'=>'nombreLugar',
        'nombreCategoria'=>'nombreCategoria',
        'url'=>'hola',
        'cliente'=>2,
        'categoria'=>2,
        'cotizacion'=>2,
        'empresa'=>2,
    ]);*/
});