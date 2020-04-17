<?php

abstract class PuertoBase extends ModelBase {

    protected $idPuerto;
    protected $nombre;
    protected $codigo;
    protected $idTipo;

    public function __construct(
        $idPuerto = 0,
        $nombre = '',
        $codigo = '',
        $idTipo = 0
    ){
        $this->setIdPuerto($idPuerto);
        $this->setNombre($nombre);
        $this->setCodigo($codigo);
        $this->setIdTipo($idTipo);
    }

    public function __toString(){
        return $this->nombre;
    }

    public function getIdPuerto(){ return $this->idPuerto; }

    public function getNombre(){ return $this->nombre; }

    public function getCodigo(){ return $this->codigo; }

    public function getIdTipo(){ return $this->idTipo; }

    public function getTipo(){
        $TipoController = new TipoController();
        $idTipo = $this->getIdTipo();
        $TipoList = $TipoController->select([['idTipo', $idTipo]]);
        return $TipoList[0];
    }

    public function setIdPuerto($idPuerto = 0){
        $this->idPuerto = (int) $idPuerto; return $this;
    }

    public function setNombre($nombre = ''){
        $this->nombre = (string) $nombre; return $this;
    }

    public function setCodigo($codigo = ''){
        $this->codigo = (string) $codigo; return $this;
    }

    public function setIdTipo($idTipo = 0){
        $this->idTipo = (int) $idTipo; return $this;
    }

}