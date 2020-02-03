<?php

abstract class ImagenBaseController extends baseController {



    public function insert(Imagen $Imagen): int {
        try{
            $sql = "INSERT INTO imagenes (idProducto, srcImagen) 
            VALUES (:idProducto, :srcImagen);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idProducto", $Imagen->getIdProducto());
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
            $sql = "UPDATE imagenes SET idProducto = :idProducto, srcImagen = :srcImagen WHERE idImagen = :idImagen LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idImagen", $Imagen->getIdImagen());
$statement->bindValue(":idProducto", $Imagen->getIdProducto());
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

    public function select(array $filtros = [], array $ordenados = [], array $limitar = []): array {
        try{
            $sql = "SELECT idImagen, idProducto, srcImagen, fechaAlta, fehaUpdate 
            FROM imagenes
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
                    $ret[] = new Imagen($row->idImagen, $row->idProducto, $row->srcImagen, $row->fechaAlta, $row->fehaUpdate);
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