<?php

$cat = filter_input(INPUT_GET, 'cat') ?? "";
//$fechaI = filter_input(INPUT_GET, 'fechaI') ?? date('d-m-Y');
//$fechaR = filter_input(INPUT_GET, 'fechaR') ?? "";
$precio_min = filter_input(INPUT_GET, 'precio_min') ?? 200;
$precio_max = filter_input(INPUT_GET, 'precio_max') ?? 2000;

$agrupar = ['idCategoriaPadre'];
$productoC = new ProductoController();
$categoriaC = new CategoriaController;
$productoFechaPDO = $productoC->getProductoFechaRefPDO([], [], [], $agrupar);

$catPadreLista = [];
foreach($productoFechaPDO as $pdo){
    $catPadreLista[] = $categoriaC->getCategoriaById($pdo->getIdCategoriaPadre()); 
}

$opciones = "";
foreach($catPadreLista as $catPadre){
    $selectted = $cat == $catPadre->getIdCategoria() ? "selected" : "";
    $opciones .= "<option value='{$catPadre->getIdCategoria()}' {$selectted}> {$catPadre} </option>";

    foreach($catPadre->getCategoriasHijas() as $catHija){
        $selectted = $cat == $catHija->getIdCategoria() ? "selected" : "";
        $opciones .= "<option value='{$catHija->getIdCategoria()}' {$selectted}>&nbsp;&nbsp;{$catHija} </option>";
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
    <form role="search" method="get" action="resultado.php" name="search" autocomplete="off">
        <div class="select-field">
            <span>All Destinations</span>
            <select name='cat' id='destination' class='postform' >
                <option value='0'>Todos los Destinos</option>
                <?= $opciones ?>
            </select>
        </div>
        <div class="field-container">
            <input type="text" name="fechaI" class="date-field" title="Fecha de Salida"  value="Fecha de Salida"/>
        </div>
        <div class="field-container">
            <input type="text" name="fechaR" class="date-field reverse" title="Fecha de Regreso" value="Fecha de Regreso"/>
        </div>
        <div class="range-slider">
            <div class="range-min"><span>0</span> &euro;</div>
            <div class="range-max"><span>0</span> &euro;</div>
            <div class="ui-slider"></div>
            <input type="hidden" name="precio_min" value="<?= $precio_min ?>" class="range-min" />
            <input type="hidden" name="precio_max" value="<?= $precio_max ?>" class="range-max" />
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