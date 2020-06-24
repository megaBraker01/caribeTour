<?php

class ReservaController extends ReservaBaseController {
    
    /**
     * TODO: finalizar este metodo
     * @param Cliente $titular
     * @param array $pasajerosList
     * @param string $notasT
     * @param int $idProductoFechaRef
     * @return Reserva $reserva
     */
    public function generarReserva(Cliente $titular, array $pasajerosList, string $notasT, int $idProductoFechaRef, string $seguro, int $tipoPago, $pvp)
    {
        // crear reserva
        $reserva = new Reserva(0, $idProductoFechaRef, Reserva::ESTADO_PDTE_PAGO, $tipoPago, $pvp);
        $idReserva = $this->insert($reserva);
        $reserva = $this->getReservaById($idReserva);

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