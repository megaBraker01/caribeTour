<?php

require_once '../../../config.php';
require_once "../../../AutoLoader/autoLoader.php";

$utilC = new UtilController();
if(!$utilC->isAjax()){
    return;
}

$sql = 'SELECT idProveedor, Nombre, NIF, Telefono, Email, Web FROM v_proveedores';
$proveedorList = $utilC->query($sql);
$data = [$utilC::LIST_DATA => $proveedorList];
$JsonData = json_encode($data);
//$JsonData = Util::objListTosonList($proveedorList, $_POST);

echo $JsonData;