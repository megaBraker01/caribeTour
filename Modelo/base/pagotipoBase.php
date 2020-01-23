<?php

require_once 'AutoLoader/AutoLoader.php';

abstract class PagotipoBase extends ModelBase {

    protected $idPagoTipo;
    protected $nombre;

    public function __construct(
        $idPagoTipo = 0,
        $nombre = ''
    ){
        $this->setIdPagoTipo($idPagoTipo);
        $this->setNombre($nombre);
    }

    public function __toString(){
        return $this->nombre;
    }

    public function getIdPagoTipo(){ return $this->idPagoTipo; }

    public function getNombre(){ return $this->nombre; }

    public function setIdPagoTipo($idPagoTipo = 0){
        $this->idPagoTipo = (int) $idPagoTipo; return $this;
    }

    public function setNombre($nombre = ''){
        $this->nombre = (string) $nombre; return $this;
    }

}