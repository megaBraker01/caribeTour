<?php

abstract class TipoBase extends ModelBase {

    protected $idTipo;
    protected $nombre;
    protected $productos;
    protected $contactos;
    protected $pagos;

    public function __construct(
        $idTipo = 0,
        $nombre = '',
        $productos = 0,
        $contactos = 0,
        $pagos = 0
    ){
        $this->setIdTipo($idTipo);
        $this->setNombre($nombre);
        $this->setProductos($productos);
        $this->setContactos($contactos);
        $this->setPagos($pagos);
    }

    public function __toString(){
        return $this->nombre;
    }

    public function getIdTipo(){ return $this->idTipo; }

    public function getNombre(){ return $this->nombre; }

    public function getProductos(){ return $this->productos; }

    public function getContactos(){ return $this->contactos; }

    public function getPagos(){ return $this->pagos; }

    public function setIdTipo($idTipo = 0){
        $this->idTipo = (int) $idTipo; return $this;
    }

    public function setNombre($nombre = ''){
        $this->nombre = (string) $nombre; return $this;
    }

    public function setProductos($productos = 0){
        $this->productos = (int) $productos; return $this;
    }

    public function setContactos($contactos = 0){
        $this->contactos = (int) $contactos; return $this;
    }

    public function setPagos($pagos = 0){
        $this->pagos = (int) $pagos; return $this;
    }

}