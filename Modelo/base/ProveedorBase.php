<?php

abstract class ProveedorBase extends ModelBase {

    protected $idProveedor;
    protected $nombre;
    protected $NIF;
    protected $direccion;
    protected $idEstado;
    protected $fechaAlta;
    protected $fechaUpdate;

    public function __construct(
        $idProveedor = 0,
        $nombre = '',
        $NIF = '',
        $direccion = '',
        $idEstado = 1,
        $fechaAlta = '',
        $fechaUpdate = ''
    ){
        $this->setIdProveedor($idProveedor);
        $this->setNombre($nombre);
        $this->setNIF($NIF);
        $this->setDireccion($direccion);
        $this->setIdEstado($idEstado);
        $this->setFechaAlta($fechaAlta);
        $this->setFechaUpdate($fechaUpdate);
    }

    public function __toString(){
        return $this->nombre;
    }

    public function getIdProveedor(){ return $this->idProveedor; }

    public function getNombre(){ return $this->nombre; }

    public function getNIF(){ return $this->NIF; }

    public function getDireccion(){ return $this->direccion; }

    public function getIdEstado(){ return $this->idEstado; }

    public function getFechaAlta(){ return $this->fechaAlta; }

    public function getFechaUpdate(){ return $this->fechaUpdate; }

    public function getEstado(){
        $EstadoController = new EstadoController();
        $idEstado = $this->getIdEstado();
        $EstadoList = $EstadoController->select([['idEstado', $idEstado]]);
        return $EstadoList[0];
    }

    public function setIdProveedor($idProveedor = 0){
        $this->idProveedor = (int) $idProveedor; return $this;
    }

    public function setNombre($nombre = ''){
        $this->nombre = (string) $nombre; return $this;
    }

    public function setNIF($NIF = ''){
        $this->NIF = (string) $NIF; return $this;
    }

    public function setDireccion($direccion = ''){
        $this->direccion = (string) $direccion; return $this;
    }

    public function setIdEstado($idEstado = 1){
        $this->idEstado = (int) $idEstado; return $this;
    }

    public function setFechaAlta($fechaAlta = ''){
        $this->fechaAlta = (string) $fechaAlta; return $this;
    }

    public function setFechaUpdate($fechaUpdate = ''){
        $this->fechaUpdate = (string) $fechaUpdate; return $this;
    }

}