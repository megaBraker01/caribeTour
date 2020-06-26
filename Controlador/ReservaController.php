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
        try {
            // crear reserva
            $reserva = new Reserva(0, Reserva::ESTADO_PDTE_PAGO, $tipoPago);
            $idReserva = $this->insert($reserva);
            $reservaRet = $this->getReservaById($idReserva);

            // introduce los productos contratados en reservaDetalle para saber cómo se van a calcular
            $reservaDetalle = new ReservaDetalleController;
            foreach ($productoFechaList as $row){
                $producto = $row['producto'];
                $idTipoFacturacion = $producto->getidTipoFacturacion();
                $idProductoFechaRef = $row['idProductoFechaRef'];
                $pFechaRef = $producto->getProductoFechaRefById($idProductoFechaRef);
                $precioProveedor = $pFechaRef->getPrecioProveedor();
                $comision = $pFechaRef->getComision();
                $reservaDetalle->insert(new ReservaDetalle($idReserva, $producto->getIdProducto(), $idProductoFechaRef, $idTipoFacturacion, $precioProveedor, $comision));
            }  

            // crea el cliente
            $clienteC = new ClienteController;
            $clienteId = $clienteC->insert($titular);

            // crea los pasajeros y la relacion reserva-cliente-pasajero
            $reservaClientePasajeroRefController = new ReservaClientePasajeroRefController;
            $pasajeroC = new PasajeroController;
            foreach($pasajerosList as $pasajero){
                $idPasajero = $pasajeroC->insert($pasajero);
                $reservaClientePasajeroRefController->insert(new ReservaClientePasajeroRef($clienteId, $idPasajero, $idReserva));
            }

            // crear nota
            // TODO: se van hacer pruebas guardando el pvp en una nota para poder compararlo con el pvp calculado entre php y js
            // luego que haya suficiente pruebas, descomentar este codigo
            /*
            if("" != $notasT){
                $notaC = new NotaController;
                $notaC->insert(new Nota(0, 'reservas', $idReserva, $notasT));
            }
             * 
             */
            $notaC = new NotaController;
            $notasT = "Pvp mostrado al cliente: $pvp\n $notasT";
            $notaC->insert(new Nota(0, 'reservas', $idReserva, $notasT));
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        
        return $reservaRet;
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