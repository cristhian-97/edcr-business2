<?php 

	/* Evitar a intrusos accesar a este archivo */
    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
        /* 
           HEADER, SE PODRIA USAR UN 404 ANQUE EXISTA EL ARCHIVO, POR SEGURIDAD
        */
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );

        /* ESCOGEMOS LA DIRECCION DONDE REENVIAREMOS AL USUARIO */
        die( header( 'location: /error.php' ) );
    }

	$servidor = env('DB_HOST');
	$usuario = env('DB_USERNAME');
	$contrasena = env('DB_PASSWORD');
	$basededatos = env('DB_DATABASE');
	
	/*function utf8ize($d) {
	    if (is_array($d)) {
	        foreach ($d as $k => $v) {
	            $d[$k] = utf8ize($v);
	        }
	    } else if (is_string ($d)) {
	        return utf8_encode($d);
	    }
	    return $d;
	} */

?>