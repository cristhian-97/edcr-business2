@extends('adminlte::page')

@section('content')
<style>
    .content-wrapper {
        background: linear-gradient(rgb(0, 0, 0) 10%, rgb(54, 70, 78));
    }
    .navbar-white {
        background: rgb(54, 70, 78);
        color: #ffffff;
    }
    .main-sidebar {
        background: #000000;/*#455A64;*/
    }
</style>
<div style="display: inline-box; align-items:center" class="titulo"><br>
    <div class="row">
        <div class="col-4">
            <button type="button" value="Cancelar" name="btn_cancelar" id="btn_cancelar">Cancelar</button>
        </div>
        <div class="col-5">
            @if($categoria!=null)
                <h2 style="width: 70%;text-align:center; color:white;">Categoría {{$categoria->nombre}}</h2>
            @else
                <h1 style="width: 70%;text-align:center; color:white;">Categoría</h1>
            @endif
        </div>
    </div>
</div><br>
<div class="container-fluid">
    <div class="row" id="fondoCotizaciones2">
        <div class="col">
            <div class="sticky-top mb-3">
                <div class="input-group">
                    <div class="card-body">
                        <div class=" mt-2 row">
                            <div class="col-md-12" id="fondoCotizaciones">
                            <!--$categoria->id==1=Edecanes
                                $categoria->id==2=Modelos de Fotografías
                                $categoria->id==3=Modelos de Fitness-->
                                <div id="contenedorCategoria">
                                    <input type="text" id="idEmpresa" hidden value="{{$empId}}">    
                                    <input type="text" id="idCategoria" hidden value="{{$categoria->id}}">
                                    <input type="text" id="nombreCategoria" hidden value="{{$categoria->nombre}}">
                                    <input type="number" id="precioCategoria" hidden value="{{$categoria->preciohora}}">
                                    <input type="text" id="comision" hidden value="{{$comision}}">
                                    <input type="text" id="correoedcr" hidden value="{{$correoedcr}}">
                                    <div class="input-group mt-4">
                                        <div class="col-md-6">
                                            <label style="position: absolute;top:-22px;" class="etiquetasRegistro">Lugar</label>
                                            <input type="text" id="txtLugar" name="lugar" placeholder="Lugar" title="Lugar" class="cajatextoedt" value="El Silencio">
                                            <label class="error" id="errorLugar" hidden>Ingrese el lugar</label>
                                        </div>                                    
                                        <div class="col-md-6">
                                            <label style="position: absolute;top:-22px;" class="etiquetasRegistro">Función</label>
                                            <input type="text" id="txtFuncion" name="funcion" placeholder="Funcion" title="Funcion" class="cajatextoedt" value="Servicio al cliente" >
                                            <label class="error" id="errorFuncion" hidden>Ingrese la función</label>
                                        </div>
                                    </div>
                                    <div class="input-group mt-4">
                                        <div class="col-md-6">
                                            <label style="position: absolute;top:-22px;" class="etiquetasRegistro">Cantidad de candidatos por cotización</label>
                                            <input type="number" min="1" id="txtCantidad" name="Cantidad" placeholder="Cantidad de candidatos por cotización" title="Cantidad de candidatos por cotización" class="cajatextoedt" value="1" >
                                            <label class="error" id="errorCantidad" hidden>Ingrese la cantidad de candidatos por cotización</label>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="txtHoras" style="position: absolute;top:-22px;" class="etiquetasRegistro">Cantidad de Horas</label>
                                            <input type="number" min="1" id="txtHoras" name="horas" placeholder="Cantidad de Horas" title="Cantidad de Horas" class="cajatextoedt" value="1">
                                            <label class="error" id="errorHoras" hidden>Ingrese la cantidad de horas</label>
                                        </div>  
                                    </div>
                                    <div class="input-group mt-4">
                                        <div class="col-md-3">                                        
                                            <label style="position: absolute;top:-22px;" class="etiquetasRegistro">Fecha del evento</label>
                                            <?php date_default_timezone_set('America/Costa_Rica'); ?>
                                            <input type="date" id="dtFechaEvento" min="<?php echo date('Y-m-d', time()-1) ?>" name="Fecha del Evento" title="Fecha de Evento" class="cajat" value="" >
                                            <label class="error" id="errorTiempoEvento" hidden>Ingrese la fecha del Evento</label>
                                        </div>
                                    
                                        <div class="col-md-3">
                                            <label for="tmHoraEvento" style="position: absolute;top:-22px;" class="etiquetasRegistro">Hora del Evento</label>
                                            <input type="time" id="tmHoraEvento" name="horaEvento" placeholder="Hora del Evento" title="Hora del Evento" class="cajat" value="">                                            
                                            <label class="error" id="errorTiempoEvento2" hidden>Ingrese la hora del Evento</label>
                                            <label class="error" id="errorHoraEvento" hidden>La hora del evento no puede se menor a la hora actual</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label style="position: absolute;top:-22px;" class="etiquetasRegistro">Tipo de Facturación</label><br>
                                            <select class="selc" style="border-color:black" id="slTipoFacturacion" required="">
                                                <option value="0" hidden="">Tipo de Facturación</option>
                                                <option value="edcr" class="selcValue">Contratar con EDCR</option>
                                                <option value="candidatos" class="selcValue">Contratar con Candidatos</option>
                                            </select><br>
                                            <label class="error" id="errorTipoFacturacion" hidden>Seleccione el tipo de Facturación</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label style="position: absolute;top:-22px;" class="etiquetasRegistro">Tipo de Moneda</label><br>
                                            <select class="selc" style="border-color:black" id="slTipoMoneda" required="">
                                                <option value="0" hidden="">Tipo de Moneda</option>
                                                <option value="dolar" class="selcValue">Dólares</option>
                                                <option value="colon" class="selcValue">Colones</option>
                                            </select><br>
                                            <label class="error" id="errorMoneda" hidden>Seleccione el tipo de Moneda</label>
                                        </div>
                                    </div>
                                    <br>
                                    
                                    <h4 class="tituloBlanco">Áreas de trabajo</h4>
                                    <div id="contenedor-data" class='table-responsive'>
                                        <table class="table">
                                            <tbody>
                                            @if(count($areasTrabajo)>0)
                                                <tr><td></td><td><input type="checkbox" class="mt-2 ml-1" data-width="120" data-height="37" onChange="checkAreas(this)"/><label class="etiquetasRegistro">&nbsp;Marcar todo</label></td><tr>
                                            @endif
                                            @foreach($areasTrabajo as $a)
                                                <tr>
                                                    <td class="etiquetasRegistro">{{$a->nombre}}</td>
                                                    <td><input type="checkbox" id="{{$a->id}}" class="mt-2 ml-1 chkAT" data-width="120" data-height="37"/></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table><br>
                                        @if($categoria!=null && ($categoria->id==1 || $categoria->id==2 || $categoria->id==3 ))<!--Edecanes-->
                                        <div class="input-group mt-4  ">
                                            <label style="position: absolute;top:-22px;" class="etiquetasRegistro">Color de Ojos</label>
                                            <input type="text" id="txtColorOjos" name="colorOjos" placeholder="Color de Ojos" title="Color de Ojos" class="cajatextoedt" value="" >
                                        </div>
                                        <div class="input-group mt-4">
                                            <label for="txtMedidas" style="position: absolute;top:-22px;" class="etiquetasRegistro">Medidas</label>
                                            <input type="number" min="1" id="txtMedidas" name="medidas" placeholder="Medidas" title="Medidas" class="cajatextoedt" value="" >
                                        </div>
                                        <div class="input-group mt-4">
                                            <div class="col-md-2">                                            
                                                <input type="checkbox" id="chkCalzado" class="mt-2 ml-1" data-width="120" data-height="37" 
                                                   onChange="checkCalzado(this)"/>
                                                <label class="etiquetasRegistro">Rango</label>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="txtCalzado1" style="position: absolute;top:-22px;" class="etiquetasRegistro">Calzado Inicial</label>
                                                <input type="number" id="txtCalzado1" placeholder="Calzado Inicial" title="Calzado Inicial" class="cajatextoedt" value="">
                                            </div>
                                            <div class="col-md-5">
                                                <label for="txtCalzado2" style="position: absolute;top:-22px;" class="etiquetasRegistro">Calzado Final</label>
                                                <input type="number" min="1" id="txtCalzado2" placeholder="Calzado Final" title="Calzado Final" class="cajatextoedt"
                                                 value="" disabled>
                                            </div>                                        
                                        </div>
                                        <label class="error" id="errorCalzado" hidden>Rango Inicial debe ser menor al Rango Final</label>
                                        <label class="error" id="errorCalzado2" hidden>Ingrese el valor del Rango Final</label>

                                        <div class="input-group mt-4">
                                            <div class="col-md-2">                                            
                                                <input type="checkbox" id="chkPeso" class="mt-2 ml-1" data-width="120" data-height="37" 
                                                    onChange="checkPeso(this)"/>
                                                <label class="etiquetasRegistro">Rango</label>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="txtPeso1" style="position: absolute;top:-22px;" class="etiquetasRegistro">Peso Inicial</label>
                                                <input type="number" min="1" id="txtPeso1" placeholder="Peso Inicial" title="Peso Inicial" class="cajatextoedt" value="" >
                                            </div>
                                            <div class="col-md-5">
                                                <label for="txtPeso2" style="position: absolute;top:-22px;" class="etiquetasRegistro">Peso Final</label>
                                                <input type="number" min="1" id="txtPeso2" placeholder="Peso Final" title="Peso Final" class="cajatextoedt" value="" 
                                                    disabled>
                                            </div>
                                        </div>
                                        <label class="error" id="errorPeso" hidden>Rango Inicial debe ser menor al Rango Final</label>
                                        <label class="error" id="errorPeso2" hidden>Ingrese el valor del Rango Final</label>

                                        <div class="input-group mt-4">
                                            <div class="col-md-2">                                            
                                                <input type="checkbox" id="chkAltura" class="mt-2 ml-1" data-width="120" data-height="37" 
                                                    onChange="checkAltura(this)"/>
                                                <label class="etiquetasRegistro">Rango</label>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="txtAltura1" style="position: absolute;top:-22px;" class="etiquetasRegistro">Altura Inicial</label>
                                                <input type="number" id="txtAltura1" placeholder="Altura Inicial" title="Altura Inicial" class="cajatextoedt" value="">
                                            </div>
                                            <div class="col-md-5">
                                                <label for="txtAltura2" style="position: absolute;top:-22px;" class="etiquetasRegistro">Altura Final</label>
                                                <input type="number" id="txtAltura2" placeholder="Altura Final" title="Altura Final" class="cajatextoedt" value="" 
                                                   disabled>
                                            </div>                                        
                                        </div>
                                        <label class="error" id="errorAltura" hidden>Rango Inicial debe ser menor al Rango Final</label>
                                        <label class="error" id="errorAltura2" hidden>Ingrese el valor del Rango Final</label>
                                        <div class="input-group mt-4">
                                            <label for="txtDireccion" style="position: absolute;top:-22px;" class="etiquetasRegistro">Dirección</label>
                                            <input type="text" id="txtDireccion" name="direccion" placeholder="Dirección" title="Dirección" class="cajatextoedt" value="" >
                                        </div>
                                        <div class="input-group mt-4">
                                            <label for="txtCursos" style="position: absolute;top:-22px;" class="etiquetasRegistro">Cursos</label>
                                            <input type="text" id="txtCursos" name="cursos" placeholder="Cursos" title="Cursos" class="cajatextoedt" value="" >
                                        </div>
                                        <div class="input-group mt-4">
                                            <label for="txtSobreMi" style="position: absolute;top:-22px;" class="etiquetasRegistro">Sobre él o ella</label>
                                            <input type="text" id="txtSobreMi" name="sobreMi" placeholder="Sobre él o ella" title="Sobre mí" class="cajatextoedt" value="" >
                                        </div>                                                                               
                                        <div class="input-group mt-4  ">
                                            <!--<label for="txtGradoAcademico" style="position: absolute;top:-22px;">Grado Académico</label>
                                            <input type="text" id="txtGradoAcademico" name="gradoAcademico" placeholder="Grado Académico" title="Grado Académico" 
                                            class="form-control rounded" value="">-->
                                            <div class="col-md-4">
                                                <label style="position: absolute;top:-22px;" class="etiquetasRegistro">Grado Academico</label>
                                                <select class="selc" style="border-color:black" required="" id="slGradoAcademico">
                                                    <option value="0" hidden="" class="selcValue">Grado Académico</option>
                                                    <option value="Primaria Incompleta" class="selcValue">Primaria Incompleta</option>
                                                    <option value="Primaria Completa" class="selcValue">Primaria Completa</option>
                                                    <option value="Secundaria Incompleta" class="selcValue">Secundaria Incompleta</option>
                                                    <option value="Secundaria Completa" class="selcValue">Secundaria Completa</option>
                                                    <option value="Diplomado Universitario" class="selcValue">Diplomado Universitario</option>
                                                    <option value="Bachiller Universitario" class="selcValue">Bachiller Universitario</option>
                                                    <option value="Licenciatura" class="selcValue">Licenciatura</option>
                                                    <option value="Maestria sin Licenciatura" class="selcValue">Maestría sin Licenciatura</option>
                                                    <option value="Maestria con Licenciatura" class="selcValue">Maestría con Licenciatura</option>
                                                    <option value="Doctorado" class="selcValue">Doctorado</option>
                                                </select>
                                            </div>                                        
                                        </div><br>
                                        <div class="input-group mt-4 ">
                                            <div class="col-md-4">
                                                <label style="position: absolute;top:-22px;">Tipo de Cabello</label>
                                                <select class="selc" style="border-color:black" required="" id="slTipoCabello">
                                                    <option value="0" hidden="">Tipo de Cabello</option>
                                                    <option value="Corto Liso" class="selcValue">Corto Liso</option>
                                                    <option value="Corto Colocho" class="selcValue">Corto Colocho</option>
                                                    <option value="Largo Liso" class="selcValue">Largo Liso</option>
                                                    <option value="Largo Colocho" class="selcValue">Largo Colocho</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label style="position: absolute;top:-22px;" class="etiquetasRegistro">Idioma</label>
                                                <select class="selc" style="border-color:black" id="slIdioma" required="">
                                                    <option value="0" hidden="" class="selcValue">Idioma</option>
                                                    @foreach($idiomas as $i)
                                                    <option value="{{$i->descripcion}}" class="selcValue">{{$i->descripcion}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label style="position: absolute;top:-22px;" class="etiquetasRegistro">Uniforme</label>
                                                <select class="selc" style="border-color:black" required="" id="slUniforme">
                                                    <option value="0" hidden="" class="selcValue">Uniforme</option>
                                                    <option value="salga" class="selcValue">Salga</option>
                                                    <option value="si" class="selcValue">Si</option>
                                                    <option value="formal" class="selcValue">Formal</option>
                                                    <option value="ejecutivo" class="selcValue">Ejecutivo</option>
                                                    <option value="vestido" class="selcValue">Vestido</option>
                                                    <option value="gala" class="selcValue">Gala</option>
                                                    <option value="host" class="selcValue">Host</option>
                                                    <option value="no" class="selcValue">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="input-group mt-4">
                                            <h4 class="tituloBlanco">Características con las que debe contar</h4><br>
                                            <div class="col-md-12">
                                                <table class="table">
                                                    <tbody>
                                                        <tr><td class="etiquetasRegistro">Frenillos <label class="tooltip-test popup" title="¿Tiene frenillos? sí o no">?</label></td><td><input type="checkbox" class="mt-2 ml-1" id="chkFrenillos"></td></tr>
                                                        <tr><td class="etiquetasRegistro">Tattos Visibles <label class="tooltip-test popup" title="¿Tiene tattos visibles o no?">?</label></td><td><input type="checkbox" class="mt-2 ml-1" id="chkTattos"></td></tr>
                                                        <tr><td class="etiquetasRegistro">Pasaporte al día <label class="tooltip-test popup" title="¿Tiene pasaporte al día? sí o no">?</label></td><td><input type="checkbox" class="mt-2 ml-1" id="chkPasaporte"></td></tr>
                                                        <tr><td class="etiquetasRegistro">Licencia al día <label class="tooltip-test popup" title="¿Tiene licencia al día? sí o no">?</label></td><td><input type="checkbox" class="mt-2 ml-1" id="chkLicencia"></td></tr>
                                                    </tbody>
                                                </table><br>
                                            </div> 
                                        </div>
                                        <div class="input-group mt-4">
                                            <h4 class="tituloBlanco">Deportes que practica</h4><br>
                                            <div class="col-md-12">
                                                <table class="table">
                                                    <tbody>
                                                        <tr><td></td><td><input type="checkbox" class="mt-2 ml-1" data-width="120" data-height="37" onChange="checkTodosDeportes(this)"/><label class="etiquetasRegistro">&nbsp;Marcar todo</label></td><tr>
                                                    @foreach($deportes as $d)
                                                        <tr>
                                                            <td class="etiquetasRegistro">{{$d->descripcion}}</td>
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
                                        <h4 class="tituloBlanco">Equipo con el que debe contar</h4><br>
                                        <div class="col-md-12">
                                            <table class="table">
                                                <tbody>
                                                    <tr><td></td><td><input type="checkbox" class="mt-2 ml-1" data-width="120" data-height="37" onChange="checkTodosEquipos(this)"/><label class="etiquetasRegistro">&nbsp;Marcar todo</label></td><tr>
                                                @foreach($equipos as $e)
                                                    <tr>
                                                        <td class="etiquetasRegistro">{{$e->descripcion}}</td>
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
                                        <h4 class="tituloBlanco">Géneros Musicales que debe manejar</h4><br>
                                        <div class="col-md-12">
                                            <table class="table">
                                                <tbody>
                                                <tr><td></td><td><input type="checkbox" class="mt-2 ml-1" data-width="120" data-height="37" onChange="checkTodaMusicas(this)"/><label class="etiquetasRegistro">&nbsp;Marcar todo</label></td><tr>
                                                @foreach($musica as $m)
                                                    <tr>
                                                        <td class="etiquetasRegistro">{{$m->descripcion}}</td>
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
                                                <tbody>
                                                    <tr><td class="etiquetasRegistro">Compositor</td><td><input type="checkbox" class="mt-2 ml-1" id="chkCompositor"></td></tr>                                                    
                                                </tbody>
                                            </table><br>
                                        </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <label style="position: absolute;top:-22px;" class="etiquetasRegistro">Fuerte</label>
                                        <select class="selc" style="border-color:black" id="slIdioma2" required="">
                                            <option value="0" hidden="">Idioma</option>
                                            @foreach($idiomas as $i)
                                            <option value="{{$i->descripcion}}" class="selcValue">{{$i->descripcion}}</option>
                                            @endforeach
                                            <option value="ambos" class="selcValue">AMBOS</option>
                                        </select><br>
                                    </div><br>
                                     <div class="input-group mt-4">
                                        <label style="position: absolute;top:-22px;" class="etiquetasRegistro">Instrumento Principal</label>
                                        <input type="text" id="txtInstPrincipal" name="Instrumento Principal" placeholder="Instrumento Principal" title="Instrumento Principal" class="cajatextoedt" value="" >
                                    </div>
                                    <div class="input-group mt-4">
                                        <label style="position: absolute;top:-22px;" class="etiquetasRegistro">Instrumento Secundario</label>
                                        <input type="text" id="txtInstSecundario" name="Instrumento Secundario" placeholder="Instrumento Secundario" title="Instrumento Secundario" class="cajatextoedt" value="" >
                                    </div>
                                    <div class="input-group mt-4">
                                        <label style="position: absolute;top:-22px;" class="etiquetasRegistro">Demos (Enlace de videos o del canal de la plataforma)</label>
                                        <input type="text" id="txtDemosMusicos" placeholder="Demos (Enlace de videos o del canal de la plataforma)" title="Demos (Enlace de videos o del canal de la plataforma)" class="cajatextoedt" value="" >
                                    </div>                                
                                    <br>
                                </div>                            
                            @elseif($categoria!=null && $categoria->id==6)<!--Dj's-->
                                    <div class="input-group mt-4">
                                        <h4 class="tituloBlanco">Equipo con el que debe contar</h4><br>
                                        <div class="col-md-12">
                                            <table class="table">
                                                </tbody>
                                                    <tr><td class="etiquetasRegistro">Equipo Propio <label class="tooltip-test popup" title="Equipo Propio...">?</label></td><td><input type="checkbox" class="mt-2 ml-1" id="chkEquipoPropio"></td></tr>
                                                    <tr><td class="etiquetasRegistro">Luces </td><td><input type="checkbox" class="mt-2 ml-1" id="chkLuces"></td></tr>
                                                    <tr><td class="etiquetasRegistro">Equipo de Sonido </td><td><input type="checkbox" class="mt-2 ml-1" id="chkEquipoSonido"></td></tr>
                                                </tbody>
                                            </table><br>
                                        </div>
                                    </div>

                                    <div class="input-group mt-4">
                                        <h4 class="tituloBlanco">Géneros Musicales que debe manejar</h4><br>
                                        <div class="col-md-12">
                                            <table class="table">
                                                </tbody>
                                                    <tr><td></td><td><input type="checkbox" class="mt-2 ml-1" data-width="120" data-height="37" onChange="checkGenerosMusicas(this)"/><label class="etiquetasRegistro">&nbsp;Marcar todo</label></td><tr>
                                                @foreach($generosMusicales as $g)
                                                    <tr>
                                                        <td class="etiquetasRegistro">{{$g->descripcion}}</td>
                                                        <td><input type="checkbox" id="{{$g->descripcion}}" name='checkdeportes' class="mt-2 ml-1 chkGMus"
                                                               data-width="120" data-height="37" data-on="Express" data-off="No Express"></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table><br>
                                        </div> 
                                    </div>
                                    <div class="input-group mt-4">
                                        <label style="position: absolute;top:-22px;" class="etiquetasRegistro">Demos (Enlace de videos o del canal de la plataforma)</label>
                                        <input type="text" id="txtDemosDj" placeholder="Demos (Enlace de videos o del canal de la plataforma)" title="Demos (Enlace de videos o del canal de la plataforma)" class="cajatextoedt" value="" >
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
                                        <input type="button" value="Cotizar" name="btn_cotizar" class="btnFormatEdit" id="btn_cotizar">
                                    </div>
                                </div>                                
                            </div>                            
                            <!--PANTALLA DE COTIZACION--->
                            <div id="contenedorCotizacion" hidden>
                                <button type="button" value="Atrás" name="btn_cancelarCotizacion" class="btn btn-secondary" id="btn_cancelarCotizacion">Atrás</button>
                                <div class="cCotizacion2">
                                    <hr><h4 class="tituloBlanco">Candidatos</h4>
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
                                    <div class="cCotizacion tituloBlanco">
                                        <div id="contenedor-data" class='table-responsive'>
                                            <div id="perfil">
                                            </div>                                
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Pantalla de Pago de Comisión-->
                            <!--</div>-->
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