<?php

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

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
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
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
//******************************************************************************
function nombreUser($parametro){
global $database_agencia, $agencia;
mysql_select_db($database_agencia, $agencia);
$query_consultaBD = sprintf("SELECT strNombre FROM tblusuario WHERE tblusuario.idUsuario = %s", GetSQLValueString($parametro, "int"));
$consultaBD = mysql_query($query_consultaBD, $agencia) or die(mysql_error());
$row_consultaBD = mysql_fetch_assoc($consultaBD);
$totalRows_consultaBD = mysql_num_rows($consultaBD);
return $row_consultaBD['strNombre'];
mysql_free_result($consultaBD);
}
//******************************************************************************
//******************************************************************************

//******************************************************************************
//******************************************************************************

function ObtenerNombreCategoria($identificador)
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT strDescripcion FROM tblcategoria WHERE idCategoria = %s", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strDescripcion'];
	mysql_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerNombreUsuario($identificador)
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT strNombre FROM tblusuario WHERE strEmail = '%s'", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strNombre'];
	mysql_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerNombreCiente($identificador)
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT strNombre FROM tblcliente WHERE strDNI = '%s'", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strNombre'];
	mysql_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerApellidosCiente($identificador)
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT strApellidos FROM tblcliente WHERE strDNI = '%s'", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strApellidos'];
	mysql_free_result($ConsultaFuncion);	
	}
	
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function FechaCtePrincipal($identificador)
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT fchNacimiento FROM tblcliente WHERE strDNI = '%s'", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['fchNacimiento'];
	mysql_free_result($ConsultaFuncion);	
	}
	
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerIDporSEO($identificador)
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT idProducto FROM tblproducto WHERE strSEO = '%s'", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['idProducto'];
	mysql_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerCatporSEO($identificador)
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT intCategoria FROM tblproducto WHERE strSEO = '%s'", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['intCategoria'];
	mysql_free_result($ConsultaFuncion);	
	}
		//******************************************************************************
//******************************************************************************
//******************************************************************************
function getIDcatBySEO($identificador) /*obsoleto*/
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT idCategoria FROM tblcategoria WHERE strSEO = '%s'", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['idCategoria'];
	mysql_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
//******************************************************************************
//**
function ObtenerSEOporCat($identificador) //**obsoleto*//
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT strSEO FROM tblcategoria WHERE idCategoria = '%s'", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strSEO'];
	mysql_free_result($ConsultaFuncion);	
	}
//******************************************************************************	
	function SEO($parameto)
{
	$conv = array("&Aacute;" => "A", "&Eacute;" => "E", "&Iacute;" => "I", "&Oacute;" => "O", "&Uacute;" => "U", "&Ntilde;" => "N", "&aacute;" => "a", "&eacute;" => "e", "&iacute;" => "i", "&oacute;" => "o", "&uacute;" => "u", "&ntilde;" => "n", "&amp;" => "y", "&" => "y");
	return strtolower(limpiarstr(str_replace(' ', '-', trim(strtr($parameto, $conv)))));
	}
//******************************************************************************
	function limpiarstr($parameto)
{
	$remplazar = array("\n\r");
	$por = " ";
	return ucfirst(strtolower(str_replace($remplazar, $por, preg_replace("/[^A-Za-z0-9-=+_@,;&.\/\s\ ]/","",htmlentities($parameto, ENT_COMPAT, 'iso-8859-1')))));
	}
//******************************************************************************
	function capitalizar($parameto)
{
	$remplazar = array("\n\r");
	$por = " ";
	return ucwords(strtolower(str_replace($remplazar, $por, preg_replace("/[^A-Za-z0-9-=+_@,;&.\/\s\ ]/","",htmlentities($parameto, ENT_COMPAT, 'iso-8859-1')))));
	}
//******************************************************************************
function noacent($cadena){
    return strtr($cadena,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ',
'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
}
	//******************************************************************************
//******************************************************************************
function activarCabecera($parametro){
$url = explode('/',$_SERVER['PHP_SELF']);
if ($parametro == substr(end($url), 0, 2)) return true;
		}
//******************************************************************************
function moneda($parametro) 
	{
	return number_format($parametro, 2, ',', '.');
	}
//******************************************************************************
function ObtenerCatPadre($identificador)
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT idPadre FROM tblcategoria WHERE idCategoria = %s", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['idPadre'];
	mysql_free_result($ConsultaFuncion);	
	}
		//******************************************************************************
