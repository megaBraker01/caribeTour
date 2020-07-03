<?php

abstract class EstadoTablaRefBaseController extends BaseController {



    public function insert(EstadoTablaRef $EstadoTablaRef): int {
        try{
            $sql = "INSERT INTO estado_tabla_ref (idEstado, tabla) 
            VALUES (:idEstado, :tabla);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idEstado", $EstadoTablaRef->getIdEstado());
$statement->bindValue(":tabla", $EstadoTablaRef->getTabla());

            $ret = 0;
            if($statement->execute()){
                $ret = $conexion->pdo()->lastInsertId();
                $conexion = NULL;
                $statement->closeCursor();
            }
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }

    public function update(EstadoTablaRef $EstadoTablaRef): int {
        try{
            $sql = "UPDATE estado_tabla_ref SET idEstado = :idEstado, tabla = :tabla WHERE idEstado = :idEstado AND tabla = :tabla LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idEstado", $EstadoTablaRef->getIdEstado());
$statement->bindValue(":tabla", $EstadoTablaRef->getTabla());

            $ret = 0;
            if($statement->execute()){
                $ret = $statement->rowCount();
                $conexion = NULL;
                $statement->closeCursor();
            }
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }

    public function select(array $filtros = [], array $ordenados = [], array $limitar = [], array $agrupar = []): array {
        try{
            $sql = "SELECT idEstado, tabla 
            FROM estado_tabla_ref";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
            
            if(!empty($rows)){
                foreach($rows as $row){
                    $ret[] = new EstadoTablaRef($row->idEstado, $row->tabla);
                }
            }
            
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }

    public function deleteByIds(array $ids = []): int {
        try{
            if(!isset($ids['idEstado']) or !isset($ids['tabla'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM estado_tabla_ref";
            $sql .= " WHERE idEstado = :idEstado AND tabla = :tabla LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            
            foreach($ids as $key => $value){
                $statement->bindValue(":{$key}", $value);
            }
            
            $ret = 0;
            if($statement->execute()){
                $ret = $statement->rowCount();
                $conexion = NULL;
                $statement->closeCursor();
            }
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }
}