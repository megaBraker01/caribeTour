<?php
require_once '../../config.php';
require_once "../../AutoLoader/autoLoader.php";

$productoList = [];
$slugCat = $_GET['slugCat'] ?? "";
$catNombre = ucfirst($slugCat);
$slugCatPadre = $categoria = $catPadre = null;
$mostrarDesde = $pagActual = $pagTotal = 1;
$mostrarProductos = [];
$productoC = new ProductoController;
$categoriaC = new CategoriaController;

if  (
    isset($slugCat) and 
    $slugCat != "" and
    $categoria = $categoriaC->getCategoriaBySlug($slugCat)
    ){
    
    $catPadre = $categoria->getCategoriaPadre();
    $slugCatPadre = $catPadre->getSlug(); 
    $idCategoria = $categoria->getIdCategoria();
    $filtros = [
        ['idCategoria', $idCategoria],
        ['fsalida', date('Y-m-d'), '>=']
    ];
    $ordenados = [['idCategoriaPadre'],['precioProveedor']];
    $limitar = [];
    $agrupar = ['idProducto'];
    $categoriaList = $productoC->getProductoFechaRefPDO($filtros, $ordenados, $limitar, $agrupar);
    
    // PAGINACION
    $productoTotales = count($categoriaList);
    $mostrarItems = 4;
    $pag = $_GET['pag'] ?? 1;
    $pagTotal = ceil($productoTotales / $mostrarItems);
    $pagActual = ($pag < 1 OR $pag > $pagTotal) ? 1 : $pag;
    $mostrarDesde = ($pagActual - 1) * $mostrarItems;
    $mostrarProductos = array_slice($categoriaList, $mostrarDesde, $mostrarItems);
}
?>
<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <?php include_once("includes/metatag.php"); ?>
        <meta property="og:title" content="Caribetour.es | Especialistas en el Caribe" />
        <meta name="title" content="CaribeTour.es: Especialistas en el Caribe" />
        <meta name="DC.title" content="CaribeTour.es: Especialistas en el Caribe" />
        <title><?= $catNombre ?> | Caribetour.es Especialistas en el Caribe</title>        
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
                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/<?= $slugCatPadre ?>" rel="tag" title="<?= $catPadre ?>"><?= $catPadre ?></a>
                    </div>
                    <div class="breadcrumb">
                        <?= $categoria ?>
                    </div>
                </div>
                <!-- /breadcrumb-->            
            
            
                <div class="row">
                    <div class="column ninecol">
			<?php echo "<h1>Por favor rellene todos los campos del formulario.</h1><br>";?>
                        <?php echo "<h1>Gracias por su consulta, los datos se han enviado correctamente.</h1><br>"; ?>
                        <?php echo "<h1 style='color:red'>Error al enviar los datos del formulario, por favor int&eacute;ntelo de nuevo.</h1><br>"; ?>
                        <?php // Show if recordset not empty ?>
                        <div class="items-list clearfix">
                            
                            <?php 
                            $i = 1; 
                            foreach ($mostrarProductos as $utilProducto){
                                $producto = $productoC->getProductoById($utilProducto->getIdProducto());
                                $precioMasBajo = $producto->getPrecioMasBajo();
                                $fsalida = new DateTime($utilProducto->getFsalida());
                                $fvuelta = new DateTime($utilProducto->getFvuelta());
                                $duracion = $fsalida->diff($fvuelta);
                            ?>
                            <div class="full-tour clearfix">
                                
                                <div class="fivecol column">
                                    <div class="content-slider-container tour-slider-container">
                                        <div class="featured-image">
                                            <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/<?=$catPadre->getSlug() ?>/<?=$categoria->getSlug() ?>/<?=$producto->getSlug() ?>">
                                                <img width="550" height="413" src="<?php echo PATHFRONTEND."img/{$producto->getImagen()}"; ?>" class="attachment-extended wp-post-image" alt="<?=$producto->getNombre() ?>" title="<?=$producto->getNombre() ?>" />
                                            </a>
                                        </div>
                                        <div class="block-background layer-2"></div>
                                    </div>
                                </div>
                                
                                <div class="sevencol column last">
                                    <div class="section-title">
                                        <h1>
                                            <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/<?=$catPadre->getSlug() ?>/<?=$categoria->getSlug() ?>/<?=$producto->getSlug() ?>" title="<?=$producto->getNombre() ?>"><?=$producto->getNombre() ?></a>
                                        </h1>
                                    </div>
                                    <ul class="tour-meta">
                                        <li>
                                            <div class="colored-icon icon-2"></div>
                                            <strong>Destino:</strong>
                                            <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/<?=$catPadre->getSlug() ?>/<?=$categoria->getSlug() ?>" title="Ver todos los destinos de <?=$catPadre ?>" rel="tag">
                                                <?=$categoria->getNombre() ?>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="colored-icon icon-1">
                                                <span></span>
                                            </div>
                                            <strong>Duraci&oacute;n:</strong> <?= $duracion->format('%d'); ?> D&iacute;as
                                        </li>
                                        <li style="font-size:1.8em;">
                                            <div class="colored-icon icon-3"><span></span></div>
                                            <strong>Desde:</strong> <?= Util::moneda($precioMasBajo) ?>
                                        </li>
                                    </ul>
                                    <p><?= substr($producto->getDescripcion(),0,261); ?>.[...]</p>
                                    <footer class="tour-footer">
                                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/<?=$catPadre->getSlug() ?>/<?=$categoria->getSlug() ?>/<?=$producto->getSlug() ?>" class="button small" title="Saber m&aacute;s sobre <?=$producto->getNombre() ?>">
                                            <span>Saber M&aacute;s</span>
                                        </a>
                                        <a href="#question-form" data-id="<?=$producto->getNombre() ?>" data-title="<?=$producto->getNombre() ?>" class="button grey small colorbox inline" title="Hacer una consulta">
                                            <span>Consultar</span>
                                        </a>
                                    </footer>
                                </div>
                                
                            </div>
                            <?php } ?>
                            
                        </div>
                        
                        
                        <?php if(empty($categoriaList)){ ?>
                        <div class="column ninecol">
                            <div class="items-list clearfix">
                                <h3>Sin Resultados...</h3>
                                <p>Lo sentimos, no hemos encontrado Destinos con estas caracter&iacute;sticas, puedes intentar buscando en el men&uacute; superior<a hreflang="es" type="text/html" charset="iso-8859-1" href="paises"> Paises</a> o trata cambiando los parametros de b&uacute;squeda.</p>
                                <img src="<?php echo PATHFRONTEND ?>/images/no-encontrado.gif" title="Ehhhhh..... No lo encuentro." alt="Sin Resultados..."><br>
                            </div>
                        </div>
			<?php } ?>
                        
                        <?php if(!empty($categoriaList)){ ?>
                        <nav class="pagination">
                        <?php 
			for ($i = 1; $i <= $pagTotal; $i++){
                            if ($i == $pagActual)
                                echo "<span class='page-numbers current'>".$i."</span>";
                            else
				echo "<a hreflang='es' type='text/html' charset='iso-8859-1' href='paises/{$catPadre->getSlug()}/{$categoria->getSlug()}/pag=$i' class='page-numbers' title='Pasar a la p&aacute;gina $i'>$i</a>";
			} 
			?>
                        </nav>
                        <?php } ?>
                        
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
                                <div class="featured-image">
                                    <a hreflang="es" type="text/html" charset="iso-8859-1" href="">
                                        <img src="<?php echo PATHFRONTEND ?>images/image_18.jpg" alt="" />
                                    </a>
                                </div>
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
