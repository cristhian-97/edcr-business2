window.addEventListener('load',iniciar,false);
var frm, nombreEmpresa, cedEmpresa, telefonoEmpresa, usuario, contrasena, confContrasena, direccion, btnCancelar, btnRegistrar;
var nombreEncargado, cedEncargado, correoEncargado, telEncargado;

function iniciar(){
    //frm = document.getElementById('formRegistro');
    nombreEmpresa = document.getElementById('txtNombreEmpresa');
    cedEmpresa = document.getElementById('txtCedulaEmpresa');
    telefonoEmpresa = document.getElementById('txtTelefonoEmpresa');
    usuario = document.getElementById('txtUsuario');
    contrasena = document.getElementById('txtContrasena');
    confContrasena = document.getElementById('txtConfContrasena');
    direccion = document.getElementById('txtDireccion');

    nombreEncargado = document.getElementById('txtNombreEncargado');
    cedEncargado = document.getElementById('txtCedulaEncargado');
    correoEncargado = document.getElementById('txtCorreoEncargado');
    telEncargado = document.getElementById('txtTelefonoEncargado');

    btnCancelar =  document.getElementById('btn_cancelar');
    btnRegistrar = document.getElementById('btn_registrar');

    //frm.addEventListener('submit', function(event) { validarForm(event)});
    nombreEmpresa.focus(); 
    btnCancelar.addEventListener('click',cancelar,false);   
}

function cancelar(){
    window.location.href = getbaseurl();
}

function validarForm(event){
    e = event;
    if(!stringValido(nombreEmpresa.value) || !stringValido(cedEmpresa.value) || !stringValido(telefonoEmpresa.value) || !stringValido(usuario.value) ||
     !stringValido(direccion.value) || !stringValido(contrasena.value) || !stringValido(nombreEncargado.value) || !stringValido(cedEncargado.value) 
     || !stringValido(correoEncargado.value) || !stringValido(telEncargado.value) ){
        e.preventDefault();
        alertify.error("Debe llenar todos los campos");
    }

    if(!logitudCorrecta(nombreEmpresa.value,255) || !logitudCorrecta(cedEmpresa.value,42) || !logitudCorrecta(telefonoEmpresa.value,25) || !logitudCorrecta(usuario.value,128)
        || !logitudCorrecta(contrasena.value,25) || !logitudCorrecta(direccion.value,255) ||!logitudCorrecta(nombreEncargado.value,255) || !logitudCorrecta(cedEncargado.value,42)
        || !logitudCorrecta(correoEncargado.value,128) || !!logitudCorrecta(telefonoEmpresa.value,25))
        e.preventDefault();        
    if(!logitudCorrecta(nombreEmpresa.value,255))
        alertify.error("Caracteres permitidos en el nombre de la Empresa: 255");
    if(!logitudCorrecta(nombreEncargado.value,70))
        alertify.error("Caracteres permitidos en el nombre del Encargado: 70");        
    if(!logitudCorrecta(cedEmpresa.value,42))
        alertify.error("Caracteres permitidos en la cédula: 42");
    if(!logitudCorrecta(cedEncargado.value,42))
        alertify.error("Caracteres permitidos en la cédula: 42");        
    if(!logitudCorrecta(telefonoEmpresa.value,25))
        alertify.error("Caracteres permitidos en el teléfono: 25");
    if(!logitudCorrecta(usuario.value,128))
        alertify.error("Caracteres permitidos en el usuario: 128");
    if(!logitudCorrecta(correoEncargado.value,128))
        alertify.error("Caracteres permitidos en el correo del Encargado : 128");
    if(!logitudCorrecta(telEncargado.value,25))
        alertify.error("Caracteres permitidos en el teléfono: 25");        
    if(!logitudCorrecta(contrasena.value,25))
        alertify.error("Caracteres permitidos en la contraseña: 25");
    if(!logitudCorrecta(direccion.value,255))
        alertify.error("Caracteres permitidos en la dirección: 255");                              
    if(contrasena.value != confContrasena.value){
        e.preventDefault();
        alertify.error("La contraseña ingresada no coincide con el campo de confirmación");
    }
    if(!validateEmail(usuario.value) && stringValido(usuario.value)){
        e.preventDefault();
        alertify.error('Correo invalido');
    }
    if(!validateEmail(correoEncargado.value) && stringValido(correoEncargado.value)){
        e.preventDefault();
        alertify.error('Correo invalido');
    }
}

function llenarForm(nomb,cedJur,tel,usu,contra,dir,nombEnc, cedEnc,corEnc,telEnc){
    document.getElementById('txtNombreEmpresa').value=nomb;
    document.getElementById('txtCedulaEmpresa').value=cedJur;
    document.getElementById('txtTelefono').value=tel;
    document.getElementById('txtUsuario').value=usu;
    document.getElementById('txtContrasena').value=contra;
    document.getElementById('txtConfContrasena').value = contra;
    document.getElementById('txtDireccion').value=dir;

    document.getElementById('txtNombreEncargado').value=nombEnc;
    document.getElementById('txtCedulaEncargado').value=cedEnc;
    document.getElementById('txtCorreoEncargado').value=corEnc;
    document.getElementById('txtTelefonoEncargado').value=telEnc;
}