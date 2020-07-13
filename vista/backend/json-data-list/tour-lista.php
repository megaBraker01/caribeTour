<?php

require_once '../../../config.php';
require_once "../../../AutoLoader/autoLoader.php";

$utilC = new UtilController();
if(!Util::isAjax()){
    return;
}

$productoC = new ProductoController;
$productoList = $productoC->select([['idTipo', '3']], [['idProducto', 'desc']]);
$JsonData = $utilC->objListToJsonList($productoList, $_POST);

echo $JsonData;