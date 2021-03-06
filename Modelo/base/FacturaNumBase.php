<?php

abstract class FacturaNumBase extends ModelBase {

    protected $facturaNum;
    protected $fechaAlta;

    public function __construct(
        $facturaNum = 0,
        $fechaAlta = ''
    ){
        $this->setFacturaNum($facturaNum);
        $this->setFechaAlta($fechaAlta);
    }

    public function getFacturaNum(){ return $this->facturaNum; }

    public function getFechaAlta(){ return $this->fechaAlta; }

    public function setFacturaNum($facturaNum = 0){
        $this->facturaNum = (int) $facturaNum; return $this;
    }

    public function setFechaAlta($fechaAlta = ''){
        $this->fechaAlta = (string) $fechaAlta; return $this;
    }

}