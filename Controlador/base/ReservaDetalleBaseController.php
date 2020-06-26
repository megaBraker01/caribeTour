<?php

abstract class ReservaDetalleBaseController extends BaseController {



    public function insert(ReservaDetalle $ReservaDetalle): int {
        try{
            $sql = "INSERT INTO reserva_detalles (idReserva, idProducto, idProductoFechaRef, idTipoFacturacion, precioProveedor, comision) 
            VALUES (:idReserva, :idProducto, :idProductoFechaRef, :idTipoFacturacion, :precioProveedor, :comision);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idReserva", $ReservaDetalle->getIdReserva());
$statement->bindValue(":idProducto", $ReservaDetalle->getIdProducto());
$statement->bindValue(":idProductoFechaRef", $ReservaDetalle->getIdProductoFechaRef());
$statement->bindValue(":idTipoFacturacion", $ReservaDetalle->getIdTipoFacturacion());
$statement->bindValue(":precioProveedor", $ReservaDetalle->getPrecioProveedor());
$statement->bindValue(":comision", $ReservaDetalle->getComision());

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

    public function update(ReservaDetalle $ReservaDetalle): int {
        try{
            $sql = "UPDATE reserva_detalles SET idReserva = :idReserva, idProducto = :idProducto, idProductoFechaRef = :idProductoFechaRef, idTipoFacturacion = :idTipoFacturacion, precioProveedor = :precioProveedor, comision = :comision WHERE idReserva = :idReserva AND idProducto = :idProducto LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idReserva", $ReservaDetalle->getIdReserva());
$statement->bindValue(":idProducto", $ReservaDetalle->getIdProducto());
$statement->bindValue(":idProductoFechaRef", $ReservaDetalle->getIdProductoFechaRef());
$statement->bindValue(":idTipoFacturacion", $ReservaDetalle->getIdTipoFacturacion());
$statement->bindValue(":precioProveedor", $ReservaDetalle->getPrecioProveedor());
$statement->bindValue(":comision", $ReservaDetalle->getComision());

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
            $sql = "SELECT idReserva, idProducto, idProductoFechaRef, idTipoFacturacion, precioProveedor, comision, fechaAlta, fechaUpdate 
            FROM reserva_detalles";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
            
            if(!empty($rows)){
                foreach($rows as $row){
                    $ret[] = new ReservaDetalle($row->idReserva, $row->idProducto, $row->idProductoFechaRef, $row->idTipoFacturacion, $row->precioProveedor, $row->comision, $row->fechaAlta, $row->fechaUpdate);
                }
            }
            
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }

    public function deleteByIds(array $ids = []): int {
        try{
            if(!isset($ids['idReserva']) or !isset($ids['idProducto'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM reserva_detalles";
            $sql .= " WHERE idReserva = :idReserva AND idProducto = :idProducto LIMIT 1;";
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