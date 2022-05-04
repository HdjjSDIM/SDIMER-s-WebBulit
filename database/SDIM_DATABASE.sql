-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: sdim
-- ------------------------------------------------------
-- Server version	8.0.28

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
-- Table structure for table `artical`
--

DROP TABLE IF EXISTS `artical`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `artical` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `artical_classification` varchar(225) NOT NULL,
  `artical_label` varchar(225) NOT NULL,
  `artical_title` varchar(225) NOT NULL,
  `artical_abstract` varchar(255) NOT NULL,
  `artical_cover` varchar(255) NOT NULL,
  `artical_pdf` varchar(255) NOT NULL,
  `artical_isanonymous` int NOT NULL,
  `like_number` int NOT NULL,
  `collection_number` int NOT NULL,
  `writer_id` int NOT NULL,
  `upload_time` varchar(255) NOT NULL,
  `comment` varchar(225) NOT NULL,
  `article_status` int DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artical`
--

LOCK TABLES `artical` WRITE;
/*!40000 ALTER TABLE `artical` DISABLE KEYS */;
INSERT INTO `artical` VALUES (23,'1','1a4a5a6a7a8a9a10a11a12a','啊实打实大苏打的','阿三大苏打大苏打实打实打算萨达萨达飒飒','QQ图片20220409234042.png','sdm283-project-2.pdf',1,0,0,7,'2022-04-30','',0),(24,'2','1a','ImissU_test','A','Null','Null',1,1,1,1,'2022-04-30','1',1),(25,'2','4a','Good DAY_test','B','Null','Null',1,9,1,1,'2022-04-30','1',2);
/*!40000 ALTER TABLE `artical` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `artical_classification`
--

DROP TABLE IF EXISTS `artical_classification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `artical_classification` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `classification_name` varchar(255) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artical_classification`
--

LOCK TABLES `artical_classification` WRITE;
/*!40000 ALTER TABLE `artical_classification` DISABLE KEYS */;
INSERT INTO `artical_classification` VALUES (1,'生活'),(2,'项目交流'),(3,'升学经验'),(4,'测试的一级标签');
/*!40000 ALTER TABLE `artical_classification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `artical_label`
--

DROP TABLE IF EXISTS `artical_label`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `artical_label` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `label_name` varchar(225) NOT NULL,
  `label_father_uid` varchar(225) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artical_label`
--

LOCK TABLES `artical_label` WRITE;
/*!40000 ALTER TABLE `artical_label` DISABLE KEYS */;
INSERT INTO `artical_label` VALUES (1,'游戏','1'),(2,'美学与设计心理学','2'),(3,'出国','3'),(4,'摄影','1'),(5,'购物','1'),(6,'玩耍','1'),(7,'外出','1'),(8,'返校','1'),(9,'食物','1'),(10,'唱歌','1'),(11,'跳舞','1'),(12,'RAP','1'),(13,'吃饭吃饭了','4');
/*!40000 ALTER TABLE `artical_label` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `artical_id` int NOT NULL,
  `content` varchar(255) NOT NULL,
  `comment_time` varchar(255) NOT NULL,
  `comment_writerid` int NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (31,22,'nimanima','2022-05-01',7);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,'0000-00-00',''),(2,'0000-00-00',''),(3,'0000-00-00',''),(4,'0000-00-00',''),(5,'0000-00-00',''),(6,'0000-00-00',''),(7,'0000-00-00',''),(8,'0000-00-00',''),(9,'0000-00-00',''),(10,'0000-00-00','');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `passedarticle`
--

DROP TABLE IF EXISTS `passedarticle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `passedarticle` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `artical_classification` varchar(225) NOT NULL,
  `artical_label` varchar(225) NOT NULL,
  `artical_title` varchar(225) NOT NULL,
  `artical_abstract` varchar(255) NOT NULL,
  `artical_cover` varchar(255) NOT NULL,
  `artical_pdf` varchar(255) NOT NULL,
  `artical_isanonymous` int NOT NULL,
  `like_number` int NOT NULL,
  `collection_number` int NOT NULL,
  `writer_id` int NOT NULL,
  `upload_time` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passedarticle`
--

LOCK TABLES `passedarticle` WRITE;
/*!40000 ALTER TABLE `passedarticle` DISABLE KEYS */;
INSERT INTO `passedarticle` VALUES (20,'4','13a','吃饭吃饭了','吃饭吃饭了','thumb-1920-735943.png','工业设计史_读书笔记_何典峻part.pdf',1,0,0,7,'2022-04-30',''),(22,'1','1a','测试测试','123','thumb-1920-735943.png','sdm283-project-2.pdf',1,7,0,7,'2022-04-30','');
/*!40000 ALTER TABLE `passedarticle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `passedmessages`
--

