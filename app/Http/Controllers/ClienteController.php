<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contacto;
use Illuminate\Support\Facades\DB;
use App\Models\Categoria;
use App\Models\Filtro;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(){
        $url = URL::temporarySignedRoute('unsubscribe',now()->addMinutes(15),['name'=>'Jose Carlos']);
        Mail::to(request('email'))->send(new Contacto(request('name'),request('name'),$url));
    }
    public function store2(){
        return request('email');
    }
    public function getUns()
    {
        # code...
    }
    public function postUns()
    {
        # code...
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function loginCandidato2(){
        $empresa = $_POST['_token'];

        return view('loginCliente',['empresa'=>$empresa]);
    }

    public function loginCliente(Request $request){
        $request->validate([
            'usuario'=>'required|email:rfc,dns',
            'contrasena'=>'required']);

        $estado = Cliente::autenticar($request->usuario, $request->contrasena);
        switch ($estado) {
            case 'exito':
                header('Location: ' . URL::to('/aceptarContrato'), true, 302);
                die();
                break;
            case 'noRegistrada' || 'noLogeada': //error de usuaro o contraseña
                return view("login",['noLogeado' => 'Nombre de usuario o contraseña incorrecta por favor intente de nuevo.','usuarioIng'=>$request->usuario,'contraIng'=>$request->contrasena]);
                break;
        }
        //si llego hasta aqui, fue porque no entro a algun case, por seguridad, retornar a login
        return view("login",['noLogeado' => 'Error al intentar autenticar. Por favor intente mas tarde.']);
    }
    //EDCR
    public static function aceptarContratacion(){
        $codigo = $_POST['codigo'];
        $categoria = $_POST['categoria'];
        $cotizacion = $_POST['cotizacion'];
        $empresa = $_POST['empresa'];

        $cotizacionXCandidato = DB::table('tbcotizacionesenviadas')
                                        ->where('cliente', $codigo)
                                        ->where('categoria', $categoria)
                                        ->where('id', $cotizacion)
                                        ->where('empresa',$empresa)
                                        ->first();

        $cliente =  DB::table('tbclientes as c')
                        ->select('c.nombre as nombreCliente')
                        ->where('c.codigo',$codigo)
                        ->first();
        
        $emp = DB::table('tbempresas')->select('usuario')->where('id', $empresa)->first();

        $comision = Categoria::obtenerPrecioCotizacion();

        $cliente?$nombreCliente = $cliente->nombreCliente:$nombreCliente = "";
        $emp?$correoEmpresa=$emp->usuario:$correoEmpresa=""; 
        
        $fechaComoEntero = strtotime($cotizacionXCandidato->fechaevento);
        $hora = (int)substr($cotizacionXCandidato->horaevento, 0, 2);
        $minutos = substr($cotizacionXCandidato->horaevento, 2);
        $hora<12?$tiempo=" a.m":$tiempo=" p.m";
        $hora>12? ($horaEvento = ($hora-12).$minutos.$tiempo ):($horaEvento = $hora.$minutos.$tiempo);  
        
        
        $mes="";
        if(date('m',$fechaComoEntero)==1)
           $mes="Enero";
        if(date('m',$fechaComoEntero)==2)
           $mes="Febreo";
        if(date('m',$fechaComoEntero)==3)
           $mes="Marzo";
        if(date('m',$fechaComoEntero)==4)
           $mes="Abril";
        if(date('m',$fechaComoEntero)==5)
           $mes="Mayo";
        if(date('m',$fechaComoEntero)==6)
           $mes="Junio";
        if(date('m',$fechaComoEntero)==7)
           $mes="Julio";
        if(date('m',$fechaComoEntero)==8)
           $mes="Agosto";
        if(date('m',$fechaComoEntero)==9)
           $mes="Septiembre";
        if(date('m',$fechaComoEntero)==10)
           $mes="Octubre";
        if(date('m',$fechaComoEntero)==11)
           $mes="Noviembre";
        if(date('m',$fechaComoEntero)==12)
           $mes="Diciembre";

        $fecha = date('d',$fechaComoEntero)." de ".$mes." de ".date('Y',$fechaComoEntero);

        if($cotizacionXCandidato->usuarioedcr=="EDCR"){
            $nombres = $cotizacionXCandidato->usuarioedcr;
            $correos = $cotizacionXCandidato->correoedcr;
        }else{
            $nombres = $cotizacionXCandidato->nombres;
            $correos = $cotizacionXCandidato->correos;
        }
        $smb="";
        if($cotizacionXCandidato->simbolo=="dolar")
           $smb = "$";
        else if($cotizacionXCandidato->simbolo=="colon")
           $smb = "₡";

        
        if($cotizacionXCandidato)//nombreClienteX,nombreEventoX,fechaEventoX,horaEventoX,nombreLugarX,nombreCategoriaX,correoEmpresaX
            return view('aceptarContrato',['cotizacion'=>$cotizacionXCandidato,'nombreCliente'=>$nombreCliente,'correoEmpresa'=>$correoEmpresa,
                                           'fecha'=>$fecha,'hora'=>$horaEvento,'nombres'=>$nombres,'correos'=>$correos,'comision'=>$comision,
                                           'simbolo'=>$smb]);
        else
            return view('contratoNoEncontrado');
    }
    //Candidato
    public static function aceptarContratacion2(){
        $codigo = $_POST['codigo'];
        $categoria = $_POST['categoria'];
        $cotizacion = $_POST['cotizacion'];
        $empresa = $_POST['empresa'];
        $cotizacionXCandidato = DB::table('tbcotizacionesenviadas')
                                        ->where('cliente', $codigo)
                                        ->where('categoria', $categoria)
                                        ->where('id', $cotizacion)
                                        ->where('empresa',$empresa)
                                        ->first();

        $cliente =  DB::table('tbclientes as c')
                        ->select('c.nombre as nombreCliente')
                        ->where('c.codigo',$codigo)
                        ->first();
        
        $emp = DB::table('tbempresas')->select('usuario','nombreEmpresa')->where('id', $empresa)->first();

        $comision = Categoria::obtenerPrecioCotizacion();

        $cliente?$nombreCliente = $cliente->nombreCliente:$nombreCliente = "";
        $emp?$correoEmpresa=$emp->usuario:$correoEmpresa=""; 
        
        $fechaComoEntero = strtotime($cotizacionXCandidato->fechaevento);
        $hora = (int)substr($cotizacionXCandidato->horaevento, 0, 2);
        $minutos = substr($cotizacionXCandidato->horaevento, 2);
        $hora<12?$tiempo=" a.m":$tiempo=" p.m";
        $hora>12? ($horaEvento = ($hora-12).$minutos.$tiempo ):($horaEvento = $hora.$minutos.$tiempo);  
        
        
        $mes="";
        if(date('m',$fechaComoEntero)==1)
           $mes="Enero";
        if(date('m',$fechaComoEntero)==2)
           $mes="Febreo";
        if(date('m',$fechaComoEntero)==3)
           $mes="Marzo";
        if(date('m',$fechaComoEntero)==4)
           $mes="Abril";
        if(date('m',$fechaComoEntero)==5)
           $mes="Mayo";
        if(date('m',$fechaComoEntero)==6)
           $mes="Junio";
        if(date('m',$fechaComoEntero)==7)
           $mes="Julio";
        if(date('m',$fechaComoEntero)==8)
           $mes="Agosto";
        if(date('m',$fechaComoEntero)==9)
           $mes="Septiembre";
        if(date('m',$fechaComoEntero)==10)
           $mes="Octubre";
        if(date('m',$fechaComoEntero)==11)
           $mes="Noviembre";
        if(date('m',$fechaComoEntero)==12)
           $mes="Diciembre";

        $fecha = date('d',$fechaComoEntero)." de ".$mes." de ".date('Y',$fechaComoEntero);

        if($cotizacionXCandidato->usuarioedcr=="EDCR"){
            $nombres = $cotizacionXCandidato->usuarioedcr;
            $correos = $cotizacionXCandidato->correoedcr;
        }else{
            $nombres = $cotizacionXCandidato->nombres;
            $correos = $cotizacionXCandidato->correos;
        }
        $smb="";
        if($cotizacionXCandidato->simbolo=="dolar")
           $smb = "$";
        else if($cotizacionXCandidato->simbolo=="colon")
           $smb = "₡";
        
        if($cotizacionXCandidato)
            return view('aceptarContrato2',['cotizacion'=>$cotizacionXCandidato,'nombreCliente'=>$nombreCliente,'correoEmpresa'=>$correoEmpresa,
                                            'fecha'=>$fecha,'hora'=>$horaEvento,'nombres'=>$nombres,'correos'=>$correos,'comision'=>$comision,
                                            'nombreEmpresa'=>$emp?$emp->nombreEmpresa:"",'simbolo'=>$smb]);
        else
            return view('contratoNoEncontrado');
    }    

    public static function mostrarContact2(){
        return view('contact2');
    }
    
    public static function contact(Request $request){
        $url = URL::temporarySignedRoute('aceptarContactar',now()->addMinutes(15),[]);
        Mail::to(request('email'))->send(new Contacto(request('name'),request('name'),$url));
    }

    public static function aceptarContactar(){
        return "Mi nombre es: ".$_POST['nombre'];
    }

    public static function conversionPHP(){
        $valor=self::convertirMoneda("USD","EUR",1);
        return $valor;
        //echo "1 Euro=$valor Dólares";
    }

    function convertirMoneda($monedaOrigen,$monedaDestino,$importe){
       $valor = file_get_contents("https://www.google.com/finance/converter?a=$importe&from=$monedaOrigen&to=$monedaDestino");
       $valor = explode("<span class=bld>",$valor);
       $valor = explode("</span>",$valor[1]);
       return preg_replace("/[^0-9\.]/", null, $valor[0]);
    }

    public static function realizarPago(){
        $comision = Categoria::obtenerPrecioCotizacion();
        $empresa=$_POST['empresa'];
        $categoria = $_POST['categoria'];
        $cotizacion = $_POST['cotizacion'];
        //tbcotizacionesenviadas
        $cot = Filtro::obtenerTotal($cotizacion);           
        $monto = 0;
        if($cot){
            if($cot->simbolo=="dolar")
               $monto = round($cot->total, 2);
            else if($cot->simbolo=="colon")
               $monto = round($cot->totaldolar, 2);
        }

        $candidato = $_POST['cliente'];
        return view('cotizacionpago/opcionPago',['idEmpresa'=>$empresa,'comision'=>$monto,'categoria'=>$categoria,'cotizacion'=>$_POST['cotizacion'],'candidato'=>$candidato,'opcion'=>'edcr']);
    }

    public static function realizarPago2(){      
      $comision = Categoria::obtenerPrecioCotizacion();
      $monto = 0;
      if($comision)
         $monto = $comision->valor;
      $empresa=$_POST['empresa'];
      $categoria = $_POST['categoria'];
      $cotizacion = $_POST['cotizacion'];
      $candidato = $_POST['cliente'];
      return view('cotizacionpago/opcionPago',['idEmpresa'=>$empresa,'comision'=>$monto,'categoria'=>$categoria,'cotizacion'=>$_POST['cotizacion'],'candidato'=>$candidato,'opcion'=>'candidato']);
  }
    
}
