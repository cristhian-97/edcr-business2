<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categoria extends Model
{
    use HasFactory;
    public function obtenerCategorias(){
        return DB::table('tbrol')->where('estado',1)->get();
    }

    public function obtenerCategoria($id){
        return DB::table('tbrol')->where('id', $id)->first();
    }

    public function obtenerPrecioComision(){
        return DB::table('tbparametros')->where('clave','comision')->first();
    }

    public function obtenerPrecioCotizacion(){
        return DB::table('tbparametros')->where('clave','contrato')->first();
    }

    public function obtenerCorreo(){
        return DB::table('tbparametros')->where('clave','correoedcr')->first();
    }    
    
    public function cotizar2(){
        $idCategoria = $_POST['idCategoria'];
        $clientes = Array();
        $whereArray=Array();
        array_push($whereArray,['c.rol',$idCategoria]);
        if($idCategoria==1 || $idCategoria==2 || $idCategoria ){}
    }

    public function sacarElemento($arreglo, $pos){
        $nuevaLista = [];
        $aux;
        for($a=0; $a<$arreglo; $a++){
            if($a!=$pos)
                array_push($nuevaLista,$arreglo[$a]);
            else
              $aux = $arreglo[$a];
        }
        return $nuevaLista;
    }   

    public function cotizarSinFiltros(){
        $idCategoria = $_POST['idCategoria'];
        $clientes = Array();
        $whereArray=Array();
        $clientesAux2 = DB::table('tbclientes as c')
                                ->select('c.codigo','c.nombre as nombreCliente', 'c.color_ojos','c.medidas','c.calzado','c.peso','c.altura',
                                         'c.preciohora','c.correo','c.disponibilidad','c.transporte','c.portada','c.telefono','c.altura',
                                         'c.peso','c.disponibilidad','c.facturaelectronica','c.experiencia','c.color_ojos','c.grado_academico',
                                         'c.cursos','c.cabello','c.frenillos','c.tattos','c.idioma','c.uniforme','c.pasaporte','c.licencia',
                                         'c.instPrincipal','c.instSecundario','c.compositor','c.miFuerte','c.equipoPropio','c.luces',
                                         'c.equipoSonido','c.equipoSonido','c.generosMusicales','c.deportes','c.musica','c.equipoList',
                                         'c.habilidades','c.orden','c.direccion','c.cursos','c.sobre_mi','c.demos')
                                ->where('c.rol',$idCategoria)->get();
        if(sizeof($clientesAux2)>0){
            for($f=0; $f<sizeof($clientesAux2); $f++)
                array_push($clientes,$clientesAux2[$f]);
            if(sizeof($clientes)==0)
                return "vacio";
        }else
            return "vacio";
           
        $cliXAT = DB::table('tbclientes as cl')
                            ->join('tbtrabajosxusuario as txu','cl.codigo','=','txu.usuario')
                            ->join('tbcaracteristicasxrol as aT','aT.idRol','=','cl.rol')
                            ->select('cl.codigo','cl.nombre as nombreCliente', 'cl.color_ojos','cl.medidas','cl.calzado','cl.peso','cl.altura',
                                     'cl.preciohora','aT.id','aT.nombre as nombreAT')
                            ->where('cl.rol',$idCategoria)
                            ->whereRaw("upper(txu.trabajo) LIKE upper(aT.nombre)")
                            ->groupBy('cl.codigo','aT.id')
                            ->get();

        $cliXPerfil = DB::table('tbclientes as cl2')
                            ->join('tbimagenesxusuario as im','cl2.codigo','=','im.idEdecan')
                            ->select('cl2.codigo','cl2.nombre as nombreCliente', 'cl2.color_ojos','cl2.medidas','cl2.calzado','cl2.peso','cl2.altura',
                                     'cl2.preciohora','im.url as urlperfil')
                            ->where('cl2.rol',$idCategoria)        
                            ->get();                            

        $clientesDefinitivos = Array();
        $cantXCotiz = $_POST['cantidad'];

        $longitud = count($clientes);
        for ($i = 0; $i < $longitud; $i++) {
            for ($j = 0; $j < $longitud - 1; $j++) {
                if ($clientes[$j]->orden > $clientes[$j + 1]->orden) {
                    $temporal = $clientes[$j];
                    $clientes[$j] = $clientes[$j + 1];
                    $clientes[$j + 1] = $temporal;
                }
            }
        }

        $clientesOrden0 = Array();
        $clientesOrdenMen10 = Array();
        $clientesOrdenMayIg10 = Array();

        for($n=0; $n<sizeof($clientes);$n++){
            if($clientes[$n]->orden==0)
                array_push($clientesOrden0,$clientes[$n]);
            else if($clientes[$n]->orden<10)
                array_push($clientesOrdenMen10,$clientes[$n]);
            else
                array_push($clientesOrdenMayIg10,$clientes[$n]);
        }
        $clientesTemp = Array();
        for($n=0; $n<sizeof($clientesOrdenMen10);$n++)
            array_push($clientesTemp,$clientesOrdenMen10[$n]);
        for($n=0; $n<sizeof($clientesOrden0);$n++)
            array_push($clientesTemp,$clientesOrden0[$n]);
        for($n=0; $n<sizeof($clientesOrdenMayIg10);$n++)
            array_push($clientesTemp,$clientesOrdenMayIg10[$n]);

        $clientes = $clientesTemp;    
        
        if($cantXCotiz==1){
            for($d=0;$d<sizeof($clientes);$d++)
                array_push($clientesDefinitivos,[[$clientes[$d]],1,$cliXAT,$cliXPerfil]);
            return $clientesDefinitivos;     
        }else{
            if(sizeof($clientes)<=$cantXCotiz)
                    array_push($clientesDefinitivos,[$clientes,sizeof($clientes),$cliXAT,$cliXPerfil]);
            else{
                $contador = 0;
                $listaClientes=Array();
                for($a=0; $a<sizeof($clientes); $a++){
                    $contador++;
                    if($contador<=$cantXCotiz)
                        array_push($listaClientes,$clientes[$a]);

                    if($contador==$cantXCotiz){
                        array_push($clientesDefinitivos,[$listaClientes,$cantXCotiz,$cliXAT,$cliXPerfil]);
                        $contador=0;
                        $listaClientes=Array();
                    }
                }
                if($contador>0)
                    array_push($clientesDefinitivos,[$listaClientes,sizeof($listaClientes),$cliXAT,$cliXPerfil]);
            }
        }
        return $clientesDefinitivos;        
    }

    public function cotizar(){
        $idCategoria = $_POST['idCategoria'];
        $clientes = Array();
        /*$clie = ['altura'=>"1.70",'cabello'=>"corto","calzado"=>"37","codigo"=>"0","color_ojos"=>"café",
        "compositor"=>null,"correo"=>"maria@gmail.com","cursos"=>null,"deportes"=>"Natación. Gym. ","disponibilidad"=>"",
        "equipoList"=>null,
        "equipoPropio"=>null,
        "equipoSonido"=>null,
        "experiencia"=>null,
        "facturaelectronica"=>"SI",
        "frenillos"=>"si",
        "generosMusicales"=>null,
        "grado_academico"=>"secundaria completa",
        "habilidades"=>null,
        "idioma"=>"español",
        "instPrincipal"=>null,
        "instSecundario"=>null,
        "licencia"=>"si",
        "luces"=>null,
        "medidas"=>"12",
        "miFuerte"=>null,
        "musica"=>null,
        "nombreCliente"=>"María",
        "orden"=>2,
        "pasaporte"=>"si",
        "peso"=>"58.00",
        "portada"=>null,
        "preciohora"=>null,
        "tattos"=>"visible",
        "telefono"=>8888888,
        "transporte"=>"SI",
        "uniforme"=>"formal"];
        //array_push($clientes,$clie);*/
        
        $whereArray=Array();
        array_push($whereArray,['c.rol',$idCategoria]);
        
        if(isset($_POST['idsAreasTrabajo'])){
            $idsAT = $_POST['idsAreasTrabajo'];
            $idsAreasTrabajo = explode(",",$idsAT);         
            $clientesList = DB::table('tbclientes as cl')
                                    ->select('cl.codigo','cl.nombre as nombreCliente', 'cl.color_ojos','cl.medidas','cl.calzado','cl.peso','cl.altura',
                                             'cl.preciohora','cl.correo','cl.disponibilidad','cl.transporte','cl.portada','cl.telefono','cl.altura',
                                             'cl.peso','cl.disponibilidad','cl.facturaelectronica','cl.experiencia','cl.color_ojos','cl.grado_academico',
                                             'cl.cursos','cl.cabello','cl.frenillos','cl.tattos','cl.idioma','cl.uniforme','cl.pasaporte','cl.licencia',
                                             'cl.instPrincipal','cl.instSecundario','cl.compositor','cl.miFuerte','cl.equipoPropio','cl.luces',
                                             'cl.equipoSonido','cl.equipoSonido','cl.generosMusicales','cl.deportes','cl.musica','cl.equipoList',
                                             'cl.habilidades','cl.orden','cl.direccion','cl.cursos','cl.sobre_mi','cl.demos')
                                    ->where('cl.rol',$idCategoria)
                                    ->get();
            
            for($c=0; $c<sizeof($clientesList); $c++){
                $areasEncontradas=1;
                for($i=0; $i<sizeof($idsAreasTrabajo); $i++){
                    $cli = DB::table('tbclientes as cl')
                                    ->join('tbtrabajosxusuario as txu','cl.codigo','=','txu.usuario')
                                    ->join('tbcaracteristicasxrol as aT','aT.idRol','=','cl.rol')
                                    ->select('cl.codigo','cl.nombre as nombreCliente', 'cl.color_ojos','cl.medidas','cl.calzado','cl.peso','cl.altura',
                                               'cl.preciohora','aT.id','aT.nombre as nombreAT','cl.correo','cl.disponibilidad','cl.transporte','cl.portada','cl.telefono','cl.altura',
                                               'cl.peso','cl.disponibilidad','cl.facturaelectronica','cl.experiencia','cl.color_ojos','cl.grado_academico',
                                               'cl.cursos','cl.cabello','cl.frenillos','cl.tattos','cl.idioma','cl.uniforme','cl.pasaporte','cl.licencia',
                                               'cl.instPrincipal','cl.instSecundario','cl.compositor','cl.miFuerte','cl.equipoPropio','cl.luces',
                                               'cl.equipoSonido','cl.equipoSonido','cl.generosMusicales','cl.deportes','cl.musica','cl.equipoList',
                                               'cl.habilidades','cl.orden','cl.direccion','cl.cursos','cl.sobre_mi','cl.demos')
                                    ->where('cl.rol',$idCategoria)
                                    ->where('cl.codigo',$clientesList[$c]->codigo)
                                    ->where('aT.id',$idsAreasTrabajo[$i])
                                    ->whereRaw("upper(txu.trabajo) LIKE upper(aT.nombre)")
                                    ->groupBy('cl.codigo','aT.id')
                                    ->get();
                    if(sizeof($cli)==0){
                       $areasEncontradas = 0;
                       break;
                    }
                }
                if($areasEncontradas==1)
                    array_push($clientes,$clientesList[$c]);
            }
            //Si no pasa el primer filtro se sale
            if(sizeof($clientes)==0)
               return "vacio";
        }
        
        if(isset($_POST['color_ojos']))
            array_push($whereArray,['c.color_ojos', 'LIKE','%' . $_POST['color_ojos'] . '%']);
        
        if(isset($_POST['medidas']))
            array_push($whereArray,['c.medidas', $_POST['medidas']]);

        if(isset($_POST['calzado1']) && !isset($_POST['calzado2']))
            array_push($whereArray,['c.calzado',$_POST['calzado1']]);

        if(isset($_POST['peso1']) && !isset($_POST['peso2']))
            array_push($whereArray,['c.peso',$_POST['peso1']]);

        if(isset($_POST['altura1']) && !isset($_POST['altura2']))
            array_push($whereArray,['c.altura',$_POST['altura1']]);

        if(isset($_POST['direccion']))
            array_push($whereArray,['c.direccion', 'LIKE','%' . $_POST['direccion'] . '%']);
            
        if(isset($_POST['cursos']))
            array_push($whereArray,['c.cursos', 'LIKE','%' . $_POST['cursos'] . '%']);
            
        if(isset($_POST['sobremi']))
            array_push($whereArray,['c.sobre_mi', 'LIKE','%' . $_POST['sobremi'] . '%']);

        if(isset($_POST['grado_academico']))
            array_push($whereArray,['c.grado_academico',$_POST['grado_academico']]);
        
        if(isset($_POST['tipo_cabello']))
            array_push($whereArray,['c.cabello',$_POST['tipo_cabello']]);

        if(isset($_POST['idioma']))
            array_push($whereArray,['c.idioma',$_POST['idioma']]);
        
        if(isset($_POST['uniforme']))
            array_push($whereArray,['c.uniforme',$_POST['uniforme']]);

        if(isset($_POST['frenillos']))   
            array_push($whereArray,['c.frenillos',$_POST['frenillos']]);
        
        if(isset($_POST['tattos']))
            array_push($whereArray,['c.tattos',$_POST['tattos']]);

        if(isset($_POST['pasaporte']))
            array_push($whereArray,['c.pasaporte',$_POST['pasaporte']]);            
        
        if(isset($_POST['licencia']))
            array_push($whereArray,['c.licencia',$_POST['licencia']]);

        if(isset($_POST['equipoPropio']))
            array_push($whereArray,['c.equipoPropio',$_POST['equipoPropio']]);

        if(isset($_POST['luces']))
            array_push($whereArray,['c.luces',$_POST['luces']]);
            
        if(isset($_POST['equipoSonido']))
            array_push($whereArray,['c.equipoSonido',$_POST['equipoSonido']]);
            
        if(isset($_POST['compositor']))
            array_push($whereArray,['c.compositor',$_POST['compositor']]);
        
        if(isset($_POST['instPrincipal']))         
            array_push($whereArray,['c.instPrincipal', 'LIKE','%' . $_POST['instPrincipal'] . '%']);

        if(isset($_POST['instSecundario']))
            array_push($whereArray,['c.instSecundario', 'LIKE','%' . $_POST['instSecundario'] . '%']);

        if(isset($_POST['demos']))
            array_push($whereArray,['c.demos', 'LIKE','%' . $_POST['demos'] . '%']);
               
        if(sizeof($whereArray)>1){//Si es mayor a 1 vienen filtros aparte del de id de categoria            
                //Aquí no pasa nada porque al menos vendría el filtro por id de Categoría    
            $clientesAux2 = DB::table('tbclientes as c')
                        ->select('c.codigo','c.nombre as nombreCliente', 'c.color_ojos','c.medidas','c.calzado','c.peso','c.altura',
                            'c.preciohora','c.correo','c.disponibilidad','c.transporte','c.portada','c.telefono','c.altura',
                            'c.peso','c.disponibilidad','c.facturaelectronica','c.experiencia','c.color_ojos','c.grado_academico',
                            'c.cursos','c.cabello','c.frenillos','c.tattos','c.idioma','c.uniforme','c.pasaporte','c.licencia',
                            'c.instPrincipal','c.instSecundario','c.compositor','c.miFuerte','c.equipoPropio','c.luces',
                            'c.equipoSonido','c.equipoSonido','c.generosMusicales','c.deportes','c.musica','c.equipoList',
                            'c.habilidades','c.orden','c.direccion','c.cursos','c.sobre_mi','c.demos')
                        ->where($whereArray)->get();

            if(sizeof($clientesAux2)>0){
                /*Entra si no se debía filtrar por áreas de trabajo, porque si filtró por áreas de trabajo y
                  el array de clientes es cero hace que la función devuelva vacío*/
                if(sizeof($clientes)==0){
                    for($f=0; $f<sizeof($clientesAux2); $f++)
                        array_push($clientes,$clientesAux2[$f]);
                }else{
                   /*No agregamos nuevos clientes porque tenemos todos lo que habrían cumplido el primer filtro, pero sí 
                    podemos sacar si no cumplen los nuevos filtros*/
                    for($c=0; $c<sizeof($clientes);$c++){
                        $agregado=0;
                        for($f=0; $f<sizeof($clientesAux2); $f++){
                            //El cliente ya está en la lista y cumple con el filtro actual
                            if($clientesAux2[$f]->codigo == $clientes[$c]->codigo){
                                $agregado=1;
                                break;
                            }
                        }
                        if($agregado==0)//Entra si el cliente actual no cumple los nuevos filtros
                           array_splice($clientes, $c, 1);
                    }
                }
                if(sizeof($clientes)==0)
                   return "vacio";
            }else
              return "vacio";
        }
        //Cada vez que hago filtros si al final la lista de clientes queda en cero devuelve vacío
        if(isset($_POST['peso1']) && isset($_POST['peso2'])){
            $peso1 = $_POST['peso1'];
            $peso2 = $_POST['peso2'];
            $pesos = Array();
            for($p=$peso1; $p<=$peso2; $p++)
                array_push($pesos,$p);

            $clientesAux = DB::table('tbclientes as c')
                                ->select('c.codigo','c.nombre as nombreCliente', 'c.color_ojos','c.medidas','c.calzado','c.peso','c.altura',
                                        'c.preciohora','c.correo','c.disponibilidad','c.transporte','c.portada','c.telefono','c.altura',
                                        'c.peso','c.disponibilidad','c.facturaelectronica','c.experiencia','c.color_ojos','c.grado_academico',
                                        'c.cursos','c.cabello','c.frenillos','c.tattos','c.idioma','c.uniforme','c.pasaporte','c.licencia',
                                        'c.instPrincipal','c.instSecundario','c.compositor','c.miFuerte','c.equipoPropio','c.luces',
                                        'c.equipoSonido','c.equipoSonido','c.generosMusicales','c.deportes','c.musica','c.equipoList',
                                        'c.habilidades','c.orden','c.direccion','c.cursos','c.sobre_mi','c.demos')
                                ->where('c.rol',$idCategoria)
                                ->whereIn('c.peso',$pesos)->get();

            if(sizeof($clientesAux)>0){
                /*Entra si no se debía filtrar por áreas de trabajo o por los filtros anteriores, porque si filtró por áreas de trabajo o por los filtros
                  anteriores y el array de clientes es cero hace que la función devuelva vacío*/
                if(sizeof($clientes)==0){
                    for($f=0; $f<sizeof($clientesAux); $f++)
                        array_push($clientes,$clientesAux[$f]);
                }else{
                    /*No agregamos nuevos clientes porque tenemos todos lo que habrían cumplido los filtros anteriores, pero sí 
                        podemos sacar si no cumplen los nuevos filtros*/
                    for($c=0; $c<sizeof($clientes);$c++){
                        $agregado=0;
                        for($f=0; $f<sizeof($clientesAux); $f++){
                            //El cliente ya está en la lista y cumple con el filtro actual
                            if($clientesAux[$f]->codigo == $clientes[$c]->codigo){
                                $agregado=1;
                                break;
                            }
                        }
                        if($agregado==0)//Entra si el cliente actual no cumple los nuevos filtros
                           array_splice($clientes, $c, 1);
                    }
                }
            }else
               return "vacio";
                
            if(sizeof($clientes)==0)
               return "vacio";    
        }
        //Cada vez que hago filtros si al final la lista de clientes queda en cero devuelve vacío
        if(isset($_POST['calzado1']) && isset($_POST['calzado2'])){
            $calzado1 = $_POST['calzado1'];
            $calzado2 = $_POST['calzado2'];
            $calzados = Array();
            for($cz=$calzado1; $cz<=$calzado2; $cz++)
                array_push($calzados,$cz);

            $clientesAux = DB::table('tbclientes as c')
                                ->select('c.codigo','c.nombre as nombreCliente', 'c.color_ojos','c.medidas','c.calzado','c.peso','c.altura',
                                        'c.preciohora','c.correo','c.disponibilidad','c.transporte','c.portada','c.telefono','c.altura',
                                        'c.peso','c.disponibilidad','c.facturaelectronica','c.experiencia','c.color_ojos','c.grado_academico',
                                        'c.cursos','c.cabello','c.frenillos','c.tattos','c.idioma','c.uniforme','c.pasaporte','c.licencia',
                                        'c.instPrincipal','c.instSecundario','c.compositor','c.miFuerte','c.equipoPropio','c.luces',
                                        'c.equipoSonido','c.equipoSonido','c.generosMusicales','c.deportes','c.musica','c.equipoList',
                                        'c.habilidades','c.orden','c.direccion','c.cursos','c.sobre_mi','c.demos')
                                ->where('c.rol',$idCategoria)
                                ->whereIn('c.calzado',$calzados)->get();

            if(sizeof($clientesAux)>0){
                /*Entra si no se debía filtrar por áreas de trabajo o por los filtros anteriores, porque si filtró por áreas de trabajo o por los filtros
                  anteriores y el array de clientes es cero hace que la función devuelva vacío*/
                if(sizeof($clientes)==0){
                    for($f=0; $f<sizeof($clientesAux); $f++)
                        array_push($clientes,$clientesAux[$f]);
                }else{
                    /*No agregamos nuevos clientes porque tenemos todos lo que habrían cumplido los filtros anteriores, pero sí 
                        podemos sacar si no cumplen los nuevos filtros*/
                    for($c=0; $c<sizeof($clientes);$c++){
                        $agregado=0;
                        for($f=0; $f<sizeof($clientesAux); $f++){
                            //El cliente ya está en la lista y cumple con el filtro actual
                            if($clientesAux[$f]->codigo == $clientes[$c]->codigo){
                                $agregado=1;
                                break;
                            }
                        }
                        if($agregado==0)//Entra si el cliente actual no cumple los nuevos filtros
                           array_splice($clientes, $c, 1);
                    }
                }
            }else
               return "vacio";

            if(sizeof($clientes)==0)
               return "vacio";    
        }
        //Cada vez que hago filtros si al final la lista de clientes queda en cero devuelve vacío
        if(isset($_POST['altura1']) && isset($_POST['altura2'])){
            $altura1 = $_POST['altura1'];
            $altura2 = $_POST['altura2'];
            $alturas = Array();
            for($a=$altura1; $a<=$altura2; $a+=0.01)
                array_push($alturas,$a);

            $clientesAux = DB::table('tbclientes as c')
                                ->select('c.codigo','c.nombre as nombreCliente', 'c.color_ojos','c.medidas','c.calzado','c.peso','c.altura',
                                        'c.preciohora','c.correo','c.disponibilidad','c.transporte','c.portada','c.telefono','c.altura',
                                        'c.peso','c.disponibilidad','c.facturaelectronica','c.experiencia','c.color_ojos','c.grado_academico',
                                        'c.cursos','c.cabello','c.frenillos','c.tattos','c.idioma','c.uniforme','c.pasaporte','c.licencia',
                                        'c.instPrincipal','c.instSecundario','c.compositor','c.miFuerte','c.equipoPropio','c.luces',
                                        'c.equipoSonido','c.equipoSonido','c.generosMusicales','c.deportes','c.musica','c.equipoList',
                                        'c.habilidades','c.orden','c.direccion','c.cursos','c.sobre_mi','c.demos')
                                ->where('c.rol',$idCategoria)
                                ->whereIn('c.altura',$alturas)->get();

            if(sizeof($clientesAux)>0){
                /*Entra si no se debía filtrar por áreas de trabajo o por los filtros anteriores, porque si filtró por áreas de trabajo o por los filtros
                  anteriores y el array de clientes es cero hace que la función devuelva vacío*/
                if(sizeof($clientes)==0){
                    for($f=0; $f<sizeof($clientesAux); $f++)
                        array_push($clientes,$clientesAux[$f]);
                }else{
                    /*No agregamos nuevos clientes porque tenemos todos lo que habrían cumplido los filtros anteriores, pero sí 
                        podemos sacar si no cumplen los nuevos filtros*/
                    for($c=0; $c<sizeof($clientes);$c++){
                        $agregado=0;
                        for($f=0; $f<sizeof($clientesAux); $f++){
                            //El cliente ya está en la lista y cumple con el filtro actual
                            if($clientesAux[$f]->codigo == $clientes[$c]->codigo){
                                $agregado=1;
                                break;
                            }
                        }
                        if($agregado==0)//Entra si el cliente actual no cumple los nuevos filtros
                           array_splice($clientes, $c, 1);
                    }
                }
            }else
               return "vacio";

            if(sizeof($clientes)==0)
               return "vacio";    
        }
       
        if(isset($_POST['descripcionDeportes'])){
            $descDep = $_POST['descripcionDeportes'];
            $descDeportes = explode(",",$descDep);
            $clientesAux = Array();  
            $clientesList = DB::table('tbclientes as cl')
                                    ->select('cl.codigo','cl.nombre as nombreCliente', 'cl.color_ojos','cl.medidas','cl.calzado','cl.peso','cl.altura',
                                             'cl.preciohora','cl.correo','cl.disponibilidad','cl.transporte','cl.portada','cl.telefono','cl.altura',
                                             'cl.peso','cl.disponibilidad','cl.facturaelectronica','cl.experiencia','cl.color_ojos','cl.grado_academico',
                                             'cl.cursos','cl.cabello','cl.frenillos','cl.tattos','cl.idioma','cl.uniforme','cl.pasaporte','cl.licencia',
                                             'cl.instPrincipal','cl.instSecundario','cl.compositor','cl.miFuerte','cl.equipoPropio','cl.luces',
                                             'cl.equipoSonido','cl.equipoSonido','cl.generosMusicales','cl.deportes','cl.musica','cl.equipoList',
                                             'cl.habilidades','cl.orden','cl.direccion','cl.cursos','cl.sobre_mi','cl.demos')
                                    ->where('cl.rol',$idCategoria)
                                    ->get();
            //Guarda en $clientesAux los clientes que practican los deportes seleccionados
            for($c=0; $c<sizeof($clientesList); $c++){
                $deportesEncontrados=1;
                for($i=0; $i<sizeof($descDeportes); $i++){
                    $dep = $clientesList[$c]->deportes!=null?$clientesList[$c]->deportes:"";
                    if($dep!=""){
                        $matches=[];
                        preg_match_all('/\w/u', "áàäéèëíìïòóöùúüÀÁÄÈÉËÌÍÏÒÓÖÙÚÜ", $matches);
                        $find=array_map(function($el) { return "/".$el."/u"; },$matches[0]); 
                        $campoSinTilde = preg_replace($find, str_split("aaaeeeiiiooouuuAAAEEEIIIOOOUUU"), $dep);                    
                        $encontrado = 1;
                        if(!str_contains(strtoupper($campoSinTilde), strtoupper($descDeportes[$i]))){
                           $deportesEncontrados=0;
                           break;
                        }
                    }
                }
                if($deportesEncontrados==1)
                   array_push($clientesAux,$clientesList[$c]);
            }
            if(sizeof($clientesAux)>0){
                if(sizeof($clientes)==0){
                    for($f=0; $f<sizeof($clientesAux); $f++)
                        array_push($clientes,$clientesAux[$f]);
                }else{
                    for($c2=0; $c2<sizeof($clientes);$c2++){
                        $agregado=0;
                        for($f=0; $f<sizeof($clientesAux); $f++){
                            if($clientesAux[$f]->codigo == $clientes[$c2]->codigo){
                                $agregado=1;
                                break;
                            }
                        }
                        if($agregado==0)
                           array_splice($clientes, $c2, 1);
                    }
                }
            }else
               return "vacio";
            if(sizeof($clientes)==0)
               return "vacio";
        }
        
        if(isset($_POST['descripcionEquipos'])){
            $descEqp = $_POST['descripcionEquipos'];
            $descEquipos = explode(",",$descEqp);
            $clientesAux = Array();
            $clientesList = DB::table('tbclientes as cl')
                                    ->select('cl.codigo','cl.nombre as nombreCliente', 'cl.color_ojos','cl.medidas','cl.calzado','cl.peso','cl.altura',
                                             'cl.preciohora','cl.correo','cl.disponibilidad','cl.transporte','cl.portada','cl.telefono','cl.altura',
                                             'cl.peso','cl.disponibilidad','cl.facturaelectronica','cl.experiencia','cl.color_ojos','cl.grado_academico',
                                             'cl.cursos','cl.cabello','cl.frenillos','cl.tattos','cl.idioma','cl.uniforme','cl.pasaporte','cl.licencia',
                                             'cl.instPrincipal','cl.instSecundario','cl.compositor','cl.miFuerte','cl.equipoPropio','cl.luces',
                                             'cl.equipoSonido','cl.equipoSonido','cl.generosMusicales','cl.deportes','cl.musica','cl.equipoList',
                                             'cl.habilidades','cl.orden','cl.direccion','cl.cursos','cl.sobre_mi','cl.demos')
                                    ->where('cl.rol',$idCategoria)
                                    ->get();
            for($c=0; $c<sizeof($clientesList); $c++){
                $equiposEncontrados=1;
                for($i=0; $i<sizeof($descEquipos); $i++){
                    $dep = $clientesList[$c]->musica!=null?$clientesList[$c]->musica:"";
                    if($dep!=""){
                        $matches=[];
                        preg_match_all('/\w/u', "áàäéèëíìïòóöùúüÀÁÄÈÉËÌÍÏÒÓÖÙÚÜ", $matches);
                        $find=array_map(function($el) { return "/".$el."/u"; },$matches[0]);
                        $campoSinTilde = preg_replace($find, str_split("aaaeeeiiiooouuuAAAEEEIIIOOOUUU"), $dep);
                        $encontrado = 1;
                        if(!str_contains(strtoupper($campoSinTilde), strtoupper($descEquipos[$i]))){
                           $equiposEncontrados=0;
                           break;
                        }
                    }
                }
                if($equiposEncontrados==1)
                    array_push($clientesAux,$clientesList[$c]); 
            }
            if(sizeof($clientesAux)>0){
                if(sizeof($clientes)==0){
                    for($f=0; $f<sizeof($clientesAux); $f++)
                        array_push($clientes,$clientesAux[$f]);
                }else{
                    for($c2=0; $c2<sizeof($clientes);$c2++){
                        $agregado=0;
                        for($f=0; $f<sizeof($clientesAux); $f++){
                            if($clientesAux[$f]->codigo == $clientes[$c2]->codigo){
                                $agregado=1;
                                break;
                            }
                        }
                        if($agregado==0)
                           array_splice($clientes, $c2, 1);
                    }
                }
            }else
               return "vacio";

            if(sizeof($clientes)==0)
               return "vacio";         
        }
        //tbgenerosmusicales1:2
        if(isset($_POST['descripcionGenMusicales'])){
            $descGMus = $_POST['descripcionGenMusicales'];
            $descGenMusicales = explode(",",$descGMus);
            $clientesAux = Array();
            $clientesList = DB::table('tbclientes as cl')
                                    ->select('cl.codigo','cl.nombre as nombreCliente', 'cl.color_ojos','cl.medidas','cl.calzado','cl.peso','cl.altura',
                                             'cl.preciohora','cl.correo','cl.disponibilidad','cl.transporte','cl.portada','cl.telefono','cl.altura',
                                             'cl.peso','cl.disponibilidad','cl.facturaelectronica','cl.experiencia','cl.color_ojos','cl.grado_academico',
                                             'cl.cursos','cl.cabello','cl.frenillos','cl.tattos','cl.idioma','cl.uniforme','cl.pasaporte','cl.licencia',
                                             'cl.instPrincipal','cl.instSecundario','cl.compositor','cl.miFuerte','cl.equipoPropio','cl.luces',
                                             'cl.equipoSonido','cl.equipoSonido','cl.generosMusicales','cl.deportes','cl.musica','cl.equipoList',
                                             'cl.habilidades','cl.orden','cl.direccion','cl.cursos','cl.sobre_mi','cl.demos')
                                    ->where('cl.rol',$idCategoria)
                                    ->get();
            for($c=0; $c<sizeof($clientesList); $c++){
                $genMusicalesEncontradas = 1;
                for($i=0; $i<sizeof($descGenMusicales); $i++){
                    $dep = $clientesList[$c]->generosMusicales!=null?$clientesList[$c]->generosMusicales:"";
                    if($dep!=""){
                        $matches=[];
                        preg_match_all('/\w/u', "áàäéèëíìïòóöùúüÀÁÄÈÉËÌÍÏÒÓÖÙÚÜ", $matches);
                        $find=array_map(function($el) { return "/".$el."/u"; },$matches[0]);
                        $campoSinTilde = preg_replace($find, str_split("aaaeeeiiiooouuuAAAEEEIIIOOOUUU"), $dep);                    
                        $encontrado = 1;
                        if(!str_contains(strtoupper($campoSinTilde), strtoupper($descGenMusicales[$i]))){
                           $genMusicalesEncontradas=0;
                           break;
                        }
                    }                  
                }
                if($genMusicalesEncontradas==1)
                    array_push($clientesAux,$clientesList[$c]); 
            }
            if(sizeof($clientesAux)>0){
                if(sizeof($clientes)==0){
                    for($f=0; $f<sizeof($clientesAux); $f++)
                        array_push($clientes,$clientesAux[$f]);
                }else{
                    for($c2=0; $c2<sizeof($clientes);$c2++){
                        $agregado=0;
                        for($f=0; $f<sizeof($clientesAux); $f++){
                            if($clientesAux[$f]->codigo == $clientes[$c2]->codigo){
                                $agregado=1;
                                break;
                            }
                        }
                        if($agregado==0)
                           array_splice($clientes, $c2, 1);
                    }
                }
            }else
               return "vacio";

            if(sizeof($clientes)==0)
               return "vacio";
        }
        //tbmusica
        //descripcionMusica
        if(isset($_POST['descripcionMusicas'])){            
            $descMus = $_POST['descripcionMusicas'];
            $descMusicales = explode(",",$descMus);
            $clientesAux = Array();
            $clientesList = DB::table('tbclientes as cl')
                                    ->select('cl.codigo','cl.nombre as nombreCliente', 'cl.color_ojos','cl.medidas','cl.calzado','cl.peso','cl.altura',
                                             'cl.preciohora','cl.correo','cl.disponibilidad','cl.transporte','cl.portada','cl.telefono','cl.altura',
                                             'cl.peso','cl.disponibilidad','cl.facturaelectronica','cl.experiencia','cl.color_ojos','cl.grado_academico',
                                             'cl.cursos','cl.cabello','cl.frenillos','cl.tattos','cl.idioma','cl.uniforme','cl.pasaporte','cl.licencia',
                                             'cl.instPrincipal','cl.instSecundario','cl.compositor','cl.miFuerte','cl.equipoPropio','cl.luces',
                                             'cl.equipoSonido','cl.equipoSonido','cl.generosMusicales','cl.deportes','cl.musica','cl.equipoList',
                                             'cl.habilidades','cl.orden','cl.direccion','cl.cursos','cl.sobre_mi','cl.demos')
                                    ->where('cl.rol',$idCategoria)
                                    ->get(); 
            for($c=0; $c<sizeof($clientesList); $c++){
                $musicasEncontradas = 1;
                for($i=0; $i<sizeof($descMusicales); $i++){                    
                    $dep = $clientesList[$c]->musica!=null?$clientesList[$c]->musica:"";
                    if($dep!=""){
                        $matches=[];
                        preg_match_all('/\w/u', "áàäéèëíìïòóöùúüÀÁÄÈÉËÌÍÏÒÓÖÙÚÜ", $matches);
                        $find=array_map(function($el) { return "/".$el."/u"; },$matches[0]);
                        $campoSinTilde = preg_replace($find, str_split("aaaeeeiiiooouuuAAAEEEIIIOOOUUU"), $dep);                    
                        $encontrado = 1;
                        if(!str_contains(strtoupper($campoSinTilde), strtoupper($descMusicales[$i]))){
                           $musicasEncontradas=0;
                           break;
                        }
                    }
                }
                if($musicasEncontradas==1)
                    array_push($clientesAux,$clientesList[$c]);
            }
            if(sizeof($clientesAux)>0){
                if(sizeof($clientes)==0){
                    for($f=0; $f<sizeof($clientesAux); $f++)
                        array_push($clientes,$clientesAux[$f]);
                }else{
                    for($c=0; $c<sizeof($clientes);$c++){
                        $agregado=0;
                        for($f=0; $f<sizeof($clientesAux); $f++){
                            if($clientesAux[$f]->codigo == $clientes[$c]->codigo){
                                $agregado=1;
                                break;
                            }
                        }
                        if($agregado==0)
                           array_splice($clientes, $c, 1);
                    }
                }
            }else
               return "vacio";

            if(sizeof($clientes)==0)
               return "vacio";
        }
        
        $cliXAT = DB::table('tbclientes as cl')
                          ->join('tbtrabajosxusuario as txu','cl.codigo','=','txu.usuario')
                          ->join('tbcaracteristicasxrol as aT','aT.idRol','=','cl.rol')
                          ->select('cl.codigo','cl.nombre as nombreCliente', 'cl.color_ojos','cl.medidas','cl.calzado','cl.peso','cl.altura',
                                   'cl.preciohora','aT.id','aT.nombre as nombreAT')
                          ->where('cl.rol',$idCategoria)
                          ->whereRaw("upper(txu.trabajo) LIKE upper(aT.nombre)")
                          ->groupBy('cl.codigo','aT.id')
                          ->get();

        $cliXPerfil = DB::table('tbclientes as cl2')
                            ->join('tbimagenesxusuario as im','cl2.codigo','=','im.idEdecan')
                            ->select('cl2.codigo','cl2.nombre as nombreCliente', 'cl2.color_ojos','cl2.medidas','cl2.calzado','cl2.peso','cl2.altura',
                                     'cl2.preciohora','im.url as urlperfil')
                            ->where('cl2.rol',$idCategoria)        
                            ->get();
        
        $clientesDefinitivos = Array();
        $cantXCotiz = $_POST['cantidad'];

        if(sizeof($clientes)==0)
           return "vacio";
        
        $longitud = count($clientes);
        for ($i = 0; $i < $longitud; $i++) {
            for ($j = 0; $j < $longitud - 1; $j++) {
                if ($clientes[$j]->orden > $clientes[$j + 1]->orden) {
                    $temporal = $clientes[$j];
                    $clientes[$j] = $clientes[$j + 1];
                    $clientes[$j + 1] = $temporal;
                }
            }
        }


        $clientesOrden0 = Array();
        $clientesOrdenMen10 = Array();
        $clientesOrdenMayIg10 = Array();

        for($n=0; $n<sizeof($clientes);$n++){
            if($clientes[$n]->orden==0)
                array_push($clientesOrden0,$clientes[$n]);
            else if($clientes[$n]->orden<10)
                array_push($clientesOrdenMen10,$clientes[$n]);
            else
                array_push($clientesOrdenMayIg10,$clientes[$n]);
        }
        $clientesTemp = Array();
        for($n=0; $n<sizeof($clientesOrdenMen10);$n++)
            array_push($clientesTemp,$clientesOrdenMen10[$n]);
        for($n=0; $n<sizeof($clientesOrden0);$n++)
            array_push($clientesTemp,$clientesOrden0[$n]);
        for($n=0; $n<sizeof($clientesOrdenMayIg10);$n++)
            array_push($clientesTemp,$clientesOrdenMayIg10[$n]);

        $clientes = $clientesTemp;    
        
        if($cantXCotiz==1){
            for($d=0;$d<sizeof($clientes);$d++)
                array_push($clientesDefinitivos,[[$clientes[$d]],1,$cliXAT,$cliXPerfil]);
            return $clientesDefinitivos;     
        }else{                   
            if(sizeof($clientes)<=$cantXCotiz)
                    array_push($clientesDefinitivos,[$clientes,sizeof($clientes),$cliXAT,$cliXPerfil]);
            else{
                $contador = 0;
                $listaClientes=Array();                                
                for($a=0; $a<sizeof($clientes); $a++){
                    $contador++;
                    if($contador<=$cantXCotiz)
                        array_push($listaClientes,$clientes[$a]);

                    if($contador==$cantXCotiz){
                        array_push($clientesDefinitivos,[$listaClientes,$cantXCotiz,$cliXAT,$cliXPerfil]);
                        $contador=0;
                        $listaClientes=Array();
                    }
                }
                if($contador>0)
                    array_push($clientesDefinitivos,[$listaClientes,sizeof($listaClientes),$cliXAT,$cliXPerfil]);
            }
        }
        return $clientesDefinitivos;
    }    
}
