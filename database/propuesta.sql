-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-02-2025 a las 02:53:57
-- Versión del servidor: 10.4.32-MariaDB-log
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `propuesta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `apellidos`, `telefono`) VALUES
(20, 'Juana', 'Vazquez', '7451022761'),
(30, 'César', 'Cruz Chavez', '5516181029'),
(31, 'Paola', 'Shakira', '7451043812'),
(32, 'Benito', 'Jaarez', '7441027151'),
(34, 'Sandra', 'Vazquez', '1231231231'),
(35, 'Juana', 'Vazquez', '1231231232'),
(36, 'Berna', 'Villazana', '5527351235'),
(37, 'Oscar Cruz', 'Chavez', '7412931928'),
(44, 'Camila', 'Sanchez', '7451043813'),
(45, 'Camila', 'Sanchez', '7451043813'),
(46, 'Rigoberto', 'Villazana', '7441201827'),
(47, 'Anahi', 'Zamora', '7441092837'),
(48, 'Elsa', 'Sanchez', '7451043813'),
(49, 'Benito', 'Zamora', '7441092837'),
(50, 'Camila', 'Sanchez', '7441092837'),
(51, 'Hector', 'Apolonio', '7441021527'),
(52, 'Apolinar ', 'Sanchez', '4543543536'),
(53, 'Camila', 'Diaz', '7441201827'),
(54, 'Benito', 'Sanchez', '7441021527'),
(55, 'Oscar', 'Cruz Chavez', '4543543536'),
(56, 'Mati', 'Gutierrez', '5561518726'),
(57, 'Camila', 'Juarez', '7441092837'),
(58, 'Camila', 'Vazquez', '7441092837'),
(59, 'SADSDA', 'SADSDA', '2353453453'),
(60, 'Camila', 'Juarez', '2321312312'),
(61, 'Camila', 'Diaz', '7441092837'),
(62, 'Camila', 'Juarez', '7451043813'),
(63, 'Rigoberto', 'Martinez Villazana', '7441201827'),
(64, 'Camila', 'Navarrete Cortes', '5345345454'),
(65, 'Yaritza', 'Aparicio', '7441021527'),
(66, 'Jesus', 'Bibiano Ramirez', '5543534543'),
(67, 'Ximena', 'Sanchez Perez', '5543534543'),
(68, 'Graciela', 'Garcia Martinez', '7413123231'),
(69, 'Benito', 'Juarez', '7564324234'),
(70, 'Patricia', 'Galvez Diaz', '7411212123'),
(71, 'Elsa', 'Silva Diaz', '7532353453'),
(72, 'Juan', 'Herrera Vazquez', '7443423423'),
(73, 'Maria', 'Hernandez', '7433231231'),
(74, 'Dylan', 'Carmona', '2223232131'),
(75, 'Camila', 'Villazana', '2223123123'),
(76, 'Apolinar', 'Tornez Diaz', '7412931928'),
(78, 'Katia', 'Nava', '7231231231'),
(79, 'Victor', 'Castro', '7442432432'),
(81, 'q', 'Juarez', '7451043813'),
(82, 'Benito', 'Juarez', '4543543536'),
(83, 'Hector', 'Polo', '7771627381'),
(85, 'Andres', 'Manuel', '4534353456'),
(86, 'Camila', 'Navarrete Cortes', '7451043813'),
(88, 'Camila', 'Villazana', '5543534543'),
(89, 'Antonio', 'Rodrigez', '7441231231'),
(90, 'Apolinar ', 'Tornez Diaz', '4543543536'),
(91, 'Rigoberto', 'Navarrete Cortes', '7771627381'),
(92, 'Camila', 'Sanchez', '7451043813'),
(93, 'Eduardo', 'Diaz', '4543543536'),
(94, 'Elsa', 'Zamora', '4543543536'),
(95, 'Oscar ', 'Cruz Chavez', '1122322321'),
(97, 'Ramora', 'Alvarado', '3254234524'),
(98, 'Ricardo', 'Nava', '4543543536'),
(99, 'Nanci', 'Cisnero', '6345345345'),
(100, 'Hector', 'Villazana', '7771627381'),
(102, 'Marco', 'Carrillo', '4543543536'),
(103, 'Hector', 'Sanchez', '4543543536'),
(106, 'WEREWR', 'EWRWER', '4543543536'),
(108, 'REPLICACION', 'test', '7451043813'),
(109, 'REPLICACION', 'TEST', '5561518726'),
(110, 'REPLICACION', 'TEST', '5561518726'),
(111, 'Nubia Jocelyn', 'Lopez', '7443441380'),
(112, 'Juana', 'Apolonio', '7412931928'),
(113, 'Lizbet', 'Carrillo', '7451043813'),
(114, 'Juan', 'Chavez', '7451043813'),
(115, 'Juana', 'xd', '4543543536');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `asuto` varchar(150) NOT NULL,
  `mensaje` text NOT NULL,
  `hora` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_habitacion`
