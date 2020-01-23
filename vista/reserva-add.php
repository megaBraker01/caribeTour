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
var_dump($_POST);
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "clientes")) {
	if (isset($_POST['strNombre'][0]) && $_POST['strNombre'][0] !="" && preg_replace('/[^A-Za-zñÑ]/','',$_POST["strNombre"][0]) && is_string($_POST["strNombre"][0]) && isset($_POST['strApellidos'][0]) && $_POST['strApellidos'][0] !="" && preg_replace('/[^A-Za-zñÑ]/','',$_POST["strApellidos"][0]) && is_string($_POST["strApellidos"][0]) && isset($_POST['strDNI'][0]) && $_POST['strDNI'][0] !="" && preg_replace('/[^A-Za-zñÑ]/','',$_POST["strDNI"][0]) && is_string($_POST["strDNI"][0]) && isset($_POST['strTelefono'][0]) && $_POST['strTelefono'][0] !="" && is_numeric($_POST['strTelefono'][0]) && preg_match('/[0-9]/',$_POST['strTelefono'][0]) && isset($_POST['strEmail'][0]) && $_POST['strEmail'][0] !="" && filter_var($_POST['strEmail'][0], FILTER_VALIDATE_EMAIL) && preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$_POST['strEmail'][0]) && isset($_POST['strDireccion'][0]) && $_POST['strDireccion'][0] !="" && preg_replace('/[^A-Za-z0-9-+,;.\/\ ]/','',$_POST["strDireccion"][0]) && is_string($_POST["strDireccion"][0]) && isset($_POST['strCiudad'][0]) && $_POST['strCiudad'][0] !="" && preg_replace('/[^A-Za-zñÑ]/','',$_POST["strCiudad"][0]) && is_string($_POST["strCiudad"][0]) && isset($_POST['strProvincia'][0]) && $_POST['strProvincia'][0] !="" && preg_replace('/[^A-Za-zñÑ]/','',$_POST["strProvincia"][0]) && is_string($_POST["strProvincia"][0]) && isset($_POST['intCodigoPostal'][0]) && $_POST['intCodigoPostal'][0] !="" && is_numeric($_POST['intCodigoPostal'][0]) && preg_match('/[0-9]/',$_POST['intCodigoPostal'][0])){
		//Asigna el usuario principal, la fecha y el producto seleccionado a la sesion
		$_SESSION['MM_strDNI'] = $_POST['strDNI'][0];
		$_SESSION['producto'] = $_POST['idproducto'];
		$_SESSION['idFecha'] = $_POST['idFecha'];
		//Genera el numero de reserva que corresponde e introduce las notas y la fecha de la reserva
		$insertSQL = sprintf("INSERT INTO tblreserva (strNotas, fchReserva) VALUES (%s, NOW())", GetSQLValueString(limpiarstr($_POST['strNotas']), "text"));
		mysql_select_db($database_conexionturismo, $conexionturismo);
		$Result1 = mysql_query($insertSQL, $conexionturismo) or die(mysql_error());
		$ultimareserva = $_SESSION['reserva'] = mysql_insert_id();
		//Introduce los datos del titular de la reserva y los pasajeros y calcula el precio total de la reserva
		$precioAdulto = $_POST['dblPrecio']+$_POST['dblTasas'];
		$tasas = $_POST['dblTasas'];
		$totalProducto = 0;
		$totalSeguro = 0;
		$totalReserva = 0;
		$personas = count($_POST['strNombre'])-1;
		$adultos = 0;
		$ninios = 0;
		if ((isset($_POST["strNombre"])) && ($_POST["strNombre"] != "")) {
			for($i=0;$i<count($_POST['strNombre']);$i++)
			{
			//si es el titular de la reserva, introduce tambien los datos de la direccion
				if ($_POST['strDNI'][$i] == $_POST['strDNI'][0]){
					$fchNacimiento = $_POST['intAnios'][$i] . "-" . $_POST['strMes'][$i] . "-" . $_POST['intDia'][$i];
				//calcular la cantidad de adultos, niños y el precio acumulado
					$anos = Edad($fchNacimiento);
					if($i>0){
						if ($anos >= 2){ $precio = $precioAdulto; $adultos++;   }
						else { $precio = $tasas; $ninios++; }
						$totalProducto = $totalProducto + $precio;
					}
					$insertSQL = sprintf("INSERT INTO tblcliente (strNombre, strApellidos, strDNI, fchNacimiento, strTelefono, strEmail, strDireccion, strCiudad, strProvincia, intCodigopostal, idReserva, fchAlta) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, NOW())",
								   GetSQLValueString(capitalizar($_POST['strNombre'][$i]), "text"),
								   GetSQLValueString(capitalizar($_POST['strApellidos'][$i]), "text"),
								   GetSQLValueString(strtoupper($_POST['strDNI'][$i]), "text"),
								   GetSQLValueString($fchNacimiento, "date"),
								   GetSQLValueString($_POST['strTelefono'][0], "int"),
								   GetSQLValueString($_POST['strEmail'][0], "text"),
								   GetSQLValueString($_POST['strDireccion'][0], "text"),
								   GetSQLValueString($_POST['strCiudad'][0], "text"),
								   GetSQLValueString($_POST['strProvincia'][0], "text"),
								   GetSQLValueString($_POST['intCodigoPostal'][0], "int"),
								   GetSQLValueString($ultimareserva, "int"));
		
					mysql_select_db($database_conexionturismo, $conexionturismo);
					$Result2 = mysql_query($insertSQL, $conexionturismo) or die(mysql_error());
				}
				else {
					//si es un pasajero, solo introduce el nombre, apellidos, dni, nacimiento
					$fchNacimiento = $_POST['intAnios'][$i] . "-" . $_POST['strMes'][$i] . "-" . $_POST['intDia'][$i];
					//calcular la cantidad de adultos, niños y el precio acumulado
					$anos = Edad($fchNacimiento);
					if ($anos >= 2){ $precio = $precioAdulto; $adultos++;   }
					else { $precio = $tasas; $ninios++; }
					$totalProducto = $totalProducto + $precio;
					$insertSQL = sprintf("INSERT INTO tblcliente (strNombre, strApellidos, strDNI, fchNacimiento, idReserva, fchAlta) VALUES (%s, %s, %s, %s, %s, NOW())",
								   GetSQLValueString(capitalizar($_POST['strNombre'][$i]), "text"),
								   GetSQLValueString(capitalizar($_POST['strApellidos'][$i]), "text"),
								   GetSQLValueString(strtoupper($_POST['strDNI'][$i]), "text"),
								   GetSQLValueString($fchNacimiento, "date"),
								   GetSQLValueString($ultimareserva, "int"));
		
					mysql_select_db($database_conexionturismo, $conexionturismo);
					$Result2 = mysql_query($insertSQL, $conexionturismo) or die(mysql_error());
				}
			}
		}
		//Introduce los seguros seleccionados
		if ((isset($_POST["idSeguros"])) && ($_POST["idSeguros"] != "")) {
			for($i=0;$i<count($_POST['idSeguros']);$i++)
			{
				$precioAdultoSeg = ObtenerPrecioProducto($_POST['idSeguros'][$i]);
				$precioInfanteSeg = ObtenerPrecioInfanteProducto($_POST['idSeguros'][$i]);
				$insertSQLseguros = sprintf("INSERT INTO tblcompra (idReserva, idProducto, dblPrecio, dblTasas, fchAdicion) VALUES (%s, %s, %s, %s, NOW())",
							   GetSQLValueString($_SESSION['reserva'], "int"),
							   GetSQLValueString($_POST['idSeguros'][$i], "int"),
							   GetSQLValueString($precioAdultoSeg, "int"),
							   GetSQLValueString($precioInfanteSeg, "int"));
				$contratacion = ObtenerCatProducto($_POST['idSeguros'][$i]);
				if ($contratacion == 16) { $totalSeguro = $precioAdultoSeg*$personas; } //seguro por persona
				if ($contratacion == 17) { $totalSeguro = $totalSeguro + $precioAdultoSeg; } //seguro por reerva
	
		  mysql_select_db($database_conexionturismo, $conexionturismo);
		  $Result2 = mysql_query($insertSQLseguros, $conexionturismo) or die(mysql_error());
			}
		}
		//actualiza la reserva con el precio total que le corresponde
		$totalReserva = $totalProducto+$totalSeguro;
		$_SESSION['totalReserva'] = $totalReserva;
		global $database_conexionturismo, $conexionturismo;		
		$updateSQL = sprintf("UPDATE tblreserva SET dblTotal = %s WHERE idReserva = %s",
		$_SESSION['totalReserva'], $_SESSION['reserva']);	 
		mysql_select_db($database_conexionturismo, $conexionturismo);
		$Result1 = mysql_query($updateSQL, $conexionturismo) or die(mysql_error()); 
		//TotalReserva();
		//Introduce los datos del producto comprado ligado a la reserva que corresponde
		$insertSQL = sprintf("INSERT INTO tblcompra (idReserva, idProducto, idFecha, dblPrecio, dblTasas, fchAdicion) VALUES (%s, %s, %s, %s, %s, NOW())",
						   $ultimareserva,
						   $_SESSION['producto'],
						   $_POST['idFecha'],
						   $_POST['dblPrecio'],
						   $tasas);
	  mysql_select_db($database_conexionturismo, $conexionturismo);
	  $Result1 = mysql_query($insertSQL, $conexionturismo) or die(mysql_error());
		
		header("Location: forma_pago.php");
		exit;
	}
	else {
		$_SESSION['NO'] = true;
		header('Location: cliente-datos.php?idproducto='.$_POST['idproducto'].'&idFecha='.$_POST['idFecha'].'&strNombre='.$_POST['strNombre'][0].'&strApellidos='.$_POST['strApellidos'][0].'&strDNI='.$_POST['strDNI'][0].'&strTelefono='.$_POST['strTelefono'][0].'&strEmail='.$_POST['strEmail'][0].'&strDireccion='.$_POST['strDireccion'][0].'&strCiudad='.$_POST['strCiudad'][0].'&strProvincia='.$_POST['strProvincia'][0].'&intCodigoPostal='.$_POST['intCodigoPostal'][0].'');
	}
} 
else { header("Location: index.php");
exit; }
?>