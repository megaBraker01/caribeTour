-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 27-07-2020 a las 23:34:20
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
-- Base de datos: `caribetour`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE IF NOT EXISTS `blogs` (
  `idBlog` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `metaDescripcion` varchar(255) DEFAULT NULL,
  `metaKeyWords` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `srcImagen` varchar(255) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL DEFAULT '1' COMMENT 'el autor del post',
  `idEstado` int(11) NOT NULL DEFAULT '1',
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaUpdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idBlog`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `blogs`
--

INSERT INTO `blogs` (`idBlog`, `nombre`, `slug`, `metaDescripcion`, `metaKeyWords`, `descripcion`, `srcImagen`, `idUsuario`, `idEstado`, `fechaAlta`, `fechaUpdate`) VALUES
(1, 'Bienvenidos a La Republica Dominicana', 'bienvenidos-a-la-republica-dominicana', 'Es un pai&acirc;&shy;s que se destaca por la calidez de su clima y la hospitalidad de su gente. rep&atilde;&pound;&acirc;&pound;&atilde;&cent;&acirc;&ordm;blica dominicana es un destino sin igual que cuenta con una naturaleza extraordinaria, fascinante hi', 'Bienvenidos a la republica dominicana', '<p>Rep&uacute;blica Dominicana es el segundo pa&iacute;s m&aacute;s grande y m&aacute;s diverso del Caribe. Con vuelos directos desde las principales ciudades de Latinoam&eacute;rica, Estados Unidos, Canad&aacute; y Europa. Es un pa&iacute;s que se destaca por la calidez de su clima y la hospitalidad de su gente. Rep&uacute;blica Dominicana es un destino sin igual que cuenta con una naturaleza extraordinaria, fascinante historia y gran riqueza cultural.<br />\r\nRodeada por el Oc&eacute;ano Atl&aacute;ntico hacia el Norte y el Mar Caribe hacia el Sur, Rep&uacute;blica Dominicana se enorgullece de contar con m&aacute;s de 1,600 Km. de costa y 400 Km. de las mejores playas del mundo, magn&iacute;ficos hoteles y resorts, e infinidad de opciones en deportes, entretenimiento y recreaci&oacute;n. Aqu&iacute; puedes bailar al ritmo contagioso del merengue, renovarte en nuestros lujosos y variados hoteles, explorar antiguas ruinas,&nbsp; deleitarte con la mejor gastronom&iacute;a dominicana, o vivir aventuras ecotur&iacute;sticas en nuestros magn&iacute;ficos parques naturales, cordilleras, r&iacute;os y playas.<br />\r\nDescubierta en 1492 por Crist&oacute;bal Col&oacute;n, Rep&uacute;blica Dominicana cuenta con una fascinante historia, apasionantes museos y experiencias culturales como m&uacute;sica, arte y festivales; adem&aacute;s de una gran variedad de especialidades dominicanas como cigarros, ron, chocolate, caf&eacute;, merengue, &aacute;mbar y larimar.<br />\r\nEl destino n&uacute;mero uno de golf del Caribe y Latinoam&eacute;rica, Rep&uacute;blica Dominicana, deleita a sus visitantes con sus veinticinco campos de golf de renombrados dise&ntilde;adores, rodeados de impresionantes costas, con majestuosas monta&ntilde;as de fondo, y &ldquo;fairways&rdquo; de un verdor exuberante. Adem&aacute;s de escenarios naturales como cascadas rom&aacute;nticas, costas espectaculares y relajantes hoteles y resorts, Rep&uacute;blica Dominicana es el mejor destino para bodas y escapadas rom&aacute;nticas. Tambi&eacute;n ofrece las condiciones ideales para que grupos de ejecutivos de todas partes del mundo se motiven a realizar sus reuniones en el pa&iacute;s.</p>\r\n', 'bienvenidos-a-la-republica-dominicana.jpg', 1, 1, '2020-02-06 22:45:21', '2020-02-12 21:04:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blog_comentarios`
--

DROP TABLE IF EXISTS `blog_comentarios`;
CREATE TABLE IF NOT EXISTS `blog_comentarios` (
  `idBlogComentario` int(11) NOT NULL AUTO_INCREMENT,
  `idBlog` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL DEFAULT '1',
  `nombre` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `comentario` text NOT NULL,
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idBlogComentario`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `blog_comentarios`
--

INSERT INTO `blog_comentarios` (`idBlogComentario`, `idBlog`, `idEstado`, `nombre`, `email`, `comentario`, `fechaAlta`) VALUES
(1, 1, 1, 'alguien', 'correo@mail.com', 'esto es un comentario para hacer pruebas', '2020-02-22 10:20:28'),
(2, 1, 1, 'otro', 'email@correo.com', 'ese blog es muy bueno', '2020-02-22 10:20:28'),
(3, 0, 0, 'Proveedor', 'roberto@hotmail.com', '', '2020-02-22 18:57:25'),
(4, 1, 2, 'Cliente', 'angel_rafael01@hotmail.com', '', '2020-02-22 18:59:51'),
(5, 1, 2, 'Proveedor', 'angel_rafael01@hotmail.com', '', '2020-02-22 19:00:38'),
(6, 1, 2, 'Proveedor', 'angel_rafael01@hotmail.com', 'un comentario\r \ncon multiples lineas\r   \ny muchos caracteres  &quot;&Acirc;&middot;  &amp;/  = &Acirc;&iquest;  &Atilde; &Acirc;&uml;_ ;&Acirc;&ordm;1234557890 &Acirc;&iexcl; +&Atilde;&sect;&Acirc;&acute;-.,  @  &acirc; &not;    ', '2020-02-22 19:03:26'),
(7, 1, 2, 'alguien', 'correo@correo.com', 'este es otro comentario\r \nque le vamos a meter una imagen \r\n&lt;img width=&quot;768&quot; height=&quot;522&quot; src=&quot;vista/frontend/img/bienvenidos-a-la-republica-dominicana.jpg&quot; class=&quot;attachment-wide wp-post-image&quot; alt=&quot;Bienvenidos a La Republica Dominicana&quot; /&gt;', '2020-02-22 19:13:14'),
(8, 1, 2, 'Proveedor', 'roberto@hotmail.com', 'otro comentario m&Atilde;&iexcl;s para ver si el n&Atilde;&ordm;mero de comentarios incrementa', '2020-02-22 19:19:47');

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
  `idEstado` int(11) NOT NULL DEFAULT '1',
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
(4, 1, 'Santo Domingo', 'santo-domingo', 'Es la ciudad primada de ameria\r\n', 1, 'yucatan.jpg'),
(5, 2, 'Rivera Maya', 'rivera-maya', '...', 1, 'rivera-maya.jpg'),
(6, 1, 'Punta Cana', 'punta-cana', '...', 1, 'varadero.jpg'),
(7, 3, 'Varadero', 'varadero', '...', 1, 'varadero.jpg'),
(8, 2, 'Yucatan', 'yucatan', '...', 1, 'yucatan.jpg'),
(9, 2, 'Canc&uacute;n', 'cancun', '...', 1, 'cancun.jpg'),
(10, 1, 'La Romana', 'la-romana', '...', 1, 'cancun.jpg'),
(11, 1, 'Puerto Plata', 'puerto-plata', 'Es Un Lugar Precioso Con Grandes Monta&ntilde;as Y Ricas Playas En Las Que Podras Encontrar Un Sin Numero De Especies Marinas ', 1, 'paradisuspalmareal.jpg'),
(12, 0, 'Puerto Rico', 'puerto-rico', '', 1, 'puerto-rico.jpg'),
(13, 13, 'San Juan', 'san-juan', '....', 1, 'san-juan.jpg'),
(14, 0, 'Seguros', 'seguros', 'Todos Los Seguros Que Pueden Contratar Los Pasajeros', 1, ''),
(15, 14, 'Por Persona', 'por-persona', 'Se Calculan Por La Candidad De Personas Que Lo Contraten', 1, ''),
(16, 14, 'Por Reserva', 'por-reserva', '..', 1, ''),
(17, 14, 'Por Persona Y Estancia', 'por-persona-y-estancia', '..', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cias`
--

DROP TABLE IF EXISTS `cias`;
CREATE TABLE IF NOT EXISTS `cias` (
  `idCia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `codigo` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idCia`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cias`
--

INSERT INTO `cias` (`idCia`, `nombre`, `codigo`) VALUES
(1, 'caribetour', 'caribetour');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `idEstado` int(11) NOT NULL DEFAULT '1',
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
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

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
(14, 2, 'Laura', 'Peña', '13477542b', '276062155', 'Laura05@hotmail.com', 'c/la plana, 4, 1b', '27000', 'barcelona', 'hospitalet', 'españa', '2020-01-13 20:51:14', NULL),
(15, 0, 'Laura', 'Avram', 'D98755654', '637929208', 'laura@hotmail.com', 'calle puerto del pozazal 37, p', '28031', 'Vallecas', 'madrid', '', '2020-06-23 18:39:24', NULL),
(16, 0, 'Laura', 'Avram', 'D98755654', '637929208', 'laura@hotmail.com', 'calle puerto del pozazal 37, p', '28031', 'Vallecas', 'madrid', '', '2020-06-23 18:41:06', NULL),
(17, 0, 'Laura', 'Avram', 'D98755654', '637929208', 'laura@hotmail.com', 'calle puerto del pozazal 37, p', '28031', 'Vallecas', 'madrid', '', '2020-06-23 18:43:14', NULL),
(18, 0, 'Laura', 'Avram', 'D98755654', '637929208', 'laura@hotmail.com', 'calle puerto del pozazal 37, p', '28031', 'Vallecas', 'madrid', '', '2020-06-23 19:07:06', NULL),
(19, 0, 'Laura', 'Avram', 'D98755654', '637929208', 'laura@hotmail.com', 'calle puerto del pozazal 37, p', '28031', 'Vallecas', 'madrid', '', '2020-06-23 19:13:04', NULL),
(20, 0, 'Laura', 'Avram', 'D98755654', '637929208', 'laura@hotmail.com', 'calle puerto del pozazal 37, p', '28031', 'Vallecas', 'madrid', '', '2020-06-23 19:30:56', NULL),
(21, 0, 'Laura', 'Avram', 'D98755654', '637929208', 'laura@hotmail.com', 'calle puerto del pozazal 37, p', '28031', 'Vallecas', 'madrid', '', '2020-06-23 19:31:07', NULL),
(22, 0, 'Laura', 'Avram', 'D98755654', '637929208', 'laura@hotmail.com', 'calle puerto del pozazal 37, p', '28031', 'Vallecas', 'madrid', 'España', '2020-06-23 19:32:23', NULL),
(23, 0, 'Laura', 'Avram', 'D98755654', '637929208', 'laura@hotmail.com', 'calle puerto del pozazal 37, p', '28031', 'Vallecas', 'madrid', 'España', '2020-06-23 19:34:19', NULL),
(24, 2, 'armando', 'perez', '4654654654', '654654654', 'armando@email.com', 'calle primera 3', '28000', 'madrid', 'madrid', 'españa', '2020-06-25 23:59:34', NULL),
(25, 2, 'raul', 'gonzalez', 'r789789789', '654987987', 'raul@email.com', 'calle segunda, 4', '28000', 'madrid', 'madrid', 'españa', '2020-07-01 18:33:48', NULL),
(26, 2, 'edwart', 'meran', 'r987987987', '654321654', 'edwart@email.com', 'fuego, 34', '28035', 'alcobendas', 'madrid', 'españa', '2020-07-02 20:33:26', NULL),
(27, 2, 'edwart', 'meran', 'r987987987', '654321654', 'edwart@email.com', 'fuego, 34', '28035', 'alcobendas', 'madrid', 'españa', '2020-07-02 20:36:49', NULL),
(28, 2, 'edwart', 'meran', 'r987987987', '654321654', 'edwart@email.com', 'fuego, 34', '28035', 'alcobendas', 'madrid', 'españa', '2020-07-02 20:37:53', NULL),
(29, 2, 'edwart', 'meran', 'r987987987', '654321654', 'edwart@email.com', 'fuego, 34', '28035', 'alcobendas', 'madrid', 'españa', '2020-07-02 20:43:10', NULL),
(30, 2, 'Laura', 'Avram', 'D98755654', '637929208', 'laura@hotmail.com', 'calle puerto del pozazal 37, p', '28031', 'Vallecas', 'madrid', 'España', '2020-07-17 00:14:43', NULL),
(31, 2, 'Laura', 'Avram', 'D98755654', '637929208', 'laura@hotmail.com', 'calle puerto del pozazal 37, p', '28031', 'Vallecas', 'madrid', 'España', '2020-07-27 22:03:48', NULL),
(32, 2, 'Laura', 'Avram', 'D98755654', '637929208', 'laura@hotmail.com', 'calle puerto del pozazal 37, p', '28031', 'Vallecas', 'madrid', 'España', '2020-07-27 22:09:47', NULL),
(33, 2, 'Laura', 'Avram', 'D98755654', '637929208', 'laura@hotmail.com', 'calle puerto del pozazal 37, p', '28031', 'Vallecas', 'madrid', 'España', '2020-07-27 22:24:58', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

DROP TABLE IF EXISTS `contactos`;
CREATE TABLE IF NOT EXISTS `contactos` (
  `idContacto` int(11) NOT NULL AUTO_INCREMENT,
  `idTipo` int(11) NOT NULL DEFAULT '1',
  `contacto` varchar(255) NOT NULL,
  `personaContacto` varchar(255) DEFAULT NULL,
  `tabla` varchar(255) NOT NULL,
  `idTabla` int(11) NOT NULL,
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaUpdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idContacto`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`idContacto`, `idTipo`, `contacto`, `personaContacto`, `tabla`, `idTabla`, `fechaAlta`, `fechaUpdate`) VALUES
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
(66, 10, 'http://www.flexibleautos.es/', '', 'proveedores', 24, '2020-01-18 18:53:12', NULL),
(67, 8, '654654654', 'raul', 'proveedores', 24, '2020-06-07 08:20:47', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

DROP TABLE IF EXISTS `documentos`;
CREATE TABLE IF NOT EXISTS `documentos` (
  `idDocumento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `path` varchar(40) NOT NULL COMMENT 'el path es el sha1_file del documento, con esto comprobamos si ya se ha subido el mismo documento con distinto nombre',
  `tabla` varchar(255) NOT NULL,
  `idTabla` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL DEFAULT '1',
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
  PRIMARY KEY (`idEstado`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`idEstado`, `nombre`) VALUES
(1, '-'),
(2, 'Activo'),
(3, 'Inactivo'),
(4, 'Confirmado'),
(5, 'Cancelado'),
(6, 'Pendiente de Confirmar'),
(7, 'Pendiente de Pago'),
(8, 'Pagado'),
(12, 'Pendiente de Confirmar Proveedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_tabla_ref`
--

DROP TABLE IF EXISTS `estado_tabla_ref`;
CREATE TABLE IF NOT EXISTS `estado_tabla_ref` (
  `idEstado` int(11) NOT NULL,
  `tabla` varchar(20) NOT NULL,
  PRIMARY KEY (`idEstado`,`tabla`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado_tabla_ref`
--

INSERT INTO `estado_tabla_ref` (`idEstado`, `tabla`) VALUES
(1, 'blogs'),
(1, 'blog_comentarios'),
(1, 'categorias'),
(1, 'clientes'),
(1, 'legales'),
(1, 'pagos'),
(1, 'productos'),
(1, 'proveedores'),
(1, 'reservas'),
(1, 'usuarios'),
(2, 'blogs'),
(2, 'categorias'),
(2, 'clientes'),
(2, 'legales'),
(2, 'productos'),
(2, 'proveedores'),
(2, 'usuarios'),
(3, 'blogs'),
(3, 'categorias'),
(3, 'clientes'),
(3, 'legales'),
(3, 'productos'),
(3, 'proveedores'),
(3, 'usuarios'),
(4, 'pagos'),
(4, 'reservas'),
(5, 'pagos'),
(5, 'reservas'),
(6, 'reservas'),
(7, 'pagos'),
(7, 'reservas'),
(8, 'pagos'),
(8, 'reservas'),
(12, 'reservas');

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
  `idPuertoSalida` int(11) DEFAULT '1',
  `terminalSalida` varchar(10) DEFAULT NULL,
  `tasasSalida` double DEFAULT NULL,
  `idPuertoDestino` int(11) DEFAULT '1',
  `terminalDestino` varchar(10) DEFAULT NULL,
  `tasasDestino` double DEFAULT NULL,
  `idCia` int(11) DEFAULT '1',
  PRIMARY KEY (`idFecha`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fechas`
--

INSERT INTO `fechas` (`idFecha`, `fecha`, `idPuertoSalida`, `terminalSalida`, `tasasSalida`, `idPuertoDestino`, `terminalDestino`, `tasasDestino`, `idCia`) VALUES
(1, '2020-08-22 00:00:00', 2, 'T2', 60, 3, 'T1', 0, 1),
(2, '2020-08-29 00:00:00', 3, 'T1', 20, 2, 'T2', 0, 1),
(3, '2020-08-23 00:00:00', 2, 'T2', 60, 3, 'T1', 0, 1),
(4, '2020-08-30 00:00:00', 3, 'T1', 20, 2, 'T2', 0, 1),
(5, '2020-09-01 00:00:00', 2, 'T2', 60, 3, 'T1', 0, 1),
(6, '2020-09-08 00:00:00', 3, 'T1', 20, 2, 'T2', 0, 1),
(7, '2020-09-06 00:00:00', 2, 'T2', 60, 3, 'T1', 0, 1),
(8, '2020-09-13 00:00:00', 3, 'T1', 20, 2, 'T2', 0, 1),
(9, '2020-08-18 00:00:00', 2, 'T2', 60, 3, 'T1', 0, 1),
(10, '2020-08-23 00:00:00', 3, 'T1', 20, 2, 'T2', 0, 1),
(11, '2020-09-06 00:00:00', 1, '', 0, 1, '', 0, 1),
(12, '2020-09-13 00:00:00', 1, '', 0, 1, '', 0, 1),
(13, '2020-09-06 00:00:00', 1, '', 0, 1, '', 0, 1),
(14, '2020-09-13 00:00:00', 1, '', 0, 1, '', 0, 1),
(15, '2020-09-06 00:00:00', 1, '', 0, 1, '', 0, 1),
(16, '2020-09-13 00:00:00', 1, '', 0, 1, '', 0, 1),
(17, '2020-09-06 00:00:00', 1, '', 0, 1, '', 0, 1),
(18, '2020-09-13 00:00:00', 1, '', 0, 1, '', 0, 1),
(19, '2020-09-06 00:00:00', 1, '', 0, 1, '', 0, 1),
(20, '2020-09-13 00:00:00', 1, '', 0, 1, '', 0, 1),
(21, '2020-09-06 00:00:00', 1, '', 0, 1, '', 0, 1),
(22, '2020-09-13 00:00:00', 1, '', 0, 1, '', 0, 1),
(23, '2020-09-06 00:00:00', 1, '', 0, 1, '', 0, 1),
(24, '2020-09-13 00:00:00', 1, '', 0, 1, '', 0, 1),
(25, '2020-09-06 00:00:00', 1, '', 0, 1, '', 0, 1),
(26, '2020-09-13 00:00:00', 1, '', 0, 1, '', 0, 1),
(27, '2020-09-06 00:00:00', 1, '', 0, 1, '', 0, 1),
(28, '2020-09-13 00:00:00', 1, '', 0, 1, '', 0, 1),
(29, '2020-09-06 00:00:00', 1, '', 0, 1, '', 0, 1),
(30, '2020-09-13 00:00:00', 1, '', 0, 1, '', 0, 1),
(31, '2020-09-06 00:00:00', 1, '', 0, 1, '', 0, 1),
(32, '2020-09-13 00:00:00', 1, '', 0, 1, '', 0, 1),
(33, '2020-09-06 00:00:00', 1, '', 0, 1, '', 0, 1),
(34, '2020-09-13 00:00:00', 1, '', 0, 1, '', 0, 1),
(35, '2020-09-06 00:00:00', 1, '', 0, 1, '', 0, 1),
(36, '2020-09-13 00:00:00', 1, '', 0, 1, '', 0, 1),
(37, '2020-08-22 00:00:00', 1, '', 0, 1, '', 0, 1),
(38, '1970-01-01 00:00:00', 1, '', 0, 1, '', 0, 1),
(39, '2020-08-18 00:00:00', 1, '', 0, 1, '', 0, 1),
(40, '2020-08-23 00:00:00', 1, '', 0, 1, '', 0, 1),
(41, '2020-08-18 00:00:00', 1, '', 0, 1, '', 0, 1),
(42, '2020-08-23 00:00:00', 1, '', 0, 1, '', 0, 1),
(43, '2020-09-06 00:00:00', 1, '', 0, 1, '', 0, 1),
(44, '2020-09-13 00:00:00', 1, '', 0, 1, '', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

DROP TABLE IF EXISTS `imagenes`;
CREATE TABLE IF NOT EXISTS `imagenes` (
  `idImagen` int(11) NOT NULL AUTO_INCREMENT,
  `tabla` varchar(255) DEFAULT NULL,
  `idTabla` int(11) DEFAULT NULL,
  `srcImagen` varchar(255) NOT NULL,
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fehaUpdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idImagen`)
) ENGINE=MyISAM AUTO_INCREMENT=97 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`idImagen`, `tabla`, `idTabla`, `srcImagen`, `fechaAlta`, `fehaUpdate`) VALUES
(1, 'productos', 1, 'vik-hotel-arena-blanca_14609041621.jpg', '2020-02-12 18:51:07', '2020-07-03 18:39:11'),
(2, 'productos', 1, 'vik-hotel-arena-blanca_14609041622.jpg', '2020-02-12 18:51:07', '2020-07-03 18:39:11'),
(3, 'productos', 1, 'vik-hotel-arena-blanca_14609041623.jpg', '2020-02-12 18:51:07', '2020-07-03 18:39:11'),
(4, 'productos', 1, 'vik-hotel-arena-blanca_14609041624.jpg', '2020-02-12 18:51:07', '2020-07-03 18:39:11'),
(5, 'productos', 1, 'vik-hotel-arena-blanca_14609041635.jpg', '2020-02-12 18:51:07', '2020-07-03 18:39:11'),
(6, 'productos', 1, 'vik-hotel-arena-blanca_14609041638.jpg', '2020-02-12 18:51:07', '2020-07-03 18:39:11'),
(7, 'productos', 1, 'vik-hotel-arena-blanca_146090416310.jpg', '2020-02-12 18:51:07', '2020-07-03 18:39:11'),
(8, 'productos', 1, 'vik-hotel-arena-blanca_146090416311.jpg', '2020-02-12 18:51:07', '2020-07-03 18:39:11'),
(9, 'productos', 1, 'vik-hotel-arena-blanca_146090416312.jpg', '2020-02-12 18:51:07', '2020-07-03 18:39:11'),
(10, 'productos', 1, 'vik-hotel-arena-blanca_146090416313.jpg', '2020-02-12 18:51:07', '2020-07-03 18:39:11'),
(11, 'productos', 1, 'vik-hotel-arena-blanca_146090416314.jpg', '2020-02-12 18:51:07', '2020-07-03 18:39:11'),
(12, 'productos', 1, 'vik-hotel-arena-blanca_146090416315.jpg', '2020-02-12 18:51:07', '2020-07-03 18:39:11'),
(13, 'productos', 1, 'vik-hotel-arena-blanca_146090416316.jpg', '2020-02-12 18:51:07', '2020-07-03 18:39:11'),
(14, 'productos', 1, 'vik-hotel-arena-blanca_146090416317.jpg', '2020-02-12 18:51:07', '2020-07-03 18:39:11'),
(15, 'productos', 1, 'vik-hotel-arena-blanca_146090416318.jpg', '2020-02-12 18:51:07', '2020-07-03 18:39:11'),
(16, 'productos', 1, 'vik-hotel-arena-blanca_146090416320.jpg', '2020-02-12 18:51:07', '2020-07-03 18:39:11'),
(17, 'productos', 2, 'natura-park-beach-eco-resort-y-spa_14694525191.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(18, 'productos', 2, 'natura-park-beach-eco-resort-y-spa_14694525192.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(19, 'productos', 2, 'natura-park-beach-eco-resort-y-spa_14694525193.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(20, 'productos', 3, 'caribe-club-princess-beach-resort-y-spa_14695362591.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(21, 'productos', 3, 'caribe-club-princess-beach-resort-y-spa_14695362592.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(22, 'productos', 3, 'caribe-club-princess-beach-resort-y-spa_14695362593.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(23, 'productos', 3, 'caribe-club-princess-beach-resort-y-spa_14695362594.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(24, 'productos', 3, 'caribe-club-princess-beach-resort-y-spa_14695362595.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(25, 'productos', 3, 'caribe-club-princess-beach-resort-y-spa_14695362596.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(26, 'productos', 3, 'caribe-club-princess-beach-resort-y-spa_14695362607.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(27, 'productos', 3, 'caribe-club-princess-beach-resort-y-spa_14695362608.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(28, 'productos', 3, 'caribe-club-princess-beach-resort-y-spa_14695362609.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(29, 'productos', 3, 'caribe-club-princess-beach-resort-y-spa_146953626010.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(30, 'productos', 3, 'caribe-club-princess-beach-resort-y-spa_146953626011.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(31, 'productos', 3, 'caribe-club-princess-beach-resort-y-spa_146953626012.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(32, 'productos', 3, 'caribe-club-princess-beach-resort-y-spa_146953626013.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(33, 'productos', 3, 'caribe-club-princess-beach-resort-y-spa_146953626014.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(34, 'productos', 3, 'caribe-club-princess-beach-resort-y-spa_146953626015.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(35, 'productos', 3, 'caribe-club-princess-beach-resort-y-spa_146953626016.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(36, 'productos', 3, 'caribe-club-princess-beach-resort-y-spa_146953626017.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(37, 'productos', 3, 'caribe-club-princess-beach-resort-y-spa_146953626018.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(38, 'productos', 3, 'caribe-club-princess-beach-resort-y-spa_146953626119.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(39, 'productos', 3, 'caribe-club-princess-beach-resort-y-spa_146953626120.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(40, 'productos', 3, 'caribe-club-princess-beach-resort-y-spa_14695366111.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(41, 'productos', 3, 'caribe-club-princess-beach-resort-y-spa_14695366112.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(42, 'productos', 3, 'caribe-club-princess-beach-resort-y-spa_14695366113.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(43, 'productos', 3, 'caribe-club-princess-beach-resort-y-spa_14695366114.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(44, 'productos', 3, 'caribe-club-princess-beach-resort-y-spa_14695366115.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(45, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_14695409561.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(46, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_14695409562.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(47, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_14695409563.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(48, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_14695409564.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(49, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_14695409565.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(50, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_14695409576.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(51, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_14695409577.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(52, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_14695409578.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(53, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_14695409579.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(54, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_146954095710.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(55, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_146954095711.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(56, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_146954095812.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(57, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_14695410191.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(58, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_14695410192.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(59, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_14695411151.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(60, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_14695411152.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(61, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_14695411153.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(62, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_14695414441.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(63, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_14695414442.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(64, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_14695414443.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(65, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_14695414444.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(66, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_14695414445.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(67, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_14695414456.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(68, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_14695416611.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(69, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_14695416612.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(70, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_14695416613.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(71, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_14695416614.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(72, 'productos', 4, 'sirenis-punta-cana-resort-casino-y-aquagames_14695416615.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(73, 'productos', 5, 'riu-lupita_14699142181.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(74, 'productos', 5, 'riu-lupita_14699142182.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(75, 'productos', 5, 'riu-lupita_14699142183.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(76, 'productos', 5, 'riu-lupita_14699142184.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(77, 'productos', 5, 'riu-lupita_14699142185.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(78, 'productos', 5, 'riu-lupita_14699142186.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(79, 'productos', 5, 'riu-lupita_14699164741.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(80, 'productos', 6, 'catalonia-riviera-maya-resort-y-spa_14700557781.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(81, 'productos', 6, 'catalonia-riviera-maya-resort-y-spa_14700557782.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(82, 'productos', 6, 'catalonia-riviera-maya-resort-y-spa_14700557783.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(83, 'productos', 6, 'catalonia-riviera-maya-resort-y-spa_14700557784.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(84, 'productos', 6, 'catalonia-riviera-maya-resort-y-spa_14700557795.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(85, 'productos', 6, 'catalonia-riviera-maya-resort-y-spa_14700557796.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(86, 'productos', 6, 'catalonia-riviera-maya-resort-y-spa_14700557797.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(87, 'productos', 6, 'catalonia-riviera-maya-resort-y-spa_14700557798.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(88, 'productos', 6, 'catalonia-riviera-maya-resort-y-spa_14700557799.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(89, 'productos', 6, 'catalonia-riviera-maya-resort-y-spa_147005577910.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(90, 'productos', 6, 'catalonia-riviera-maya-resort-y-spa_147005577911.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(91, 'productos', 6, 'catalonia-riviera-maya-resort-y-spa_147005577912.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(92, 'productos', 6, 'catalonia-riviera-maya-resort-y-spa_147005577913.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(93, 'productos', 6, 'catalonia-riviera-maya-resort-y-spa_147005577914.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(94, 'productos', 6, 'catalonia-riviera-maya-resort-y-spa_147005577915.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(95, 'productos', 6, 'catalonia-riviera-maya-resort-y-spa_147005578016.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11'),
(96, 'productos', 6, 'catalonia-riviera-maya-resort-y-spa_147005578017.jpg', '2020-02-12 18:51:27', '2020-07-03 18:39:11');

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
  `idEstado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idLegal`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

DROP TABLE IF EXISTS `notas`;
CREATE TABLE IF NOT EXISTS `notas` (
  `idNota` int(11) NOT NULL AUTO_INCREMENT,
  `tabla` varchar(255) NOT NULL,
  `idTabla` int(11) NOT NULL,
  `nota` varchar(255) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaUpdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idNota`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`idNota`, `tabla`, `idTabla`, `nota`, `idUsuario`, `fechaAlta`, `fechaUpdate`) VALUES
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
(18, 'proveedores', 24, 'codigo cliente:41767110\ncontraseña:Fa411145\n\nclaves de nuestra intranet:\ncodigo cliente:41767110\ncontraseña:Jg6Tv41767110qy1a', 1, '2020-01-17 23:05:32', NULL),
(19, 'reservas', 3, '', 1, '2020-06-23 18:43:14', NULL),
(20, 'reservas', 1, '', 1, '2020-06-23 19:07:06', NULL),
(21, 'reservas', 5, 'algo para anotar', 1, '2020-06-23 19:32:23', NULL),
(22, 'reservas', 6, 'algo para anotar', 1, '2020-06-23 19:34:20', NULL),
(23, 'reservas', 13, 'Pvp mostrado al cliente: 926,50€\n probando la nota', 1, '2020-06-25 23:59:34', NULL),
(24, 'reservas', 14, 'Pvp mostrado al cliente: 2113.00\n a ver que tal sale esta reservaq', 1, '2020-07-01 18:33:48', NULL),
(25, 'reservas', 15, 'Pvp mostrado al cliente: 2400.00\n espero que el pago por paypal funcione', 1, '2020-07-02 20:33:26', NULL),
(26, 'reservas', 16, 'Pvp mostrado al cliente: 2400.00\n espero que el pago por paypal funcione', 1, '2020-07-02 20:36:49', NULL),
(27, 'reservas', 17, 'Pvp mostrado al cliente: 2400.00\n espero que el pago por paypal funcione', 1, '2020-07-02 20:37:53', NULL),
(28, 'reservas', 18, 'Pvp mostrado al cliente: 2400.00\n espero que el pago por paypal funcione', 1, '2020-07-02 20:43:10', NULL),
(29, 'reservas', 19, 'Pvp mostrado al cliente: 1939.80\n ', 1, '2020-07-17 00:14:43', NULL),
(30, 'reservas', 20, 'Pvp mostrado al cliente: 480.00\n ', 1, '2020-07-27 22:03:48', NULL),
(31, 'reservas', 21, 'Pvp mostrado al cliente: 480.00\n ', 1, '2020-07-27 22:09:47', NULL),
(32, 'reservas', 22, 'Pvp mostrado al cliente: 2460.00\n ', 1, '2020-07-27 22:24:58', NULL);

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
  `idEstado` int(11) NOT NULL DEFAULT '1',
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
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pasajeros`
--

INSERT INTO `pasajeros` (`idPasajero`, `nombre`, `apellidos`, `NIFoPasaporte`, `nacionalidad`, `fechaNacimiento`, `fechaAlta`, `fechaUpdate`) VALUES
(1, 'Laura', 'Avram', 'D654564789', 'rumana', '1987-02-06', '2020-06-23 18:39:24', NULL),
(2, 'Laura', 'Avram', 'D654564789', 'rumana', '1987-02-06', '2020-06-23 18:41:06', NULL),
(3, 'armando', 'ramirez', 'd65445665', 'dominicado', '1989-03-02', '2020-06-23 18:41:06', NULL),
(4, 'Laura', 'Avram', 'D654564789', 'rumana', '1987-02-06', '2020-06-23 18:43:14', NULL),
(5, 'armando', 'ramirez', 'd65445665', 'dominicado', '1989-03-02', '2020-06-23 18:43:14', NULL),
(6, 'Laura', 'Avram', 'D654564789', 'rumana', '1987-02-06', '2020-06-23 19:07:06', NULL),
(7, 'armando', 'ramirez', 'd65445665', 'dominicado', '1989-03-02', '2020-06-23 19:07:06', NULL),
(8, 'Laura', 'Avram', 'D654564789', 'rumana', '1987-02-06', '2020-06-23 19:13:04', NULL),
(9, 'armando', 'ramirez', 'd65445665', 'dominicado', '1989-03-02', '2020-06-23 19:13:04', NULL),
(10, 'Laura', 'Avram', 'D654564789', 'rumana', '1987-02-06', '2020-06-23 19:30:56', NULL),
(11, 'armando', 'ramirez', 'd65445665', 'dominicado', '1989-03-02', '2020-06-23 19:30:56', NULL),
(12, 'Laura', 'Avram', 'D654564789', 'rumana', '1987-02-06', '2020-06-23 19:31:07', NULL),
(13, 'armando', 'ramirez', 'd65445665', 'dominicado', '1989-03-02', '2020-06-23 19:31:07', NULL),
(14, 'Laura', 'Avram', 'D654564789', 'rumana', '1973-02-01', '2020-06-23 19:32:23', NULL),
(15, 'maria', 'Avram', 'D654564789', 'rumana', '1984-04-01', '2020-06-23 19:32:23', NULL),
(16, 'Laura', 'Avram', 'D654564789', 'rumana', '1973-02-01', '2020-06-23 19:34:19', NULL),
(17, 'maria', 'Avram', 'D654564789', 'rumana', '1984-04-01', '2020-06-23 19:34:20', NULL),
(18, 'angel', 'perez', '987987987', 'dominicado', '1987-09-27', '2020-06-25 23:59:34', NULL),
(19, 'armandito', 'perez', '987987456', 'dominicano', '1990-01-06', '2020-06-25 23:59:34', NULL),
(20, 'adrian', 'gonzalez', 's654897789', 'español', '1990-06-06', '2020-07-01 18:33:48', NULL),
(21, 'maria', 'peralta', 'd78979898', 'española', '1991-04-19', '2020-07-01 18:33:48', NULL),
(22, 'elba', 'meran', 'w98798797', 'dominicana', '1992-02-06', '2020-07-02 20:33:26', NULL),
(23, 'edi', 'meran', 'g98798797', 'dominicana', '1989-04-08', '2020-07-02 20:33:26', NULL),
(24, 'elba', 'meran', 'w98798797', 'dominicana', '1992-02-06', '2020-07-02 20:36:49', NULL),
(25, 'edi', 'meran', 'g98798797', 'dominicana', '1989-04-08', '2020-07-02 20:36:49', NULL),
(26, 'elba', 'meran', 'w98798797', 'dominicana', '1992-02-06', '2020-07-02 20:37:53', NULL),
(27, 'edi', 'meran', 'g98798797', 'dominicana', '1989-04-08', '2020-07-02 20:37:53', NULL),
(28, 'elba', 'meran', 'w98798797', 'dominicana', '1992-02-06', '2020-07-02 20:43:10', NULL),
(29, 'edi', 'meran', 'g98798797', 'dominicana', '1989-04-08', '2020-07-02 20:43:10', NULL),
(30, 'Laura', 'Avram', 'D654564789', 'rumana', '1989-06-17', '2020-07-17 00:14:43', NULL),
(31, 'edwart', 'meran', 'w98798797', 'dominicado', '1985-03-03', '2020-07-17 00:14:43', NULL),
(32, 'Laura', 'Avram', 'D654564789', 'rumana', '1999-04-05', '2020-07-27 22:03:48', NULL),
(33, 'edwart', 'meran', 'w98798797', 'dominicado', '1988-10-06', '2020-07-27 22:03:48', NULL),
(34, 'Laura', 'Avram', 'D654564789', 'rumana', '1999-04-05', '2020-07-27 22:09:47', NULL),
(35, 'edwart', 'meran', 'w98798797', 'dominicado', '1988-10-06', '2020-07-27 22:09:47', NULL),
(36, 'armando', 'perez', 'D654564789', 'dominicado', '1990-04-06', '2020-07-27 22:24:58', NULL),
(37, 'Laura', 'Avram', '987987987', 'rumana', '1970-01-01', '2020-07-27 22:24:58', NULL);

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
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `slug` varchar(100) DEFAULT NULL,
  `itinerario` text,
  `incluye` text,
  `precioProveedor` double NOT NULL DEFAULT '0',
  `comision` double NOT NULL DEFAULT '0',
  `metaDescripcion` text,
  `metaKeyWords` varchar(255) DEFAULT NULL,
  `idCategoria` int(11) NOT NULL DEFAULT '1',
  `idTipo` int(11) NOT NULL DEFAULT '1',
  `idTipoFacturacion` int(11) NOT NULL DEFAULT '1',
  `idEstado` int(11) NOT NULL DEFAULT '1',
  `idProveedor` int(11) NOT NULL DEFAULT '1',
  `stock` int(11) DEFAULT '1',
  `esOferta` tinyint(4) DEFAULT '0',
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaUpdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idProducto`),
  UNIQUE KEY `slug` (`slug`,`idCategoria`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `nombre`, `imagen`, `descripcion`, `slug`, `itinerario`, `incluye`, `precioProveedor`, `comision`, `metaDescripcion`, `metaKeyWords`, `idCategoria`, `idTipo`, `idTipoFacturacion`, `idEstado`, `idProveedor`, `stock`, `esOferta`, `fechaAlta`, `fechaUpdate`) VALUES
(1, 'Vik Hotel Arena Blanca', 'vik-hotel-arena-blanca.png', 'El vik hotel arena blanca está situado en punta cana sobre la inigualable playa de bávaro, a 30 minutos del aeropuerto internacional de punta cana. este hotel en punta cana fue reformado en 2006 para ofrecerle su característica variedad de ambientes cuidados terapéuticos y de belleza en el moderno spa, completos programas de animación y cenas románticas bajo las estrellas, sobre la templada playa caribeña. desconecte desde su llegada al vik...\r\n \r\npara satisfacer todo tipo de paladares, el vik hotel arena blanca dispone de 1 restaurante buffet principal y otros 3 a la carta, con platos de la alta cocina italiana, local e internacional. ¿cuál es la que más le gusta los 5 bares, el snack-bar y la discoteca completan la oferta gastronómica de nuestro servicio de todo incluido, variado y de calidad. todo tipo de gastronomía y bebidas para que se sienta mejor que en casa.', 'vik-hotel-arena-blanca', '1- Salida el %s a las %s hrs en vuelo directo desde Madrid con destino %s.\r\n2- Llegada al aeropuerto internacional %s. Asistencia de nuestro Tour Operador en destino para traslados del aeropuerto al hotel %s.\r\n3- Estancia en el hotel %s - %s - todo incluido.\r\n4- Dï¿½a %s traslado desde el hotel %s al aeropuerto, Vuelo desde %s a las %s hrs con destino Madrid.', '-Vuelo directo con la compaï¿½ï¿½a Evelop desde Madrid con destino Punta Cana.\r\n-Estancia en habitaciï¿½n Standard, 7 noches en rï¿½gimen de todo incluï¿½do en el Hotel VIK Arena Blanca 4* - Punta Cana.\r\n-Traslados de entrada y salida Punta Cana.\r\n-Tasas aï¿½reas incluidas.\r\n-Seguro obligatorio de Viaje', 0, 0, 'El Vik Hotel Arena Blanca está situado en punta cana sobre la inigualable playa de bávaro, a 30 minutos del aeropuerto internacional de Punta Cana', 'El Vik Hotel Arena Blanca está situado en punta cana sobre la inigualable playa de bávaro, a 30 minutos del aeropuerto internacional de Punta Cana', 11, 3, 3, 2, 5, 100, 0, '2020-01-17 21:55:51', '2020-07-10 21:13:56'),
(15, 'producto de prueba', '', 'esto es para rellenar los campos con una vista mas amplia, esto te ayuda a leer todo lo que estas escribiendo de una mejor forma, es perfecto.', 'producto-de-prueba', '', '', 0, 0, '', '', 7, 3, 3, 3, 9, 5, 0, '2020-04-04 12:41:02', '2020-07-10 21:13:56'),
(2, 'Natura Park Beach Eco Resort & Spa', 'natura-park-beach-eco-resort-spa.jpeg', 'En este resort se aprovechan los recursos naturales del área tales como las piedras, el coco, la madera y la caña, creando un ambiente de extraordinaria belleza natural que parece estar soñando...\r\n \r\nviva la experiencia de unas vacaciones en completa armonía con la naturaleza en el lujoso resort de punta cana, natura park. abundantes jardines tropicales que rebosan con una exótica vida de aves se mezclan con lagunas y puentes a lo largo de caminos serpenteantes que llevan a la playa. el hotel está ubicado en la maravillosa playa de , uno de los mejores en el caribe.\r\n \r\nel natura park beach eco resort se beneficia de un diseño arquitectónico original que utiliza los recursos naturales de la zona como la piedra, los cocoteros, la madera y la caña para crear un ambiente tranquilo y confortable. el natura park es un lugar idílico para unas vacaciones relajantes en el caribe. nuestra excelente ubicación del punta cana resort ofrece una completa selección de actividades y de servicios especiales.', 'natura-park-beach-eco-resort-spa', '1- Salida el %s a las %s hrs en vuelo directo desde Madrid con destino %s.\r\n2- Llegada al aeropuerto internacional %s. Asistencia de nuestro Tour Operador en destino para traslados del aeropuerto al hotel %s.\r\n3- Estancia en el hotel %s - %s - todo incluido.\r\n4- Día %s traslado desde el hotel %s al aeropuerto, Vuelo desde %s a las %s hrs con destino Madrid.', '-Vuelo directo con la compañía Evelop desde Madrid con destino Punta Cana.\r\n-Estancia en habitación Standard, 7 noches en régimen de todo incluído en el Hotel Natura Park Eco - Resort & Spa 5* - Punta Cana.\r\n-Traslados de entrada y salida Punta Cana.\r\n-Tasas aéreas incluidas.\r\n-Seguro obligatorio de Viaje.', 0, 0, 'Natura park beach eco resort & spa es un lugar idílico para unas vacaciones relajantes en el caribe.', 'Natura Park Beach Eco Resort & Spa', 10, 3, 3, 2, 21, 100, 0, '2020-01-17 21:55:51', '2020-07-10 21:13:56'),
(3, 'Caribe Club Princess Beach Resort & Spa', 'caribe-club-princess-beach-resort-y-spa.jpg', 'El hotel caribe club princess beach resort & spa, está situado en una de las más bellas playas de la república dominicana, playa bávaro. gracias a su ubicación, te permitirá disfrutar de un paraje donde la belleza de sus paisajes y el encanto de sus aguas cristalinas, ofrece una percepción emocional de placentera y excepcional sensación de relajamiento y tranquilidad. estarás a pie de playa y además, a tan solo 25 min del aeropuerto de punta cana.\r\n \r\nel completo equipamiento y la calidad de los servicios de sus 111 caribe suites y de sus 229 habitaciones superiores, te ofrecen unas vacaciones en punta cana perfectas para disfrutar con amigos o con tu pareja. tendrás servicio wifi gratuito en el lobby. el atractivo de las tiendas y ofertas que tiene la calle caribeña, te incitarán a que pasees por ella y disfrutes de su animado ambiente.\r\n \r\nademás, este hotel de 4 estrellas te invita a disfrutar de las diversas actividades de ocio y entretenimiento tanto diurnas como nocturnas que tiene organizadas; deportes acuáticos en la playa, ejercicios aeróbicos en la piscina, pista de tenis, paseo en bicicleta, un gran casino ubicado en el bávaro princess, transporte gratuito, discoteca \"areito\" . asimismo, en este hotel todo incluido, podrás degustar la gastronomía de la isla en cualquiera de sus 6 restaurantes / snack bares y 4 bares uno de ellos dentro de la piscina.', 'caribe-club-princess-beach-resort-y-spa', '1- Salida el %s a las %s hrs en vuelo directo desde Madrid con destino %s.\r\n2- Llegada al aeropuerto internacional %s. Asistencia de nuestro Tour Operador en destino para traslados del aeropuerto al hotel %s.\r\n3- Estancia en el hotel %s - %s - todo incluido.\r\n4- Día %s traslado desde el hotel %s al aeropuerto, Vuelo desde %s a las %s hrs con destino Madrid.', '-Vuelo directo con la compañía Wamos Air desde Madrid con destino Punta Cana.\r\n-Estancia en habitación Superior, 7 noches en régimen de todo incluído en el Hotel Caribe Club Princess 4* - Punta Cana.\r\n-Traslados de entrada y salida Punta Cana.\r\n-Tasas aéreas incluidas.\r\n-Seguro obligatorio de Viaje.', 0, 0, 'El hotel caribe club princess beach resort & spa, está situado en una de las más bellas playas de la república dominicana, playa bávaro.', 'Caribe Club Princess Beach Resort & Spa', 7, 3, 3, 1, 21, 100, 0, '2020-01-17 21:55:51', '2020-07-09 10:58:27'),
(4, 'Sirenis Punta Cana Resort Casino & Aquagames', 'sirenis-punta-cana-resort-casino-y-aquagames.jpg', 'Este espectacular resort de cinco estrellas, está situado en uno de los más bellos cocotales de punta cana; en un entorno privilegiado, el sirenis punta cana resort casino & aquagames ofrece actividades para todas las edades, ya sea en familia, con su pareja o amigos.\r\npreparado para dar el mejor servicio a sus clientes, dispone de dos piscinas para adultos, con entrada tipo playa, 2 piscinas separadas para los más pequeños, terrazas-solárium.  en el sirenis punta cana resort casino & aquagames  disfrutará de fantásticas  instalaciones, pistas de tenis, 1 pista de pádel,  gimnasio, tenis de mesa, dardos, vóley playa, actividades acuáticas como windsurf, kayak, canoa, catamarán, snorkel y buceo. el gran parque acuático sirenis aquagames de 12.000 m2 está disponible para los clientes del hotel; su gran extensión y sus sorprendentes atracciones, ¡es único en su tipo en toda la región . \r\n \r\nla calidad de la cocina que ofrecen nuestros chefs en los restaurante buffet y en los 7 restaurantes temáticos del hotel es excepcional. cada noche una nueva especialidad, italiana, mexicana, asiática y muchas más. con nuestra fórmula de todo incluido no tendrá que preocuparse de nada más, que de disfrutar de sus vacaciones podrá saborear  su cóctel preferido en los 8 bares del complejo, en la discoteca ó en el casino del hotel.\r\n \r\npunta cana le invita a disfrutar de unas vacaciones de ensueño. el exotismo del caribe, la amabilidad de su gente, playas con aguas transparentes ¡un destino mágico y excepcional le espera', 'sirenis-punta-cana-resort-casino-y-aquagames', '1- Salida el %s a las %s hrs en vuelo directo desde Madrid con destino %s.\r\n2- Llegada al aeropuerto internacional %s. Asistencia de nuestro Tour Operador en destino para traslados del aeropuerto al hotel %s.\r\n3- Estancia en el hotel %s - %s - todo incluido.\r\n4- Día %s traslado desde el hotel %s al aeropuerto, Vuelo desde %s a las %s hrs con destino Madrid.', '-Vuelo directo con la compañía Wamos Air desde Madrid con destino Punta Cana.\r\n-Estancia en habitación Standard, 7 noches en régimen de todo incluído en el Hotel Sirenis Punta Cana Resort Aqualand & Casino 5* - Punta Cana.\r\n-Traslados de entrada y salida Punta Cana.\r\n-Tasas aéreas incluidas.\r\n-Seguro obligatorio de Viaje.', 0, 0, 'Sirenis punta cana resort casino & aquagames ofrece actividades para todas las edades, ya sea en familia, con su pareja o amigos.', 'Sirenis Punta Cana Resort Casino & Aquagames', 10, 3, 3, 1, 21, 100, 0, '2020-01-17 21:55:51', '2020-07-10 21:13:56'),
(5, 'Riu Lupita', 'riu-lupita.jpg', 'Rodeado de unos increã­bles jardines tropicales, el hotel riu lupita de playa del carmen ofrece a sus clientes todas las facilidades para que vivan unas vacaciones inolvidables. este hotel 5 estrellas en playa del carmen cuenta con el programa todo incluido 24 horas para proporcionarte los mejores servicios de riu hotels & resorts.\r\n \r\nel hotel riu lupita cuenta con 300 habitaciones divididas en varios edificios con vistas al jardã­n o a la piscina. ademã¡s, te ofrecen aire acondicionado, minibar con dispensador de bebidas, tv satã©lite y balcã³n o terraza, entre otras facilidades, para que tengas todas las comodidades durante tu estancia con nosotros.\r\n \r\nlas completas instalaciones de este hotel todo incluido en playa del carmen, mã©xico, te aseguran unas vacaciones perfectas. podrã¡s refrescarte en las piscinas del hotel y practicar numerosos deportes como tenis, windsurf, kayak, buceo y voleibol, ademã¡s de disfrutar del gimnasio del hotel riu lupita. si deseas relajarte en cualquier momento del dã­a, te recomendamos visitar el renova spa para que disfrutes de un sinfã­n de tratamientos y salgas totalmente renovado.', 'riu-lupita', '1- Salida el %s a las %s hrs en vuelo directo desde Madrid con destino Cancun - %s.\r\n2- Llegada al aeropuerto internacional de Cancun - %s. Asistencia de nuestro Tour Operador en destino para traslados del aeropuerto al hotel %s.\r\n3- Estancia en el hotel %s - %s - todo incluido.\r\n4- Dï¿½a %s traslado desde el hotel %s al aeropuerto, Vuelo desde Cancun - %s a las %s hrs con destino Madrid.', '-Vuelo directo con la compaï¿½ï¿½a Evelop desde Madrid con destino Cancun.\r\n-Estancia en habitaciï¿½n Standard, 7 noches en rï¿½gimen de todo incluï¿½do en el Hotel Riu Lupita 5* - Riviera Maya.\r\n-Traslados de entrada y salida Riviera Maya.\r\n-Tasas aï¿½reas incluidas.\r\n-Seguro obligatorio de Viaje.', 0, 0, 'Rodeado de unos increã­bles jardines tropicales, el hotel riu lupita de playa del carmen ofrece a sus clientes todas las facilidades para que vivan unas vacaciones inolvidables.', 'RIU LUPITA', 4, 3, 3, 2, 21, 100, 0, '2020-01-17 21:55:51', '2020-07-10 21:13:56'),
(7, 'Barceló Maya Beach', 'barcelo-maya-beach.jpg', 'El hotel barceló maya beach se encuentra dentro de un increíble resort todo incluido situado en una de las playas más bellas del caribe mexicano que se extiende a lo largo de 2 km de arena blanca, agua cristalina y un arrecife de coral.\r\n \r\nel hotel ha sido renovado para adaptarse a las expectativas de nuestros clientes. la nueva casa club con su impactante diseño, alberga los servicios de recepción, lounge club premium, lobby bar beach con terraza para fumadores, restaurante buffet beach, restaurante de especialidad mexicana a la carta méxico lindo, tiendas de regalos y salones para reuniones.\r\n \r\ndele a su estancia un toque de lujo y déjese consentir con los beneficios exclusivos que le brinda el concepto club premium, disfrute de las totalmente nuevas habitaciones junior suite frente al mar club premium y suite frente al mar club premium.\r\n \r\nel hotel le ofrece 3 restaurantes entre los que encontrará el buffet beach con un novedoso diseño inspirado en la cultura maya, el espectacular méxico lindo con especialidades de la cocina mexicana y rancho grande restaurante de playa con vista al mar caribe; además de 3 bares repartidos estratégicamente por el hotel. el programa barceló todo incluido le ofrece aperitivos, comidas y bebidas disponibles las 24 horas del día.', 'barcelo-maya-beach', '1- Salida el %s a las %s hrs en vuelo directo desde Madrid con destino Cancun - %s.\r\n2- Llegada al aeropuerto internacional de Cancun - %s. Asistencia de nuestro Tour Operador en destino para traslados del aeropuerto al hotel %s.\r\n3- Estancia en el hotel %s - %s - todo incluido.\r\n4- Día %s traslado desde el hotel %s al aeropuerto, Vuelo desde Cancun - %s a las %s hrs con destino Madrid.', '- Vuelo directo con la compañía Evelop desde Madrid con destino Cancun.\r\n-Estancia en habitación Standard, 7 noches en régimen de todo incluído en el Hotel Barceló Maya Beach Resort 5* - Riviera Maya.\r\n-Traslados de entrada y salida Riviera Maya.\r\n-Tasas aéreas incluidas.\r\n-Seguro obligatorio de Viaje.', 0, 0, 'El hotel barceló maya beach se encuentra dentro de un increíble resort todo incluido situado en una de las playas más bellas del caribe mexicano', 'Barceló Maya Beach', 10, 3, 3, 1, 21, 100, 0, '2020-01-17 21:55:51', '2020-07-10 21:13:56'),
(9, 'Catalonia Riviera Maya Resort & Spa', 'catalonia-riviera-maya-resort-y-spa.jpg', 'Catalonia riviera maya resort & spa está situado en la exclusiva zona de puerto aventuras, en las maravillosas costas del caribe mexicano. en pleno corazón de la riviera maya, puerto aventuras es de fácil acceso por carretera, a tan sólo 24 km de playa del carmen y a 78 km al sur del aeropuerto internacional de cancún, en el estado de quintana roo, méxico.\r\n \r\nla riviera maya es un pequeño paraíso para disfrutar a lo grande. sus paisajes hipnotizan a todo aquel que los mira y sus playas enamoran a quienes tienen el placer de visitarlas. el catalonia riviera maya te ofrece unas vacaciones de ensueño. su distribución permite que las habitaciones ofrezcan maravillosas vistas del mar caribe y de los fantásticos jardines que rodean al hotel.\r\n \r\nnuestras habitaciones se caracterizan por su amplitud, su hermosa y cálida decoración y por sus terrazas o balcones, indispensables para poder experimentar la suave brisa del caribe.\r\n \r\nla oferta gastronómica es amplia para satisfacer todos los gustos, por eso te ofrecemos restaurantes y bares en donde podrás degustar de deliciosos platillos, refrescantes bebidas, así como postres y tus snacks favoritos. nuestras instalaciones y actividades te ofrecen constante diversión y entretenimiento para toda la familia', 'catalonia-riviera-maya-resort-y-spa', '1- Salida el %s a las %s hrs en vuelo directo desde Madrid con destino Cancun - %s.\r\n2- Llegada al aeropuerto internacional de Cancun - %s. Asistencia de nuestro Tour Operador en destino para traslados del aeropuerto al hotel %s.\r\n3- Estancia en el hotel %s - %s - todo incluido.\r\n4- Día %s traslado desde el hotel %s al aeropuerto, Vuelo desde Cancun - %s a las %s hrs con destino Madrid.', '-Vuelo directo con la compañía Evelop desde Madrid con destino Cancun.\r\n-Estancia en habitación Standard, 7 noches en régimen de todo incluído en el Hotel Catalonia Riviera Maya 5* - Riviera Maya.\r\n-Traslados de entrada y salida Riviera Maya.\r\n-Tasas aéreas incluidas.\r\n-Seguro obligatorio de Viaje.', 0, 0, 'Catalonia riviera maya resort & spa está situado en la exclusiva zona de puerto aventuras, en las maravillosas costas del caribe mexicano.', 'Catalonia Riviera Maya Resort & Spa', 10, 3, 3, 2, 21, 100, 0, '2020-02-16 21:52:22', '2020-07-10 21:13:56'),
(16, 'segunda prueba del producto', 'segunda-prueba-del-producto.jpeg', 'hemos cambiado la imagen', 'segunda-prueba-del-producto', '', '', 0, 0, '', '', 6, 3, 3, 2, 20, 0, 1, '2020-04-04 17:58:14', '2020-07-10 21:13:56'),
(25, 'nuevo tour', '', 'esto es un producto de prueba, editado', '', '', '', 0, 0, '', '', 1, 3, 3, 1, 1, 0, 0, '2020-05-30 15:22:03', '2020-07-10 21:13:56'),
(27, 'otro pruducto de prueba & pruebas', 'otro-pruducto-de-prueba.png', 'estamos viendo si la calefactorización con las imágenes ha dado resultado', 'otro-pruducto-de-prueba', '', '', 0, 0, '', '', 1, 3, 3, 1, 1, 0, 0, '2020-06-01 17:44:50', '2020-07-10 21:13:56'),
(28, 'ultimo producto hecho', 'ultimo-producto-hecho.jpeg', 'este producto se crea para ver si no hay ningún problema con la inserción de los datos', 'ultimo-producto-hecho', '', '', 0, 0, '', '', 17, 4, 3, 2, 3, 0, 0, '2020-06-02 21:17:55', '2020-07-10 21:13:56'),
(29, 'ver si el slugfy sigue funcionando', '', '', 'ver-si-el-slugfy-sigue-funcionando', '', '', 0, 0, '', '', 1, 2, 3, 2, 1, 0, 0, '2020-06-07 08:14:38', '2020-07-10 21:13:56'),
(30, 'Asistencia', '', 'Amplia la cobertura de salud en 20000€ adicional', 'asistencia', '', '', 20, 5, '', '', 14, 7, 3, 2, 13, 0, 0, '2020-06-25 23:13:06', '2020-07-10 21:13:56'),
(31, 'Cancelación', '', 'Cancela el viaje por cualquier motivo y sin dar excusas,', 'cancelacion', '', '', 50, 5, '', '', 14, 7, 3, 2, 13, 0, 0, '2020-06-25 23:16:02', '2020-07-10 21:13:56');

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
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto_fecha_ref`
--

INSERT INTO `producto_fecha_ref` (`idProductoFechaRef`, `idProducto`, `idFechaSalida`, `idFechaVuelta`, `precioProveedor`, `comision`) VALUES
(1, 5, 1, 2, 800, 10),
(2, 3, 7, 8, 850, 9),
(19, 30, 11, 12, 20, 5),
(4, 2, 7, 8, 1000, 10),
(5, 3, 9, 10, 100, 10),
(6, 6, 1, 2, 865, 10),
(7, 4, 9, 10, 850, 9),
(8, 2, 7, 8, 1987, 10),
(9, 1, 9, 10, 123, 10),
(10, 3, 5, 6, 965, 10),
(11, 8, 5, NULL, 720, 10),
(12, 9, 7, 8, 1003, 10),
(13, 10, 9, NULL, 103, 10),
(14, 11, 1, NULL, 809, 10),
(15, 3, 3, 4, 850, 9),
(16, 10, 7, 8, 1000, 10),
(17, 8, 9, 10, 120, 10),
(18, 6, 5, 6, 708, 10),
(20, 30, 13, 14, 20, 5),
(21, 30, 15, 16, 20, 5),
(22, 30, 17, 18, 20, 5),
(23, 30, 19, 20, 20, 5),
(24, 30, 21, 22, 20, 5),
(25, 30, 23, 24, 20, 5),
(26, 30, 25, 26, 20, 5),
(27, 31, 27, 28, 50, 5),
(28, 30, 29, 30, 20, 5),
(29, 30, 31, 32, 20, 5),
(30, 30, 33, 34, 20, 5),
(31, 30, 35, 36, 20, 5),
(32, 30, 37, 38, 20, 5),
(33, 31, 39, 40, 50, 5),
(34, 31, 41, 42, 50, 5),
(35, 31, 43, 44, 50, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE IF NOT EXISTS `proveedores` (
  `idProveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `NIF` varchar(20) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `idEstado` int(11) NOT NULL DEFAULT '1',
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaUpdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idProveedor`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idProveedor`, `nombre`, `NIF`, `direccion`, `idEstado`, `fechaAlta`, `fechaUpdate`) VALUES
(1, 'Caribetour.es', 'e654054894', '', 1, '2020-01-17 23:05:32', NULL),
(2, 'Greco Tour', 'ES-B-82124546', 'calle ruiz 22, 28004 Madrid', 1, '2020-01-17 23:05:32', NULL),
(3, 'Pro Excursions', '', '4 Avenida Cayuco Dominicus, République Dominicaine', 1, '2020-01-17 23:05:32', NULL),
(4, 'OUT BACK ADVENTURES', '', 'Km 2.1 Carretera Veron-Bavaro Bavaro, Republica Dominicana', 1, '2020-01-17 23:05:32', NULL),
(5, 'monster truck safari', '', '', 1, '2020-01-17 23:05:32', NULL),
(6, 'our amazing tour', '456654', '', 1, '2020-01-17 23:05:32', NULL),
(7, 'Punta Cana Tours', '654654', '', 1, '2020-01-17 23:05:32', NULL),
(8, 'Spin Off Travel', '', 'C/Fundadores de la Cooperativa,Nº66 - L.10. San Miguel de Abona, 38639, Tenerife.', 1, '2020-01-17 23:05:32', NULL),
(9, 'Zafirotour', '456789654g', '', 1, '2020-01-17 23:05:32', NULL),
(10, 'Servi Vuelo', '', 'Calle del Dr. Esquerdo, 10, 28028 Madrid', 1, '2020-01-17 23:05:32', NULL),
(11, 'Aerticket', '', 'C/ Nuredduna, 10 07006 Palma Islas Baleares', 1, '2020-01-17 23:05:32', NULL),
(12, 'Travelplan', '', 'CTRA. ARENAL - LLUCMAJOR KM, 21.5 - 07620 LLUCMAJOR - Baleares', 1, '2020-01-17 23:05:32', NULL),
(13, 'Intermundial Seguros', 'B-81577231', 'c/ Irún 7  28008 Madrid', 1, '2020-01-17 23:05:32', NULL),
(14, 'Avis Alquile Un Coche Sa', 'A28152767', 'Avd Manoteras 32  28050 Madrid', 1, '2020-01-17 23:05:32', NULL),
(15, 'Aon Gil Y Carvajal S.a.u Seguros', 'A-28109247', '', 1, '2020-01-17 23:05:32', NULL),
(16, 'Nextel', '', 'C/ Francesc Carbonell, 21-23, entlo 4ª 08034 Barcelona', 1, '2020-01-17 23:05:32', NULL),
(17, 'Jumbobeds', '', 'Gran Vía Asima 4A - 2° Polígono de Son Castelló 07009 Palma de Mallorca Illes Balears (Spain)', 1, '2020-01-17 23:05:32', NULL),
(18, 'Daniel Ruiz Latorre', '', '', 1, '2020-01-17 23:05:32', NULL),
(19, 'Grupo Vdt Dominicana Tours', '', 'C/ Marie Curie 5 Edificio Alpha 3ª planta, Rivas VaciaMadrid 28521 Madrid', 1, '2020-01-17 23:05:32', NULL),
(20, 'Grupo Europa', '', 'C/ Occident, 52 08904 - L\'Hospitalet de Llobregat Barcelona ', 1, '2020-01-17 23:05:32', NULL),
(21, 'Travelsens S.l.', 'B-57727901', 'C/ Albasanz, 16 - 4ï¿½ Pta Of. B1 28037 Madrid', 1, '2020-01-17 23:05:32', NULL),
(22, 'Gowaii', '', '', 1, '2020-01-17 23:05:32', NULL),
(23, 'Keytel Hoteles', '', 'C/Mallorca, 351 08013 Barcelona', 1, '2020-01-17 23:05:32', NULL),
(24, 'Flexible Autos', '', 'Plaza Gala Placidia, 8, 1º-2ª 08006 - Barcelona', 2, '2020-01-17 23:05:32', '2020-07-04 10:48:51'),
(25, 'probando un proveedor', 'aaasdf6549', 'no tiene dirección de nada', 1, '2020-06-06 15:18:35', '2020-06-06 20:18:03'),
(26, '', '', '', 0, '2020-06-06 21:04:12', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puertos`
--

DROP TABLE IF EXISTS `puertos`;
CREATE TABLE IF NOT EXISTS `puertos` (
  `idPuerto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `codigo` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idTipo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idPuerto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `puertos`
--

INSERT INTO `puertos` (`idPuerto`, `nombre`, `codigo`, `idTipo`) VALUES
(1, '-', '-', 1),
(2, 'Madrid-Barajas', 'MAD', 18),
(3, 'Las Americas', 'SDQ', 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

DROP TABLE IF EXISTS `reservas`;
CREATE TABLE IF NOT EXISTS `reservas` (
  `idReserva` int(11) NOT NULL AUTO_INCREMENT,
  `idEstado` int(11) NOT NULL DEFAULT '1',
  `idTipoPago` int(11) NOT NULL DEFAULT '12' COMMENT 'se refiere a la forma de pago',
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idReserva`),
  KEY `idEstado` (`idEstado`),
  KEY `idTipo` (`idTipoPago`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`idReserva`, `idEstado`, `idTipoPago`, `fechaAlta`) VALUES
(1, 6, 926, '2020-06-23 19:07:06'),
(2, 6, 926, '2020-06-23 19:13:04'),
(3, 6, 12, '2020-06-23 19:30:56'),
(4, 6, 12, '2020-06-23 19:31:07'),
(5, 6, 12, '2020-06-23 19:32:23'),
(6, 6, 12, '2020-06-23 19:34:19'),
(7, 7, 0, '2020-06-25 23:31:14'),
(8, 7, 0, '2020-06-25 23:32:24'),
(9, 7, 0, '2020-06-25 23:40:49'),
(10, 7, 0, '2020-06-25 23:41:03'),
(11, 7, 0, '2020-06-25 23:56:53'),
(12, 7, 0, '2020-06-25 23:57:06'),
(13, 7, 12, '2020-06-25 23:59:34'),
(14, 7, 13, '2020-07-01 18:33:48'),
(15, 7, 14, '2020-07-02 20:33:26'),
(16, 7, 14, '2020-07-02 20:36:49'),
(17, 7, 14, '2020-07-02 20:37:53'),
(18, 7, 14, '2020-07-02 20:43:10'),
(19, 7, 14, '2020-07-17 00:14:43'),
(20, 7, 14, '2020-07-27 22:03:48'),
(21, 7, 14, '2020-07-27 22:09:47'),
(22, 7, 14, '2020-07-27 22:24:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_cliente_pasajero_ref`
--

DROP TABLE IF EXISTS `reserva_cliente_pasajero_ref`;
CREATE TABLE IF NOT EXISTS `reserva_cliente_pasajero_ref` (
  `idCliente` int(11) NOT NULL,
  `idPasajero` int(11) NOT NULL,
  `idReserva` int(11) NOT NULL,
  PRIMARY KEY (`idCliente`,`idPasajero`,`idReserva`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reserva_cliente_pasajero_ref`
--

INSERT INTO `reserva_cliente_pasajero_ref` (`idCliente`, `idPasajero`, `idReserva`) VALUES
(16, 2, 2),
(16, 3, 2),
(17, 4, 3),
(17, 5, 3),
(18, 6, 1),
(18, 7, 1),
(19, 8, 2),
(19, 9, 2),
(20, 10, 3),
(20, 11, 3),
(21, 12, 4),
(21, 13, 4),
(22, 14, 5),
(22, 15, 5),
(23, 16, 6),
(23, 17, 6),
(24, 18, 13),
(24, 19, 13),
(25, 20, 14),
(25, 21, 14),
(26, 22, 15),
(26, 23, 15),
(27, 24, 16),
(27, 25, 16),
(28, 26, 17),
(28, 27, 17),
(29, 28, 18),
(29, 29, 18),
(30, 30, 19),
(30, 31, 19),
(31, 32, 20),
(31, 33, 20),
(32, 34, 21),
(32, 35, 21),
(33, 36, 22),
(33, 37, 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_detalles`
--

DROP TABLE IF EXISTS `reserva_detalles`;
CREATE TABLE IF NOT EXISTS `reserva_detalles` (
  `idReserva` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `idProductoFechaRef` int(11) DEFAULT NULL,
  `idTipoFacturacion` int(11) NOT NULL COMMENT 'hace referencia el tipo de cobro que se le va a realizar al cliente, si es por reserva, por pasajero, etc',
  `precioProveedor` double NOT NULL DEFAULT '0',
  `comision` double NOT NULL DEFAULT '0',
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaUpdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idReserva`,`idProducto`),
  KEY `idProductoFechaRef` (`idProductoFechaRef`),
  KEY `idTipoCobro` (`idTipoFacturacion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reserva_detalles`
--

INSERT INTO `reserva_detalles` (`idReserva`, `idProducto`, `idProductoFechaRef`, `idTipoFacturacion`, `precioProveedor`, `comision`, `fechaAlta`, `fechaUpdate`) VALUES
(13, 3, 2, 1, 850, 9, '2020-06-25 23:59:34', NULL),
(13, 30, 26, 21, 20, 5, '2020-06-25 23:59:34', NULL),
(14, 3, 2, 21, 850, 9, '2020-07-01 18:33:48', NULL),
(14, 31, 27, 21, 50, 5, '2020-07-01 18:33:48', NULL),
(15, 10, 16, 21, 1000, 10, '2020-07-02 20:33:26', NULL),
(15, 30, 28, 21, 20, 5, '2020-07-02 20:33:26', NULL),
(16, 10, 16, 21, 1000, 10, '2020-07-02 20:36:49', NULL),
(16, 30, 29, 21, 20, 5, '2020-07-02 20:36:49', NULL),
(17, 10, 16, 21, 1000, 10, '2020-07-02 20:37:53', NULL),
(17, 30, 30, 21, 20, 5, '2020-07-02 20:37:53', NULL),
(18, 10, 16, 21, 1000, 10, '2020-07-02 20:43:10', NULL),
(18, 30, 31, 21, 20, 5, '2020-07-02 20:43:10', NULL),
(19, 11, 14, 3, 809, 10, '2020-07-17 00:14:43', NULL),
(19, 30, 32, 3, 20, 5, '2020-07-17 00:14:43', NULL),
(20, 3, 5, 3, 100, 10, '2020-07-27 22:03:48', NULL),
(20, 31, 33, 3, 50, 5, '2020-07-27 22:03:48', NULL),
(21, 3, 5, 3, 100, 10, '2020-07-27 22:09:47', NULL),
(21, 31, 34, 3, 50, 5, '2020-07-27 22:09:47', NULL),
(22, 10, 16, 3, 1000, 10, '2020-07-27 22:24:58', NULL),
(22, 31, 35, 3, 50, 5, '2020-07-27 22:24:58', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

DROP TABLE IF EXISTS `tipos`;
CREATE TABLE IF NOT EXISTS `tipos` (
  `idTipo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`idTipo`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`idTipo`, `nombre`) VALUES
(1, '-'),
(2, 'Otros'),
(3, 'Tour'),
(4, 'Excursion'),
(5, 'Traslados'),
(6, 'Circuitos'),
(7, 'Seguro'),
(8, 'Telefono'),
(9, 'Email'),
(10, 'Web'),
(11, 'Fax'),
(12, 'Tarjeta'),
(13, 'Transferencia'),
(14, 'PayPal'),
(15, 'Efectivo'),
(16, 'Cheque'),
(17, 'Terrestre'),
(18, 'Aereo'),
(19, 'Maritimo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_facturacion`
--

DROP TABLE IF EXISTS `tipo_facturacion`;
CREATE TABLE IF NOT EXISTS `tipo_facturacion` (
  `idTipoFacturacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`idTipoFacturacion`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COMMENT='indica el tipo de facturación de un producto';

--
-- Volcado de datos para la tabla `tipo_facturacion`
--

INSERT INTO `tipo_facturacion` (`idTipoFacturacion`, `nombre`) VALUES
(1, '-'),
(2, 'Por Reserva'),
(3, 'Por Persona'),
(4, 'Por Trayecto'),
(5, 'Por Noche'),
(6, 'Por Noche y Persona'),
(7, 'Por Día'),
(8, 'Por Día y Persona');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_tabla_ref`
--

DROP TABLE IF EXISTS `tipo_tabla_ref`;
CREATE TABLE IF NOT EXISTS `tipo_tabla_ref` (
  `idTipo` int(11) NOT NULL,
  `tabla` varchar(255) NOT NULL,
  PRIMARY KEY (`idTipo`,`tabla`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_tabla_ref`
--

INSERT INTO `tipo_tabla_ref` (`idTipo`, `tabla`) VALUES
(1, 'contactos'),
(1, 'pagos'),
(1, 'productos'),
(1, 'puertos'),
(2, 'contactos'),
(2, 'pagos'),
(2, 'productos'),
(2, 'puertos'),
(3, 'productos'),
(4, 'productos'),
(5, 'productos'),
(6, 'productos'),
(7, 'productos'),
(8, 'contactos'),
(9, 'contactos'),
(10, 'contactos'),
(11, 'contactos'),
(12, 'pagos'),
(13, 'pagos'),
(14, 'pagos'),
(15, 'pagos'),
(16, 'pagos'),
(17, 'puertos'),
(18, 'puertos'),
(19, 'puertos');

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
  `idEstado` int(11) NOT NULL DEFAULT '1',
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaUpdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idUsuario`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `apellidos`, `DNI`, `email`, `password`, `telefono`, `perfil`, `imagen`, `idEstado`, `fechaAlta`, `fechaUpdate`) VALUES
(1, 'sistema', '-', '-', '-', '-', '-', '-', '-', 1, '2020-02-11 22:21:15', '2020-02-11 22:22:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permiso_ref`
--

DROP TABLE IF EXISTS `usuario_permiso_ref`;
CREATE TABLE IF NOT EXISTS `usuario_permiso_ref` (
  `idUsuario` int(11) NOT NULL,
  `idPermiso` int(11) NOT NULL,
  PRIMARY KEY (`idUsuario`,`idPermiso`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_producto_fecha_ref`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `v_producto_fecha_ref`;
CREATE TABLE IF NOT EXISTS `v_producto_fecha_ref` (
`idProductoFechaRef` int(11)
,`idProducto` int(11)
,`idFechaSalida` int(11)
,`precioProveedor` double
,`comision` int(11)
,`producto` varchar(100)
,`idCategoria` int(11)
,`categoria` varchar(50)
,`idCategoriaPadre` int(11)
,`catPadre` varchar(50)
,`fsalida` datetime
,`terminalSalida` varchar(10)
,`terminalDestino` varchar(10)
,`tasasSalida` double
,`tasasDestino` double
,`idFechaVuelta` int(11)
,`fvuelta` datetime
,`terminalSalidaV` varchar(10)
,`terminalDestinoV` varchar(10)
,`tasasSalidaV` double
,`tasasDestinoV` double
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_proveedores`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `v_proveedores`;
CREATE TABLE IF NOT EXISTS `v_proveedores` (
`idProveedor` int(11)
,`Nombre` varchar(100)
,`NIF` varchar(20)
,`Telefono` text
,`Email` text
,`Web` text
);

-- --------------------------------------------------------

--
-- Estructura para la vista `v_producto_fecha_ref`
--
DROP TABLE IF EXISTS `v_producto_fecha_ref`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_producto_fecha_ref`  AS  select `pfr`.`idProductoFechaRef` AS `idProductoFechaRef`,`pfr`.`idProducto` AS `idProducto`,`pfr`.`idFechaSalida` AS `idFechaSalida`,`pfr`.`precioProveedor` AS `precioProveedor`,`pfr`.`comision` AS `comision`,`p`.`nombre` AS `producto`,`cat`.`idCategoria` AS `idCategoria`,`cat`.`nombre` AS `categoria`,`catpadre`.`idCategoria` AS `idCategoriaPadre`,`catpadre`.`nombre` AS `catPadre`,`fs`.`fecha` AS `fsalida`,`fs`.`terminalSalida` AS `terminalSalida`,`fs`.`terminalDestino` AS `terminalDestino`,`fs`.`tasasSalida` AS `tasasSalida`,`fs`.`tasasDestino` AS `tasasDestino`,`pfr`.`idFechaVuelta` AS `idFechaVuelta`,`fv`.`fecha` AS `fvuelta`,`fv`.`terminalSalida` AS `terminalSalidaV`,`fv`.`terminalDestino` AS `terminalDestinoV`,`fv`.`tasasSalida` AS `tasasSalidaV`,`fv`.`tasasDestino` AS `tasasDestinoV` from (((((`producto_fecha_ref` `pfr` join `productos` `p` on((`pfr`.`idProducto` = `p`.`idProducto`))) join `categorias` `cat` on((`p`.`idCategoria` = `cat`.`idCategoria`))) join `categorias` `catpadre` on((`cat`.`idCategoriaPadre` = `catpadre`.`idCategoria`))) join `fechas` `fs` on((`pfr`.`idFechaSalida` = `fs`.`idFecha`))) left join `fechas` `fv` on((`pfr`.`idFechaVuelta` = `fv`.`idFecha`))) where ((`p`.`idEstado` = 1) and (`cat`.`idEstado` = 1) and (`catpadre`.`idEstado` = 1)) order by `fs`.`fecha` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_proveedores`
--
DROP TABLE IF EXISTS `v_proveedores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_proveedores`  AS  select `p`.`idProveedor` AS `idProveedor`,`p`.`nombre` AS `Nombre`,`p`.`NIF` AS `NIF`,group_concat((case when (`t`.`nombre` = 'Telefono') then `c`.`contacto` end) separator ', ') AS `Telefono`,group_concat((case when (`t`.`nombre` = 'Email') then `c`.`contacto` end) separator ', ') AS `Email`,group_concat((case when (`t`.`nombre` = 'Web') then `c`.`contacto` end) separator ', ') AS `Web` from ((`proveedores` `p` join `contactos` `c` on(((`c`.`tabla` = 'proveedores') and (`c`.`idTabla` = `p`.`idProveedor`)))) join `tipos` `t` on((`c`.`idTipo` = `t`.`idTipo`))) group by `p`.`idProveedor` order by `p`.`idProveedor` ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
