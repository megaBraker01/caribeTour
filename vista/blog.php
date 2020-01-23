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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_blogs = 4;
$pageNum_blogs = 0;
if (isset($_GET['pageNum_blogs'])) {
  $pageNum_blogs = $_GET['pageNum_blogs'];
}
$startRow_blogs = $pageNum_blogs * $maxRows_blogs;

mysql_select_db($database_conexionturismo, $conexionturismo);
$query_blogs = "SELECT tblblog.idArticulo AS idBlog, tblblog.strNombre, tblblog.strSEO, tblblog.strDescripcion, tblblog.strImagen, tblblog.strAutor, tblblog.fchFecha FROM tblblog WHERE tblblog.intEstado = 1 GROUP BY tblblog.idArticulo ORDER BY idBlog DESC";
$query_limit_blogs = sprintf("%s LIMIT %d, %d", $query_blogs, $startRow_blogs, $maxRows_blogs);
$blogs = mysql_query($query_limit_blogs, $conexionturismo) or die(mysql_error());
$row_blogs = mysql_fetch_assoc($blogs);

if (isset($_GET['totalRows_blogs'])) {
  $totalRows_blogs = $_GET['totalRows_blogs'];
} else {
  $all_blogs = mysql_query($query_blogs);
  $totalRows_blogs = mysql_num_rows($all_blogs);
}
$totalPages_blogs = ceil($totalRows_blogs/$maxRows_blogs)-1;

$varArticulo_comentarios = "0";
if (isset($row_blogs['idBlog'])) {
  $varArticulo_comentarios = $row_blogs['idBlog'];
}
mysql_select_db($database_conexionturismo, $conexionturismo);
$query_comentarios = sprintf("SELECT COUNT(tblcomentarios.idArticulo) AS comentarios FROM tblcomentarios WHERE tblcomentarios.idArticulo = %s AND tblcomentarios.intEstado = 1 LIMIT 1", GetSQLValueString($varArticulo_comentarios, "int"));
$comentarios = mysql_query($query_comentarios, $conexionturismo) or die(mysql_error());
$row_comentarios = mysql_fetch_assoc($comentarios);
$totalRows_comentarios = mysql_num_rows($comentarios);

mysql_select_db($database_conexionturismo, $conexionturismo);
$query_popularpost = "SELECT tblblog.strNombre, tblblog.strSEO, tblblog.strImagen, tblblog.fchFecha, Count(tblcomentarios.idArticulo) AS comentarios FROM tblblog INNER JOIN tblcomentarios ON tblblog.idArticulo = tblcomentarios.idArticulo WHERE tblblog.intEstado = 1 AND tblcomentarios.intEstado = 1 GROUP BY tblblog.idArticulo, tblblog.strNombre, tblblog.strSEO, tblblog.strDescripcion, tblblog.strImagen, tblblog.fchFecha ORDER BY comentarios DESC LIMIT 3";
$popularpost = mysql_query($query_popularpost, $conexionturismo) or die(mysql_error());
$row_popularpost = mysql_fetch_assoc($popularpost);
$totalRows_popularpost = mysql_num_rows($popularpost);

mysql_select_db($database_conexionturismo, $conexionturismo);
$query_ultimoscoments = "SELECT tblcomentarios.strNombre, tblcomentarios.idComentario, tblblog.strNombre AS blog, tblblog.strSEO FROM tblcomentarios INNER JOIN tblblog ON tblcomentarios.idArticulo = tblblog.idArticulo WHERE tblcomentarios.intEstado = 1 AND tblblog.intEstado = 1 GROUP BY tblblog.strSEO ORDER BY tblcomentarios.fchPost DESC LIMIT 5";
$ultimoscoments = mysql_query($query_ultimoscoments, $conexionturismo) or die(mysql_error());
$row_ultimoscoments = mysql_fetch_assoc($ultimoscoments);
$totalRows_ultimoscoments = mysql_num_rows($ultimoscoments);

mysql_select_db($database_conexionturismo, $conexionturismo);
$query_imagenes = "SELECT tblimagen.strImagen, tblproducto.strNombre FROM tblproducto INNER JOIN tblimagen ON tblimagen.idProducto = tblproducto.idProducto WHERE tblproducto.intEstado = 1 ORDER BY RAND() LIMIT 8";
$imagenes = mysql_query($query_imagenes, $conexionturismo) or die(mysql_error());
$row_imagenes = mysql_fetch_assoc($imagenes);
$totalRows_imagenes = mysql_num_rows($imagenes);

$queryString_blogs = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_blogs") == false && 
        stristr($param, "totalRows_blogs") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_blogs = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_blogs = sprintf("&totalRows_blogs=%d%s", $totalRows_blogs, $queryString_blogs);
