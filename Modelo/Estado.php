<?php

/**
 * TODO: realizar la refactorizacion de esta clase, hay que enlazarla con estado_tabla_ref, ver todos los lugares donde se una Estado y refactorizar. falta generar modelo y controller de estado_tabla_ref
 */
class Estado extends EstadoBase {
    const ESTADO_ = 1;
    const ESTADO_ACTIVO = 2;
    const ESTADO_INACTIVO = 3;
    const ESTADO_CONFIRMADO = 4;
    const ESTADO_CANCELADO = 5;
    const ESTADO_PENDIENTE_CONFIRMAR = 6;
    const ESTADO_PENDIENTE_PAGAR = 7;
    const ESTADO_PAGADO = 8;
}