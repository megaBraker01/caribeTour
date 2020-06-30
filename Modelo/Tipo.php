<?php

class Tipo extends TipoBase {
    // averiguar donde se usa esta constante y refactorizar el nombre para ver de qué se trata
    const SEGURO = 5;

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
}