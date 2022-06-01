<html lang="es">
<head>
   <title>Contrato</title>
   <link rel="stylesheet" href="{{url('/css/edcr.css')}}">
   <link rel="stylesheet" href="{{url('/css/cotizacion.css')}}">
   <link rel="stylesheet" type="text/css" href="{{ url('/css/alertify.min.css') }}" />

   <script src="{{ url('/js/alertify.min.js') }}"></script>
   <script src="{{ url('/js/axios.min.js') }}"></script>
   <script src="{{url('/js/aceptarContrato.js')}}"></script>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<input type="text" id="nombreCliente" value="{{$nombreCliente}}" hidden>
                                                        <input type="text" id="nombreEvento" value="{{$cotizacion->funcion}}" hidden>
                                                        <input type="text" id="fecha" value="{{$fecha}}" hidden>
                                                        <input type="text" id="hora" value="{{$hora}}" hidden>
                                                        <input type="text" id="nombreLugar" value="{{$cotizacion->lugar}}" hidden>
                                                        <input type="text" id="nombreCategoria" value="{{$cotizacion->nombrecategoria}}" hidden>

                                                        <input type="text" id="correoEmpresa" value="{{$correoEmpresa}}" hidden>
                                                        <input type="text" id="empresa" value="{{$cotizacion->empresa}}" hidden>
                                                        <input type="text" id="categoria" value="{{$cotizacion->categoria}}" hidden>
                                                        <input type="text" id="cliente" value="{{$cotizacion->cliente}}" hidden>
                                                        <input type="text" id="cotizacion" value="{{$cotizacion->id}}" hidden>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="sticky-top mb-3">
                <div class="input-group">
                    <div class="card-body">
                        <div class=" mt-5 row">
                            <div class="col-md-12">
                            <!--<div id="contenedorCotizacion">
                                <div class="cCotizacion2">
                                    <div id="contenedor-data" class='table-responsive'>
                                        <div id="contenedorCandidatos">
                                            <div style="display: flex;align-items: center;justify-content: center;padding-top: 1%;padding-bottom: 1%;padding-right: 5%;padding-left: 5%;width: 100%;">
                                                <div style="background-color: rgb(255, 255, 255);width: 95%;text-align: center;padding-left: 5%;padding-right: 5%;border-radius: 1px;">
                                                    <div class="row" style="margin-top: 4%;">
                                                        <div class="col-6">
                                                            <div style="width: 25%;padding-top: 5%;display: flexbox;vertical-align: middle;">
                                                                <img style="width: 100%;" src=/img/logo.png>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <label style="font-size: 17px;font-weight: bold;">COTIZACIÓN</label>
                                                        </div>
                                                    </div><br>
                                                    <div class="row" style="text-justify: initial;text-align: justify;word-wrap: break-word;margin-top: 4%;">
                                                        <div class="col-3">
                                                            <label style="font-size: 15px;font-weight: bold;">Facturar a</label>
                                                        </div>
                                                        <div class="col-4">
                                                            <label style="font-size: 15px;font-weight: bold;">Enviar a</label>
                                                        </div>
                                                        <div class="col-3">
                                                            <label style="font-size: 15px;font-weight: bold;">Cotización #</th>
                                                        </div>
                                                        <div class="col-2">
                                                            <td>{{$cotizacion->numero}}</td>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="text-justify: initial;text-align: justify;word-wrap: break-word;margin-top: 4%;">
                                                        <div class="col-3">
                                                            {{$nombres}}
                                                        </div>
                                                        <div class="col-4">
                                                            {{$correos}}
                                                            <br>
                                                        </div>
                                                        <div class="col-3">
                                                            <label style="font-size: 15px;font-weight: bold;">Fecha de la cotización</label>
                                                        </div>
                                                        <div class="col-2">
                                                            <td>{{$cotizacion->fechacotizacion}}</td>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="text-justify: initial;text-align: justify;word-wrap: break-word;margin-top: 4px;margin-top: 4%;">
                                                        <div class="col-3">
                                                            <label>Usuario EDCR: </label>
                                                        </div>
                                                        <div class="col-3">
                                                            {{$cotizacion->usuarioedcr}}
                                                        </div>
                                                    </div><br>
                                                    <div class="row">
                                                        <input type="text" id="nombreCliente" value="{{$nombreCliente}}" hidden>
                                                        <input type="text" id="nombreEvento" value="{{$cotizacion->funcion}}" hidden>
                                                        <input type="text" id="fecha" value="{{$fecha}}" hidden>
                                                        <input type="text" id="hora" value="{{$hora}}" hidden>
                                                        <input type="text" id="nombreLugar" value="{{$cotizacion->lugar}}" hidden>
                                                        <input type="text" id="nombreCategoria" value="{{$cotizacion->nombrecategoria}}" hidden>

                                                        <input type="text" id="correoEmpresa" value="{{$correoEmpresa}}" hidden>
                                                        <input type="text" id="empresa" value="{{$cotizacion->empresa}}" hidden>
                                                        <input type="text" id="categoria" value="{{$cotizacion->categoria}}" hidden>
                                                        <input type="text" id="cliente" value="{{$cotizacion->cliente}}" hidden>
                                                        <input type="text" id="cotizacion" value="{{$cotizacion->id}}" hidden>
                                                    </div>
                                                    <div class="row" style="text-justify: initial;text-align: justify;word-wrap: break-word;margin-top: 4%;">
                                                        <table class="table">
                                                            <thead>
                                                                <th>CANT.</th>
                                                                <th>DESCRIPCIÓN</th>
                                                                <th>PRECIO UNITARIO</th>
                                                                <th>IMPORTE</th>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>{{$cotizacion->cantidad}}</td>
                                                                    <td>
                                                                        <label>Categoría: </label>{{$cotizacion->nombrecategoria}}<br>
                                                                        <label>Lugar: </label>{{$cotizacion->lugar}}<br>
                                                                        <label>Función: </label>{{$cotizacion->funcion}}<br>
                                                                        <label>Disponibilidad: </label>{{$cotizacion->disponibilidad}}<br>
                                                                        <label>Transporte: </label>{{$cotizacion->transporte}}<br>
                                                                        <label>Fecha del Evento: </label>{{$cotizacion->fechaevento}}<br>
                                                                        <label>Hora del Evento: </label>{{$cotizacion->horaevento}}<br>
                                                                    </td>
                                                                    <td>{{$cotizacion->preciocategoria}}</td>
                                                                    <td>{{$cotizacion->importe}}</td>
                                                                </tr>
                                                                <tr>
                                                                   <td></td><td></td><td>Subtotal</td><td><label>{{$simbolo}}</label>{{$cotizacion->importe}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td><td></td><td>Comisión</td><td><label>{{$simbolo}}</label>{{$cotizacion->comision}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td><td></td><td>Valor Agregado 13.0%</td><td><label>{{$simbolo}}</label>{{$cotizacion->iva}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td><td></td><td><label style="font-size: 20px;font-weight: bold;">TOTAL</label></td>
                                                                    <td> <label style="font-size: 20px;font-weight: bold;"> {{$simbolo}}{{$cotizacion->total}}</label></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td><input type="button" value="Aceptar Contrato" name="btn_aceptarContrato"  style="background:rgb(253, 221, 110);color: #000000;width: 100%;border-radius: 7px;position: relative;
	                                                                            height: 40px;padding-left: 1.5%;padding-right: 1.5%;font-size:17px;font-weight: bold;transition: .2s;word-wrap: break-word;" onClick="aceptarContrato2()"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div><br><br>
                                                </div><br>
                                            </div>                                  
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                            <div id="machoteContrato" style="display: flex;align-items: center;justify-content: center;padding-top: 1%;padding-bottom: 1%;padding-right: 5%;padding-left: 5%;width: 100%;">
                                <div style="background-color: rgb(255, 255, 255);width: 95%;text-align: center;padding-left: 5%;padding-right: 5%;border-radius: 1px;">
                                    <div class="row" style="margin-top: 4%;">
                                        <div class="col-6">
                                            <div style="width: 25%;padding-top: 5%;display: flexbox;vertical-align: middle;">
                                                <img style="width: 100%;" src=/img/logo.png>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row" style="text-justify: initial;text-align: justify;word-wrap: break-word;margin-top: 4%;">
                                        <div class="col-2"></div>    
                                        <div class="col-8">
                                            <h4 style="font-weight: normal;">
                                                La empresa {{$nombreEmpresa}} le contrata para un evento a realizarse el día <label style="font-weight: bold;">{{$fecha}}</label> a 
                                                las <label style="font-weight: bold;">{{$hora}}</label> en lugar <label style="font-weight: bold;">{{$cotizacion->lugar}}</label>
                                                para la categoría <label style="font-weight: bold;">{{$cotizacion->nombrecategoria}}</label>.
                                                <br><br>
                                                Favor cualquier consulta comunicarse al correo {{$correoEmpresa}}.
                                            </h4>
                                        </div>
                                        <div class="col-2"></div>
                                    </div><br><br>
                                </div><br><br><br>
                            </div> 


                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    aceptarContrato2();
</script>
</html>