//******************************************************************************
//**
function ObtenerCatProducto($identificador)
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT intCategoria FROM tblproducto WHERE idProducto = %s", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['intCategoria'];
	mysql_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
//******************************************************************************
//**
function ObtenerIdxSeo($identificador)
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT idProducto FROM tblproducto WHERE strSEO = '%s'", $identificador);
	echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['idProducto'];
	mysql_free_result($ConsultaFuncion);	
	}
	
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerNombreProducto($identificador)
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT strNombre FROM tblproducto WHERE idProducto = %s", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strNombre'];
	mysql_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerSEOProducto($identificador)
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT strSEO FROM tblproducto WHERE idProducto = %s", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strSEO'];
	mysql_free_result($ConsultaFuncion);	
	}
	
	
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerNombreExcursion($identificador)
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT strNombre FROM tblexcursion WHERE idExcursion = %s", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strNombre'];
	mysql_free_result($ConsultaFuncion);	
	}
	
	
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerImagenporID()
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = "SELECT strNombre FROM tblproducto WHERE idProducto = idImagen";
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strNombre'];
	mysql_free_result($ConsultaFuncion);	
	}
	
	//******************************************************************************	
//******************************************************************************
function ObtenerstrImagen($identificador)
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT strImagen FROM tblimagen WHERE idImagen = %s", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strImagen'];
	mysql_free_result($ConsultaFuncion);	
	}
	
//******************************************************************************

function recortarImagen($rutaOrigen, $rutaFin, $nombre_archivo, $ancho, $alto)
{
$ruta_imagen = $rutaOrigen;

		$miniatura_ancho_maximo = $ancho;
		$miniatura_alto_maximo = $alto;
		
		$info_imagen = getimagesize($ruta_imagen);
		$imagen_ancho = $info_imagen[0];
		$imagen_alto = $info_imagen[1];
		$imagen_tipo = $info_imagen['mime'];
		
		
		$proporcion_imagen = $imagen_ancho / $imagen_alto;
		$proporcion_miniatura = $miniatura_ancho_maximo / $miniatura_alto_maximo;
		
		if ( $proporcion_imagen > $proporcion_miniatura ){
			$miniatura_ancho = $miniatura_alto_maximo * $proporcion_imagen;
			$miniatura_alto = $miniatura_alto_maximo;
		} else if ( $proporcion_imagen < $proporcion_miniatura ){
			$miniatura_ancho = $miniatura_ancho_maximo;
			$miniatura_alto = $miniatura_ancho_maximo / $proporcion_imagen;
		} else {
			$miniatura_ancho = $miniatura_ancho_maximo;
			$miniatura_alto = $miniatura_alto_maximo;
		}
		
		$x = ( $miniatura_ancho - $miniatura_ancho_maximo ) / 2;
		$y = ( $miniatura_alto - $miniatura_alto_maximo ) / 2;
		
		switch ( $imagen_tipo ){
			case "image/jpg":
			case "image/jpeg":
				$imagen = imagecreatefromjpeg( $ruta_imagen );
				break;
			case "image/png":
				$imagen = imagecreatefrompng( $ruta_imagen );
				break;
			case "image/gif":
				$imagen = imagecreatefromgif( $ruta_imagen );
				break;
		}
		
		$lienzo = imagecreatetruecolor( $miniatura_ancho_maximo, $miniatura_alto_maximo );
		$lienzo_temporal = imagecreatetruecolor( $miniatura_ancho, $miniatura_alto );
		
		imagecopyresampled($lienzo_temporal, $imagen, 0, 0, 0, 0, $miniatura_ancho, $miniatura_alto, $imagen_ancho, $imagen_alto);
		imagecopy($lienzo, $lienzo_temporal, 0,0, $x, $y, $miniatura_ancho_maximo, $miniatura_alto_maximo);
		
		imagejpeg($lienzo, $rutaFin.$nombre_archivo, 80);

}	
	
