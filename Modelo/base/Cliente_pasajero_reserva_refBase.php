<?php

abstract class Cliente_pasajero_reserva_refBase extends ModelBase {

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

    public function getCliente(){
        $ClienteController = new ClienteController();
        $idCliente = $this->getIdCliente();
        $ClienteList = $ClienteController->select([['idCliente', '=', $idCliente]]);
        return $ClienteList[0];
    }

    public function getPasajero(){
        $PasajeroController = new PasajeroController();
        $idPasajero = $this->getIdPasajero();
        $PasajeroList = $PasajeroController->select([['idPasajero', '=', $idPasajero]]);
        return $PasajeroList[0];
    }

    public function getReserva(){
        $ReservaController = new ReservaController();
        $idReserva = $this->getIdReserva();
        $ReservaList = $ReservaController->select([['idReserva', '=', $idReserva]]);
        return $ReservaList[0];
    }

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