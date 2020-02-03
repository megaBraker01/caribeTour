-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 03-02-2020 a las 18:33:58
-- Versión del servidor: 5.7.19
-- Versión de PHP: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `caribetournew`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE IF NOT EXISTS `blogs` (
  `idblog` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `metaDescripcion` varchar(255) DEFAULT NULL,
  `metaKeyWords` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `srcImagen` varchar(255) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL COMMENT 'el autor del post',
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaUpdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idblog`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blog_comentarios`
--

DROP TABLE IF EXISTS `blog_comentarios`;
CREATE TABLE IF NOT EXISTS `blog_comentarios` (
  `idBlogComentario` int(11) NOT NULL AUTO_INCREMENT,
  `idBlog` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `comentario` varchar(255) NOT NULL,
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idBlogComentario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `idCategoriaPadre` int(11) NOT NULL DEFAULT '0',
  `nombre` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `descripcion` text,
  `idEstado` int(11) NOT NULL,
  `srcImagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `idCategoriaPadre`, `nombre`, `slug`, `descripcion`, `idEstado`, `srcImagen`) VALUES
(1, 0, 'Rep&uacute;blica Dominicana', 'republica-dominicana', 'Donde te espera la sonrisa eterna de gente buena y hospitalaria, la carcajada de un mar que hace de la republica dominicana un destino singular cargado con el sol caribe&ntilde;o, la alegr&iacute;a del merengue y la bachata y el mejor ron del mundo. tambi&eacute;n encontraras excelente clima, playas paradisiacas, y el mejor arco&iacute;ris gastron&oacute;mico que te puedas imaginar.', 1, 'republica-dominicana.jpg'),
(2, 0, 'M&eacute;xico', 'mexico', '', 1, 'mexico.jpg'),
(3, 0, 'Cuba', 'cuba', '', 1, 'cuba.jpg'),
(4, 1, 'Santo Domingo', 'santo-domingo', 'Es la ciudad primada de ameria\r\n', 1, 'santo-domingo.jpg'),
(5, 2, 'Rivera Maya', 'rivera-maya', '...', 1, 'rivera-maya.jpg'),
(6, 1, 'Punta Cana', 'punta-cana', '...', 1, 'paradisuspalmareal.jpg'),
(7, 3, 'Varadero', 'varadero', '...', 1, 'paradisuspal.jpg'),
(8, 2, 'Yucatan', 'yucatan', '...', 1, 'yucatan.jpg'),
(9, 2, 'Canc&uacute;n', 'cancun', '...', 1, 'cancun.jpg'),
(10, 1, 'La Romana', 'la-romana', '...', 1, 'portada.jpg'),
(11, 1, 'Puerto Plata', 'puerto-plata', 'Es Un Lugar Precioso Con Grandes Monta&ntilde;as Y Ricas Playas En Las Que Podras Encontrar Un Sin Numero De Especies Marinas ', 1, 'paradisuspal.jpg'),
(12, 0, 'Puerto Rico', 'puerto-rico', '', 3, 'puerto-rico.jpg'),
(13, 13, 'San Juan', 'san-juan', '....', 1, 'san-juan.jpg'),
(14, 0, 'Seguros', 'seguros', 'Todos Los Seguros Que Pueden Contratar Los Pasajeros', 1, ''),
(15, 14, 'Por Persona', 'por-persona', 'Se Calculan Por La Candidad De Personas Que Lo Contraten', 1, ''),
(16, 14, 'Por Reserva', 'por-reserva', '..', 1, ''),
(17, 14, 'Por Persona Y Estancia', 'por-persona-y-estancia', '..', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `idEstado` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(70) DEFAULT NULL,
  `NIFoPasaporte` varchar(10) NOT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `codigoPostal` varchar(10) DEFAULT NULL,
  `ciudad` varchar(20) DEFAULT NULL,
  `provincia` varchar(20) DEFAULT NULL,
  `pais` varchar(20) DEFAULT NULL,
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaUpdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idCliente`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `idEstado`, `nombre`, `apellidos`, `NIFoPasaporte`, `telefono`, `email`, `direccion`, `codigoPostal`, `ciudad`, `provincia`, `pais`, `fechaAlta`, `fechaUpdate`) VALUES
(4, 2, 'Maria', 'ramirez', '13477542b', '276062155', 'rau3@hotmail.com', 'c/la plana, 4, 1b', '28654', 'barcelona', 'hospitalet', 'españa', '2020-01-13 20:31:46', NULL),
(3, 2, 'Raulin', 'gonzalez', '13477542b', '276062155', 'rau3@hotmail.com', 'c/la plana, 4, 1b', '28654', 'barcelona', 'hospitalet', 'españa', '2020-01-13 20:30:48', NULL),
(5, 2, 'Adrian', 'peralta', '13477542b', '276062155', 'rau3@hotmail.com', 'c/la plana, 4, 1b', '28654', 'barcelona', 'hospitalet', 'españa', '2020-01-13 20:32:26', NULL),
(6, 2, 'Laura', 'Peña', '13477542b', '276062155', 'Laura05@hotmail.com', 'c/la plana, 4, 1b', '27000', 'barcelona', 'hospitalet', 'españa', '2020-01-13 20:50:30', NULL),
(7, 2, 'Juan', 'Perez', '13477542b', '276062155', 'Juan05@hotmail.com', 'c/la plana, 4, 1b', '20000', 'barcelona', 'hospitalet', 'españa', '2020-01-13 20:51:14', NULL),
(8, 2, 'José', 'Sanchez', '13477542b', '276062155', 'José05@hotmail.com', 'c/la plana, 4, 1b', '21000', 'barcelona', 'hospitalet', 'españa', '2020-01-13 20:51:14', NULL),
(9, 2, 'Miguel', 'Gonzalez', '13477542b', '276062155', 'Miguel05@hotmail.com', 'c/la plana, 4, 1b', '22000', 'barcelona', 'hospitalet', 'españa', '2020-01-13 20:51:14', NULL),
(10, 2, 'Antonio', 'Peralta', '13477542b', '276062155', 'Antonio05@hotmail.com', 'c/la plana, 4, 1b', '23000', 'barcelona', 'hospitalet', 'españa', '2020-01-13 20:51:14', NULL),
(11, 2, 'Maria', 'García', '13477542b', '276062155', 'Maria05@hotmail.com', 'c/la plana, 4, 1b', '24000', 'barcelona', 'hospitalet', 'españa', '2020-01-13 20:51:14', NULL),
(12, 2, 'Esther', 'Ontana', '13477542b', '276062155', 'Esther05@hotmail.com', 'c/la plana, 4, 1b', '25000', 'barcelona', 'hospitalet', 'españa', '2020-01-13 20:51:14', NULL),
(13, 2, 'Paula', 'Ramirez', '13477542b', '276062155', 'Paula05@hotmail.com', 'c/la plana, 4, 1b', '26000', 'barcelona', 'hospitalet', 'españa', '2020-01-13 20:51:14', NULL),
(14, 2, 'Laura', 'Peña', '13477542b', '276062155', 'Laura05@hotmail.com', 'c/la plana, 4, 1b', '27000', 'barcelona', 'hospitalet', 'españa', '2020-01-13 20:51:14', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_pasajero_reserva_ref`
--

DROP TABLE IF EXISTS `cliente_pasajero_reserva_ref`;
CREATE TABLE IF NOT EXISTS `cliente_pasajero_reserva_ref` (
  `idCliente` int(11) NOT NULL,
  `idPasajero` int(11) NOT NULL,
  `idReserva` int(11) NOT NULL,
  PRIMARY KEY (`idCliente`,`idPasajero`,`idReserva`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

DROP TABLE IF EXISTS `contactos`;
CREATE TABLE IF NOT EXISTS `contactos` (
  `idContacto` int(11) NOT NULL AUTO_INCREMENT,
  `idTipo` int(11) NOT NULL,
  `contacto` varchar(255) NOT NULL,
  `personaContacto` varchar(255) DEFAULT NULL,
  `srcTabla` varchar(255) NOT NULL,
  `idTabla` int(11) NOT NULL,
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaUpdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idContacto`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`idContacto`, `idTipo`, `contacto`, `personaContacto`, `srcTabla`, `idTabla`, `fechaAlta`, `fechaUpdate`) VALUES
(1, 8, '676062155', 'Rafa', 'proveedores', 1, '2020-01-18 18:53:12', NULL),
(2, 9, 'angel_rafael01@hotmail.com', '', 'proveedores', 1, '2020-01-18 18:53:12', NULL),
(3, 10, 'www.caribetour.es', '', 'proveedores', 1, '2020-01-18 18:53:12', NULL),
(4, 8, '914 455 257', 'Alexis', 'proveedores', 2, '2020-01-18 18:53:12', NULL),
(5, 9, 'viajes@grecotour.com', '', 'proveedores', 2, '2020-01-18 18:53:12', NULL),
(6, 10, 'http://www.grecotour.com', '', 'proveedores', 2, '2020-01-18 18:53:12', NULL),
(7, 8, '829 659 4688', '', 'proveedores', 3, '2020-01-18 18:53:12', NULL),
(8, 9, 'info@proexcursions.com', '', 'proveedores', 3, '2020-01-18 18:53:12', NULL),
(9, 10, 'www.proexcursionsbayahibe.com/excursions-plongee/index.aspx', '', 'proveedores', 3, '2020-01-18 18:53:12', NULL),
(10, 8, '(809) 455 1573', '', 'proveedores', 4, '2020-01-18 18:53:12', NULL),
(11, 10, 'http://www.outbackadventuresdr.com/', '', 'proveedores', 4, '2020-01-18 18:53:12', NULL),
(12, 8, '809 815 2795', '', 'proveedores', 5, '2020-01-18 18:53:12', NULL),
(13, 9, 'info@monstertrucksafari.com', '', 'proveedores', 5, '2020-01-18 18:53:12', NULL),
(14, 10, 'www.monstertrucksafari.com', '', 'proveedores', 5, '2020-01-18 18:53:12', NULL),
(15, 8, '(809)796-7569', '', 'proveedores', 6, '2020-01-18 18:53:12', NULL),
(16, 10, 'www.colonialtours.com.do/tours/tours.asp?s_zona=1', '', 'proveedores', 6, '2020-01-18 18:53:12', NULL),
(17, 8, '829 584 2386', '', 'proveedores', 7, '2020-01-18 18:53:12', NULL),
(18, 10, 'http://puntacanatours.es/', '', 'proveedores', 7, '2020-01-18 18:53:12', NULL),
(19, 8, '+34 922 170 493', '', 'proveedores', 8, '2020-01-18 18:53:12', NULL),
(20, 10, 'http://espana.spinofftravel.com/', '', 'proveedores', 8, '2020-01-18 18:53:12', NULL),
(21, 8, '654321321', 'Oscar', 'proveedores', 9, '2020-01-18 18:53:12', NULL),
(22, 9, 'info@zafiro.com', '', 'proveedores', 9, '2020-01-18 18:53:12', NULL),
(23, 10, 'www.zafirotours.com', '', 'proveedores', 9, '2020-01-18 18:53:12', NULL),
(24, 8, '91 188 06 60', '', 'proveedores', 10, '2020-01-18 18:53:12', NULL),
(25, 10, 'www.servivuelo.com/', '', 'proveedores', 10, '2020-01-18 18:53:12', NULL),
(26, 8, '971 576 554', 'Chari Prima', 'proveedores', 11, '2020-01-18 18:53:12', NULL),
(27, 9, 'reservas@aerticket.es', '', 'proveedores', 11, '2020-01-18 18:53:12', NULL),
(28, 10, 'www.aerticket.es', '', 'proveedores', 11, '2020-01-18 18:53:12', NULL),
(29, 8, '902140040', '', 'proveedores', 12, '2020-01-18 18:53:12', NULL),
(30, 9, ' info.minorista@travelplan.es', '', 'proveedores', 12, '2020-01-18 18:53:12', NULL),
(31, 10, 'http://www.travelplan.es/', '', 'proveedores', 12, '2020-01-18 18:53:12', NULL),
(32, 8, '911 680 680', 'Mirian Mat&iacute;a', 'proveedores', 13, '2020-01-18 18:53:12', NULL),
(33, 9, 'mmatia@intermundial.es', '', 'proveedores', 13, '2020-01-18 18:53:12', NULL),
(34, 10, 'www.intermundial.es', '', 'proveedores', 13, '2020-01-18 18:53:12', NULL),
(35, 8, ' 902 148 842 ', 'Antonio Palaci&aacute;n', 'proveedores', 14, '2020-01-18 18:53:12', NULL),
(36, 9, 'comisiones.finanzas@avis.es, antonio.palacian@avis.es', '', 'proveedores', 14, '2020-01-18 18:53:12', NULL),
(37, 10, 'www.', '', 'proveedores', 14, '2020-01-18 18:53:12', NULL),
(38, 8, '933662602', 'Eva Pascual Espinosa', 'proveedores', 15, '2020-01-18 18:53:12', NULL),
(39, 9, 'booking.seguros@aon.es', '', 'proveedores', 15, '2020-01-18 18:53:12', NULL),
(40, 10, 'http://www.taeds.com/default.asp', '', 'proveedores', 15, '2020-01-18 18:53:12', NULL),
(41, 8, '902 365 001 - 627 472 237', 'Sonia Orihuela', 'proveedores', 16, '2020-01-18 18:53:12', NULL),
(42, 9, 'sonia.orihuela@nextel.travel', '', 'proveedores', 16, '2020-01-18 18:53:12', NULL),
(43, 10, 'http://www.nextel.travel/es/home/', '', 'proveedores', 16, '2020-01-18 18:53:12', NULL),
(44, 8, '+34 971 211175', 'Isabel Chac&oacute;n', 'proveedores', 17, '2020-01-18 18:53:12', NULL),
(45, 9, 'asistencia.comercial@jumbobeds.com', '', 'proveedores', 17, '2020-01-18 18:53:12', NULL),
(46, 10, 'https://www.jumbobeds.com/ES/index.m', '', 'proveedores', 17, '2020-01-18 18:53:12', NULL),
(47, 8, '682 876 437 | 912 785 100', 'Daniel Ruiz Latorre', 'proveedores', 18, '2020-01-18 18:53:12', NULL),
(48, 9, 'danielruiz@clubdevacaciones.es', '', 'proveedores', 18, '2020-01-18 18:53:12', NULL),
(49, 10, 'www.', '', 'proveedores', 18, '2020-01-18 18:53:12', NULL),
(50, 8, '911858910', '', 'proveedores', 19, '2020-01-18 18:53:12', NULL),
(51, 9, 'info@grupovdt.com', '', 'proveedores', 19, '2020-01-18 18:53:12', NULL),
(52, 10, 'http://www.grupovdt.com/wtc/es/vuelos/Default.aspx', '', 'proveedores', 19, '2020-01-18 18:53:12', NULL),
(53, 8, '93 342 99 90 - 628 850 923 - 674 842 729', 'David Pobes Y Charo Perez', 'proveedores', 20, '2020-01-18 18:53:12', NULL),
(54, 9, 'comercial.centro@grupoeuropa.com, delegado.centro@grupoeuropa.com, cruceros@grupoeuropa.com', '', 'proveedores', 20, '2020-01-18 18:53:12', NULL),
(55, 10, 'http://www.grupoeuropa.com/socios/index.php3', '', 'proveedores', 20, '2020-01-18 18:53:12', NULL),
(56, 8, '971448096', 'Jordi Amengual', 'proveedores', 21, '2020-01-18 18:53:12', NULL),
(57, 9, 'comercial@quelonea.com', '', 'proveedores', 21, '2020-01-18 18:53:12', NULL),
(58, 10, 'http://www.quelonea.com/', '', 'proveedores', 21, '2020-01-18 18:53:12', NULL),
(59, 9, 'soporteagencias@gowaii.com', '', 'proveedores', 22, '2020-01-18 18:53:12', NULL),
(60, 10, 'http://b2b.gowaii.com ', '', 'proveedores', 22, '2020-01-18 18:53:12', NULL),
(61, 8, '34 93 4525570 (Ext 434)', 'Yolanda Navarro', 'proveedores', 23, '2020-01-18 18:53:12', NULL),
(62, 9, 'agencias@keytel.es', '', 'proveedores', 23, '2020-01-18 18:53:12', NULL),
(63, 10, 'http://www.keytel.es/ky/web/login.xhtml', '', 'proveedores', 23, '2020-01-18 18:53:12', NULL),
(64, 8, '93 368 73 43', 'Eva Lorenzo', 'proveedores', 24, '2020-01-18 18:53:12', NULL),
(65, 9, 'comercial@flexibleautos.com', '', 'proveedores', 24, '2020-01-18 18:53:12', NULL),
(66, 10, 'http://www.flexibleautos.es/', '', 'proveedores', 24, '2020-01-18 18:53:12', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

DROP TABLE IF EXISTS `documentos`;
CREATE TABLE IF NOT EXISTS `documentos` (
  `idDocumento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `path` varchar(40) NOT NULL COMMENT 'el path es el sha1_file del documento, con esto comprobamos si ya se ha subido el mismo documento con distinto nombre',
  `nombreTabla` varchar(255) NOT NULL,
  `idTabla` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idDocumento`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

DROP TABLE IF EXISTS `estados`;
CREATE TABLE IF NOT EXISTS `estados` (
  `idEstado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `productos` tinyint(4) NOT NULL DEFAULT '0',
  `categorias` tinyint(4) NOT NULL DEFAULT '0',
  `blogComentarios` tinyint(4) NOT NULL DEFAULT '0',
  `blos` tinyint(4) NOT NULL DEFAULT '0',
  `proveedores` tinyint(4) NOT NULL DEFAULT '0',
  `pagos` tinyint(4) NOT NULL DEFAULT '0',
  `reservas` tinyint(4) NOT NULL DEFAULT '0',
  `clientes` tinyint(4) NOT NULL DEFAULT '0',
  `usuarios` tinyint(4) NOT NULL DEFAULT '0',
  `legales` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idEstado`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`idEstado`, `nombre`, `productos`, `categorias`, `blogComentarios`, `blos`, `proveedores`, `pagos`, `reservas`, `clientes`, `usuarios`, `legales`) VALUES
(1, '-', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 'Activo', 1, 1, 0, 1, 1, 0, 0, 1, 1, 1),
(3, 'Inactivo', 1, 1, 0, 1, 1, 0, 0, 1, 1, 1),
(4, 'Confirmado', 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(5, 'Cancelado', 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(6, 'Pendiente de Confirmar', 0, 0, 0, 0, 0, 0, 1, 0, 0, 0),
(7, 'Pendiente de Pago', 0, 0, 0, 0, 0, 1, 0, 0, 0, 0),
(8, 'Pagado', 0, 0, 0, 0, 0, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

DROP TABLE IF EXISTS `facturas`;
CREATE TABLE IF NOT EXISTS `facturas` (
  `idFactura` int(11) NOT NULL AUTO_INCREMENT,
  `facturaNum` varchar(10) NOT NULL,
  `idReserva` int(11) NOT NULL,
  `idFacturaTitular` int(11) NOT NULL,
  `importeBruto` double NOT NULL,
  `IVA` int(11) NOT NULL COMMENT 'Indica el IVA en porcentaje 0 - 100',
  `descuento` int(11) DEFAULT NULL COMMENT 'indica el descuento en porcentaje 0 - 100',
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fehaUpdate` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idFactura`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_num`
--

DROP TABLE IF EXISTS `factura_num`;
CREATE TABLE IF NOT EXISTS `factura_num` (
  `facturaNum` int(11) NOT NULL AUTO_INCREMENT COMMENT 'este campo genera el numero visible de la factura, cada año vuelve a contar desde cero',
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`facturaNum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_titular`
--

DROP TABLE IF EXISTS `factura_titular`;
CREATE TABLE IF NOT EXISTS `factura_titular` (
  `idFacturaTitular` int(11) NOT NULL AUTO_INCREMENT,
  `idCliente` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(70) DEFAULT NULL,
  `NIF` varchar(10) NOT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `codigoPostal` varchar(10) DEFAULT NULL,
  `ciudad` varchar(20) DEFAULT NULL,
  `provincia` varchar(20) DEFAULT NULL,
  `pais` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idFacturaTitular`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fechas`
--

DROP TABLE IF EXISTS `fechas`;
CREATE TABLE IF NOT EXISTS `fechas` (
  `idFecha` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `terminalSalida` varchar(10) DEFAULT NULL,
  `terminalDestino` varchar(10) DEFAULT NULL,
  `tasasSalida` double DEFAULT NULL,
  `tasasDestino` double DEFAULT NULL,
  PRIMARY KEY (`idFecha`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

DROP TABLE IF EXISTS `imagenes`;
CREATE TABLE IF NOT EXISTS `imagenes` (
  `idImagen` int(11) NOT NULL AUTO_INCREMENT,
  `idProducto` int(11) NOT NULL,
  `srcImagen` varchar(255) NOT NULL,
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fehaUpdate` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idImagen`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `legales`
--

DROP TABLE IF EXISTS `legales`;
CREATE TABLE IF NOT EXISTS `legales` (
  `idLegal` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `idEstado` int(11) NOT NULL,
  PRIMARY KEY (`idLegal`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

DROP TABLE IF EXISTS `notas`;
CREATE TABLE IF NOT EXISTS `notas` (
  `idNota` int(11) NOT NULL AUTO_INCREMENT,
  `nombreTabla` varchar(255) NOT NULL,
  `idTabla` int(11) NOT NULL,
  `nota` varchar(255) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaUpdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idNota`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`idNota`, `nombreTabla`, `idTabla`, `nota`, `idUsuario`, `fechaAlta`, `fechaUpdate`) VALUES
(1, 'proveedores', 1, 'Somos nosotros', 1, '2020-01-17 23:05:32', NULL),
(2, 'proveedores', 2, 'Notas', 1, '2020-01-17 23:05:32', NULL),
(3, 'proveedores', 4, 'Tiene de un gran numero de excursiones disponible por todo el territorio de la Rep. Dom.', 1, '2020-01-17 23:05:32', NULL),
(4, 'proveedores', 10, 'Son consolidadores aereos\nesta pendiente de consultarle como es su buscador de buelo y cuanto cobran por incorporarlo en mi web.\na parte hay que consultarle si ofrecen otros servicios.', 1, '2020-01-17 23:05:32', NULL),
(5, 'proveedores', 11, 'número de cliente: 086110\ncontraseña: Aerticket1\n\nconsolidadores de vuelos,\npendiente de hacer la consulta a la comercial Rosario Prima ( comercial@aerticket.es ) para saber si disponen de buscador de vuelos y si lo puedo incorporar en mi web, tambien', 1, '2020-01-17 23:05:32', NULL),
(6, 'proveedores', 12, 'Es una mayorista, \ntengo pendiente de consultarle los paquetes que tienen  disponible y cuanto es la comision', 1, '2020-01-17 23:05:32', NULL),
(7, 'proveedores', 13, 'user: CARIBET \npwr: BET070616 ', 1, '2020-01-17 23:05:32', NULL),
(8, 'proveedores', 14, 'Mi aan es 0196453n\npara cotizar\nhttp//production.rent-at-avis.com/avisonline/es/ibe.nsf/reservationstep1openform&amp;mst=3e2a10c654908451c1257633004e1c28\n \n', 1, '2020-01-17 23:05:32', NULL),
(9, 'proveedores', 15, 'Http//www.taeds.com/default.asp\nusuario caribe\npassword godella\n\n\nhttp://www.taeds.com/aonseguros/entry.asp?tb_usuari=CARIBE&tb_password=GODELLA', 1, '2020-01-17 23:05:32', NULL),
(10, 'proveedores', 16, 'Usuario 101354\ncontrase&ntilde;a caribe2016\nwww.nextel.travel - www.nextelonline.es', 1, '2020-01-17 23:05:32', NULL),
(11, 'proveedores', 17, 'User: EUROPA581\nPassword: h7hBSP\n \nnuestros destinos estrella \n&8203;en españa &8203;baleares, canarias, costa del sol, costa blanca, costa brava, urbano nacional.\nen europa y mediterráneo parís, italia-c', 1, '2020-01-17 23:05:32', NULL),
(12, 'proveedores', 18, 'Usuario        caribetour0001 \npassword        caribetour0001 \n', 1, '2020-01-17 23:05:32', NULL),
(13, 'proveedores', 19, 'Mayorista del caribe\nlogin: info@caribetour.es \ncontraseña: 8222', 1, '2020-01-17 23:05:32', NULL),
(14, 'proveedores', 20, 'Usuario: caribetour\ncontraseña: mfwkpc2s4\n   \n', 1, '2020-01-17 23:05:32', NULL),
(15, 'proveedores', 21, 'Usuario 21676062155\ncontraseï¿½a 21676062155999\n \nlas web con acceso son \nlacuartaisla.com, quelonea.com, jolidey.com, vivatours.com, leskionline.com, jotelclick.com, evelop.com y jolidey.pt\n\n\nvamos a un 10%', 1, '2020-01-17 23:05:32', NULL),
(16, 'proveedores', 22, 'Agencia: 9006220 \nusuario: 909006220 \npassword: 999006220 \n \nurls de acceso \nb2b gowaii  http//b2b.gowaii.com \nb2b mundicolor  http//www.mundicolor.com ', 1, '2020-01-17 23:05:32', NULL),
(17, 'proveedores', 23, 'C&oacute;digo acceso caribetour\n- password 480846ky', 1, '2020-01-17 23:05:32', NULL),
(18, 'proveedores', 24, 'codigo cliente:41767110\ncontraseña:Fa411145\n\nclaves de nuestra intranet:\ncodigo cliente:41767110\ncontraseña:Jg6Tv41767110qy1a', 1, '2020-01-17 23:05:32', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

DROP TABLE IF EXISTS `pagos`;
CREATE TABLE IF NOT EXISTS `pagos` (
  `idPago` int(11) NOT NULL AUTO_INCREMENT,
  `idReserva` int(11) NOT NULL,
  `importe` double NOT NULL,
  `idPagoTipo` int(11) NOT NULL COMMENT 'indica el tipo de pago',
  `idEstado` int(11) NOT NULL,
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idPago`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasajeros`
--

DROP TABLE IF EXISTS `pasajeros`;
CREATE TABLE IF NOT EXISTS `pasajeros` (
  `idPasajero` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(70) DEFAULT NULL,
  `NIFoPasaporte` varchar(10) NOT NULL,
  `nacionalidad` varchar(20) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaUpdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idPasajero`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE IF NOT EXISTS `permisos` (
  `idPermiso` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`idPermiso`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `slug` varchar(100) DEFAULT NULL,
  `itinerario` text,
  `incluye` text,
  `metaDescripcion` text,
  `metaKeyWords` varchar(255) DEFAULT NULL,
  `idCategoria` int(11) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `esOferta` tinyint(4) DEFAULT '0',
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fehaUpdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idproducto`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idproducto`, `nombre`, `imagen`, `descripcion`, `slug`, `itinerario`, `incluye`, `metaDescripcion`, `metaKeyWords`, `idCategoria`, `idTipo`, `idEstado`, `idProveedor`, `stock`, `esOferta`, `fechaAlta`, `fehaUpdate`) VALUES
(1, 'Vik Hotel Arena Blanca', 'vik-hotel-arena-blanca.jpg', 'El vik hotel arena blanca estã£â¡ situado en punta cana sobre la inigualable playa de bã£â¡varo, a 30 minutos del aeropuerto internacional de punta cana. este hotel en punta cana fue reformado en 2006 para ofrecerle su caracterã£â­stica variedad de ambientes cuidados terapã£â©uticos y de belleza en el moderno spa, completos programas de animaciã£â³n y cenas romã£â¡nticas bajo las estrellas, sobre la templada playa caribeã£â±a. desconecte desde su llegada al vik.\r\n \r\npara satisfacer todo tipo de paladares, el vik hotel arena blanca dispone de 1 restaurante buffet principal y otros 3 a la carta, con platos de la alta cocina italiana, local e internacional. ã¢â¿cuã£â¡l es la que mã£â¡s le gusta los 5 bares, el snack-bar y la discoteca completan la oferta gastronã£â³mica de nuestro servicio de todo incluido, variado y de calidad. todo tipo de gastronomã£â­a y bebidas para que se sienta mejor que en casa.', 'vik-hotel-arena-blanca', '1- Salida el %s a las %s hrs en vuelo directo desde Madrid con destino %s.\r\n2- Llegada al aeropuerto internacional %s. Asistencia de nuestro Tour Operador en destino para traslados del aeropuerto al hotel %s.\r\n3- Estancia en el hotel %s - %s - todo incluido.\r\n4- Dï¿½a %s traslado desde el hotel %s al aeropuerto, Vuelo desde %s a las %s hrs con destino Madrid.', '-Vuelo directo con la compaï¿½ï¿½a Evelop desde Madrid con destino Punta Cana.\r\n-Estancia en habitaciï¿½n Standard, 7 noches en rï¿½gimen de todo incluï¿½do en el Hotel VIK Arena Blanca 4* - Punta Cana.\r\n-Traslados de entrada y salida Punta Cana.\r\n-Tasas aï¿½reas incluidas.\r\n-Seguro obligatorio de Viaje', 'El vik hotel arena blanca est&atilde;&pound;&acirc;&iexcl; situado en punta cana sobre la inigualable playa de b&atilde;&pound;&acirc;&iexcl;varo, a 30 minutos del aeropuerto internacional de punta ca', 'El VIK hotel Arena Blanca estï¿½ situado en Punta Cana sobre la inigualable Playa de Bï¿½varo, a 30 minutos del Aeropuerto Internacional de Punta Cana. ', 11, 3, 1, 21, 100, 0, '2020-01-17 21:55:51', '2020-01-18 17:48:34'),
(2, 'Natura Park Beach Eco Resort &amp; Spa', 'natura-park-beach-eco-resort-y-spa.jpg', 'En este resort se aprovechan los recursos naturales del área tales como las piedras, el coco, la madera y la caña, creando un ambiente de extraordinaria belleza natural que parece estar soñando...\r\n \r\nviva la experiencia de unas vacaciones en completa armonía con la naturaleza en el lujoso resort de punta cana, natura park. abundantes jardines tropicales que rebosan con una exótica vida de aves se mezclan con lagunas y puentes a lo largo de caminos serpenteantes que llevan a la playa. el hotel está ubicado en la maravillosa playa de , uno de los mejores en el caribe.\r\n \r\nel natura park beach eco resort se beneficia de un diseño arquitectónico original que utiliza los recursos naturales de la zona como la piedra, los cocoteros, la madera y la caña para crear un ambiente tranquilo y confortable. el natura park es un lugar idílico para unas vacaciones relajantes en el caribe. nuestra excelente ubicación del punta cana resort ofrece una completa selección de actividades y de servicios especiales.', 'natura-park-beach-eco-resort-y-spa', '1- Salida el %s a las %s hrs en vuelo directo desde Madrid con destino %s.\r\n2- Llegada al aeropuerto internacional %s. Asistencia de nuestro Tour Operador en destino para traslados del aeropuerto al hotel %s.\r\n3- Estancia en el hotel %s - %s - todo incluido.\r\n4- Día %s traslado desde el hotel %s al aeropuerto, Vuelo desde %s a las %s hrs con destino Madrid.', '-Vuelo directo con la compañía Evelop desde Madrid con destino Punta Cana.\r\n-Estancia en habitación Standard, 7 noches en régimen de todo incluído en el Hotel Natura Park Eco - Resort & Spa 5* - Punta Cana.\r\n-Traslados de entrada y salida Punta Cana.\r\n-Tasas aéreas incluidas.\r\n-Seguro obligatorio de Viaje.', 'Natura park beach eco resort &amp; spa es un lugar id&iacute;lico para unas vacaciones relajantes en el caribe.', 'Natura Park Beach Eco Resort & Spa', 7, 3, 1, 21, 100, 0, '2020-01-17 21:55:51', '2020-01-18 17:48:45'),
(3, 'Caribe Club Princess Beach Resort &amp; Spa ', 'caribe-club-princess-beach-resort-y-spa.jpg', 'El hotel caribe club princess beach resort & spa, está situado en una de las más bellas playas de la república dominicana, playa bávaro. gracias a su ubicación, te permitirá disfrutar de un paraje donde la belleza de sus paisajes y el encanto de sus aguas cristalinas, ofrece una percepción emocional de placentera y excepcional sensación de relajamiento y tranquilidad. estarás a pie de playa y además, a tan solo 25 min del aeropuerto de punta cana.\r\n \r\nel completo equipamiento y la calidad de los servicios de sus 111 caribe suites y de sus 229 habitaciones superiores, te ofrecen unas vacaciones en punta cana perfectas para disfrutar con amigos o con tu pareja. tendrás servicio wifi gratuito en el lobby. el atractivo de las tiendas y ofertas que tiene la calle caribeña, te incitarán a que pasees por ella y disfrutes de su animado ambiente.\r\n \r\nademás, este hotel de 4 estrellas te invita a disfrutar de las diversas actividades de ocio y entretenimiento tanto diurnas como nocturnas que tiene organizadas; deportes acuáticos en la playa, ejercicios aeróbicos en la piscina, pista de tenis, paseo en bicicleta, un gran casino ubicado en el bávaro princess, transporte gratuito, discoteca \"areito\" . asimismo, en este hotel todo incluido, podrás degustar la gastronomía de la isla en cualquiera de sus 6 restaurantes / snack bares y 4 bares uno de ellos dentro de la piscina.', 'caribe-club-princess-beach-resort-y-spa', '1- Salida el %s a las %s hrs en vuelo directo desde Madrid con destino %s.\r\n2- Llegada al aeropuerto internacional %s. Asistencia de nuestro Tour Operador en destino para traslados del aeropuerto al hotel %s.\r\n3- Estancia en el hotel %s - %s - todo incluido.\r\n4- Día %s traslado desde el hotel %s al aeropuerto, Vuelo desde %s a las %s hrs con destino Madrid.', '-Vuelo directo con la compañía Wamos Air desde Madrid con destino Punta Cana.\r\n-Estancia en habitación Superior, 7 noches en régimen de todo incluído en el Hotel Caribe Club Princess 4* - Punta Cana.\r\n-Traslados de entrada y salida Punta Cana.\r\n-Tasas aéreas incluidas.\r\n-Seguro obligatorio de Viaje.', 'El hotel caribe club princess beach resort &amp; spa, est&aacute; situado en una de las m&aacute;s bellas playas de la rep&uacute;blica dominicana, playa b&aacute;varo. ', 'Caribe Club Princess Beach Resort & Spa ', 7, 3, 1, 21, 100, 0, '2020-01-17 21:55:51', '2020-01-18 17:48:45'),
(4, 'Sirenis Punta Cana Resort Casino &amp; Aquagames', 'sirenis-punta-cana-resort-casino-y-aquagames.jpg', 'Este espectacular resort de cinco estrellas, está situado en uno de los más bellos cocotales de punta cana; en un entorno privilegiado, el sirenis punta cana resort casino & aquagames ofrece actividades para todas las edades, ya sea en familia, con su pareja o amigos.\r\npreparado para dar el mejor servicio a sus clientes, dispone de dos piscinas para adultos, con entrada tipo playa, 2 piscinas separadas para los más pequeños, terrazas-solárium.  en el sirenis punta cana resort casino & aquagames  disfrutará de fantásticas  instalaciones, pistas de tenis, 1 pista de pádel,  gimnasio, tenis de mesa, dardos, vóley playa, actividades acuáticas como windsurf, kayak, canoa, catamarán, snorkel y buceo. el gran parque acuático sirenis aquagames de 12.000 m2 está disponible para los clientes del hotel; su gran extensión y sus sorprendentes atracciones, ¡es único en su tipo en toda la región . \r\n \r\nla calidad de la cocina que ofrecen nuestros chefs en los restaurante buffet y en los 7 restaurantes temáticos del hotel es excepcional. cada noche una nueva especialidad, italiana, mexicana, asiática y muchas más. con nuestra fórmula de todo incluido no tendrá que preocuparse de nada más, que de disfrutar de sus vacaciones podrá saborear  su cóctel preferido en los 8 bares del complejo, en la discoteca ó en el casino del hotel.\r\n \r\npunta cana le invita a disfrutar de unas vacaciones de ensueño. el exotismo del caribe, la amabilidad de su gente, playas con aguas transparentes ¡un destino mágico y excepcional le espera', 'sirenis-punta-cana-resort-casino-y-aquagames', '1- Salida el %s a las %s hrs en vuelo directo desde Madrid con destino %s.\r\n2- Llegada al aeropuerto internacional %s. Asistencia de nuestro Tour Operador en destino para traslados del aeropuerto al hotel %s.\r\n3- Estancia en el hotel %s - %s - todo incluido.\r\n4- Día %s traslado desde el hotel %s al aeropuerto, Vuelo desde %s a las %s hrs con destino Madrid.', '-Vuelo directo con la compañía Wamos Air desde Madrid con destino Punta Cana.\r\n-Estancia en habitación Standard, 7 noches en régimen de todo incluído en el Hotel Sirenis Punta Cana Resort Aqualand & Casino 5* - Punta Cana.\r\n-Traslados de entrada y salida Punta Cana.\r\n-Tasas aéreas incluidas.\r\n-Seguro obligatorio de Viaje.', 'Sirenis punta cana resort casino &amp; aquagames ofrece actividades para todas las edades, ya sea en familia, con su pareja o amigos.', 'Sirenis Punta Cana Resort Casino & Aquagames', 7, 3, 1, 21, 100, 0, '2020-01-17 21:55:51', '2020-01-18 17:48:45'),
(5, 'Riu Lupita', 'riu-lupita.jpg', 'Rodeado de unos increã­bles jardines tropicales, el hotel riu lupita de playa del carmen ofrece a sus clientes todas las facilidades para que vivan unas vacaciones inolvidables. este hotel 5 estrellas en playa del carmen cuenta con el programa todo incluido 24 horas para proporcionarte los mejores servicios de riu hotels & resorts.\r\n \r\nel hotel riu lupita cuenta con 300 habitaciones divididas en varios edificios con vistas al jardã­n o a la piscina. ademã¡s, te ofrecen aire acondicionado, minibar con dispensador de bebidas, tv satã©lite y balcã³n o terraza, entre otras facilidades, para que tengas todas las comodidades durante tu estancia con nosotros.\r\n \r\nlas completas instalaciones de este hotel todo incluido en playa del carmen, mã©xico, te aseguran unas vacaciones perfectas. podrã¡s refrescarte en las piscinas del hotel y practicar numerosos deportes como tenis, windsurf, kayak, buceo y voleibol, ademã¡s de disfrutar del gimnasio del hotel riu lupita. si deseas relajarte en cualquier momento del dã­a, te recomendamos visitar el renova spa para que disfrutes de un sinfã­n de tratamientos y salgas totalmente renovado.', 'riu-lupita', '1- Salida el %s a las %s hrs en vuelo directo desde Madrid con destino Cancun - %s.\r\n2- Llegada al aeropuerto internacional de Cancun - %s. Asistencia de nuestro Tour Operador en destino para traslados del aeropuerto al hotel %s.\r\n3- Estancia en el hotel %s - %s - todo incluido.\r\n4- Dï¿½a %s traslado desde el hotel %s al aeropuerto, Vuelo desde Cancun - %s a las %s hrs con destino Madrid.', '-Vuelo directo con la compaï¿½ï¿½a Evelop desde Madrid con destino Cancun.\r\n-Estancia en habitaciï¿½n Standard, 7 noches en rï¿½gimen de todo incluï¿½do en el Hotel Riu Lupita 5* - Riviera Maya.\r\n-Traslados de entrada y salida Riviera Maya.\r\n-Tasas aï¿½reas incluidas.\r\n-Seguro obligatorio de Viaje.', 'Rodeado de unos incre&atilde;&shy;bles jardines tropicales, el hotel riu lupita de playa del carmen ofrece a sus clientes todas las facilidades para que vivan unas vacaciones inolvidables.', 'RIU LUPITA', 6, 3, 1, 21, 100, 0, '2020-01-17 21:55:51', '2020-01-18 17:48:45'),
(6, 'Catalonia Riviera Maya Resort &amp; Spa', 'catalonia-riviera-maya-resort-y-spa.jpg', 'Catalonia riviera maya resort & spa está situado en la exclusiva zona de puerto aventuras, en las maravillosas costas del caribe mexicano. en pleno corazón de la riviera maya, puerto aventuras es de fácil acceso por carretera, a tan sólo 24 km de playa del carmen y a 78 km al sur del aeropuerto internacional de cancún, en el estado de quintana roo, méxico.\r\n \r\nla riviera maya es un pequeño paraíso para disfrutar a lo grande. sus paisajes hipnotizan a todo aquel que los mira y sus playas enamoran a quienes tienen el placer de visitarlas. el catalonia riviera maya te ofrece unas vacaciones de ensueño. su distribución permite que las habitaciones ofrezcan maravillosas vistas del mar caribe y de los fantásticos jardines que rodean al hotel.\r\n \r\nnuestras habitaciones se caracterizan por su amplitud, su hermosa y cálida decoración y por sus terrazas o balcones, indispensables para poder experimentar la suave brisa del caribe.\r\n \r\nla oferta gastronómica es amplia para satisfacer todos los gustos, por eso te ofrecemos restaurantes y bares en donde podrás degustar de deliciosos platillos, refrescantes bebidas, así como postres y tus snacks favoritos. nuestras instalaciones y actividades te ofrecen constante diversión y entretenimiento para toda la familia', 'catalonia-riviera-maya-resort-y-spa', '1- Salida el %s a las %s hrs en vuelo directo desde Madrid con destino Cancun - %s.\r\n2- Llegada al aeropuerto internacional de Cancun - %s. Asistencia de nuestro Tour Operador en destino para traslados del aeropuerto al hotel %s.\r\n3- Estancia en el hotel %s - %s - todo incluido.\r\n4- Día %s traslado desde el hotel %s al aeropuerto, Vuelo desde Cancun - %s a las %s hrs con destino Madrid.', '-Vuelo directo con la compañía Evelop desde Madrid con destino Cancun.\r\n-Estancia en habitación Standard, 7 noches en régimen de todo incluído en el Hotel Catalonia Riviera Maya 5* - Riviera Maya.\r\n-Traslados de entrada y salida Riviera Maya.\r\n-Tasas aéreas incluidas.\r\n-Seguro obligatorio de Viaje.', 'Catalonia riviera maya resort &amp; spa est&aacute; situado en la exclusiva zona de puerto aventuras, en las maravillosas costas del caribe mexicano.', 'Catalonia Riviera Maya Resort & Spa', 6, 3, 1, 21, 100, 0, '2020-01-17 21:55:51', '2020-01-18 17:48:45'),
(7, 'Barcel&oacute; Maya Beach', 'barcelo-maya-beach.jpg', 'El hotel barceló maya beach se encuentra dentro de un increíble resort todo incluido situado en una de las playas más bellas del caribe mexicano que se extiende a lo largo de 2 km de arena blanca, agua cristalina y un arrecife de coral.\r\n \r\nel hotel ha sido renovado para adaptarse a las expectativas de nuestros clientes. la nueva casa club con su impactante diseño, alberga los servicios de recepción, lounge club premium, lobby bar beach con terraza para fumadores, restaurante buffet beach, restaurante de especialidad mexicana a la carta méxico lindo, tiendas de regalos y salones para reuniones.\r\n \r\ndele a su estancia un toque de lujo y déjese consentir con los beneficios exclusivos que le brinda el concepto club premium, disfrute de las totalmente nuevas habitaciones junior suite frente al mar club premium y suite frente al mar club premium.\r\n \r\nel hotel le ofrece 3 restaurantes entre los que encontrará el buffet beach con un novedoso diseño inspirado en la cultura maya, el espectacular méxico lindo con especialidades de la cocina mexicana y rancho grande restaurante de playa con vista al mar caribe; además de 3 bares repartidos estratégicamente por el hotel. el programa barceló todo incluido le ofrece aperitivos, comidas y bebidas disponibles las 24 horas del día.', 'barcelo-maya-beach', '1- Salida el %s a las %s hrs en vuelo directo desde Madrid con destino Cancun - %s.\r\n2- Llegada al aeropuerto internacional de Cancun - %s. Asistencia de nuestro Tour Operador en destino para traslados del aeropuerto al hotel %s.\r\n3- Estancia en el hotel %s - %s - todo incluido.\r\n4- Día %s traslado desde el hotel %s al aeropuerto, Vuelo desde Cancun - %s a las %s hrs con destino Madrid.', '- Vuelo directo con la compañía Evelop desde Madrid con destino Cancun.\r\n-Estancia en habitación Standard, 7 noches en régimen de todo incluído en el Hotel Barceló Maya Beach Resort 5* - Riviera Maya.\r\n-Traslados de entrada y salida Riviera Maya.\r\n-Tasas aéreas incluidas.\r\n-Seguro obligatorio de Viaje.', 'El hotel barcel&oacute; maya beach se encuentra dentro de un incre&iacute;ble resort todo incluido situado en una de las playas m&aacute;s bellas del caribe mexicano', 'Barceló Maya Beach', 6, 3, 1, 21, 100, 0, '2020-01-17 21:55:51', '2020-01-18 17:48:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_fecha_ref`
--

DROP TABLE IF EXISTS `producto_fecha_ref`;
CREATE TABLE IF NOT EXISTS `producto_fecha_ref` (
  `idProductoFechaRef` int(11) NOT NULL AUTO_INCREMENT,
  `idProducto` int(11) NOT NULL,
  `idFechaSalida` int(11) DEFAULT NULL,
  `idFechaVuelta` int(11) DEFAULT NULL,
  `precioProveedor` double DEFAULT NULL,
  `comision` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProductoFechaRef`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE IF NOT EXISTS `proveedores` (
  `idProveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `contacto` varchar(30) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `NIF` varchar(20) DEFAULT NULL,
  `web` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `idEstado` int(11) NOT NULL,
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fehaUpdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idProveedor`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idProveedor`, `nombre`, `contacto`, `telefono`, `NIF`, `web`, `email`, `direccion`, `idEstado`, `fechaAlta`, `fehaUpdate`) VALUES
(1, 'Caribetour.es', 'Rafa', '676062155', 'e654054894', 'www.caribetour.es', 'angel_rafael01@hotmail.com', '', 1, '2020-01-17 23:05:32', NULL),
(2, 'Greco Tour', 'Alexis', '914 455 257', 'ES-B-82124546', 'http://www.grecotour.com', 'viajes@grecotour.com', 'calle ruiz 22, 28004 Madrid', 1, '2020-01-17 23:05:32', NULL),
(3, 'Pro Excursions', '', '829 659 4688', '', 'www.proexcursionsbayahibe.com/excursions-plongee/index.aspx', 'info@proexcursions.com', '4 Avenida Cayuco Dominicus, République Dominicaine', 1, '2020-01-17 23:05:32', NULL),
(4, 'OUT BACK ADVENTURES', '', '(809) 455 1573', '', 'http://www.outbackadventuresdr.com/', '', 'Km 2.1 Carretera Veron-Bavaro Bavaro, Republica Dominicana', 1, '2020-01-17 23:05:32', NULL),
(5, 'monster truck safari', '', '809 815 2795', '', 'www.monstertrucksafari.com', 'info@monstertrucksafari.com', '', 1, '2020-01-17 23:05:32', NULL),
(6, 'our amazing tour', '', '(809)796-7569', '456654', 'www.colonialtours.com.do/tours/tours.asp?s_zona=1', '', '', 1, '2020-01-17 23:05:32', NULL),
(7, 'Punta Cana Tours', '', '829 584 2386', '654654', 'http://puntacanatours.es/', '', '', 1, '2020-01-17 23:05:32', NULL),
(8, 'Spin Off Travel', '', '+34 922 170 493', '', 'http://espana.spinofftravel.com/', '', 'C/Fundadores de la Cooperativa,Nº66 - L.10. San Miguel de Abona, 38639, Tenerife.', 1, '2020-01-17 23:05:32', NULL),
(9, 'Zafirotour', 'Oscar', '654321321', '456789654g', 'www.zafirotours.com', 'info@zafiro.com', '', 1, '2020-01-17 23:05:32', NULL),
(10, 'Servi Vuelo', '', '91 188 06 60', '', 'www.servivuelo.com/', '', 'Calle del Dr. Esquerdo, 10, 28028 Madrid', 1, '2020-01-17 23:05:32', NULL),
(11, 'Aerticket', 'Chari Prima', '971 576 554', '', 'www.aerticket.es', 'reservas@aerticket.es', 'C/ Nuredduna, 10 07006 Palma Islas Baleares', 1, '2020-01-17 23:05:32', NULL),
(12, 'Travelplan', '', '902140040', '', 'http://www.travelplan.es/', ' info.minorista@travelplan.es', 'CTRA. ARENAL - LLUCMAJOR KM, 21.5 - 07620 LLUCMAJOR - Baleares', 1, '2020-01-17 23:05:32', NULL),
(13, 'Intermundial Seguros', 'Mirian Mat&iacute;a', '911 680 680', 'B-81577231', 'www.intermundial.es', 'mmatia@intermundial.es', 'c/ Irún 7  28008 Madrid', 1, '2020-01-17 23:05:32', NULL),
(14, 'Avis Alquile Un Coche Sa', 'Antonio Palaci&aacute;n', ' 902 148 842 ', 'A28152767', 'www.', 'comisiones.finanzas@avis.es, antonio.palacian@avis.es', 'Avd Manoteras 32  28050 Madrid', 1, '2020-01-17 23:05:32', NULL),
(15, 'Aon Gil Y Carvajal S.a.u Seguros', 'Eva Pascual Espinosa', '933662602', 'A-28109247', 'http://www.taeds.com/default.asp', 'booking.seguros@aon.es', '', 1, '2020-01-17 23:05:32', NULL),
(16, 'Nextel', 'Sonia Orihuela', '902 365 001 - 627 472 237', '', 'http://www.nextel.travel/es/home/', 'sonia.orihuela@nextel.travel', 'C/ Francesc Carbonell, 21-23, entlo 4ª 08034 Barcelona', 1, '2020-01-17 23:05:32', NULL),
(17, 'Jumbobeds', 'Isabel Chac&oacute;n', '+34 971 211175', '', 'https://www.jumbobeds.com/ES/index.m', 'asistencia.comercial@jumbobeds.com', 'Gran Vía Asima 4A - 2° Polígono de Son Castelló 07009 Palma de Mallorca Illes Balears (Spain)', 1, '2020-01-17 23:05:32', NULL),
(18, 'Daniel Ruiz Latorre', 'Daniel Ruiz Latorre', '682 876 437 | 912 785 100', '', 'www.', 'danielruiz@clubdevacaciones.es', '', 1, '2020-01-17 23:05:32', NULL),
(19, 'Grupo Vdt Dominicana Tours', '', '911858910', '', 'http://www.grupovdt.com/wtc/es/vuelos/Default.aspx', 'info@grupovdt.com', 'C/ Marie Curie 5 Edificio Alpha 3ª planta, Rivas VaciaMadrid 28521 Madrid', 1, '2020-01-17 23:05:32', NULL),
(20, 'Grupo Europa', 'David Pobes Y Charo Perez', '93 342 99 90 - 628 850 923 - 674 842 729', '', 'http://www.grupoeuropa.com/socios/index.php3', 'comercial.centro@grupoeuropa.com, delegado.centro@grupoeuropa.com, cruceros@grupoeuropa.com', 'C/ Occident, 52 08904 - L\'Hospitalet de Llobregat Barcelona ', 1, '2020-01-17 23:05:32', NULL),
(21, 'Travelsens S.l.', 'Jordi Amengual', '971448096', 'B-57727901', 'http://www.quelonea.com/', 'comercial@quelonea.com', 'C/ Albasanz, 16 - 4ï¿½ Pta Of. B1 28037 Madrid', 1, '2020-01-17 23:05:32', NULL),
(22, 'Gowaii', '', '', '', 'http://b2b.gowaii.com ', 'soporteagencias@gowaii.com', '', 1, '2020-01-17 23:05:32', NULL),
(23, 'Keytel Hoteles', 'Yolanda Navarro', '34 93 4525570 (Ext 434)', '', 'http://www.keytel.es/ky/web/login.xhtml', 'agencias@keytel.es', 'C/Mallorca, 351 08013 Barcelona', 1, '2020-01-17 23:05:32', NULL),
(24, 'Flexible Autos', 'Eva Lorenzo', '93 368 73 43', '', 'http://www.flexibleautos.es/', 'comercial@flexibleautos.com', 'Plaza Gala Placidia, 8, 1º-2ª 08006 - Barcelona', 1, '2020-01-17 23:05:32', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

DROP TABLE IF EXISTS `reservas`;
CREATE TABLE IF NOT EXISTS `reservas` (
  `idReserva` int(11) NOT NULL AUTO_INCREMENT,
  `idProductoFechaRef` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `importe` double NOT NULL,
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idReserva`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

DROP TABLE IF EXISTS `tipos`;
CREATE TABLE IF NOT EXISTS `tipos` (
  `idTipo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `productos` tinyint(4) NOT NULL DEFAULT '0',
  `contactos` tinyint(4) NOT NULL DEFAULT '0',
  `pagos` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idTipo`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`idTipo`, `nombre`, `productos`, `contactos`, `pagos`) VALUES
(1, '-', 1, 1, 1),
(2, 'Otros', 1, 1, 1),
(3, 'Tour', 1, 0, 0),
(4, 'Excursion', 1, 0, 0),
(5, 'Traslados', 1, 0, 0),
(6, 'Circuitos', 1, 0, 0),
(7, 'Seguro', 1, 0, 0),
(8, 'Telefono', 0, 1, 0),
(9, 'Email', 0, 1, 0),
(10, 'Web', 0, 1, 0),
(11, 'Fax', 0, 1, 0),
(12, 'Tarjeta', 0, 0, 1),
(13, 'Transferencia', 0, 0, 1),
(14, 'PayPal', 0, 0, 1),
(15, 'Efectivo', 0, 0, 1),
(16, 'Cheque', 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(70) DEFAULT NULL,
  `DNI` varchar(10) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `perfil` varchar(50) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `idEstado` int(11) NOT NULL,
  `idPermiso` int(11) NOT NULL,
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaUpdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
