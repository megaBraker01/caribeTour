<?php

require_once 'AutoLoader/AutoLoader.php';

abstract class EstadoBase extends ModelBase {

    protected $idEstado;
    protected $nombre;
    protected $productos;
    protected $categorias;
    protected $blogComentarios;
    protected $blos;
    protected $proveedores;
    protected $pagos;
    protected $reservas;
    protected $clientes;
    protected $usuarios;
    protected $legales;

    public function __construct(
        $idEstado = 0,
        $nombre = '',
        $productos = 0,
        $categorias = 0,
        $blogComentarios = 0,
        $blos = 0,
        $proveedores = 0,
        $pagos = 0,
        $reservas = 0,
        $clientes = 0,
        $usuarios = 0,
        $legales = 0
    ){
        $this->setIdEstado($idEstado);
        $this->setNombre($nombre);
        $this->setProductos($productos);
        $this->setCategorias($categorias);
        $this->setBlogComentarios($blogComentarios);
        $this->setBlos($blos);
        $this->setProveedores($proveedores);
        $this->setPagos($pagos);
        $this->setReservas($reservas);
        $this->setClientes($clientes);
        $this->setUsuarios($usuarios);
        $this->setLegales($legales);
    }

    public function __toString(){
        return $this->nombre;
    }

    public function getIdEstado(){ return $this->idEstado; }

    public function getNombre(){ return $this->nombre; }

    public function getProductos(){ return $this->productos; }

    public function getCategorias(){ return $this->categorias; }

    public function getBlogComentarios(){ return $this->blogComentarios; }

    public function getBlos(){ return $this->blos; }

    public function getProveedores(){ return $this->proveedores; }

    public function getPagos(){ return $this->pagos; }

    public function getReservas(){ return $this->reservas; }

    public function getClientes(){ return $this->clientes; }

    public function getUsuarios(){ return $this->usuarios; }

    public function getLegales(){ return $this->legales; }

    public function setIdEstado($idEstado = 0){
        $this->idEstado = (int) $idEstado; return $this;
    }

    public function setNombre($nombre = ''){
        $this->nombre = (string) $nombre; return $this;
    }

    public function setProductos($productos = 0){
        $this->productos = (int) $productos; return $this;
    }

    public function setCategorias($categorias = 0){
        $this->categorias = (int) $categorias; return $this;
    }

    public function setBlogComentarios($blogComentarios = 0){
        $this->blogComentarios = (int) $blogComentarios; return $this;
    }

    public function setBlos($blos = 0){
        $this->blos = (int) $blos; return $this;
    }

    public function setProveedores($proveedores = 0){
        $this->proveedores = (int) $proveedores; return $this;
    }

    public function setPagos($pagos = 0){
        $this->pagos = (int) $pagos; return $this;
    }

    public function setReservas($reservas = 0){
        $this->reservas = (int) $reservas; return $this;
    }

    public function setClientes($clientes = 0){
        $this->clientes = (int) $clientes; return $this;
    }

    public function setUsuarios($usuarios = 0){
        $this->usuarios = (int) $usuarios; return $this;
    }

    public function setLegales($legales = 0){
        $this->legales = (int) $legales; return $this;
    }

}