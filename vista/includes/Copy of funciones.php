<?php

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  global $conexionturismo;
$theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($conexionturismo, $theValue) : mysqli_escape_string($conexionturismo,$theValue);

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
$consultaBD = mysqli_query($conexionturismo,$query_consultaBD, $agencia) or die(mysqli_error($conexionturismo));
$row_consultaBD = mysqli_fetch_assoc($consultaBD);
$totalRows_consultaBD = mysqli_num_rows($consultaBD);
return $row_consultaBD['strNombre'];
mysqli_free_result($consultaBD);
}
//******************************************************************************
//******************************************************************************

//******************************************************************************
//******************************************************************************

function ObtenerNombreCategoria($identificador)
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT strDescripcion FROM tblcategoria WHERE idCategoria = %s", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strDescripcion'];
	mysqli_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerNombreUsuario($identificador)
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT strNombre FROM tblusuario WHERE strEmail = '%s'", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strNombre'];
	mysqli_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerNombreCiente($identificador)
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT strNombre FROM tblcliente WHERE strDNI = '%s'", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strNombre'];
	mysqli_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerApellidosCiente($identificador)
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT strApellidos FROM tblcliente WHERE strDNI = '%s'", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strApellidos'];
	mysqli_free_result($ConsultaFuncion);	
	}
	
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function FechaCtePrincipal($identificador)
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT fchNacimiento FROM tblcliente WHERE strDNI = '%s'", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['fchNacimiento'];
	mysqli_free_result($ConsultaFuncion);	
	}
	
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerIDporSEO($identificador)
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT idProducto FROM tblproducto WHERE strSEO = '%s'", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['idProducto'];
	mysqli_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerCatporSEO($identificador)
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT intCategoria FROM tblproducto WHERE strSEO = '%s'", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['intCategoria'];
	mysqli_free_result($ConsultaFuncion);	
	}
		//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerCatporSEOtblCat($identificador)
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT idCategoria FROM tblcategoria WHERE strSEO = '%s'", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['idCategoria'];
	mysqli_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
//******************************************************************************
//**
function ObtenerSEOporCat($identificador) //**obsoleto*//
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT strSEO FROM tblcategoria WHERE idCategoria = '%s'", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strSEO'];
	mysqli_free_result($ConsultaFuncion);	
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

function ObtenerCatPadre($identificador)
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT idPadre FROM tblcategoria WHERE idCategoria = %s", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['idPadre'];
	mysqli_free_result($ConsultaFuncion);	
	}
		//******************************************************************************
//******************************************************************************
//**
function ObtenerCatProducto($identificador)
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT intCategoria FROM tblproducto WHERE idProducto = %s", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['intCategoria'];
	mysqli_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
//******************************************************************************
//**
function ObtenerIdxSeo($identificador)
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT idProducto FROM tblproducto WHERE strSEO = '%s'", $identificador);
	echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['idProducto'];
	mysqli_free_result($ConsultaFuncion);	
	}
	
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerNombreProducto($identificador)
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT strNombre FROM tblproducto WHERE idProducto = %s", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strNombre'];
	mysqli_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerSEOProducto($identificador)
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT strSEO FROM tblproducto WHERE idProducto = %s", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strSEO'];
	mysqli_free_result($ConsultaFuncion);	
	}
	
	
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerNombreExcursion($identificador)
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT strNombre FROM tblexcursion WHERE idExcursion = %s", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strNombre'];
	mysqli_free_result($ConsultaFuncion);	
	}
	
	
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerImagenporID()
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = "SELECT strNombre FROM tblproducto WHERE idProducto = idImagen";
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strNombre'];
	mysqli_free_result($ConsultaFuncion);	
	}
	
	//******************************************************************************	
//******************************************************************************
function ObtenerstrImagen($identificador)
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT strImagen FROM tblimagen WHERE idImagen = %s", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strImagen'];
	mysqli_free_result($ConsultaFuncion);	
	}
	
	//******************************************************************************	
//******************************************************************************
function ObtenerPrecioProducto($identificador)
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT dblPrecio FROM tblproducto WHERE idProducto = %s", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['dblPrecio'];
	mysqli_free_result($ConsultaFuncion);	
	}
	//******************************************************************************	
