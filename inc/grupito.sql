-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-03-2020 a las 17:49:50
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `grupito`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
  `idDetallePedido` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detallepedido`
--

INSERT INTO `detallepedido` (`idDetallePedido`, `idPedido`, `idProducto`, `cantidad`, `precio`) VALUES
(1, 2, 2, 3, '12.99'),
(2, 2, 1, 2, '6.40'),
(3, 2, 4, 1, '14.99'),
(4, 3, 1, 2, '6.40'),
(5, 4, 2, 3, '12.99'),
(6, 5, 2, 1, '12.99'),
(7, 6, 1, 1, '6.40'),
(8, 7, 1, 1, '6.40'),
(9, 8, 2, 2, '12.99'),
(10, 8, 6, 7, '1.95'),
(11, 8, 3, 2, '4.90'),
(12, 8, 4, 2, '14.99');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` decimal(10,2) NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`idPedido`, `idUsuario`, `fecha`, `total`, `estado`) VALUES
(2, 1, '2020-02-18 17:39:19', '66.76', ''),
(3, 1, '2020-02-18 17:48:16', '12.80', ''),
(4, 3, '2020-02-18 17:48:37', '38.97', ''),
(5, 1, '2020-02-18 17:52:43', '12.99', ''),
(6, 1, '2020-02-18 17:59:16', '6.40', ''),
(7, 1, '2020-02-18 18:04:50', '6.40', ''),
(8, 1, '2020-02-27 13:41:07', '79.41', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `introDescripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `precioOferta` decimal(10,2) NOT NULL,
  `online` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `nombre`, `introDescripcion`, `descripcion`, `imagen`, `precio`, `precioOferta`, `online`) VALUES
(1, 'Yelmo Cines', 'Entrada al cine con opción de menú en Yelmo Madrid o resto de península (hasta 44% de descuento)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consequat ullamcorper nisl. Nulla sed felis scelerisque, aliquet neque nec, laoreet velit. Integer leo dolor, eleifend gravida dui id, convallis bibendum arcu. Mauris quis sem mi. Nulla ', 'yelmo.jpg', '9.10', '6.40', 1),
(2, 'Invernalia', 'Acceso a la pista de hielo con alquiler de patines para 2 o 4 personas en Invernalia (hasta 37%)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consequat ullamcorper nisl. Nulla sed felis scelerisque, aliquet neque nec, laoreet velit. Integer leo dolor, eleifend gravida dui id, convallis bibendum arcu. Mauris quis sem mi. Nulla ', 'patinaje.jpg', '19.00', '12.99', 1),
(3, 'Multicines Norte', 'Entrada al cine y combo mediano para 1, 2 o 4 personas desde 4,90 € en Multicines Norte', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consequat ullamcorper nisl. Nulla sed felis scelerisque, aliquet neque nec, laoreet velit. Integer leo dolor, eleifend gravida dui id, convallis bibendum arcu. Mauris quis sem mi. Nulla ', 'cine.jpg', '9.50', '4.90', 1),
(4, 'Arepa Olé Street Vigo', 'Menú para 2 o 4 personas con entrante, arepa, postre y bebida en Arepa Ole Street Vigo (hasta 45%)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consequat ullamcorper nisl. Nulla sed felis scelerisque, aliquet neque nec, laoreet velit. Integer leo dolor, eleifend gravida dui id, convallis bibendum arcu. Mauris quis sem mi. Nulla ', 'comida.jpg', '26.40', '14.99', 1),
(5, 'Pack de 4 almohadas Visco Cashmere', 'Estas almohadas son ideales para dormir de forma cómoda y saludable.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consequat ullamcorper nisl. Nulla sed felis scelerisque, aliquet neque nec, laoreet velit. Integer leo dolor, eleifend gravida dui id, convallis bibendum arcu. Mauris quis sem mi.', 'almohada.jpg', '39.99', '14.99', 1),
(6, 'Camp Nou Experience & Tour', 'Paga 1,95 € por un descuento del 50% en la entrada regular y guiada al Barça Stadium Tour & Museum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consequat ullamcorper nisl. Nulla sed felis scelerisque, aliquet neque nec, laoreet velit. Integer leo dolor, eleifend gravida dui id, convallis bibendum arcu. Mauris quis sem mi.', 'futbol.jpg', '5.00', '1.95', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `online` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `email`, `password`, `nombre`, `apellidos`, `direccion`, `telefono`, `online`) VALUES
(1, 'mauro@gmail.com', '$2y$10$3H.Y.w9PikmPZk6aZL/bY.AEkIOpTuFx4REfZXvwKa7gQ.Rv6Ip92', 'Mauro', 'Rodríguez Pousada', 'Calle Síngulis, 20', '111222333', 1),
(3, 'prueba@gmail.com', '$2y$10$Jauo1AqjAzIkrmm2doY5OOpOWf1qsRIU71haXNXJ12fqght40LMJ.', 'a', 'b c', 'ey', '123', 1),
(4, 'ana@gmail.com', '$2y$10$7he6G.lxaMdcV/k2Dvf7Q.SWptK2Nf1LjyvyDf2KI7szYwF./V3t6', 'Ana', 'Malvido', 'C/ Inventada, S/N', '111222333', 1),
(5, 'adri@gmail.com', '$2y$10$6OtIF4olrb.xbfbzclVCBetc/oQkKSbKBudHm42QRxhAG8gcAZktS', 'Adri', 'Inventado', 'C/ Prueba, 34', '999888777', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD PRIMARY KEY (`idDetallePedido`),
  ADD KEY `idPedido` (`idPedido`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  MODIFY `idDetallePedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `detallepedido_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
  ADD CONSTRAINT `detallepedido_ibfk_2` FOREIGN KEY (`idPedido`) REFERENCES `pedidos` (`idPedido`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
