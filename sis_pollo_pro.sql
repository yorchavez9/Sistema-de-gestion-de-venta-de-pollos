-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-06-2024 a las 03:09:25
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
(232, 16, '2024-06-01', '08:01:00', '15:30:00', 'Presente', ''),
(233, 17, '2024-06-01', '08:01:00', '15:30:00', 'Presente', '');

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
(26, 'Pollos', 'Pollos frescos ', '2024-06-01 07:07:20'),
(27, 'Mariscos', 'Marisco frescos', '2024-06-01 07:07:39'),
(28, 'Pescados', 'Pescados frescos', '2024-06-01 07:07:55'),
(29, 'Pavos', 'Pavos frescos', '2024-06-01 07:10:41');

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
(9, 'AVITAC', '920468502', 'avitac123@gmail.com', 'Vía Los libertadores', '../vistas/img/ticket/202406041854045453.png', 'Gracias por la compra', '2024-06-04 11:54:04');

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
(9, 16, 10, 'diaria', 45.00, '2024-06-01 07:24:59'),
(10, 17, 4, 'semanal', 460.00, '2024-06-01 07:25:19');

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
(126, 129, 49, 10.20, 11.60, 50, 100.00),
(127, 130, 46, 8.10, 9.40, 30, 62.00);

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
(95, 80, 49, 10.90, 12, 26.00),
(96, 81, 46, 8.70, 8, 18.00),
(97, 82, 43, 9.00, 3, 8.00),
(111, 95, 46, 9.00, 2, 2.00),
(114, 99, 46, 8.70, 1, 1.00),
(115, 100, 49, 10.78, 1, 1.00),
(116, 101, 46, 9.00, 123, 123.00);

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
(129, 96, 124, '2024-06-01', 'ticket', 'T0001', '0001', 0.00, 1020.00, 1020.00, 1020.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-01 07:15:12'),
(130, 97, 124, '2024-06-01', 'ticket', 'T0002', '0002', 0.00, 502.20, 0.00, 502.20, 0.00, 'credito', 'pendiente', 'efectivo', '2024-06-01 07:16:16');

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
(4, 'EPSON L310 Series', '874328923489623498', '2024-06-01');

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
(14, 9, 45.00, '2024-07-01 00:00:00', 1),
(15, 10, 460.00, '2024-06-22 00:00:00', 1);

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
(95, 'cliente', 'Juan Ramos Salvatierra', 1, '72243221', 'Jr. Los Andes #45', 'Lima', '43256', '987645321', 'juan@gmail.com', '', 1, '', NULL, '2024-06-01 06:31:33'),
(96, 'proveedor', 'San Antonio', 2, '82847371818', 'Jr Puno #456', 'Lima', '43256', '923432123', 'sanantonio@gmail.com', 'http://sanantonio.com', 1, '', NULL, '2024-06-01 06:38:36'),
(97, 'proveedor', 'Los Angeles', 2, '10345612342', 'Av. Grau #455', 'Lima', '53435', '923345431', 'losangeles@gmail.com', 'https://losangeles.com', 1, 'BCP', '97892378922344', '2024-06-01 07:01:29'),
(99, 'cliente', 'Lucia Chavez Gómez', 1, '61122113', 'Jr. Puno #123', 'Lircay', '52354', '923432111', 'lucia@gmail.com', '', 1, 'null', '', '2024-06-01 07:03:49');

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
(43, 26, 'P001', 'Pollo A1', 0.00, 34, '2024-06-15', '', '../vistas/img/productos/202406011410069566.jpeg', 1, '2024-06-01 07:10:06'),
(46, 26, 'P002', 'Pollo A2', 9.00, 222, '2024-06-10', '', '../vistas/img/productos/202406011411291361.jpeg', 1, '2024-06-01 07:11:29'),
(49, 29, 'P003', 'Pavita ', 11.00, 34, '2024-06-16', '', '../vistas/img/productos/202406011412113401.jpeg', 1, '2024-06-01 07:12:11');

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
(16, 'Jorge Chavez Huincho', '72243562', '920468502', 'jorge1234@gmail.com', '../vistas/img/trabajador/202406011423122416.jpeg', '../vistas/pdf/trabajador/202406011423126724.pdf', 'efectivo', '', 1),
(17, 'Luis', '23122345', '923434123', 'luis@gmail.com', '../vistas/img/trabajador/202406011424109177.jpeg', '../vistas/pdf/trabajador/202406011424107744.pdf', 'efectivo', '', 1);

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
(124, 'Jorge chavez Huincho', 1, '72243561', 'Av. Ninguno #456', '920468001', 'jorge@gmail.com', 'Jorge', '$2a$07$asxx54ahjppf45sd87a5auKKweOnGVRntDRMQN.CVMrzvBvwrBU/C', '../vistas/img/usuarios/202405240419369573.jpg', 1, '2024-05-23 21:19:36', '[\"administrador\",\"cajero\",\"ayudante\"]'),
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
(9, 16, '2024-06-30', '2024-07-30', 0);

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
(80, 1, 124, '2024-06-01', 'ticket', 'T0001', '0001', 0.00, 283.40, 283.40, 283.40, 0.00, 'contado', 'completado', 'efectivo', '2024-06-01 07:17:32'),
(81, 1, 124, '2024-06-01', 'ticket', 'T0002', '0002', 0.00, 156.60, 56.60, 156.60, 0.00, 'credito', 'pendiente', 'Ninguno', '2024-06-01 07:18:07'),
(82, 1, 124, '2024-06-01', 'ticket', 'T0003', '0003', 0.00, 72.00, 72.00, 72.00, 0.00, 'contado', 'completado', 'yape', '2024-06-01 07:18:52'),
(95, 1, 124, '2024-06-06', 'ticket', 'T0016', '0016', 0.00, 18.00, 18.00, 18.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-06 15:38:40'),
(96, 1, 124, '2024-06-06', 'ticket', 'T0017', '0017', 0.00, 0.00, 0.00, 0.00, 0.00, 'contado', 'completado', 'yape', '2024-06-06 15:49:13'),
(99, 1, 124, '2024-06-07', 'ticket', 'T0018', '0018', 0.00, 8.70, 8.70, 8.70, 0.00, 'contado', 'completado', 'efectivo', '2024-06-06 20:00:39'),
(100, 1, 124, '2024-06-07', 'ticket', 'T0019', '0019', 0.00, 10.78, 10.78, 10.78, 0.00, 'contado', 'completado', 'efectivo', '2024-06-06 20:01:35'),
(101, 1, 124, '2024-06-07', 'ticket', 'T0020', '0020', 0.00, 1107.00, 1107.00, 1107.00, 0.00, 'contado', 'completado', 'efectivo', '2024-06-06 20:06:03');

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
-- AUTO_INCREMENT de la tabla `asistencia_trabajadores`
--
ALTER TABLE `asistencia_trabajadores`
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `config_ticket`
--
ALTER TABLE `config_ticket`
  MODIFY `id_config_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `contratos_trabajadores`
--
ALTER TABLE `contratos_trabajadores`
  MODIFY `id_contrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `detalle_egreso`
--
ALTER TABLE `detalle_egreso`
  MODIFY `id_detalle_egreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT de la tabla `egresos`
--
ALTER TABLE `egresos`
  MODIFY `id_egreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT de la tabla `impresora`
--
ALTER TABLE `impresora`
  MODIFY `id_impresora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pagos_trabajadores`
--
ALTER TABLE `pagos_trabajadores`
  MODIFY `id_pagos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `tipo_documentos`
--
ALTER TABLE `tipo_documentos`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `id_trabajador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  MODIFY `id_vacacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

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