DROP TABLE IF EXISTS `passedmessages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `passedmessages` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `artical_classification` varchar(225) NOT NULL,
  `artical_label` varchar(255) NOT NULL,
  `artical_title` varchar(225) NOT NULL,
  `artical_abstract` varchar(255) NOT NULL,
  `artical_cover` varchar(255) NOT NULL,
  `artical_pdf` varchar(255) NOT NULL,
  `artical_isanonymous` varchar(255) NOT NULL,
  `like_number` int NOT NULL,
  `collection_number` int NOT NULL,
  `writer_id` int NOT NULL,
  `upload_time` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=20220410 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passedmessages`
--

LOCK TABLES `passedmessages` WRITE;
/*!40000 ALTER TABLE `passedmessages` DISABLE KEYS */;
/*!40000 ALTER TABLE `passedmessages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unpassedarticle`
--

DROP TABLE IF EXISTS `unpassedarticle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unpassedarticle` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `artical_classification` varchar(225) NOT NULL,
  `artical_label` varchar(225) NOT NULL,
  `artical_title` varchar(225) NOT NULL,
  `artical_abstract` varchar(255) NOT NULL,
  `artical_cover` varchar(255) NOT NULL,
  `artical_pdf` varchar(255) NOT NULL,
  `artical_isanonymous` int NOT NULL,
  `like_number` int NOT NULL,
  `collection_number` int NOT NULL,
  `writer_id` int NOT NULL,
  `upload_time` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unpassedarticle`
--

LOCK TABLES `unpassedarticle` WRITE;
/*!40000 ALTER TABLE `unpassedarticle` DISABLE KEYS */;
INSERT INTO `unpassedarticle` VALUES (13,'1','1a4a5a','测试4.22','测试','1.jpg','test.pdf',1,0,0,0,'2022-04-22','qaq'),(14,'1','1a4a5a6a7a8a9a10a11a12a','综合2','综合综合','1.jpg','angluo-php-149814.pdf',1,1,0,0,'2022-04-22','qaq');
/*!40000 ALTER TABLE `unpassedarticle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `permission` int NOT NULL,
  `nickName` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `telephoneNum` int NOT NULL,
  `hobby` varchar(255) DEFAULT NULL,
  `likedArtical` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'jason1','jason1',0,'','',0,'basketball','','defrgh','87654356478'),(2,'jason2','',0,'','',0,'PingPong','','defgf','45657'),(3,'123','123',0,'','',0,'123','','1111111111@','4546'),(4,'jason4','',0,'','',0,'','','dfdfgs','453647'),(5,'jason5','55555555',0,'','',0,'','','dsf','3456457'),(6,'jason6','66666666',0,'','',0,'','','ddfd','34564'),(7,'jason7','77777777',1,'','',0,'','22',NULL,'34546'),(8,'jason9','999999999',0,'','',0,'','','efd','23456'),(9,'jsn','123456789',0,'','',0,'','','wdef','1213245'),(10,'jason10','10101010',0,'','',0,'','ef','def','2345'),(11,'jason11','11111111',0,'','',0,'','','efrg','3456'),(12,'12010207','12010207',1,'12010207','',0,'','','efd','3345');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-04 11:42:25
