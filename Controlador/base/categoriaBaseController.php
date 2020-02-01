<?php

require_once SITE_ROOT ."/AutoLoader/autoLoaderController.php";
require_once SITE_ROOT ."/AutoLoader/autoLoaderConexion.php";
require_once SITE_ROOT ."/AutoLoader/autoLoaderModelo.php";

abstract class CategoriaBaseController extends baseController {



    public function insert(Categoria $Categoria): int {
        try{
            $sql = "INSERT INTO categorias (idCategoriaPadre, nombre, slug, descripcion, idEstado, srcImagen) 
            VALUES (:idCategoriaPadre, :nombre, :slug, :descripcion, :idEstado, :srcImagen);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
$statement->bindValue(":idCategoriaPadre", $Categoria->getIdCategoriaPadre());
$statement->bindValue(":nombre", $Categoria->getNombre());
$statement->bindValue(":slug", $Categoria->getSlug());
$statement->bindValue(":descripcion", $Categoria->getDescripcion());
$statement->bindValue(":idEstado", $Categoria->getIdEstado());
$statement->bindValue(":srcImagen", $Categoria->getSrcImagen());

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

    public function update(Categoria $Categoria): int {
        try{
            $sql = "UPDATE categorias SET idCategoria = :idCategoria, idCategoriaPadre = :idCategoriaPadre, nombre = :nombre, slug = :slug, descripcion = :descripcion, idEstado = :idEstado, srcImagen = :srcImagen WHERE idCategoria = :idCategoria LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idCategoria", $Categoria->getIdCategoria());
$statement->bindValue(":idCategoriaPadre", $Categoria->getIdCategoriaPadre());
$statement->bindValue(":nombre", $Categoria->getNombre());
$statement->bindValue(":slug", $Categoria->getSlug());
$statement->bindValue(":descripcion", $Categoria->getDescripcion());
$statement->bindValue(":idEstado", $Categoria->getIdEstado());
$statement->bindValue(":srcImagen", $Categoria->getSrcImagen());

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
            $sql = "SELECT idCategoria, idCategoriaPadre, nombre, slug, descripcion, idEstado, srcImagen 
            FROM categorias
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
                    $ret[] = new Categoria($row->idCategoria, $row->idCategoriaPadre, $row->nombre, $row->slug, $row->descripcion, $row->idEstado, $row->srcImagen);
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
            if(!isset($ids['idCategoria'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM categorias";
            $sql .= " WHERE idCategoria = :idCategoria LIMIT 1;";
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