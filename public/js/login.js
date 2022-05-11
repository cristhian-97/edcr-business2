window.addEventListener('load', iniciar, false);
var usuario, btnRegistro, lblRecuperarContra; 

function iniciar() {
    usuario = document.getElementById('txt_usuario');
    btnRegistro = document.getElementById('btn_registro');
    lblRecuperarContra = document.getElementById('lbl_RecuperarContra');
    usuario.focus();
    btnRegistro.addEventListener('click',registrar,false);
    lblRecuperarContra.addEventListener('click',olvidoContra,false);

}

function registrar() {
    window.location.href = getbaseurl() + '/empresa/registro';
}

function olvidoContra() {
    window.location.href = getbaseurl() + '/recuperarContra';
}

function llenarForm(user,cont){
    document.getElementById('txt_usuario').value=user;
    document.getElementById('txt_password').value=cont;
}