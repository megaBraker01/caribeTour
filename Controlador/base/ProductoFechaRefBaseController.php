<?php

abstract class ProductoFechaRefBaseController extends BaseController {



    public function insert(ProductoFechaRef $ProductoFechaRef): int {
        try{
            $sql = "INSERT INTO producto_fecha_ref (idProducto, idFechaSalida, idFechaVuelta, precioProveedor, comision) 
            VALUES (:idProducto, :idFechaSalida, :idFechaVuelta, :precioProveedor, :comision);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idProducto", $ProductoFechaRef->getIdProducto());
$statement->bindValue(":idFechaSalida", $ProductoFechaRef->getIdFechaSalida());
$statement->bindValue(":idFechaVuelta", $ProductoFechaRef->getIdFechaVuelta());
$statement->bindValue(":precioProveedor", $ProductoFechaRef->getPrecioProveedor());
$statement->bindValue(":comision", $ProductoFechaRef->getComision());

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

    public function update(ProductoFechaRef $ProductoFechaRef): int {
        try{
            $sql = "UPDATE producto_fecha_ref SET idProducto = :idProducto, idFechaSalida = :idFechaSalida, idFechaVuelta = :idFechaVuelta, precioProveedor = :precioProveedor, comision = :comision WHERE idProductoFechaRef = :idProductoFechaRef LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idProductoFechaRef", $ProductoFechaRef->getIdProductoFechaRef());
$statement->bindValue(":idProducto", $ProductoFechaRef->getIdProducto());
$statement->bindValue(":idFechaSalida", $ProductoFechaRef->getIdFechaSalida());
$statement->bindValue(":idFechaVuelta", $ProductoFechaRef->getIdFechaVuelta());
$statement->bindValue(":precioProveedor", $ProductoFechaRef->getPrecioProveedor());
$statement->bindValue(":comision", $ProductoFechaRef->getComision());

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
            $sql = "SELECT idProductoFechaRef, idProducto, idFechaSalida, idFechaVuelta, precioProveedor, comision 
            FROM producto_fecha_ref";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar);
            
            if(count($rows) > 0){
                foreach($rows as $row){
                    $ret[] = new ProductoFechaRef($row->idProductoFechaRef, $row->idProducto, $row->idFechaSalida, $row->idFechaVuelta, $row->precioProveedor, $row->comision);
                }
            }
            
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }

    public function deleteByIds(array $ids = []): int {
        try{
            if(!isset($ids['idProductoFechaRef'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM producto_fecha_ref";
            $sql .= " WHERE idProductoFechaRef = :idProductoFechaRef LIMIT 1;";
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