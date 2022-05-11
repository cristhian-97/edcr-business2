<!--<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{ url('/css/alertify.min.css') }}" />
    <link rel="stylesheet" href="{{ url('/css/edcr.css') }}">
    <link rel="stylesheet" href="{{ url('/css/login.css') }}">
    
    <script src="{{ url('/js/alertify.min.js') }}"></script>
    <script src="{{url('/js/edcr.js')}}"></script>
    <script src="{{url('/js/registrar.js')}}"></script>
</head>

<body>
    <div id="contenedorTitulo">
        <label id="titulo">Registrar Empresa</label>
    </div>
    <form id="formRegistro" method="POST" autocomplete="off">
        {{csrf_field()}}
        <div class="centroblanco" style="display: block;">
            <div style="display: flex;">
                <div class="contenedorcentroIzquierda">
                    <label for="">Nombre</label>
                    <br>
                    <input type="text" id="txtNombre" name="nombre" placeholder="Nombre" title="Nombre"
                        class="cajatexto"  ><br>
                    <label for="">Teléfono</label>
                    <br>
                    <input type="text" id="txtTelefono" name="telefono" placeholder="Número de teléfono" title="Número de teléfono"
                        class="cajatexto"><br>
                    <label for="">Contraseña</label>
                    <br>
                    <input type="text" id="txtContrasena" name="contrasena" placeholder="Contraseña" title="Contraseña"
                        class="cajatexto">                                          
                </div>                
                <div class="contenedorcentroderecha">
                    <label for="">Cédula Jurídica</label>
                    <br>
                    <input type="text" id="txtCedulaJuridica" name="cedulaJuridica" placeholder="Cédula Jurídica" title="Cédula Jurídica"
                        class="cajatexto">
                    <br>
                    <label for="">Usuario</label>
                    <br>
                    <input type="text" id="txtUsuario" name="usuario" placeholder="Usuario" title="Usuario"
                        class="cajatexto"><br>
                    <label for="">Confirmar Contraseña</label>
                    <br>
                    <input type="text" id="txtConfContrasena" name="confContrasena" placeholder="Confirmar Contraseña" title="Confirmar Contraseña"
                        class="cajatexto">
                </div>                
            </div>
            <label for="">Direción</label>
            <br>
            <input type="text" id="txtDireccion" name="direccion" placeholder="Dirección" title="Dirección"
                       class="cajatexto"><br>
            <div>
                <input type="button" value="Cancelar" class="btnFormat" id="btn_cancelar">
                <input type="submit" value="Registrar" name="btn_registrar" class="ml-5 btnFormat" id="btn_registrar" >
            </div>
        </div>
    </form>
</body>

</html>-->

<?php
if (isset($mensajeError))
    echo "<script> mensajeError('" . $mensajeError . "'); </script>";
?>
