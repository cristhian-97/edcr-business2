window.addEventListener('load', iniciar, false);
var rdCedulaFisica, rdCedulaJuridica, tipoCedula;

function iniciar() {
    rdCedulaFisica = document.getElementById('rdCedulaFisica');
    rdCedulaJuridica = document.getElementById('rdCedulaJuridica');
    tipoCedula = document.getElementById('tipoCedula');
    if(tipoCedula.value=="1")
       document.querySelector('#rdCedulaFisica').checked = true;
    else
       document.querySelector('#rdCedulaJuridica').checked = true;
}