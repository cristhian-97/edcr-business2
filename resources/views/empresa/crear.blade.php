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

<body>
    <div  class="centroblanco2"> 
        <div class="card-header">
            <h3 class="card-title">Registrar Empresa</h3>
        </div>
        <div class="card-body">    
            <form action="{{ route('empresa.store') }}" method="POST" autocomplete="off">              
                {{csrf_field()}}
                <div class=" mt-5 row">
                    <div class="col-md-6">
                        <label for="txtNombreEmpresa" >Nombre de la Empresa</label><br>
                        <input type="text" id="txtNombreEmpresa" name="nombreEmpresa" placeholder="Nombre de la Empresa" title="Nombre de la Empresa" class="form-control" value="{{ old('nombreEmpresa') }}" >
                        @error('nombreEmpresa')<p class="error-message errMsg">{{ $message }}</p>@enderror
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rdCedula" id="rdCedulaFisica" value="1">
                                    <label class="form-check-label" for="rdCedulaFisica">Física</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rdCedula" id="rdCedulaJuridica" checked value="2">
                                    <label class="form-check-label" for="rdCedulaJuridica">Jurídica</label>
                                </div> 
                            </div>
                        </div>
                        <input type="text" id="txtCedulaEmpresa" name="cedulaEmpresa" placeholder="Cédula de la Empresa" title="Cédula de la Empresa" class="form-control" value="{{ old('cedulaEmpresa') }}">
                        @error('cedulaEmpresa')<p class="error-message errMsg">{{ $message }}</p>@enderror
                    </div>        
                </div>
                <div class=" mt-5 row">
                    <div class="col-md-6">
                        <label for="txtNombreEncargado" >Nombre del Encargado</label><br>
                        <input type="text" id="txtNombreEncargado" name="nombreEncargado" placeholder="Nombre del Encargado" title="Nombre del Encargado" class="form-control" value="{{ old('nombreEncargado') }}" >
                        @error('nombreEncargado')<p class="error-message errMsg">{{ $message }}</p>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="txtCedulaEncargado">Cédula del Encargado</label>
                        <input type="text" id="txtCedulaEncargado" name="cedulaEncargado" placeholder="Cédula del Encargado" title="Cédula del Encargado" class="form-control" value="{{ old('cedulaEncargado') }}">
                        @error('cedulaEncargado')<p class="error-message errMsg">{{ $message }}</p>@enderror
                    </div>   
                </div>
                <div class=" mt-5 row">
                    <div class="col-md-6">
                        <label for="txtTelefonoEncargado">Teléfono del Encargado</label>
                        <input type="text" id="txtTelefonoEncargado" name="telefonoEncargado" placeholder="Teléfono del Encargado" title="Teléfono del Encargado" class="form-control" value="{{ old('telefonoEncargado') }}">
                        @error('telefonoEncargado')<p class="error-message errMsg">{{ $message }}</p>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="txtCorreoEncargado">Correo del Encargado</label>
                        <input type="text" id="txtCorreoEncargado" name="correoEncargado" placeholder="Correo del Encargado" title="Correo del Encargado" class="form-control" value="{{ old('correoEncargado') }}">
                        @error('correoEncargado')<p class="error-message errMsg">{{ $message }}</p>@enderror
                    </div>                    
                </div>
                <div class="mt-5 row">
                    <div class="col-md-6">
                        <label for="txtTelefonoEmpresa">Teléfono de la Empresa</label>
                        <input type="text" id="txtTelefonoEmpresa" name="telefonoEmpresa" placeholder="Teléfono de la Empresa" title="Teléfono de la Empresa" class="form-control" value="{{ old('telefonoEmpresa') }}">
                        @error('telefonoEmpresa')<p class="error-message errMsg">{{ $message }}</p>@enderror
                    </div>
                    <div class="col-md-6">      
                        <label for="txtUsuario">Usuario</label>
                        <input type="text" id="txtUsuario" name="usuario" placeholder="Usuario" title="Usuario" class="form-control" value="{{ old('usuario') }}">
                        @error('usuario')<p class="error-message errMsg">{{ $message }}</p>@enderror     
                    </div>
                </div>
                <div class="mt-5 row">
                    <div class="col-md-6">
                        <label for="txtContrasena">Contraseña</label>                      
                        <input type="password" id="txtContrasena" name="contrasena" placeholder="Contraseña" title="Contraseña" class="form-control" value="{{ old('contrasena') }}">
                        @error('contrasena')<p class="error-message errMsg">{{ $message }}</p>@enderror
                    </div>
                    <div class="col-md-6">      
                        <label for="txtConfContrasena">Confirmar Contraseña</label>
                        <input type="password" id="txtConfContrasena" name="contrasena_confirmation" placeholder="Confirmar Contraseña" title="Confirmar Contraseña" class="form-control" value="{{ old('contrasena_confirmation')}}">
                        @error('contrasena_confirmation')<p class="error-message errMsg">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="mt-5 row">
                    <div class="col-md-12">
                        <label for="txtDireccion">Dirección</label>
                        <input type="text" id="txtDireccion" name="direccion" placeholder="Dirección" title="Dirección" class="form-control" value="{{ old('direccion') }}">
                        @error('direccion')<p class="error-message errMsg">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="mt-5 ">
                    <input type="button" value="Cancelar" class="btnFormat" id="btn_cancelar">
                    <input type="submit" value="Registrar" name="btn_registrar" class="ml-5 btnFormat" id="btn_registrar" >
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
