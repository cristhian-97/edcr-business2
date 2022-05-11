window.addEventListener('load', inicial, false)
var activo;//saber en que pantalla estoy


function inicial() {
   alertify.set('notifier', 'position', 'top-right');
}
function getbaseurl() {
    var getUrl = window.location;
    return getUrl.protocol + "//" + getUrl.host;
}

function mensajeError(mensaje) {
    /*if (mensaje == 'Usuario inactivo.')
        document.getElementById('contenedorcentroderecha').innerHTML = "Usuario Inactivo. Por favor contacte un administrador.";
    else if (mensaje == 'Empresa inactiva.')
        document.getElementById('contenedorcentroderecha').innerHTML = "Empresa Inactiva. Por favor contacte un administrador.";
    else*/
    alertify.error(mensaje);
}

function mensajeExito(mensaje){
    alertify.success(mensaje);
}

//metodo validar la integridad y longitud de un string
function stringValido(cadena) {
    //revisar que no sea nulo
    if (!cadena || /^\s*$/.test(cadena)) {
        return false;
    }
    //revisar que no sean puros espacios
    if (cadena.length === 0 || !cadena.trim()) {
        return false;
    }
    return true;
}
function logitudCorrecta(cadena, tamanomax) {
    //revisar que no sobrepase tamano max
    if (cadena.length > tamanomax) {
        return false;
    }
    return true;
}
//https://stackoverflow.com/questions/46155/how-to-validate-an-email-address-in-javascript
function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}