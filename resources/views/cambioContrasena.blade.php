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
    <div id="contenedorTitulo">
        <label id="titulo">Cambiar contraseña</label>
    </div><br>
    <div class="centroblanco">
        <div class="contenedorcentroIzquierda"><br><br>
            <p class="etiquetasRegistro"> Por su seguridad es necesario cambiar la contraseña de su cuenta. <br>Para continuar, por favor introduzca una nueva contraseña.</p><br>
        </div>
        <div class="contenedorcentroderecha">
            <form id="forcambio" method="POST" autocomplete="off">
                {{csrf_field()}}
                <label for="txtContrasena" class="etiquetasRegistro">Contraseña</label><br>
                <input type="password" id="txtContrasena" name="contrasena" placeholder="Contraseña" title="Contraseña" class="cajatexto" value="{{ old('contrasena') }}">
                @error('contrasena')<p class="error-message errMsg">{{ $message }}</p>@enderror<br>
                <br><br>
                <label for="txtConfContrasena" class="etiquetasRegistro">Confirmar Contraseña</label><br>
                <input type="password" id="txtConfContrasena" name="contrasena_confirmation" placeholder="Confirmar Contraseña" title="Confirmar Contraseña" class="cajatexto" value="{{ old('contrasena_confirmation')}}">
                @error('contrasena_confirmation')<p class="error-message errMsg">{{ $message }}</p>@enderror
                <br><br>
                <div><input type="submit" value="OK" name="btn_cambio" class="btnFormat" id="btn_cambio"></div>        
            </form>
            <br><br><br><br><br><br>
        </div> 
    </div>    
</body>
</html>
<?php
    if (isset($mensaje))
        echo "<script> mensajeError('" . $mensaje . "'); </script>";
?>