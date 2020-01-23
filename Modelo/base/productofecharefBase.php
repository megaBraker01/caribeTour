<?php

require_once 'AutoLoader/AutoLoader.php';

abstract class ProductofecharefBase extends ModelBase {

    protected $idProductoFechaRef;
    protected $idProducto;
    protected $idFechaSalida;
    protected $idFechaVuelta;
    protected $precioProveedor;
    protected $comision;

    public function __construct(
        $idProductoFechaRef = 0,
        $idProducto = 0,
        $idFechaSalida = 0,
        $idFechaVuelta = 0,
        $precioProveedor = 0,
        $comision = 0
    ){
        $this->setIdProductoFechaRef($idProductoFechaRef);
        $this->setIdProducto($idProducto);
        $this->setIdFechaSalida($idFechaSalida);
        $this->setIdFechaVuelta($idFechaVuelta);
        $this->setPrecioProveedor($precioProveedor);
        $this->setComision($comision);
    }

    public function getIdProductoFechaRef(){ return $this->idProductoFechaRef; }

    public function getIdProducto(){ return $this->idProducto; }

    public function getIdFechaSalida(){ return $this->idFechaSalida; }

    public function getIdFechaVuelta(){ return $this->idFechaVuelta; }

    public function getPrecioProveedor(){ return $this->precioProveedor; }

    public function getComision(){ return $this->comision; }

    public function setIdProductoFechaRef($idProductoFechaRef = 0){
        $this->idProductoFechaRef = (int) $idProductoFechaRef; return $this;
    }

    public function setIdProducto($idProducto = 0){
        $this->idProducto = (int) $idProducto; return $this;
    }

    public function setIdFechaSalida($idFechaSalida = 0){
        $this->idFechaSalida = (int) $idFechaSalida; return $this;
    }

    public function setIdFechaVuelta($idFechaVuelta = 0){
        $this->idFechaVuelta = (int) $idFechaVuelta; return $this;
    }

    public function setPrecioProveedor($precioProveedor = 0){
        $this->precioProveedor = (float) $precioProveedor; return $this;
    }

    public function setComision($comision = 0){
        $this->comision = (int) $comision; return $this;
    }

}