<?php

require_once SITE_ROOT ."/AutoLoader/autoLoaderModelo.php";

abstract class CategoriaBase extends ModelBase {

    protected $idCategoria;
    protected $idCategoriaPadre;
    protected $nombre;
    protected $slug;
    protected $descripcion;
    protected $idEstado;
    protected $srcImagen;

    public function __construct(
        $idCategoria = 0,
        $idCategoriaPadre = 0,
        $nombre = '',
        $slug = '',
        $descripcion = '',
        $idEstado = 0,
        $srcImagen = ''
    ){
        $this->setIdCategoria($idCategoria);
        $this->setIdCategoriaPadre($idCategoriaPadre);
        $this->setNombre($nombre);
        $this->setSlug($slug);
        $this->setDescripcion($descripcion);
        $this->setIdEstado($idEstado);
        $this->setSrcImagen($srcImagen);
    }

    public function __toString(){
        return $this->nombre;
    }

    public function getIdCategoria(){ return $this->idCategoria; }

    public function getIdCategoriaPadre(){ return $this->idCategoriaPadre; }

    public function getNombre(){ return $this->nombre; }

    public function getSlug(){ return $this->slug; }

    public function getDescripcion(){ return $this->descripcion; }

    public function getIdEstado(){ return $this->idEstado; }

    public function getSrcImagen(){ return $this->srcImagen; }

    public function setIdCategoria($idCategoria = 0){
        $this->idCategoria = (int) $idCategoria; return $this;
    }

    public function setIdCategoriaPadre($idCategoriaPadre = 0){
        $this->idCategoriaPadre = (int) $idCategoriaPadre; return $this;
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

    public function setSrcImagen($srcImagen = ''){
        $this->srcImagen = (string) $srcImagen; return $this;
    }

}