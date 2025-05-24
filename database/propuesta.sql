CREATE TABLE `cliente` (
  `id` int NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `apellidos` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefono` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `contacto` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `asuto` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `mensaje` text COLLATE utf8mb4_general_ci NOT NULL,
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `contacto` (`id`, `name`, `correo`, `asuto`, `mensaje`, `hora`) VALUES
(5, 'Lizbet', 'lizbet@gmail.com', 'test', 'mensaje de prueba aver si funciona\r\n', '2025-05-07 19:45:49'),
(8, 'Oscar Cruz Chavez', '2313212132133@gmail.com', 'DUDA', 'd', '2025-05-11 03:24:55');

CREATE TABLE `estado_habitacion` (
  `id` int NOT NULL,
  `estado` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `estado_habitacion` (`id`, `estado`) VALUES
(1, 'Disponible'),
(2, 'Ocupado');

CREATE TABLE `evento` (
  `id` int NOT NULL,
  `fecha_evento` date DEFAULT NULL,
  `num_personas` int DEFAULT NULL,
  `id_cliente` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `habitacion` (
  `id` int NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `precio_noche` decimal(10,2) DEFAULT NULL,
  `precio_renta` decimal(10,2) DEFAULT NULL,
  `id_estado` int DEFAULT NULL,
  `id_tipo_habitacion` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `habitacion` (`id`, `nombre`, `precio_noche`, `precio_renta`, `id_estado`, `id_tipo_habitacion`) VALUES
(1, 'Habitación 1', 300.00, 1800.00, 1, 1),
(2, 'Habitación 2', 300.00, 1800.00, 1, 1),
(3, 'Habitación 3', 300.00, 1800.00, 1, 1),
(4, 'Habitación 4', 300.00, 1800.00, 1, 1),
(5, 'Habitación 5', 300.00, 1800.00, 1, 1),
(6, 'Habitación 6', 300.00, 1800.00, 1, 1),
(7, 'Habitación 7', 300.00, 1800.00, 1, 1);

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `sender` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `puntos` (
  `ID_Puntos` int NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellidos` varchar(100) NOT NULL,
  `Telefono` bigint NOT NULL,
  `Contrasena` varchar(100) NOT NULL,
  `Correo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `resenas` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `calificacion` int NOT NULL,
  `comentario` text NOT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP
) ;

INSERT INTO `resenas` (`id`, `nombre`, `calificacion`, `comentario`, `fecha`) VALUES
(13, 'Oscar Cruz Chavez', 5, 'La habitación me sorprendió mucho. Era amplia, muy limpia y con una decoración sencilla pero acogedora, el cuarto estaba bastente limpio :D.\r\n', '2025-05-10 15:52:24'),
(14, 'Apolinar Tornez Diaz', 5, 'Excelente Servicio', '2025-05-10 19:43:27'),
(15, 'Lizbet ', 1, 'Estan sucios los cuartos.\r\n', '2025-05-20 07:37:45');

CREATE TABLE `reservas` (
  `id` int NOT NULL,
  `id_cliente` int DEFAULT NULL,
  `id_habitacion` int DEFAULT NULL,
  `fecha_llegada` date DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  `total_adultos` int DEFAULT NULL,
  `total_ninos` int DEFAULT NULL,
  `total_pagar` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `rol` (
  `id` int NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `rol` (`id`, `nombre`) VALUES
(1, 'Recepcionista'),
(2, 'Administrador');

CREATE TABLE `tipo_habitacion` (
  `id` int NOT NULL,
  `tipo` enum('renta','noches') COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tipo_habitacion` (`id`, `tipo`) VALUES
(1, 'renta'),
(2, 'noches');
CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `correo` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contrasena` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_rol` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contrasena`, `id_rol`) VALUES
(3, 'Oscar', 'oscar@gmail.com', '$2y$10$Mdu0NzU/7uXnYsrnKSpty.EG1KD9ilNvIVK3cFjChTBw3wZDIUxCO', 2),
(5, 'Oscar', 'oscarch2002@gmail.com', '$2y$10$oz9YgE936gHb9G0f0dPRb.6L/59tVFXE155hAgArX.a5VHya2XjLa', 1),
(6, 'recepcionista', 'recepcionista@gmail.com', '$2y$10$cI22NphJBJIZFP66uTPg4uUvVcgEdMbeX8MC0jQWqYmT3hUjh70YO', 1);

CREATE TABLE `promociones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_general_ci NOT NULL,
  `descuento` decimal(5,2) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `estado` enum('activa','inactiva') COLLATE utf8mb4_general_ci DEFAULT 'activa',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estructura de tabla para la tabla `promociones_habitaciones`
--

CREATE TABLE `promociones_habitaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_habitacion` int(11) NOT NULL,
  `descuento` decimal(5,2) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `descripcion` text NOT NULL,
  `estado` enum('activa','inactiva') NOT NULL DEFAULT 'activa',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_habitacion` (`id_habitacion`),
  CONSTRAINT `promociones_habitaciones_ibfk_1` FOREIGN KEY (`id_habitacion`) REFERENCES `habitacion` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `estado_habitacion`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evento_ibfk_1` (`id_cliente`);
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `id_tipo_habitacion` (`id_tipo_habitacion`);
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `puntos`
  ADD PRIMARY KEY (`ID_Puntos`);
ALTER TABLE `resenas`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_habitacion` (`id_habitacion`);

ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tipo_habitacion`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rol` (`id_rol`);

ALTER TABLE `cliente`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

ALTER TABLE `contacto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `estado_habitacion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `evento`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

ALTER TABLE `habitacion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

ALTER TABLE `resenas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `reservas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

ALTER TABLE `rol`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `tipo_habitacion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
ALTER TABLE `habitacion`
  ADD CONSTRAINT `habitacion_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado_habitacion` (`id`),
  ADD CONSTRAINT `habitacion_ibfk_2` FOREIGN KEY (`id_tipo_habitacion`) REFERENCES `tipo_habitacion` (`id`);
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`);
COMMIT;