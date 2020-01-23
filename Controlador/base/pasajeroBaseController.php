<?php

require_once 'AutoLoader/AutoLoader.php';

abstract class PasajeroBaseController extends baseController {



    public function insert(Pasajero $Pasajero): int {
        try{
            $sql = "INSERT INTO pasajeros (nombre, apellidos, NIFoPasaporte, nacionalidad, fechaNacimiento, fechaAlta) 
            VALUES (:nombre, :apellidos, :NIFoPasaporte, :nacionalidad, :fechaNacimiento, :fechaAlta);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":nombre", $Pasajero->getNombre());
$statement->bindValue(":apellidos", $Pasajero->getApellidos());
$statement->bindValue(":NIFoPasaporte", $Pasajero->getNIFoPasaporte());
$statement->bindValue(":nacionalidad", $Pasajero->getNacionalidad());
$statement->bindValue(":fechaNacimiento", $Pasajero->getFechaNacimiento());
$statement->bindValue(":fechaAlta", $Pasajero->getFechaAlta());

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

    public function update(Pasajero $Pasajero): int {
        try{
            $sql = "UPDATE pasajeros SET nombre = :nombre, apellidos = :apellidos, NIFoPasaporte = :NIFoPasaporte, nacionalidad = :nacionalidad, fechaNacimiento = :fechaNacimiento, fechaAlta = :fechaAlta WHERE idPasajero = :idPasajero LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idPasajero", $Pasajero->getIdPasajero());
$statement->bindValue(":nombre", $Pasajero->getNombre());
$statement->bindValue(":apellidos", $Pasajero->getApellidos());
$statement->bindValue(":NIFoPasaporte", $Pasajero->getNIFoPasaporte());
$statement->bindValue(":nacionalidad", $Pasajero->getNacionalidad());
$statement->bindValue(":fechaNacimiento", $Pasajero->getFechaNacimiento());
$statement->bindValue(":fechaAlta", $Pasajero->getFechaAlta());

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
            $sql = "SELECT idPasajero, nombre, apellidos, NIFoPasaporte, nacionalidad, fechaNacimiento, fechaAlta, fechaUpdate 
            FROM pasajeros
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
                    $ret[] = new Pasajero($row->idPasajero, $row->nombre, $row->apellidos, $row->NIFoPasaporte, $row->nacionalidad, $row->fechaNacimiento, $row->fechaAlta, $row->fechaUpdate);
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
            if(!isset($ids['idPasajero'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM pasajeros";
            $sql .= " WHERE idPasajero = :idPasajero LIMIT 1;";
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