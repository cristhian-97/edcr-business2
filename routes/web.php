<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;

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
    return view('login');
});
  
Route::post('/', [EmpresaController::class, 'login']);

Route::get('/registrar', function () {
    return view('registro');
});

Route::get('/dashboard',[DashboardController::class,'inicio']);

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

Route::get('/pagoComision', function () {
    session_start();
    $emp = $_SESSION['empresa'];
    return view('paypal/paypal',['idEmpresa'=>$emp->id]);
})->name('pagoComision');

/*Route::get('/pagoComision2', function () {
    session_start();
    $emp = $_SESSION['empresa'];
    return view('paypal/paypal',['idEmpresa'=>$emp->id,'pago'=>30]);
})->name('pagoComision2');*/

Route::post('/paypal',[EmpresaController::class, 'paypal'])->name('paypal');
Route::post('/paypal2',[EmpresaController::class, 'paypal2'])->name('paypal2');

Route::post('/obtenerCliente',[CategoriaController::class, 'obtenerCliente'])->name('obtenerCliente');