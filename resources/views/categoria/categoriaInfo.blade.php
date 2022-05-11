@extends('adminlte::page')

@section('content')
<div style="display: flow-box; align-items:center" class="titulo"><br>
<button type="button" value="Cancelar" name="btn_cancelar" class="btn btn-danger" id="btn_cancelar">Cancelar</button>
@if($categoria!=null)
    <h2 style="width: 100%;text-align:center;">Categoría {{$categoria->nombre}}</h2>
@else
    <h1 style="width: 100%;text-align:center;">Categoría</h1>
@endif    
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="sticky-top mb-3">
                <div class="input-group">
                    <div class="card-body">
                        <div class=" mt-5 row">
                            <div class="col-md-12">
                            <!--$categoria->id==1=Edecanes
                                $categoria->id==2=Modelos de Fotografías
                                $categoria->id==3=Modelos de Fitness-->
                                <div id="contenedorCategoria">
                                    <input type="text" id="idEmpresa" hidden value="{{$empId}}">    
                                    <input type="text" id="idCategoria" hidden value="{{$categoria->id}}">
                                    <input type="text" id="nombreCategoria" hidden value="{{$categoria->nombre}}">
                                    <input type="number" id="precioCategoria" hidden value="{{$categoria->preciohora}}">
                                    <input type="text" id="comision" hidden value="{{$comision}}">
                                    <div class="input-group mt-4">
                                        <div class="col-md-6">
                                            <label style="position: absolute;top:-22px;">Lugar</label>
                                            <input type="text" id="txtLugar" name="lugar" placeholder="Lugar" title="Lugar" class="form-control rounded" value="" >
                                            <label class="error" id="errorLugar" hidden>Ingrese el lugar</label>
                                        </div>                                    
                                        <div class="col-md-6">
                                            <label style="position: absolute;top:-22px;">Función</label>
                                            <input type="text" id="txtFuncion" name="funcion" placeholder="Funcion" title="Funcion" class="form-control rounded" value="" >
                                            <label class="error" id="errorFuncion" hidden>Ingrese la función</label>
                                        </div>
                                    </div><br>
                                    <div class="input-group mt-4">
                                        <div class="col-md-6">
                                            <label style="position: absolute;top:-22px;">Cantidad de candidatos por cotización</label>
                                            <input type="number" min="1" id="txtCantidad" name="Cantidad" placeholder="Cantidad de candidatos por cotización" title="Cantidad" class="form-control rounded" value="" >
                                            <label class="error" id="errorCantidad" hidden>Ingrese la cantidad de candidatos por cotización</label>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="txtHoras" style="position: absolute;top:-22px;">Cantidad de Horas</label>
                                            <input type="number" min="1" id="txtHoras" name="horas" placeholder="Cantidad de Horas" title="Cantidad de Horas" class="form-control rounded" value="">
                                            <label class="error" id="errorHoras" hidden>Ingrese la cantidad de horas</label>
                                        </div>  
                                    </div><br>
                                    <div class="input-group mt-4">
                                        <div class="col-md-6">
                                            <label style="position: absolute;top:-22px;">Seleccione el tipo de Facturación</label>
                                            <select class="btn" style="border-color:black" id="slTipoFacturacion" required="">
                                                <option value="0" hidden="">Tipo de Facturación</option>
                                                <option value="edcr">Contratar con EDCR</option>
                                                <option value="candidatos">Contratar con Candidatos</option>
                                            </select><br>
                                            <label class="error" id="errorTipoFacturacion" hidden>Seleccione el tipo de Facturación</label>
                                        </div>
                                    </div><br>
                                    <h4>Áreas de trabajo</h4>
                                    <div id="contenedor-data" class='table-responsive'>
                                        <table class="table">
                                            </tbody>
                                            @if(count($areasTrabajo)>0)
                                                <tr><td></td><td><input type="checkbox" class="mt-2 ml-1" data-width="120" data-height="37" onChange="checkAreas(this)"/><label>&nbsp;Marcar todo</label></td><tr>
                                            @endif
                                            @foreach($areasTrabajo as $a)
                                                <tr>
                                                    <td>{{$a->nombre}}</td>
                                                    <td><input type="checkbox" id="{{$a->id}}" class="mt-2 ml-1 chkAT" data-width="120" data-height="37"/></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table><br>
                                        @if($categoria!=null && ($categoria->id==1 || $categoria->id==2 || $categoria->id==3 ))<!--Edecanes-->
                                        <div class="input-group mt-4  ">
                                            <label style="position: absolute;top:-22px;">Color de Ojos</label>
                                            <input type="text" id="txtColorOjos" name="colorOjos" placeholder="Color de Ojos" title="Color de Ojos" class="form-control rounded" value="" >
                                        </div>
                                        <div class="input-group mt-4">
                                            <label for="txtMedidas" style="position: absolute;top:-22px;">Medidas</label>
                                            <input type="number" min="1" id="txtMedidas" name="medidas" placeholder="Medidas" title="Medidas" class="form-control rounded" value="" >
                                        </div>
                                        <div class="input-group mt-4">
                                            <div class="col-md-2">                                            
                                                <input type="checkbox" id="chkCalzado" class="mt-2 ml-1" data-width="120" data-height="37" 
                                                   onChange="checkCalzado(this)"/>
                                                <label>Rango</label>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="txtCalzado1" style="position: absolute;top:-22px;">Calzado Inicial</label>
                                                <input type="number" id="txtCalzado1" placeholder="Calzado Inicial" title="Calzado Inicial" class="form-control rounded" value="">
                                            </div>
                                            <div class="col-md-5">
                                                <label for="txtCalzado2" style="position: absolute;top:-22px;">Calzado Final</label>
                                                <input type="number" min="1" id="txtCalzado2" placeholder="Calzado Final" title="Calzado Final" class="form-control rounded"
                                                 value="" disabled>
                                            </div>                                        
                                        </div>
                                        <label class="error" id="errorCalzado" hidden>Rango Inicial debe ser menor al Rango Final</label>
                                        <label class="error" id="errorCalzado2" hidden>Ingrese el valor del Rango Final</label>

                                        <div class="input-group mt-4  ">
                                            <div class="col-md-2">                                            
                                                <input type="checkbox" id="chkPeso" class="mt-2 ml-1" data-width="120" data-height="37" 
                                                    onChange="checkPeso(this)"/>
                                                <label>Rango</label>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="txtPeso1" style="position: absolute;top:-22px;">Peso Inicial</label>
                                                <input type="number" min="1" id="txtPeso1" placeholder="Peso Inicial" title="Peso Inicial" class="form-control rounded" value="" >
                                            </div>
                                            <div class="col-md-5">
                                                <label for="txtPeso2" style="position: absolute;top:-22px;">Peso Final</label>
                                                <input type="number" min="1" id="txtPeso2" placeholder="Peso Final" title="Peso Final" class="form-control rounded" value="" 
                                                    disabled>
                                            </div>
                                        </div>
                                        <label class="error" id="errorPeso" hidden>Rango Inicial debe ser menor al Rango Final</label>
                                        <label class="error" id="errorPeso2" hidden>Ingrese el valor del Rango Final</label>

                                        <div class="input-group mt-4  ">
                                            <div class="col-md-2">                                            
                                                <input type="checkbox" id="chkAltura" class="mt-2 ml-1" data-width="120" data-height="37" 
                                                    onChange="checkAltura(this)"/>
                                                <label>Rango</label>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="txtAltura1" style="position: absolute;top:-22px;">Altura Inicial</label>
                                                <input type="number" id="txtAltura1" placeholder="Altura Inicial" title="Altura Inicial" class="form-control rounded" value="">
                                            </div>
                                            <div class="col-md-5">
                                                <label for="txtAltura2" style="position: absolute;top:-22px;">Altura Final</label>
                                                <input type="number" id="txtAltura2" placeholder="Altura Final" title="Altura Final" class="form-control rounded" value="" 
                                                   disabled>
                                            </div>                                        
                                        </div>
                                        <label class="error" id="errorAltura" hidden>Rango Inicial debe ser menor al Rango Final</label>
                                        <label class="error" id="errorAltura2" hidden>Ingrese el valor del Rango Final</label>
                                        <div class="input-group mt-4">
                                            <label for="txtDireccion" style="position: absolute;top:-22px;">Dirección</label>
                                            <input type="text" id="txtDireccion" name="direccion" placeholder="Dirección" title="Dirección" class="form-control rounded" value="" >
                                        </div>
                                        <div class="input-group mt-4">
                                            <label for="txtCursos" style="position: absolute;top:-22px;">Cursos</label>
                                            <input type="text" id="txtCursos" name="cursos" placeholder="Cursos" title="Cursos" class="form-control rounded" value="" >
                                        </div>
                                        <div class="input-group mt-4">
                                            <label for="txtSobreMi" style="position: absolute;top:-22px;">Sobre él o ella</label>
                                            <input type="text" id="txtSobreMi" name="sobreMi" placeholder="Sobre él o ella" title="Sobre mí" class="form-control rounded" value="" >
                                        </div>                                                                               
                                        <div class="input-group mt-4  ">
                                            <!--<label for="txtGradoAcademico" style="position: absolute;top:-22px;">Grado Académico</label>
                                            <input type="text" id="txtGradoAcademico" name="gradoAcademico" placeholder="Grado Académico" title="Grado Académico" 
                                            class="form-control rounded" value="">-->
                                            <div class="col-md-4">
                                                <label style="position: absolute;top:-22px;">Grado Academico</label>
                                                <select class="btn" style="border-color:black" required="" id="slGradoAcademico">
                                                    <option value="0" hidden="">Grado Académico</option>
                                                    <option value="Primaria Incompleta">Primaria Incompleta</option>
                                                    <option value="Primaria Completa">Primaria Completa</option>
                                                    <option value="Secundaria Incompleta">Secundaria Incompleta</option>
                                                    <option value="Secundaria Completa">Secundaria Completa</option>
                                                    <option value="Diplomado Universitario">Diplomado Universitario</option>
                                                    <option value="Bachiller Universitario">Bachiller Universitario</option>
                                                    <option value="Licenciatura">Licenciatura</option>
                                                    <option value="Maestria sin Licenciatura">Maestría sin Licenciatura</option>
                                                    <option value="Maestria con Licenciatura">Maestría con Licenciatura</option>
                                                    <option value="Doctorado">Doctorado</option>
                                                </select>
                                            </div>                                        
                                        </div><br>
                                        <div class="input-group mt-4 ">
                                            <div class="col-md-4">
                                                <label style="position: absolute;top:-22px;">Tipo de Cabello</label>
                                                <select class="btn" style="border-color:black" required="" id="slTipoCabello">
                                                    <option value="0" hidden="">Tipo de Cabello</option>
                                                    <option value="Corto Liso">Corto Liso</option>
                                                    <option value="Corto Colocho">Corto Colocho</option>
                                                    <option value="Largo Liso">Largo Liso</option>
                                                    <option value="Largo Colocho">Largo Colocho</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label style="position: absolute;top:-22px;">Idioma</label>
                                                <select class="btn" style="border-color:black" id="slIdioma" required="">
                                                    <option value="0" hidden="">Idioma</option>
                                                    @foreach($idiomas as $i)
                                                    <option value="{{$i->descripcion}}">{{$i->descripcion}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label style="position: absolute;top:-22px;">Uniforme</label>
                                                <select class="btn" style="border-color:black" required="" id="slUniforme">
                                                    <option value="0" hidden="">Uniforme</option>
                                                    <option value="salga">Salga</option>
                                                    <option value="si">Si</option>
                                                    <option value="formal">Formal</option>
                                                    <option value="ejecutivo">Ejecutivo</option>
                                                    <option value="vestido">Vestido</option>
                                                    <option value="gala">Gala</option>
                                                    <option value="host">Host</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="input-group mt-4">
                                            <h4>Características con las que debe contar</h4><br>
                                            <div class="col-md-12">
                                                <table class="table">
                                                    </tbody>
                                                        <tr><td>Frenillos <label class="tooltip-test popup" title="¿Tienes frenillos? sí o no">?</label></td><td><input type="checkbox" class="mt-2 ml-1" id="chkFrenillos"></td></tr>
                                                        <tr><td>Tattos Visibles <label class="tooltip-test popup" title="¿Tienes tattos visibles o no?">?</label></td><td><input type="checkbox" class="mt-2 ml-1" id="chkTattos"></td></tr>
                                                        <tr><td>Pasaporte al día <label class="tooltip-test popup" title="¿Tienes pasaporte al día? sí o no">?</label></td><td><input type="checkbox" class="mt-2 ml-1" id="chkPasaporte"></td></tr>
                                                        <tr><td>Licencia al día <label class="tooltip-test popup" title="¿Tienes licencia al día? sí o no">?</label></td><td><input type="checkbox" class="mt-2 ml-1" id="chkLicencia"></td></tr>
                                                    </tbody>
                                                </table><br>
                                            </div> 
                                        </div>
                                        <div class="input-group mt-4">
                                            <h4>Deportes que practica</h4><br>
                                            <div class="col-md-12">
                                                <table class="table">
                                                    </tbody>
                                                        <tr><td></td><td><input type="checkbox" class="mt-2 ml-1" data-width="120" data-height="37" onChange="checkTodosDeportes(this)"/><label>&nbsp;Marcar todo</label></td><tr>
                                                    @foreach($deportes as $d)
                                                        <tr>
                                                            <td>{{$d->descripcion}}</td>
                                                            <td><input type="checkbox" id="{{$d->descripcion}}" class="mt-2 ml-1 chkDep"
                                                                data-width="120" data-height="37" data-on="Express" data-off="No Express"></td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table><br>
                                            </div> 
                                        </div>
                                    </div>
                            @elseif($categoria!=null && ($categoria->id==4 || $categoria->id==7))<!--6=Influencers 7=Presentadores-->
                                    <div class="input-group mt-4">
                                        <h4>Equipo con el que debe contar</h4><br>
                                        <div class="col-md-12">
                                            <table class="table">
                                                </tbody>
                                                    <tr><td></td><td><input type="checkbox" class="mt-2 ml-1" data-width="120" data-height="37" onChange="checkTodosEquipos(this)"/><label>&nbsp;Marcar todo</label></td><tr>
                                                @foreach($equipos as $e)
                                                    <tr>
                                                        <td>{{$e->descripcion}}</td>
                                                        <td><input type="checkbox" id="{{$e->descripcion}}" class="mt-2 ml-1 chkEqu"
                                                            data-width="120" data-height="37" data-on="Express" data-off="No Express"></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table><br>
                                        </div> 
                                    </div>
                                </div>                            
                            @elseif($categoria!=null && $categoria->id==5)<!--Músicos-->
                                    <div class="input-group mt-4">
                                        <h4>Géneros Musicales que debe manejar</h4><br>
                                        <div class="col-md-12">
                                            <table class="table">
                                                </tbody>
                                                <tr><td></td><td><input type="checkbox" class="mt-2 ml-1" data-width="120" data-height="37" onChange="checkTodaMusicas(this)"/><label>&nbsp;Marcar todo</label></td><tr>
                                                @foreach($musica as $m)
                                                    <tr>
                                                        <td>{{$m->descripcion}}</td>
                                                        <td><input type="checkbox" id="{{$m->descripcion}}" class="mt-2 ml-1 chkMus"
                                                            data-width="120" data-height="37" data-on="Express" data-off="No Express"></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table><br>
                                        </div> 
                                    </div>
                                    <div class="input-group mt-4">
                                        <hr> <!--<h4>Características con las que debe contar</h4>--><br>
                                        <div class="col-md-12">
                                            <table class="table">
                                                </tbody>
                                                    <tr><td>Compositor</td><td><input type="checkbox" class="mt-2 ml-1" id="chkCompositor"></td></tr>                                                    
                                                </tbody>
                                            </table><br>
                                        </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <label style="position: absolute;top:-22px;">Fuerte</label>
                                        <select class="btn" style="border-color:black" id="slIdioma2" required="">
                                            <option value="0" hidden="">Idioma</option>
                                            @foreach($idiomas as $i)
                                            <option value="{{$i->descripcion}}">{{$i->descripcion}}</option>
                                            @endforeach
                                            <option value="ambos">AMBOS</option>
                                        </select><br>
                                    </div><br>
                                     <div class="input-group mt-4">
                                        <label style="position: absolute;top:-22px;">Instrumento Principal</label>
                                        <input type="text" id="txtInstPrincipal" name="Instrumento Principal" placeholder="Instrumento Principal" title="Instrumento Principal" class="form-control rounded" value="" >
                                    </div>
                                    <div class="input-group mt-4">
                                        <label style="position: absolute;top:-22px;">Instrumento Secundario</label>
                                        <input type="text" id="txtInstSecundario" name="Instrumento Secundario" placeholder="Instrumento Secundario" title="Instrumento Secundario" class="form-control rounded" value="" >
                                    </div>
                                    <div class="input-group mt-4">
                                        <label style="position: absolute;top:-22px;">Demos (Enlace de videos o del canal de la plataforma)</label>
                                        <input type="text" id="txtDemosMusicos" placeholder="Demos (Enlace de videos o del canal de la plataforma)" title="Demos (Enlace de videos o del canal de la plataforma)" class="form-control rounded" value="" >
                                    </div>                                
                                    <br>
                                </div>                            
                            @elseif($categoria!=null && $categoria->id==6)<!--Dj's-->
                                    <div class="input-group mt-4">
                                        <h4>Equipo con el que debe contar</h4><br>
                                        <div class="col-md-12">
                                            <table class="table">
                                                </tbody>
                                                    <tr><td>Equipo Propio <label class="tooltip-test popup" title="Equipo Propio...">?</label></td><td><input type="checkbox" class="mt-2 ml-1" id="chkEquipoPropio"></td></tr>
                                                    <tr><td>Luces </td><td><input type="checkbox" class="mt-2 ml-1" id="chkLuces"></td></tr>
                                                    <tr><td>Equipo de Sonido </td><td><input type="checkbox" class="mt-2 ml-1" id="chkEquipoSonido"></td></tr>
                                                </tbody>
                                            </table><br>
                                        </div>
                                    </div>

                                    <div class="input-group mt-4">
                                        <h4>Géneros Musicales que debe manejar</h4><br>
                                        <div class="col-md-12">
                                            <table class="table">
                                                </tbody>
                                                    <tr><td></td><td><input type="checkbox" class="mt-2 ml-1" data-width="120" data-height="37" onChange="checkGenerosMusicas(this)"/><label>&nbsp;Marcar todo</label></td><tr>
                                                @foreach($generosMusicales as $g)
                                                    <tr>
                                                        <td>{{$g->descripcion}}</td>
                                                        <td><input type="checkbox" id="{{$g->descripcion}}" name='checkdeportes' class="mt-2 ml-1 chkGMus"
                                                            data-width="120" data-height="37" data-on="Express" data-off="No Express"></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table><br>
                                        </div> 
                                    </div>
                                    <div class="input-group mt-4">
                                        <label style="position: absolute;top:-22px;">Demos (Enlace de videos o del canal de la plataforma)</label>
                                        <input type="text" id="txtDemosDj" placeholder="Demos (Enlace de videos o del canal de la plataforma)" title="Demos (Enlace de videos o del canal de la plataforma)" class="form-control rounded" value="" >
                                    </div>
                                </div>
                            @elseif($categoria!=null && ($categoria->id==8 || $categoria->id==9 || $categoria->id==10 || $categoria->id==11 || $categoria->id==12) )
                                <!--8=Productores Audiovisuales
                                    9=Transporte
                                    10=Montaje
                                    11=Promotores
                                    12=Fotógrafos-->                               
                                </div>
                            @elseif($categoria!=null && ($categoria->id>12) )
                            </div>
                            @endif
                                <div class="input-group mt-4">                                  
                                    <div class="col-md-4">
                                        <input type="button" value="Cotizar" name="btn_cotizar" class="btn btn-success" id="btn_cotizar">
                                    </div>
                                </div>                                
                            </div>                            
                            <!--PANTALLA DE COTIZACION--->
                            <div id="contenedorCotizacion" hidden>
                                <button type="button" value="Atrás" name="btn_cancelarCotizacion" class="btn btn-secondary" id="btn_cancelarCotizacion">Atrás</button>
                                <div class="cCotizacion">
                                    <hr><h4>Candidatos</h4>
                                    <div id="contenedor-data" class='table-responsive'>
                                        <div id="contenedorCandidatos">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Pantalla de perfil-->
                            <div>
                                <br>
                                <button type="button" value="Atrás" name="btn_atrasPerfil" class="btn btn-secondary" id="btn_atrasPerfil" hidden>Atrás</button>
                                <br><hr>
                                <div id="contenedorPerfil" hidden>
                                    <div class="cCotizacion">
                                        <div id="contenedor-data" class='table-responsive'>
                                            <div id="perfil">
                                            </div>                                
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!--Pantalla de Pago de Comisión-->
                            <div>
                                <button type="button" value="Atrás" name="btn_atrasPago" class="btn btn-secondary" id="btn_atrasPago" hidden>Atrás</button>
                                <br><hr>
                                <div id="contenedorPago" hidden>
                                    <div class="cCotizacion">
                                        <div id="contenedor-data" class='table-responsive'>
                                            <div id="pago">
                                            <?php /******************---------------- ENCABEZADOS ----------------******************/
                                              header('Access-Control-Allow-Origin: *'); //CORS
                                                header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); //Compartir los metodos
                                            ?>
                                            <!DOCTYPE html>
                                            <?php
                                                if(isset($POST["afiliado"])){
                                                    $codAfiliado = $POST["afiliado"];
                                                }
                                                else{
                                                    $codAfiliado = "0";
                                                }

                                                if(isset($_GET["idorden"])){
                                                   $codOrden = $_GET["idorden"];
                                                }
                                                else{
                                                    $codOrden = "0";
                                                }

                                                if(isset($empId))
                                                   $codigoUsuario = $empId;
                                                else
                                                   $codigoUsuario = "0";

                                                if(isset($_POST["pago"])){
                                                    $valorPago = $_POST["pago"];  
                                                }
                                                else{
                                                   $valorPago = "30";
                                                }

                                                if(isset($categoria)){
                                                    $catId = $categoria->id;  
                                                }
                                                else{
                                                    $catId = "30";
                                                }                                                
                                             ?>
                                            <html lang="es">
                                                <head>
                                                    <meta charset="UTF-8">
                                                    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
                                                    <meta name="format-detection" content="telephone=no">
                                                    <meta name="msapplication-tap-highlight" content="no">
                                                    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
                                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/css-loader/3.3.3/css-loader.css">
                                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css">
                                                    <link rel="stylesheet" type="text/css" href="{{ url('/css/alertify.min.css') }}" />
                                                    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
                                                    <script type="text/javascript" src="https://www.paypal.com/sdk/js?client-id=Af1vsaJCVx5qQltD1ISS-3mrdcF2YesGCMl-HIeUhOjxn5_CwRs3v2QBgfktnMWZ7tw-QVSj_BAOolWG&disable-funding=credit,card"></script>
                                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"></script>
                                                    <script src="{{ url('/js/alertify.min.js') }}"></script>
                                                    <script src="{{ url('/js/axios.min.js') }}"></script>
                                                    <style>
                                                        input[type=text] {
                                                                width: 100%;
                                                                padding: 12px 20px;
                                                                margin: 8px 0;
                                                                box-sizing: border-box;
                                                                border: 1px solid grey;
                                                                border-radius: 5px;
                                                        }
                                                    </style>
                                                    <title>Paypal Pago</title>
                                                </head>
                                                <body style="background-color: black !important;">  
                                                    <div class="loader loader-default" data-text="Finalizando Compra" id="divLoader"></div>
                                                        <div>
                                                            <label for="telefono" style="color: white;">Número de teléfono:</label>
                                                            <input type="text" id="telefono" name="telefono"><br><br>
                                                            <label for="adicional" style="color: white;">Datos adicionales:</label>
                                                            <input type="text" id="adicional" name="adicional"><br><br>
                                                        </div>
                                                        <div id="paypal-button-container"></div>
                                                        <script type="text/javascript">
                                                            var afiliadoX = '<?php echo $codAfiliado; ?>';
                                                            var ordenX = '<?php echo $codOrden; ?>';
                                                            var pagoX = '<?php echo $valorPago; ?>';
                                                            var codigoUsuarioX = '<?php echo $codigoUsuario; ?>';
                                                            var idCategoriaX = '<?php echo $catId; ?>';
                                                            console.log('idCategoria '+idCategoriaX);

                                                            console.log('afiliadoX '+afiliadoX);
                                                            console.log('ordenX '+ordenX);
                                                            console.log('pagoX '+pagoX);
                                                            console.log('codigoUsuarioX '+codigoUsuarioX);
