window.addEventListener('load',iniciar,false);
var btn_cancelar,btn_cotizar,btn_cancelarCotizacion,btn_cancelarContactar,btn_atrasPerfil,btn_atrasPago;
var contenedorCotizacion,contenedorCategoria,contenedorCandidatos,contenedorPago;
var txtColorOjos,txtMedidas,txtCalzado1,txtCalzado2,txtPeso1,txtPeso2,txtAltura1,txtAltura2,txtHoras,txtInstPrincipal, txtInstSecundario;
var txtLugar,txtFuncion,nombreCategoria,txtCantidad;
var txtDireccion, txtCursos, txtSobreMi, txtDemosMusicos, txtDemosDj;
var chkCalzado, chkPeso, chkAltura, chkFrenillos, chkTattos, chkPasaporte, chkLicencia,chkCompositor,chkLuces, chkEquipoSonido,chkEquipoPropio;
var slTipoCabello, slIdioma,slIdioma2, slUniforme,slGradoAcademico,slTipoFacturacion;
var idCategoria,precioCategoria;
var areasTrabajo;
var contenedorContactar,contenedorPerfil,perfil;
var clienteList = [];
var nombresAEnviar= [];
var correosDestinos = [];
var datosList = [];
var posActual=0;
var areasT = [];
var precioComision;

function iniciar(){
    btn_cancelar=document.getElementById('btn_cancelar');
    btn_cancelar.addEventListener('click',cancelar,false);
    btn_cancelarCotizacion = document.getElementById('btn_cancelarCotizacion');
    btn_cancelarCotizacion.addEventListener('click',cancelarCotizacion,false);
    contenedorCotizacion = document.getElementById('contenedorCotizacion');
    contenedorCategoria = document.getElementById('contenedorCategoria');
    contenedorContactar = document.getElementById('contenedorContactar');
    contenedorPerfil = document.getElementById('contenedorPerfil');
    perfil = document.getElementById('perfil');
    contenedorPago = document.getElementById('contenedorPago');
    btn_atrasPerfil = document.getElementById('btn_atrasPerfil');
    btn_atrasPerfil.addEventListener('click',volverPerfil,false);
    btn_atrasPago = document.getElementById('btn_atrasPago');
    btn_atrasPago.addEventListener('click',volverPago,false);

    precioComision = document.getElementById('comision');
    
    txtColorOjos = document.getElementById('txtColorOjos');
    txtMedidas = document.getElementById('txtMedidas');
    txtCalzado1 = document.getElementById('txtCalzado1');
    txtCalzado2 = document.getElementById('txtCalzado2');
    txtPeso1 = document.getElementById('txtPeso1');
    txtPeso2 = document.getElementById('txtPeso2');
    txtAltura1 = document.getElementById('txtAltura1');
    txtAltura2 = document.getElementById('txtAltura2');
    txtHoras = document.getElementById('txtHoras');
    txtLugar = document.getElementById('txtLugar');
    txtFuncion = document.getElementById('txtFuncion');
    nombreCategoria = document.getElementById('nombreCategoria');
    txtCantidad = document.getElementById('txtCantidad');
    
    slGradoAcademico = document.getElementById('slGradoAcademico');

    chkCalzado=document.getElementById('chkCalzado');
    chkPeso= document.getElementById('chkPeso');
    chkAltura =document.getElementById('chkAltura');

    slTipoCabello = document.getElementById('slTipoCabello');
    slIdioma = document.getElementById('slIdioma');
    slIdioma2 = document.getElementById('slIdioma2');
    slUniforme = document.getElementById('slUniforme');
    slTipoFacturacion = document.getElementById('slTipoFacturacion');
    

    chkFrenillos = document.getElementById('chkFrenillos');
    chkTattos = document.getElementById('chkTattos');
    chkPasaporte = document.getElementById('chkPasaporte');
    chkLicencia = document.getElementById('chkLicencia');

    chkEquipoPropio = document.getElementById('chkEquipoPropio');
    chkLuces = document.getElementById('chkLuces');
    chkEquipoSonido = document.getElementById('chkEquipoSonido');

    chkCompositor = document.getElementById('chkCompositor');

    txtInstPrincipal = document.getElementById('txtInstPrincipal');
    txtInstSecundario = document.getElementById('txtInstSecundario');     

    idCategoria = document.getElementById('idCategoria');
    precioCategoria = document.getElementById('precioCategoria');
    btn_cotizar = document.getElementById('btn_cotizar');
    btn_cotizar.addEventListener('click',cotizar,false);

    txtDireccion = document.getElementById('txtDireccion');
    txtCursos = document.getElementById('txtCursos');
    txtSobreMi = document.getElementById('txtSobreMi');
    txtDemosMusicos = document.getElementById('txtDemosMusicos');
    txtDemosDj = document.getElementById('txtDemosDj');
    
    contenedorCandidatos =  document.getElementById('contenedorCandidatos');

    var idEmpresa = document.getElementById('idEmpresa');

    console.log(idCategoria.value);
}

function cancelar(){
    window.location.href = getbaseurl()+'/categorias';
}
function getbaseurl() {
    var getUrl = window.location;
    return getUrl.protocol + "//" + getUrl.host;
}

