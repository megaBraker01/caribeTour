<?php


abstract class BaseController {

   protected $parameters = [];

    /**
     * pasamos los parametros para condicionar el WHERE de la consulta
     * el aparametro debe de ser un array de arrays, cada array elemento tiene que ser de la forma:
     * ['campo_a_comparar', 'sigo_comparacion', 'valor_a_comparar', (opcional 'and | or')]
     * ejemplo: $filters = [['idEstado', '=', 1], ['idTipo', '!=', 3, 'or'], ['marNombre', 'like', 'merce'], ['idBlog', 'in', '1, 5, 8']];
     * @param array $filters
     * @return string
     */
    protected function filterSqlPrepare(array $filters): string {
        $sql = "";
        if(!empty($filters)){
            $sql .= " WHERE TRUE";
            $i = 1;
            $p = 'p';
            foreach($filters as $filter){
            	$field = $filter[0];
            	$comparator = strtoupper(trim($filter[1]));
            	$value = "LIKE" == $comparator ? "%{$filter[2]}%" : $filter[2];
                $united = (isset($filter[3]) && is_string($filter[3])) ? strtoupper($filter[3]) : 'AND';
                
                if('IN' == $comparator) {
                    $values = explode(", ", $value);
                    $paramIN = [];
                    foreach($values as $val){
                        $binParam = $p.$i;
                        $paramIN[]= ":{$binParam}";
                        $this->parameters[$binParam] = $val;
                        $i++;
                    }
                    $finalParam = implode(", ", $paramIN);
                    $sql .= " $united {$field} {$comparator} ({$finalParam})";
                		
                } else {
                    $binParam = $p.$i;
                    $sql .= " $united {$field} {$comparator} :{$binParam}";
                    $this->parameters[$binParam] = $value;
                }
                $i++;
            }
        }
        return $sql;
    }

    /**
     * Preparamos para agrupar la consulta por los campos indicados
     * ejemplo: $groupList = ['idCategoria', 'precio'];
     * @param array $groupList
     * @return string
     */
    protected function groupSqlPrepare(array $groupList){
        $ret = "";
        if(!empty($groupList)){
            $ret .=" GROUP BY ".implode(', ', $groupList);
        }
        return $ret;
    }

    /**
     * preparamos para ordenas la consulta
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

    /**
     * preparamos para limitar la consulta
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


    /**
     * Para realizar querys personalizadas
     * @param string $sql
     * @param array $filtros
     * @param array $ordenados
     * @param array $limitar
     * @param array $agrupar
     * @return array
     */
    protected function query(string $sql, array $filtros = [], array $ordenados = [], array $limitar = [], array $agrupar = []): array {
        try{
            $sql .= $this->filterSqlPrepare($filtros);
            $sql .= $this->groupSqlPrepare($agrupar);
            $sql .= $this->orderSqlPrepare($ordenados);
            $sql .= $this->limitSqlPrepare($limitar);
            //var_dump($sql);
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            
            foreach($this->parameters as $key => $val){
		$statement->bindValue($key, $val);
            }
                        
            $ret = [];
            if($statement->execute() and $statement->rowCount() > 0){
                $ret = $statement->fetchAll(PDO::FETCH_OBJ);
            }
            
            $conexion = NULL;
            $statement->closeCursor();
            
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }
}