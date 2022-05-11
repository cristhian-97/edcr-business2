@extends('adminlte::page')

@section('content')
<div style="display: flow-box; align-items:center" class="titulo"><br>
   <button type="button" value="Cancelar" name="btn_cancelar" class="btn btn-danger" id="btn_cancelar">Cancelar</button>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="sticky-top mb-3">
                <div class="input-group">
                    <div class="card-body">
                        <div class=" mt-5 row">
                            <div class="col-md-12">
                            <!--$categoria->id==1=Edecanes
                                $categoria->id==2=Modelos de Fotografías
                                $categoria->id==3=Modelos de Fitness-->
                               
                            @if($cliente!=null)
                                <h4>Cliente</h4>
                                <div id="contenedor-data" class='table-responsive'>
                                    <table class="table">
                                        </tbody>
                                        @foreach($cliente as $c)
                                            <tr>
                                                <td>{{$c->nombre}}</td>
                                                <td><input type="checkbox" id="{{$c->codigo}}" class="mt-2 ml-1 chkAT" data-width="120" data-height="37" 
                                                            /></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table><br>                                    
                                </div>
                            @endif
                                <div class="input-group mt-4">
                                    <div class="col-md-4">
                                        <label for="txtHoras" style="position: absolute;top:-22px;">Cantidad de Horas</label>
                                        <input type="number" id="txtHoras" name="horas" placeholder="Cantidad de Horas" title="Cantidad de Horas" class="form-control rounded" value="">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="button" value="Cotizar" name="btn_cotizar" class="btn btn-success" id="btn_cotizar">
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>


</div>


@stop

@section('css')    
<link rel="stylesheet" type="text/css" href="{{ url('/css/alertify.min.css') }}" />
<link rel="stylesheet" href="{{url('/css/edcr.css')}}">
@stop

@section('js')
<script src="{{ url('/js/alertify.min.js') }}"></script>
<script src="{{ url('/js/axios.min.js') }}"></script>
<script src="{{url('/js/edcr.js')}}"></script>
  <!-- jQuery -->
<script src="{{url('/js/cotizacion.js')}}"></script>
 @stop