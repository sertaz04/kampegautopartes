-- MySQL dump 10.13  Distrib 5.5.25a, for Linux (x86_64)
--
-- Host: localhost    Database: EXCSA
-- ------------------------------------------------------
-- Server version	5.5.25a-cll

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
-- Table structure for table `CausasRefNCND`
--

DROP TABLE IF EXISTS `CausasRefNCND`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CausasRefNCND` (
  `NroNCND` int(10) NOT NULL,
  `TipoDocto` int(4) NOT NULL,
  `CausaEmision` int(4) NOT NULL,
  `Empresa` int(10) NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `TipoDoctoRef` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CausasRefNCND`
--

LOCK TABLES `CausasRefNCND` WRITE;
/*!40000 ALTER TABLE `CausasRefNCND` DISABLE KEYS */;
/*!40000 ALTER TABLE `CausasRefNCND` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DTE_Cesionarios`
--

DROP TABLE IF EXISTS `DTE_Cesionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DTE_Cesionarios` (
  `idCasionario` int(11) NOT NULL AUTO_INCREMENT,
  `rutCesionario` varchar(12) NOT NULL,
  `razonSocial` varchar(80) NOT NULL,
  `direccionCesionario` varchar(80) NOT NULL,
  `telefonoCesionario` varchar(30) NOT NULL,
  `emailContacto` varchar(50) NOT NULL,
  PRIMARY KEY (`idCasionario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DTE_Cesionarios`
--

LOCK TABLES `DTE_Cesionarios` WRITE;
/*!40000 ALTER TABLE `DTE_Cesionarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `DTE_Cesionarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DTE_Recibidos`
--

DROP TABLE IF EXISTS `DTE_Recibidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DTE_Recibidos` (
  `RutReceptor` varchar(12) NOT NULL,
  `RutEmisor` varchar(12) NOT NULL,
  `RznSocialEmisor` varchar(80) NOT NULL,
  `TipoDTE` int(4) NOT NULL,
  `TipoDTEDescripcion` varchar(70) NOT NULL,
  `FolioDTE` varchar(18) NOT NULL,
  `FechaEmision` varchar(20) NOT NULL,
  `MontoTotal` varchar(18) NOT NULL,
  `FechaRecepcion` varchar(20) NOT NULL,
  `CorreoUID` varchar(500) NOT NULL,
  `XMLRecibido` varchar(2000) NOT NULL,
  `FechaVencimiento` datetime NOT NULL,
  `EstadoValidacionXML` varchar(10) NOT NULL,
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `IdEnvio` varchar(100) NOT NULL,
  `EmailProveedor` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DTE_Recibidos`
--

LOCK TABLES `DTE_Recibidos` WRITE;
/*!40000 ALTER TABLE `DTE_Recibidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `DTE_Recibidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DTE_Respuesta`
--

DROP TABLE IF EXISTS `DTE_Respuesta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DTE_Respuesta` (
  `RutEmisor` varchar(12) NOT NULL,
  `TipoDTE` int(4) NOT NULL,
  `FolioDTE` varchar(18) NOT NULL,
  `RutReceptor` varchar(12) NOT NULL,
  `XmlRespuesta` varchar(2000) NOT NULL,
  `TipoRespuesta` int(10) NOT NULL,
  `EstadoRespuesta` int(10) NOT NULL,
  `FechaRespuesta` datetime NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `IdRespuesta` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`IdRespuesta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DTE_Respuesta`
--

LOCK TABLES `DTE_Respuesta` WRITE;
/*!40000 ALTER TABLE `DTE_Respuesta` DISABLE KEYS */;
/*!40000 ALTER TABLE `DTE_Respuesta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DTE_TipoDocumentos`
--

DROP TABLE IF EXISTS `DTE_TipoDocumentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DTE_TipoDocumentos` (
  `IdTipoDoc` int(4) NOT NULL,
  `NombreDoc` varchar(50) NOT NULL,
  `documento_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DTE_TipoDocumentos`
--

LOCK TABLES `DTE_TipoDocumentos` WRITE;
/*!40000 ALTER TABLE `DTE_TipoDocumentos` DISABLE KEYS */;
INSERT INTO `DTE_TipoDocumentos` VALUES (33,'FACTURA ELECTRONICA',26),(61,'NOTA CREDITO ELECTRONICA',24),(56,'NOTA DEBITO ELECTRONICA',23),(34,'FACTURA EXENTA ELECTRONICA',37),(52,'GUIA DESPACHO ELECTRONICA',14);
/*!40000 ALTER TABLE `DTE_TipoDocumentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DTE_TiposCambios`
--

DROP TABLE IF EXISTS `DTE_TiposCambios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DTE_TiposCambios` (
  `FechaTC` varchar(10) NOT NULL,
  `ValorObs` varchar(10) NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `FechaImport` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DTE_TiposCambios`
--

LOCK TABLES `DTE_TiposCambios` WRITE;
/*!40000 ALTER TABLE `DTE_TiposCambios` DISABLE KEYS */;
/*!40000 ALTER TABLE `DTE_TiposCambios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DTE_caf`
--

DROP TABLE IF EXISTS `DTE_caf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DTE_caf` (
  `Empresa` varchar(20) NOT NULL,
  `RutEmpresa` varchar(20) NOT NULL,
  `TipoDocto` varchar(4) NOT NULL,
  `CAFVigente` varchar(60) NOT NULL,
  `UltimoFolioUtilizado` varchar(10) NOT NULL DEFAULT '1',
  `PrimerFolio` varchar(10) NOT NULL,
  `UltimoFolio` varchar(10) NOT NULL,
  `FechaMov` varchar(20) NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `Vigente` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DTE_caf`
--

LOCK TABLES `DTE_caf` WRITE;
/*!40000 ALTER TABLE `DTE_caf` DISABLE KEYS */;
INSERT INTO `DTE_caf` VALUES ('1','5.847.862-8','33','5847862-8/33/FoliosSII58478623312018451349.xml','1','60','60','20180405','1000000000','SI');
/*!40000 ALTER TABLE `DTE_caf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DTE_envioSII`
--

DROP TABLE IF EXISTS `DTE_envioSII`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DTE_envioSII` (
  `NroDTE` int(10) NOT NULL,
  `TipoDocto` varchar(4) NOT NULL,
  `Empresa` varchar(10) NOT NULL,
  `Estado` varchar(5) NOT NULL,
  `Sistema` varchar(50) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `FechaRecepcion` varchar(50) NOT NULL,
  `IdSII` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DTE_envioSII`
--

LOCK TABLES `DTE_envioSII` WRITE;
/*!40000 ALTER TABLE `DTE_envioSII` DISABLE KEYS */;
INSERT INTO `DTE_envioSII` VALUES (1,'33','1','EPR','INTRANET','2018-04-09 00:00:00','ebusiness','2018-04-09',1),(1,'33','1','EPR','INTRANET','2018-04-09 00:00:00','ebusiness','2018-04-09',1),(1,'33','1','EPR','INTRANET','2018-04-09 00:00:00','ebusiness','2018-04-09',1);
/*!40000 ALTER TABLE `DTE_envioSII` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DTE_informacionEmpresas`
--

DROP TABLE IF EXISTS `DTE_informacionEmpresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DTE_informacionEmpresas` (
  `RUTEmisor` varchar(12) NOT NULL,
  `RznSoc` varchar(100) NOT NULL,
  `GiroEmis` varchar(150) NOT NULL,
  `DirOrigen` varchar(100) NOT NULL,
  `CiudadOrigen` varchar(50) NOT NULL,
  `CmnaOrigen` varchar(50) NOT NULL,
  `Acteco` varchar(50) NOT NULL,
  `CorreoEmisor` varchar(50) NOT NULL,
  `CdgVendedor` varchar(50) NOT NULL,
  `CodEmpresa` int(4) NOT NULL,
  `RutAutorizador` varchar(12) NOT NULL,
  `NroResolucion` varchar(50) NOT NULL,
  `FechaResolucion` int(20) NOT NULL,
  `CodSucSII` int(5) NOT NULL,
  `Rol` varchar(50) NOT NULL,
  `Pago` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DTE_informacionEmpresas`
--

LOCK TABLES `DTE_informacionEmpresas` WRITE;
/*!40000 ALTER TABLE `DTE_informacionEmpresas` DISABLE KEYS */;
INSERT INTO `DTE_informacionEmpresas` VALUES ('5.847.862-8','Nancy Magaly Hemmelmann Gálvez','Extintores, Seguridad, Publicidad, Librería, Ferretería, Asesorías','Villagrán 1251, LOS ANGELES','LOS ANGELES','LOS ANGELES','292980','ventas@excsaltda.cl','0',1,'5847862-8','80',20140822,204,'','0');
/*!40000 ALTER TABLE `DTE_informacionEmpresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `VIEW_COUNT_DTE_POR_TIPO`
--

DROP TABLE IF EXISTS `VIEW_COUNT_DTE_POR_TIPO`;
/*!50001 DROP VIEW IF EXISTS `VIEW_COUNT_DTE_POR_TIPO`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `VIEW_COUNT_DTE_POR_TIPO` (
  `NroDTE` bigint(21),
  `Tipo_Docto` bigint(20),
  `Fecha_Mov` varchar(100),
  `SubTotal` double(17,0),
  `Dcto_Monto` double(17,0),
  `Neto` double(17,0),
  `IVA` double(17,0),
  `Total` double(17,0),
  `CodEmpresa` int(11)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `VIEW_DTE_FACTURAS_AGRUPADA`
--

DROP TABLE IF EXISTS `VIEW_DTE_FACTURAS_AGRUPADA`;
/*!50001 DROP VIEW IF EXISTS `VIEW_DTE_FACTURAS_AGRUPADA`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `VIEW_DTE_FACTURAS_AGRUPADA` (
  `Factura` bigint(11),
  `Proceso` int(1),
  `Tipo_Docto` int(2),
  `Fecha_Mov` varchar(100),
  `O_Compra` varchar(80),
  `Est_Factura` int(1),
  `SubTotal` double(17,0),
  `Dcto_Monto` double(17,0),
  `Neto` double(17,0),
  `IVA` double(17,0),
  `Total` double(17,0),
  `Guias_Cadena` char(0),
  `Fec_Vcto` varchar(100),
  `NCERTFOR` varchar(13),
  `Total_Texto` varchar(4),
  `NroFactura` int(11),
  `IVA_Retener` int(1),
  `Destino_Dir` varchar(17),
  `Destino_Ciu` varchar(14),
  `Origen` varchar(6),
  `Chofer` varchar(13),
  `Rut_Chofer` varchar(10),
  `Patente_Camion` varchar(14),
  `Patente_Carro` varchar(13),
  `Transportista` varchar(20),
  `Rut_Transporte` varchar(17),
  `Despachador` varchar(18),
  `RutDespachador` varchar(14),
  `Observacion` varchar(367),
  `TipoDoctoRef` varchar(2),
  `causaNCND` int(1),
  `Fecha_Ref` varchar(8),
  `CL03_NombreLargo` varchar(100),
  `CL04_Rut` varchar(15),
  `CL05_Giro` text,
  `CL06_Dir` varchar(100),
  `CL07_Fono` varchar(100),
  `email` varchar(150),
  `NOMLARGO` varchar(50),
  `UN03_NombreLargo` varchar(2),
  `PRODUCTO` varchar(401),
  `NPzas` int(10),
  `NPqts` int(1),
  `Precio` double(17,0),
  `Moneda` varchar(12),
  `P_U` double(17,0),
  `Total_Volumen` decimal(11,3),
  `TCambio` int(1),
  `Total_Volumen_Factura` int(1),
  `Comuna` varchar(100),
  `Ciudad` varchar(100),
  `RUTEmisor` varchar(12),
  `RznSoc` varchar(100),
  `GiroEmis` varchar(150),
  `DirOrigen` varchar(100),
  `CiudadOrigen` varchar(50),
  `CmnaOrigen` varchar(50),
  `Acteco` varchar(50),
  `CorreoEmisor` varchar(50),
  `CdgVendedor` varchar(50),
  `CodEmpresa` int(4),
  `FechaResolucion` int(20),
  `NroResolucion` varchar(50),
  `RutAutorizador` varchar(12),
  `CodSucSII` int(5),
  `CAFVigente` varchar(60)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `VIEW_DTE_FACTURAS_AGRUPADA_NOTAS`
--

DROP TABLE IF EXISTS `VIEW_DTE_FACTURAS_AGRUPADA_NOTAS`;
/*!50001 DROP VIEW IF EXISTS `VIEW_DTE_FACTURAS_AGRUPADA_NOTAS`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `VIEW_DTE_FACTURAS_AGRUPADA_NOTAS` (
  `Factura` bigint(11),
  `Proceso` int(1),
  `Tipo_Docto` int(2),
  `Fecha_Mov` varchar(100),
  `O_Compra` varchar(9),
  `Est_Factura` int(1),
  `SubTotal` double(17,0),
  `Dcto_Monto` double(17,0),
  `Neto` double(17,0),
  `IVA` double(17,0),
  `Total` double(17,0),
  `Guias_Cadena` char(0),
  `Fec_Vcto` varchar(100),
  `NCERTFOR` varchar(13),
  `Total_Texto` varchar(4),
  `NroFactura` int(10),
  `IVA_Retener` int(1),
  `Destino_Dir` varchar(17),
  `Destino_Ciu` varchar(14),
  `Origen` varchar(6),
  `Chofer` varchar(13),
  `Rut_Chofer` varchar(10),
  `Patente_Camion` varchar(14),
  `Patente_Carro` varchar(13),
  `Transportista` varchar(20),
  `Rut_Transporte` varchar(17),
  `Despachador` varchar(18),
  `RutDespachador` varchar(14),
  `Observacion` varchar(367),
  `TipoDoctoRef` varchar(2),
  `causaNCND` int(11),
  `Fecha_Ref` varchar(100),
  `CL03_NombreLargo` varchar(100),
  `CL04_Rut` varchar(15),
  `CL05_Giro` text,
  `CL06_Dir` varchar(100),
  `CL07_Fono` varchar(100),
  `email` varchar(150),
  `NOMLARGO` varchar(50),
  `UN03_NombreLargo` varchar(2),
  `PRODUCTO` varchar(401),
  `NPzas` int(10),
  `NPqts` int(1),
  `Precio` double(17,0),
  `Moneda` varchar(12),
  `P_U` double(17,0),
  `Total_Volumen` decimal(11,3),
  `TCambio` int(1),
  `Total_Volumen_Factura` int(1),
  `Comuna` varchar(100),
  `Ciudad` varchar(100),
  `RUTEmisor` varchar(12),
  `RznSoc` varchar(100),
  `GiroEmis` varchar(150),
  `DirOrigen` varchar(100),
  `CiudadOrigen` varchar(50),
  `CmnaOrigen` varchar(50),
  `Acteco` varchar(50),
  `CorreoEmisor` varchar(50),
  `CdgVendedor` varchar(50),
  `CodEmpresa` int(4),
  `FechaResolucion` int(20),
  `NroResolucion` varchar(50),
  `RutAutorizador` varchar(12),
  `CodSucSII` int(5),
  `CAFVigente` varchar(60)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `VIEW_DTE_FACTURAS_LCV`
--

DROP TABLE IF EXISTS `VIEW_DTE_FACTURAS_LCV`;
/*!50001 DROP VIEW IF EXISTS `VIEW_DTE_FACTURAS_LCV`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `VIEW_DTE_FACTURAS_LCV` (
  `Factura` varchar(100),
  `Tipo_Docto` bigint(20),
  `Fecha_Mov` varchar(100),
  `SubTotal` double(17,0),
  `Dcto_Monto` double(17,0),
  `Neto` double(17,0),
  `IVA` double(17,0),
  `Total` double(17,0),
  `FactReferencia` bigint(20),
  `IVA_Retener` bigint(20),
  `TipoDoctoRef` varchar(2),
  `causaNCND` bigint(20),
  `Fecha_Ref` varchar(100),
  `CL03_NombreLargo` varchar(100),
  `CL04_Rut` varchar(100),
  `RUTEmisor` varchar(12),
  `RznSoc` varchar(100),
  `CodEmpresa` int(11),
  `FechaResolucion` int(20),
  `NroResolucion` varchar(50),
  `RutAutorizador` varchar(12),
  `TpoLibro` varchar(7),
  `AnhoLibro` bigint(20),
  `MesLibro` varchar(3),
  `Otros_imp` decimal(36,4)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `VIEW_DTE_RECIBIDO`
--

DROP TABLE IF EXISTS `VIEW_DTE_RECIBIDO`;
/*!50001 DROP VIEW IF EXISTS `VIEW_DTE_RECIBIDO`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `VIEW_DTE_RECIBIDO` (
  `RutReceptor` varchar(12),
  `RutEmisor` varchar(12),
  `RznSocialEmisor` varchar(80),
  `TipoDTE` int(4),
  `TipoDTEDescripcion` varchar(70),
  `FolioDTE` varchar(18),
  `FechaEmision` varchar(20),
  `MontoTotal` varchar(18),
  `FechaRecepcion` varchar(20),
  `CorreoUID` varchar(500),
  `XMLRecibido` varchar(2000),
  `FechaVencimiento` datetime,
  `EstadoValidacionXML` varchar(10),
  `ID` int(10),
  `EmailProveedor` varchar(100),
  `IdEnvio` varchar(100)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `VIEW_GUIAS_FACTURA`
--

DROP TABLE IF EXISTS `VIEW_GUIAS_FACTURA`;
/*!50001 DROP VIEW IF EXISTS `VIEW_GUIAS_FACTURA`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `VIEW_GUIAS_FACTURA` (
  `Guia` int(1),
  `Tipo_Docto` varchar(2),
  `Empresa` int(1),
  `TipoFactura` varchar(2),
  `NFactura` int(1),
  `Fecha_Mov` int(8)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `VIEW_GUIA_DESPACHO_LIBRO`
--

DROP TABLE IF EXISTS `VIEW_GUIA_DESPACHO_LIBRO`;
/*!50001 DROP VIEW IF EXISTS `VIEW_GUIA_DESPACHO_LIBRO`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `VIEW_GUIA_DESPACHO_LIBRO` (
  `Proceso` varchar(7),
  `Mov` varchar(3),
  `Guia_Original` int(1),
  `Tipo_Docto` varchar(2),
  `Estado_Docto` varchar(1),
  `Fecha_Mov` int(8),
  `Cliente` varchar(14),
  `Destino_Dir` varchar(11),
  `Destino_Ciu` varchar(14),
  `OrdenCompra` varchar(6),
  `TCambio` int(1),
  `OrdenT` varchar(10),
  `Origen` int(1),
  `Producto` varchar(8),
  `TOTPzas` int(1),
  `TOTPqts` int(1),
  `TOTVolumen` int(1),
  `Chofer` varchar(10),
  `Rut_Chofer` varchar(10),
  `Patente_Camion` varchar(14),
  `Patente_Carro` varchar(13),
  `Transportista` varchar(17),
  `Despachador` varchar(18),
  `CostoFlete` varchar(1),
  `CPago` int(1),
  `SubTotal` int(1),
  `Dscto_Porc1` int(1),
  `Dscto_Monto1` int(1),
  `Neto` int(1),
  `IVA_Porc` int(1),
  `IVA` int(1),
  `Total` int(1),
  `Nom_QRecibe` varchar(20),
  `Rut_QRecibe` varchar(17),
  `Efectivo` int(1),
  `ChFec001` int(1),
  `NCh001` int(1),
  `BcoCh001` int(1),
  `ChFec011` int(1),
  `NChFec011` int(1),
  `BcoChFec011` int(1),
  `ChFec021` int(1),
  `NChFec021` int(1),
  `BcoChFec021` int(1),
  `GuiaProveedor` varchar(4),
  `Moneda` int(1),
  `Monto_01` int(1),
  `Monto_02` int(1),
  `Monto_03` int(1),
  `EXP_EXI700` int(1),
  `FEC_EXI700` int(1),
  `Obs` varchar(12),
  `Destino` int(1),
  `Empresa` int(1),
  `Unidad_R` varchar(16),
  `Cantidad_R` int(1),
  `VolFlete` int(1),
  `Unidad_Flete` varchar(12),
  `Retorno` int(1),
  `Ruta` int(1),
  `Anulado_Por` varchar(12),
  `Fec_Anulacion` int(8),
  `F_Pago_Flete` int(1),
  `TCambio_Flete` int(1),
  `Autoriza_Pago_Flete` varchar(15),
  `AfectaPrecio` int(1),
  `AfectaVolumen` int(1),
  `Fec_Vcto` int(8),
  `Emitido` int(1),
  `Carguio` varchar(15),
  `Descarguio` varchar(18),
  `RecepcionCliente` int(1),
  `Cosecha` varchar(7),
  `IVA_Porc_Retener` int(1),
  `IVA_Retener` int(1),
  `Emite_Pago_Flete` varchar(22),
  `TipoDetalle` int(1),
  `CERTFOR` int(1),
  `NCERTFOR` varchar(24),
  `NroViaje` int(1),
  `CodFlete` int(1),
  `CL04_Rut` varchar(11),
  `CL03_NombreLargo` varchar(14),
  `TipoFactura` varchar(2),
  `NFactura` int(1),
  `FechaFactura` int(8)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `VIEW_LIBRO_COMPRA`
--

DROP TABLE IF EXISTS `VIEW_LIBRO_COMPRA`;
/*!50001 DROP VIEW IF EXISTS `VIEW_LIBRO_COMPRA`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `VIEW_LIBRO_COMPRA` (
  `NroDTE` bigint(21),
  `Tipo_Docto` bigint(20),
  `anho` bigint(20),
  `mes` varchar(2),
  `Fecha_Mov` varchar(100),
  `SubTotal` double(17,0),
  `Dcto_Monto` double(17,0),
  `Neto` double(17,0),
  `IVA` double(17,0),
  `Total` double(17,0),
  `Otros_imp` decimal(36,4),
  `CodEmpresa` int(11)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `VIEW_LIBRO_COMPRA_DETALLE`
--

DROP TABLE IF EXISTS `VIEW_LIBRO_COMPRA_DETALLE`;
/*!50001 DROP VIEW IF EXISTS `VIEW_LIBRO_COMPRA_DETALLE`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `VIEW_LIBRO_COMPRA_DETALLE` (
  `Factura` varchar(100),
  `Tipo_Docto` bigint(20),
  `anho` bigint(20),
  `mes` bigint(20),
  `Fecha_Mov` varchar(100),
  `SubTotal` double(17,0),
  `Dcto_Monto` double(17,0),
  `Neto` double(17,0),
  `IVA` double(17,0),
  `Total` double(17,0),
  `Otros_imp` decimal(23,0),
  `CodEmpresa` int(11)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `VIEW_LIBRO_VENTA`
--

DROP TABLE IF EXISTS `VIEW_LIBRO_VENTA`;
/*!50001 DROP VIEW IF EXISTS `VIEW_LIBRO_VENTA`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `VIEW_LIBRO_VENTA` (
  `NroDTE` bigint(21),
  `Tipo_Docto` bigint(20),
  `anho` bigint(20),
  `mes` bigint(20),
  `Fecha_Mov` varchar(100),
  `SubTotal` double(17,0),
  `Dcto_Monto` double(17,0),
  `Neto` double(17,0),
  `IVA` double(17,0),
  `Total` double(17,0),
  `CodEmpresa` int(11)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `VIEW_LIBRO_VENTAS_SIN_KILOS`
--

DROP TABLE IF EXISTS `VIEW_LIBRO_VENTAS_SIN_KILOS`;
/*!50001 DROP VIEW IF EXISTS `VIEW_LIBRO_VENTAS_SIN_KILOS`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `VIEW_LIBRO_VENTAS_SIN_KILOS` (
  `NroDTE` bigint(21),
  `Tipo_Docto` bigint(20),
  `anho` bigint(20),
  `mes` bigint(20),
  `Fecha_Mov` varchar(100),
  `SubTotal` double(17,0),
  `Dcto_Monto` double(17,0),
  `Neto` double(17,0),
  `IVA` double(17,0),
  `Total` double(17,0),
  `CodEmpresa` int(11)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `VIEW_LIBRO_VENTA_DETALLE`
--

DROP TABLE IF EXISTS `VIEW_LIBRO_VENTA_DETALLE`;
/*!50001 DROP VIEW IF EXISTS `VIEW_LIBRO_VENTA_DETALLE`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `VIEW_LIBRO_VENTA_DETALLE` (
  `Factura` int(11),
  `Tipo_Docto` bigint(20),
  `anho` bigint(20),
  `mes` bigint(20),
  `Fecha_Mov` varchar(100),
  `SubTotal` double(17,0),
  `Dcto_Monto` double(17,0),
  `Neto` double(17,0),
  `IVA` double(17,0),
  `Total` double(17,0),
  `CodEmpresa` int(11)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `bancos`
--

DROP TABLE IF EXISTS `bancos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bancos` (
  `banco_id` int(10) NOT NULL AUTO_INCREMENT,
  `banco_codigo` int(10) NOT NULL DEFAULT '0',
  `banco_name` varchar(50) NOT NULL,
  PRIMARY KEY (`banco_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bancos`
--

LOCK TABLES `bancos` WRITE;
/*!40000 ALTER TABLE `bancos` DISABLE KEYS */;
INSERT INTO `bancos` VALUES (1,9,'BANCO INTERNACIONAL'),(2,49,'BANCO SECURITY'),(3,504,'BBVA'),(4,16,'BCI'),(5,28,'BICE'),(6,1,'CHILE'),(7,27,'CORPBANCA'),(8,12,'ESTADO'),(9,51,'FALABELLA'),(10,39,'ITAU'),(11,37,'SANTANDER'),(12,14,'SCOTIABANK');
/*!40000 ALTER TABLE `bancos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bodega`
--

DROP TABLE IF EXISTS `bodega`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bodega` (
  `bodega_id` int(10) NOT NULL AUTO_INCREMENT,
  `bodega_nombre` varchar(50) NOT NULL,
  `bodega_capacidad` int(10) NOT NULL,
  `empresa_id` int(10) NOT NULL,
  `sucursal_id` int(10) NOT NULL,
  `user_create` varchar(100) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bodega_id`),
  KEY `FK_bodega_empresa` (`empresa_id`),
  CONSTRAINT `FK_bodega_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bodega`
--

LOCK TABLES `bodega` WRITE;
/*!40000 ALTER TABLE `bodega` DISABLE KEYS */;
INSERT INTO `bodega` VALUES (1,'BODEGA LOS ANGELES',0,1,0,'ruribe','2016-12-26 22:20:32','','0000-00-00 00:00:00',0);
/*!40000 ALTER TABLE `bodega` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `causas_emision`
--

DROP TABLE IF EXISTS `causas_emision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `causas_emision` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `codigo` int(10) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `user_create` varchar(100) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `causas_emision`
--

LOCK TABLES `causas_emision` WRITE;
/*!40000 ALTER TABLE `causas_emision` DISABLE KEYS */;
INSERT INTO `causas_emision` VALUES (1,1,'Anula Documento','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(2,2,'Corrige Texto','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(3,3,'Corrige Montos','','0000-00-00 00:00:00','','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `causas_emision` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `centro_costo`
--

DROP TABLE IF EXISTS `centro_costo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `centro_costo` (
  `centro_id` int(11) NOT NULL AUTO_INCREMENT,
  `centro_nombre` varchar(100) NOT NULL,
  `centro_codigo` int(10) DEFAULT NULL,
  `empresa_id` int(11) NOT NULL,
  `sucursal_id` int(10) NOT NULL,
  `user_create` varchar(100) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`centro_id`),
  KEY `FK_centro_costo_empresa` (`empresa_id`),
  CONSTRAINT `FK_centro_costo_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `centro_costo`
--

LOCK TABLES `centro_costo` WRITE;
/*!40000 ALTER TABLE `centro_costo` DISABLE KEYS */;
INSERT INTO `centro_costo` VALUES (1,'Caja - LOS ANGELES',1,1,1,'lvargas','2016-07-05 11:22:56','lvargas','2016-07-05 11:23:04',0);
/*!40000 ALTER TABLE `centro_costo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `claveSII`
--

DROP TABLE IF EXISTS `claveSII`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `claveSII` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_invoice` int(10) NOT NULL,
  `folio_DTE` int(10) NOT NULL,
  `fecha` varchar(50) DEFAULT NULL,
  `tipo_documento` int(10) DEFAULT NULL,
  `estado` int(10) DEFAULT NULL,
  `empresa_id` int(10) DEFAULT NULL,
  `user_create` varchar(50) DEFAULT NULL,
  `date_create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estadoSII` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_claveSII_estadoSII` (`estado`),
  KEY `FK_claveSII_tipo_documento` (`tipo_documento`),
  KEY `FK_claveSII_empresa` (`empresa_id`),
  KEY `id_invoice` (`id_invoice`),
  KEY `folio_DTE` (`folio_DTE`),
  CONSTRAINT `FK_claveSII_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`),
  CONSTRAINT `FK_claveSII_estadoSII` FOREIGN KEY (`estado`) REFERENCES `estadoSII` (`id`),
  CONSTRAINT `FK_claveSII_tipo_documento` FOREIGN KEY (`tipo_documento`) REFERENCES `tipo_documento` (`tipo_documento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `claveSII`
--

LOCK TABLES `claveSII` WRITE;
/*!40000 ALTER TABLE `claveSII` DISABLE KEYS */;
INSERT INTO `claveSII` VALUES (1,5,1,'2018-04-09',26,1,1,'ebusiness','2018-04-10 00:10:40',NULL);
/*!40000 ALTER TABLE `claveSII` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` varchar(15) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_fantasyname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `membership_number` varchar(100) NOT NULL,
  `prod_name` varchar(550) NOT NULL,
  `email` varchar(150) NOT NULL,
  `expected_date` varchar(500) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `comuna` varchar(100) NOT NULL,
  `note` varchar(500) NOT NULL,
  `empresa_id` int(10) NOT NULL,
  `sucursal_id` int(10) NOT NULL,
  `user_create` varchar(100) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete` int(1) NOT NULL DEFAULT '0',
  `tipo_cliente` varchar(50) DEFAULT NULL,
  `bloqueado` varchar(10) DEFAULT NULL,
  `rut_libre` varchar(10) DEFAULT NULL,
  `descuento` varchar(10) DEFAULT NULL,
  `porcentaje_maximo_descuento` varchar(20) DEFAULT NULL,
  `saldo_maximo` int(30) DEFAULT NULL,
  `vendedor_cartera` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`customer_id`),
  KEY `FK_customer_empresa` (`empresa_id`),
  CONSTRAINT `FK_customer_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=854 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (852,'76504231-3','INGENIERIA MARCELA MUÑOZ OJEDA EIRL','','PASAJE JOSE PRIDA 1651','HUGO MUÑOZ OJEDA','56 9 58163902','','CONSULTORÍA Y ASESORÍA INFORMATICA','informatica@ebusiness.cl','','TEMUCO','TEMUCO','',1,1,'ebusiness','2018-03-19 21:42:07','ebusiness','2018-04-09 23:38:35',0,'','','','true','10',2000000,'6'),(853,'79633220-4','BESALCO MAQUINARIAS SA','','JOSE JOAQUIN PRIETO 9660','ERWIN VASQUEZ','979762340','','ARRIENDO DE MAQUINARIAS','EVASQUEZ@BESALCO.CL','','SANTIAGO','EL BOSQUE','',1,1,'fsaldana','2018-03-20 13:12:24','','0000-00-00 00:00:00',0,'FORESTAL','','','','',0,'26');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresa` (
  `empresa_id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_nombre` varchar(100) NOT NULL,
  `empresa_rut` varchar(100) NOT NULL,
  `empresa_direccion` varchar(100) NOT NULL,
  `empresa_telefono` varchar(100) NOT NULL,
  `empresa_representante_legal` varchar(100) NOT NULL,
  `user_create` varchar(100) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`empresa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` VALUES (1,'Nancy Magaly Hemmelmann Gálvez','5.847.862-8','Villagrán 1251','43 2 369002','Nancy Magaly Hemmelmann Gálvez','','0000-00-00 00:00:00','SISTEMAS','2016-12-21 22:39:21',0);
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entrada_compra`
--

DROP TABLE IF EXISTS `entrada_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entrada_compra` (
  `entrada_compra_id` int(10) NOT NULL,
  `entrada_compra_fecha` varchar(100) NOT NULL,
  `user_create` varchar(10) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete` int(1) NOT NULL DEFAULT '0',
  `empresa_id` int(10) DEFAULT NULL,
  `sucursal_id` int(10) NOT NULL,
  KEY `FK_entrada_compra_empresa` (`empresa_id`),
  CONSTRAINT `FK_entrada_compra_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entrada_compra`
--

LOCK TABLES `entrada_compra` WRITE;
/*!40000 ALTER TABLE `entrada_compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `entrada_compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estadoSII`
--

DROP TABLE IF EXISTS `estadoSII`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estadoSII` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `estado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estadoSII`
--

LOCK TABLES `estadoSII` WRITE;
/*!40000 ALTER TABLE `estadoSII` DISABLE KEYS */;
INSERT INTO `estadoSII` VALUES (1,'EMITIDA'),(2,'RECHAZADA'),(3,'CON REPAROS'),(4,'ACEPTADA');
/*!40000 ALTER TABLE `estadoSII` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `family`
--

DROP TABLE IF EXISTS `family`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `family` (
  `family_id` int(10) NOT NULL AUTO_INCREMENT,
  `group_id` int(10) NOT NULL,
  `family_name` varchar(100) NOT NULL,
  `family_label` varchar(5) NOT NULL,
  `empresa_id` int(10) DEFAULT NULL,
  `sucursal_id` int(10) NOT NULL,
  `user_create` varchar(100) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`family_id`),
  KEY `FK_family_group` (`group_id`),
  KEY `FK_family_empresa` (`empresa_id`),
  CONSTRAINT `family_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`),
  CONSTRAINT `family_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `group` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=186 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `family`
--

LOCK TABLES `family` WRITE;
/*!40000 ALTER TABLE `family` DISABLE KEYS */;
INSERT INTO `family` VALUES (178,77,'EXTINTORES','EX',1,0,'fsaldana','2018-03-20 13:01:54','','0000-00-00 00:00:00',0),(179,77,'IMPLEMENTOS','IMP',1,0,'fsaldana','2018-03-20 13:02:16','','0000-00-00 00:00:00',0),(180,77,'LADRILLOS','LD',1,0,'fsaldana','2018-03-20 13:02:43','','0000-00-00 00:00:00',0),(181,77,'LETREROS','LT',1,0,'fsaldana','2018-03-20 13:02:52','','0000-00-00 00:00:00',0),(182,77,'LIBRERIA','LB',1,0,'fsaldana','2018-03-20 13:03:09','','0000-00-00 00:00:00',0),(183,77,'RED HUMEDA','RH',1,0,'fsaldana','2018-03-20 13:03:22','','0000-00-00 00:00:00',0),(184,77,'ROPA CORPORATIVA','RC',1,0,'fsaldana','2018-03-20 13:03:35','','0000-00-00 00:00:00',0),(185,77,'ARTICULOS DE ASEO','ADA',1,0,'fsaldana','2018-03-20 13:03:53','','0000-00-00 00:00:00',1);
/*!40000 ALTER TABLE `family` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forma_pago`
--

DROP TABLE IF EXISTS `forma_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forma_pago` (
  `forma_pago_id` int(10) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  `forma_pago_SII_code` int(10) NOT NULL,
  `forma_pago_SII_descipcion` varchar(50) NOT NULL,
  `user_create` varchar(100) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`forma_pago_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forma_pago`
--

LOCK TABLES `forma_pago` WRITE;
/*!40000 ALTER TABLE `forma_pago` DISABLE KEYS */;
INSERT INTO `forma_pago` VALUES (0,'Efectivo',1,'CONTADO','','2017-02-28 03:55:45','','0000-00-00 00:00:00'),(1,'Efectivo',1,'CONTADO','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(2,'Credito',2,'CREDITO','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(3,'Cheque al dia',2,'CREDITO','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(4,'Cheque a Fecha',2,'CREDITO','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(5,'Mixto cheque efectivo',2,'CREDITO','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(6,'Tarjeta credito debito',2,'CREDITO','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(7,'Transferencia Electronica',1,'CONTADO','','0000-00-00 00:00:00','','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `forma_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group` (
  `group_id` int(10) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) NOT NULL,
  `group_label` varchar(5) NOT NULL,
  `empresa_id` int(10) DEFAULT NULL,
  `user_create` varchar(100) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_id`),
  KEY `FK_group_empresa` (`empresa_id`),
  CONSTRAINT `FK_group_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group`
--

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` VALUES (77,'EXCSA','EXCSA',1,'fsaldana','2018-03-20 13:01:27','','0000-00-00 00:00:00',0);
/*!40000 ALTER TABLE `group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imei`
--

DROP TABLE IF EXISTS `imei`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imei` (
  `username` varchar(50) DEFAULT NULL,
  `imei` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imei`
--

LOCK TABLES `imei` WRITE;
/*!40000 ALTER TABLE `imei` DISABLE KEYS */;
INSERT INTO `imei` VALUES ('ruribe','353464082379349'),('emelipil','866432021099898'),('HMUNOZ','357735053241527');
/*!40000 ALTER TABLE `imei` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_entrada_compra`
--

DROP TABLE IF EXISTS `item_entrada_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_entrada_compra` (
  `item_entrada_id` int(10) NOT NULL AUTO_INCREMENT,
  `producto_id` int(10) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `invoice` int(10) NOT NULL,
  `bodega_id` int(10) NOT NULL,
  `seccion_id` int(10) NOT NULL,
  `empresa_id` int(10) NOT NULL,
  `sucursal_id` int(10) NOT NULL,
  `user_create` varchar(100) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`item_entrada_id`),
  KEY `FK_item_entrada_compra_products` (`producto_id`),
  KEY `FK_item_entrada_compra_empresa` (`empresa_id`),
  CONSTRAINT `FK_item_entrada_compra_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`),
  CONSTRAINT `FK_item_entrada_compra_products` FOREIGN KEY (`producto_id`) REFERENCES `products` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_entrada_compra`
--

LOCK TABLES `item_entrada_compra` WRITE;
/*!40000 ALTER TABLE `item_entrada_compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_entrada_compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_salida_venta`
--

DROP TABLE IF EXISTS `item_salida_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_salida_venta` (
  `item_salida_venta_id` int(10) NOT NULL AUTO_INCREMENT,
  `producto_id` int(10) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `invoice` int(10) NOT NULL,
  `bodega_id` int(10) NOT NULL,
  `seccion_id` int(10) NOT NULL,
  `empresa_id` int(10) DEFAULT NULL,
  `sucursal_id` int(10) NOT NULL,
  `user_create` varchar(100) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`item_salida_venta_id`),
  KEY `FK_item_salida_venta_products` (`producto_id`),
  KEY `FK_item_salida_venta_empresa` (`empresa_id`),
  CONSTRAINT `FK_item_salida_venta_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`),
  CONSTRAINT `FK_item_salida_venta_products` FOREIGN KEY (`producto_id`) REFERENCES `products` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_salida_venta`
--

LOCK TABLES `item_salida_venta` WRITE;
/*!40000 ALTER TABLE `item_salida_venta` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_salida_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL DEFAULT '0',
  `code` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `codebar` varchar(200) NOT NULL,
  `unit_purchase` varchar(100) NOT NULL,
  `unit_sale` varchar(100) NOT NULL,
  `avgcost` int(10) NOT NULL,
  `lastcost` int(10) NOT NULL,
  `marginsale` double(10,2) NOT NULL,
  `pricesale` int(10) NOT NULL,
  `marginspecial` double(10,2) NOT NULL,
  `pricespecial` int(10) NOT NULL,
  `originproduct` varchar(100) NOT NULL,
  `genericcode` varchar(100) NOT NULL,
  `maxdescount` int(10) NOT NULL,
  `codeaccount` int(10) NOT NULL,
  `nameaccount` varchar(100) NOT NULL,
  `codecenter` int(10) NOT NULL,
  `namecenter` varchar(100) NOT NULL,
  `inmovilizado` varchar(10) NOT NULL,
  `inventariable` varchar(10) NOT NULL,
  `stock` int(10) DEFAULT '0',
  `critica` int(10) DEFAULT '0',
  `group_id` int(10) NOT NULL,
  `family_id` int(10) NOT NULL,
  `subfamily_id` int(10) NOT NULL,
  `empresa_id` int(10) NOT NULL,
  `sucursal_id` int(10) NOT NULL,
  `details` varchar(255) NOT NULL,
  `user_create` varchar(100) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) DEFAULT NULL,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`),
  KEY `FK_products_group` (`group_id`),
  KEY `FK_products_family` (`family_id`),
  KEY `FK_products_subfamily` (`subfamily_id`),
  KEY `FK_products_empresa` (`empresa_id`),
  KEY `FK_products_supliers` (`supplier_id`),
  CONSTRAINT `FK_products_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`),
  CONSTRAINT `FK_products_family` FOREIGN KEY (`family_id`) REFERENCES `family` (`family_id`),
  CONSTRAINT `FK_products_group` FOREIGN KEY (`group_id`) REFERENCES `group` (`group_id`),
  CONSTRAINT `FK_products_subfamily` FOREIGN KEY (`subfamily_id`) REFERENCES `subfamily` (`subfamily_id`),
  CONSTRAINT `FK_products_supliers` FOREIGN KEY (`supplier_id`) REFERENCES `supliers` (`suplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (5,15,'2','2','2','UN','UN',6,6,1000.00,66,1000.00,66,'Nacional','6',6,6,'6',1,'1','1','',0,0,77,178,84,1,1,'','ebusiness','2018-03-29 13:39:37',NULL,'0000-00-00 00:00:00',1),(6,15,'SNL','SENALETICA','01111','UN','UN',1000,500,50.00,750,50.00,750,'Nacional','SENALETICA',10,0,'LERERO',1,'1','0','',0,0,77,181,84,1,1,'','fsaldana','2018-03-29 13:41:31','ebusiness','2018-04-10 00:56:53',0),(7,15,'BL','BOLSO ALFOMBRA EXTINTOR','BL','UN','UN',1000,1000,110.80,2108,110.80,2108,'Nacional','BL',0,0,'BL',1,'1','0','',0,0,77,178,84,1,1,'','fsaldana','2018-03-30 18:55:33','fsaldana','2018-03-30 19:00:33',0),(8,15,'CIN','CINTILLO PORTA MANGUERA EXTINTOR','CIN','UN','UN',400,400,150.00,1000,150.00,1000,'Nacional','CIN',0,0,'CIN',1,'1','0','',0,0,77,178,84,1,1,'','fsaldana','2018-03-30 18:58:58','fsaldana','2018-03-30 18:59:34',0),(9,15,'DIF','DIFUSOR EXTINTOR 2 KILOS COW','DIF','UN','UN',1500,1500,153.33,3800,153.33,3800,'Nacional','DF',0,0,'DIF',1,'1','1','',0,0,77,178,84,1,1,'','fsaldana','2018-03-30 19:02:17',NULL,'0000-00-00 00:00:00',0),(10,15,'P1','EXTINTOR CERTIFICADO 1 KILO PQS','P1','UN','UN',4500,4500,53.33,6900,53.33,6900,'Nacional','P1',20,0,'P1',1,'1','1','',0,0,77,178,84,1,1,'','fsaldana','2018-03-30 19:03:34',NULL,'0000-00-00 00:00:00',0),(11,15,'P10','EXTINTOR CERTIFICADO 10 KILOS PQS','P10','UN','UN',16500,16500,0.00,26900,0.00,26900,'Nacional','P10',20,0,'P10',1,'1','1','',0,0,77,178,84,1,1,'','fsaldana','2018-03-30 19:05:07',NULL,'0000-00-00 00:00:00',0),(12,15,'P2','EXTINTOR CERTIFICADO 2 KILOS PQS','P2','UN','UN',6500,6500,67.69,10900,67.69,10900,'Nacional','P2',20,0,'P2',1,'1','1','',0,0,77,178,84,1,1,'','fsaldana','2018-03-30 19:48:37',NULL,'0000-00-00 00:00:00',0),(13,15,'P4','EXTINTOR CERTIFICADO 4 KILOS PQS','P4','UN','UN',9200,9200,94.57,17900,94.57,17900,'Nacional','P4',20,0,'P4',1,'1','1','',0,0,77,178,84,1,1,'','fsaldana','2018-03-30 19:53:35',NULL,'0000-00-00 00:00:00',0),(14,15,'02035075','GRAPAS 26/6 5000 UNID','02035075','UN','UN',0,0,0.00,0,0.00,0,'Nacional','0',0,0,'LIBRERIA',1,'1','1','',0,0,77,182,84,1,1,'','asaldana','2018-03-30 19:56:04',NULL,'0000-00-00 00:00:00',0),(15,15,'P5CO2','EXTINTOR CERTIFICADO 5 KILOS CO2','P5CO2','UN','UN',20000,20000,110.00,42000,110.00,42000,'Nacional','P5CO2',20,0,'P5CO2',1,'1','1','',0,0,77,178,84,1,1,'','fsaldana','2018-03-30 19:56:10',NULL,'0000-00-00 00:00:00',0),(16,15,'P6','EXTINTOR CERTIFICADO 6 KILOS PQS','P6','UN','UN',11900,11900,76.47,21000,76.47,21000,'Nacional','P6',20,0,'P6',1,'1','1','',0,0,77,178,84,1,1,'','fsaldana','2018-03-30 19:57:54',NULL,'0000-00-00 00:00:00',0),(17,15,'P6K','EXTINTOR CERTIFICADO 6 KILOS K','P6K','UN','UN',200000,200000,25.00,250000,25.00,250000,'Nacional','P6K',20,0,'EXTINTOR',1,'1','1','',0,0,77,178,84,1,1,'','fsaldana','2018-03-30 20:00:04',NULL,'0000-00-00 00:00:00',0),(18,15,'07003056','HOJAS DE CUADERNILLO OFICIO','07003056','UN','UN',0,0,0.00,0,0.00,0,'Nacional','0',0,0,'LIBRERIA',1,'1','1','',0,0,77,182,84,1,1,'','asaldana','2018-03-30 20:00:48',NULL,'0000-00-00 00:00:00',0),(19,15,'P100','EXTINTOR CARRO 100 KILOS PQS CERTIFICADO','P100','UN','UN',100000,100000,260.00,360000,260.00,360000,'Nacional','P100',20,0,'EXTINTOR',1,'1','1','',0,0,77,178,84,1,1,'','fsaldana','2018-03-30 20:01:16',NULL,'0000-00-00 00:00:00',0),(20,15,'P25','EXTINTOR CARRO 25 KILOS PQS CERTIFICADO','P25','UN','UN',100000,100000,80.00,180000,80.00,180000,'Nacional','P25',20,0,'EXTINTOR',1,'1','1','',0,0,77,178,84,1,1,'','fsaldana','2018-03-30 20:02:15',NULL,'0000-00-00 00:00:00',0),(21,15,'04011036','HOJAS TERMOLAMINADO PLASTIFICADO','04011036','UN','UN',1,1,1.00,1,1.00,1,'Nacional','1',1,0,'LIBRERIA',1,'1','1','',0,0,77,182,84,1,1,'','asaldana','2018-03-30 20:02:58',NULL,'0000-00-00 00:00:00',0),(22,15,'P50','EXTINTOR CARRO 50 KILOS PQS CERTIFICADO','P50','UN','UN',100000,100000,150.00,250000,150.00,250000,'Nacional','P50',20,0,'EXTINTOR',1,'1','1','',0,0,77,178,84,1,1,'','fsaldana','2018-03-30 20:03:07',NULL,'0000-00-00 00:00:00',0),(23,15,'P2CO2','EXTINTOR CERTIFICADO 2 KILOS CO2','P2CO2','UN','UN',19500,19500,51.28,29500,51.28,29500,'Nacional','P2CO2',20,0,'EXTINTOR',1,'1','1','',0,0,77,178,84,1,1,'','fsaldana','2018-03-30 20:05:12',NULL,'0000-00-00 00:00:00',0),(24,15,'P10CO2','EXTINTOR CARRO 10 KILOS CO2','P10CO2','UN','UN',80000,80000,37.50,110000,37.50,110000,'Nacional','P10CO2',20,0,'EXTINTOR',1,'1','1','',0,0,77,178,84,1,1,'','fsaldana','2018-03-30 20:07:23',NULL,'0000-00-00 00:00:00',0),(25,15,'02038248','LAPIZ GEL','02038248','UN','UN',1,1,1.00,1,1.00,1,'Nacional','1',1,2038248,'LIBRERIA',1,'1','1','',0,0,77,182,85,1,1,'','asaldana','2018-03-30 20:08:17',NULL,'0000-00-00 00:00:00',0),(26,15,'02038248','LAPIZ GEL','02038248','UN','UN',1,1,1.00,1,1.00,1,'Nacional','1',1,2038248,'LIBRERIA',1,'1','1','',0,0,77,182,85,1,1,'','asaldana','2018-03-30 20:08:20',NULL,'0000-00-00 00:00:00',0),(27,15,'P6CO2','EXTINTOR CERTIFICADO 6 KILOS CO2','P6CO2','UN','UN',35000,35000,40.00,49000,40.00,49000,'Nacional','P6CO2',20,0,'EXTINTOR',1,'1','1','',0,0,77,178,84,1,1,'','fsaldana','2018-03-30 20:10:07',NULL,'0000-00-00 00:00:00',0),(28,15,'FUNDA','FUNDA PVC EXTINTOR','FUNDA','UN','UN',7500,7500,68.07,12605,68.07,12605,'Nacional','FUNDA',20,0,'EXTINTOR',1,'1','1','',0,0,77,178,84,1,1,'','fsaldana','2018-03-30 20:10:54',NULL,'0000-00-00 00:00:00',0),(29,15,'02041041','LAPIZ BIC PUNTA FINA AZUL','02041041','UN','UN',1,1,1.00,120,1.00,1,'Nacional','1',1,0,'LIBRERIA',1,'1','1','',0,0,77,182,84,1,1,'','asaldana','2018-03-30 20:11:13',NULL,'0000-00-00 00:00:00',0),(30,15,'INSP','INSPECCION EXTINTORES','INSP','UN','UN',10,10,-100.00,0,-100.00,0,'Nacional','INSP',20,0,'EXTINTOR',1,'1','1','',0,0,77,178,84,1,1,'','fsaldana','2018-03-30 20:11:50',NULL,'0000-00-00 00:00:00',0),(31,15,'05057164','LAPIZ JUMBO GRAFITO 12 UNID','05057164','UN','UN',1,1,1.00,1,1.00,1,'Nacional','1',1,0,'LIBRERIA',1,'1','1','',0,0,77,182,84,1,1,'','asaldana','2018-03-30 20:13:13',NULL,'0000-00-00 00:00:00',0),(32,15,'INST','INSTALACION EXTINTOR','INST','UN','UN',500,500,600.00,3500,600.00,3500,'Nacional','INST',20,0,'EXTINTOR',1,'1','1','',0,0,77,178,84,1,1,'','fsaldana','2018-03-30 20:14:04',NULL,'0000-00-00 00:00:00',0),(33,15,'05057125','LAPIZ MINA HB N2 12UN ARTEL','05057125','UN','UN',1,1,1.00,1,1.00,1,'Nacional','1',1,0,'LIBRERIA',1,'1','1','',0,0,77,182,84,1,1,'','asaldana','2018-03-30 20:14:58',NULL,'0000-00-00 00:00:00',0),(34,15,'02041075','LAPIZ PASTA AZUL','02041075','UN','UN',1,1,1.00,1,1.00,1,'Nacional','1',1,0,'LIBRERIA',1,'1','1','',0,0,77,182,84,1,1,'','asaldana','2018-03-30 20:20:15',NULL,'0000-00-00 00:00:00',0),(35,15,'02041009','LAPIZ PASTA NEGRO BIC','02041009','UN','UN',1,1,1.00,1,1.00,1,'Nacional','1',1,0,'LIBRERIA',1,'1','1','',0,0,77,182,84,1,1,'','asaldana','2018-03-30 20:24:56',NULL,'0000-00-00 00:00:00',0),(36,15,'02041241','LAPIZ  PASTA AZUL KILOM PTA.FINA','02041241','UN','UN',1,1,1.00,1,1.00,1,'Nacional','1',1,0,'LIBRERIA',1,'1','1','',0,0,77,182,84,1,1,'','asaldana','2018-03-30 20:27:22',NULL,'0000-00-00 00:00:00',0);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puesto`
--

DROP TABLE IF EXISTS `puesto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `puesto` (
  `puesto_id` int(10) NOT NULL AUTO_INCREMENT,
  `puesto_nombre` varchar(100) NOT NULL,
  `user_create` varchar(100) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`puesto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puesto`
--

LOCK TABLES `puesto` WRITE;
/*!40000 ALTER TABLE `puesto` DISABLE KEYS */;
/*!40000 ALTER TABLE `puesto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchases` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(100) NOT NULL,
  `correlativo` int(11) NOT NULL,
  `fecha_factura` varchar(100) NOT NULL,
  `fecha_vencimiento` varchar(100) NOT NULL,
  `fecha_ingreso` varchar(100) NOT NULL,
  `suplier_id` int(11) NOT NULL,
  `tipo_productos` varchar(100) NOT NULL,
  `adicional` int(11) NOT NULL,
  `observaciones` varchar(200) NOT NULL,
  `retencion` int(11) NOT NULL,
  `exportacion` varchar(10) NOT NULL,
  `recuperable` varchar(10) NOT NULL,
  `centro_id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `tipo_documento_id` int(11) NOT NULL,
  `user_create` varchar(100) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`transaction_id`),
  KEY `FK_purchases_supliers` (`suplier_id`),
  KEY `FK_purchases_centro_costo` (`centro_id`),
  KEY `FK_purchases_empresa` (`empresa_id`),
  KEY `FK_purchases_tipo_documento` (`tipo_documento_id`),
  KEY `FK_purchases_sucursal` (`sucursal_id`),
  CONSTRAINT `FK_purchases_centro_costo` FOREIGN KEY (`centro_id`) REFERENCES `centro_costo` (`centro_id`),
  CONSTRAINT `FK_purchases_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`),
  CONSTRAINT `FK_purchases_sucursal` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursal` (`sucursal_id`),
  CONSTRAINT `FK_purchases_supliers` FOREIGN KEY (`suplier_id`) REFERENCES `supliers` (`suplier_id`),
  CONSTRAINT `FK_purchases_tipo_documento` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documento` (`tipo_documento_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchases`
--

LOCK TABLES `purchases` WRITE;
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchases_item`
--

DROP TABLE IF EXISTS `purchases_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchases_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(10) NOT NULL,
  `qty` double(11,3) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `descuento` int(10) NOT NULL,
  `empresa_id` int(10) NOT NULL,
  `sucursal_id` int(10) NOT NULL,
  `user_create` varchar(50) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_purchases_item_products` (`product_id`),
  KEY `FK_purchases_item_empresa` (`empresa_id`),
  CONSTRAINT `FK_purchases_item_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`),
  CONSTRAINT `FK_purchases_item_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchases_item`
--

LOCK TABLES `purchases_item` WRITE;
/*!40000 ALTER TABLE `purchases_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchases_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(100) DEFAULT NULL,
  `invoice_reference` varchar(100) DEFAULT NULL,
  `causa_emision_id` int(11) NOT NULL,
  `correlativo` int(11) DEFAULT NULL,
  `fecha_factura` varchar(100) NOT NULL,
  `fecha_vencimiento` varchar(100) NOT NULL,
  `fecha_ingreso` varchar(100) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `tipo_productos` varchar(100) NOT NULL,
  `adicional` int(11) NOT NULL,
  `observaciones` varchar(200) NOT NULL,
  `forma_pago_id` int(11) NOT NULL,
  `estado_pago` int(11) NOT NULL DEFAULT '0',
  `centro_id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `tipo_documento_id` int(11) NOT NULL,
  `chofer` varchar(100) DEFAULT NULL,
  `chofer_rut` varchar(15) DEFAULT NULL,
  `direccion_origen` varchar(100) DEFAULT NULL,
  `direccion_destino` varchar(100) DEFAULT NULL,
  `ciudad_origen` varchar(100) DEFAULT NULL,
  `ciudad_destino` varchar(100) DEFAULT NULL,
  `tipo_traslado_id` int(11) DEFAULT NULL,
  `transportista` varchar(100) DEFAULT NULL,
  `transportista_rut` varchar(100) DEFAULT NULL,
  `patente_camion` varchar(100) DEFAULT NULL,
  `patente_carro` varchar(100) DEFAULT NULL,
  `user_create` varchar(100) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete` int(1) NOT NULL DEFAULT '0',
  `monto_efectivo` int(10) DEFAULT '0',
  `monto_credito` int(10) DEFAULT '0',
  `monto_cheque` int(10) DEFAULT '0',
  `id_pedido` bigint(20) DEFAULT NULL,
  `imei` varchar(80) DEFAULT NULL,
  `orden_compra` varchar(80) DEFAULT NULL,
  `customer_sucursal_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `FK_sales_customer` (`customer_id`),
  KEY `FK_sales_centro_costo` (`centro_id`),
  KEY `FK_sales_empresa` (`empresa_id`),
  KEY `FK_sales_tipo_documento` (`tipo_documento_id`),
  KEY `FK_sales_sucursal` (`sucursal_id`),
  KEY `transaction_id` (`transaction_id`),
  KEY `fecha_factura` (`fecha_factura`),
  CONSTRAINT `FK_sales_centro_costo` FOREIGN KEY (`centro_id`) REFERENCES `centro_costo` (`centro_id`),
  CONSTRAINT `FK_sales_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  CONSTRAINT `FK_sales_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`),
  CONSTRAINT `FK_sales_sucursal` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursal` (`sucursal_id`),
  CONSTRAINT `FK_sales_tipo_documento` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documento` (`tipo_documento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (1,'',NULL,0,1,'2018-03-20','2018-04-20','2018-03-20',853,'Mercaderia',0,'',0,0,1,1,1,26,'','','','','','',0,'','','','','fsaldana','2018-03-20 13:14:37','','0000-00-00 00:00:00',1,0,0,0,NULL,NULL,NULL,NULL),(2,'',NULL,0,1,'2018-03-29','2018-04-29','2018-03-29',853,'Mercaderia',0,'',0,0,1,1,1,26,'','','','','','',0,'','','','','fsaldana','2018-03-29 13:42:48','','0000-00-00 00:00:00',1,0,0,0,NULL,NULL,NULL,NULL),(3,'',NULL,0,2,'2018-03-30','2018-04-30','2018-03-30',853,'Mercaderia',0,'',0,0,1,1,1,26,'','','','','','',0,'','','','','fsaldana','2018-03-30 19:05:33','','0000-00-00 00:00:00',1,0,0,0,NULL,NULL,NULL,NULL),(4,'',NULL,0,3,'2018-03-30','2018-04-30','2018-03-30',853,'Mercaderia',0,'',0,0,1,1,1,26,'','','','','','',0,'','','','','fsaldana','2018-03-30 19:06:42','','0000-00-00 00:00:00',0,0,0,0,NULL,NULL,NULL,NULL),(5,'',NULL,0,1,'2018-04-05','2018-05-05','2018-04-05',852,'Mercaderia',0,'probando probando PROBANDO',4,0,1,1,1,26,'','','','','','',0,'','','','','ebusiness','2018-04-05 16:57:59','','0000-00-00 00:00:00',0,0,0,0,NULL,NULL,'12345678',NULL),(6,'',NULL,0,2,'2018-04-09','2018-05-09','2018-04-09',853,'Mercaderia',0,'prueba',0,0,1,1,1,26,'','','','','','',0,'','','','','fsaldana','2018-04-09 15:31:51','','0000-00-00 00:00:00',0,0,0,0,NULL,NULL,'1234567887',NULL),(7,'4',NULL,0,3,'2018-04-09','2018-05-09','2018-04-09',853,'Mercaderia',0,'',0,0,1,1,1,12,'','','','','','',0,'','','','','fsaldana','2018-04-09 15:49:18','','0000-00-00 00:00:00',0,0,0,0,NULL,NULL,NULL,NULL),(8,'4',NULL,0,4,'2018-04-09','2018-05-09','2018-04-09',853,'Mercaderia',0,'',0,0,1,1,1,12,'','','','','','',0,'','','','','fsaldana','2018-04-09 16:30:37','','0000-00-00 00:00:00',0,0,0,0,NULL,NULL,NULL,NULL),(9,'','5',3,5,'2018-04-09','2018-04-09','2018-04-09',852,'Mercaderia',0,'',0,0,1,1,1,24,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ebusiness','2018-04-10 00:16:16','','0000-00-00 00:00:00',1,0,0,0,NULL,NULL,NULL,NULL),(10,'','5',1,6,'2018-04-09','2018-04-09','2018-04-09',852,'Mercaderia',0,'ANULA DTE',0,0,1,1,1,24,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ebusiness','2018-04-10 00:16:31','','0000-00-00 00:00:00',1,0,0,0,NULL,NULL,'',NULL);
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_history`
--

DROP TABLE IF EXISTS `sales_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_history` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(100) DEFAULT NULL,
  `invoice_reference` varchar(100) DEFAULT NULL,
  `causa_emision_id` int(11) NOT NULL,
  `correlativo` int(11) DEFAULT NULL,
  `fecha_factura` varchar(100) NOT NULL,
  `fecha_vencimiento` varchar(100) NOT NULL,
  `fecha_ingreso` varchar(100) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `tipo_productos` varchar(100) NOT NULL,
  `adicional` int(11) NOT NULL,
  `observaciones` varchar(200) NOT NULL,
  `forma_pago_id` int(11) NOT NULL,
  `estado_pago` int(11) NOT NULL DEFAULT '0',
  `centro_id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `tipo_documento_id` int(11) NOT NULL,
  `chofer` varchar(100) DEFAULT NULL,
  `chofer_rut` varchar(15) DEFAULT NULL,
  `direccion_origen` varchar(100) DEFAULT NULL,
  `direccion_destino` varchar(100) DEFAULT NULL,
  `ciudad_origen` varchar(100) DEFAULT NULL,
  `ciudad_destino` varchar(100) DEFAULT NULL,
  `tipo_traslado_id` int(11) DEFAULT NULL,
  `transportista` varchar(100) DEFAULT NULL,
  `transportista_rut` varchar(100) DEFAULT NULL,
  `patente_camion` varchar(100) DEFAULT NULL,
  `patente_carro` varchar(100) DEFAULT NULL,
  `user_create` varchar(100) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete` int(1) NOT NULL DEFAULT '0',
  `monto_efectivo` int(10) DEFAULT '0',
  `monto_credito` int(10) DEFAULT '0',
  `monto_cheque` int(10) DEFAULT '0',
  `id_pedido` bigint(20) DEFAULT NULL,
  `imei` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `FK_sales_customer1` (`customer_id`),
  KEY `FK_sales_centro_costo1` (`centro_id`),
  KEY `FK_sales_empresa1` (`empresa_id`),
  KEY `FK_sales_tipo_documento1` (`tipo_documento_id`),
  KEY `FK_sales_sucursal1` (`sucursal_id`),
  KEY `transaction_id1` (`transaction_id`),
  KEY `fecha_factura1` (`fecha_factura`),
  CONSTRAINT `FK_sales_centro_cost1o` FOREIGN KEY (`centro_id`) REFERENCES `centro_costo` (`centro_id`),
  CONSTRAINT `FK_sales_customer1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  CONSTRAINT `FK_sales_empresa1` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`),
  CONSTRAINT `FK_sales_sucursal1` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursal` (`sucursal_id`),
  CONSTRAINT `FK_sales_tipo_documento1` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documento` (`tipo_documento_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_history`
--

LOCK TABLES `sales_history` WRITE;
/*!40000 ALTER TABLE `sales_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_order`
--

DROP TABLE IF EXISTS `sales_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(10) NOT NULL,
  `qty` double(11,3) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `descuento` int(10) NOT NULL,
  `empresa_id` int(10) NOT NULL,
  `sucursal_id` int(10) NOT NULL,
  `user_create` varchar(50) DEFAULT NULL,
  `date_create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) DEFAULT NULL,
  `date_update` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `delete` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_sales_order_products` (`product_id`),
  KEY `FK_sales_order_empresa` (`empresa_id`),
  KEY `transaction_id` (`transaction_id`),
  KEY `invoice` (`invoice`),
  CONSTRAINT `FK_sales_order_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`),
  CONSTRAINT `FK_sales_order_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_order`
--

LOCK TABLES `sales_order` WRITE;
/*!40000 ALTER TABLE `sales_order` DISABLE KEYS */;
INSERT INTO `sales_order` VALUES (1,0,6,20.000,'750','2',0,1,1,'fsaldana','2018-03-29 13:44:57',NULL,'0000-00-00 00:00:00',1),(2,0,11,10.000,'26900','3',0,1,1,'fsaldana','2018-03-30 19:05:52',NULL,'0000-00-00 00:00:00',1),(3,0,11,15.000,'26900','4',0,1,1,'fsaldana','2018-03-30 19:06:53',NULL,'0000-00-00 00:00:00',0),(4,0,11,10.000,'269000','5',0,1,1,'ebusiness','2018-04-05 16:58:10','ebusiness','2018-04-09 23:50:15',1),(24,0,16,3.000,'21000','6',0,1,1,'fsaldana','2018-04-09 15:32:00',NULL,'0000-00-00 00:00:00',0),(28,0,11,50.000,'26900','7',0,1,1,'fsaldana','2018-04-09 15:49:38',NULL,'0000-00-00 00:00:00',0),(29,0,11,1.000,'26900','',0,1,1,'fsaldana','2018-04-09 15:49:59',NULL,'0000-00-00 00:00:00',0),(30,0,12,2.000,'10900','8',0,1,1,'fsaldana','2018-04-09 16:30:46',NULL,'0000-00-00 00:00:00',0),(42,0,11,10.000,'26900','5',0,1,1,'ebusiness','2018-04-09 23:50:37',NULL,'0000-00-00 00:00:00',0),(44,0,29,100.000,'120','5',0,1,1,'ebusiness','2018-04-09 23:53:51',NULL,'0000-00-00 00:00:00',0),(49,0,11,10.000,'26900','9',0,1,1,'ebusiness','2018-04-10 00:16:16',NULL,'0000-00-00 00:00:00',1),(50,0,29,100.000,'120','9',0,1,1,'ebusiness','2018-04-10 00:16:16',NULL,'0000-00-00 00:00:00',1),(51,0,11,10.000,'26900','10',0,1,1,'ebusiness','2018-04-10 00:16:31',NULL,'0000-00-00 00:00:00',1),(52,0,29,100.000,'120','10',0,1,1,'ebusiness','2018-04-10 00:16:31',NULL,'0000-00-00 00:00:00',1),(60,0,20,12.000,'180000','5',0,1,1,'ebusiness','2018-04-10 02:40:20',NULL,'0000-00-00 00:00:00',0);
/*!40000 ALTER TABLE `sales_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_order_history`
--

DROP TABLE IF EXISTS `sales_order_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_order_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(10) NOT NULL,
  `qty` double(11,3) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `descuento` int(10) NOT NULL,
  `empresa_id` int(10) NOT NULL,
  `sucursal_id` int(10) NOT NULL,
  `user_create` varchar(50) DEFAULT NULL,
  `date_create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) DEFAULT NULL,
  `date_update` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `delete` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_sales_order_products1` (`product_id`),
  KEY `FK_sales_order_empresa1` (`empresa_id`),
  KEY `transaction_id` (`transaction_id`),
  KEY `invoice` (`invoice`),
  CONSTRAINT `FK_sales_order_empresa1` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`),
  CONSTRAINT `FK_sales_order_products1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_order_history`
--

LOCK TABLES `sales_order_history` WRITE;
/*!40000 ALTER TABLE `sales_order_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales_order_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salida_venta`
--

DROP TABLE IF EXISTS `salida_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salida_venta` (
  `salida_venta_id` int(10) NOT NULL,
  `empresa_id` int(10) NOT NULL,
  `sucursal_id` int(10) NOT NULL,
  `salida_venta_fecha` varchar(30) NOT NULL,
  `user_create` varchar(30) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`salida_venta_id`),
  KEY `FK_salida_venta_empresa` (`empresa_id`),
  CONSTRAINT `FK_salida_venta_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salida_venta`
--

LOCK TABLES `salida_venta` WRITE;
/*!40000 ALTER TABLE `salida_venta` DISABLE KEYS */;
/*!40000 ALTER TABLE `salida_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seccion`
--

DROP TABLE IF EXISTS `seccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seccion` (
  `seccion_id` int(10) NOT NULL AUTO_INCREMENT,
  `capacidad` int(10) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `bodega_id` int(10) NOT NULL,
  `empresa_id` int(10) NOT NULL,
  `sucursal_id` int(10) NOT NULL,
  `user_create` varchar(100) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`seccion_id`),
  KEY `FK_seccion_bodega` (`bodega_id`),
  KEY `FK_seccion_empresa` (`empresa_id`),
  CONSTRAINT `FK_seccion_bodega` FOREIGN KEY (`bodega_id`) REFERENCES `bodega` (`bodega_id`),
  CONSTRAINT `FK_seccion_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seccion`
--

LOCK TABLES `seccion` WRITE;
/*!40000 ALTER TABLE `seccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `seccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subfamily`
--

DROP TABLE IF EXISTS `subfamily`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subfamily` (
  `subfamily_id` int(10) NOT NULL AUTO_INCREMENT,
  `subfamily_name` varchar(100) NOT NULL,
  `subfamily_label` varchar(5) NOT NULL,
  `family_id` int(10) NOT NULL,
  `empresa_id` int(10) NOT NULL,
  `sucursal_id` int(10) NOT NULL,
  `user_create` varchar(100) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`subfamily_id`),
  KEY `family_id` (`family_id`),
  KEY `FK_subfamily_empresa` (`empresa_id`),
  CONSTRAINT `FK_subfamily_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`),
  CONSTRAINT `subfamily_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `family` (`family_id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subfamily`
--

LOCK TABLES `subfamily` WRITE;
/*!40000 ALTER TABLE `subfamily` DISABLE KEYS */;
INSERT INTO `subfamily` VALUES (77,'SERVICIOS','SS',178,1,0,'fsaldana','2018-03-20 13:51:19','','0000-00-00 00:00:00',1),(78,'INSUMOS','INS',179,1,0,'fsaldana','2018-03-20 13:51:30','','0000-00-00 00:00:00',1),(79,'LADRILLOS','LD',180,1,0,'fsaldana','2018-03-20 13:51:39','','0000-00-00 00:00:00',1),(80,'LIBRERIA','LB',182,1,0,'fsaldana','2018-03-20 13:51:48','','0000-00-00 00:00:00',1),(81,'RED HUMEDA','RH',183,1,0,'fsaldana','2018-03-20 13:51:58','','0000-00-00 00:00:00',1),(82,'LETREROS','LT',181,1,0,'fsaldana','2018-03-20 13:52:07','','0000-00-00 00:00:00',1),(83,'ROPA CORPORATIVA','RC',184,1,0,'fsaldana','2018-03-20 13:52:20','','0000-00-00 00:00:00',1),(84,'SIN FAMILIA','NO1',178,1,0,'fsaldana','2018-03-22 14:56:16','ebusiness','2018-03-29 01:30:05',0),(85,'SIN FAMILIA','NO2',179,1,0,'fsaldana','2018-03-22 14:56:34','ebusiness','2018-03-29 01:30:11',0),(86,'SIN FAMILIA','NO3',180,1,0,'fsaldana','2018-03-22 14:56:41','ebusiness','2018-03-29 01:30:18',0),(87,'SIN FAMILIA','NO4',181,1,0,'fsaldana','2018-03-22 14:56:56','ebusiness','2018-03-29 01:30:26',0),(88,'SIN FAMILIA','NO5',182,1,0,'fsaldana','2018-03-22 14:57:07','ebusiness','2018-03-29 01:30:35',0),(89,'SIN FAMILIA','NO6',183,1,0,'fsaldana','2018-03-22 14:57:22','ebusiness','2018-03-29 01:30:44',0),(90,'SIN FAMILIA','NO7',184,1,0,'fsaldana','2018-03-22 14:57:31','ebusiness','2018-03-29 01:30:50',0);
/*!40000 ALTER TABLE `subfamily` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sucursal`
--

DROP TABLE IF EXISTS `sucursal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sucursal` (
  `sucursal_id` int(10) NOT NULL AUTO_INCREMENT,
  `sucursal_nombre` varchar(50) DEFAULT '0',
  `sucursal_direccion` varchar(100) DEFAULT '0',
  `sucursal_telefono` varchar(50) DEFAULT '0',
  `sucursal_ciudad` varchar(50) DEFAULT '0',
  `sucursal_comuna` varchar(50) DEFAULT '0',
  `empresa_id` int(10) NOT NULL DEFAULT '0',
  `user_create` varchar(50) DEFAULT '0',
  `date_create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sucursal_id`,`empresa_id`),
  KEY `FK__empresa` (`empresa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sucursal`
--

LOCK TABLES `sucursal` WRITE;
/*!40000 ALTER TABLE `sucursal` DISABLE KEYS */;
INSERT INTO `sucursal` VALUES (1,'Casa Matriz',' Villagrán 1251','43 2 369002','LOS ANGELES','LOS ANGELES',1,'ebusiness','2016-06-08 23:41:43','ebusiness','2016-12-26 22:21:48',0);
/*!40000 ALTER TABLE `sucursal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supliers`
--

DROP TABLE IF EXISTS `supliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supliers` (
  `suplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `suplier_rut` varchar(100) NOT NULL,
  `suplier_name` varchar(100) NOT NULL,
  `suplier_fantasyname` varchar(100) NOT NULL,
  `suplier_address` varchar(100) NOT NULL,
  `suplier_contact` varchar(100) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `suplier_giro` varchar(100) NOT NULL,
  `suplier_ciudad` varchar(100) NOT NULL,
  `suplier_comuna` varchar(100) NOT NULL,
  `suplier_email` varchar(100) NOT NULL,
  `note` varchar(500) NOT NULL,
  `empresa_id` int(10) NOT NULL,
  `sucursal_id` int(10) NOT NULL,
  `user_create` varchar(100) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`suplier_id`),
  KEY `FK_supliers_empresa` (`empresa_id`),
  CONSTRAINT `FK_supliers_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supliers`
--

LOCK TABLES `supliers` WRITE;
/*!40000 ALTER TABLE `supliers` DISABLE KEYS */;
INSERT INTO `supliers` VALUES (15,'76504231-3','ebusiness','INGENIERIA MARCELA MUNOZ OJEDA EIRL','PASAJE JOSE PRIDA 1651','56 9 58163902','HUGO MUÑOZ OJEDA','CONSULTORIA Y ASESORIA INFORMATICA','TEMUCO ','TEMUCO','informatica@ebusiness.cl','',1,1,'ebusiness','2018-03-19 21:43:22','csaldana','2018-03-19 23:05:02',0);
/*!40000 ALTER TABLE `supliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_documento`
--

DROP TABLE IF EXISTS `tipo_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_documento` (
  `tipo_documento_id` int(10) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `user_create` varchar(100) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`tipo_documento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_documento`
--

LOCK TABLES `tipo_documento` WRITE;
/*!40000 ALTER TABLE `tipo_documento` DISABLE KEYS */;
INSERT INTO `tipo_documento` VALUES (12,'Factura','30','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(13,'Boleta','35','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(14,'Guia De Despacho Electr&#243;nica','52','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(15,'Guia De Despacho','50','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(16,'Boleta Exenta','38','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(17,'Boleta  Electr&#243;nica','39','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(18,'Liquidaci&#243;n Factura','40','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(19,'Boleta Exenta Electr&#243;nica','41','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(20,'Liquidaci&#243;n Factura Electr&#243;nica','43','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(21,'Factura De Compra','45','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(22,'Factura De Compra Electr&#243;nica','46','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(23,'Nota De D&#233;bito','55','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(24,'Nota De Cr&#233;dito','60','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(25,'Factura No Afecta O Exenta','32','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(26,'Factura Electr&#243;nica','33','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(27,'Factura No Afecta O Exenta Electr&#243;nica','34','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(29,'Nota De D&#233;bito Electr&#243;nica','56','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(30,'Nota De Cr&#233;dito Electr&#243;nica','61','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(31,'Liquidaci&#243;n','103','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(32,'Factura de Exportaci&#243;n Electr&#243;nica','110','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(33,'Nota de D&#233;bito de Exportaci&#243;n Electr&#243;nica','111','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(34,'Nota de Cr&#233;dito de Exportaci&#243;n Electr&#243;nica','112','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(35,'Orden De Compra','801','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(36,'Nota de Pedido','802','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(37,'Contrato ','803','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(38,'Resoluci&#243;n ','804','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(39,'Proceso ChileCompra','805','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(40,'Ficha ChileCompra','806','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(41,'DUS','807','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(42,'B/L','808','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(43,'AWB','809','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(44,'MIC/DTA','810','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(45,'Carta De Porte','81','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(46,'Resoluci&#243;n Del SNA','812','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(47,'Pasaporte ','813','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(48,'Certificado De Dep&#243;sito Bolsa Prod. Chile','814','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(49,'Vale De Prenda Bolsa Prod. Chile','815','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(50,'Orden De Compra','OC','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(51,'Nota De Venta','NV','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(52,'Pedido','PE','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(53,'HES','HES','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(54,'HEM','HEM','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(55,'SET','SET','','0000-00-00 00:00:00','','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `tipo_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_traslado`
--

DROP TABLE IF EXISTS `tipo_traslado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_traslado` (
  `tipo_traslado_id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo_traslado_code` int(10) NOT NULL,
  `tipo_traslado_descripcion` varchar(50) NOT NULL,
  `user_create` varchar(100) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`tipo_traslado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_traslado`
--

LOCK TABLES `tipo_traslado` WRITE;
/*!40000 ALTER TABLE `tipo_traslado` DISABLE KEYS */;
INSERT INTO `tipo_traslado` VALUES (1,1,'Constituye venta','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(2,2,'Venta por efectuar','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(3,3,'Consignaciones','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(4,4,'Entrega gratuita','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(5,5,'Traslado interno','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(6,6,'Otro traslado no venta','','0000-00-00 00:00:00','','0000-00-00 00:00:00'),(7,7,'Guía de devolución','','0000-00-00 00:00:00','','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `tipo_traslado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `rut` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `empresa_id` int(10) NOT NULL,
  `sucursal_id` int(10) DEFAULT NULL,
  `user_create` varchar(50) DEFAULT NULL,
  `date_create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(100) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_user_empresa` (`empresa_id`),
  KEY `FK_user_sucursal` (`sucursal_id`),
  CONSTRAINT `FK_user_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (6,'ebusiness','76504231-3','1234','EBUSINESS','Administrador',1,1,NULL,NULL,'lvargas','2016-09-27 21:41:26',0),(26,'fsaldana','15208733-0','222555','Francisco Saldaña','Administrador',1,1,'ebusiness','2018-03-19 22:02:47','fsaldana','2018-03-20 13:26:41',0),(27,'csaldana','12559738-6','222555','Cesar Saldaña','Administrador',1,1,'ebusiness','2018-03-19 22:05:35','fsaldana','2018-03-20 13:26:25',0),(28,'asaldana','11963033-9','222555','ANNETTE SALDAÑA','Vendedor',1,1,'fsaldana','2018-03-20 13:26:02','','0000-00-00 00:00:00',0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas_impago`
--

DROP TABLE IF EXISTS `ventas_impago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ventas_impago` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(10) NOT NULL DEFAULT '0',
  `fecha` varchar(50) NOT NULL DEFAULT '0',
  `forma_pago_id` int(10) DEFAULT NULL,
  `customer_id` int(10) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `numero_cheque` int(30) DEFAULT NULL,
  `banco` varchar(50) DEFAULT NULL,
  `fecha_pago` varchar(50) DEFAULT NULL,
  `monto` varchar(50) DEFAULT NULL,
  `empresa_id` int(10) DEFAULT NULL,
  `sucursal_id` int(10) DEFAULT NULL,
  `user_create` varchar(50) DEFAULT NULL,
  `date_create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(50) DEFAULT NULL,
  `date_update` timestamp NULL DEFAULT NULL,
  `delete` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas_impago`
--

LOCK TABLES `ventas_impago` WRITE;
/*!40000 ALTER TABLE `ventas_impago` DISABLE KEYS */;
INSERT INTO `ventas_impago` VALUES (1,5,'2018-04-09',4,852,'Pdte Pago',1212,'1','2018-04-09','320110',1,1,'ebusiness','2018-04-09 23:51:03',NULL,NULL,0);
/*!40000 ALTER TABLE `ventas_impago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas_pagos`
--

DROP TABLE IF EXISTS `ventas_pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ventas_pagos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(10) NOT NULL DEFAULT '0',
  `customer_id` int(10) NOT NULL DEFAULT '0',
  `fecha_pago` varchar(50) NOT NULL,
  `monto` int(10) NOT NULL DEFAULT '0',
  `numero_cheque` varchar(50) NOT NULL,
  `banco_id` int(10) NOT NULL DEFAULT '0',
  `fecha_cheque` varchar(50) NOT NULL,
  `forma_pago` varchar(50) NOT NULL,
  `empresa_id` int(10) NOT NULL,
  `sucursal_id` int(10) NOT NULL,
  `observaciones` varchar(250) NOT NULL,
  `user_create` varchar(50) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(50) NOT NULL,
  `date_update` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas_pagos`
--

LOCK TABLES `ventas_pagos` WRITE;
/*!40000 ALTER TABLE `ventas_pagos` DISABLE KEYS */;
/*!40000 ALTER TABLE `ventas_pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'EXCSA'
--

--
-- Dumping routines for database 'EXCSA'
--

--
-- Final view structure for view `VIEW_COUNT_DTE_POR_TIPO`
--

/*!50001 DROP TABLE IF EXISTS `VIEW_COUNT_DTE_POR_TIPO`*/;
/*!50001 DROP VIEW IF EXISTS `VIEW_COUNT_DTE_POR_TIPO`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `VIEW_COUNT_DTE_POR_TIPO` AS (select count(distinct `s`.`transaction_id`) AS `NroDTE`,33 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `SubTotal`,sum(round(((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100) / 1),0)) AS `Dcto_Monto`,sum(round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `Neto`,sum(round((((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) AS `IVA`,sum((round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) AS `Total`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from (((((((((`sales` `s` join `sales_order` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 26) and (`s`.`transaction_id` > 0) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0)))) left join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) left join `DTE_caf` on(((`DTE_caf`.`RutEmpresa` = `DTE_informacionEmpresas`.`RUTEmisor`) and (`DTE_caf`.`TipoDocto` = '33') and (`DTE_caf`.`Vigente` = 'SI')))) left join `customer` on((`customer`.`customer_id` = `s`.`customer_id`))) join `products` on((`products`.`product_id` = `so`.`product_id`))) join `sucursal` on(((`s`.`sucursal_id` = `sucursal`.`sucursal_id`) and (`s`.`empresa_id` = `sucursal`.`empresa_id`)))) join `user` on((`user`.`username` = `s`.`user_create`))) join `forma_pago` on((`s`.`forma_pago_id` = `forma_pago`.`forma_pago_id`))) left join `claveSII` on(((`claveSII`.`id_invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = `claveSII`.`tipo_documento`) and (`s`.`empresa_id` = `claveSII`.`empresa_id`)))) where ((`s`.`fecha_factura` >= '2017-02-01') and (`s`.`fecha_factura` < '2017-03-01') and (`s`.`delete` = 0)) group by `DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,61 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1.19),0)) * 1) AS `SubTotal`,sum(round(((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100) / 1.19),0)) AS `Dcto_Monto`,(sum(round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) * 1) AS `Neto`,(sum(round((((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) * 1) AS `IVA`,(sum((round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) * 1) AS `Total`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from (((((((((((`sales` `s` join `sales_order` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 24) and (`so`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) join `DTE_caf` on(((`DTE_caf`.`RutEmpresa` = `DTE_informacionEmpresas`.`RUTEmisor`) and (`DTE_caf`.`TipoDocto` = '61') and (`DTE_caf`.`Vigente` = 'SI')))) join `customer` on((`customer`.`customer_id` = `s`.`customer_id`))) left join `products` on((`products`.`product_id` = `so`.`product_id`))) join `sucursal` on(((`s`.`sucursal_id` = `sucursal`.`sucursal_id`) and (`s`.`empresa_id` = `sucursal`.`empresa_id`)))) left join `sales` `sref` on((`sref`.`transaction_id` = `s`.`invoice_reference`))) join `user` on((`user`.`username` = `s`.`user_create`))) left join `forma_pago` on((`sref`.`forma_pago_id` = `forma_pago`.`forma_pago_id`))) left join `claveSII` on(((`claveSII`.`id_invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = `claveSII`.`tipo_documento`) and (`s`.`empresa_id` = `claveSII`.`empresa_id`)))) left join `claveSII` `claveSIIRef` on(((`claveSIIRef`.`id_invoice` = `sref`.`transaction_id`) and (`sref`.`tipo_documento_id` = `claveSIIRef`.`tipo_documento`) and (`sref`.`empresa_id` = `claveSIIRef`.`empresa_id`)))) where ((`s`.`fecha_factura` >= '2017-02-01') and (`s`.`fecha_factura` < '2017-03-01') and (`s`.`delete` = 0)) group by `DTE_informacionEmpresas`.`CodEmpresa`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `VIEW_DTE_FACTURAS_AGRUPADA`
--

/*!50001 DROP TABLE IF EXISTS `VIEW_DTE_FACTURAS_AGRUPADA`*/;
/*!50001 DROP VIEW IF EXISTS `VIEW_DTE_FACTURAS_AGRUPADA`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `VIEW_DTE_FACTURAS_AGRUPADA` AS (select (case when (`claveSII`.`folio_DTE` > 0) then `claveSII`.`folio_DTE` else `s`.`transaction_id` end) AS `Factura`,0 AS `Proceso`,33 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(case when isnull(`s`.`orden_compra`) then 'Sin Orden' else `s`.`orden_compra` end) AS `O_Compra`,1 AS `Est_Factura`,round(((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)),0) AS `SubTotal`,round((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100),0) AS `Dcto_Monto`,round(((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)),0) AS `Neto`,round((round(((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)),0) * 0.19),0) AS `IVA`,(round(((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)),0) + round(((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) * 19) / 100),0)) AS `Total`,'' AS `Guias_Cadena`,replace(`s`.`fecha_vencimiento`,'-','') AS `Fec_Vcto`,'CERTIFICACION' AS `NCERTFOR`,'CERO' AS `Total_Texto`,`s`.`customer_id` AS `NroFactura`,0 AS `IVA_Retener`,'DIRECCION DESTINO' AS `Destino_Dir`,'CIUDAD DESTINO' AS `Destino_Ciu`,'ORIGEN' AS `Origen`,'NOMBRE CHOFER' AS `Chofer`,'15282456-4' AS `Rut_Chofer`,'PATENTE CAMION' AS `Patente_Camion`,'PATENTE CARRO' AS `Patente_Carro`,'NOMBRE TRANSPORTISTA' AS `Transportista`,'RUT TRANSPORTISTA' AS `Rut_Transporte`,'NOMBRE DESPACHADOR' AS `Despachador`,'RUT DESPACHADO' AS `RutDespachador`,concat(concat(`sucursal`.`sucursal_nombre`,', Emitida por: ',`user`.`name`),', ',`s`.`observaciones`) AS `Observacion`,'FE' AS `TipoDoctoRef`,1 AS `causaNCND`,'20160101' AS `Fecha_Ref`,ucase(`customer`.`customer_name`) AS `CL03_NombreLargo`,ucase(`customer`.`rut`) AS `CL04_Rut`,ucase(`customer`.`prod_name`) AS `CL05_Giro`,ucase(replace(replace(`customer`.`address`,'°',' '),'Ñ','N')) AS `CL06_Dir`,`customer`.`phone` AS `CL07_Fono`,`customer`.`email` AS `email`,`forma_pago`.`forma_pago_SII_descipcion` AS `NOMLARGO`,'UN' AS `UN03_NombreLargo`,concat(`products`.`code`,'#',ucase(replace(replace(replace(`products`.`name`,'°',' '),'#',' '),'ñ','n'))) AS `PRODUCTO`,`so`.`descuento` AS `NPzas`,0 AS `NPqts`,round(`so`.`cost`,0) AS `Precio`,'PESO CHILENO' AS `Moneda`,round(`so`.`cost`,0) AS `P_U`,cast(`so`.`qty` as decimal(11,3)) AS `Total_Volumen`,0 AS `TCambio`,0 AS `Total_Volumen_Factura`,ucase(`customer`.`comuna`) AS `Comuna`,ucase(`customer`.`ciudad`) AS `Ciudad`,`DTE_informacionEmpresas`.`RUTEmisor` AS `RUTEmisor`,ucase(`DTE_informacionEmpresas`.`RznSoc`) AS `RznSoc`,ucase(`DTE_informacionEmpresas`.`GiroEmis`) AS `GiroEmis`,ucase(replace(`DTE_informacionEmpresas`.`DirOrigen`,'°',' ')) AS `DirOrigen`,ucase(`DTE_informacionEmpresas`.`CiudadOrigen`) AS `CiudadOrigen`,ucase(`DTE_informacionEmpresas`.`CmnaOrigen`) AS `CmnaOrigen`,`DTE_informacionEmpresas`.`Acteco` AS `Acteco`,`DTE_informacionEmpresas`.`CorreoEmisor` AS `CorreoEmisor`,`DTE_informacionEmpresas`.`CdgVendedor` AS `CdgVendedor`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion` AS `FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion` AS `NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador` AS `RutAutorizador`,`DTE_informacionEmpresas`.`CodSucSII` AS `CodSucSII`,`DTE_caf`.`CAFVigente` AS `CAFVigente` from (((((((((`sales` `s` join `sales_order` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`fecha_ingreso` >= '2018-03-11')))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) left join `claveSII` on((`claveSII`.`id_invoice` = `s`.`transaction_id`))) left join `DTE_caf` on(((`DTE_caf`.`RutEmpresa` = `DTE_informacionEmpresas`.`RUTEmisor`) and (`DTE_caf`.`TipoDocto` = '33')))) join `customer` on((`customer`.`customer_id` = `s`.`customer_id`))) join `products` on((`products`.`product_id` = `so`.`product_id`))) left join `sucursal` on(((`s`.`sucursal_id` = `sucursal`.`sucursal_id`) and (`s`.`empresa_id` = `sucursal`.`empresa_id`)))) join `user` on((`user`.`username` = `s`.`user_create`))) left join `forma_pago` on((`s`.`forma_pago_id` = `forma_pago`.`forma_pago_id`))) where ((`so`.`delete` = 0) and (`s`.`fecha_ingreso` >= '2018-03-11') and (`s`.`tipo_documento_id` = 26)) group by `s`.`transaction_id`,`so`.`id`,`s`.`fecha_factura`,`s`.`fecha_vencimiento`,`customer`.`customer_name`,`customer`.`rut`,`customer`.`prod_name`,`customer`.`address`,`customer`.`phone`,`customer`.`email`,`products`.`name`,`customer`.`comuna`,`customer`.`ciudad`,`DTE_informacionEmpresas`.`RUTEmisor`,`DTE_informacionEmpresas`.`RznSoc`,`DTE_informacionEmpresas`.`GiroEmis`,`DTE_informacionEmpresas`.`DirOrigen`,`DTE_informacionEmpresas`.`CiudadOrigen`,`DTE_informacionEmpresas`.`CmnaOrigen`,`DTE_informacionEmpresas`.`Acteco`,`DTE_informacionEmpresas`.`CorreoEmisor`,`DTE_informacionEmpresas`.`CdgVendedor`,`DTE_informacionEmpresas`.`CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador`,`DTE_informacionEmpresas`.`CodSucSII`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `VIEW_DTE_FACTURAS_AGRUPADA_NOTAS`
--

/*!50001 DROP TABLE IF EXISTS `VIEW_DTE_FACTURAS_AGRUPADA_NOTAS`*/;
/*!50001 DROP VIEW IF EXISTS `VIEW_DTE_FACTURAS_AGRUPADA_NOTAS`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `VIEW_DTE_FACTURAS_AGRUPADA_NOTAS` AS (select (case when (`claveSII`.`folio_DTE` > 0) then `claveSII`.`folio_DTE` else `s`.`transaction_id` end) AS `Factura`,0 AS `Proceso`,61 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,'Sin Orden' AS `O_Compra`,1 AS `Est_Factura`,round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1.19),0) AS `SubTotal`,round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100) / 1.19),0) AS `Dcto_Monto`,round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1.19),0) AS `Neto`,round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1.19) * 19) / 100),0) AS `IVA`,(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1.19),0) + round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1.19) * 19) / 100),0)) AS `Total`,'' AS `Guias_Cadena`,replace(`s`.`fecha_vencimiento`,'-','') AS `Fec_Vcto`,'CERTIFICACION' AS `NCERTFOR`,'CERO' AS `Total_Texto`,`claveSIIRef`.`folio_DTE` AS `NroFactura`,0 AS `IVA_Retener`,'DIRECCION DESTINO' AS `Destino_Dir`,'CIUDAD DESTINO' AS `Destino_Ciu`,'ORIGEN' AS `Origen`,'NOMBRE CHOFER' AS `Chofer`,'15282456-4' AS `Rut_Chofer`,'PATENTE CAMION' AS `Patente_Camion`,'PATENTE CARRO' AS `Patente_Carro`,'NOMBRE TRANSPORTISTA' AS `Transportista`,'RUT TRANSPORTISTA' AS `Rut_Transporte`,'NOMBRE DESPACHADOR' AS `Despachador`,'RUT DESPACHADO' AS `RutDespachador`,concat(concat(`sucursal`.`sucursal_nombre`,', Emitida por: ',`user`.`name`),', ',`s`.`observaciones`) AS `Observacion`,'FE' AS `TipoDoctoRef`,`s`.`causa_emision_id` AS `causaNCND`,replace(`sref`.`fecha_factura`,'-','') AS `Fecha_Ref`,ucase(`customer`.`customer_name`) AS `CL03_NombreLargo`,ucase(`customer`.`rut`) AS `CL04_Rut`,ucase(`customer`.`prod_name`) AS `CL05_Giro`,ucase(`customer`.`address`) AS `CL06_Dir`,`customer`.`phone` AS `CL07_Fono`,`customer`.`email` AS `email`,`forma_pago`.`forma_pago_SII_descipcion` AS `NOMLARGO`,'UN' AS `UN03_NombreLargo`,concat(`products`.`code`,'#',ucase(`products`.`name`)) AS `PRODUCTO`,`so`.`descuento` AS `NPzas`,0 AS `NPqts`,round((`so`.`cost` / 1.19),0) AS `Precio`,'PESO CHILENO' AS `Moneda`,round((`so`.`cost` / 1.19),0) AS `P_U`,cast(`so`.`qty` as decimal(11,3)) AS `Total_Volumen`,0 AS `TCambio`,0 AS `Total_Volumen_Factura`,ucase(`customer`.`comuna`) AS `Comuna`,ucase(`customer`.`ciudad`) AS `Ciudad`,`DTE_informacionEmpresas`.`RUTEmisor` AS `RUTEmisor`,`DTE_informacionEmpresas`.`RznSoc` AS `RznSoc`,`DTE_informacionEmpresas`.`GiroEmis` AS `GiroEmis`,`DTE_informacionEmpresas`.`DirOrigen` AS `DirOrigen`,`DTE_informacionEmpresas`.`CiudadOrigen` AS `CiudadOrigen`,`DTE_informacionEmpresas`.`CmnaOrigen` AS `CmnaOrigen`,`DTE_informacionEmpresas`.`Acteco` AS `Acteco`,`DTE_informacionEmpresas`.`CorreoEmisor` AS `CorreoEmisor`,`DTE_informacionEmpresas`.`CdgVendedor` AS `CdgVendedor`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion` AS `FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion` AS `NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador` AS `RutAutorizador`,`DTE_informacionEmpresas`.`CodSucSII` AS `CodSucSII`,`DTE_caf`.`CAFVigente` AS `CAFVigente` from (((((((((((`sales` `s` join `sales_order` `so` on((`so`.`invoice` = `s`.`transaction_id`))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) join `DTE_caf` on(((`DTE_caf`.`RutEmpresa` = `DTE_informacionEmpresas`.`RUTEmisor`) and (`DTE_caf`.`TipoDocto` = '61') and (`DTE_caf`.`Vigente` = 'SI')))) join `customer` on((`customer`.`customer_id` = `s`.`customer_id`))) left join `products` on((`products`.`product_id` = `so`.`product_id`))) join `sucursal` on(((`s`.`sucursal_id` = `sucursal`.`sucursal_id`) and (`s`.`empresa_id` = `sucursal`.`empresa_id`)))) left join `sales` `sref` on((`sref`.`transaction_id` = `s`.`invoice_reference`))) join `user` on((`user`.`username` = `s`.`user_create`))) left join `forma_pago` on((`sref`.`forma_pago_id` = `forma_pago`.`forma_pago_id`))) left join `claveSII` on(((`claveSII`.`id_invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = `claveSII`.`tipo_documento`) and (`s`.`empresa_id` = `claveSII`.`empresa_id`)))) left join `claveSII` `claveSIIRef` on(((`claveSIIRef`.`id_invoice` = `sref`.`transaction_id`) and (`sref`.`tipo_documento_id` = `claveSIIRef`.`tipo_documento`) and (`sref`.`empresa_id` = `claveSIIRef`.`empresa_id`)))) where ((`s`.`tipo_documento_id` = 24) and (`so`.`delete` = 0)) group by `s`.`transaction_id`,`so`.`id`,`s`.`fecha_factura`,`s`.`fecha_vencimiento`,`customer`.`customer_name`,`customer`.`rut`,`customer`.`prod_name`,`customer`.`address`,`customer`.`phone`,`customer`.`email`,`products`.`name`,`customer`.`comuna`,`customer`.`ciudad`,`DTE_informacionEmpresas`.`RUTEmisor`,`DTE_informacionEmpresas`.`RznSoc`,`DTE_informacionEmpresas`.`GiroEmis`,`DTE_informacionEmpresas`.`DirOrigen`,`DTE_informacionEmpresas`.`CiudadOrigen`,`DTE_informacionEmpresas`.`CmnaOrigen`,`DTE_informacionEmpresas`.`Acteco`,`DTE_informacionEmpresas`.`CorreoEmisor`,`DTE_informacionEmpresas`.`CdgVendedor`,`DTE_informacionEmpresas`.`CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador`,`DTE_informacionEmpresas`.`CodSucSII`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `VIEW_DTE_FACTURAS_LCV`
--

/*!50001 DROP TABLE IF EXISTS `VIEW_DTE_FACTURAS_LCV`*/;
/*!50001 DROP VIEW IF EXISTS `VIEW_DTE_FACTURAS_LCV`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `VIEW_DTE_FACTURAS_LCV` AS (select (case when (`claveSII`.`folio_DTE` > 0) then `claveSII`.`folio_DTE` else `s`.`transaction_id` end) AS `Factura`,33 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `SubTotal`,sum(round(((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100) / 1),0)) AS `Dcto_Monto`,sum(round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `Neto`,sum(round((((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) AS `IVA`,sum((round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) AS `Total`,`s`.`customer_id` AS `FactReferencia`,0 AS `IVA_Retener`,'FE' AS `TipoDoctoRef`,1 AS `causaNCND`,'20160101' AS `Fecha_Ref`,ucase(`customer`.`customer_name`) AS `CL03_NombreLargo`,ucase(`customer`.`rut`) AS `CL04_Rut`,`DTE_informacionEmpresas`.`RUTEmisor` AS `RUTEmisor`,ucase(`DTE_informacionEmpresas`.`RznSoc`) AS `RznSoc`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion` AS `FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion` AS `NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador` AS `RutAutorizador`,'LIBVTA' AS `TpoLibro`,year(`s`.`fecha_factura`) AS `AnhoLibro`,concat('0','',month(`s`.`fecha_factura`)) AS `MesLibro`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp` from (((((((((`sales` `s` join `sales_order` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 26) and (`s`.`transaction_id` > 0) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`s`.`delete` = 0)))) left join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) left join `DTE_caf` on(((`DTE_caf`.`RutEmpresa` = `DTE_informacionEmpresas`.`RUTEmisor`) and (`DTE_caf`.`TipoDocto` = '33') and (`DTE_caf`.`Vigente` = 'SI')))) left join `customer` on((`customer`.`customer_id` = `s`.`customer_id`))) join `products` on((`products`.`product_id` = `so`.`product_id`))) join `sucursal` on(((`s`.`sucursal_id` = `sucursal`.`sucursal_id`) and (`s`.`empresa_id` = `sucursal`.`empresa_id`)))) join `user` on((`user`.`username` = `s`.`user_create`))) join `forma_pago` on((`s`.`forma_pago_id` = `forma_pago`.`forma_pago_id`))) left join `claveSII` on(((`claveSII`.`id_invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = `claveSII`.`tipo_documento`) and (`s`.`empresa_id` = `claveSII`.`empresa_id`)))) where (`so`.`delete` = 0) group by `s`.`fecha_factura`,`s`.`fecha_vencimiento`,`customer`.`customer_name`,`customer`.`rut`,`DTE_informacionEmpresas`.`RUTEmisor`,`DTE_informacionEmpresas`.`RznSoc`,`DTE_informacionEmpresas`.`GiroEmis`,`DTE_informacionEmpresas`.`DirOrigen`,`DTE_informacionEmpresas`.`CiudadOrigen`,`DTE_informacionEmpresas`.`CmnaOrigen`,`DTE_informacionEmpresas`.`Acteco`,`DTE_informacionEmpresas`.`CorreoEmisor`,`DTE_informacionEmpresas`.`CdgVendedor`,`DTE_informacionEmpresas`.`CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador`) union all (select (case when (`claveSII`.`folio_DTE` > 0) then `claveSII`.`folio_DTE` else `s`.`transaction_id` end) AS `Factura`,61 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1.19),0)) * 1) AS `SubTotal`,sum(round(((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100) / 1.19),0)) AS `Dcto_Monto`,(sum(round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) * 1) AS `Neto`,(sum(round((((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) * 1) AS `IVA`,(sum((round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) * 1) AS `Total`,`claveSIIRef`.`folio_DTE` AS `FactReferencia`,0 AS `IVA_Retener`,'FE' AS `TipoDoctoRef`,`s`.`causa_emision_id` AS `causaNCND`,replace(`sref`.`fecha_factura`,'-','') AS `Fecha_Ref`,ucase(`customer`.`customer_name`) AS `CL03_NombreLargo`,ucase(`customer`.`rut`) AS `CL04_Rut`,`DTE_informacionEmpresas`.`RUTEmisor` AS `RUTEmisor`,`DTE_informacionEmpresas`.`RznSoc` AS `RznSoc`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion` AS `FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion` AS `NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador` AS `RutAutorizador`,'LIBVTA' AS `TpoLibro`,year(`s`.`fecha_factura`) AS `AnhoLibro`,concat('0','',month(`s`.`fecha_factura`)) AS `MesLibro`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp` from (((((((((((`sales` `s` join `sales_order` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 24) and (`so`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) join `DTE_caf` on(((`DTE_caf`.`RutEmpresa` = `DTE_informacionEmpresas`.`RUTEmisor`) and (`DTE_caf`.`TipoDocto` = '61') and (`DTE_caf`.`Vigente` = 'SI')))) join `customer` on((`customer`.`customer_id` = `s`.`customer_id`))) left join `products` on((`products`.`product_id` = `so`.`product_id`))) join `sucursal` on(((`s`.`sucursal_id` = `sucursal`.`sucursal_id`) and (`s`.`empresa_id` = `sucursal`.`empresa_id`)))) left join `sales` `sref` on((`sref`.`transaction_id` = `s`.`invoice_reference`))) join `user` on((`user`.`username` = `s`.`user_create`))) left join `forma_pago` on((`sref`.`forma_pago_id` = `forma_pago`.`forma_pago_id`))) left join `claveSII` on(((`claveSII`.`id_invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = `claveSII`.`tipo_documento`) and (`s`.`empresa_id` = `claveSII`.`empresa_id`)))) left join `claveSII` `claveSIIRef` on(((`claveSIIRef`.`id_invoice` = `sref`.`transaction_id`) and (`sref`.`tipo_documento_id` = `claveSIIRef`.`tipo_documento`) and (`sref`.`empresa_id` = `claveSIIRef`.`empresa_id`)))) where (`so`.`delete` = 0) group by `s`.`fecha_factura`,`s`.`fecha_vencimiento`,`customer`.`customer_name`,`customer`.`rut`,`DTE_informacionEmpresas`.`RUTEmisor`,`DTE_informacionEmpresas`.`RznSoc`,`DTE_informacionEmpresas`.`GiroEmis`,`DTE_informacionEmpresas`.`DirOrigen`,`DTE_informacionEmpresas`.`CiudadOrigen`,`DTE_informacionEmpresas`.`CmnaOrigen`,`DTE_informacionEmpresas`.`Acteco`,`DTE_informacionEmpresas`.`CorreoEmisor`,`DTE_informacionEmpresas`.`CdgVendedor`,`DTE_informacionEmpresas`.`CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador`) union all (select `s`.`invoice_number` AS `Factura`,33 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `SubTotal`,sum(round(((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100) / 1),0)) AS `Dcto_Monto`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `Neto`,sum(round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) AS `IVA`,sum((round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) AS `Total`,`s`.`suplier_id` AS `FactReferencia`,0 AS `IVA_Retener`,'FE' AS `TipoDoctoRef`,1 AS `causaNCND`,'20160101' AS `Fecha_Ref`,ucase(`supliers`.`suplier_name`) AS `CL03_NombreLargo`,ucase(`supliers`.`suplier_rut`) AS `CL04_Rut`,`DTE_informacionEmpresas`.`RUTEmisor` AS `RUTEmisor`,ucase(`DTE_informacionEmpresas`.`RznSoc`) AS `RznSoc`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion` AS `FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion` AS `NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador` AS `RutAutorizador`,'LIBCOMP' AS `TpoLibro`,year(`s`.`fecha_factura`) AS `AnhoLibro`,concat('0','',month(`s`.`fecha_factura`)) AS `MesLibro`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp` from (((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 26) and (`s`.`transaction_id` > 0) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0)))) left join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) left join `supliers` on((`supliers`.`suplier_id` = `s`.`suplier_id`))) where ((`s`.`delete` = 0) and (`s`.`empresa_id` = 1)) group by `s`.`invoice_number`,`DTE_informacionEmpresas`.`CodEmpresa`,`s`.`tipo_documento_id`) union all (select `s`.`invoice_number` AS `Factura`,61 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round(((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)),0)) * 1) AS `SubTotal`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100),0)) AS `Dcto_Monto`,(sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) * 1) AS `Neto`,(sum(round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) * 1) AS `IVA`,(sum((round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) * 1) AS `Total`,0 AS `FactReferencia`,0 AS `IVA_Retener`,'FE' AS `TipoDoctoRef`,1 AS `causaNCND`,'20160101' AS `Fecha_Ref`,ucase(`supliers`.`suplier_name`) AS `CL03_NombreLargo`,ucase(`supliers`.`suplier_rut`) AS `CL04_Rut`,`DTE_informacionEmpresas`.`RUTEmisor` AS `RUTEmisor`,`DTE_informacionEmpresas`.`RznSoc` AS `RznSoc`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion` AS `FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion` AS `NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador` AS `RutAutorizador`,'LIBCOMP' AS `TpoLibro`,year(`s`.`fecha_factura`) AS `AnhoLibro`,concat('0','',month(`s`.`fecha_factura`)) AS `MesLibro`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp` from ((((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 30) and (`so`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) join `supliers` on((`supliers`.`suplier_id` = `s`.`suplier_id`))) left join `claveSII` on(((`claveSII`.`id_invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = `claveSII`.`tipo_documento`) and (`s`.`empresa_id` = `claveSII`.`empresa_id`)))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 1)) group by `s`.`invoice_number`,`DTE_informacionEmpresas`.`CodEmpresa`,`s`.`tipo_documento_id`) union all (select `s`.`invoice_number` AS `Factura`,34 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round(((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)),0)) * 1) AS `SubTotal`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100),0)) AS `Dcto_Monto`,(sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) * 1) AS `Neto`,0 AS `IVA`,(sum((round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) * 1) AS `Total`,0 AS `FactReferencia`,0 AS `IVA_Retener`,'FE' AS `TipoDoctoRef`,1 AS `causaNCND`,'20160101' AS `Fecha_Ref`,ucase(`supliers`.`suplier_name`) AS `CL03_NombreLargo`,ucase(`supliers`.`suplier_rut`) AS `CL04_Rut`,`DTE_informacionEmpresas`.`RUTEmisor` AS `RUTEmisor`,`DTE_informacionEmpresas`.`RznSoc` AS `RznSoc`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion` AS `FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion` AS `NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador` AS `RutAutorizador`,'LIBCOMP' AS `TpoLibro`,year(`s`.`fecha_factura`) AS `AnhoLibro`,concat('0','',month(`s`.`fecha_factura`)) AS `MesLibro`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp` from ((((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 27) and (`so`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) join `supliers` on((`supliers`.`suplier_id` = `s`.`suplier_id`))) left join `claveSII` on(((`claveSII`.`id_invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = `claveSII`.`tipo_documento`) and (`s`.`empresa_id` = `claveSII`.`empresa_id`)))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 1)) group by `s`.`invoice_number`,`DTE_informacionEmpresas`.`CodEmpresa`,`s`.`tipo_documento_id`) union all (select `s`.`invoice_number` AS `Factura`,33 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `SubTotal`,sum(round(((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100) / 1),0)) AS `Dcto_Monto`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `Neto`,sum(round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) AS `IVA`,sum((round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) AS `Total`,`s`.`suplier_id` AS `FactReferencia`,0 AS `IVA_Retener`,'FE' AS `TipoDoctoRef`,1 AS `causaNCND`,'20160101' AS `Fecha_Ref`,ucase(`supliers`.`suplier_name`) AS `CL03_NombreLargo`,ucase(`supliers`.`suplier_rut`) AS `CL04_Rut`,`DTE_informacionEmpresas`.`RUTEmisor` AS `RUTEmisor`,ucase(`DTE_informacionEmpresas`.`RznSoc`) AS `RznSoc`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion` AS `FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion` AS `NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador` AS `RutAutorizador`,'LIBCOMP' AS `TpoLibro`,year(`s`.`fecha_factura`) AS `AnhoLibro`,concat('0','',replace(month(`s`.`fecha_factura`),'1','2')) AS `MesLibro`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp` from (((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 26) and (`s`.`transaction_id` > 0) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0)))) left join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) left join `supliers` on((`supliers`.`suplier_id` = `s`.`suplier_id`))) where ((`s`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'1','2') = 2) and (`s`.`fecha_ingreso` <= '2017-03-31')) group by `s`.`invoice_number`,`DTE_informacionEmpresas`.`CodEmpresa`,`s`.`tipo_documento_id`) union all (select `s`.`invoice_number` AS `Factura`,61 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round(((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)),0)) * 1) AS `SubTotal`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100),0)) AS `Dcto_Monto`,(sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) * 1) AS `Neto`,(sum(round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) * 1) AS `IVA`,(sum((round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) * 1) AS `Total`,0 AS `FactReferencia`,0 AS `IVA_Retener`,'FE' AS `TipoDoctoRef`,1 AS `causaNCND`,'20160101' AS `Fecha_Ref`,ucase(`supliers`.`suplier_name`) AS `CL03_NombreLargo`,ucase(`supliers`.`suplier_rut`) AS `CL04_Rut`,`DTE_informacionEmpresas`.`RUTEmisor` AS `RUTEmisor`,`DTE_informacionEmpresas`.`RznSoc` AS `RznSoc`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion` AS `FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion` AS `NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador` AS `RutAutorizador`,'LIBCOMP' AS `TpoLibro`,year(`s`.`fecha_factura`) AS `AnhoLibro`,concat('0','',replace(month(`s`.`fecha_factura`),'1','2')) AS `MesLibro`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp` from ((((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 30) and (`so`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) join `supliers` on((`supliers`.`suplier_id` = `s`.`suplier_id`))) left join `claveSII` on(((`claveSII`.`id_invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = `claveSII`.`tipo_documento`) and (`s`.`empresa_id` = `claveSII`.`empresa_id`)))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'1','2') = 2) and (`s`.`fecha_ingreso` <= '2017-03-31')) group by `s`.`invoice_number`,`DTE_informacionEmpresas`.`CodEmpresa`,`s`.`tipo_documento_id`) union all (select `s`.`invoice_number` AS `Factura`,34 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round(((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)),0)) * 1) AS `SubTotal`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100),0)) AS `Dcto_Monto`,(sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) * 1) AS `Neto`,0 AS `IVA`,(sum((round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) * 1) AS `Total`,0 AS `FactReferencia`,0 AS `IVA_Retener`,'FE' AS `TipoDoctoRef`,1 AS `causaNCND`,'20160101' AS `Fecha_Ref`,ucase(`supliers`.`suplier_name`) AS `CL03_NombreLargo`,ucase(`supliers`.`suplier_rut`) AS `CL04_Rut`,`DTE_informacionEmpresas`.`RUTEmisor` AS `RUTEmisor`,`DTE_informacionEmpresas`.`RznSoc` AS `RznSoc`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion` AS `FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion` AS `NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador` AS `RutAutorizador`,'LIBCOMP' AS `TpoLibro`,year(`s`.`fecha_factura`) AS `AnhoLibro`,concat('0','',replace(month(`s`.`fecha_factura`),'1','2')) AS `MesLibro`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp` from ((((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 27) and (`so`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) join `supliers` on((`supliers`.`suplier_id` = `s`.`suplier_id`))) left join `claveSII` on(((`claveSII`.`id_invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = `claveSII`.`tipo_documento`) and (`s`.`empresa_id` = `claveSII`.`empresa_id`)))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'1','2') = 2) and (`s`.`fecha_ingreso` <= '2017-03-31')) group by `s`.`invoice_number`,`DTE_informacionEmpresas`.`CodEmpresa`,`s`.`tipo_documento_id`) union all (select `s`.`invoice_number` AS `Factura`,33 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `SubTotal`,sum(round(((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100) / 1),0)) AS `Dcto_Monto`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `Neto`,sum(round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) AS `IVA`,sum((round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) AS `Total`,`s`.`suplier_id` AS `FactReferencia`,0 AS `IVA_Retener`,'FE' AS `TipoDoctoRef`,1 AS `causaNCND`,'20160101' AS `Fecha_Ref`,ucase(`supliers`.`suplier_name`) AS `CL03_NombreLargo`,ucase(`supliers`.`suplier_rut`) AS `CL04_Rut`,`DTE_informacionEmpresas`.`RUTEmisor` AS `RUTEmisor`,ucase(`DTE_informacionEmpresas`.`RznSoc`) AS `RznSoc`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion` AS `FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion` AS `NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador` AS `RutAutorizador`,'LIBCOMP' AS `TpoLibro`,year(`s`.`fecha_factura`) AS `AnhoLibro`,concat('0','',replace(month(`s`.`fecha_factura`),'2','3')) AS `MesLibro`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp` from (((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 26) and (`s`.`transaction_id` > 0) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0)))) left join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) left join `supliers` on((`supliers`.`suplier_id` = `s`.`suplier_id`))) where ((`s`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'2','3') = 3) and (`s`.`fecha_ingreso` >= '2017-04-01') and (`s`.`fecha_ingreso` <= '2017-04-30')) group by `s`.`invoice_number`,`DTE_informacionEmpresas`.`CodEmpresa`,`s`.`tipo_documento_id`) union all (select `s`.`invoice_number` AS `Factura`,61 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round(((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)),0)) * 1) AS `SubTotal`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100),0)) AS `Dcto_Monto`,(sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) * 1) AS `Neto`,(sum(round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) * 1) AS `IVA`,(sum((round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) * 1) AS `Total`,0 AS `FactReferencia`,0 AS `IVA_Retener`,'FE' AS `TipoDoctoRef`,1 AS `causaNCND`,'20160101' AS `Fecha_Ref`,ucase(`supliers`.`suplier_name`) AS `CL03_NombreLargo`,ucase(`supliers`.`suplier_rut`) AS `CL04_Rut`,`DTE_informacionEmpresas`.`RUTEmisor` AS `RUTEmisor`,`DTE_informacionEmpresas`.`RznSoc` AS `RznSoc`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion` AS `FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion` AS `NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador` AS `RutAutorizador`,'LIBCOMP' AS `TpoLibro`,year(`s`.`fecha_factura`) AS `AnhoLibro`,concat('0','',replace(month(`s`.`fecha_factura`),'2','3')) AS `MesLibro`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp` from ((((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 30) and (`so`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) join `supliers` on((`supliers`.`suplier_id` = `s`.`suplier_id`))) left join `claveSII` on(((`claveSII`.`id_invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = `claveSII`.`tipo_documento`) and (`s`.`empresa_id` = `claveSII`.`empresa_id`)))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'2','3') = 3) and (`s`.`fecha_ingreso` >= '2017-04-01') and (`s`.`fecha_ingreso` <= '2017-04-30')) group by `s`.`invoice_number`,`DTE_informacionEmpresas`.`CodEmpresa`,`s`.`tipo_documento_id`) union all (select `s`.`invoice_number` AS `Factura`,34 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round(((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)),0)) * 1) AS `SubTotal`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100),0)) AS `Dcto_Monto`,(sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) * 1) AS `Neto`,0 AS `IVA`,(sum((round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) * 1) AS `Total`,0 AS `FactReferencia`,0 AS `IVA_Retener`,'FE' AS `TipoDoctoRef`,1 AS `causaNCND`,'20160101' AS `Fecha_Ref`,ucase(`supliers`.`suplier_name`) AS `CL03_NombreLargo`,ucase(`supliers`.`suplier_rut`) AS `CL04_Rut`,`DTE_informacionEmpresas`.`RUTEmisor` AS `RUTEmisor`,`DTE_informacionEmpresas`.`RznSoc` AS `RznSoc`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion` AS `FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion` AS `NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador` AS `RutAutorizador`,'LIBCOMP' AS `TpoLibro`,year(`s`.`fecha_factura`) AS `AnhoLibro`,concat('0','',replace(month(`s`.`fecha_factura`),'2','3')) AS `MesLibro`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp` from ((((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 27) and (`so`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) join `supliers` on((`supliers`.`suplier_id` = `s`.`suplier_id`))) left join `claveSII` on(((`claveSII`.`id_invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = `claveSII`.`tipo_documento`) and (`s`.`empresa_id` = `claveSII`.`empresa_id`)))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'2','3') = 3) and (`s`.`fecha_ingreso` >= '2017-04-01') and (`s`.`fecha_ingreso` <= '2017-04-30')) group by `s`.`invoice_number`,`DTE_informacionEmpresas`.`CodEmpresa`,`s`.`tipo_documento_id`) union all (select `s`.`invoice_number` AS `Factura`,33 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `SubTotal`,sum(round(((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100) / 1),0)) AS `Dcto_Monto`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `Neto`,sum(round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) AS `IVA`,sum((round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) AS `Total`,`s`.`suplier_id` AS `FactReferencia`,0 AS `IVA_Retener`,'FE' AS `TipoDoctoRef`,1 AS `causaNCND`,'20160101' AS `Fecha_Ref`,ucase(`supliers`.`suplier_name`) AS `CL03_NombreLargo`,ucase(`supliers`.`suplier_rut`) AS `CL04_Rut`,`DTE_informacionEmpresas`.`RUTEmisor` AS `RUTEmisor`,ucase(`DTE_informacionEmpresas`.`RznSoc`) AS `RznSoc`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion` AS `FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion` AS `NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador` AS `RutAutorizador`,'LIBCOMP' AS `TpoLibro`,year(`s`.`fecha_factura`) AS `AnhoLibro`,concat('0','',replace(month(`s`.`fecha_factura`),'3','4')) AS `MesLibro`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp` from (((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 26) and (`s`.`transaction_id` > 0) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0)))) left join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) left join `supliers` on((`supliers`.`suplier_id` = `s`.`suplier_id`))) where ((`s`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'3','4') = 4) and (`s`.`fecha_ingreso` >= '2017-05-01') and (`s`.`fecha_ingreso` <= '2017-05-30')) group by `s`.`invoice_number`,`DTE_informacionEmpresas`.`CodEmpresa`,`s`.`tipo_documento_id`) union all (select `s`.`invoice_number` AS `Factura`,61 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round(((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)),0)) * 1) AS `SubTotal`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100),0)) AS `Dcto_Monto`,(sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) * 1) AS `Neto`,(sum(round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) * 1) AS `IVA`,(sum((round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) * 1) AS `Total`,0 AS `FactReferencia`,0 AS `IVA_Retener`,'FE' AS `TipoDoctoRef`,1 AS `causaNCND`,'20160101' AS `Fecha_Ref`,ucase(`supliers`.`suplier_name`) AS `CL03_NombreLargo`,ucase(`supliers`.`suplier_rut`) AS `CL04_Rut`,`DTE_informacionEmpresas`.`RUTEmisor` AS `RUTEmisor`,`DTE_informacionEmpresas`.`RznSoc` AS `RznSoc`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion` AS `FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion` AS `NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador` AS `RutAutorizador`,'LIBCOMP' AS `TpoLibro`,year(`s`.`fecha_factura`) AS `AnhoLibro`,concat('0','',replace(month(`s`.`fecha_factura`),'3','4')) AS `MesLibro`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp` from ((((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 30) and (`so`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) join `supliers` on((`supliers`.`suplier_id` = `s`.`suplier_id`))) left join `claveSII` on(((`claveSII`.`id_invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = `claveSII`.`tipo_documento`) and (`s`.`empresa_id` = `claveSII`.`empresa_id`)))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'3','4') = 4) and (`s`.`fecha_ingreso` >= '2017-05-01') and (`s`.`fecha_ingreso` <= '2017-05-30')) group by `s`.`invoice_number`,`DTE_informacionEmpresas`.`CodEmpresa`,`s`.`tipo_documento_id`) union all (select `s`.`invoice_number` AS `Factura`,34 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round(((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)),0)) * 1) AS `SubTotal`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100),0)) AS `Dcto_Monto`,(sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) * 1) AS `Neto`,0 AS `IVA`,(sum((round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) * 1) AS `Total`,0 AS `FactReferencia`,0 AS `IVA_Retener`,'FE' AS `TipoDoctoRef`,1 AS `causaNCND`,'20160101' AS `Fecha_Ref`,ucase(`supliers`.`suplier_name`) AS `CL03_NombreLargo`,ucase(`supliers`.`suplier_rut`) AS `CL04_Rut`,`DTE_informacionEmpresas`.`RUTEmisor` AS `RUTEmisor`,`DTE_informacionEmpresas`.`RznSoc` AS `RznSoc`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion` AS `FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion` AS `NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador` AS `RutAutorizador`,'LIBCOMP' AS `TpoLibro`,year(`s`.`fecha_factura`) AS `AnhoLibro`,concat('0','',replace(month(`s`.`fecha_factura`),'3','4')) AS `MesLibro`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp` from ((((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 27) and (`so`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) join `supliers` on((`supliers`.`suplier_id` = `s`.`suplier_id`))) left join `claveSII` on(((`claveSII`.`id_invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = `claveSII`.`tipo_documento`) and (`s`.`empresa_id` = `claveSII`.`empresa_id`)))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'3','4') = 4) and (`s`.`fecha_ingreso` >= '2017-05-01') and (`s`.`fecha_ingreso` <= '2017-05-30')) group by `s`.`invoice_number`,`DTE_informacionEmpresas`.`CodEmpresa`,`s`.`tipo_documento_id`) union all (select `s`.`invoice_number` AS `Factura`,33 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `SubTotal`,sum(round(((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100) / 1),0)) AS `Dcto_Monto`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `Neto`,sum(round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) AS `IVA`,sum((round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) AS `Total`,`s`.`suplier_id` AS `FactReferencia`,0 AS `IVA_Retener`,'FE' AS `TipoDoctoRef`,1 AS `causaNCND`,'20160101' AS `Fecha_Ref`,ucase(`supliers`.`suplier_name`) AS `CL03_NombreLargo`,ucase(`supliers`.`suplier_rut`) AS `CL04_Rut`,`DTE_informacionEmpresas`.`RUTEmisor` AS `RUTEmisor`,ucase(`DTE_informacionEmpresas`.`RznSoc`) AS `RznSoc`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion` AS `FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion` AS `NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador` AS `RutAutorizador`,'LIBCOMP' AS `TpoLibro`,year(`s`.`fecha_factura`) AS `AnhoLibro`,concat('0','',replace(month(`s`.`fecha_factura`),'4','5')) AS `MesLibro`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp` from (((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 26) and (`s`.`transaction_id` > 0) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0)))) left join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) left join `supliers` on((`supliers`.`suplier_id` = `s`.`suplier_id`))) where ((`s`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'4','5') = 5) and (`s`.`fecha_ingreso` >= '2017-05-31') and (`s`.`fecha_ingreso` <= '2017-06-30')) group by `s`.`invoice_number`,`DTE_informacionEmpresas`.`CodEmpresa`,`s`.`tipo_documento_id`) union all (select `s`.`invoice_number` AS `Factura`,61 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round(((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)),0)) * 1) AS `SubTotal`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100),0)) AS `Dcto_Monto`,(sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) * 1) AS `Neto`,(sum(round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) * 1) AS `IVA`,(sum((round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) * 1) AS `Total`,0 AS `FactReferencia`,0 AS `IVA_Retener`,'FE' AS `TipoDoctoRef`,1 AS `causaNCND`,'20160101' AS `Fecha_Ref`,ucase(`supliers`.`suplier_name`) AS `CL03_NombreLargo`,ucase(`supliers`.`suplier_rut`) AS `CL04_Rut`,`DTE_informacionEmpresas`.`RUTEmisor` AS `RUTEmisor`,`DTE_informacionEmpresas`.`RznSoc` AS `RznSoc`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion` AS `FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion` AS `NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador` AS `RutAutorizador`,'LIBCOMP' AS `TpoLibro`,year(`s`.`fecha_factura`) AS `AnhoLibro`,concat('0','',replace(month(`s`.`fecha_factura`),'4','5')) AS `MesLibro`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp` from ((((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 30) and (`so`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) join `supliers` on((`supliers`.`suplier_id` = `s`.`suplier_id`))) left join `claveSII` on(((`claveSII`.`id_invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = `claveSII`.`tipo_documento`) and (`s`.`empresa_id` = `claveSII`.`empresa_id`)))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'4','5') = 5) and (`s`.`fecha_ingreso` >= '2017-05-31') and (`s`.`fecha_ingreso` <= '2017-06-30')) group by `s`.`invoice_number`,`DTE_informacionEmpresas`.`CodEmpresa`,`s`.`tipo_documento_id`) union all (select `s`.`invoice_number` AS `Factura`,34 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round(((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)),0)) * 1) AS `SubTotal`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100),0)) AS `Dcto_Monto`,(sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) * 1) AS `Neto`,0 AS `IVA`,(sum((round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) * 1) AS `Total`,0 AS `FactReferencia`,0 AS `IVA_Retener`,'FE' AS `TipoDoctoRef`,1 AS `causaNCND`,'20160101' AS `Fecha_Ref`,ucase(`supliers`.`suplier_name`) AS `CL03_NombreLargo`,ucase(`supliers`.`suplier_rut`) AS `CL04_Rut`,`DTE_informacionEmpresas`.`RUTEmisor` AS `RUTEmisor`,`DTE_informacionEmpresas`.`RznSoc` AS `RznSoc`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion` AS `FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion` AS `NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador` AS `RutAutorizador`,'LIBCOMP' AS `TpoLibro`,year(`s`.`fecha_factura`) AS `AnhoLibro`,concat('0','',replace(month(`s`.`fecha_factura`),'4','5')) AS `MesLibro`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp` from ((((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 27) and (`so`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) join `supliers` on((`supliers`.`suplier_id` = `s`.`suplier_id`))) left join `claveSII` on(((`claveSII`.`id_invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = `claveSII`.`tipo_documento`) and (`s`.`empresa_id` = `claveSII`.`empresa_id`)))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'4','5') = 5) and (`s`.`fecha_ingreso` >= '2017-05-31') and (`s`.`fecha_ingreso` <= '2017-06-30')) group by `s`.`invoice_number`,`DTE_informacionEmpresas`.`CodEmpresa`,`s`.`tipo_documento_id`) union all (select `s`.`invoice_number` AS `Factura`,33 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `SubTotal`,sum(round(((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100) / 1),0)) AS `Dcto_Monto`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `Neto`,sum(round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) AS `IVA`,sum((round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) AS `Total`,`s`.`suplier_id` AS `FactReferencia`,0 AS `IVA_Retener`,'FE' AS `TipoDoctoRef`,1 AS `causaNCND`,'20160101' AS `Fecha_Ref`,ucase(`supliers`.`suplier_name`) AS `CL03_NombreLargo`,ucase(`supliers`.`suplier_rut`) AS `CL04_Rut`,`DTE_informacionEmpresas`.`RUTEmisor` AS `RUTEmisor`,ucase(`DTE_informacionEmpresas`.`RznSoc`) AS `RznSoc`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion` AS `FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion` AS `NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador` AS `RutAutorizador`,'LIBCOMP' AS `TpoLibro`,year(`s`.`fecha_factura`) AS `AnhoLibro`,concat('0','',replace(month(`s`.`fecha_factura`),'5','6')) AS `MesLibro`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp` from (((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 26) and (`s`.`transaction_id` > 0) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0)))) left join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) left join `supliers` on((`supliers`.`suplier_id` = `s`.`suplier_id`))) where ((`s`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'5','6') = 6) and (`s`.`fecha_ingreso` >= '2017-07-01') and (`s`.`fecha_ingreso` <= '2017-07-30')) group by `s`.`invoice_number`,`DTE_informacionEmpresas`.`CodEmpresa`,`s`.`tipo_documento_id`) union all (select `s`.`invoice_number` AS `Factura`,61 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round(((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)),0)) * 1) AS `SubTotal`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100),0)) AS `Dcto_Monto`,(sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) * 1) AS `Neto`,(sum(round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) * 1) AS `IVA`,(sum((round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) * 1) AS `Total`,0 AS `FactReferencia`,0 AS `IVA_Retener`,'FE' AS `TipoDoctoRef`,1 AS `causaNCND`,'20160101' AS `Fecha_Ref`,ucase(`supliers`.`suplier_name`) AS `CL03_NombreLargo`,ucase(`supliers`.`suplier_rut`) AS `CL04_Rut`,`DTE_informacionEmpresas`.`RUTEmisor` AS `RUTEmisor`,`DTE_informacionEmpresas`.`RznSoc` AS `RznSoc`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion` AS `FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion` AS `NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador` AS `RutAutorizador`,'LIBCOMP' AS `TpoLibro`,year(`s`.`fecha_factura`) AS `AnhoLibro`,concat('0','',replace(month(`s`.`fecha_factura`),'5','6')) AS `MesLibro`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp` from ((((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 30) and (`so`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) join `supliers` on((`supliers`.`suplier_id` = `s`.`suplier_id`))) left join `claveSII` on(((`claveSII`.`id_invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = `claveSII`.`tipo_documento`) and (`s`.`empresa_id` = `claveSII`.`empresa_id`)))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'5','6') = 6) and (`s`.`fecha_ingreso` >= '2017-07-01') and (`s`.`fecha_ingreso` <= '2017-07-30')) group by `s`.`invoice_number`,`DTE_informacionEmpresas`.`CodEmpresa`,`s`.`tipo_documento_id`) union all (select `s`.`invoice_number` AS `Factura`,34 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round(((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)),0)) * 1) AS `SubTotal`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100),0)) AS `Dcto_Monto`,(sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) * 1) AS `Neto`,0 AS `IVA`,(sum((round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) * 1) AS `Total`,0 AS `FactReferencia`,0 AS `IVA_Retener`,'FE' AS `TipoDoctoRef`,1 AS `causaNCND`,'20160101' AS `Fecha_Ref`,ucase(`supliers`.`suplier_name`) AS `CL03_NombreLargo`,ucase(`supliers`.`suplier_rut`) AS `CL04_Rut`,`DTE_informacionEmpresas`.`RUTEmisor` AS `RUTEmisor`,`DTE_informacionEmpresas`.`RznSoc` AS `RznSoc`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion` AS `FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion` AS `NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador` AS `RutAutorizador`,'LIBCOMP' AS `TpoLibro`,year(`s`.`fecha_factura`) AS `AnhoLibro`,concat('0','',replace(month(`s`.`fecha_factura`),'5','6')) AS `MesLibro`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp` from ((((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 27) and (`so`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) join `supliers` on((`supliers`.`suplier_id` = `s`.`suplier_id`))) left join `claveSII` on(((`claveSII`.`id_invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = `claveSII`.`tipo_documento`) and (`s`.`empresa_id` = `claveSII`.`empresa_id`)))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'5','6') = 6) and (`s`.`fecha_ingreso` >= '2017-07-01') and (`s`.`fecha_ingreso` <= '2017-07-30')) group by `s`.`invoice_number`,`DTE_informacionEmpresas`.`CodEmpresa`,`s`.`tipo_documento_id`) union all (select `s`.`invoice_number` AS `Factura`,33 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `SubTotal`,sum(round(((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100) / 1),0)) AS `Dcto_Monto`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `Neto`,sum(round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) AS `IVA`,sum((round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) AS `Total`,`s`.`suplier_id` AS `FactReferencia`,0 AS `IVA_Retener`,'FE' AS `TipoDoctoRef`,1 AS `causaNCND`,'20160101' AS `Fecha_Ref`,ucase(`supliers`.`suplier_name`) AS `CL03_NombreLargo`,ucase(`supliers`.`suplier_rut`) AS `CL04_Rut`,`DTE_informacionEmpresas`.`RUTEmisor` AS `RUTEmisor`,ucase(`DTE_informacionEmpresas`.`RznSoc`) AS `RznSoc`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion` AS `FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion` AS `NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador` AS `RutAutorizador`,'LIBCOMP' AS `TpoLibro`,year(`s`.`fecha_factura`) AS `AnhoLibro`,concat('0','',replace(month(`s`.`fecha_factura`),'6','7')) AS `MesLibro`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp` from (((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 26) and (`s`.`transaction_id` > 0) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0)))) left join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) left join `supliers` on((`supliers`.`suplier_id` = `s`.`suplier_id`))) where ((`s`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'6','7') = 7) and (`s`.`fecha_factura` >= '2017-07-01') and (`s`.`fecha_factura` <= '2017-07-31')) group by `s`.`invoice_number`,`DTE_informacionEmpresas`.`CodEmpresa`,`s`.`tipo_documento_id`) union all (select `s`.`invoice_number` AS `Factura`,61 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round(((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)),0)) * 1) AS `SubTotal`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100),0)) AS `Dcto_Monto`,(sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) * 1) AS `Neto`,(sum(round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) * 1) AS `IVA`,(sum((round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) * 1) AS `Total`,0 AS `FactReferencia`,0 AS `IVA_Retener`,'FE' AS `TipoDoctoRef`,1 AS `causaNCND`,'20160101' AS `Fecha_Ref`,ucase(`supliers`.`suplier_name`) AS `CL03_NombreLargo`,ucase(`supliers`.`suplier_rut`) AS `CL04_Rut`,`DTE_informacionEmpresas`.`RUTEmisor` AS `RUTEmisor`,`DTE_informacionEmpresas`.`RznSoc` AS `RznSoc`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion` AS `FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion` AS `NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador` AS `RutAutorizador`,'LIBCOMP' AS `TpoLibro`,year(`s`.`fecha_factura`) AS `AnhoLibro`,concat('0','',replace(month(`s`.`fecha_factura`),'6','7')) AS `MesLibro`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp` from ((((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 30) and (`so`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) join `supliers` on((`supliers`.`suplier_id` = `s`.`suplier_id`))) left join `claveSII` on(((`claveSII`.`id_invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = `claveSII`.`tipo_documento`) and (`s`.`empresa_id` = `claveSII`.`empresa_id`)))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'6','7') = 7) and (`s`.`fecha_factura` >= '2017-07-01') and (`s`.`fecha_factura` <= '2017-07-31')) group by `s`.`invoice_number`,`DTE_informacionEmpresas`.`CodEmpresa`,`s`.`tipo_documento_id`) union all (select `s`.`invoice_number` AS `Factura`,34 AS `Tipo_Docto`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round(((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)),0)) * 1) AS `SubTotal`,sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100),0)) AS `Dcto_Monto`,(sum(round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) * 1) AS `Neto`,0 AS `IVA`,(sum((round((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) - (((round(`so`.`cost`,0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) * 1) AS `Total`,0 AS `FactReferencia`,0 AS `IVA_Retener`,'FE' AS `TipoDoctoRef`,1 AS `causaNCND`,'20160101' AS `Fecha_Ref`,ucase(`supliers`.`suplier_name`) AS `CL03_NombreLargo`,ucase(`supliers`.`suplier_rut`) AS `CL04_Rut`,`DTE_informacionEmpresas`.`RUTEmisor` AS `RUTEmisor`,`DTE_informacionEmpresas`.`RznSoc` AS `RznSoc`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa`,`DTE_informacionEmpresas`.`FechaResolucion` AS `FechaResolucion`,`DTE_informacionEmpresas`.`NroResolucion` AS `NroResolucion`,`DTE_informacionEmpresas`.`RutAutorizador` AS `RutAutorizador`,'LIBCOMP' AS `TpoLibro`,year(`s`.`fecha_factura`) AS `AnhoLibro`,concat('0','',replace(month(`s`.`fecha_factura`),'6','7')) AS `MesLibro`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp` from ((((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 27) and (`so`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) join `supliers` on((`supliers`.`suplier_id` = `s`.`suplier_id`))) left join `claveSII` on(((`claveSII`.`id_invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = `claveSII`.`tipo_documento`) and (`s`.`empresa_id` = `claveSII`.`empresa_id`)))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'6','7') = 7) and (`s`.`fecha_factura` >= '2017-07-01') and (`s`.`fecha_factura` <= '2017-07-31')) group by `s`.`invoice_number`,`DTE_informacionEmpresas`.`CodEmpresa`,`s`.`tipo_documento_id`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `VIEW_DTE_RECIBIDO`
--

/*!50001 DROP TABLE IF EXISTS `VIEW_DTE_RECIBIDO`*/;
/*!50001 DROP VIEW IF EXISTS `VIEW_DTE_RECIBIDO`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `VIEW_DTE_RECIBIDO` AS select `DTE_Recibidos`.`RutReceptor` AS `RutReceptor`,`DTE_Recibidos`.`RutEmisor` AS `RutEmisor`,`DTE_Recibidos`.`RznSocialEmisor` AS `RznSocialEmisor`,`DTE_Recibidos`.`TipoDTE` AS `TipoDTE`,`DTE_Recibidos`.`TipoDTEDescripcion` AS `TipoDTEDescripcion`,`DTE_Recibidos`.`FolioDTE` AS `FolioDTE`,`DTE_Recibidos`.`FechaEmision` AS `FechaEmision`,`DTE_Recibidos`.`MontoTotal` AS `MontoTotal`,`DTE_Recibidos`.`FechaRecepcion` AS `FechaRecepcion`,`DTE_Recibidos`.`CorreoUID` AS `CorreoUID`,`DTE_Recibidos`.`XMLRecibido` AS `XMLRecibido`,`DTE_Recibidos`.`FechaVencimiento` AS `FechaVencimiento`,`DTE_Recibidos`.`EstadoValidacionXML` AS `EstadoValidacionXML`,`DTE_Recibidos`.`ID` AS `ID`,`DTE_Recibidos`.`EmailProveedor` AS `EmailProveedor`,`DTE_Recibidos`.`IdEnvio` AS `IdEnvio` from `DTE_Recibidos` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `VIEW_GUIAS_FACTURA`
--

/*!50001 DROP TABLE IF EXISTS `VIEW_GUIAS_FACTURA`*/;
/*!50001 DROP VIEW IF EXISTS `VIEW_GUIAS_FACTURA`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `VIEW_GUIAS_FACTURA` AS select 0 AS `Guia`,'GE' AS `Tipo_Docto`,1 AS `Empresa`,'FE' AS `TipoFactura`,1 AS `NFactura`,20160101 AS `Fecha_Mov` from `sales` where (1 = 0) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `VIEW_GUIA_DESPACHO_LIBRO`
--

/*!50001 DROP TABLE IF EXISTS `VIEW_GUIA_DESPACHO_LIBRO`*/;
/*!50001 DROP VIEW IF EXISTS `VIEW_GUIA_DESPACHO_LIBRO`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `VIEW_GUIA_DESPACHO_LIBRO` AS select distinct 'PROCESO' AS `Proceso`,'MOV' AS `Mov`,1 AS `Guia_Original`,'GE' AS `Tipo_Docto`,'1' AS `Estado_Docto`,20160101 AS `Fecha_Mov`,'NOMBRE CLIENTE' AS `Cliente`,'DIR DESTINO' AS `Destino_Dir`,'CIUDAD DESTINO' AS `Destino_Ciu`,'ORDEN ' AS `OrdenCompra`,0 AS `TCambio`,'ORDEN TRAB' AS `OrdenT`,1 AS `Origen`,'PRODUCTO' AS `Producto`,0 AS `TOTPzas`,0 AS `TOTPqts`,0 AS `TOTVolumen`,'NOM CHOFER' AS `Chofer`,'RUT CHOFER' AS `Rut_Chofer`,'PATENTE CAMION' AS `Patente_Camion`,'PATENTE CARRO' AS `Patente_Carro`,'NOMBRE TRANSPORTE' AS `Transportista`,'NOMBRE DESPACHADOR' AS `Despachador`,'0' AS `CostoFlete`,0 AS `CPago`,0 AS `SubTotal`,0 AS `Dscto_Porc1`,0 AS `Dscto_Monto1`,0 AS `Neto`,0 AS `IVA_Porc`,0 AS `IVA`,0 AS `Total`,'NOMBRE RECEPCIONISTA' AS `Nom_QRecibe`,'RUT RECEPCIONISTA' AS `Rut_QRecibe`,0 AS `Efectivo`,0 AS `ChFec001`,0 AS `NCh001`,0 AS `BcoCh001`,0 AS `ChFec011`,0 AS `NChFec011`,0 AS `BcoChFec011`,0 AS `ChFec021`,0 AS `NChFec021`,0 AS `BcoChFec021`,'1212' AS `GuiaProveedor`,1 AS `Moneda`,0 AS `Monto_01`,0 AS `Monto_02`,0 AS `Monto_03`,0 AS `EXP_EXI700`,0 AS `FEC_EXI700`,'OBSERVACION ' AS `Obs`,1 AS `Destino`,1 AS `Empresa`,'UNIDAD RECEPCION' AS `Unidad_R`,0 AS `Cantidad_R`,0 AS `VolFlete`,'UNIDAD FLETE' AS `Unidad_Flete`,0 AS `Retorno`,0 AS `Ruta`,'NOMBRE ANULA' AS `Anulado_Por`,20160101 AS `Fec_Anulacion`,1 AS `F_Pago_Flete`,0 AS `TCambio_Flete`,'NOMBRE AUT PAGO' AS `Autoriza_Pago_Flete`,0 AS `AfectaPrecio`,0 AS `AfectaVolumen`,20160101 AS `Fec_Vcto`,0 AS `Emitido`,'EMPRESA CARGUIO' AS `Carguio`,'EMPRESA DESCARGIUO' AS `Descarguio`,0 AS `RecepcionCliente`,'COSECHA' AS `Cosecha`,0 AS `IVA_Porc_Retener`,0 AS `IVA_Retener`,'NOMBREEMITE PAGO FLETE' AS `Emite_Pago_Flete`,0 AS `TipoDetalle`,0 AS `CERTFOR`,'DESCRIPCON CERTIFICACION' AS `NCERTFOR`,0 AS `NroViaje`,0 AS `CodFlete`,'RUT CLIENTE' AS `CL04_Rut`,'NOMBRE CLIENTE' AS `CL03_NombreLargo`,'FE' AS `TipoFactura`,1 AS `NFactura`,20160101 AS `FechaFactura` from `sales` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `VIEW_LIBRO_COMPRA`
--

/*!50001 DROP TABLE IF EXISTS `VIEW_LIBRO_COMPRA`*/;
/*!50001 DROP VIEW IF EXISTS `VIEW_LIBRO_COMPRA`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `VIEW_LIBRO_COMPRA` AS (select count(distinct `s`.`transaction_id`) AS `NroDTE`,33 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,replace(month(`s`.`fecha_factura`),'1','2') AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `SubTotal`,sum(round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1) / 1),0)) AS `Dcto_Monto`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `Neto`,sum(round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0)) AS `IVA`,sum((round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0) + round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0))) AS `Total`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 26) and (`s`.`transaction_id` > 0) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`s`.`delete` = 0)))) left join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 1)) group by `s`.`transaction_id`,replace(month(`s`.`fecha_factura`),'1','2'),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,61 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,replace(month(`s`.`fecha_factura`),'1','2') AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) * -(1)) AS `SubTotal`,sum(round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1) / 1),0)) AS `Dcto_Monto`,(sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) * -(1)) AS `Neto`,(sum(round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0)) * -(1)) AS `IVA`,(sum((round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0) + round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0))) * -(1)) AS `Total`,sum(0) AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 30) and (`so`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 1)) group by `s`.`transaction_id`,replace(month(`s`.`fecha_factura`),'1','2'),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,34 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,replace(month(`s`.`fecha_factura`),'1','2') AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `SubTotal`,sum(round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1) / 1),0)) AS `Dcto_Monto`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `Neto`,0 AS `IVA`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `Total`,sum(0) AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 27) and (`so`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 1)) group by `s`.`transaction_id`,replace(month(`s`.`fecha_factura`),'1','2'),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,33 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,replace(month(`s`.`fecha_factura`),'1','2') AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `SubTotal`,sum(round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1) / 1),0)) AS `Dcto_Monto`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `Neto`,sum(round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0)) AS `IVA`,sum((round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0) + round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0))) AS `Total`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` left join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 26) and (`s`.`transaction_id` > 0) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`s`.`delete` = 0)))) left join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'1','2') = 2) and (`s`.`fecha_ingreso` <= '2017-03-31')) group by `s`.`transaction_id`,replace(month(`s`.`fecha_factura`),'1','2'),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,61 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,replace(month(`s`.`fecha_factura`),'1','2') AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) * -(1)) AS `SubTotal`,sum(round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1) / 1),0)) AS `Dcto_Monto`,(sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) * -(1)) AS `Neto`,(sum(round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0)) * -(1)) AS `IVA`,(sum((round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0) + round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0))) * -(1)) AS `Total`,sum(0) AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 30) and (`so`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'1','2') = 2) and (`s`.`fecha_ingreso` <= '2017-03-31')) group by `s`.`transaction_id`,replace(month(`s`.`fecha_factura`),'1','2'),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,34 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,replace(month(`s`.`fecha_factura`),'1','2') AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `SubTotal`,sum(round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1) / 1),0)) AS `Dcto_Monto`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `Neto`,0 AS `IVA`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `Total`,sum(0) AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` left join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 27) and (`so`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'1','2') = 2) and (`s`.`fecha_ingreso` <= '2017-03-31')) group by `s`.`transaction_id`,replace(month(`s`.`fecha_factura`),'1','2'),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,33 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,replace(month(`s`.`fecha_factura`),'2','3') AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `SubTotal`,sum(round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1) / 1),0)) AS `Dcto_Monto`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `Neto`,sum(round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0)) AS `IVA`,sum((round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0) + round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0))) AS `Total`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` left join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 26) and (`s`.`transaction_id` > 0) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`s`.`delete` = 0)))) left join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'2','3') in (2,3)) and (`s`.`fecha_ingreso` >= '2017-04-01') and (`s`.`fecha_ingreso` <= '2017-05-30')) group by `s`.`transaction_id`,replace(month(`s`.`fecha_factura`),'2','3'),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,61 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,replace(month(`s`.`fecha_factura`),'2','3') AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) * -(1)) AS `SubTotal`,sum(round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1) / 1),0)) AS `Dcto_Monto`,(sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) * -(1)) AS `Neto`,(sum(round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0)) * -(1)) AS `IVA`,(sum((round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0) + round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0))) * -(1)) AS `Total`,sum(0) AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 30) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`s`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'2','3') in (2,3)) and (`s`.`fecha_ingreso` >= '2017-04-01') and (`s`.`fecha_ingreso` <= '2017-05-30')) group by `s`.`transaction_id`,replace(month(`s`.`fecha_factura`),'2','3'),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,34 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,replace(month(`s`.`fecha_factura`),'2','3') AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `SubTotal`,sum(round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1) / 1),0)) AS `Dcto_Monto`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `Neto`,0 AS `IVA`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `Total`,sum(0) AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 27) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`s`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'2','3') in (2,3)) and (`s`.`fecha_ingreso` >= '2017-04-01') and (`s`.`fecha_ingreso` <= '2017-05-30')) group by `s`.`transaction_id`,replace(month(`s`.`fecha_factura`),'2','3'),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,33 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,replace(month(`s`.`fecha_factura`),'3','4') AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `SubTotal`,sum(round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1) / 1),0)) AS `Dcto_Monto`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `Neto`,sum(round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0)) AS `IVA`,sum((round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0) + round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0))) AS `Total`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` left join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 26) and (`s`.`transaction_id` > 0) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`s`.`delete` = 0)))) left join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'3','4') in (3,4)) and (`s`.`fecha_ingreso` >= '2017-05-01') and (`s`.`fecha_ingreso` <= '2017-05-30')) group by `s`.`transaction_id`,replace(month(`s`.`fecha_factura`),'3','4'),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,61 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,replace(month(`s`.`fecha_factura`),'3','4') AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) * -(1)) AS `SubTotal`,sum(round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1) / 1),0)) AS `Dcto_Monto`,(sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) * -(1)) AS `Neto`,(sum(round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0)) * -(1)) AS `IVA`,(sum((round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0) + round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0))) * -(1)) AS `Total`,sum(0) AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 30) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`s`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'3','4') in (3,4)) and (`s`.`fecha_ingreso` >= '2017-05-01') and (`s`.`fecha_ingreso` <= '2017-05-30')) group by `s`.`transaction_id`,replace(month(`s`.`fecha_factura`),'3','4'),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,34 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,replace(month(`s`.`fecha_factura`),'3','4') AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `SubTotal`,sum(round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1) / 1),0)) AS `Dcto_Monto`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `Neto`,0 AS `IVA`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `Total`,sum(0) AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 27) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`s`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'3','4') in (3,4)) and (`s`.`fecha_ingreso` >= '2017-04-01') and (`s`.`fecha_ingreso` <= '2017-05-30')) group by `s`.`transaction_id`,replace(month(`s`.`fecha_factura`),'3','4'),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,33 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,replace(month(`s`.`fecha_factura`),'4','5') AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `SubTotal`,sum(round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1) / 1),0)) AS `Dcto_Monto`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `Neto`,sum(round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0)) AS `IVA`,sum((round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0) + round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0))) AS `Total`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` left join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 26) and (`s`.`transaction_id` > 0) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`s`.`delete` = 0)))) left join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'4','5') in (4,5)) and (`s`.`fecha_ingreso` >= '2017-05-31') and (`s`.`fecha_ingreso` <= '2017-06-30')) group by `s`.`transaction_id`,replace(month(`s`.`fecha_factura`),'4','5'),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,61 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,replace(month(`s`.`fecha_factura`),'4','5') AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) * -(1)) AS `SubTotal`,sum(round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1) / 1),0)) AS `Dcto_Monto`,(sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) * -(1)) AS `Neto`,(sum(round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0)) * -(1)) AS `IVA`,(sum((round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0) + round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0))) * -(1)) AS `Total`,sum(0) AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 30) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`s`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'4','5') in (4,5)) and (`s`.`fecha_ingreso` >= '2017-05-31') and (`s`.`fecha_ingreso` <= '2017-06-30')) group by `s`.`transaction_id`,replace(month(`s`.`fecha_factura`),'4','5'),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,34 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,replace(month(`s`.`fecha_factura`),'4','5') AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `SubTotal`,sum(round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1) / 1),0)) AS `Dcto_Monto`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `Neto`,0 AS `IVA`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `Total`,sum(0) AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 27) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`s`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'4','5') in (4,5)) and (`s`.`fecha_ingreso` >= '2017-05-31') and (`s`.`fecha_ingreso` <= '2017-06-30')) group by `s`.`transaction_id`,replace(month(`s`.`fecha_factura`),'4','5'),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,33 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,replace(month(`s`.`fecha_factura`),'5','6') AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `SubTotal`,sum(round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1) / 1),0)) AS `Dcto_Monto`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `Neto`,sum(round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0)) AS `IVA`,sum((round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0) + round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0))) AS `Total`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` left join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 26) and (`s`.`transaction_id` > 0) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`s`.`delete` = 0)))) left join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'5','6') in (5,6)) and (`s`.`fecha_ingreso` >= '2017-07-01') and (`s`.`fecha_ingreso` <= '2017-07-30')) group by `s`.`transaction_id`,replace(month(`s`.`fecha_factura`),'5','6'),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,61 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,replace(month(`s`.`fecha_factura`),'5','6') AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) * -(1)) AS `SubTotal`,sum(round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1) / 1),0)) AS `Dcto_Monto`,(sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) * -(1)) AS `Neto`,(sum(round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0)) * -(1)) AS `IVA`,(sum((round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0) + round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0))) * -(1)) AS `Total`,sum(0) AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 30) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`s`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'5','6') in (5,6)) and (`s`.`fecha_ingreso` >= '2017-07-01') and (`s`.`fecha_ingreso` <= '2017-07-30')) group by `s`.`transaction_id`,replace(month(`s`.`fecha_factura`),'5','6'),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,34 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,replace(month(`s`.`fecha_factura`),'5','6') AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `SubTotal`,sum(round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1) / 1),0)) AS `Dcto_Monto`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `Neto`,0 AS `IVA`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `Total`,sum(0) AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 27) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`s`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'5','6') in (5,6)) and (`s`.`fecha_ingreso` >= '2017-07-01') and (`s`.`fecha_ingreso` <= '2017-07-30')) group by `s`.`transaction_id`,replace(month(`s`.`fecha_factura`),'5','6'),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,33 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,replace(month(`s`.`fecha_factura`),'6','7') AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `SubTotal`,sum(round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1) / 1),0)) AS `Dcto_Monto`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `Neto`,sum(round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0)) AS `IVA`,sum((round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0) + round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0))) AS `Total`,(sum(`s`.`adicional`) / count(`so`.`invoice`)) AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` left join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 26) and (`s`.`transaction_id` > 0) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`s`.`delete` = 0)))) left join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'6','7') in (6,7)) and (`s`.`fecha_factura` >= '2017-07-01') and (`s`.`fecha_factura` <= '2017-07-31')) group by `s`.`transaction_id`,replace(month(`s`.`fecha_factura`),'6','7'),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,61 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,replace(month(`s`.`fecha_factura`),'6','7') AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) * -(1)) AS `SubTotal`,sum(round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1) / 1),0)) AS `Dcto_Monto`,(sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) * -(1)) AS `Neto`,(sum(round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0)) * -(1)) AS `IVA`,(sum((round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0) + round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1) * 19) / 100),0))) * -(1)) AS `Total`,sum(0) AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 30) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`s`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'6','7') in (6,7)) and (`s`.`fecha_factura` >= '2017-07-01') and (`s`.`fecha_factura` <= '2017-07-31')) group by `s`.`transaction_id`,replace(month(`s`.`fecha_factura`),'6','7'),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,34 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,replace(month(`s`.`fecha_factura`),'6','7') AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `SubTotal`,sum(round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1) / 1),0)) AS `Dcto_Monto`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `Neto`,0 AS `IVA`,sum(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 1)) / 1),0)) AS `Total`,sum(0) AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 27) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`s`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`so`.`delete` = 0) and (`s`.`empresa_id` = 2) and (replace(month(`s`.`fecha_factura`),'6','7') in (6,7)) and (`s`.`fecha_factura` >= '2017-07-01') and (`s`.`fecha_factura` <= '2017-07-31')) group by `s`.`transaction_id`,replace(month(`s`.`fecha_factura`),'6','7'),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `VIEW_LIBRO_COMPRA_DETALLE`
--

/*!50001 DROP TABLE IF EXISTS `VIEW_LIBRO_COMPRA_DETALLE`*/;
/*!50001 DROP VIEW IF EXISTS `VIEW_LIBRO_COMPRA_DETALLE`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `VIEW_LIBRO_COMPRA_DETALLE` AS (select `s`.`invoice_number` AS `Factura`,33 AS `Tipo_Docto`,year(`s`.`fecha_ingreso`) AS `anho`,month(`s`.`fecha_ingreso`) AS `mes`,replace(`s`.`fecha_ingreso`,'-','') AS `Fecha_Mov`,round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1),0) AS `SubTotal`,round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100) / 1),0) AS `Dcto_Monto`,round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1),0) AS `Neto`,round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0) AS `IVA`,(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1),0) + round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) AS `Total`,`s`.`adicional` AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 26) and (`s`.`transaction_id` > 0) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`s`.`delete` = 0)))) left join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where (`so`.`delete` = 0)) union all (select `s`.`invoice_number` AS `Factura`,30 AS `Tipo_Docto`,year(`s`.`fecha_ingreso`) AS `anho`,month(`s`.`fecha_ingreso`) AS `mes`,replace(`s`.`fecha_ingreso`,'-','') AS `Fecha_Mov`,round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1),0) AS `SubTotal`,round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100) / 1),0) AS `Dcto_Monto`,round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1),0) AS `Neto`,round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0) AS `IVA`,(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1),0) + round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) AS `Total`,`s`.`adicional` AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 12) and (`s`.`transaction_id` > 0) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`s`.`delete` = 0)))) left join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where (`so`.`delete` = 0)) union all (select `s`.`invoice_number` AS `Factura`,61 AS `Tipo_Docto`,year(`s`.`fecha_ingreso`) AS `anho`,month(`s`.`fecha_ingreso`) AS `mes`,replace(`s`.`fecha_ingreso`,'-','') AS `Fecha_Mov`,(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1),0) * 1) AS `SubTotal`,round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100) / 1),0) AS `Dcto_Monto`,(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1),0) * 1) AS `Neto`,(round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0) * 1) AS `IVA`,((round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1),0) + round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) * 1) AS `Total`,sum(0) AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 30) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`s`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where (`so`.`delete` = 0)) union all (select `s`.`invoice_number` AS `Factura`,34 AS `Tipo_Docto`,year(`s`.`fecha_ingreso`) AS `anho`,month(`s`.`fecha_ingreso`) AS `mes`,replace(`s`.`fecha_ingreso`,'-','') AS `Fecha_Mov`,round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1),0) AS `SubTotal`,round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100) / 1),0) AS `Dcto_Monto`,round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1),0) AS `Neto`,0 AS `IVA`,round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1),0) AS `Total`,sum(0) AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 27) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`s`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where (`so`.`delete` = 0)) union all (select `s`.`invoice_number` AS `Factura`,60 AS `Tipo_Docto`,year(`s`.`fecha_ingreso`) AS `anho`,month(`s`.`fecha_ingreso`) AS `mes`,replace(`s`.`fecha_ingreso`,'-','') AS `Fecha_Mov`,(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1),0) * 1) AS `SubTotal`,round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100) / 1),0) AS `Dcto_Monto`,(round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1),0) * 1) AS `Neto`,(round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0) * 1) AS `IVA`,((round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1),0) + round((((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) * 1) AS `Total`,sum(0) AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 24) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`s`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where (`so`.`delete` = 0)) union all (select `s`.`invoice_number` AS `Factura`,32 AS `Tipo_Docto`,year(`s`.`fecha_ingreso`) AS `anho`,month(`s`.`fecha_ingreso`) AS `mes`,replace(`s`.`fecha_ingreso`,'-','') AS `Fecha_Mov`,round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1),0) AS `SubTotal`,round(((((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100) / 1),0) AS `Dcto_Monto`,round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1),0) AS `Neto`,0 AS `IVA`,round((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1),0) AS `Total`,sum(0) AS `Otros_imp`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`purchases` `s` join `purchases_item` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 25) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`s`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where (`so`.`delete` = 0)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `VIEW_LIBRO_VENTA`
--

/*!50001 DROP TABLE IF EXISTS `VIEW_LIBRO_VENTA`*/;
/*!50001 DROP VIEW IF EXISTS `VIEW_LIBRO_VENTA`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `VIEW_LIBRO_VENTA` AS (select count(distinct `s`.`transaction_id`) AS `NroDTE`,33 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,month(`s`.`fecha_factura`) AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `SubTotal`,sum(round(((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100) / 1),0)) AS `Dcto_Monto`,sum(round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `Neto`,sum(round((((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) AS `IVA`,sum((round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) AS `Total`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`sales` `s` join `sales_order` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 26) and (`s`.`transaction_id` > 0) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`so`.`delete` = 0) and (`s`.`delete` = 0)))) left join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where (`so`.`delete` = 0) group by month(`s`.`fecha_factura`),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,61 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,month(`s`.`fecha_factura`) AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1.19),0)) * -(1)) AS `SubTotal`,sum(round(((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100) / 1.19),0)) AS `Dcto_Monto`,(sum(round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) * -(1)) AS `Neto`,(sum(round((((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) * -(1)) AS `IVA`,(sum((round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) * -(1)) AS `Total`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`sales` `s` join `sales_order` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 24) and (`so`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where (`so`.`delete` = 0) group by month(`s`.`fecha_factura`),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `VIEW_LIBRO_VENTAS_SIN_KILOS`
--

/*!50001 DROP TABLE IF EXISTS `VIEW_LIBRO_VENTAS_SIN_KILOS`*/;
/*!50001 DROP VIEW IF EXISTS `VIEW_LIBRO_VENTAS_SIN_KILOS`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `VIEW_LIBRO_VENTAS_SIN_KILOS` AS (select count(distinct `s`.`transaction_id`) AS `NroDTE`,33 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,month(`s`.`fecha_factura`) AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((round((`so`.`cost` / 1.19),0) * round(`so`.`qty`,0)) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `SubTotal`,sum(round(((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100) / 1),0)) AS `Dcto_Monto`,sum(round((((round((`so`.`cost` / 1.19),0) * round(`so`.`qty`,0)) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `Neto`,sum(round((((((round((`so`.`cost` / 1.19),0) * round(`so`.`qty`,0)) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) AS `IVA`,sum((round((((round((`so`.`cost` / 1.19),0) * round(`so`.`qty`,0)) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round((`so`.`cost` / 1.19),0) * round(`so`.`qty`,0)) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) AS `Total`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`sales` `s` join `sales_order` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 26) and (`s`.`transaction_id` > 0) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0)))) left join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`s`.`fecha_factura` >= '2017-02-01') and (`s`.`fecha_factura` <= '2017-02-15')) group by month(`s`.`fecha_factura`),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,61 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,month(`s`.`fecha_factura`) AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round((((round((`so`.`cost` / 1.19),0) * round(`so`.`qty`,0)) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1.19),0)) * -(1)) AS `SubTotal`,sum(round(((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100) / 1.19),0)) AS `Dcto_Monto`,(sum(round((((round((`so`.`cost` / 1.19),0) * round(`so`.`qty`,0)) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) * -(1)) AS `Neto`,(sum(round((((((round((`so`.`cost` / 1.19),0) * round(`so`.`qty`,0)) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) * -(1)) AS `IVA`,(sum((round((((round((`so`.`cost` / 1.19),0) * round(`so`.`qty`,0)) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round((`so`.`cost` / 1.19),0) * round(`so`.`qty`,0)) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) * -(1)) AS `Total`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`sales` `s` join `sales_order` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 24) and (`so`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`s`.`fecha_factura` >= '2017-02-01') and (`s`.`fecha_factura` <= '2017-02-15')) group by month(`s`.`fecha_factura`),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,33 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,month(`s`.`fecha_factura`) AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `SubTotal`,sum(round(((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100) / 1),0)) AS `Dcto_Monto`,sum(round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `Neto`,sum(round((((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) AS `IVA`,sum((round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) AS `Total`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`sales` `s` join `sales_order` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 26) and (`s`.`transaction_id` > 0) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0)))) left join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`s`.`fecha_factura` >= '2017-02-16') and (`s`.`fecha_factura` < '2017-03-01')) group by month(`s`.`fecha_factura`),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,61 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,month(`s`.`fecha_factura`) AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1.19),0)) * -(1)) AS `SubTotal`,sum(round(((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100) / 1.19),0)) AS `Dcto_Monto`,(sum(round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) * -(1)) AS `Neto`,(sum(round((((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) * -(1)) AS `IVA`,(sum((round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) * -(1)) AS `Total`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`sales` `s` join `sales_order` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 24) and (`so`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`s`.`fecha_factura` >= '2017-02-16') and (`s`.`fecha_factura` < '2017-03-01')) group by month(`s`.`fecha_factura`),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,33 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,month(`s`.`fecha_factura`) AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,sum(round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `SubTotal`,sum(round(((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100) / 1),0)) AS `Dcto_Monto`,sum(round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) AS `Neto`,sum(round((((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) AS `IVA`,sum((round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) AS `Total`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`sales` `s` join `sales_order` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 26) and (`s`.`transaction_id` > 0) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`so`.`delete` = 0)))) left join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`so`.`delete` = 0) and (`s`.`fecha_factura` >= '2017-03-01')) group by month(`s`.`fecha_factura`),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) union all (select count(distinct `s`.`transaction_id`) AS `NroDTE`,61 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,month(`s`.`fecha_factura`) AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(sum(round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1.19),0)) * -(1)) AS `SubTotal`,sum(round(((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100) / 1.19),0)) AS `Dcto_Monto`,(sum(round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0)) * -(1)) AS `Neto`,(sum(round((((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) * -(1)) AS `IVA`,(sum((round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0))) * -(1)) AS `Total`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from ((`sales` `s` join `sales_order` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 24) and (`so`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) where ((`so`.`delete` = 0) and (`s`.`fecha_factura` >= '2017-03-01')) group by month(`s`.`fecha_factura`),year(`s`.`fecha_factura`),`DTE_informacionEmpresas`.`CodEmpresa`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `VIEW_LIBRO_VENTA_DETALLE`
--

/*!50001 DROP TABLE IF EXISTS `VIEW_LIBRO_VENTA_DETALLE`*/;
/*!50001 DROP VIEW IF EXISTS `VIEW_LIBRO_VENTA_DETALLE`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `VIEW_LIBRO_VENTA_DETALLE` AS (select (case when (`claveSII`.`folio_DTE` > 0) then `claveSII`.`folio_DTE` else `s`.`transaction_id` end) AS `Factura`,33 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,month(`s`.`fecha_factura`) AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) AS `SubTotal`,round(((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100) / 1),0) AS `Dcto_Monto`,round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) AS `Neto`,round((((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0) AS `IVA`,(round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) AS `Total`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from (((`sales` `s` join `sales_order` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 26) and (`s`.`transaction_id` > 0) and (`s`.`empresa_id` = `so`.`empresa_id`) and (`s`.`sucursal_id` = `so`.`sucursal_id`) and (`so`.`delete` = 0) and (`s`.`delete` = 0)))) left join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) left join `claveSII` on(((`claveSII`.`id_invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = `claveSII`.`tipo_documento`) and (`s`.`empresa_id` = `claveSII`.`empresa_id`)))) where (`so`.`delete` = 0)) union all (select (case when (`claveSII`.`folio_DTE` > 0) then `claveSII`.`folio_DTE` else `s`.`transaction_id` end) AS `Factura`,61 AS `Tipo_Docto`,year(`s`.`fecha_factura`) AS `anho`,month(`s`.`fecha_factura`) AS `mes`,replace(`s`.`fecha_factura`,'-','') AS `Fecha_Mov`,(round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1.19),0) * -(1)) AS `SubTotal`,round(((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100) / 1.19),0) AS `Dcto_Monto`,(round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) * -(1)) AS `Neto`,(round((((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0) * -(1)) AS `IVA`,((round((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1),0) + round((((((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) - (((round((`so`.`cost` / 1.19),0) * cast(`so`.`qty` as decimal(11,3))) * `so`.`descuento`) / 100)) / 1) * 19) / 100),0)) * -(1)) AS `Total`,`DTE_informacionEmpresas`.`CodEmpresa` AS `CodEmpresa` from (((`sales` `s` join `sales_order` `so` on(((`so`.`invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = 24) and (`so`.`delete` = 0)))) join `DTE_informacionEmpresas` on((`s`.`empresa_id` = `DTE_informacionEmpresas`.`CodEmpresa`))) left join `claveSII` on(((`claveSII`.`id_invoice` = `s`.`transaction_id`) and (`s`.`tipo_documento_id` = `claveSII`.`tipo_documento`) and (`s`.`empresa_id` = `claveSII`.`empresa_id`)))) where (`so`.`delete` = 0)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-10  0:01:06
