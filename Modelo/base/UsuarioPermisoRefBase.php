<?php

abstract class UsuarioPermisoRefBase extends ModelBase {

    protected $idUsuario;
    protected $idPermiso;

    public function __construct(
        $idUsuario = 0,
        $idPermiso = 0
    ){
        $this->setIdUsuario($idUsuario);
        $this->setIdPermiso($idPermiso);
    }

    public function getIdUsuario(){ return $this->idUsuario; }

    public function getIdPermiso(){ return $this->idPermiso; }

    public function getUsuario(){
        $UsuarioController = new UsuarioController();
        $idUsuario = $this->getIdUsuario();
        $UsuarioList = $UsuarioController->select([['idUsuario', $idUsuario]]);
        return $UsuarioList[0];
    }

    public function getPermiso(){
        $PermisoController = new PermisoController();
        $idPermiso = $this->getIdPermiso();
        $PermisoList = $PermisoController->select([['idPermiso', $idPermiso]]);
        return $PermisoList[0];
    }

    public function setIdUsuario($idUsuario = 0){
        $this->idUsuario = (int) $idUsuario; return $this;
    }

    public function setIdPermiso($idPermiso = 0){
        $this->idPermiso = (int) $idPermiso; return $this;
    }

}