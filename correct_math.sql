-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-01-2025 a las 03:16:46
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `correct_math`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `Id_Actividad` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text NOT NULL,
  `Id_Profesor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Actividad de los alumnos';

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`Id_Actividad`, `Nombre`, `Descripcion`, `Id_Profesor`) VALUES
(1, 'Actividad 1', 'Descripción de la actividad 1', 1),
(2, 'Actividad 2', 'Descripción de la actividad 2', 2),
(3, 'Actividad 3', 'Descripción de la actividad 3', 1),
(4, 'Actividad 4', 'Descripción de la actividad 4', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id_alumno` int(11) NOT NULL COMMENT 'Primary Key',
  `create_time` datetime DEFAULT NULL COMMENT 'Create Time',
  `Nombre_A` varchar(255) DEFAULT NULL COMMENT 'Name'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla de Alumnos';

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id_alumno`, `create_time`, `Nombre_A`) VALUES
(1, '0000-00-00 00:00:00', 'Raul B.'),
(2, '2025-01-03 17:54:22', 'Cindy p.'),
(3, NULL, 'Maria A.'),
(4, NULL, 'Luis B.'),
(5, NULL, 'Marcos E.'),
(6, NULL, 'Juana H.'),
(7, NULL, 'Enrique E.'),
(8, NULL, 'Carlos I.'),
(9, NULL, 'Enrique H.'),
(10, NULL, 'Carolina H.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `Id_Equipo` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Id_Profesor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla de Equiipo';

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`Id_Equipo`, `Nombre`, `Id_Profesor`) VALUES
(1, 'Alpha Centauri', 1),
(2, 'Escuadra', 1),
(3, 'Geometricos', 1),
(4, 'Circuferencios', 2),
(5, 'Calculadores', 2),
(6, 'ickkck', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo_alumno`
--

