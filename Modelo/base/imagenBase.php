<?php

require_once 'AutoLoader/AutoLoader.php';

abstract class ImagenBase extends ModelBase {

    protected $idImagen;
    protected $idProducto;
    protected $srcImagen;
    protected $fechaAlta;
    protected $fehaUpdate;

    public function __construct(
        $idImagen = 0,
        $idProducto = 0,
        $srcImagen = '',
        $fechaAlta = '',
        $fehaUpdate = ''
    ){
        $this->setIdImagen($idImagen);
        $this->setIdProducto($idProducto);
        $this->setSrcImagen($srcImagen);
        $this->setFechaAlta($fechaAlta);
        $this->setFehaUpdate($fehaUpdate);
    }

    public function __toString(){
        return $this->srcImagen;
    }

    public function getIdImagen(){ return $this->idImagen; }

    public function getIdProducto(){ return $this->idProducto; }

    public function getSrcImagen(){ return $this->srcImagen; }

    public function getFechaAlta(){ return $this->fechaAlta; }

    public function getFehaUpdate(){ return $this->fehaUpdate; }

    public function setIdImagen($idImagen = 0){
        $this->idImagen = (int) $idImagen; return $this;
    }

    public function setIdProducto($idProducto = 0){
        $this->idProducto = (int) $idProducto; return $this;
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