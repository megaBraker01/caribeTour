<?php

/* 
 * Archivo de configuracion para PayPal
 */


// configuracion para la API REST
define('ProPayPal', 0);
if(ProPayPal){
    define("PayPalClientId", "*********************");
    define("PayPalSecret", "*********************");
    define("PayPalBaseUrl", "https://api.paypal.com/v1/");
    define("PayPalENV", "production");
} else {
    define("PayPalClientId", "AQBtZI9iDBXVbCnNClgQ4l5VRnAG8kX5MDBwei-Ii14Izk--a_3HR-81CCR0ECrOfnAAAc3iDLvGs0s-");
    define("PayPalSecret", "EJfIlEMVOf1KeyhaRLuWG3R3Lsa6TVqz7B1zVSq3e461Tnps6TU1MKBhL0xpyJwRDN3c9QTsb_H3MjJn");
    define("PayPalBaseUrl", "https://api.sandbox.paypal.com/v1/");
    define("PayPalENV", "sandbox");
}


// configuracion para el formulario
// PAYPAL CONFIG
if(!defined('PAYPALENTORNO'))
    define('PAYPALENTORNO', 0); // 1 para produccion, 0 para desarrollo (test, pruebas)

if(PAYPALENTORNO){
    define('FORM_ACTION', 'https://www.paypal.com/cgi-bin/webscr');
} else {
    define('FORM_ACTION', 'https://www.sandbox.paypal.com/cgi-bin/webscr');
}

if(!defined('BUSINESS'))
    define('BUSINESS', 'rperez@caribetour.es');

if(!defined('RECEIVER_EMAIL'))
    define('RECEIVER_EMAIL', 'rperez@caribetour.es');

if(!defined('UPLOAD'))
    define('UPLOAD', 1);

if(!defined('CMD'))
    define('CMD', '_xclick');

if(!defined('CURRENCY_CODE'))
    define('CURRENCY_CODE', 'EUR');

if(!defined('CBT'))
    define('CBT', 'Volver al inicio');

if(!defined('HOSTED_BUTTON_ID'))
    define('HOSTED_BUTTON_ID', 'GX4V7KN7EPGNL');
