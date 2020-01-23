<?php

require_once 'AutoLoader/AutoLoader.php';

abstract class PermisoBase extends ModelBase {

    protected $idPermiso;
    protected $nombre;

    public function __construct(
        $idPermiso = 0,
        $nombre = ''
    ){
        $this->setIdPermiso($idPermiso);
        $this->setNombre($nombre);
    }

    public function __toString(){
        return $this->nombre;
    }

    public function getIdPermiso(){ return $this->idPermiso; }

    public function getNombre(){ return $this->nombre; }

    public function setIdPermiso($idPermiso = 0){
        $this->idPermiso = (int) $idPermiso; return $this;
    }

    public function setNombre($nombre = ''){
        $this->nombre = (string) $nombre; return $this;
    }

}