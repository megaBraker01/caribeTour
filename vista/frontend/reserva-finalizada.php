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
$query_producto = sprintf("SELECT tblproducto.idProducto, tblproducto.intCategoria, tblproducto.strNombre, tblproducto.strItinerario, tblproducto.strSEO,  tblproducto.strImagen, tblproducto.strMetaDescripcion, tblproducto.strMetakeyWords, tblcategoria.idPadre AS padre, tblcategoria.strDescripcion AS subcategoria, tblcategoria.strSEO AS seoSubCat, (SELECT tblcategoria.strDescripcion FROM tblcategoria WHERE tblcategoria.idCategoria = padre) AS categoria, (SELECT tblcategoria.strSEO FROM tblcategoria WHERE tblcategoria.idCategoria = padre) AS seoCategoria, tblfechas.idFecha AS id, (SELECT Sum(tblfechas.dblPrecio + tblfechas.dblTasas) FROM tblfechas WHERE tblfechas.idFecha = id LIMIT 1) AS dblPrecio, tblfechas.fchIda, tblfechas.fchVuelta, tblproveedor.strEmail AS emailProveedor FROM tblproducto INNER JOIN tblcategoria ON tblproducto.intCategoria = tblcategoria.idCategoria INNER JOIN tblfechas ON tblproducto.idProducto = tblfechas.idProducto INNER JOIN tblproveedor ON tblproducto.intProveedor = tblproveedor.idProveedor WHERE tblproducto.idProducto = %s AND tblfechas.idFecha = %s ORDER BY tblfechas.fchIda ASC LIMIT 1", GetSQLValueString($varProducto_producto, "int"), GetSQLValueString($varProducto_fecha, "int"));
$producto = mysql_query($query_producto, $conexionturismo) or die(mysql_error());
$row_producto = mysql_fetch_assoc($producto);
$totalRows_producto = mysql_num_rows($producto);

$varReserva = "0";
if (isset($_SESSION['reserva'])) {
  $varReserva = $_SESSION['reserva'];
}

mysql_select_db($database_conexionturismo, $conexionturismo);
$query_pasajeros = sprintf("SELECT tblcliente.idCliente, tblcliente.idReserva, tblcliente.strNombre, tblcliente.strApellidos, tblcliente.strDNI, tblcliente.strEmail, tblcliente.fchNacimiento, tblcompra.dblPrecio, tblcompra.dblTasas, tblreserva.dblTotal FROM tblcliente INNER JOIN tblcompra ON tblcliente.idReserva = tblcompra.idReserva INNER JOIN tblreserva ON tblcliente.idReserva = tblreserva.idReserva INNER JOIN tblproducto ON tblcompra.idProducto = tblproducto.idProducto WHERE tblcliente.idReserva = %s AND tblproducto.intTipo != 5", GetSQLValueString($varReserva, "int"));
$pasajeros = mysql_query($query_pasajeros, $conexionturismo) or die(mysql_error());
$row_pasajeros = mysql_fetch_assoc($pasajeros);
$totalRows_pasajeros = mysql_num_rows($pasajeros);

mysql_select_db($database_conexionturismo, $conexionturismo);
$query_pasajerosProveedor = sprintf("SELECT tblcliente.idCliente, tblcliente.idReserva, tblcliente.strNombre, tblcliente.strApellidos, tblcliente.strDNI, tblcliente.fchNacimiento FROM tblcliente INNER JOIN tblcompra ON tblcliente.idReserva = tblcompra.idReserva INNER JOIN tblproducto ON tblcompra.idProducto = tblproducto.idProducto WHERE tblcliente.idReserva = %s AND tblproducto.intTipo != 5", GetSQLValueString($varReserva, "int"));
$pasajerosProveedor = mysql_query($query_pasajerosProveedor, $conexionturismo) or die(mysql_error());
$row_pasajerosProveedor = mysql_fetch_assoc($pasajerosProveedor);
$totalRows_pasajerosProveedor = mysql_num_rows($pasajerosProveedor);
$cantidadPasajeros = $totalRows_pasajerosProveedor-1;

