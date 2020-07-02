<?php
require_once '../../config.php';
require_once "../../AutoLoader/autoLoader.php";

$productoC = new ProductoController;
$categoriaC = new CategoriaController;
$filtros = [['fsalida', date('Y-m-d'), '>=']];
$ordenados = [];
$limitar = [];
$agrupar = ['idCategoriaPadre'];
$paisesList = $productoC->getProductoFechaRefPDO($filtros, $ordenados, $limitar, $agrupar);
?>
<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <?php include_once("includes/metatag.php"); ?>
        <meta property="og:title" content="Caribetour.es | Especialistas en el Caribe" />
        <meta name="title" content="CaribeTour.es: Especialistas en el Caribe" />
        <meta name="DC.title" content="CaribeTour.es: Especialistas en el Caribe" />
        <title>Paises en CaribeTour.es | Caribetour.es Especialistas en el Caribe</title>        
        <meta name="description" content="CaribeTour.es | Agencia especializada en el Caribe y sus paises" />
        <meta name="keywords" content="CaribeTour.es | Agencia especializada en el Caribe y sus paises" />
        <!--[if lt IE 9]>
            <script type="text/javascript" src="https://www.caribetour.es/js/jquery/html5.js"></script>
        <![endif]-->
        <?php include_once("includes/baselink.php"); ?>
        <link rel="canonical" href="https://www.caribetour.es/" />
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
                <!-- background -->
                <div class="substrate top-substrate">
                    <?php include('includes/imgSiteBg.php') ?>
                </div>
                <!-- /background -->
                <!-- supheader -->
                
                <?php include("includes/header.php");?>
                
                <!-- /supheader -->
                <div class="block-background header-background"></div>
            </header>
            <!-- /header -->

            <!-- content -->
            <section class="container site-content">
                <!--inicio breadcrumb-->
                <div class="miga" id="breadcrumb">
                    <div class="breadcrumb">
                            <a hreflang="es" type="text/html" charset="iso-8859-1" href="inicio" rel="tag" title="Inicio">Inicio</a>
                    </div>
                    <div class="breadcrumb">
                            Paises
                    </div>
                </div>
                <!--fin de breadcrumb-->            
            
            
                <div class="row">
                    <?php 
                    $i = 1; 
                    foreach($paisesList as $pais){
                        $idCategoria = $pais->getIdCategoriaPadre();
                        $categoria = $categoriaC->getCategoriaById($idCategoria);
                        $precioMasBajo = Util::moneda($categoria->getPrecioMasBajo(true, true));
                        $last = "";
                        $clear = "";
                        if($i++ % 3 == 0){
                            $last = "last";
                            $clear = '<div class="clear"></div>';
                        }
                    ?>
                    
                    <div class="fourcol column <?= $last ?>">
                        <div class="featured-blog">
                            <article class="post type-post status-publish format-standard category-<?= $categoria->getSlug() ?> tag-<?= $categoria->getSlug() ?> tag-caribe">
                                <div class="featured-image">
                                    <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/<?= $categoria->getSlug() ?>">
                                        <img width="440" height="299" src="<?=PATHFRONTEND ?>img/<?= $categoria->getSrcImagen() ?>" class="attachment-normal wp-post-image" alt="<?= $categoria->getNombre() ?>" title="<?= $categoria->getNombre() ?>" />
                                    </a>
                                </div>
                                <div class="post-content">
                                    <h2 class="post-title">
                                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/<?= $categoria->getSlug() ?>" title="<?= $categoria->getNombre() ?>"><?= $categoria->getNombre() ?> desde <?= $precioMasBajo ?></a>
                                    </h2>
                                    <p>&nbsp;</p>
                                </div>
                            </article>
                        </div>
                    </div>
                    <?= $clear ?>
                    
                    <?php } ?>
                    
                    <?php if(empty($paisesList)){ ?>
                    <div class="column sixcol">
                        <div class="tour-thumb-container">
                            <div class="tour-thumb">
                                <img width="440" height="330" src="<?=PATHFRONTEND ?>images/no-encontrado.gif" class="attachment-preview wp-post-image" alt="Sin Resultados" />
                                <div class="tour-caption">
                                    <h3 class="tour-title">
                                           Sin Resultados...
                                    </h3>
                                    <p>Lo sentimos, el destino elegido <strong>NO</strong> se encuentra disponible en estos momentos, Puedes echar un vistazo a los paises relacionados.. Disculpen las molestias.</p>
                                </div>
                            </div>
                            <div class="block-background"></div>
                        </div>
                    </div>
                    <?php } ?>
                    
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