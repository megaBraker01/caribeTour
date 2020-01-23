<?php

require_once 'AutoLoader/AutoLoader.php';

abstract class PasajeroBase extends ModelBase {

    protected $idPasajero;
    protected $nombre;
    protected $apellidos;
    protected $NIFoPasaporte;
    protected $nacionalidad;
    protected $fechaNacimiento;
    protected $fechaAlta;
    protected $fechaUpdate;

    public function __construct(
        $idPasajero = 0,
        $nombre = '',
        $apellidos = '',
        $NIFoPasaporte = '',
        $nacionalidad = '',
        $fechaNacimiento = '',
        $fechaAlta = '',
        $fechaUpdate = ''
    ){
        $this->setIdPasajero($idPasajero);
        $this->setNombre($nombre);
        $this->setApellidos($apellidos);
        $this->setNIFoPasaporte($NIFoPasaporte);
        $this->setNacionalidad($nacionalidad);
        $this->setFechaNacimiento($fechaNacimiento);
        $this->setFechaAlta($fechaAlta);
        $this->setFechaUpdate($fechaUpdate);
    }

    public function __toString(){
        return $this->nombre;
    }

    public function getIdPasajero(){ return $this->idPasajero; }

    public function getNombre(){ return $this->nombre; }

    public function getApellidos(){ return $this->apellidos; }

    public function getNIFoPasaporte(){ return $this->NIFoPasaporte; }

    public function getNacionalidad(){ return $this->nacionalidad; }

    public function getFechaNacimiento(){ return $this->fechaNacimiento; }

    public function getFechaAlta(){ return $this->fechaAlta; }

    public function getFechaUpdate(){ return $this->fechaUpdate; }

    public function setIdPasajero($idPasajero = 0){
        $this->idPasajero = (int) $idPasajero; return $this;
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

    public function setNacionalidad($nacionalidad = ''){
        $this->nacionalidad = (string) $nacionalidad; return $this;
    }

    public function setFechaNacimiento($fechaNacimiento = ''){
        $this->fechaNacimiento = (string) $fechaNacimiento; return $this;
    }

    public function setFechaAlta($fechaAlta = ''){
        $this->fechaAlta = (string) $fechaAlta; return $this;
    }

    public function setFechaUpdate($fechaUpdate = ''){
        $this->fechaUpdate = (string) $fechaUpdate; return $this;
    }

}