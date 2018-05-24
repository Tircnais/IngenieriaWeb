-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-05-2018 a las 05:53:29
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `eventos`
--
CREATE DATABASE `eventos` CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `eventos`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

CREATE TABLE `registros` (
  `id` int(11) NOT NULL,
  `nombres` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cedula` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `tipo` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `curso` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `taller` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `registros`
--

INSERT INTO `registros` (`id`, `nombres`, `apellidos`, `direccion`, `correo`, `cedula`, `telefono`, `fecha_nacimiento`, `tipo`, `curso`, `taller`) VALUES
(9, 'Carlos', 'Quezada', 'San Cayetano', 'carlosq@hotmail.com', '1234567890', '555123', '1996-03-12', 'P', 'A', '1'),
(10, 'Galo', 'Plaza', 'Daniel Alvarez', 'plaza@gmail.com', '0987654321', '555321', '1998-06-05', 'O', '-', '3'),
(11, 'Juan', 'Salinas', 'La Banda', 'jsalinas@utpl.edu.ec', '2345678901', '555234', '1994-08-07', 'E', 'P', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registrotaller`
--

CREATE TABLE `registrotaller` (
  `id` int(11) NOT NULL,
  `id_registro` int(6) NOT NULL,
  `id_taller` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `registrotaller`
--

INSERT INTO `registrotaller` (`id`, `id_registro`, `id_taller`) VALUES
(18, 9, 1),
(19, 9, 2),
(20, 10, 3),
(21, 10, 4),
(22, 11, 1),
(23, 11, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talleres`
--

CREATE TABLE `talleres` (
  `id` int(11) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `talleres`
--

INSERT INTO `talleres` (`id`, `codigo`, `nombre`) VALUES
(1, '001', 'HTML'),
(2, '002', 'CSS'),
(3, '003', 'Visualizacion'),
(4, '004', 'Cocina');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registrotaller`
--
ALTER TABLE `registrotaller`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_registro` (`id_registro`),
  ADD KEY `id_taller` (`id_taller`);

--
-- Indices de la tabla `talleres`
--
ALTER TABLE `talleres`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `registros`
--
ALTER TABLE `registros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `registrotaller`
--
ALTER TABLE `registrotaller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `talleres`
--
ALTER TABLE `talleres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `registrotaller`
--
ALTER TABLE `registrotaller`
  ADD CONSTRAINT `registrotaller_ibfk_1` FOREIGN KEY (`id_registro`) REFERENCES `registros` (`id`),
  ADD CONSTRAINT `registrotaller_ibfk_2` FOREIGN KEY (`id_taller`) REFERENCES `talleres` (`id`),
  ADD CONSTRAINT `registrotaller_ibfk_3` FOREIGN KEY (`id_registro`) REFERENCES `registros` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
