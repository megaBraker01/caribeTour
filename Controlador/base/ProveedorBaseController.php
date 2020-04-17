<?php

abstract class ProveedorBaseController extends BaseController {



    public function insert(Proveedor $Proveedor): int {
        try{
            $sql = "INSERT INTO proveedores (nombre, contacto, telefono, NIF, web, email, direccion, idEstado) 
            VALUES (:nombre, :contacto, :telefono, :NIF, :web, :email, :direccion, :idEstado);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":nombre", $Proveedor->getNombre());
$statement->bindValue(":contacto", $Proveedor->getContacto());
$statement->bindValue(":telefono", $Proveedor->getTelefono());
$statement->bindValue(":NIF", $Proveedor->getNIF());
$statement->bindValue(":web", $Proveedor->getWeb());
$statement->bindValue(":email", $Proveedor->getEmail());
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
            $sql = "UPDATE proveedores SET nombre = :nombre, contacto = :contacto, telefono = :telefono, NIF = :NIF, web = :web, email = :email, direccion = :direccion, idEstado = :idEstado WHERE idProveedor = :idProveedor LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idProveedor", $Proveedor->getIdProveedor());
$statement->bindValue(":nombre", $Proveedor->getNombre());
$statement->bindValue(":contacto", $Proveedor->getContacto());
$statement->bindValue(":telefono", $Proveedor->getTelefono());
$statement->bindValue(":NIF", $Proveedor->getNIF());
$statement->bindValue(":web", $Proveedor->getWeb());
$statement->bindValue(":email", $Proveedor->getEmail());
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
            $sql = "SELECT idProveedor, nombre, contacto, telefono, NIF, web, email, direccion, idEstado, fechaAlta, fehaUpdate 
            FROM proveedores";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
            
            if(!empty($rows)){
                foreach($rows as $row){
                    $ret[] = new Proveedor($row->idProveedor, $row->nombre, $row->contacto, $row->telefono, $row->NIF, $row->web, $row->email, $row->direccion, $row->idEstado, $row->fechaAlta, $row->fehaUpdate);
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