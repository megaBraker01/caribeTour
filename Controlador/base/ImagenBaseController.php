<?php

abstract class ImagenBaseController extends BaseController {



    public function insert(Imagen $Imagen): int {
        try{
            $sql = "INSERT INTO imagenes (tabla, idTabla, srcImagen) 
            VALUES (:tabla, :idTabla, :srcImagen);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":tabla", $Imagen->getTabla());
$statement->bindValue(":idTabla", $Imagen->getIdTabla());
$statement->bindValue(":srcImagen", $Imagen->getSrcImagen());

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

    public function update(Imagen $Imagen): int {
        try{
            $sql = "UPDATE imagenes SET tabla = :tabla, idTabla = :idTabla, srcImagen = :srcImagen WHERE idImagen = :idImagen LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idImagen", $Imagen->getIdImagen());
$statement->bindValue(":tabla", $Imagen->getTabla());
$statement->bindValue(":idTabla", $Imagen->getIdTabla());
$statement->bindValue(":srcImagen", $Imagen->getSrcImagen());

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
            $sql = "SELECT idImagen, tabla, idTabla, srcImagen, fechaAlta, fehaUpdate 
            FROM imagenes";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
            
            if(!empty($rows)){
                foreach($rows as $row){
                    $ret[] = new Imagen($row->idImagen, $row->tabla, $row->idTabla, $row->srcImagen, $row->fechaAlta, $row->fehaUpdate);
                }
            }
            
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }

    public function deleteByIds(array $ids = []): int {
        try{
            if(!isset($ids['idImagen'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM imagenes";
            $sql .= " WHERE idImagen = :idImagen LIMIT 1;";
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