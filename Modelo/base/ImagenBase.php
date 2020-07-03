<?php

abstract class ImagenBase extends ModelBase {

    protected $idImagen;
    protected $tabla;
    protected $idTabla;
    protected $srcImagen;
    protected $fechaAlta;
    protected $fehaUpdate;

    public function __construct(
        $idImagen = 0,
        $tabla = '',
        $idTabla = 0,
        $srcImagen = '',
        $fechaAlta = '',
        $fehaUpdate = ''
    ){
        $this->setIdImagen($idImagen);
        $this->setTabla($tabla);
        $this->setIdTabla($idTabla);
        $this->setSrcImagen($srcImagen);
        $this->setFechaAlta($fechaAlta);
        $this->setFehaUpdate($fehaUpdate);
    }

    public function __toString(){
        return $this->srcImagen;
    }

    public function getIdImagen(){ return $this->idImagen; }

    public function getTabla(){ return $this->tabla; }

    public function getIdTabla(){ return $this->idTabla; }

    public function getSrcImagen(){ return $this->srcImagen; }

    public function getFechaAlta(){ return $this->fechaAlta; }

    public function getFehaUpdate(){ return $this->fehaUpdate; }

    public function setIdImagen($idImagen = 0){
        $this->idImagen = (int) $idImagen; return $this;
    }

    public function setTabla($tabla = ''){
        $this->tabla = (string) $tabla; return $this;
    }

    public function setIdTabla($idTabla = 0){
        $this->idTabla = (int) $idTabla; return $this;
    }

    public function setSrcImagen($srcImagen = ''){
        $this->srcImagen = (string) $srcImagen; return $this;
    }

    public function setFechaAlta($fechaAlta = ''){
        $this->fechaAlta = (string) $fechaAlta; return $this;
    }

    public function setFehaUpdate($fehaUpdate = ''){
        $this->fehaUpdate = (string) $fehaUpdate; return $this;
    }

}