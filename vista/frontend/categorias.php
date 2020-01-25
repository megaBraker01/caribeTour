<?php require_once('Connections/conexionturismo.php'); ?>
<?php
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

$seoCat_seo = "0";
if (isset($_GET["seoCat"])) {
  $seoCat_seo = $_GET["seoCat"];
}
mysql_select_db($database_conexionturismo, $conexionturismo);
$query_seo = sprintf("SELECT tblcategoria.idCategoria, tblcategoria.idPadre, tblcategoria.strDescripcion, tblcategoria.strTexto, tblcategoria.strSEO FROM tblcategoria WHERE tblcategoria.strSEO = %s", GetSQLValueString($seoCat_seo, "text"));
$seo = mysql_query($query_seo, $conexionturismo) or die(mysql_error());
$row_seo = mysql_fetch_assoc($seo);
$totalRows_seo = mysql_num_rows($seo);

$seoCat_categoria = "0";
if (isset($row_seo['idCategoria'])) {
  $seoCat_categoria = $row_seo['idCategoria'];
}
mysql_select_db($database_conexionturismo, $conexionturismo);
$query_categoria = sprintf("SELECT tblfechas.idFecha AS id, Min((SELECT Sum(tblfechas.dblPrecio + tblfechas.dblTasas) FROM tblfechas WHERE tblfechas.idFecha = id)) AS precio, tblfechas.idFecha, tblcategoria.strDescripcion, tblcategoria.strSEO, tblcategoria.strTexto, tblcategoria.strImagen, tblcategoria.intEstado, tblcategoria.idPadre, tblcategoria.idCategoria FROM tblproducto INNER JOIN tblfechas ON tblproducto.idProducto = tblfechas.idProducto INNER JOIN tblcategoria ON tblproducto.intCategoria = tblcategoria.idCategoria WHERE tblproducto.intEstado = 1 AND tblproducto.intTipo = 1 AND tblproducto.intStock > 0 AND tblcategoria.intEstado = 1 AND tblfechas.fchIda > NOW() AND tblcategoria.idPadre = %s GROUP BY tblcategoria.strDescripcion, tblcategoria.strSEO", GetSQLValueString($seoCat_categoria, "int"));
$categoria = mysql_query($query_categoria, $conexionturismo) or die(mysql_error());
$row_categoria = mysql_fetch_assoc($categoria);
$totalRows_categoria = mysql_num_rows($categoria);
?>
<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <?php include("includes/metatag.php"); ?>
        <meta property="og:title" content="<?php echo ucwords($row_seo['strDescripcion']); ?> | CaribeTour.es" />
        <meta name="title" content="<?php echo ucwords($row_seo['strDescripcion']); ?> | CaribeTour.es" />
        <meta name="DC.title" content="<?php echo ucwords($row_seo['strDescripcion']); ?> | CaribeTour.es" />
        <title><?php echo ucwords($row_seo['strDescripcion']); ?> | CaribeTour.es</title>
        <meta name="description" content="<?php echo ucwords($row_seo['strDescripcion']); ?> | <?php echo substr($row_seo['strTexto'], 0, 121); ?>" />
        <meta name="keywords" content="<?php echo ucwords($row_seo['strDescripcion']); ?>" />
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
        <script type='text/javascript' src='js/comment-reply.min.js?ver=3.7.11'></script><!--para los comentarios del blog-->
        <script type='text/javascript' src='js/jquery.hoverIntent.min.js?ver=3.7.11'></script><!--para los menus deplegable-->
        <script type='text/javascript' src='js/jquery.ui.touchPunch.js?ver=3.7.11'></script><!--para los efectos en los dispositivos tactiles (IMPORTANTE)-->
        <script type='text/javascript' src='js/jquery.colorbox.min.js?ver=3.7.11'></script><!--para las galerias de fotos-->
        <script type='text/javascript' src='js/jquery.placeholder.min.js?ver=3.7.11'></script><!--para que se pueda ver el placeholder(formularios) en todos los navegadores-->
        <script type='text/javascript' src='js/jquery.themexSlider.js?ver=3.7.11'></script><!--para el slider de las imagenes (indez, destino-detalles)-->
        <script type='text/javascript' src='js/jquery.textPattern.js?ver=3.7.11'></script><!--validacion de los formularios, tambien se utiliza para pasar las imagenes-->
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
                <div class="substrate top-substrate">
                    <img src="images/site_bg.jpg" class="fullwidth" alt="Imagen de fondo" />
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
                            <a hreflang="es" type="text/html" charset="iso-8859-1" href="destinos" rel="tag" title="Inicio">Destinos</a>
                        </div>
                        <div class="breadcrumb"><?php echo $row_seo['strDescripcion']; ?></div>
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
                <img src="images/site_bg.jpg" class="fullwidth" alt="Imagen de fondo" />
			</div>
        </div>
		<script type='text/javascript' src='js/jquery.ui.core.min.js?ver=1.10.3'></script>
        <script type='text/javascript' src='js/jquery.ui.widget.min.js?ver=1.10.3'></script>
        <script type='text/javascript' src='js/jquery.ui.mouse.min.js?ver=1.10.3'></script>
        <script type='text/javascript' src='js/jquery.ui.slider.min.js?ver=1.10.3'></script><!--para el slider de las imagenes (indez, destino-detalles)-->
        <script type='text/javascript' src='js/jquery.ui.datepicker.min.js?ver=1.10.3'></script>
    <!--para el calendario-->
    </body>
</html>
<?php
mysql_free_result($seo);

mysql_free_result($categoria);
?>