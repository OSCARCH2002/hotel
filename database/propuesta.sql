-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-04-2025 a las 05:03:41
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
(115, 'Juana', 'xd', '4543543536'),
(116, 'Hector', 'Perez Rosalez', '5435435435'),
(117, 'Mario', 'Juárez', '6547833200'),
(118, 'Margarita', 'Villazana Campos', '7452313213'),
(119, 'Karina', 'Sanchez Benitez', '5345345435'),
(120, 'Carlos', 'Vázquez García', '5567895411'),
(121, 'Norbella', 'Santana Silva', '7442321432'),
(122, 'Paula', 'Silva Olea', '7458213782'),
(123, 'Marta', 'Ramirez Rodriguez', '7412249988'),
(124, 'Elsa', 'Silva Olea', '5528548433'),
(125, 'Luis', 'Diaz Catalan', '7442312312'),
(126, 'Diana', 'Cantú García', '7456613976'),
(127, 'Amelia', 'Silva Catalan', '7423243324'),
(128, 'Lizbet', 'Carrillo Calixto', '5576766843'),
(129, 'Emilio', 'García López', '7442309116'),
(130, 'Nanci', 'Cisneros Perez', '7442143214'),
(131, 'Andrés', 'Martínez López', '5567432201'),
(132, 'Matias', 'Zamora Catalan', '5532112312'),
(133, 'Victor', 'Villanueva', '7475561200'),
(134, 'Gila', 'Bailon Salazar', '7452132142'),
(135, 'Lina', 'Crisostomo', '7478890122'),
(136, 'Noemi', 'Cabrera Nava', '7442142343'),
(137, 'Lilie', 'Vazquez Cruz', '7413360987'),
(138, 'Marcos', 'Sanchez', '7449002189'),
(139, 'César', 'Martinez Sanchez', '5546780022'),
(140, 'Nanci', 'Diaz Catalan', '7771627381'),
(141, 'Isabel', 'Gonzalez Perez', '7476652134'),
(142, 'Osmar', 'Casildo Cruz', '7442432432'),
(143, 'Matias', 'Diaz Catalan', '7771627381'),
(144, 'Félix', 'Pérez Quesada', '7445562175'),
(145, 'Misael', 'Huerta', '7412209521'),
(146, 'Gabriela', 'Villanueva Lopez', '5527387612'),
(147, 'Luz', 'García', '7443321973'),
(148, 'Moises', 'Juárez García', '7456621982'),
(149, 'Dylan', 'Cisneros', '7771627383'),
(150, 'Claudia', 'Sanchez', '7412239801'),
(151, 'Elsida ', 'Chavez Silva ', '7451946513'),
(152, 'Oscar ', 'Cruz Chavez ', '7545546464'),
(153, 'Héctor ', 'Morales', '2484646464'),
(154, 'Natalia ', 'Héctor Nava', '7451946513'),
(155, 'Juan ', 'Sánchez ', '5464646464'),
(156, 'Tania ', 'García ', '7451946513'),
(157, 'Omar ', 'Gallardo ', '7545546464'),
(158, 'Hana', 'Villa ', '8454646451'),
(159, 'Paola', 'Benítez ', '5545484545'),
(160, 'Yuridia ', 'García Pérez ', '6464645451'),
(161, 'Yuridia ', 'Cruz Chavez ', '5545545454'),
(162, 'Matías ', 'Cisneros ', '5554545454'),
(163, 'Maricela ', 'Carmen ', '5545455445'),
(164, 'Walyln ', 'Villanueva ', '7455454545'),
(165, 'Rocío ', 'Ramírez ', '7455454545'),
(166, 'Tania ', 'Tornez ', '7545454554'),
(167, 'Yasmin ', 'Yarey', '7545454545'),
(168, 'Ulises ', 'Chaidez ', '7451946513'),
(169, 'Irma ', 'Liaría ', '5554554545'),
(170, 'Perla ', 'Heredia ', '7454545455'),
(171, 'Amelía ', 'Cortez ', '5454545454'),
(172, 'Silvia ', 'Solano ', '5545454545'),
(173, 'Soila ', 'Solano ', '5455454545'),
(174, 'Danna', 'Excaret', '5545455454'),
(175, 'Danna ', 'Tornez ', '5454554545'),
(176, 'Gallardo ', 'Heraldo ', '6464545455'),
(177, 'Kenia ', 'Juárez ', '8454545454'),
(178, 'Luisa ', 'López ', '5545545454'),
(179, 'Ñoño', 'Manuel ', '7444545454'),
(180, 'Ximena', 'Zamora ', '7455454545'),
(181, 'Miriam ', 'Marciano ', '5454545454'),
(182, 'Elsida', 'Chavez', '7451946513'),
(183, 'Andrés', 'Andrés', '5345345435'),
(184, 'arolina López', ' López', '7442432432'),
(185, 'arolina López', ' López', '3465346546'),
(186, 'arolina López', 'López', '5543534543'),
(187, 'Miguel', 'Miguel', '7452131231'),
(188, 'Miguel', 'Miguel', '7771627381'),
(189, 'Daniela ', 'Vargas', '5534254354'),
(190, 'Sergio ', 'Ramírez', '7412412413'),
(191, 'Lucía ', 'Fernández', '2312312312'),
(192, 'Alejandro ', 'Torres', '4521432432'),
(193, 'Valeria ', 'Mendoza', '7414323432'),
(194, 'Pablo ', 'Gutiérrez', '5525341423'),
(195, 'Matias', 'Gutiérrez', '5561518726'),
(196, 'Valeria', 'Mendoza', '7324324234'),
(197, 'Elisa', 'Godínez', '7452423432'),
(198, 'Bruno', 'Tapia', '5561518726'),
(199, 'Ignacio', 'Fonseca', '6456456546'),
(200, 'Antonia', 'Ríos', '7451421343'),
(201, 'Antonia', 'Ríos', '7441241343'),
(202, 'Vanessa', 'Beltrán', '7452343242'),
(203, 'Hugo', 'Aranda', '7442432432'),
(204, 'Dylan', 'Diaz Catalan', '7442432432'),
(205, 'Olivares', 'Lopez', '7412931928'),
(206, 'Matias', 'Cisneros', '7771627381'),
(207, 'Ángel', 'Villanueva', '5555345435'),
(208, 'Camilo', 'Benítez', '4634534534'),
(209, 'Esteban', 'Serrano', '5325354353'),
(210, 'Claudia', 'Sepúlveda', '5561518726'),
(211, 'Ignacio', 'Fonseca', '7444343243'),
(212, 'Natalia', 'Guzmán', '3452354543'),
(213, 'cleotilde', 'castro', '7456928321'),
(214, 'Carolina', 'Diaz', '7451627182'),
(215, 'Juan', 'Martinez', '4421234567'),
(216, 'Maria', 'Lopez', '5559876543'),
(217, 'Carlos', 'Mendez', '8182535673'),
(218, 'Fernanda', 'Torres', '7451230089'),
(219, 'Alejandro', 'Gutierrez', '7461765451'),
(220, 'Sofia', 'Herrera', '7451230945'),
(221, 'Luis', 'Vargas', '7456542345'),
(222, 'Roberto', 'Salazar', '7561230045'),
(223, 'Andrea ', 'Molina', '7561230016'),
(224, 'Crecenciana', 'Florencio', '7647382827'),
(225, 'Guadalupe', 'Flores', '6371721234'),
(226, 'Estefania', 'Rodriguez', '1234567891'),
(227, 'Carlos', 'Herrera', '7651230987'),
(228, 'Larry', 'Garcia', '2341234563'),
(229, 'Lizet', 'Hernandez', '7451432301'),
(230, 'Fenado', 'Cartajena', '1234567891'),
(231, 'Oscar', 'Navarrete', '7647382827'),
(232, 'Rigo', 'Castro', '5434324243'),
(233, 'Pancracio', 'Hermenegildo', '7451144552'),
(234, 'Rosa', 'Diaz', '6785432100'),
(235, 'Chano', 'Maganda', '3232114534'),
(236, 'Lucia', 'Molina', '3882716512');

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
(29, '2024-12-07', 100, 113),
(30, '2025-04-03', 133, 151),
(31, '2025-03-13', 133, 152),
(32, '2025-02-14', 35, 153),
(33, '2025-03-14', 133, 154),
(34, '2025-03-28', 111, 155),
(35, '2025-02-15', 31, 156),
(36, '2025-01-17', 200, 157),
(37, '2025-02-08', 200, 158),
(38, '2025-01-25', 199, 159),
(39, '2025-02-20', 33, 161),
(40, '2025-01-13', 200, 162),
(41, '2025-03-31', 90, 163),
(42, '2025-02-22', 135, 164),
(43, '2025-03-15', 136, 165),
(44, '2025-01-03', 75, 166),
(45, '2025-02-24', 200, 168),
(46, '2025-01-22', 197, 169),
(47, '2025-01-26', 131, 170),
(48, '2025-03-20', 137, 171),
(49, '2025-02-28', 121, 172),
(50, '2025-03-30', 136, 173),
(51, '2025-03-27', 22, 176),
(52, '2025-02-21', 131, 177),
(53, '2025-01-05', 200, 178),
(54, '2025-04-12', 63, 179),
(55, '2025-03-03', 200, 180),
(56, '2025-02-07', 69, 181),
(57, '2025-04-18', 31, 183),
(58, '2025-01-01', 112, 186),
(59, '2025-01-19', 123, 188),
(60, '2025-02-27', 43, 189),
(61, '2025-02-09', 23, 190),
(62, '2025-02-10', 12, 191),
(63, '2025-03-02', 12, 192),
(64, '2025-03-09', 22, 193),
(65, '2025-04-19', 22, 194),
(66, '2023-01-10', 80, 201),
(67, '2023-02-15', 120, 202),
(68, '2023-03-20', 60, 203),
(69, '2023-04-25', 90, 204),
(70, '2023-05-30', 150, 205),
(71, '2023-06-12', 200, 206),
(72, '2023-07-18', 110, 207),
(73, '2023-08-22', 95, 208),
(74, '2023-09-27', 130, 209),
(75, '2023-10-31', 170, 210),
(76, '2023-11-15', 140, 211),
(77, '2023-12-20', 180, 212),
(78, '2024-01-05', 85, 213),
(79, '2024-02-14', 100, 214),
(80, '2024-03-19', 115, 215),
(81, '2024-04-25', 160, 216),
(82, '2024-05-30', 175, 217),
(83, '2024-06-10', 125, 218),
(84, '2024-07-15', 140, 219),
(85, '2024-08-20', 190, 220),
(86, '2024-09-25', 155, 221),
(87, '2024-10-30', 135, 222),
(88, '2024-11-10', 145, 223),
(89, '2024-12-15', 200, 224),
(90, '2024-01-22', 105, 225),
(91, '2024-02-28', 165, 226),
(92, '2024-03-15', 185, 227),
(93, '2024-04-29', 95, 228),
(94, '2024-05-18', 175, 229),
(95, '2024-06-25', 220, 230),
(96, '2023-07-05', 90, 231),
(97, '2023-08-12', 110, 232),
(98, '2023-09-20', 130, 233),
(99, '2023-10-25', 150, 234),
(100, '2023-11-30', 175, 235),
(101, '2023-12-18', 200, 236),
(102, '2024-01-08', 85, 237),
(103, '2024-02-22', 120, 238),
(104, '2024-03-28', 140, 239),
(105, '2024-04-15', 160, 240),
(106, '2024-05-20', 180, 241),
(107, '2024-06-30', 190, 242),
(108, '2024-07-12', 100, 243),
(109, '2024-08-25', 115, 244),
(110, '2024-09-10', 135, 245),
(111, '2024-10-20', 155, 246),
(112, '2024-11-28', 170, 247),
(113, '2024-12-05', 195, 248),
(114, '2024-01-15', 210, 249),
(115, '2024-02-25', 225, 250),
(116, '2024-02-06', 100, 213),
(117, '2024-01-10', 200, 214),
(118, '2023-04-07', 200, 215),
(119, '2024-09-22', 100, 216),
(120, '2023-05-03', 200, 217),
(121, '2024-11-12', 200, 218),
(122, '2023-04-12', 100, 219),
(123, '2024-08-08', 150, 220),
(124, '2023-12-17', 180, 221),
(125, '2023-08-30', 140, 222),
(126, '2023-10-14', 169, 223),
(127, '2023-09-02', 156, 224),
(128, '2023-09-05', 100, 225),
(129, '2024-07-07', 123, 226),
(130, '2024-12-12', 200, 227),
(131, '2023-01-13', 170, 228),
(132, '2023-12-31', 123, 229),
(133, '2024-12-23', 200, 230),
(134, '2024-01-29', 200, 231),
(135, '2023-02-28', 123, 232),
(136, '2024-03-21', 200, 233),
(137, '2024-05-10', 200, 234),
(138, '2024-09-09', 200, 235),
(139, '2023-08-20', 200, 236);

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
(80, 115, 2, '2025-01-07', '2025-01-07', 2, 2, 0.00),
(81, 116, 2, '2025-01-04', '2025-01-05', 3, 1, 350.00),
(82, 117, 3, '2025-03-01', '2025-03-02', 3, 1, 350.00),
(83, 118, 1, '2025-01-04', '2025-01-07', 1, 1, 900.00),
(84, 119, 1, '2025-01-10', '2025-01-14', 4, 1, 1300.00),
(85, 120, 2, '2025-02-02', '2025-02-05', 2, 1, 900.00),
(86, 121, 7, '2025-01-24', '2025-01-30', 3, 2, 1850.00),
(87, 122, 4, '2025-01-23', '2025-01-26', 2, 2, 900.00),
(88, 123, 1, '2025-02-05', '2025-02-07', 3, 0, 650.00),
(89, 124, 4, '2025-01-17', '2025-01-19', 1, 1, 600.00),
(90, 125, 6, '2025-01-23', '2025-01-25', 2, 1, 600.00),
(91, 126, 5, '2025-02-07', '2025-02-09', 2, 2, 600.00),
(92, 127, 3, '2025-01-11', '2025-01-14', 4, 1, 1000.00),
(93, 128, 5, '2025-01-25', '2025-01-27', 3, 2, 650.00),
(94, 129, 3, '2025-02-12', '2025-02-13', 2, 0, 300.00),
(95, 130, 4, '2025-01-05', '2025-01-08', 1, 2, 900.00),
(96, 131, 6, '2025-02-13', '2025-02-16', 1, 0, 900.00),
(97, 132, 3, '2025-01-17', '2025-01-19', 3, 1, 650.00),
(98, 133, 5, '2025-02-19', '2025-03-20', 2, 1, 8700.00),
(99, 134, 2, '2025-01-08', '2025-01-12', 1, 1, 1200.00),
(100, 135, 3, '2025-02-17', '2025-02-19', 3, 0, 650.00),
(101, 136, 3, '2025-01-03', '2025-01-05', 2, 1, 600.00),
(102, 137, 7, '2025-02-14', '2025-02-17', 2, 0, 900.00),
(103, 138, 7, '2025-02-20', '2025-02-21', 1, 2, 300.00),
(104, 139, 4, '2025-02-22', '2025-02-23', 3, 0, 350.00),
(105, 140, 6, '2025-01-11', '2025-01-15', 1, 1, 1200.00),
(106, 141, 2, '2025-02-26', '2025-02-28', 2, 0, 600.00),
(107, 142, 3, '2025-01-24', '2025-01-26', 2, 2, 600.00),
(108, 143, 2, '2025-01-13', '2025-01-15', 1, 1, 600.00),
(109, 144, 7, '2025-02-18', '2025-02-19', 2, 2, 300.00),
(110, 145, 1, '2025-02-25', '2025-02-27', 2, 1, 600.00),
(111, 146, 5, '2025-01-16', '2025-01-19', 2, 2, 900.00),
(112, 147, 6, '2025-02-17', '2025-02-18', 1, 0, 300.00),
(113, 148, 4, '2025-02-04', '2025-02-06', 1, 1, 600.00),
(114, 149, 2, '2025-01-24', '2025-01-26', 2, 2, 600.00),
(115, 150, 6, '2025-02-27', '2025-02-28', 3, 1, 350.00),
(116, 182, 6, '2025-04-10', '2025-04-13', 3, 1, 950.00),
(117, 195, 7, '2025-04-25', '2025-04-27', 1, 1, 600.00),
(118, 196, 3, '2025-04-29', '2025-04-30', 1, 1, 300.00),
(119, 197, 5, '2025-04-27', '2025-04-30', 3, 1, 950.00),
(120, 198, 4, '2025-03-01', '2025-03-02', 1, 2, 300.00),
(121, 199, 2, '2025-04-03', '2025-04-05', 2, 2, 600.00),
(122, 200, 3, '2025-03-06', '2025-03-07', 1, 1, 300.00),
(123, 201, 7, '2025-03-12', '2025-03-14', 1, 1, 600.00),
(124, 202, 2, '2025-03-15', '2025-03-16', 2, 2, 300.00),
(125, 203, 4, '2025-03-21', '2025-03-23', 1, 1, 600.00),
(126, 204, 3, '2025-03-08', '2025-04-09', 3, 1, 1850.00),
(127, 205, 4, '2025-04-24', '2025-04-26', 4, 1, 700.00),
(128, 206, 4, '2025-04-29', '2025-04-30', 2, 2, 300.00),
(129, 207, 5, '2025-04-07', '2025-04-10', 1, 1, 900.00),
(130, 208, 6, '2025-04-26', '2025-05-01', 1, 2, 1500.00),
(131, 209, 4, '2025-03-30', '2025-03-31', 2, 2, 300.00),
(132, 210, 3, '2025-01-30', '2025-01-31', 1, 1, 300.00),
(133, 211, 5, '2025-03-28', '2025-03-30', 1, 1, 600.00),
(134, 212, 2, '2025-04-17', '2025-04-19', 3, 2, 650.00),
(135, 213, 6, '2024-12-15', '2024-12-18', 2, 1, 500.00),
(136, 214, 8, '2024-11-10', '2024-11-12', 1, 0, 300.00),
(137, 215, 10, '2024-10-05', '2024-10-07', 3, 2, 700.00),
(138, 216, 12, '2024-09-20', '2024-09-22', 2, 1, 550.00),
(139, 217, 14, '2024-08-15', '2024-08-18', 1, 1, 400.00),
(140, 218, 16, '2024-07-30', '2024-08-01', 2, 0, 450.00),
(141, 219, 18, '2024-06-25', '2024-06-28', 4, 2, 900.00),
(142, 220, 20, '2024-05-10', '2024-05-12', 3, 1, 600.00),
(143, 221, 22, '2024-04-05', '2024-04-07', 2, 2, 650.00),
(144, 222, 24, '2024-03-20', '2024-03-22', 1, 1, 350.00),
(145, 223, 26, '2024-02-15', '2024-02-18', 3, 2, 800.00),
(146, 224, 28, '2024-01-05', '2024-01-07', 2, 0, 500.00),
(147, 225, 30, '2023-12-10', '2023-12-12', 4, 1, 750.00),
(148, 226, 32, '2023-11-20', '2023-11-22', 2, 1, 550.00),
(149, 227, 34, '2023-10-15', '2023-10-18', 1, 1, 400.00),
(150, 228, 36, '2023-09-05', '2023-09-07', 3, 2, 850.00),
(151, 229, 38, '2023-08-25', '2023-08-27', 2, 0, 450.00),
(152, 230, 40, '2023-07-10', '2023-07-12', 4, 2, 950.00),
(153, 231, 42, '2023-06-15', '2023-06-17', 3, 1, 620.00),
(154, 232, 44, '2023-05-20', '2023-05-22', 2, 2, 680.00),
(155, 233, 46, '2023-04-05', '2023-04-07', 1, 0, 300.00),
(156, 234, 48, '2023-03-10', '2023-03-12', 3, 2, 780.00),
(157, 235, 50, '2023-02-25', '2023-02-27', 2, 0, 500.00),
(158, 236, 52, '2023-01-15', '2023-01-18', 4, 1, 800.00),
(159, 237, 54, '2023-12-05', '2023-12-08', 2, 1, 550.00),
(160, 238, 56, '2023-11-18', '2023-11-20', 3, 2, 720.00),
(161, 239, 58, '2023-10-12', '2023-10-15', 1, 0, 400.00),
(162, 240, 60, '2023-09-25', '2023-09-28', 2, 0, 500.00),
(163, 241, 62, '2023-08-08', '2023-08-10', 4, 2, 900.00),
(164, 242, 64, '2023-07-15', '2023-07-17', 3, 1, 600.00),
(165, 243, 66, '2023-06-05', '2023-06-08', 2, 2, 650.00),
(166, 244, 68, '2023-05-20', '2023-05-22', 1, 1, 350.00),
(167, 245, 70, '2023-04-10', '2023-04-12', 3, 2, 780.00),
(168, 246, 72, '2023-03-28', '2023-03-30', 2, 0, 500.00),
(169, 247, 74, '2023-02-15', '2023-02-18', 4, 1, 850.00),
(170, 248, 76, '2023-01-05', '2023-01-07', 2, 1, 450.00);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

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
-- Filtros para la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD CONSTRAINT `habitacion_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado_habitacion` (`id`),
  ADD CONSTRAINT `habitacion_ibfk_2` FOREIGN KEY (`id_tipo_habitacion`) REFERENCES `tipo_habitacion` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
