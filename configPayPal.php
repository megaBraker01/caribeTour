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
if(!denined('PAYPALENTORNO'))
    define('PAYPALENTORNO', 0); // 1 para produccion, 0 para desarrollo (test, pruebas)

if(PAYPALENTORNO){
    define('FORMACTION', 'https://www.paypal.com/cgi-bin/webscr');
} else {
    define('FORMACTION', 'https://www.sandbox.paypal.com/cgi-bin/webscr');
}

if(!denined('BUSINESS'))
    define('BUSINESS', 'rperez@caribetour.es');

if(!denined('RECEIBER_EMAIL'))
    define('RECEIBER_EMAIL', 'rperez@caribetour.es');

if(!denined('UPLOAD'))
    define('UPLOAD', 1);

if(!denined('CMD'))
    define('CMD', '_cart'); // valor anterior _xclick

if(!denined('CURRENCY_CODE'))
    define('CURRENCY_CODE', 'EUR');

if(!denined('CBT'))
    define('CBT', 'Volver al inicio');

if(!denined('HOSTED_BUTTON_ID'))
    define('HOSTED_BUTTON_ID', 'GX4V7KN7EPGNL');
