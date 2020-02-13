<?php

abstract class PasajeroBaseController extends BaseController {



    public function insert(Pasajero $Pasajero): int {
        try{
            $sql = "INSERT INTO pasajeros (nombre, apellidos, NIFoPasaporte, nacionalidad, fechaNacimiento) 
            VALUES (:nombre, :apellidos, :NIFoPasaporte, :nacionalidad, :fechaNacimiento);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":nombre", $Pasajero->getNombre());
$statement->bindValue(":apellidos", $Pasajero->getApellidos());
$statement->bindValue(":NIFoPasaporte", $Pasajero->getNIFoPasaporte());
$statement->bindValue(":nacionalidad", $Pasajero->getNacionalidad());
$statement->bindValue(":fechaNacimiento", $Pasajero->getFechaNacimiento());

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
            $sql = "UPDATE pasajeros SET nombre = :nombre, apellidos = :apellidos, NIFoPasaporte = :NIFoPasaporte, nacionalidad = :nacionalidad, fechaNacimiento = :fechaNacimiento WHERE idPasajero = :idPasajero LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idPasajero", $Pasajero->getIdPasajero());
$statement->bindValue(":nombre", $Pasajero->getNombre());
$statement->bindValue(":apellidos", $Pasajero->getApellidos());
$statement->bindValue(":NIFoPasaporte", $Pasajero->getNIFoPasaporte());
$statement->bindValue(":nacionalidad", $Pasajero->getNacionalidad());
$statement->bindValue(":fechaNacimiento", $Pasajero->getFechaNacimiento());

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
            $sql = "SELECT idPasajero, nombre, apellidos, NIFoPasaporte, nacionalidad, fechaNacimiento, fechaAlta, fechaUpdate 
            FROM pasajeros";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
            
            if(count($rows) > 0){
                foreach($rows as $row){
                    $ret[] = new Pasajero($row->idPasajero, $row->nombre, $row->apellidos, $row->NIFoPasaporte, $row->nacionalidad, $row->fechaNacimiento, $row->fechaAlta, $row->fechaUpdate);
                }
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