<?php

abstract class TipoFacturacionBaseController extends BaseController {



    public function insert(TipoFacturacion $TipoFacturacion): int {
        try{
            $sql = "INSERT INTO tipo_facturacion (nombre) 
            VALUES (:nombre);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":nombre", $TipoFacturacion->getNombre());

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

    public function update(TipoFacturacion $TipoFacturacion): int {
        try{
            $sql = "UPDATE tipo_facturacion SET nombre = :nombre WHERE idTipoFacturacion = :idTipoFacturacion LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idTipoFacturacion", $TipoFacturacion->getIdTipoFacturacion());
$statement->bindValue(":nombre", $TipoFacturacion->getNombre());

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
            $sql = "SELECT idTipoFacturacion, nombre 
            FROM tipo_facturacion";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
            
            if(!empty($rows)){
                foreach($rows as $row){
                    $ret[] = new TipoFacturacion($row->idTipoFacturacion, $row->nombre);
                }
            }
            
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }

    public function deleteByIds(array $ids = []): int {
        try{
            if(!isset($ids['idTipoFacturacion'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM tipo_facturacion";
            $sql .= " WHERE idTipoFacturacion = :idTipoFacturacion LIMIT 1;";
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