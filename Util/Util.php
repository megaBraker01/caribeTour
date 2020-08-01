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
     * Verifica si la peticion request se ha hecho a travez de ajax
     * @return boolean
     */
    public static function isAjax()
    {
        $isAjax = false;
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
            $isAjax = true;
        }
        return $isAjax;
    }
    
    /**
     * Quita los caracteres especiales de una cadena
     * @param string $value
     * @param string $type
     * @return string
     */
    public static function sanear(string $value, string $type = self::_TEXT): string
    {
        $remplazar = array("\n\r");
        $por = " ";
        $ret = htmlentities($value, ENT_COMPAT, 'utf-8');
        $pattern = "/[^A-Za-z0-9-=+_@,;&.\/\s\ ]/";
        
        switch (strtolower($type)){
            case self::_INT :
                $pattern = "/[^0-9-]/";
                $ret = preg_replace($pattern, $por, $ret);
                break;
            case self::_DOUBLE :
                $pattern = "/[^0-9-,.]/";
                $ret = preg_replace($pattern, $por, $ret);
                break;
            case self::_TEXT :
            default :
                $ret = preg_replace($pattern, $por, $ret);
                break;
        }
        
        return str_replace($remplazar, $por, $ret);
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
     * TODO: pasar a una clase listerCT por ejemplo
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
    
    
    
    public static function pagarConPaypal($idReserva, $pvpTotal, $nombreProducto, $concepto, $referencia, $idPagador, $emailPagador)
    {
        $urlPaypal = "https://www.paypal.com/cgi-bin/webscr";
        $urlRet = "http://localhost/caribetour/reserva-finalizada.php?idReserva={$idReserva}";
        $urlRetOk = $urlRet . "&pago=ok";
        $urlRetCancel = $urlRet . "&pago=Nok";
        $fields = [
            'upload' => '1',
            'amount' => $pvpTotal,
            'business' => 'rperez@caribetour.es',
            'receiver_email' => 'rperez@caribetour.es',
            'item_name' => $nombreProducto,
            'concept' => $concepto,
            'reference' => $referencia,
            'cmd' => '_xclick',
            'currency_code' => 'EUR',
            'payer_id' => $idPagador,
            'payer_email' => $emailPagador,
            'return' => $urlRetOk,
            'cancel_return' => $urlRetCancel,
            'cbt' => 'Volver a inicio',
            'hosted_button_id' => 'GX4V7KN7EPGNL',
        ];
        
        $fields_string = http_build_query($fields);
        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $urlPaypal);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

        //execute post
        $result = curl_exec($ch);
        
        
        // use key 'http' even if you send the request to https://...
        /*
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($urlPaypal, false, $context);
        if ($result === FALSE) { 
          // Handle error 
        }
         */

        echo($result);
        
    }
    
    /**
     * 
     * @param type $idProducto
     * @param int $cantidadFechas
     * @param string $iniciarEn
     * @return array
     * @throws ErrorException
     */
    public static function addFechasToProducto($idProducto, int $cantidadFechas, string $iniciarEn = null): array
    {
        $dateFormat = 'Y-m-d';
        $fechaInicio = date($dateFormat);
        if(!is_null($iniciarEn)){
            $fechaInicio = date($dateFormat, strtotime($iniciarEn));
        }
        
        $productoC = new ProductoController;
        $producto = $productoC->getProductoById($cantidadFechas);
        if(is_null($producto)){
            throw new ErrorException("No se ha encontrado el producto con el id {$idProducto}");
        }
        
        $fechaC = new FechaController();
        $productoFechaRefC = new ProductoFechaRefController;
        $productoFechaRefIdList = [];
        for($i = 0; $i <= $cantidadFechas; $i++){
            $fSalida = $fechaInicio;
            $fVuelta = date($dateFormat, strtotime($fSalida."+ 7 days"));
            
            $objFecha = new Fecha();
            $objFecha->setFecha($fSalida);
            $idFSalida = $fechaC->insert($objFecha);
            
            $objFecha->setFecha($fVuelta);
            $idFVuelta = $fechaC->insert($objFecha);
            
            $productoFechaRef = new ProductoFechaRef(0, $idProducto, $idFSalida, $idFVuelta, 500);
            
            $productoFechaRefIdList[] = $productoFechaRefC->insert($productoFechaRef);
            
            $fechaInicio = date($dateFormat, strtotime($fechaInicio."+ 1 days"));
        }
        
        return $productoFechaRefIdList;
    }
}
