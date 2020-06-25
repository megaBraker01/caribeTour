<?php

class ReservaController extends ReservaBaseController {
    
    /**
     * TODO: finalizar este metodo
     * @param Cliente $titular
     * @param array $pasajerosList
     * @param string $notasT
     * @param array $productoFechaList [['producto' => $producto, 'idProductoFechaRef' => $idProductoFechaRef]]
     * @return Reserva $reserva
     */
    public function generarReserva(Cliente $titular, array $pasajerosList, string $notasT, array $productoFechaList, int $tipoPago, $pvp)
    {
        // crear reserva
        $reserva = new Reserva(0, Reserva::ESTADO_PDTE_PAGO, $tipoPago);
        $idReserva = $this->insert($reserva);
        $reserva = $this->getReservaById($idReserva);

        // introducir los productos contratados en reservaDetalle para saber cómo se van a calcular
        $reservaDetalle = new ReservaDetalleController;
        foreach ($productoFechaList as $row){
            $producto = $row['producto'];
            $idTipoFacturacion = $producto->getidTipoFacturacion();
            $idProductoFechaRef = $row['idProductoFechaRef'];
            $reservaDetalle->insert(new ReservaDetalle($idReserva, $producto->getIdProducto(), $idProductoFechaRef, $idTipoFacturacion, $precioBruto, $comision));
        }
        
        /**
         * si se contrata un seguro, se introduce una linea en producto_fecha_ref para indicar las fechas de contratacion
         * para ello se toma las fechas del producto principal (eso sacarlo de esta funcion, porque se puede contratar un seguro sin "producto principal"
         */
        // 
        
        
        
        
        

        // crear cliente
        $clienteC = new ClienteController;
        $clienteId = $clienteC->insert($titular);
        
        // crear pasajeros y la relacion reserva-cliente-pasajero
        $reservaClientePasajeroRefController = new ReservaClientePasajeroRefController;
        $pasajeroC = new PasajeroController;
        foreach($pasajerosList as $pasajero){
            $idPasajero = $pasajeroC->insert($pasajero);
            $reservaClientePasajeroRefController->insert(new ReservaClientePasajeroRef($clienteId, $idPasajero, $idReserva));
        }

        // crear nota
        if("" != $notasT){
            $notaC = new NotaController;
            $notaC->insert(new Nota(0, 'reservas', $idReserva, $notasT));
        }

        // insertar en la tabla reserva_detalles los productos contratados (seguros, excursiones, tour, etc.) y su tipo de facturacion
        // para poder calcular el pvp de la reserga
        // TODO: compara el pvp generado con js con el pvp calculado en php, si hay diferencia poner una nota a la reserva indicandolo
        
        return $reserva;
    }

    /**
     * 
     * @param int $idReserva
     * @return Reserva $reserva
     * @throws Exception
     */
    public function getReservaById(int $idReserva)
    {
        if(!is_int($idReserva) or $idReserva < 1){
            throw new Exception('[ERROR] El idReserva tiene que ser un entero mayor a cero (0)');
        }

        $reserva = @$this->select([['idReserva', $idReserva]])[0] ?? new Reserva;
        return $reserva;
    }
}