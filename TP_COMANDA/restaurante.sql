-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-12-2019 a las 06:08:46
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encargados`
--

CREATE TABLE `encargados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `idRol` int(2) NOT NULL,
  `clave` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `encargados`
--

INSERT INTO `encargados` (`id`, `nombre`, `apellido`, `idRol`, `clave`, `usuario`, `updated_at`, `created_at`) VALUES
(1, 'Damian', 'Desario', 3, '1234', 'damiTano', '2019-11-09 19:16:41', '2019-11-09 19:16:41'),
(2, 'Juan', 'Perez', 1, '1234', 'perezJuanCapo', '2019-11-09 19:18:26', '2019-11-09 19:18:26'),
(3, 'Pepe', 'Cuenca', 2, '1234', 'pepinCuenca123', '2019-11-09 19:18:37', '2019-11-09 19:18:37'),
(4, 'Lorenzo', 'Valencia', 4, '1234', 'lorencinHugoAlfredo', '2019-11-09 19:18:47', '2019-11-09 19:18:47'),
(5, 'Leandro', 'Egea', 5, '1234', 'ElBocho', '2019-11-09 19:18:55', '2019-11-09 19:18:55'),
(6, 'Gabriel', 'Saliba', 3, 'gaby1999', 'gaby.ivan', '2019-11-12 08:14:18', '2019-11-12 08:14:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_mesa`
--

CREATE TABLE `estados_mesa` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `estados_mesa`
--

INSERT INTO `estados_mesa` (`id`, `descripcion`, `updated_at`, `created_at`) VALUES
(1, 'con cliente esperando', '2019-11-09 19:20:31', '2019-11-09 19:20:31'),
(2, 'con clientes comiendo', '2019-11-09 19:22:03', '2019-11-09 19:22:03'),
(3, 'con clientes pagando', '2019-11-09 19:23:13', '2019-11-09 19:23:13'),
(4, 'cerrada', '2019-11-09 19:23:23', '2019-11-09 19:23:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_pedidos`
--

CREATE TABLE `estados_pedidos` (
  `id` int(11) NOT NULL,
  `estado` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `estados_pedidos`
--

INSERT INTO `estados_pedidos` (`id`, `estado`, `updated_at`, `created_at`) VALUES
(1, 'recibido', '2019-11-30 20:00:43', '2019-11-30 20:00:43'),
(2, 'en preparacion', '2019-11-09 19:29:48', '2019-11-09 19:29:48'),
(3, 'listo para servir', '2019-11-09 19:30:16', '2019-11-09 19:30:16'),
(4, 'servido', '2019-12-01 18:40:52', '2019-12-01 18:40:52'),
(5, 'cobrado', '2019-12-01 20:27:20', '2019-12-01 20:27:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_productos`
--

CREATE TABLE `estados_productos` (
  `id` int(11) NOT NULL,
  `estado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `estados_productos`
--

INSERT INTO `estados_productos` (`id`, `estado`, `updated_at`, `created_at`) VALUES
(1, 'pendiente', '2019-11-09 19:24:39', '2019-11-09 19:24:39'),
(2, 'en preparacion', '2019-11-09 19:24:55', '2019-11-09 19:24:55'),
(3, 'listo para serv', '2019-11-09 19:25:23', '2019-11-09 19:25:23'),
(4, 'servido', '2019-12-01 18:44:44', '2019-12-01 18:44:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id` int(11) NOT NULL,
  `codigoMesa` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `idEstadoMesa` int(2) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `codigoMesa`, `idEstadoMesa`, `updated_at`, `created_at`) VALUES
(1, 'MESA-1', 4, '2019-12-06 09:05:59', '2019-11-16 00:01:34'),
(2, 'MESA-2', 1, '2019-12-06 08:23:40', '2019-11-16 06:22:56'),
(3, 'MESA-3', 4, '2019-12-06 08:03:28', '2019-11-16 06:23:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `idEstadoPedido` int(2) NOT NULL,
  `codigoPedido` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `codigoMesa` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `idEncargado` int(2) NOT NULL,
  `productos` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `nombreCliente` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `imagen` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tiempo` int(4) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `idEstadoPedido`, `codigoPedido`, `codigoMesa`, `idEncargado`, `productos`, `nombreCliente`, `imagen`, `tiempo`, `updated_at`, `created_at`) VALUES
(1, 5, 'BVPRW', 'MESA-3', 5, '1,1,1,7,8,9', 'Caludio', NULL, 0, '2019-12-03 01:50:02', '2019-12-03 01:48:15'),
(2, 5, 'AtQtR', 'MESA-3', 5, '1,1,1,7,8,9', 'Caludio', NULL, 0, '2019-12-03 02:12:48', '2019-12-03 02:09:27'),
(7, 5, 'IyVJn', 'MESA-1', 5, '1,2,7', 'Alfredo y Gaby', 'C:\\xampp\\tmp\\phpC4E8.tmp', 0, '2019-12-06 09:05:59', '2019-12-06 08:14:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `precio` int(10) NOT NULL,
  `idRol` int(11) NOT NULL,
  `tiempoPreparacion` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `descripcion`, `tipo`, `precio`, `idRol`, `tiempoPreparacion`, `updated_at`, `created_at`) VALUES
(1, 'Coca Cola', 'bebida', 90, 5, 3, '2019-11-12 19:39:49', '2019-11-12 15:39:49'),
(2, 'Sprite', 'bebida', 90, 5, 3, '2019-11-12 19:40:12', '2019-11-12 15:40:12'),
(3, 'Aquarius', 'bebida', 90, 5, 3, '2019-11-12 19:40:31', '2019-11-12 15:40:31'),
(4, 'Cafe', 'bebida', 110, 5, 5, '2019-11-12 19:41:32', '2019-11-12 15:41:32'),
(5, 'Te', 'bebida', 100, 5, 3, '2019-11-12 19:41:44', '2019-11-12 15:41:44'),
(6, 'Agua', 'bebida', 90, 5, 3, '2019-11-12 19:41:56', '2019-11-12 15:41:56'),
(7, 'Milanesa con papas fritas', 'comida', 280, 1, 15, '2019-11-12 19:42:14', '2019-11-12 15:42:14'),
(8, 'Bife de lomo con verduras', 'comida', 300, 1, 22, '2019-11-12 19:42:23', '2019-11-12 15:42:23'),
(9, 'Pulpo a la gallega', 'comida', 1700, 1, 45, '2019-11-12 19:42:31', '2019-11-12 15:42:31'),
(10, 'Pollo para dos', 'comida', 480, 1, 15, '2019-11-12 19:42:40', '2019-11-12 15:42:40'),
(11, 'Vino tinto', 'vino', 300, 4, 6, '2019-11-12 19:43:05', '2019-11-12 15:43:05'),
(12, 'Papitas', 'comida', 187, 1, 40, '2019-11-12 19:43:19', '2019-11-12 15:43:19'),
(14, 'Esperma de Pitufo', 'trago', 300, 4, 3, '2019-11-12 19:43:35', '2019-11-12 15:43:35'),
(15, 'Cerveza', 'cerveza', 150, 2, 6, '2019-11-12 19:43:51', '2019-11-12 15:43:51'),
(16, 'Rabas', 'comida', 220, 1, 30, '2019-11-12 19:44:11', '2019-11-12 15:44:11'),
(17, 'Lengua la vinagreta', 'comida', 187, 1, 40, '2019-11-12 19:44:24', '2019-11-12 15:44:24'),
(18, 'Pure con churrasco\n', 'comida', 180, 1, 12, '2019-11-12 19:44:26', '2019-11-12 15:44:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_pedidos`
--

CREATE TABLE `productos_pedidos` (
  `id` int(11) NOT NULL,
  `codigoPedido` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `idProducto` int(11) NOT NULL,
  `idEstadoProducto` int(2) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos_pedidos`
--

INSERT INTO `productos_pedidos` (`id`, `codigoPedido`, `idProducto`, `idEstadoProducto`, `updated_at`, `created_at`) VALUES
(1, 'BVPRW', 1, 4, '2019-12-03 01:49:45', '2019-12-03 01:48:15'),
(2, 'BVPRW', 1, 4, '2019-12-03 01:49:45', '2019-12-03 01:48:15'),
(3, 'BVPRW', 1, 4, '2019-12-03 01:49:45', '2019-12-03 01:48:15'),
(4, 'BVPRW', 7, 4, '2019-12-03 01:49:45', '2019-12-03 01:48:15'),
(5, 'BVPRW', 8, 4, '2019-12-03 01:49:45', '2019-12-03 01:48:15'),
(6, 'BVPRW', 9, 4, '2019-12-03 01:49:45', '2019-12-03 01:48:15'),
(7, 'AtQtR', 1, 4, '2019-12-03 02:11:56', '2019-12-03 02:09:27'),
(8, 'AtQtR', 1, 4, '2019-12-03 02:11:56', '2019-12-03 02:09:27'),
(9, 'AtQtR', 1, 4, '2019-12-03 02:11:56', '2019-12-03 02:09:27'),
(10, 'AtQtR', 7, 4, '2019-12-03 02:11:56', '2019-12-03 02:09:27'),
(11, 'AtQtR', 8, 4, '2019-12-03 02:11:56', '2019-12-03 02:09:27'),
(12, 'AtQtR', 9, 4, '2019-12-03 02:11:56', '2019-12-03 02:09:27'),
(25, 'IyVJn', 1, 4, '2019-12-06 08:52:41', '2019-12-06 08:19:35'),
(26, 'IyVJn', 2, 4, '2019-12-06 08:52:41', '2019-12-06 08:19:35'),
(27, 'IyVJn', 7, 4, '2019-12-06 08:52:41', '2019-12-06 08:19:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `cargo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `cargo`, `updated_at`, `created_at`) VALUES
(1, 'cocinero', '2019-11-09 19:50:01', '2019-11-09 19:50:01'),
(2, 'cervecero', '2019-11-09 19:50:17', '2019-11-09 19:50:17'),
(3, 'socio', '2019-11-09 19:50:22', '2019-11-09 19:50:22'),
(4, 'bartender', '2019-11-09 19:50:46', '2019-11-09 19:50:46'),
(5, 'mozo', '2019-11-09 19:50:54', '2019-11-09 19:50:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `precioTotal` int(10) NOT NULL,
  `codigoPedido` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `encargado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `mesa` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id`, `precioTotal`, `codigoPedido`, `encargado`, `mesa`, `updated_at`, `created_at`) VALUES
(1, 2550, 'BVPRW', 'legea', 'MESA-3', '2019-12-03 01:50:02', '2019-12-03 01:50:02'),
(2, 2550, 'AtQtR', 'legea', 'MESA-3', '2019-12-03 02:12:48', '2019-12-03 02:12:48'),
(3, 460, 'IyVJn', 'ElBocho', 'MESA-1', '2019-12-06 09:05:59', '2019-12-06 09:05:59');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `encargados`
--
ALTER TABLE `encargados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados_mesa`
--
ALTER TABLE `estados_mesa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados_pedidos`
--
ALTER TABLE `estados_pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados_productos`
--
ALTER TABLE `estados_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_pedidos`
--
ALTER TABLE `productos_pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `encargados`
--
ALTER TABLE `encargados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `estados_mesa`
--
ALTER TABLE `estados_mesa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estados_pedidos`
--
ALTER TABLE `estados_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `estados_productos`
--
ALTER TABLE `estados_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `productos_pedidos`
--
ALTER TABLE `productos_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
