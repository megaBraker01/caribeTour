<?php

abstract class EstadoBase extends ModelBase {

    protected $idEstado;
    protected $nombre;

    public function __construct(
        $idEstado = 0,
        $nombre = ''
    ){
        $this->setIdEstado($idEstado);
        $this->setNombre($nombre);
    }

    public function __toString(){
        return $this->nombre;
    }

    public function getIdEstado(){ return $this->idEstado; }

    public function getNombre(){ return $this->nombre; }

    public function setIdEstado($idEstado = 0){
        $this->idEstado = (int) $idEstado; return $this;
    }

    public function setNombre($nombre = ''){
        $this->nombre = (string) $nombre; return $this;
    }

}