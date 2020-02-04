<?php

abstract class FacturaTitularBase extends ModelBase {

    protected $idFacturaTitular;
    protected $idCliente;
    protected $nombre;
    protected $apellidos;
    protected $NIF;
    protected $direccion;
    protected $codigoPostal;
    protected $ciudad;
    protected $provincia;
    protected $pais;

    public function __construct(
        $idFacturaTitular = 0,
        $idCliente = 0,
        $nombre = '',
        $apellidos = '',
        $NIF = '',
        $direccion = '',
        $codigoPostal = '',
        $ciudad = '',
        $provincia = '',
        $pais = ''
    ){
        $this->setIdFacturaTitular($idFacturaTitular);
        $this->setIdCliente($idCliente);
        $this->setNombre($nombre);
        $this->setApellidos($apellidos);
        $this->setNIF($NIF);
        $this->setDireccion($direccion);
        $this->setCodigoPostal($codigoPostal);
        $this->setCiudad($ciudad);
        $this->setProvincia($provincia);
        $this->setPais($pais);
    }

    public function __toString(){
        return $this->nombre;
    }

    public function getIdFacturaTitular(){ return $this->idFacturaTitular; }

    public function getIdCliente(){ return $this->idCliente; }

    public function getNombre(){ return $this->nombre; }

    public function getApellidos(){ return $this->apellidos; }

    public function getNIF(){ return $this->NIF; }

    public function getDireccion(){ return $this->direccion; }

    public function getCodigoPostal(){ return $this->codigoPostal; }

    public function getCiudad(){ return $this->ciudad; }

    public function getProvincia(){ return $this->provincia; }

    public function getPais(){ return $this->pais; }

    public function getCliente(){
        $ClienteController = new ClienteController();
        $idCliente = $this->getIdCliente();
        $ClienteList = $ClienteController->select([['idCliente', '=', $idCliente]]);
        return $ClienteList[0];
    }

    public function setIdFacturaTitular($idFacturaTitular = 0){
        $this->idFacturaTitular = (int) $idFacturaTitular; return $this;
    }

    public function setIdCliente($idCliente = 0){
        $this->idCliente = (int) $idCliente; return $this;
    }

    public function setNombre($nombre = ''){
        $this->nombre = (string) $nombre; return $this;
    }

    public function setApellidos($apellidos = ''){
        $this->apellidos = (string) $apellidos; return $this;
    }

    public function setNIF($NIF = ''){
        $this->NIF = (string) $NIF; return $this;
    }

    public function setDireccion($direccion = ''){
        $this->direccion = (string) $direccion; return $this;
    }

    public function setCodigoPostal($codigoPostal = ''){
        $this->codigoPostal = (string) $codigoPostal; return $this;
    }

    public function setCiudad($ciudad = ''){
        $this->ciudad = (string) $ciudad; return $this;
    }

    public function setProvincia($provincia = ''){
        $this->provincia = (string) $provincia; return $this;
    }

    public function setPais($pais = ''){
        $this->pais = (string) $pais; return $this;
    }

}