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

$varBlog_blogdatos = "0";
if (isset($_GET["idBlog"])) {
  $varBlog_blogdatos = $_GET["idBlog"];
}
mysql_select_db($database_conexionturismo, $conexionturismo);
$query_blogdatos = sprintf("SELECT tblblog.idArticulo AS idBlog, tblblog.strNombre, tblblog.strSEO, tblblog.strDescripcion, tblblog.strImagen, tblblog.strAutor, tblblog.fchFecha, tblblog.strMetaDescripcion, tblblog.strMetakeyWords FROM tblblog WHERE tblblog.intEstado = 1 AND tblblog.strSEO = %s GROUP BY tblblog.idArticulo ORDER BY idBlog DESC", GetSQLValueString($varBlog_blogdatos, "text"));
$blogdatos = mysql_query($query_blogdatos, $conexionturismo) or die(mysql_error());
$row_blogdatos = mysql_fetch_assoc($blogdatos);
$totalRows_blogdatos = mysql_num_rows($blogdatos);

if (isset($row_blogdatos['idBlog'])) {
  $varBlog_comentarios = $row_blogdatos['idBlog'];
}
mysql_select_db($database_conexionturismo, $conexionturismo);
$query_comentarios = sprintf("SELECT *, COUNT(tblcomentarios.idArticulo) AS comentarios FROM tblcomentarios WHERE tblcomentarios.idArticulo = %s AND tblcomentarios.intEstado = 1", GetSQLValueString($varBlog_comentarios, "int"));
$comentarios = mysql_query($query_comentarios, $conexionturismo) or die(mysql_error());
$row_comentarios = mysql_fetch_assoc($comentarios);
$totalRows_comentarios = mysql_num_rows($comentarios);

mysql_select_db($database_conexionturismo, $conexionturismo);
$query_popularpost = "SELECT tblblog.strNombre, tblblog.strSEO, tblblog.strImagen, tblblog.fchFecha, Count(tblcomentarios.idArticulo) AS comentarios FROM tblblog INNER JOIN tblcomentarios ON tblblog.idArticulo = tblcomentarios.idArticulo WHERE tblblog.intEstado = 1 AND tblcomentarios.intEstado = 1 GROUP BY tblblog.idArticulo, tblblog.strNombre, tblblog.strSEO, tblblog.strDescripcion, tblblog.strImagen, tblblog.fchFecha ORDER BY comentarios DESC LIMIT 3";
$popularpost = mysql_query($query_popularpost, $conexionturismo) or die(mysql_error());
$row_popularpost = mysql_fetch_assoc($popularpost);
$totalRows_popularpost = mysql_num_rows($popularpost);

if (isset($row_blogdatos['idBlog'])) {
  $varBlog_ultimoscoments = $row_blogdatos['idBlog'];
}
mysql_select_db($database_conexionturismo, $conexionturismo);
$query_ultimoscoments = sprintf("SELECT tblcomentarios.strNombre, tblcomentarios.idComentario, tblblog.strNombre AS blog, tblblog.strSEO FROM tblcomentarios INNER JOIN tblblog ON tblcomentarios.idArticulo = tblblog.idArticulo WHERE tblcomentarios.intEstado = 1 AND tblblog.intEstado = 1 AND tblcomentarios.idArticulo = %s ORDER BY tblcomentarios.fchPost DESC LIMIT 5", GetSQLValueString($varBlog_ultimoscoments, "int"));
$ultimoscoments = mysql_query($query_ultimoscoments, $conexionturismo) or die(mysql_error());
$row_ultimoscoments = mysql_fetch_assoc($ultimoscoments);
$totalRows_ultimoscoments = mysql_num_rows($ultimoscoments);

