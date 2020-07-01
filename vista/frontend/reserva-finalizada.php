<?php
require_once '../../config.php';
require_once "../../AutoLoader/autoLoader.php";

try {

    if(isset($_GET['idReserva']) and "" != $_GET['idReserva']){
        $idReserva = (int) $_GET['idReserva'];
        $reservaC = new ReservaController;
        $reserva = @$reservaC->select([['idReserva', $idReserva]])[0];
        $totalPvp = $reserva->calularPvp();
        $titutar = $reserva->getTitular();
        $titularNombre = $titutar->getNombre() . " " . $titutar->getApellidos();
        $titularEmail = $titutar->getEmail();

        // PRODUCTOS
        $productoC = new ProductoController;
        $productoList = [];
        $seguro = $tour = $fsalida = $fvuelta = $duracion = null;
        $pvpSeguro = $pvpTour = 0;
        
        foreach($reserva->getDetalles() as $detalleR){
            $producto = $productoC->select([['idProducto', $detalleR->getIdProducto()]])[0];
            $productoList[] = $producto;
            switch($producto->getIdTipo()){

                case (Tipo::TIPO_SEGURO):
                    $seguro = $producto;
                    $pvpSeguro = Util::moneda($detalleR->getPrecioComisionTasas());
                break;

                case (Tipo::TIPO_TOUR):
                default:
                    $tour = $producto;
                    $categoria = $tour->getCategoria();
                    $pfr = $detalleR->getProductoFechaRef();
                    $fsalida = Util::dateFormat($pfr->getFechaSalida());
                    $fvuelta = Util::dateFormat($pfr->getFechaVuelta());
                    $duracion = Util::duracionCalc($fsalida, $fvuelta);
                    $pvpTour = Util::moneda($detalleR->getPrecioComisionTasas());
                break;
            }
        }


        //Util::dev($productoList);

    }
    
} catch (Exception $e){
    $showError = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <?php include_once("includes/metatag.php"); ?>
        <meta property="og:title" content="Caribetour.es | Especialistas en el Caribe" />
        <meta name="title" content="CaribeTour.es: Especialistas en el Caribe" />
        <meta name="DC.title" content="CaribeTour.es: Especialistas en el Caribe" />
        <title>Reserva Finalizada | Especialistas en el Caribe</title>        
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
                        paginaActual
                    </div>
                </div>
                <!-- /breadcrumb-->            
            
            
                <div class="row">
                    <div class="twelvecol column last">
                        <?php 
                    
                        $show = "";

                        switch($reserva->getIdTipoPago()){
                            case (Reserva::TIPO_PAGO_TRANSFERENCIA):
                                $show = '<h5 class="tour-title">Has elegido  la forma de pago por TRANSFERENCIA.</h5>
                                <p>Ahora deber&aacute;s efectuar la transferencia o el ingreso al siguiente n&uacute;mero de cuenta:</p>
                                <p><strong>TITULAR: CaribeTour.es</strong></p>
                                <p><strong>BANCO: ING Direct</strong></p>
                                <p><strong>IBAN: ES55 1465 0100 99 1709163771</strong></p>
                                <p><strong>Concepto: Reserva '. $reserva->getReservaFormat() .'</strong></p>
                                <p><strong>Por un importe total de '. Util::moneda($totalPvp) .' </strong></p>
                                <p>Una vez hayas realizado la transferencia o el ingreso, deber&aacute;s remitirnos un email con el comprobante del pago a <a href="mailto:pagos@caribetour.es"><i>pagos@caribetour.es</i></a>.<br>
                                Recuerda que la reserva s&oacute;lo se har&aacute; efectiva despu&eacute;s que hayamos recibido dicho comprobanter.</p>
                                <p>Hemos remitido el resumen de esta reserva a la cuenta de correo <em>'. $titularEmail .'.</em></p>';
                            break;
                        }

                        ?>
                        <p><?= $show ?></p>
                        
                    </div>                   

                </div>

                <div class="row">
                    
                    <div class="twelvecol column last">
                        
                        <div class="section-title">
                            <h1>Resumen de la Reserva</h1>
                        </div>

                        <!-- foto portada -->
                        <div class="column fourcol ">
                            <div class="tour-thumb-container">
                                <div class="tour-thumb">
                                    <img width="440" height="330" src="<?=PATHFRONTEND ?>img/<?= $tour->getImagen() ?>" class="attachment-preview wp-post-image" alt="<?= $tour ?>" title="<?= $tour ?>" />
                                </div>
                                <div class="block-background"></div>
                            </div>
                        </div>
                        <!-- /foto portada -->

                        <!-- datos del producto -->
                        <div class="fourcol column">
                            <h3><?= $tour ?></h3>
                            <ul class="tour-meta">
                                <li>
                                    <div class="colored-icon icon-2"></div>
                                    <strong>Destino:</strong> <?= $categoria ?>
                                </li>
                                <li>
                                    <div class="colored-icon icon-1"><span></span></div>
                                    <strong>Duracion:</strong> <?= $duracion ?> D&iacute;as
                                </li>
                                <li>
                                    <div class="colored-icon icon-6"><span></span></div>
                                    <strong>Salida:</strong> <?= $fsalida ?>
                                </li>
                                <li>
                                    <div class="colored-icon icon-7"><span></span></div>
                                    <strong>Regreso:</strong> <?= $fvuelta ?>
                                </li>
                                <li>
                                    <div class="colored-icon icon-3"><span></span></div>
                                    <strong>Facturación:</strong> <?= $tour->getTipoFacturacion() ?>
                                </li>                            
                            </ul>
                            <div style="font-size:1.8em;">
                                <strong>Precio:</strong> <span id="pvp"><?= $pvpTour ?></span>
                            </div>
                        </div>
                        <!-- /datos del producto -->

                        <!-- itinerario -->

                        <div class="column fourcol last">
                            <h3>Itinerario</h3>
                            <p><?= $tour->getItinerario() ?></p>
                        </div>

                        <!-- /itinerario -->
                        
                    </div>
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
  
        
    </body>
</html>