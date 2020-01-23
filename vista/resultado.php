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
$currentPage = $_SERVER["PHP_SELF"];
$parametrosURL = $_SERVER["QUERY_STRING"];
$maxRows_producto = 4;
$pageNum_producto = 0;
if (isset($_GET['pageNum_producto'])) {
  $pageNum_producto = $_GET['pageNum_producto'];
}
$startRow_producto = $pageNum_producto * $maxRows_producto;

mysql_select_db($database_conexionturismo, $conexionturismo);
$query_producto = "SELECT tblproducto.idProducto, tblproducto.strNombre, tblproducto.strDescripcion, tblproducto.strSEO, tblfechas.fchIda, tblfechas.fchVuelta, tblfechas.idFecha AS id, (SELECT Sum(tblfechas.dblPrecio + tblfechas.dblTasas) FROM tblfechas WHERE tblfechas.idFecha = id LIMIT 1) AS dblPrecio, tblproducto.strImagen, tblcategoria.idPadre AS padre, (SELECT tblcategoria.strSEO FROM tblcategoria WHERE tblcategoria.idCategoria = padre GROUP BY tblcategoria.idPadre LIMIT 1) AS seoCategoria, tblcategoria.strDescripcion AS subCategoria, tblcategoria.strSEO AS seoSubCategoria FROM tblproducto  INNER JOIN tblcategoria ON tblproducto.intCategoria = tblcategoria.idCategoria INNER JOIN tblfechas ON tblproducto.idProducto = tblfechas.idProducto";
if(isset($_GET['cat']) && $_GET['cat'] == 0)
{
	$query_producto .=" WHERE tblproducto.intEstado = 1 AND tblproducto.intTipo = 1 AND tblproducto.intStock > 0 AND tblcategoria.intEstado = 1 AND tblfechas.fchIda > NOW()";
	}
if(isset($_GET['cat']) && $_GET['cat'] > 0 && $_GET['cat'] <= 4)
{
	$query_producto .=" WHERE tblproducto.intEstado = 1 AND tblproducto.intTipo = 1 AND tblproducto.intStock > 0 AND tblcategoria.intEstado = 1 AND tblfechas.fchIda > NOW() AND tblcategoria.idPadre = " . $_GET['cat'] ."";
	}
if(isset($_GET['cat']) && $_GET['cat'] > 4)
{
	$query_producto .=" WHERE tblproducto.intEstado = 1 AND tblproducto.intTipo = 1 AND tblproducto.intStock > 0 AND tblcategoria.intEstado = 1 AND tblfechas.fchIda > NOW() AND tblproducto.intCategoria = " . $_GET['cat'] ."";
	}
	if (isset($_GET["fechaI"]) && is_date($_GET["fechaI"])) {
  $fida_producto = date("Y-m-d", strtotime($_GET["fechaI"]));
  $query_producto .= " AND tblfechas.fchIda >= '".$fida_producto."'" ;
}
if (isset($_GET["fechaR"])&& is_date($_GET["fechaR"])) {
  $fregreso_producto = date("Y-m-d", strtotime($_GET["fechaR"]));
  $query_producto .= " AND tblfechas.fchVuelta <= '".$fregreso_producto."'" ;
}
if (isset($_GET["precio_min"])) {;
  $query_producto .=" AND tblfechas.dblPrecio >= (SELECT(".$_GET['precio_min']."-tblfechas.dblTasas) FROM tblfechas LIMIT 1)";
}
if(isset($_GET['precio_max']))
{
	$query_producto .=" AND tblfechas.dblPrecio <= (SELECT(".$_GET['precio_max']."-tblfechas.dblTasas) FROM tblfechas LIMIT 1)";
}
	$query_producto .=" GROUP BY tblproducto.idProducto ORDER BY tblfechas.dblPrecio ASC";
