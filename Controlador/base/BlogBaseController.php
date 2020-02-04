<?php

abstract class BlogBaseController extends baseController {



    public function insert(Blog $Blog): int {
        try{
            $sql = "INSERT INTO blogs (nombre, slug, metaDescripcion, metaKeyWords, descripcion, srcImagen, idUsuario) 
            VALUES (:nombre, :slug, :metaDescripcion, :metaKeyWords, :descripcion, :srcImagen, :idUsuario);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":nombre", $Blog->getNombre());
$statement->bindValue(":slug", $Blog->getSlug());
$statement->bindValue(":metaDescripcion", $Blog->getMetaDescripcion());
$statement->bindValue(":metaKeyWords", $Blog->getMetaKeyWords());
$statement->bindValue(":descripcion", $Blog->getDescripcion());
$statement->bindValue(":srcImagen", $Blog->getSrcImagen());
$statement->bindValue(":idUsuario", $Blog->getIdUsuario());

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
            $sql = "UPDATE blogs SET nombre = :nombre, slug = :slug, metaDescripcion = :metaDescripcion, metaKeyWords = :metaKeyWords, descripcion = :descripcion, srcImagen = :srcImagen, idUsuario = :idUsuario WHERE idblog = :idblog LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idblog", $Blog->getIdblog());
$statement->bindValue(":nombre", $Blog->getNombre());
$statement->bindValue(":slug", $Blog->getSlug());
$statement->bindValue(":metaDescripcion", $Blog->getMetaDescripcion());
$statement->bindValue(":metaKeyWords", $Blog->getMetaKeyWords());
$statement->bindValue(":descripcion", $Blog->getDescripcion());
$statement->bindValue(":srcImagen", $Blog->getSrcImagen());
$statement->bindValue(":idUsuario", $Blog->getIdUsuario());

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
            $sql = "SELECT idblog, nombre, slug, metaDescripcion, metaKeyWords, descripcion, srcImagen, idUsuario, fechaAlta, fechaUpdate 
            FROM blogs
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
                    $ret[] = new Blog($row->idblog, $row->nombre, $row->slug, $row->metaDescripcion, $row->metaKeyWords, $row->descripcion, $row->srcImagen, $row->idUsuario, $row->fechaAlta, $row->fechaUpdate);
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
            if(!isset($ids['idblog'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM blogs";
            $sql .= " WHERE idblog = :idblog LIMIT 1;";
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