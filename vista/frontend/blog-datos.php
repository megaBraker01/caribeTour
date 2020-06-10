<?php
require_once '../../config.php';
require_once "../../AutoLoader/autoLoader.php";

$blogC = new BlogController;
// INSERTAT COMENTARIO
if(isset($_POST['MM_insert'])){
    $nombre = UtilController::sanear($_POST['nombre']);
    $email = UtilController::sanear($_POST['email']);
    $comentarios = UtilController::sanear($_POST['comentario']);
    $idBlog = UtilController::sanear($_POST['idBlog'], UtilController::_INT);
    
    $comentarioC = new BlogComentarioController;
    $comentario = new BlogComentario(0, $idBlog, Estado::ESTADO_ACTIVO, $nombre, $email, $comentarios);
    $mensaje = 'KO';
    if($comentarioC->insert($comentario)){
        $mensaje = 'OK';
    }
    $insertGoTo = $_SERVER['REDIRECT_URL'] ."?". $mensaje;
    header(sprintf("Location: %s", $insertGoTo));
}

// MOSTRAR EL BLOG
$blog = null;
$blogSlug = $_GET['slugBlog'] ?? null;

if(isset($blogSlug) and $blogSlug != ""){    
    $filtro = [['slug', $blogSlug]];
    $blogList = $blogC->select($filtro);
    if(isset($blogList[0])){
        $blog = $blogList[0];
    }
}

// BLOGS POPULARES
$blogsPopulares = $blogC->getBlogsPopulares();

