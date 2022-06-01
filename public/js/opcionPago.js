window.addEventListener('load',iniciar,false);
var btn_pagoPaypal,btn_pagoDeposito;
var idEmpresa, comision;
var contenedorPago1,contenedorPago2,pago,contenedorCampos;

function iniciar(){
    comision = document.getElementById('comision');
    idEmpresa = document.getElementById('idEmpresa');

    pago = document.getElementById('pago');
    contenedorPago1 = document.getElementById('contenedorPago1');
    contenedorPago2 = document.getElementById('contenedorPago2');
    contenedorCampos = document.getElementById('contenedorCampos');
    
    btn_pagoPaypal=document.getElementById('btn_pagoPaypal');
    btn_pagoPaypal.addEventListener('click',pagoPaypal,false);
    btn_pagoDeposito = document.getElementById('btn_pagoDeposito');
    btn_pagoDeposito.addEventListener('click',pagoDeposito,false);
}

function pagoPaypal() {
    pago.setAttribute('hidden',true);
    contenedorCampos.removeAttribute('hidden');
    document.getElementById('btn_atrasCampos').removeAttribute('hidden');      
}
function irAPagoPaypal(){
    txtTelefono3 = document.getElementById('txtTelefono3');
    txtDireccion3 = document.getElementById('txtDireccion3');
    var errores = false;
    if(txtTelefono3!=null && !stringValido(txtTelefono3.value)){
       document.getElementById('errorTelefono3').removeAttribute('hidden');
       errores=true;
    }else
       document.getElementById('errorTelefono3').setAttribute('hidden',true);

    if(!errores){
        contenedorCampos.setAttribute('hidden',true);
        document.getElementById('btn_atrasCampos').setAttribute('hidden',true);
        document.getElementById('contenedorPago1').removeAttribute('hidden');
        document.getElementById('btn_atrasPago1').removeAttribute('hidden');    
    }
}

function envioPagoPaypal(afiliadoX,cliente,ordenX,id,create_time,update_time,intent,status,payer_id,email_address,country_code,
                         given_name,reference_id,value,currency_code,email_address2,merchant_id,full_name,address_line_1,
                         postal_code,country_code2,status2,id2,final_capture,create_time2,update_time2,value2,currency_code2,tipo,codigoUsuarioX){
    var form = new FormData();
    var tel = document.getElementById('txtTelefono3');
    var telE="";
    if(tel!=null && stringValido(tel.value))
       telE = tel.value;

    var adicE="";
    var adc = document.getElementById('txtDireccion3');
    if(adc!=null && stringValido(adc.value))
       adicE=adc.value;

    form.append('telefono',telE);
    form.append('adicional',adicE);    
    form.append('afiliado',afiliadoX);
    form.append('cliente',cliente);
    form.append('idOrden',ordenX);
    form.append('paypalId',id);
    form.append('creacion',create_time);
    form.append('edicion',update_time);
    form.append('intent',intent);
    form.append('estado',status);
    form.append('idComprador',payer_id);
    form.append('emailComprador',email_address);
    form.append('paisComprador',country_code);
    form.append('nombreComprador',given_name);
    form.append('undId',reference_id);
    form.append('undValor',value);
    form.append('undMoneda',currency_code);
    form.append('undEmail',email_address2);
    form.append('undMerchant',merchant_id);
    form.append('dirComprador',full_name);
    form.append('dirDireccion',address_line_1);
    form.append('dirPostal',postal_code);
    form.append('dirPais',country_code2);
    form.append('pagoEstado',status2);
    form.append('pagoId',id2);
    form.append('pagoCapture',final_capture);
    form.append('pagoCreacion',create_time2);
    form.append('pagoEdicion',update_time2);
    form.append('pagoValor',value2);
    form.append('pagoMoneda',currency_code2);
    form.append('tipo',tipo);
    form.append('codigoUsuario',codigoUsuarioX);
    axios.post('paypal', form)
    .then(function (response) {
        $("#divLoader").removeClass("is-active");
        console.log(response.data);
        if(response.data=='Error al registrar el pago. Por favor intente mas tarde.'){
            new Noty({
              theme: 'metroui',
              layout: 'topLeft',
              type: 'warning',
              text: "Se procesó la transacción, pero el pago no se registró. Notifique al comercio."
            }).show();
        }else{
        new Noty({
              theme: 'metroui',
              type: 'success',
              layout: 'topCenter',
              text: "Su pago se realizo correctamente, espere unos segundos y será redireccionado."
            }).show();
            espera();
        }
    }).catch(function (error) {
        $("#divLoader").removeClass("is-active");
        new Noty({
              theme: 'metroui',
              layout: 'topLeft',
              type: 'warning',
              text: "Se procesó la transacción, pero el pago no se registró. Notifique al comercio."
            }).show();
    })    
}

