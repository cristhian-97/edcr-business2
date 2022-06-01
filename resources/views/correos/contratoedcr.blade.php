<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EDCR Business</title>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div style="background-color:rgb(183, 180, 180);display: flex;align-items: center;justify-content: center;padding-top: 1%;padding-bottom: 1%;padding-right: 5%;padding-left: 5%;width: 100%;">
        <div style="background-color: rgb(255, 255, 255);width: 95%;text-align: center;padding-left: 5%;padding-right: 5%;border-radius: 1px;">
            <div class="row" style="margin-top: 4%;">
                <div class="col-6">
                    <div style="width: 25%;padding-top: 5%;display: flexbox;vertical-align: middle;">
                        <img style="width: 100%;" src=https://apps.biinsidecr.com/edecanes/logo.png>
                    </div>
                </div>
                <div class="col-6">
                    <label style="font-size: 17px;font-weight: bold;">COTIZACIÓN</label>
                </div>
            </div><br>
            <div class="row" style="text-justify: initial;text-align: justify;word-wrap: break-word;margin-top: 4%;">
                <div class="col-3">
                    <label style="font-size: 17px;font-weight: bold;">Comunicarse al: </label>
                </div>
                <div class="col-4">
                    <label style="font-size: 17px;font-weight: bold;">{{$correo}}</label>
                </div>
            </div>
            <div class="row" style="text-justify: initial;text-align: justify;word-wrap: break-word;margin-top: 4%;">
                <div class="col-3">
                    <label style="font-size: 17px;font-weight: bold;">Facturar a</label>
                </div>
                <div class="col-4">
                    <label style="font-size: 17px;font-weight: bold;">Enviar a</label>
                </div>
                <div class="col-3">
                    <label style="font-size: 17px;font-weight: bold;">Cotización #</th>
                </div>
                <div class="col-2">
                    <td style="font-size:17px;">{{$numero}}</td>
                </div>
            </div>
            <div class="row" style="text-justify: initial;text-align: justify;word-wrap: break-word;margin-top: 4%;">
                <div class="col-3" style="font-size:17px;">
                   {{$usuarioEDCR}}
                </div>
                <div class="col-4" style="font-size:17px;">
                     {{$correoedcr}}
                    <br>
                </div>
                <div class="col-3">
                    <label style="width: 100%;text-align:right;font-size: 17px;font-weight: bold;">Fecha de la cotización</label>
                </div>
                <div class="col-2" style="width: 100%;text-align:right;font-size:17px;">
                    <td>{{$fecha}}</td>
                </div>
            </div>
            <div class="row" style="text-justify: initial;text-align: justify;word-wrap: break-word;margin-top: 4px;margin-top: 4%;">
                <div class="col-3">
                    <label style="font-size:17px;">Usuario EDCR: </label>
                </div>
                <div class="col-3" style="font-size:17px;">
                    {{$usuarioEDCR}}
                </div>
            </div>
            <br>
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
                            <td style="font-size:17px;">{{$cant}}</td>
                            <td style="font-size:17px;">
                                <label>Categoría: </label>{{$nombreCat}}<br>
                                <label>Lugar: </label>{{$lugar}}<br>
                                <label>Función: </label>{{$funcion}}<br>
                                <label>Disponibilidad: </label>{{$disp2}}<br>
                                <label>Transporte: </label>{{$transp}}<br>
                                <label>Fecha del Evento: </label>{{$fechaEv}}<br>
                                <label>Hora del Evento: </label>{{$horaEv}}<br>
                            </td>
                            <td style="font-size:17px;">{{$precioCt}}</td>
                            <td style="font-size:17px;">{{$imprte}}</td>
                        </tr>
                        <tr>
                            <td></td><td></td><td style="font-size:17px;">Subtotal</td><td style="font-size:17px;"><label>{{$simbolo}}</label>{{$imprte}}</td>
                        </tr>
                        <tr>
                            <td></td><td></td><td style="font-size:17px;">Comisión</td><td style="font-size:17px;"><label>{{$simbolo}}</label>{{$comsion}}</td>
                        </tr>
                        <tr>
                            <td></td><td></td><td style="font-size:17px;">Valor Agregado 13.0%</td><td style="font-size:17px;"><label>{{$simbolo}}</label>{{$iva}}</td>
                        </tr>
                        <tr>
                            <td></td><td></td><td><label style="font-size: 20px;font-weight: bold;">TOTAL</label></td>
                            <td> <label style="font-size: 20px;font-weight: bold;">{{$simbolo}}{{$totl}}</label></td>
                        </tr>
                        <tr><td></td><td></td><td></td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-8" style="font-size:17px;">
                        <label>Para aceptar la oferta debe ir al sistema y aceptar el contrato mediante el siguiente enlace: </label>
                    </div>
                    <div class="col-4">
                        <form action="{{ $url }}" method="post" target="_blank">
                            {{csrf_field()}}
                            <input type="text" name="codigo" value="{{$codigo}}" hidden>
                            <input type="text" name="categoria" value="{{$idCategoria}}" hidden>
                            <input type="text" name="cotizacion" value="{{$idCotizacion}}" hidden>
                            <input type="text" name="empresa" value="{{$idEmpresa}}" hidden>
                            <button type="submit" style="background:rgb(253, 221, 110);color: #000000;width: 100%;border-radius: 7px;position: relative;
	                            height: 40px;padding-left: 1.5%;padding-right: 1.5%;font-size:18px;font-weight: bold;transition: .2s;">Aceptar Oferta</button>
                        </form>
                    </div>   
                </div>
            </div><br><br>
        </div><br>
    </div>
</body>

</html>