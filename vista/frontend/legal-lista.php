<?php require_once('Connections/conexionturismo.php'); ?>
<?php require_once('Connections/conexionturismo.php'); 
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

mysql_select_db($database_conexionturismo, $conexionturismo);
$query_legales = "SELECT tbllegal.strNombre, tbllegal.strSEO FROM tbllegal WHERE tbllegal.intEstado = 1";
$legales = mysql_query($query_legales, $conexionturismo) or die(mysql_error());
$row_legales = mysql_fetch_assoc($legales);
$totalRows_legales = mysql_num_rows($legales);
?>
<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <?php include("includes/metatag.php"); ?>
        <meta property="og:title" content="Area Legal de CaribeTour.es | Especialistas en el Caribe" />
        <meta name="title" content="Area Legal de CaribeTour.es | Especialistas en el Caribe" />
        <meta name="DC.title" content="Area Legal de CaribeTour.es | Especialistas en el Caribe" />
        <title>Area Legal de CaribeTour.es | Especialistas en el Caribe</title>        
        <meta name="description" content="Area Legal de CaribeTour.es | Especialistas en el Caribe" />
        <meta name="keywords" content="Area Legal de CaribeTour.es | Especialistas en el Caribe" />
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
                        <a href="inicio" rel="tag" title="Inicio">Inicio</a>
                    </div>
                    <div class="breadcrumb">Legal</div>
                </div>
            <!--fin de breadcrumb-->
            <div class="row">
                <div class="column ninecol">
                        <div class="items-list clearfix">
                          <h1>Area Legal</h1>
                          <ul>
                          	<?php do { ?>
                       	    <li><a hreflang="es" type="text/html" charset="utf-8" href="legal/<?php echo $row_legales['strSEO']; ?>" title="<?php echo $row_legales['strNombre']; ?>"><?php echo $row_legales['strNombre']; ?></a></li>
                          	  <?php } while ($row_legales = mysql_fetch_assoc($legales)); ?></ul>
                          <p></p>
                        </div>
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
            </div>
        </section>
        <!-- /content -->
        <!-- footer -->
        <?php include("includes/footer.php");?>
        <!-- /footer -->
        <div class="substrate bottom-substrate"> <img src="images/site_bg.jpg" class="fullwidth" alt="Imagen de fondo" /> </div>
        </div>
<script type='text/javascript' src='js/jquery.ui.core.min.js?ver=1.10.3'></script>
        <script type='text/javascript' src='js/jquery.ui.widget.min.js?ver=1.10.3'></script>
        <script type='text/javascript' src='js/jquery.ui.mouse.min.js?ver=1.10.3'></script>
        <script type='text/javascript' src='js/jquery.ui.slider.min.js?ver=1.10.3'></script>
        <script type='text/javascript' src='js/jquery.ui.datepicker.min.js?ver=1.10.3'></script>
    </body>
</html>
<?php
mysql_free_result($legales);
?>