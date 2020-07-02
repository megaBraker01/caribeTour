<?php

class Tipo extends TipoBase {

    // tipos de productos
    const TIPO_TOUR = 3;
    const TIPO_EXCURSION = 4;
    const TIPO_TRASLADO = 5;
    const TIPO_CIRCUITO = 6;
    const TIPO_SEGURO = 7;

    // tipos de facturacion
    const FACTURAR_POR_RESERVA = 20;
    const FACTURAR_POR_PERSONA = 21;
    const FACTURAR_POR_TRAYECTO = 22;
    const FACTURAR_POR_NOCHE = 23;
    const FACTURAR_POR_NOCHEYPERSONA = 24;
    
    // tipos de pago
    const PAGO_TARJETA = 12;
    const PAGO_TRANSFERENCIA = 13;
    const PAGO_PAYPAL = 14;
    const PAGO_EFECTIVO = 15;
    const PAGO_CHEQUE = 16;
}