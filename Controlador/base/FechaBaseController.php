<?php

abstract class FechaBaseController extends BaseController {



    public function insert(Fecha $Fecha): int {
        try{
            $sql = "INSERT INTO fechas (fecha, terminalSalida, terminalDestino, tasasSalida, tasasDestino) 
            VALUES (:fecha, :terminalSalida, :terminalDestino, :tasasSalida, :tasasDestino);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":fecha", $Fecha->getFecha());
$statement->bindValue(":terminalSalida", $Fecha->getTerminalSalida());
$statement->bindValue(":terminalDestino", $Fecha->getTerminalDestino());
$statement->bindValue(":tasasSalida", $Fecha->getTasasSalida());
$statement->bindValue(":tasasDestino", $Fecha->getTasasDestino());

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

    public function update(Fecha $Fecha): int {
        try{
            $sql = "UPDATE fechas SET fecha = :fecha, terminalSalida = :terminalSalida, terminalDestino = :terminalDestino, tasasSalida = :tasasSalida, tasasDestino = :tasasDestino WHERE idFecha = :idFecha LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idFecha", $Fecha->getIdFecha());
$statement->bindValue(":fecha", $Fecha->getFecha());
$statement->bindValue(":terminalSalida", $Fecha->getTerminalSalida());
$statement->bindValue(":terminalDestino", $Fecha->getTerminalDestino());
$statement->bindValue(":tasasSalida", $Fecha->getTasasSalida());
$statement->bindValue(":tasasDestino", $Fecha->getTasasDestino());

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
            $sql = "SELECT idFecha, fecha, terminalSalida, terminalDestino, tasasSalida, tasasDestino 
            FROM fechas
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
                    $ret[] = new Fecha($row->idFecha, $row->fecha, $row->terminalSalida, $row->terminalDestino, $row->tasasSalida, $row->tasasDestino);
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
            if(!isset($ids['idFecha'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM fechas";
            $sql .= " WHERE idFecha = :idFecha LIMIT 1;";
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