//******************************************************************************
function ObtenerPrecioProducto($identificador)
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT dblPrecio FROM tblproducto WHERE idProducto = %s", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['dblPrecio'];
	mysql_free_result($ConsultaFuncion);	
	}
	//******************************************************************************	
//******************************************************************************
function ObtenerPrecioInfanteProducto($identificador)
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT dblTasas FROM tblproducto WHERE idProducto = %s", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['dblTasas'];
	mysql_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
function ObtenerFormaPago($identificador)
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT intTipoPago FROM tblcompra WHERE idCompra = %s", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['intTipoPago'];
	mysql_free_result($ConsultaFuncion);	
	}
	
	//******************************************************************************
//******************************************************************************
//******************************************************************************
	function ObtenerFechaPago($identificador)
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT fchCompra FROM tblcompra WHERE idCompra = %s", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['fchCompra'];
	mysql_free_result($ConsultaFuncion);	
	}
	
		//******************************************************************************
//******************************************************************************
//******************************************************************************
		function MostratFechaEspanol($identificador)
{
	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado"); 
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
	$fecha = ($dias[date('w', strtotime($identificador))]." ".date('d', strtotime($identificador))." de ".$meses[date('n', strtotime($identificador))-1 ]. " del ".date("Y", strtotime($identificador)));
	return $fecha;	
	}
//******************************************************************************
	function fechaCorta($parametro)
	{
	$fecha = date("d-m-Y", strtotime($parametro));
	return $fecha;
	}
//******************************************************************************
	function is_date($fecha)
	{
		if (date('d-m-Y', strtotime($fecha)) == $fecha) {
        return true;
		} else {
			return false;
		} 
	}
//******************************************************************************
//******************************************************************************
	function ObtenerTotalPago($identificador)
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT dblTotal FROM tblcompra WHERE idCompra = %s", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['dblTotal'];
	mysql_free_result($ConsultaFuncion);	
	}
	
//******************************************************************************
//******************************************************************************
//******************************************************************************
	
	function Tratamiento($varEstado)
	{
		if ($varEstado >= 18) return "Adulto";
		if ($varEstado <= 1.9) return "Beb&eacute";
		if ($varEstado < 18 or $varEstado >= 2)return "Ni&ntilde;o";		
		}
//******************************************************************************
//******************************************************************************
//******************************************************************************
	
	function EstadoUsuario($varEstado)
	{
		if ($varEstado == 1) return "Activo";
		if ($varEstado == 0) return "Inactivo";
		}
		
//******************************************************************************
//******************************************************************************
//******************************************************************************
			function EstadoReserva($varEstado)
	{
		if ($varEstado == 0) return "Pendiente de Pago <span class='glyphicon glyphicon-euro'></span>";
		if ($varEstado == 1) return "Confirmada <span class='glyphicon glyphicon-ok'></span>";
		if ($varEstado == 2) return "Cancelada <span class='glyphicon glyphicon-remove'></span>";
		}
	
	//******************************************************************************
	
		function estadoCliente($varEstado)
	{
		switch($varEstado){		
		case 0: echo 'Cancelado'; break;
		case 1: echo 'Confirmado'; break;
		case 2: echo 'Pendiente de confirmar'; break;
		}
	}
	//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
	function colorFila($varEstado)
	{
		switch($varEstado){		
		case 0: echo 'class="warning"'; break;
		case 1: echo 'class="success"'; break;
		case 2: echo 'class="danger"'; break;
		}
	}
//*****************************************************************************
	
	function EstadoProducto($varEstado)
	{
		if ($varEstado == 1) return "Disponible";
		if ($varEstado == 0) return " No Disponible";
		}
		
	//******************************************************************************
//******************************************************************************
//******************************************************************************
	function TextoTipoPago($varTipoPago)
	{
		if ($varTipoPago == 0) return "Pendiente";
		if ($varTipoPago == 1) return "VISA / MasterCard";
		if ($varTipoPago == 2) return "Transferencia";
		if ($varTipoPago == 3) return "PayPal";
		if ($varTipoPago == 4) return "Efectivo";
		}
		
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function TextoTipoProducto($varTipoPago)
	{
		if ($varTipoPago == 1) return "Tour";
		if ($varTipoPago == 2) return "Excursion";
		if ($varTipoPago == 3) return "Est&eacute;tica";
		}
		
	//******************************************************************************
	//******************************************************************************
