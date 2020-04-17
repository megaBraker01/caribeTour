<?php

abstract class ClienteBase extends ModelBase {

    protected $idCliente;
    protected $idEstado;
    protected $nombre;
    protected $apellidos;
    protected $NIFoPasaporte;
    protected $telefono;
    protected $email;
    protected $direccion;
    protected $codigoPostal;
    protected $ciudad;
    protected $provincia;
    protected $pais;
    protected $fechaAlta;
    protected $fechaUpdate;

    public function __construct(
        $idCliente = 0,
        $idEstado = 0,
        $nombre = '',
        $apellidos = '',
        $NIFoPasaporte = '',
        $telefono = '',
        $email = '',
        $direccion = '',
        $codigoPostal = '',
        $ciudad = '',
        $provincia = '',
        $pais = '',
        $fechaAlta = '',
        $fechaUpdate = ''
    ){
        $this->setIdCliente($idCliente);
        $this->setIdEstado($idEstado);
        $this->setNombre($nombre);
        $this->setApellidos($apellidos);
        $this->setNIFoPasaporte($NIFoPasaporte);
        $this->setTelefono($telefono);
        $this->setEmail($email);
        $this->setDireccion($direccion);
        $this->setCodigoPostal($codigoPostal);
        $this->setCiudad($ciudad);
        $this->setProvincia($provincia);
        $this->setPais($pais);
        $this->setFechaAlta($fechaAlta);
        $this->setFechaUpdate($fechaUpdate);
    }

    public function __toString(){
        return $this->nombre;
    }

    public function getIdCliente(){ return $this->idCliente; }

    public function getIdEstado(){ return $this->idEstado; }

    public function getNombre(){ return $this->nombre; }

    public function getApellidos(){ return $this->apellidos; }

    public function getNIFoPasaporte(){ return $this->NIFoPasaporte; }

    public function getTelefono(){ return $this->telefono; }

    public function getEmail(){ return $this->email; }

    public function getDireccion(){ return $this->direccion; }

    public function getCodigoPostal(){ return $this->codigoPostal; }

    public function getCiudad(){ return $this->ciudad; }

    public function getProvincia(){ return $this->provincia; }

    public function getPais(){ return $this->pais; }

    public function getFechaAlta(){ return $this->fechaAlta; }

    public function getFechaUpdate(){ return $this->fechaUpdate; }

    public function getEstado(){
        $EstadoController = new EstadoController();
        $idEstado = $this->getIdEstado();
        $EstadoList = $EstadoController->select([['idEstado', $idEstado]]);
        return $EstadoList[0];
    }

    public function setIdCliente($idCliente = 0){
        $this->idCliente = (int) $idCliente; return $this;
    }

    public function setIdEstado($idEstado = 0){
        $this->idEstado = (int) $idEstado; return $this;
    }

    public function setNombre($nombre = ''){
        $this->nombre = (string) $nombre; return $this;
    }

    public function setApellidos($apellidos = ''){
        $this->apellidos = (string) $apellidos; return $this;
    }

    public function setNIFoPasaporte($NIFoPasaporte = ''){
        $this->NIFoPasaporte = (string) $NIFoPasaporte; return $this;
    }

    public function setTelefono($telefono = ''){
        $this->telefono = (string) $telefono; return $this;
    }

    public function setEmail($email = ''){
        $this->email = (string) $email; return $this;
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

    public function setFechaAlta($fechaAlta = ''){
        $this->fechaAlta = (string) $fechaAlta; return $this;
    }

    public function setFechaUpdate($fechaUpdate = ''){
        $this->fechaUpdate = (string) $fechaUpdate; return $this;
    }

}