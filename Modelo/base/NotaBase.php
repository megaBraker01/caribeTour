<?php

abstract class NotaBase extends ModelBase {

    protected $idNota;
    protected $tabla;
    protected $idTabla;
    protected $nota;
    protected $idUsuario;
    protected $fechaAlta;
    protected $fechaUpdate;

    public function __construct(
        $idNota = 0,
        $tabla = '',
        $idTabla = 0,
        $nota = '',
        $idUsuario = 1,
        $fechaAlta = '',
        $fechaUpdate = ''
    ){
        $this->setIdNota($idNota);
        $this->setTabla($tabla);
        $this->setIdTabla($idTabla);
        $this->setNota($nota);
        $this->setIdUsuario($idUsuario);
        $this->setFechaAlta($fechaAlta);
        $this->setFechaUpdate($fechaUpdate);
    }

    public function __toString(){
        return $this->nota;
    }

    public function getIdNota(){ return $this->idNota; }

    public function getTabla(){ return $this->tabla; }

    public function getIdTabla(){ return $this->idTabla; }

    public function getNota(){ return $this->nota; }

    public function getIdUsuario(){ return $this->idUsuario; }

    public function getFechaAlta(){ return $this->fechaAlta; }

    public function getFechaUpdate(){ return $this->fechaUpdate; }

    public function getUsuario(){
        $UsuarioController = new UsuarioController();
        $idUsuario = $this->getIdUsuario();
        $UsuarioList = $UsuarioController->select([['idUsuario', $idUsuario]]);
        return $UsuarioList[0];
    }

    public function setIdNota($idNota = 0){
        $this->idNota = (int) $idNota; return $this;
    }

    public function setTabla($tabla = ''){
        $this->tabla = (string) $tabla; return $this;
    }

    public function setIdTabla($idTabla = 0){
        $this->idTabla = (int) $idTabla; return $this;
    }

    public function setNota($nota = ''){
        $this->nota = (string) $nota; return $this;
    }

    public function setIdUsuario($idUsuario = 1){
        $this->idUsuario = (int) $idUsuario; return $this;
    }

    public function setFechaAlta($fechaAlta = ''){
        $this->fechaAlta = (string) $fechaAlta; return $this;
    }

    public function setFechaUpdate($fechaUpdate = ''){
        $this->fechaUpdate = (string) $fechaUpdate; return $this;
    }

}