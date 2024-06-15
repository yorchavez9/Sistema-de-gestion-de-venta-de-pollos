-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-06-2024 a las 23:10:22
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
-- Estructura de tabla para la tabla `asistencia_trabajadores`
--

CREATE TABLE `asistencia_trabajadores` (
  `id_asistencia` int(11) NOT NULL,
  `id_trabajador` int(11) NOT NULL,
  `fecha_asistencia` date NOT NULL,
  `hora_entrada` time DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  `estado` enum('Presente','Tarde','Falta') NOT NULL,
  `observaciones` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencia_trabajadores`
--

INSERT INTO `asistencia_trabajadores` (`id_asistencia`, `id_trabajador`, `fecha_asistencia`, `hora_entrada`, `hora_salida`, `estado`, `observaciones`) VALUES
(238, 18, '2024-06-10', '17:58:00', '01:58:00', 'Presente', ''),
(239, 19, '2024-06-10', '17:58:00', '01:58:00', 'Presente', ''),
(240, 20, '2024-06-10', '17:58:00', '01:58:00', 'Presente', ''),
(241, 18, '2024-06-27', '21:58:00', '23:58:00', 'Tarde', ''),
(242, 19, '2024-06-27', '21:58:00', '23:58:00', 'Presente', ''),
(243, 20, '2024-06-27', '21:58:00', '23:58:00', 'Tarde', ''),
(244, 18, '2024-06-11', '13:16:00', '21:16:00', 'Presente', ''),
(245, 19, '2024-06-11', '13:16:00', '21:16:00', 'Presente', ''),
(246, 20, '2024-06-11', '13:16:00', '21:16:00', 'Presente', '');

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
(31, 'Pollos', 'Pollos Frescos', '2024-06-10 17:29:44'),
(32, 'Pavitas', 'Pavitas frescos', '2024-06-10 17:29:58'),
(33, 'Pescado', 'Pescados frescos', '2024-06-10 17:30:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_ticket`
--

CREATE TABLE `config_ticket` (
  `id_config_ticket` int(11) NOT NULL,
  `nombre_empresa` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `direccion` varchar(100) NOT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `mensaje` varchar(200) DEFAULT NULL,
  `fecha_config_ticket` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `config_ticket`
--

INSERT INTO `config_ticket` (`id_config_ticket`, `nombre_empresa`, `telefono`, `correo`, `direccion`, `logo`, `mensaje`, `fecha_config_ticket`) VALUES
(11, 'Apuuray', '920468502', 'apuuray@gmail.com', 'Vía Los libertadores', '../vistas/img/ticket/202406110041571471.png', 'Gracias por su compra, vuelva pronto', '2024-06-10 17:41:57');

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
(12, 18, 15, 'diaria', 45.00, '2024-06-10 17:53:10'),
(13, 19, 2, 'semanal', 480.00, '2024-06-10 17:53:25'),
(14, 20, 3, 'mensual', 2400.00, '2024-06-10 17:53:43');

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
(134, 100, 124, '2024-07-10', 'ticket', 'T0001', '0001', 0.00, 3800.00, 3800.00, 3800.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-10 17:44:31'),
(135, 101, 124, '2024-07-10', 'ticket', 'T0002', '0002', 0.00, 529.30, 529.30, 529.30, 0.00, 'contado', 'completado', 'efectivo', '2024-06-10 17:46:07'),
(136, 101, 124, '2024-07-10', 'ticket', 'T0003', '0003', 0.00, 120.00, 120.00, 120.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-10 17:46:27'),
(137, 102, 124, '2024-06-10', 'ticket', 'T0004', '0004', 0.00, 7.00, 7.00, 7.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-10 17:46:50'),
(138, 102, 124, '2024-07-10', 'ticket', 'T0005', '0005', 0.00, 625.40, 625.40, 625.40, 0.00, 'contado', 'completado', 'efectivo', '2024-06-10 17:47:22'),
(139, 102, 124, '2024-06-10', 'ticket', 'T0006', '0006', 0.00, 163.20, 163.20, 163.20, 0.00, 'contado', 'completado', 'efectivo', '2024-06-10 17:47:58'),
(140, 102, 124, '2024-06-10', 'ticket', 'T0007', '0007', 0.00, 7.10, 7.10, 7.10, 0.00, 'contado', 'completado', 'efectivo', '2024-06-10 18:55:01'),
(141, 101, 124, '2024-07-11', 'ticket', 'T0008', '0008', 0.00, 84.00, 84.00, 84.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-11 12:02:48'),
(142, 102, 124, '2024-05-11', 'ticket', 'T0009', '0009', 0.00, 132.00, 132.00, 132.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-11 12:03:32'),
(143, 102, 124, '2024-05-11', 'ticket', 'T0010', '0010', 0.00, 154.00, 154.00, 154.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-11 12:05:36'),
(144, 102, 124, '2024-07-11', 'ticket', 'T0011', '0011', 0.00, 144.00, 144.00, 144.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-11 12:19:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impresora`
--

CREATE TABLE `impresora` (
  `id_impresora` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `ip_impresora` varchar(100) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `impresora`
--

INSERT INTO `impresora` (`id_impresora`, `nombre`, `ip_impresora`, `fecha`) VALUES
(5, 'EPSON-L310-Series', '192.168.1.50', '2024-06-10');

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
(17, 12, 45.00, '2024-06-25 00:00:00', 1),
(18, 13, 480.00, '2024-06-23 00:00:00', 1),
(19, 14, 2400.00, '2024-07-10 00:00:00', 1);

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
(1, 'cliente', 'Cliente genérico', 1, 'Ninguno', 'Ninguno', 'Ninguno', 'Ninguno', 'Ninguno', 'Ninguno', 'Ninguno', 1, '', NULL, '2024-06-01 06:36:03'),
(100, 'proveedor', 'San antonio', 2, '20123456789', 'Jr. Los ángeles #45', 'Lima', '09405', '920468501', 'sanantonio@gmail.com', '', 1, 'null', '', '2024-06-10 17:18:41'),
(101, 'proveedor', 'Altamar', 2, '20234567890', 'Av. Grau #4567', 'Lima', '09405', '920468502', 'altamar@gmail.com', 'https://altamar.com', 1, 'BBVA', '32156423151432', '2024-06-10 17:20:18'),
(102, 'proveedor', 'San miguel', 2, '20345678901', 'Pasaje Los Sajus', 'Huancayo', '09404', '920468503', 'sanmiguel@gmail.com', '', 1, 'null', '', '2024-06-10 17:21:23'),
(103, 'cliente', 'José Sarmiento Lopez', 1, '47233445', 'Pampona', 'Arequipa', '09406', '920468504', 'jose123@gmail.com', '', 1, 'null', '', '2024-06-10 17:22:46'),
(116, 'cliente', 'Alicia de la Cruz Gómez', 1, '72243566', 'Jr. Las Americas #45', 'Arequipa', '09409', '920234556', 'alicia123@gmail.com', '', 1, 'null', '', '2024-06-10 17:25:05');

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
(129, 31, 'P001', 'Producto ', 0.00, 123, '2024-06-19', 'Descripcion ', '../vistas/img/productos/202406152243236388.png', 1, '2024-06-15 15:43:23');

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
(18, 'Lucas Dominguez Sanches', '72233456', '923345541', 'lucas@gmail.com', '../vistas/img/trabajador/202406110050548470.jpeg', '../vistas/pdf/trabajador/202406110050549025.pdf', 'efectivo', '', 1),
(19, 'Luis Illanez Martinez', '47564312', '923456512', 'luis@gmail.com', '../vistas/img/trabajador/202406110051524831.jpeg', '../vistas/pdf/trabajador/202406110051527414.pdf', 'efectivo', '', 1),
(20, 'Saul Clemente Salas', '42232113', '923234566', 'saul@gmail.com', '../vistas/img/trabajador/202406110052424056.jpeg', '../vistas/pdf/trabajador/202406110052427414.pdf', 'efectivo', '', 1);

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
(124, 'Jorge chavez Huincho', 1, '72243561', 'Av. Ninguno #456', '920468001', 'jorge@gmail.com', 'Jorge', '$2a$07$asxx54ahjppf45sd87a5auKKweOnGVRntDRMQN.CVMrzvBvwrBU/C', '../vistas/img/usuarios/202406071600245658.jpeg', 1, '2024-05-23 21:19:36', '[\"administrador\",\"cajero\",\"ayudante\"]'),
(125, 'Juan Dominguez Santos', 1, '61234312', 'Vía Los libertadores', '920468502', 'juan123@gmail.com', 'Juan', '$2a$07$asxx54ahjppf45sd87a5auFxqrwzBR0RPCx/v9BOmOyImsyarRs7G', '../vistas/img/usuarios/202406011358592009.jpeg', 1, '2024-06-01 06:58:59', '[\"cajero\",\"ayudante\"]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacaciones`
--

CREATE TABLE `vacaciones` (
  `id_vacacion` int(11) NOT NULL,
  `id_trabajador` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `estado_vacion` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `vacaciones`
--

INSERT INTO `vacaciones` (`id_vacacion`, `id_trabajador`, `fecha_inicio`, `fecha_fin`, `estado_vacion`) VALUES
(11, 18, '2025-06-10', '2024-06-11', 0),
(12, 19, '2024-06-20', '2024-06-26', 0),
(13, 20, '2024-06-10', '2024-06-11', 0);

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
(109, 1, 124, '2024-06-10', 'ticket', 'T0001', '0001', 0.00, 72.00, 72.00, 72.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-10 18:45:59'),
(110, 1, 124, '2024-06-10', 'ticket', 'T0002', '0002', 0.00, 151.00, 151.00, 151.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-10 18:50:43'),
(111, 1, 124, '2024-06-10', 'ticket', 'T0003', '0003', 0.00, 168.00, 94.00, 168.00, 0.00, 'credito', 'pendiente', 'Ninguno', '2024-06-10 18:52:35'),
(112, 1, 124, '2024-06-10', 'ticket', 'T0004', '0004', 0.00, 217.80, 217.80, 217.80, 0.00, 'contado', 'completado', 'efectivo', '2024-06-10 18:53:23'),
(113, 1, 124, '2024-06-11', 'ticket', 'T0005', '0005', 0.00, 16.00, 16.00, 16.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-10 19:03:05'),
(114, 1, 124, '2024-06-11', 'ticket', 'T0006', '0006', 0.00, 16.00, 16.00, 16.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-10 19:03:39'),
(115, 1, 124, '2024-06-11', 'ticket', 'T0007', '0007', 0.00, 245.00, 245.00, 245.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-10 19:06:09'),
(116, 1, 124, '2024-06-11', 'ticket', 'T0008', '0008', 0.00, 70.20, 70.00, 70.20, 0.00, 'credito', 'pendiente', 'Ninguno', '2024-06-10 19:08:08'),
(117, 1, 124, '2024-05-11', 'ticket', 'T0009', '0009', 0.00, 208.00, 208.00, 208.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-11 12:04:16'),
(118, 1, 124, '2024-05-11', 'ticket', 'T0010', '0010', 0.00, 345.00, 345.00, 345.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-11 12:04:47'),
(119, 1, 124, '2024-07-11', 'ticket', 'T0011', '0011', 0.00, 108.00, 108.00, 108.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-11 12:17:36'),
(120, 1, 124, '2024-06-11', 'ticket', 'T0012', '0012', 0.00, 166.60, 166.60, 166.60, 0.00, 'contado', 'completado', 'efectivo', '2024-06-11 13:10:26'),
(121, 1, 124, '2024-06-12', 'ticket', 'T0013', '0013', 0.00, 18.00, 18.00, 18.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-12 13:21:21'),
(122, 1, 124, '2024-06-12', 'ticket', 'T0014', '0014', 0.00, 18.00, 18.00, 18.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-12 13:23:40'),
(123, 1, 124, '2024-06-12', 'ticket', 'T0015', '0015', 0.00, 14.00, 14.00, 14.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-12 13:27:37'),
(124, 1, 124, '2024-06-12', 'ticket', 'T0016', '0016', 0.00, 120.00, 120.00, 120.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-12 13:30:35'),
(125, 103, 124, '2024-06-12', 'ticket', 'T0017', '0017', 0.00, 273.00, 273.00, 273.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-12 13:32:27'),
(126, 1, 124, '2024-06-12', 'ticket', 'T0018', '0018', 0.00, 24.00, 24.00, 24.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-12 16:41:02'),
(127, 1, 124, '2024-06-13', 'ticket', 'T0019', '0019', 0.00, 35.00, 35.00, 35.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-13 17:10:48'),
(128, 1, 124, '2024-06-14', 'ticket', 'T0020', '0020', 0.00, 36.00, 36.00, 36.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-14 10:22:46');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia_trabajadores`
--
ALTER TABLE `asistencia_trabajadores`
  ADD PRIMARY KEY (`id_asistencia`),
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
-- Indices de la tabla `impresora`
--
ALTER TABLE `impresora`
  ADD PRIMARY KEY (`id_impresora`);

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
-- AUTO_INCREMENT de la tabla `asistencia_trabajadores`
--
ALTER TABLE `asistencia_trabajadores`
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `config_ticket`
--
ALTER TABLE `config_ticket`
  MODIFY `id_config_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `contratos_trabajadores`
--
ALTER TABLE `contratos_trabajadores`
  MODIFY `id_contrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `detalle_egreso`
--
ALTER TABLE `detalle_egreso`
  MODIFY `id_detalle_egreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT de la tabla `egresos`
--
ALTER TABLE `egresos`
  MODIFY `id_egreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT de la tabla `impresora`
--
ALTER TABLE `impresora`
  MODIFY `id_impresora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pagos_trabajadores`
--
ALTER TABLE `pagos_trabajadores`
  MODIFY `id_pagos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT de la tabla `tipo_documentos`
--
ALTER TABLE `tipo_documentos`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `id_trabajador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  MODIFY `id_vacacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia_trabajadores`
--
ALTER TABLE `asistencia_trabajadores`
  ADD CONSTRAINT `asistencia_trabajadores_ibfk_1` FOREIGN KEY (`id_trabajador`) REFERENCES `trabajadores` (`id_trabajador`);

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
