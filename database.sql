-- Progettazione Web 
DROP DATABASE if exists granucci_654379; 
CREATE DATABASE granucci_654379; 
USE granucci_654379; 
-- MySQL dump 10.13  Distrib 5.6.20, for Win32 (x86)
--
-- Host: localhost    Database: granucci_654379
-- ------------------------------------------------------
-- Server version	5.6.20

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
-- Table structure for table `partita`
--

DROP TABLE IF EXISTS `partita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partita` (
  `Difficolta` tinyint(4) NOT NULL,
  `Tempo` int(11) NOT NULL,
  `Vittoria` tinyint(1) NOT NULL,
  `IndiziUsati` int(11) NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(128) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partita`
--

LOCK TABLES `partita` WRITE;
/*!40000 ALTER TABLE `partita` DISABLE KEYS */;
INSERT INTO `partita` VALUES (0,1,0,0,2,'pollo'),(0,1,0,0,3,'pollo'),(0,27,1,0,4,'pollo'),(0,38,1,3,5,'pollo'),(0,13,0,0,6,'LucaGranucci'),(0,2,0,0,7,'LucaGranucci'),(0,14,0,3,8,'LucaGranucci'),(0,21,0,0,9,'LucaGranucci'),(0,2,0,0,10,'LucaGranucci'),(0,37,1,0,11,'LucaGranucci'),(1,0,0,0,12,'LucaGranucci'),(1,76,1,2,13,'LucaGranucci'),(2,8,0,0,14,'LucaGranucci'),(2,22,0,0,15,'LucaGranucci'),(2,18,0,0,16,'LucaGranucci'),(2,44,0,0,17,'LucaGranucci'),(2,23,0,0,18,'LucaGranucci'),(2,31,0,0,19,'LucaGranucci'),(2,129,1,0,20,'LucaGranucci'),(1,24,0,0,21,'LucaGranucci'),(1,1,0,0,22,'LucaGranucci'),(1,10,0,0,23,'LucaGranucci'),(1,13,0,0,24,'LucaGranucci'),(1,2,0,0,25,'LucaGranucci'),(0,141,1,0,26,'LucaGranucci'),(0,6,0,0,27,'LucaGranucci'),(1,51,1,0,28,'LucaGranucci'),(1,51,1,0,29,'LucaGranucci'),(0,1,0,0,30,'Icrow'),(0,1,0,0,31,'Icrow'),(0,25,1,0,32,'Icrow'),(1,43,0,0,33,'FluxZeero'),(-1,2,0,0,34,'pollo'),(-1,13,0,4,35,'pollo'),(0,24,1,0,36,'pollo'),(1,1,0,0,37,'pollo'),(0,0,0,0,38,'pollo'),(0,3,0,0,39,'Lgranucci'),(1,1,0,0,40,'Lgranucci'),(1,6,0,0,41,'Lgranucci'),(1,12,0,0,42,'Lgranucci'),(1,31,0,0,43,'Lgranucci'),(1,56,1,2,44,'Lgranucci'),(1,1,0,0,45,'Lgranucci'),(1,0,0,0,46,'Lgranucci'),(1,1,0,0,47,'Lgranucci'),(1,45,1,0,48,'Marco');
/*!40000 ALTER TABLE `partita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utente`
--

DROP TABLE IF EXISTS `utente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utente` (
  `Username` varchar(128) NOT NULL,
  `Password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utente`
--

LOCK TABLES `utente` WRITE;
/*!40000 ALTER TABLE `utente` DISABLE KEYS */;
INSERT INTO `utente` VALUES ('pollo','$2y$10$KrTP4h5WLLDZnxZ22QswBu569t01xNpDq0q1/pQWQxVZiOWnVgMOe'),('LucaGranucci','$2y$10$ONYVm1VKUkRbXXyWhDmuCucrT3KIRhLz3RTQY3KRxmyT3U7qpFK0S'),('Icrow','$2y$10$qDa90MkWS.YTqmDloPnPDesfKU1i9hHxXI56n0U82g5Z9CdiPzQSy'),('FluxZeero','$2y$10$TmXWbXXlGjtiHu6qhf6yoO085WF2NVrgA6twonlQ9pbTEwbWz8/j.'),('Lgranucci','$2y$10$rcZU9A7dyXLeBYIjwhVBjOzKnhmMRfI9.Ds1BkIrikYSH4Lj6bzqK'),('Marco','$2y$10$tGrp19b2aZIYVTqRd/9fKOB2nYokSyM8T6XaDNqEsOMY63hokyhTa');
/*!40000 ALTER TABLE `utente` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-31 15:19:46
