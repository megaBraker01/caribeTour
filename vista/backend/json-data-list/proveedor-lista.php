<?php

require_once '../../../config.php';
require_once "../../../AutoLoader/autoLoader.php";

if(!Util::isAjax()){
    return;
}

$proveedorC = new ProveedorController;
$util = new Util();
$sql = 'SELECT * FROM v_proveedores';
$proveedorList = $util->query($sql);
$data = [$util::LIST_DATA => $proveedorList];
$JsonData = json_encode($data);
//$JsonData = Util::objListTosonList($proveedorList, $_POST);

echo $JsonData;