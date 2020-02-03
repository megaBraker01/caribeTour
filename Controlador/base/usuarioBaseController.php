<?php

abstract class UsuarioBaseController extends baseController {



    public function insert(Usuario $Usuario): int {
        try{
            $sql = "INSERT INTO usuarios (nombre, apellidos, DNI, email, password, telefono, perfil, imagen, idEstado, idPermiso) 
            VALUES (:nombre, :apellidos, :DNI, :email, :password, :telefono, :perfil, :imagen, :idEstado, :idPermiso);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":nombre", $Usuario->getNombre());
$statement->bindValue(":apellidos", $Usuario->getApellidos());
$statement->bindValue(":DNI", $Usuario->getDNI());
$statement->bindValue(":email", $Usuario->getEmail());
$statement->bindValue(":password", $Usuario->getPassword());
$statement->bindValue(":telefono", $Usuario->getTelefono());
$statement->bindValue(":perfil", $Usuario->getPerfil());
$statement->bindValue(":imagen", $Usuario->getImagen());
$statement->bindValue(":idEstado", $Usuario->getIdEstado());
$statement->bindValue(":idPermiso", $Usuario->getIdPermiso());

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

    public function update(Usuario $Usuario): int {
        try{
            $sql = "UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, DNI = :DNI, email = :email, password = :password, telefono = :telefono, perfil = :perfil, imagen = :imagen, idEstado = :idEstado, idPermiso = :idPermiso WHERE idUsuario = :idUsuario LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idUsuario", $Usuario->getIdUsuario());
$statement->bindValue(":nombre", $Usuario->getNombre());
$statement->bindValue(":apellidos", $Usuario->getApellidos());
$statement->bindValue(":DNI", $Usuario->getDNI());
$statement->bindValue(":email", $Usuario->getEmail());
$statement->bindValue(":password", $Usuario->getPassword());
$statement->bindValue(":telefono", $Usuario->getTelefono());
$statement->bindValue(":perfil", $Usuario->getPerfil());
$statement->bindValue(":imagen", $Usuario->getImagen());
$statement->bindValue(":idEstado", $Usuario->getIdEstado());
$statement->bindValue(":idPermiso", $Usuario->getIdPermiso());

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
            $sql = "SELECT idUsuario, nombre, apellidos, DNI, email, password, telefono, perfil, imagen, idEstado, idPermiso, fechaAlta, fechaUpdate 
            FROM usuarios
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
                    $ret[] = new Usuario($row->idUsuario, $row->nombre, $row->apellidos, $row->DNI, $row->email, $row->password, $row->telefono, $row->perfil, $row->imagen, $row->idEstado, $row->idPermiso, $row->fechaAlta, $row->fechaUpdate);
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
            if(!isset($ids['idUsuario'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM usuarios";
            $sql .= " WHERE idUsuario = :idUsuario LIMIT 1;";
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