<?php

class Util {
    
    const _TEXT = 'text';
    const _INT = 'int';
    const _DOUBLE = 'double';
    const LIST_DATA = "data";
    const AJAX_PATH = "json-data-list/";

    /**
     * Depura el parametro de entrada
     */
    public static function dev($param){
        var_dump($param);
        exit();
    }


    /**
     * 
     * @param type $numberToCombert
     * @param int $decimal
     * @param string $sing
     * @return string
     */
    public static function moneda($numberToCombert = 0, int $decimal = 2, string $sing = "e"): string
    {
        switch(strtolower($sing)){
            case 'e': $symbol = "&euro;";
                break;
            case 'd': $symbol = "&dollar;";
                break;
            case 'p': $symbol = "&pound;";
                break;
            case 'c': $symbol = "&cent;";
                break;
            case 'y': $symbol = "&yen;";
                break;
            default: $symbol = "&euro;";
                break;
        }
        return number_format($numberToCombert, $decimal, ",", ".") . $symbol;
    }
    
    /**
     * 
     * @param array $thList
     * @return string
     */
    public function renderThForLister($thList = [])
    {
        $ret = "";
        foreach($thList as $th){
            $ret .= "<th>$th</th>";
        }
        $ret .= "<th></th>";
        return $ret;
    }
    
    /**
     * Calcula en días la duracion de un viaje
     * @param string $fsalida
     * @param string $fvuelta
     * @return int
     */
    public static  function duracionCalc(string $fsalida, string $fvuelta): int 
    {
        $duracion = strtotime($fvuelta) - strtotime($fsalida);
        return date('d', $duracion) * 1;
    }
    
    /**
     * 
     * @param string $date
     * @param string $format
     * @return string
     */
    public static function dateFormat(string $date, string $format = "d-m-Y")
    {
        return date($format, strtotime($date));
    }

    /**
     * Calcula el precio sumandole el porsentaje de la comision
     * @param type $precio
     * @param type $comision
     * @return float
     */
    public static function precioComisionCalc($precio, $comision): float
    {
        return $precio + self::comisionCalc($precio, $comision);
    }
    
    /**
     * 
     * @param type $precio
     * @param type $comision
     * @return float
     */
    public static function comisionCalc($precio, $comision): float
    {
        return (($precio * $comision) / 100);
    }
    
    /**
     * Convierte a mayúsculas el primer caracter de cada palabra de una cadena
     * @param string $str
     * @return string
     */
    public static function capitalizar(string $str)
    {
        return ucwords($str);
    }
}
