<?php

abstract class TipoBase extends ModelBase {

    protected $idTipo;
    protected $nombre;

    public function __construct(
        $idTipo = 0,
        $nombre = ''
    ){
        $this->setIdTipo($idTipo);
        $this->setNombre($nombre);
    }

    public function __toString(){
        return $this->nombre;
    }

    public function getIdTipo(){ return $this->idTipo; }

    public function getNombre(){ return $this->nombre; }

    public function setIdTipo($idTipo = 0){
        $this->idTipo = (int) $idTipo; return $this;
    }

    public function setNombre($nombre = ''){
        $this->nombre = (string) $nombre; return $this;
    }

}