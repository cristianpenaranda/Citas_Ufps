-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-03-2019 a las 21:40:39
-- Versión del servidor: 5.5.53-0+deb8u1
-- Versión de PHP: 7.0.13-1~dotdeb+8.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `citasufps`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `usuario_admin` varchar(10) NOT NULL,
  `clave` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`usuario_admin`, `clave`) VALUES
('1090491573', 'b29JS0dQcnFoZWc3d1R3RE5PS3g3Zz09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE IF NOT EXISTS `cita` (
`id` int(11) NOT NULL,
  `turno` int(10) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `horario` int(11) NOT NULL,
  `usuario` varchar(12) NOT NULL,
  `funcionario` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencia`
--

CREATE TABLE IF NOT EXISTS `dependencia` (
`id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `funcionario` varchar(12) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dependencia`
--

INSERT INTO `dependencia` (`id`, `nombre`, `ubicacion`, `telefono`, `funcionario`) VALUES
(1, 'RECTORIA', 'EDIFICIO DE TORRE ADMINISTRATIVA, 2DO PISO ', '5776655', '88281595');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionario`
--

CREATE TABLE IF NOT EXISTS `funcionario` (
  `documento` varchar(12) NOT NULL,
  `clave` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `funcionario`
--

INSERT INTO `funcionario` (`documento`, `clave`) VALUES
('88281595', 'b29JS0dQcnFoZWc3d1R3RE5PS3g3Zz09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE IF NOT EXISTS `horario` (
`id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `funcionario` varchar(12) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`id`, `fecha`, `hora_inicio`, `hora_fin`, `funcionario`) VALUES
(1, '2018-12-06', '10:00:00', '12:00:00', '88281595'),
(2, '2018-12-06', '14:00:00', '16:00:00', '88281595');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE IF NOT EXISTS `noticia` (
`id` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` date NOT NULL,
  `administrador` varchar(10) DEFAULT NULL,
  `funcionario` varchar(12) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`id`, `titulo`, `descripcion`, `fecha`, `administrador`, `funcionario`) VALUES
(1, 'Proyecto AyD 2018 - 1151190', 'Sistema de Tickets para Atención a Usuario - Citas Ufps 2018', '2018-12-07', '1090491573', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `documento` varchar(12) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `correo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`documento`, `nombre`, `telefono`, `correo`) VALUES
('123456', 'LAURA', '123456', 'lauridani1@gmail.com'),
('27706878', 'YAZMIN SANCHEZ', '3212828820', 'majose315@hotmail.com'),
('88281595', 'HECTOR MIGUEL PARRA LOPEZ', '3101122334', 'rectoria@ufps.edu.co');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `documento` varchar(12) NOT NULL,
  `clave` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`documento`, `clave`) VALUES
('123456', 'WTNWb3dXbWY5dUN4OXRpa3kyanVzQT09'),
('27706878', 'b29JS0dQcnFoZWc3d1R3RE5PS3g3Zz09');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
 ADD PRIMARY KEY (`usuario_admin`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_cita_horario1_idx` (`horario`), ADD KEY `fk_cita_usuario1_idx` (`usuario`), ADD KEY `fk_cita_funcionario1_idx` (`funcionario`);

--
-- Indices de la tabla `dependencia`
--
ALTER TABLE `dependencia`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_dependencia_funcionario1_idx` (`funcionario`);

--
-- Indices de la tabla `funcionario`
--
ALTER TABLE `funcionario`
 ADD PRIMARY KEY (`documento`), ADD KEY `fk_funcionario_persona1_idx` (`documento`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_horario_funcionario1_idx` (`funcionario`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_noticia_administrador1_idx` (`administrador`), ADD KEY `fk_noticia_funcionario1_idx` (`funcionario`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
 ADD PRIMARY KEY (`documento`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`documento`), ADD KEY `fk_usuario_persona1_idx` (`documento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `dependencia`
--
ALTER TABLE `dependencia`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
ADD CONSTRAINT `fk_cita_funcionario1` FOREIGN KEY (`funcionario`) REFERENCES `funcionario` (`documento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_cita_horario1` FOREIGN KEY (`horario`) REFERENCES `horario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_cita_usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`documento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dependencia`
--
ALTER TABLE `dependencia`
ADD CONSTRAINT `fk_dependencia_funcionario1` FOREIGN KEY (`funcionario`) REFERENCES `funcionario` (`documento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `funcionario`
--
ALTER TABLE `funcionario`
ADD CONSTRAINT `fk_funcionario_persona1` FOREIGN KEY (`documento`) REFERENCES `persona` (`documento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
ADD CONSTRAINT `fk_horario_funcionario1` FOREIGN KEY (`funcionario`) REFERENCES `funcionario` (`documento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `noticia`
--
ALTER TABLE `noticia`
ADD CONSTRAINT `fk_noticia_administrador1` FOREIGN KEY (`administrador`) REFERENCES `administrador` (`usuario_admin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_noticia_funcionario1` FOREIGN KEY (`funcionario`) REFERENCES `funcionario` (`documento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
ADD CONSTRAINT `fk_usuario_persona1` FOREIGN KEY (`documento`) REFERENCES `persona` (`documento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
