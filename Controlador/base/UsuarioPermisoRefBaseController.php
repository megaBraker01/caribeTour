<?php

abstract class UsuarioPermisoRefBaseController extends BaseController {



    public function insert(UsuarioPermisoRef $UsuarioPermisoRef): int {
        try{
            $sql = "INSERT INTO usuario_permiso_ref (idUsuario, idPermiso) 
            VALUES (:idUsuario, :idPermiso);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idUsuario", $UsuarioPermisoRef->getIdUsuario());
$statement->bindValue(":idPermiso", $UsuarioPermisoRef->getIdPermiso());

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

    public function update(UsuarioPermisoRef $UsuarioPermisoRef): int {
        try{
            $sql = "UPDATE usuario_permiso_ref SET idUsuario = :idUsuario, idPermiso = :idPermiso WHERE idUsuario = :idUsuario AND idPermiso = :idPermiso LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idUsuario", $UsuarioPermisoRef->getIdUsuario());
$statement->bindValue(":idPermiso", $UsuarioPermisoRef->getIdPermiso());

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

    public function select(array $filtros = [], array $ordenados = [], array $limitar = [], array $agrupar = []): array {
        try{
            $sql = "SELECT idUsuario, idPermiso 
            FROM usuario_permiso_ref";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
            
            if(!empty($rows)){
                foreach($rows as $row){
                    $ret[] = new UsuarioPermisoRef($row->idUsuario, $row->idPermiso);
                }
            }
            
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }

    public function deleteByIds(array $ids = []): int {
        try{
            if(!isset($ids['idUsuario']) or !isset($ids['idPermiso'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM usuario_permiso_ref";
            $sql .= " WHERE idUsuario = :idUsuario AND idPermiso = :idPermiso LIMIT 1;";
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