mysql_select_db($database_conexionturismo, $conexionturismo);
$query_seguro = sprintf("SELECT tblproducto.strNombre, tblcategoria.strDescripcion, tblcompra.dblPrecio, tblcompra.dblTasas FROM tblproducto INNER JOIN tblcategoria ON tblproducto.intCategoria = tblcategoria.idCategoria INNER JOIN tblcompra ON tblproducto.idProducto = tblcompra.idProducto WHERE tblproducto.intTipo = 5 AND tblcompra.idReserva = %s", GetSQLValueString($varReserva, "int"));
$seguro = mysql_query($query_seguro, $conexionturismo) or die(mysql_error());
$row_seguro = mysql_fetch_assoc($seguro);
$totalRows_seguro = mysql_num_rows($seguro);

?>
<!DOCTYPE html>
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
        <meta property="og:title" content="Reserva Finalizada | CaribeTour.es" />
        <meta name="title" content="Reserva Finalizada | CaribeTour.es" />
        <meta name="DC.title" content="Reserva Finalizada | CaribeTour.es" />
        <title>Reserva Finalizada | CaribeTour.es</title>
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
                    <div class="breadcrumb"> Destinos </div>
                    <div class="breadcrumb"> <?php echo $row_producto['categoria']; ?> </div>
                    <div class="breadcrumb"> <?php echo $row_producto['subcategoria']; ?> </div>
                    <div class="breadcrumb"> <?php echo $row_producto['strNombre']; ?> </div>
                    <div class="breadcrumb">Datos del cliente</div>
                    <div class="breadcrumb">Forma de Pago</div>
                    <div class="breadcrumb">Reserva Finalizada</div>
                </div>
            	<!--fin de breadcrumb-->
                <div class="row">
                    <div class="section-title">
                            <h1>Reserva Finaliza</h1>
                    </div>
                    <div class="eightcol column">
                    <?php $idTitular = $row_pasajeros['idCliente'];
