-- Progettazione Web 
DROP DATABASE if exists build_your_pc_db; 
CREATE DATABASE build_your_pc_db; 
USE build_your_pc_db; 
-- MySQL dump 10.13  Distrib 5.7.28, for Win64 (x86_64)
--
-- Host: localhost    Database: build_your_pc_db
-- ------------------------------------------------------
-- Server version	5.7.28

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
-- Table structure for table `compatibile_cpu_cooler`
--

DROP TABLE IF EXISTS `compatibile_cpu_cooler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compatibile_cpu_cooler` (
  `Codice_Cooler` char(5) NOT NULL,
  `Socket` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compatibile_cpu_cooler`
--

LOCK TABLES `compatibile_cpu_cooler` WRITE;
/*!40000 ALTER TABLE `compatibile_cpu_cooler` DISABLE KEYS */;
INSERT INTO `compatibile_cpu_cooler` VALUES ('B001','LGA1151'),('B001','LGA1200'),('B001','LGA1700'),('B001','AM4'),('B002','LGA1151'),('B002','LGA1200'),('B002','AM4'),('B003','LGA1151'),('B003','AM4'),('B004','LGA1151'),('B004','LGA1200'),('B004','LGA1700'),('B004','AM4'),('B005','LGA1151'),('B006','LGA1151'),('B006','AM4');
/*!40000 ALTER TABLE `compatibile_cpu_cooler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configurazioni`
--

DROP TABLE IF EXISTS `configurazioni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configurazioni` (
  `id_configurazione` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `titolo` varchar(255) DEFAULT NULL,
  `CPU` varchar(15) DEFAULT NULL,
  `MOTHERBOARD` varchar(15) DEFAULT NULL,
  `RAM` varchar(15) DEFAULT NULL,
  `COOLER` varchar(15) DEFAULT NULL,
  `VIDEO_CARD` varchar(15) DEFAULT NULL,
  `ALIMENTATORE` varchar(15) DEFAULT NULL,
  `PC_CASE` varchar(15) DEFAULT NULL,
  `SSD` varchar(15) DEFAULT NULL,
  `HARD_DISK` varchar(15) DEFAULT NULL,
  `MONITOR` varchar(15) DEFAULT NULL,
  `PREZZO` double DEFAULT NULL,
  `WATTAGE` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_configurazione`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configurazioni`
--

LOCK TABLES `configurazioni` WRITE;
/*!40000 ALTER TABLE `configurazioni` DISABLE KEYS */;
INSERT INTO `configurazioni` VALUES (3,'admin','CONF_3','A003','C010','D007','B002','E003','F004','G004','L001',NULL,NULL,1828.31,339),(5,'admin','CONF_2','A005','C006','D001','B001','E001','F004','G005','L002','I001','H001',3550.37,559),(11,'admin','CONF_1','A004','C009','D008','B001','E002','F005','G005','L002','I001','H002',2383.39,324),(14,'mario','TEST','A006','C001','D008','B001','E004','F001','G001','L002','I002','H004',2341.3,429),(15,'mario','FASCIA_BASSA','A008','C002','D007','B004',NULL,'F003','G003','L001','I001','H004',796.16,179);
/*!40000 ALTER TABLE `configurazioni` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configurazioni_standard`
--

DROP TABLE IF EXISTS `configurazioni_standard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configurazioni_standard` (
  `id_configurazione` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_username` varchar(50) NOT NULL,
  `titolo` varchar(255) DEFAULT NULL,
  `CPU` varchar(15) DEFAULT NULL,
  `MOTHERBOARD` varchar(15) DEFAULT NULL,
  `RAM` varchar(15) DEFAULT NULL,
  `COOLER` varchar(15) DEFAULT NULL,
  `VIDEO_CARD` varchar(15) DEFAULT NULL,
  `ALIMENTATORE` varchar(15) DEFAULT NULL,
  `PC_CASE` varchar(15) DEFAULT NULL,
  `SSD` varchar(15) DEFAULT NULL,
  `HARD_DISK` varchar(15) DEFAULT NULL,
  `MONITOR` varchar(15) DEFAULT NULL,
  `PREZZO` double DEFAULT NULL,
  `WATTAGE` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_configurazione`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configurazioni_standard`
--

LOCK TABLES `configurazioni_standard` WRITE;
/*!40000 ALTER TABLE `configurazioni_standard` DISABLE KEYS */;
INSERT INTO `configurazioni_standard` VALUES (1,'gamer','FASCIA_BASSA','A008','C005','D007','B004','E002','F006','G005','L003','I001','H006',1200.62,264),(2,'gamer','FASCIA_MEDIA','A002','C008','D007','B004','E003','F005','G005','L003','I001','H005',1619.68,354),(3,'gamer','FASCIA_ALTA','A003','C009','D009','B001','E001','F004','G004','L002','I002','H001',3510.81,539),(4,'lavoratore','FASCIA_BASSA','A008','C002','D007','B004',NULL,'F003','G001','L001','I001','H004',766.15,179),(5,'lavoratore','FASCIA_MEDIA','A002','C011','D007','B002','E002','F003','G002','L002','I001','H005',1547.76,299),(6,'lavoratore','FASCIA_ALTA','A005','C006','D003','B001','E004','F004','G004','L002','I002','H003',3189.36,437),(7,'studente','FASCIA_BASSA','A008','C002','D007','B004',NULL,'F003','G003','L001','I001','H004',796.16,179),(8,'studente','FASCIA_MEDIA','A008','C001','D007','B002','E002','F003','G003','L001','I001','H005',1393.81,259),(9,'studente','FASCIA_ALTA','A006','C001','D008','B001','E004','F001','G001','L002','I002','H002',2721.31,429),(10,'altro','FASCIA_BASSA','A009','C002','D007','B004',NULL,'F003','G003','L001','I001','H004',693.05,179),(11,'altro','FASCIA_MEDIA','A002','C008','D007','B004','E003','F005','G005','L003','I001','H005',1619.68,354),(12,'altro','FASCIA_ALTA','A005','C006','D003','B001','E004','F004','G004','L002','I002','H003',3189.36,437);
/*!40000 ALTER TABLE `configurazioni_standard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cooler`
--

DROP TABLE IF EXISTS `cooler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cooler` (
  `Codice` char(5) NOT NULL,
  `Marca` char(50) DEFAULT NULL,
  `Nome_Serie` char(50) DEFAULT NULL,
  `Tipologia` char(50) DEFAULT NULL,
  `Dimensioni` char(50) DEFAULT NULL,
  `Wattaggio` int(11) DEFAULT NULL,
  `Prezzo` double NOT NULL,
  `Link` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cooler`
--

LOCK TABLES `cooler` WRITE;
/*!40000 ALTER TABLE `cooler` DISABLE KEYS */;
INSERT INTO `cooler` VALUES ('B001','ASUS','ASUS ROG Strix LC II 360','Liquido','42x24x13',15,222.99,'https://amzn.to/344SSxv'),('B002','MSI','MSI MAG CORELIQUID C240','Liquido','45x25x20',15,129,'https://amzn.to/36YnrWR'),('B003','COOLER MASTER','COOLER MASTER MASTERLIQUID LITE 120','Liquido','15.7x12x2.7',15,44.99,'https://amzn.to/3sxZDBb'),('B004','ARCTIC','ARCTIC Freezer 34 eSports DUO','Aria','19x13x11',10,44.99,'https://amzn.to/3hsblag'),('B005','NOCTUA','Noctua NH-U9B SE2','Aria','9.5x9.5x12.5',10,49.9,'https://amzn.to/36UFz3K'),('B006','COOLER MASTER','Cooler Master MasterAir MA624 Stealth','Aria','14.5x15.3x16',10,99.41,'https://amzn.to/3hvvI6p');
/*!40000 ALTER TABLE `cooler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cpu`
--

DROP TABLE IF EXISTS `cpu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cpu` (
  `Codice` char(5) NOT NULL,
  `Marca` char(50) DEFAULT NULL,
  `Nome_Serie` char(50) DEFAULT NULL,
  `Velocita'` char(50) DEFAULT NULL,
  `Cores` int(11) DEFAULT NULL,
  `Threads` int(11) DEFAULT NULL,
  `Socket` char(50) DEFAULT NULL,
  `Wattaggio` int(11) DEFAULT NULL,
  `Dissipatore incluso` tinyint(1) DEFAULT NULL,
  `Scheda grafica` char(50) DEFAULT NULL,
  `Prezzo` double NOT NULL,
  `Link` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cpu`
--

LOCK TABLES `cpu` WRITE;
/*!40000 ALTER TABLE `cpu` DISABLE KEYS */;
INSERT INTO `cpu` VALUES ('A001','AMD','Ryzen 5 5600G','3.9, 4.4 GHz',6,12,'AM4',65,1,'NO',223.59,'https://amzn.to/3ptsxkh'),('A002','AMD','Ryzen 7 5800X','3.8, 4.7 GHz',8,16,'AM4',105,0,'NO',339,'https://amzn.to/3IDb0gM'),('A003','AMD','Ryzen 9 5950X','4.9 GHz',16,32,'AM4',105,0,'NO',680.5,'https://amzn.to/35JdgEV'),('A004','AMD','Ryzen 9 5900X','3.7, 4.8 GHz',12,24,'AM4',105,0,'NO',509.99,'https://amzn.to/36TRNtr'),('A005','INTEL','i9 12900k','3.2, 5.2 GHz',16,24,'LGA1700',125,0,'UHD Intel 770',595,'https://amzn.to/35f2wyg'),('A006','INTEL','i9 11900k','3.5, 5.1 GHz',8,16,'LGA1200',125,0,'UHD Intel 750',488,'https://amzn.to/3teuT7m'),('A007','INTEL','i7 9700k','3.6, 4.9 GHz',8,8,'LGA1151',95,0,'UHD Intel 630',341.8,'https://amzn.to/3hvMqTg'),('A008','INTEL','i5 11400','2.6, 4.4 GHz',6,12,'LGA1200',65,0,'UHD Intel 730',182,'https://amzn.to/3MaoWBn'),('A009','INTEL','i3 10100f','3.6, 4.3 GHz',4,8,'LGA1200',65,0,'NO',78.89,'https://amzn.to/3sxTvZO');
/*!40000 ALTER TABLE `cpu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hard_disk`
--

DROP TABLE IF EXISTS `hard_disk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hard_disk` (
  `Codice` char(5) NOT NULL,
  `Marca` char(50) DEFAULT NULL,
  `Nome_Serie` char(50) DEFAULT NULL,
  `Velocita' (giri/min)` int(11) DEFAULT NULL,
  `Dimensioni` char(10) DEFAULT NULL,
  `Wattaggio` int(11) DEFAULT NULL,
  `Prezzo` double NOT NULL,
  `Link` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hard_disk`
--

LOCK TABLES `hard_disk` WRITE;
/*!40000 ALTER TABLE `hard_disk` DISABLE KEYS */;
INSERT INTO `hard_disk` VALUES ('I001','SEAGATE','Seagate BarraCuda',7200,'1 TB',20,41.89,'https://amzn.to/3479uoc'),('I002','SEAGATE','SEAGATE ST2000DM008 BARRACUDA',7200,'2 TB',20,49.8,'https://amzn.to/3sBJPgV');
/*!40000 ALTER TABLE `hard_disk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monitor`
--

DROP TABLE IF EXISTS `monitor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `monitor` (
  `Codice` char(5) NOT NULL,
  `Marca` char(50) DEFAULT NULL,
  `Nome_Serie` char(50) DEFAULT NULL,
  `Frequenza (Hz)` int(11) DEFAULT NULL,
  `Dimensioni (pollici)` double DEFAULT NULL,
  `Tipologia` char(10) DEFAULT NULL,
  `Risoluzione` char(20) DEFAULT NULL,
  `Tempo risposta (ms)` int(11) DEFAULT NULL,
  `Prezzo` double NOT NULL,
  `Link` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monitor`
--

LOCK TABLES `monitor` WRITE;
/*!40000 ALTER TABLE `monitor` DISABLE KEYS */;
INSERT INTO `monitor` VALUES ('H001','PREDATOR','Predator X25 Monitor Gaming',360,24.5,'16 9','1920x1080',1,649,'https://amzn.to/3tmDYep'),('H002','HUAWEI','HUAWEI MateView GT',165,34,'21 9','3440x1440',4,499,'https://amzn.to/3ItRIul'),('H003','MSI','MSI Optix MAG342CQR',144,34,'21 9','3440x1440',1,580.68,'https://amzn.to/3hsAnWK'),('H004','HP','Monitor HP V22e',60,22,'16 9','1920x1080',5,118.99,'https://amzn.to/3Md4YFW'),('H005','AOC','AOC Gaming U28G2AE',60,28,'16 9','1920x1080',1,220.44,'https://amzn.to/3C4SdIN'),('H006','SAMSUNG','Samsung Monitor Gaming Odyssey G3 (F24G33)',144,24,'16 9','1920x1080',1,199.9,'https://amzn.to/3sxXVQt');
/*!40000 ALTER TABLE `monitor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `motherboard`
--

DROP TABLE IF EXISTS `motherboard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `motherboard` (
  `Codice` char(5) NOT NULL,
  `Marca` char(50) DEFAULT NULL,
  `Nome_Serie` char(50) DEFAULT NULL,
  `Tipologia` char(50) DEFAULT NULL,
  `RAM` char(5) DEFAULT NULL,
  `Socket_CPU` char(20) DEFAULT NULL,
  `NVME` tinyint(1) DEFAULT NULL,
  `Wattaggio` int(11) DEFAULT NULL,
  `Prezzo` double NOT NULL,
  `Link` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `motherboard`
--

LOCK TABLES `motherboard` WRITE;
/*!40000 ALTER TABLE `motherboard` DISABLE KEYS */;
INSERT INTO `motherboard` VALUES ('C001','ASUS','ASUS ROG STRIX B560-G GAMING WIFI','MICRO ATX','DDR4','LGA1200',1,60,188.99,'https://amzn.to/3K8Xy4C'),('C002','ASUS','Asus PRIME H510M-E','MICRO ATX','DDR4','LGA1200',1,60,86.99,'https://amzn.to/3KbTot1'),('C003','MSI','MSI H310M PRO-VDH PLUS','MICRO ATX','DDR4','LGA1151',1,60,101.2,'https://amzn.to/3vtCRMG'),('C004','ASUS','ASUS Prime Z390-A','ATX','DDR4','LGA1151',0,70,182.22,'https://amzn.to/35FKLHW'),('C005','MSI','MSI Z490-A PRO','ATX','DDR4','LGA1200',0,70,113.99,'https://amzn.to/3MgnHQO'),('C006','MSI','MSI PRO Z690-A WIFI','ATX','DDR5','LGA1700',1,70,237.92,'https://amzn.to/3puqfkO'),('C007','GIGABYTE','GIGABYTE Scheda Madre Z690 UD','ATX','DDR5','LGA1700',0,70,184.65,'https://amzn.to/3HsCoNn'),('C008','ASUS','ASUS ROG STRIX B550-A GAMING','ATX','DDR4','AM4',0,70,167.5,'https://amzn.to/3psSU9T'),('C009','ASUS','ASUS ProArt B550-CREATOR','ATX','DDR4','AM4',1,70,263.98,'https://amzn.to/3sus1nU'),('C010','MSI','MSI MAG B550 TOMAHAWK','ATX','DDR4','AM4',1,70,150,'https://amzn.to/3IPEIzz'),('C011','ASUS','Asus TUF GAMING B550M-E','MICRO ATX','DDR4','AM4',1,60,135.99,'https://amzn.to/3ItW8Br');
/*!40000 ALTER TABLE `motherboard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pc_case`
--

DROP TABLE IF EXISTS `pc_case`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pc_case` (
  `Codice` char(5) NOT NULL,
  `Marca` char(50) DEFAULT NULL,
  `Nome_Serie` char(50) DEFAULT NULL,
  `Dimensioni` char(50) DEFAULT NULL,
  `Vetro temperato` tinyint(1) DEFAULT NULL,
  `Prezzo` double NOT NULL,
  `Link` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pc_case`
--

LOCK TABLES `pc_case` WRITE;
/*!40000 ALTER TABLE `pc_case` DISABLE KEYS */;
INSERT INTO `pc_case` VALUES ('G001','COOLER MASTER','Cooler Master MasterBox Q300L','MICRO ATX',0,54.98,'https://amzn.to/3HsMP3m'),('G002','KOLINK','Kolink Citadel Mesh Case','MICRO ATX',1,70.59,'https://amzn.to/3svQOYL'),('G003','EMPIRE GAMING','ONYX Case PC Gamer ARGB','MICRO ATX',1,84.99,'https://amzn.to/3C6rT1d'),('G004','ANIDEES','anidees AI Crystal M','ATX',1,139.9,'https://amzn.to/3K8QN2K'),('G005','CORSAIR','Corsair 4000D Airflow Case','ATX',1,97.9,'https://amzn.to/3pvN87w');
/*!40000 ALTER TABLE `pc_case` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `power_supply`
--

DROP TABLE IF EXISTS `power_supply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `power_supply` (
  `Codice` char(5) NOT NULL,
  `Marca` char(50) DEFAULT NULL,
  `Nome_Serie` char(50) DEFAULT NULL,
  `Potenza` int(11) DEFAULT NULL,
  `Tipologia` char(20) DEFAULT NULL,
  `DImensioni` char(20) DEFAULT NULL,
  `Prezzo` double NOT NULL,
  `Link` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `power_supply`
--

LOCK TABLES `power_supply` WRITE;
/*!40000 ALTER TABLE `power_supply` DISABLE KEYS */;
INSERT INTO `power_supply` VALUES ('F001','COOLER MASTER','Cooler Master V850 SFX Gold',850,'Modulare','MICRO ATX',144.99,'https://amzn.to/3hwHmxP'),('F002','COOLER MASTER','Cooler Master V650 SFX Gold',650,'Modulare','MICRO ATX',110.99,'https://amzn.to/3huTNuk'),('F003','COOLER MASTER','Cooler Master V550 SFX Gold',550,'Modulare','MICRO ATX',104.39,'https://amzn.to/3K534FB'),('F004','COOLER MASTER','Cooler Master Alimentatore V850 Gold V2',850,'Modulare','ATX',117.99,'https://amzn.to/36YgdSJ'),('F005','COOLER MASTER','Cooler Master Alimentatore V650 Gold V2',650,'Modulare','ATX',98.99,'https://amzn.to/3vr6luN'),('F006','COOLER MASTER','Cooler Master Alimentatore V550 Gold V2',550,'Modulare','ATX',79.99,'https://amzn.to/35L5wCo'),('F007','EVGA','EVGA 750 BQ',750,'Semi modulare','ATX',71.7,'https://amzn.to/3vu1yZu'),('F008','EVGA','EVGA 650 BQ',650,'Semi modulare','ATX',68.99,'https://amzn.to/3hsBs0D');
/*!40000 ALTER TABLE `power_supply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ram`
--

DROP TABLE IF EXISTS `ram`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ram` (
  `Codice` char(5) NOT NULL,
  `Marca` char(50) DEFAULT NULL,
  `Nome_Serie` char(50) DEFAULT NULL,
  `Tipologia` char(5) DEFAULT NULL,
  `Memoria` char(20) DEFAULT NULL,
  `Velocita` int(11) DEFAULT NULL,
  `Wattaggio` int(11) DEFAULT NULL,
  `Prezzo` double NOT NULL,
  `Link` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ram`
--

LOCK TABLES `ram` WRITE;
/*!40000 ALTER TABLE `ram` DISABLE KEYS */;
INSERT INTO `ram` VALUES ('D001','KINGSTON','Kingston FURY Beast','DDR5','2x16 GB',5600,29,367.69,'https://amzn.to/36Ymqhv'),('D002','KINGSTON','Kingston FURY Beast','DDR5','2x8 GB',5600,20,235.99,'https://amzn.to/3MhYAgz'),('D003','KINGSTON','Kingston FURY Beast','DDR5','2x16 GB',6000,27,391.18,'https://amzn.to/3vucBBW'),('D004','KINGSTON','Kingston FURY Beast','DDR5','2x8 GB',6000,18,266.99,'https://amzn.to/3tjMFWY'),('D005','KINGSTON','Kingston FURY Beast','DDR5','2x16 GB',5200,25,320.54,'https://amzn.to/3tlBGMJ'),('D006','KINGSTON','Kingston FURY Beast','DDR5','2x8 GB',5200,16,221.99,'https://amzn.to/3Iznztv'),('D007','CORSAIR','Corsair VENGEANCELPX16GB','DDR4','2x8 GB',3600,14,76.47,'https://amzn.to/3swQZTw'),('D008','CORSAIR','Corsair Vengeance CMK32GX4M2B3200C16','DDR4','2x16 GB',3200,29,218.66,'https://amzn.to/3HxpDBa'),('D009','CORSAIR','CORSAIR VENGEANCE RGB PRO SL 32 GB','DDR4','2x16 GB',3200,29,166.66,'https://amzn.to/3MaVYBc'),('D010','CORSAIR','Crucial Ballistix BL2K8G26C16U4B 2666 MHz','DDR4','2x8 GB',2666,14,106.82,'https://amzn.to/3hyjRVj');
/*!40000 ALTER TABLE `ram` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ssd`
--

DROP TABLE IF EXISTS `ssd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ssd` (
  `Codice` char(5) NOT NULL,
  `Marca` char(50) DEFAULT NULL,
  `Nome_Serie` char(50) DEFAULT NULL,
  `Velocita' (MB/s)` int(11) DEFAULT NULL,
  `Dimensioni` char(10) DEFAULT NULL,
  `NVME` tinyint(1) DEFAULT NULL,
  `Wattaggio` int(11) DEFAULT NULL,
  `Prezzo` double NOT NULL,
  `Link` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ssd`
--

LOCK TABLES `ssd` WRITE;
/*!40000 ALTER TABLE `ssd` DISABLE KEYS */;
INSERT INTO `ssd` VALUES ('L001','CRUCIAL','Crucial P2 CT500P2SSD8 SSD Interno',2400,'500 GB',1,10,55.45,'https://amzn.to/3sB7Y7d'),('L002','SAMSUNG','Samsung Memorie MZ-V7S1T0 970 EVO Plus',3500,'1 TB',1,10,120,'https://amzn.to/371JSKN'),('L003','CRUCIAL','Crucial MX500 500GB CT500MX500SSD1',560,'500 GB',0,10,53.5,'https://amzn.to/3vxqBuJ'),('L004','SAMSUNG','Samsung SSD 870 EVO, 1 TB',560,'1 TB',0,10,110.6,'https://amzn.to/35Ghqx9');
/*!40000 ALTER TABLE `ssd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo_utente` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$mqOEpq8dUp4npI0TPM7SuO4XaNeshW13RPiUyUYQM/tU2qtqkDj42','gamer'),(2,'mario','$2y$10$Qyw/YK3owjkMNTvF9jqWmuLThJnwnDvTxDC11FMfY8I5pgO.PtZme','studente'),(3,'giovanni','$2y$10$F9L.EdbtQYAOPZe/eqqCUOsiKAe6cY6o6V/Rxv6jIaIRUYWjstfzq','lavoratore');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_card`
--

DROP TABLE IF EXISTS `video_card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video_card` (
  `Codice` char(5) NOT NULL,
  `Marca` char(50) DEFAULT NULL,
  `Nome_Serie` char(50) DEFAULT NULL,
  `Tipologia` char(20) DEFAULT NULL,
  `Memoria` char(6) DEFAULT NULL,
  `Wattaggio` int(11) DEFAULT NULL,
  `Prezzo` double NOT NULL,
  `Link` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_card`
--

LOCK TABLES `video_card` WRITE;
/*!40000 ALTER TABLE `video_card` DISABLE KEYS */;
INSERT INTO `video_card` VALUES ('E001','EVGA','EVGA GeForce RTX 3070 Ti FTW3 ULTRA GAMING','RTX 3070 ti','8 GB',290,1099.99,'https://amzn.to/35eBc3b'),('E002','MSI','NVIDIA GEFORCE GTX 1650 4GT LP OC','GTX 1650','4 GB',75,309.99,'https://amzn.to/3sujMbs'),('E003','ASUS','ASUS TUF Gaming NVIDIA Super OC Edition','GTX 1660 Super','6 GB',125,479,'https://amzn.to/3HzdU4T'),('E004','ZOTAC','Zotac VGA RTX3060 Twin Edge OC 12G','RTX 3060','12 GB',170,733.9,'https://amzn.to/35HZ52D');
/*!40000 ALTER TABLE `video_card` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-10 18:30:49
