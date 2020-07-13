<?php

require_once '../../../config.php';
require_once "../../../AutoLoader/autoLoader.php";

$utilC = new UtilController();
if(!Util::isAjax()){
    return;
}

$reservaC = new ReservaController;
$reservaList = $reservaC->select();
$JsonData = $utilC->objListToJsonList($reservaList, $_POST);

echo $JsonData;