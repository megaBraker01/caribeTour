<?php

abstract class ProveedorBase extends ModelBase {

    protected $idProveedor;
    protected $nombre;
    protected $contacto;
    protected $telefono;
    protected $NIF;
    protected $web;
    protected $email;
    protected $direccion;
    protected $idEstado;
    protected $fechaAlta;
    protected $fehaUpdate;

    public function __construct(
        $idProveedor = 0,
        $nombre = '',
        $contacto = '',
        $telefono = '',
        $NIF = '',
        $web = '',
        $email = '',
        $direccion = '',
        $idEstado = 0,
        $fechaAlta = '',
        $fehaUpdate = ''
    ){
        $this->setIdProveedor($idProveedor);
        $this->setNombre($nombre);
        $this->setContacto($contacto);
        $this->setTelefono($telefono);
        $this->setNIF($NIF);
        $this->setWeb($web);
        $this->setEmail($email);
        $this->setDireccion($direccion);
        $this->setIdEstado($idEstado);
        $this->setFechaAlta($fechaAlta);
        $this->setFehaUpdate($fehaUpdate);
    }

    public function __toString(){
        return $this->nombre;
    }

    public function getIdProveedor(){ return $this->idProveedor; }

    public function getNombre(){ return $this->nombre; }

    public function getContacto(){ return $this->contacto; }

    public function getTelefono(){ return $this->telefono; }

    public function getNIF(){ return $this->NIF; }

    public function getWeb(){ return $this->web; }

    public function getEmail(){ return $this->email; }

    public function getDireccion(){ return $this->direccion; }

    public function getIdEstado(){ return $this->idEstado; }

    public function getFechaAlta(){ return $this->fechaAlta; }

    public function getFehaUpdate(){ return $this->fehaUpdate; }

    public function getEstado(){
        $EstadoController = new EstadoController();
        $idEstado = $this->getIdEstado();
        $EstadoList = $EstadoController->select([['idEstado', '=', $idEstado]]);
        return $EstadoList[0];
    }

    public function setIdProveedor($idProveedor = 0){
        $this->idProveedor = (int) $idProveedor; return $this;
    }

    public function setNombre($nombre = ''){
        $this->nombre = (string) $nombre; return $this;
    }

    public function setContacto($contacto = ''){
        $this->contacto = (string) $contacto; return $this;
    }

    public function setTelefono($telefono = ''){
        $this->telefono = (string) $telefono; return $this;
    }

    public function setNIF($NIF = ''){
        $this->NIF = (string) $NIF; return $this;
    }

    public function setWeb($web = ''){
        $this->web = (string) $web; return $this;
    }

    public function setEmail($email = ''){
        $this->email = (string) $email; return $this;
    }

    public function setDireccion($direccion = ''){
        $this->direccion = (string) $direccion; return $this;
    }

    public function setIdEstado($idEstado = 0){
        $this->idEstado = (int) $idEstado; return $this;
    }

    public function setFechaAlta($fechaAlta = ''){
        $this->fechaAlta = (string) $fechaAlta; return $this;
    }

    public function setFehaUpdate($fehaUpdate = ''){
        $this->fehaUpdate = (string) $fehaUpdate; return $this;
    }

}