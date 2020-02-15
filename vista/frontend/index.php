<?php
require_once '../../config.php';
require_once "../../AutoLoader/autoLoader.php";

$productoC = new ProductoController;
$productoFechaC = new ProductoFechaRefController;

// CATEGORIAS (SLIDER)
$productoFiltro = [
    ['idEstado', '=', 1],
    ['stock', '>', 0]
];
// 1ro- obtenemos los productos disponibles y que agrupamos por categoria
$productoLista = $productoC->select($productoFiltro, [], [], ['idCategoria']);
$productoIds = [];

// 2do- solo nos quedamos con los ids para luego filtrar las fechas
foreach($productoLista as $producto){
    $productoIds[] = $producto->getIdproducto();
}

// 3ro- filtramos las fechas de los productos obtenidos y las organizamos por precio
$showProductoIds = implode(', ', $productoIds);
$productoFechaOrder = [['precioProveedor']];
$productoFechaSlider = $productoFechaC->select([['idProducto', 'in', $showProductoIds]], $productoFechaOrder);


// PRODUCTOS
$productoList = $productoC->select($productoFiltro,[],[6]);
foreach($productoList as $producto){
    $productoIds[] = $producto->getIdproducto();
}
$showProductoIds = implode(', ', $productoIds);
$productosMostrarList = $productoFechaC->select([['idProducto', 'in', $showProductoIds]], $productoFechaOrder);



// BLOG
$blogC = new BlogController();
$blogFiltro = [
    ['idEstado', '=', 1]
];
$blogOrder = [['fechaAlta', 'DESC']];
$blogLimit = [1];
$blogLista = $blogC->select($blogFiltro, $blogOrder, $blogLimit);
$blog = null;
if(count($blogLista) > 0){
    $blog = $blogLista[0];
}


