<?php


abstract class BaseController {


    /* pasamos los parametros para condicionar el WHERE de la consulta
    * el aparametro debe de ser un array de arrays, cada array elemento tiene que ser de la forma:
    * ['campo_a_comparar', 'sigo_comparacion', 'valor_a_comparar', (opcional 'and | or')]
    * ejemplo: $filters = [['idEstado', '=', 1], ['idTipo', '!=', 3, 'or'], ['marNombre', 'like', 'merce']];
    * @param array $filters
    * @return string    
    */
    protected function filterSqlPrepare(array $filters): string {
        $sql = '';
        if(!empty($filters)){
            $i = 1;
            foreach($filters as $filter){
                $united = (isset($filter[3]) && is_string($filter[3])) ? strtoupper($filter[3]) : 'AND';
                $param = 'p'.$i++;
                $filter[1] = strtoupper($filter[1]);
                $sql .= " $united {$filter[0]} {$filter[1]} :{$param}";
            }
        }
        return $sql;
    }

    /* preparamos para ordenas la consulta
    * ejemplo: $ordenados = [['idTipo', 'desc'], ['fechaAlta']];
    * @param array $orderList
    * @return string
    */
    protected function orderSqlPrepare(array $orderList): string {
       $ret = "";
       if(!empty($orderList)){
           $sql = [];
           foreach($orderList as $order){
               $sql[] = isset($order[1]) ? $order[0].' '.strtoupper($order[1]) : $order[0];
           }
           $ret .=" ORDER BY ".implode(', ', $sql);
       }
       return $ret;
    }

    /* preparamos para limitar la consulta
    * ejemplo: $limitar = [2, 5] o $limitar = [3];
    * @param array $limit
    * @return string
    */
    protected function limitSqlPrepare(array $limit): string {
        $sql = "";
        if(!empty($limit)){
            $sql .= " LIMIT ";
            $sql .= isset($limit[1]) ? $limit[0].", ".$limit[1] : $limit[0];            
        }
        return $sql;
    }

}