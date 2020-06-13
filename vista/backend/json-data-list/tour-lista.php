<?php

require_once '../../../config.php';
require_once "../../../AutoLoader/autoLoader.php";

$utilC = new UtilController();
if(!$utilC->isAjax()){
    return;
}

$productoC = new ProductoController;
$productoList = $productoC->select([['idTipo', '3']], [['idProducto', 'desc']]);
$JsonData = $utilC->objListTosonList($productoList, $_POST);

echo $JsonData;