CREATE TABLE `equipo_alumno` (
  `Id_Equipo` int(11) NOT NULL,
  `Id_Alumno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Relación muchos a muchos entre Equipo y Alumno';

--
-- Volcado de datos para la tabla `equipo_alumno`
--

INSERT INTO `equipo_alumno` (`Id_Equipo`, `Id_Alumno`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 5),
(3, 6),
(4, 7),
(4, 8),
(5, 9),
(5, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evidencia`
--

CREATE TABLE `evidencia` (
  `Id_Evidencia` int(11) NOT NULL,
  `Archivo` text NOT NULL,
  `Id_Actividad` int(11) NOT NULL,
  `Id_Pregunta` int(11) DEFAULT NULL,
  `Id_Respuesta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Evidencias de los Usuarios';

--
-- Volcado de datos para la tabla `evidencia`
--

INSERT INTO `evidencia` (`Id_Evidencia`, `Archivo`, `Id_Actividad`, `Id_Pregunta`, `Id_Respuesta`) VALUES
(1, 'evidencia1.pdf', 1, 1, 1),
(2, 'evidencia2.pdf', 2, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `Id_Pregunta` int(11) NOT NULL,
  `Tiempo` int(11) NOT NULL,
  `Pregunta` text NOT NULL,
  `Id_Actividad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla Actividad';

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`Id_Pregunta`, `Tiempo`, `Pregunta`, `Id_Actividad`) VALUES
(1, 60, '¿Cuál es la capital de Francia?', 1),
(2, 160, '¿Cuánto es 2 + 2?', 2),
(13, 60, '¿Cuál es la capital de España?', 1),
(14, 45, '¿Cuánto es 5 + 7?', 1),
(15, 30, '¿Quién escribió \"Cien años de soledad\"?', 1),
(16, 50, '¿Cuál es el símbolo químico del agua?', 1),
(17, 40, '¿En qué año llegó el hombre a la luna?', 1),
(18, 55, '¿Cuál es el océano más grande del mundo?', 2),
(19, 35, '¿Qué planeta es conocido como el planeta rojo?', 2),
(20, 60, '¿Quién pintó la Mona Lisa?', 1),
(21, 45, '¿Qué idioma se habla en Brasil?', 2),
(22, 30, '¿Cuál es el río más largo del mundo?', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `Id_Profesor` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Correo` varchar(100) NOT NULL,
  `Contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla de Profesor';

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`Id_Profesor`, `Nombre`, `Correo`, `Contraseña`) VALUES
(1, 'Juan Carlos D.', 'juan@gmail.com', '1234'),
(2, 'Pablo Sánchez.', 'pablo@gmail.com', 'abcd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `Id_Respuesta` int(11) NOT NULL,
  `Respuesta` text NOT NULL,
  `Correcta` tinyint(1) NOT NULL,
  `Id_Pregunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla de las Respuestas de los Us';

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`Id_Respuesta`, `Respuesta`, `Correcta`, `Id_Pregunta`) VALUES
(1, 'París', 0, 1),
(2, 'Madrid', 0, 1),
(3, '4', 1, 2),
(4, '5', 1, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`Id_Actividad`),
  ADD KEY `Id_Profesor` (`Id_Profesor`);

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id_alumno`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`Id_Equipo`),
  ADD KEY `Id_Profesor` (`Id_Profesor`);

--
-- Indices de la tabla `equipo_alumno`
--
ALTER TABLE `equipo_alumno`
  ADD PRIMARY KEY (`Id_Equipo`,`Id_Alumno`),
  ADD KEY `Id_Alumno` (`Id_Alumno`);

--
-- Indices de la tabla `evidencia`
--
ALTER TABLE `evidencia`
  ADD PRIMARY KEY (`Id_Evidencia`),
  ADD KEY `Id_Actividad` (`Id_Actividad`),
  ADD KEY `Id_Pregunta` (`Id_Pregunta`),
  ADD KEY `Id_Respuesta` (`Id_Respuesta`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`Id_Pregunta`),
  ADD KEY `Id_Actividad` (`Id_Actividad`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`Id_Profesor`),
  ADD UNIQUE KEY `Correo` (`Correo`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`Id_Respuesta`),
  ADD KEY `Id_Pregunta` (`Id_Pregunta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `Id_Actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `Id_Equipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `evidencia`
--
ALTER TABLE `evidencia`
  MODIFY `Id_Evidencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `Id_Pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `Id_Profesor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `Id_Respuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `actividad_ibfk_1` FOREIGN KEY (`Id_Profesor`) REFERENCES `profesores` (`Id_Profesor`) ON DELETE CASCADE;

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `equipos_ibfk_1` FOREIGN KEY (`Id_Profesor`) REFERENCES `profesores` (`Id_Profesor`) ON DELETE CASCADE;

--
-- Filtros para la tabla `equipo_alumno`
--
ALTER TABLE `equipo_alumno`
  ADD CONSTRAINT `equipo_alumno_ibfk_1` FOREIGN KEY (`Id_Alumno`) REFERENCES `alumnos` (`id_alumno`) ON DELETE CASCADE,
  ADD CONSTRAINT `equipo_alumno_ibfk_2` FOREIGN KEY (`Id_Equipo`) REFERENCES `equipos` (`Id_Equipo`);

--
-- Filtros para la tabla `evidencia`
--
ALTER TABLE `evidencia`
  ADD CONSTRAINT `evidencia_ibfk_1` FOREIGN KEY (`Id_Actividad`) REFERENCES `actividad` (`Id_Actividad`) ON DELETE CASCADE,
  ADD CONSTRAINT `evidencia_ibfk_2` FOREIGN KEY (`Id_Pregunta`) REFERENCES `pregunta` (`Id_Pregunta`) ON DELETE CASCADE,
  ADD CONSTRAINT `evidencia_ibfk_3` FOREIGN KEY (`Id_Respuesta`) REFERENCES `respuesta` (`Id_Respuesta`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `pregunta_ibfk_1` FOREIGN KEY (`Id_Actividad`) REFERENCES `actividad` (`Id_Actividad`) ON DELETE CASCADE;

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `respuesta_ibfk_1` FOREIGN KEY (`Id_Pregunta`) REFERENCES `pregunta` (`Id_Pregunta`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
