<?php

class Reserva extends ReservaBase {
    
    // ESTADOS
    const ESTADO_CONFIRMADA = 4;
    const ESTADO_CANCELADA = 5;
    const ESTADO_PDTE_CONFIMAR_PROVEEROR = 12;
    const ESTADO_PDTE_PAGO = 7;
    const ESTADO_PAGADA = 8;

    // TIPOS DE PAGO
    const TIPO_PAGO_TARJETA = 12;
    const TIPO_PAGO_TRANSFERENCIA = 13;
    const TIPO_PAGO_PAYPAL = 14;
    const TIPO_PAGO_EFECTIVO = 15;
    const TIPO_PAGO_CHEQUE = 16;

    // TIPO DE FACTURACION
    
    // WORKFLOW ESTADOS
    // ESTADO_PDTE_PAGO > ESTADO_PAGADA > ESTADO_PDTE_CONFIMACION_PROVEEROR > ESTADO_CONFIRMADA
    /**
     * ESTADO_PDTE_PAGO 7 = estado por defecto cuando se crea una reserva
     * ESTADO_PAGADA 8 = cuando recibimos respuesta satisfactoria del tpv o seteo manual si el pago es transferencia
     * ESTADO_PDTE_CONFIMAR_PROVEEROR 6 = cuando se manda la peticion de reserva del proveedor
     * ESTADO_CONFIRMADA 4 = cuando el proveedor nos da el OK;
     */
    
    /**
     * eliminar el campo idProductoFechaRef de la tabla reserva, este campo ya se guarda en reservaDetalles
     * se elimina el campo pvpTotal porque es un valor calculado
     */
      /**
       * TODO: Esta funcion se encargará de calcular el pvp final de una reserva
       * para ello tiene que tirar de la tabla reserva_detalles y ver el idTipo para saber cómo se va a calcular el precio,
       * los tipos pueden ser: por persona, por trayecto, por persona+trayecto, por reserva, etc...
       * luego obtiene la cantidad de pasajeros, y aplicará el correspondiente calculo
       */
      public function calularPvp()
      {
          $retPvp = 0;
          // se extraen los reserva_detalles ()
          // se verifica el tipo de calculo
          // se cuentan la cantidad de pasajeros y según el tipo se calcula
          // se suman las tasas (si la hubiese)


          $reservaDetalles = $this->getDetalles();
          foreach($reservaDetalles as $detalle){

            switch($detalle->getIdTipoFacturacion()){

              case Tipo::FACTURAR_POR_RESERVA: 
                $precioP = $detalle->getPrecioProveedor();
                $comision = $detalle->getComision();
                $precioComision = Util::precioComisionCalc($precioP, $comision);
                $retPvp += $precioComision;
              break;

              case Tipo::FACTURAR_POR_PERSONA:
                $pasajerosCount = count($this->getPasajeros());
                Util::dev($this->getPasajeros());
                $precioP = $detalle->getPrecioProveedor();
                $comision = $detalle->getComision();
                $precioComision = Util::precioComisionCalc($precioP, $comision);
                $retPvp += $precioComision * $pasajerosCount;
              break;

              // por defecto se cobra por reserva
              default:
                $precioP = $detalle->getPrecioProveedor();
                $comision = $detalle->getComision();
                $precioComision = Util::precioComisionCalc($precioP, $comision);
                $retPvp += $precioComision;
              break;

            }

          }

          return (double) $retPvp;
      }


      public function getDetalles()
      {
          $detallesC = new ReservaDetalleController;
          return $detallesC->select([['idReserva', $this->getIdReserva()]]) ?? [];
      }

      public function getPasajeros()
      {
          $pasajeros = [];
          $reservaCP = new ReservaClientePasajeroRefController;
          $pasajeroC = new PasajeroController;
          foreach($reservaCP->select([['idReserva', $this->getIdReserva()]]) as $rcp){
              $pasajero = $pasajeroC->select([['idPasajero', $rcp->getIdPasajero()]])[0];
              $pasajeros[] = $pasajero;
          }

          return $pasajeros;
      }
}