<?php
require_once '../../config.php';
require_once "../../AutoLoader/autoLoader.php";
require_once '../../configPayPal.php';

if(!isset($_GET['idReserva']) or "" == $_GET['idReserva']){
    $showError = "No se ha podido localizar la reserva, por favor p&oacute;ngase en contacto con nosotros a travez de <a href='contactos' title='contacto'>este enlace</a>";
    
} else {
    $idReserva = $_GET['idReserva'];
    $reservaC = new ReservaController;
    $reserva = $reservaC->getReservaById($idReserva);    
    $titular = $reserva->getTitular();    
    $pasajeros = $reserva->getPasajeros();
    $cantidadPasajeros = count($pasajeros);
    
    foreach($reserva->getProductos() as $productoR){
        if(Tipo::TIPO_TOUR == $productoR->getIdTipo()){
            $producto = $productoR;
        }
    }
    $concepto = "{$producto->getNombre()} x $cantidadPasajeros";
    
    $urlRet = "http://localhost/caribetour/reserva-finalizada.php?idReserva={$idReserva}";
    $urlRetOk = $urlRet . "&pago=ok";
    $urlRetCancel = $urlRet . "&pago=Nok";
    $fields = [
        'upload' => UPLOAD,
        'cmd' => CMD,
        'currency_code' => CURRENCY_CODE,
        'business' => BUSINESS,
        'receiver_email' => RECEIVER_EMAIL,
        'cbt' => CBT,
        'hosted_button_id' => HOSTED_BUTTON_ID,
        'amount' => $reserva->calularPvp(),
        'payer_email' => $titular->getEmail(),
        'payer_id' => $titular->getNIFoPasaporte(),
        'item_name' => $producto->getNombre(),
        'concept' => $concepto,
        'reference' => $reserva->getLocalizador(),
        'return' => $urlRetOk,
        'cancel_return' => $urlRetCancel,
        
    ];
    
    $renderFields = "";
    foreach($fields as $name => $value){
        $renderFields .= "<input type='hidden' name='{$name}' value='{$value}' required/>\n";
    }
}
?>
<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <?php include_once("includes/metatag.php"); ?>
        <meta property="og:title" content="Caribetour.es | Especialistas en el Caribe" />
        <meta name="title" content="CaribeTour.es: Especialistas en el Caribe" />
        <meta name="DC.title" content="CaribeTour.es: Especialistas en el Caribe" />
        <title>Preparando el Pago por PayPal| Especialistas en el Caribe</title>        
        <meta name="description" content="CaribeTour.es | Agencia especializada en el Caribe y sus destinos" />
        <meta name="keywords" content="CaribeTour.es | Agencia especializada en el Caribe y sus destinos" />
        <!--[if lt IE 9]>
            <script type="text/javascript" src="http://www.caribetour.es/js/jquery/html5.js"></script>
        <![endif]-->
        <?php include_once("includes/baselink.php"); ?>
        <link rel="canonical" href="http://www.caribetour.es/" />
	    <?php include_once("includes/icons.php"); ?>
        <link rel='stylesheet' id='colorbox-css'  href='<?=PATHFRONTEND ?>css/colorbox.css?ver=3.7.1' type='text/css' media='all' />
        <link rel='stylesheet' id='jquery-ui-datepicker-css'  href='<?=PATHFRONTEND ?>css/datepicker.css?ver=3.7.1' type='text/css' media='all' />
        <link rel='stylesheet' id='general-css'  href='<?=PATHFRONTEND ?>css/style.css?ver=3.7.1' type='text/css' media='all' />
        <?php include_once("includes/jsHead.php"); ?>
        <?php include_once("includes/css.php"); ?>
        <script type="text/javascript">
        WebFontConfig = {google: { families: [ "Signika:400,600","Open Sans:400,400italic,600" ] } };
        (function() {
            var wf = document.createElement("script");
            wf.src = ("https:" == document.location.protocol ? "https" : "http") + "://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js";
            wf.type = "text/javascript";
            wf.async = "true";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(wf, s);
        })();
        </script>
        <style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
    </head>
    <body class="home page page-id-96 page-template-default">
        <!-- container -->
        <div class="container site-container">
            <!-- header -->
            <header class="container site-header">
                <div class="substrate top-substrate">
                    <?php include('includes/imgSiteBg.php') ?>
                </div>
                <!-- background -->
                <!-- supheader -->
                <?php include("includes/header.php");?>
                <!-- /supheader -->
                <div class="block-background header-background"></div>
            </header>
            <!-- /header -->

            <!-- content -->
            <section class="container site-content">
                <!-- breadcrumb-->
                <div class="miga" id="breadcrumb">
                    <div class="breadcrumb">
                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="inicio" rel="tag" title="Inicio">Inicio</a>
                    </div>
                    <div class="breadcrumb">
                        Pago por PayPal
                    </div>
                </div>
                <!-- /breadcrumb-->            
            
            
                <div class="row">
                    <h3>Preparando el Pago por PayPal</h3>
                    <p>Un momento por favor...</p>
                    <form method="POST" action="<?= FORM_ACTION ?>" id="paypalForm">
                        <?= $renderFields ?>
                    </form>
                    
                </div>
                
            </section>
      
            <!-- /content -->

            <!-- footer -->
            <?php include("includes/footer.php");?>
            
            <!-- /footer -->

            <div class="substrate bottom-substrate">
                <?php include('includes/imgSiteBg.php') ?>
                
            </div>
        </div>
        <!-- /container -->
	<?php include_once('includes/jsFoot.php'); ?>
        <script type='text/javascript'>
            (window.onload = function(){
                let form = document.getElementById('paypalForm');
                //form.submit();
            })();
        </script>
        
    </body>
</html>