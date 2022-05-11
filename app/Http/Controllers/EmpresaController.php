<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\DashboardController;

class EmpresaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('empresa.crear');
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate([
            'nombreEmpresa' => 'required|max:255',
            'nombreEncargado' => 'required|max:255',
            'cedulaEmpresa' => 'required|max:42|unique:tbempresas,cedulaEmpresa,'.$request->idempresa.',id',
            'cedulaEncargado' => 'required|max:42|unique:tbempresas,cedulaEncargado,'.$request->idempresa.',id',
            'telefonoEmpresa'=>'required|max:25|unique:tbempresas,telefonoEmpresa,'.$request->idempresa.',id',
            'telefonoEncargado'=>'required|max:25|unique:tbempresas,telefonoEncargado,'.$request->idempresa.',id',
            'direccion'=>'required|max:255',
            'usuario'=>'required|max:128|email:rfc,dns|unique:tbempresas,usuario,'.$request->idempresa.',id',
            'correoEncargado'=>'required|max:128|email:rfc,dns|unique:tbempresas,correoEncargado,'.$request->idempresa.',id',
            'contrasena'=>'required|max:25|confirmed',
            'contrasena_confirmation'=>'required|max:25'
        ]);
        $mensaje = Empresa::registrar($request->nombreEmpresa,$request->cedulaEmpresa,$request->telefonoEmpresa,$request->usuario,$request->contrasena,$request->direccion,
                                      $request->nombreEncargado,$request->cedulaEncargado,$request->correoEncargado,intVal($request->rdCedula),$request->telefonoEncargado);
        if($mensaje != "Exito")
            return view("registro",['mensajeError' => $mensaje]);
        else return view('logout',['mensaje' => 'Registro Exitoso.', 'dir' => '/']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){}

    public function edit2(){
        if(DashboardController::estaLogeado())
            return view('empresa.editar',['empresa' => $_SESSION['empresa']]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
            $request->validate([
                'nombreEmpresa' => 'required|max:255',
                'nombreEncargado' => 'required|max:255',
                'cedulaEmpresa' => 'required|max:42|unique:tbempresas,cedulaEmpresa,'.$request->idempresa.',id',
                'cedulaEncargado' => 'required|max:42|unique:tbempresas,cedulaEncargado,'.$request->idempresa.',id',
                'telefonoEmpresa'=>'required|max:25|unique:tbempresas,telefonoEmpresa,'.$request->idempresa.',id',
                'telefonoEncargado'=>'required|max:25|unique:tbempresas,telefonoEncargado,'.$request->idempresa.',id',
                'direccion'=>'required|max:255',
                'usuario'=>'required|max:128|email:rfc,dns|unique:tbempresas,usuario,'.$request->idempresa.',id',
                'correoEncargado'=>'required|max:128|email:rfc,dns|unique:tbempresas,correoEncargado,'.$request->idempresa.',id',
                'contrasena'=>'required|max:25|confirmed',
                'contrasena_confirmation'=>'required|max:25'
            ]);
           
            $mensaje = Empresa::editar($request->idempresa,$request->nombreEmpresa,$request->cedulaEmpresa,$request->telefonoEmpresa,$request->usuario,$request->contrasena,$request->direccion,
                $request->nombreEncargado,$request->cedulaEncargado,$request->correoEncargado,intVal($request->rdCedula),$request->telefonoEncargado );
            
            if($mensaje == "Exito")
                return view('empresa.editar',['empresa' => $_SESSION['empresa'], 'mensaje' => 'Actualización Exitósa']);            
            else
                return view('empresa.editar', ['empresa' => $_SESSION['empresa'],'mensajeError' => $mensaje]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
    }    
    /*pagoComision
      
    */
    public function login(Request $request){
        $request->validate([
            'usuario'=>'required|email:rfc,dns',
            'contrasena'=>'required']);

        $estado = Empresa::autenticar($request->usuario, $request->contrasena);
        switch ($estado) {
            case 'exito'://bien logeado
                header('Location: ' . URL::to('/dashboard'), true, 302);
                die();
                break;
            case 'cambiarcontra': //bien logeado pero es necesario cambiar contra
                return redirect()->route('cambioContra');
                break;
            case 'pagoComision':
                return redirect()->route('pagoComision');
                break;    
            case 'noRegistrada' || 'noLogeada': //error de usuaro o contraseña
                return view("login",['noLogeado' => 'Nombre de usuario o contraseña incorrecta por favor intente de nuevo.','usuarioIng'=>$request->usuario,'contraIng'=>$request->contrasena]);
                break;
        }
        //si llego hasta aqui, fue porque no entro a algun case, por seguridad, retornar a login
        return view("login",['noLogeado' => 'Error al intentar autenticar. Por favor intente mas tarde.']);
    }

    public function logout(){
        Empresa::logout();
        return view('logout', ['mensaje' => 'Sesión cerrada correctamente.', 'dir' => '/']);
    }
    public function recuperarContra(Request $request){
        $request->validate([
            'usuario'=>'required|email:rfc,dns',
        ]);  
        if (Empresa::recuperarContra($request->usuario) == 0)
            return view('recuperarContra',['noLogeado' => 'No existe cuenta asociada al usuario ingresado.','usuarioIng'=>$request->usuario]);
        else 
           return view('logout', ['mensaje' => 'Se ha enviado una contraseña temporal a su cuenta de correo.', 'dir' => '/']);
    }

    public function contactar(){
        return Empresa::contrato();
    }    

    public function cambiarContra(Request $request){
        $request->validate([
            'contrasena'=>'required|max:25|confirmed',
            'contrasena_confirmation'=>'required|max:25'
        ]);
        if (session_status() == PHP_SESSION_NONE)
            session_start();

        if (Hash::check($request->contrasena, $_SESSION['empresa']->contrasena))
            return view('cambioContrasena',['mensaje' => 'La contraseña ingresada debe ser diferente a la que recibió en el correo.']);
        else {
            if (Empresa::ejecCambioContra($request->contrasena, $_SESSION['empresa']->usuario))
                return view('logout', ['mensaje' => 'Contraseña cambiada exitosamente.', 'dir' => '/dashboard']);
            else
                return view('cambioContrasena',['mensaje' => 'Ocurrió un error cambiando la contraseña.']);
        }
        return redirect()->back();
    }

    public function paypal(){
        if(DashboardController::estaLogeado())
           return Empresa::guardarPago();
    }
    public function paypal2(){
        return Empresa::guardarPago2();
    }    
}
