
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EDCR Business</title>
    <link rel="stylesheet" type="text/css" href="{{ url('/css/alertify.min.css') }}" />
    <link rel="stylesheet" href="{{url('/css/edcr.css')}}">
    <link rel="stylesheet" href="{{ url('/css/opcionPago.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="{{ url('/js/alertify.min.js') }}"></script>
    <script src="{{ url('/js/axios.min.js') }}"></script>
    <script src="{{ url('/js/edcr.js') }}"></script>
    <script src="{{ url('/js/opcionPago.js') }}"></script>
    <style>
        .content-wrapper {
            background: linear-gradient(rgb(0, 0, 0) 10%, rgb(54, 70, 78));
        }
        .navbar-white {
            background: rgb(54, 70, 78);
            color: #ffffff;
        }
        .main-sidebar {
            background: #455A64;
        }
    </style>
</head>
<input type="text" id="idEmpresa" hidden value="{{$idEmpresa}}">
<input type="text" id="comision" hidden value="{{$comision->valor}}">
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="sticky-top mb-3">
                <div class="input-group">
                    <div class="card-body">
                        <div class="row">
                            <div>
                                <div id="pago">
                                    <div class="centroblanco">
                                        <div class="contenedorcentroIzquierda mt-5">
                                            <div id="contenedorLogoPago">
                                                <img id="logo" src="/img/logo.png">
                                            </div>
                                        </div>
                                        <div class="contenedorcentroderecha">
                                            <div class="mt-1 row">
                                                <label id="titulo">Tipo de Pago</label><br><br><br><br>
                                            </div>
                                            <div class="mt-2 row">
                                                <input type="button" value="Pago por medio de Paypal" class="btnFormat" id="btn_pagoPaypal">       
                                            </div><br><br>
                                            <div class="mt-2 row">
                                                <input type="button" value="Pago por depósito bancario" class="btnFormat" id="btn_pagoDeposito"><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="button" value="Atrás" name="btn_atrasCampos" class="btn btn-secondary" id="btn_atrasCampos" hidden onClick="volverCamposPago()">Atrás</button>
                            <button type="button" value="Atrás" name="btn_atrasPago2" class="btn btn-secondary" id="btn_atrasPago2" hidden onClick="volverPago2()">Atrás</button>
                            <button type="button" value="Atrás" name="btn_atrasPago1" class="btn btn-secondary" id="btn_atrasPago1" hidden onClick="volverPago1()">Atrás</button>
                            <br><hr>
                            <div id="contenedorCampos" hidden>
                                <div class="cCotizacion">
                                    <div class="mt-2 row">
                                        <label for="telefono" style="color: white;">Número de teléfono:</label>  
                                        <input type="text" placeholder="Número de teléfono" class="cajatextopago" id="txtTelefono3">
                                        <label style="color:red;" class="error" id="errorTelefono3" hidden>Debe ingresar un teléfono</label>
                                    </div><br>
                                    <div class="mt-2 row">
                                        <label for="adicional" style="color: white;">Datos adicionales:</label> 
                                        <input type="text" placeholder="Datos Adicionales" class="cajatextopago" id="txtDireccion3">       
                                    </div><br>                                        
                                    <div class="mt-2 row">
                                        <input type="button" value="Siguiente" class="btnFormat" id="btn_siguiente" onClick="irAPagoPaypal()"><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div><br>                                    
                                    <br><hr>
                                    <div id="contenedorPago2" hidden>
                                        <div class="cCotizacion">
                                            <div class="mt-2 row">
                                                <label for="telefono" style="color: white;">Número de teléfono:</label>
                                                <input type="text" placeholder="Número de teléfono" class="cajatextopago" id="txtTelefono2">
                                                <label style="color:red;" class="error" id="errorTelefono2" hidden>Debe ingresar un teléfono</label>
                                            </div><br>
                                            <div class="mt-2 row">
                                                <label for="adicional" style="color: white;">Datos adicionales:</label> 
                                                <input type="text" placeholder="Datos Adicionales" class="cajatextopago" id="txtDireccion">       
                                            </div><br>                                        
                                            <div class="mt-2 row">
                                                <input type="text" placeholder="Número de comprobante" class="cajatextopago" id="txtComprobante">
                                                <label style="color:red;" class="error" id="errorComprobante" hidden>Debe ingresar el número de comprobante</label>
                                            </div><br><br>
                                            <div class="mt-2 row">
                                                <input type="button" value="Depósito Bancario" class="btnFormat" id="btn_pagoDepositar" onClick="registroPagoDeposito()"><br>
                                            </div>
                                        </div>
                                    </div>
                        </div>                              

                        <div>
                            <br><hr>
                            <div id="contenedorPago1" hidden>
                                <div class="cCotizacion">
                                    <div id="contenedor-data" class='table-responsive'>
                                        <div>
                                            <?php
                                                header('Access-Control-Allow-Origin: *');
                                                header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); //Compartir los metodos
                                            ?>
                                            <!DOCTYPE html>
                                            <?php
                                                if(isset($POST["afiliado"]))
                                                    $codAfiliado = $POST["afiliado"];
                                                else
                                                    $codAfiliado = "0";
                                                if(isset($_GET["idorden"]))
                                                    $codOrden = $_GET["idorden"];
                                                else
                                                    $codOrden = "0";
                                                if(isset($idEmpresa))
                                                    $codigoUsuario = $idEmpresa;
                                                else
                                                    $codigoUsuario = "0";
                                                if(isset($comision))
                                                    $valorPago = $comision->valor;
                                                else
                                                    $valorPago = "30";
                                            ?>
                                            <html lang="es">
                                                <head>
                                                    <meta charset="UTF-8">
                                                    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
                                                    <meta name="format-detection" content="telephone=no">
                                                    <meta name="msapplication-tap-highlight" content="no">
                                                    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
                                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/css-loader/3.3.3/css-loader.css">
                                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css">
                                                    <link rel="stylesheet" type="text/css" href="{{ url('/css/alertify.min.css') }}" />
                                                    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
                                                    <script type="text/javascript" src="https://www.paypal.com/sdk/js?client-id=Af1vsaJCVx5qQltD1ISS-3mrdcF2YesGCMl-HIeUhOjxn5_CwRs3v2QBgfktnMWZ7tw-QVSj_BAOolWG&disable-funding=credit,card"></script>
                                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"></script>
                                                    <script src="{{ url('/js/alertify.min.js') }}"></script>
                                                    <script src="{{ url('/js/axios.min.js') }}"></script>
                                                    <style>
                                                        input[type=text] {
                                                            width: 100%;
                                                            padding: 12px 20px;
                                                            margin: 8px 0;
                                                            box-sizing: border-box;
                                                            border: 1px solid grey;
                                                            border-radius: 5px;
                                                        }
                                                    </style>
                                                </head>
                                                <body style="background-color: black !important;">  
                                                    <div class="loader loader-default" data-text="Finalizando Compra" id="divLoader"></div>
                                                    <div id="paypal-button-container"></div>
                                                    <script type="text/javascript">
                                                        var afiliadoX = '<?php echo $codAfiliado; ?>';
                                                        var ordenX = '<?php echo $codOrden; ?>';
                                                        var pagoX = '<?php echo $valorPago; ?>';
                                                        var codigoUsuarioX = '<?php echo $codigoUsuario; ?>';
                                                        function getbaseurl() {
                                                            var getUrl = window.location;
                                                            return getUrl.protocol + "//" + getUrl.host;
                                                        }
                                                        function espera(){
                                                            setTimeout(function(){
                                                                window.location.href = getbaseurl()+'/dashboard';
                                                            },2000);
                                                        }
                                                        paypal.Buttons({                                            
                                                            style: {
                                                                size: 'responsive'
                                                            },
                                                            funding: {
                                                                disallowed: [paypal.FUNDING.CARD],
                                                                disallowed: [ paypal.FUNDING.CREDIT ]
                                                            },
                                                            createOrder: function (data, actions) {
                                                                return actions.order.create({
                                                                    purchase_units: [{
                                                                        amount: {
                                                                            value: pagoX,
                                                                            currency: 'USD'
                                                                        }
                                                                    }]
                                                                });
                                                            },
               
                                                            onApprove: function (data, actions) {                    
                                                                $("#divLoader").addClass("is-active");  
                                                                return actions.order.capture().then(function (details) {
                                                                    envioPagoPaypal(afiliadoX,'App Edecanes',ordenX,details.id,details.create_time,details.update_time,
                                                                                    details.intent,details.status,details.payer.payer_id,details.payer.email_address,details.payer.country_code,
                                                                                    details.payer.name.given_name + ' ' + details.payer.name.surname,details.purchase_units[0].reference_id,
                                                                                    details.purchase_units[0].amount.value,details.purchase_units[0].amount.currency_code,
                                                                                    details.purchase_units[0].payee.email_address,
                                                                                    details.purchase_units[0].payee.merchant_id,
                                                                                    details.purchase_units[0].shipping.name.full_name,
                                                                                    details.purchase_units[0].shipping.address.address_line_1,
                                                                                    details.purchase_units[0].shipping.address.postal_code,
                                                                                    details.purchase_units[0].shipping.address.country_code,
                                                                                    details.purchase_units[0].payments.captures[0].status,
                                                                                    details.purchase_units[0].payments.captures[0].id,
                                                                                    details.purchase_units[0].payments.captures[0].final_capture,
                                                                                    details.purchase_units[0].payments.captures[0].create_time,
                                                                                    details.purchase_units[0].payments.captures[0].update_time,
                                                                                    details.purchase_units[0].payments.captures[0].amount.value,
                                                                                    details.purchase_units[0].payments.captures[0].amount.currency_code,
                                                                                    1,
                                                                                    codigoUsuarioX);
                                                                });
                                                            }
                                                        }).render('#paypal-button-container');
                                                    </script>
                                                </body>
                                            </html><br><br><br><br><br><br><br><br><br><br><br>                                            
                                        </div>                                
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>