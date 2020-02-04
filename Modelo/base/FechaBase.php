<?php

abstract class FechaBase extends ModelBase {

    protected $idFecha;
    protected $fecha;
    protected $terminalSalida;
    protected $terminalDestino;
    protected $tasasSalida;
    protected $tasasDestino;

    public function __construct(
        $idFecha = 0,
        $fecha = '',
        $terminalSalida = '',
        $terminalDestino = '',
        $tasasSalida = 0,
        $tasasDestino = 0
    ){
        $this->setIdFecha($idFecha);
        $this->setFecha($fecha);
        $this->setTerminalSalida($terminalSalida);
        $this->setTerminalDestino($terminalDestino);
        $this->setTasasSalida($tasasSalida);
        $this->setTasasDestino($tasasDestino);
    }

    public function __toString(){
        return $this->fecha;
    }

    public function getIdFecha(){ return $this->idFecha; }

    public function getFecha(){ return $this->fecha; }

    public function getTerminalSalida(){ return $this->terminalSalida; }

    public function getTerminalDestino(){ return $this->terminalDestino; }

    public function getTasasSalida(){ return $this->tasasSalida; }

    public function getTasasDestino(){ return $this->tasasDestino; }

    public function setIdFecha($idFecha = 0){
        $this->idFecha = (int) $idFecha; return $this;
    }

    public function setFecha($fecha = ''){
        $this->fecha = (string) $fecha; return $this;
    }

    public function setTerminalSalida($terminalSalida = ''){
        $this->terminalSalida = (string) $terminalSalida; return $this;
    }

    public function setTerminalDestino($terminalDestino = ''){
        $this->terminalDestino = (string) $terminalDestino; return $this;
    }

    public function setTasasSalida($tasasSalida = 0){
        $this->tasasSalida = (float) $tasasSalida; return $this;
    }

    public function setTasasDestino($tasasDestino = 0){
        $this->tasasDestino = (float) $tasasDestino; return $this;
    }

}