function checkCalzado(obj){
    if(obj.checked){
      txtCalzado2.disabled=false;
      document.getElementById('errorCalzado').setAttribute('hidden',true);
    }else{
       txtCalzado2.value="";
       txtCalzado2.disabled=true;
       document.getElementById('errorCalzado').setAttribute('hidden',true);
    }
}
function checkPeso(obj){
    if(obj.checked){
      txtPeso2.disabled=false;
      document.getElementById('errorPeso').setAttribute('hidden',true);
    }else{
       txtPeso2.value="";
       txtPeso2.disabled=true;
       document.getElementById('errorPeso').setAttribute('hidden',true);
    }
}
function checkAltura(obj){
    if(obj.checked){
      txtAltura2.disabled=false;
      document.getElementById('errorAltura').setAttribute('hidden',true);  
    }else{
       txtAltura2.value="";
       txtAltura2.disabled=true;
       document.getElementById('errorAltura').setAttribute('hidden',true);
    }
}

function checkAreas(obj){
    var areasTodas = document.getElementsByClassName('chkAT');
    if(areasTodas!=null && areasTodas.length>0){
        for(var a=0; a<areasTodas.length; a++)
            areasTodas[a].checked=obj.checked;
    }        
}
function checkTodosDeportes(obj){
    var deportesTodos = document.getElementsByClassName('chkDep');
    if(deportesTodos!=null && deportesTodos.length>0){
        for(var a=0; a<deportesTodos.length; a++)
            deportesTodos[a].checked=obj.checked;
    }
}

function checkTodosEquipos(obj){
    var equiposTodos = document.getElementsByClassName('chkEqu');
    if(equiposTodos!=null && equiposTodos.length>0){
        for(var a=0; a<equiposTodos.length; a++)
            equiposTodos[a].checked=obj.checked;
    }
}

function checkTodaMusicas(obj){
    var musicasTodos = document.getElementsByClassName('chkMus');
    if(musicasTodos!=null && musicasTodos.length>0){
        for(var a=0; a<musicasTodos.length; a++)
            musicasTodos[a].checked=obj.checked;
    }
}

function checkGenerosMusicas(obj){
    var genMusicasTodos = document.getElementsByClassName('chkGMus');
    if(genMusicasTodos!=null && genMusicasTodos.length>0){
        for(var a=0; a<genMusicasTodos.length; a++)
            genMusicasTodos[a].checked=obj.checked;
    }
}
 
function cotizar() {
    var errores = false;
    if(!stringValido(txtHoras.value)){
       document.getElementById('errorHoras').removeAttribute('hidden');
       errores=true;
    }else
       document.getElementById('errorHoras').setAttribute('hidden',true);

    /*if(!stringValido(txtLugar.value)){
        document.getElementById('errorLugar').removeAttribute('hidden');
        errores=true;
    }else
        document.getElementById('errorLugar').setAttribute('hidden',true);

    if(!stringValido(txtFuncion.value)){
        document.getElementById('errorFuncion').removeAttribute('hidden');
        errores=true;
    }else
        document.getElementById('errorFuncion').setAttribute('hidden',true);*/

    if(slTipoFacturacion!=null && slTipoFacturacion.value=="0"){
        document.getElementById('errorTipoFacturacion').removeAttribute('hidden');
        errores=true;
    }else if(slTipoFacturacion!=null && slTipoFacturacion.value!="0")
        document.getElementById('errorTipoFacturacion').setAttribute('hidden',true);
        
    if(!stringValido(txtCantidad.value)){
        document.getElementById('errorCantidad').removeAttribute('hidden');
        errores=true;
    }else
        document.getElementById('errorCantidad').setAttribute('hidden',true);        
    
    if(txtCalzado1!=null && txtCalzado1.value!="" && txtCalzado2.value!="" && txtCalzado1.value>txtCalzado2.value){
       document.getElementById('errorCalzado').removeAttribute('hidden');
       errores=true;
    }else if(txtCalzado1!=null) 
       document.getElementById('errorCalzado').setAttribute('hidden',true);

    if(chkCalzado!=null && chkCalzado.checked && txtCalzado2.value==""){
       document.getElementById('errorCalzado2').removeAttribute('hidden');
       errores=true;
    }else if(chkCalzado!=null)
       document.getElementById('errorCalzado2').setAttribute('hidden',true);

    if(txtPeso1!=null && txtPeso1.value!="" && txtPeso2.value!="" && txtPeso1.value>txtPeso2.value){
        document.getElementById('errorPeso').removeAttribute('hidden');
        errores=true;
    }else if(txtPeso1!=null)
        document.getElementById('errorPeso').setAttribute('hidden',true);

    if(chkPeso!=null && chkPeso.checked && txtPeso2.value==""){
        document.getElementById('errorPeso2').removeAttribute('hidden');
        errores=true;
    }else if(chkPeso!=null)
        document.getElementById('errorPeso2').setAttribute('hidden',true);

    if(txtAltura1!=null && txtAltura1.value!="" && txtAltura2.value!="" && txtAltura1.value>txtAltura2.value){
        document.getElementById('errorAltura').removeAttribute('hidden');
        errores=true;
    }else if(txtAltura1!=null)
        document.getElementById('errorAltura').setAttribute('hidden',true);
        
    if(chkAltura!=null && chkAltura.checked && txtAltura2.value==""){
        document.getElementById('errorAltura2').removeAttribute('hidden');
        errores=true;
    }else if(chkAltura!=null)
        document.getElementById('errorAltura2').setAttribute('hidden',true);        

    if(!errores)
       cotizarCategoria();
}

