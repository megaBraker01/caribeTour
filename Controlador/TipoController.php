<?php

class TipoController extends TipoBaseController { 
    
    public function getTiposByTableName(string $tableName)
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
}