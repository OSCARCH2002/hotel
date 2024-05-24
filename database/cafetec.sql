-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2024 a las 19:40:45
-- Versión del servidor: 8.0.27
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cafetec`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int NOT NULL,
  `cantidad` int NOT NULL,
  `fecha_pedido` date NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `FK_comida` int NOT NULL,
  `FK_usuario` int NOT NULL,
  `tipo_comida` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id`, `cantidad`, `fecha_pedido`, `total`, `FK_comida`, `FK_usuario`, `tipo_comida`) VALUES
(161, 3, '2024-05-20', 75, 14, 2, 'Sándwich');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comida`
--

CREATE TABLE `comida` (
  `id` int NOT NULL,
  `productos` varchar(50) NOT NULL,
  `precio` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `comida`
--

INSERT INTO `comida` (`id`, `productos`, `precio`) VALUES
(1, 'Tacos cecina', 15),
(2, 'Tacos deChicharron', 15),
(3, 'Tacos de arroz con huevo', 15),
(4, 'Tacos de chorizo', 15),
(5, 'Tacos de mole', 15),
(6, 'Tacos de barbacoa', 15),
(7, 'Sopes de pollo', 15),
(8, 'Sopes de chorizo', 15),
(9, 'Sopes de tinga', 15),
(10, 'Sopes de Oaxaca', 15),
(11, 'Torta de Salchicha', 40),
(12, 'Torta de jamon', 40),
(13, 'Tostadas', 40),
(14, 'Sandwich', 25),
(15, 'Spaguetti con Nuggets', 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE `estatus` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `estatus`
--

INSERT INTO `estatus` (`id`, `nombre`) VALUES
(2, 'pendiente'),
(3, 'en_proceso'),
(4, 'entregado'),
(5, 'cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int NOT NULL,
  `numero_pedido` varchar(100) DEFAULT NULL,
  `cantidad` int NOT NULL,
  `fecha_pedido` date NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `FK_estatus` int NOT NULL,
  `FK_comida` int NOT NULL,
  `FK_usuario` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `numero_pedido`, `cantidad`, `fecha_pedido`, `total`, `FK_estatus`, `FK_comida`, `FK_usuario`) VALUES
(46, '20240520162100-1-5195', 3, '2024-05-20', 120, 2, 13, 1),
(47, '20240520162100-1-7041', 1, '2024-05-20', 25, 2, 14, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`) VALUES
(1, 'estudiante'),
(2, 'maestro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `identificacion` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `id_rol` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `identificacion`, `contrasena`, `id_rol`) VALUES
(1, 'Oscar', '211230019', 'och2002ch', 1),
(2, 'Apolinar', '211230017', 'polo', 1),
(3, 'LIzbet', '211230018', 'liz', 1),
(4, 'Hermenegildo', 'VECJ880100', 'hermes', 2),
(6, 'Leonardo', 'VECJ880200', 'leo', 2),
(7, 'Victor', '211230001', '12345', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_comida` (`FK_comida`),
  ADD KEY `FK_usuario` (`FK_usuario`);

--
-- Indices de la tabla `comida`
--
ALTER TABLE `comida`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_pedido` (`numero_pedido`),
  ADD KEY `FK_estatus` (`FK_estatus`),
  ADD KEY `FK_comida` (`FK_comida`),
  ADD KEY `FK_usuario` (`FK_usuario`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
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
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT de la tabla `comida`
--
ALTER TABLE `comida`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`FK_comida`) REFERENCES `comida` (`id`),
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`FK_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`FK_estatus`) REFERENCES `estatus` (`id`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`FK_comida`) REFERENCES `comida` (`id`),
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`FK_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
