<?php

class ReservaDetalle extends ReservaDetalleBase {

    public function getTasasSalidaTotal(){
        $productoFechaRef = $this->getProductoFechaRef();
        $fechaIda = $productoFechaRef->getFechaSalida();
        $tasasTotal = $fechaIda->getTasasSalida() + $fechaIda->getTasasDestino();
        return $tasasTotal;

    }

    public function getTasasVueltaTotal(){
        $productoFechaRef = $this->getProductoFechaRef();
        $fechaVuelta = $productoFechaRef->getFechaVuelta();
        $tasasTotal = $fechaVuelta->getTasasSalida() + $fechaVuelta->getTasasDestino();
        return $tasasTotal;        
    }


    public function getTasasTotal(){
        return $this->getTasasSalidaTotal() + $this->getTasasVueltaTotal();
    }

    public function getPrecioComision(){
        return Util::precioComisionCalc($this->getPrecioProveedor(), $this->getComision());
    }


    public function getPrecioComisionTasas(){
        return $this->getPrecioComision() + $this->getTasasTotal();
    }
}