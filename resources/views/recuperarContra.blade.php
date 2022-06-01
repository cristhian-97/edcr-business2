<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{ url('/css/alertify.min.css') }}" />
    <link rel="stylesheet" href="{{ url('/css/edcr.css') }}">

    <script src="{{ url('/js/alertify.min.js') }}"></script>
    <script src="{{url('/js/edcr.js')}}"></script>
    <script src="{{url('/js/recuperarcontra.js')}}"></script>
    <title>EDCR Business</title>
</head>

<body><br><br><br><br>
    <div id="contenedorTitulo">
        <label id="titulo">Recuperar contraseña</label>
    </div>    
    <form id="formlogin" method="POST" autocomplete="off">
        {{csrf_field()}}
        <div class="centroblanco2" style="display: block;"><br>
            <br><br><br><br>
            <label class="etiquetasRegistro">Ingrese su usuario</label><br>
            <input type="text" name="usuario" placeholder="Usuario" title="Usuario" class="cajatexto" id="txt_usuario" value="{{ old('usuario') }}">
            @error('usuario')<p class="error-message errMsg">{{ $message }}</p>@enderror        
            <br><br>
            <div class="mt-3">
                <input type="button" value="Cancelar" name="btn_cancelar" class="btnFormat" id="btn_cancelarRec">&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Ok" name="btn_recuperar" class="ml-10 btnFormat" id="btn_recuperar">
            </div>
        </div>
    </form><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</body>
</html>
<?php
    if (isset($noLogeado))
        echo "<script> mensajeError('" . $noLogeado . "'); </script>";
    if (isset($usuarioIng))
        echo "<script> llenarForm('" .$usuarioIng."'); </script>";        
?>