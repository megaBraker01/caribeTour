<?php

abstract class EstadoTablaRefBase extends ModelBase {

    protected $idEstado;
    protected $tabla;

    public function __construct(
        $idEstado = 0,
        $tabla = ''
    ){
        $this->setIdEstado($idEstado);
        $this->setTabla($tabla);
    }

    public function getIdEstado(){ return $this->idEstado; }

    public function getTabla(){ return $this->tabla; }

    public function getEstado(){
        $EstadoController = new EstadoController();
        $idEstado = $this->getIdEstado();
        $EstadoList = $EstadoController->select([['idEstado', $idEstado]]);
        return $EstadoList[0];
    }

    public function setIdEstado($idEstado = 0){
        $this->idEstado = (int) $idEstado; return $this;
    }

    public function setTabla($tabla = ''){
        $this->tabla = (string) $tabla; return $this;
    }

}