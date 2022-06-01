window.addEventListener('load',iniciar,false);
var btn_pagoPaypal,btn_pagoDeposito;
var idEmpresa, comision;
var contenedorPago1,contenedorPago2,pago,contenedorCampos;

function iniciar(){
    comision = document.getElementById('comision');
    idEmpresa = document.getElementById('idEmpresa');
    console.log(comision.value);

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
        contenedorPago1.removeAttribute('hidden');
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

    var catE="";
    var idCategoriaX = document.getElementById('categoria');
    if(idCategoriaX!=null && stringValido(idCategoriaX.value))
       catE = idCategoriaX.value;

    var cotE="";
    var idCotizacion = document.getElementById('cotizacion');
    if(idCotizacion!=null && stringValido(idCotizacion.value))
       cotE = idCotizacion.value;

    var canE="";
    var idCandidato = document.getElementById('candidato');
    if(idCandidato!=null && stringValido('candidato'))
       canE=idCandidato.value;   

    form.append('telefono',telE);
    form.append('adicional',adicE);
    form.append('cotizacion',cotE);
    form.append('candidato',canE);
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
    form.append('categoria',catE);
    /*console.log('telefono '+telE);
    console.log('adicional '+adicE);
    console.log('afiliado '+afiliadoX);
    console.log('cliente '+cliente);
    console.log('idOrden '+ordenX);
    console.log('paypalId '+id);
    console.log('creacion '+create_time);
    console.log('edicion '+update_time);
    console.log('intent '+intent);
    console.log('estado '+status);
    console.log('idComprador '+payer_id);
    console.log('emailComprador '+email_address);
    console.log('paisComprador '+country_code);
    console.log('nombreComprador '+given_name);
    console.log('undId '+reference_id);
    console.log('undValor '+value);
    console.log('undMoneda '+currency_code);
    console.log('undEmail '+email_address2);
    console.log('undMerchant '+merchant_id);
    console.log('dirComprador '+full_name);
    console.log('dirDireccion '+address_line_1);
    console.log('dirPostal '+postal_code);
    console.log('dirPais '+country_code2);
    console.log('pagoEstado '+status2);
    console.log('pagoId '+id2);
    console.log('pagoCapture '+final_capture);
    console.log('pagoCreacion '+create_time2);
    console.log('pagoEdicion '+update_time2);
    console.log('pagoValor '+value2);
    console.log('pagoMoneda '+currency_code2);
    console.log('tipo '+tipo);
    console.log('codigoUsuario '+codigoUsuarioX);
    console.log('categoria '+catE);
    console.log('cotizacion '+cotE);*/

    axios.post('paypal2', form)
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
            if(response.data=="preregistrado"){
                new Noty({
                    theme: 'metroui',
                    type: 'success',
                    layout: 'topCenter',
                    text: "El pago que desea hacer no se realizó, debido a que ya el pago se encuentra registrado."
                }).show();
            }else{
                new Noty({
                    theme: 'metroui',
                    type: 'success',
                    layout: 'topCenter',
                    text: "Su pago se realizo correctamente."
                }).show();
            }
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
    opc = document.getElementById('opcion');
    var errores = false;
    if(txtTelefono2!=null && !stringValido(txtTelefono2.value)){
       document.getElementById('errorTelefono2').removeAttribute('hidden');
       errores=true;
    }else
       document.getElementById('errorTelefono2').setAttribute('hidden',true);
    
    if(opc!=null && opc.value=="candidato"){
        if(txtComprobante!=null && !stringValido(txtComprobante.value)){
            document.getElementById('errorComprobante').removeAttribute('hidden');
            errores=true;
         }else
            document.getElementById('errorComprobante').setAttribute('hidden',true);        
    }

    if(!errores){
        var form = new FormData();
        
        var empresa = document.getElementById('idEmpresa').value==""?"0":document.getElementById('idEmpresa').value;
        //var comision = document.getElementById('comision').value;
        form.append('empresa', empresa);
        //form.append('comision',comision);
        form.append('telefono',document.getElementById('txtTelefono2').value);
        form.append('direccion',document.getElementById('txtDireccion').value);
        form.append('comprobante',document.getElementById('txtComprobante').value);
        form.append('tipo','cotizacion');
        axios.post('pagoDeposito', form)
            .then(function (response) {
                if(response.data=="Exito"){
                    alertify.set('notifier','position', 'top-right');                
                    alertify.success("Registro realizado exitosamente.");
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