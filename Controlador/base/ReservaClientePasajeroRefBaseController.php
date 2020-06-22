<?php

abstract class ReservaClientePasajeroRefBaseController extends BaseController {



    public function insert(ReservaClientePasajeroRef $ReservaClientePasajeroRef): int {
        try{
            $sql = "INSERT INTO reserva_cliente_pasajero_ref (idCliente, idPasajero, idReserva) 
            VALUES (:idCliente, :idPasajero, :idReserva);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idCliente", $ReservaClientePasajeroRef->getIdCliente());
$statement->bindValue(":idPasajero", $ReservaClientePasajeroRef->getIdPasajero());
$statement->bindValue(":idReserva", $ReservaClientePasajeroRef->getIdReserva());

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

    public function update(ReservaClientePasajeroRef $ReservaClientePasajeroRef): int {
        try{
            $sql = "UPDATE reserva_cliente_pasajero_ref SET idCliente = :idCliente, idPasajero = :idPasajero, idReserva = :idReserva WHERE idCliente = :idCliente AND idPasajero = :idPasajero AND idReserva = :idReserva LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idCliente", $ReservaClientePasajeroRef->getIdCliente());
$statement->bindValue(":idPasajero", $ReservaClientePasajeroRef->getIdPasajero());
$statement->bindValue(":idReserva", $ReservaClientePasajeroRef->getIdReserva());

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
            $sql = "SELECT idCliente, idPasajero, idReserva 
            FROM reserva_cliente_pasajero_ref";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
            
            if(!empty($rows)){
                foreach($rows as $row){
                    $ret[] = new ReservaClientePasajeroRef($row->idCliente, $row->idPasajero, $row->idReserva);
                }
            }
            
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }

    public function deleteByIds(array $ids = []): int {
        try{
            if(!isset($ids['idCliente']) or !isset($ids['idPasajero']) or !isset($ids['idReserva'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM reserva_cliente_pasajero_ref";
            $sql .= " WHERE idCliente = :idCliente AND idPasajero = :idPasajero AND idReserva = :idReserva LIMIT 1;";
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