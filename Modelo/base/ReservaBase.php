<?php

abstract class ReservaBase extends ModelBase {

    protected $idReserva;
    protected $idEstado;
    protected $idTipoPago;
    protected $fechaAlta;

    public function __construct(
        $idReserva = 0,
        $idEstado = 0,
        $idTipoPago = 12,
        $fechaAlta = ''
    ){
        $this->setIdReserva($idReserva);
        $this->setIdEstado($idEstado);
        $this->setIdTipoPago($idTipoPago);
        $this->setFechaAlta($fechaAlta);
    }

    public function getIdReserva(){ return $this->idReserva; }

    public function getIdEstado(){ return $this->idEstado; }

    public function getIdTipoPago(){ return $this->idTipoPago; }

    public function getFechaAlta(){ return $this->fechaAlta; }

    public function getEstado(){
        $EstadoController = new EstadoController();
        $idEstado = $this->getIdEstado();
        $EstadoList = $EstadoController->select([['idEstado', $idEstado]]);
        return $EstadoList[0];
    }

    public function getTipoPago(){
        $TipoPagoController = new TipoPagoController();
        $idTipoPago = $this->getIdTipoPago();
        $TipoPagoList = $TipoPagoController->select([['idTipoPago', $idTipoPago]]);
        return $TipoPagoList[0];
    }

    public function setIdReserva($idReserva = 0){
        $this->idReserva = (int) $idReserva; return $this;
    }

    public function setIdEstado($idEstado = 0){
        $this->idEstado = (int) $idEstado; return $this;
    }

    public function setIdTipoPago($idTipoPago = 12){
        $this->idTipoPago = (int) $idTipoPago; return $this;
    }

    public function setFechaAlta($fechaAlta = ''){
        $this->fechaAlta = (string) $fechaAlta; return $this;
    }

}