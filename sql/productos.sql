-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-12-2021 a las 21:07:41
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_pos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `fecha`) VALUES
(1, 'Equipos Electromecanicos', '2021-12-22 20:06:23'),
(2, 'Taladros', '2021-12-22 20:06:42'),
(3, 'Andamios', '2021-12-22 20:06:53'),
(4, 'Generadores de energía', '2021-12-22 20:07:14'),
(5, 'Equipos para construccción', '2021-12-22 20:07:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `codigo` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `imagen` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` float NOT NULL,
  `ventas` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_categoria`, `codigo`, `descripcion`, `imagen`, `stock`, `precio_compra`, `precio_venta`, `ventas`, `fecha`) VALUES
(1, 1, '101', 'Aspiradora Industrial ', '', 20, 1500, 2100, 0, '2021-12-22 20:04:30'),
(2, 1, '102', 'Plato Flotante para Allanadora', '', 20, 4500, 6300, 0, '2021-12-22 20:04:30'),
(3, 1, '103', 'Compresor de Aire para pintura', '', 20, 3000, 4200, 0, '2021-12-22 20:04:30'),
(4, 1, '104', 'Cortadora de Adobe sin Disco ', '', 20, 4000, 5600, 0, '2021-12-22 20:04:30'),
(5, 1, '105', 'Cortadora de Piso sin Disco ', '', 20, 1540, 2156, 0, '2021-12-22 20:04:30'),
(6, 1, '106', 'Disco Punta Diamante ', '', 20, 1100, 1540, 0, '2021-12-22 20:04:30'),
(7, 1, '107', 'Extractor de Aire ', '', 20, 1540, 2156, 0, '2021-12-22 20:04:30'),
(8, 1, '108', 'Guada?adora ', '', 20, 1540, 2156, 0, '2021-12-22 20:04:30'),
(9, 1, '109', 'Hidrolavadora El?ctrica ', '', 20, 2600, 3640, 0, '2021-12-22 20:04:30'),
(10, 1, '110', 'Hidrolavadora Gasolina', '', 20, 2210, 3094, 0, '2021-12-22 20:04:30'),
(11, 1, '111', 'Motobomba a Gasolina', '', 20, 2860, 4004, 0, '2021-12-22 20:04:30'),
(12, 1, '112', 'Motobomba El?ctrica', '', 20, 2400, 3360, 0, '2021-12-22 20:04:30'),
(13, 1, '113', 'Sierra Circular ', '', 20, 1100, 1540, 0, '2021-12-22 20:04:30'),
(14, 1, '114', 'Disco de tugsteno para Sierra circular', '', 20, 4500, 6300, 0, '2021-12-22 20:04:30'),
(15, 1, '115', 'Soldador Electrico ', '', 20, 1980, 2772, 0, '2021-12-22 20:04:30'),
(16, 1, '116', 'Careta para Soldador', '', 20, 4200, 5880, 0, '2021-12-22 20:04:30'),
(17, 1, '117', 'Torre de iluminacion ', '', 20, 1800, 2520, 0, '2021-12-22 20:04:30'),
(18, 2, '201', 'Martillo Demoledor de Piso 110V', '', 20, 5600, 7840, 0, '2021-12-22 20:04:30'),
(19, 2, '202', 'Muela o cincel martillo demoledor piso', '', 20, 9600, 13440, 0, '2021-12-22 20:04:30'),
(20, 2, '203', 'Taladro Demoledor de muro 110V', '', 20, 3850, 5390, 0, '2021-12-22 20:04:30'),
(21, 2, '204', 'Muela o cincel martillo demoledor muro', '', 20, 9600, 13440, 0, '2021-12-22 20:04:30'),
(22, 2, '205', 'Taladro Percutor de 1/2\" Madera y Metal', '', 20, 8000, 11200, 0, '2021-12-22 20:04:30'),
(23, 2, '206', 'Taladro Percutor SDS Plus 110V', '', 20, 3900, 5460, 0, '2021-12-22 20:04:30'),
(24, 2, '207', 'Taladro Percutor SDS Max 110V (Mineria)', '', 20, 4600, 6440, 0, '2021-12-22 20:04:30'),
(25, 3, '301', 'Andamio colgante', '', 20, 1440, 2016, 0, '2021-12-22 20:04:30'),
(26, 3, '302', 'Distanciador andamio colgante', '', 20, 1600, 2240, 0, '2021-12-22 20:04:30'),
(27, 3, '303', 'Marco andamio modular ', '', 20, 900, 1260, 0, '2021-12-22 20:04:30'),
(28, 3, '304', 'Marco andamio tijera', '', 20, 100, 140, 0, '2021-12-22 20:04:30'),
(29, 3, '305', 'Tijera para andamio', '', 20, 162, 226, 0, '2021-12-22 20:04:30'),
(30, 3, '306', 'Escalera interna para andamio', '', 20, 270, 378, 0, '2021-12-22 20:04:30'),
(31, 3, '307', 'Pasamanos de seguridad', '', 20, 75, 105, 0, '2021-12-22 20:04:30'),
(32, 3, '308', 'Rueda giratoria para andamio', '', 20, 168, 235, 0, '2021-12-22 20:04:30'),
(33, 3, '309', 'Arnes de seguridad', '', 20, 1750, 2450, 0, '2021-12-22 20:04:30'),
(34, 3, '310', 'Eslinga para arnes', '', 20, 175, 245, 0, '2021-12-22 20:04:30'),
(35, 3, '311', 'Plataforma Met?lica', '', 20, 420, 588, 0, '2021-12-22 20:04:30'),
(36, 4, '401', 'Planta Electrica Diesel 6 Kva', '', 20, 3500, 4900, 0, '2021-12-22 20:04:30'),
(37, 4, '402', 'Planta Electrica Diesel 10 Kva', '', 20, 3550, 4970, 0, '2021-12-22 20:04:30'),
(38, 4, '403', 'Planta Electrica Diesel 20 Kva', '', 20, 3600, 5040, 0, '2021-12-22 20:04:30'),
(39, 4, '404', 'Planta Electrica Diesel 30 Kva', '', 20, 3650, 5110, 0, '2021-12-22 20:04:30'),
(40, 4, '405', 'Planta Electrica Diesel 60 Kva', '', 20, 3700, 5180, 0, '2021-12-22 20:04:30'),
(41, 4, '406', 'Planta Electrica Diesel 75 Kva', '', 20, 3750, 5250, 0, '2021-12-22 20:04:30'),
(42, 4, '407', 'Planta Electrica Diesel 100 Kva', '', 20, 3800, 5320, 0, '2021-12-22 20:04:30'),
(43, 4, '408', 'Planta Electrica Diesel 120 Kva', '', 20, 3850, 5390, 0, '2021-12-22 20:04:30'),
(44, 5, '501', 'Escalera de Tijera Aluminio ', '', 20, 350, 490, 0, '2021-12-22 20:04:30'),
(45, 5, '502', 'Extension Electrica ', '', 20, 370, 518, 0, '2021-12-22 20:04:30'),
(46, 5, '503', 'Gato tensor', '', 20, 380, 532, 0, '2021-12-22 20:04:30'),
(47, 5, '504', 'Lamina Cubre Brecha ', '', 20, 380, 532, 0, '2021-12-22 20:04:30'),
(48, 5, '505', 'Llave de Tubo', '', 20, 480, 672, 0, '2021-12-22 20:04:30'),
(49, 5, '506', 'Manila por Metro', '', 20, 600, 840, 0, '2021-12-22 20:04:30'),
(50, 5, '507', 'Polea 2 canales', '', 20, 900, 1260, 0, '2021-12-22 20:04:30'),
(51, 5, '508', 'Tensor', '', 20, 100, 140, 0, '2021-12-22 20:04:30'),
(52, 5, '509', 'Bascula ', '', 20, 130, 182, 0, '2021-12-22 20:04:30'),
(53, 5, '510', 'Bomba Hidrostatica', '', 20, 770, 1078, 0, '2021-12-22 20:04:30'),
(54, 5, '511', 'Chapeta', '', 20, 660, 924, 0, '2021-12-22 20:04:30'),
(55, 5, '512', 'Cilindro muestra de concreto', '', 20, 400, 560, 0, '2021-12-22 20:04:30'),
(56, 5, '513', 'Cizalla de Palanca', '', 20, 450, 630, 0, '2021-12-22 20:04:30'),
(57, 5, '514', 'Cizalla de Tijera', '', 20, 580, 812, 0, '2021-12-22 20:04:30'),
(58, 5, '515', 'Coche llanta neumatica', '', 20, 420, 588, 0, '2021-12-22 20:04:30'),
(59, 5, '516', 'Cono slump', '', 20, 140, 196, 0, '2021-12-22 20:04:30'),
(60, 5, '517', 'Cortadora de Baldosin', '', 20, 930, 1302, 0, '2021-12-22 20:04:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `foto` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(22, 'fer', 'ferfit', '$2a$07$asxx54ahjppf45sd87a5au2BJzDGbj8danA9OTTm6aODztQR87Rp2', 'Administrador', 'vistas/img/usuarios/ferfit/624.png', 1, '2021-12-22 08:57:33', '2021-12-22 11:57:33'),
(32, 'sofi', 'sofi', '$2a$07$asxx54ahjppf45sd87a5au1kPPgBkin2NwGFyWN/qVL5xhUO5L0Ra', 'Administrador', 'vistas/img/usuarios/sofi/155.png', 0, '0000-00-00 00:00:00', '2021-12-21 15:48:11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
