<?php

abstract class TipoTablaRefBaseController extends BaseController {



    public function insert(TipoTablaRef $TipoTablaRef): int {
        try{
            $sql = "INSERT INTO tipo_tabla_ref (idTipo, tabla) 
            VALUES (:idTipo, :tabla);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idTipo", $TipoTablaRef->getIdTipo());
$statement->bindValue(":tabla", $TipoTablaRef->getTabla());

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

    public function update(TipoTablaRef $TipoTablaRef): int {
        try{
            $sql = "UPDATE tipo_tabla_ref SET idTipo = :idTipo, tabla = :tabla WHERE idTipo = :idTipo AND tabla = :tabla LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idTipo", $TipoTablaRef->getIdTipo());
$statement->bindValue(":tabla", $TipoTablaRef->getTabla());

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
            $sql = "SELECT idTipo, tabla 
            FROM tipo_tabla_ref";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
            
            if(!empty($rows)){
                foreach($rows as $row){
                    $ret[] = new TipoTablaRef($row->idTipo, $row->tabla);
                }
            }
            
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }

    public function deleteByIds(array $ids = []): int {
        try{
            if(!isset($ids['idTipo']) or !isset($ids['tabla'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM tipo_tabla_ref";
            $sql .= " WHERE idTipo = :idTipo AND tabla = :tabla LIMIT 1;";
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