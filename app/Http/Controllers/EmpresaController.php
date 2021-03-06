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
                return view('empresa.editar',['empresa' => $_SESSION['empresa'], 'mensaje' => 'Actualizaci??n Exit??sa']);            
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
            case 'noregistrada' || 'nologeada': //error de usuaro o contrase??a
                return view("login",['noLogeado' => 'Nombre de usuario o contrase??a incorrecta por favor intente de nuevo.','usuarioIng'=>$request->usuario,'contraIng'=>$request->contrasena]);
                break;
        }
        //si llego hasta aqui, fue porque no entro a algun case, por seguridad, retornar a login
        return view("login",['noLogeado' => 'Error al intentar autenticar. Por favor intente mas tarde.']);
    }

    public function logout(){
        Empresa::logout();
        return view('logout', ['mensaje' => 'Sesi??n cerrada correctamente.', 'dir' => '/']);
    }
    public function recuperarContra(Request $request){
        $request->validate([
            'usuario'=>'required|email:rfc,dns',
        ]);  
        if (Empresa::recuperarContra($request->usuario) == 0)
            return view('recuperarContra',['noLogeado' => 'No existe cuenta asociada al usuario ingresado.','usuarioIng'=>$request->usuario]);
        else 
           return view('logout', ['mensaje' => 'Se ha enviado una contrase??a temporal a su cuenta de correo.', 'dir' => '/']);
    }

    public function contactar(){
        return Empresa::contrato();
    }

    public function notificarEmpresa(){
        return Empresa::notificarEmpresa();
    }
    
    public function notificarEmpresaXCandidato(){
        return Empresa::notificarEmpresaXCandidato();
    }  

    public function cambiarContra(Request $request){
        $request->validate([
            'contrasena'=>'required|max:25|confirmed',
            'contrasena_confirmation'=>'required|max:25'
        ]);
        if (session_status() == PHP_SESSION_NONE)
            session_start();

        if (Hash::check($request->contrasena, $_SESSION['empresa']->contrasena))
            return view('cambioContrasena',['mensaje' => 'La contrase??a ingresada debe ser diferente a la que recibi?? en el correo.']);
        else {
            if (Empresa::ejecCambioContra($request->contrasena, $_SESSION['empresa']->usuario))
                return view('logout', ['mensaje' => 'Contrase??a cambiada exitosamente.', 'dir' => '/dashboard']);
            else
                return view('cambioContrasena',['mensaje' => 'Ocurri?? un error cambiando la contrase??a.']);
        }
        return redirect()->back();
    }

    public function paypal(){
        if(DashboardController::estaLogeado())
           return Empresa::guardarPago();//Pago de la comisi??n inicial
    }
    public function paypal2(){
        return Empresa::guardarPago2();
    }

    public function pagoDepositoRegistro(){
        return Empresa::pagoDepositoRegistro();
    }





    public function noti(){       
        //return self::convertCurrency(5,"USD","PHP");
        return view('contact2');
    }

    function currencyConverter($currency_from,$currency_to,$currency_input){
        $yql_base_url = "http://query.yahooapis.com/v1/public/yql";
        $yql_query = 'select * from yahoo.finance.xchange where pair in ("'.$currency_from.$currency_to.'")';
        $yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
        $yql_query_url .= "&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";
        $yql_session = file_get_contents($yql_query_url);
        $yql_json =  json_decode($yql_session,true);
        $currency_output = (float) $currency_input*$yql_json['query']['results']['rate']['Rate'];
    
        return $currency_output;
    }

    public function tipoPago(){
        
        if(isset($_POST['pago'])){
            $emp = $_POST['idEmpresa'];
            $comision = $_POST['comision'];
            return view('paypal/paypal',['idEmpresa'=>$emp,'comision'=>$comision]);
        }
        return redirect()->back();
    }
    
    /*function currencyConverter($from_Currency,$to_Currency,$amount) {
        $from_Currency = urlencode($from_Currency);
        $to_Currency = urlencode($to_Currency);
        $encode_amount = 1;
        $get = file_get_contents("https://www.google.com/finance/converter?a=$encode_amount&from=$from_Currency&to=$to_Currency");
        $get = explode("<span class=bld>",$get);
        $get = explode("</span>",$get[1]);
        $converted_currency = preg_replace("/[^0-9.]/", null, $get[0]);
        return $converted_currency;
    }*/

}
