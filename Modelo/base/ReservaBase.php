<?php

abstract class ReservaBase extends ModelBase {

    protected $idReserva;
    protected $idProductoFechaRef;
    protected $idEstado;
    protected $importe;
    protected $fechaAlta;

    public function __construct(
        $idReserva = 0,
        $idProductoFechaRef = 0,
        $idEstado = 0,
        $importe = 0,
        $fechaAlta = ''
    ){
        $this->setIdReserva($idReserva);
        $this->setIdProductoFechaRef($idProductoFechaRef);
        $this->setIdEstado($idEstado);
        $this->setImporte($importe);
        $this->setFechaAlta($fechaAlta);
    }

    public function getIdReserva(){ return $this->idReserva; }

    public function getIdProductoFechaRef(){ return $this->idProductoFechaRef; }

    public function getIdEstado(){ return $this->idEstado; }

    public function getImporte(){ return $this->importe; }

    public function getFechaAlta(){ return $this->fechaAlta; }

    public function getProductoFechaRef(){
        $ProductoFechaRefController = new ProductoFechaRefController();
        $idProductoFechaRef = $this->getIdProductoFechaRef();
        $ProductoFechaRefList = $ProductoFechaRefController->select([['idProductoFechaRef', $idProductoFechaRef]]);
        return $ProductoFechaRefList[0];
    }

    public function getEstado(){
        $EstadoController = new EstadoController();
        $idEstado = $this->getIdEstado();
        $EstadoList = $EstadoController->select([['idEstado', $idEstado]]);
        return $EstadoList[0];
    }

    public function setIdReserva($idReserva = 0){
        $this->idReserva = (int) $idReserva; return $this;
    }

    public function setIdProductoFechaRef($idProductoFechaRef = 0){
        $this->idProductoFechaRef = (int) $idProductoFechaRef; return $this;
    }

    public function setIdEstado($idEstado = 0){
        $this->idEstado = (int) $idEstado; return $this;
    }

    public function setImporte($importe = 0){
        $this->importe = (float) $importe; return $this;
    }

    public function setFechaAlta($fechaAlta = ''){
        $this->fechaAlta = (string) $fechaAlta; return $this;
    }

}