// TODO: la galería tiene que ser fotos relacionadas con el blog
// GALERIA
$imagenes = $blogC->getBlogImagenes();
?>
<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <?php include_once("includes/metatag.php"); ?>
        <meta property="og:title" content="Caribetour.es | Especialistas en el Caribe" />
        <meta name="title" content="CaribeTour.es: Especialistas en el Caribe" />
        <meta name="DC.title" content="CaribeTour.es: Especialistas en el Caribe" />
        <title><?= $blog ?> | Especialistas en el Caribe</title>        
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
                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="blogs" rel="tag" title="Blogs">Blogs</a>
                    </div>
                    <div class="breadcrumb">
                        <?= $blog ?>
                    </div>
                </div>
                <!-- /breadcrumb-->            
            
            
                <div class="row">
                    <div class="column eightcol">
                    
                    	<?php 
                        if($blog){ 
                         $fechaAlta = date('d-m-Y', strtotime($blog->getFechaAlta()));
                         $comentarios = $blog->getComentarios();
                        ?>
                        <article class="post type-post status-publish format-standard full-post">
                            <div class="post-featured-image">
                                <div class="featured-image">
                                    <a hreflang="es" type="text/html" charset="iso-8859-1" href="blogs/<?= $blog->getSlug() ?>" title="<?= $blog ?>"><img width="768" height="522" src="<?=PATHFRONTEND ?>img/<?= $blog->getSrcImagen() ?>" class="attachment-wide wp-post-image" alt="<?= $blog ?>" /></a>
                                </div>
                            </div>
                            <div class="post-content">
                                <div class="section-title">
                                    <h1><a hreflang="es" type="text/html" charset="iso-8859-1" href="blogs/<?= $blog->getSlug() ?>"><?= $blog ?></a></h1>
                                </div>
                                <?= nl2br($blog->getDescripcion()) ?>			
                            </div>
                            <footer class="post-footer clearfix">
                                <div class="post-comment-count"><?= count($comentarios); ?></div>
                                <div class="post-info">Por <strong><?= $blog->getUsuario() ?></strong> el <?= $fechaAlta ?></div>
                            </footer>
                        </article>
                        
                        <!-- post comments -->
                        <div class="post-comments clearfix">
                            <div class="section-title">
                                <h2>Deja tus Comentarios</h2>
                            </div>
                            
                            <div id="respond" class="comment-respond">
                                <form method="post" id="commentform" class="comment-form" name="comentarios" onSubmit="return validacion();">
                                    <div class="formatted-form">
                                    	<div class="message" id="nrequired" style="display:none;">Por favor indique su nombre completo</div>
                                        <div class="sixcol column">
                                            <div class="field-container">
                                                <input id="nombre" name="nombre" type="text" value="" size="30" maxlength="50" title="Indroduzca su Nombre" placeholder="Nombre" required />
                                            </div>
                                        </div>
                                        <div class="message" id="erequired" style="display:none;">Por favor indique un correo v&aacute;lido</div>
                                        <div class="sixcol column last">
                                            <div class="field-container">
                                                <input id="email" name="email" type="email" value="" title="Introduzca su Email" maxlength="60" size="30" placeholder="Email" required />
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="message" id="mrequired" style="display:none;">Es necesario rellenar este campo</div>
                                        <div class="field-container">
                                            <textarea id="comentario" name="comentario" title="Introduzca sus Comentarios" maxlength="1000" cols="45" rows="8" placeholder="Comentario" required ></textarea>
                                        </div>
                                    </div>
                                    <p class="form-submit">
                                        <input name="submit" type="submit" id="submit" value="Comentar" />
                                        <input type="hidden" name="idBlog" value="<?= $blog->getIdBlog() ?>" />
                                        <input type="hidden" name="blogSeo" value="<?= $blog->getSlug() ?>" />
                                        <input type="hidden" name="MM_insert" value="comentarios" />
                                    </p><br>
                                </form>
                            </div><!-- #respond -->
                            
                            <?php if(!empty($comentarios)){ ?>
                            <div class="section-title">
                                <h2>Comentarios</h2>
                            </div>
                            <div class="comments-list" id="comments">		
                                <ul>
                                    <?php 
                                    foreach ($comentarios as $comentario){
                                        $fechaAlta = date('d-m-Y H:i', strtotime($comentario->getFechaAlta()));
                                    ?>
                                    <li id="comment-<?= $comentario->getIdBlogComentario() ?>">
                                        <div class="comment clearfix">
                                            <div class="comment-text">
                                                <header class="comment-header clearfix">				
                                                    <h6 class="comment-author">
                                                        <?= $comentario->getNombre() ?>
                                                    </h6>
                                                    <time class="comment-date" datetime="<?= $fechaAlta ?>"><?= $fechaAlta ?></time>
                                                    <span class='comment-reply-link'></span>
                                                </header>
                                                <p><?= nl2br($comentario->getComentario()) ?></p>
                                            </div>
                                        </div>
                                    </li>
                                    <?php } ?>
                                    
                                </ul>
                            </div>
                            <?php } // endComentario ?>
                            
                            
                            <nav class="pagination comments-pagination"></nav>
                        </div>
                        <?php } // endBlog ?> 
                        <!-- /post comments -->
                        
                        
                    </div>
                    <aside class="column fourcol last">
                        <div class="widget widget-selected-posts">
                            <div class="section-title">
                                <h4>Art&iacute;culos Populares</h4>
                            </div>
                            
                            <?php 
                            foreach($blogsPopulares as $blog) { 
                                $fechaAlta = date('d-m-Y', strtotime($blog->getFechaAlta()));
                            ?>
                            <article class="post clearfix">
                                <div class="post-featured-image">
                                    <div class="featured-image">
                                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="blogs/<?= $blog->getSlug() ?>"><img width="440" height="299" src="<?=PATHFRONTEND ?>img/<?= $blog->getSrcImagen() ?>" class="attachment-normal wp-post-image" alt="<?= $blog ?>" title="<?= $blog ?>" /></a>
                                    </div>
                                </div>
                                <div class="post-content">
                                    <h6 class="post-title"><a hreflang="es" type="text/html" charset="iso-8859-1" href="blogs/<?= $blog->getSlug() ?>" title="<?= $blog ?>"><?= $blog ?></a></h6>
                                    <footer class="post-footer clearfix">
                                        <div class="post-comment-count" title="Comentarios"><?= count($blog->getComentarios()); ?></div>
                                        <div class="post-info">
                                            <time datetime="<?= $fechaAlta ?>" title="Fecha de Publicaci&oacute;n"><?= $fechaAlta ?></time>
                                        </div>
                                    </footer>
                                </div>
                            </article>
                            <?php } ?>
                            
                        </div>
                            
                        <!-- comentarios 
                        <div class="widget widget_recent_comments">
                            <div class="section-title"><h4>Comentarios Recientes</h4></div>
                            <ul id="recentcomments">
                                <?php do { ?>
                                <li class="recentcomments">
                                    <?php echo 'nombre'; ?> en <a hreflang="es" type="text/html" charset="iso-8859-1" href="blogs/<?php echo 'seo'; ?>#comment-<?php echo 'idcoment'; ?>">
                                        <?php echo ucwords('blog'); ?>
                                    </a>
                                </li>
                                <?php } while (false); ?>
                            </ul>
                        </div>
                        /comentarios -->
                        
                        
                        <!-- galeria -->
                        <div class="widget widget_text">
                            <div class="section-title"><a hreflang="es" type="text/html" charset="iso-8859-1" href="galeria" title="Ver la Galer&iacute;a Completa"><h4>Galer&iacute;a</h4></a></div>
                            <div class="textwidget">
                                <div class="items-grid">
                                    
                                    <?php 
                                    $i=1;
                                    foreach ($imagenes as $imagen){ 
                                        $last = "";
                                        $clear = "";
                                        if($i++ % 2 == 0){
                                            $last = "last";
                                            $clear = '<div class="clear"></div>';
                                        }
                                    ?>
                                    <div class="column gallery-item sixcol <?= $last ?>">
                                        <div class="featured-image">
                                            <a href="<?=PATHFRONTEND ?>img/<?= $imagen->srcImagen ?>" class="colorbox " data-group="gallery-111" title="<?= $imagen->nombre ?>"><img width="440" height="330" src="<?=PATHFRONTEND ?>img/<?= $imagen->srcImagen ?>" class="attachment-preview wp-post-image" alt="<?= $imagen->nombre ?>" title="<?= $imagen->nombre ?>" /></a>
                                            <a class="featured-image-caption none-caption" href="#">
                                                <h6><?= $imagen->nombre ?></h6>
                                            </a>
                                        </div>
                                        <div class="block-background"></div>
                                    </div>
                                    <?= $clear ?>
                                    <?php } ?>
                                    
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <!-- /galeria -->
                        
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
