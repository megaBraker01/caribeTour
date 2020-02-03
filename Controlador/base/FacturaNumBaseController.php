<?php

abstract class FacturaNumBaseController extends baseController {



    public function insert(Factura_num $Factura_num): int {
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

    public function update(Factura_num $Factura_num): int {
        try{
            $sql = "UPDATE factura_num SET  WHERE facturaNum = :facturaNum LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":facturaNum", $Factura_num->getFacturaNum());

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
            FROM factura_num
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
                    $ret[] = new Factura_num($row->facturaNum, $row->fechaAlta);
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