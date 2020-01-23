<?php require_once('Connections/conexionturismo.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['reserva'])) {
	header("Location: index.php");
	exit;
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
$varProducto_fecha = 0;
$varProducto_producto = 0;
if (isset($_SESSION['producto']) && isset($_SESSION['idFecha'])) {
  $varProducto_producto = $_SESSION['producto'];
  $varProducto_fecha = $_SESSION['idFecha'];
}

mysql_select_db($database_conexionturismo, $conexionturismo);
$query_seo = sprintf("SELECT tblcategoria.idCategoria, tblcategoria.idPadre AS padre, tblcategoria.strDescripcion AS subCategoria, tblcategoria.strSEO AS seoSubCategoria, (SELECT tblcategoria.strDescripcion FROM tblcategoria WHERE idCategoria = padre LIMIT 1) AS categoria,(SELECT tblcategoria.strSEO FROM tblcategoria WHERE idCategoria = padre LIMIT 1) AS seoCategoria, tblproducto.strNombre AS producto, tblproducto.strSEO AS seoProducto FROM tblcategoria INNER JOIN tblproducto ON tblcategoria.idCategoria = tblproducto.intCategoria WHERE tblproducto.idProducto = %s LIMIT 1", GetSQLValueString($varProducto_producto, "int"));
$seo = mysql_query($query_seo, $conexionturismo) or die(mysql_error());
$row_seo = mysql_fetch_assoc($seo);
$totalRows_seo = mysql_num_rows($seo);

mysql_select_db($database_conexionturismo, $conexionturismo);
$query_producto = sprintf("SELECT tblproducto.idProducto, tblproducto.intCategoria, tblproducto.strNombre, tblproducto.strItinerario, tblproducto.strSEO,  tblproducto.strImagen, tblproducto.strMetaDescripcion, tblproducto.strMetakeyWords, tblcategoria.strDescripcion AS subcategoria, tblcategoria.strSEO AS seoSubCat, tblfechas.idFecha AS id, (SELECT Sum(tblfechas.dblPrecio + tblfechas.dblTasas) FROM tblfechas WHERE tblfechas.idFecha = id LIMIT 1) AS dblPrecio, tblfechas.fchIda, tblfechas.fchVuelta FROM tblproducto INNER JOIN tblcategoria ON tblproducto.intCategoria = tblcategoria.idCategoria INNER JOIN tblfechas ON tblproducto.idProducto = tblfechas.idProducto WHERE tblproducto.intEstado = 1 AND tblproducto.intStock > 0 AND tblcategoria.intEstado = 1 AND tblproducto.idProducto = %s AND tblfechas.idFecha = %s AND tblfechas.fchIda > NOW() ORDER BY tblfechas.fchIda ASC LIMIT 1", GetSQLValueString($varProducto_producto, "int"), GetSQLValueString($varProducto_fecha, "int"));
$producto = mysql_query($query_producto, $conexionturismo) or die(mysql_error());
$row_producto = mysql_fetch_assoc($producto);
$totalRows_producto = mysql_num_rows($producto);

$varReserva = "0";
if (isset($_SESSION['reserva'])) {
  $varReserva = $_SESSION['reserva'];
}

mysql_select_db($database_conexionturismo, $conexionturismo);
$query_pasajeros = sprintf("SELECT tblcliente.idCliente, tblcliente.idReserva, tblcliente.strNombre, tblcliente.strApellidos, tblcliente.strEmail, tblcliente.fchNacimiento, tblcompra.dblPrecio, tblcompra.dblTasas, tblreserva.dblTotal FROM tblcliente INNER JOIN tblcompra ON tblcliente.idReserva = tblcompra.idReserva INNER JOIN tblreserva ON tblcliente.idReserva = tblreserva.idReserva INNER JOIN tblproducto ON tblcompra.idProducto = tblproducto.idProducto WHERE tblcliente.idReserva = %s AND tblproducto.intTipo != 5", GetSQLValueString($varReserva, "int"), GetSQLValueString($varReserva, "int"));
$pasajeros = mysql_query($query_pasajeros, $conexionturismo) or die(mysql_error());
$row_pasajeros = mysql_fetch_assoc($pasajeros);
$totalRows_pasajeros = mysql_num_rows($pasajeros);

mysql_select_db($database_conexionturismo, $conexionturismo);
$query_seguro = sprintf("SELECT tblproducto.strNombre, tblcategoria.strDescripcion, tblcompra.dblPrecio, tblcompra.dblTasas FROM tblproducto INNER JOIN tblcategoria ON tblproducto.intCategoria = tblcategoria.idCategoria INNER JOIN tblcompra ON tblproducto.idProducto = tblcompra.idProducto WHERE tblproducto.intTipo = 5 AND tblcompra.idReserva = %s", GetSQLValueString($varReserva, "int"));
$seguro = mysql_query($query_seguro, $conexionturismo) or die(mysql_error());
$row_seguro = mysql_fetch_assoc($seguro);
$totalRows_seguro = mysql_num_rows($seguro);
?><!DOCTYPE html>
<html lang="es-ES">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="robots" content="noindex, nofollow, nosnippet, noarchive, noimageindex" />
        <meta name="language" content="Spanish" />
        <meta name="author" content="CaribeTour.es" />
        <meta name="copyright" content="Copyright &copy; <?php echo date('Y'); ?> - CaribeTour.es" />
        <meta name="description" content="CaribeTour.es: Especialistas en el Caribe" />
        <meta name="application-name" content="CaribeTour.es" />
        <meta name="geo.placename" content="Madrid" />
        <meta http-equiv="content-language" content="es-ES" />
        <meta name="geo.country" content="ES" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]; ?>" />
        <meta property="og:site_name" content="Caribetour.es"/>
        <meta property="og:title" content="Forma de Pago | CaribeTour.es" />
        <meta name="title" content="Forma de Pago | CaribeTour.es" />
        <meta name="DC.title" content="Forma de Pago | CaribeTour.es" />
        <title>Forma de Pago | CaribeTour.es</title>
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
                    <div class="breadcrumb"> <a hreflang="es" type="text/html" charset="iso-8859-1" href="index.php" rel="tag" title="ir al Inicio">Inicio</a> </div>
                    <div class="breadcrumb"> Destinos </div>
                    <div class="breadcrumb"> <?php echo $row_seo['categoria']; ?> </div>
                    <div class="breadcrumb"> <?php echo $row_seo['subCategoria']; ?> </div>
                    <div class="breadcrumb"> <?php echo $row_seo['producto']; ?> </div>
                    <div class="breadcrumb">Datos del cliente</div>
                    <div class="breadcrumb">Forma de Pago</div>
              </div>
            	<!--fin de breadcrumb-->
                <div class="row">
                    <div class="section-title">
                        <h1><?php if ($totalRows_producto > 0) { // Show if recordset not empty ?>El&iacute;ge la forma de pago<?php } // Show if recordset not empty ?><?php if ($totalRows_producto == 0) { // Show if recordset empty ?>Producto NO disponible :(<?php } // Show if recordset empty ?></h1>
                    </div>
                    <div class="eightcol column"><?php if ($totalRows_producto > 0) { // Show if recordset not empty ?>
<div class="booking-form">
                            <form method="POST" class="formatted-form" role="form" name="clientes" id="clientes" lang="es" >
                           <!-- <div class="field-container"><input type="radio" name="forma_pago" value="1" id="tarjeta" checked="CHECKED"/> <label for="tarjeta" title="Elegir la forma de pago con tarjeta VISA o MasterCard">VISA/MasterCard</label></div>-->
                            <div class="field-container"><input type="radio" name="forma_pago" id="transferencia" value="2" checked="CHECKED"/> <label for="transferencia" title="Elegir la forma de pago por transferencia bancaria">Transferencia</label></div>
                            <div class="field-container"><input type="radio" name="forma_pago" id="paypal" value="3"/> <label for="paypal" title="Elegir la forma de pago por PayPal">PayPal</label></div><br>
                            <div class="field-container"><input type="button" id="reservar" value="Pagar Reserva" title="Efectuar el Pago" onMouseDown="javascript:formaPago();" onMouseUp="javascript:accion();"/></div>
                            	<input type="hidden" name="reserva" id="reserva" value="<?php echo $row_pasajeros['idReserva']; ?>" />
                                <input type="hidden" name="upload" value="1" />
                                <input type="hidden" name="amount" value="<?php echo $row_pasajeros['dblTotal']; ?>" />
                                <input type="hidden" name="business" value="rperez@caribetour.es" />
                                <input type="hidden" name="receiver_email" value="rperez@caribetour.es" />
                                <input type="hidden" name="item_name" value="<?php echo $row_producto['strNombre']; ?> X <?php echo $totalRows_pasajeros-1; ?> Personas" />
                                <input type="hidden" name="concept" value="Reseva hecha en caribetour.es" />
                                <input type="hidden" name="reference" value="W0<?php echo $row_pasajeros['idReserva']; ?>" />
                                <input type="hidden" name="cmd" value="_xclick" />                        
                                <input type="hidden" name="currency_code" value="EUR" />
                                <input type="hidden" name="payer_id" value="<?php echo $row_pasajeros['idCliente']; ?>" />
                                <input type="hidden" name="payer_email" value="<?php echo $row_pasajeros['strEmail']; ?>" />
                                <input type="hidden" name="return" value="http://localhost/caribetour.es/paypal_ok.php?idreserva=<?php echo $row_pasajeros['idReserva']; ?>">
                                <input type="hidden" name="cancel_return" value="http://localhost/caribetour.es/paypal_cancel.php?idreserva=<?php echo $row_pasajeros['idReserva']; ?>" />
                                <input type="hidden" name="cbt" value="Volver a inicio" />
                                <input type="hidden" name="hosted_button_id" value="GX4V7KN7EPGNL" />
                            </form>
                        </div>
                      <div class="clear"></div><br/>
                      <div class="tour-caption"><h2 class="tour-title">Resumen de la Reserva</h2></div>
                        <h3>TITULAR: <?php echo $row_pasajeros['strNombre']; ?> <?php echo $row_pasajeros['strApellidos']; $idTitular = $row_pasajeros['idCliente']; ?></h3>
                        <table summary="Resumen de la reserva W0<?php echo $row_pasajeros['idReserva']; ?>">
                        	<caption><h3>LOCALIZADOR: W0<?php echo $row_pasajeros['idReserva']; ?></h3></caption>
                            <thead>
                                <tr>
                                    <th scope="col">PASAJEROS</th>
                                    <th scope="col">FECHA DE NACIMIENTO</th>
                                    <th scope="col">PRECIO</th>
                                    <th scope="col">TASAS</th>
                                </tr>
                            </thead>
                            <tfoot>
                            	<tr>
                                	<th colspan="2" scope="row"><strong>TOTAL (IVA Incluido)</strong><br/> Régimen Especial de Agencias de Viajes (REAV).</th>
                                    <th colspan="2" scope="row"><h3><?php echo moneda($row_pasajeros['dblTotal']); ?> &euro;</h3></th>
                                </tr>
                            </tfoot>
                            <tbody><?php do { if ($row_pasajeros['idCliente']!=$idTitular) { ?>
                                <tr>
                                    <td><?php echo $row_pasajeros['strNombre']; ?> <?php echo $row_pasajeros['strApellidos']; ?></td>
                                    <td><?php $anos = Edad($row_pasajeros['fchNacimiento']); echo fechaCorta($row_pasajeros['fchNacimiento']) .' ('. Tratamiento($anos) .')'; ?></td>
                                    <td><?php if ($anos < 2){?><?php $precio = 0; echo moneda($precio);?> &euro;<?php } else { ?><?php $precio = $row_pasajeros['dblPrecio']; echo moneda($precio);?> &euro;<?php }?></td>
                                    <td><?php $precio = $row_pasajeros['dblTasas']; echo moneda($precio);?> &euro;</td>
								<?php } } while ($row_pasajeros = mysql_fetch_assoc($pasajeros)); ?>
                                <tr><?php if ($totalRows_seguro > 0) { // Show if recordset not empty ?>
                                	<th colspan="4">SEGUROS</td>
                                </tr>
								<tr>
                                	<td>NOMBRE</td>
                                    <td>TIPO DE SEGURO</td>
                                    <td colspan="2">PRECIO</td>
                                </tr><?php do { ?>
                                <tr>
                                	<td>Seguros de <?php echo $row_seguro['strNombre']; ?></td>
                                    <td><?php echo $row_seguro['strDescripcion']; ?></td>
                                    <td colspan="2"><?php echo moneda($row_seguro['dblPrecio']); ?> &euro;</td>
                                </tr>
                                <?php } while ($row_seguro = mysql_fetch_assoc($seguro)); ?><?php } // Show if recordset not empty ?>
                            </tbody>
                        </table><?php } // Show if recordset not empty ?>
                        <?php if ($totalRows_producto == 0) { // Show if recordset empty ?><p>Lo sentimos, el producto elegido <strong>NO</strong> se encuentra disponible en estos momentos.</p><p>Puedes echar un vistazo en el men&uacute; <a hreflang="es" type="text/html" charset="iso-8859-1" href="destinos" title="Destinos">&quot;Destinos&quot;</a>... Disculpen las molestias.</p><?php } // Show if recordset empty ?>
                  </div><?php if ($totalRows_producto > 0) { // Show if recordset not empty ?>
<div class="fourcol column last">
                        <div class="featured-blog">
                            <article class="post">
                                <div class="featured-image">
                                    <img width="550" height="413" src="img/<?php echo $row_producto['strImagen']; ?>" class="attachment-extended wp-post-image" alt="Imagen de <?php echo $row_producto['strNombre']; ?>" title="<?php echo $row_producto['strNombre']; ?>" />
                                </div>
                                <div class="post-content">
                                    <h2 class="post-title"><?php echo $row_producto['strNombre']; ?></h2>
                                    <ul class="tour-meta">
                                        <li><div class="colored-icon icon-2"></div> <strong>Destino:</strong> <?php echo $row_producto['subcategoria']; ?></li>
                                        <li><div class="colored-icon icon-1"><span></span></div> <strong>Duraci&oacute;n:</strong> <?php $duracion=strtotime($row_producto['fchVuelta']) - strtotime($row_producto['fchIda']); echo date('d',$duracion)*1; ?> D&iacute;as</li>
                                        <li><div class="colored-icon icon-6"><span></span></div> <strong>Salida:</strong> <?php echo MostratFechaEspanol($row_producto['fchIda']); ?></li>
                                        <li><div class="colored-icon icon-7"><span></span></div> <strong>Regreso:</strong> <?php echo MostratFechaEspanol($row_producto['fchVuelta']); ?></li>
                                        <li style="font-size:1.8em;"><div class="colored-icon icon-3"><span></span></div><strong>Precio por persona:</strong> <?php echo moneda($row_producto['dblPrecio']); ?> &euro;</li>
                                    </ul>
                                    <p>&nbsp;</p>
                                </div>
                                <div class="post-content">
                                	<h3>Itinerario</h3>
                                    <p><?php $itinerario = nl2br($row_producto['strItinerario']); echo sprintf($itinerario, MostratFechaEspanol($row_producto['fchIda']), date("H:i",strtotime($row_producto['fchIda'])), $row_producto['subcategoria'], $row_producto['subcategoria'],$row_producto['strNombre'],$row_producto['strNombre'],$row_producto['subcategoria'],MostratFechaEspanol($row_producto['fchVuelta']), $row_producto['strNombre'], $row_producto['subcategoria'], date("H:i",strtotime($row_producto['fchVuelta']))); ?></p>
                                    <p><strong>NOTA:</strong> Los horarios definitivos de los Vuelos se reconfirmarán tras la realización de la reserva.</p>
                                </div>
                            </article>
                        </div>
                    </div><?php } // Show if recordset not empty ?>
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
        <script type="text/javascript">
		function formaPago (){
			var reserva = document.getElementById("reserva").value;
			var tarjeta = document.getElementById("tarjeta");
			var transfer = document.getElementById("transferencia");
			var paypal = document.getElementById("paypal");
			if(tarjeta.checked){
				var valor = tarjeta.value;
			}
			if(transfer.checked){
				var valor = transfer.value;
			}
			if(paypal.checked){
				var valor = paypal.value;
			}			
			// Comprobamos que está disponible AJAX
			if(window.XMLHttpRequest) {
				ajax = new XMLHttpRequest();
			}
			else if(window.ActiveXObject) {
				ajax = new ActiveXObject("Microsoft.XMLHTTP");
			}
			// Pedimos el archivo "prueba.php"
			ajax.open("POST","actualizarfp.php",true);
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("&forma_pago=" + valor + "&idreserva=" + reserva);
        }   
        </script>
        <script type="text/javascript">
		function accion (){
			var tarjeta = document.getElementById("tarjeta");
			var transfer = document.getElementById("transferencia");
			var paypal = document.getElementById("paypal");
			if(tarjeta.checked){
				var direccion = "recibiendo.php";
			}
			if(transfer.checked){
				var direccion = "reserva-finalizada.php?idreserva=<?php echo $_SESSION['reserva']; ?>";
			}
			if(paypal.checked){
				var direccion = "https://www.paypal.com/cgi-bin/webscr";
			}
			document.clientes.action = direccion;
			document.clientes.submit();
		
		}
		</script>
		<script type='text/javascript' src='js/jquery.ui.core.min.js?ver=1.10.3'></script>
        <script type='text/javascript' src='js/jquery.ui.widget.min.js?ver=1.10.3'></script>
        <script type='text/javascript' src='js/jquery.ui.mouse.min.js?ver=1.10.3'></script>
        <script type='text/javascript' src='js/jquery.ui.slider.min.js?ver=1.10.3'></script>
        <script type='text/javascript' src='js/jquery.ui.datepicker.min.js?ver=1.10.3'></script>
    <!--para el calendario-->
    </body>
</html>
<?php
mysql_free_result($seo);

mysql_free_result($producto);

mysql_free_result($pasajeros);

mysql_free_result($seguro);
?>