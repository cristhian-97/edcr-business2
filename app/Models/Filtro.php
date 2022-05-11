<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Filtro extends Model
{
    use HasFactory;
    public function obtenerFiltros($idCategoría){
        return DB::table('tbclientes')->where('rol', $idCategoría)->get();
    }

    public function obtenerCliente(){
        $codigo = $_POST['codigo'];
        return DB::table('tbclientes')->where('codigo', $codigo)->get();
    }    

    public function obtenerAreasTrabajo($idCategoría){
        return DB::table('tbcaracteristicasxrol')->where('idRol', $idCategoría)->get();
    }

    public function obtenerAreasTrabajoXCliente(){
        $idCategoria = $_POST['idCategoria'];
        $codigo =  $_POST['codigo'];
        $cli = DB::table('tbclientes as cl')
                            ->join('tbtrabajosxusuario as txu','cl.codigo','=','txu.usuario')
                            ->join('tbcaracteristicasxrol as aT','aT.idRol','=','cl.rol')
                            ->select('cl.codigo','cl.nombre as nombreCliente', 'cl.color_ojos','cl.medidas','cl.calzado','cl.peso','cl.altura',
                                       'cl.preciohora','aT.id','aT.nombre as nombreAT')
                            ->where('cl.rol',$idCategoria)           
                            ->where('cl.codigo',$codigo)
                            ->whereRaw("upper(txu.trabajo) LIKE upper(aT.nombre)")
                            ->groupBy('cl.codigo','aT.id')
                            ->get();
        if(sizeof($cli)==0)
          return "vacio";
        else 
         return $cli;  
    }

    public function obtenerDeportes(){
        return DB::table('tbdeportes')->get();
    }

    public function obtenerIdiomas(){
        return DB::table('tbidioma')->get();
    }    

    public function obtenerEquipos(){
        return DB::table('tbequipo')->get();
    }

    public function obtenerGenerosMusicales(){
        return DB::table('tbgenerosmusicales')->get();
    }
    public function obtenerMusica(){
        return DB::table('tbmusica')->get();
    }

    public function filtroXAreaTrabajo(){
        return DB::table('tbcaracteristicasxrol')->get();
    }

}
