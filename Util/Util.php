<?php

class Util extends BaseController {
    
    const _TEXT = 'text';
    const _INT = 'int';
    const _DOUBLE = 'double';


    public function sanear($value, $type = self::_TEXT): string
    {
        $remplazar = array("\n\r");
	    $por = " ";
        $ret = htmlentities($value, ENT_COMPAT, 'iso-8859-1');
        $pattern = "/[^A-Za-z0-9-=+_@,;&.\/\s\ ]/";
        
        switch (strtolower($type)){
            case self::_TEXT :
                $ret = preg_replace($pattern, $por, $ret);
                break;
            case self::_INT :
                $pattern = "/[^0-9-]/";
                $ret = preg_replace($pattern, $por, $ret);
                break;
            case self::_DOUBLE :
                $pattern = "/[^0-9-,.]/";
                $ret = preg_replace($pattern, $por, $ret);
                break;
            default :
                $ret = preg_replace($pattern, $por, $ret);
                break;
        }
        
        return str_replace($remplazar, $por, $ret);
    }
    

    public function getProductoFechaRefPDO(array $filtros = [], array $ordenados = [], array $limitar = [], array $agrupar = []): array
    {
        $sql = "SELECT * FROM v_producto_fecha_ref";
        $ret = [];
        $rows = $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
        foreach($rows as $row){
            $ret[] = new ProductoFechaDTO($row->idProductoFechaRef, $row->idProducto, $row->idFechaSalida, $row->precioProveedor, $row->comision, $row->producto, $row->idCategoria, $row->categoria, $row->idCategoriaPadre, $row->catPadre, $row->fsalida, $row->terminalSalida, $row->terminalDestino, $row->tasasSalida, $row->tasasDestino, $row->idFechaVuelta, $row->fvuelta, $row->terminalSalidaV, $row->terminalDestinoV, $row->tasasSalidaV, $row->tasasDestinoV);
        }
        return $ret;
    }
    
    public function getProductoById(int $idProducto)
    {
        if(!is_int($idProducto) or $idProducto < 1){
            throw new Exception('[ERROR] El idProducto tiene que ser un entero mayor a cero (0)');
        }
        $producto = null;
        $productoC = new ProductoController;
        $filtros = [['idProducto', '=', $idProducto]];
        $productoList = $productoC->select($filtros);
        if(isset($productoList[0])){
            $producto = $productoList[0];
        }
        return $producto;
    }
    
    public function getProductoBySlug(string $slug)
    {
        if(!is_string($slug) or "" == $slug){
            throw new Exception('[ERROR] El slug tiene que ser un string distinto de ""');
        }
        $slug = strtolower($slug);
        $producto = null;
        $productoC = new ProductoController;
        $filtros = [['slug', '=', $slug]];
        $productoList = $productoC->select($filtros);
        if(isset($productoList[0])){
            $producto = $productoList[0];
        }
        return $producto;
    }
    
    public function getCategoriaById(int $idCategoria)
    {
        if(!is_int($idCategoria) or $idCategoria < 1){
            throw new Exception('[ERROR] El idProducto tiene que ser un entero mayor a cero (0)');
        }
        $categoria = null;
        $categoriaC = new CategoriaController;
        $filtros = [['idCategoria', '=', $idCategoria]];
        $categoriaList = $categoriaC->select($filtros);
        if(isset($categoriaList[0])){
            $categoria = $categoriaList[0];
        }
        return $categoria;
    }
    
    public function getCategoriaBySlug(string $slug)
    {
        if(!is_string($slug) or "" == $slug){
            throw new Exception('[ERROR] El slug tiene que ser un string distinto de ""');
        }
        $slug = strtolower($slug);
        $categoria = null;
        $categoriaC = new CategoriaController;
        $filtros = [['slug', '=', $slug]];
        $categoriaList = $categoriaC->select($filtros);
        if(isset($categoriaList[0])){
            $categoria = $categoriaList[0];
        }
        return $categoria;
    }
    
    public function getBlogsPopulares(): array
    {
        $sql = "SELECT idBlog, count(idBlogComentario) AS comentarios FROM  blog_comentarios bc GROUP BY idBlog ORDER by comentarios desc";
        $rows = $this->query($sql);
        $Ids = [];
        foreach($rows as $row){
            $Ids[] = $row->idBlog;
        }
        $blogsIds = implode(", ", $Ids);
        $filtro = [['idBlog', 'in', $blogsIds]];
        $blogC = new BlogController;
        $blogList = $blogC->select($filtro);
        return $blogList;
    }
    
    public function getGaleriaBlog(array $filtros = [], array $ordenados = [], array $limitar = [], array $agrupar = []): array
    {
        $ordenados[] = ['RAND()'];
        $limitar[] = 8;
        $sql = "SELECT i.idImagen, i.srcImagen, i.idProducto, p.nombre, p.slug FROM imagenes i INNER JOIN productos p ON i.idProducto = p.idproducto";
        return $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
        
    }


    public static function moneda($numberToCombert = 0, $decimal = 2, $sing = "e"){
        switch(strtolower($sing)){
            case 'e': $symbol = "&euro;";
                break;
            case 'd': $symbol = "&dollar;";
                break;
            case 'p': $symbol = "&&pound;;";
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


    public static function generar_calendario($month, $year, $holidays = null, $lang = "es"){
 
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


    public static function diasCalendario($month = null, $year = null, $holidays = [], $lang = "es"){
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
        $url = $_SERVER['REDIRECT_URL'];
        for($i = 1; $i <= $numero_dias; $i++){
            if($i <= $iniciomes){
                $ret .= '<td></td>';
            } else {
                $dia = $i-$iniciomes;
                $precio = $dayClass = $showPrecio = "";
                if($dia == $dia_actual){
                    $dayClass = " class='calendar-current-day'";
                }
                $dateToCompare = date('Y-m-d', mktime(0,0,0,$month, $dia, $year));
                if(isset($holidays[$dateToCompare])){
                    $precio = Util::moneda($holidays[$dateToCompare]);
                    $showPrecio = "<div class='calendar-price'><a href='{$url}?fecha={$i}'>{$precio}</a></div>";
                }
                
                $ret .=  "<td{$dayClass}>{$dia} {$showPrecio}</td>";
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

    public static function calendario($month = null, $year = null, $holidays = [], $lang = "es"){
        $fechaTexto = Util::MostratFechaEspanol(date('d-m-Y'));
        $diasCalendario = Util::diasCalendario($month, $year , $holidays, $lang);
        $ret ="<table>
                 <thead>
                     <tr>
                         <th><a href='' title='Ver el mes anterior'>&lt; &lt;--</a></th><th colspan='5'> {$fechaTexto} </th><th><a href='' title='Ver el mes anterior'>--&gt; &gt;</a></th>
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
}