function cotizarCategoria(){
    var form = new FormData();
    form.append('idCategoria',idCategoria.value);
    form.append('cantidad',txtCantidad.value);
    //Todas las categorías tienen áreas de trabajo. No hay problema para 
    var arrayAreasTrabajo = [];    
    var areasTrabajo = document.getElementsByClassName('chkAT');
    if(areasTrabajo!=null && areasTrabajo.length>0){
        for(var a=0; a<areasTrabajo.length; a++){
            if(areasTrabajo[a].checked)
                arrayAreasTrabajo.push(areasTrabajo[a].id);
        }
        if(arrayAreasTrabajo.length>0)
           form.append('idsAreasTrabajo',arrayAreasTrabajo);
    }
    
    if(txtColorOjos!=null && stringValido(txtColorOjos.value))
      form.append('color_ojos',txtColorOjos.value);

    if(txtMedidas!=null && Number(txtMedidas.value) )
      form.append('medidas',txtMedidas.value);

    if(txtCalzado1!=null && Number(txtCalzado1.value))
        form.append('calzado1',txtCalzado1.value);
    if(txtCalzado2!=null && Number(txtCalzado2.value))
        form.append('calzado2',txtCalzado2.value);        
    
    if(txtPeso1!=null && Number(txtPeso1.value))
       form.append('peso1',txtPeso1.value);
    if(txtPeso2!=null && Number(txtPeso2.value))
       form.append('peso2',txtPeso2.value);

    if(txtAltura1!=null&&Number(txtAltura1.value))
       form.append('altura1',txtAltura1.value);
    if(txtAltura2!=null&&Number(txtAltura2.value))
       form.append('altura2',txtAltura2.value);    

    if(txtDireccion!=null && stringValido(txtDireccion.value))
       form.append('direccion',txtDireccion.value);
       
    if(txtCursos!=null && stringValido(txtCursos.value))
       form.append('cursos',txtCursos.value);
       
    if(txtSobreMi!=null && stringValido(txtSobreMi.value))
       form.append('sobremi',txtSobreMi.value);              

    if(slGradoAcademico!=null && slGradoAcademico.value!="0")
       form.append('grado_academico',slGradoAcademico.value);

    if(slTipoCabello!=null && slTipoCabello.value!="0"){
        form.append('tipo_cabello',slTipoCabello.value);
        console.log(slTipoCabello.value);
    }      
    if(slIdioma!=null && slIdioma.value!="0")
        form.append('idioma',slIdioma.value);
    if(slUniforme!=null && slUniforme.value!="0")
        form.append('uniforme',slUniforme.value);
    
    if(chkFrenillos!=null)
        chkFrenillos.checked?form.append('frenillos','SI'):form.append('frenillos','NO');
        
    if(chkTattos!=null)
       chkTattos.checked?form.append('tattos','VISIBLE'):form.append('tattos','NO');
    if(chkPasaporte!=null)
       chkPasaporte.checked?form.append('pasaporte','SI'):form.append('pasaporte','NO');
    if(chkLicencia!=null)
       chkLicencia.checked?form.append('licencia','SI'):form.append('licencia','NO');
       
    var arrayDeportes = [];
    var deportes = document.getElementsByClassName('chkDep');
    if(deportes!=null && deportes.length>0){
        for(var a=0; a<deportes.length; a++){
            if(deportes[a].checked)
               arrayDeportes.push(deportes[a].id.normalize("NFD").replace(/[\u0300-\u036f]/g, ""));
        }
        if(arrayDeportes.length>0){
           form.append('descripcionDeportes',arrayDeportes);
           console.log(arrayDeportes);
        }
    }
    var arrayEquipos = [];
    var equipos = document.getElementsByClassName('chkEqu');
    if(equipos!=null && equipos.length>0){
        for(var a=0; a<equipos.length; a++){
            if(equipos[a].checked)
               arrayEquipos.push(equipos[a].id.normalize("NFD").replace(/[\u0300-\u036f]/g, ""));
        }
        if(arrayEquipos.length>0)
           form.append('descripcionEquipos',arrayEquipos); 
    }

    if(chkEquipoPropio!=null)
        chkEquipoPropio.checked?form.append('equipoPropio','PROPIO'):form.append('equipoPropio','NO');
    if(chkLuces!=null)
        chkLuces.checked?form.append('luces','SI'):form.append('luces','NO');
    if(chkEquipoSonido!=null)
        chkEquipoSonido.checked?form.append('equipoSonido','SI'):form.append('equipoSonido','NO');       

    if(txtDemosMusicos!=null && stringValido(txtDemosMusicos.value))
        form.append('demos',txtDemosMusicos.value);
    
    if(txtDemosDj!=null && stringValido(txtDemosDj.value))
        form.append('demos',txtDemosDj.value);                

    //descripcionGenMusicales
    var arrayGenMusicales = [];
    var genMusicales = document.getElementsByClassName('chkGMus');//Filtro para Dj
    if(genMusicales!=null && genMusicales.length>0){
        for(var a=0; a<genMusicales.length; a++){
            if(genMusicales[a].checked)
                arrayGenMusicales.push(genMusicales[a].id.normalize("NFD").replace(/[\u0300-\u036f]/g, ""));
        }
        if(arrayGenMusicales.length>0)
           form.append('descripcionGenMusicales',arrayGenMusicales); 
    }

    var arrayMusica = [];
    var musicas = document.getElementsByClassName('chkMus');//Filtro para Músicos
    if(musicas!=null && musicas.length>0){
        for(var a=0; a<musicas.length; a++){
            if(musicas[a].checked)
                arrayMusica.push(musicas[a].id.normalize("NFD").replace(/[\u0300-\u036f]/g, ""));
        }
        if(arrayMusica.length>0)
           form.append('descripcionMusicas',arrayMusica); 
    }
    //Filtro de equipo con el que debe contar, está almacenado en el campo musica de tbclientes, separados por .
    //Para la categoría de Dj la lista de géneros musicales se obtiene de tbgenerosmusicales y se compara con campo generosMusicales de tbclientes
    //Para la categoría de músicos la lista de géneros musicales se obtiene de tbmusica y se compara con comparo con musica, (TENGO QUE VALIDAR PORQUE
    //ESTE CAMPO TIENE ALMACENADO EQUIPO, Y HAY UN CAMPO DE EQUIPOlIST )
    if(chkCompositor!=null)
        chkCompositor.checked?form.append('compositor','SI'):form.append('compositor','NO');

    if(slIdioma2!=null && slIdioma2.value!="0")
        form.append('idioma',slIdioma2.value);

    if(txtInstPrincipal!=null && stringValido(txtInstPrincipal.value))
        form.append('instPrincipal',txtInstPrincipal.value);

    if(txtInstSecundario!=null && stringValido(txtInstSecundario.value))
        form.append('instSecundario',txtInstSecundario.value);

    axios.post('cotizar', form)
        .then(function (response) {
               mostrarResultadoCotizacion2(response.data);
        }).catch(function (error) {
              alertify.error(error.message);
              alertify.error('Ocurrio un error interno al intentar filtrar. Por favor intente mas tarde.');
    })
}

