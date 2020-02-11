<?php

abstract class ProductoBaseController extends BaseController {



    public function insert(Producto $Producto): int {
        try{
            $sql = "INSERT INTO productos (nombre, imagen, descripcion, slug, itinerario, incluye, metaDescripcion, metaKeyWords, idCategoria, idTipo, idEstado, idProveedor, stock, esOferta) 
            VALUES (:nombre, :imagen, :descripcion, :slug, :itinerario, :incluye, :metaDescripcion, :metaKeyWords, :idCategoria, :idTipo, :idEstado, :idProveedor, :stock, :esOferta);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":nombre", $Producto->getNombre());
$statement->bindValue(":imagen", $Producto->getImagen());
$statement->bindValue(":descripcion", $Producto->getDescripcion());
$statement->bindValue(":slug", $Producto->getSlug());
$statement->bindValue(":itinerario", $Producto->getItinerario());
$statement->bindValue(":incluye", $Producto->getIncluye());
$statement->bindValue(":metaDescripcion", $Producto->getMetaDescripcion());
$statement->bindValue(":metaKeyWords", $Producto->getMetaKeyWords());
$statement->bindValue(":idCategoria", $Producto->getIdCategoria());
$statement->bindValue(":idTipo", $Producto->getIdTipo());
$statement->bindValue(":idEstado", $Producto->getIdEstado());
$statement->bindValue(":idProveedor", $Producto->getIdProveedor());
$statement->bindValue(":stock", $Producto->getStock());
$statement->bindValue(":esOferta", $Producto->getEsOferta());

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

    public function update(Producto $Producto): int {
        try{
            $sql = "UPDATE productos SET nombre = :nombre, imagen = :imagen, descripcion = :descripcion, slug = :slug, itinerario = :itinerario, incluye = :incluye, metaDescripcion = :metaDescripcion, metaKeyWords = :metaKeyWords, idCategoria = :idCategoria, idTipo = :idTipo, idEstado = :idEstado, idProveedor = :idProveedor, stock = :stock, esOferta = :esOferta WHERE idproducto = :idproducto LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idproducto", $Producto->getIdproducto());
$statement->bindValue(":nombre", $Producto->getNombre());
$statement->bindValue(":imagen", $Producto->getImagen());
$statement->bindValue(":descripcion", $Producto->getDescripcion());
$statement->bindValue(":slug", $Producto->getSlug());
$statement->bindValue(":itinerario", $Producto->getItinerario());
$statement->bindValue(":incluye", $Producto->getIncluye());
$statement->bindValue(":metaDescripcion", $Producto->getMetaDescripcion());
$statement->bindValue(":metaKeyWords", $Producto->getMetaKeyWords());
$statement->bindValue(":idCategoria", $Producto->getIdCategoria());
$statement->bindValue(":idTipo", $Producto->getIdTipo());
$statement->bindValue(":idEstado", $Producto->getIdEstado());
$statement->bindValue(":idProveedor", $Producto->getIdProveedor());
$statement->bindValue(":stock", $Producto->getStock());
$statement->bindValue(":esOferta", $Producto->getEsOferta());

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
            $sql = "SELECT idproducto, nombre, imagen, descripcion, slug, itinerario, incluye, metaDescripcion, metaKeyWords, idCategoria, idTipo, idEstado, idProveedor, stock, esOferta, fechaAlta, fehaUpdate 
            FROM productos";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar);
            
            if(count($rows) > 0){
                foreach($rows as $row){
                    $ret[] = new Producto($row->idproducto, $row->nombre, $row->imagen, $row->descripcion, $row->slug, $row->itinerario, $row->incluye, $row->metaDescripcion, $row->metaKeyWords, $row->idCategoria, $row->idTipo, $row->idEstado, $row->idProveedor, $row->stock, $row->esOferta, $row->fechaAlta, $row->fehaUpdate);
                }
            }
            
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }

    public function deleteByIds(array $ids = []): int {
        try{
            if(!isset($ids['idproducto'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM productos";
            $sql .= " WHERE idproducto = :idproducto LIMIT 1;";
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