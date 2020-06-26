<?php

abstract class ReservaDetalleBase extends ModelBase {

    protected $idReserva;
    protected $idProducto;
    protected $idProductoFechaRef;
    protected $idTipoFacturacion;
    protected $precioProveedor;
    protected $comision;
    protected $fechaAlta;
    protected $fechaUpdate;

    public function __construct(
        $idReserva = 0,
        $idProducto = 0,
        $idProductoFechaRef = 0,
        $idTipoFacturacion = 0,
        $precioProveedor = 0,
        $comision = 0,
        $fechaAlta = '',
        $fechaUpdate = ''
    ){
        $this->setIdReserva($idReserva);
        $this->setIdProducto($idProducto);
        $this->setIdProductoFechaRef($idProductoFechaRef);
        $this->setIdTipoFacturacion($idTipoFacturacion);
        $this->setPrecioProveedor($precioProveedor);
        $this->setComision($comision);
        $this->setFechaAlta($fechaAlta);
        $this->setFechaUpdate($fechaUpdate);
    }

    public function getIdReserva(){ return $this->idReserva; }

    public function getIdProducto(){ return $this->idProducto; }

    public function getIdProductoFechaRef(){ return $this->idProductoFechaRef; }

    public function getIdTipoFacturacion(){ return $this->idTipoFacturacion; }

    public function getPrecioProveedor(){ return $this->precioProveedor; }

    public function getComision(){ return $this->comision; }

    public function getFechaAlta(){ return $this->fechaAlta; }

    public function getFechaUpdate(){ return $this->fechaUpdate; }

    public function getReserva(){
        $ReservaController = new ReservaController();
        $idReserva = $this->getIdReserva();
        $ReservaList = $ReservaController->select([['idReserva', $idReserva]]);
        return $ReservaList[0];
    }

    public function getProducto(){
        $ProductoController = new ProductoController();
        $idProducto = $this->getIdProducto();
        $ProductoList = $ProductoController->select([['idProducto', $idProducto]]);
        return $ProductoList[0];
    }

    public function getProductoFechaRef(){
        $ProductoFechaRefController = new ProductoFechaRefController();
        $idProductoFechaRef = $this->getIdProductoFechaRef();
        $ProductoFechaRefList = $ProductoFechaRefController->select([['idProductoFechaRef', $idProductoFechaRef]]);
        return $ProductoFechaRefList[0];
    }

    public function getTipoFacturacion(){
        $TipoFacturacionController = new TipoFacturacionController();
        $idTipoFacturacion = $this->getIdTipoFacturacion();
        $TipoFacturacionList = $TipoFacturacionController->select([['idTipoFacturacion', $idTipoFacturacion]]);
        return $TipoFacturacionList[0];
    }

    public function setIdReserva($idReserva = 0){
        $this->idReserva = (int) $idReserva; return $this;
    }

    public function setIdProducto($idProducto = 0){
        $this->idProducto = (int) $idProducto; return $this;
    }

    public function setIdProductoFechaRef($idProductoFechaRef = 0){
        $this->idProductoFechaRef = (int) $idProductoFechaRef; return $this;
    }

    public function setIdTipoFacturacion($idTipoFacturacion = 0){
        $this->idTipoFacturacion = (int) $idTipoFacturacion; return $this;
    }

    public function setPrecioProveedor($precioProveedor = 0){
        $this->precioProveedor = (float) $precioProveedor; return $this;
    }

    public function setComision($comision = 0){
        $this->comision = (float) $comision; return $this;
    }

    public function setFechaAlta($fechaAlta = ''){
        $this->fechaAlta = (string) $fechaAlta; return $this;
    }

    public function setFechaUpdate($fechaUpdate = ''){
        $this->fechaUpdate = (string) $fechaUpdate; return $this;
    }

}