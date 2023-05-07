-- MySQL dump 10.13  Distrib 8.0.22, for Linux (x86_64)
--
-- Host: localhost    Database: motel
-- ------------------------------------------------------
-- Server version	8.0.25-0ubuntu0.20.04.1

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
-- Table structure for table `bills`
--

DROP TABLE IF EXISTS `bills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bills` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `room_id` int NOT NULL,
  `status` tinyint NOT NULL,
  `customer_id` int NOT NULL,
  `deposited` int DEFAULT NULL,
  `month` date NOT NULL,
  `total_price` int NOT NULL,
  `payment_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bills`
--

LOCK TABLES `bills` WRITE;
/*!40000 ALTER TABLE `bills` DISABLE KEYS */;
INSERT INTO `bills` VALUES (18,4,0,3,NULL,'2021-02-10',3402000,NULL,'2021-05-13 03:50:44','2021-05-13 03:50:44','2021-02-10','2021-02-28'),(19,4,0,3,NULL,'2021-03-01',4785000,NULL,'2021-05-13 03:51:19','2021-05-13 03:51:19','2021-03-01','2021-03-31'),(20,4,0,3,NULL,'2021-04-01',4820000,NULL,'2021-05-13 03:52:13','2021-05-13 03:52:13','2021-04-01','2021-04-30'),(22,4,0,3,NULL,'2021-02-04',4280000,NULL,'2021-05-13 03:56:37','2021-05-13 03:56:37','2021-02-04','2021-02-28'),(23,3,0,1,NULL,'2021-02-04',1825000,NULL,'2021-05-13 03:58:35','2021-05-13 03:58:35','2021-02-04','2021-02-28'),(24,3,0,1,NULL,'2021-03-01',3410000,NULL,'2021-05-13 04:00:24','2021-05-13 04:00:24','2021-03-01','2021-03-31'),(25,3,0,1,NULL,'2021-04-01',3270000,NULL,'2021-05-13 04:00:58','2021-05-13 04:00:58','2021-04-01','2021-04-30');
/*!40000 ALTER TABLE `bills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contract_services`
--

DROP TABLE IF EXISTS `contract_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contract_services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `contract_id` int NOT NULL,
  `service_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contract_services`
--

LOCK TABLES `contract_services` WRITE;
/*!40000 ALTER TABLE `contract_services` DISABLE KEYS */;
INSERT INTO `contract_services` VALUES (140,42,1,NULL,NULL),(141,42,2,NULL,NULL),(142,42,3,NULL,NULL),(143,42,4,NULL,NULL),(144,43,1,NULL,NULL),(145,43,2,NULL,NULL),(146,43,3,NULL,NULL),(147,43,4,NULL,NULL),(148,44,1,NULL,NULL),(149,44,2,NULL,NULL),(150,44,3,NULL,NULL),(151,44,4,NULL,NULL),(152,45,1,NULL,NULL),(153,45,2,NULL,NULL),(154,45,3,NULL,NULL),(155,45,4,NULL,NULL),(156,46,1,NULL,NULL),(157,46,2,NULL,NULL),(158,46,3,NULL,NULL),(159,46,4,NULL,NULL),(160,47,1,NULL,NULL),(161,47,2,NULL,NULL),(162,47,3,NULL,NULL),(163,47,4,NULL,NULL),(164,48,1,NULL,NULL),(165,48,2,NULL,NULL),(166,48,3,NULL,NULL),(167,48,4,NULL,NULL),(168,49,1,NULL,NULL),(169,49,2,NULL,NULL),(170,49,3,NULL,NULL),(171,49,4,NULL,NULL),(172,50,1,NULL,NULL),(173,50,2,NULL,NULL),(174,50,3,NULL,NULL),(175,50,4,NULL,NULL);
/*!40000 ALTER TABLE `contract_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contracts`
--

DROP TABLE IF EXISTS `contracts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contracts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `room_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `deposited` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `return_deposit` tinyint DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '2' COMMENT '1: still, 0: expired, 2: pending, 3: find',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `return_room` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contracts`
--

LOCK TABLES `contracts` WRITE;
/*!40000 ALTER TABLE `contracts` DISABLE KEYS */;
INSERT INTO `contracts` VALUES (42,11,9,'500000',NULL,'2021-05-19','2023-12-13',NULL,2,'2021-05-13 02:52:24','2021-05-13 02:55:20',0),(43,2,9,'500000',NULL,'2021-04-25','2021-12-31',NULL,2,'2021-05-13 02:54:44','2021-05-13 03:26:13',0),(44,1,2,'500000',NULL,'2021-05-14','2021-12-24',NULL,1,'2021-05-13 02:56:57','2021-05-13 02:56:57',0),(45,3,1,'500000',NULL,'2021-02-04','2023-07-13',NULL,1,'2021-05-13 02:59:44','2021-05-13 02:59:44',0),(46,4,3,'500000',NULL,'2021-02-10','2021-12-13',NULL,1,'2021-05-13 03:01:22','2021-05-13 03:01:22',0),(47,5,4,'500000',NULL,'2021-05-21','2021-12-13',NULL,2,'2021-05-13 03:02:50','2021-05-13 03:02:50',0),(48,6,4,'500000',NULL,'2021-05-01','2021-12-23',NULL,1,'2021-05-13 03:03:47','2021-05-13 03:03:47',0),(49,7,5,'500000',NULL,'2021-04-26','2021-12-13',NULL,1,'2021-05-13 03:04:30','2021-05-13 03:04:30',0),(50,8,15,'50000',NULL,'2021-05-13','2021-12-13',NULL,1,'2021-05-13 03:22:34','2021-05-13 03:22:34',0);
/*!40000 ALTER TABLE `contracts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_rooms`
--

DROP TABLE IF EXISTS `customer_rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_rooms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `room_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_rooms`
--

LOCK TABLES `customer_rooms` WRITE;
/*!40000 ALTER TABLE `customer_rooms` DISABLE KEYS */;
INSERT INTO `customer_rooms` VALUES (13,9,11,NULL,NULL),(14,9,2,NULL,NULL),(15,2,1,NULL,NULL),(16,1,3,NULL,NULL),(17,3,4,NULL,NULL),(18,4,5,NULL,NULL),(19,4,6,NULL,NULL),(20,5,7,NULL,NULL),(21,15,8,NULL,NULL);
/*!40000 ALTER TABLE `customer_rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `id_card` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` tinyint NOT NULL COMMENT '0: female, 1 male',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'Zelma Romaguera MD','kieutuananh2121999@gmail.com','$2y$10$dJND/R5uLfGDzG24gg9QHOzVpcZJNB2sTYJELbXe3NFPl4fP5FT1e','2009-01-14','001800679895',1,'68089 Raleigh PrairieLake Everardoport, NY 29073-1768','House Cleaner','123456789','2021-05-01 19:25:13','2021-05-01 20:25:49'),(2,'Korbin Bayer DDS','hal34@yahoo.com','$2y$10$dJND/R5uLfGDzG24gg9QHOzVpcZJNB2sTYJELbXe3NFPl4fP5FT1e','2010-01-03','001800679895',1,'560 Virgie Ville Apt. 607\nNew Conor, WI 02099','Mechanical Door Repairer','573.977.4500','2021-05-01 19:25:13','2021-05-01 19:25:13'),(3,'Caleb Carroll PhD','rmcdermott@hotmail.com','$2y$10$XQgo4bgz6tiD2dvanYikF.HBDhZhhC4er6assmXFxr.scFIVDFw9a','2008-02-24','001800679895',1,'77756 Monique Keys\nWest Deven, WI 95719','Truck Driver','+1 (872) 384-3583','2021-05-01 19:25:13','2021-05-01 19:25:13'),(4,'Gracie Casper','wuckert.prince@yahoo.com','$2y$10$ATSpTgBK76M0CKM.wKMZW.gLSKlx3m0nYgWXXRW/LtruVPAIXpmmC','2011-05-04','001800679895',1,'41294 Feest Cliff Suite 766\nDellahaven, DC 31114','Naval Architects','(248) 319-1419','2021-05-01 19:25:13','2021-05-01 19:25:13'),(5,'Deontae Murazik','pasquale27@yahoo.com','$2y$10$uzdCrYcBn/mMyXm9fs5pFerhZZAoZ.pXRGsvCf9JXovimTO1h7HJy','2008-04-10','001800679895',1,'5796 Hettinger Turnpike Apt. 269\nWolfmouth, CO 49334','Personal Care Worker','870.233.1991','2021-05-01 19:25:13','2021-05-01 19:25:13'),(6,'Mr. Reese Johnston','thea88@kuhlman.com','$2y$10$/WnSUPA9LeKGy4IlPpeB.eTyK5kTY4m1RTmJcA5eu8SWZgDW2JYw.','2012-06-19','001800679895',0,'51784 Mozelle Place Apt. 038\nEast Maximestad, OK 27577-9892','Transportation Equipment Maintenance','385.947.0225','2021-05-01 19:25:13','2021-05-01 19:25:13'),(7,'Prof. Arvel Reichert','iernser@hotmail.com','$2y$10$9L4x8fXnEy8TbJ1nmvXI7OydF2k0KcmSdtKb6cj/IreQ4Da1PFLDy','2010-03-09','001800679895',1,'291 Champlin Inlet Apt. 993\nNew Flossiebury, IN 98241-9346','Truck Driver','984-308-0894','2021-05-01 19:25:13','2021-05-04 07:53:55'),(8,'Dr. Kailyn Rodriguez','alda.berge@leannon.org','$2y$10$ixWbRuN4O/vxErBUhx6oF.WvUqhX.xy8yYtKZCgqKG/N64MoGBQgq','2012-09-04','001800679895',1,'77411 Parker Ridge Apt. 150\nNorth Helga, NY 20093-6958','Aircraft Engine Specialist','+14807774387','2021-05-01 19:25:13','2021-05-01 19:25:13'),(9,'Kip Mosciski MD','eweimann@gmail.com','$2y$10$YsLKdnBJ981jN7M9CN10xe2RfHb6lthGuBh634rvX3XmyFjCvlkEy','2010-12-21','001800679895',1,'82595 Casimer Mountains Apt. 812\nGoodwinberg, NM 84420-2588','Training Manager OR Development Manager','+15202792999','2021-05-01 19:25:13','2021-05-01 19:25:13'),(10,'Larissa Lynch','ari.mante@beer.biz','$2y$10$mfDQ1nyoVdkmoMRoAhGtM.7hks9YxxdEdS8NajHMWdpH36SvkbFrC','2008-09-19','001800679895',0,'250 Braun Field\nParkermouth, MA 65777','Budget Analyst','231.943.7734','2021-05-01 19:25:13','2021-05-01 19:25:13'),(11,'Marjorie Halvorson','kim.reilly@hackett.com','$2y$10$vVXzMZegvcl37HveUGtvLubMu9BqKdhDxuIzdkKoR.rODgiWPfLM2','2008-04-11','001800679895',0,'63667 Ankunding Ramp Apt. 744\nDexterstad, OR 87076','Animal Husbandry Worker','(860) 867-9902','2021-05-01 19:25:13','2021-05-01 19:25:13'),(12,'Prof. Arden Mante IV','lratke@wintheiser.com','$2y$10$29W.NA6MG4P/z.URBmnTDegCSUkiGFpR8m1tKzJhWii4bucx2s4KC','2009-04-01','001800679895',1,'2321 Kertzmann Ports Suite 529\nPort Isailand, CT 79776','Railroad Conductors','1-630-210-1960','2021-05-01 19:25:13','2021-05-01 19:25:13'),(13,'Dr. Lupe Turcotte Sr.','yasmeen81@yahoo.com','$2y$10$rIaQlidYHexwsw7bWSBYH.NzMFZ3t3El.Izjc3h4ZZCpRjGSYfi2W','2010-02-16','001800679895',0,'12218 Kemmer Trace Apt. 282\nNew Daneburgh, NC 14846-5683','Locomotive Engineer','360-394-5542','2021-05-01 19:25:13','2021-05-01 19:25:13'),(14,'Matilda Toy Jr.','wuckert.heather@yahoo.com','$2y$10$GA7dnW2G3JF5OPYMIUWsCO15qSVDInF5tIHYQ1D5KCvlyaFaMOUBG','2008-02-13','001800679895',1,'1325 Lindgren Estates\nBentonfort, VT 15234','Automotive Mechanic','+1-951-934-5499','2021-05-01 19:25:13','2021-05-01 19:25:13'),(15,'Ashlee Jast IV','lindgren.alia@hotmail.com','$2y$10$dI..L7ZqyGYx9FSJ.9pHCuf20WvWe1EUo/ge1DAsUtGp2bZZJR8Ia','2012-12-03','001800679895',0,'283 Wilkinson Track\nEsmeraldashire, AR 08456-6324','Production Planning','+1-442-608-9609','2021-05-01 19:25:13','2021-05-01 19:25:13');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_bills`
--

DROP TABLE IF EXISTS `detail_bills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_bills` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `bill_id` int NOT NULL,
  `service_id` int NOT NULL,
  `unit_price` int NOT NULL,
  `usage` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_bills`
--

LOCK TABLES `detail_bills` WRITE;
/*!40000 ALTER TABLE `detail_bills` DISABLE KEYS */;
INSERT INTO `detail_bills` VALUES (84,18,1,3500,100,NULL,NULL),(85,18,2,8000,10,NULL,NULL),(86,18,3,150000,1,NULL,NULL),(87,18,4,30000,1,NULL,NULL),(88,19,1,3500,70,NULL,NULL),(89,19,2,8000,20,NULL,NULL),(90,19,3,150000,1,NULL,NULL),(91,19,4,30000,1,NULL,NULL),(92,20,1,3500,80,NULL,NULL),(93,20,2,8000,20,NULL,NULL),(94,20,3,150000,1,NULL,NULL),(95,20,4,30000,1,NULL,NULL),(100,22,1,3500,60,NULL,NULL),(101,22,2,8000,20,NULL,NULL),(102,22,3,150000,1,NULL,NULL),(103,22,4,30000,1,NULL,NULL),(104,23,1,3500,50,NULL,NULL),(105,23,2,8000,30,NULL,NULL),(106,23,3,150000,1,NULL,NULL),(107,23,4,30000,1,NULL,NULL),(108,24,1,3500,100,NULL,NULL),(109,24,2,8000,10,NULL,NULL),(110,24,3,150000,1,NULL,NULL),(111,24,4,30000,1,NULL,NULL),(112,25,1,3500,60,NULL,NULL),(113,25,2,8000,10,NULL,NULL),(114,25,3,150000,1,NULL,NULL),(115,25,4,30000,1,NULL,NULL);
/*!40000 ALTER TABLE `detail_bills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (2,'1619254643dA5VDQi3NJJ2qcWZ.jpeg','1',NULL,NULL),(3,'16192546438r4AaK1zNzGQKR0d.jpeg','1',NULL,NULL),(4,'1619254701W0YDFFstIxExnkOe.jpeg','2',NULL,NULL),(5,'1619254701UDntxgbx8oeOJEiu.jpeg','2',NULL,NULL),(6,'1619255077j40t5keUWdo6Dbr7.jpeg','3',NULL,NULL),(7,'1619255077zSrwqUSPVr6RlWxV.jpeg','3',NULL,NULL),(8,'1619255120gGqbIa8aTSzfzSXE.jpeg','4',NULL,NULL),(9,'1619255165kXtar08QyxJ9e4O5.jpeg','5',NULL,NULL),(10,'1619255208hsqH0eoE8QpX6DBM.jpg','6',NULL,NULL),(11,'1619255252EK6lMdiU1ocoFBYW.jpeg','7',NULL,NULL),(12,'1619255285URtOdueDw0rA2PRc.jpg','8',NULL,NULL),(13,'1619255347hfASI7Bo6ENSMtvP.jpeg','9',NULL,NULL),(14,'1619255398ExFqmqwk1dIaPqri.jpeg','10',NULL,NULL),(15,'16192554429dgP4v5HPrb03pBX.jpeg','11',NULL,NULL),(16,'1619255478O9h1KXwyQbAh5s2m.jpeg','12',NULL,NULL),(17,'1620894858HOqZgtETAN31g5zy.jpg','13',NULL,NULL),(18,'1620894883nXs4djKRzwCeDWnX.jpg','14',NULL,NULL),(19,'16208949124VSo0QT0ETqOb1G0.jpeg','15',NULL,NULL),(20,'1620894946eQ0bGLCW0idVb21I.jpeg','16',NULL,NULL),(21,'1620894972q2KRd4JEWymf93UY.jpeg','17',NULL,NULL),(22,'1620895000sc9nrYCM42FyLmAX.jpeg','18',NULL,NULL),(23,'1620895043ukxkm6WS8PgNTh6N.jpeg','19',NULL,NULL),(24,'1620895066uF6KAaIckWe07ETF.jpeg','20',NULL,NULL),(25,'1620895094TkjyIRgMoHfb0ftJ.jpg','21',NULL,NULL),(26,'1620895136csWDL2ERTvOVuYBd.jpg','22',NULL,NULL);
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2021_02_26_034208_create_rooms_table',1),(6,'2021_02_26_043239_create_contracts_table',1),(7,'2021_02_26_043519_create_services_table',1),(8,'2021_03_07_113256_create_bills_table',1),(9,'2021_04_13_140330_create_customer_rooms_table',1),(10,'2021_04_13_140349_create_contract_services_table',1),(11,'2021_04_13_144256_create_images_table',1),(12,'2021_04_19_161141_create_detail_bills_table',1),(13,'2021_02_26_034740_create_customers_table',2),(14,'2021_05_09_053458_add_column_is_transplant_rooms',3),(16,'2021_05_11_133215_add_column_return_room_table',4),(17,'2021_05_11_135921_add_column_date_bills_table',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rooms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0: not used, 1: used',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_transplant` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rooms`
--

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` VALUES (1,'A1',3200000,'26m2',NULL,1,'2021-04-24 01:57:23','2021-05-13 02:56:57',1),(2,'A2',3000000,'24m2',NULL,1,'2021-04-24 01:58:21','2021-05-13 02:54:44',0),(3,'A3',2800000,'25m2',NULL,1,'2021-04-24 02:04:37','2021-05-13 04:33:09',1),(4,'B1',4200000,'30m2',NULL,1,'2021-04-24 02:05:20','2021-05-13 03:01:22',0),(5,'B2',4500000,'34m2',NULL,1,'2021-04-24 02:06:05','2021-05-13 03:02:50',0),(6,'B3',4500000,'35m2',NULL,1,'2021-04-24 02:06:48','2021-05-13 03:03:47',1),(7,'B4',3800000,'30m2',NULL,1,'2021-04-24 02:07:32','2021-05-13 03:04:30',0),(8,'A4',3300000,'28m2',NULL,1,'2021-04-24 02:08:05','2021-05-13 03:22:34',0),(9,'A5',2700000,'2300000',NULL,0,'2021-04-24 02:09:07','2021-05-11 06:47:48',0),(10,'A6',4100000,'6x6m2',NULL,0,'2021-04-24 02:09:58','2021-05-05 08:31:19',0),(11,'A7',4600000,'36m2',NULL,1,'2021-04-24 02:10:42','2021-05-13 02:52:24',1),(12,'B5',4400000,'35m2',NULL,0,'2021-04-24 02:11:18','2021-05-13 02:38:57',0),(13,'A8',4500000,'35m2',NULL,0,'2021-05-13 01:34:18','2021-05-13 01:34:18',0),(14,'A9',4000000,'26m2',NULL,0,'2021-05-13 01:34:43','2021-05-13 01:34:43',0),(15,'A10',3400000,'27m2',NULL,0,'2021-05-13 01:35:12','2021-05-13 01:35:12',0),(16,'B6',3800000,'31m2',NULL,0,'2021-05-13 01:35:46','2021-05-13 01:35:46',0),(17,'B7',2900000,'25m2',NULL,0,'2021-05-13 01:36:12','2021-05-13 01:36:12',0),(18,'B8',3300000,'29m2',NULL,0,'2021-05-13 01:36:40','2021-05-13 01:36:40',0),(19,'B9',3400000,'32m2',NULL,0,'2021-05-13 01:37:23','2021-05-13 01:37:23',0),(20,'B10',2800000,'26m2',NULL,0,'2021-05-13 01:37:46','2021-05-13 01:37:46',0),(21,'B11',3700000,'33m2',NULL,0,'2021-05-13 01:38:14','2021-05-13 01:38:14',0),(22,'B12',2900000,'24m2',NULL,0,'2021-05-13 01:38:56','2021-05-13 01:38:56',0);
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `unit_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_type` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Điện',3500,'kw/h',1,NULL,NULL),(2,'Nước',8000,'1m3',1,NULL,NULL),(3,'Wifi',150000,'1 tháng',2,NULL,NULL),(4,'Tiền vệ sinh',30000,'1 tháng',2,'2021-04-24 01:48:14','2021-04-24 01:48:14');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Nguyễn Thị Huyền','huyenbon99@gmail.com',NULL,'$2y$10$2Yztv.QX8ke/Z3xsfb.sO.CjRiBOFlBHNdtkc7irifhinEli7MZxu',NULL,'2021-04-24 01:05:05','2021-04-24 01:05:05');
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

-- Dump completed on 2021-05-13 19:09:02
