<?php

abstract class NotaBaseController extends BaseController {



    public function insert(Nota $Nota): int {
        try{
            $sql = "INSERT INTO notas (nombreTabla, idTabla, nota, idUsuario) 
            VALUES (:nombreTabla, :idTabla, :nota, :idUsuario);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":nombreTabla", $Nota->getNombreTabla());
$statement->bindValue(":idTabla", $Nota->getIdTabla());
$statement->bindValue(":nota", $Nota->getNota());
$statement->bindValue(":idUsuario", $Nota->getIdUsuario());

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

    public function update(Nota $Nota): int {
        try{
            $sql = "UPDATE notas SET nombreTabla = :nombreTabla, idTabla = :idTabla, nota = :nota, idUsuario = :idUsuario WHERE idNota = :idNota LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idNota", $Nota->getIdNota());
$statement->bindValue(":nombreTabla", $Nota->getNombreTabla());
$statement->bindValue(":idTabla", $Nota->getIdTabla());
$statement->bindValue(":nota", $Nota->getNota());
$statement->bindValue(":idUsuario", $Nota->getIdUsuario());

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
            $sql = "SELECT idNota, nombreTabla, idTabla, nota, idUsuario, fechaAlta, fechaUpdate 
            FROM notas";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
            
            if(!empty($rows)){
                foreach($rows as $row){
                    $ret[] = new Nota($row->idNota, $row->nombreTabla, $row->idTabla, $row->nota, $row->idUsuario, $row->fechaAlta, $row->fechaUpdate);
                }
            }
            
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }

    public function deleteByIds(array $ids = []): int {
        try{
            if(!isset($ids['idNota'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM notas";
            $sql .= " WHERE idNota = :idNota LIMIT 1;";
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