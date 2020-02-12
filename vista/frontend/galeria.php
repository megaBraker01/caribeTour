<?php
require_once '../../config.php';
require_once "../../AutoLoader/autoLoader.php";

$productoC = new ProductoController;
$productoList = $productoC->select();

// PAGINACION
$productoTotales = count($productoList);
$mostrarItems = 16;
$pagTotal = ceil($productoTotales / $mostrarItems);
$pagActual = $_GET['pag'] ?? 1;
$mostrarDesde = ($pagActual - 1) * $mostrarItems;
$mostrarproductos = array_slice($productoList, $mostrarDesde, $mostrarItems);
?>
<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <?php include_once("includes/metatag.php"); ?>
        <meta property="og:title" content="Caribetour.es | Especialistas en el Caribe" />
        <meta name="title" content="CaribeTour.es: Especialistas en el Caribe" />
        <meta name="DC.title" content="CaribeTour.es: Especialistas en el Caribe" />
        <title>Galeria | Especialistas en el Caribe</title>        
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
                        Galeria
                    </div>
                </div>
                <!-- /breadcrumb-->            
            
            
                <div class="row">
                
                    
                    <div class="items-grid">
                    
                        <?php $i=1; foreach($mostrarproductos as $producto) { ?>
                        <div class="column gallery-item threecol <?php if ($i % 4==0){ echo 'last'; }?>">
                            <div class="featured-image">
                                <a href="<?=PATHFRONTEND ?>img/<?= $producto->getImagen() ?>" class="colorbox " data-group="gallery-<?= $producto->getIdProducto() ?>" title="<?= $producto ?>">
                                    <img width="440" height="330" src="<?=PATHFRONTEND ?>img/<?= $producto->getImagen() ?>" class="attachment-preview wp-post-image" alt="<?= $producto ?>" />
                                </a>                                
                                <?php foreach ($producto->getImagenes() as $imagen) { ?>
                                <a href="<?=PATHFRONTEND ?>img/<?= $imagen ?>" class="colorbox " data-group="gallery-<?= $imagen->getIdProducto() ?>" title="<?= $producto ?>"></a>
                                <?php } ?>
                                <a class="featured-image-caption visible-caption" href="#"><h6><?= $producto ?></h6></a>
                            </div>
                            <div class="block-background"></div>
                        </div>
                        <?php if ($i % 4 == 0){ echo '<div class="clear"></div>'; }?>
                        <?php $i++;  } ?>
                        
                        
                        
                        <div class="clear"></div>
                    </div>                 

                    <nav class="pagination">
                        <?php 
			for ($i = 1; $i <= $pagTotal; $i++){
                            if ($i == $pagActual)
                                echo "<span class='page-numbers current'>".$i."</span>";
                            else
				echo "<a hreflang='es' type='text/html' charset='iso-8859-1' href='galeria/pag=$i' class='page-numbers' title='Pasar a la pagina $i'>$i</a>";
			} 
			?>
                    </nav>
                    
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