function cancelarCotizacion() {
    contenedorCotizacion.setAttribute('hidden', true);
    contenedorCategoria.removeAttribute('hidden');
    btn_cancelar.removeAttribute('hidden');
}

function mostrarResultadoCotizacion2(relaciones){
    contenedorCategoria.setAttribute('hidden',true);
    btn_cancelar.setAttribute('hidden',true);
    contenedorCotizacion.removeAttribute('hidden');
    contenedorCandidatos.innerHTML = '';
    idCat = idCategoria.value;
    precioCat = precioCategoria.value;
    var contador = 1;
    var errSLP = contador+"_error"; 
    clienteList = [];
    correosDestinos =[];
    datosList = [];
    areasT = [];

    nombresAEnviar= [];
    /*if(relaciones!="vacio"){
        console.log(relaciones);
    }else */if(relaciones!="vacio"){
        relaciones.forEach((value,i) => {
            value[2].forEach((atr) => {
                areasT.push(atr);
                
            });
                    var hoy = new Date();
                    var fec = hoy.getDate() + "/" + (hoy.getMonth() +1) + "/" + hoy.getFullYear();
                    
                    var importe=0;
                    importe = precioCat*txtHoras.value*value[1];  
                    
                    var disp = (txtCantidad.value=="1")?value[0]['disponibilidad']!=null?value[0]['disponibilidad']:"No":"";
                    var transp =(txtCantidad.value=="1")?value[0]['transporte']!=null?value[0]['transporte']:"No":"";
                    var nombres = "";
                    var enviarA="";
                    var usuarioEDCR="";
                    var comision=0;
                    var iva = importe*0.13;
                    
                    if (slTipoFacturacion.value=="edcr"){
                        nombres = '<td>EDCR</td>';
                        enviarA = '<td>edcr@gmail.com</td>';
                        usuarioEDCR+='<td>EDCR</td>';
                        comision= Number(precioComision.value);
                    }else if(slTipoFacturacion.value=="candidatos"){                        
                        value[0].forEach((cl) => {
                            nombres+= '<td>'+cl['nombreCliente']+'</td><br>';
                            enviarA+='<td>'+cl['correo']+'</td><br>';
                            usuarioEDCR+='<td>'+cl['nombreCliente']+'</td><br>';
                        });
                    }
                    var total = importe+comision+iva;
                    base = '<div class="baseCot">'
                                +'<div class="cotizacion">'
                                +'<div class="input-group mt-4">'
                                    +'<div class="col-md-6">'
                                        +'<div id="contenedorLogo">'
                                          +'<img id="logo" src='+"/img/logo.jpg"+'>'
                                        +'</div>'
                                    +'</div>'
                                    +'<div class="col-md-6" style="width: 100%;text-align:right;">'
                                        +'<label class="titulosArriba">COTIZACIÓN</label>'
                                    +'</div>'
                                +'</div><br>'
                                +'<div class="input-group mt-4 justificada">'
                                    +'<div class="col-md-3">'
                                        +'<label class="etiquetaNegra">Facturar a</label>'
                                    +'</div>'
                                    +'<div class="col-md-4">'
                                        +'<label class="etiquetaNegra">Enviar a</label>'
                                    +'</div>'
                                    +'<div class="col-md-3" style="width: 100%;text-align:right;">'
                                        +'<label class="etiquetaNegra">Cotización #</th>'
                                    +'</div>'
                                    +'<div class="col-md-2" style="width: 100%;text-align:right;">'
                                        +'<td>'+contador+'</td>'
                                    +'</div>'
                                +'</div>'
                                +'<div class="input-group mt-4 justificada">'
                                    +'<div class="col-md-3">';
                                        base += nombres;
                              base +='</div>'
                                    +'<div class="col-md-4">';
                                         base += enviarA;
                              base+= '</div>'
                                    +'<div class="col-md-3" style="width: 100%;text-align:right;">'
                                        +'<label class="etiquetaNegra">Fecha de la cotización</label>'
                                    +'</div>'
                                    +'<div class="col-md-2" style="width: 100%;text-align:right;">'
                                        +'<td>'+fec+'</td>'
                                    +'</div>'
                                +'</div>'
                                +'<div class="input-group mt-4 justificada">'
                                    +'<div class="col-md-3">'
                                       +'<label>Usuario EDCR: </label>'
                                    +'</div>'
                                    +'<div class="col-md-3">'; 
                                        base += usuarioEDCR;
                                    base+='</div>'
                                +'</div>'
                                +'<div class="input-group mt-4 justificada">'
                                    +'<div class="col-md-3">'
                                        +'<select class="btn" style="border-color:black" id='+contador+' required="">';
                                        
                                        value[0].forEach((cl) => {
                                                base+= '<option value='+cl['codigo']+'>'+cl['nombreCliente']+'</option>';
                                                clienteList.push(cl);
                                                correosDestinos.push([cl['correo'],contador,cl['nombreCliente']]);
                                                nombresAEnviar.push(['<td>'+cl['nombreCliente']+'</td><br>',contador]);
                                                console.log("codigo: "+cl['codigo']);
                                            });                                            
                                        base+='</select>'
                                        +'<label class="error '+errSLP+'" hidden>Seleccione el Candidato</label>'
                                    +'</div>'
                                    +'<div class="col-md-3">'
                                        +'<input type="button" value="Ver Perfil" name="btn_verPerfil" class="btn btn-success" onClick="verPerfil('+contador+')">'
                                    +'</div>'
                               +'</div>';                                
                               base+= '<br>'
                                +'<div class="input-group mt-4 justificada">'
                                    +'<table class="table">'
                                        +'<thead>'
                                            +'<th>CANT.</th>'
                                            +'<th>DESCRIPCIÓN</th>'
                                            +'<th>PRECIO UNITARIO</th>'
                                            +'<th>IMPORTE</th>'
                                        +'</thead>'
                                        +'<tbody>'
                                            +'<tr>'
                                                +'<td>'+value[1]+'</td>'
                                                +'<td>'
                                                    +'<label>Categoría: </label>'+nombreCategoria.value+'<br>'
                                                    +'<label>Lugar: </label>'+txtLugar.value+'<br>'
                                                    +'<label>Función: </label>'+txtFuncion.value+'<br>'
                                                    +'<label>Disponibilidad: </label>'+disp+'<br>'
                                                    +'<label>Transporte: </label>'+transp+'<br>'
                                                +'</td>'
                                                +'<td>'+precioCat+'</td><td>'+importe+'</td>'
                                            +'</tr>'
                                            +'<tr>'
                                               +'<td></td>'
                                               +'<td></td>'
                                               +'<td>Subtotal</td>'
                                               +'<td>'+importe+'</td>'
                                            +'</tr>'
                                                +'<tr>'
                                                +'<td></td>'
                                                +'<td></td>'
                                                +'<td>Comisión</td>'
                                                +'<td>'+comision+'</td>'
                                            +'</tr>'
                                            +'<tr>'
                                               +'<td></td>'
                                               +'<td></td>'
                                               +'<td>Valor Agregado 13.0%</td>'
                                               +'<td>'+iva+'</td>'
                                            +'</tr>'
                                            +'<tr>'
                                               +'<td></td>'
                                               +'<td></td>'
                                               +'<td><label class="etiquetaNegra2">TOTAL</label></td>'
                                               +'<td> <label class="etiquetaNegra2"> ₡'+total+'</label></td>'
                                            +'</tr>'
                                            +'<tr>'
                                                +'<td></td>'
                                                +'<td></td>'
                                                +'<td></td>'
                                                +'<td><input type="button" value="Aceptar Contratación" name="btn_contactar" class="btn btn-success" onClick="contactar('+contador+')"></td>'
                                            +'</tr>'                                            
                                        +'</tbody>'
                                    +'</table>'
                                +'</div><br><br>'
                            +'</div><br></div>';
                            datosList.push([contador,fec,value[1],nombreCategoria.value,txtLugar.value,txtFuncion.value,disp,transp,precioCat,importe,comision,iva,total]);
                            contador++;
        contenedorCandidatos.innerHTML += base;
        });
    }else{
       contenedorCandidatos.innerHTML='<div class="baseCategoria">'
                                            +'<div class="categoria"><br>'
                                                +'<h4>Sin resultados</h4><br>';
                                            +'</div>'
                                      +'</div>';
    }
}

