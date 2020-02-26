<?php

class ProductoFechaDTO {
	
    protected $idProductoFechaRef;
    protected $idProducto;
    protected $idFechaSalida;
    protected $precioProveedor;
    protected $comision;
    protected $producto;
    protected $idCategoria;
    protected $categoria;
    protected $idCategoriaPadre;
    protected $catPadre;
    protected $fsalida;
    protected $terminalSalida;
    protected $terminalDestino;
    protected $tasasSalida;
    protected $tasasDestino;
    protected $idFechaVuelta;
    protected $fvuelta;
    protected $terminalSalidaV;
    protected $terminalDestinoV;
    protected $tasasSalidaV;
    protected $tasasDestinoV;

    function __construct($idProductoFechaRef, $idProducto, $idFechaSalida, $precioProveedor, $comision, $producto, $idCategoria, $categoria, $idCategoriaPadre, $catPadre, $fsalida, $terminalSalida, $terminalDestino, $tasasSalida, $tasasDestino, $idFechaVuelta, $fvuelta, $terminalSalidaV, $terminalDestinoV, $tasasSalidaV, $tasasDestinoV) {
        $this->setIdProductoFechaRef($idProductoFechaRef);
        $this->setIdProducto($idProducto);
        $this->setIdFechaSalida($idFechaSalida);
        $this->setPrecioProveedor($precioProveedor);
        $this->setComision($comision);
        $this->setProducto($producto);
        $this->setIdCategoria($idCategoria);
        $this->setCategoria($categoria);
        $this->setIdCategoriaPadre($idCategoriaPadre);
        $this->setCatPadre($catPadre);
        $this->setFsalida($fsalida);
        $this->setTerminalSalida($terminalSalida);
        $this->setTerminalDestino($terminalDestino);
        $this->setTasasSalida($tasasSalida);
        $this->setTasasDestino($tasasDestino);
        $this->setIdFechaVuelta($idFechaVuelta);
        $this->setFvuelta($fvuelta);
        $this->setTerminalSalidaV($terminalSalidaV);
        $this->setTerminalDestinoV($terminalDestinoV);
        $this->setTasasSalidaV($tasasSalidaV);
        $this->setTasasDestinoV($tasasDestinoV);
    }
    
    function getIdProductoFechaRef() {
        return $this->idProductoFechaRef;
    }

    function getIdProducto() {
        return $this->idProducto;
    }

    function getIdFechaSalida() {
        return $this->idFechaSalida;
    }

    function getPrecioProveedor() {
        return $this->precioProveedor;
    }

    function getComision() {
        return $this->comision;
    }

    function getProducto() {
        return $this->producto;
    }

    function getIdCategoria() {
        return $this->idCategoria;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getIdCategoriaPadre() {
        return $this->idCategoriaPadre;
    }

    function getCatPadre() {
        return $this->catPadre;
    }

    function getFsalida() {
        return $this->fsalida;
    }

    function getTerminalSalida() {
        return $this->terminalSalida;
    }

    function getTerminalDestino() {
        return $this->terminalDestino;
    }

    function getTasasSalida() {
        return $this->tasasSalida;
    }

    function getTasasDestino() {
        return $this->tasasDestino;
    }

    function getIdFechaVuelta() {
        return $this->idFechaVuelta;
    }

    function getFvuelta() {
        return $this->fvuelta;
    }

    function getTerminalSalidaV() {
        return $this->terminalSalidaV;
    }

    function getTerminalDestinoV() {
        return $this->terminalDestinoV;
    }

    function getTasasSalidaV() {
        return $this->tasasSalidaV;
    }

    function getTasasDestinoV() {
        return $this->tasasDestinoV;
    }

    function setIdProductoFechaRef($idProductoFechaRef) {
        $this->idProductoFechaRef = (int) $idProductoFechaRef;
    }

    function setIdProducto($idProducto) {
        $this->idProducto = (int) $idProducto;
    }

    function setIdFechaSalida($idFechaSalida) {
        $this->idFechaSalida = (int) $idFechaSalida;
    }

    function setPrecioProveedor($precioProveedor) {
        $this->precioProveedor = $precioProveedor;
    }

    function setComision($comision) {
        $this->comision = $comision;
    }

    function setProducto($producto) {
        $this->producto = $producto;
    }

    function setIdCategoria($idCategoria) {
        $this->idCategoria = (int) $idCategoria;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setIdCategoriaPadre($idCategoriaPadre) {
        $this->idCategoriaPadre = (int) $idCategoriaPadre;
    }

    function setCatPadre($catPadre) {
        $this->catPadre = $catPadre;
    }

    function setFsalida($fsalida) {
        $this->fsalida = $fsalida;
    }

    function setTerminalSalida($terminalSalida) {
        $this->terminalSalida = $terminalSalida;
    }

    function setTerminalDestino($terminalDestino) {
        $this->terminalDestino = $terminalDestino;
    }

    function setTasasSalida($tasasSalida) {
        $this->tasasSalida = $tasasSalida;
    }

    function setTasasDestino($tasasDestino) {
        $this->tasasDestino = $tasasDestino;
    }

    function setIdFechaVuelta($idFechaVuelta) {
        $this->idFechaVuelta = (int) $idFechaVuelta;
    }

    function setFvuelta($fvuelta) {
        $this->fvuelta = $fvuelta;
    }

    function setTerminalSalidaV($terminalSalidaV) {
        $this->terminalSalidaV = $terminalSalidaV;
    }

    function setTerminalDestinoV($terminalDestinoV) {
        $this->terminalDestinoV = $terminalDestinoV;
    }

    function setTasasSalidaV($tasasSalidaV) {
        $this->tasasSalidaV = $tasasSalidaV;
    }

    function setTasasDestinoV($tasasDestinoV) {
        $this->tasasDestinoV = $tasasDestinoV;
    }



}