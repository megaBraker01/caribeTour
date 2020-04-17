<?php

abstract class FechaBase extends ModelBase {

    protected $idFecha;
    protected $fecha;
    protected $idPuertoSalida;
    protected $terminalSalida;
    protected $tasasSalida;
    protected $idPuertoDestino;
    protected $terminalDestino;
    protected $tasasDestino;
    protected $idCia;

    public function __construct(
        $idFecha = 0,
        $fecha = '',
        $idPuertoSalida = 1,
        $terminalSalida = '',
        $tasasSalida = 0,
        $idPuertoDestino = 1,
        $terminalDestino = '',
        $tasasDestino = 0,
        $idCia = 1
    ){
        $this->setIdFecha($idFecha);
        $this->setFecha($fecha);
        $this->setIdPuertoSalida($idPuertoSalida);
        $this->setTerminalSalida($terminalSalida);
        $this->setTasasSalida($tasasSalida);
        $this->setIdPuertoDestino($idPuertoDestino);
        $this->setTerminalDestino($terminalDestino);
        $this->setTasasDestino($tasasDestino);
        $this->setIdCia($idCia);
    }

    public function __toString(){
        return $this->fecha;
    }

    public function getIdFecha(){ return $this->idFecha; }

    public function getFecha(){ return $this->fecha; }

    public function getIdPuertoSalida(){ return $this->idPuertoSalida; }

    public function getTerminalSalida(){ return $this->terminalSalida; }

    public function getTasasSalida(){ return $this->tasasSalida; }

    public function getIdPuertoDestino(){ return $this->idPuertoDestino; }

    public function getTerminalDestino(){ return $this->terminalDestino; }

    public function getTasasDestino(){ return $this->tasasDestino; }

    public function getIdCia(){ return $this->idCia; }

    public function getPuertoSalida(){
        $PuertoSalidaController = new PuertoSalidaController();
        $idPuertoSalida = $this->getIdPuertoSalida();
        $PuertoSalidaList = $PuertoSalidaController->select([['idPuertoSalida', $idPuertoSalida]]);
        return $PuertoSalidaList[0];
    }

    public function getPuertoDestino(){
        $PuertoDestinoController = new PuertoDestinoController();
        $idPuertoDestino = $this->getIdPuertoDestino();
        $PuertoDestinoList = $PuertoDestinoController->select([['idPuertoDestino', $idPuertoDestino]]);
        return $PuertoDestinoList[0];
    }

    public function getCia(){
        $CiaController = new CiaController();
        $idCia = $this->getIdCia();
        $CiaList = $CiaController->select([['idCia', $idCia]]);
        return $CiaList[0];
    }

    public function setIdFecha($idFecha = 0){
        $this->idFecha = (int) $idFecha; return $this;
    }

    public function setFecha($fecha = ''){
        $this->fecha = (string) $fecha; return $this;
    }

    public function setIdPuertoSalida($idPuertoSalida = 1){
        $this->idPuertoSalida = (int) $idPuertoSalida; return $this;
    }

    public function setTerminalSalida($terminalSalida = ''){
        $this->terminalSalida = (string) $terminalSalida; return $this;
    }

    public function setTasasSalida($tasasSalida = 0){
        $this->tasasSalida = (float) $tasasSalida; return $this;
    }

    public function setIdPuertoDestino($idPuertoDestino = 1){
        $this->idPuertoDestino = (int) $idPuertoDestino; return $this;
    }

    public function setTerminalDestino($terminalDestino = ''){
        $this->terminalDestino = (string) $terminalDestino; return $this;
    }

    public function setTasasDestino($tasasDestino = 0){
        $this->tasasDestino = (float) $tasasDestino; return $this;
    }

    public function setIdCia($idCia = 1){
        $this->idCia = (int) $idCia; return $this;
    }

}