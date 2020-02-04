<?php

abstract class DocumentoBase extends ModelBase {

    protected $idDocumento;
    protected $nombre;
    protected $path;
    protected $nombreTabla;
    protected $idTabla;
    protected $idUsuario;
    protected $fechaAlta;

    public function __construct(
        $idDocumento = 0,
        $nombre = '',
        $path = '',
        $nombreTabla = '',
        $idTabla = 0,
        $idUsuario = 0,
        $fechaAlta = ''
    ){
        $this->setIdDocumento($idDocumento);
        $this->setNombre($nombre);
        $this->setPath($path);
        $this->setNombreTabla($nombreTabla);
        $this->setIdTabla($idTabla);
        $this->setIdUsuario($idUsuario);
        $this->setFechaAlta($fechaAlta);
    }

    public function __toString(){
        return $this->nombreTabla;
    }

    public function getIdDocumento(){ return $this->idDocumento; }

    public function getNombre(){ return $this->nombre; }

    public function getPath(){ return $this->path; }

    public function getNombreTabla(){ return $this->nombreTabla; }

    public function getIdTabla(){ return $this->idTabla; }

    public function getIdUsuario(){ return $this->idUsuario; }

    public function getFechaAlta(){ return $this->fechaAlta; }

    public function getTabla(){
        $TablaController = new TablaController();
        $idTabla = $this->getIdTabla();
        $TablaList = $TablaController->select([['idTabla', '=', $idTabla]]);
        return $TablaList[0];
    }

    public function getUsuario(){
        $UsuarioController = new UsuarioController();
        $idUsuario = $this->getIdUsuario();
        $UsuarioList = $UsuarioController->select([['idUsuario', '=', $idUsuario]]);
        return $UsuarioList[0];
    }

    public function setIdDocumento($idDocumento = 0){
        $this->idDocumento = (int) $idDocumento; return $this;
    }

    public function setNombre($nombre = ''){
        $this->nombre = (string) $nombre; return $this;
    }

    public function setPath($path = ''){
        $this->path = (string) $path; return $this;
    }

    public function setNombreTabla($nombreTabla = ''){
        $this->nombreTabla = (string) $nombreTabla; return $this;
    }

    public function setIdTabla($idTabla = 0){
        $this->idTabla = (int) $idTabla; return $this;
    }

    public function setIdUsuario($idUsuario = 0){
        $this->idUsuario = (int) $idUsuario; return $this;
    }

    public function setFechaAlta($fechaAlta = ''){
        $this->fechaAlta = (string) $fechaAlta; return $this;
    }

}