<?php

abstract class ClientePasajeroReservaRefBaseController extends BaseController {



    public function insert(ClientePasajeroReservaRef $ClientePasajeroReservaRef): int {
        try{
            $sql = "INSERT INTO cliente_pasajero_reserva_ref (idCliente, idPasajero, idReserva) 
            VALUES (:idCliente, :idPasajero, :idReserva);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idCliente", $ClientePasajeroReservaRef->getIdCliente());
$statement->bindValue(":idPasajero", $ClientePasajeroReservaRef->getIdPasajero());
$statement->bindValue(":idReserva", $ClientePasajeroReservaRef->getIdReserva());

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

    public function update(ClientePasajeroReservaRef $ClientePasajeroReservaRef): int {
        try{
            $sql = "UPDATE cliente_pasajero_reserva_ref SET idCliente = :idCliente, idPasajero = :idPasajero, idReserva = :idReserva WHERE idCliente = :idCliente AND idPasajero = :idPasajero AND idReserva = :idReserva LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idCliente", $ClientePasajeroReservaRef->getIdCliente());
$statement->bindValue(":idPasajero", $ClientePasajeroReservaRef->getIdPasajero());
$statement->bindValue(":idReserva", $ClientePasajeroReservaRef->getIdReserva());

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
            FROM cliente_pasajero_reserva_ref";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
            
            if(!empty($rows)){
                foreach($rows as $row){
                    $ret[] = new ClientePasajeroReservaRef($row->idCliente, $row->idPasajero, $row->idReserva);
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
            $sql = "DELETE FROM cliente_pasajero_reserva_ref";
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