<?php

abstract class PuertoBaseController extends BaseController {



    public function insert(Puerto $Puerto): int {
        try{
            $sql = "INSERT INTO puertos (nombre, codigo, idTipo) 
            VALUES (:nombre, :codigo, :idTipo);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":nombre", $Puerto->getNombre());
$statement->bindValue(":codigo", $Puerto->getCodigo());
$statement->bindValue(":idTipo", $Puerto->getIdTipo());

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

    public function update(Puerto $Puerto): int {
        try{
            $sql = "UPDATE puertos SET nombre = :nombre, codigo = :codigo, idTipo = :idTipo WHERE idPuerto = :idPuerto LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idPuerto", $Puerto->getIdPuerto());
$statement->bindValue(":nombre", $Puerto->getNombre());
$statement->bindValue(":codigo", $Puerto->getCodigo());
$statement->bindValue(":idTipo", $Puerto->getIdTipo());

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
            $sql = "SELECT idPuerto, nombre, codigo, idTipo 
            FROM puertos";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
            
            if(!empty($rows)){
                foreach($rows as $row){
                    $ret[] = new Puerto($row->idPuerto, $row->nombre, $row->codigo, $row->idTipo);
                }
            }
            
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }

    public function deleteByIds(array $ids = []): int {
        try{
            if(!isset($ids['idPuerto'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM puertos";
            $sql .= " WHERE idPuerto = :idPuerto LIMIT 1;";
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