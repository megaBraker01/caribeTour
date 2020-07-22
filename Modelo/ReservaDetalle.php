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
     * NOTA: No siempre existe una fechaVuelta
     * @return type
     */
    public function getTasasVueltaTotal(){
        $productoFechaRef = $this->getProductoFechaRef();
        $fechaVuelta = $productoFechaRef->getFechaVuelta();
        $tasasTotal = 0;
        if(!is_null($fechaVuelta)){
            $tasasTotal = $fechaVuelta->getTasasSalida() + $fechaVuelta->getTasasDestino();
        }
        
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
        $TipoFacturacionController = new TipoFacturacionController();
        $idTipoFacturacion = $this->getIdTipoFacturacion();
        $TipoFacturacionList = $TipoFacturacionController->select([['idTipoFacturacion', $idTipoFacturacion]]);
        if(!isset($TipoFacturacionList[0])){
            throw new Exception('No se ha encontrado un tipoFacturacion con el id {$idTipoFacturacion}');
        }
        
        return $TipoFacturacionList[0];
    }
}