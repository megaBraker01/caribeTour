<?php

abstract class TipoFacturacionBase extends ModelBase {

    protected $idTipoFacturacion;
    protected $nombre;

    public function __construct(
        $idTipoFacturacion = 0,
        $nombre = ''
    ){
        $this->setIdTipoFacturacion($idTipoFacturacion);
        $this->setNombre($nombre);
    }

    public function __toString(){
        return $this->nombre;
    }

    public function getIdTipoFacturacion(){ return $this->idTipoFacturacion; }

    public function getNombre(){ return $this->nombre; }

    public function setIdTipoFacturacion($idTipoFacturacion = 0){
        $this->idTipoFacturacion = (int) $idTipoFacturacion; return $this;
    }

    public function setNombre($nombre = ''){
        $this->nombre = (string) $nombre; return $this;
    }

}