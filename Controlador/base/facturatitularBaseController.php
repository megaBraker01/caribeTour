<?php

require_once 'AutoLoader/AutoLoader.php';

abstract class FacturatitularBaseController extends baseController {



    public function insert(Facturatitular $Facturatitular): int {
        try{
            $sql = "INSERT INTO facturatitular (idCliente, nombre, apellidos, NIF, direccion, codigoPostal, ciudad, provincia, pais) 
            VALUES (:idCliente, :nombre, :apellidos, :NIF, :direccion, :codigoPostal, :ciudad, :provincia, :pais);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idCliente", $Facturatitular->getIdCliente());
$statement->bindValue(":nombre", $Facturatitular->getNombre());
$statement->bindValue(":apellidos", $Facturatitular->getApellidos());
$statement->bindValue(":NIF", $Facturatitular->getNIF());
$statement->bindValue(":direccion", $Facturatitular->getDireccion());
$statement->bindValue(":codigoPostal", $Facturatitular->getCodigoPostal());
$statement->bindValue(":ciudad", $Facturatitular->getCiudad());
$statement->bindValue(":provincia", $Facturatitular->getProvincia());
$statement->bindValue(":pais", $Facturatitular->getPais());

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

    public function update(Facturatitular $Facturatitular): int {
        try{
            $sql = "UPDATE facturatitular SET idCliente = :idCliente, nombre = :nombre, apellidos = :apellidos, NIF = :NIF, direccion = :direccion, codigoPostal = :codigoPostal, ciudad = :ciudad, provincia = :provincia, pais = :pais WHERE idFacturaTitular = :idFacturaTitular LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idFacturaTitular", $Facturatitular->getIdFacturaTitular());
$statement->bindValue(":idCliente", $Facturatitular->getIdCliente());
$statement->bindValue(":nombre", $Facturatitular->getNombre());
$statement->bindValue(":apellidos", $Facturatitular->getApellidos());
$statement->bindValue(":NIF", $Facturatitular->getNIF());
$statement->bindValue(":direccion", $Facturatitular->getDireccion());
$statement->bindValue(":codigoPostal", $Facturatitular->getCodigoPostal());
$statement->bindValue(":ciudad", $Facturatitular->getCiudad());
$statement->bindValue(":provincia", $Facturatitular->getProvincia());
$statement->bindValue(":pais", $Facturatitular->getPais());

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
            FROM facturatitular
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
                    $ret[] = new Facturatitular($row->idFacturaTitular, $row->idCliente, $row->nombre, $row->apellidos, $row->NIF, $row->direccion, $row->codigoPostal, $row->ciudad, $row->provincia, $row->pais);
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
            $sql = "DELETE FROM facturatitular";
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