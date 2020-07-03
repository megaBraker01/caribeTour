<?php

abstract class ContactoBase extends ModelBase {

    protected $idContacto;
    protected $idTipo;
    protected $contacto;
    protected $personaContacto;
    protected $tabla;
    protected $idTabla;
    protected $fechaAlta;
    protected $fechaUpdate;

    public function __construct(
        $idContacto = 0,
        $idTipo = 1,
        $contacto = '',
        $personaContacto = '',
        $tabla = '',
        $idTabla = 0,
        $fechaAlta = '',
        $fechaUpdate = ''
    ){
        $this->setIdContacto($idContacto);
        $this->setIdTipo($idTipo);
        $this->setContacto($contacto);
        $this->setPersonaContacto($personaContacto);
        $this->setTabla($tabla);
        $this->setIdTabla($idTabla);
        $this->setFechaAlta($fechaAlta);
        $this->setFechaUpdate($fechaUpdate);
    }

    public function __toString(){
        return $this->contacto;
    }

    public function getIdContacto(){ return $this->idContacto; }

    public function getIdTipo(){ return $this->idTipo; }

    public function getContacto(){ return $this->contacto; }

    public function getPersonaContacto(){ return $this->personaContacto; }

    public function getTabla(){ return $this->tabla; }

    public function getIdTabla(){ return $this->idTabla; }

    public function getFechaAlta(){ return $this->fechaAlta; }

    public function getFechaUpdate(){ return $this->fechaUpdate; }

    public function getTipo(){
        $TipoController = new TipoController();
        $idTipo = $this->getIdTipo();
        $TipoList = $TipoController->select([['idTipo', $idTipo]]);
        return $TipoList[0];
    }

    public function getTabla(){
        $TablaController = new TablaController();
        $idTabla = $this->getIdTabla();
        $TablaList = $TablaController->select([['idTabla', $idTabla]]);
        return $TablaList[0];
    }

    public function setIdContacto($idContacto = 0){
        $this->idContacto = (int) $idContacto; return $this;
    }

    public function setIdTipo($idTipo = 1){
        $this->idTipo = (int) $idTipo; return $this;
    }

    public function setContacto($contacto = ''){
        $this->contacto = (string) $contacto; return $this;
    }

    public function setPersonaContacto($personaContacto = ''){
        $this->personaContacto = (string) $personaContacto; return $this;
    }

    public function setTabla($tabla = ''){
        $this->tabla = (string) $tabla; return $this;
    }

    public function setIdTabla($idTabla = 0){
        $this->idTabla = (int) $idTabla; return $this;
    }

    public function setFechaAlta($fechaAlta = ''){
        $this->fechaAlta = (string) $fechaAlta; return $this;
    }

    public function setFechaUpdate($fechaUpdate = ''){
        $this->fechaUpdate = (string) $fechaUpdate; return $this;
    }

}