//
            function espera(){
                setTimeout(function(){
                    contactar2();
                },2000);
            }
            paypal.Buttons({
                style: {
                    size: 'responsive'
                },
                funding: {
                    disallowed: [paypal.FUNDING.CARD],
                    disallowed: [ paypal.FUNDING.CREDIT ]
                },
                createOrder: function (data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: pagoX,
                                currency: 'USD'
                            }
                        }]
                    });
                },
                onApprove: function (data, actions) {
                    $("#divLoader").addClass("is-active");  
                    return actions.order.capture().then(function (details) {
                        var form = new FormData();
                        form.append('afiliado',afiliadoX);
                        form.append('cliente','App Edecanes');
                        form.append('idOrden',ordenX);
                        form.append('paypalId',details.id);
                        form.append('creacion',details.create_time);
                        form.append('edicion',details.update_time);
                        form.append('intent',details.intent);
                        form.append('estado',details.status);
                        form.append('idComprador',details.payer.payer_id);
                        form.append('emailComprador',details.payer.email_address);
                        form.append('paisComprador',details.payer.country_code);
                        form.append('nombreComprador',details.payer.name.given_name + ' ' + details.payer.name.surname);
                        form.append('undId',details.purchase_units[0].reference_id);
                        form.append('undValor',details.purchase_units[0].amount.value);
                        form.append('undMoneda',details.purchase_units[0].amount.currency_code);
                        form.append('undEmail',details.purchase_units[0].payee.email_address);
                        form.append('undMerchant',details.purchase_units[0].payee.merchant_id);
                        form.append('dirComprador',details.purchase_units[0].shipping.name.full_name);
                        form.append('dirDireccion',details.purchase_units[0].shipping.address.address_line_1);
                        form.append('dirPostal',details.purchase_units[0].shipping.address.postal_code);
                        form.append('dirPais',details.purchase_units[0].shipping.address.country_code);
                        form.append('pagoEstado',details.purchase_units[0].payments.captures[0].status);
                        form.append('pagoId',details.purchase_units[0].payments.captures[0].id);
                        form.append('pagoCapture',details.purchase_units[0].payments.captures[0].final_capture);
                        form.append('pagoCreacion',details.purchase_units[0].payments.captures[0].create_time);
                        form.append('pagoEdicion',details.purchase_units[0].payments.captures[0].update_time);
                        form.append('pagoValor',details.purchase_units[0].payments.captures[0].amount.value);
                        form.append('pagoMoneda',details.purchase_units[0].payments.captures[0].amount.currency_code);
                        form.append('tipo',1);
                        form.append('codigoUsuario',codigoUsuarioX);
                        form.append('categoria',idCategoriaX);

                        axios.post('paypal2', form)
                        .then(function (response) {
                            $("#divLoader").removeClass("is-active");                            
                            console.log(response.data);
                            if(response.data=='Error al registrar el pago. Por favor intente mas tarde.'){
                                new Noty({
                                  theme: 'metroui',
                                  layout: 'topLeft',
                                  type: 'warning',
                                  text: "Se procesó la transacción, pero el pedido no se registró. Notifique al comercio."
                                }).show();
                            }else {
                            new Noty({
                                  theme: 'metroui',
                                  type: 'success',
                                  layout: 'topCenter',
                                  text: "Su pago se realizó correctamente, puede pulsar el botón de regresar. Se está notificando vía correo electrónico a los candidatos asociados."
                                }).show();
                                espera();
                            }
                        }).catch(function (error) {
                            $("#divLoader").removeClass("is-active");
                            new Noty({
                                  theme: 'metroui',
                                  layout: 'topLeft',
                                  type: 'warning',
                                  text: "Se procesó la transacción, pero el pedido no se registró. Notifique al comercio."
                                }).show();
                        })
                    });
                }
            }).render('#paypal-button-container');
        </script>
    </body>
</html>
                                            </div>                                
                                        </div>
                                    </div>
                                </div>
                            </div>


                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')    
<link rel="stylesheet" type="text/css" href="{{ url('/css/alertify.min.css') }}" />
<link rel="stylesheet" href="{{url('/css/edcr.css')}}">
<link rel="stylesheet" href="{{url('/css/cotizacion.css')}}">
@stop

@section('js')
<script src="{{ url('/js/alertify.min.js') }}"></script>
<script src="{{ url('/js/axios.min.js') }}"></script>
<script src="{{url('/js/edcr.js')}}"></script>
  <!-- jQuery -->
<script src="{{url('/js/categoriaInfo.js')}}"></script>
 @stop