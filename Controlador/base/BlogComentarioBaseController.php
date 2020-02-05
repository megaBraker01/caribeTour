<?php

abstract class BlogComentarioBaseController extends BaseController {



    public function insert(BlogComentario $BlogComentario): int {
        try{
            $sql = "INSERT INTO blog_comentarios (idBlog, idEstado, nombre, email, comentario) 
            VALUES (:idBlog, :idEstado, :nombre, :email, :comentario);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idBlog", $BlogComentario->getIdBlog());
$statement->bindValue(":idEstado", $BlogComentario->getIdEstado());
$statement->bindValue(":nombre", $BlogComentario->getNombre());
$statement->bindValue(":email", $BlogComentario->getEmail());
$statement->bindValue(":comentario", $BlogComentario->getComentario());

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

    public function update(BlogComentario $BlogComentario): int {
        try{
            $sql = "UPDATE blog_comentarios SET idBlog = :idBlog, idEstado = :idEstado, nombre = :nombre, email = :email, comentario = :comentario WHERE idBlogComentario = :idBlogComentario LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idBlogComentario", $BlogComentario->getIdBlogComentario());
$statement->bindValue(":idBlog", $BlogComentario->getIdBlog());
$statement->bindValue(":idEstado", $BlogComentario->getIdEstado());
$statement->bindValue(":nombre", $BlogComentario->getNombre());
$statement->bindValue(":email", $BlogComentario->getEmail());
$statement->bindValue(":comentario", $BlogComentario->getComentario());

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
            FROM blog_comentarios
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
                    $ret[] = new BlogComentario($row->idBlogComentario, $row->idBlog, $row->idEstado, $row->nombre, $row->email, $row->comentario, $row->fechaAlta);
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
            $sql = "DELETE FROM blog_comentarios";
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