//******************************************************************************
function ObtenerPrecioInfanteProducto($identificador)
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT dblTasaIda FROM tblproducto WHERE idProducto = %s", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['dblTasaIda'];
	mysqli_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
function ObtenerFormaPago($identificador)
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT intTipoPago FROM tblcompra WHERE idCompra = %s", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['intTipoPago'];
	mysqli_free_result($ConsultaFuncion);	
	}
	
	//******************************************************************************
//******************************************************************************
//******************************************************************************
	function ObtenerFechaPago($identificador)
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT fchCompra FROM tblcompra WHERE idCompra = %s", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['fchCompra'];
	mysqli_free_result($ConsultaFuncion);	
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
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT dblTotal FROM tblcompra WHERE idCompra = %s", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['dblTotal'];
	mysqli_free_result($ConsultaFuncion);	
	}
	
//******************************************************************************
//******************************************************************************
//******************************************************************************
	
	function Tratamiento($varEstado)
	{
		if ($varEstado >= 18) return "Adulto";
		if ($varEstado <= 1) return "Beb&eacute";
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
//******************************************************************************

	function mostrar_subcategoria($identificador)
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE idPadre = %s", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	?>
    <?php
 
		do {
			echo "&nbsp;&nbsp;&nbsp;-".$row_ConsultaFuncion['strDescripcion'];
			echo "<br>";
			}
			while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
	
	mysqli_free_result($ConsultaFuncion);
	}
	
		//******************************************************************************
//******************************************************************************
//******************************************************************************

	function mostrar_subcategoria_admin($identificador)
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE idPadre = %s", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	?>
    <?php
 	if ($totalRows_ConsultaFuncion > 0) {
		do {
			?>
			<option value="<?php echo $row_ConsultaFuncion['idCategoria']?>" <?php if(isset($_GET['cat']) && $_GET['cat'] == $row_ConsultaFuncion['idCategoria'])
{?> selected="selected" <?php } ?>>&nbsp;&nbsp;&nbsp; <?php echo $row_ConsultaFuncion['strDescripcion']?></option>
            
            <?php
		} while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
		}
	mysqli_free_result($ConsultaFuncion);
	}
	
	
		//******************************************************************************
//******************************************************************************
//******************************************************************************

	function mostrar_subcategoria_admin_seleccion($identificador, $categoria_de_producto)
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE idPadre = %s", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	?>
    <?php
 	if ($totalRows_ConsultaFuncion > 0) {
		do {
			?>
			<option value="<?php echo $row_ConsultaFuncion['idCategoria']?>" <?php if (!(strcmp($row_ConsultaFuncion['idCategoria'],$categoria_de_producto))) {echo "SELECTED";} ?>>&nbsp;&nbsp;&nbsp; - <?php echo $row_ConsultaFuncion['strDescripcion']?></option>
            
            <?php
		} while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
		}
	mysqli_free_result($ConsultaFuncion);	
	}	
	
//******************************************************************************
//******************************************************************************
//******************************************************************************
		function TotalReserva()
		{			
			global $conexionturismo;		
			$updateSQL = sprintf("UPDATE tblreserva SET dblTotal = %s WHERE idReserva = %s",
                     $_SESSION['totalReserva'], $_SESSION['reserva']);	 
  
  $Result1 = mysqli_query($conexionturismo,$updateSQL) or die(mysqli_error($conexionturismo)); 
  		}	

//******************************************************************************
//******************************************************************************
//******************************************************************************
		function ConfirmarReserva($tipopago)
		{
			
		global $conexionturismo;
$insertSQL = sprintf("UPDATE tblreserva SET intTipoPago = %s WHERE idReserva = %s",
                     $tipopago, $_SESSION['reserva']);	
  
  $Result1 = mysqli_query($conexionturismo,$insertSQL) or die(mysqli_error($conexionturismo));  
  		}
			//******************************************************************************
//******************************************************************************
//******************************************************************************
		function ActualizarReserva($ultimacompra)
		{			
			global $conexionturismo;		
			$updateSQL = sprintf("UPDATE tblreserva SET intTransaccionEfectuada = %s WHERE idCliente = '%s' AND intTransaccionEfectuada = 0 AND idReserva = %s",
                     $ultimacompra, $_SESSION['MM_strDNI'], $_SESSION['reserva']);	 
  
  $Result1 = mysqli_query($conexionturismo,$updateSQL) or die(mysqli_error($conexionturismo));
			}
