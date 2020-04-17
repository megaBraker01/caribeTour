<?php

abstract class TipoTablaRefBase extends ModelBase {

    protected $idTipo;
    protected $tabla;

    public function __construct(
        $idTipo = 0,
        $tabla = ''
    ){
        $this->setIdTipo($idTipo);
        $this->setTabla($tabla);
    }

    public function getIdTipo(){ return $this->idTipo; }

    public function getTabla(){ return $this->tabla; }

    public function getTipo(){
        $TipoController = new TipoController();
        $idTipo = $this->getIdTipo();
        $TipoList = $TipoController->select([['idTipo', $idTipo]]);
        return $TipoList[0];
    }

    public function setIdTipo($idTipo = 0){
        $this->idTipo = (int) $idTipo; return $this;
    }

    public function setTabla($tabla = ''){
        $this->tabla = (string) $tabla; return $this;
    }

}