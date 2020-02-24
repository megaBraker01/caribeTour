<?php

//var_dump($_GET);
//var_dump($_SERVER);
$url = $_SERVER["REQUEST_URI"];
$urlClear = trim(strstr($url, "?"), "?");
$urlClear = explode("&", $urlClear);

var_dump($urlClear);
$agrupar = ['idCategoriaPadre'];
$util = new Util;
$productoFechaPDO = $util->getProductoFechaRefPDO([], [], [], $agrupar);

$catPadreLista = [];
foreach($productoFechaPDO as $pdo){
    $catPadreLista[] = $util->getCategoriaById($pdo->getIdCategoriaPadre()); 
}

$opciones = "";
foreach($catPadreLista as $catPadre){
    $opciones .= "<option value='{$catPadre->getIdCategoria()}'> {$catPadre} </option>";

    foreach($catPadre->getCategoriasHijas() as $catHija){
        $opciones .= "<option value='{$catHija->getIdCategoria()}'>&nbsp;&nbsp;{$catHija} </option>";
    }     	
}
?>
<script type='text/javascript'>
/* <![CDATA[ */
var labels = {"dateFormat":"dd-mm-yy","dayNames":["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"],"dayNamesMin":["Do","Lu","Ma","Mi","Ju","Vi","Sa"],"monthNames":["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],"firstDay":"1","prevText":"Mes Anterior","nextText":"Mes Siguiente"};
/* ]]> */
</script>
	<div class="tour-search-form placeholder-form">
        <div class="form-title">
            <h4>Encuentra tu Destino</h4>
        </div>
		<form role="search" method="get" action="resultado.php" name="search">
			<div class="select-field">
				<span>All Destinations</span>
				<select name='cat' id='destination' class='postform' >
                    <option value='0'>Todos los Destinos</option>
                    	<?= $opciones ?>
				</select>
			</div>
			<div class="field-container">
				<input type="text" name="fechaI" class="date-field"  value="Fecha de Salida"/>
			</div>
			<div class="field-container">
				<input type="text" name="fechaR" class="date-field reverse" value="Fecha de Regreso"/>
			</div>
			<div class="range-slider">
				<div class="range-min"><span>0</span> &euro;</div>
				<div class="range-max"><span>0</span> &euro;</div>
				<div class="ui-slider"></div>
                <input type="hidden" name="precio_min" <?php if(isset($_GET["precio_min"])) echo 'value="'.$_GET["precio_min"].'"'; else echo 'value="0"'; ?> class="range-min" />
                <input type="hidden" name="precio_max" <?php if(isset($_GET["precio_max"])) echo 'value="'.$_GET["precio_max"].'"'; else echo 'value="0"'; ?> class="range-max" />
                <input type="hidden" value="200" class="range-min-value" />
                <input type="hidden" value="2000" class="range-max-value" />
			</div>
			<div class="form-button">
                <div class="button-container">
                    <a href="#" class="button submit-button" title="Buscar">Buscar</a>
                </div>
			</div>
		</form>
	</div>