// GALERIA
$productoGaleriaList = $productoC->select([],[],[6]);
?>
<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <?php include_once("includes/metatag.php"); ?>
        <meta property="og:title" content="Caribetour.es | Especialistas en el Caribe" />
        <meta name="title" content="CaribeTour.es: Especialistas en el Caribe" />
        <meta name="DC.title" content="CaribeTour.es: Especialistas en el Caribe" />
        <title>CaribeTour.es | Especialistas en el Caribe</title>        
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
        <!-- DOTO: poner los js necesarios en un include -->
        <script type='text/javascript' src='<?=PATHFRONTEND ?>js/jquery.js?ver=1.10.2'></script>
        <script type='text/javascript' src='<?=PATHFRONTEND ?>js/jquery-migrate.min.js?ver=1.2.1'></script>
        <script type='text/javascript' src='<?=PATHFRONTEND ?>js/comment-reply.min.js?ver=3.7.11'></script>
        <script type='text/javascript' src='<?=PATHFRONTEND ?>js/jquery.hoverIntent.min.js?ver=3.7.11'></script>
        <script type='text/javascript' src='<?=PATHFRONTEND ?>js/jquery.ui.touchPunch.js?ver=3.7.11'></script>
        <script type='text/javascript' src='<?=PATHFRONTEND ?>js/jquery.colorbox.min.js?ver=3.7.11'></script>
        <script type='text/javascript' src='<?=PATHFRONTEND ?>js/jquery.placeholder.min.js?ver=3.7.11'></script>
        <script type='text/javascript' src='<?=PATHFRONTEND ?>js/jquery.themexSlider.js?ver=3.7.11'></script>
        <script type='text/javascript' src='<?=PATHFRONTEND ?>js/jquery.textPattern.js?ver=3.7.11'></script>
        <script type='text/javascript' src='<?=PATHFRONTEND ?>js/general.js?ver=3.7.11'></script>
        <?php include_once("includes/css.php");?>
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
                <img src="<?=PATHFRONTEND ?>images/site_bg.jpg" class="fullwidth" alt="Imagen de fondo" />
            </div>
            <!-- background -->
            <!-- supheader -->
            <?php include_once("includes/header.php");?>                
            <div class="row subheader">
                <div class="threecol column subheader-block">
                    <!-- tour search form -->
                    <?php include_once("includes/buscador.php");?>	
                    <!-- /tour search form -->	
                </div>
                <div class="ninecol column subheader-block last">
                    <div class="main-slider-container content-slider-container">
                        <div class="content-slider main-slider" id="slider" style="position:relative">
                            <ul>
                                <?php foreach ($productoFechaSlider as $productoFecha){ ?>
                                <?php
                                $producto = $productoFecha->getProducto();
                                $categoria = $producto->getCategoria();
                                $categoriaPadre = $categoria->getCategoriaPadre();
                                $precio = $productoFecha->getPrecioProveedor();
                                $precio += ($productoFecha->getPrecioProveedor() * $productoFecha->getComision()) / 100;
                                ?>
                                <li>
                                    <div class="featured-image">
                                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/<?= $categoriaPadre->getSlug() ?>/<?= $categoria->getSlug() ?>">
                                            <div class="etiqueta-categoria" id="etiqueta">
                                                <?= $categoria ?> desde <?= $precio ?>&euro;
                                            </div>
                                            <img width="824" height="370" src="<?=PATHFRONTEND ?>img/<?= $categoria->getSrcImagen() ?>" class="attachment-large wp-post-image" alt="<?= $categoria ?>" title="Ver Todos Los destinos de <?= $categoria ?>"/>
                                        </a>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                            <div class="arrow arrow-left content-slider-arrow"></div>
                            <div class="arrow arrow-right content-slider-arrow"></div>
                            <input type="hidden" class="slider-pause" value="7008" />
                            <input type="hidden" class="slider-speed" value="400" />
                            <input type="hidden" class="slider-effect" value="fade" />
                        </div>
                        <div class="block-background layer-1"></div>
                        <div class="block-background layer-2"></div>
                    </div>
                </div>
            </div>
            <!-- /subheader -->
            <div class="block-background header-background"></div>
        </header>
        <!-- /header -->
        
        <!-- content -->
        <section class="container site-content">
            <div class="row">
                <div class="eightcol column">
                    <div class="fivecol column">
                        <img alt="CaribeTour.es | Explora el mundo" class="alignnone size-medium wp-image-21 demo-image" title="CaribeTour.es | Explora el mundo" src="<?=PATHFRONTEND ?>images/explora.jpg" />
                    </div>
                    <div class="sevencol column last">
                        <div class="section-title">
                            <h1>Explora el Mundo con CaribeTour.es</h1>
                        </div>
                        <span>
                            El Caribe es una regi&oacute;n maravillosa que ofrece todos los atractivos necesarios: gente alegre y hospitalaria que le recibir&aacute; con una sonrisa, playas v&iacute;rgenes e interminables, bellas monta&ntilde;as repletas de vegetaci&oacute;n tropical, mares de colores &uacute;nicos y fondos sorprendentes, cuevas ancestrales, amaneceres sobrecogedores y una gastronom&iacute;a sabrosa hasta para los paladares m&aacute;s exquisitos.!
                        </span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="fourcol column last">
                    <div class="content-slider testimonials-slider">
                        <ul>
                            <li>
                                <article class="testimonial">
                                    <div class="quote-text">
                                        <div class="block-background">
                                            Tuvimos el más increíble viaje de luna de miel en Punta Cana gracias a ustedes. Sin dudas el viaje superó con creces nuestras expectativas. Gracias!
                                        </div>
                                    </div>
                                    <h6 class="quote-author">Maria Taveras</h6>
                                </article>
                            </li>
                            <li>
                                <article class="testimonial">
                                    <div class="quote-text">
                                        <div class="block-background">
                                            Todo fue absolutamente increíble y todos los detalles eran simplemente perfecto. han hecho todo el viaje sin complicaciones! El mejor viaje que he tenido.
                                        </div>
                                    </div>
                                    <h6 class="quote-author">Juan Fornel Jimenez</h6>
                                </article>
                            </li>
                            <li>
                                <article class="testimonial">
                                    <div class="quote-text">
                                        <div class="block-background">
                                            Thank you for the marvelous trip you arranged in the Dominican Republic. We could never have put together such a well-planned visit by ourselves. Amazing!
                                        </div>
                                    </div>
                                    <h6 class="quote-author">Lisa Blackwood</h6>
                                </article>
                            </li>
                        </ul>
                        <input type="hidden" class="slider-pause" value="0" />
                        <input type="hidden" class="slider-speed" value="400" />
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </section>
        
        <section class="container content-section">
            <div class="substrate section-substrate">
                <img src="<?=PATHFRONTEND ?>images/background_1.jpg" class="fullwidth" alt="" />
            </div>
            <div class="row">
                
                <!-- producto -->
                <div class="items-grid">
                    
                    <?php $i=1; foreach ($productosMostrarList as $productoFecha) { ?>
                    <?php
                    $producto = $productoFecha->getProducto();
                    $categoria = $producto->getCategoria();
                    $categoriPadre = $categoria->getCategoriaPadre();
                    $precio = $productoFecha->getPrecioProveedor();
                    $precio += ($productoFecha->getPrecioProveedor() * $productoFecha->getComision()) / 100;                    
                    ?>
                    
                    <div class="column threecol <?php if ($i % 4==0){ echo 'last'; }?>">
                        <div class="tour-thumb-container">
                            <div class="tour-thumb">
                                <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/<?= $categoriPadre->getSlug() ?>/<?= $categoria->getSlug() ?>/<?= $producto->getSlug() ?>">
                                    <img width="440" height="330" src="<?=PATHFRONTEND ?>img/<?= $producto->getImagen() ?>" class="attachment-preview wp-post-image" alt="<?= $producto ?>" title="<?= $producto ?>" />
                                </a>
                                <div class="tour-caption">
                                    <h5 class="tour-title">
                                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/<?= $categoriPadre->getSlug() ?>/<?= $categoria->getSlug() ?>/<?= $producto->getSlug() ?>" title="<?= $producto ?>"><?= $producto ?></a>
                                    </h5>
                                    <div class="tour-meta">
                                        <div class="tour-destination">
                                            <div class="colored-icon icon-2"></div>
                                            <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/<?= $categoriPadre->getSlug() ?>/<?= $categoria->getSlug() ?>" rel="tag" title="Ver todos los destinos de <?= $categoria ?>"><?= $categoria ?></a>
                                        </div>
                                        <div class="colored-icon icon-3"></div><div class="precio"><?= $precio ?>&euro;</div>
                                    </div>
                                </div>
                            </div>
                            <div class="block-background"></div>
                        </div>
                    </div>
                    
                    <?php if ($i % 4==0){ echo '<div class="clear"></div>'; }?>
                    <?php $i++; } ?>
                    
                    <div class="clear"></div>
                </div>
                <!-- producto -->
            </div>
        </section>
        
        <section class="container site-content">
            <div class="row">
                
                
                <!-- blog -->
                <div class="threecol column">
                    <div class="section-title">
                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="blogs" title="Blogs de Viajes"><h2>Blogs de Viajes</h2></a>
                    </div>
                    
                    <div class="featured-blog">
                        <?php if($blog) { ?>
                        <article class="post type-post status-publish format-standard hentry category-guides post">
                            <div class="featured-image">
                                <a hreflang="es" type="text/html" charset="iso-8859-1" href="blogs/<?= $blog->getSlug() ?>"><img width="440" height="299" src="<?=PATHFRONTEND ?>img/<?= $blog->getSrcImagen() ?>" class="attachment-normal wp-post-image" alt="Imagen de <?= $blog ?>" title="<?= $blog ?>" /></a>
                            </div>
                            <div class="post-content">
                                <h5 class="post-title">
                                    <a hreflang="es" type="text/html" charset="iso-8859-1" href="blogs/<?= $blog->getSlug() ?>" title="<?= $blog ?>"><?= $blog ?></a>
                                </h5>
                                <p><?php echo substr(nl2br($blog->getDescripcion()), 0, 400); ?>.[...]</p>
                            </div>
                            <footer class="post-footer clearfix">
                                <a hreflang="es" type="text/html" charset="iso-8859-1" href="blogs/<?= $blog->getSlug() ?>" class="button small" title="Leer m&aacute;s">Leer M&aacute;s</a>
                                <div class="post-comment-count">1</div>
                                <div class="post-info">
                                    <time datetime="<?= $blog->getFechaAlta() ?>"><?= $blog->getFechaAlta() ?></time>
                                </div>
                            </footer>
                        </article>
                        <?php } else { ?>
                        <h3>Por el momento No hay articulos publicados</h3>
                        <?php } ?>
                    </div>
                    
                </div>
                <!-- /blog -->
                
                
                <!-- galeria -->
                <div class="sixcol column">
                    <div class="section-title">
                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="galeria" title="Ver la Galer&iacute;a Completa"><h2>Galer&iacute;a</h2></a>
                    </div>
                    <div class="items-grid">
                        
                        <?php $i=1; foreach($productoGaleriaList as $producto) { ?>
                        <div class="column gallery-item fourcol <?php if ($i % 3==0){ echo 'last'; }?>">
                            <div class="featured-image">
                                <a hreflang="es" type="text/html" charset="iso-8859-1" href="<?=PATHFRONTEND ?>img/<?= $producto->getImagen() ?>" class="colorbox " data-group="gallery-<?= $producto->getIdProducto() ?>" title="<?= $producto ?>">
                                    <img width="440" height="330" src="<?=PATHFRONTEND ?>img/<?= $producto->getImagen() ?>" class="attachment-preview wp-post-image" alt="<?= $producto ?>" />
                                </a>                                
                                <?php foreach ($producto->getImagenes() as $imagen) { ?>
                                <a href="<?=PATHFRONTEND ?>img/<?= $imagen ?>" class="colorbox " data-group="gallery-<?= $imagen->getIdProducto() ?>" title="<?= $producto ?>"></a>
                                <?php } ?>
                                <a class="featured-image-caption visible-caption" href="#"><h6><?= $producto ?></h6></a>
                            </div>
                            <div class="block-background"></div>
                        </div>
                        <?php if ($i % 3 == 0){ echo '<div class="clear"></div>'; }?>
                        <?php $i++;  } ?>
                        
                        <div class="clear"></div>
                    </div>
                </div>
                <!-- /galeria -->
                
                <!-- twitter -->
                <div class="threecol column last">
                    <div class="widget widget-twitter">
                        <div class="section-title">
                            <h2>&Uacute;ltimos Tweets</h2>
                        </div>
                        <div id="tweets">
                            <a class="twitter-timeline" href="https://twitter.com/CaribeToures" data-widget-id="508241026889162754">Tweets por @CaribeToures</a> 
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                        </div>
                    </div>
                </div>
                <!-- /twitter -->
                
                <div class="clear"></div>
            </div>		
        </section>
        <!-- /content -->
        
        <!-- footer -->
        <?php include_once("includes/footer.php");?>
        <!-- footer -->
        
        <div class="substrate bottom-substrate">
            <img src="<?=PATHFRONTEND ?>images/site_bg.jpg" class="fullwidth" alt="Imagen de fondo" />
        </div>
	</div>
        <!-- /container -->
        
	<script type='text/javascript' src='<?=PATHFRONTEND ?>js/jquery.ui.core.min.js?ver=1.10.3'></script>
        <script type='text/javascript' src='<?=PATHFRONTEND ?>js/jquery.ui.widget.min.js?ver=1.10.3'></script>
        <script type='text/javascript' src='<?=PATHFRONTEND ?>js/jquery.ui.mouse.min.js?ver=1.10.3'></script>
        <script type='text/javascript' src='<?=PATHFRONTEND ?>js/jquery.ui.slider.min.js?ver=1.10.3'></script>
        <script type='text/javascript' src='<?=PATHFRONTEND ?>js/jquery.ui.datepicker.min.js?ver=1.10.3'></script>
    </body>
</html>
