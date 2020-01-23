<?php

require_once 'AutoLoader/AutoLoader.php';

abstract class BlogcomentarioBaseController extends baseController {



    public function insert(Blogcomentario $Blogcomentario): int {
        try{
            $sql = "INSERT INTO blogcomentarios (idBlog, idEstado, nombre, email, comentario, fechaAlta) 
            VALUES (:idBlog, :idEstado, :nombre, :email, :comentario, :fechaAlta);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idBlog", $Blogcomentario->getIdBlog());
$statement->bindValue(":idEstado", $Blogcomentario->getIdEstado());
$statement->bindValue(":nombre", $Blogcomentario->getNombre());
$statement->bindValue(":email", $Blogcomentario->getEmail());
$statement->bindValue(":comentario", $Blogcomentario->getComentario());
$statement->bindValue(":fechaAlta", $Blogcomentario->getFechaAlta());

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

    public function update(Blogcomentario $Blogcomentario): int {
        try{
            $sql = "UPDATE blogcomentarios SET idBlog = :idBlog, idEstado = :idEstado, nombre = :nombre, email = :email, comentario = :comentario, fechaAlta = :fechaAlta WHERE idBlogComentario = :idBlogComentario LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idBlogComentario", $Blogcomentario->getIdBlogComentario());
$statement->bindValue(":idBlog", $Blogcomentario->getIdBlog());
$statement->bindValue(":idEstado", $Blogcomentario->getIdEstado());
$statement->bindValue(":nombre", $Blogcomentario->getNombre());
$statement->bindValue(":email", $Blogcomentario->getEmail());
$statement->bindValue(":comentario", $Blogcomentario->getComentario());
$statement->bindValue(":fechaAlta", $Blogcomentario->getFechaAlta());

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
            $sql = "SELECT idBlogComentario, idBlog, idEstado, nombre, email, comentario, fechaAlta 
            FROM blogcomentarios
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
                    $ret[] = new Blogcomentario($row->idBlogComentario, $row->idBlog, $row->idEstado, $row->nombre, $row->email, $row->comentario, $row->fechaAlta);
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
            if(!isset($ids['idBlogComentario'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM blogcomentarios";
            $sql .= " WHERE idBlogComentario = :idBlogComentario LIMIT 1;";
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