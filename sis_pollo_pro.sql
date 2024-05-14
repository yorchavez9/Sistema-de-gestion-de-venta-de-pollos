-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-05-2024 a las 17:25:03
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sis_pollo_pro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id_asistecia` int(11) NOT NULL,
  `id_trabajador` int(11) NOT NULL,
  `entrada_presente` tinyint(1) NOT NULL,
  `salida_presente` tinyint(1) NOT NULL,
  `fecha_asistencia` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `descripcion`, `fecha`) VALUES
(2, 'Pollos A2', 'Los mejores pollos tex', '2024-03-27 15:34:14'),
(4, 'Pollo Entero', 'Pollos enteros de alta calidad, listos para cocinar.', '2024-03-27 00:00:00'),
(5, 'Muslos de Pollo', 'Muslos de pollo frescos y jugosos.', '2024-03-27 00:00:00'),
(6, 'Alitas de Pollo', 'Alitas de pollo ideales para asar o freír.', '2024-03-27 00:00:00'),
(7, 'Pechugas de Pollo', 'Pechugas de pollo sin hueso, perfectas para platos principales.', '2024-03-27 00:00:00'),
(8, 'Pollo Rostizado', 'Pollos asados lentamente, con un sabor irresistible.', '2024-03-27 00:00:00'),
(9, 'Pollo Marinado', 'Pollo marinado en una mezcla especial de especias y hierbas.', '2024-03-27 00:00:00'),
(10, 'Pollo Orgánico', 'Pollos criados de manera orgánica, alimentados con una dieta natural.', '2024-03-27 00:00:00'),
(11, 'Pollo a la Parrilla', 'Pollos cocinados a la parrilla, con un delicioso sabor ahumado.', '2024-03-27 00:00:00'),
(12, 'Pollo a la Barbacoa', 'Pollos bañados en salsa barbacoa, listos para disfrutar.', '2024-03-27 00:00:00'),
(13, 'Pollo a la Broaster', 'Pollos empanizados y cocinados a presión, para una textura crujiente por fuera y jugosa por dentro.', '2024-03-27 00:00:00'),
(15, 'Pollo a la Cerveza', 'Pollos cocinados con una deliciosa salsa de cerveza, para un sabor único, Los animales', '2024-03-27 00:00:00'),
(16, 'Pollo al Horno', 'Pollos cocinados lentamente en el horno, con hierbas y especias aromáticas.', '2024-03-27 00:00:00'),
(17, 'Pollo a la Mostaza', 'Pollos preparados con una salsa de mostaza cremosa y llena de sabor.', '2024-03-27 00:00:00'),
(18, 'Pollo Picante', 'Pollos preparados con una mezcla de especias picantes, para los amantes del sabor intenso.', '2024-03-27 00:00:00'),
(19, 'Pollo Teriyaki', 'Pollos marinados en salsa teriyaki, con un toque oriental irresistible.', '2024-03-27 00:00:00'),
(20, 'Pollo Frito', 'Pollos crujientes y dorados, perfectos para una comida rápida y deliciosa.', '2024-03-27 00:00:00'),
(21, 'Pollo a la Parmesana', 'Pollos empanizados y cubiertos con salsa marinara y queso parmesano, gratinados al horno.', '2024-03-27 00:00:00'),
(22, 'Pollo a la Crema', 'Pollos preparados con una salsa cremosa de champiñones y hierbas aromáticas.', '2024-03-27 00:00:00'),
(23, 'Pollo a la Criolla', 'Pollos cocinados en una salsa criolla de tomate, cebolla y pimientos, con un toque casero.', '2024-03-27 00:00:00'),
(24, '83428jwsd', 'dsafdasf', '2024-03-27 16:20:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_ticket`
--