function TipoSeguro($parametro) //obsoleto
	{
		if ($parametro == 1) return "Por Persona";
		if ($parametro == 2) return "Por Reserva";
		if ($parametro == 3) return "Por Persona y Estancia";
		}
		
	//******************************************************************************
//******************************************************************************
//******************************************************************************

	function mostrar_subcategoria($identificador)
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE idPadre = %s", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	?>
    <?php
 
		do {
			echo "&nbsp;&nbsp;&nbsp;-".$row_ConsultaFuncion['strDescripcion'];
			echo "<br>";
			}
			while ($row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion));
	
	mysql_free_result($ConsultaFuncion);
	}
	
		//******************************************************************************
//******************************************************************************
//******************************************************************************

	function mostrar_subcategoria_admin($identificador)
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE idPadre = %s", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	?>
    <?php
 	if ($totalRows_ConsultaFuncion > 0) {
		do {
			?>
			<option value="<?php echo $row_ConsultaFuncion['idCategoria']?>" <?php if(isset($_GET['cat']) && $_GET['cat'] == $row_ConsultaFuncion['idCategoria'])
{?> selected="selected" <?php } ?>>&nbsp;&nbsp;&nbsp; <?php echo $row_ConsultaFuncion['strDescripcion']?></option>
            
            <?php
		} while ($row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion));
		}
	mysql_free_result($ConsultaFuncion);
	}
	
	
		//******************************************************************************
//******************************************************************************
//******************************************************************************

	function mostrar_subcategoria_admin_seleccion($identificador, $categoria_de_producto)
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE idPadre = %s", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	?>
    <?php
 	if ($totalRows_ConsultaFuncion > 0) {
		do {
			?>
			<option value="<?php echo $row_ConsultaFuncion['idCategoria']?>" <?php if (!(strcmp($row_ConsultaFuncion['idCategoria'],$categoria_de_producto))) {echo "SELECTED";} ?>>&nbsp;&nbsp;&nbsp; - <?php echo $row_ConsultaFuncion['strDescripcion']?></option>
            
            <?php
		} while ($row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion));
		}
	mysql_free_result($ConsultaFuncion);	
	}	
	
//******************************************************************************
//******************************************************************************
//******************************************************************************
		function TotalReserva()
		{			
			global $database_conexionturismo, $conexionturismo;		
			$updateSQL = sprintf("UPDATE tblreserva SET dblTotal = %s WHERE idReserva = %s",
                     $_SESSION['totalReserva'], $_SESSION['reserva']);	 
  mysql_select_db($database_conexionturismo, $conexionturismo);
  $Result1 = mysql_query($updateSQL, $conexionturismo) or die(mysql_error()); 
  		}	

//******************************************************************************
//******************************************************************************
/*
		function ConfirmarReserva($tipopago)
		{
			
		global $database_conexionturismo, $conexionturismo;
$insertSQL = sprintf("UPDATE tblreserva SET intTipoPago = %s WHERE idReserva = %s",
                     $tipopago, $_SESSION['reserva']);	
  mysql_select_db($database_conexionturismo, $conexionturismo);
  $Result1 = mysql_query($insertSQL, $conexionturismo) or die(mysql_error());  
  		}
*/
//******************************************************************************
//******************************************************************************
		function confirmarReserva($reserva)
		{			
			global $database_conexionturismo, $conexionturismo;		
			$updateSQL = sprintf("UPDATE tblreserva SET intEstado = 1 WHERE idReserva = %s",$reserva);	 
  mysql_select_db($database_conexionturismo, $conexionturismo);
  $Result1 = mysql_query($updateSQL, $conexionturismo) or die(mysql_error());
			}
//******************************************************************************
//******************************************************************************
		function cancelarReserva($reserva)
		{			
			global $database_conexionturismo, $conexionturismo;		
			$updateSQL = sprintf("UPDATE tblreserva SET intEstado = 2 WHERE idReserva = %s",$reserva);	 
  mysql_select_db($database_conexionturismo, $conexionturismo);
  $Result1 = mysql_query($updateSQL, $conexionturismo) or die(mysql_error());
			}