//******************************************************************************
//******************************************************************************
//******************************************************************************
function ActualizarStock($ultimacompra)
		{	
		global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcompra WHERE idReserva = %s", $ultimacompra);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
			do {
				$pasajeros = ObtenerCantidadPasajero($ultimacompra);
			$updateSQL = sprintf("UPDATE tblproducto SET intStock = intStock-%s WHERE idProducto = %s", $pasajeros, $row_ConsultaFuncion['idProducto']);
  $Result1 = mysqli_query($conexionturismo,$updateSQL) or die(mysqli_error($conexionturismo));
			} while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
			}
//******************************************************************************
//******************************************************************************
//******************************************************************************
function ComprobarStock()
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT intStock FROM tblproducto WHERE idProducto = %s", $_SESSION['producto']);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['intStock'];
	mysqli_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ActualizarEstadoProducto()
	{	
		global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT intStock FROM tblproducto WHERE idProducto = %s", $_SESSION['producto']);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if($row_ConsultaFuncion['intStock'] <= 0)
		{				
			global $conexionturismo;		
			$updateSQL = sprintf("UPDATE tblproducto SET intEstado = 0 WHERE idProducto = %s",
                     $_SESSION['producto']);	 
  
  $Result1 = mysqli_query($conexionturismo,$updateSQL) or die(mysqli_error($conexionturismo));
mysqli_free_result($ConsultaFuncion);	
		}
	}
//******************************************************************************
//******************************************************************************
//******************************************************************************
function factura($reserva)
		{
			
		global $conexionturismo;
$insertSQL = sprintf("INSERT INTO tblfactura (idReserva, fchFecha) VALUES (%s, NOW())",
                       $reserva);
  
  $Result1 = mysqli_query($conexionturismo,$insertSQL) or die(mysqli_error($conexionturismo));
  
  		}
			//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerMailCiente($identificador)
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT strEmail FROM tblcliente WHERE strDNI = '%s'", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strEmail'];
	mysqli_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
//******************************************************************************
//******************************************************************************
		
		function EnvioCorreoHTML($destinatario, $contenido, $asunto)
{

	$mensaje = '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Mensaje enviado desde CaribeTour.es</title>
</head>

<body>
<table width="90%" border="0" cellspacing="3" cellpadding="3" align="center">
  <tr>
    <td><img src="http://www.caribetour.es/images/logo.jpg" alt="Logo CaribeTour.es" title="CaribeTour.es" width="300" height="62" /></td>
  </tr>
  <tr>
    <td><p>&nbsp;&nbsp;&nbsp;Estimado Cliente: </p>
    <p>';
	$mensaje.= $contenido;
	$mensaje.='</p></td>
  </tr>
  <tr>
    <td>Muchas gracias,<br /><br />     
	<p><strong>Departamento de Reservas CaribeTour.es</strong><br>
	<strong>Oficina:</strong> Calle Ruiz 22, Madrid 28004 - España<br>
	<strong>Tel:</strong> (+34) 555-5555<br>
	<strong>Fax:</strong> (+34) 555-5555<br>
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
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcomentarios WHERE idpostPadre = '%s'", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['idComentario'];
	mysqli_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerCantidadComentario($identificador) /*la funcion ObtenerCantidadComentario que obsoleta ya que tengo una consulta que obtiene la cantidad de comentarios*/
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT COUNT(*) AS cantidad FROM tblcomentarios WHERE idArticulo = '%s' AND intEstado = 1", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['cantidad'];
	mysqli_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerCantidadPasajero($identificador)
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT COUNT(*) AS cantidad FROM tblcliente WHERE idReserva = %s", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['cantidad'];
	mysqli_free_result($ConsultaFuncion);	
	} 
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerNombreArticulo($identificador) /*obsoleto*/
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT strNombre FROM tblblog WHERE idArticulo = '%s'", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strNombre'];
	mysqli_free_result($ConsultaFuncion);	
	}
	
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function fechaPrecio($idproducto, $dia, $mes){
global $conexionturismo;

$query_fechas = sprintf("SELECT tblfechas.idFecha, tblfechas.idProducto, tblfechas.fchIda, tblfechas.fchVuelta, tblfechas.dblPrecio FROM tblfechas WHERE tblfechas.idProducto = %s AND tblfechas.fchIda > NOW()", GetSQLValueString($idproducto, "int"));
$fechas = mysqli_query($conexionturismo,$query_fechas) or die(mysqli_error($conexionturismo));
$row_fechas = mysqli_fetch_assoc($fechas);
$totalRows_fechas = mysqli_num_rows($fechas);
	do {
		if ($dia == date('j', strtotime($row_fechas['fchIda'])) && $mes == date('n', strtotime($row_fechas['fchIda']))){
		return '<p style="font-size:1.2em;"><strong><a href="cliente_datos.php?idproducto='.$row_fechas['idProducto'].'&idFecha='.$row_fechas['idFecha'].'" title="Saliendo el '.MostratFechaEspanol($row_fechas['fchIda']).' y regresando el '.MostratFechaEspanol($row_fechas['fchVuelta']).'">'.$row_fechas['dblPrecio'].'&euro;</a></strong></p>';
		}
	} while ($row_fechas = mysqli_fetch_assoc($fechas));
}
//****************************************************
function ObtenerImagenArticulo($identificador) /*obsoleto*/
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT strImagen FROM tblblog WHERE idArticulo = '%s'", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strImagen'];
	mysqli_free_result($ConsultaFuncion);	
	}
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function ObtenerFechaArticulo($identificador) /*obsoleto*/
{
	global $conexionturismo;
	
	$query_ConsultaFuncion = sprintf("SELECT fchFecha FROM tblblog WHERE idArticulo = '%s'", $identificador);
	$ConsultaFuncion = mysqli_query($conexionturismo,$query_ConsultaFuncion) or die(mysqli_error($conexionturismo));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['fchFecha'];
	mysqli_free_result($ConsultaFuncion);	
	}
	
	//******************************************************************************
