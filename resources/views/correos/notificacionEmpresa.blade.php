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
                    <h2 style="font-weight: bold; margin-top:5%">Cotización aceptada</h2>
                </div>
            </div><br><br>
            <div class="row" style="text-justify: initial;text-align: justify;word-wrap: break-word;margin-top: 4%;">            
                <div class="row">
                    <div class="col-2"></div>    
                    <div class="col-8">
                        <h4 style="font-weight: normal;">
                            El usuario <label style="font-weight: bold;">{{$nombreCliente}}</label> a aceptado la contratación para el evento
                            <label style="font-weight: bold;">{{$nombreEvento}}</label> que se realizará el día <label style="font-weight: bold;">{{$fechaEvento}}</label> a 
                            las <label style="font-weight: bold;">{{$horaEvento}}</label> en lugar <label style="font-weight: bold;">{{$nombreLugar}}</label>
                            para la categoría <label style="font-weight: bold;">{{$nombreCategoria}}</label>.
                        </h4>
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-9"></div>    
                <div class="col-3">
                    <form action="{{ $url }}" method="post" target="_blank">
                        {{csrf_field()}}
                        <input type="text" name="cliente" value="{{$cliente}}" hidden>
                        <input type="text" name="categoria" value="{{$categoria}}" hidden>
                        <input type="text" name="cotizacion" value="{{$cotizacion}}" hidden>
                        <input type="text" name="empresa" value="{{$empresa}}" hidden>
                        <button type="submit" style="background:rgb(253, 221, 110);color: #000000;width: 100%;border-radius: 7px;position: relative;
	                        height: 40px;padding-left: 1.5%;padding-right: 1.5%;font-size:17px;font-weight: bold;transition: .2s;">Realizar Pago</button>
                    </form>
                </div>
            </div>
            <br><br>
        </div><br>
    </div>
</body>

</html>