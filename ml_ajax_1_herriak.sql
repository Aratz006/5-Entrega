-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: ml_ajax_1
-- ------------------------------------------------------
-- Server version	8.0.39

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `herriak`
--

DROP TABLE IF EXISTS `herriak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `herriak` (
  `idherriak` int NOT NULL AUTO_INCREMENT,
  `herria` varchar(20) NOT NULL,
  `eskualdea` varchar(20) NOT NULL,
  PRIMARY KEY (`idherriak`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `herriak`
--

LOCK TABLES `herriak` WRITE;
/*!40000 ALTER TABLE `herriak` DISABLE KEYS */;
INSERT INTO `herriak` VALUES (1,'Legorreta','Goierri'),(2,'Ordizia','Goierri'),(3,'Beasain','Goierri'),(4,'Lazkao','Goierri'),(5,'Zumarraga','Urola'),(6,'Urretxu','Urola'),(7,'Legazpi','Urola'),(8,'Ezkio','Urola'),(9,'Donosti','Donostialdea'),(10,'Lezo','Donostialdea'),(11,'Pasaia','Donostialdea'),(12,'Errenteria','Donostialdea'),(13,'Andoain','Buruntzaldea'),(14,'Hernani','Buruntzaldea'),(15,'Lasarte','Buruntzaldea'),(16,'Urnieta','Buruntzaldea');
/*!40000 ALTER TABLE `herriak` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-25 20:12:41