//******************************************************************************
//******************************************************************************
function Edad($identificador)
{
$fecha = time() - strtotime($identificador);
$edad = floor($fecha/31556926);
return $edad;	
	}

	//************************CALENTEDIO**********************************
function calcula_numero_dia_semana($dia,$mes,$ano){
	$numerodiasemana = date('w', mktime(0,0,0,$mes,$dia,$ano));
	if ($numerodiasemana == 0) 
		$numerodiasemana = 6;
	else
		$numerodiasemana--;
	return $numerodiasemana;
}

//funcion que devuelve el ?ltimo d?a de un mes y a?o dados
function ultimoDia($mes,$ano){ 
    $ultimo_dia=28; 
    while (checkdate($mes,$ultimo_dia + 1,$ano)){ 
       $ultimo_dia++; 
    } 
    return $ultimo_dia; 
} 

function dame_nombre_mes($mes){
	 switch ($mes){
	 	case 1:
			$nombre_mes="Enero";
			break;
	 	case 2:
			$nombre_mes="Febrero";
			break;
	 	case 3:
			$nombre_mes="Marzo";
			break;
	 	case 4:
			$nombre_mes="Abril";
			break;
	 	case 5:
			$nombre_mes="Mayo";
			break;
	 	case 6:
			$nombre_mes="Junio";
			break;
	 	case 7:
			$nombre_mes="Julio";
			break;
	 	case 8:
			$nombre_mes="Agosto";

			break;
	 	case 9:
			$nombre_mes="Septiembre";
			break;
	 	case 10:
			$nombre_mes="Octubre";
			break;
	 	case 11:
			$nombre_mes="Noviembre";
			break;
	 	case 12:
			$nombre_mes="Diciembre";
			break;
	}
	return $nombre_mes;
}

