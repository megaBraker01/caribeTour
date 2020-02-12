<?php require_once('Connections/conexionturismo.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$varSeo_seo = "0";
if (isset($_GET["seoProd"])) {
  $varSeo_seo = $_GET["seoProd"];
}
mysql_select_db($database_conexionturismo, $conexionturismo);
$query_seo = sprintf("SELECT tblcategoria.idCategoria, tblcategoria.idPadre AS padre, tblcategoria.strDescripcion AS subCategoria, tblcategoria.strSEO AS seoSubCategoria, (SELECT tblcategoria.strDescripcion FROM tblcategoria WHERE idCategoria = padre LIMIT 1) AS categoria, (SELECT tblcategoria.strSEO FROM tblcategoria WHERE idCategoria = padre LIMIT 1) AS seoCategoria, tblproducto.strNombre AS producto, tblproducto.strDescripcion FROM tblcategoria INNER JOIN tblproducto ON tblcategoria.idCategoria = tblproducto.intCategoria WHERE tblproducto.strSEO = %s LIMIT 1", GetSQLValueString($varSeo_seo, "text"));
$seo = mysql_query($query_seo, $conexionturismo) or die(mysql_error());
$row_seo = mysql_fetch_assoc($seo);
$totalRows_seo = mysql_num_rows($seo);

$seoProduct_producto = "0";
if (isset($_GET["seoProd"])) {
  $seoProduct_producto = $_GET["seoProd"];
}
mysql_select_db($database_conexionturismo, $conexionturismo);
$query_producto = sprintf("SELECT tblproducto.idProducto, tblproducto.intCategoria, tblproducto.strNombre, tblproducto.strSEO, tblproducto.strDescripcion, tblproducto.strImagen, tblproducto.strIncluye, tblproducto.strItinerario, tblproducto.strMetaDescripcion, tblproducto.strMetakeyWords, tblcategoria.idPadre AS padre, tblcategoria.strDescripcion AS subcategoria, tblcategoria.strSEO AS seoSubCat, (SELECT tblcategoria.strDescripcion FROM tblcategoria WHERE tblcategoria.idCategoria = padre LIMIT 1) AS categoria, (SELECT tblcategoria.strSEO FROM tblcategoria WHERE tblcategoria.idCategoria = padre LIMIT 1) AS seoCategoria, tblproducto.intEstrellas, tblfechas.idFecha, tblfechas.idFecha AS id, (SELECT Sum(tblfechas.dblPrecio + tblfechas.dblTasas) FROM tblfechas WHERE tblfechas.idFecha = id) AS dblPrecio, tblfechas.fchIda, tblfechas.fchVuelta, tblfechas.dblTasas FROM tblproducto INNER JOIN tblcategoria ON tblproducto.intCategoria = tblcategoria.idCategoria INNER JOIN tblfechas ON tblproducto.idProducto = tblfechas.idProducto WHERE tblproducto.intEstado = 1 AND tblproducto.intStock > 0 AND tblproducto.intTipo = 1 AND tblcategoria.intEstado = 1 AND tblproducto.strSEO = %s AND tblfechas.fchIda > NOW() ORDER BY tblfechas.fchIda ASC LIMIT 1", GetSQLValueString($seoProduct_producto, "text"));
$producto = mysql_query($query_producto, $conexionturismo) or die(mysql_error());
$row_producto = mysql_fetch_assoc($producto);
$totalRows_producto = mysql_num_rows($producto);
$_SESSION['producto']=$row_producto['strNombre'];

$idProducto_imagenes = "0";
if (isset($row_producto['idProducto'])) {
  $idProducto_imagenes = $row_producto['idProducto'];
}
mysql_select_db($database_conexionturismo, $conexionturismo);
$query_imagenes = sprintf("SELECT tblimagen.strImagen FROM tblimagen WHERE tblimagen.idProducto = %s", GetSQLValueString($idProducto_imagenes, "int"),GetSQLValueString($idProducto_imagenes, "int"));
$imagenes = mysql_query($query_imagenes, $conexionturismo) or die(mysql_error());
$row_imagenes = mysql_fetch_assoc($imagenes);
$totalRows_imagenes = mysql_num_rows($imagenes);

$varCat_relacionados = "0";
if (isset($row_producto['intCategoria'])) {
  $varCat_relacionados = $row_producto['intCategoria'];
}
$seo_relacionados = "0";
if (isset($_GET["seoProd"])) {
  $seo_relacionados = $_GET["seoProd"];
}
mysql_select_db($database_conexionturismo, $conexionturismo);
$query_relacionados = sprintf("SELECT tblproducto.strNombre, tblproducto.strSEO, tblproducto.strImagen, tblfechas.dblPrecio, tblcategoria.strDescripcion AS subCategoria, tblcategoria.strSEO AS seoSubCat, tblcategoria.idPadre AS padre, (SELECT tblcategoria.strDescripcion FROM tblcategoria WHERE tblcategoria.idCategoria = padre LIMIT 1) AS categoria, (SELECT tblcategoria.strSEO FROM tblcategoria WHERE tblcategoria.idCategoria = padre LIMIT 1) AS seoCategoria FROM tblproducto INNER JOIN tblcategoria ON tblproducto.intCategoria = tblcategoria.idCategoria INNER JOIN tblfechas ON tblproducto.idProducto = tblfechas.idProducto WHERE tblproducto.intCategoria = (SELECT tblproducto.intCategoria FROM tblproducto WHERE tblproducto.strSEO = %s LIMIT 1) AND tblproducto.strSEO != %s AND tblproducto.intTipo = 1 AND tblproducto.intStock > 0 AND tblproducto.intEstado = 1 AND tblcategoria.intEstado = 1 AND tblfechas.fchIda > NOW() GROUP BY tblproducto.strSEO ORDER BY RAND() LIMIT 4", GetSQLValueString($seo_relacionados, "text"), GetSQLValueString($seo_relacionados, "text"));
$relacionados = mysql_query($query_relacionados, $conexionturismo) or die(mysql_error());
$row_relacionados = mysql_fetch_assoc($relacionados);
$totalRows_relacionados = mysql_num_rows($relacionados);

$varProducto_fechas = "0";
if (isset($row_producto['idProducto'])) {
  $varProducto_fechas = $row_producto['idProducto'];
}
mysql_select_db($database_conexionturismo, $conexionturismo);
$query_fechas = sprintf("SELECT tblfechas.idFecha, tblfechas.fchIda, tblfechas.fchVuelta, tblfechas.dblPrecio FROM tblfechas WHERE tblfechas.idProducto = %s", GetSQLValueString($varProducto_fechas, "int"));
$fechas = mysql_query($query_fechas, $conexionturismo) or die(mysql_error());
$row_fechas = mysql_fetch_assoc($fechas);
$totalRows_fechas = mysql_num_rows($fechas);

        date_default_timezone_set("Europe/Madrid");
        setlocale(LC_TIME, "spanish");
        $anio_actual = isset($_POST['anio']) ? $_POST['anio'] : date("Y");
        $mes_actual = (isset($_POST['mes']) ? $_POST['mes'] : date("n"))*1;
        $fechaN='01-'.$mes_actual.'-'.$anio_actual;
        $numero_dias = cal_days_in_month(CAL_GREGORIAN, $mes_actual, $anio_actual);
        $iniciomes = date('w',mktime(0,0,0,$mes_actual,1,$anio_actual));
        $numero_dias += $iniciomes;					
        $filas = ceil($numero_dias/7);
        $cantidad_celdas = $filas * 7;
        $diferencia = $cantidad_celdas - $numero_dias;
        //datos anteriores				
        $mesA = $mes_actual - 1;
        $anioA = $anio_actual;
        if ($mesA <= 0){
        $mesA = 12;
        $anioA = $anioA - 1;
        }
        //datos siguiente
        $mesS = $mes_actual + 1;
        $anioS = $anio_actual;
        if ($mesS >=13){
        $mesS = 1;
        $anioS = $anioS + 1;
        }
?><!DOCTYPE html>
<html lang="es-ES">
    <head>
        <?php include("includes/metatag.php"); ?>
        <meta property="og:title" content="<?php echo ucwords($row_seo['producto']); ?> | CaribeTour.es" />
        <meta name="title" content="<?php echo ucwords($row_seo['producto']); ?> | CaribeTour.es" />
        <meta name="DC.title" content="<?php echo ucwords($row_seo['producto']); ?> | CaribeTour.es" />
        <title><?php echo $row_seo['producto']; ?> | CaribeTour.es</title>
        <meta name="description" content="<?php echo ucwords($row_seo['producto']); ?> | <?php echo substr($row_seo['strDescripcion'], 0, 121); ?>" />
        <meta name="keywords" content="<?php echo ucwords($row_seo['producto']); ?>" />
        <!--[if lt IE 9]>
            <script type="text/javascript" src="http://www.caribetour.es/js/jquery/html5.js"></script>
		<![endif]-->
		<?php include("includes/baselink.php"); ?>
        <link rel="canonical" href="http://www.caribetour.es/" />
        <link rel="apple-touch-icon" sizes="57x57" href="images/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="images/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="images/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="images/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="images/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="images/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon-180x180.png">
        <link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="images/favicon-194x194.png" sizes="194x194">
        <link rel="icon" type="image/png" href="images/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="images/android-chrome-192x192.png" sizes="192x192">
        <link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="images/manifest.json">
        <link rel="mask-icon" href="images/safari-pinned-tab.svg" color="#ff9000">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-TileImage" content="images/mstile-144x144.png">
        <meta name="theme-color" content="#ff9000">
        <meta name="apple-touch-fullscreen" content="yes" />
        <link rel='stylesheet' id='colorbox-css'  href='css/colorbox.css?ver=3.7.1' type='text/css' media='all' /><!--para las galerias de fotos-->
        <link rel='stylesheet' id='jquery-ui-datepicker-css'  href='css/datepicker.css?ver=3.7.1' type='text/css' media='all' /><!--para el calendario-->
        <link rel='stylesheet' id='general-css'  href='css/style.css?ver=3.7.1' type='text/css' media='all' />
        <script type='text/javascript' src='js/jquery.js?ver=1.10.2'></script>
        <script type='text/javascript' src='js/jquery-migrate.min.js?ver=1.2.1'></script>
        <script type='text/javascript' src='js/comment-reply.min.js?ver=3.7.11'></script>
        <script type='text/javascript' src='js/jquery.hoverIntent.min.js?ver=3.7.11'></script>
        <script type='text/javascript' src='js/jquery.ui.touchPunch.js?ver=3.7.11'></script>
        <script type='text/javascript' src='js/jquery.colorbox.min.js?ver=3.7.11'></script>
        <script type='text/javascript' src='js/jquery.placeholder.min.js?ver=3.7.11'></script>
        <script type='text/javascript' src='js/jquery.themexSlider.js?ver=3.7.11'></script>
        <script type='text/javascript' src='js/jquery.textPattern.js?ver=3.7.11'></script>
        <script type='text/javascript' src='js/general.js?ver=3.7.11'></script>
        <?php include("includes/css.php");?>
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
    <body class="page page-id-295 page-template-default">
        <div class="container site-container">
          <!-- header -->
          <header class="container site-header">
            <div class="substrate top-substrate"> <img src="images/site_bg.jpg" class="fullwidth" alt="Imagen de fondo" /> </div>
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
                <div class="breadcrumb"> <a hreflang="es" type="text/html" charset="iso-8859-1" href="inicio" rel="tag" title="ir al Inicio">Inicio</a> </div>
                <div class="breadcrumb"> <a hreflang="es" type="text/html" charset="iso-8859-1" href="destinos" rel="tag" title="Ver todos los destinos">Destinos</a> </div>
                <div class="breadcrumb"> <a hreflang="es" type="text/html" charset="iso-8859-1" href="destinos/<?php echo $row_seo['seoCategoria']; ?>" rel="tag" title="Ver destinos en <?php echo $row_seo['categoria']; ?>"><?php echo $row_seo['categoria']; ?></a> </div>
                <div class="breadcrumb"> <a hreflang="es" type="text/html" charset="iso-8859-1" href="destinos/<?php echo $row_seo['seoCategoria']; ?>/<?php echo $row_seo['seoSubCategoria']; ?>" rel="tag" title="Ver destinos en <?php echo $row_seo['subCategoria']; ?>"><?php echo $row_seo['subCategoria']; ?></a> </div>
                <div class="breadcrumb"><?php echo $row_seo['producto']; ?></div>
            </div>
            <!--fin de breadcrumb-->
            <div class="row"><?php if (isset($_SESSION['nombre']) && !isset($_SESSION['enviado'])){
				echo "<h1>Por favor rellene todos los campos del formulario.</h1><br>";
				} ?><?php if (isset($_SESSION['enviado']) && $_SESSION['enviado']==1){
				echo "<h1>Gracias por su consulta, los datos se han enviado correctamente.</h1><br>";
				} ?><?php if (isset($_SESSION['enviado']) && $_SESSION['enviado']==0){
				echo "<h1 style='color:red'>Error al enviar los datos del formulario, por favor int&eacute;ntelo de nuevo.</h1><br>";
				} ?><?php if ($totalRows_producto > 0) { // Show if recordset not empty ?>
                <div class="full-tour clearfix">
                    <div class="sixcol column">
                        <div class="content-slider-container tour-slider-container">
                            <div class="content-slider tour-slider">
                                <ul>
                                <li><img src="img/<?php echo $row_producto['strImagen']; ?>" alt="Imagen de <?php echo $row_producto['strNombre']; ?>" title="<?php echo $row_producto['strNombre']; ?>" /></li>
                                <?php if ($totalRows_imagenes > 0) { // Show if recordset not empty ?><?php do { ?>
                                <li><img src="img/<?php echo $row_imagenes['strImagen']; ?>" alt="Imagen de <?php echo $row_producto['strNombre']; ?>" title="<?php echo $row_producto['strNombre']; ?>" /></li>
                                <?php } while ($row_imagenes = mysql_fetch_assoc($imagenes)); ?><?php } // Show if recordset not empty ?>
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
                            <h1><?php echo $row_producto['strNombre']; ?></h1>
                        </div>
                        <ul class="tour-meta">
                            <li>
                            <div class="colored-icon icon-2"></div>
                            <strong>Destino:</strong> <a hreflang="es" type="text/html" charset="iso-8859-1" href="destinos/<?php echo $row_producto['seoCategoria']; ?>/<?php echo $row_producto['seoSubCat']; ?>" rel="tag" title="Ver destinos en <?php echo $row_producto['subcategoria']; ?>"><?php echo $row_producto['subcategoria']; ?></a></li>
                            <li>
                            <div class="colored-icon icon-1"><span></span></div>
                            <strong>Duracion:</strong> <?php $duracion=strtotime($row_producto['fchVuelta']) - strtotime($row_producto['fchIda']); echo date('d',$duracion)*1; ?> D&iacute;as</li>
                            <li>
                            <div class="colored-icon icon-6"><span></span></div>
                            <strong>Salida:</strong> <?php echo MostratFechaEspanol($row_producto['fchIda']); ?></li>
                            <li>
                            <div class="colored-icon icon-7"><span></span></div>
                            <strong>Regreso:</strong> <?php echo MostratFechaEspanol($row_producto['fchVuelta']); ?></li>
                            <li style="font-size:1.8em;">
                            <div class="colored-icon icon-3"><span></span></div>
                            <strong>Precio:</strong> <?php echo moneda($row_producto['dblPrecio']); ?>&euro;</li>
                        </ul>
                        <p><?php echo nl2br($row_producto['strDescripcion']); ?></p>
                        <footer class="tour-footer"> <a hreflang="es" type="text/html" charset="iso-8859-1" href="cliente-datos.php?idproducto=<?php echo $row_producto['idProducto']; ?>&amp;idFecha=<?php echo $row_producto['idFecha']; ?>" title="Solicitar la reserva de <?php echo $row_producto['strNombre']; ?>" class="button small"><span>Reservar Ahora</span></a> <a href="#question-form" data-id="<?php echo $row_producto['strNombre']; ?>" data-title="<?php echo $row_producto['strNombre']; ?>" class="button grey small colorbox inline"><span>Consultar</span></a> </footer>
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
                                        <h5><?php echo $row_producto['strNombre']; ?></h5>
                                        <p><?php $itinerario = nl2br($row_producto['strItinerario']); echo sprintf($itinerario, MostratFechaEspanol($row_producto['fchIda']), date("H:i",strtotime($row_producto['fchIda'])), $row_producto['subcategoria'], $row_producto['subcategoria'],$row_producto['strNombre'],$row_producto['strNombre'],$row_producto['subcategoria'],MostratFechaEspanol($row_producto['fchVuelta']), $row_producto['strNombre'], $row_producto['subcategoria'], date("H:i",strtotime($row_producto['fchVuelta']))); ?></p>
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
                                        <h5><?php echo $row_producto['strNombre']; ?></h5>
                                        <p><?php echo nl2br($row_producto['strIncluye']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sixcol column last">
                    <div class="calendario">        
                        <table summary="Calendario con las fechas de salida para el tour <?php echo $row_producto['strNombre']; ?>">
                            <caption><h3>El&iacute;ge la fecha de salida</h3></caption>
                            <colgroup span="7" style="width:14.29%; text-align:left; vertical-align:top; height:39px;" />
                            <thead>
                                <tr>
                                    <th><form role="form" action="<?php echo $_SERVER["REQUEST_URI"]?>" method="post"><input type="submit" value="&lt; &lt;--" title="Ver el mes anterior"><input type="hidden" name="mes" value="<?php echo $mesA; ?>"><input type="hidden" name="anio" value="<?php echo $anioA; ?>"></form></th><th colspan="5"><?php if(isset($_POST['mes']) && date('m-Y', strtotime($fechaN))!=date('m-Y')){ echo MostratFechaEspanol($fechaN); } elseif (date('m-Y', strtotime($fechaN))==date('m-Y')) { echo MostratFechaEspanol(date('d-m-Y')); } else {	echo MostratFechaEspanol(date('d-m-Y')); } ?></th><th><form role="form" action="<?php echo $_SERVER["REQUEST_URI"]?>" method="post"><input type="submit" value="--&gt; &gt;" title="Ver el mes anterior"><input type="hidden" name="mes" value="<?php echo $mesS; ?>"><input type="hidden" name="anio" value="<?php echo $anioS; ?>"></form></th>
                                </tr>
                                <tr>
                                    <th scope="col" abbr="Domingo">Dom</th><th scope="col" abbr="Lunes">Lun</th><th scope="col" abbr="Martes">Mar</th><th scope="col" abbr="Mi&eacute;rcoles">Mie</th><th scope="col" abbr="Jueves">Jue</th><th scope="col" abbr="Viernes">Vie</th><th scope="col" abbr="S&aacute;bado">Sab</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <?php 
                                for($i = 1; $i <= $numero_dias; $i++){
                                    if($i <= $iniciomes){
                                    echo '<td></td>';
                                    } 
                                    else{
                                        $dias = $i-$iniciomes;									
                                        echo '<td'.hoy($dias,$mes_actual).'>'.$dias .' '. fechaPrecio($row_producto['idProducto'],$dias,$mes_actual,$anio_actual).'</td>';
                                    }
                                    if ($i % 7 ==0){
                                        echo '</tr>
										<tr>';
                                    }
                                }
                                for($i = 1; $i <= $diferencia; $i++){
                                echo '<td></td>';
                                }			
                                ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div><?php } // Show if recordset not empty ?>
				<?php if ($totalRows_producto == 0) { // Show if recordset empty ?>
                <h3>Sin Resultados...</h3>
                <p>Lo sentimos, el destino elegido <strong>NO</strong> se encuentra disponible en estos momentos, Puedes echar un vistazo a los destinos relacionados.. Disculpen las molestias.</p>
                <img src="images/no-encontrado.gif" title="Ehhhhh..... No lo encuentro." alt="Sin Resultados...">
                <?php } // Show if recordset empty ?>
                <div class="clear"></div>
                <?php if ($totalRows_relacionados > 0) { // Show if recordset not empty ?>
                <div class="related-tours clearfix">
                    <div class="section-title">
                    	<h2>Destinos Relacionados</h2>
                    </div>
                    <div class="items-grid"><?php do { ?>
                        <div class="column threecol ">
                            <div class="tour-thumb-container">
                                <div class="tour-thumb"> <a hreflang="es" type="text/html" charset="iso-8859-1" href="destinos/<?php echo $row_relacionados['seoCategoria']; ?>/<?php echo $row_relacionados['seoSubCat']; ?>/<?php echo $row_relacionados['strSEO']; ?>" title="<?php echo $row_relacionados['strNombre']; ?>"><img width="440" height="330" src="img/<?php echo $row_relacionados['strImagen']; ?>" class="attachment-preview wp-post-image" alt="<?php echo $row_relacionados['strNombre']; ?>" /></a>
                                    <div class="tour-caption">
                                        <h5 class="tour-title"><a hreflang="es" type="text/html" charset="iso-8859-1" href="destinos/<?php echo $row_relacionados['seoCategoria']; ?>/<?php echo $row_relacionados['seoSubCat']; ?>/<?php echo $row_relacionados['strSEO']; ?>"><?php echo $row_relacionados['strNombre']; ?></a></h5>
                                        <div class="tour-meta">
                                            <div class="tour-destination">
                                                <div class="colored-icon icon-2"></div>
                                                <a hreflang="es" type="text/html" charset="iso-8859-1" href="destinos/<?php echo $row_relacionados['seoCategoria']; ?>/<?php echo $row_relacionados['seoSubCat']; ?>" rel="tag"><?php echo $row_relacionados['subCategoria']; ?></a>
                                            </div>
                                            <div class="colored-icon icon-3"></div><?php echo moneda($row_relacionados['dblPrecio']); ?>&euro;
                                        </div>
                                    </div>
                                </div>
                                <div class="block-background"></div>
                            </div>
                        </div><?php } while ($row_relacionados = mysql_fetch_assoc($relacionados)); ?>
                        <div class="clear"></div>
                    </div>
                </div>
                <!-- related tours -->
                <?php } // Show if recordset not empty ?>
            </div>
        </section>
        <!-- /content -->
        <!-- footer -->
        <?php include("includes/footer.php");?>
        <!-- /footer -->
        <div class="substrate bottom-substrate"> <img src="images/site_bg.jpg" class="fullwidth" alt="Imagen de fondo" /> </div>
        </div>
        <script type="text/javascript">
			var enfocar = <?php echo isset($_POST['anio']) ? 1 : 0;?>;
			if (enfocar == 1){
				var h = window.innerHeight;
				var w = window.innerWidth;
				window.scrollTo(w,h);
			}
		</script>
        <script type="text/javascript" src="js/validar-pro.js"></script>
		<script type='text/javascript' src='js/jquery.ui.core.min.js?ver=1.10.3'></script>
        <script type='text/javascript' src='js/jquery.ui.widget.min.js?ver=1.10.3'></script>
        <script type='text/javascript' src='js/jquery.ui.mouse.min.js?ver=1.10.3'></script>
        <script type='text/javascript' src='js/jquery.ui.slider.min.js?ver=1.10.3'></script><!--para el slider de las imagenes (indez, destino-detalles)-->
        <script type='text/javascript' src='js/jquery.ui.datepicker.min.js?ver=1.10.3'></script>
    <!--para el calendario-->
    </body>
</html>
<?php
mysql_free_result($producto);

mysql_free_result($imagenes);

mysql_free_result($relacionados);

mysql_free_result($fechas);

mysql_free_result($seo);

unset($_SESSION['producto'], $_SESSION['nombre'], $_SESSION['enviado']);
//session_unset(); session_destroy();
?>