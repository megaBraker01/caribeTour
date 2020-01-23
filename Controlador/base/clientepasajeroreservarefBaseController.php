<?php

require_once 'AutoLoader/AutoLoader.php';

abstract class ClientepasajeroreservarefBaseController extends baseController {



    public function insert(Clientepasajeroreservaref $Clientepasajeroreservaref): int {
        try{
            $sql = "INSERT INTO clientepasajeroreservaref (idCliente, idPasajero, idReserva) 
            VALUES (:idCliente, :idPasajero, :idReserva);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idCliente", $Clientepasajeroreservaref->getIdCliente());
$statement->bindValue(":idPasajero", $Clientepasajeroreservaref->getIdPasajero());
$statement->bindValue(":idReserva", $Clientepasajeroreservaref->getIdReserva());

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

    public function update(Clientepasajeroreservaref $Clientepasajeroreservaref): int {
        try{
            $sql = "UPDATE clientepasajeroreservaref SET idCliente = :idCliente, idPasajero = :idPasajero, idReserva = :idReserva WHERE idCliente = :idCliente AND idPasajero = :idPasajero AND idReserva = :idReserva LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idCliente", $Clientepasajeroreservaref->getIdCliente());
$statement->bindValue(":idPasajero", $Clientepasajeroreservaref->getIdPasajero());
$statement->bindValue(":idReserva", $Clientepasajeroreservaref->getIdReserva());

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
            $sql = "SELECT idCliente, idPasajero, idReserva 
            FROM clientepasajeroreservaref
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
                    $ret[] = new Clientepasajeroreservaref($row->idCliente, $row->idPasajero, $row->idReserva);
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
            if(!isset($ids['idCliente']) or !isset($ids['idPasajero']) or !isset($ids['idReserva'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM clientepasajeroreservaref";
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