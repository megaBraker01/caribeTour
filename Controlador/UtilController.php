<?php


/**
 * pasar todos estos metodos a Util o a su correspondiente controller
 */
class UtilController extends BaseController {
    
    const _TEXT = 'text';
    const _INT = 'int';
    const _DOUBLE = 'double';
    const LIST_DATA = "data";
    const AJAX_PATH = "json-data-list/";



    /**
     * TODO: pasar esta funcion a BaseModelo (HECHO)
     * @param type $cadena
     * @param type $separador
     * @return type
     */
    public static function slugify($cadena, $separador = '-')
    {
        setlocale(LC_ALL, 'en_US.UTF8');
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $cadena);
        $slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $slug);
        $slug = preg_replace("/[\/_|+ -]+/", $separador, $slug);
        $slug = strtolower(trim($slug, $separador));

        return !empty($slug) ? $slug : "n{$separador}a";
    }
    
    
    /**
     * 
     * @param string $sql
     * @param array $filtros
     * @param array $ordenados
     * @param array $limitar
     * @param array $agrupar
     * @return array
     */
    public function query(string $sql, array $filtros = [], array $ordenados = [], array $limitar = [], array $agrupar = []): array
    {
        return parent::query($sql, $filtros, $ordenados, $limitar, $agrupar);
    }

 
    /**
     * TODO: Pasar este metodo a TipoController
     * Obtiene los tipos disponibles dependiendo el nombre de la tabla
     * @param string $tableName
     * @return \Tipo
     * @throws Exception
     */
    public function getTipos(string $tableName)
    {
        if(!is_string($tableName) or "" == $tableName){
            throw new Exception('[ERROR] El nombre de la tabla tiene que ser un string distinto de ""');
        }
        $sql = "SELECT tipos.idTipo, tipos.nombre FROM tipo_tabla_ref INNER JOIN tipos USING(idTipo)";
        $filtros = [['tabla', $tableName], ['idTipo', 1, '>']];
        $tiposList = [];
        foreach($this->query($sql, $filtros) as $tipo){
            $tiposList[] = new Tipo($tipo->idTipo, $tipo->nombre);
        }

        return $tiposList;
    }
    
    /**
     * TODO: cambiar a la clase formHandler
     * @param string $tableName
     * @return type
     */
    public function getTiposForForm(string $tableName)
    {
        $tipoList = $this->getTipos($tableName);
        $tipoOptions = [];
        foreach ($tipoList as $tipoObj){
            $tipoOptions[$tipoObj->getIdTipo()] = $tipoObj->getNombre();
        }
        
        return $tipoOptions;
    }

    /**
     * TODO: Pasar este metodo a EstadoController
     * @param string $tableName
     * @return \Estado
     * @throws Exception
     */
    public function getEstados(string $tableName)
    {
        if(!is_string($tableName) or "" == $tableName){
            throw new Exception('[ERROR] El nombre de la tabla tiene que ser un string distinto de ""');
        }
        $sql = "SELECT estados.idEstado, estados.nombre FROM estado_tabla_ref INNER JOIN estados USING(idEstado)";
        $filtros = [['tabla', $tableName], ['idEstado', 1, '>']];
        $estadoList = [];
        foreach($this->query($sql, $filtros) as $estado){
            $estadoList[] = new Estado($estado->idEstado, $estado->nombre);
        }

        return $estadoList;
        
    }
    
    /**
     * TODO: cambiar a la clase formHandler
     * @param string $tableName
     * @return type
     */
    public function getEstadosForForm(string $tableName)
    {
        $estadosList = $this->getEstados($tableName);
        $estadoOptions = [];
        foreach ($estadosList as $estadoObj){
            $estadoOptions[$estadoObj->getIdEstado()] = $estadoObj->getNombre();
        }
        
        return $estadoOptions;
    }
    
    /**
     * TODO: cambiar a la clase formHandler
     * @return type
     */
    public function getTipoFacturacionForForm()
    {
        $tipoFacturacionC = new TipoFacturacionController;
        $tipos = $tipoFacturacionC->select();
        $tiposOptions = [];
        foreach ($tipos as $tipo){
            $tiposOptions[$tipo->getIdTipoFacturacion()] = $tipo->getNombre();
        }
        
        return $tiposOptions;
    }

    public static function generar_calendario($month, $year, $holidays = null, $lang = "es")
    { 
        $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';
     
        if($lang=='en'){
            $headings = array('M','T','W','T','F','S','S');
        }
        if($lang=='es'){
            $headings = array('L','M','M','J','V','S','D');
        }
        if($lang=='ca'){
            $headings = array('DI','Dm','Dc','Dj','Dv','Ds','Dg');
        }
         
        $calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings)."</td></tr>\n";
     
        $running_day = date('w',mktime(0,0,0,$month,1,$year));
        $current_day = date('d');
        $running_day = ($running_day > 0) ? $running_day-1 : $running_day;
        $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
        $days_in_this_week = 1;
        $day_counter = 0;
        $dates_array = array();
     
        $calendar.= '<tr class="calendar-row">';
     
        for($x = 0; $x < $running_day; $x++):
            $calendar.= '<td class="calendar-day-np"> </td>';
            $days_in_this_week++;
        endfor;
     
        for($list_day = 1; $list_day <= $days_in_month; $list_day++):
            $calendar.= '<td class="calendar-day">';
             
            $class="day-number ";
            if($running_day == 0 || $running_day == 6 ){
                $class.=" not-work ";
            }
             
            $key_month_day = "month_{$month}_day_{$list_day}";
            
            if($holidays != null && is_array($holidays)){
                //var_dump($key_month_day);
                $month_key = array_search($key_month_day, $holidays);
                
                if(is_numeric($month_key)){
                    $class.=" not-work-holiday ";
                }
            }

            $precio = "";
            $dateToCompare = date('Y-m-d', mktime(0,0,0,$month, $list_day, $year));
            if(isset($holidays[$dateToCompare])){
                $precio = Util::moneda($holidays[$dateToCompare]);
            }

            if($current_day == $list_day){
                $class .= ' current_day';
            }
            
            //var_dump($class);
            $calendar.= "<div class='{$class}'>{$list_day} {$precio}</div>";
                 
            $calendar.= '</td>';
            if($running_day == 6):
                $calendar.= "</tr>\n";
                if(($day_counter+1) != $days_in_month):
                    $calendar.= '<tr class="calendar-row">';
                endif;
                $running_day = -1;
                $days_in_this_week = 0;
            endif;
            $days_in_this_week++; $running_day++; $day_counter++;
        endfor;
     
        if($days_in_this_week < 8):
            for($x = 1; $x <= (8 - $days_in_this_week); $x++):
                $calendar.= '<td class="calendar-day-np"> </td>';
            endfor;
        endif;
     
        $calendar.= "</tr>\n";
     
        $calendar.= '</table>';
         
        return $calendar;
    }


    public static function diasCalendario($month=null, $year=null, $holidays=[], $url="", $lang="es")
    {
        date_default_timezone_set("Europe/Madrid");
        setlocale(LC_TIME, "spanish");
        $anio_actual = $year ?? date("Y");
        $mes_actual = $month ?? date("n");
        $dia_actual = date('d');
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

    public static function mostratFechaEspanol($dateString = "")
    {
        $dias = ["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","S&aacute;bado"]; 
        $meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
        $date = strtotime($dateString);
        $fecha = ($dias[date('w', $date)]." ".date('d', $date)." de ".$meses[date('n', $date)-1 ]. " del ".date("Y", $date));
        return $fecha;
    }

    public static function calendario($month=null, $year=null, $holidays=[], $url="", $lang="es")
    {
        $fechaTexto = UtilController::MostratFechaEspanol(date('d-m-Y'));
        $diasCalendario = UtilController::diasCalendario($month, $year , $holidays, $url, $lang);
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
     * TODO: crear clase Modelo/Lister que contenga esta logica
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
     * TODO: pasar este metodo al modelo o al controlador de Base
     * Combierte una lista de objetos a formato json, la lista
     * estará compuesta por los parametros pasados en $paramList
     * @param array $objList
     * @param array $paramList
     * @return string json
     */
    public static function objListToJsonList($objList = [], $paramList = [])
    {
        $data = [];
        foreach ($objList as $obj){
            $objRecord = [];
            foreach($paramList as $param){
                $getMethod = "get".ucfirst($param);
                $value = method_exists($obj, $getMethod) ? $obj->$getMethod() : null;
                $objRecord[$param] = is_object($value) ? $value->__toString() : $value;
            }    
            $data[self::LIST_DATA][] = $objRecord;
        }

        return json_encode($data);
    }
    
    /**
     * TODO: meter en Modelo/Form y quitar el acoplamiento con ImgHandler
     * @param ModelBase $obj
     * @return \ModelBase
     */
    public function setObjFromPost(ModelBase $obj)
    {
        $obj->setAllParams($_POST);
        if(isset($_FILES['imagen'])){
            $imgHandler = new ImgHandler($_FILES['imagen']);
            $nombreImagenFinal = $imgHandler->uploadImageIfExist($obj->getSlug());
            if(!is_null($nombreImagenFinal)){
                $obj->setImagen($nombreImagenFinal);
            }
        }
               
        return $obj;
    }
}
