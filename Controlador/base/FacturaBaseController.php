<?php

abstract class FacturaBaseController extends BaseController {



    public function insert(Factura $Factura): int {
        try{
            $sql = "INSERT INTO facturas (facturaNum, idReserva, idFacturaTitular, importeBruto, IVA, descuento) 
            VALUES (:facturaNum, :idReserva, :idFacturaTitular, :importeBruto, :IVA, :descuento);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":facturaNum", $Factura->getFacturaNum());
$statement->bindValue(":idReserva", $Factura->getIdReserva());
$statement->bindValue(":idFacturaTitular", $Factura->getIdFacturaTitular());
$statement->bindValue(":importeBruto", $Factura->getImporteBruto());
$statement->bindValue(":IVA", $Factura->getIVA());
$statement->bindValue(":descuento", $Factura->getDescuento());

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

    public function update(Factura $Factura): int {
        try{
            $sql = "UPDATE facturas SET facturaNum = :facturaNum, idReserva = :idReserva, idFacturaTitular = :idFacturaTitular, importeBruto = :importeBruto, IVA = :IVA, descuento = :descuento WHERE idFactura = :idFactura LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idFactura", $Factura->getIdFactura());
$statement->bindValue(":facturaNum", $Factura->getFacturaNum());
$statement->bindValue(":idReserva", $Factura->getIdReserva());
$statement->bindValue(":idFacturaTitular", $Factura->getIdFacturaTitular());
$statement->bindValue(":importeBruto", $Factura->getImporteBruto());
$statement->bindValue(":IVA", $Factura->getIVA());
$statement->bindValue(":descuento", $Factura->getDescuento());

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
            $sql = "SELECT idFactura, facturaNum, idReserva, idFacturaTitular, importeBruto, IVA, descuento, fechaAlta, fehaUpdate 
            FROM facturas";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
            
            if(!empty($rows)){
                foreach($rows as $row){
                    $ret[] = new Factura($row->idFactura, $row->facturaNum, $row->idReserva, $row->idFacturaTitular, $row->importeBruto, $row->IVA, $row->descuento, $row->fechaAlta, $row->fehaUpdate);
                }
            }
            
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }

    public function deleteByIds(array $ids = []): int {
        try{
            if(!isset($ids['idFactura'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM facturas";
            $sql .= " WHERE idFactura = :idFactura LIMIT 1;";
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