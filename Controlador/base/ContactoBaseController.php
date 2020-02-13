<?php

abstract class ContactoBaseController extends BaseController {



    public function insert(Contacto $Contacto): int {
        try{
            $sql = "INSERT INTO contactos (idTipo, contacto, personaContacto, srcTabla, idTabla) 
            VALUES (:idTipo, :contacto, :personaContacto, :srcTabla, :idTabla);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idTipo", $Contacto->getIdTipo());
$statement->bindValue(":contacto", $Contacto->getContacto());
$statement->bindValue(":personaContacto", $Contacto->getPersonaContacto());
$statement->bindValue(":srcTabla", $Contacto->getSrcTabla());
$statement->bindValue(":idTabla", $Contacto->getIdTabla());

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

    public function update(Contacto $Contacto): int {
        try{
            $sql = "UPDATE contactos SET idTipo = :idTipo, contacto = :contacto, personaContacto = :personaContacto, srcTabla = :srcTabla, idTabla = :idTabla WHERE idContacto = :idContacto LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idContacto", $Contacto->getIdContacto());
$statement->bindValue(":idTipo", $Contacto->getIdTipo());
$statement->bindValue(":contacto", $Contacto->getContacto());
$statement->bindValue(":personaContacto", $Contacto->getPersonaContacto());
$statement->bindValue(":srcTabla", $Contacto->getSrcTabla());
$statement->bindValue(":idTabla", $Contacto->getIdTabla());

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
            $sql = "SELECT idContacto, idTipo, contacto, personaContacto, srcTabla, idTabla, fechaAlta, fechaUpdate 
            FROM contactos";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
            
            if(count($rows) > 0){
                foreach($rows as $row){
                    $ret[] = new Contacto($row->idContacto, $row->idTipo, $row->contacto, $row->personaContacto, $row->srcTabla, $row->idTabla, $row->fechaAlta, $row->fechaUpdate);
                }
            }
            
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }

    public function deleteByIds(array $ids = []): int {
        try{
            if(!isset($ids['idContacto'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM contactos";
            $sql .= " WHERE idContacto = :idContacto LIMIT 1;";
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