function contactarCandidato(id){
    var form = new FormData();
    form.append('codigo',id);
    axios.post('contactar', form)
        .then(function (response) {
               mostrarContactar(response.data);
        }).catch(function (error) {
              alertify.error(error.message);
              alertify.error('Ocurrio un error interno al intentar filtrar. Por favor intente mas tarde.');
        })
}

function contactar(pos){
    posActual=pos;
    if(slTipoFacturacion.value=="edcr"){
        contenedorCotizacion.setAttribute('hidden', true);
        btn_cancelarCotizacion.setAttribute('hidden',true);
        btn_atrasPago.removeAttribute('hidden');
        contenedorPago.removeAttribute('hidden');
    }else
        contactar2();
}

function contactar2(){
    var pos = posActual;
    var form = new FormData();
    var arrayCorreos = [];
    var arrayNombres = [];
    for(var cr=0; cr<correosDestinos.length; cr++){
        if(correosDestinos[cr][1]==pos){
            arrayCorreos.push(correosDestinos[cr][0]);
            arrayNombres.push(correosDestinos[cr][2]);
        }
    }

    if(arrayCorreos.length>0)
       form.append('correos',arrayCorreos);
    if(arrayNombres.length>0)
       form.append('nombres',arrayNombres);
    
    form.append('numero',pos);
    var fech="";
    var cant="1";
    var nombreCat="";
    var lugar="";
    var funcion="";
    var disp2="";
    var transp2="";
    var precioCt="";
    var imprte="";
    var comsion="";
    var iva2="";
    var total2="";
    for(var d=0; d<datosList.length; d++){
        if(datosList[d][0]==pos){            
            fech=datosList[d][1];
            cant=datosList[d][2];
            nombreCat=datosList[d][3];
            lugar=datosList[d][4];
            funcion=datosList[d][5];
            disp2=datosList[d][6];
            transp2=datosList[d][7];
            precioCt=datosList[d][8];
            imprte=datosList[d][9];
            comsion=datosList[d][10];
            iva2=datosList[d][11];
            total2=datosList[d][12];
            break;
        }
    }
    
    form.append('fecha',fech);  
    form.append('cant',cant.toString());
    form.append('nombreCat',nombreCat);
    form.append('lugar',lugar!=null?lugar:'');
    form.append('funcion',funcion!=null?funcion:'');
    form.append('disp2',disp2);
    form.append('transp2',transp2);
    form.append('precioCt',precioCt.toString());
    form.append('imprte',imprte.toString());
    form.append('comsion',comsion.toString());
    
    form.append('iva2',iva2.toString());
    form.append('total2',total2.toString());
  
    axios.post('contactar', form)
        .then(function (response) {
            alertify.success(response.data);
        }).catch(function (error) {
              alertify.error('Ocurrio un error interno al enviar los correos. Por favor intente mas tarde.');
    })
}

