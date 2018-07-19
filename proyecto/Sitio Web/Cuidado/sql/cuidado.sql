-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-07-2018 a las 20:16:27
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cuidado`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idC` int(11) NOT NULL,
  `nombreC` varchar(120) DEFAULT NULL COMMENT 'Nombre de la categoria.',
  `user` int(10) DEFAULT '1' COMMENT 'FK a Usuarios.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idC`, `nombreC`, `user`) VALUES
(1, 'Farmacia', 1),
(2, 'Hospital', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centros`
--

CREATE TABLE `centros` (
  `idCentro` int(11) NOT NULL,
  `idCat` int(11) DEFAULT '1' COMMENT 'FK a Usuarios.',
  `user` int(10) DEFAULT '1' COMMENT 'FK a Usuarios.',
  `nombre` varchar(250) CHARACTER SET utf8 NOT NULL COMMENT 'Nombre del Hostipal/Farmacia.',
  `direccion` varchar(250) CHARACTER SET utf8 NOT NULL COMMENT 'Calles del lugar.',
  `Latitud` double NOT NULL,
  `Longitud` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `centros`
--

INSERT INTO `centros` (`idCentro`, `idCat`, `user`, `nombre`, `direccion`, `Latitud`, `Longitud`) VALUES
(1, 1, 1, 'Farmacia Cuxibamba', 'Calle Mercadillo y Sucre', -4.001464, -79.202768),
(2, 1, 1, 'Farmacia Cruz Azul', 'Mercadillo Y Bernardo Valdivieso', -4.001303, -79.200971),
(3, 1, 1, 'Farmacia Sana Sana', 'Calle Azuay y Bernardo Valdivieso', -4.000195, -79.200698),
(4, 1, 1, 'Farmacia Nacional', 'Calle Bolivar y Colón', -3.995226, -79.202254),
(5, 1, 1, 'Fybeca Consorcio Médico', ' Calle Azuay y Sucre', -4.000376, -79.203075),
(6, 1, 1, 'FARMACIAS MIA', 'Av. Manuel Aguirre y, Colón', -3.995321, -79.205481),
(7, 1, 1, 'Farmacias Económicas', 'Avenida Manuel Agustín Aguirre', -3.996477, -79.205438),
(8, 1, 1, 'Farmacia Ecuatoriana', '10 de Agosto', -3.997162, -79.203159),
(9, 1, 1, 'Pharmacy''s', '18 DE Noviembre y Chile Centro Comercial Don Daniel', -4.009823, -79.20275),
(10, 1, 1, 'Farmacia Santa Fe', 'Avenida Universitaria', -3.992264, -79.205435),
(11, 2, 1, 'Hospital San Jose', 'Calle Juan de Salinas', -3.991786, -79.203841),
(12, 2, 1, 'Hospital Isidro Ayora', 'Calle Juan José Samaniego', -3.993532, -79.206211),
(13, 2, 1, 'Hospital UTPL', 'Salvador Bustamante Celi', -3.972699, -79.201303),
(14, 2, 1, 'Hospital Clínica San Agustin', 'Calle Azuay', -4.000308, -79.203255),
(15, 2, 1, 'Clinica San Francisco', 'Leopoldo Palacios y Juan Jose PeÃ±a', -4.002988, -79.198449),
(16, 2, 1, 'Clinica San Pablo', 'Avenida Pio Jaramillo Alvarado', -4.026354, -79.203235),
(17, 2, 1, 'SCS Heroes del Cenepa', 'Avenida Heroes del Cenepa y Jose Robles Carrión', -4.027031, -79.206047),
(18, 2, 1, 'Clinica MEDILAB', '18 de Noviembre y Vicente Rocafuerte', -3.998367, -79.203373),
(19, 2, 1, 'SOLCA Núcleo de Loja', 'Salvador Bustamante Celi', -3.97341, -79.201544),
(20, 2, 1, 'ESS Manuel Ygnacio Monteros', 'Calle Ibarra', -3.984064, -79.203055);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paradas`
--

CREATE TABLE `paradas` (
  `idParada` int(11) NOT NULL,
  `idRuta` int(11) NOT NULL DEFAULT '1' COMMENT 'FK a Rutas.',
  `latitud` double NOT NULL,
  `longitud` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paradas`
--

INSERT INTO `paradas` (`idParada`, `idRuta`, `latitud`, `longitud`) VALUES
(1, 1, -3.938683, -79.223895),
(2, 1, -3.939154, -79.224861),
(3, 1, -3.938426, -79.225826),
(4, 1, -3.948868, -79.22222),
(5, 1, -3.955728, -79.22048),
(6, 1, -3.959311, -79.216765),
(7, 1, -3.962543, -79.214643),
(8, 1, -3.967596, -79.210946),
(9, 1, -3.970122, -79.208113),
(10, 1, -3.973478, -79.205773),
(11, 1, -3.977667, -79.204716),
(12, 1, -3.984035, -79.206111),
(13, 1, -3.986704, -79.205652),
(14, 1, -3.99242, -79.205826),
(15, 1, -3.995164, -79.2055),
(16, 1, -3.997719, -79.205221),
(17, 1, -3.999371, -79.205029),
(18, 1, -4.001377, -79.204862),
(19, 1, -4.003603, -79.20459),
(20, 1, -4.005674, -79.204322),
(21, 1, -4.010163, -79.203362),
(22, 1, -4.012705, -79.204558),
(23, 1, -4.016884, -79.204001),
(24, 1, -4.018869, -79.203768),
(25, 1, -4.020775, -79.203594),
(26, 1, -4.024683, -79.203303),
(27, 1, -4.026649, -79.203143),
(28, 1, -4.029329, -79.202835),
(29, 1, -4.032497, -79.202503),
(30, 2, -3.944884, -79.229968),
(31, 2, -3.942294, -79.228295),
(32, 2, -3.941866, -79.227243),
(33, 2, -3.945741, -79.224046),
(34, 2, -3.949572, -79.222995),
(35, 2, -3.955416, -79.221578),
(36, 2, -3.958156, -79.220398),
(37, 2, -3.961988, -79.21778),
(38, 2, -3.965584, -79.214218),
(39, 2, -3.970208, -79.207888),
(40, 2, -3.973462, -79.205743),
(41, 2, -3.977636, -79.204734),
(42, 2, -3.98692, -79.205555),
(43, 2, -3.990356, -79.205491),
(44, 2, -3.992186, -79.205813),
(45, 2, -3.99544, -79.205952),
(46, 2, -3.998158, -79.206607),
(47, 2, -4.001208, -79.206242),
(48, 2, -4.001429, -79.207176),
(49, 2, -4.007707, -79.207393),
(50, 2, -4.010265, -79.207309),
(51, 2, -4.012936, -79.205927),
(52, 2, -4.017483, -79.209022),
(53, 2, -4.023672, -79.206415),
(54, 2, -4.025791, -79.207391),
(55, 2, -4.028574, -79.208249),
(56, 2, -4.035137, -79.205336),
(57, 2, -4.039675, -79.207246),
(58, 2, -4.049221, -79.213083);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `idRuta` int(11) NOT NULL,
  `user` int(10) DEFAULT '1' COMMENT 'FK a Usuarios.',
  `TituloRuta` varchar(250) CHARACTER SET utf8 NOT NULL COMMENT 'Nombre de la ruta del bus.',
  `lineaRuta` varchar(250) CHARACTER SET utf8 NOT NULL COMMENT 'Linea del Bus (Ej. Suaces Norte-Argelia, L2).',
  `intervalo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`idRuta`, `user`, `TituloRuta`, `lineaRuta`, `intervalo`) VALUES
(1, 1, 'Sauces Norte - Argelia', 'L2', '5 min'),
(2, 1, 'Motupe - Punzara', 'L7', '7 min');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `uid` int(10) NOT NULL COMMENT 'Primary Key: Unique user ID.',
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL DEFAULT '' COMMENT 'Unique user name.',
  `usuario` varchar(60) NOT NULL DEFAULT '' COMMENT 'Unique user name.',
  `clave` varchar(128) NOT NULL DEFAULT '' COMMENT 'User’s password (hashed).',
  `correo` varchar(254) DEFAULT '' COMMENT 'User’s e-mail address.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stores user data.';

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`uid`, `nombre`, `apellido`, `usuario`, `clave`, `correo`) VALUES
(1, 'Cristian', 'Aguirre', 'ceaguirre6', '1234', 'ceaguirre7@utpl.edu.ec'),
(4, 'ntest', 'aptst', 'ustest', 'test', 'test@mail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idC`),
  ADD KEY `FK_categoriasusuarios` (`user`);

--
-- Indices de la tabla `centros`
--
ALTER TABLE `centros`
  ADD PRIMARY KEY (`idCentro`),
  ADD KEY `FK_centrosUsers` (`user`),
  ADD KEY `FK_centroscategorias` (`idCat`);

--
-- Indices de la tabla `paradas`
--
ALTER TABLE `paradas`
  ADD PRIMARY KEY (`idParada`,`idRuta`),
  ADD KEY `FK_paradasRuta` (`idRuta`);

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`idRuta`),
  ADD KEY `FK_rutasUsers` (`user`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `centros`
--
ALTER TABLE `centros`
  MODIFY `idCentro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `paradas`
--
ALTER TABLE `paradas`
  MODIFY `idParada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `idRuta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key: Unique user ID.', AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `FK_categoriasusuarios` FOREIGN KEY (`user`) REFERENCES `usuarios` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `centros`
--
ALTER TABLE `centros`
  ADD CONSTRAINT `FK_centrosUsers` FOREIGN KEY (`user`) REFERENCES `usuarios` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_centroscategorias` FOREIGN KEY (`idCat`) REFERENCES `categorias` (`idC`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `paradas`
--
ALTER TABLE `paradas`
  ADD CONSTRAINT `FK_paradasRuta` FOREIGN KEY (`idRuta`) REFERENCES `rutas` (`idRuta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD CONSTRAINT `FK_rutasUsers` FOREIGN KEY (`user`) REFERENCES `usuarios` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
