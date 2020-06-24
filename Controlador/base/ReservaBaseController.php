<?php

abstract class ReservaBaseController extends BaseController {



    public function insert(Reserva $Reserva): int {
        try{
            $sql = "INSERT INTO reservas (idProductoFechaRef, idEstado, idTipo, pvpTotal) 
            VALUES (:idProductoFechaRef, :idEstado, :idTipo, :pvpTotal);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idProductoFechaRef", $Reserva->getIdProductoFechaRef());
$statement->bindValue(":idEstado", $Reserva->getIdEstado());
$statement->bindValue(":idTipo", $Reserva->getIdTipo());
$statement->bindValue(":pvpTotal", $Reserva->getPvpTotal());

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

    public function update(Reserva $Reserva): int {
        try{
            $sql = "UPDATE reservas SET idProductoFechaRef = :idProductoFechaRef, idEstado = :idEstado, idTipo = :idTipo, pvpTotal = :pvpTotal WHERE idReserva = :idReserva LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idReserva", $Reserva->getIdReserva());
$statement->bindValue(":idProductoFechaRef", $Reserva->getIdProductoFechaRef());
$statement->bindValue(":idEstado", $Reserva->getIdEstado());
$statement->bindValue(":idTipo", $Reserva->getIdTipo());
$statement->bindValue(":pvpTotal", $Reserva->getPvpTotal());

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
            $sql = "SELECT idReserva, idProductoFechaRef, idEstado, idTipo, pvpTotal, fechaAlta 
            FROM reservas";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
            
            if(!empty($rows)){
                foreach($rows as $row){
                    $ret[] = new Reserva($row->idReserva, $row->idProductoFechaRef, $row->idEstado, $row->idTipo, $row->pvpTotal, $row->fechaAlta);
                }
            }
            
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }

    public function deleteByIds(array $ids = []): int {
        try{
            if(!isset($ids['idReserva'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM reservas";
            $sql .= " WHERE idReserva = :idReserva LIMIT 1;";
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