function mostrarContactar(resultados){
    contenedorCotizacion.setAttribute('hidden', true);
    btn_cancelarCotizacion.setAttribute('hidden',true);
    contenedorContactar.removeAttribute('hidden');
    btn_cancelarContactar.removeAttribute('hidden');
    contenedorContactar.innerHTML = '';
    if(resultados!="vacio"){
        resultados.forEach((value,i) => {
            contenedorContactar.innerHTML+='<div class="baseCategoria">'
            +'<div class="categoria">'
                +'<table class="table">'
                    +'<tbody>'
                        +'<tr><td>Nombre</td><td>'+value['nombre']+'</td></tr>'
                    +'</tbody>'
                +'</table>'
                +'<br></div></div>'
        })
    }
}

function cancelarContactar(){
    contenedorContactar.setAttribute('hidden', true);
    btn_cancelarContactar.setAttribute('hidden', true);
    contenedorCotizacion.removeAttribute('hidden');
    btn_cancelarCotizacion.removeAttribute('hidden');
}

function volverPerfil(){
    contenedorPerfil.setAttribute('hidden', true);
    btn_atrasPerfil.setAttribute('hidden', true);
    contenedorCotizacion.removeAttribute('hidden');
    btn_cancelarCotizacion.removeAttribute('hidden');
}

function volverPago(){
    contenedorPago.setAttribute('hidden', true);
    btn_atrasPago.setAttribute('hidden', true);
    contenedorCotizacion.removeAttribute('hidden');
    btn_cancelarCotizacion.removeAttribute('hidden');
}

