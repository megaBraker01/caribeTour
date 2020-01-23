<?php

require_once 'AutoLoader/AutoLoader.php';

abstract class NotaBase extends ModelBase {

    protected $idNota;
    protected $nombreTabla;
    protected $idTabla;
    protected $nota;
    protected $idUsuario;
    protected $fechaAlta;
    protected $fechaUpdate;

    public function __construct(
        $idNota = 0,
        $nombreTabla = '',
        $idTabla = 0,
        $nota = '',
        $idUsuario = 0,
        $fechaAlta = '',
        $fechaUpdate = ''
    ){
        $this->setIdNota($idNota);
        $this->setNombreTabla($nombreTabla);
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

    public function getNombreTabla(){ return $this->nombreTabla; }

    public function getIdTabla(){ return $this->idTabla; }

    public function getNota(){ return $this->nota; }

    public function getIdUsuario(){ return $this->idUsuario; }

    public function getFechaAlta(){ return $this->fechaAlta; }

    public function getFechaUpdate(){ return $this->fechaUpdate; }

    public function setIdNota($idNota = 0){
        $this->idNota = (int) $idNota; return $this;
    }

    public function setNombreTabla($nombreTabla = ''){
        $this->nombreTabla = (string) $nombreTabla; return $this;
    }

    public function setIdTabla($idTabla = 0){
        $this->idTabla = (int) $idTabla; return $this;
    }

    public function setNota($nota = ''){
        $this->nota = (string) $nota; return $this;
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