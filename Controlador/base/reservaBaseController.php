<?php

require_once 'AutoLoader/AutoLoader.php';

abstract class ReservaBaseController extends baseController {



    public function insert(Reserva $Reserva): int {
        try{
            $sql = "INSERT INTO reservas (idProductoFechaRef, idEstado, importe, fechaAlta) 
            VALUES (:idProductoFechaRef, :idEstado, :importe, :fechaAlta);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idProductoFechaRef", $Reserva->getIdProductoFechaRef());
$statement->bindValue(":idEstado", $Reserva->getIdEstado());
$statement->bindValue(":importe", $Reserva->getImporte());
$statement->bindValue(":fechaAlta", $Reserva->getFechaAlta());

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
            $sql = "UPDATE reservas SET idProductoFechaRef = :idProductoFechaRef, idEstado = :idEstado, importe = :importe, fechaAlta = :fechaAlta WHERE idReserva = :idReserva LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idReserva", $Reserva->getIdReserva());
$statement->bindValue(":idProductoFechaRef", $Reserva->getIdProductoFechaRef());
$statement->bindValue(":idEstado", $Reserva->getIdEstado());
$statement->bindValue(":importe", $Reserva->getImporte());
$statement->bindValue(":fechaAlta", $Reserva->getFechaAlta());

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
            $sql = "SELECT idReserva, idProductoFechaRef, idEstado, importe, fechaAlta 
            FROM reservas
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
                    $ret[] = new Reserva($row->idReserva, $row->idProductoFechaRef, $row->idEstado, $row->importe, $row->fechaAlta);
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