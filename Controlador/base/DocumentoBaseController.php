<?php

abstract class DocumentoBaseController extends BaseController {



    public function insert(Documento $Documento): int {
        try{
            $sql = "INSERT INTO documentos (nombre, path, tabla, idTabla, idUsuario) 
            VALUES (:nombre, :path, :tabla, :idTabla, :idUsuario);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":nombre", $Documento->getNombre());
$statement->bindValue(":path", $Documento->getPath());
$statement->bindValue(":tabla", $Documento->getTabla());
$statement->bindValue(":idTabla", $Documento->getIdTabla());
$statement->bindValue(":idUsuario", $Documento->getIdUsuario());

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

    public function update(Documento $Documento): int {
        try{
            $sql = "UPDATE documentos SET nombre = :nombre, path = :path, tabla = :tabla, idTabla = :idTabla, idUsuario = :idUsuario WHERE idDocumento = :idDocumento LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idDocumento", $Documento->getIdDocumento());
$statement->bindValue(":nombre", $Documento->getNombre());
$statement->bindValue(":path", $Documento->getPath());
$statement->bindValue(":tabla", $Documento->getTabla());
$statement->bindValue(":idTabla", $Documento->getIdTabla());
$statement->bindValue(":idUsuario", $Documento->getIdUsuario());

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
            $sql = "SELECT idDocumento, nombre, path, tabla, idTabla, idUsuario, fechaAlta 
            FROM documentos";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
            
            if(!empty($rows)){
                foreach($rows as $row){
                    $ret[] = new Documento($row->idDocumento, $row->nombre, $row->path, $row->tabla, $row->idTabla, $row->idUsuario, $row->fechaAlta);
                }
            }
            
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }

    public function deleteByIds(array $ids = []): int {
        try{
            if(!isset($ids['idDocumento'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM documentos";
            $sql .= " WHERE idDocumento = :idDocumento LIMIT 1;";
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