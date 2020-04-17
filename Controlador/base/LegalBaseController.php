<?php

abstract class LegalBaseController extends BaseController {



    public function insert(Legal $Legal): int {
        try{
            $sql = "INSERT INTO legales (idLegal, nombre, slug, descripcion, idEstado) 
            VALUES (:idLegal, :nombre, :slug, :descripcion, :idEstado);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idLegal", $Legal->getIdLegal());
$statement->bindValue(":nombre", $Legal->getNombre());
$statement->bindValue(":slug", $Legal->getSlug());
$statement->bindValue(":descripcion", $Legal->getDescripcion());
$statement->bindValue(":idEstado", $Legal->getIdEstado());

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

    public function update(Legal $Legal): int {
        try{
            $sql = "UPDATE legales SET idLegal = :idLegal, nombre = :nombre, slug = :slug, descripcion = :descripcion, idEstado = :idEstado WHERE idLegal = :idLegal LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idLegal", $Legal->getIdLegal());
$statement->bindValue(":nombre", $Legal->getNombre());
$statement->bindValue(":slug", $Legal->getSlug());
$statement->bindValue(":descripcion", $Legal->getDescripcion());
$statement->bindValue(":idEstado", $Legal->getIdEstado());

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
            $sql = "SELECT idLegal, nombre, slug, descripcion, idEstado 
            FROM legales";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
            
            if(!empty($rows)){
                foreach($rows as $row){
                    $ret[] = new Legal($row->idLegal, $row->nombre, $row->slug, $row->descripcion, $row->idEstado);
                }
            }
            
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }

    public function deleteByIds(array $ids = []): int {
        try{
            if(!isset($ids['idLegal'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM legales";
            $sql .= " WHERE idLegal = :idLegal LIMIT 1;";
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