function verPerfil(idSLPerf){
    var slPerf =document.getElementById(idSLPerf);
    if(slPerf.value!="0"){
        contenedorCotizacion.setAttribute('hidden', true);
        btn_cancelarCotizacion.setAttribute('hidden',true);
        btn_atrasPerfil.removeAttribute('hidden');
        contenedorPerfil.removeAttribute('hidden');
        contenedorPerfil.innerHTML='';
        var cliente;
        
        for(var c=0; c<clienteList.length; c++){
            if(clienteList[c].codigo == slPerf.value){
               cliente = clienteList[c];
               break;
            }
        }        
        var imagenCliente = cliente['portada']!=null?'<img src='+cliente['portada']+' class="imgPerfil">':'';
        var nombreCLiente = cliente['nombreCliente']!=null?cliente['nombreCliente']:"";
        var correo = cliente['correo']!=null?cliente['correo']:"";
        var telefono = cliente['telefono']!=null?cliente['telefono']:"";
        var transporte = cliente['transporte']!=null?cliente['transporte']:"";
        var experiencia = cliente['experiencia']!=null?cliente['experiencia']:"";
        var disponibilidad = cliente['disponibilidad']!=null?cliente['disponibilidad']:"";
        var facturaelectronica = cliente['facturaelectronica']!=null?cliente['facturaelectronica']:"";
   
        var peso = cliente['peso']!=null?cliente['peso']:"";
        var altura = cliente['altura']!=null?cliente['altura']:"";
        var colorOjos = cliente['color_ojos']!=null?cliente['color_ojos']:"";
        var grado_academico = cliente['grado_academico']!=null?cliente['grado_academico']:"";
        var medidas = cliente['medidas']!=null?cliente['medidas']:"";
        var calzado = cliente['calzado']!=null?cliente['calzado']:"";
        var cabello = cliente['cabello']!=null?cliente['cabello']:"";
        var frenillos = cliente['frenillos']!=null?cliente['frenillos']:"";
        var tattos = cliente['tattos']!=null?cliente['tattos']:"";
        var idioma = cliente['idioma']!=null?cliente['idioma']:"";
        var uniforme = cliente['uniforme']!=null?cliente['uniforme']:"";
        var pasaporte= cliente['pasaporte']!=null?cliente['pasaporte']:"";
        var licencia = cliente['licencia']!=null?cliente['licencia']:"";

        var direccion = cliente['direccion']!=null?cliente['direccion']:"";
        var cursos = cliente['cursos']!=null?cliente['cursos']:"";
        var sobremi = cliente['sobre_mi']!=null?cliente['sobre_mi']:"";
        var demos = cliente['demos']!=null?cliente['demos']:"";
   
        var instPrincipal = cliente['instPrincipal']!=null?cliente['instPrincipal']:"";
        var instSecundario = cliente['instSecundario']!=null?cliente['instSecundario']:"";
        var compositor = cliente['compositor']!=null?cliente['compositor']:"";
        var miFuerte = cliente['miFuerte']!=null?cliente['miFuerte']:"";

        var equipoPropio = cliente['equipoPropio']!=null?cliente['equipoPropio']:"";
        var luces = cliente['luces']!=null?cliente['luces']:"";
        var equipoSonido = cliente['equipoSonido']!=null?cliente['equipoSonido']:"";

        var idCat = idCategoria.value;
        //Lista de áreas de trabajo--------------------------------------------
        var arrayAreasTrabajo = [];
        for(var at=0; at<areasT.length; at++){
            if(areasT[at].codigo == slPerf.value){
                var encontrado = 0;
                for(var j=0; j<arrayAreasTrabajo.length; j++){
                    if(areasT[at].nombreAT==arrayAreasTrabajo[j]){
                        encontrado=1;
                        break;
                    }
                }
                if(encontrado==0)
                  arrayAreasTrabajo.push(areasT[at].nombreAT);         
            }
        }
        areasTrabajo="";
        areasTrabajo+='<table class="table"><tbody>';
        for(var i=0; i<arrayAreasTrabajo.length; i++)
            areasTrabajo+='<tr><td>'+arrayAreasTrabajo[i]+'</td></tr>';
        if(arrayAreasTrabajo.length==0)
           areasTrabajo+='<tr><td>Ninguna</td></tr>';        
        areasTrabajo+='</tbody></table>';
        //Lista de deportes-----------------------------------------------------
        var deportesTemp = cliente['deportes']!=null?cliente['deportes']:"";
        var deportesSplit = deportesTemp.split('.');
        var deportes='<table class="table"><tbody>';
        for(var s=0; s<deportesSplit.length; s++){
            if(deportesSplit[s].trim()!="")
                deportes+='<tr><td>'+deportesSplit[s]+'</td></tr>';
        }
        if(deportesSplit=="")
            deportes+='<tr><td>Ninguno</td></tr>';
        deportes+='</tbody></table>';
        //Lista de equipo--------------------------------------------------
        var equiposTemp = cliente['musica']!=null?cliente['musica']:"";
        var equiposSplit = equiposTemp.split(',');
        var equipos='<table class="table"><tbody>';
        for(var s=0; s<equiposSplit.length; s++){
            if(equiposSplit[s].trim()!="")
               equipos+='<tr><td>'+equiposSplit[s]+'</td></tr>';
        }
        if(equiposSplit=="")
            equipos+='<tr><td>Ninguno</td></tr>';
        equipos+='</tbody></table>';
        //Lista de géneros musicales
        var genMusicalesTemp = cliente['generosMusicales']!=null?cliente['generosMusicales']:"";//generosMusicales
        var genMusicalesSplit = genMusicalesTemp.split('.');//generosMusicales
        var genMusicales='<table class="table"><tbody>';
        for(var s=0; s<genMusicalesSplit.length; s++){
            if(genMusicalesSplit[s].trim()!="")
                genMusicales+='<tr><td>'+genMusicalesSplit[s]+'</td></tr>';
        }
        if(genMusicalesSplit=="")
            genMusicales+='<tr><td>Ninguno</td></tr>';
        genMusicales+='</tbody></table>';
        //Lista de géneros musicales
        var musicasTemp = cliente['musica']!=null?cliente['musica']:"";
        var musicasSplit = musicasTemp.split(',');
        var musicas='<table class="table"><tbody>';
        for(var s=0; s<musicasSplit.length; s++){
            if(musicasSplit[s].trim()!="")
                musicas+='<tr><td>'+musicasSplit[s]+'</td></tr>';
        }
        if(musicasSplit=="")
            musicas+='<tr><td>Ninguno</td></tr>';
        musicas+='</tbody></table>';

        var dd="";

        contenedorPerfil.innerHTML+='<div class="input-group mt-4">'
                                        +'<div class="contenedorImgPerfil">';
                                            contenedorPerfil.innerHTML+=imagenCliente;//'<img src='+cliente['portada']+' class="imgPerfil">'
                                            contenedorPerfil.innerHTML+='</div>'
                                    +'</div><br>'
                                    +'<table class="table">'
                                        +'<tbody>'
                                            +'<tr><td><label>Nombre: </label></td><td>'+nombreCLiente+'</td></tr>'
                                            +'<tr><td><label>Correo: </label></td><td>'+correo+'</td></tr>'
                                            +'<tr><td><label>Teléfono: </label></td><td>'+telefono+'</td></tr>'
                                            +'<tr><td><label>Transporte: </label></td><td>'+transporte+'</td></tr>'
                                            +'<tr><td><label>Experiencia: </label></td><td>'+experiencia+'</td></tr>'
                                            +'<tr><td><label>Disponibilidad: </label></td><td>'+disponibilidad+'</td></tr>'
                                            +'<tr><td><label>Factura Electronica: </label></td><td>'+facturaelectronica+'</td></tr>'
                                        +'</tbody>'
                                    +'</table><hr>';
                                    (idCat!=7 && idCat!=12)?contenedorPerfil.innerHTML+='<label>Datos de la Categoría</label>':'';
                                    (idCat==1 || idCat==2 || idCat==3)?(contenedorPerfil.innerHTML+='<table class="table">'
                                    +'<tbody>'
                                        +'<tr><td><label>Color de Ojos </label></td><td>'+colorOjos+'</td></tr>'
                                        +'<tr><td><label>Medidas: </label></td><td>'+medidas+'</td></tr>'
                                        +'<tr><td><label>Calzado: </label></td><td>'+calzado+'</td></tr>'
                                        +'<tr><td><label>Peso: </label></td><td>'+peso+'</td></tr>'
                                        +'<tr><td><label>Altura: </label></td><td>'+altura+'</td></tr>'
                                        +'<tr><td><label>Grado Académico: </label></td><td>'+grado_academico+'</td></tr>'
                                        +'<tr><td><label>Tipo de Cabello: </label></td><td>'+cabello+'</td></tr>'
                                        +'<tr><td><label>Idioma: </label></td><td>'+idioma+'</td></tr>'
                                        +'<tr><td><label>Uniforme: </label></td><td>'+uniforme+'</td></tr>'
                                        +'<tr><td><label>Frenillos: </label></td><td>'+frenillos+'</td></tr>'
                                        +'<tr><td><label>Tattos Visibles: </label></td><td>'+tattos+'</td></tr>'
                                        +'<tr><td><label>Pasaporte al día: </label></td><td>'+pasaporte+'</td></tr>'
                                        +'<tr><td><label>Licencia al día: </label></td><td>'+licencia+'</td></tr>'
                                        +'<tr><td><label>Dirección: </label></td><td>'+direccion+'</td></tr>'
                                        +'<tr><td><label>Cursos: </label></td><td>'+cursos+'</td></tr>'
                                        +'<tr><td><label>Sobre mí: </label></td><td>'+sobremi+'</td></tr>'
                                    +'</tbody>'
                                    +'</table><br>'):'';
                                    (idCat==5)?(contenedorPerfil.innerHTML+='<table class="table">'
                                        +'<tbody>'
                                            +'<tr><td><label>Compositor: </label></td><td>'+compositor+'</td></tr>'
                                            +'<tr><td><label>Fuerte: </label></td><td>'+miFuerte+'</td></tr>'
                                            +'<tr><td><label>Instrumento Principal: </label></td><td>'+instPrincipal+'</td></tr>'
                                            +'<tr><td><label>Instrumento Secundario: </label></td><td>'+instSecundario+'</td></tr>'
                                            +'<tr><td><label>Demos: </label></td><td>'+demos+'</td></tr>'
                                        + '</tbody>'
                                    +'</table><br>'):'';
                                    (idCat==6)?(contenedorPerfil.innerHTML+='<table class="table">'
                                        +'<tbody>'
                                                +'<tr><td><label>Equipo Propio: </label></td><td>'+equipoPropio+'</td></tr>'
                                                +'<tr><td><label>Luces: </label></td><td>'+luces+'</td></tr>'
                                                +'<tr><td><label>Equipo de Sonido: </label></td><td>'+equipoSonido+'</td></tr>'
                                                +'<tr><td><label>Demos: </label></td><td>'+demos+'</td></tr>'
                                        + '</tbody>'
                                    +'</table><br>'):'';
                                    contenedorPerfil.innerHTML+='<br>'
                                    +'<h5>Áreas de trabajo</h5>';                    
                                    contenedorPerfil.innerHTML+=areasTrabajo;                            
                    (idCat==1 || idCat==2 || idCat==3)? contenedorPerfil.innerHTML+= '<br><h5>Deportes que practica</h5>':'';
                    (idCat==1 || idCat==2 || idCat==3)?contenedorPerfil.innerHTML+=deportes:'';
                    
                    (idCat==4 || idCat==7)? contenedorPerfil.innerHTML+= '<br><h5>Equipo con el que cuenta</h5>':'';
                    (idCat==4 || idCat==7)? contenedorPerfil.innerHTML+=equipos:'';
                    

                    (idCat==6)? contenedorPerfil.innerHTML+= '<br><h5>Géneros Musicales con los que cuenta</h5>':'';
                    (idCat==6)?contenedorPerfil.innerHTML+=genMusicales:'';//DJ generosMusicales

                    (idCat==5)? contenedorPerfil.innerHTML+= '<br><h5>Géneros Musicales con los que cuenta según filtro</h5>':'';
                    (idCat==5)?contenedorPerfil.innerHTML+=musicas:'';//Musicos musica
                                                                              
    }
}
/**2h
 * 1h
 * 1h
 * 48m
 * 
 * 
 *  *  * */