-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: brackets
-- ------------------------------------------------------
-- Server version	11.3.2-MariaDB-1:11.3.2+maria~ubu2204

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `expressionsHistory`
--

DROP TABLE IF EXISTS `expressionsHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expressionsHistory` (
  `expressionID` int(11) NOT NULL AUTO_INCREMENT,
  `expression` varchar(255) NOT NULL DEFAULT '',
  `result` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`expressionID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expressionsHistory`
--

LOCK TABLES `expressionsHistory` WRITE;
/*!40000 ALTER TABLE `expressionsHistory` DISABLE KEYS */;
INSERT INTO `expressionsHistory` VALUES (1,'(\"(привет+пока)\")',1),(2,'(\"< ( { [ 42 ] } ) >\")',1),(3,'(\"< ( { [ 42 ] } ) >\")',1),(5,'(\"( 2 * 45 [ 11 ) - 7]\")',0),(6,'(\"(привет+пока)\")',1),(7,'(\"(привет+пока)\")',1),(8,'()',1),(9,'()',1),(10,'())',0),(11,'(',1),(12,'()',1),(13,'(',1),(14,'{{',1),(15,'}}',0),(16,'{',1),(17,'{',1),(18,'{}',1),(19,'{{',1),(20,'{{)',0),(21,'(',1),(22,'((',1),(23,'((',0),(24,'{{',0),(25,'((',0),(26,'}}',1),(27,'< ( { [ 42 ] } ) > ',1),(28,'( 2 * 44 [ 11 ] ) ',1),(29,'< a * ( 4 / 7 - [ 2 - 2] / { 11 } ) >',1),(30,'(привет+пока) ',1),(31,'( 2 * 45 [ 11 ) - 7]',0),(32,'( 2 { 3 / [ ? } 1 ] )',0),(33,'> < > < ',1),(34,'> < > <',1),(35,'> < > <',0),(36,'> < > <',0),(37,'( 2 * 45 [ 11 ) - 7]',0),(38,'( 2 { 3 / [ ? } 1 ] )',0),(39,'> < > < ',0),(40,'< ( { [ 42 ] } ) > ',1),(41,'( 2 * 44 [ 11 ] ) ',1),(42,'< a * ( 4 / 7 - [ 2 - 2] / { 11 } ) >',1),(43,'(привет+пока) ',1),(44,'  (привет+пока) ',1),(45,'  (привет   +пока) ',1),(46,'  (привет   +    пока) ',1),(47,'((',0),(48,'))',0),(49,'123',1),(50,'()',1),(51,'(',0),(52,'1',1),(53,'123',1),(54,'455456',1),(55,'455456)',0),(56,'test',1),(57,'test',1),(58,'test2',1),(59,'(',0),(60,'test1',1),(61,'test1',1);
/*!40000 ALTER TABLE `expressionsHistory` ENABLE KEYS */;
UNLOCK TABLES;
