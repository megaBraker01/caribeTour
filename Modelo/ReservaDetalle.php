<?php

class ReservaDetalle extends ReservaDetalleBase {

    /**
     * Obtiene la suma de las tasas de la salida
     * @return type
     */
    public function getTasasSalidaTotal(){
        $productoFechaRef = $this->getProductoFechaRef();
        $fechaIda = $productoFechaRef->getFechaSalida();
        $tasasTotal = $fechaIda->getTasasSalida() + $fechaIda->getTasasDestino();
        return $tasasTotal;

    }

    /**
     * Obtiene la suma de las tasas de la vuelta
     * @return type
     */
    public function getTasasVueltaTotal(){
        $productoFechaRef = $this->getProductoFechaRef();
        $fechaVuelta = $productoFechaRef->getFechaVuelta();
        $tasasTotal = $fechaVuelta->getTasasSalida() + $fechaVuelta->getTasasDestino();
        return $tasasTotal;        
    }


    /**
     * Obtiene la suma total de totas las tasas
     * @return type
     */
    public function getTasasTotal(){
        return $this->getTasasSalidaTotal() + $this->getTasasVueltaTotal();
    }

    /**
     * Obtiene la suma del precio mas comision
     * @return type
     */
    public function getPrecioComision(){
        return Util::precioComisionCalc($this->getPrecioProveedor(), $this->getComision());
    }


    /**
     * Obtiene la suma del precio mas comision mas las tasas
     * @return type
     */
    public function getPrecioComisionTasas(){
        return $this->getPrecioComision() + $this->getTasasTotal();
    }
    
    public function getTipoFacturacion(){
        $TipoFacturacionController = new TipoController();
        $idTipoFacturacion = $this->getIdTipoFacturacion();
        $TipoFacturacionList = $TipoFacturacionController->select([['idTipo', $idTipoFacturacion]]);
        return $TipoFacturacionList[0];
    }
}