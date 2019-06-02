-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-06-2019 a las 22:53:12
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `citasufps`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `usuario_admin` varchar(10) NOT NULL,
  `clave` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`usuario_admin`, `clave`) VALUES
('0000', 'b29JS0dQcnFoZWc3d1R3RE5PS3g3Zz09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id` int(11) NOT NULL,
  `turno` int(10) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL,
  `horario` int(11) NOT NULL,
  `funcionario` varchar(12) NOT NULL,
  `usuario` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencia`
--

CREATE TABLE `dependencia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dependencia`
--

INSERT INTO `dependencia` (`id`, `nombre`, `ubicacion`, `telefono`) VALUES
(1, 'PLAN DE ESTUDIOS ING DE SISTEMAS', 'EDIF AULA SUR A-4 PISO', '5776655 ext 332'),
(2, 'RECTORIA', 'EDIFICIO TORRE ADMINISTRATIVA', '56783982'),
(3, 'PLAN DE ESTUDIOS ING CIVIL', 'EDIF FUNDADORES-1 PISO', '5776655 ext 329'),
(4, 'PLAN DE ESTUDIOS ING MECANICA', 'EDIF FUNDADORES-1 PISO', '5776655 ext 119'),
(5, 'PLAN DE ESTUDIOS DERECHO', 'EDIF FUNDADORES-1 PISO', '5776655 ext 323'),
(6, 'PLAN DE ESTUDIOS ING INDUSTRIAL', 'EDIF FUNDADORES-1 PISO', '5776655 ext 120'),
(7, 'PLAN DE ESTUDIOS ING DE MINAS', 'EDIF FUNDADORES-2 PISO', '5776655 ext 123'),
(8, 'VICERRECTORIA BIENESTAR UNIVERSITARIO', 'EDIF AULA SUR A-1 PISO', '5776655 ext 329'),
(9, 'PLAN DE ESTUDIOS COMUNICACION SOCIAL', 'EDIF COMUNICACIÓN SOCIALO', '5752920'),
(10, 'BIBLIOTECA EDUARDO COTE LAMUS', 'DIVISIÓN BIBLIOTECA', '5771550');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionario`
--

CREATE TABLE `funcionario` (
  `documento` varchar(12) NOT NULL,
  `dependencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `funcionario`
--

INSERT INTO `funcionario` (`documento`, `dependencia`) VALUES
('2222222222', 1),
('3333333333', 1),
('4444444444', 1),
('5555555555', 1),
('11111111111', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `funcionario` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_anuncios`
--

CREATE TABLE `imagenes_anuncios` (
  `id` int(1) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `archivo` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `imagenes_anuncios`
--

INSERT INTO `imagenes_anuncios` (`id`, `nombre`, `archivo`) VALUES
(3, 'IMAGEN PRINCIPAL', 'view/presentacion/archivos/8d5d5689e792b012568feb926f52c1b57251a5b6.png'),
(4, 'ING SISTEMAS', 'view/presentacion/archivos/9bcc0f5a48b7ac2c4781b79fffce5b1cd252e512.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `id` int(11) NOT NULL,
  `titulo` text,
  `descripcion` text,
  `fecha` date DEFAULT NULL,
  `administrador` varchar(10) DEFAULT NULL,
  `funcionario` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`id`, `titulo`, `descripcion`, `fecha`, `administrador`, `funcionario`) VALUES
(1, 'Proyecto AyD 2018 - 1151190', 'Sistema de Tickets para Atención a Usuario - Citas Ufps 2018', '2018-12-07', '0000', NULL),
(2, 'Proyecto IngSw 2019', 'Continuación del proyecto de Citas Ufps del año 2018-2', '2019-05-29', '0000', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `documento` varchar(12) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `clave` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`documento`, `nombre`, `telefono`, `correo`, `clave`) VALUES
('11111111111', 'MILTON JESUS VERA', '3101122333', 'cristiancamilops95@gmail.com', 'b29JS0dQcnFoZWc3d1R3RE5PS3g3Zz09'),
('2222222222', 'CARLOS RENE ANGARITA', '3101122333', 'cristiancamilops95@gmail.com', 'b29JS0dQcnFoZWc3d1R3RE5PS3g3Zz09'),
('3333333333', 'JUDITH DEL PILAR RODRIGUEZ', '3101122333', 'cristiancamilops95@gmail.com', 'b29JS0dQcnFoZWc3d1R3RE5PS3g3Zz09'),
('4444444444', 'NELSON BELTRAN', '3101122333', 'cristiancamilops95@gmail.com', 'b29JS0dQcnFoZWc3d1R3RE5PS3g3Zz09'),
('5555555555', 'OSCAR ALBERTO GALLARDO', '3101122333', 'cristiancamilops95@gmail.com', 'b29JS0dQcnFoZWc3d1R3RE5PS3g3Zz09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `documento` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`documento`) VALUES
('11111111111'),
('2222222222'),
('3333333333'),
('4444444444'),
('5555555555');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cita_horario1_idx` (`horario`),
  ADD KEY `fk_cita_funcionario1_idx` (`funcionario`),
  ADD KEY `fk_cita_usuario1_idx` (`usuario`);

--
-- Indices de la tabla `dependencia`
--
ALTER TABLE `dependencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `funcionario`
--
ALTER TABLE `funcionario`
  ADD KEY `fk_funcionario_persona1_idx` (`documento`),
  ADD KEY `fk_funcionario_dependencia1_idx` (`dependencia`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_horario_funcionario1_idx` (`funcionario`);

--
-- Indices de la tabla `imagenes_anuncios`
--
ALTER TABLE `imagenes_anuncios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_noticia_admnistrador1_idx` (`administrador`),
  ADD KEY `fk_noticia_funcionario1_idx` (`funcionario`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`documento`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD KEY `fk_usuario_persona_idx` (`documento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `dependencia`
--
ALTER TABLE `dependencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `imagenes_anuncios`
--
ALTER TABLE `imagenes_anuncios`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `fk_cita_funcionario1` FOREIGN KEY (`funcionario`) REFERENCES `funcionario` (`documento`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cita_horario1` FOREIGN KEY (`horario`) REFERENCES `horario` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cita_usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`documento`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk_funcionario_dependencia1` FOREIGN KEY (`dependencia`) REFERENCES `dependencia` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_funcionario_persona1` FOREIGN KEY (`documento`) REFERENCES `persona` (`documento`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `fk_horario_funcionario1` FOREIGN KEY (`funcionario`) REFERENCES `funcionario` (`documento`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `fk_noticia_admnistrador1` FOREIGN KEY (`administrador`) REFERENCES `administrador` (`usuario_admin`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_noticia_funcionario1` FOREIGN KEY (`funcionario`) REFERENCES `funcionario` (`documento`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_persona` FOREIGN KEY (`documento`) REFERENCES `persona` (`documento`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
