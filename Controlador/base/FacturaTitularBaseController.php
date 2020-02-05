<?php

abstract class FacturaTitularBaseController extends BaseController {



    public function insert(FacturaTitular $FacturaTitular): int {
        try{
            $sql = "INSERT INTO factura_titular (idCliente, nombre, apellidos, NIF, direccion, codigoPostal, ciudad, provincia, pais) 
            VALUES (:idCliente, :nombre, :apellidos, :NIF, :direccion, :codigoPostal, :ciudad, :provincia, :pais);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idCliente", $FacturaTitular->getIdCliente());
$statement->bindValue(":nombre", $FacturaTitular->getNombre());
$statement->bindValue(":apellidos", $FacturaTitular->getApellidos());
$statement->bindValue(":NIF", $FacturaTitular->getNIF());
$statement->bindValue(":direccion", $FacturaTitular->getDireccion());
$statement->bindValue(":codigoPostal", $FacturaTitular->getCodigoPostal());
$statement->bindValue(":ciudad", $FacturaTitular->getCiudad());
$statement->bindValue(":provincia", $FacturaTitular->getProvincia());
$statement->bindValue(":pais", $FacturaTitular->getPais());

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

    public function update(FacturaTitular $FacturaTitular): int {
        try{
            $sql = "UPDATE factura_titular SET idCliente = :idCliente, nombre = :nombre, apellidos = :apellidos, NIF = :NIF, direccion = :direccion, codigoPostal = :codigoPostal, ciudad = :ciudad, provincia = :provincia, pais = :pais WHERE idFacturaTitular = :idFacturaTitular LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idFacturaTitular", $FacturaTitular->getIdFacturaTitular());
$statement->bindValue(":idCliente", $FacturaTitular->getIdCliente());
$statement->bindValue(":nombre", $FacturaTitular->getNombre());
$statement->bindValue(":apellidos", $FacturaTitular->getApellidos());
$statement->bindValue(":NIF", $FacturaTitular->getNIF());
$statement->bindValue(":direccion", $FacturaTitular->getDireccion());
$statement->bindValue(":codigoPostal", $FacturaTitular->getCodigoPostal());
$statement->bindValue(":ciudad", $FacturaTitular->getCiudad());
$statement->bindValue(":provincia", $FacturaTitular->getProvincia());
$statement->bindValue(":pais", $FacturaTitular->getPais());

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
            $sql = "SELECT idFacturaTitular, idCliente, nombre, apellidos, NIF, direccion, codigoPostal, ciudad, provincia, pais 
            FROM factura_titular
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
                    $ret[] = new FacturaTitular($row->idFacturaTitular, $row->idCliente, $row->nombre, $row->apellidos, $row->NIF, $row->direccion, $row->codigoPostal, $row->ciudad, $row->provincia, $row->pais);
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
            if(!isset($ids['idFacturaTitular'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM factura_titular";
            $sql .= " WHERE idFacturaTitular = :idFacturaTitular LIMIT 1;";
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