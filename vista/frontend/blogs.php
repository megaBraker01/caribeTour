<?php
require_once '../../config.php';
require_once "../../AutoLoader/autoLoader.php";

$filtro = [
        ['idEstado', '=', 1]
];
$blogC = new BlogController;
$blogList = $blogC->select($filtro);

// PAGINACION
$blogTotales = count($blogList);
$mostrarItems = 1;
$pagTotal = ceil($blogTotales / $mostrarItems);
$pagActual = $_GET['pag'] ?? 1;
$mostrarDesde = ($pagActual - 1) * $mostrarItems;
$mostrarBlogs = array_slice($blogList, $mostrarDesde, $mostrarItems);
?>
<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <?php include_once("includes/metatag.php"); ?>
        <meta property="og:title" content="Caribetour.es | Especialistas en el Caribe" />
        <meta name="title" content="CaribeTour.es: Especialistas en el Caribe" />
        <meta name="DC.title" content="CaribeTour.es: Especialistas en el Caribe" />
        <title>Blogs | Especialistas en el Caribe</title>        
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
                        Blogs
                    </div>
                </div>
                <!-- /breadcrumb-->            
            
            
                <div class="row">
                    <div class="column eightcol">
                        <div class="blog-listing">
                            
                            <?php foreach ($mostrarBlogs as $blog) { ?>
                            <article class="post type-post status-publish format-standard hentry category-guides post clearfix">
                                <div class="column fivecol post-featured-image">
                                    <div class="featured-image">
                                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="blogs/<?= $blog->getSlug() ?>"><img width="440" height="299" src="<?=PATHFRONTEND ?>img/<?= $blog->getSrcImagen() ?>" alt="<?= $blog ?>" title="<?= $blog ?>" /></a>
                                    </div>
                                </div>
                                <div class="column sevencol last">
                                    <div class="post-content">
                                        <div class="section-title">
                                            <h1>
                                                <a hreflang="es" type="text/html" charset="iso-8859-1" href="blogs/<?= $blog->getSlug() ?>" title="<?= $blog ?>"><?= $blog ?></a>
                                            </h1>
                                        </div>
                                        <p><?php echo substr($blog->getDescripcion(), 0, 400); ?>.[...]</p>
                                        <footer class="post-footer clearfix">
                                            <a hreflang="es" type="text/html" charset="iso-8859-1" href="blogs/<?= $blog->getSlug() ?>" class="button small"><span>Leer M&aacute;s</span></a>
                                            <div class="post-comment-count"><?php echo '1'; ?></div>
                                            <div class="post-info"><time datetime="25/01/2020"><?php echo '25/01/2020'; ?></time></div>
                                        </footer>
                                    </div>
                                </div>
                            </article>
                            <?php } ?>
                            
                        </div>
                        
                        <nav class="pagination">
                        <?php 
			for ($i = 1; $i <= $pagTotal; $i++){
                            if ($i == $pagActual)
                                echo "<span class='page-numbers current'>".$i."</span>";
                            else
				echo "<a hreflang='es' type='text/html' charset='iso-8859-1' href='blogs/pag=$i' class='page-numbers' title='Pasar a la pagina $i'>$i</a>";
			} 
			?>
                        </nav>
                        
                    </div>
                    <!--/column eightcol-->
                    <aside class="column fourcol last">
                        <div class="widget widget-selected-posts">
                            <div class="section-title">
                                <h4>Art&iacute;culos Populares</h4>
                            </div> <?php do { ?>
                            <article class="post clearfix">
                                <div class="post-featured-image">
                                    <div class="featured-image">
                                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="blogs/<?php echo 'seo'; ?>"><img width="440" height="299" src="<?=PATHFRONTEND ?>img/<?php echo 'imagen'; ?>" class="attachment-normal wp-post-image" alt="<?php echo ucwords('nombre'); ?>" title="<?php echo ucwords('nombre'); ?>" /></a>
                                    </div>
                                </div>
                                <div class="post-content">
                                    <h6 class="post-title"><a hreflang="es" type="text/html" charset="iso-8859-1" href="blogs/<?php echo 'seo'; ?>" title="<?php echo ucwords('nombre'); ?>"><?php echo ucwords('nombre'); ?></a></h6>
                                    <footer class="post-footer clearfix">
                                        <div class="post-comment-count"><?php echo 'comentario'; ?></div>
                                        <div class="post-info">
                                            <time datetime="<?php echo '25/01/2020'; ?>"><?php echo '25/01/2020'; ?></time>
                                        </div>
                                    </footer>
                                </div>
                            </article><?php } while (false); ?>
                        </div>
                        <div class="widget widget_recent_comments">
                            <div class="section-title"><h4>Comentarios Recientes</h4></div>
                            <ul id="recentcomments"><?php do { ?>
                                <li class="recentcomments"><?php echo 'nombre'; ?> en <a hreflang="es" type="text/html" charset="iso-8859-1" href="blogs/<?php echo 'seo'; ?>#comment-<?php echo 'idcoment'; ?>"><?php echo ucwords('blog'); ?></a></li><?php } while (false); ?>
                            </ul>
                        </div>
                        <div class="widget widget_text">
                            <div class="section-title"><a hreflang="es" type="text/html" charset="iso-8859-1" href="galeria" title="Ver la Galer&iacute;a Completa"><h4>Galer&iacute;a</h4></a></div>
                            <div class="textwidget">
                                <div class="items-grid"><?php $i=1; do { ?>
                                    <div class="column gallery-item sixcol <?php if ($i % 2==0){ echo 'last'; }?>">
                                        <div class="featured-image">
                                            <a href="<?=PATHFRONTEND ?>img/<?php echo 'imagen'; ?>" class="colorbox " data-group="gallery-111" title="<?php echo ucwords('nombre'); ?>"><img width="440" height="330" src="<?=PATHFRONTEND ?>img/<?php echo 'imagen'; ?>" class="attachment-preview wp-post-image" alt="<?php echo 'nombre'; ?>" /></a>
                                            <a class="featured-image-caption none-caption" href="#"><h6><?php echo ucwords('nombre'); ?></h6></a>
                                        </div>
                                        <div class="block-background"></div>
                                    </div><?php if ($i % 2==0){ echo '<div class="clear"></div>'; }?><?php $i++; } while (false); ?>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </aside>
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