--

CREATE TABLE `estado_habitacion` (
  `id` int(11) NOT NULL,
  `estado` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_habitacion`
--

INSERT INTO `estado_habitacion` (`id`, `estado`) VALUES
(1, 'Disponible'),
(2, 'Ocupado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `id` int(11) NOT NULL,
  `fecha_evento` date DEFAULT NULL,
  `num_personas` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`id`, `fecha_evento`, `num_personas`, `id_cliente`) VALUES
(20, '2024-11-01', 100, 93),
(21, '2024-11-09', 444, 94),
(22, '2024-10-10', 100, 95),
(23, '2024-11-05', 111, 103),
(27, '2025-04-13', 2, 111),
(28, '2024-12-05', 22, 112),
(29, '2024-12-07', 100, 113);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `precio_noche` decimal(10,2) DEFAULT NULL,
  `precio_renta` decimal(10,2) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `id_tipo_habitacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`id`, `nombre`, `precio_noche`, `precio_renta`, `id_estado`, `id_tipo_habitacion`) VALUES
(1, 'Habitación 1', 300.00, 1800.00, 1, 1),
(2, 'Habitación 2', 300.00, 1800.00, 1, 1),
(3, 'Habitación 3', 300.00, 1800.00, 1, 1),
(4, 'Habitación 4', 300.00, 1800.00, 1, 1),
(5, 'Habitación 5', 300.00, 1800.00, 1, 1),
(6, 'Habitación 6', 300.00, 1800.00, 1, 1),
(7, 'Habitación 7', 300.00, 1800.00, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `receiver` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`id`, `sender`, `receiver`, `message`, `timestamp`) VALUES
(42, 'Recepcionista', 'Administrador', 'a', '2024-11-12 19:53:05'),
(43, 'Administrador', 'Recepcionista', 'a', '2024-11-12 19:53:12'),
(44, 'Recepcionista', 'Administrador', 'AA', '2024-11-12 19:58:15'),
(45, 'Recepcionista', 'Administrador', 'hOLLA', '2024-11-12 20:00:32'),
(46, 'Recepcionista', 'Administrador', 'hOOLAA', '2024-11-12 20:02:32'),
(47, 'Administrador', 'Recepcionista', 'kk', '2024-11-12 20:04:04'),
(48, 'Recepcionista', 'Administrador', 'MM', '2024-11-12 20:04:12'),
(49, 'Administrador', 'Recepcionista', 'jj', '2024-11-12 20:05:47'),
(50, 'Recepcionista', 'Administrador', 'kk', '2024-11-12 20:10:55'),
(51, 'Recepcionista', 'Administrador', 'G', '2024-11-12 20:11:50'),
(52, 'Administrador', 'Recepcionista', 'Hola', '2024-11-12 20:20:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_habitacion` int(11) DEFAULT NULL,
  `fecha_llegada` date DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  `total_adultos` int(11) DEFAULT NULL,
  `total_ninos` int(11) DEFAULT NULL,
  `total_pagar` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `id_cliente`, `id_habitacion`, `fecha_llegada`, `fecha_salida`, `total_adultos`, `total_ninos`, `total_pagar`) VALUES
