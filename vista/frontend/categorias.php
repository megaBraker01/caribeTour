<?php
include_once "includes/pathFrontend.php";
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
        <link rel='stylesheet' id='colorbox-css'  href='vista/frontend/css/colorbox.css?ver=3.7.1' type='text/css' media='all' />
        <link rel='stylesheet' id='jquery-ui-datepicker-css'  href='vista/frontend/css/datepicker.css?ver=3.7.1' type='text/css' media='all' />
        <link rel='stylesheet' id='general-css'  href='vista/frontend/css/style.css?ver=3.7.1' type='text/css' media='all' />
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
					<!--inicio breadcrumb-->
					<div class="miga" id="breadcrumb">
						<div class="breadcrumb">
							<a hreflang="es" type="text/html" charset="iso-8859-1" href="index.php" rel="tag" title="Inicio">Inicio</a>
						</div>
						<div class="breadcrumb">
							paginaActual
						</div>
               </div>
				   <!--fin de breadcrumb-->            
            
            
                <div class="row"><?php if ($totalRows_categoria > 0) { // Show if recordset not empty ?><?php $i=1; do { ?>
                    <div class="fourcol column<?php if ($i % 3==0){ echo ' last'; }?>">
                        <div class="featured-blog">
                            <article class="post-112 post type-post status-publish format-standard hentry category-guides tag-amet tag-dolor tag-lorem post">
                                <div class="featured-image">
                                    <a hreflang="es" type="text/html" charset="iso-8859-1" href="destinos/<?php echo $row_seo['strSEO']; ?>/<?php echo $row_categoria['strSEO']; ?>"><img width="440" height="299" src="img/<?php echo $row_categoria['strImagen']; ?>" class="attachment-normal wp-post-image" alt="Imagen de <?php echo $row_categoria['strDescripcion']; ?>" title="<?php echo ucwords($row_categoria['strDescripcion']); ?>" /></a>
                                </div>
                                <div class="post-content">
                                    <h2 class="post-title">
                                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="destinos/<?php echo $row_seo['strSEO']; ?>/<?php echo $row_categoria['strSEO']; ?>" title="<?php echo ucwords($row_categoria['strDescripcion']); ?>"><?php echo $row_categoria['strDescripcion']; ?> desde <?php echo moneda($row_categoria['precio']); ?>&euro;</a>
                                    </h2>
                                    <p><?php echo substr($row_categoria['strTexto'], 0, 121); ?></p>
                                    <p>&nbsp;</p>
                                </div>
                            </article>
                        </div>
                    </div><?php if ($i % 3==0){ echo '<div class="clear"></div>'; }?><?php $i++; } while ($row_categoria = mysql_fetch_assoc($categoria)); ?><?php } // Show if recordset not empty ?>
				<?php if ($totalRows_categoria == 0) { // Show if recordset empty ?>
                <h3>Sin Resultados...</h3>
                <p>Lo sentimos, <?php echo $row_seo['strDescripcion']; ?> <strong>NO</strong> se encuentra disponible en estos momentos, Puedes echar un vistazo a los productos relacionados.. Disculpen las molestias.</p>
                <img src="images/no-encontrado.gif" title="Ehhhhh..... No lo encuentro." alt="Sin Resultados...">
                <?php } // Show if recordset empty ?>
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