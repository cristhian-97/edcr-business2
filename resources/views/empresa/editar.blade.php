@extends('adminlte::page')

@section('title', 'EDCR Business - Inicio')

@section('content')
<style>
    .content-wrapper {
      background: linear-gradient(rgb(0, 0, 0) 10%, rgb(54, 70, 78));
    }
    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
      background: #FDDD6E;
      color: black;
    }    
    .navbar-white {
        background: rgb(54, 70, 78);
        color: #ffffff;
    }
    .main-sidebar {
        background: #000000;/*#455A64;*/
    }
</style>
<link rel="stylesheet" type="text/css" href="{{ url('/css/alertify.min.css') }}" />
<link rel="stylesheet" href="{{ url('/css/edcr.css') }}">

<script src="{{ url('/js/alertify.min.js') }}"></script>
<script src="{{url('/js/edcr.js')}}"></script>
<script src="{{url('/js/editarEmpresa.js')}}"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="sticky-top mb-3">
                <div class="card-body">
                    <form action="{{ route('empresa.update') }}" method="POST" autocomplete="off">
                        {{csrf_field()}}
                        {{ method_field('PUT') }}
                        <input type="text" id="idempresa" name="idempresa" hidden value="{{$empresa->id}}">
                        <input type="text" id="tipoCedula" hidden value="{{old('tipoCedula',$empresa->tipoCedula)}}">
                        <div class=" mt-5 row">
                            <div class="col-md-6">
                                <label for="txtNombreEmpresa" style="position: absolute;top:-22px;" class="etiquetasRegistro">Nombre de la Empresa</label>
                                <input type="text" id="txtNombreEmpresa" name="nombreEmpresa" placeholder="Nombre de la Empresa" title="Nombre de la Empresa"
                                    class="cajatextoedt" value="{{ old('nombreEmpresa',$empresa->nombreEmpresa) }}" >
                                @error('nombreEmpresa')<p class="error-message errMsg">{{ $message }}</p>@enderror
                            </div>
                            <div class="col-md-6">                
                                <div class="row" style="position: absolute;top:-22px;">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rdCedula" id="rdCedulaFisica" value="1">
                                            <label class="form-check-label etiquetasRegistro" for="rdCedulaFisica">F??sica</label>
                                        </div>
                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rdCedula" id="rdCedulaJuridica" value="2">
                                            <label class="form-check-label etiquetasRegistro" for="rdCedulaJuridica">Jur??dica</label>
                                        </div>
                                    </div>
                                </div><!--<label for="txtCedulaEmpresa" style="position: absolute;top:-22px;">C??dula de la Empresa</label>-->
                                <input type="text" id="txtCedulaEmpresa" name="cedulaEmpresa" placeholder="C??dula de la Empresa" title="C??dula de la Empresa"
                                    class="cajatextoedt" value="{{old('cedulaEmpresa',$empresa->cedulaEmpresa)}}">
                                @error('cedulaEmpresa')<p class="error-message errMsg">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="mt-5 row">
                            <div class="col-md-6">
                                <label for="txtNombreEncargado" style="position: absolute;top:-22px;" class="etiquetasRegistro">Nombre del Encargado</label>
                                <input type="text" id="txtNombreEncargado" name="nombreEncargado" placeholder="Nombre del Encargado" title="Nombre del Encargado" 
                                    class="cajatextoedt" value="{{ old('nombreEncargado',$empresa->nombreEncargado) }}">
                                    @error('nombreEncargado')<p class="error-message errMsg">{{ $message }}</p>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="txtCedulaEncargado" style="position: absolute;top:-22px;" class="etiquetasRegistro">C??dula del Encargado</label>
                                <input type="text" id="txtCedulaEncargado" name="cedulaEncargado" placeholder="C??dula del Encargado" title="C??dula del Encargado"
                                    class="cajatextoedt" value="{{ old('cedulaEncargado',$empresa->cedulaEncargado) }}">
                                @error('cedulaEncargado')<p class="error-message errMsg">{{ $message }}</p>@enderror
                            </div>   
                        </div>
                        <div class=" mt-5 row">
                            <div class="col-md-6">
                                <label for="txtTelefonoEncargado" style="position: absolute;top:-22px;" class="etiquetasRegistro">Tel??fono del Encargado</label>
                                <input type="text" id="txtTelefonoEncargado" name="telefonoEncargado" placeholder="Tel??fono del Encargado" title="Tel??fono del Encargado"
                                    class="cajatextoedt" value="{{ old('telefonoEncargado',$empresa->telefonoEncargado) }}">
                                @error('telefonoEncargado')<p class="error-message errMsg">{{ $message }}</p>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="txtCorreoEncargado" style="position: absolute;top:-22px;" class="etiquetasRegistro">Correo del Encargado</label>
                                <input type="text" id="txtCorreoEncargado" name="correoEncargado" placeholder="Correo del Encargado" title="Correo del Encargado" 
                                    class="cajatextoedt" value="{{ old('correoEncargado',$empresa->correoEncargado) }}">
                                @error('correoEncargado')<p class="error-message errMsg">{{ $message }}</p>@enderror
                            </div>                    
                        </div>
                        <div class="mt-5 row">
                            <div class="col-md-6">
                                <label for="txtTelefono" style="position: absolute;top:-22px;" class="etiquetasRegistro">Tel??fono de la Empresa</label>
                                <input type="text" id="txtTelefono" name="telefonoEmpresa" placeholder="N??mero de tel??fono" title="N??mero de tel??fono"
                                    class="cajatextoedt" value="{{ old('telefonoEmpresa',$empresa->telefonoEmpresa) }}">
                                @error('telefonoEmpresa')<p class="error-message errMsg">{{ $message }}</p>@enderror
                            </div>
                            <div class="col-md-6">      
                                <label for="txtUsuario" style="position: absolute;top:-22px;" class="etiquetasRegistro">Usuario</label>
                                <input type="text" id="txtUsuario" name="usuario" placeholder="Usuario" title="Usuario"
                                    class="cajatextoedt" value="{{ old('usuario',$empresa->usuario) }}">
                                @error('usuario')<p class="error-message errMsg">{{ $message }}</p>@enderror     
                            </div>            
                        </div>
                        <div class="mt-5 row">
                            <div class="col-md-6">
                                <label for="txtContrasena" style="position: absolute;top:-22px;" class="etiquetasRegistro">Contrase??a</label>
                                <input type="password" id="txtContrasena" name="contrasena" placeholder="Contrase??a" title="Contrase??a"
                                    class="cajatextoedt" value="{{ old('contrasena') }}">
                                @error('contrasena')<p class="error-message errMsg">{{ $message }}</p>@enderror                
                            </div>
                            <div class="col-md-6">      
                                <label for="txtConfContrasena" style="position: absolute;top:-22px;" class="etiquetasRegistro">Confirmar Contrase??a</label>
                                <input type="password" id="txtConfContrasena" name="contrasena_confirmation" placeholder="Confirmar Contrase??a" title="Confirmar Contrase??a"
                                    class="cajatextoedt" value="{{ old('contrasena_confirmation')}}">
                                @error('contrasena_confirmation')<p class="error-message errMsg">{{ $message }}</p>@enderror
                            </div>            
                        </div>
                        <div class="mt-5 row">
                            <div class="col-md-12">
                                <label for="txtDireccion" style="position: absolute;top:-22px;" class="etiquetasRegistro">Direcci??n</label>
                                <input type="text" id="txtDireccion" name="direccion" placeholder="Direcci??n" title="Direcci??n"
                                    class="cajatextoedt" value="{{ old('direccion',$empresa->direccion) }}">
                                @error('direccion')<p class="error-message errMsg">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="mt-5 ">
                            <input type="submit" value="Actualizar" name="btn_registrar" class="btnFormatEdit" id="btn_registrar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($mensaje))
    echo "<script> mensajeExito('" . $mensaje . "'); </script>";
if(isset($mensajeError))
   echo "<script> mensajeError('" . $mensajeError . "'); </script>";
?>
@stop

@section('css') 
@stop

@section('js')
@stop
