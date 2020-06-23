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
    public function generarReserva(Cliente $titular, array $pasajerosList, string $notasT, int $idProductoFechaRef, $pvp)
    {
        // crear reserva
        $reserva = new Reserva(0, $idProductoFechaRef, Reserva::ESTADO_PDTE_CONFIMACION_PROVEEROR, $pvp);
        $idReserva = $this->insert($reserva);
        $reserva = $this->getReservaById($idReserva);

        // crear cliente
        $clienteC = new ClienteController;
        $clienteId = $clienteC->insert($titular);
        
        // TODO: la tabla ClientePasajeroReservaRef ahora se llama reservaClientePasajeroRef, hacer el generate
        // crear pasajeros y la relacion reserva-cliente-pasajero
        $clientePasajeroReservaRefController = new ClientePasajeroReservaRefController;
        $pasajeroC = new PasajeroController;
        foreach($pasajerosList as $pasajero){
            $idPasajero = $pasajeroC->insert($pasajero);
            $clientePasajeroReservaRefController->insert(new ClientePasajeroReservaRef($clienteId, $idPasajero, $idReserva));
        }

        // TODO: hacer el generate de la tabla notas
        // crear nota
        $notaC = new NotaController;
        $notaC->insert(new Nota(0, 'reservas', $idReserva, $notasT));

        return $reserva;
    }

    public function getReservaById($idReserva)
    {
        if(!is_int($idReserva) or $idReserva < 1){
            throw new Exception('[ERROR] El idReserva tiene que ser un entero mayor a cero (0)');
        }

        $reserva = @$this->select([['idReserva', $idReserva]])[0];		
        if(!$reserva){
            throw new Exception("NO hay reserva con el id {$idReserva}");
        }
        return $reserva;
    }
}