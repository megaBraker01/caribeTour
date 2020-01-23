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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$Sintaxis='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "suscribir")) {
	if($_POST["email"]!="" && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && preg_match($Sintaxis,$_POST["email"])){
		$varEmail_emailrepetido = $_POST["email"];
		mysql_select_db($database_conexionturismo, $conexionturismo);
		$query_emailrepetido = sprintf("SELECT tblsuscriptores.strEmail FROM tblsuscriptores WHERE tblsuscriptores.strEmail = %s", GetSQLValueString($varEmail_emailrepetido, "text"));
		$emailrepetido = mysql_query($query_emailrepetido, $conexionturismo) or die(mysql_error());
		$row_emailrepetido = mysql_fetch_assoc($emailrepetido);
		$totalRows_emailrepetido = mysql_num_rows($emailrepetido);
		if ($totalRows_emailrepetido){
			$insertGoTo = "contactos?suscritor=".strtolower(limpiarstr($_POST["email"]));
			header(sprintf("Location: %s", $insertGoTo));
		}
		else {
			$insertSQL = sprintf("INSERT INTO tblsuscriptores (strEmail, fchFecha) VALUES (%s, NOW())",
							   GetSQLValueString(strtolower(limpiarstr($_POST["email"])), "text"));
			
			mysql_select_db($database_conexionturismo, $conexionturismo);
			$Result1 = mysql_query($insertSQL, $conexionturismo) or die(mysql_error());
			
			$insertGoTo = "contactos?suscritook";
			header(sprintf("Location: %s", $insertGoTo));	
		}
	}
	else {
		$insertGoTo = "contactos?errorsuscritor=".strtolower(limpiarstr($_POST["email"]));
			header(sprintf("Location: %s", $insertGoTo));
	}
} 
?><!DOCTYPE html>
<html lang="es-ES">
    <head>
        <?php include("includes/metatag.php"); ?>
        <meta property="og:title" content="Cont&aacute;tos de CaribeTour.es | Especialistas en el Caribe" />
        <meta name="title" content="Cont&aacute;tos de CaribeTour.es | Especialistas en el Caribe" />
        <meta name="DC.title" content="Cont&aacute;tos de CaribeTour.es | Especialistas en el Caribe" />
        <title>Cont&aacute;tos de CaribeTour.es | Especialistas en el Caribe</title>
        <meta name="description" content="Cont&aacute;tos de CaribeTour.es | Especialistas en el Caribe" />
        <meta name="keywords" content="Cont&aacute;tos de CaribeTour.es" />
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
        <script type="text/javascript">
		function suscriptor (){
			var suscribir = document.getElementById("suscribir").value;
			if (typeof(suscribir) !="undefined"){
				expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if(suscribir == "" || !expr.test(suscribir)){
					document.getElementById("srequired").style.display ="";
					document.getElementById("suscribir").focus();
					return false;
				}
			}
		}
		</script>
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
            <!--<section class="container site-content">
              <div class="row"></div>
            </section>
                <div class="map-container align-top">
                    <div class="map-canvas" id="map-568994f34666f" style="height:300px"></div>
                    <input type="hidden" class="map-latitude" value="40.344952" />
                    <input type="hidden" class="map-longitude" value="-3.689895" />
                    <input type="hidden" class="map-zoom" value="15" />
                    <input type="hidden" class="map-description" value="Vis&iacute;tanos cuando quieras" />
                </div>-->
            <section class="container site-content">
                <div class="row">
                    <div class="eightcol column"><?php if (isset($_SESSION['nombre']) && !isset($_SESSION['enviado'])){
				echo "<h1>Por favor rellene todos los campos del formulario.</h1><br>";
				} ?><?php if (isset($_SESSION['enviado']) && $_SESSION['enviado']==1){
				echo "<h1>Gracias por su consulta, los datos se han enviado correctamente.</h1><br>";
				} ?><?php if (isset($_SESSION['enviado']) && $_SESSION['enviado']==0){
				echo "<h1 style='color:red'>Error al enviar los datos del formulario, por favor int&eacute;ntelo de nuevo.</h1><br>";
				} ?>
                        <div class="section-title"><h1>Contacta con nosotros</h1></div>
                        <form action="mail.php" method="POST" class="formatted-form" name="clientes" onSubmit="return validacion();">
                        <p></p>
                            <div class="sixcol column ">
                                <div class="field-container">
                                    <input type="text" id="nombre" name="nombre" title="Introduzca su Nombtre Completo." maxlength="50" placeholder="Nombre Completo" value="<?php if (isset($_SESSION['nombre']) && $_SESSION['enviado']!=1) { echo $_SESSION['nombre']; } ?>" required />
                                </div>
                            </div>
                            <div class="sixcol column last">
                                <div class="field-container">
                                    <input  type="email" id="email" name="email" title="Introduzca su Email." maxlength="80" placeholder="Email" value="<?php if (isset($_SESSION['email']) && $_SESSION['enviado']!=1) { echo $_SESSION['email']; } ?>" required />
                                </div>
                            </div>                            
                            <div class="clear"></div>
                            <div class="field-container">
                                <textarea id="mensaje" name="mensaje" title="Introduzca su Mensaje." maxlength="1000" placeholder="Mensaje" required ><?php if (isset($_SESSION['mensaje']) && $_SESSION['enviado']!=1) { echo $_SESSION['mensaje']; } ?></textarea>
                            </div>
                            <input type="submit" class="action" value="Enviar" title="Enviar" />
                            <input type="hidden" name="producto" value="algo" />
                            <input type="hidden" name="volver" value="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]; ?>" />
                        </form>
                    </div>
                    <div class="fourcol column last">
                        <div class="widget widget-subscribe">
                            <div class="section-title"><h4>Noticias</h4></div>
                            <p>Suscr&iacute;bete a nuestras noticias para mantenerte actualizado con las ofertas de &uacute;ltimo minuto disponibles en CaribeTour.es</p>
                            <form action="<?php echo $editFormAction; ?>" method="POST" name="suscribir" onSubmit="return suscriptor();" >
                            	<div class="message" id="srequired" style="display:none;">Por favor indique un correo v&aacute;lido</div>
                                <?php if (isset($_GET['suscritor'])) {echo '<div class="message">Este correo ya est&aacute; suscrito</div>';} ?>
                                <?php if (isset($_GET['suscritook'])){ echo '<div>Gracias por suscribirte!!</div>';} ?>
                                <?php if (isset($_GET['errorsuscritor'])){ echo '<div class="message">Por favor indique un correo v&aacute;lido</div>';} ?>
                                <div class="field-container">
                                    <input type="email" name="email" id="suscribir" placeholder="Email" value="<?php if (isset($_GET['suscritor'])) {echo $_GET['suscritor'];} if (isset($_GET['errorsuscritor'])) {echo $_GET['errorsuscritor'];} ?>" title="Introduzca su Email para suscribirse." maxlength="60" required />
                                </div><br>
                                <input type="submit" class="action" value="Suscribirse" title="Suscribirse" />
                                <input type="hidden" name="MM_insert" value="suscribir">
                            </form>
                      </div>
                        <div class="widget widget_text">
                            <div class="section-title">
                                <h4>Detalles</h4>
                            </div>
                            <div class="textwidget">
                              <!--<strong>Ofic&iacute;na:</strong> 6258 Amesbury St, San Diego, CA<br />
                              <strong>Tel&eacute;fono:</strong> (619) 264-5690<br />-->
                              <strong>Email:</strong><img src="images/email.gif" alt="Email" width="119" height="15">
                          </div>
                        </div>
                    </div>
                    <div class="clear"></div>
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
        <script type="text/javascript" src="js/validar-pro.js"></script>
    	<script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=false&#038;ver=3.7.11'></script>
    </body>
</html>
<?php
mysql_free_result($emailrepetido);
 session_unset(); session_destroy(); ?>