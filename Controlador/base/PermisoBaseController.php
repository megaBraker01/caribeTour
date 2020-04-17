<?php

abstract class PermisoBaseController extends BaseController {



    public function insert(Permiso $Permiso): int {
        try{
            $sql = "INSERT INTO permisos (nombre) 
            VALUES (:nombre);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":nombre", $Permiso->getNombre());

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

    public function update(Permiso $Permiso): int {
        try{
            $sql = "UPDATE permisos SET nombre = :nombre WHERE idPermiso = :idPermiso LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idPermiso", $Permiso->getIdPermiso());
$statement->bindValue(":nombre", $Permiso->getNombre());

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
            $sql = "SELECT idPermiso, nombre 
            FROM permisos";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
            
            if(!empty($rows)){
                foreach($rows as $row){
                    $ret[] = new Permiso($row->idPermiso, $row->nombre);
                }
            }
            
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }

    public function deleteByIds(array $ids = []): int {
        try{
            if(!isset($ids['idPermiso'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM permisos";
            $sql .= " WHERE idPermiso = :idPermiso LIMIT 1;";
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