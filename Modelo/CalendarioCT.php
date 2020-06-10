<?php


/**
 * Calendario CaribeTour: muestra el calendario de un destino con las salidas y 
 * precios programados
 *
 * @author makina
 */
class CalendarioCT {
    
    /**
     * Renderiza un calendario con el que se puede adelantar o atrazar entre meses.
     * El parametro $eventos es un array de arrays asociativos, que en caso de estar setteado
     * entonces la clave será la fecha (yyyy-mm-dd) a la que corresponde el evento y el valor será
     * lo que se mostrará en dicha fecha. Ej: [["2020-06-05" => "Cita medico"], ["2020-06-29" => "Pagar Telefono"]]
     * En el valor tambien se podrá mandar codigo html. Ej: ["2020-09-02" => "<a href='www.dominio.com'>pagar dominio</a>"]
     * @param array $eventos
     * @param string $fecha Se refiere a la fecha que queremos mostrar en el calendario
     * @return string
     */
    public static function showCalendarCT(array $eventos = [], string $fecha = ""): string 
    {
        date_default_timezone_set("Europe/Madrid");
        setlocale(LC_TIME, "spanish");
        $mostraFechaEspanol = self::mostrarFechaEspanol($fecha);
        $mostrarCeldasDias = self::getCeldasDias($fecha, $eventos = []);
        $ret = "
<div style='overflow-x:auto;'>
    <table>
        <thead>
            <tr>
                <th><a href='paises/cuba/varadero/caribe-club-princess-beach-resort-y-spa/fecha=5' title='Ver el mes anterior' class='button'>&lt;&lt;</a></th>
                <th colspan='5'>{$mostraFechaEspanol}</th>
                <th><a href='paises/cuba/varadero/caribe-club-princess-beach-resort-y-spa/fecha=7' title='Ver el mes siguiente' class='button'>&gt;&gt;</a></th>
            </tr>
            <tr>
                <th>Dom</th><th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th><th>Vie</th><th>Sab</th>
            </tr>
        </thead>
        <tbody>
                {$mostrarCeldasDias}
        </tbody>
    </table>
</div>"
        ;
        
        
        if(!empty($eventos)){
            $ret .= "calendario";
        }
        return $ret;
    }
    
    /**
     * Calcula la cantidad de días que tiene un mes.
     * @param int $numeroMes
     * @param int $anio
     * @return int
     */
    private static function calDiasDelMes(int $numeroMes, int $anio = null): int 
    {
        $anio = $anio ?? date('Y');
        return cal_days_in_month(CAL_GREGORIAN, $numeroMes, $anio);
    }
    
    /**
     * El parametro $eventos es un array de arrays asociativos, que en caso de estar setteado
     * entonces la clave será la fecha (yyyy-mm-dd) a la que corresponde el evento y el valor será
     * lo que se mostrará en dicha fecha. Ej: [["2020-06-05" => "Cita medico"], ["2020-06-29" => "Pagar Telefono"]]
     * En el valor tambien se podrá mandar codigo html. Ej: ["2020-09-02" => "<a href='www.dominio.com'>pagar dominio</a>"]
     * @param string $fecha en formato YYYY-mm-dd, Ej: 2021-03-02
     * @param array $eventos
     * @return string
     */
    public static function getCeldasDias(string $fecha = "", array $eventos = [])
    {
        $fechaBase = $fecha ?: date("Y-m-d");
        $dia = date("d", strtotime($fechaBase));
        $mes = date("m", strtotime($fechaBase));
        $anio = date("Y", strtotime($fechaBase));
        $dias_total = self::calDiasDelMes($mes);
        $dia_que_inicia_mes = date('w', mktime(0,0,0,$mes,1,$anio));
        $dias_total += $dia_que_inicia_mes;
        $filas_total = ceil($dias_total / 7);
        $celdas_total = $filas_total * 7;
        $celdas_restantes = $celdas_total - $dias_total;
              
        
        $ret = "<tr>";
        for($i = 1; $i <= $dias_total; $i++){
            if($i <= $dia_que_inicia_mes){
                $ret .= "<td></td>";
            } else {
                $mostrarNumeroDia = $i - $dia_que_inicia_mes;
                $ret .= "<td>{$mostrarNumeroDia}</td>";
                if(($i % 7) == 0){
                    $ret .= "</tr>\n<tr>";
                }
            }
        }
        
        for($i = 1; $i <= $celdas_restantes; $i++){
            $ret .= "<td></td>";
        }
        
        $ret .= "</tr>";
        
        return $ret;
    }
    
