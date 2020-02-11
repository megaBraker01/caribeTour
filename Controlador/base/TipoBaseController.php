<?php

abstract class TipoBaseController extends BaseController {



    public function insert(Tipo $Tipo): int {
        try{
            $sql = "INSERT INTO tipos (nombre, productos, contactos, pagos) 
            VALUES (:nombre, :productos, :contactos, :pagos);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":nombre", $Tipo->getNombre());
$statement->bindValue(":productos", $Tipo->getProductos());
$statement->bindValue(":contactos", $Tipo->getContactos());
$statement->bindValue(":pagos", $Tipo->getPagos());

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

    public function update(Tipo $Tipo): int {
        try{
            $sql = "UPDATE tipos SET nombre = :nombre, productos = :productos, contactos = :contactos, pagos = :pagos WHERE idTipo = :idTipo LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idTipo", $Tipo->getIdTipo());
$statement->bindValue(":nombre", $Tipo->getNombre());
$statement->bindValue(":productos", $Tipo->getProductos());
$statement->bindValue(":contactos", $Tipo->getContactos());
$statement->bindValue(":pagos", $Tipo->getPagos());

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

    public function select(array $filtros = [], array $ordenados = [], array $limitar = []): array {
        try{
            $sql = "SELECT idTipo, nombre, productos, contactos, pagos 
            FROM tipos";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar);
            
            if(count($rows) > 0){
                foreach($rows as $row){
                    $ret[] = new Tipo($row->idTipo, $row->nombre, $row->productos, $row->contactos, $row->pagos);
                }
            }
            
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }

    public function deleteByIds(array $ids = []): int {
        try{
            if(!isset($ids['idTipo'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM tipos";
            $sql .= " WHERE idTipo = :idTipo LIMIT 1;";
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