mysql_select_db($database_conexionturismo, $conexionturismo);
$query_imagenes = "SELECT tblimagen.strImagen, tblproducto.strNombre FROM tblproducto INNER JOIN tblimagen ON tblimagen.idProducto = tblproducto.idProducto WHERE tblproducto.intEstado = 1 ORDER BY RAND() LIMIT 8";
$imagenes = mysql_query($query_imagenes, $conexionturismo) or die(mysql_error());
$row_imagenes = mysql_fetch_assoc($imagenes);
$totalRows_imagenes = mysql_num_rows($imagenes);
?><!DOCTYPE html>
<html lang="es-ES">
    <head>
		<?php include("includes/metatag.php"); ?>
        <meta name="author" content="<?php echo $row_blogdatos['strAutor']; ?>" />
        <meta property="og:title" content="<?php echo $row_blogdatos['strNombre']; ?> | Blog CaribeTour.es" />
        <meta name="title" content="<?php echo $row_blogdatos['strNombre']; ?> | Blog CaribeTour.es" />
        <meta name="DC.title" content="<?php echo $row_blogdatos['strNombre']; ?> | Blog CaribeTour.es" />
        <title><?php echo $row_blogdatos['strNombre']; ?> | Blog CaribeTour.es</title>
        <meta name="description" content="<?php echo substr($row_blogdatos['strMetaDescripcion'], 0, 121); ?> | Blog CaribeTour.es" />
        <meta name="keywords" content="<?php echo ucwords($row_blogdatos['strMetakeyWords']); ?>" />
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
                        <div class="breadcrumb"><a hreflang="es" type="text/html" charset="iso-8859-1" href="index.php" rel="tag" title="Inicio">Inicio</a></div>
                        <div class="breadcrumb"><a hreflang="es" type="text/html" charset="iso-8859-1" href="blog" rel="tag" title="Blog">Blog</a></div>
                        <div class="breadcrumb"><?php echo $row_blogdatos['strNombre']; ?></div>
                    </div>
                <!--fin de breadcrumb-->
            	<div class="row">
                    <div class="column eightcol">
                        <article class="post-112 post type-post status-publish format-standard hentry category-guides tag-amet tag-dolor tag-lorem post full-post">
                            <div class="post-featured-image">
                                <div class="featured-image">
                                    <a hreflang="es" type="text/html" charset="iso-8859-1" href="blog/<?php echo $row_blogdatos['strSEO']; ?>" title="<?php echo $row_blogdatos['strNombre']; ?>"><img width="768" height="522" src="img/<?php echo $row_blogdatos['strImagen']; ?>" class="attachment-wide wp-post-image" alt="<?php echo $row_blogdatos['strNombre']; ?>" /></a>
                                </div>
                            </div>
                            <div class="post-content">
                                <div class="section-title">
                                    <h1><a hreflang="es" type="text/html" charset="iso-8859-1" href="blog/<?php echo $row_blogdatos['strSEO']; ?>"><?php echo $row_blogdatos['strNombre']; ?></a></h1>
                                </div>
                                <?php echo nl2br(ucfirst($row_blogdatos['strDescripcion'])); ?>			
                            </div>
                            <footer class="post-footer clearfix">
                                <div class="post-comment-count"><?php echo $row_comentarios['comentarios']; ?></div>
                                <div class="post-info">Por <strong><?php echo $row_blogdatos['strAutor']; ?></strong> el <?php echo fechaCorta($row_blogdatos['fchFecha']); ?></div>
                            </footer>
                        </article>
                        <div class="post-comments clearfix">
                            <div class="section-title">
                                <h2>Deja tus Comentarios</h2>
                            </div>
                            <div id="respond" class="comment-respond">
                                <form action="coment_add.php" method="post" id="commentform" class="comment-form" name="comentarios" onSubmit="return validacion();">
                                    <div class="formatted-form">
                                    	<div class="message" id="nrequired" style="display:none;">Por favor indique su nombre completo</div>
                                        <div class="sixcol column">
                                            <div class="field-container">
                                                <input id="nombre" name="strNombre" type="text" value="" size="30" maxlength="50" title="Indroduzca su Nombre" placeholder="Nombre" required />
                                            </div>
                                        </div>
                                        <div class="message" id="erequired" style="display:none;">Por favor indique un correo v&aacute;lido</div>
                                        <div class="sixcol column last">
                                            <div class="field-container">
                                                <input id="email" name="strEmail" type="email" value="" title="Introduzca su Email" maxlength="60" size="30" placeholder="Email" required />
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="message" id="mrequired" style="display:none;">Es necesario rellenar este campo</div>
                                        <div class="field-container">
                                            <textarea id="mensaje" name="strComentario" title="Introduzca sus Comentarios" maxlength="1000" cols="45" rows="8" placeholder="Comentario" required ></textarea>
                                        </div>
                                    </div>
                                    <p class="form-submit">
                                        <input name="submit" type="submit" id="submit" value="Comentar" />
                                        <input type="hidden" name="idArticulo" value="<?php echo $row_blogdatos['idBlog'] ?>" />
                                        <input type="hidden" name="blogSeo" value="<?php echo $_SERVER["REQUEST_URI"]; ?>" />
                                        <input type="hidden" name="MM_insert" value="comentarios" />
                                    </p><br>
                                </form>
                            </div><!-- #respond --><?php if ($totalRows_comentarios > 0) { ?>
                            <div class="section-title">
                                <h2>Comentarios</h2>
                            </div>
                            <div class="comments-list" id="comments">		
                                <ul><?php do { ?>
                                    <li id="comment-<?php echo $row_comentarios['idComentario']; ?>">
                                        <div class="comment clearfix">
                                            <div class="comment-text">
                                                <header class="comment-header clearfix">				
                                                    <h6 class="comment-author"><?php echo $row_comentarios['strNombre']; ?></h6>
                                                    <time class="comment-date" datetime="<?php echo fechaCorta($row_comentarios['fchPost']); ?>"><?php echo fechaCorta($row_comentarios['fchPost']); ?></time>
                                                    <span class='comment-reply-link'></span>
                                                </header>
                                                <p><?php echo $row_comentarios['strComentario']; ?></p>
                                            </div>
                                        </div>
                                    </li><?php } while ($row_comentarios = mysql_fetch_assoc($comentarios)); ?><!-- #comment-## -->
                                </ul>
                            </div><?php } ?>
                            <nav class="pagination comments-pagination"></nav>
                        </div>
                        <!-- post comments -->
                    </div>
                    <aside class="column fourcol last">
                        <div class="widget widget-selected-posts">
                            <div class="section-title"><h4>Art&iacute;culos Populares</h4></div><?php do { ?>
                            <article class="post-112 post type-post status-publish format-standard hentry category-guides tag-amet tag-dolor tag-lorem post clearfix">
                                <div class="post-featured-image">
                                    <div class="featured-image">
                                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="blog/<?php echo $row_popularpost['strSEO']; ?>"><img width="440" height="299" src="img/<?php echo $row_popularpost['strImagen']; ?>" class="attachment-normal wp-post-image" alt="image_7" /></a>
                                    </div>
                                </div>
                                <div class="post-content">
                                    <h6 class="post-title"><a hreflang="es" type="text/html" charset="iso-8859-1" href="blog/<?php echo $row_popularpost['strSEO']; ?>"><?php echo $row_popularpost['strNombre']; ?></a></h6>
                                    <footer class="post-footer clearfix">
                                        <div class="post-comment-count"><?php echo $row_popularpost['comentarios']; ?></div>
                                        <div class="post-info">
                                                <time datetime="2012-11-24"><?php echo fechaCorta($row_popularpost['fchFecha']); ?></time>
                                        </div>
                                    </footer>
                                </div>
                            </article><?php } while ($row_popularpost = mysql_fetch_assoc($popularpost)); ?>
                        </div><?php if ($totalRows_ultimoscoments > 0) { ?>
                        <div class="widget widget_recent_comments">
                            <div class="section-title"><h4>Comentarios Recientes</h4></div>
                            <ul id="recentcomments"><?php do { ?>
                                <li class="recentcomments"><?php echo $row_ultimoscoments['strNombre']; ?> en <a hreflang="es" type="text/html" charset="iso-8859-1" href="blog/<?php echo $row_ultimoscoments['strSEO']; ?>#comment-<?php echo $row_ultimoscoments['idComentario']; ?>"><?php echo $row_ultimoscoments['blog']; ?></a></li><?php } while ($row_ultimoscoments = mysql_fetch_assoc($ultimoscoments)); ?>
                            </ul>
                        </div><?php } ?>
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
        <script type='text/javascript' src='js/jquery.ui.slider.min.js?ver=1.10.3'></script><!--para el slider de las imagenes (indez, destino-detalles)-->
        <script type='text/javascript' src='js/jquery.ui.datepicker.min.js?ver=1.10.3'></script>
        <script type='text/javascript'>
		window.onload = function(){
			var url = document.location.href;
			var comentario = url.split('?')[1];
			if (comentario){
				alert ("¡Gracias por dejar tus comentarios! ;-)");
			}
		}
		</script>
        <script type='text/javascript' src='js/validar.js'></script>
    </body>
</html>
<?php
mysql_free_result($blogdatos);

mysql_free_result($comentarios);

mysql_free_result($popularpost);

mysql_free_result($ultimoscoments);

mysql_free_result($imagenes);
?>