<?php

abstract class ProductoFechaRefBaseController extends baseController {



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
            FROM producto_fecha_ref
            WHERE TRUE";
            $sql .= $this->filterSqlPrepare($filtros);
            $sql .= $this->orderSqlPrepare($ordenados);
            $sql .= $this->limitSqlPrepare($limitar);
            
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            
            $i = 1;
            foreach($filtros as $filtro){
                if(strtolower($filtro[1]) == "like"){
                    $filtro[2] = "%{$filtro[2]}%";
                }
                $statement->bindValue(":p{$i}", $filtro[2]);
                $i++;
            }
            
            $ret = [];
            if($statement->execute() and $statement->rowCount() > 0){
                while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
                    $ret[] = new ProductoFechaRef($row->idProductoFechaRef, $row->idProducto, $row->idFechaSalida, $row->idFechaVuelta, $row->precioProveedor, $row->comision);
                }
                $conexion = NULL;
                $statement->closeCursor();
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