$query_limit_producto = sprintf("%s LIMIT %d, %d", $query_producto, $startRow_producto, $maxRows_producto);
$producto = mysql_query($query_limit_producto, $conexionturismo) or die(mysql_error());
$row_producto = mysql_fetch_assoc($producto);
if (isset($_GET['totalRows_producto'])) {
  $totalRows_producto = $_GET['totalRows_producto'];
} else {
  $all_producto = mysql_query($query_producto);
  $totalRows_producto = mysql_num_rows($all_producto);
}
$totalPages_producto = ceil($totalRows_producto/$maxRows_producto)-1;

$queryString_producto = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_producto") == false && 
        stristr($param, "totalRows_producto") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_producto = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_producto = sprintf("%s", $queryString_producto);
$_SESSION['producto']=$row_producto['strNombre'];
?><!DOCTYPE html>
<html lang="es-ES">
    <head>
        <?php include("includes/metatag.php"); ?>
        <meta property="og:title" content="Resultado de CaribeTour.es | Especialistas en el Caribe" />
        <meta name="title" content="Resultado de CaribeTour.es | Especialistas en el Caribe" />
        <meta name="DC.title" content="Resultado de CaribeTour.es | Especialistas en el Caribe" />
        <title>Resultado de CaribeTour.es | Especialistas en el Caribe</title>
        <meta name="description" content="Resultado de CaribeTour.es | Especialistas en el Caribe" />
        <meta name="keywords" content="Resultado de CaribeTour.es | Especialistas en el Caribe" />
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
        <link rel='stylesheet' id='colorbox-css'  href='css/colorbox.css?ver=3.7.1' type='text/css' media='all' />
        <link rel='stylesheet' id='jquery-ui-datepicker-css'  href='css/datepicker.css?ver=3.7.1' type='text/css' media='all' />
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
                <div class="miga" >
                    <div class="breadcrumb">	
                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="index.php" rel="tag" title="Inicio">Inicio</a>
                    </div>
                    <div class="breadcrumb">Resultado de la B&uacute;squeda...</div>
                </div>
                <!--fin de breadcrumb-->
                <div class="row">
                    <div class="column ninecol"><?php if (isset($_SESSION['nombre']) && !isset($_SESSION['enviado'])){
				echo "<h1>Por favor rellene todos los campos del formulario.</h1><br>";
				} ?><?php if (isset($_SESSION['enviado']) && $_SESSION['enviado']==1){
				echo "<h1>Gracias por su consulta, los datos se han enviado correctamente.</h1><br>";
				} ?><?php if (isset($_SESSION['enviado']) && $_SESSION['enviado']==0){
				echo "<h1 style='color:red'>Error al enviar los datos del formulario, por favor int&eacute;ntelo de nuevo.</h1><br>";
				} ?><?php if ($totalRows_producto > 0) { // Show if recordset not empty ?>
                        <div class="items-list clearfix"><?php do { ?>
                            <div class="full-tour clearfix">
                                <div class="fivecol column">
                                    <div class="content-slider-container tour-slider-container">
                                        <div class="featured-image">
                                            <a hreflang="es" type="text/html" charset="iso-8859-1" href="destinos/<?php echo $row_producto['seoCategoria']; ?>/<?php echo $row_producto['seoSubCategoria']; ?>/<?php echo $row_producto['strSEO']; ?>"><img width="550" height="413" src="img/<?php echo $row_producto['strImagen']; ?>" class="attachment-extended wp-post-image" alt="<?php echo $row_producto['strNombre']; ?>" title="<?php echo $row_producto['strNombre']; ?>" /></a>
                                        </div>
                                        <div class="block-background layer-2"></div>
                                    </div>
                                </div>
                                <div class="sevencol column last">
                                    <div class="section-title">
                                        <h1><a hreflang="es" type="text/html" charset="iso-8859-1" href="destinos/<?php echo $row_producto['seoCategoria']; ?>/<?php echo $row_producto['seoSubCategoria']; ?>/<?php echo $row_producto['strSEO']; ?>" title="<?php echo $row_producto['strNombre']; ?>"><?php echo $row_producto['strNombre']; ?></a></h1>
                                    </div>
                                    <ul class="tour-meta">
                                        <li><div class="colored-icon icon-2"></div><strong>Destino:</strong> <a hreflang="es" type="text/html" charset="iso-8859-1" href="destinos/<?php echo $row_producto['seoCategoria']; ?>/<?php echo $row_producto['seoSubCategoria']; ?>" title="Ver todos los destinos de <?php echo $row_producto['subCategoria']; ?>" rel="tag"><?php echo $row_producto['subCategoria']; ?></a></li>
                                        <li><div class="colored-icon icon-1"><span></span></div><strong>Duraci&oacute;n:</strong> <?php $duracion=strtotime($row_producto['fchVuelta']) - strtotime($row_producto['fchIda']); echo date('d',$duracion)*1; ?> D&iacute;as</li>
                                        <li><div class="colored-icon icon-6"><span></span></div><strong>Salida:</strong> <?php echo MostratFechaEspanol($row_producto['fchIda']); ?></li>
                                        <li><div class="colored-icon icon-7"><span></span></div><strong>Regreso:</strong> <?php echo MostratFechaEspanol($row_producto['fchVuelta']); ?></li>
                                        <li style="font-size:1.8em;"><div class="colored-icon icon-3"><span></span></div><strong>Desde:</strong> <?php echo moneda($row_producto['dblPrecio']); ?> &euro;</li>
                                    </ul>
                                    <p><?php echo substr($row_producto['strDescripcion'],0,261); ?>.[...]</p>
                                    <footer class="tour-footer">
                                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="destinos/<?php echo $row_producto['seoCategoria']; ?>/<?php echo $row_producto['seoSubCategoria']; ?>/<?php echo $row_producto['strSEO']; ?>" title="Saber m&aacute;s sobre <?php echo $row_producto['strNombre']; ?>" class="button small"><span>Saber M&aacute;s</span></a> <a href="#question-form" data-id="<?php echo $row_producto['strNombre']; ?>" data-title="<?php echo $row_producto['strNombre']; ?>" title="Hacer una consulta" class="button grey small colorbox inline"><span>Consultar</span></a>
                                    </footer>
                                </div>
                            </div><?php } while ($row_producto = mysql_fetch_assoc($producto)); ?>
                        </div><?php } // Show if recordset not empty ?><?php if ($totalRows_producto == 0) { // Show if recordset empty ?>
                        <div class="column ninecol">
                            <div class="items-list clearfix">
                                <h3>Sin Resultados...</h3>
                                <p>Lo sentimos, no hemos encontrado Destinos con estas caracter&iacute;sticas, puedes intentar buscando en el men&uacute; superior<a hreflang="es" type="text/html" charset="iso-8859-1" href="destinos"> Destinos</a> o trata cambiando los parametros de b&uacute;squeda.</p>
                                <img src="images/no-encontrado.gif" title="Ehhhhh..... No lo encuentro." alt="Sin Resultados..."><br>
                            </div>
                        </div><?php } // Show if recordset empty ?>
                        <nav class="pagination">
                        <?php for ($cont=0;$cont<=$totalPages_producto;$cont++){
                            $numPagina=$cont+1;
                            if ($cont==$pageNum_producto)
                                echo "<span class='page-numbers current'>".$numPagina."</span>";
                            else
                                echo "<a class='page-numbers' href='".$currentPage."?pageNum_producto=".$cont.$queryString_producto."'>".$numPagina."</a>";
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
        <div class="substrate bottom-substrate"> <img src="images/site_bg.jpg" class="fullwidth" alt="Imagen de fondo" /> </div>
        </div>
        <script type='text/javascript' src='js/validar-pro.js'></script>
		<script type='text/javascript' src='js/jquery.ui.core.min.js?ver=1.10.3'></script>
        <script type='text/javascript' src='js/jquery.ui.widget.min.js?ver=1.10.3'></script>
        <script type='text/javascript' src='js/jquery.ui.mouse.min.js?ver=1.10.3'></script>
        <script type='text/javascript' src='js/jquery.ui.slider.min.js?ver=1.10.3'></script>
        <script type='text/javascript' src='js/jquery.ui.datepicker.min.js?ver=1.10.3'></script>
    </body>
</html>
<?php
mysql_free_result($producto);
session_unset(); session_destroy();
?>