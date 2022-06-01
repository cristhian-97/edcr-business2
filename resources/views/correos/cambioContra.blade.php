<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EDCR Business</title>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">

</head>

<body style="background: #455A64;">
    <div style='border: 5px solid transparent;'>
        <div style='border-radius:30px 50px;background-color: black;border: 1px solid gray;'>
            <div style=" margin:0;">
                <div class="row">
                    <div style="position: relative;width: 100%;text-align:center;">
                        <img style="width: 10%;margin-top:10px" src=https://apps.biinsidecr.com/edecanes/logo.png>
                    </div>
                    <div style="position: relative;
                                height:40px;
                                background-color: black;
                                border-radius:30px 50px;
                                color:white;
                                text-align:center;
                                font-size: 40px;">
                        Bussiness
                    </div>
                </div>
            </div>
            <br><br><br><br>
            <div style="padding-left:25px; padding-top:10px;padding-bottom:10px; color:white;font-size: 20px;">Nombre: {{$nombreEmpresa}}.</div>
            <div style="padding-left: 25px; margin-top:15px; color:white;font-size: 20px;">Cambio de contraseña procesado.</div>
            <br><br>
        </div>
    </div>

    <div style='border: 5px solid transparent;'>
        <div style='border-radius:30px 50px;border: 1px solid gray;background-color: #FDDD6E;margin-top:5px;color:white;'>
            <div style=" margin:0; ">
                <div style="position: relative;
                    height:60px;
                    background-color: #FDDD6E;
                    border-radius:30px 50px;
                    color:black;
                    text-align:center;
                    padding-top:20px;
                    padding-bottom:20px;
                    font-size: 26px;
                ">La nueva contraseña es:<br>{{$contra}}</div>
            </div>
        </div>
    </div>
</body>

</html>