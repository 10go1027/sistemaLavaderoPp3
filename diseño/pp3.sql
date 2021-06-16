-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-06-2021 a las 16:02:43
-- Versión del servidor: 5.7.28-log
-- Versión de PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pp3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deposito`
--

CREATE TABLE `deposito` (
  `id_deposito` int(11) NOT NULL,
  `id_prenda` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `deposito`
--

INSERT INTO `deposito` (`id_deposito`, `id_prenda`, `cantidad`, `id_estado`) VALUES
(5, 123, 1200, 1),
(6, 32, 3, 1),
(7, 73, 20, 1),
(8, 36, 200, 1),
(9, 43, 6, 1),
(10, 33, 11, 1),
(11, 270, 3, 1),
(12, 202, 1000, 1),
(13, 16, 100, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `descripcion`) VALUES
(1, 'Limpia'),
(2, 'Sucia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento`
--

CREATE TABLE `movimiento` (
  `id_movimiento` int(11) NOT NULL,
  `id_usuarios` int(11) NOT NULL,
  `id` varchar(100) NOT NULL,
  `total` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `movimiento`
--

INSERT INTO `movimiento` (`id_movimiento`, `id_usuarios`, `id`, `total`, `fecha`) VALUES
(28, 2, '68bf471d464f302226da2776ad922b50', 1107, '2021-05-13 21:59:07'),
(29, 2, 'a55d5b6e32026b071e85fe6773a88c05', 14, '2021-05-28 18:47:50'),
(30, 2, 'c465b2319d88ddd131819f4a5fd33c7c', 0, '2021-05-28 22:53:00'),
(31, 1, 'cfc4ef8c1bec618cbec62fe623c29620', 10, '2021-06-01 22:38:07'),
(32, 2, 'e2c3231fe2630de2ed25975037a187bf', 0, '2021-06-10 03:07:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prenda`
--

CREATE TABLE `prenda` (
  `id_prenda` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `prenda`
--

INSERT INTO `prenda` (`id_prenda`, `codigo`, `descripcion`, `estado`) VALUES
(2, 36, 'Colcha', 1),
(5, 73, 'Frazada', 1),
(6, 71, 'Funda', 1),
(7, 270, 'Zalea', 1),
(8, 1, 'Poncho', 1),
(9, 202, 'Sabana', 1),
(10, 123, 'Barbijo', 0),
(26, 16, 'Gato', 1),
(27, 43, 'Pato', 1),
(28, 32, 'Campo', 1),
(35, 33, 'Perro', 1),
(36, 101, 'Compresa', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prenda_salas`
--

CREATE TABLE `prenda_salas` (
  `id_preda_salas` int(11) NOT NULL,
  `id_salas` int(11) NOT NULL,
  `id_prenda` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_movimiento` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `prenda_salas`
--

INSERT INTO `prenda_salas` (`id_preda_salas`, `id_salas`, `id_prenda`, `id_estado`, `id_movimiento`, `cantidad`) VALUES
(340, 1, 123, 2, '68bf471d464f302226da2776ad922b50', 100),
(341, 2, 123, 2, '68bf471d464f302226da2776ad922b50', 7),
(342, 3, 123, 2, '68bf471d464f302226da2776ad922b50', 1000),
(347, 1, 36, 2, '32a1e32ebf2b9f6e91ed176c32904948', 60),
(348, 2, 36, 2, '32a1e32ebf2b9f6e91ed176c32904948', 50),
(349, 3, 36, 2, '32a1e32ebf2b9f6e91ed176c32904948', 40),
(350, 4, 36, 2, '32a1e32ebf2b9f6e91ed176c32904948', 20),
(360, 1, 32, 2, 'a55d5b6e32026b071e85fe6773a88c05', 1),
(361, 1, 123, 2, 'a55d5b6e32026b071e85fe6773a88c05', 13),
(372, 1, 202, 2, 'c32017634b4e9a324c5143bfc6ba9418', 30),
(381, 1, 36, 2, 'cfc4ef8c1bec618cbec62fe623c29620', 10),
(382, 1, 36, 2, '91aa8dfb125862e6d8ac7f3d4857d362', 39),
(384, 3, 202, 2, '91aa8dfb125862e6d8ac7f3d4857d362', 80),
(385, 3, 1, 2, '91aa8dfb125862e6d8ac7f3d4857d362', 8),
(386, 3, 36, 2, '91aa8dfb125862e6d8ac7f3d4857d362', 7),
(387, 1, 36, 2, 'fc998f388818925f417f03b79c510128', 40),
(388, 1, 73, 2, 'fc998f388818925f417f03b79c510128', 3),
(389, 2, 36, 2, 'fc998f388818925f417f03b79c510128', 20),
(390, 1, 202, 2, 'f83ccda249586ac4c0abc76688fa72d1', 10),
(391, 17, 202, 2, 'f83ccda249586ac4c0abc76688fa72d1', 10),
(392, 1, 36, 2, 'bf6f1ff62a71d29e7ef2a25494a9331d', 4),
(393, 2, 202, 2, 'bf6f1ff62a71d29e7ef2a25494a9331d', 8),
(394, 2, 36, 2, 'bf6f1ff62a71d29e7ef2a25494a9331d', 4),
(395, 1, 202, 2, '9ecb26114ff3ccc5aaf5a7ae33c900be', 32),
(396, 1, 202, 2, 'cd3bead1cb4750ca8314a2f1962d6805', 23),
(397, 1, 36, 2, 'cd3bead1cb4750ca8314a2f1962d6805', 10),
(398, 1, 71, 2, 'cd3bead1cb4750ca8314a2f1962d6805', 5),
(399, 2, 202, 2, 'cd3bead1cb4750ca8314a2f1962d6805', 30),
(401, 1, 36, 2, '22883c0e848aee42b923e8d812b77a1b', 5),
(402, 17, 202, 2, '22883c0e848aee42b923e8d812b77a1b', 20),
(403, 4, 36, 2, '22883c0e848aee42b923e8d812b77a1b', 3),
(404, 5, 202, 2, '22883c0e848aee42b923e8d812b77a1b', 11),
(406, 1, 202, 2, '22883c0e848aee42b923e8d812b77a1b', 20),
(407, 2, 36, 2, '22883c0e848aee42b923e8d812b77a1b', 2),
(408, 1, 202, 2, 'a811274f392509aadfdfa551f5445110', 40),
(409, 1, 36, 2, 'a811274f392509aadfdfa551f5445110', 7),
(410, 1, 71, 2, 'a811274f392509aadfdfa551f5445110', 10),
(411, 2, 202, 2, 'a811274f392509aadfdfa551f5445110', 20),
(412, 2, 36, 2, 'a811274f392509aadfdfa551f5445110', 5),
(413, 17, 202, 2, 'a811274f392509aadfdfa551f5445110', 8),
(414, 1, 202, 2, '6c56db1d5b2c117be7cbcf56ee252c4c', 20),
(420, 1, 73, 2, '45d00ca710d4b54beccf0a556919fb8c', 1),
(421, 1, 202, 2, '45d00ca710d4b54beccf0a556919fb8c', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `descripcion`) VALUES
(1, 'Encargado'),
(2, 'Operario'),
(3, 'Enfermera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salas`
--

CREATE TABLE `salas` (
  `id_sala` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `salas`
--

INSERT INTO `salas` (`id_sala`, `descripcion`) VALUES
(1, 'Unidad 1 sala clinica (mujer)'),
(2, 'Unidad 2 sala clinica (hombre)'),
(3, 'Unidad 3 sala clinica'),
(4, 'Unidad 4 sala de dia'),
(5, 'Unidad 5 sala cardiologia'),
(6, 'Unidad 6 sala psiquiatria'),
(7, 'Unidad 8 sala cirugia hombre'),
(8, 'Unidad 9 sala cirugia general mujer'),
(9, 'Unidad 10 sala traumatologia'),
(10, 'Unidad 15 sala maternidad'),
(11, 'Unidad 16 sala pediatra'),
(12, 'Unidad 17 sala neonatal'),
(13, 'Unidad 18 terapia intensiva'),
(14, 'Unidad 19 guardia'),
(15, 'Quirofano 19 de guardia'),
(16, 'Quirofano 15 maternidad'),
(17, 'Parto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuarios` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `contrasenia` varchar(100) NOT NULL,
  `ficha_municipal` int(11) NOT NULL,
  `fecha_alta` date NOT NULL,
  `fecha_baja` date DEFAULT NULL,
  `correo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuarios`, `nombre`, `apellido`, `contrasenia`, `ficha_municipal`, `fecha_alta`, `fecha_baja`, `correo`) VALUES
(1, 'test', 'test', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 654, '2021-03-27', NULL, 'damian@pp3.ml'),
(2, 'elza', 'pato', '3da541559918a808c2402bba5012f6c60b27661c', 123, '2021-03-30', NULL, 'elzapato@gmail.com'),
(3, 'manuel', 'rodriguez', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 321, '2021-03-30', NULL, 'manuel__rodriguez@mayonesa.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

CREATE TABLE `usuario_rol` (
  `id_usuario_rol` int(11) NOT NULL,
  `id_usuarios` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `flagBaja` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`id_usuario_rol`, `id_usuarios`, `id_rol`, `flagBaja`) VALUES
(1, 1, 1, b'0'),
(2, 1, 2, b'0'),
(3, 2, 2, b'0'),
(4, 1, 3, b'0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `deposito`
--
ALTER TABLE `deposito`
  ADD PRIMARY KEY (`id_deposito`),
  ADD KEY `fk_estado_deposito` (`id_estado`),
  ADD KEY `fk_prenda_deposito` (`id_prenda`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `movimiento`
--
ALTER TABLE `movimiento`
  ADD PRIMARY KEY (`id_movimiento`),
  ADD KEY `fk_usuarios_mov` (`id_usuarios`);

--
-- Indices de la tabla `prenda`
--
ALTER TABLE `prenda`
  ADD PRIMARY KEY (`id_prenda`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `prenda_salas`
--
ALTER TABLE `prenda_salas`
  ADD PRIMARY KEY (`id_preda_salas`),
  ADD KEY `fk_salas` (`id_salas`),
  ADD KEY `fk_estado` (`id_estado`),
  ADD KEY `fk_prenda` (`id_prenda`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`id_sala`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuarios`),
  ADD UNIQUE KEY `ficha_municipal` (`ficha_municipal`);

--
-- Indices de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD PRIMARY KEY (`id_usuario_rol`),
  ADD KEY `fk_usuarios` (`id_usuarios`),
  ADD KEY `fk_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `deposito`
--
ALTER TABLE `deposito`
  MODIFY `id_deposito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `movimiento`
--
ALTER TABLE `movimiento`
  MODIFY `id_movimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `prenda`
--
ALTER TABLE `prenda`
  MODIFY `id_prenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `prenda_salas`
--
ALTER TABLE `prenda_salas`
  MODIFY `id_preda_salas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=445;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `salas`
--
ALTER TABLE `salas`
  MODIFY `id_sala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  MODIFY `id_usuario_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `deposito`
--
ALTER TABLE `deposito`
  ADD CONSTRAINT `fk_estado_deposito` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`),
  ADD CONSTRAINT `fk_prenda_deposito` FOREIGN KEY (`id_prenda`) REFERENCES `prenda` (`codigo`);

--
-- Filtros para la tabla `movimiento`
--
ALTER TABLE `movimiento`
  ADD CONSTRAINT `fk_usuarios_mov` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id_usuarios`);

--
-- Filtros para la tabla `prenda_salas`
--
ALTER TABLE `prenda_salas`
  ADD CONSTRAINT `fk_estado` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`),
  ADD CONSTRAINT `fk_prenda` FOREIGN KEY (`id_prenda`) REFERENCES `prenda` (`codigo`),
  ADD CONSTRAINT `fk_salas` FOREIGN KEY (`id_salas`) REFERENCES `salas` (`id_sala`);

--
-- Filtros para la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD CONSTRAINT `fk_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`),
  ADD CONSTRAINT `fk_usuarios` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id_usuarios`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
