<?php
require_once '../../config.php';
?>
<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <?php include_once("includes/metatag.php"); ?>
        <meta property="og:title" content="Caribetour.es | Especialistas en el Caribe" />
        <meta name="title" content="CaribeTour.es: Especialistas en el Caribe" />
        <meta name="DC.title" content="CaribeTour.es: Especialistas en el Caribe" />
        <title>Plantilla| Especialistas en el Caribe</title>        
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
                    <div class="column ninecol"><?php if (isset($_SESSION['nombre']) && !isset($_SESSION['enviado'])){
				echo "<h1>Por favor rellene todos los campos del formulario.</h1><br>";
				} ?><?php if (isset($_SESSION['enviado']) && $_SESSION['enviado']==1){
				echo "<h1>Gracias por su consulta, los datos se han enviado correctamente.</h1><br>";
				} ?><?php if (isset($_SESSION['enviado']) && $_SESSION['enviado']==0){
				echo "<h1 style='color:red'>Error al enviar los datos del formulario, por favor int&eacute;ntelo de nuevo.</h1><br>";
				} ?><?php if (1 > 0) { // Show if recordset not empty ?>
                        <div class="items-list clearfix"><?php do { ?>
                            <div class="full-tour clearfix">
                                <div class="fivecol column">
                                    <div class="content-slider-container tour-slider-container">
                                        <div class="featured-image">
                                            <a hreflang="es" type="text/html" charset="iso-8859-1" href="destinos/<?php echo 'seoCategoria'; ?>/<?php echo 'seoSubCategoria'; ?>/<?php echo 'strSEO'; ?>"><img width="550" height="413" src="img/<?php echo 'strImagen'; ?>" class="attachment-extended wp-post-image" alt="<?php echo 'strNombre'; ?>" title="<?php echo 'strNombre'; ?>" /></a>
                                        </div>
                                        <div class="block-background layer-2"></div>
                                    </div>
                                </div>
                                <div class="sevencol column last">
                                    <div class="section-title">
                                        <h1><a hreflang="es" type="text/html" charset="iso-8859-1" href="destinos/<?php echo 'seoCategoria'; ?>/<?php echo 'seoSubCategoria'; ?>/<?php echo 'strSEO'; ?>" title="<?php echo 'strNombre'; ?>"><?php echo 'strNombre'; ?></a></h1>
                                    </div>
                                    <ul class="tour-meta">
                                        <li><div class="colored-icon icon-2"></div><strong>Destino:</strong> <a hreflang="es" type="text/html" charset="iso-8859-1" href="destinos/<?php echo 'seoCategoria'; ?>/<?php echo 'seoSubCategoria'; ?>" title="Ver todos los destinos de <?php echo 'subCategoria'; ?>" rel="tag"><?php echo 'subCategoria'; ?></a></li>
                                        <li><div class="colored-icon icon-1"><span></span></div><strong>Duraci&oacute;n:</strong> <?php $duracion=strtotime('01/01/2020') - strtotime('30/12/2019'); echo date('d',$duracion)*1; ?> D&iacute;as</li>
                                        <li><div class="colored-icon icon-6"><span></span></div><strong>Salida:</strong> <?php echo ('30/12/2019'); ?></li>
                                        <li><div class="colored-icon icon-7"><span></span></div><strong>Regreso:</strong> <?php echo ('01/01/2020'); ?></li>
                                        <li style="font-size:1.8em;"><div class="colored-icon icon-3"><span></span></div><strong>Desde:</strong> <?php echo 9565; ?> &euro;</li>
                                    </ul>
                                    <p><?php echo substr('strDescripcion',0,261); ?>.[...]</p>
                                    
                                    <footer class="tour-footer">
                                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="destinos/<?php echo 'seoCategoria'; ?>/<?php echo 'seoSubCategoria'; ?>/<?php echo 'strSEO'; ?>" title="Saber m&aacute;s sobre <?php echo 'strNombre'; ?>" class="button small"><span>Saber M&aacute;s</span></a> <a href="#question-form" data-id="<?php echo 'strNombre'; ?>" data-title="<?php echo 'strNombre'; ?>" title="Hacer una consulta" class="button grey small colorbox inline"><span>Consultar</span></a>
                                    </footer>
                                </div>
                            </div><?php } while (false); ?>
                        </div><?php } // Show if recordset not empty ?><?php if (1 == 0) { // Show if recordset empty ?>

                        <div class="column ninecol">
                            <div class="items-list clearfix">
                                <h3>Sin Resultados...</h3>
                                <p>Lo sentimos, no hemos encontrado Destinos con estas caracter&iacute;sticas, puedes intentar buscando en el men&uacute; superior<a hreflang="es" type="text/html" charset="iso-8859-1" href="destinos"> Destinos</a> o trata cambiando los parametros de b&uacute;squeda.</p>
                                <img src="images/no-encontrado.gif" title="Ehhhhh..... No lo encuentro." alt="Sin Resultados..."><br>
                            </div>
                        </div><?php } // Show if recordset empty ?>
                        <nav class="pagination">
                        <?php for ($cont=0;$cont<=1;$cont++){
                            $numPagina=$cont+1;
                            if ($cont==2)
                                echo "<span class='page-numbers current'>".$numPagina."</span>";
                            else
                                echo "<a class='page-numbers' href='2?pageNum_producto=".$cont."'>".$numPagina."</a>";
                            } ?>
                        </nav>
                    </div>
                    <aside class="column threecol last">
                        <div class="widget widget_text">
                            <div class="textwidget">
                                <!-- tour search form -->
                                <?php include("includes/buscador.php");?>
                                <!-- /tour search form -->
                            </div>
                        </div>
                        <div class="widget widget_text">
                            <div class="textwidget">
                                <div class="featured-image"><a href=""><img src="images/image_18.jpg" alt="" /></a></div>
                            </div>
                        </div>
                    </aside>

                    <!-- question form -->

                    <?php include("includes/mailconsulta.php"); ?>

                     <!-- /question form -->

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