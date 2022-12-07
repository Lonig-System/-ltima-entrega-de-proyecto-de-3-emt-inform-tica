CREATE DATABASE  IF NOT EXISTS `seguridadcorporal` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `seguridadcorporal`;
-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: localhost    Database: seguridadcorporal
-- ------------------------------------------------------
-- Server version	5.5.68-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `NumUsuarioCl` int(11) NOT NULL,
  `Verificacion` tinyint(1) NOT NULL,
  PRIMARY KEY (`NumUsuarioCl`),
  CONSTRAINT `NumUsuarioCl` FOREIGN KEY (`NumUsuarioCl`) REFERENCES `usuario` (`NumUsuario`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (30,1),(31,1);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comprador`
--

DROP TABLE IF EXISTS `comprador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comprador` (
  `NumUsuarioCo` int(11) NOT NULL,
  `AñoIngreso` date DEFAULT NULL,
  PRIMARY KEY (`NumUsuarioCo`),
  CONSTRAINT `fk_Jefe_Usuario0` FOREIGN KEY (`NumUsuarioCo`) REFERENCES `usuario` (`NumUsuario`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comprador`
--

LOCK TABLES `comprador` WRITE;
/*!40000 ALTER TABLE `comprador` DISABLE KEYS */;
INSERT INTO `comprador` VALUES (29,'2022-11-07');
/*!40000 ALTER TABLE `comprador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comprador_compra_producto`
--

DROP TABLE IF EXISTS `comprador_compra_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comprador_compra_producto` (
  `NumUsuarioCo` int(11) NOT NULL,
  `IDProducto` int(11) NOT NULL,
  PRIMARY KEY (`NumUsuarioCo`,`IDProducto`),
  KEY `fk_Comprador_has_Producto_Producto2_idx` (`IDProducto`),
  KEY `fk_Comprador_has_Producto_Comprador2_idx` (`NumUsuarioCo`),
  CONSTRAINT `fk_Comprador_has_Producto_Comprador2` FOREIGN KEY (`NumUsuarioCo`) REFERENCES `usuario` (`NumUsuario`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_Comprador_has_Producto_Producto2` FOREIGN KEY (`IDProducto`) REFERENCES `producto` (`IDProducto`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comprador_compra_producto`
--

LOCK TABLES `comprador_compra_producto` WRITE;
/*!40000 ALTER TABLE `comprador_compra_producto` DISABLE KEYS */;
/*!40000 ALTER TABLE `comprador_compra_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comprador_gestiona_producto`
--

DROP TABLE IF EXISTS `comprador_gestiona_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comprador_gestiona_producto` (
  `NumUsuarioCo` int(11) NOT NULL,
  `IDProducto` int(11) NOT NULL,
  PRIMARY KEY (`NumUsuarioCo`,`IDProducto`),
  KEY `fk_Comprador_has_Producto_Producto1_idx` (`IDProducto`),
  KEY `fk_Comprador_has_Producto_Comprador1_idx` (`NumUsuarioCo`),
  CONSTRAINT `fk_Comprador_has_Producto_Comprador1` FOREIGN KEY (`NumUsuarioCo`) REFERENCES `usuario` (`NumUsuario`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_Comprador_has_Producto_Producto1` FOREIGN KEY (`IDProducto`) REFERENCES `producto` (`IDProducto`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comprador_gestiona_producto`
--

LOCK TABLES `comprador_gestiona_producto` WRITE;
/*!40000 ALTER TABLE `comprador_gestiona_producto` DISABLE KEYS */;
/*!40000 ALTER TABLE `comprador_gestiona_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `direccion`
--

DROP TABLE IF EXISTS `direccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `direccion` (
  `NumUsuario` int(11) NOT NULL,
  `NumPuerta` varchar(45) DEFAULT NULL,
  `Calle` varchar(45) DEFAULT NULL,
  `Barrio` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`NumUsuario`),
  CONSTRAINT `NumUsuario` FOREIGN KEY (`NumUsuario`) REFERENCES `usuario` (`NumUsuario`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `direccion`
--

LOCK TABLES `direccion` WRITE;
/*!40000 ALTER TABLE `direccion` DISABLE KEYS */;
INSERT INTO `direccion` VALUES (15,'123',NULL,NULL);
/*!40000 ALTER TABLE `direccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factura`
--

DROP TABLE IF EXISTS `factura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `factura` (
  `IDFactura` int(11) NOT NULL AUTO_INCREMENT,
  `Pedido_IDPedido` int(11) NOT NULL,
  PRIMARY KEY (`IDFactura`,`Pedido_IDPedido`),
  KEY `fk_Factura_Pedido1_idx` (`Pedido_IDPedido`),
  CONSTRAINT `fk_Factura_Pedido1` FOREIGN KEY (`Pedido_IDPedido`) REFERENCES `pedido` (`IDPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factura`
--

LOCK TABLES `factura` WRITE;
/*!40000 ALTER TABLE `factura` DISABLE KEYS */;
INSERT INTO `factura` VALUES (1,5),(2,8);
/*!40000 ALTER TABLE `factura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jefe`
--

DROP TABLE IF EXISTS `jefe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jefe` (
  `NumUsuarioJe` int(11) NOT NULL,
  `AñoIngreso` date DEFAULT NULL,
  PRIMARY KEY (`NumUsuarioJe`),
  CONSTRAINT `jefe` FOREIGN KEY (`NumUsuarioJe`) REFERENCES `usuario` (`NumUsuario`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jefe`
--

LOCK TABLES `jefe` WRITE;
/*!40000 ALTER TABLE `jefe` DISABLE KEYS */;
/*!40000 ALTER TABLE `jefe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paquete`
--

DROP TABLE IF EXISTS `paquete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paquete` (
  `IDPaquete` int(11) NOT NULL AUTO_INCREMENT,
  `IDProducto` varchar(99) DEFAULT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Descuento` varchar(99) DEFAULT NULL,
  `Cantidad_Producto` varchar(99) DEFAULT NULL,
  PRIMARY KEY (`IDPaquete`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paquete`
--

LOCK TABLES `paquete` WRITE;
/*!40000 ALTER TABLE `paquete` DISABLE KEYS */;
INSERT INTO `paquete` VALUES (2,'27:27','123','15','3:1');
/*!40000 ALTER TABLE `paquete` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedido` (
  `IDPedido` int(11) NOT NULL AUTO_INCREMENT,
  `IDProducto` varchar(99) NOT NULL,
  `IDPaquete` varchar(99) NOT NULL,
  `NumUsuarioCl` int(11) NOT NULL,
  `Estado` varchar(99) NOT NULL,
  `Fecha_Realizado` date NOT NULL,
  `Verificacion` int(1) NOT NULL,
  `Precio` int(11) NOT NULL,
  `CantidadProducto` varchar(99) NOT NULL,
  PRIMARY KEY (`IDPedido`,`IDProducto`,`IDPaquete`),
  KEY `fk_Pedido_Producto1_idx` (`IDProducto`),
  KEY `fk_Pedido_Paquete1_idx` (`IDPaquete`),
  KEY `fk_Pedido_Cliente1_idx` (`NumUsuarioCl`),
  CONSTRAINT `fk_Pedido_Cliente1` FOREIGN KEY (`NumUsuarioCl`) REFERENCES `usuario` (`NumUsuario`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido`
--

LOCK TABLES `pedido` WRITE;
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
INSERT INTO `pedido` VALUES (5,'24:26:18','2',15,'pago pendiente','2022-11-07',1,56,'2:1:3-2'),(6,'24:26:18','2',15,'pago pendiente','2022-11-07',0,56,'2:1:3-2'),(8,'24:26:18','2',15,'pago pendiente','2022-11-07',1,94,'2:1:3-2');
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido_asigna_repartidor`
--

DROP TABLE IF EXISTS `pedido_asigna_repartidor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedido_asigna_repartidor` (
  `IDPedido` int(11) NOT NULL,
  `NumUsuarioRe` int(11) NOT NULL,
  PRIMARY KEY (`IDPedido`,`NumUsuarioRe`),
  KEY `fk_Pedido_has_Repartidor_Repartidor1_idx` (`NumUsuarioRe`),
  KEY `fk_Pedido_has_Repartidor_Pedido1_idx` (`IDPedido`),
  CONSTRAINT `fk_Pedido_has_Repartidor_Pedido1` FOREIGN KEY (`IDPedido`) REFERENCES `pedido` (`IDPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pedido_has_Repartidor_Repartidor1` FOREIGN KEY (`NumUsuarioRe`) REFERENCES `repartidor` (`NumUsuarioRe`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido_asigna_repartidor`
--

LOCK TABLES `pedido_asigna_repartidor` WRITE;
/*!40000 ALTER TABLE `pedido_asigna_repartidor` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedido_asigna_repartidor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `IDProducto` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `Descripcion` varchar(999) NOT NULL,
  `Precio` decimal(11,2) NOT NULL,
  `Stock` int(11) NOT NULL,
  `IDProveedor` int(11) DEFAULT NULL,
  `Foto` varchar(45) DEFAULT NULL,
  `Tipo` int(4) DEFAULT NULL,
  PRIMARY KEY (`IDProducto`),
  KEY `fk_Producto_Proveedor1_idx` (`IDProveedor`),
  CONSTRAINT `fk_Producto_Proveedor1` FOREIGN KEY (`IDProveedor`) REFERENCES `proveedor` (`IDProveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (18,'Remera polo','ComposiciÃ³n: 35 % algodÃ³n/ 65% polyester\r gramaje 210 g\r Talles: S al XXXL ',8.20,30,0,'re.jpg',5),(19,'Guantes de hilo','Guantes de hilo con palma de PU Ãºnico talle.',49.50,30,0,'gun.jpg',4),(21,'Lentes claro','Lentes claro de policarbonato cada uno   mas iva',1.50,30,0,'len.jpg',2),(22,'Bermuda cargo reforzada','Bermuda cargo reforzada varios colores 100% algodon. ',14.30,30,0,'pon.jpg',6),(24,'Zapatos de seguridad','Zapatos de seguridad amarillo suela sin puntera marca Bompel\r\nConsulte!!!\r\nMas iva',17.00,30,0,'cal.jpg',7),(25,'Casco de proteccion','DiseÃ±ado para proteger la cabeza del impacto de objetos que caen libremente.\r\nDiseÃ±o modular que permite el montaje de productos de protecciÃ³n facial, auditiva, ocular.\r\nFabricado en polietileno, se distingue por su moderno diseÃ±o y excelente terminaciÃ³n.\r\nSuspensiÃ³n sintÃ©tica con ajuste de pines.\r\n8 tiras de suspensiÃ³n en 8 puntos de fijaciÃ³n al casco.\r\nRegulaciÃ³n de altura de la suspensiÃ³n en 3 niveles.\r\nMas iva',4.50,30,0,'cas.jpg',1),(26,'Tapaboca descartable','Tapaboca descartable con elÃ¡stico triple capa\r\nFiltro bacteriolÃ³gico al 99 % mientras la estructura estÃ¡ seca\r\nEmbalaje: caja con 50 unidades\r\nColor: celeste\r\nMÃ¡s iva',2.00,30,0,'tapa.png',9),(27,'Equipo de lluvia oxford','Equipo de lluvia oxford de muy buena calidad azul\r\nMas iva',16.50,30,0,'ll.jpg',8);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto_has_proveedor`
--

DROP TABLE IF EXISTS `producto_has_proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto_has_proveedor` (
  `Producto_IDProducto` int(11) NOT NULL,
  `Proveedor_IDProveedor` int(11) NOT NULL,
  PRIMARY KEY (`Producto_IDProducto`,`Proveedor_IDProveedor`),
  KEY `fk_Producto_has_Proveedor_Proveedor1_idx` (`Proveedor_IDProveedor`),
  KEY `fk_Producto_has_Proveedor_Producto1_idx` (`Producto_IDProducto`),
  CONSTRAINT `fk_Producto_has_Proveedor_Producto1` FOREIGN KEY (`Producto_IDProducto`) REFERENCES `producto` (`IDProducto`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_Producto_has_Proveedor_Proveedor1` FOREIGN KEY (`Proveedor_IDProveedor`) REFERENCES `proveedor` (`IDProveedor`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto_has_proveedor`
--

LOCK TABLES `producto_has_proveedor` WRITE;
/*!40000 ALTER TABLE `producto_has_proveedor` DISABLE KEYS */;
INSERT INTO `producto_has_proveedor` VALUES (18,0),(19,0),(21,0),(22,0),(24,0),(25,0),(26,0),(27,0);
/*!40000 ALTER TABLE `producto_has_proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedor` (
  `IDProveedor` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) DEFAULT NULL,
  `PaginaWeb` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IDProveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedor`
--

LOCK TABLES `proveedor` WRITE;
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` VALUES (0,'No seleccionado',NULL),(1,'Montevideo uniformes','https://montevideouniformes.uy/'),(2,'Fupi','https://www.fupi.com.uy/'),(3,'Vicas','https://www.vicas.com.uy/'),(4,'Garimport','https://www.garimport.com/');
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remito`
--

DROP TABLE IF EXISTS `remito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `remito` (
  `IDRemito` int(11) NOT NULL AUTO_INCREMENT,
  `Pedido_IDPedido` int(11) NOT NULL,
  PRIMARY KEY (`IDRemito`,`Pedido_IDPedido`),
  KEY `fk_Remito_Pedido1_idx` (`Pedido_IDPedido`),
  CONSTRAINT `fk_Remito_Pedido1` FOREIGN KEY (`Pedido_IDPedido`) REFERENCES `pedido` (`IDPedido`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remito`
--

LOCK TABLES `remito` WRITE;
/*!40000 ALTER TABLE `remito` DISABLE KEYS */;
INSERT INTO `remito` VALUES (1,8);
/*!40000 ALTER TABLE `remito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repartidor`
--

DROP TABLE IF EXISTS `repartidor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repartidor` (
  `NumUsuarioRe` int(11) NOT NULL,
  `AñoIngreso` date DEFAULT NULL,
  PRIMARY KEY (`NumUsuarioRe`),
  CONSTRAINT `fk_Jefe_Usuario010` FOREIGN KEY (`NumUsuarioRe`) REFERENCES `usuario` (`NumUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repartidor`
--

LOCK TABLES `repartidor` WRITE;
/*!40000 ALTER TABLE `repartidor` DISABLE KEYS */;
/*!40000 ALTER TABLE `repartidor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `NumUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `Telefono` int(11) NOT NULL,
  `FNacimiento` date NOT NULL,
  `Contra` varchar(100) NOT NULL,
  `Tipo` int(1) NOT NULL,
  PRIMARY KEY (`NumUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (15,'Guan','De Tal','ejemplo@gmail.com',92568423,'1998-05-24','*87AB814E5B89C7BFC390F4CD7BB93D716DE7EDA9',0),(28,'Santiago','Costa','ejmplo@ejem.com',123,'1990-07-12','*23AE809DDACAF96AF0FD78ED04B6A265E05AA257',1),(29,'Dulo','Acostaa','ejemplo@ejem.com',123,'1992-06-17','*8219F47CAE10FAAFD6CEB090F986110655353578',2),(30,'Lucia','Catillo','ejemplo@ejem.com',123,'1993-06-09','*23AE809DDACAF96AF0FD78ED04B6A265E05AA257',4),(31,'Lucas','Ropetch','ejemplo@ejem.com',123,'1990-07-12','*23AE809DDACAF96AF0FD78ED04B6A265E05AA257',4);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendedor`
--

DROP TABLE IF EXISTS `vendedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendedor` (
  `NumUsuarioVe` int(11) NOT NULL,
  `AñoIngreso` date DEFAULT NULL,
  PRIMARY KEY (`NumUsuarioVe`),
  CONSTRAINT `fk_Jefe_Usuario` FOREIGN KEY (`NumUsuarioVe`) REFERENCES `usuario` (`NumUsuario`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendedor`
--

LOCK TABLES `vendedor` WRITE;
/*!40000 ALTER TABLE `vendedor` DISABLE KEYS */;
INSERT INTO `vendedor` VALUES (28,'2022-11-07');
/*!40000 ALTER TABLE `vendedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendedor_verifica_cliente`
--

DROP TABLE IF EXISTS `vendedor_verifica_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendedor_verifica_cliente` (
  `NumUsuarioVe` int(11) NOT NULL,
  `NumUsuarioCl` int(11) NOT NULL,
  PRIMARY KEY (`NumUsuarioCl`),
  KEY `fk_Vendedor_has_Cliente_Cliente1_idx` (`NumUsuarioCl`),
  KEY `fk_Vendedor_has_Cliente_Vendedor1_idx` (`NumUsuarioVe`),
  CONSTRAINT `fk_Vendedor_has_Cliente_Cliente1` FOREIGN KEY (`NumUsuarioCl`) REFERENCES `cliente` (`NumUsuarioCl`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_Vendedor_has_Cliente_Vendedor1` FOREIGN KEY (`NumUsuarioVe`) REFERENCES `usuario` (`NumUsuario`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendedor_verifica_cliente`
--

LOCK TABLES `vendedor_verifica_cliente` WRITE;
/*!40000 ALTER TABLE `vendedor_verifica_cliente` DISABLE KEYS */;
INSERT INTO `vendedor_verifica_cliente` VALUES (15,31),(28,30);
/*!40000 ALTER TABLE `vendedor_verifica_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendedor_verifica_pedido`
--

DROP TABLE IF EXISTS `vendedor_verifica_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendedor_verifica_pedido` (
  `NumUsuarioVe` int(11) NOT NULL,
  `IDPedido` int(11) NOT NULL,
  PRIMARY KEY (`IDPedido`),
  KEY `fk_Vendedor_has_Pedido_Pedido1_idx` (`IDPedido`),
  KEY `fk_Vendedor_has_Pedido_Vendedor1_idx` (`NumUsuarioVe`),
  CONSTRAINT `fk_Vendedor_has_Pedido_Pedido1` FOREIGN KEY (`IDPedido`) REFERENCES `pedido` (`IDPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Vendedor_has_Pedido_Vendedor1` FOREIGN KEY (`NumUsuarioVe`) REFERENCES `vendedor` (`NumUsuarioVe`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendedor_verifica_pedido`
--

LOCK TABLES `vendedor_verifica_pedido` WRITE;
/*!40000 ALTER TABLE `vendedor_verifica_pedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendedor_verifica_pedido` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-07  6:26:19
