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
    
    // WORKFLOW ESTADOS
    // ESTADO_PDTE_PAGO > ESTADO_PAGADA > ESTADO_PDTE_CONFIMACION_PROVEEROR > ESTADO_CONFIRMADA
    /**
     * ESTADO_PDTE_PAGO 7 = estado por defecto cuando se crea una reserva
     * ESTADO_PAGADA 8 = cuando recibimos respuesta satisfactoria del tpv
     * ESTADO_PDTE_CONFIMAR_PROVEEROR 6 = cuando se manda la peticion de reserva del proveedor
     * ESTADO_CONFIRMADA 4 = cuando el proveedor nos da el OK;
     */
}