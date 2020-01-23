<?php

require_once 'AutoLoader/AutoLoader.php';

abstract class ContactoBase extends ModelBase {

    protected $idContacto;
    protected $idTipo;
    protected $contacto;
    protected $personaContacto;
    protected $srcTabla;
    protected $idTabla;
    protected $fechaAlta;
    protected $fechaUpdate;

    public function __construct(
        $idContacto = 0,
        $idTipo = 0,
        $contacto = '',
        $personaContacto = '',
        $srcTabla = '',
        $idTabla = 0,
        $fechaAlta = '',
        $fechaUpdate = ''
    ){
        $this->setIdContacto($idContacto);
        $this->setIdTipo($idTipo);
        $this->setContacto($contacto);
        $this->setPersonaContacto($personaContacto);
        $this->setSrcTabla($srcTabla);
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

    public function getSrcTabla(){ return $this->srcTabla; }

    public function getIdTabla(){ return $this->idTabla; }

    public function getFechaAlta(){ return $this->fechaAlta; }

    public function getFechaUpdate(){ return $this->fechaUpdate; }

    public function setIdContacto($idContacto = 0){
        $this->idContacto = (int) $idContacto; return $this;
    }

    public function setIdTipo($idTipo = 0){
        $this->idTipo = (int) $idTipo; return $this;
    }

    public function setContacto($contacto = ''){
        $this->contacto = (string) $contacto; return $this;
    }

    public function setPersonaContacto($personaContacto = ''){
        $this->personaContacto = (string) $personaContacto; return $this;
    }

    public function setSrcTabla($srcTabla = ''){
        $this->srcTabla = (string) $srcTabla; return $this;
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