//******************************************************************************
//******************************************************************************
//******************************************************************************
function ActualizarStock($ultimacompra)
		{	
		global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcompra WHERE idReserva = %s", $ultimacompra);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
			do {
				$pasajeros = ObtenerCantidadPasajero($ultimacompra);
			$updateSQL = sprintf("UPDATE tblproducto SET intStock = intStock-%s WHERE idProducto = %s", $pasajeros, $row_ConsultaFuncion['idProducto']);
  $Result1 = mysql_query($updateSQL, $conexionturismo) or die(mysql_error());
			} while ($row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion));
			}
//******************************************************************************
//******************************************************************************
//******************************************************************************
function ComprobarStock() /*obsoleto*/
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT intStock FROM tblproducto WHERE idProducto = %s", $_SESSION['producto']);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['intStock'];
	mysql_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ActualizarEstadoProducto() /*obsoleto*/
	{	
		global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT intStock FROM tblproducto WHERE idProducto = %s", $_SESSION['producto']);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	if($row_ConsultaFuncion['intStock'] <= 0)
		{				
			global $database_conexionturismo, $conexionturismo;		
			$updateSQL = sprintf("UPDATE tblproducto SET intEstado = 0 WHERE idProducto = %s",
                     $_SESSION['producto']);	 
  mysql_select_db($database_conexionturismo, $conexionturismo);
  $Result1 = mysql_query($updateSQL, $conexionturismo) or die(mysql_error());
mysql_free_result($ConsultaFuncion);	
		}
	}
//******************************************************************************
//******************************************************************************
//******************************************************************************
function factura($reserva){	
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT idFactura, idReserva FROM tblfactura WHERE idReserva = %s", $reserva);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	if ($totalRows_ConsultaFuncion==0){
		$insertSQL = sprintf("INSERT INTO tblfactura (idReserva, fchFecha) VALUES (%s, NOW())",
					   $reserva);
		mysql_select_db($database_conexionturismo, $conexionturismo);
		$Result1 = mysql_query($insertSQL, $conexionturismo) or die(mysql_error());
	}
	return $row_ConsultaFuncion['idFactura'];
	mysql_free_result($ConsultaFuncion);
}
			//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerMailCiente($identificador)
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT strEmail FROM tblcliente WHERE strDNI = '%s'", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strEmail'];
	mysql_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
