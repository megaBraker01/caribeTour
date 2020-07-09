<?php

class EstadoController extends EstadoBaseController {
    
    /**
     * 
     * @param string $tableName
     * @return \Estado
     * @throws Exception
     */
    public function getEstadosByTableName(string $tableName)
    {
        if(!is_string($tableName) or "" == $tableName){
            throw new Exception('[ERROR] El nombre de la tabla tiene que ser un string distinto de ""');
        }
        
        $estadotrC = new EstadoTablaRefController;
        $estadotrList = $estadotrC->select([['tabla', $tableName]]);
        $estadoList = [];
        foreach ($estadotrList as $estadotr){
            $estadoList[] = $estadotr->getEstado();
        }

        return $estadoList;
        
    }
}