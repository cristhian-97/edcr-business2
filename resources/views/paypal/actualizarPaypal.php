<?php include 'conexion.php';?>

<?php
    header('Content-type: application/json');
    
    if(isset($_POST["id"])){
        $id = $_POST["id"];
    }
    else $id = "";

    if(isset($_POST["telefono"])){
        $telefono = $_POST["telefono"];
    }
    else $telefono = "";

    if(isset($_POST["adicional"])){
        $adicional = $_POST["adicional"];
    }
    else $adicional = "";

    try {
        /*Aquí se actualiza la orden respectiva despues de hacer el pago en paypal, pasa de 2 a 0, para indicar que ya se pagó*/
        $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos; charset=utf8", $usuario, $contrasena); //Abrir la conexion con la BD
        $consulta = $conexion->prepare('CALL `sp_ActualizarPaypalData`(?,?,?)'); //Hacer la consulta
    	$consulta->bindValue(1, $id, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(2, $telefono, PDO::PARAM_STR);//Parametros
        $consulta->bindValue(3, $adicional, PDO::PARAM_STR);//Parametros
        $datosRegistrados = $consulta->execute(); //Habilitar la consulta
        
        if($datosRegistrados == 1){//Si lo registra
            echo 1;
        }
        else{
            echo 0;
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
?> 