    /**
     * Muestra la fecha en formato letras y en en español Ej: "Lunes 30 de Diciembre del 2021"
     * @param type $fecha fecha en formato yyyy-mm-dd
     * @return string
     */
    public static function mostrarFechaEspanol(string $fecha = ""): string
    {
        $dias = ["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"]; 
        $meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
        $fechaBase = ("" != $fecha) ? $fecha : date("Y-m-d");
        $date = strtotime($fechaBase);
        $fecha = ($dias[date('w', $date)]." ".date('d', $date)." de ".$meses[date('n', $date)-1 ]. " del ".date("Y", $date));
        return $fecha;
    }

    





































    public static function mostrarCalendario($month=null, $year=null, $holidays=[], $url="", $lang="es")
    {
        $fechaTexto = CalendarioCT::MostratFechaEspanol(date('d-m-Y'));
        $diasCalendario = CalendarioCT::diasCalendario($month, $year , $holidays, $url, $lang);
        $previousMonth = $month - 1;
        $nextMonth = $month + 1;
        $ret ="<table>
                 <thead>
                     <tr>
                        <th><a href='$url/fecha={$previousMonth}' title='Ver el mes anterior' class='button'>&lt;&lt;</a></th>
                        <th colspan='5'> {$fechaTexto} </th>
                        <th><a href='$url/fecha={$nextMonth}' title='Ver el mes siguiente' class='button'>&gt;&gt;</a></th>
                     </tr>
                     <tr>
                         <th>Dom</th><th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th><th>Vie</th><th>Sab</th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr>
                     {$diasCalendario}
                     </tr>
                 </tbody>
             </table>";

        return $ret;
    }
    
    
    
    private static function diasCalendario($month=null, $year=null, $holidays=[], $url="", $lang="es")
    {
        date_default_timezone_set("Europe/Madrid");
        setlocale(LC_TIME, "spanish");
        $anio_actual = $year ?? date("Y");
        $mes_actual = $month ?? date("n");
        $dia_actual = date('d');
        //Util::dev($month);
        $numero_dias = cal_days_in_month(CAL_GREGORIAN, $mes_actual, $anio_actual);
        $iniciomes = date('w',mktime(0,0,0,$mes_actual,1,$anio_actual));
        $numero_dias += $iniciomes;					
        $filas = ceil($numero_dias/7);
        $cantidad_celdas = $filas * 7;
        $diferencia = $cantidad_celdas - $numero_dias;
        $ret = "";
        //$url = $_SERVER['REDIRECT_URL'];
        $dateSelectedClass = "";
        $dateSelected = $_GET['fecha'] ?? "";
        for($i = 1; $i <= $numero_dias; $i++){
            if($i <= $iniciomes){
                $ret .= '<td></td>';
            } else {
                $dia = $i-$iniciomes;
                $precio = $dayClass = $showPrecio = "";
                if($dia == $dia_actual){
                    $dayClass = "calendar-current-day";
                }
                $dateToCompare = date('Y-m-d', mktime(0,0,0,$month, $dia, $year));
                if(isset($holidays[$dateToCompare])){
                    $precio = Util::moneda($holidays[$dateToCompare]);
                    $dayClass .= $dateSelected == $dateToCompare ? " calendar-selected-date" : "";
                    $showPrecio = "<div class='calendar-price'><a href='{$url}/fecha={$dateToCompare}'>{$precio}</a></div>";
                }
                
                $ret .=  "<td class='{$dayClass}'>{$dia} {$showPrecio}</td>";
            }

            if ($i % 7 ==0){
                $ret .=  '</tr><tr>';
            }

         }

         for($i = 1; $i <= $diferencia; $i++){
            $ret .= '<td></td>';
         }

         return $ret;
    }
}
