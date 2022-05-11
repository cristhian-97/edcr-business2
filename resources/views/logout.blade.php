<!DOCTYPE html>
<!--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EDCR Business</title>
    <link rel="stylesheet" type="text/css" href="{{ url('/css/edcr.css') }}" />
    <?php   
    use Illuminate\Support\Facades\URL;
    header('Refresh: 2; URL=' . URL::to($dir));
    ?>
</head>

<body style="background: linear-gradient(90deg, rgb(187, 187, 187) 0%, rgb(15, 53, 53) 100%);">

    <div id="contenedorcerro">
        <p id="cerrosession"> {{$mensaje}}</p>
        <p id="cerrosession2"> Espere y pronto sera redireccionado.</p>
        <?php
    echo '<a href="' . URL::to($dir) . '" id="sinadasucede">Si nada sucede presione aqui.</a>';
    ?>
    </div>

</body>

</html>