CREATE TABLE `config_ticket` (
  `id_config_ticket` int(11) NOT NULL,
  `nombre_empresa` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `direccion` varchar(10) NOT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `mensaje` varchar(200) DEFAULT NULL,
  `fecha_config_ticket` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos_trabajadores`
--

CREATE TABLE `contratos_trabajadores` (
  `id_contrato` int(11) NOT NULL,
  `id_trabajador` int(11) NOT NULL,
  `tiempo_contrato` int(11) NOT NULL,
  `tipo_sueldo` varchar(100) NOT NULL,
  `sueldo` decimal(11,2) NOT NULL,
  `fecha_contrato` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contratos_trabajadores`
--

INSERT INTO `contratos_trabajadores` (`id_contrato`, `id_trabajador`, `tiempo_contrato`, `tipo_sueldo`, `sueldo`, `fecha_contrato`) VALUES
(2, 10, 100, 'diaria', 1399.00, '2024-05-10 09:33:05'),
(3, 8, 12, 'mensual', 1600.00, '2024-05-10 09:34:23'),
(5, 12, 12, 'semanal', 324.00, '2024-05-10 10:32:33'),
(6, 10, 12, 'mensual', 5900.00, '2024-05-10 10:34:13'),
(7, 14, 4, 'semanal', 400.00, '2024-05-13 12:06:04'),
(8, 11, 5, 'mensual', 1540.00, '2024-05-13 20:47:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_egreso`
--

CREATE TABLE `detalle_egreso` (
  `id_detalle_egreso` int(11) NOT NULL,
  `id_egreso` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `precio_compra` decimal(11,2) NOT NULL,
  `precio_venta` decimal(11,2) NOT NULL,
  `cantidad_u` int(11) DEFAULT NULL,
  `cantidad_kg` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_egreso`
--

INSERT INTO `detalle_egreso` (`id_detalle_egreso`, `id_egreso`, `id_producto`, `precio_compra`, `precio_venta`, `cantidad_u`, `cantidad_kg`) VALUES
(91, 106, 26, 23.00, 23.00, 8, 23.00),
(92, 106, 25, 23.00, 23.00, 3, 23.00),
(93, 107, 17, 23.00, 23.00, 12, 12.00),
(94, 108, 25, 23.00, 21.00, 12, 23.00),
(95, 109, 26, 23.00, 0.00, 0, 123.00),
(96, 110, 24, 23.00, 3.00, 123, 23.00),
(97, 111, 24, 2.00, 0.00, 0, 2134.00),
(98, 112, 25, 23.00, 23.00, 23, 23.00),
(99, 113, 24, 23.00, 23.00, 23, 23.00),
(100, 114, 15, 23.00, 23.00, 12, 23.00),
(101, 114, 26, 23.00, 23.00, 12, 23.00),
(102, 114, 24, 23.00, 23.00, 23, 23.00),
(103, 115, 24, 12.00, 12.00, 12, 21.00),
(104, 116, 11, 34.00, 38.00, 12, 12.00),
(105, 117, 25, 123.00, 124.00, 76, 34.00),
(106, 118, 23, 23.00, 23.00, 5, 23.00),
(107, 118, 22, 23.00, 32.00, 10, 23.00),
(108, 119, 26, 23.00, 25.00, 50, 50.00),
(109, 120, 23, 12.00, 15.00, 14, 10.00),
(110, 121, 26, 8.00, 10.00, 5, 12.00),
(111, 122, 25, 8.00, 11.00, 20, 40.00),
(112, 123, 26, 12.00, 13.00, 500, 100.00),
(113, 124, 25, 10.00, 13.00, 200, 100.00),
(114, 125, 23, 5.00, 10.50, 68, 120.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_detalle_venta` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `precio_venta` decimal(11,2) NOT NULL,
  `cantidad_u` int(11) DEFAULT NULL,
  `cantidad_kg` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_venta`, `id_producto`, `precio_venta`, `cantidad_u`, `cantidad_kg`) VALUES
(63, 60, 26, 13.00, 12, 25.00),
(67, 62, 26, 13.00, 12, 25.00),
(68, 62, 25, 13.00, 12, 34.00),
(69, 62, 21, 23.00, 12, 34.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresos`
--

CREATE TABLE `egresos` (
  `id_egreso` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_egre` date NOT NULL,
  `tipo_comprobante` varchar(20) NOT NULL,
  `serie_comprobante` varchar(7) NOT NULL,
  `num_comprobante` varchar(10) NOT NULL,
  `impuesto` decimal(4,2) NOT NULL,
  `total_compra` decimal(11,2) NOT NULL,
  `total_pago` decimal(11,2) NOT NULL,
  `subTotal` decimal(11,2) NOT NULL,
  `igv` decimal(11,2) NOT NULL,
  `tipo_pago` varchar(30) NOT NULL,
  `estado_pago` varchar(30) DEFAULT NULL,
  `pago_e_y` varchar(50) NOT NULL,
  `fecha_egreso` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `egresos`
--

INSERT INTO `egresos` (`id_egreso`, `id_persona`, `id_usuario`, `fecha_egre`, `tipo_comprobante`, `serie_comprobante`, `num_comprobante`, `impuesto`, `total_compra`, `total_pago`, `subTotal`, `igv`, `tipo_pago`, `estado_pago`, `pago_e_y`, `fecha_egreso`) VALUES
(106, 47, 99, '2024-04-08', 'ticket', 'T0001', '0001', 50.00, 1058.00, 0.00, 0.00, 0.00, 'contado', 'completado', 'efectivo', '2024-04-08 12:22:51'),
(107, 47, 99, '2024-04-08', 'ticket', 'T0002', '0002', 0.00, 276.00, 34.00, 276.00, 0.00, 'contado', 'completado', 'efectivo', '2024-04-08 13:30:41'),
(108, 56, 99, '2024-04-08', 'ticket', 'T0003', '0003', 0.00, 529.00, 56.00, 529.00, 0.00, 'contado', 'completado', 'efectivo', '2024-04-08 13:46:48'),
(109, 51, 99, '2024-04-08', 'ticket', 'T0004', '0004', 0.00, 2829.00, 211.00, 2829.00, 0.00, 'credito', 'pendiente', 'efectivo', '2024-04-08 13:47:48'),
(110, 47, 99, '2024-04-08', 'ticket', 'T0005', '0005', 0.00, 529.00, 242.00, 529.00, 0.00, 'contado', 'completado', 'efectivo', '2024-04-08 13:51:51'),
(111, 53, 99, '2024-04-08', 'ticket', 'T0006', '0006', 0.00, 4268.00, 268.00, 4268.00, 0.00, 'contado', 'completado', 'efectivo', '2024-04-08 13:53:19'),
(112, 62, 99, '2024-04-08', 'ticket', 'T0007', '0007', 0.00, 529.00, 529.00, 529.00, 0.00, 'credito', 'pendiente', 'efectivo', '2024-04-08 13:56:32'),
(113, 91, 99, '2024-04-08', 'ticket', 'T0008', '0008', 18.00, 624.22, 624.22, 529.00, 95.22, 'contado', 'completado', 'efectivo', '2024-04-08 15:20:47'),
(114, 31, 99, '2024-04-08', 'ticket', 'T0009', '0009', 0.00, 1587.00, 1587.00, 1587.00, 0.00, 'contado', 'completado', 'efectivo', '2024-04-08 15:23:18'),
(115, 56, 99, '2024-04-09', 'ticket', 'T0010', '0010', 0.00, 252.00, 252.00, 252.00, 0.00, 'contado', 'completado', 'efectivo', '2024-04-09 08:35:11'),
(116, 56, 99, '2024-04-10', 'ticket', 'T0011', '0011', 0.00, 408.00, 408.00, 408.00, 0.00, 'contado', 'completado', 'efectivo', '2024-04-10 09:48:13'),
(117, 70, 99, '2024-04-10', 'ticket', 'T0012', '0012', 0.00, 4182.00, 4182.00, 4182.00, 0.00, 'contado', 'completado', 'efectivo', '2024-04-10 09:51:20'),
(118, 53, 99, '2024-04-10', 'ticket', 'T0013', '0013', 0.00, 1058.00, 1058.00, 1058.00, 0.00, 'contado', 'completado', 'efectivo', '2024-04-10 11:52:37'),
(119, 57, 99, '2024-04-10', 'ticket', 'T0014', '0014', 0.00, 1150.00, 1150.00, 1150.00, 0.00, 'contado', 'completado', 'efectivo', '2024-04-10 12:05:53'),
(120, 53, 99, '2024-04-10', 'ticket', 'T0015', '0015', 0.00, 120.00, 120.00, 120.00, 0.00, 'contado', 'completado', 'efectivo', '2024-04-10 16:10:57'),
(121, 54, 99, '2024-04-11', 'ticket', 'T0016', '0016', 0.00, 96.00, 96.00, 96.00, 0.00, 'contado', 'completado', 'efectivo', '2024-04-11 17:58:30'),
(122, 54, 99, '2024-04-11', 'ticket', 'T0017', '0017', 0.00, 320.00, 320.00, 320.00, 0.00, 'contado', 'completado', 'efectivo', '2024-04-11 17:59:29'),
(123, 61, 99, '2024-04-18', 'ticket', 'T0018', '0018', 0.00, 1200.00, 1200.00, 1200.00, 0.00, 'contado', 'completado', 'efectivo', '2024-04-18 10:03:59'),
(124, 53, 99, '2024-04-18', 'ticket', 'T0019', '0019', 0.00, 1000.00, 1000.00, 1000.00, 0.00, 'contado', 'completado', 'efectivo', '2024-04-18 10:04:29'),
(125, 91, 99, '2024-04-18', 'ticket', 'T0020', '0020', 0.00, 600.00, 600.00, 600.00, 0.00, 'contado', 'completado', 'efectivo', '2024-04-18 10:05:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_trabajadores`
--

CREATE TABLE `pagos_trabajadores` (
  `id_pagos` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL,
  `monto_pago` decimal(11,2) NOT NULL,
  `fecha_pago` datetime DEFAULT current_timestamp(),
  `estado_pago` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pagos_trabajadores`
--

INSERT INTO `pagos_trabajadores` (`id_pagos`, `id_contrato`, `monto_pago`, `fecha_pago`, `estado_pago`) VALUES
(6, 2, 1399.00, '2024-05-13 00:00:00', 0),
(9, 3, 1600.00, '2024-05-30 00:00:00', 1),
(10, 7, 400.00, '2024-05-13 00:00:00', 0),
(11, 8, 1540.00, '2024-06-13 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_persona` int(11) NOT NULL,
  `tipo_persona` varchar(50) NOT NULL,
  `razon_social` varchar(100) NOT NULL,
  `id_doc` int(11) NOT NULL,
  `numero_documento` varchar(20) NOT NULL,
  `direccion` varchar(120) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `codigo_postal` varchar(20) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sitio_web` varchar(150) NOT NULL,
  `estado_persona` int(11) DEFAULT 1,
  `tipo_banco` varchar(50) NOT NULL,
  `numero_cuenta` varchar(50) DEFAULT NULL,
  `fecha_persona` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_persona`, `tipo_persona`, `razon_social`, `id_doc`, `numero_documento`, `direccion`, `ciudad`, `codigo_postal`, `telefono`, `email`, `sitio_web`, `estado_persona`, `tipo_banco`, `numero_cuenta`, `fecha_persona`) VALUES
(1, 'cliente', 'Cliente Genérico', 2, 'Ninguno', 'Ninguno', 'Ninguno', '00000', 'Ninguno', 'Ninguno', 'Ninguno', 1, 'BF', '', '2024-04-05 14:00:00'),
(31, 'proveedor', 'jorge', 2, '987654321', 'Av. Principal', 'Ciudad B', '54321', '9876543210', 'proveedor2@example.com', 'www.proveedor2.com', 1, 'BCP', '9876543210', '2024-03-20 15:13:02'),
(38, 'proveedor', 'Pino', 6, '666777888', 'Av. Norte', 'Ciudad I', '97531', '6667778888', 'proveedor9@example.com', 'www.proveedor9.com', 1, 'BCRP', '6667778888', '2024-03-29 11:45:40'),
(41, 'proveedor', 'Proveedor 11', 1, '111222444', 'Calle Este', 'Ciudad K', '54321', '1112224444', 'proveedor11@example.com', 'www.proveedor11.com', 1, 'BCP', '1112224444', '2024-04-01 10:00:00'),
(42, 'proveedor', 'Proveedor 13', 6, '555666777', 'Calle Norte', 'Ciudad M', '67890', '5556667777', 'proveedor13@example.com', 'www.proveedor13.com', 1, 'BCRP', '5556667777', '2024-04-03 12:00:00'),
(43, 'proveedor', 'Proveedor 14', 1, '888999111', 'Av. Sur', 'Ciudad N', '09876', '8889991111', 'proveedor14@example.com', 'www.proveedor14.com', 1, 'BN', '8889991111', '2024-04-04 13:00:00'),
(47, 'proveedor', 'Proveedor 20', 1, '222111444', 'Av. Norte', 'Ciudad T', '43210', '2221114444', 'proveedor20@example.com', 'www.proveedor20.com', 1, 'BBVA', '2221114444', '2024-04-10 19:00:00'),
(51, 'proveedor', 'Proveedor 22', 2, '654987321', 'Calle 2', 'Ciudad V', '54321', '6549873210', 'proveedor22@example.com', 'www.proveedor22.com', 1, 'BCP', '6549873210', '2024-04-12 11:00:00'),
(52, 'proveedor', 'Proveedor 23', 6, '789654123', 'Calle 3', 'Ciudad W', '67890', '7896541230', 'proveedor23@example.com', 'www.proveedor23.com', 1, 'SBP', '7896541230', '2024-04-13 12:00:00'),
(53, 'proveedor', 'Proveedor 24', 1, '456789321', 'Calle 4', 'Ciudad X', '09876', '4567893210', 'proveedor24@example.com', 'www.proveedor24.com', 1, 'IB', '4567893210', '2024-04-14 13:00:00'),
(54, 'proveedor', 'Proveedor 25', 2, '321654987', 'Calle 5', 'Ciudad Y', '54321', '3216549870', 'proveedor25@example.com', 'www.proveedor25.com', 1, 'BBVA', '3216549870', '2024-04-15 14:00:00'),
(55, 'proveedor', 'Proveedor 26', 6, '654321987', 'Calle 6', 'Ciudad Z', '13579', '6543219870', 'proveedor26@example.com', 'www.proveedor26.com', 1, 'BR', '6543219870', '2024-04-16 15:00:00'),
(56, 'proveedor', 'Proveedor 27', 1, '987321654', 'Calle 7', 'Ciudad AA', '24680', '9873216540', 'proveedor27@example.com', 'www.proveedor27.com', 1, 'BN', '9873216540', '2024-04-17 16:00:00'),
(57, 'proveedor', 'Proveedor 28', 2, '789123456', 'Calle 8', 'Ciudad BB', '86420', '7891234560', 'proveedor28@example.com', 'www.proveedor28.com', 1, 'BF', '7891234560', '2024-04-18 17:00:00'),
(58, 'proveedor', 'Proveedor 29', 6, '321789654', 'Calle 9', 'Ciudad CC', '97531', '3217896540', 'proveedor29@example.com', 'www.proveedor29.com', 1, 'BCRP', '3217896540', '2024-04-19 18:00:00'),
(59, 'cliente', 'Camilo Surco', 1, '456123789', 'Calle 10', 'Ciudad DD', '12345', '4561237890', 'proveedor30@example.com', 'www.proveedor30.com', 1, 'BCP', '4561237890', '2024-04-20 19:00:00'),
(61, 'proveedor', 'Proveedor 31', 1, '111222333', 'Calle 11', 'Ciudad EE', '54321', '1112223330', 'proveedor31@example.com', 'www.proveedor31.com', 1, 'BCRP', '1112223330', '2024-04-21 10:00:00'),
(62, 'proveedor', 'Proveedor 32', 2, '444555666', 'Calle 12', 'Ciudad FF', '12345', '4445556660', 'proveedor32@example.com', 'www.proveedor32.com', 1, 'BCP', '4445556660', '2024-04-22 11:00:00'),
(63, 'proveedor', 'Proveedor 33', 6, '777888999', 'Calle 13', 'Ciudad GG', '67890', '7778889990', 'proveedor33@example.com', 'www.proveedor33.com', 1, 'SBP', '7778889990', '2024-04-23 12:00:00'),
(64, 'cliente', 'Celia', 1, '999888777', 'Calle 14', 'Ciudad HH', '09876', '9998887770', 'proveedor34@example.com', 'www.proveedor34.com', 1, 'IB', '9998887770', '2024-04-24 13:00:00'),
(65, 'proveedor', 'Proveedor 35', 2, '333222111', 'Calle 15', 'Ciudad II', '54321', '3332221110', 'proveedor35@example.com', 'www.proveedor35.com', 1, 'BBVA', '3332221110', '2024-04-25 14:00:00'),
(66, 'proveedor', 'Proveedor 36', 6, '666777888', 'Calle 16', 'Ciudad JJ', '13579', '6667778880', 'proveedor36@example.com', 'www.proveedor36.com', 1, 'BR', '6667778880', '2024-04-26 15:00:00'),
(67, 'cliente', 'San Juan', 1, '222111444', 'Calle 17', 'Ciudad KK', '24680', '2221114440', 'proveedor37@example.com', 'www.proveedor37.com', 1, 'BN', '2221114440', '2024-04-27 16:00:00'),
(68, 'proveedor', 'Proveedor 38', 2, '666555444', 'Calle 18', 'Ciudad LL', '86420', '6665554440', 'proveedor38@example.com', 'www.proveedor38.com', 1, 'BF', '6665554440', '2024-04-28 17:00:00'),
(69, 'proveedor', 'Proveedor 39', 6, '444333222', 'Calle 19', 'Ciudad MM', '97531', '4443332220', 'proveedor39@example.com', 'www.proveedor39.com', 1, 'BCRP', '4443332220', '2024-04-29 18:00:00'),
(70, 'proveedor', 'Proveedor 40', 1, '888777666', 'Calle 20', 'Ciudad NN', '12345', '8887776660', 'proveedor40@example.com', 'www.proveedor40.com', 1, 'BCP', '8887776660', '2024-04-30 19:00:00'),
(83, 'cliente', 'Valentina Herrera Gómez', 1, '72243121', 'Av. Los ángeles #45', 'Lircay', '32345', '920468543', 'valentina@gmail.com', '', 1, 'IB', '345334321321421421', '2024-03-27 14:00:49'),
(84, 'cliente', 'Santiago Vargas Martínez sdf', 1, '72243512', 'Av. Santiago #456', 'Huancayo', '45325', '912234123', 'santiago@gmail.com', '', 1, 'BBVA', '84383427324173217324', '2024-03-27 14:02:03'),
(85, 'cliente', 'Camila Montoya Rodríguez', 2, '107224356', 'Av. Camila #45', 'Huanoco', '53234', '3234654323', 'camila@gmail.com', 'www.camila.com', 1, 'IB', '4321445314354643456', '2024-03-27 14:04:24'),
(86, 'cliente', 'Mateo Silva Pérez', 6, '341454343', 'Jr. Mateo #865', 'Huaraz', '54324', '954924382', 'mateo@gmail.com', '', 1, 'BCP', '3421544235323334', '2024-03-27 14:06:03'),
(87, 'cliente', 'Isabella Rojas García', 1, '46563412', 'Av. isabella #12345', 'Lima', '42354', '7653423523', 'isabella@gmail.com', 'www.isabella.com', 1, 'BBVA', '34342541234', '2024-03-27 14:07:30'),
(88, 'cliente', 'Juan Pablo Gómez López', 1, '542354325', 'Jr. juan #8544', 'Pisco', '63425', '85482347423', 'juan@gmail.com', '', 1, 'IB', '45325325432235235', '2024-03-27 14:08:33'),
(89, 'cliente', 'Natalia Ramírez Sánchez', 2, '10234234561', 'Av. natalia #252', 'Cusco', '56365', '95984542434', 'natalia@gmail.com', '', 1, 'null', '', '2024-03-27 14:09:35'),
(90, 'proveedor', 'Lopez dominges', 2, '10723634', 'Av. centenario  #456', 'Lircay', 'a0012', '928238347', 'doc@gmail.com', '', 1, 'null', '', '2024-04-03 11:56:31'),
(91, 'proveedor', 'Pedro Juan', 2, '324142143', '', 'Lircay', '', '93283428342', 'gu@gmail.com', '', 1, 'null', '', '2024-04-03 12:09:08'),
(92, 'proveedor', 'sol', 2, '343423321', '', 'hdsfdfs', '', '920236523', 'jsol@gmail.com', '', 1, 'null', '', '2024-04-03 12:10:44'),
(93, 'proveedor', 'Ciro', 1, '674376342', '', 'Lircay', '', '920345120', 'ciro@gmail.com', 'dfsaf', 1, 'IB', '435325235', '2024-04-03 12:13:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `codigo_producto` varchar(50) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `precio_producto` decimal(11,2) NOT NULL,
  `stock_producto` int(11) NOT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `descripcion_producto` text DEFAULT NULL,
  `imagen_producto` varchar(100) DEFAULT NULL,
  `estado_producto` int(11) DEFAULT 1,
  `fecha_producto` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `id_categoria`, `codigo_producto`, `nombre_producto`, `precio_producto`, `stock_producto`, `fecha_vencimiento`, `descripcion_producto`, `imagen_producto`, `estado_producto`, `fecha_producto`) VALUES
(11, 23, 'A001', 'Polos AB2', 38.00, 12, '2024-04-30', 'dsaff', '../vistas/img/productos/202404020102059907.jpg', 1, '2024-04-01 17:45:09'),
(12, 21, 'A002', 'Pollo A2', 0.00, 0, '2024-05-06', 'Descripcion del pollo', '../vistas/img/productos/202404020105497407.jpg', 1, '2024-04-01 18:05:49'),
(13, 4, 'A003', 'Pollo tierno', 0.00, 0, '2024-05-14', 'asdfdsafdsaf', '../vistas/img/productos/202404020106207276.jpg', 1, '2024-04-01 18:06:20'),
(14, 21, 'A004', 'Pollo d3', 0.00, 0, '2024-05-14', 'sdfasdf', '../vistas/img/productos/202404020107043683.jpg', 1, '2024-04-01 18:07:04'),
(15, 20, 'A005', 'Pollo edf', 0.00, 9, '2024-05-13', 'dfsfdas', '../vistas/img/productos/202404020107335335.jpg', 1, '2024-04-01 18:07:33'),
(16, 2, 'A006', 'Pollo fasdf', 0.00, 10, '2024-05-15', 'fdsaf', '../vistas/img/productos/202404020108526008.png', 1, '2024-04-01 18:08:52'),
(17, 23, 'A007', 'Prodcuto ss', 0.00, 123, '2024-05-07', 'fdsaf', '../vistas/img/productos/202404020112257253.jpg', 1, '2024-04-01 18:12:25'),
(18, 23, 'A008', 'Cangrejo B1', 0.00, 1, '2024-05-02', 'Calamina', '../vistas/img/productos/202404101936545470.jpg', 1, '2024-04-01 18:51:59'),
(21, 22, 'A0019', 'Cangreso A1', 0.00, 111, '2024-05-01', 'fdsaf', '../vistas/img/productos/202404101936231066.jpg', 1, '2024-04-03 10:34:52'),
(22, 20, 'a00d', 'Pescado A1', 32.00, 0, '2024-04-30', 'daD', '../vistas/img/productos/202404101933502536.jpg', 1, '2024-04-03 10:40:27'),
(23, 20, 'B001', 'Salchicha A1', 10.00, 2, '2024-05-22', 'dasda', '../vistas/img/productos/202404101932454518.jpg', 1, '2024-04-03 10:43:19'),
(24, 23, 'a00234', 'Jamon A1', 0.00, -16, '2024-04-23', 'fsadf', '../vistas/img/productos/202404101931014143.jpg', 1, '2024-04-03 10:46:14'),
(25, 23, 'A0054', 'Pollo B2', 13.00, 68, '2024-04-09', 'fsafdsa', '../vistas/img/productos/202404101929544885.jpg', 1, '2024-04-03 10:47:33'),
(26, 23, 'A0012', 'Pollo B1', 13.00, 306, '2024-05-08', 'Descripcion del producto', '../vistas/img/productos/202404101928503425.jpg', 1, '2024-04-04 08:32:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documentos`
--

CREATE TABLE `tipo_documentos` (
  `id_doc` int(11) NOT NULL,
  `nombre_doc` varchar(50) NOT NULL,
  `fecha_doc` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_documentos`
--

INSERT INTO `tipo_documentos` (`id_doc`, `nombre_doc`, `fecha_doc`) VALUES
(1, 'DNI', '2024-03-20 15:13:02'),
(2, 'RUC', '2024-03-20 15:13:02'),
(6, 'Cédula', '2024-03-23 11:25:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE `trabajadores` (
  `id_trabajador` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `num_documento` varchar(20) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `cv` varchar(50) DEFAULT NULL,
  `tipo_pago` varchar(100) NOT NULL,
  `num_cuenta` varchar(30) DEFAULT NULL,
  `estado_trabajador` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `trabajadores`
--

INSERT INTO `trabajadores` (`id_trabajador`, `nombre`, `num_documento`, `telefono`, `correo`, `foto`, `cv`, `tipo_pago`, `num_cuenta`, `estado_trabajador`) VALUES
(8, 'Daniel Chávez Martinez', '72243561', '920468502', 'jorge@gmail.com', '../vistas/img/trabajador/202405092141484284.png', '../vistas/pdf/trabajador/202405092141489690.pdf', 'targetaDebito', '923836723621621', 1),
(10, 'Jorge Chávez Huincho', '72243561', '920468502', 'jorge@gmail.com', '../vistas/img/trabajador/202405101505511432.jpeg', '../vistas/pdf/trabajador/202405101505511414.pdf', 'efectivo', '', 1),
(11, 'Alejandro Pérez García', '56452314', '976321123', 'alajandro@gmail.com', '../vistas/img/trabajador/202405101729165140.jpg', '../vistas/pdf/trabajador/202405101729165362.pdf', 'efectivo', '', 1),
(12, 'Luis Martínez Sánchez', '56452334', '9879675432', 'Luis@gmail.com', '../vistas/img/trabajador/202405101729575791.jpg', '../vistas/pdf/trabajador/202405101729574266.pdf', 'targetaDebito', '7489023109871432', 1),
(13, 'María García Martínez', '12233454', '923212457', 'maria@gmail.com', '../vistas/img/trabajador/202405101731172764.jpg', '../vistas/pdf/trabajador/202405101731178053.pdf', 'efectivo', '', 1),
(14, 'Laura Sánchez Rodríguez', '34345467', '987564234', 'laura@gmail.com', '../vistas/img/trabajador/202405101732021330.jpg', '../vistas/pdf/trabajador/202405101732027056.pdf', 'targetaCredito', '6345653362434445', 1),
(15, 'Jorge Chávez Huincho', '72243561', '920468502', 'jorge@gmail.com', '../vistas/img/trabajador/202405140346015358.jpg', '../vistas/pdf/trabajador/202405140346019922.pdf', 'efectivo', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `id_doc` int(11) NOT NULL,
  `numero_documento` varchar(20) NOT NULL,
  `direccion` varchar(70) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `imagen_usuario` varchar(50) NOT NULL,
  `estado` int(11) DEFAULT 1,
  `fecha_usuario` datetime DEFAULT current_timestamp(),
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`roles`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `id_doc`, `numero_documento`, `direccion`, `telefono`, `correo`, `usuario`, `contrasena`, `imagen_usuario`, `estado`, `fecha_usuario`, `roles`) VALUES
(99, 'Jorge', 1, '72243561', 'Av. Los libertadores #453', '920468502', 'jorge@gmail.com', 'Jorge', '$2a$07$asxx54ahjppf45sd87a5auKKweOnGVRntDRMQN.CVMrzvBvwrBU/C', '../vistas/img/usuarios/202404111913174629.png', 1, '2024-04-01 11:31:15', '[\"administrador\",\"cajero\"]'),
(100, 'Juan', 1, '72243562', 'Av. Los libertadores #453', '920468509', 'juan@gmail.com', 'Juan', '$2a$07$asxx54ahjppf45sd87a5auFxqrwzBR0RPCx/v9BOmOyImsyarRs7G', '../vistas/img/usuarios/202404011831496892.jpg', 1, '2024-04-01 11:31:49', '[\"administrador\",\"cajero\",\"ayudante\"]'),
(101, 'Gimena', 2, '1023344512', 'Av. Los libertadores #453', '920468500', 'gimena@gmail.com', 'Gimena', '$2a$07$asxx54ahjppf45sd87a5auDDwkjduNzmb7Sm.c8sy/h38RdR1WucC', '../vistas/img/usuarios/202404111913025998.png', 1, '2024-04-01 11:32:50', '[\"administrador\",\"cajero\"]'),
(104, 'Sergio', 1, '72243561', 'Av. centenario ', '3542521354', 'sergio@gmail.com', 'Sergio', '$2a$07$asxx54ahjppf45sd87a5aui6rQDeZzg/833bVKPHkwtIvfwJtfMy.', '../vistas/img/usuarios/202405092145439037.jpg', 1, '2024-04-11 11:50:34', '[\"administrador\",\"cajero\",\"ayudante\"]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacaciones`
--

CREATE TABLE `vacaciones` (
  `id_vacacion` int(11) NOT NULL,
  `id_trabajador` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `estado_vacion` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_venta` date NOT NULL,
  `tipo_comprobante` varchar(20) NOT NULL,
  `serie_comprobante` varchar(7) NOT NULL,
  `num_comprobante` varchar(10) NOT NULL,
  `impuesto` decimal(4,2) NOT NULL,
  `total_venta` decimal(11,2) NOT NULL,
  `total_pago` decimal(11,2) NOT NULL,
  `sub_total` decimal(11,2) NOT NULL,
  `igv` decimal(11,2) NOT NULL,
  `tipo_pago` varchar(30) NOT NULL,
  `estado_pago` varchar(30) DEFAULT NULL,
  `pago_e_y` varchar(50) NOT NULL,
  `fecha_venta_a` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_persona`, `id_usuario`, `fecha_venta`, `tipo_comprobante`, `serie_comprobante`, `num_comprobante`, `impuesto`, `total_venta`, `total_pago`, `sub_total`, `igv`, `tipo_pago`, `estado_pago`, `pago_e_y`, `fecha_venta_a`) VALUES
(60, 1, 99, '2024-05-03', 'ticket', 'T0001', '0001', 0.00, 325.00, 325.00, 325.00, 0.00, 'contado', 'completado', 'efectivo', '2024-05-03 12:00:01'),
(62, 1, 99, '2024-05-03', 'ticket', 'T0003', '0003', 0.00, 1549.00, 1549.00, 1549.00, 0.00, 'credito', 'pendiente', 'yape', '2024-05-03 12:02:59');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id_asistecia`),
  ADD KEY `id_trabajador` (`id_trabajador`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `config_ticket`
--
ALTER TABLE `config_ticket`
  ADD PRIMARY KEY (`id_config_ticket`);

--
-- Indices de la tabla `contratos_trabajadores`
--
ALTER TABLE `contratos_trabajadores`
  ADD PRIMARY KEY (`id_contrato`),
  ADD KEY `id_trabajador` (`id_trabajador`);

--
-- Indices de la tabla `detalle_egreso`
--
ALTER TABLE `detalle_egreso`
  ADD PRIMARY KEY (`id_detalle_egreso`),
  ADD KEY `id_egreso` (`id_egreso`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detalle_venta`),
  ADD KEY `id_ventas` (`id_venta`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `egresos`
--
ALTER TABLE `egresos`
  ADD PRIMARY KEY (`id_egreso`),
  ADD KEY `id_persona` (`id_persona`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `pagos_trabajadores`
--
ALTER TABLE `pagos_trabajadores`
  ADD PRIMARY KEY (`id_pagos`),
  ADD KEY `id_contrato` (`id_contrato`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_persona`),
  ADD UNIQUE KEY `telefono` (`telefono`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_doc` (`id_doc`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `codigo_producto` (`codigo_producto`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `tipo_documentos`
--
ALTER TABLE `tipo_documentos`
  ADD PRIMARY KEY (`id_doc`);

--
-- Indices de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`id_trabajador`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `id_doc` (`id_doc`);

--
-- Indices de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  ADD PRIMARY KEY (`id_vacacion`),
  ADD KEY `id_trabajador` (`id_trabajador`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_persona` (`id_persona`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id_asistecia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `config_ticket`
--
ALTER TABLE `config_ticket`
  MODIFY `id_config_ticket` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contratos_trabajadores`
--
ALTER TABLE `contratos_trabajadores`
  MODIFY `id_contrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `detalle_egreso`
--
ALTER TABLE `detalle_egreso`
  MODIFY `id_detalle_egreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `egresos`
--
ALTER TABLE `egresos`
  MODIFY `id_egreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT de la tabla `pagos_trabajadores`
--
ALTER TABLE `pagos_trabajadores`
  MODIFY `id_pagos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `tipo_documentos`
--
ALTER TABLE `tipo_documentos`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `id_trabajador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  MODIFY `id_vacacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`id_trabajador`) REFERENCES `trabajadores` (`id_trabajador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `contratos_trabajadores`
--
ALTER TABLE `contratos_trabajadores`
  ADD CONSTRAINT `contratos_trabajadores_ibfk_1` FOREIGN KEY (`id_trabajador`) REFERENCES `trabajadores` (`id_trabajador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_egreso`
--
ALTER TABLE `detalle_egreso`
  ADD CONSTRAINT `detalle_egreso_ibfk_1` FOREIGN KEY (`id_egreso`) REFERENCES `egresos` (`id_egreso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_egreso_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `egresos`
--
ALTER TABLE `egresos`
  ADD CONSTRAINT `egresos_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `egresos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pagos_trabajadores`
--
ALTER TABLE `pagos_trabajadores`
  ADD CONSTRAINT `pagos_trabajadores_ibfk_1` FOREIGN KEY (`id_contrato`) REFERENCES `contratos_trabajadores` (`id_contrato`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `personas_ibfk_1` FOREIGN KEY (`id_doc`) REFERENCES `tipo_documentos` (`id_doc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_doc`) REFERENCES `tipo_documentos` (`id_doc`);

--
-- Filtros para la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  ADD CONSTRAINT `vacaciones_ibfk_1` FOREIGN KEY (`id_trabajador`) REFERENCES `trabajadores` (`id_trabajador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
