-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-02-2023 a las 10:01:13
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `forum`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion`
--

CREATE TABLE `accion` (
  `id_accion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `like` int(11) NOT NULL,
  `dislike` int(11) NOT NULL,
  `otro` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `accion`
--

INSERT INTO `accion` (`id_accion`, `id_usuario`, `id_post`, `like`, `dislike`, `otro`) VALUES
(1, 8, 25, 1, 0, NULL),
(2, 8, 18, 1, 0, NULL),
(3, 8, 19, 0, 1, NULL),
(4, 8, 20, 1, 0, NULL),
(5, 8, 26, 1, 0, NULL),
(6, 12, 18, 1, 0, NULL),
(7, 12, 19, 1, 0, NULL),
(8, 12, 20, 1, 0, NULL),
(9, 12, 21, 1, 0, NULL),
(12, 11, 20, 0, 1, NULL),
(14, 8, 22, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `id_facultad` int(11) NOT NULL,
  `nombre_categoria` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `abreviatura` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `color_categoria` varchar(15) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `id_facultad`, `nombre_categoria`, `abreviatura`, `color_categoria`) VALUES
(1, 1, 'Grado en Arquitectura Técnica', 'G.A.T.', '#925B35'),
(2, 1, 'Grado en Ingeniería Agroalimentaria', 'G.I.A.', '#925B35'),
(3, 1, 'Grado en Ingeniería Informática en Sistemas de Información', 'G.I.I.S.I.', '#925B35'),
(4, 1, 'Grado en Ingeniería Civil', 'G.I.C.', '#925B35'),
(5, 1, 'Grado en Ingeniería Mecánica', 'G.I.M.', '#925B35'),
(6, 1, 'Grado en Ingeniería de Materiales', 'G.I.Mat.', '#925B35'),
(7, 1, 'Doble Grado en Ingeniería de Materiales e Ingeniería Mecánica', 'G.I.M.M.', '#925B35'),
(8, 1, 'Doble Grado en Ingeniería Informática en Sistemas de Información e Información y Documentación', 'G.I.I.D.', '#925B35'),
(9, 1, 'Grado en Desarrollo de Aplicaciones 3D Interactivas y Videojuegos', 'G.A.3D.I.', '#925B35'),
(10, 2, 'Maestro en Educación Infantil', 'M.E.Inf.', '#38E4EA'),
(11, 2, 'Maestro en Educación Primaria', 'M.E.Pri.', '#38E4EA'),
(12, 2, 'Doble Titulación de Maestro en Educación Primaria y en Maestro en Educación Infantil', 'M.E.Pri.Inf.', '#38E4EA'),
(13, 3, 'Enfermería', 'Enf.', '#C3C8C9'),
(14, 4, 'Relaciones Laborales y Recursos Humanos', 'R.L.R.H', '#E8983D');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultad`
--

CREATE TABLE `facultad` (
  `id_facultad` int(11) NOT NULL,
  `nombre_facultad` varchar(70) COLLATE latin1_spanish_ci NOT NULL,
  `abreviatura` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `calle_facultad` varchar(70) COLLATE latin1_spanish_ci NOT NULL,
  `ciudad_facultad` varchar(20) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `facultad`
--

INSERT INTO `facultad` (`id_facultad`, `nombre_facultad`, `abreviatura`, `calle_facultad`, `ciudad_facultad`) VALUES
(1, 'Escuela Politécnica Superior de Zamora', 'E.P.S.Z.', 'Avenida de Requejo, 33', 'Zamora'),
(2, 'Escuela Universitaria de Magisterio', 'E.U.M.', 'Avenida del Príncipe de Asturias', 'Zamora'),
(3, 'Escuela de Enfermería de Zamora', 'E.E.Z.', 'Avenida de Requejo, 33', 'Zamora'),
(4, 'Escuela Universitaria de relaciones laborales de Zamora', 'E.U.R.L.Z', 'San Torcuato, 43', 'Zamora');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id_mensaje` int(11) NOT NULL,
  `id_emisor` int(11) NOT NULL,
  `id_receptor` int(11) NOT NULL,
  `cuerpo_mensaje` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `estado_mensaje` int(11) NOT NULL,
  `fecha_mensaje` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`id_mensaje`, `id_emisor`, `id_receptor`, `cuerpo_mensaje`, `estado_mensaje`, `fecha_mensaje`) VALUES
