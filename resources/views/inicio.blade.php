@extends('adminlte::page')

@section('title', 'EDCR Business - Inicio')

<?php

use Illuminate\Support\Facades\URL;

//session_start();
if (!isset($_SESSION['empresa'])) {
  header('Location: ' . URL::to('/nolog'), true, 307);
  die();
}
?>

@section('content')
<div style="display: flow-box; align-items:center">
    <br>
    <h1 style="width: 100%;text-align:center;">Bienvenido {{$_SESSION['empresa']->nombreEmpresa}}</h1>
</div>
@stop 

@section('css')
<!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('js')
@stop