//******************************************************************************
//******************************************************************************
		
		function EnvioCorreoCliente($destinatario, $contenido, $asunto)
{

	$mensaje = '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link media="all" href="http://fonts.googleapis.com/css?family=Signika:400,600%7COpen+Sans:400,400italic,600" rel="stylesheet">
<link rel="stylesheet" id="general-css"  href="http://www.caribetour.es/css/style.css?ver=3.7.1" type="text/css" media="all" />
<title>Mensaje enviado desde CaribeTour.es</title>
</head>

<body>
<table width="90%" border="0" cellspacing="3" cellpadding="3" align="center">
  <tr>
    <td><a href="http://www.caribetour.es"><img src="http://www.caribetour.es/images/logo.jpg" alt="Logo CaribeTour.es" title="CaribeTour.es" width="300" height="62" /></a></td>
  </tr>
  <tr>
    <td><p>&nbsp;&nbsp;&nbsp;Estimado Cliente: </p>';
	$mensaje.= $contenido;
	$mensaje.='</td>
  </tr>
  <tr>
    <td>Muchas gracias,<br /><br />     
	<p><strong>Departamento de Reservas CaribeTour.es</strong><br>
	<strong>Oficina:</strong> Calle Puerto del Pozazal 37 3 7º-5, Madrid 28031 - Espa&ntilde;a<br>
	<strong>Tel:</strong> (+34) 676062155<br>
	<strong>Email:</strong> <a href="mailto:info@caribetour.es">info@caribetour.es</a></p>
	<small>Este mensaje puede contener información privilegiada y/o personal. Si cree que ha recibido éste correo por error descarte su contenido e informe al remitente para evitar que en el futuro reciba otro correo como este. Disculpe los inconvenientes.</small></td>
  </tr>
</table>
</body>
</html>';

	// Para enviar correo HTML, la cabecera Content-type debe definirse
	$headers = "MIME-Version:1.0;\r\n";
	$headers .= "Content-type: text/html; \r\n charset=iso-8859-1; \r\n";
	// Cabeceras adicionales
	$headers .= "From: CaribeTour.es <info@caribetour.es> \r\n";
	$headers .= "Bcc: info@caribetour.es \r\n";
	// Enviarlo
	mail($destinatario, $asunto, $mensaje, $headers);
}

	//******************************************************************************
	//******************************************************************************
		
		function EnvioCorreoProveedor($destinatario, $contenido, $asunto)
{

	$mensaje = '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link media="all" href="http://fonts.googleapis.com/css?family=Signika:400,600%7COpen+Sans:400,400italic,600" rel="stylesheet">
<link rel="stylesheet" id="general-css"  href="http://www.caribetour.es/css/style.css?ver=3.7.1" type="text/css" media="all" />
<title>Mensaje enviado desde CaribeTour.es</title>
</head>

<body>
<table width="90%" border="0" cellspacing="3" cellpadding="3" align="center">
  <tr>
    <td><a href="http://www.caribetour.es"><img src="http://www.caribetour.es/images/logo.jpg" alt="Logo CaribeTour.es" title="CaribeTour.es" width="300" height="62" /></a></td>
  </tr>
  <tr>
    <td><p>&nbsp;&nbsp;&nbsp;Muy buenas!!! </p>';
	$mensaje.= $contenido;
	$mensaje.='</td>
  </tr>
  <tr>
    <td>Muchas gracias,<br /><br />     
	<p><strong>Departamento de Reservas CaribeTour.es</strong><br>
	<strong>Oficina:</strong> Calle Puerto del Pozazal 37 3 7º-5, Madrid 28031 - Espa&ntilde;a<br>
	<strong>Tel:</strong> (+34) 676062155<br>
	<strong>Email:</strong> <a href="mailto:info@caribetour.es">info@caribetour.es</a></p>
	<small>Este mensaje puede contener información privilegiada y/o personal. Si cree que ha recibido éste correo por error descarte su contenido e informe al remitente para evitar que en el futuro reciba otro correo como este. Disculpe los inconvenientes.</small></td>
  </tr>
</table>
</body>
</html>';

	// Para enviar correo HTML, la cabecera Content-type debe definirse
	$headers = "MIME-Version:1.0;\r\n";
	$headers .= "Content-type: text/html; \r\n charset=iso-8859-1; \r\n";
	// Cabeceras adicionales
	$headers .= "From: CaribeTour.es <info@caribetour.es> \r\n";
	$headers .= "Bcc: info@caribetour.es \r\n";
	// Enviarlo
	mail($destinatario, $asunto, $mensaje, $headers);
}

	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerPostHijo($identificador)
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcomentarios WHERE idpostPadre = '%s'", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['idComentario'];
	mysql_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerCantidadComentario($identificador) /*la funcion ObtenerCantidadComentario que obsoleta ya que tengo una consulta que obtiene la cantidad de comentarios*/
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT COUNT(*) AS cantidad FROM tblcomentarios WHERE idArticulo = '%s' AND intEstado = 1", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['cantidad'];
	mysql_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerCantidadPasajero($identificador)
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT COUNT(*) AS cantidad FROM tblcliente WHERE idReserva = %s", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['cantidad'];
	mysql_free_result($ConsultaFuncion);	
	} 
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerNombreArticulo($identificador) /*obsoleto*/
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT strNombre FROM tblblog WHERE idArticulo = '%s'", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strNombre'];
	mysql_free_result($ConsultaFuncion);	
	}
	
	//******************************************************************************
//******************************************************************************

function ObtenerImagenArticulo($identificador) /*obsoleto*/
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT strImagen FROM tblblog WHERE idArticulo = '%s'", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strImagen'];
	mysql_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerFechaArticulo($identificador) /*obsoleto*/
{
	global $database_conexionturismo, $conexionturismo;
	mysql_select_db($database_conexionturismo, $conexionturismo);
	$query_ConsultaFuncion = sprintf("SELECT fchFecha FROM tblblog WHERE idArticulo = '%s'", $identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionturismo) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['fchFecha'];
	mysql_free_result($ConsultaFuncion);	
	}
	
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function Edad($identificador)
{
list($Y,$m,$d) = explode("-",$identificador);
return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
/*
$fecha = time() - strtotime($identificador);
$edad = floor($fecha/31556926);
return $edad;*/	
	}
