
                            <div>
                                <button type="button" value="Atrás" name="btn_atrasPago" class="btn btn-secondary" id="btn_atrasPago" hidden>Atrás</button>
                                <br><hr>
                                <div id="contenedorPago" hidden>
                                    <div class="cCotizacion">
                                        <div id="contenedor-data" class='table-responsive'>
                                            <div id="pago">
                                            <?php /******************---------------- ENCABEZADOS ----------------******************/
                                              header('Access-Control-Allow-Origin: *'); //CORS
                                                header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); //Compartir los metodos
                                            ?>
                                            <!DOCTYPE html>
                                            <?php
                                                if(isset($POST["afiliado"])){
                                                    $codAfiliado = $POST["afiliado"];
                                                }
                                                else{
                                                    $codAfiliado = "0";
                                                }

                                                if(isset($_GET["idorden"])){
                                                   $codOrden = $_GET["idorden"];
                                                }
                                                else{
                                                    $codOrden = "0";
                                                }

                                                if(isset($empId))
                                                   $codigoUsuario = $empId;
                                                else
                                                   $codigoUsuario = "0";

                                                if(isset($_POST["pago"])){
                                                    $valorPago = $_POST["pago"];  
                                                }
                                                else{
                                                   $valorPago = "30";
                                                }

                                                if(isset($categoria)){
                                                    $catId = $categoria->id;  
                                                }
                                                else{
                                                    $catId = "30";
                                                }                                                
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
                                                   
<link rel="stylesheet" type="text/css" href="{{ url('/css/alertify.min.css') }}" />
<link rel="stylesheet" href="{{url('/css/edcr.css')}}">
<link rel="stylesheet" href="{{url('/css/cotizacion.css')}}">
<script src="{{ url('/js/alertify.min.js') }}"></script>
<script src="{{ url('/js/axios.min.js') }}"></script>
<script src="{{url('/js/edcr.js')}}"></script>
  <!-- jQuery -->
<script src="{{url('/js/categoriaInfo.js')}}"></script>
 
                                                   
                                                   
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
                                                    <title>Paypal Pago</title>
                                                </head>
                                                <body style="background-color: black !important;">  
                                                    <div class="loader loader-default" data-text="Finalizando Compra" id="divLoader"></div>
                                                        <div>
                                                            <label for="telefono" style="color: white;">Número de teléfono:</label>
                                                            <input type="text" id="telefono" name="telefono"><br><br>
                                                            <label for="adicional" style="color: white;">Datos adicionales:</label>
                                                            <input type="text" id="adicional" name="adicional"><br><br>
                                                        </div>
                                                        <div id="paypal-button-container"></div>
                                                        <script type="text/javascript">
                                                            var afiliadoX = '<?php echo $codAfiliado; ?>';
                                                            var ordenX = '<?php echo $codOrden; ?>';
                                                            var pagoX = '<?php echo $valorPago; ?>';
                                                            var codigoUsuarioX = '<?php echo $codigoUsuario; ?>';
                                                            var idCategoriaX = '<?php echo $catId; ?>';
                                                            console.log('idCategoria '+idCategoriaX);

                                                            console.log('afiliadoX '+afiliadoX);
                                                            console.log('ordenX '+ordenX);
                                                            console.log('pagoX '+pagoX);
                                                            console.log('codigoUsuarioX '+codigoUsuarioX);
//
            function espera(){
                setTimeout(function(){
                    contactar2();
                },2000);
            }
            function mmsj(){
                notific();
            }
            mmsj();
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
                        var form = new FormData();
                        form.append('afiliado',afiliadoX);
                        form.append('cliente','App Edecanes');
                        form.append('idOrden',ordenX);
                        form.append('paypalId',details.id);
                        form.append('creacion',details.create_time);
                        form.append('edicion',details.update_time);
                        form.append('intent',details.intent);
                        form.append('estado',details.status);
                        form.append('idComprador',details.payer.payer_id);
                        form.append('emailComprador',details.payer.email_address);
                        form.append('paisComprador',details.payer.country_code);
                        form.append('nombreComprador',details.payer.name.given_name + ' ' + details.payer.name.surname);
                        form.append('undId',details.purchase_units[0].reference_id);
                        form.append('undValor',details.purchase_units[0].amount.value);
                        form.append('undMoneda',details.purchase_units[0].amount.currency_code);
                        form.append('undEmail',details.purchase_units[0].payee.email_address);
                        form.append('undMerchant',details.purchase_units[0].payee.merchant_id);
                        form.append('dirComprador',details.purchase_units[0].shipping.name.full_name);
                        form.append('dirDireccion',details.purchase_units[0].shipping.address.address_line_1);
                        form.append('dirPostal',details.purchase_units[0].shipping.address.postal_code);
                        form.append('dirPais',details.purchase_units[0].shipping.address.country_code);
                        form.append('pagoEstado',details.purchase_units[0].payments.captures[0].status);
                        form.append('pagoId',details.purchase_units[0].payments.captures[0].id);
                        form.append('pagoCapture',details.purchase_units[0].payments.captures[0].final_capture);
                        form.append('pagoCreacion',details.purchase_units[0].payments.captures[0].create_time);
                        form.append('pagoEdicion',details.purchase_units[0].payments.captures[0].update_time);
                        form.append('pagoValor',details.purchase_units[0].payments.captures[0].amount.value);
                        form.append('pagoMoneda',details.purchase_units[0].payments.captures[0].amount.currency_code);
                        form.append('tipo',1);
                        form.append('codigoUsuario',codigoUsuarioX);
                        form.append('categoria',idCategoriaX);

                        axios.post('paypal2', form)
                        .then(function (response) {
                            $("#divLoader").removeClass("is-active");                            
                            console.log(response.data);
                            if(response.data=='Error al registrar el pago. Por favor intente mas tarde.'){
                                new Noty({
                                  theme: 'metroui',
                                  layout: 'topLeft',
                                  type: 'warning',
                                  text: "Se procesó la transacción, pero el pedido no se registró. Notifique al comercio."
                                }).show();
                            }else {
                            new Noty({
                                  theme: 'metroui',
                                  type: 'success',
                                  layout: 'topCenter',
                                  text: "Su pago se realizó correctamente, puede pulsar el botón de regresar. Se está notificando vía correo electrónico a los candidatos asociados."
                                }).show();
                                espera();
                            }
                        }).catch(function (error) {
                            $("#divLoader").removeClass("is-active");
                            new Noty({
                                  theme: 'metroui',
                                  layout: 'topLeft',
                                  type: 'warning',
                                  text: "Se procesó la transacción, pero el pedido no se registró. Notifique al comercio."
                                }).show();
                        })
                    });
                }
            }).render('#paypal-button-container');
        </script>
    </body>
</html>
