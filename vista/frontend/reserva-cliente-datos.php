<?php
require_once '../../config.php';
require_once "../../AutoLoader/autoLoader.php";


$producto = $categoria = $idProductoFechaRef = $showError = null;
$catSlug =  $catPadre = $catPadreSlug = $producSlug = null;
try{
    $idProducto = (isset($_GET['idProducto']) and "" != $_GET['idProducto']) 
            ? (int) $_GET['idProducto'] 
            : 0;    
    $productoC = new ProductoController;
    $producto = $productoC->getProductoById($idProducto);
    $producSlug = $producto->getSlug();
    $categoria = $producto->getCategoria();
    $catSlug = $categoria->getSlug();
    $catPadre = $categoria->getCategoriaPadre();
    $catPadreSlug = $catPadre->getSlug();
    
    // FECHA SELECCIONADA
    $idProductoFechaRef = (isset($_GET['idProductoFechaRef']) and "" != $_GET['idProductoFechaRef']) 
            ? (int) $_GET['idProductoFechaRef'] 
            : 0; 
    $fsalidaFiltro = [
        ['idProducto', $idProducto],
        ['idProductoFechaRef', $idProductoFechaRef],
    ];
    $fsalida = $fvuelta = $pvp = $duracion = "";
    if($fSeleccionadaData = @$productoC->getProductoFechaRefPDO($fsalidaFiltro)[0]){
        
        $idProductoFechaRef = $fSeleccionadaData->getIdProductoFechaRef();
        $fsalida = Util::dateFormat($fSeleccionadaData->getFsalida());
        $fvuelta = ("" != $fSeleccionadaData->getFvuelta()) ? Util::dateFormat($fSeleccionadaData->getFvuelta()) : "N/A";
        $duracion = Util::duracionCalc($fvuelta, $fsalida); 
        $pProveedor = $fSeleccionadaData->getPrecioProveedor();
        $pComision = $fSeleccionadaData->getComision();
        $precio = $pProveedor + (($pProveedor * $pComision) / 100);   
        $pvp = Util::moneda($precio);
    }
    
    
    
    // EDIT AREA
    $editFormAction = $_SERVER['PHP_SELF'];
    if (isset($_SERVER['QUERY_STRING'])) {
      $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
    }
    
    if(isset($_POST['chx_termsAndConditions']) and "on" == $_POST['chx_termsAndConditions']){        
        
        $nombreT = $_POST['nombreT'];
        $apellidosT = $_POST['apellidosT'];
        $NIFoPasaporteT = $_POST['NIFoPasaporteT'];
        $telefonoT = $_POST['telefonoT'];
        $emailT = $_POST['emailT'];
        $direccionT = $_POST['direccionT'];
        $ciudadT = $_POST['ciudadT'];
        $provinciaT = $_POST['provinciaT'];
        $codigoPostalT = $_POST['codigoPostalT'];
        $paisT = $_POST['paisT'];
        $notasT = $_POST['notasT'];
        $idProductoFechaRef = $_POST['idProductoFechaRef'];
        $tipoPago = $_POST['tipoPago'];
        $pvp = $_POST['pvp'];
        
        $clienteC = new ClienteController;
        $titular = new Cliente();
        $titular->setNombre($nombreT)->setApellidos($apellidosT)->setNIFoPasaporte($NIFoPasaporteT)
                ->setTelefono($telefonoT)->setEmail($emailT)->setDireccion($direccionT)
                ->setCiudad($ciudadT)->setProvincia($provinciaT)->setCodigoPostal($codigoPostalT)
                ->setPais($paisT)->setIdEstado(Estado::ESTADO_ACTIVO);
        
        $pasajerosList = [];
        $count = count($_POST['nombreP']);
        for($i = 0; $i < $count; $i++){
            $nombreP = $_POST['nombreP'][$i];
            $apellidosP = $_POST['apellidosP'][$i];
            $NIFoPasaporteP = $_POST['NIFoPasaporteP'][$i];
            $nacionalidadP = $_POST['nacionalidadP'][$i];
            $fechaNacimiento = "{$_POST['anioP'][$i]}-{$_POST['mesP'][$i]}-{$_POST['diaP'][$i]}";
            $fechaNacimiento = Util::dateFormat($fechaNacimiento, "Y-m-d");
            $pasajero = new Pasajero();
            $pasajero->setNombre($nombreP)->setApellidos($apellidosP)->setNIFoPasaporte($NIFoPasaporteP)
                    ->setNacionalidad($nacionalidadP)->setFechaNacimiento($fechaNacimiento);
            $pasajerosList[] = $pasajero;
        }

        $reservaC = new ReservaController;
        $reserva = $reservaC->generarReserva($titular, $pasajerosList, $notasT, $idProductoFechaRef, $tipoPago, $pvp);
        
    }
    
} catch (Exception $e){
    $showError = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <?php include_once("includes/metatag.php"); ?>
        <meta property="og:title" content="Caribetour.es | Especialistas en el Caribe" />
        <meta name="title" content="CaribeTour.es: Especialistas en el Caribe" />
        <meta name="DC.title" content="CaribeTour.es: Especialistas en el Caribe" />
        <title>Plantilla| Especialistas en el Caribe</title>        
        <meta name="description" content="CaribeTour.es | Agencia especializada en el Caribe y sus destinos" />
        <meta name="keywords" content="CaribeTour.es | Agencia especializada en el Caribe y sus destinos" />
        <!--[if lt IE 9]>
            <script type="text/javascript" src="http://www.caribetour.es/js/jquery/html5.js"></script>
        <![endif]-->
        <?php include_once("includes/baselink.php"); ?>
        <link rel="canonical" href="http://www.caribetour.es/" />
	    <?php include_once("includes/icons.php"); ?>
        <link rel='stylesheet' id='colorbox-css'  href='<?=PATHFRONTEND ?>css/colorbox.css?ver=3.7.1' type='text/css' media='all' />
        <link rel='stylesheet' id='jquery-ui-datepicker-css'  href='<?=PATHFRONTEND ?>css/datepicker.css?ver=3.7.1' type='text/css' media='all' />
        <link rel='stylesheet' id='general-css'  href='<?=PATHFRONTEND ?>css/style.css?ver=3.7.1' type='text/css' media='all' />
        <?php include_once("includes/jsHead.php"); ?>
        <?php include_once("includes/css.php"); ?>
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
    <body class="home page page-id-96 page-template-default">
        <!-- container -->
        <div class="container site-container">
            <!-- header -->
            <header class="container site-header">
                <div class="substrate top-substrate">
                    <?php include('includes/imgSiteBg.php') ?>
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
                <!-- breadcrumb-->
                <div class="miga" id="breadcrumb">
                    <div class="breadcrumb">
                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="inicio" rel="tag" title="Inicio">Inicio</a>
                    </div>
                    <div class="breadcrumb">
                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises" rel="tag" title="Paises">Paises</a>
                    </div>
                    <div class="breadcrumb">
                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/<?= $catPadreSlug ?>"  rel="tag" title="<?= $catPadre ?>"><?= $catPadre ?></a>
                    </div>
                    <div class="breadcrumb">
                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/<?= $catPadreSlug ?>/<?= $catSlug ?>" rel="tag" title="<?= $categoria ?>"><?= $categoria ?></a>
                    </div>
                    <div class="breadcrumb">
                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="paises/<?= $catPadreSlug ?>/<?= $catSlug ?>/<?= $producSlug?>" rel="tag" title="<?= $producto ?>"><?= $producto ?></a>
                    </div>
                    <div class="breadcrumb">
                        Resumen de la Reserva
                    </div>
                </div>
                <!-- /breadcrumb-->            
            
            
                <div class="row">
                    <div class="section-title">
                        <h1>Resumen de la Reserva</h1>
                    </div>
                    
                    <!-- foto portada -->
                    <div class="column fourcol ">
                        <div class="tour-thumb-container">
                            <div class="tour-thumb">
                                <img width="440" height="330" src="<?=PATHFRONTEND ?>img/<?= $producto->getImagen() ?>" class="attachment-preview wp-post-image" alt="<?= $producto ?>" title="<?= $producto ?>" />
                            </div>
                            <div class="block-background"></div>
                        </div>
                    </div>
                    <!-- /foto portada -->
                    
                    <!-- datos del producto -->
                    <div class="fourcol column">
                        <h3><?= $producto ?></h3>
                        <ul class="tour-meta">
                            <li>
                                <div class="colored-icon icon-2"></div>
                                <strong>Destino:</strong> <?= $categoria ?>
                            </li>
                            <li>
                                <div class="colored-icon icon-1"><span></span></div>
                                <strong>Duracion:</strong> <?= $duracion ?> D&iacute;as
                            </li>
                            <li>
                                <div class="colored-icon icon-6"><span></span></div>
                                <strong>Salida:</strong> <?= $fsalida ?>
                            </li>
                            <li>
                                <div class="colored-icon icon-7"><span></span></div>
                                <strong>Regreso:</strong> <?= $fvuelta ?>
                            </li>
                            <li style="font-size:1.8em;">
                                <div class="colored-icon icon-3"><span></span></div>
                                <strong>Precio:</strong> <?= $pvp ?>
                            </li>
                        </ul>
                    </div>
                    <!-- /datos del producto -->
                    
                    <!-- itinerario -->
                    
                    <div class="column fourcol last">
                        <h3>Itinerario</h3>
                        <p><?= $producto->getItinerario() ?></p>
                    </div>
                    
                    <!-- /itinerario -->
                    
                </div>
                
                <div class="row">
                    
                    
                    <div class="booking-form">
                        <form action="<?= $editFormAction ?>" method="POST" class="formatted-form" role="form" name="clientes" lang="es" onSubmit="return validacion();" dir="ltr">
                            <div class="section-title">
                                <h2>Datos del Titular</h2>
                                <p>(*) Campo Obligatorio</p>
                            </div>
                            <fieldset class="column fourcol" name="Titular">
                                <label for="nombre">Nombre *</label>
                                <div class="field-container"><input id="nombre" type="text" width="" name="nombreT" value="" placeholder="Nombre" title="Introduzca su Nombre" maxlength="20" required /></div>
                                <label for="apelli2">Apellidos *</label>
                                <div class="field-container"><input id="apelli2" type="text" name="apellidosT" value="" placeholder="Apellidos" title="Introduzca sus Apellidos" maxlength="30" required /></div>
                                <label for="dni">DNI o Pasaporte *</label>
                                <div class="field-container"><input id="dni" type="text" name="NIFoPasaporteT" value="" placeholder="DNI o Pasaporte" title="Introduzca el DNI o Pasaporte sin guiones ni espacios." maxlength="10" required /></div>
                                <label for="telefono">Tel&eacute;fono de contacto *</label>
                                <div class="field-container"><input id="telefono" type="number" name="telefonoT" value="" placeholder="Tel&eacute;fono" title="Introduzca su N&uacute;mero Telef&oacute;nico sin guiones ni espacios" maxlength="15" required /></div>
                                <label for="email">Email *</label>
                                <div class="field-container"><input type="email" name="emailT" id="email" value="" placeholder="Email" title="Introduzca su Correo Eletr&oacute;nico" maxlength="50" required /></div>
                            </fieldset>
                            <fieldset class="column fourcol" name="Direccion">
                                <label for="direccion">Direcci&oacute;n</label>
                                <div class="field-container"><input type="text" id="direccion" name="direccionT" value="" placeholder="Direcci&oacute;n" title="Indique su Direcci&oacute;n" maxlength="30" /></div>
                                <label for="ciudad">Ciudad o Pueblo</label>
                                <div class="field-container"><input type="text" id="ciudad" name="ciudadT" value="" placeholder="Ciudad o Pueblo" title="Introduzca su Ciudad" maxlength="30" /></div>
                                <label for="provincia">Provincia</label>
                                <div class="field-container"><input type="text" id="provincia" name="provinciaT" value="" placeholder="Provincia" title="Introduzca su Provincia" maxlength="30" /></div>
                                <label for="cp">C&oacute;digo Postal</label>
                                <div class="field-container"><input type="number" id="cp" name="codigoPostalT" value="" placeholder="C&oacute;digo Postal" title="Introduzca el C&oacute;digo Postal sin guiones ni espacios" maxlength="6" required /></div>
                                <label for="pais">Pais</label>
                                <div class="field-container"><input type="text" id="pais" name="paisT" value="" placeholder="Pais" title="Introduzca el Pais" maxlength="50" /></div>
                            </fieldset>
                            <fieldset class="column fourcol last" name="notas">
                                <label for="notas">Notas</label>
                                <div class="field-container"><textarea name="notasT" id="notas" title="Agrega cualquier comentario que sea de utilidad..." placeholder="Agrega cualquier comentario que sea de utilidad..." maxlength="500" width="100%" spellcheck="true" rows="90"></textarea></div>
                            </fieldset>
                            
                            <div class="clear"></div>
                            <fieldset class="twelvecol column last">
                                <p>&nbsp;</p>
                            </fieldset>
                            <div class="clear"></div>
                            
                            <fieldset class="twelvecol column last" name="pasajeros">
                                <div class="section-title">
                                    <h2>Datos de los Pasajeros</h2>
                                </div>
                            </fieldset>
                            

                            <fieldset class="twelvecol column last">
                                <legend>
                                    <input type="button" name="copyTitular" title="Copiar los datos del titular al pasajero 1" value="Copiar datos del Titular" onClick="javascript:copiar();"/>
                                </legend>
                                <p>&nbsp;</p>
                            </fieldset>
                            <div class="clear"></div>
                            
                            
                            <fieldset class="column fourcol" name="Pasajero 1">
                                <legend><h2>Pasajero 1</h2></legend>
                                <label for="nombrep">Nombre *</label>
                                <div class="field-container"><input id="nombrep" type="text" width="" name="nombreP[]" value="" placeholder="Nombre" title="Introduzca su Nombre" maxlength="20" required /></div>
                                <label for="apelli2p">Apellidos *</label>
                                <div class="field-container"><input id="apelli2p" type="text" name="apellidosP[]" value="" placeholder="Apellidos" title="Introduzca sus Apellidos" maxlength="30" required /></div>
                                <label for="dnip">DNI o Pasaporte *</label>
                                <div class="field-container"><input id="dnip" type="text" name="NIFoPasaporteP[]" value="" placeholder="DNI o Pasaporte" title="Introduzca el DNI o Pasaporte sin guiones ni espacios." maxlength="10" required /></div>
                                <label for="nacionalidadp">Nacionalidad *</label>
                                <div class="field-container"><input id="nacionalidadp" type="text" name="nacionalidadP[]" value="" placeholder="Nacionalidad" title="Introduzca la Nacionalidad." required /></div>
                                <legend>Fecha de Nacimiento *</legend>
                                <div class="threecol column">
                                    <div class="field-container">
                                        <input type="number" name="diaP[]" value="" id="dia" placeholder="D&iacute;a" onKeyUp="if (this.value.length == this.getAttribute('maxlength')) mesP[].focus()" maxlength="2" max="31" min="1" title="Introduzca el D&iacute;a de su nacimiento" required />
                                    </div>
                                </div>
                                <div class="fivecol column">
                                    <div class="field-container">
                                        <select name="mesP[]" id="mes" title="Seleccione el mes de su nacimiento" required >
                                            <option value="" selected="selected">Mes</option>
                                            <option value="01">Enero</option>
                                            <option value="02">Febrero</option>
                                            <option value="03">Marzo</option>
                                            <option value="04">Abril</option>
                                            <option value="05">Mayo</option>
                                            <option value="06">Junio</option>
                                            <option value="07">Julio</option>
                                            <option value="08">Agosto</option>
                                            <option value="09">Septiembre</option>
                                            <option value="10">Octubre</option>
                                            <option value="11">Noviembre</option>
                                            <option value="12">Diciembre</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="fourcol column last">
                                <div class="field-container">
                                <input type="number" id="anio" name="anioP[]" value="" maxlength="4" max="2002" min="1930" placeholder="A&ntilde;o" title="Introduzca el a&ntilde;o de su nacimiento" onKeyUp="if (this.value.length == this.getAttribute('maxlength')) strCiudad[].focus()" required /></div></div>
                            </fieldset>
                            
                            <fieldset class="column fourcol" name="Pasajero 1">
                                <legend><h2>Pasajero 2</h2></legend>
                                <label for="nombrep">Nombre *</label>
                                <div class="field-container"><input id="nombrep" type="text" width="" name="nombreP[]" value="" placeholder="Nombre" title="Introduzca su Nombre" maxlength="20" required /></div>
                                <label for="apelli2p">Apellidos *</label>
                                <div class="field-container"><input id="apelli2p" type="text" name="apellidosP[]" value="" placeholder="Apellidos" title="Introduzca sus Apellidos" maxlength="30" required /></div>
                                <label for="dnip">DNI o Pasaporte *</label>
                                <div class="field-container"><input id="dnip" type="text" name="NIFoPasaporteP[]" value="" placeholder="DNI o Pasaporte" title="Introduzca el DNI o Pasaporte sin guiones ni espacios." maxlength="10" required /></div>
                                <label for="nacionalidadp">Nacionalidad *</label>
                                <div class="field-container"><input id="nacionalidadp" type="text" name="nacionalidadP[]" value="" placeholder="Nacionalidad" title="Introduzca la Nacionalidad." required /></div>
                                <legend>Fecha de Nacimiento *</legend>
                                <div class="threecol column">
                                    <div class="field-container">
                                        <input type="number" name="diaP[]" value="" id="dia" placeholder="D&iacute;a" onKeyUp="if (this.value.length == this.getAttribute('maxlength')) mesP[].focus()" maxlength="2" max="31" min="1" title="Introduzca el D&iacute;a de su nacimiento" required />
                                    </div>
                                </div>
                                <div class="fivecol column">
                                    <div class="field-container">
                                        <select name="mesP[]" id="mes" title="Seleccione el mes de su nacimiento" required >
                                            <option value="" selected="selected">Mes</option>
                                            <option value="01">Enero</option>
                                            <option value="02">Febrero</option>
                                            <option value="03">Marzo</option>
                                            <option value="04">Abril</option>
                                            <option value="05">Mayo</option>
                                            <option value="06">Junio</option>
                                            <option value="07">Julio</option>
                                            <option value="08">Agosto</option>
                                            <option value="09">Septiembre</option>
                                            <option value="10">Octubre</option>
                                            <option value="11">Noviembre</option>
                                            <option value="12">Diciembre</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="fourcol column last">
                                <div class="field-container">
                                <input type="number" id="anio" name="anioP[]" value="" maxlength="4" max="2002" min="1930" placeholder="A&ntilde;o" title="Introduzca el a&ntilde;o de su nacimiento" onKeyUp="if (this.value.length == this.getAttribute('maxlength')) strCiudad[].focus()" required /></div></div>
                            </fieldset>
                            
                            <div class="clear"></div>
                            <fieldset class="twelvecol column last">
                                <p>&nbsp;</p>
                            </fieldset>
                            <div class="clear"></div>
                            
                            <fieldset class="twelvecol column last" name="pasajeros">
                                <div class="section-title">
                                    <h2>Forma de Pago</h2>
                                </div>
                            </fieldset>
                            
                            <fieldset class="twelvecol column last" name="pasajeros">
                                <div class="field-container">
                                    <input id="tarjeta" type="radio" name="tipoPago" value="tarjeta" checked /><span><label for="tarjeta" class="label-input-radio">Tarjeta Cr&eacute;dito/D&eacute;vito</label></span><br>
                                    <input id="PayPal" type="radio" name="tipoPago" value="PayPal" /><span><label for="PayPal" class="label-input-radio">PayPal</label></span><br>
                                    <input id="transferencia" type="radio" name="tipoPago" value="transferencia" /><span><label for="transferencia" class="label-input-radio">Transferencia</label></span><br>
                                    
                                </div>
                            </fieldset>
                            
                            <div class="clear"></div>
                            <fieldset class="twelvecol column last">
                                <p>&nbsp;</p>
                            </fieldset>
                            <div class="clear"></div>
                            
                            <fieldset class="twelvecol column last">
                                <div class="field-container">
                                    <input type="checkbox" name="chx_termsAndConditions" id="chx_termsAndConditions" required /> 
                                    <label for="chx_termsAndConditions" title="Aceptar los terminos y condiciones">
                                        He le&iacute;do y acepto las <a href="legal/condiciones-de-uso" title="Ver condiciones generales" target="_blank">Condiciones generales</a> de venta y la <a href="legal/politica-de-privacidad" title="Ver Pol&iacute;tica de Seguridad y Privacidad" target="_blank">Pol&iacute;tica de Seguridad y Privacidad</a>
                                    </label>
                                </div>
                                <p>&nbsp;</p>

                                <input type="hidden" name="idproducto" value="<?= $idProducto ?>" />
                                <input type="hidden" name="idProductoFechaRef" value="<?= $idProductoFechaRef ?>">
                                <input type="hidden" name="pvp" value="<?= $pvp ?>" />
                                <input type="submit" value="Confirmar Datos y Elegir Forma de Pago" title="Confirmar Datos y Elegir Forma de Pago" tabindex="25"/>
                                
                            </fieldset>
                            
                        </form>
                    </div>
                    
                    
                </div>
                
                
            </section>
      
            <!-- /content -->

            <!-- footer -->
            <?php include("includes/footer.php");?>
            
            <!-- /footer -->

            <div class="substrate bottom-substrate">
                <?php include('includes/imgSiteBg.php') ?>
                
            </div>
        </div>
        <!-- /container -->
	    <?php include_once('includes/jsFoot.php'); ?>
  
        
    </body>
</html>