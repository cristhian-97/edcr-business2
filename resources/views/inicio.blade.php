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
<head>
  <style>
    .content-wrapper {
      background: #000000;/*linear-gradient(rgb(0, 0, 0) 10%, rgb(54, 70, 78));*/
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
</head>
<div style="display: flow-box; align-items:center;color:#ffffff;"><br>
    <h1 style="width: 100%;text-align:center;">Bienvenido {{$_SESSION['empresa']->nombreEmpresa}}</h1>
</div>
@stop 

@section('css')
<!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop
@section('js')
@stop