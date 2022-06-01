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
    <script src="{{url('/js/login.js')}}"></script>
    <style>
        body {
            background: black;
            margin: 0;
            font-family: 'Raleway', sans-serif;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div id="contenedorTitulo">
        <label id="titulo">Login</label>
    </div><br>
    <div class="centroblanco">
        <div class="contenedorcentroIzquierda">
            <div id="contenedorLogo">
                <img id="logo" src="/img/logo.png">
            </div>
        </div>
        <div class="contenedorcentroderecha">
            <form method="POST" autocomplete="off">
                {{csrf_field()}}
                <input type="text" name="usuario" placeholder="Usuario" title="Usuario" class="cajatexto" id="txt_usuario" value="{{ old('usuario') }}">
                @error('usuario')<p class="error-message errMsg">{{ $message }}</p>@enderror
                <br><br>
                <input type="password" name="contrasena" placeholder="**********" title="Contraseña" class="cajatexto" id="txt_password" value="{{ old('contrasena') }}"/>
                @error('contrasena')<p class="error-message errMsg">{{ $message }}</p>@enderror
                <br><br>
                <div>
                    <input type="button" value="Registrarme" name="btn_registro" class="btnFormat" id="btn_registro2">&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" value="Iniciar Sesión" name="btn_login" class="ml-10 btnFormat" id="btn_login">
                </div><br>
                <label class="lblRecuperarContra" id="lbl_RecuperarContra">Olvidé mi contraseña</label>
                <br><br><br><br><br><br><br>
            </form>
        </div>
</body>
</html>
<?php
if (isset($mensajeExito))
    echo "<script> mensajeExito('" . $mensajeExito . "'); </script>";
if (isset($noLogeado))
    echo "<script> mensajeError('" . $noLogeado . "'); </script>";
if (isset($usuarioIng) && isset($contraIng))
    echo "<script> llenarForm('" .$usuarioIng."','".$contraIng."'); </script>"; 
?>