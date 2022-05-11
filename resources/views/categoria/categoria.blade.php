@extends('adminlte::page')

@section('content')
<div style="display: flow-box; align-items:center" class="titulo"><br>
    <h1 style="width: 100%;text-align:center;">Categorías</h1>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="sticky-top mb-3">
                
                    <div class="card-body">
                        <div class=" mt-5 row">
                            <div class="col-md-12">
                                <div id="contenedor-data" class='table-responsive'>
                                    <div class="baseCategorias">
                                        @foreach ($categorias as $c)
                                            <div class="baseCategoria">
                                                <div class="categoria">
                                                    <form action="{{ route('categoria') }}" method="POST">
                                                        {{csrf_field()}}
                                                        <input type="text" id="id" name="id" hidden value="{{ $c->id }}">
                                                        <input type="text" id="comision" name="comision" hidden value="{{$comision->valor}}">                                                        
                                                        <button type="submit" class="btn btn-outline-secondary">{{$c->nombre}}</button>
                                                    </form>
                                                </div>
                                            </div><br>
                                        @endforeach
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
    <link rel="stylesheet" href="{{url('/css/categoria.css')}}">
    <link rel="stylesheet" href="{{url('/css/edcr.css')}}">
@stop

@section('js')
@stop