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
     * @param string $fvuelta
     * @param string $fsalida
     * @return int
     */
    public static  function duracionCalc(string $fvuelta, string $fsalida): int 
    {
        $duracion = strtotime($fvuelta) - strtotime($fsalida);
        return date('d', $duracion) * 1;
    }    
}
