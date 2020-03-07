<?php
// CALENDARIO
$anioActual = 2018; //date('y');
$mesActual = 1; //date('n');
$diaActual = date('j');
//$diasMes = cal_days_in_month(CAL_GREGORIAN, $mesActual, $anioActual);
$diasMes = date('t', mktime(0, 0, 0, $mesActual, $diaActual, $anioActual));
$saltear = date('w', mktime(0, 0, 0, $mesActual, 1, $anioActual));
$filasCantidad = ceil($diasMes / 7);
$celdasCantidad = $filasCantidad * 7;
$celdasRestantes = $celdasCantidad - $diasMes;

$diasNombres = ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'];
echo $saltear;
$tdhead = "";
foreach($diasNombres as $dias){
    $tdhead .= "<th>{$dias}</th>";
}

$trhead = "<tr>{$tdhead}</tr>";
$thead = "<thead>{$trhead}</thead>";

$trbody = $tdbody = "";
$diasMes += $saltear;

for($i = 1; $i <= $diasMes; $i++){
    if($i <= $saltear){
        $tdbody .= "<td></td>";
    } else {
        $dia = $i - $saltear;
        $tdbody .= "<td>{$dia}</td>";
    }
    
    if ($i % 7 == 0){
        $tdbody .= "</tr><tr>";
    }
}

for($j = 1; $j <= $saltear; $j++){
    $tdbody .= "<td></td>";
}


$trbody = $tdbody;
$tbody = "<tbody><tr>{$trbody}</tr></tbody>";
$table = "
    <table border=2>
    {$thead}
    {$tbody}
    </table>
";

echo $table;
