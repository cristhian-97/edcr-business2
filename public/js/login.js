window.addEventListener('load', iniciar, false);
var usuario, btnRegistro, lblRecuperarContra;

function iniciar() {
    usuario = document.getElementById('txt_usuario');
    btnRegistro = document.getElementById('btn_registro2');
    lblRecuperarContra = document.getElementById('lbl_RecuperarContra');
    usuario.focus();
    btnRegistro.addEventListener('click',registrar,false);
    lblRecuperarContra.addEventListener('click',olvidoContra,false);
/*
    const btns = document.querySelectorAll('.btn');
    
    btns.forEach(btn => {
        btn.addEventListener('click',()=>{
            let ripple = document.createElement('span');
            let x = e.clientX - e.target.offsetLet;
            let y = e.clientY - e.target.offsetTop;

            ripple.style.left = x+'px';
            ripple.style.top = y+'px';

            btn.appendChild(ripple);
            setTimeout(()=>{
                ripple.remove();
            },700);
        })
    })*/
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