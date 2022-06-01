<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EDCR Business</title>
    <link rel="stylesheet" type="text/css" href="{{ url('/css/alertify.min.css') }}" />
    <link rel="stylesheet" href="{{ url('/css/opcionPago.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="{{ url('/js/alertify.min.js') }}"></script>
    <script src="{{ url('/js/axios.min.js') }}"></script>
    <script src="{{ url('/js/opcionPago.js') }}"></script>
</head>
<body>
    <input type="text" id="idEmpresa" hidden value="{{$idEmpresa}}">    
    <input type="text" id="comision" hidden value="{{$comision->valor}}">
                                    
    <div class="centroblanco">
        <div class="contenedorcentroIzquierda mt-5">
            <div id="contenedorLogoPago">
                <img id="logo" src="/img/logo.png">
            </div>
        </div>
        <div class="contenedorcentroderecha">
            <div class="mt-1 row">
                <label id="titulo">Tipo de Pago</label><br><br><br><br>
            </div>
            <div class="mt-2 row">
                <input type="button" value="Pago por medio de Paypal" class="btnFormat" id="btn_pagoPaypal">       
            </div><br><br>
            <div class="mt-2 row">
                <input type="button" value="Pago por depósito bancario" class="btnFormat" id="btn_pagoDeposito"><br>
            </div>
        </div>
    </div><br><br><br><br><br>
</body>
</html>