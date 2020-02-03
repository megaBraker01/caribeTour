<?php

abstract class EstadoBaseController extends baseController {



    public function insert(Estado $Estado): int {
        try{
            $sql = "INSERT INTO estados (nombre, productos, categorias, blogComentarios, blos, proveedores, pagos, reservas, clientes, usuarios, legales) 
            VALUES (:nombre, :productos, :categorias, :blogComentarios, :blos, :proveedores, :pagos, :reservas, :clientes, :usuarios, :legales);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":nombre", $Estado->getNombre());
$statement->bindValue(":productos", $Estado->getProductos());
$statement->bindValue(":categorias", $Estado->getCategorias());
$statement->bindValue(":blogComentarios", $Estado->getBlogComentarios());
$statement->bindValue(":blos", $Estado->getBlos());
$statement->bindValue(":proveedores", $Estado->getProveedores());
$statement->bindValue(":pagos", $Estado->getPagos());
$statement->bindValue(":reservas", $Estado->getReservas());
$statement->bindValue(":clientes", $Estado->getClientes());
$statement->bindValue(":usuarios", $Estado->getUsuarios());
$statement->bindValue(":legales", $Estado->getLegales());

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

    public function update(Estado $Estado): int {
        try{
            $sql = "UPDATE estados SET nombre = :nombre, productos = :productos, categorias = :categorias, blogComentarios = :blogComentarios, blos = :blos, proveedores = :proveedores, pagos = :pagos, reservas = :reservas, clientes = :clientes, usuarios = :usuarios, legales = :legales WHERE idEstado = :idEstado LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idEstado", $Estado->getIdEstado());
$statement->bindValue(":nombre", $Estado->getNombre());
$statement->bindValue(":productos", $Estado->getProductos());
$statement->bindValue(":categorias", $Estado->getCategorias());
$statement->bindValue(":blogComentarios", $Estado->getBlogComentarios());
$statement->bindValue(":blos", $Estado->getBlos());
$statement->bindValue(":proveedores", $Estado->getProveedores());
$statement->bindValue(":pagos", $Estado->getPagos());
$statement->bindValue(":reservas", $Estado->getReservas());
$statement->bindValue(":clientes", $Estado->getClientes());
$statement->bindValue(":usuarios", $Estado->getUsuarios());
$statement->bindValue(":legales", $Estado->getLegales());

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
            $sql = "SELECT idEstado, nombre, productos, categorias, blogComentarios, blos, proveedores, pagos, reservas, clientes, usuarios, legales 
            FROM estados
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
                    $ret[] = new Estado($row->idEstado, $row->nombre, $row->productos, $row->categorias, $row->blogComentarios, $row->blos, $row->proveedores, $row->pagos, $row->reservas, $row->clientes, $row->usuarios, $row->legales);
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
            if(!isset($ids['idEstado'])){
                throw new Exception('Para eliminar un registro, se tiene que especificar sus ids');
            }
            $sql = "DELETE FROM estados";
            $sql .= " WHERE idEstado = :idEstado LIMIT 1;";
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