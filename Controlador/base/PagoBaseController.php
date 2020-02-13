<?php

abstract class PagoBaseController extends BaseController {



    public function insert(Pago $Pago): int {
        try{
            $sql = "INSERT INTO pagos (idReserva, importe, idPagoTipo, idEstado) 
            VALUES (:idReserva, :importe, :idPagoTipo, :idEstado);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idReserva", $Pago->getIdReserva());
$statement->bindValue(":importe", $Pago->getImporte());
$statement->bindValue(":idPagoTipo", $Pago->getIdPagoTipo());
$statement->bindValue(":idEstado", $Pago->getIdEstado());

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
            $sql = "UPDATE pagos SET idReserva = :idReserva, importe = :importe, idPagoTipo = :idPagoTipo, idEstado = :idEstado WHERE idPago = :idPago LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idPago", $Pago->getIdPago());
$statement->bindValue(":idReserva", $Pago->getIdReserva());
$statement->bindValue(":importe", $Pago->getImporte());
$statement->bindValue(":idPagoTipo", $Pago->getIdPagoTipo());
$statement->bindValue(":idEstado", $Pago->getIdEstado());

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
            $sql = "SELECT idPago, idReserva, importe, idPagoTipo, idEstado, fechaAlta 
            FROM pagos";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
            
            if(count($rows) > 0){
                foreach($rows as $row){
                    $ret[] = new Pago($row->idPago, $row->idReserva, $row->importe, $row->idPagoTipo, $row->idEstado, $row->fechaAlta);
                }
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