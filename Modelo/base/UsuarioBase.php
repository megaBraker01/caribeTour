<?php

abstract class UsuarioBase extends ModelBase {

    protected $idUsuario;
    protected $nombre;
    protected $apellidos;
    protected $DNI;
    protected $email;
    protected $password;
    protected $telefono;
    protected $perfil;
    protected $imagen;
    protected $idEstado;
    protected $fechaAlta;
    protected $fechaUpdate;

    public function __construct(
        $idUsuario = 0,
        $nombre = '',
        $apellidos = '',
        $DNI = '',
        $email = '',
        $password = '',
        $telefono = '',
        $perfil = '',
        $imagen = '',
        $idEstado = 1,
        $fechaAlta = '',
        $fechaUpdate = ''
    ){
        $this->setIdUsuario($idUsuario);
        $this->setNombre($nombre);
        $this->setApellidos($apellidos);
        $this->setDNI($DNI);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setTelefono($telefono);
        $this->setPerfil($perfil);
        $this->setImagen($imagen);
        $this->setIdEstado($idEstado);
        $this->setFechaAlta($fechaAlta);
        $this->setFechaUpdate($fechaUpdate);
    }

    public function __toString(){
        return $this->nombre;
    }

    public function getIdUsuario(){ return $this->idUsuario; }

    public function getNombre(){ return $this->nombre; }

    public function getApellidos(){ return $this->apellidos; }

    public function getDNI(){ return $this->DNI; }

    public function getEmail(){ return $this->email; }

    public function getPassword(){ return $this->password; }

    public function getTelefono(){ return $this->telefono; }

    public function getPerfil(){ return $this->perfil; }

    public function getImagen(){ return $this->imagen; }

    public function getIdEstado(){ return $this->idEstado; }

    public function getFechaAlta(){ return $this->fechaAlta; }

    public function getFechaUpdate(){ return $this->fechaUpdate; }

    public function getEstado(){
        $EstadoController = new EstadoController();
        $idEstado = $this->getIdEstado();
        $EstadoList = $EstadoController->select([['idEstado', $idEstado]]);
        return $EstadoList[0];
    }

    public function setIdUsuario($idUsuario = 0){
        $this->idUsuario = (int) $idUsuario; return $this;
    }

    public function setNombre($nombre = ''){
        $this->nombre = (string) $nombre; return $this;
    }

    public function setApellidos($apellidos = ''){
        $this->apellidos = (string) $apellidos; return $this;
    }

    public function setDNI($DNI = ''){
        $this->DNI = (string) $DNI; return $this;
    }

    public function setEmail($email = ''){
        $this->email = (string) $email; return $this;
    }

    public function setPassword($password = ''){
        $this->password = (string) $password; return $this;
    }

    public function setTelefono($telefono = ''){
        $this->telefono = (string) $telefono; return $this;
    }

    public function setPerfil($perfil = ''){
        $this->perfil = (string) $perfil; return $this;
    }

    public function setImagen($imagen = ''){
        $this->imagen = (string) $imagen; return $this;
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