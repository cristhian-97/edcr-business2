<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Filtro;
use App\Http\Controllers\DashboardController;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if(DashboardController::estaLogeado()){
            $categorias = Categoria::obtenerCategorias();
            $comision = Categoria::obtenerPrecioCotizacion();
            $correoEDCR = Categoria::obtenerCorreo();
            return view('categoria.categoria',['categorias'=>$categorias,'comision'=>$comision,'correoedcr'=>$correoEDCR]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //
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
    public function edit($id){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //
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

    public function mostrarCategoria(Request $request){
        if(DashboardController::estaLogeado()){
            /**obtener la categoría
             * En clientes hay filtros, estos los muestro en categoriaInfo, según el id de la categoría, preciohora y preciodia
             * Las areas de trabajo las obtengo de aqui tbcaracteristicasxrol (idRol, id, nombre, estado)
             * habilidades de tbhabilidades (id, descripción, estado y rol). Ej: Acaparar al cliente, fluidez al hablar
             * tbtrabajosxusuario (id, usuario, trabajo), trabajo=Radio y podcast, expos, masivos..
             * tbdeportes(id, descripcion y estado)
             * tbequipo (id, descripción y estado). Ej: Drone, cámara, luz, efectos 
             * tbgenerosmusicales (id, descripcion y estado). Ej: Charanga, electrónica, Beggae, Roots, Electro House, House, Todos los generos 
             * tbidioma (id, descripcion y estado). Ej: Español, Inglés
             * tbpaises (id, nombre, opcionales, estado). Ej Costa Rica, Panama
             * tbmusica (id, descripcion, estado). Ej: Rock en Español, Rock en Inglés, Latino
             */
            $comision = $request->comision;
            $correoedcr = $request->correoedcr;
            $cat = Categoria::obtenerCategoria($request->id);
            $areasTrabajo=null;
            $deportes=null;
            $idiomas = null;
            $equipos=null;
            $generosMusicales=null;
            $musica = null;
            $areasTrabajo = Filtro::obtenerAreasTrabajo($request->id);
            if($request->id==1 || $request->id==2 || $request->id==3){       
                //$areasTrabajo = Filtro::obtenerAreasTrabajo($request->id);
                $deportes = Filtro::obtenerDeportes();//deportes devuelve todos porque no tiene fk
                $idiomas = Filtro::obtenerIdiomas();
            }else if($request->id==4 || $request->id==7){
                //$areasTrabajo = Filtro::obtenerAreasTrabajo($request->id);
                //Revizar esto para verificar si realmente son equipos o géneros
                $equipos = Filtro::obtenerEquipos();
            }else if($request->id==5){
                //$areasTrabajo = Filtro::obtenerAreasTrabajo($request->id);
                $musica = Filtro::obtenerMusica();//tbgenerosmusicales
                $idiomas = Filtro::obtenerIdiomas();
                //$generosMusicales = Filtro::obtenerGenerosMusicales();           
            }else if($request->id==6){
                //$areasTrabajo = Filtro::obtenerAreasTrabajo($request->id);
                $generosMusicales = Filtro::obtenerGenerosMusicales();//tbgenerosmusicales
            }else if($request->id==8 || $request->id==9 || $request->id==10 || $request->id==11|| $request->id==12){
                //$areasTrabajo = Filtro::obtenerAreasTrabajo($request->id);
            }
            $emp = $_SESSION['empresa'];
            return view('categoria.categoriaInfo',['categoria'=>$cat,'areasTrabajo'=>$areasTrabajo,'deportes'=>$deportes, 'idiomas'=>$idiomas, 'equipos'=>$equipos,
                                                    'musica'=>$musica,'generosMusicales'=>$generosMusicales,'empId'=>$emp->id,'comision'=>$comision,
                                                    'correoedcr'=>$correoedcr]);
        }
    }

    public function obtenerCliente(){
        return Filtro::obtenerAreasTrabajoXClientes();        
    }

    public function cotizar(){
        if(isset($_POST['idCategoria'])){
            if($_POST['filtros']=="SI")
                return Categoria::cotizar();
            else if($_POST['filtros']=="NO")
                return Categoria::cotizarSinFiltros();    
        }
        return "Error";
    }

    public function contactar(){
        if(isset($_POST['codigo'])){
            return Filtro::obtenerCliente();
        }
        return "Error";
    }
}
