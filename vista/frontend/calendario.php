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

// PARCIALMENTE FUNCIONANDO

    // CALENDARIO
    /*
    $anioActual = date('y');
    $mesActual = 2;//date('n');
    $diaActual = date('j');
    $diasMes = cal_days_in_month(CAL_GREGORIAN, $mesActual, $anioActual);
    $diaPosicion = date('w', mktime(0, 0, 0, $mesActual, 1, $anioActual));
    $filasCantidad = ceil($diasMes / 7);
    $celdasCantidad = $filasCantidad * 7;
    $celdasRestantes = $celdasCantidad - $diasMes;
    $diasNombres = ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'];
    $dias = [];
    $i = $j = 0;
    $firstRow = array_fill(0, $diaPosicion, "");
    $dias[] = $firstRow;
    
    while($j < $filasCantidad){
        $start = ++$i;
        $end = ($i+=6) <= $diasMes ? $i : $diasMes;
        $celdas = range($start, $end);
        if($j == $celdasRestantes){
            $celdas = array_merge($celdas, array_fill($end-1, $celdasRestantes, ""));
        }
        $dias[] = $celdas;
        $j++;
    }

    $lastPosition = count($dias)-1;
    array_push($dias[$lastPosition], array_fill(--$lastPosition, $celdasRestantes, ""));
    */