// envío de email al proveedor //
$destinatario = strtolower($row_pasajeros['strEmail']);
$asunto = 'Reserva W-0'.$row_pasajeros['idReserva'].' en CaribeTour.es';
$mensaje = '<h5 class="tour-title">Has elegido  la forma de pago por TRANSFERENCIA.</h5>
                    <p>Ahora deber&aacute;s efectuar la transferencia o el ingreso al siguiente n&uacute;mero de cuenta:</p>
                    <p><strong>TITULAR: CaribeTour.es</strong></p>
                    <p><strong>BANCO: ING Direct</strong></p>
                    <p><strong>IBAN: ES55 1465 0100 99 1709163771</strong></p>
                    <p><strong>Concepto: Reserva W-0'.$row_pasajeros['idReserva'].'</strong></p>
                    <p><strong>Por un importe total de '.moneda($row_pasajeros['dblTotal']).' &euro;</strong></p>
                    <p>Una vez hayas realizado la transferencia, deber&aacute;s remitirnos un email con el certificado de tu pago a <i>pagos@caribetour.es</i>. Recuerda que la reserva s&oacute;lo se har&aacute; efectiva despu&eacute;s que nos hayas enviado el certificado del pago.</p>
                    <p>Hemos remitido el resumen de esta reserva a la cuenta de correo <em>'. strtolower($row_pasajeros['strEmail']).'.</em></p>
                    <div class="tour-caption"><h2 class="tour-title">Resumen de la Reserva</h2></div>
                        <h3>TITULAR: '.$row_pasajeros['strNombre'].' '.$row_pasajeros['strApellidos'].'</h3>
                        <table summary="Resumen de la reserva W0'.$row_pasajeros['idReserva'].'">
                        	<caption><h3>LOCALIZADOR: W0'.$row_pasajeros['idReserva'].'</h3></caption>
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
                                    <th colspan="2" scope="row"><h3>'. moneda($row_pasajeros['dblTotal']).' &euro;</h3></th>
                                </tr>
                            </tfoot>
                            <tbody>'; do { if ($row_pasajeros['idCliente']!=$idTitular) { 
							$anos = Edad($row_pasajeros['fchNacimiento']);
                                $mensaje .=' <tr>
                                    <td>'. $row_pasajeros['strNombre'].' '.$row_pasajeros['strApellidos'].'</td>
                                    <td>'.fechaCorta($row_pasajeros['fchNacimiento']).' ('. Tratamiento($anos) .')</td>
                                    <td>'; if ($anos < 2){ $precio = 0; $mensaje .=moneda($precio).' &euro;'; } else { $precio = $row_pasajeros['dblPrecio']; $mensaje .= moneda($precio).' &euro;'; } $mensaje .='</td>
									<td>'.moneda($row_pasajeros['dblTasas']).' &euro; </td>';
								} } while ($row_pasajeros = mysql_fetch_assoc($pasajeros));
                                $mensaje .='<tr>'; if ($totalRows_seguro > 0) { // Show if recordset not empty 
                                	$mensaje .='<th colspan="3">SEGUROS</th>
                                </tr>'; do { 
                                $mensaje .='<tr>
                                	<td>Seguros de '.$row_seguro['strNombre'].'</td>
                                    <td>'.$row_seguro['strDescripcion'].'</td>
                                    <td>'.moneda($row_seguro['dblPrecio']).' &euro;</td>
                                </tr>';
                                } while ($row_seguro = mysql_fetch_assoc($seguro)); } // Show if recordset not empty
                            $mensaje .='</tbody>
                        </table>
						<p>&nbsp;</p>
						<h4>NOTA IMPORTANTE</h4>
                        <p>Desde el momento en que realiz&oacute; su solicitud de reserva, hemos procedido a tramitarla contactando con el tour operador para confirmar la disponibilidad de plazas en las fechas seleccionadas. en breve nos pondremos en contacto con usted, si a&uacute;n no lo hemos hecho, para informarle de la fecha de recepci&oacute;n de la documentaci&oacute;n y absolver cualquier duda que le pueda surgir. En caso de que la reserva no fuera confirmada tal y como usted lo solicit&oacute;, se le ofrecer&aacute; una alternativa de caracter&iacute;sticas similares a las solicitadas. por favor, tenga en cuenta que una vez tramitada y confirmada la reserva, cualquier cambio o cancelaci&oacute;n de la misma podr&iacute;a generar gastos por parte del tour operador.</p>';
						echo $mensaje;
						EnvioCorreoCliente($destinatario, $mensaje, $asunto);
						// enviar mensaje al proveedor
						$mensajeProveedor = '<p>Por favor, confirmar y reservar un &ldquo;'.$row_producto['strNombre'].' X '.$cantidadPasajeros.'&rdquo; con ida el '.MostratFechaEspanol($row_producto['fchIda']).' y la vuelta el '.MostratFechaEspanol($row_producto['fchVuelta']).'.</p>
						<h3>TITULAR: '.$row_pasajerosProveedor['strNombre'].' '.$row_pasajerosProveedor['strApellidos'].'</h3>
                        <table summary="Resumen de la reserva W0'.$row_pasajerosProveedor['idReserva'].'">
                        	<caption><h3>LOCALIZADOR: W0'.$row_pasajerosProveedor['idReserva'].'</h3></caption>
                            <thead>
                                <tr>
                                    <th scope="col">PASAJEROS</th>
                                    <th scope="col">FECHA DE NACIMIENTO</th>
                                    <th scope="col">DNI O PASAPORTE</th>
                                </tr>
                            </thead>
                            <tbody>';
							 do { if ($row_pasajerosProveedor['idCliente']!=$idTitular) {
							$anos = Edad($row_pasajerosProveedor['fchNacimiento']);
                                $mensajeProveedor .=' <tr>
                                    <td>'. $row_pasajerosProveedor['strNombre'].' '.$row_pasajerosProveedor['strApellidos'].'</td>
                                    <td>'.fechaCorta($row_pasajerosProveedor['fchNacimiento']).' ('. Tratamiento($anos) .')</td>
                                    <td>'.$row_pasajerosProveedor['strDNI'].'</td>';
								} } while ($row_pasajerosProveedor = mysql_fetch_assoc($pasajerosProveedor));
                                $mensajeProveedor .='
							</tbody>
                        </table>';
						EnvioCorreoProveedor($row_producto['emailProveedor'],$mensajeProveedor, $asunto);
						?>                 
                    </div>
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
                    </div>
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
        <script type='text/javascript' src='js/jquery.ui.datepicker.min.js?ver=1.10.3'></script><!--para el calendario-->
    </body>
</html>
<?php
mysql_free_result($producto);

mysql_free_result($pasajeros);

mysql_free_result($pasajerosProveedor);

mysql_free_result($seguro);
//session_unset(); session_destroy();
?>