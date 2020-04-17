<?php

abstract class EstadoBaseController extends BaseController {



    public function insert(Estado $Estado): int {
        try{
            $sql = "INSERT INTO estados (nombre, productos, categorias, blogComentarios, blogs, proveedores, pagos, reservas, clientes, usuarios, legales) 
            VALUES (:nombre, :productos, :categorias, :blogComentarios, :blogs, :proveedores, :pagos, :reservas, :clientes, :usuarios, :legales);";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":nombre", $Estado->getNombre());
$statement->bindValue(":productos", $Estado->getProductos());
$statement->bindValue(":categorias", $Estado->getCategorias());
$statement->bindValue(":blogComentarios", $Estado->getBlogComentarios());
$statement->bindValue(":blogs", $Estado->getBlogs());
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
            $sql = "UPDATE estados SET nombre = :nombre, productos = :productos, categorias = :categorias, blogComentarios = :blogComentarios, blogs = :blogs, proveedores = :proveedores, pagos = :pagos, reservas = :reservas, clientes = :clientes, usuarios = :usuarios, legales = :legales WHERE idEstado = :idEstado LIMIT 1;";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
            $statement->bindValue(":idEstado", $Estado->getIdEstado());
$statement->bindValue(":nombre", $Estado->getNombre());
$statement->bindValue(":productos", $Estado->getProductos());
$statement->bindValue(":categorias", $Estado->getCategorias());
$statement->bindValue(":blogComentarios", $Estado->getBlogComentarios());
$statement->bindValue(":blogs", $Estado->getBlogs());
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

    public function select(array $filtros = [], array $ordenados = [], array $limitar = [], array $agrupar = []): array {
        try{
            $sql = "SELECT idEstado, nombre, productos, categorias, blogComentarios, blogs, proveedores, pagos, reservas, clientes, usuarios, legales 
            FROM estados";                        
            $ret = [];
            $rows = $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
            
            if(!empty($rows)){
                foreach($rows as $row){
                    $ret[] = new Estado($row->idEstado, $row->nombre, $row->productos, $row->categorias, $row->blogComentarios, $row->blogs, $row->proveedores, $row->pagos, $row->reservas, $row->clientes, $row->usuarios, $row->legales);
                }
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