<?php

class ProductoFechaRef extends ProductoFechaRefBase {

    public function getFechaSalida(){
        $FechaSalidaController = new FechaController();
        $idFechaSalida = $this->getIdFechaSalida();
        $FechaSalidaList = $FechaSalidaController->select([['idFecha', $idFechaSalida]]);
        return $FechaSalidaList[0];
    }

    public function getFechaVuelta(){
        $FechaVueltaController = new FechaController();
        $idFechaVuelta = $this->getIdFechaVuelta();
        $FechaVueltaList = $FechaVueltaController->select([['idFecha', $idFechaVuelta]]);
        return $FechaVueltaList[0];
    }
}