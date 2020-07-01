<?php
require_once '../../config.php';
require_once "../../AutoLoader/autoLoader.php";

$producto = $categoria = $catPadre = $idProductoFechaRef = null;
$producSlug = $_GET['slugProduc'] ?? null;
$url = explode("/", trim($_SERVER['REDIRECT_URL'], "/"));
$catPadreSlug = strtolower($url[2]);
$catSlug = strtolower($url[3]);
$categoriaC = new CategoriaController;
$productoC = new ProductoController;
$productoRelList = [];
$showError = null;

try {    
    // CATEGORIA 
    if ($categoria = $categoriaC->getCategoriaBySlug($catSlug)){

        $catPadre = $categoria->getCategoriaPadre();
        $catPadreSlug = $catPadre->getSlug();
        $idProducto = 0;

        if(!is_null($producSlug) and $producto = $productoC->getProductoBySlug($producSlug)){
            $idProducto = $producto->getIdProducto();
            // IMAGENES DEL PRODUCTO
            $imagenList = $producto->getImagenes();
        }

        // CALENDARIO
        $fecha = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');
        $urlNavegation = "paises/{$catPadreSlug}/{$catSlug}/{$producSlug}";
        $eventos = $productoC->getDataForCalendar($idProducto, $fecha, $urlNavegation);
        $showCalendar = CalendarioCT::showCalendarCT($urlNavegation, $eventos, $fecha);

        // FECHA SELECCIONADA
        $fsalidaFiltro = [
            ['idProducto', $idProducto],
            ['fsalida', date('Y-m-d'), ">="],
        ];

        if(isset($_GET['fechaS']) and "" != $_GET['fechaS']){
            $fSeleccionada = $_GET['fechaS'];
            $fsalidaFiltro[] = ['fsalida', $fSeleccionada];
        }

        $fsalida = $fvuelta = $pvp = $duracion = "";
        // TODO: para el producto 7, a fecha 27/06/2020 se muestra en la lista pero no aparece fecha de salida
        if($fSeleccionadaData = @$productoC->getProductoFechaRefPDO($fsalidaFiltro)[0]){
            $idProductoFechaRef = $fSeleccionadaData->getIdProductoFechaRef();
            $fsalida = Util::dateFormat($fSeleccionadaData->getFsalida());
            $fvuelta = ("" != $fSeleccionadaData->getFvuelta()) ?  Util::dateFormat($fSeleccionadaData->getFvuelta()) : "N/A";
            $duracion = Util::duracionCalc($fsalida, $fvuelta);
            $precio = $fSeleccionadaData->getPrecioTotal();
            $pvp = Util::moneda($precio);
        }

        // PRODUCTOS RELACIONADOS
        $productoRelFiltro = [
            ['idCategoria', $categoria->getIdCategoria()],
            ['fsalida', date('Y-m-d'), '>=']
        ];

        if($producto){
            $productoRelFiltro[] = ['idProducto', $producto->getIdProducto(), '!='];
        }

        $limit = [4];
        $productoRelList = $productoC->getProductoFechaRefPDO($productoRelFiltro, [], $limit, ['idProducto']);
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
        <title><?= $producto ?> | Especialistas en el Caribe</title>        
        <meta name="description" content="CaribeTour.es | Agencia especializada en el Caribe y sus paises" />
        <meta name="keywords" content="CaribeTour.es | Agencia especializada en el Caribe y sus paises" />
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
                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises" rel="tag" title="Paises">Paises</a>
                    </div>
                    <div class="breadcrumb">
                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/<?= $catPadreSlug ?>"  rel="tag" title="<?= $catPadre ?>"><?= $catPadre ?></a>
                    </div>
                    <div class="breadcrumb">
                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/<?= $catPadreSlug ?>/<?= $catSlug ?>" rel="tag" title="<?= $categoria ?>"><?= $categoria ?></a>
                    </div>
                    <div class="breadcrumb">
                        <?= $producto ?>
                    </div>
                </div>
                <!-- /breadcrumb-->            
            
                <!-- row -->
                <div class="row">
                <?php 
                if(!is_null($showError)){
                    "<h1 style='color:red'>$showError</h1><br>";
                }
                ?>
                
                <?php if(!is_null($producto) and is_null($showError)){ ?>
                
                <div class="full-tour clearfix">
                    <div class="sixcol column">
                        <div class="content-slider-container tour-slider-container">
                            <div class="content-slider tour-slider">
                                <ul>
                                <li><img src="<?=PATHFRONTEND ?>img/<?= $producto->getImagen() ?>" alt="Imagen de <?= $producto ?>" title="<?= $producto ?>" /></li>
                                <?php foreach ($imagenList as $imagen) { ?>
                                <li><img src="<?=PATHFRONTEND ?>img/<?= $imagen->getSrcImagen() ?>" alt="Imagen de <?= $producto ?>" title="<?= $producto ?>" /></li>
                                <?php } ?>
                                </ul>
                                <div class="arrow arrow-left content-slider-arrow"></div>
                                <div class="arrow arrow-right content-slider-arrow"></div>
                                <input type="hidden" class="slider-speed" value="400" />
                                <input type="hidden" class="slider-pause" value="6000" />
                            </div>
                            <div class="block-background layer-1"></div>
                            <div class="block-background layer-2"></div>
                        </div>
                    </div>
                    <div class="sixcol column last">
                        <div class="section-title">
                            <h1><?= $producto ?></h1>
                        </div>
                        <ul class="tour-meta">
                            <li>
                                <div class="colored-icon icon-2"></div>
                                <strong>Destino:</strong> <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/<?= $catPadreSlug ?>/<?= $catSlug ?>" rel="tag" title="Ver paises en subCategoria"><?= $categoria ?></a>
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
                                <strong>Facturación:</strong> <?= $producto->getTipoFacturacion() ?>
                            </li>                            
                        </ul>
                        <div style="font-size:1.8em;">
                            <strong>Precio:</strong> <span id="pvp"><?= $pvp ?></span>
                        </div>
                        <br>
                        <p>
                            <?= $producto->getDescripcion() ?>
                        </p>
                        <footer class="tour-footer"> 
                            <a hreflang="es" type="text/html" charset="utf-8" href="reserva-cliente-datos.php?idProducto=<?= $idProducto ?>&amp;idProductoFechaRef=<?= $idProductoFechaRef ?>" title="Solicitar la reserva de <?= $producto ?>" class="button small"><span>Reservar Ahora</span></a> 
                            <a href="#question-form" data-id="<?= $producto ?>" data-title="<?= $producto ?>" class="button grey small colorbox inline"><span>Consultar</span></a> 
                        </footer>
                    </div>
                </div>
                
                
                
               <!-- question form -->
                <?php include("includes/mailconsulta.php"); ?>
                <!-- /question form -->
                <div class="sixcol column">
                    <div class="tour-itinerary">
                        <div class="tour-day">
                            <div class="tour-day-number">
                                <h5>Itinerario</h5>
                            </div>
                            <div class="tour-day-text clearfix">
                                <div class="bubble-corner"></div>
                                <div class="bubble-text">
                                    <div class="column twelvecol last">
                                        <h5><?= $producto ?></h5>
                                        <p><?= $producto->getItinerario() ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tour-day">
                            <div class="tour-day-number">
                                <h5>Incluye</h5>
                            </div>
                            <div class="tour-day-text clearfix">
                                <div class="bubble-corner"></div>
                                <div class="bubble-text">
                                    <div class="column twelvecol last">
                                        <h5><?= $producto ?></h5>
                                        <p><?= $producto->getIncluye() ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sixcol column last">  
                    <?= $showCalendar ?>
                </div>
                <?php } ?>
		
		<?php if(is_null($producto)){ ?>
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
                
                <div class="clear"></div>
                
                <!-- related tours -->
                <?php if(!empty($productoRelList)) { ?>
                <div class="related-tours clearfix">
                    <div class="section-title">
                    	<h2>Destinos Relacionados</h2>
                    </div>
                    <div class="items-grid">
                    
                        <?php 
                        $i = 1;
                        foreach($productoRelList as $productoRel) { 
                            $producto = $productoC->getProductoById($productoRel->getIdProducto());
                            $last = $i++ % 4 == 0 ? "last" : "";
                        ?>
                        <div class="column threecol <?= $last ?>">
                            <div class="tour-thumb-container">
                                <div class="tour-thumb"> <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/<?= $catPadre->getSlug() ?>/<?= $categoria->getSlug() ?>/<?= $producto->getSlug() ?>" title="<?= $producto ?>"><img width="440" height="330" src="<?=PATHFRONTEND ?>img/<?= $producto->getImagen() ?>" class="attachment-preview wp-post-image" alt="<?= $producto ?>" /></a>
                                    <div class="tour-caption">
                                        <h5 class="tour-title">
                                                <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/<?= $catPadreSlug ?>/<?= $catSlug ?>/<?= $producto->getSlug() ?>" title="<?= $producto ?>"> <?= $producto ?> </a>
                                        </h5>
                                        <div class="tour-meta">
                                            <div class="tour-destination">
                                                <div class="colored-icon icon-2"></div>
                                                <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/<?= $catPadreSlug ?>/<?= $catSlug ?>" rel="tag" title="<?= $categoria ?>"><?= $categoria ?></a>
                                            </div>
                                            <div class="colored-icon icon-3"></div><div class="precio"><?= Util::moneda($producto->getPrecioMasBajo()) ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="block-background"></div>
                            </div>
                        </div>
                        <?php }  ?>
                        
                        <div class="clear"></div>
                    </div>
                </div>
                <?php } ?>
                <!-- /related tours -->
                
            </div>
            <!-- /row -->
                
                
                
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