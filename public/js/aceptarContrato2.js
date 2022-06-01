function aceptarContrato(){
    contenedorCotizacion = document.getElementById('contenedorCotizacion');
    machoteContrato = document.getElementById('machoteContrato');

    contenedorCotizacion.setAttribute('hidden', true);
    machoteContrato.removeAttribute('hidden');
}

function aceptarContrato2(){
    contenedorCotizacion = document.getElementById('contenedorCotizacion');
    machoteContrato = document.getElementById('machoteContrato');

    contenedorCotizacion.setAttribute('hidden', true);
    machoteContrato.removeAttribute('hidden');

    var nombreCliente = document.getElementById('nombreCliente').value;
    var nombreEvento = document.getElementById('nombreEvento').value;
    var fecha = document.getElementById('fecha').value;
    var hora = document.getElementById('hora').value;
    var nombreLugar = document.getElementById('nombreLugar').value;
    var nombreCategoria = document.getElementById('nombreCategoria').value;

    var correoEmpresa = document.getElementById('correoEmpresa').value;
    var empresa = document.getElementById('empresa').value;
    var categoria = document.getElementById('categoria').value;
    var cliente = document.getElementById('cliente').value;
    var cotizacion = document.getElementById('cotizacion').value;
    espera2(nombreCliente,nombreEvento,fecha,hora,nombreLugar,nombreCategoria,correoEmpresa,empresa,categoria,cliente,cotizacion);    
}

function acuerdo(){
    alertify.set('notifier','position', 'top-right');
    alertify.success("Notificando a la empresa");
    //machoteContrato = document.getElementById('machoteContrato');

    //machoteContrato.setAttribute('hidden',true);
    //contain = document.getElementsByClassName('container-fluid')[0];
    //contain.style.background="#000000";
    var nombreCliente = document.getElementById('nombreCliente').value;
    var nombreEvento = document.getElementById('nombreEvento').value;
    var fecha = document.getElementById('fecha').value;
    var hora = document.getElementById('hora').value;
    var nombreLugar = document.getElementById('nombreLugar').value;
    var nombreCategoria = document.getElementById('nombreCategoria').value;

    var correoEmpresa = document.getElementById('correoEmpresa').value;
    var empresa = document.getElementById('empresa').value;
    var categoria = document.getElementById('categoria').value;
    var cliente = document.getElementById('cliente').value;
    var cotizacion = document.getElementById('cotizacion').value;
    espera(nombreCliente,nombreEvento,fecha,hora,nombreLugar,nombreCategoria,correoEmpresa,empresa,categoria,cliente,cotizacion);
}

function espera(nombreCliente,nombreEvento,fecha,hora,nombreLugar,nombreCategoria,correoEmpresa,empresa,categoria,cliente,cotizacion){
    setTimeout(function(){
        notificarEmpresa(nombreCliente,nombreEvento,fecha,hora,nombreLugar,nombreCategoria,correoEmpresa,empresa,categoria,cliente,cotizacion);
    },100);
}

function espera2(nombreCliente,nombreEvento,fecha,hora,nombreLugar,nombreCategoria,correoEmpresa,empresa,categoria,cliente,cotizacion){
    setTimeout(function(){
        notificarEmpresaXCandidato(nombreCliente,nombreEvento,fecha,hora,nombreLugar,nombreCategoria,correoEmpresa,empresa,categoria,cliente,cotizacion);
    },100);
}

function desacuerdo(){
    machoteContrato = document.getElementById('machoteContrato');
    contenedorCotizacion = document.getElementById('contenedorCotizacion'); 

    machoteContrato.setAttribute('hidden',true);
    contenedorCotizacion.removeAttribute('hidden');
}

function volverPago(){
    contenedorPago = document.getElementById('contenedorPago');
    btn_atrasPago = document.getElementById('btn_atrasPago');
    contenedorCotizacion = document.getElementById('contenedorCotizacion');

    contenedorPago.setAttribute('hidden', true);
    btn_atrasPago.setAttribute('hidden', true);
    contenedorCotizacion.removeAttribute('hidden'); 
    contain = document.getElementsByClassName('container-fluid')[0];
    contain.style.background="linear-gradient(rgb(0, 0, 0) 10%, rgb(54, 70, 78))";  
}

function notificarEmpresa(nombreCliente,nombreEvento,fechaEvento,horaEvento,nombreLugar,nombreCategoria,correoEmpresa,empresa,categoria,cliente,cotizacion){
    var form = new FormData();
    form.append('nombreCliente',nombreCliente);  
    form.append('nombreEvento',nombreEvento);
    form.append('fechaEvento',fechaEvento);
    form.append('horaEvento',horaEvento);
    form.append('nombreLugar',nombreLugar);
    form.append('nombreCategoria',nombreCategoria);
    form.append('correoEmpresa',correoEmpresa);

    form.append('empresa',empresa);
    form.append('categoria',categoria);
    form.append('cliente',cliente);
    form.append('cotizacion',cotizacion);
    
    axios.post('notificarEmpresa', form)
        .then(function (response) {
            alertify.set('notifier','position', 'top-right');
            alertify.success(response.data);
        }).catch(function (error) {
              alertify.set('notifier','position', 'top-right');
              alertify.error('Ocurrio un error interno al enviar los correos. Por favor intente mas tarde.');
    })
}
//
function notificarEmpresaXCandidato(nombreCliente,nombreEvento,fechaEvento,horaEvento,nombreLugar,nombreCategoria,correoEmpresa,empresa,categoria,cliente,cotizacion){
    var form = new FormData();
    form.append('nombreCliente',nombreCliente);  
    form.append('nombreEvento',nombreEvento);
    form.append('fechaEvento',fechaEvento);
    form.append('horaEvento',horaEvento);
    form.append('nombreLugar',nombreLugar);
    form.append('nombreCategoria',nombreCategoria);
    form.append('correoEmpresa',correoEmpresa);

    form.append('empresa',empresa);
    form.append('categoria',categoria);
    form.append('cliente',cliente);
    form.append('cotizacion',cotizacion);
    
    axios.post('notificarEmpresaXCandidato', form)
        .then(function (response) {
            alertify.set('notifier','position', 'top-right');
            alertify.success(response.data);
        }).catch(function (error) {
              alertify.set('notifier','position', 'top-right');
              alertify.error('Ocurrio un error interno al enviar los correos. Por favor intente mas tarde.');
    })
}