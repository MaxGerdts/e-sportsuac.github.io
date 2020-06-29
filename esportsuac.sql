-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-04-2020 a las 19:23:09
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `esportsuac`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `esportsuac_usuarios`
--

CREATE TABLE `esportsuac_usuarios` (
  `usuarios_id` int(200) NOT NULL,
  `usuarios_nombre` varchar(40) NOT NULL,
  `usuarios_apellidos` varchar(40) NOT NULL,
  `usuarios_tipo_id` varchar(40) NOT NULL,
  `usuarios_identificacion` varchar(40) NOT NULL,
  `usuarios_email` varchar(40) NOT NULL,
  `usuarios_password` varchar(40) NOT NULL,
  `usuarios_programa` varchar(50) NOT NULL,
  `usuarios_liga` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `esportsuac_usuarios`
--
ALTER TABLE `esportsuac_usuarios`
  ADD PRIMARY KEY (`usuarios_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `esportsuac_usuarios`
--
ALTER TABLE `esportsuac_usuarios`
  MODIFY `usuarios_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
