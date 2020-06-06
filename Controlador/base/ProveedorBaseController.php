<?php

abstract class ProveedorBaseController extends BaseController {



    public function insert(Proveedor $Proveedor): int {
        try{
            $sql = "INSERT INTO proveedores (nombre, NIF, direccion, idEstado) 
            VALUES (:nombre, :NIF, :direccion, :idEstado);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":nombre", $Proveedor->getNombre());
$statement->bindValue(":NIF", $Proveedor->getNIF());
$statement->bindValue(":direccion", $Proveedor->getDireccion());
$statement->bindValue(":idEstado", $Proveedor->getIdEstado());

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

    public function update(Proveedor $Proveedor): int {
        try{
            $sql = "UPDATE proveedores SET nombre = :nombre, NIF = :NIF, direccion = :direccion, idEstado = :idEstado WHERE idProveedor = :idProveedor LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idProveedor", $Proveedor->getIdProveedor());
$statement->bindValue(":nombre", $Proveedor->getNombre());
$statement->bindValue(":NIF", $Proveedor->getNIF());
$statement->bindValue(":direccion", $Proveedor->getDireccion());
$statement->bindValue(":idEstado", $Proveedor->getIdEstado());

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
            $sql = "SELECT idProveedor, nombre, NIF, direccion, idEstado, fechaAlta, fechaUpdate 
            FROM proveedores";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
            
            if(!empty($rows)){
                foreach($rows as $row){
                    $ret[] = new Proveedor($row->idProveedor, $row->nombre, $row->NIF, $row->direccion, $row->idEstado, $row->fechaAlta, $row->fechaUpdate);
                }
            }
            
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }

    public function deleteByIds(array $ids = []): int {
        try{
            if(!isset($ids['idProveedor'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM proveedores";
            $sql .= " WHERE idProveedor = :idProveedor LIMIT 1;";
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