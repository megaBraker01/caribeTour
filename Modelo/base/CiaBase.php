<?php

abstract class CiaBase extends ModelBase {

    protected $idCia;
    protected $nombre;
    protected $codigo;

    public function __construct(
        $idCia = 0,
        $nombre = '',
        $codigo = ''
    ){
        $this->setIdCia($idCia);
        $this->setNombre($nombre);
        $this->setCodigo($codigo);
    }

    public function __toString(){
        return $this->nombre;
    }

    public function getIdCia(){ return $this->idCia; }

    public function getNombre(){ return $this->nombre; }

    public function getCodigo(){ return $this->codigo; }

    public function setIdCia($idCia = 0){
        $this->idCia = (int) $idCia; return $this;
    }

    public function setNombre($nombre = ''){
        $this->nombre = (string) $nombre; return $this;
    }

    public function setCodigo($codigo = ''){
        $this->codigo = (string) $codigo; return $this;
    }

}