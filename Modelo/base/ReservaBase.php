<?php

abstract class ReservaBase extends ModelBase {

    protected $idReserva;
    protected $idProductoFechaRef;
    protected $idEstado;
    protected $idTipo;
    protected $pvpTotal;
    protected $fechaAlta;

    public function __construct(
        $idReserva = 0,
        $idProductoFechaRef = 0,
        $idEstado = 0,
        $idTipo = 12,
        $pvpTotal = 0,
        $fechaAlta = ''
    ){
        $this->setIdReserva($idReserva);
        $this->setIdProductoFechaRef($idProductoFechaRef);
        $this->setIdEstado($idEstado);
        $this->setIdTipo($idTipo);
        $this->setPvpTotal($pvpTotal);
        $this->setFechaAlta($fechaAlta);
    }

    public function getIdReserva(){ return $this->idReserva; }

    public function getIdProductoFechaRef(){ return $this->idProductoFechaRef; }

    public function getIdEstado(){ return $this->idEstado; }

    public function getIdTipo(){ return $this->idTipo; }

    public function getPvpTotal(){ return $this->pvpTotal; }

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

    public function getTipo(){
        $TipoController = new TipoController();
        $idTipo = $this->getIdTipo();
        $TipoList = $TipoController->select([['idTipo', $idTipo]]);
        return $TipoList[0];
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

    public function setIdTipo($idTipo = 12){
        $this->idTipo = (int) $idTipo; return $this;
    }

    public function setPvpTotal($pvpTotal = 0){
        $this->pvpTotal = (float) $pvpTotal; return $this;
    }

    public function setFechaAlta($fechaAlta = ''){
        $this->fechaAlta = (string) $fechaAlta; return $this;
    }

}