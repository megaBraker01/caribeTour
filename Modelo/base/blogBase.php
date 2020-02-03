<?php

abstract class BlogBase extends ModelBase {

    protected $idblog;
    protected $nombre;
    protected $slug;
    protected $metaDescripcion;
    protected $metaKeyWords;
    protected $descripcion;
    protected $srcImagen;
    protected $idUsuario;
    protected $fechaAlta;
    protected $fechaUpdate;

    public function __construct(
        $idblog = 0,
        $nombre = '',
        $slug = '',
        $metaDescripcion = '',
        $metaKeyWords = '',
        $descripcion = '',
        $srcImagen = '',
        $idUsuario = 0,
        $fechaAlta = '',
        $fechaUpdate = ''
    ){
        $this->setIdblog($idblog);
        $this->setNombre($nombre);
        $this->setSlug($slug);
        $this->setMetaDescripcion($metaDescripcion);
        $this->setMetaKeyWords($metaKeyWords);
        $this->setDescripcion($descripcion);
        $this->setSrcImagen($srcImagen);
        $this->setIdUsuario($idUsuario);
        $this->setFechaAlta($fechaAlta);
        $this->setFechaUpdate($fechaUpdate);
    }

    public function __toString(){
        return $this->nombre;
    }

    public function getIdblog(){ return $this->idblog; }

    public function getNombre(){ return $this->nombre; }

    public function getSlug(){ return $this->slug; }

    public function getMetaDescripcion(){ return $this->metaDescripcion; }

    public function getMetaKeyWords(){ return $this->metaKeyWords; }

    public function getDescripcion(){ return $this->descripcion; }

    public function getSrcImagen(){ return $this->srcImagen; }

    public function getIdUsuario(){ return $this->idUsuario; }

    public function getFechaAlta(){ return $this->fechaAlta; }

    public function getFechaUpdate(){ return $this->fechaUpdate; }

    public function getUsuario(){
        $UsuarioController = new UsuarioController();
        $idUsuario = $this->getIdUsuario();
        $UsuarioList = $UsuarioController->select([['idUsuario', '=', $idUsuario]]);
        return $UsuarioList[0];
    }

    public function setIdblog($idblog = 0){
        $this->idblog = (int) $idblog; return $this;
    }

    public function setNombre($nombre = ''){
        $this->nombre = (string) $nombre; return $this;
    }

    public function setSlug($slug = ''){
        $this->slug = (string) $slug; return $this;
    }

    public function setMetaDescripcion($metaDescripcion = ''){
        $this->metaDescripcion = (string) $metaDescripcion; return $this;
    }

    public function setMetaKeyWords($metaKeyWords = ''){
        $this->metaKeyWords = (string) $metaKeyWords; return $this;
    }

    public function setDescripcion($descripcion = ''){
        $this->descripcion = (string) $descripcion; return $this;
    }

    public function setSrcImagen($srcImagen = ''){
        $this->srcImagen = (string) $srcImagen; return $this;
    }

    public function setIdUsuario($idUsuario = 0){
        $this->idUsuario = (int) $idUsuario; return $this;
    }

    public function setFechaAlta($fechaAlta = ''){
        $this->fechaAlta = (string) $fechaAlta; return $this;
    }

    public function setFechaUpdate($fechaUpdate = ''){
        $this->fechaUpdate = (string) $fechaUpdate; return $this;
    }

}