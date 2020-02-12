<?php
require_once '../../config.php';
require_once "../../AutoLoader/autoLoader.php";

$producto = null;
$producSlug = $_GET['slugProduc'] ?? null;
$url = explode("/", trim($_SERVER['REDIRECT_URL'], "/"));
$catPadreSlug = $url[2];
$catSlug = $url[3];

$categoriaC = new CategoriaController;
$catList = $categoriaC->select([['slug', '=', $catSlug]]);
$categoria = $catList[0];
$catPadre = $categoria->getCategoriaPadre();

if(isset($producSlug) and $producSlug != ""){
    $productoC = new ProductoController;
    $filtro = [
    	['slug', '=', $producSlug],
    	['idEstado', '=', 1],
    	['stock', '>', 0]
    ];
    
    $productoList = $productoC->select($filtro);
    
    if(isset($productoList[0])){
        $producto = $productoList[0];
        
        // IMAGENES DEL PRODUCTO
        $imagenC = new ImagenController;
        $imagenList = $imagenC->select([['idProducto', '=', $producto->getIdProducto()]]);
    }
}


// PRODUCTOS RELACIONADOS
$productoRelFiltro = [
    ['idCategoria', '=', $categoria->getIdCategoria()],
    ['idEstado', '=', 1],
    ['stock', '>', 0]
];

if($producto){
    $productoRelFiltro[] = ['idProducto', '!=', $producto->getIdProducto()];
}

$productoRelList = $productoC->select($productoRelFiltro);
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
                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/<?= $catPadre->getSlug() ?>"  rel="tag" title="<?= $catPadre ?>"><?= $catPadre ?></a>
                    </div>
                    <div class="breadcrumb">
                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/<?= $catPadre->getSlug() ?>/<?= $categoria->getSlug() ?>" rel="tag" title="<?= $categoria ?>"><?= $categoria ?></a>
                    </div>
                    <div class="breadcrumb">
                        <?= $producto ?>
                    </div>
                </div>
                <!-- /breadcrumb-->            
            
            
                <div class="row">
                <?php echo "<h1>Por favor rellene todos los campos del formulario.</h1><br>";?>
                <?php echo "<h1>Gracias por su consulta, los datos se han enviado correctamente.</h1><br>"; ?>
                <?php echo "<h1 style='color:red'>Error al enviar los datos del formulario, por favor int&eacute;ntelo de nuevo.</h1><br>";?>
                
                <?php if(!is_null($producto)){ ?>
                
                <div class="full-tour clearfix">
                    <div class="sixcol column">
                        <div class="content-slider-container tour-slider-container">
                            <div class="content-slider tour-slider">
                                <ul>
                                <li><img src="<?=PATHFRONTEND ?>img/<?= $producto->getImagen() ?>" alt="Imagen de <?= $producto ?>" title="<?= $producto ?>" /></li>
                                <?php foreach ($imagenList as $imagen) {?>
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
                                <strong>Destino:</strong> <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/categoria/subCategoria" rel="tag" title="Ver paises en subCategoria"><?= $producto->getCategoria() ?></a>
                            </li>
                            <li>
                                <div class="colored-icon icon-1"><span></span></div>
                                <strong>Duracion:</strong> <?php $duracion=strtotime("01/02/2020") - strtotime("25/01/2020"); echo date('d',$duracion)*1; ?> D&iacute;as
                            </li>
                            <li>
                                <div class="colored-icon icon-6"><span></span></div>
                                <strong>Salida:</strong> 25/01/2020
                            </li>
                            <li>
                                <div class="colored-icon icon-7"><span></span></div>
                                <strong>Regreso:</strong> 02/02/2020
                            </li>
                            <li style="font-size:1.8em;">
                                <div class="colored-icon icon-3"><span></span></div>
                                <strong>Precio:</strong> 965&euro;
                            </li>
                        </ul>
                        <p><?= $producto->getDescripcion() ?></p>
                        <footer class="tour-footer"> 
                            <a hreflang="es" type="text/html" charset="iso-8859-1" href="cliente-datos.php?idproducto=idProducto&amp;idFecha=idFecha" title="Solicitar la reserva de <?= $producto ?>" class="button small"><span>Reservar Ahora</span></a> 
                            <a href="#question-form" data-id="<?= $producto ?>" data-title="<?= $producto ?>" class="button grey small colorbox inline"><span>Consultar</span></a> 
                        </footer>
                    </div>
                </div>
                
                
                
               <!-- question form -->
                <?php include("includes/mailconsulta.php"); ?>
                <!-- /question form -->
                </div>
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
                    <div class="calendario">        
                        <table summary="Calendario con las fechas de salida para el tour <?= $producto ?>">
                            <caption><h3>El&iacute;ge la fecha de salida</h3></caption>
                            <colgroup span="7" style="width:14.29%; text-align:left; vertical-align:top; height:39px;" />
                            <thead>
                                <tr>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th scope="col" abbr="Domingo">Dom</th><th scope="col" abbr="Lunes">Lun</th><th scope="col" abbr="Martes">Mar</th><th scope="col" abbr="Mi&eacute;rcoles">Mie</th><th scope="col" abbr="Jueves">Jue</th><th scope="col" abbr="Viernes">Vie</th><th scope="col" abbr="S&aacute;bado">Sab</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } ?>
		
		<?php if(is_null($producto)){ ?>
				
                <h3>Sin Resultados...</h3>
                <p>Lo sentimos, el destino elegido <strong>NO</strong> se encuentra disponible en estos momentos, Puedes echar un vistazo a los paises relacionados.. Disculpen las molestias.</p>
                <img src="<?=PATHFRONTEND ?>images/no-encontrado.gif" title="Ehhhhh..... No lo encuentro." alt="Sin Resultados...">
                
                <?php } ?>
                
                <div class="clear"></div>
                
                <!-- related tours -->
                <?php if(!empty($productoRelList)) { ?>
                <div class="related-tours clearfix">
                    <div class="section-title">
                    	<h2>Destinos Relacionados</h2>
                    </div>
                    <div class="items-grid">
                    
                        <?php foreach($productoRelList as $productoRel) { ?>
                        <div class="column threecol ">
                            <div class="tour-thumb-container">
                                <div class="tour-thumb"> <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/<?= $catPadre->getSlug() ?>/<?= $categoria->getSlug() ?>/<?= $productoRel->getSlug() ?>" title="<?= $productoRel ?>"><img width="440" height="330" src="<?=PATHFRONTEND ?>img/<?= $productoRel->getImagen() ?>" class="attachment-preview wp-post-image" alt="<?= $productoRel ?>" /></a>
                                    <div class="tour-caption">
                                        <h5 class="tour-title">
                                                <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/<?= $catPadre->getSlug() ?>/<?= $categoria->getSlug() ?>/<?= $productoRel->getSlug() ?>" title="<?= $productoRel ?>"> <?= $productoRel ?> </a>
                                        </h5>
                                        <div class="tour-meta">
                                            <div class="tour-destination">
                                                <div class="colored-icon icon-2"></div>
                                                <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/<?= $catPadre->getSlug() ?>/<?= $categoria->getSlug() ?>" rel="tag" title="<?= $categoria ?>"><?= $categoria ?></a>
                                            </div>
                                            <div class="colored-icon icon-3"></div>654&euro;
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
