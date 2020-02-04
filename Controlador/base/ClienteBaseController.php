<?php

abstract class ClienteBaseController extends baseController {



    public function insert(Cliente $Cliente): int {
        try{
            $sql = "INSERT INTO clientes (idEstado, nombre, apellidos, NIFoPasaporte, telefono, email, direccion, codigoPostal, ciudad, provincia, pais) 
            VALUES (:idEstado, :nombre, :apellidos, :NIFoPasaporte, :telefono, :email, :direccion, :codigoPostal, :ciudad, :provincia, :pais);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idEstado", $Cliente->getIdEstado());
$statement->bindValue(":nombre", $Cliente->getNombre());
$statement->bindValue(":apellidos", $Cliente->getApellidos());
$statement->bindValue(":NIFoPasaporte", $Cliente->getNIFoPasaporte());
$statement->bindValue(":telefono", $Cliente->getTelefono());
$statement->bindValue(":email", $Cliente->getEmail());
$statement->bindValue(":direccion", $Cliente->getDireccion());
$statement->bindValue(":codigoPostal", $Cliente->getCodigoPostal());
$statement->bindValue(":ciudad", $Cliente->getCiudad());
$statement->bindValue(":provincia", $Cliente->getProvincia());
$statement->bindValue(":pais", $Cliente->getPais());

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

    public function update(Cliente $Cliente): int {
        try{
            $sql = "UPDATE clientes SET idEstado = :idEstado, nombre = :nombre, apellidos = :apellidos, NIFoPasaporte = :NIFoPasaporte, telefono = :telefono, email = :email, direccion = :direccion, codigoPostal = :codigoPostal, ciudad = :ciudad, provincia = :provincia, pais = :pais WHERE idCliente = :idCliente LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idCliente", $Cliente->getIdCliente());
$statement->bindValue(":idEstado", $Cliente->getIdEstado());
$statement->bindValue(":nombre", $Cliente->getNombre());
$statement->bindValue(":apellidos", $Cliente->getApellidos());
$statement->bindValue(":NIFoPasaporte", $Cliente->getNIFoPasaporte());
$statement->bindValue(":telefono", $Cliente->getTelefono());
$statement->bindValue(":email", $Cliente->getEmail());
$statement->bindValue(":direccion", $Cliente->getDireccion());
$statement->bindValue(":codigoPostal", $Cliente->getCodigoPostal());
$statement->bindValue(":ciudad", $Cliente->getCiudad());
$statement->bindValue(":provincia", $Cliente->getProvincia());
$statement->bindValue(":pais", $Cliente->getPais());

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
            $sql = "SELECT idCliente, idEstado, nombre, apellidos, NIFoPasaporte, telefono, email, direccion, codigoPostal, ciudad, provincia, pais, fechaAlta, fechaUpdate 
            FROM clientes
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
                    $ret[] = new Cliente($row->idCliente, $row->idEstado, $row->nombre, $row->apellidos, $row->NIFoPasaporte, $row->telefono, $row->email, $row->direccion, $row->codigoPostal, $row->ciudad, $row->provincia, $row->pais, $row->fechaAlta, $row->fechaUpdate);
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
            if(!isset($ids['idCliente'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM clientes";
            $sql .= " WHERE idCliente = :idCliente LIMIT 1;";
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