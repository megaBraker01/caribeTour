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

$maxRows_imagenes = 12;
$pageNum_imagenes = 0;
if (isset($_GET['pageNum_imagenes'])) {
  $pageNum_imagenes = $_GET['pageNum_imagenes'];
}
$startRow_imagenes = $pageNum_imagenes * $maxRows_imagenes;

mysql_select_db($database_conexionturismo, $conexionturismo);
$query_imagenes = "SELECT tblimagen.strImagen, tblimagen.idImagen, tblproducto.strNombre AS producto FROM tblimagen INNER JOIN tblproducto ON tblimagen.idProducto = tblproducto.idProducto WHERE tblproducto.intEstado = 1 AND tblproducto.intTipo = 1 ORDER BY tblimagen.idImagen DESC";
$query_limit_imagenes = sprintf("%s LIMIT %d, %d", $query_imagenes, $startRow_imagenes, $maxRows_imagenes);
$imagenes = mysql_query($query_limit_imagenes, $conexionturismo) or die(mysql_error());
$row_imagenes = mysql_fetch_assoc($imagenes);

if (isset($_GET['totalRows_imagenes'])) {
  $totalRows_imagenes = $_GET['totalRows_imagenes'];
} else {
  $all_imagenes = mysql_query($query_imagenes);
  $totalRows_imagenes = mysql_num_rows($all_imagenes);
}
$totalPages_imagenes = ceil($totalRows_imagenes/$maxRows_imagenes)-1;
?><!DOCTYPE html>
<html lang="es-ES">
    <head>
        <?php include("includes/metatag.php"); ?>
        <meta property="og:title" content="Galer&iacute;a de CaribeTour.es | Especialistas en el Caribe" />
        <meta name="title" content="Galer&iacute;a de CaribeTour.es | Especialistas en el Caribe" />
        <meta name="DC.title" content="Galer&iacute;a de CaribeTour.es | Especialistas en el Caribe" />
        <title>Galer&iacute;a de CaribeTour.es | Especialistas en el Caribe</title>
        <meta name="description" content="Galer&iacute;a de CaribeTour.es | Especialistas en el Caribe" />
        <meta name="keywords" content="Galer&iacute;a de CaribeTour.es" />
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
                        <div class="breadcrumb">Galer&iacute;a</div>
                    </div>
                <!--fin de breadcrumb-->
                <div class="row">
                    <div class="items-grid"><?php $i=1; do { ?>
                        <div class="column gallery-item threecol <?php if ($i % 4==0){ echo 'last'; }?>">
                            <div class="featured-image">
                                <a href="img/<?php echo $row_imagenes['strImagen']; ?>" class="colorbox " data-group="gallery-111" title="<?php echo $row_imagenes['producto']; ?>">
                                    <img width="440" height="330" src="img/<?php echo $row_imagenes['strImagen']; ?>" class="attachment-preview wp-post-image" alt="<?php echo $row_imagenes['producto']; ?>" />
                                </a>
                                <a class="featured-image-caption visible-caption" href="#"><h6><?php echo $row_imagenes['producto']; ?></h6></a>
                            </div>
                            <div class="block-background"></div>
                        </div><?php if ($i % 4==0){ echo '<div class="clear"></div>'; }?><?php $i++; } while ($row_imagenes = mysql_fetch_assoc($imagenes)); ?>
                        <div class="clear"></div>
                    </div>
                    <nav class="pagination">
                            <?php for ($cont=0;$cont<=$totalPages_imagenes;$cont++){
                                $numPagina=$cont+1;
                                if ($cont==$pageNum_imagenes)
                                    echo "<span class='page-numbers current'>".$numPagina."</span>";
                                else
                                    echo "<a class='page-numbers' href='galeria.php?pageNum_imagenes=".$cont."'>".$numPagina."</a>";
                                } ?>
                        </nav>
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
        <script type='text/javascript' src='js/jquery.ui.slider.min.js?ver=1.10.3'></script>
        <script type='text/javascript' src='js/jquery.ui.datepicker.min.js?ver=1.10.3'></script>
    </body>
</html>
<?php
mysql_free_result($imagenes);
?>