function dame_estilo($dia_imprimir){
	global $mes,$ano,$dia_solo_hoy,$tiempo_actual;
	//dependiendo si el d?a es Hoy, Domigo o Cualquier otro, devuelvo un estilo
	if ($dia_solo_hoy == $dia_imprimir && $mes==date("n", $tiempo_actual) && $ano==date("Y", $tiempo_actual)){
		//si es hoy
		$estilo = " class='hoy'";
	}else{
		$fecha=mktime(12,0,0,$mes,$dia_imprimir,$ano);
		if (date("w",$fecha)==0){
			//si es domingo 
			$estilo = " class='domingo'";
		}else{
			//si es cualquier dia
			$estilo = " class='diario'";
		}
	}
	return $estilo;
}
function precio($dia_imprimir){
	global $mes, $ano, $dia_solo_hoy, $tiempo_actual, $database_conexionturismo, $conexionturismo;
	
$query_fechasproducto = sprintf("SELECT * FROM tblfechas WHERE idProducto = %s", 10);
$fechasproducto = mysqli_query($conexionturismo,$query_fechasproducto) or die(mysqli_error($conexionturismo));
$row_fechasproducto = mysqli_fetch_assoc($fechasproducto);
$totalRows_fechasproducto = mysqli_num_rows($fechasproducto);
	//dependiendo si el d?a es Hoy, Domigo o Cualquier otro, devuelvo un estilo
	do {
		if ($dia_imprimir == date("j", strtotime($row_fechasproducto['fchIda'])) && $mes == date("n", strtotime($row_fechasproducto['fchIda'])) && $ano==date("Y", strtotime($row_fechasproducto['fchIda'])))
		{
			return "<h4><a href='cliente_datos.php?idProducto=". $row_fechasproducto['idProducto'] . "&idFecha=". $row_fechasproducto['idFecha'] . "' class='active'>". $row_fechasproducto['dblPrecio'] . " &euro;</a></h4>";
		}
	} while ($row_fechasproducto = mysqli_fetch_assoc($fechasproducto));
	mysqli_free_result($fechasproducto);
}
function mostrar_calendario($mes,$ano){
	global $parametros_formulario;
	//tomo el nombre del mes que hay que imprimir
	$nombre_mes = dame_nombre_mes($mes);
	
	//construyo la tabla general
	echo '<table class="tablacalendario" cellspacing="3" cellpadding="2" border="0">';
	echo '<tr><td colspan="7" class="tit">';
	//tabla para mostrar el mes el a?o y los controles para pasar al mes anterior y siguiente
	echo '<table width="100%" cellspacing="2" cellpadding="2" border="0"><tr><td class="messiguiente">';
	//calculo el mes y ano del mes anterior
	$mes_anterior = $mes - 1;
	$ano_anterior = $ano;
	if ($mes_anterior==0){
		$ano_anterior--;
		$mes_anterior=12;
	}
	$url_actual = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	echo '<form method="post" action="'.$url_actual.'">
	<input type="hidden" value="'.$mes_anterior.'" name="nuevo_mes">
	<input type="hidden" value="'.$ano_anterior.'" name="nuevo_ano">
	<input type="submit" value="&lt;&lt;" title="Ir al mes anterior" id="ames"></form></td>';
	echo "<td class='titmesano'>$nombre_mes $ano</td>";
	echo "<td class='mesanterior'>";
	//calculo el mes y ano del mes siguiente
	$mes_siguiente = $mes + 1;
	$ano_siguiente = $ano;
	if ($mes_siguiente==13){
		$ano_siguiente++;
		$mes_siguiente=1;
	}
	echo '<form method="post" action="'.$url_actual.'">
	<input type="hidden" value="'.$mes_siguiente.'" name="nuevo_mes">
	<input type="hidden" value="'.$ano_siguiente.'" name="nuevo_ano">
	<input type="submit" value="&gt;&gt;" title="Ir al mes siguiente" id="smes" onClick="javascript:foco();"></form></td></tr></table></td></tr>';
	echo '	<tr>
			    <th width=14% class="diasemana">Lun</th>
			    <th width=14% class="diasemana">Mar</th>
			    <th width=14% class="diasemana">Mie</th>
			    <th width=14% class="diasemana">Jue</th>
			    <th width=14% class="diasemana">Vie</th>
			    <th width=14% class="diasemana">Sab</th>
			    <th width=14% class="diasemana">Dom</th>
			</tr>';
	
	//Variable para llevar la cuenta del dia actual
	$dia_actual = 1;
	
	//calculo el numero del dia de la semana del primer dia
	$numero_dia = calcula_numero_dia_semana(1,$mes,$ano);
	//echo "Numero del dia de demana del primer: $numero_dia <br>";
	
	//calculo el ?ltimo dia del mes
	$ultimo_dia = ultimoDia($mes,$ano);
	
	//escribo la primera fila de la semana
	echo "<tr>";
	for ($i=0;$i<7;$i++){
		if ($i < $numero_dia){
			//si el dia de la semana i es menor que el numero del primer dia de la semana no pongo nada en la celda
			echo '<td class="diainvalido"><span></span></td>';
		} else {
			echo "<td class='diavalido' ". dame_estilo($dia_actual) ."><span>$dia_actual ".  precio($dia_actual) ."<span></td>";
			$dia_actual++;
		}
	}
	echo "</tr>";
	
	//recorro todos los dem?s d?as hasta el final del mes
	$numero_dia = 0;
	while ($dia_actual <= $ultimo_dia){
		//si estamos a principio de la semana escribo el <TR>
		if ($numero_dia == 0)
			echo "<tr>";
		echo "<td class='diavalido'". dame_estilo($dia_actual) ."><span>$dia_actual ". precio($dia_actual) ."<span></td>";
		$dia_actual++;
		$numero_dia++;
		//si es el u?timo de la semana, me pongo al principio de la semana y escribo el </tr>
		if ($numero_dia == 7){
			$numero_dia = 0;
			echo "</tr>";
		}
	}
	
	//compruebo que celdas me faltan por escribir vacias de la ?ltima semana del mes
	for ($i=$numero_dia;$i<7;$i++){
		echo '<td class="diainvalido"><span></span></td>';
	}
	
	echo "</tr>";
	echo "</table>";
}	