(53, 8, 11, 'Hola', 0, '2022-11-24 10:55:51'),
(54, 8, 12, 'Hola, que tal?', 0, '2022-11-24 10:56:11'),
(55, 8, 11, 'Que tal?', 0, '2022-11-25 09:32:41'),
(72, 8, 12, 'Bien', 0, '2022-12-03 09:41:45'),
(73, 8, 12, 'Que paso?\n', 0, '2022-12-03 09:41:45'),
(98, 12, 8, 'Nada nada, ya me hice la cuenta del foro', 0, '2022-11-27 11:25:47'),
(99, 11, 8, 'Hola', 0, '2022-11-27 11:25:45'),
(100, 8, 11, 'Buenos dias', 1, '2022-11-27 10:36:23'),
(101, 8, 9, 'Hola', 1, '2022-11-27 10:42:56'),
(102, 9, 8, 'Que tal\n', 0, '2022-11-27 11:25:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `id_post_raiz` int(11) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `titulo_post` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `cuerpo_post` varchar(550) COLLATE latin1_spanish_ci NOT NULL,
  `tipo_post` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `tags_post` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `vistas_post` int(11) NOT NULL DEFAULT 0,
  `fecha_post` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`id_post`, `id_post_raiz`, `id_usuario`, `id_categoria`, `titulo_post`, `cuerpo_post`, `tipo_post`, `tags_post`, `vistas_post`, `fecha_post`) VALUES
