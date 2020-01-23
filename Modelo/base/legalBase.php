<?php

require_once 'AutoLoader/AutoLoader.php';

abstract class LegalBase extends ModelBase {

    protected $idLegal;
    protected $nombre;
    protected $slug;
    protected $descripcion;
    protected $idEstado;

    public function __construct(
        $idLegal = 0,
        $nombre = '',
        $slug = '',
        $descripcion = '',
        $idEstado = 0
    ){
        $this->setIdLegal($idLegal);
        $this->setNombre($nombre);
        $this->setSlug($slug);
        $this->setDescripcion($descripcion);
        $this->setIdEstado($idEstado);
    }

    public function __toString(){
        return $this->nombre;
    }

    public function getIdLegal(){ return $this->idLegal; }

    public function getNombre(){ return $this->nombre; }

    public function getSlug(){ return $this->slug; }

    public function getDescripcion(){ return $this->descripcion; }

    public function getIdEstado(){ return $this->idEstado; }

    public function setIdLegal($idLegal = 0){
        $this->idLegal = (int) $idLegal; return $this;
    }

    public function setNombre($nombre = ''){
        $this->nombre = (string) $nombre; return $this;
    }

    public function setSlug($slug = ''){
        $this->slug = (string) $slug; return $this;
    }

    public function setDescripcion($descripcion = ''){
        $this->descripcion = (string) $descripcion; return $this;
    }

    public function setIdEstado($idEstado = 0){
        $this->idEstado = (int) $idEstado; return $this;
    }

}