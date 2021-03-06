<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\RecuperarContra;
use App\Mail\Contrato;
use App\Mail\ContratoEdcr;
use App\Mail\NotificacionEmpresa;
use App\Mail\NotificacionEmpresaCandidato;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class Empresa extends Model
{
    use HasFactory;
    //Datos únicos: cédula jurídica, teléfono, usuario=correo
    public static function registrar($nombre, $cedulaEmpresa, $telefono, $usuario, $contrasena, $direccion,$nombEnc,$cedEnc,$correoEnc,$tipCed,$telEnc){
        $validation = "";  
        $cedJur = DB::table('tbempresas')->where('cedulaEmpresa', $cedulaEmpresa)->first();
        $tel = DB::table('tbempresas')->where('telefonoEmpresa', $telefono)->first();
        $usr = DB::table('tbempresas')->where('usuario', $usuario)->first();
        
        if($cedJur != null){
            $validation.='La cédula jurídica ingresada ya se encuentra registrada.<br>';
        }
        if($tel != null)
            $validation.='El teléfono ingresado ya se encuentra registrado.<br>';                    
        if($usr != null)
            $validation.='El correo ingresado ya se encuentra registrado.<br>';

        if($validation!="")
            return $validation;

        $exito = DB::table('tbempresas')->insert(['nombreEmpresa' => $nombre, 'cedulaEmpresa' => $cedulaEmpresa, 'telefonoEmpresa'=> $telefono, 'direccion' => $direccion, 'usuario'=>$usuario ,'contrasena' => Hash::make($contrasena),
                                                  'nombreEncargado'=>$nombEnc ,'cedulaEncargado'=>$cedEnc ,'correoEncargado'=>$correoEnc,'tipoCedula'=>$tipCed,'telefonoEncargado'=>$telEnc]);
        if ($exito)
            return 'Exito';
        else
            return 'Error al registrar la empresa. Por favor intente mas tarde.';
    }

    public static function editar($id, $nombre, $cedulaEmpresa, $telefono, $usuario, $contrasena, $direccion,$nombEnc,$cedEnc,$correoEnc,$tipCed,$telEnc){
        $validation = "";  
        $cedJur = DB::table('tbempresas')->where('cedulaEmpresa', $cedulaEmpresa)->where('id','!=',$id)->first();
        $tel = DB::table('tbempresas')->where('telefonoEmpresa', $telefono)->where('id','!=',$id)->first();
        $usr = DB::table('tbempresas')->where('usuario', $usuario)->where('id','!=',$id)->first();
        
        if($cedJur != null){
            $validation.='La cédula jurídica ingresada ya se encuentra registrada.<br>';
        }
        if($tel != null)
            $validation.='El teléfono ingresado ya se encuentra registrado.<br>';                    
        if($usr != null)
            $validation.='El correo ingresado ya se encuentra registrado.<br>';

        if($validation!="")
            return $validation;

        $exito = DB::table('tbempresas')->where('id',$id)->update(['nombreEmpresa' => $nombre, 'cedulaEmpresa' => $cedulaEmpresa, 'telefonoEmpresa'=> $telefono,
                         'direccion' => $direccion, 'usuario'=>$usuario ,'contrasena' => Hash::make($contrasena),
                         'nombreEncargado'=>$nombEnc ,'cedulaEncargado'=>$cedEnc ,'correoEncargado'=>$correoEnc,'tipoCedula'=>$tipCed,'telefonoEncargado'=>$telEnc]);
        if ($exito){
            $emp = DB::table('tbempresas')->where('usuario', $usuario)->first();
            $_SESSION['empresa'] = $emp;
            return 'Exito';
        }else
            return 'Error al actualizar la empresa. Por favor intente mas tarde.';
    }    
    

    public static function autenticar($usuario, $contra){
        $emp = DB::table('tbempresas')->where('usuario', $usuario)->first();
        if ($emp == null)
            return 'noregistrada';
        if (Hash::check($contra, $emp->contrasena)) {
            //usuario autenticado
            session_start();
            $_SESSION['empresa'] = $emp;
            if ($emp->cambioContra == 1)
                return 'cambiarcontra'; //bien logeado, pero toca cambiar contra
            if($emp->pagoComision==0)//0)
               return 'pagoComision';
            
            return 'exito';   
        }
        return 'nologeada';
    }
    public static function logout(){
        session_start();
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach ($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', 1);
                setcookie($name, '', 1, '/');
            }
        }
        session_unset();
        session_destroy();
        $_SESSION = array();
    }

    
    public static function recuperarContra($usuario){
        if (DB::table('tbempresas')->where('usuario', $usuario)->exists()) {
            $contra =  self::generarPass();
            echo "<script>console.log('Console: " . $contra . "' );</script>";
            DB::table('tbempresas')->where('usuario', $usuario)->update(['contrasena' => Hash::make($contra), 'cambioContra' =>  1]);

            $emp = DB::table('tbempresas')->where('usuario', $usuario)->first();
            //la variable $contra contiene la contraseña sin encriptar, se la enviamos al usuario en texto plano
            //Mail::to($correoDestino->par_valor)->send(new RecuperarContra($user, $contra));
            Mail::to($usuario)->send(new RecuperarContra($emp, $contra));

            return 1; //'exito';
        } else {
            return 0; //'No existe cuenta asociada al correo ingresado.';
        }
    }

    public static function contrato(){
        if(isset($_POST['correos']) && isset($_POST['nombres'])){
            $correosRecibidos = $_POST['correos'];
            $correos = explode(",",$correosRecibidos);

            $nombresRecibidos = $_POST['nombres'];
            $nombres = explode(",",$nombresRecibidos);

            $codigosRecibidos = $_POST['codigos'];
            $codigos = explode(",",$codigosRecibidos);

            $numero =$_POST['numero'];
            $fecha= $_POST['fecha'];     
            $cant=$_POST['cant'];
            $nombreCat = $_POST['nombreCat'];
            $lugar=$_POST['lugar'];
            $funcion=$_POST['funcion'];
            $disp2=$_POST['disp2'];
            $transp= $_POST['transp2'];
            $precioCt = $_POST['precioCt'];
            $imprte=$_POST['imprte'];
            $comsion = $_POST['comsion'];
            $iva=$_POST['iva2'];
            $totl = $_POST['total2'];
            $totalDol=$_POST['totalDol'];

            $usuEDCR = $_POST['usuarioedcr'];
            $fechaEv = $_POST['fechaEv'];
            $horaEv = $_POST['horaEv'];

            $idCategoria = $_POST['idCategoria'];
            $idEmpresa = $_POST['idEmpresa'];
            $simbolo = $_POST['simbolo'];
            if($simbolo=="dolar")
              $simboloVisual = "$";//"dolar";
            else if($simbolo=="colon")
              $simboloVisual="₡";//"colon";

            $usuarioEDCRDEfinitivo = "";
            if($usuEDCR=="EDCR")
               $usuarioEDCRDEfinitivo = $usuEDCR;
            else
              $usuarioEDCRDEfinitivo = $nombresRecibidos;              
            
            $msj="";
            if($usuEDCR=="EDCR"){
                $correoedcr = $_POST['correoedcr'];
                if (DB::table('tbparametros')->where('valor', $correoedcr)->exists()){
                    for($i=0; $i<sizeof($correos); $i++){
                        if (DB::table('tbclientes')->where('correo', $correos[$i])->exists()){
                            $idCotizacion = DB::table('tbcotizacionesenviadas')
                                        ->insertGetId(['correo'=>$correos[$i],
                                                  'cliente'=>$codigos[$i],
                                                  'nombre'=>$nombres[$i],
                                                  'nombres'=>$nombresRecibidos,
                                                  'numero'=>$numero,
                                                  'correos'=>$correosRecibidos,
                                                  'fechacotizacion'=>$fecha,
                                                  'cantidad'=>$cant,
                                                  'categoria'=>$idCategoria,
                                                  'empresa'=>$idEmpresa,
                                                  'nombrecategoria'=>$nombreCat,
                                                  'lugar'=>$lugar,
                                                  'funcion'=>$funcion,
                                                  'disponibilidad'=>$disp2,
                                                  'transporte'=>$transp,
                                                  'preciocategoria'=>$precioCt,
                                                  'importe'=>$imprte,
                                                  'iva'=>$iva,
                                                  'total'=>$totl,
                                                  'comision'=>$comsion,
                                                  'fechaevento'=>$fechaEv,
                                                  'horaevento'=>$horaEv,
                                                  'usuarioedcr'=>$usuarioEDCRDEfinitivo,
                                                  'correoedcr'=>$correoedcr,
                                                  'simbolo'=>$simbolo,
                                                  'totaldolar'=>$totalDol]);

                            if (is_numeric($idCotizacion)) {//$url = URL::signedRoute('contratar',['codigo'=>$codigos[$i],'categoria'=>$idCategoria,'cotizacion'=>$idCotizacion,'empresa'=>$idEmpresa]);
                                $url = URL::temporarySignedRoute('contratar',now()->addMinutes(15),[]);
                                Mail::to($correoedcr)->send(new ContratoEdcr($correos[$i],$usuarioEDCRDEfinitivo,$correoedcr,$numero,$fecha,$cant,$nombreCat,$lugar,
                                                                             $funcion,$disp2,$transp,$precioCt,$imprte,$iva,$totl,$comsion,$fechaEv,$horaEv,$url,
                                                                             $codigos[$i],$idCategoria,$idCotizacion,$idEmpresa,$simboloVisual));
                            }else
                                $msj.="La cotización del cliente con correo: ".$correo[$i]." no se envió al correo ".$correoedcr;
                        }else
                            $msj.= "No existe cuenta asociada al correo ".$correo[$i];
                    }
                }else
                  $msj.= "El correo ".$correoedcr." no se encuentra registrado";
            }else{
                for($i=0; $i<sizeof($correos); $i++){
                    if (DB::table('tbclientes')->where('correo', $correos[$i])->exists()){
                        $idCotizacion = DB::table('tbcotizacionesenviadas')
                                            ->insertGetId(['correo'=>$correos[$i],
                                                      'cliente'=>$codigos[$i],
                                                      'nombre'=>$nombres[$i],
                                                      'nombres'=>$nombresRecibidos,
                                                      'numero'=>$numero,
                                                      'correos'=>$correosRecibidos,
                                                      'fechacotizacion'=>$fecha,
                                                      'cantidad'=>$cant,
                                                      'categoria'=>$idCategoria,
                                                      'empresa'=>$idEmpresa,
                                                      'nombrecategoria'=>$nombreCat,
                                                      'lugar'=>$lugar,
                                                      'funcion'=>$funcion,
                                                      'disponibilidad'=>$disp2,
                                                      'transporte'=>$transp,
                                                      'preciocategoria'=>$precioCt,
                                                      'importe'=>$imprte,
                                                      'iva'=>$iva,
                                                      'total'=>$totl,
                                                      'comision'=>$comsion,
                                                      'fechaevento'=>$fechaEv,
                                                      'horaevento'=>$horaEv,
                                                      'usuarioedcr'=>$usuarioEDCRDEfinitivo,
                                                      'simbolo'=>$simbolo,
                                                      'totaldolar'=>$totalDol]);

                        if (is_numeric($idCotizacion)) {//$url = URL::temporarySignedRoute('contratar',now()->addMinutes(30),['codigo'=>$codigos[$i],'categoria'=>$idCategoria,'cotizacion'=>$idCotizacion,'empresa'=>$idEmpresa]);
                            $url = URL::temporarySignedRoute('contratar2',now()->addMinutes(15),[]);
                            Mail::to($correos[$i])->send(new Contrato($nombres[$i],$nombresRecibidos,$numero,$correosRecibidos,$fecha,$cant,$nombreCat,$lugar,$funcion,
                                                                      $disp2,$transp,$precioCt,$imprte,$iva,$totl,$comsion,$fechaEv,$horaEv,$usuarioEDCRDEfinitivo,$url,
                                                                      $codigos[$i],$idCategoria,$idCotizacion,$idEmpresa,$simboloVisual));
                        }else
                            $msj.="No se envió la cotización al correo ".$correo[$i];
                    }else
                        $msj.= "No existe cuenta asociada al correo ".$correo[$i];
                }
            }
            if($msj=="")
               return "Se ha enviado un correo de notificación a los correos asociados"; //'exito';
            else
                return $msj; 
        }else 
          return "Ningún correo enviado";
    }

    public static function notificarEmpresa(){
        $correoEmpresa = $_POST['correoEmpresa'];
        $nombreCliente =$_POST['nombreCliente'];
        $nombreEvento= $_POST['nombreEvento'];     
        $fechaEvento=$_POST['fechaEvento'];
        $horaEvento = $_POST['horaEvento'];
        $nombreLugar=$_POST['nombreLugar'];
        $nombreCategoria=$_POST['nombreCategoria'];

        $empresa = $_POST['empresa'];
        $categoria = $_POST['categoria'];
        $cliente = $_POST['cliente'];
        $cotizacion = $_POST['cotizacion'];
            
        $msj="";
        $url = URL::signedRoute('realizarPago',[]);
        if (DB::table('tbempresas')->where('usuario', $correoEmpresa)->exists()){            
            Mail::to($correoEmpresa)->send(new NotificacionEmpresa($nombreCliente,$nombreEvento,$fechaEvento,$horaEvento,$nombreLugar,$nombreCategoria,$url,
                                                                    $empresa,$categoria,$cliente,$cotizacion));                    
        }else
            $msj.= "No existe cuenta asociada al correo ".$correoEmpresa;
            
        if($msj=="")
            return "Se ha enviado un correo de notificación a los correos asociados";
        else
            return $msj;      
    }
    
    public static function notificarEmpresaXCandidato(){
        $correoEmpresa = $_POST['correoEmpresa'];
        $nombreCliente =$_POST['nombreCliente'];
        $nombreEvento= $_POST['nombreEvento'];     
        $fechaEvento=$_POST['fechaEvento'];
        $horaEvento = $_POST['horaEvento'];
        $nombreLugar=$_POST['nombreLugar'];
        $nombreCategoria=$_POST['nombreCategoria'];

        $empresa = $_POST['empresa'];
        $categoria = $_POST['categoria'];
        $cliente = $_POST['cliente'];
        $cotizacion = $_POST['cotizacion'];
            
        $msj="";
        $url = URL::signedRoute('realizarPago2',[]);
        if (DB::table('tbempresas')->where('usuario', $correoEmpresa)->exists()){            
            Mail::to($correoEmpresa)->send(new NotificacionEmpresaCandidato($nombreCliente,$nombreEvento,$fechaEvento,$horaEvento,$nombreLugar,$nombreCategoria,
            $url, $empresa,$categoria,$cliente,$cotizacion));
        }else
            $msj.= "No existe cuenta asociada al correo ".$correoEmpresa;
            
        if($msj=="")
            return "Se ha enviado un correo de notificación a los correos asociados";
        else
            return $msj;      
    }    

    

    private static function generarPass(){
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

    public static function ejecCambioContra($contra, $usuario){
        if (DB::table('tbempresas')->where('usuario', $usuario)->exists()) {
            DB::table('tbempresas')->where('usuario', $usuario)->update(['contrasena' => Hash::make($contra), 'cambioContra' => 0]);
            if (session_status() == PHP_SESSION_NONE)
                session_start();            
            $_SESSION['empresa']->cambioContra = 0;
            return true; //'exito';
        } else
            return false; //'No existe cuenta asociada al correo ingresado.';
    }

    public static function guardarPago(){
        $paisComprador = "";
        if($_POST['paisComprador']==null || !isset($_POST['paisComprador']))
            $paisComprador= "";
        $idPago = DB::table('tbpagosempresaspaypal')->insertGetId(['afiliado'=>$_POST['afiliado'],'cliente'=>$_POST['cliente'],
                           'paypalid'=>$_POST['paypalId'],'creacion'=>$_POST['creacion'],'edicion'=>$_POST['edicion'],
                           'intent'=>$_POST['intent'],'estado'=>$_POST['estado'],'idcomprador'=>$_POST['idComprador'],
                           'emailcomp'=>$_POST['emailComprador'],'paiscomp'=>$paisComprador,'nombrecomp'=>$_POST['nombreComprador'],
                           'idcompra'=>$_POST['undId'],'valorcompra'=>$_POST['undValor'],'monedacompra'=>$_POST['undMoneda'],
                           'emailcompra'=>$_POST['undEmail'],'merchant'=>$_POST['undMerchant'],'dirnombre'=>$_POST['dirComprador'],
                           'dirdireccion'=>$_POST['dirDireccion'],'dirpostal'=>$_POST['dirPostal'],'dirpais'=>$_POST['dirPais'],
                           'pagoestado'=>$_POST['pagoEstado'],'pagoid'=>$_POST['pagoId'],'pagocapture'=>$_POST['pagoCapture'],
                           'pagocreacion'=>$_POST['pagoCreacion'],'pagoedicion'=>$_POST['pagoEdicion'],'pagomonto'=>$_POST['pagoValor'],
                           'pagomoneda'=>$_POST['pagoMoneda'],'tipo'=>$_POST['tipo'],'empresa'=>$_POST['codigoUsuario'],
                           'telefono'=>$_POST['telefono'],'adicional'=>$_POST['adicional']]);
        if (is_numeric($idPago)){
            $resultado2 = DB::table('tbempresas')->where('id',$_POST['codigoUsuario'])->update(['pagoComision' => 1]);
            if ($resultado2)
                return 'Pago realizado exitosamente';
            else{
                $resultado3 = DB::table('tbpagosempresaspaypal')->where('id',$idPago)->delete();
                return 'Error al registrar el pago. Por favor intente mas tarde.';    
            }
        }else
            return 'Error al registrar el pago. Por favor intente mas tarde.';        
    }

    public static function guardarPago2(){
        $paisComprador = "";
        if($_POST['paisComprador']==null || !isset($_POST['paisComprador']))
            $paisComprador= "";
        
        $pagosCot =  DB::table('tbpagoscotizacionespaypal')
                            ->where('cotizacion',$_POST['cotizacion'])
                            ->get();  
        if(count($pagosCot)>0)
            return 'preregistrado';
        else{  
            $resultado = DB::table('tbpagoscotizacionespaypal')->insert(['afiliado'=>$_POST['afiliado'],'cliente'=>$_POST['cliente'],
                           'paypalid'=>$_POST['paypalId'],'creacion'=>$_POST['creacion'],'edicion'=>$_POST['edicion'],
                           'intent'=>$_POST['intent'],'estado'=>$_POST['estado'],'idcomprador'=>$_POST['idComprador'],
                           'emailcomp'=>$_POST['emailComprador'],'paiscomp'=>$paisComprador,'nombrecomp'=>$_POST['nombreComprador'],
                           'idcompra'=>$_POST['undId'],'valorcompra'=>$_POST['undValor'],'monedacompra'=>$_POST['undMoneda'],
                           'emailcompra'=>$_POST['undEmail'],'merchant'=>$_POST['undMerchant'],'dirnombre'=>$_POST['dirComprador'],
                           'dirdireccion'=>$_POST['dirDireccion'],'dirpostal'=>$_POST['dirPostal'],'dirpais'=>$_POST['dirPais'],
                           'pagoestado'=>$_POST['pagoEstado'],'pagoid'=>$_POST['pagoId'],'pagocapture'=>$_POST['pagoCapture'],
                           'pagocreacion'=>$_POST['pagoCreacion'],'pagoedicion'=>$_POST['pagoEdicion'],'pagomonto'=>$_POST['pagoValor'],
                           'pagomoneda'=>$_POST['pagoMoneda'],'tipo'=>$_POST['tipo'],'empresa'=>$_POST['codigoUsuario'],'categoria'=>$_POST['categoria'],
                           'cotizacion'=>$_POST['cotizacion'],'candidato'=>$_POST['candidato'],
                           'telefono'=>$_POST['telefono'],'adicional'=>$_POST['adicional']]);
            if ($resultado)
                return 'Pago realizado exitosamente';
            else
                return 'Error al registrar el pago. Por favor intente mas tarde.';
        }
    }
    
    public static function pagoDepositoRegistro(){
        $resultado = DB::table('tbdepositos')->insert(['empresa'=>$_POST['empresa'],'telefono'=>$_POST['telefono'],
                                                       'direccion'=>$_POST['direccion'],'comprobante'=>$_POST['comprobante'],
                                                       'tipo'=>$_POST['tipo']]);

        DB::table('tbempresas')->where('id', $_POST['empresa'])->update(['pagoComision' => 1]);

        if ($resultado)
            return 'Exito';
        else
            return 'Error';
    }
}
