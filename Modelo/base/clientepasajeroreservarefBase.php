<?php

require_once 'AutoLoader/AutoLoader.php';

abstract class ClientepasajeroreservarefBase extends ModelBase {

    protected $idCliente;
    protected $idPasajero;
    protected $idReserva;

    public function __construct(
        $idCliente = 0,
        $idPasajero = 0,
        $idReserva = 0
    ){
        $this->setIdCliente($idCliente);
        $this->setIdPasajero($idPasajero);
        $this->setIdReserva($idReserva);
    }

    public function getIdCliente(){ return $this->idCliente; }

    public function getIdPasajero(){ return $this->idPasajero; }

    public function getIdReserva(){ return $this->idReserva; }

    public function setIdCliente($idCliente = 0){
        $this->idCliente = (int) $idCliente; return $this;
    }

    public function setIdPasajero($idPasajero = 0){
        $this->idPasajero = (int) $idPasajero; return $this;
    }

    public function setIdReserva($idReserva = 0){
        $this->idReserva = (int) $idReserva; return $this;
    }

}