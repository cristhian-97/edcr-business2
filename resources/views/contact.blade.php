<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Contacto</h1>

    <form action="{{ $url }}" method="post" target="_blank">
        {{csrf_field()}}
        <input type="text" name="nombre" value="Jose" hidden>
        <button type="submit">Click me</button>
    </form>
</body>
</html>