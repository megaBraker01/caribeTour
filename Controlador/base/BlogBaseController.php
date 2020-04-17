<?php

abstract class BlogBaseController extends BaseController {



    public function insert(Blog $Blog): int {
        try{
            $sql = "INSERT INTO blogs (nombre, slug, metaDescripcion, metaKeyWords, descripcion, srcImagen, idUsuario, idEstado) 
            VALUES (:nombre, :slug, :metaDescripcion, :metaKeyWords, :descripcion, :srcImagen, :idUsuario, :idEstado);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":nombre", $Blog->getNombre());
$statement->bindValue(":slug", $Blog->getSlug());
$statement->bindValue(":metaDescripcion", $Blog->getMetaDescripcion());
$statement->bindValue(":metaKeyWords", $Blog->getMetaKeyWords());
$statement->bindValue(":descripcion", $Blog->getDescripcion());
$statement->bindValue(":srcImagen", $Blog->getSrcImagen());
$statement->bindValue(":idUsuario", $Blog->getIdUsuario());
$statement->bindValue(":idEstado", $Blog->getIdEstado());

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

    public function update(Blog $Blog): int {
        try{
            $sql = "UPDATE blogs SET nombre = :nombre, slug = :slug, metaDescripcion = :metaDescripcion, metaKeyWords = :metaKeyWords, descripcion = :descripcion, srcImagen = :srcImagen, idUsuario = :idUsuario, idEstado = :idEstado WHERE idBlog = :idBlog LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idBlog", $Blog->getIdBlog());
$statement->bindValue(":nombre", $Blog->getNombre());
$statement->bindValue(":slug", $Blog->getSlug());
$statement->bindValue(":metaDescripcion", $Blog->getMetaDescripcion());
$statement->bindValue(":metaKeyWords", $Blog->getMetaKeyWords());
$statement->bindValue(":descripcion", $Blog->getDescripcion());
$statement->bindValue(":srcImagen", $Blog->getSrcImagen());
$statement->bindValue(":idUsuario", $Blog->getIdUsuario());
$statement->bindValue(":idEstado", $Blog->getIdEstado());

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
            $sql = "SELECT idBlog, nombre, slug, metaDescripcion, metaKeyWords, descripcion, srcImagen, idUsuario, idEstado, fechaAlta, fechaUpdate 
            FROM blogs";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
            
            if(!empty($rows)){
                foreach($rows as $row){
                    $ret[] = new Blog($row->idBlog, $row->nombre, $row->slug, $row->metaDescripcion, $row->metaKeyWords, $row->descripcion, $row->srcImagen, $row->idUsuario, $row->idEstado, $row->fechaAlta, $row->fechaUpdate);
                }
            }
            
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }

    public function deleteByIds(array $ids = []): int {
        try{
            if(!isset($ids['idBlog'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM blogs";
            $sql .= " WHERE idBlog = :idBlog LIMIT 1;";
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