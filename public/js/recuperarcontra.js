window.addEventListener('load', iniciar, false);

var usuario, btnCancelar;

function iniciar() {
    usuario = document.getElementById('txt_usuario');
    btnCancelar =document.getElementById('btn_cancelarRec');
    usuario.focus();
    btnCancelar.addEventListener('click',cancelar,false);
}

function cancelar(){
    window.location.href = getbaseurl();
}

function llenarForm(usu){
    document.getElementById('txt_usuario').value=usu;
}