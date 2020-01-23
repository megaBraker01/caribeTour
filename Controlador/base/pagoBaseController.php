<?php

require_once 'AutoLoader/AutoLoader.php';

abstract class PagoBaseController extends baseController {



    public function insert(Pago $Pago): int {
        try{
            $sql = "INSERT INTO pagos (idReserva, importe, idPagoTipo, idEstado, fechaAlta) 
            VALUES (:idReserva, :importe, :idPagoTipo, :idEstado, :fechaAlta);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idReserva", $Pago->getIdReserva());
$statement->bindValue(":importe", $Pago->getImporte());
$statement->bindValue(":idPagoTipo", $Pago->getIdPagoTipo());
$statement->bindValue(":idEstado", $Pago->getIdEstado());
$statement->bindValue(":fechaAlta", $Pago->getFechaAlta());

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

    public function update(Pago $Pago): int {
        try{
            $sql = "UPDATE pagos SET idReserva = :idReserva, importe = :importe, idPagoTipo = :idPagoTipo, idEstado = :idEstado, fechaAlta = :fechaAlta WHERE idPago = :idPago LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idPago", $Pago->getIdPago());
$statement->bindValue(":idReserva", $Pago->getIdReserva());
$statement->bindValue(":importe", $Pago->getImporte());
$statement->bindValue(":idPagoTipo", $Pago->getIdPagoTipo());
$statement->bindValue(":idEstado", $Pago->getIdEstado());
$statement->bindValue(":fechaAlta", $Pago->getFechaAlta());

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
            $sql = "SELECT idPago, idReserva, importe, idPagoTipo, idEstado, fechaAlta 
            FROM pagos
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
                    $ret[] = new Pago($row->idPago, $row->idReserva, $row->importe, $row->idPagoTipo, $row->idEstado, $row->fechaAlta);
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
            if(!isset($ids['idPago'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM pagos";
            $sql .= " WHERE idPago = :idPago LIMIT 1;";
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