//******************************************************************************
function fechaPrecio($idproducto, $dia, $mes, $anio){
global $database_conexionturismo, $conexionturismo;
mysql_select_db($database_conexionturismo, $conexionturismo);
$query_fechas = sprintf("SELECT tblfechas.idFecha AS id, (SELECT Sum(tblfechas.dblPrecio + tblfechas.dblTasas) FROM tblfechas WHERE tblfechas.idFecha = id) AS dblPrecio, tblfechas.idProducto, tblfechas.fchIda, tblfechas.fchVuelta FROM tblfechas WHERE tblfechas.idProducto = %s AND tblfechas.fchIda > NOW()", GetSQLValueString($idproducto, "int"));
$fechas = mysql_query($query_fechas, $conexionturismo) or die(mysql_error());
$row_fechas = mysql_fetch_assoc($fechas);
$totalRows_fechas = mysql_num_rows($fechas);
	do {
		if ($dia == date('j', strtotime($row_fechas['fchIda'])) && $mes == date('n', strtotime($row_fechas['fchIda'])) && $anio == date('Y', strtotime($row_fechas['fchIda']))){
		return '<p style="font-size:1.2em;"><strong><a href="cliente-datos.php?idproducto='.$row_fechas['idProducto'].'&amp;idFecha='.$row_fechas['id'].'" title="Saliendo el '.MostratFechaEspanol($row_fechas['fchIda']).' y regresando el '.MostratFechaEspanol($row_fechas['fchVuelta']).'">'.moneda($row_fechas['dblPrecio']).'&euro;</a></strong></p>';
		}
	} while ($row_fechas = mysql_fetch_assoc($fechas));
}
//****************************************************
function hoy($dia,$mes){
		if ($dia==date("j") && $mes==date("n")){
		return ' style="background-color:#E2E2E2"';
		}
	}
function precioss($dia,$mes){
	global $row_fechas, $fechas;
		do {
			if ($dia == date('j', strtotime($row_fechas['fchIda']))){
			return $row_fechas['dblPrecio'];
			}
		} while ($row_fechas = mysql_fetch_assoc($fechas));
	}
//************************CALENTEDIO**********************************
function calendario($idProducto){	
           print '<table>
                	<thead>
                    	<tr>
                        	<th><a href="" title="Ver el mes anterior">&lt; &lt;--</a></th><th colspan="5">'.MostratFechaEspanol(date('d-m-Y')).'</th><th><a href="" title="Ver el mes anterior">--&gt; &gt;</a></th>
                        </tr>
                        <tr>
                        	<th>Dom</th><th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th><th>Vie</th><th>Sab</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<tr>'.diasCalendario($idProducto).'
                        </tr>
                    </tbody>
                </table>';
}
function diasCalendario($idProducto){
	date_default_timezone_set("Europe/Madrid");
	setlocale(LC_TIME, "spanish");
	$anio_actual = date("Y");
	$mes_actual = date("n"); 
	$numero_dias = cal_days_in_month(CAL_GREGORIAN, $mes_actual, $anio_actual);
	$iniciomes = date('w',mktime(0,0,0,$mes_actual,1,$anio_actual));
	$numero_dias += $iniciomes;					
	$filas = ceil($numero_dias/7);
	$cantidad_celdas = $filas * 7;
	$diferencia = $cantidad_celdas - $numero_dias;
	for($i = 1; $i <= $numero_dias; $i++){
		if($i <= $iniciomes){
		echo '<td></td>';
		} 
		else{
			$dias = $i-$iniciomes;									
			echo '<td'.hoy($dias,$mes_actual).'>'.$dias .' '. fechaPrecio($idProducto,$dias,$mes_actual).'</td>';
		}
		if ($i % 7 ==0){
			echo '</tr><tr>';
		}
	 }
	 for($i = 1; $i <= $diferencia; $i++){
		echo '<td></td>';
	 }
}
?>