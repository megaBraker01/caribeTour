<?php

require_once '../../../config.php';
require_once "../../../AutoLoader/autoLoader.php";

if(!Util::isAjax()){
    return;
}

$productoC = new ProductoController;
$productoList = $productoC->select([['idTipo', '4']], [['idProducto', 'desc']]);
$JsonData = Util::objListTosonList($productoList, $_POST);

echo $JsonData;