<?php



require_once '../../../config.php';
require_once "../../../AutoLoader/autoLoader.php";

if(!Util::isAjax()){
    return;
}

$productoC = new ProductoController;
$productoList = $productoC->select();

$data = [];
foreach ($productoList as $producto){
    $data["data"][] = $producto->getAllParams(false, false);
}

$JsonData = json_encode($data);

echo $JsonData;