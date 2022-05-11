window.addEventListener('load',iniciar,false);
var btn_cancelar;
var idCategoria;

function iniciar(){
    btn_cancelar=document.getElementById('btn_cancelar');
    btn_cancelar.addEventListener('click',cancelar,false);
    idCategoria = document.getElementById('idCategoria');
}

function cancelar(){
    window.location.href = getbaseurl()+'/categorias';
}
function getbaseurl() {
    var getUrl = window.location;
    return getUrl.protocol + "//" + getUrl.host;
}