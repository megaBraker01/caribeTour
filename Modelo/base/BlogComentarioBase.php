<?php

abstract class BlogComentarioBase extends ModelBase {

    protected $idBlogComentario;
    protected $idBlog;
    protected $idEstado;
    protected $nombre;
    protected $email;
    protected $comentario;
    protected $fechaAlta;

    public function __construct(
        $idBlogComentario = 0,
        $idBlog = 0,
        $idEstado = 0,
        $nombre = '',
        $email = '',
        $comentario = '',
        $fechaAlta = ''
    ){
        $this->setIdBlogComentario($idBlogComentario);
        $this->setIdBlog($idBlog);
        $this->setIdEstado($idEstado);
        $this->setNombre($nombre);
        $this->setEmail($email);
        $this->setComentario($comentario);
        $this->setFechaAlta($fechaAlta);
    }

    public function __toString(){
        return $this->nombre;
    }

    public function getIdBlogComentario(){ return $this->idBlogComentario; }

    public function getIdBlog(){ return $this->idBlog; }

    public function getIdEstado(){ return $this->idEstado; }

    public function getNombre(){ return $this->nombre; }

    public function getEmail(){ return $this->email; }

    public function getComentario(){ return $this->comentario; }

    public function getFechaAlta(){ return $this->fechaAlta; }

    public function getBlog(){
        $BlogController = new BlogController();
        $idBlog = $this->getIdBlog();
        $BlogList = $BlogController->select([['idBlog', '=', $idBlog]]);
        return $BlogList[0];
    }

    public function getEstado(){
        $EstadoController = new EstadoController();
        $idEstado = $this->getIdEstado();
        $EstadoList = $EstadoController->select([['idEstado', '=', $idEstado]]);
        return $EstadoList[0];
    }

    public function setIdBlogComentario($idBlogComentario = 0){
        $this->idBlogComentario = (int) $idBlogComentario; return $this;
    }

    public function setIdBlog($idBlog = 0){
        $this->idBlog = (int) $idBlog; return $this;
    }

    public function setIdEstado($idEstado = 0){
        $this->idEstado = (int) $idEstado; return $this;
    }

    public function setNombre($nombre = ''){
        $this->nombre = (string) $nombre; return $this;
    }

    public function setEmail($email = ''){
        $this->email = (string) $email; return $this;
    }

    public function setComentario($comentario = ''){
        $this->comentario = (string) $comentario; return $this;
    }

    public function setFechaAlta($fechaAlta = ''){
        $this->fechaAlta = (string) $fechaAlta; return $this;
    }

}