function pagoDeposito(){
    pago.setAttribute('hidden',true);
    contenedorPago2.removeAttribute('hidden');
    document.getElementById('btn_atrasPago2').removeAttribute('hidden');
}

function volverPago1(){
    contenedorPago1.setAttribute('hidden', true);
    document.getElementById('btn_atrasPago1').setAttribute('hidden',true);
    contenedorCampos.removeAttribute('hidden');
    document.getElementById('btn_atrasCampos').removeAttribute('hidden');
}

function volverPago2(){
    contenedorPago2.setAttribute('hidden', true);
    document.getElementById('btn_atrasPago2').setAttribute('hidden',true);
    pago.removeAttribute('hidden');    
}

function volverCamposPago(){
    contenedorCampos.setAttribute('hidden', true);
    document.getElementById('btn_atrasCampos').setAttribute('hidden',true);
    pago.removeAttribute('hidden'); 
}

function registroPagoDeposito(){
    txtTelefono2 = document.getElementById('txtTelefono2');
    txtDireccion = document.getElementById('txtDireccion');
    txtComprobante = document.getElementById('txtComprobante');
    var errores = false;
    if(txtTelefono2!=null && !stringValido(txtTelefono2.value)){
       document.getElementById('errorTelefono2').removeAttribute('hidden');
       errores=true;
    }else
       document.getElementById('errorTelefono2').setAttribute('hidden',true);

    if(txtComprobante!=null && !stringValido(txtComprobante.value)){
        document.getElementById('errorComprobante').removeAttribute('hidden');
        errores=true;
     }else
        document.getElementById('errorComprobante').setAttribute('hidden',true);              

    if(!errores){
        var form = new FormData();
        
        var empresa = document.getElementById('idEmpresa').value==""?"0":document.getElementById('idEmpresa').value;
        //var comision = document.getElementById('comision').value;

        form.append('empresa', empresa);
        //form.append('comision',comision);
        form.append('telefono',document.getElementById('txtTelefono2').value);
        form.append('direccion',document.getElementById('txtDireccion').value);
        form.append('comprobante',document.getElementById('txtComprobante').value);
        form.append('tipo','registro');

        axios.post('pagoDeposito', form)
            .then(function (response) {
                if(response.data=="Exito"){
                    alertify.set('notifier','position', 'top-right');                
                    alertify.success("Registro realizado exitosamente. Espere unos segundos y será redireccionado.");
                    espera();
                }else if(response.data=="Error"){
                    alertify.set('notifier','position', 'top-right');                
                    alertify.success("Error al registrar el comprobante de pago.");
                }                 
            }).catch(function (error) {
                alertify.set('notifier','position', 'top-right');
                alertify.error('Ocurrio un error interno al registrar el depósito. Por favor intente mas tarde.');
            })
    }
}

function getbaseurl() {
    var getUrl = window.location;
    return getUrl.protocol + "//" + getUrl.host;
}
function espera(){
    setTimeout(function(){
        window.location.href = getbaseurl()+'/dashboard';
    },2000);
}