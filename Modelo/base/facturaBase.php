<?php

require_once 'AutoLoader/AutoLoader.php';

abstract class FacturaBase extends ModelBase {

    protected $idFactura;
    protected $facturaNum;
    protected $idReserva;
    protected $idFacturaTitular;
    protected $importeBruto;
    protected $IVA;
    protected $descuento;
    protected $fechaAlta;
    protected $fehaUpdate;

    public function __construct(
        $idFactura = 0,
        $facturaNum = '',
        $idReserva = 0,
        $idFacturaTitular = 0,
        $importeBruto = 0,
        $IVA = 0,
        $descuento = 0,
        $fechaAlta = '',
        $fehaUpdate = ''
    ){
        $this->setIdFactura($idFactura);
        $this->setFacturaNum($facturaNum);
        $this->setIdReserva($idReserva);
        $this->setIdFacturaTitular($idFacturaTitular);
        $this->setImporteBruto($importeBruto);
        $this->setIVA($IVA);
        $this->setDescuento($descuento);
        $this->setFechaAlta($fechaAlta);
        $this->setFehaUpdate($fehaUpdate);
    }

    public function __toString(){
        return $this->facturaNum;
    }

    public function getIdFactura(){ return $this->idFactura; }

    public function getFacturaNum(){ return $this->facturaNum; }

    public function getIdReserva(){ return $this->idReserva; }

    public function getIdFacturaTitular(){ return $this->idFacturaTitular; }

    public function getImporteBruto(){ return $this->importeBruto; }

    public function getIVA(){ return $this->IVA; }

    public function getDescuento(){ return $this->descuento; }

    public function getFechaAlta(){ return $this->fechaAlta; }

    public function getFehaUpdate(){ return $this->fehaUpdate; }

    public function setIdFactura($idFactura = 0){
        $this->idFactura = (int) $idFactura; return $this;
    }

    public function setFacturaNum($facturaNum = ''){
        $this->facturaNum = (string) $facturaNum; return $this;
    }

    public function setIdReserva($idReserva = 0){
        $this->idReserva = (int) $idReserva; return $this;
    }

    public function setIdFacturaTitular($idFacturaTitular = 0){
        $this->idFacturaTitular = (int) $idFacturaTitular; return $this;
    }

    public function setImporteBruto($importeBruto = 0){
        $this->importeBruto = (float) $importeBruto; return $this;
    }

    public function setIVA($IVA = 0){
        $this->IVA = (int) $IVA; return $this;
    }

    public function setDescuento($descuento = 0){
        $this->descuento = (int) $descuento; return $this;
    }

    public function setFechaAlta($fechaAlta = ''){
        $this->fechaAlta = (string) $fechaAlta; return $this;
    }

    public function setFehaUpdate($fehaUpdate = ''){
        $this->fehaUpdate = (string) $fehaUpdate; return $this;
    }

}