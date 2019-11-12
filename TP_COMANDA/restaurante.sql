-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2019 a las 05:03:53
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
(5, 'Leandro', 'Egea', 5, '1234', 'ElBocho', '2019-11-09 19:18:55', '2019-11-09 19:18:55');

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
  `descripcion` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `estados_pedidos`
--

INSERT INTO `estados_pedidos` (`id`, `descripcion`, `updated_at`, `created_at`) VALUES
(1, 'en preparacion', '2019-11-09 19:29:48', '2019-11-09 19:29:48'),
(2, 'listo para servir', '2019-11-09 19:30:16', '2019-11-09 19:30:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_productos`
--

CREATE TABLE `estados_productos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `estados_productos`
--

INSERT INTO `estados_productos` (`id`, `descripcion`, `updated_at`, `created_at`) VALUES
(1, 'pendiente', '2019-11-09 19:24:39', '2019-11-09 19:24:39'),
(2, 'en preparacion', '2019-11-09 19:24:55', '2019-11-09 19:24:55'),
(3, 'listo para servir', '2019-11-09 19:25:23', '2019-11-09 19:25:23');

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
(1, 'MESA1', 4, '2019-11-09 19:48:16', '2019-11-09 19:48:16'),
(2, 'MESA2', 4, '2019-11-09 19:48:22', '2019-11-09 19:48:22'),
(4, 'MESA3', 4, '2019-11-09 19:48:37', '2019-11-09 19:48:37'),
(5, 'MESA4', 4, '2019-11-09 19:48:41', '2019-11-09 19:48:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `idEstadoPedido` int(2) NOT NULL,
  `codigoMesa` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `idEncargado` int(2) NOT NULL,
  `nombreCliente` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `imagen` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `tiempo` int(4) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `idEstadoPedido`, `codigoMesa`, `idEncargado`, `nombreCliente`, `imagen`, `tiempo`, `updated_at`, `created_at`) VALUES
(1, 1, 'MESA1', 5, 'El pepo', 'pepo.jpg', 33, '2019-11-09 20:09:42', '2019-11-09 20:09:42'),
(2, 1, 'MESA2', 3, 'El papolin', 'papolin.jpg', 36, '2019-11-09 20:10:20', '2019-11-09 20:10:20'),
(3, 1, 'MESA1', 5, 'Juancin', 'imagen.jpg', 38, '2019-11-10 23:12:51', '2019-11-10 23:12:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `precio` int(10) NOT NULL,
  `idRol` int(11) NOT NULL,
  `tiempoPreparacion` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `descripcion`, `precio`, `idRol`, `tiempoPreparacion`, `updated_at`, `created_at`) VALUES
(1, 'Coca Cola', 90, 5, 1, '2019-11-09 19:53:01', '2019-11-09 19:53:01'),
(2, 'Sprite', 90, 5, 1, '2019-11-09 19:53:10', '2019-11-09 19:53:10'),
(3, 'Aquarius', 90, 5, 1, '2019-11-09 19:53:19', '2019-11-09 19:53:19'),
(4, 'Cafe', 110, 5, 3, '2019-11-09 19:53:46', '2019-11-09 19:53:46'),
(5, 'Te', 100, 5, 3, '2019-11-09 19:54:01', '2019-11-09 19:54:01'),
(6, 'Agua', 90, 5, 1, '2019-11-09 19:54:14', '2019-11-09 19:54:14'),
(7, 'Milanesa con papas fritas', 280, 1, 1, '2019-11-09 19:55:28', '2019-11-09 19:55:28'),
(8, 'Bife de lomo con verduras', 300, 1, 1, '2019-11-09 19:55:56', '2019-11-09 19:55:56'),
(9, 'Pulpo a la gallega', 1700, 1, 1, '2019-11-09 19:56:10', '2019-11-09 19:56:10'),
(10, 'Pollo para dos', 480, 1, 1, '2019-11-09 19:56:58', '2019-11-09 19:56:58'),
(11, 'Vino tinto', 300, 4, 3, '2019-11-09 19:58:36', '2019-11-09 19:58:36'),
(12, 'Vino blanco', 300, 4, 3, '2019-11-09 19:58:42', '2019-11-09 19:58:42'),
(13, 'Mojito', 300, 4, 3, '2019-11-09 19:59:22', '2019-11-09 19:59:22'),
(14, 'Esperma de Pitufo', 300, 4, 3, '2019-11-09 19:59:41', '2019-11-09 19:59:41'),
(15, 'Cerveza', 150, 2, 3, '2019-11-09 20:00:12', '2019-11-09 20:00:12'),
(16, 'Rabas', 220, 1, 30, '2019-11-09 20:03:55', '2019-11-09 20:03:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_pedidos`
--

CREATE TABLE `productos_pedidos` (
  `idPedido` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `idEstadoProducto` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `precioTotal` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estados_mesa`
--
ALTER TABLE `estados_mesa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estados_pedidos`
--
ALTER TABLE `estados_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estados_productos`
--
ALTER TABLE `estados_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
