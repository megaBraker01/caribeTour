<?php

abstract class BlogBase extends ModelBase {

    protected $idBlog;
    protected $nombre;
    protected $slug;
    protected $metaDescripcion;
    protected $metaKeyWords;
    protected $descripcion;
    protected $srcImagen;
    protected $idUsuario;
    protected $idEstado;
    protected $fechaAlta;
    protected $fechaUpdate;

    public function __construct(
        $idBlog = 0,
        $nombre = '',
        $slug = '',
        $metaDescripcion = '',
        $metaKeyWords = '',
        $descripcion = '',
        $srcImagen = '',
        $idUsuario = 0,
        $idEstado = 1,
        $fechaAlta = '',
        $fechaUpdate = ''
    ){
        $this->setIdBlog($idBlog);
        $this->setNombre($nombre);
        $this->setSlug($slug);
        $this->setMetaDescripcion($metaDescripcion);
        $this->setMetaKeyWords($metaKeyWords);
        $this->setDescripcion($descripcion);
        $this->setSrcImagen($srcImagen);
        $this->setIdUsuario($idUsuario);
        $this->setIdEstado($idEstado);
        $this->setFechaAlta($fechaAlta);
        $this->setFechaUpdate($fechaUpdate);
    }

    public function __toString(){
        return $this->nombre;
    }

    public function getIdBlog(){ return $this->idBlog; }

    public function getNombre(){ return $this->nombre; }

    public function getSlug(){ return $this->slug; }

    public function getMetaDescripcion(){ return $this->metaDescripcion; }

    public function getMetaKeyWords(){ return $this->metaKeyWords; }

    public function getDescripcion(){ return $this->descripcion; }

    public function getSrcImagen(){ return $this->srcImagen; }

    public function getIdUsuario(){ return $this->idUsuario; }

    public function getIdEstado(){ return $this->idEstado; }

    public function getFechaAlta(){ return $this->fechaAlta; }

    public function getFechaUpdate(){ return $this->fechaUpdate; }

    public function getUsuario(){
        $UsuarioController = new UsuarioController();
        $idUsuario = $this->getIdUsuario();
        $UsuarioList = $UsuarioController->select([['idUsuario', $idUsuario]]);
        return $UsuarioList[0];
    }

    public function getEstado(){
        $EstadoController = new EstadoController();
        $idEstado = $this->getIdEstado();
        $EstadoList = $EstadoController->select([['idEstado', $idEstado]]);
        return $EstadoList[0];
    }

    public function setIdBlog($idBlog = 0){
        $this->idBlog = (int) $idBlog; return $this;
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

    public function setIdEstado($idEstado = 1){
        $this->idEstado = (int) $idEstado; return $this;
    }

    public function setFechaAlta($fechaAlta = ''){
        $this->fechaAlta = (string) $fechaAlta; return $this;
    }

    public function setFechaUpdate($fechaUpdate = ''){
        $this->fechaUpdate = (string) $fechaUpdate; return $this;
    }

}