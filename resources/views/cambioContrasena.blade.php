<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EDCR Business</title>
    <link rel="stylesheet" type="text/css" href="{{ url('/css/alertify.min.css') }}" />
    <link rel="stylesheet" href="{{ url('/css/edcr.css') }}">
    <link rel="stylesheet" href="{{ url('/css/login.css') }}">
    
    <script src="{{ url('/js/alertify.min.js') }}"></script>
    <script src="{{url('/js/edcr.js')}}"></script>
    <script src="{{url('/js/cambiocontra.js')}}"></script>
</head>

<body>
    <div id="contenedorTitulos">
        <label id="titulo">Cambiar contraseña</label>
    </div>
    <br>
    <form id="forcambio" method="POST" autocomplete="off">
        {{csrf_field()}}
        <div class="centroblanco" style="display: block;">
            <div style="display: flex;">
                <div class="contenedorcentroIzquierda">
                    <p> Por su seguridad es necesario cambiar la contraseña de su cuenta. <br>Para continuar, por favor introduzca una nueva contraseña.</p>
                    <br>
                </div>
                <div class="contenedorcentroderecha">
                    <label for="txtContrasena">Contraseña</label>
                    <input type="password" id="txtContrasena" name="contrasena" placeholder="Contraseña" title="Contraseña" class="cajatexto" value="{{ old('contrasena') }}">
                    @error('contrasena')<p class="error-message errMsg">{{ $message }}</p>@enderror<br>

                    <label for="txtConfContrasena">Confirmar Contraseña</label>
                    <input type="password" id="txtConfContrasena" name="contrasena_confirmation" placeholder="Confirmar Contraseña" title="Confirmar Contraseña" class="cajatexto" value="{{ old('contrasena_confirmation')}}">
                    @error('contrasena_confirmation')<p class="error-message errMsg">{{ $message }}</p>@enderror
                    <div><input type="submit" value="OK" name="btn_cambio" class="btnFormat" id="btn_cambio"></div>
                </div>
            </div>
        </div>
    </form>
    <br><br>    
</body>
</html>
<?php
    if (isset($mensaje))
        echo "<script> mensajeError('" . $mensaje . "'); </script>";
?>