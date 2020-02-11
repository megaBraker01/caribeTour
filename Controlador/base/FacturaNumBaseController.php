<?php

abstract class FacturaNumBaseController extends BaseController {



    public function insert(FacturaNum $FacturaNum): int {
        try{
            $sql = "INSERT INTO factura_num () 
            VALUES (:);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            
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

    public function update(FacturaNum $FacturaNum): int {
        try{
            $sql = "UPDATE factura_num SET  WHERE facturaNum = :facturaNum LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":facturaNum", $FacturaNum->getFacturaNum());

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
            $sql = "SELECT facturaNum, fechaAlta 
            FROM factura_num";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar);
            
            if(count($rows) > 0){
                foreach($rows as $row){
                    $ret[] = new FacturaNum($row->facturaNum, $row->fechaAlta);
                }
            }
            
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }

    public function deleteByIds(array $ids = []): int {
        try{
            if(!isset($ids['facturaNum'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM factura_num";
            $sql .= " WHERE facturaNum = :facturaNum LIMIT 1;";
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