(1, NULL, 8, 7, 'Prueba', 'Esto es una prueba', 'PREGUNTA', 'prueba,hola', 10, '2022-11-15 01:00:00'),
(9, NULL, 8, 13, 'Medicina', 'Prueba', 'PREGUNTA', 'prueba,hola', 0, '2022-11-15 05:00:00'),
(10, NULL, 8, 6, 'Prueba 2', 'prueba 2\r\ndksl\r\n\r\ngracias.', 'DEBATE', 'prueba, prueba2', 0, '2022-11-15 06:00:00'),
(11, NULL, 8, 7, 'Post1', 'dsfdfsdfsff', 'DEBATE', 'dsf,sdf,sdf,sdf', 0, '2022-11-15 07:00:00'),
(12, NULL, 8, 2, 'Post 2', 'sdfafsa', 'PREGUNTA', 'asda', 1, '2022-11-15 08:00:00'),
(13, NULL, 8, 10, 'Post 3', 'safsf', 'PREGUNTA', 'dsfs,sdfsf,sdfsdf', 0, '2022-11-15 09:00:00'),
(14, NULL, 8, 3, 'Post 4', 'Prueba de post 4', 'PREGUNTA', 'prueba,hola', 1, '2022-11-15 10:00:00'),
(15, NULL, 8, 5, 'Post 5', 'Prueba 5', 'PREGUNTA', 'prueba,5', 2, '2022-11-15 11:00:00'),
(17, NULL, 8, 3, 'Poner fecha en php', 'Como puedo crear una fecha en php?', 'PREGUNTA', 'fecha, php', 13, '2022-11-17 15:04:35'),
(18, NULL, 11, 9, 'Hola', 'Hola soy nueva', 'DEBATE', 'bienvenida,hola', 171, '2022-11-19 08:40:12'),
(19, 18, 8, 9, 'Hola', 'Hola', 'RESPUESTA', 'bienvenida,hola', 3, '2022-11-19 10:39:58'),
(20, 18, 8, 9, 'Hola', 'Bienvenida', 'RESPUESTA', 'bienvenida,hola', 1, '2022-11-19 11:05:28'),
(21, 16, 8, 9, 'Hola', 'Hola Pepe', 'RESPUESTA', 'nuevo,bienvenida', 1, '2022-11-19 11:59:00'),
(22, 17, 11, 3, 'Poner fecha en php', 'Tienes que usar la función date()', 'RESPUESTA', 'fecha, php', 2, '2022-11-19 12:08:31'),
(24, 16, 8, 9, 'Hola', 'Prueba1', 'RESPUESTA', 'nuevo,bienvenida', 0, '2022-11-19 15:13:52'),
(25, NULL, 12, 13, 'En que hospital es mejor hacer las prácticas?', 'Los que habeís hecho prácticas, en que hospital es mejor hacerlas?', 'PREGUNTA', 'prácticas, hospital', 45, '2022-11-19 16:17:14'),
(26, 25, 8, 13, 'En que hospital es mejor hacer las prácticas?', 'Dicen que en el virgen de la concha', 'RESPUESTA', 'prácticas, hospital', 3, '2022-11-19 16:29:41'),
(27, NULL, 8, 3, 'Hay mañana clase de empresa?', 'Alguien sabe si mañana hay clase de empresa?', 'PREGUNTA', 'clase, empresa, cuarto', 1352, '2022-11-27 17:21:02'),
(1348, 27, 8, 3, 'Hay mañana clase de empresa?', 'Si', 'RESPUESTA', 'clase, empresa, cuarto', 0, '2022-11-28 18:28:20'),
(1349, NULL, 8, 3, '¿Cuando se presenta el tfg?', 'Que dia se presenta el tfg en febrero?', 'PREGUNTA', 'tfg,presentacion', 2, '2023-02-06 09:59:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguidores`
--

CREATE TABLE `seguidores` (
  `id_seguidores` int(11) NOT NULL,
  `id_seguidor` int(11) NOT NULL,
  `id_seguido` int(11) NOT NULL,
  `fecha_seguimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `seguidores`
--

INSERT INTO `seguidores` (`id_seguidores`, `id_seguidor`, `id_seguido`, `fecha_seguimiento`) VALUES
(4, 9, 8, '2022-11-17'),
(10, 11, 8, '2022-11-19'),
(13, 12, 8, '2022-11-19'),
(14, 8, 12, '2022-11-19'),
(15, 8, 11, '2022-11-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripcion_categoria`
--

CREATE TABLE `suscripcion_categoria` (
  `id_suscripcion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `suscripcion_categoria`
--

INSERT INTO `suscripcion_categoria` (`id_suscripcion`, `id_usuario`, `id_categoria`) VALUES
(8, 9, 1),
(9, 9, 2),
(13, 11, 9),
(18, 11, 3),
(19, 12, 13),
(20, 8, 9),
(25, 8, 3),
(27, 13, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo` int(11) NOT NULL,
  `nombre_tipo` varchar(20) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo`, `nombre_tipo`) VALUES
(1, 'Administrador'),
(2, 'Profesor'),
(3, 'Alumno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `apellidos_usuario` varchar(40) COLLATE latin1_spanish_ci NOT NULL,
  `email_usuario` varchar(40) COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(40) COLLATE latin1_spanish_ci NOT NULL,
  `puntos` int(11) NOT NULL DEFAULT 0,
  `id_carrera` int(11) DEFAULT NULL,
  `id_tipo` int(11) NOT NULL DEFAULT 0,
  `ult_conexion` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `apellidos_usuario`, `email_usuario`, `password`, `puntos`, `id_carrera`, `id_tipo`, `ult_conexion`) VALUES
(8, 'Angel', 'Francisco Garcia', 'angel@usal.es', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 140, 3, 3, '2023-02-06 08:59:36'),
(9, 'David', 'David', 'david@usal.es', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 0, NULL, 1, '2022-11-27 10:43:46'),
(11, 'Elia', 'Elia', 'elia@usal.es', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 20, NULL, 3, '2022-11-27 16:45:39'),
(12, 'Carmen', 'Car', 'carmen@usal.es', '8cb2237d0679ca88db6464eac60da96345513964', 50, 13, 2, '2022-12-03 11:10:22'),
(13, 'Admin', 'Admin', 'admin@usal.es', 'd033e22ae348aeb5660fc2140aec35850c4da997', 0, NULL, 1, '2023-02-06 09:00:24');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accion`
--
ALTER TABLE `accion`
  ADD PRIMARY KEY (`id_accion`),
  ADD KEY `fk_id_usuario_accion_idx` (`id_usuario`),
  ADD KEY `fk_id_post_accion_idx` (`id_post`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `fk_id_facultad_idx` (`id_facultad`);

--
-- Indices de la tabla `facultad`
--
ALTER TABLE `facultad`
  ADD PRIMARY KEY (`id_facultad`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD KEY `fk_id_emisor_idx` (`id_emisor`),
  ADD KEY `fk_id_receptor_idx` (`id_receptor`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `fk_id_usuario_post_idx` (`id_usuario`),
  ADD KEY `fk_id_categoria_post_idx` (`id_categoria`);

--
-- Indices de la tabla `seguidores`
--
ALTER TABLE `seguidores`
  ADD PRIMARY KEY (`id_seguidores`),
  ADD KEY `fk_seguidor_idx` (`id_seguidor`),
  ADD KEY `fk_id_seguido_idx` (`id_seguido`);

--
-- Indices de la tabla `suscripcion_categoria`
--
ALTER TABLE `suscripcion_categoria`
  ADD PRIMARY KEY (`id_suscripcion`),
  ADD KEY `fk_id_usuario_idx` (`id_usuario`),
  ADD KEY `fk_id_categoria_idx` (`id_categoria`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_id_tipo_idx` (`id_tipo`),
  ADD KEY `fk_id_carrera_idx` (`id_carrera`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accion`
--
ALTER TABLE `accion`
  MODIFY `id_accion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `facultad`
--
ALTER TABLE `facultad`
  MODIFY `id_facultad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1350;

--
-- AUTO_INCREMENT de la tabla `seguidores`
--
ALTER TABLE `seguidores`
  MODIFY `id_seguidores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `suscripcion_categoria`
--
ALTER TABLE `suscripcion_categoria`
  MODIFY `id_suscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accion`
--
ALTER TABLE `accion`
  ADD CONSTRAINT `fk_id_post_accion` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_usuario_accion` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_id_facultad` FOREIGN KEY (`id_facultad`) REFERENCES `facultad` (`id_facultad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `fk_id_emisor` FOREIGN KEY (`id_emisor`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_receptor` FOREIGN KEY (`id_receptor`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_id_categoria_post` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_usuario_post` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `seguidores`
--
ALTER TABLE `seguidores`
  ADD CONSTRAINT `fk_id_seguido` FOREIGN KEY (`id_seguido`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_seguidor` FOREIGN KEY (`id_seguidor`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `suscripcion_categoria`
--
ALTER TABLE `suscripcion_categoria`
  ADD CONSTRAINT `fk_id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_id_carrera` FOREIGN KEY (`id_carrera`) REFERENCES `categoria` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_tipo` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_usuario` (`id_tipo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
