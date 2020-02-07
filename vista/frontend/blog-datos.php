<?php
require_once '../../config.php';
require_once "../../AutoLoader/autoLoader.php";


$blog = null;
$blogSlug = $_GET['slugBlog'] ?? null;

if(isset($blogSlug) and $blogSlug != ""){
        $blogC = new BlogController;
        $filtro = [['slug', '=', $blogSlug]];
        $blogList = $blogC->select($filtro);
        if(isset($productoList[0])){
                $blog = $productoList[0];
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
                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="index.php" rel="tag" title="Inicio">Inicio</a>
                    </div>
                    <div class="breadcrumb">
                        paginaActual
                    </div>
                </div>
                <!-- /breadcrumb-->            
            
            
                <div class="row">
                    <div class="column eightcol">
                        <article class="post-112 post type-post status-publish format-standard hentry category-guides tag-amet tag-dolor tag-lorem post full-post">
                            <div class="post-featured-image">
                                <div class="featured-image">
                                    <a hreflang="es" type="text/html" charset="iso-8859-1" href="blog/<?php echo 'strSEO' ?>" title="<?php echo 'strNombre' ?>"><img width="768" height="522" src="img/<?php echo 'strImagen' ?>" class="attachment-wide wp-post-image" alt="<?php echo 'strNombre' ?>" /></a>
                                </div>
                            </div>
                            <div class="post-content">
                                <div class="section-title">
                                    <h1><a hreflang="es" type="text/html" charset="iso-8859-1" href="blog/<?php echo 'strSEO' ?>"><?php echo 'strNombre' ?></a></h1>
                                </div>
                                <?php echo nl2br(ucfirst('strDescripcion')); ?>			
                            </div>
                            <footer class="post-footer clearfix">
                                <div class="post-comment-count"><?php echo 'comentarios' ?></div>
                                <div class="post-info">Por <strong><?php echo 'strAutor' ?></strong> el <?php echo ('fchFecha'); ?></div>
                            </footer>
                        </article>
                        <div class="post-comments clearfix">
                            <div class="section-title">
                                <h2>Deja tus Comentarios</h2>
                            </div>
                            <div id="respond" class="comment-respond">
                                <form action="coment_add.php" method="post" id="commentform" class="comment-form" name="comentarios" onSubmit="return validacion();">
                                    <div class="formatted-form">
                                    	<div class="message" id="nrequired" style="display:none;">Por favor indique su nombre completo</div>
                                        <div class="sixcol column">
                                            <div class="field-container">
                                                <input id="nombre" name="strNombre" type="text" value="" size="30" maxlength="50" title="Indroduzca su Nombre" placeholder="Nombre" required />
                                            </div>
                                        </div>
                                        <div class="message" id="erequired" style="display:none;">Por favor indique un correo v&aacute;lido</div>
                                        <div class="sixcol column last">
                                            <div class="field-container">
                                                <input id="email" name="strEmail" type="email" value="" title="Introduzca su Email" maxlength="60" size="30" placeholder="Email" required />
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="message" id="mrequired" style="display:none;">Es necesario rellenar este campo</div>
                                        <div class="field-container">
                                            <textarea id="mensaje" name="strComentario" title="Introduzca sus Comentarios" maxlength="1000" cols="45" rows="8" placeholder="Comentario" required ></textarea>
                                        </div>
                                    </div>
                                    <p class="form-submit">
                                        <input name="submit" type="submit" id="submit" value="Comentar" />
                                        <input type="hidden" name="idArticulo" value="<?php echo 'idBlog' ?>" />
                                        <input type="hidden" name="blogSeo" value="<?php echo $_SERVER["REQUEST_URI"]; ?>" />
                                        <input type="hidden" name="MM_insert" value="comentarios" />
                                    </p><br>
                                </form>
                            </div><!-- #respond --><?php if (1 > 0) { ?>
                            <div class="section-title">
                                <h2>Comentarios</h2>
                            </div>
                            <div class="comments-list" id="comments">		
                                <ul><?php do { ?>
                                    <li id="comment-<?php echo 'idComentario' ?>">
                                        <div class="comment clearfix">
                                            <div class="comment-text">
                                                <header class="comment-header clearfix">				
                                                    <h6 class="comment-author"><?php echo 'strNombre' ?></h6>
                                                    <time class="comment-date" datetime="<?php echo ('fchPost'); ?>"><?php echo ('fchPost'); ?></time>
                                                    <span class='comment-reply-link'></span>
                                                </header>
                                                <p><?php echo 'strComentario' ?></p>
                                            </div>
                                        </div>
                                    </li><?php } while (false); ?><!-- #comment-## -->
                                </ul>
                            </div><?php } ?>
                            <nav class="pagination comments-pagination"></nav>
                        </div>
                        <!-- post comments -->
                    </div>
                    <aside class="column fourcol last">
                        <div class="widget widget-selected-posts">
                            <div class="section-title"><h4>Art&iacute;culos Populares</h4></div><?php do { ?>
                            <article class="post-112 post type-post status-publish format-standard hentry category-guides tag-amet tag-dolor tag-lorem post clearfix">
                                <div class="post-featured-image">
                                    <div class="featured-image">
                                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="blog/<?php echo "seoBlog"; ?>"><img width="440" height="299" src="img/<?php echo 'strImagen' ?>" class="attachment-normal wp-post-image" alt="image_7" /></a>
                                    </div>
                                </div>
                                <div class="post-content">
                                    <h6 class="post-title"><a hreflang="es" type="text/html" charset="iso-8859-1" href="blog/<?php echo "seoBlog"; ?>"><?php echo 'strNombre'; ?></a></h6>
                                    <footer class="post-footer clearfix">
                                        <div class="post-comment-count"><?php echo 'comentarios'; ?></div>
                                        <div class="post-info">
                                                <time datetime="2012-11-24"><?php echo ('fchFecha'); ?></time>
                                        </div>
                                    </footer>
                                </div>
                            </article><?php } while (false); ?>
                        </div><?php if (1 > 0) { ?>
                        <div class="widget widget_recent_comments">
                            <div class="section-title"><h4>Comentarios Recientes</h4></div>
                            <ul id="recentcomments"><?php do { ?>
                                <li class="recentcomments"><?php echo "nombreComentario"; ?> en <a hreflang="es" type="text/html" charset="iso-8859-1" href="blog/<?php echo "seoComentario"; ?>#comment-<?php echo "idcomentario"; ?>"><?php echo "nombreBlog"; ?></a></li><?php } while (false); ?>
                            </ul>
                        </div><?php } ?>
                        <div class="widget widget_text">
                            <div class="section-title"><a hreflang="es" type="text/html" charset="iso-8859-1" href="galeria" title="Ver la Galer&iacute;a Completa"><h4>Galer&iacute;a</h4></a></div>
                            <div class="textwidget">
                                <div class="items-grid"><?php $i=1; do { ?>
                                    <div class="column gallery-item sixcol <?php if ($i % 2==0){ echo 'last'; }?>">
                                        <div class="featured-image">
                                            <a href="img/<?php echo "nombreImagen"; ?>" class="colorbox " data-group="gallery-111" title="<?php echo ucwords("nombreProducto"); ?>"><img width="440" height="330" src="img/<?php echo "nombreImagen"; ?>" class="attachment-preview wp-post-image" alt="<?php echo "nombreProducto"; ?>" /></a>
                                            <a class="featured-image-caption none-caption" href="#"><h6><?php echo ucwords("nombreProducto"); ?></h6></a>
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