function formularioCalendario($mes,$ano){
	$url_actual = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	global $parametros_formulario;
echo '
	<br>
	<table width="100%" align="center" cellspacing="2" cellpadding="2" border="0" class=tform>
	<tr><form action="'.$url_actual.'" method="POST">';
echo '
    <td align="center" valign="top">
		Mes: <br>
		<select name=nuevo_mes>
		<option value="1"';
if ($mes==1)
 echo "selected";
echo'>Enero
		<option value="2" ';
if ($mes==2) 
	echo "selected";
echo'>Febrero
		<option value="3" ';
if ($mes==3) 
	echo "selected";
echo'>Marzo
		<option value="4" ';
if ($mes==4) 
	echo "selected";
echo '>Abril
		<option value="5" ';
if ($mes==5) 
		echo "selected";
echo '>Mayo
		<option value="6" ';
if ($mes==6) 
	echo "selected";
echo '>Junio
		<option value="7" ';
if ($mes==7) 
	echo "selected";
echo '>Julio
		<option value="8" ';
if ($mes==8) 
	echo "selected";
echo '>Agosto
		<option value="9" ';
if ($mes==9) 
	echo "selected";
echo '>Septiembre
		<option value="10" ';
if ($mes==10) 
	echo "selected";
echo '>Octubre
		<option value="11" ';
if ($mes==11) 
	echo "selected";
echo '>Noviembre
		<option value="12" ';
if ($mes==12) 
    echo "selected";
echo '>Diciembre
		</select>
		</td>';
echo '		
	    <td align="center" valign="top">
		A&ntilde;o: <br>
		<select name=nuevo_ano>';

for ($cont=date("Y", time());$cont<$ano+2;$cont++){
	echo "<option value='$cont'";
	if ($ano==$cont) 
   		echo " selected";
   	echo ">$cont";
}
echo '
	</select>
		</td>';
echo '
	</tr>
	<tr>
	    <td colspan="2" align="center"><input type="Submit" value="IR A ESE MES"></td>
	</tr>
	</table><br>
	
	<br>
	
	</form>';
}
	
////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Funcion que escribe en la pagina un fomrulario preparado para introducir una fecha y enlazado con el calendario para seleccionarla comodamente
////////////////////////////////////////////////////////////////////////////////////////////////////////////
function escribe_formulario_fecha_vacio($nombrecampo,$nombreformulario){
	global $raiz;
	echo '
	<INPUT name="'.$nombrecampo.'" size="10">
	<input type=button value="Seleccionar fecha" onclick="muestraCalendario(\''. $raiz.'\',\''. $nombreformulario .'\',\''.$nombrecampo.'\')">
	';	
}
?>