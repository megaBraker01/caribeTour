<?php

require_once 'AutoLoader/AutoLoader.php';

abstract class ProductofecharefBaseController extends baseController {



    public function insert(Productofecharef $Productofecharef): int {
        try{
            $sql = "INSERT INTO productofecharef (idProducto, idFechaSalida, idFechaVuelta, precioProveedor, comision) 
            VALUES (:idProducto, :idFechaSalida, :idFechaVuelta, :precioProveedor, :comision);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idProducto", $Productofecharef->getIdProducto());
$statement->bindValue(":idFechaSalida", $Productofecharef->getIdFechaSalida());
$statement->bindValue(":idFechaVuelta", $Productofecharef->getIdFechaVuelta());
$statement->bindValue(":precioProveedor", $Productofecharef->getPrecioProveedor());
$statement->bindValue(":comision", $Productofecharef->getComision());

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

    public function update(Productofecharef $Productofecharef): int {
        try{
            $sql = "UPDATE productofecharef SET idProducto = :idProducto, idFechaSalida = :idFechaSalida, idFechaVuelta = :idFechaVuelta, precioProveedor = :precioProveedor, comision = :comision WHERE idProductoFechaRef = :idProductoFechaRef LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idProductoFechaRef", $Productofecharef->getIdProductoFechaRef());
$statement->bindValue(":idProducto", $Productofecharef->getIdProducto());
$statement->bindValue(":idFechaSalida", $Productofecharef->getIdFechaSalida());
$statement->bindValue(":idFechaVuelta", $Productofecharef->getIdFechaVuelta());
$statement->bindValue(":precioProveedor", $Productofecharef->getPrecioProveedor());
$statement->bindValue(":comision", $Productofecharef->getComision());

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
            FROM productofecharef
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
                    $ret[] = new Productofecharef($row->idProductoFechaRef, $row->idProducto, $row->idFechaSalida, $row->idFechaVuelta, $row->precioProveedor, $row->comision);
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
            $sql = "DELETE FROM productofecharef";
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