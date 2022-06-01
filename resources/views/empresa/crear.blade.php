<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{ url('/css/alertify.min.css') }}" />
    <link rel="stylesheet" href="{{ url('/css/edcr.css') }}">
    <link rel="stylesheet" href="{{ url('/css/login.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    
    
    <script src="{{ url('/js/alertify.min.js') }}"></script>
    <script src="{{url('/js/edcr.js')}}"></script>
    <script src="{{url('/js/registrar.js')}}"></script>
</head>

<body><br>
    <div id="tituloregemp">
        <h3 class="card-title" style="color: white">Registrar Empresa</h3>
    </div>
    <div class="centroblanco3">
        <div class="card-body">
            <form action="{{ route('empresa.store') }}" method="POST" autocomplete="off">              
                {{csrf_field()}}
                <div class=" mt-2 row">
                    <div class="col-md-6">
                        <label for="txtNombreEmpresa" class="etiquetasRegistro">Nombre de la Empresa</label><br>
                        <input type="text" id="txtNombreEmpresa" name="nombreEmpresa" placeholder="Nombre de la Empresa" title="Nombre de la Empresa" class="cajatextoedt" value="{{ old('nombreEmpresa') }}" >
                        @error('nombreEmpresa')<p class="error-message errMsg">{{ $message }}</p>@enderror
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rdCedula" id="rdCedulaFisica" value="1">
                                    <label class="form-check-label etiquetasRegistro" for="rdCedulaFisica">Física</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rdCedula" id="rdCedulaJuridica" checked value="2">
                                    <label class="form-check-label etiquetasRegistro" for="rdCedulaJuridica">Jurídica</label>
                                </div> 
                            </div>
                        </div>
                        <input type="text" id="txtCedulaEmpresa" name="cedulaEmpresa" placeholder="Cédula de la Empresa" title="Cédula de la Empresa" class="cajatextoedt" value="{{ old('cedulaEmpresa') }}">
                        @error('cedulaEmpresa')<p class="error-message errMsg">{{ $message }}</p>@enderror
                    </div>        
                </div>
                <div class="mt-3 row">
                    <div class="col-md-6">
                        <label for="txtNombreEncargado" class="etiquetasRegistro">Nombre del Encargado</label><br>
                        <input type="text" id="txtNombreEncargado" name="nombreEncargado" placeholder="Nombre del Encargado" title="Nombre del Encargado" class="cajatextoedt" value="{{ old('nombreEncargado') }}" >
                        @error('nombreEncargado')<p class="error-message errMsg">{{ $message }}</p>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="txtCedulaEncargado" class="etiquetasRegistro">Cédula del Encargado</label>
                        <input type="text" id="txtCedulaEncargado" name="cedulaEncargado" placeholder="Cédula del Encargado" title="Cédula del Encargado" class="cajatextoedt" value="{{ old('cedulaEncargado') }}">
                        @error('cedulaEncargado')<p class="error-message errMsg">{{ $message }}</p>@enderror
                    </div>   
                </div>
                <div class="mt-3 row">
                    <div class="col-md-6">
                        <label for="txtTelefonoEncargado" class="etiquetasRegistro">Teléfono del Encargado</label>
                        <input type="text" id="txtTelefonoEncargado" name="telefonoEncargado" placeholder="Teléfono del Encargado" title="Teléfono del Encargado" class="cajatextoedt" value="{{ old('telefonoEncargado') }}">
                        @error('telefonoEncargado')<p class="error-message errMsg">{{ $message }}</p>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="txtCorreoEncargado" class="etiquetasRegistro">Correo del Encargado</label>
                        <input type="text" id="txtCorreoEncargado" name="correoEncargado" placeholder="Correo del Encargado" title="Correo del Encargado" class="cajatextoedt" value="{{ old('correoEncargado') }}">
                        @error('correoEncargado')<p class="error-message errMsg">{{ $message }}</p>@enderror
                    </div>                    
                </div>
                <div class="mt-3 row">
                    <div class="col-md-6">
                        <label for="txtTelefonoEmpresa" class="etiquetasRegistro">Teléfono de la Empresa</label>
                        <input type="text" id="txtTelefonoEmpresa" name="telefonoEmpresa" placeholder="Teléfono de la Empresa" title="Teléfono de la Empresa" class="cajatextoedt" value="{{ old('telefonoEmpresa') }}">
                        @error('telefonoEmpresa')<p class="error-message errMsg">{{ $message }}</p>@enderror
                    </div>
                    <div class="col-md-6">      
                        <label for="txtUsuario" class="etiquetasRegistro">Usuario</label>
                        <input type="text" id="txtUsuario" name="usuario" placeholder="Usuario" title="Usuario" class="cajatextoedt" value="{{ old('usuario') }}">
                        @error('usuario')<p class="error-message errMsg">{{ $message }}</p>@enderror     
                    </div>
                </div>
                <div class="mt-3 row">
                    <div class="col-md-6">
                        <label for="txtContrasena" class="etiquetasRegistro">Contraseña</label>
                        <input type="password" id="txtContrasena" name="contrasena" placeholder="Contraseña" title="Contraseña" class="cajatextoedt" value="{{ old('contrasena') }}">
                        @error('contrasena')<p class="error-message errMsg">{{ $message }}</p>@enderror
                    </div>
                    <div class="col-md-6">      
                        <label for="txtConfContrasena" class="etiquetasRegistro">Confirmar Contraseña</label>
                        <input type="password" id="txtConfContrasena" name="contrasena_confirmation" placeholder="Confirmar Contraseña" title="Confirmar Contraseña" class="cajatextoedt" value="{{ old('contrasena_confirmation')}}">
                        @error('contrasena_confirmation')<p class="error-message errMsg">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="mt-3 row">
                    <div class="col-md-12">
                        <label for="txtDireccion" class="etiquetasRegistro">Dirección</label>
                        <input type="text" id="txtDireccion" name="direccion" placeholder="Dirección" title="Dirección" class="cajatextoedt" value="{{ old('direccion') }}">
                        @error('direccion')<p class="error-message errMsg">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="mt-3 alineacionCentro">
                    <input type="button" value="Cancelar" class="btnFormat" id="btn_cancelarReg">&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" value="Registrarme" name="btn_registrar" class="ml-5 btnFormat" id="btn_registrar" >
                </div>     
            </form>
        </div>
    </div>    
</body>

</html>

<?php
if (isset($mensajeError))
    echo "<script> mensajeError('" . $mensajeError . "'); </script>";
?>
