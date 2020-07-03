<?php

require_once '../../../config.php';
require_once "../../../AutoLoader/autoLoader.php";

$utilC = new UtilController();
if(!$utilC->isAjax()){
    return;
}

$reservaC = new ReservaController;
$reservaList = $reservaC->select();
$JsonData = $utilC->objListTosonList($reservaList, $_POST);

echo $JsonData;