<?php

abstract class PagoBase extends ModelBase {

    protected $idPago;
    protected $idReserva;
    protected $importe;
    protected $idPagoTipo;
    protected $idEstado;
    protected $fechaAlta;

    public function __construct(
        $idPago = 0,
        $idReserva = 0,
        $importe = 0,
        $idPagoTipo = 0,
        $idEstado = 1,
        $fechaAlta = ''
    ){
        $this->setIdPago($idPago);
        $this->setIdReserva($idReserva);
        $this->setImporte($importe);
        $this->setIdPagoTipo($idPagoTipo);
        $this->setIdEstado($idEstado);
        $this->setFechaAlta($fechaAlta);
    }

    public function getIdPago(){ return $this->idPago; }

    public function getIdReserva(){ return $this->idReserva; }

    public function getImporte(){ return $this->importe; }

    public function getIdPagoTipo(){ return $this->idPagoTipo; }

    public function getIdEstado(){ return $this->idEstado; }

    public function getFechaAlta(){ return $this->fechaAlta; }

    public function getReserva(){
        $ReservaController = new ReservaController();
        $idReserva = $this->getIdReserva();
        $ReservaList = $ReservaController->select([['idReserva', $idReserva]]);
        return $ReservaList[0];
    }

    public function getPagoTipo(){
        $PagoTipoController = new PagoTipoController();
        $idPagoTipo = $this->getIdPagoTipo();
        $PagoTipoList = $PagoTipoController->select([['idPagoTipo', $idPagoTipo]]);
        return $PagoTipoList[0];
    }

    public function getEstado(){
        $EstadoController = new EstadoController();
        $idEstado = $this->getIdEstado();
        $EstadoList = $EstadoController->select([['idEstado', $idEstado]]);
        return $EstadoList[0];
    }

    public function setIdPago($idPago = 0){
        $this->idPago = (int) $idPago; return $this;
    }

    public function setIdReserva($idReserva = 0){
        $this->idReserva = (int) $idReserva; return $this;
    }

    public function setImporte($importe = 0){
        $this->importe = (float) $importe; return $this;
    }

    public function setIdPagoTipo($idPagoTipo = 0){
        $this->idPagoTipo = (int) $idPagoTipo; return $this;
    }

    public function setIdEstado($idEstado = 1){
        $this->idEstado = (int) $idEstado; return $this;
    }

    public function setFechaAlta($fechaAlta = ''){
        $this->fechaAlta = (string) $fechaAlta; return $this;
    }

}