?><!DOCTYPE html>
<html lang="es-ES">
    <head>
        <?php include("includes/metatag.php"); ?>
        <meta property="og:title" content="Blog de Caribetour.es | Especialistas en el Caribe" />
        <meta name="title" content="Blog de Caribetour.es | Especialistas en el Caribe" />
        <meta name="DC.title" content="Blog de Caribetour.es | Especialistas en el Caribe" />
        <title>Blog de Caribetour.es | Especialistas en el Caribe</title>
        <meta name="description" content="Blog de Caribetour.es | Especialistas en el Caribe" />
        <meta name="keywords" content="Blog de Caribetour.es" />
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
                        <div class="breadcrumb">Blog</div>
                    </div>
                <!--fin de breadcrumb-->
                <div class="row">
                    <div class="column eightcol">
                        <div class="blog-listing"><?php do { ?>
                            <article class="post-112 post type-post status-publish format-standard hentry category-guides post clearfix">
                                <div class="column fivecol post-featured-image">
                                    <div class="featured-image">
                                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="blog/<?php echo $row_blogs['strSEO']; ?>"><img width="440" height="299" src="img/<?php echo $row_blogs['strImagen']; ?>" alt="<?php echo ucwords($row_blogs['strNombre']); ?>" title="<?php echo ucwords($row_blogs['strNombre']); ?>" /></a>
                                    </div>
                                </div>
                                <div class="column sevencol last">
                                    <div class="post-content">
                                        <div class="section-title">
                                            <h1><a hreflang="es" type="text/html" charset="iso-8859-1" href="blog/<?php echo $row_blogs['strSEO']; ?>" title="<?php echo ucwords($row_blogs['strNombre']); ?>"><?php echo ucwords($row_blogs['strNombre']); ?></a></h1>
                                        </div>
                                        <p><?php echo substr($row_blogs['strDescripcion'],0,400); ?>.[...]</p>
                                        <footer class="post-footer clearfix">
                                            <a hreflang="es" type="text/html" charset="iso-8859-1" href="blog/<?php echo $row_blogs['strSEO']; ?>" class="button small"><span>Leer M&aacute;s</span></a>
                                            <div class="post-comment-count"><?php echo $row_comentarios['comentarios']; ?></div>
                                            <div class="post-info"><time datetime="2012-11-24"><?php echo fechaCorta($row_blogs['fchFecha']); ?></time></div>
                                        </footer>
                                    </div>
                                </div>
                            </article><?php } while ($row_blogs = mysql_fetch_assoc($blogs)); ?>
                        </div>
                        <nav class="pagination">
                            <?php for ($cont=0;$cont<=$totalPages_blogs;$cont++){
                                $numPagina=$cont+1;
                                if ($cont==$pageNum_blogs)
                                    echo "<span class='page-numbers current'>".$numPagina."</span>";
                                else
                                    echo "<a class='page-numbers' href='blog.php?pageNum_blogs=".$cont."'>".$numPagina."</a>";
                                } ?>
                        </nav>
                    </div>
                    <!--/column eightcol-->
                    <aside class="column fourcol last">
                        <div class="widget widget-selected-posts">
                            <div class="section-title">
                                <h4>Art&iacute;culos Populares</h4>
                            </div> <?php do { ?>
                            <article class="post clearfix">
                                <div class="post-featured-image">
                                    <div class="featured-image">
                                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="blog/<?php echo $row_popularpost['strSEO']; ?>"><img width="440" height="299" src="img/<?php echo $row_popularpost['strImagen']; ?>" class="attachment-normal wp-post-image" alt="<?php echo ucwords($row_popularpost['strNombre']); ?>" title="<?php echo ucwords($row_popularpost['strNombre']); ?>" /></a>
                                    </div>
                                </div>
                                <div class="post-content">
                                    <h6 class="post-title"><a hreflang="es" type="text/html" charset="iso-8859-1" href="blog/<?php echo $row_popularpost['strSEO']; ?>" title="<?php echo ucwords($row_popularpost['strNombre']); ?>"><?php echo ucwords($row_popularpost['strNombre']); ?></a></h6>
                                    <footer class="post-footer clearfix">
                                        <div class="post-comment-count"><?php echo $row_popularpost['comentarios']; ?></div>
                                        <div class="post-info">
                                            <time datetime="<?php echo fechaCorta($row_popularpost['fchFecha']); ?>"><?php echo fechaCorta($row_popularpost['fchFecha']); ?></time>
                                        </div>
                                    </footer>
                                </div>
                            </article><?php } while ($row_popularpost = mysql_fetch_assoc($popularpost)); ?>
                        </div>
                        <div class="widget widget_recent_comments">
                            <div class="section-title"><h4>Comentarios Recientes</h4></div>
                            <ul id="recentcomments"><?php do { ?>
                                <li class="recentcomments"><?php echo $row_ultimoscoments['strNombre']; ?> en <a hreflang="es" type="text/html" charset="iso-8859-1" href="blog/<?php echo $row_ultimoscoments['strSEO']; ?>#comment-<?php echo $row_ultimoscoments['idComentario']; ?>"><?php echo ucwords($row_ultimoscoments['blog']); ?></a></li><?php } while ($row_ultimoscoments = mysql_fetch_assoc($ultimoscoments)); ?>
                            </ul>
                        </div>
                        <div class="widget widget_text">
                            <div class="section-title"><a hreflang="es" type="text/html" charset="iso-8859-1" href="galeria" title="Ver la Galer&iacute;a Completa"><h4>Galer&iacute;a</h4></a></div>
                            <div class="textwidget">
                                <div class="items-grid"><?php $i=1; do { ?>
                                    <div class="column gallery-item sixcol <?php if ($i % 2==0){ echo 'last'; }?>">
                                        <div class="featured-image">
                                            <a href="img/<?php echo $row_imagenes['strImagen']; ?>" class="colorbox " data-group="gallery-111" title="<?php echo ucwords($row_imagenes['strNombre']); ?>"><img width="440" height="330" src="img/<?php echo $row_imagenes['strImagen']; ?>" class="attachment-preview wp-post-image" alt="<?php echo $row_imagenes['strNombre']; ?>" /></a>
                                            <a class="featured-image-caption none-caption" href="#"><h6><?php echo ucwords($row_imagenes['strNombre']); ?></h6></a>
                                        </div>
                                        <div class="block-background"></div>
                                    </div><?php if ($i % 2==0){ echo '<div class="clear"></div>'; }?><?php $i++; } while ($row_imagenes = mysql_fetch_assoc($imagenes)); ?>
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
mysql_free_result($blogs);

mysql_free_result($popularpost);

mysql_free_result($ultimoscoments);

mysql_free_result($imagenes);

mysql_free_result($comentarios);
?>