(28, 30, 5, '2024-10-10', '2024-10-12', 3, 1, 650.00),
(29, 31, 2, '2024-10-19', '2024-10-20', 3, 2, 350.00),
(30, 32, 1, '2024-10-13', '2024-10-14', 3, 1, 350.00),
(32, 34, 2, '2024-10-13', '2024-10-14', 3, 1, 350.00),
(33, 35, 6, '2024-10-13', '2024-10-14', 1, 2, 300.00),
(34, 36, 1, '2024-10-20', '2024-10-21', 1, 0, 300.00),
(35, 37, 4, '2024-10-20', '2024-10-22', 11, 2, 1050.00),
(42, 63, 1, '2024-09-01', '2024-09-04', 2, 1, 900.00),
(43, 64, 2, '2024-09-01', '2024-10-04', 3, 1, 1850.00),
(44, 65, 3, '2024-09-07', '2024-09-10', 3, 1, 950.00),
(45, 66, 4, '2024-09-17', '2024-09-18', 2, 1, 300.00),
(46, 67, 7, '2024-09-18', '2024-09-21', 1, 0, 900.00),
(47, 68, 4, '2024-09-27', '2024-09-30', 2, 1, 900.00),
(48, 69, 5, '2024-09-13', '2024-09-18', 2, 2, 1500.00),
(49, 70, 3, '2024-09-21', '2024-09-27', 2, 1, 1800.00),
(50, 71, 1, '2024-09-18', '2024-09-23', 2, 2, 1500.00),
(51, 72, 5, '2024-09-25', '2024-09-26', 1, 1, 300.00),
(52, 73, 1, '2024-10-01', '2024-10-02', 1, 0, 300.00),
(53, 74, 3, '2024-10-05', '2024-10-06', 3, 1, 350.00),
(54, 75, 7, '2024-10-25', '2024-10-26', 1, 0, 300.00),
(55, 76, 5, '2024-10-19', '2024-10-21', 4, 1, 700.00),
(57, 78, 6, '2024-10-01', '2024-10-04', 1, 0, 900.00),
(58, 79, 3, '2024-10-19', '2024-10-22', 2, 2, 900.00),
(60, 62, 2, '2024-10-29', '2024-10-31', 1, 1, 0.00),
(61, 83, 7, '2024-11-01', '2024-11-02', 1, 1, 300.00),
(63, 85, 6, '2024-11-01', '2024-11-02', 3, 1, 350.00),
(65, 88, 2, '2024-11-08', '2024-11-09', 3, 1, 350.00),
(66, 89, 2, '2024-11-01', '2024-11-02', 1, 1, 300.00),
(67, 90, 5, '2024-11-04', '2024-11-06', 1, 1, 600.00),
(68, 91, 1, '2024-10-31', '2024-11-02', 1, 1, 600.00),
(70, 97, 7, '2024-11-08', '2024-11-09', 1, 1, 300.00),
(71, 98, 2, '2024-11-14', '2024-11-15', 1, 1, 300.00),
(72, 99, 2, '2024-11-12', '2024-11-13', 1, 0, 300.00),
(73, 100, 7, '2024-11-06', '2024-11-07', 3, 1, 350.00),
(75, 102, 1, '2024-11-23', '2024-11-24', 1, 1, 300.00),
(79, 114, 1, '2024-12-31', '2025-01-01', 4, 1, 400.00),
(80, 115, 2, '2025-01-07', '2025-01-07', 2, 2, 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`) VALUES
(1, 'Recepcionista'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_habitacion`
--

CREATE TABLE `tipo_habitacion` (
  `id` int(11) NOT NULL,
  `tipo` enum('renta','noches') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_habitacion`
--

INSERT INTO `tipo_habitacion` (`id`, `tipo`) VALUES
(1, 'renta'),
(2, 'noches');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contrasena`, `id_rol`) VALUES
(3, 'Oscar', 'oscar@gmail.com', '$2y$10$Mdu0NzU/7uXnYsrnKSpty.EG1KD9ilNvIVK3cFjChTBw3wZDIUxCO', 2),
(5, 'Oscar', 'oscarch2002@gmail.com', '$2y$10$oz9YgE936gHb9G0f0dPRb.6L/59tVFXE155hAgArX.a5VHya2XjLa', 1),
(6, 'recepcionista', 'recepcionista@gmail.com', '$2y$10$cI22NphJBJIZFP66uTPg4uUvVcgEdMbeX8MC0jQWqYmT3hUjh70YO', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_habitacion`
--
ALTER TABLE `estado_habitacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evento_ibfk_1` (`id_cliente`);

--
-- Indices de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `id_tipo_habitacion` (`id_tipo_habitacion`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_habitacion` (`id_habitacion`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_habitacion`
--
ALTER TABLE `tipo_habitacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estado_habitacion`
--
ALTER TABLE `estado_habitacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_habitacion`
--
ALTER TABLE `tipo_habitacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`);

--
-- Filtros para la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD CONSTRAINT `habitacion_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado_habitacion` (`id`),
  ADD CONSTRAINT `habitacion_ibfk_2` FOREIGN KEY (`id_tipo_habitacion`) REFERENCES `tipo_habitacion` (`id`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `reservas_ibfk_3` FOREIGN KEY (`id_habitacion`) REFERENCES `habitacion` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
