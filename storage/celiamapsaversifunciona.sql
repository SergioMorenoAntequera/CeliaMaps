-- MySQL dump 10.13  Distrib 5.7.24, for Win64 (x86_64)
--
-- Host: localhost    Database: celiamaps
-- ------------------------------------------------------
-- Server version	5.7.24

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
-- Table structure for table `backup_databases`
--

DROP TABLE IF EXISTS `backup_databases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backup_databases` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup_databases`
--

LOCK TABLES `backup_databases` WRITE;
/*!40000 ALTER TABLE `backup_databases` DISABLE KEYS */;
/*!40000 ALTER TABLE `backup_databases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backups`
--

DROP TABLE IF EXISTS `backups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backups`
--

LOCK TABLES `backups` WRITE;
/*!40000 ALTER TABLE `backups` DISABLE KEYS */;
/*!40000 ALTER TABLE `backups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotspots`
--

DROP TABLE IF EXISTS `hotspots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotspots` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  `point_x` int(10) unsigned NOT NULL,
  `point_y` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotspots`
--

LOCK TABLES `hotspots` WRITE;
/*!40000 ALTER TABLE `hotspots` DISABLE KEYS */;
INSERT INTO `hotspots` VALUES (1,'catedralAlmeria.png','Catedral','CAtedral de la ciudad de Almeria',100,150,'2020-01-25 19:01:01','2020-01-25 19:01:01'),(2,'Alcazaba.png','Alcazaba','Alcazaba de la ciudad de Almeria',50,190,'2020-01-25 19:01:01','2020-01-25 19:01:01'),(3,'mercadoCentral.png','Mercado Central','Mercado del paseo',500,63,'2020-01-25 19:01:01','2020-01-25 19:01:01'),(4,'REfugios.png','Refugios WW2','Refugios de la segunda guerra mundial',100,150,'2020-01-25 19:01:01','2020-01-25 19:01:01'),(5,'minihollywood.png','Minihollywood','Atracción del oeste y zoo para toda la familia',10,500,'2020-01-25 19:01:01','2020-01-25 19:01:01');
/*!40000 ALTER TABLE `hotspots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotspots_images`
--

DROP TABLE IF EXISTS `hotspots_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotspots_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hotspot_id` int(10) unsigned NOT NULL,
  `image_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotspots_images`
--

LOCK TABLES `hotspots_images` WRITE;
/*!40000 ALTER TABLE `hotspots_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `hotspots_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotspots_maps`
--

DROP TABLE IF EXISTS `hotspots_maps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotspots_maps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hotspot_id` int(10) unsigned NOT NULL,
  `map_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotspots_maps`
--

LOCK TABLES `hotspots_maps` WRITE;
/*!40000 ALTER TABLE `hotspots_maps` DISABLE KEYS */;
INSERT INTO `hotspots_maps` VALUES (1,2,1,NULL,NULL),(2,4,2,NULL,NULL),(3,3,4,NULL,NULL),(4,3,3,NULL,NULL),(5,3,1,NULL,NULL),(6,1,2,NULL,NULL);
/*!40000 ALTER TABLE `hotspots_maps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maps`
--

DROP TABLE IF EXISTS `maps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `date` int(11) NOT NULL,
  `image` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `miniature` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `deviation_x` double(10,2) NOT NULL,
  `deviation_y` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `maps_title_unique` (`title`),
  UNIQUE KEY `maps_level_unique` (`level`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maps`
--

LOCK TABLES `maps` WRITE;
/*!40000 ALTER TABLE `maps` DISABLE KEYS */;
INSERT INTO `maps` VALUES (1,'Almería XXI','Mapa de la ciudad de Almeria en el siglo XXI','Almería',2012,'Almeria2012.png','MiniatureAlmeria2012.png',1,900,400,40.00,40.00,'2020-01-25 19:01:00','2020-01-25 19:01:00'),(2,'Huercal XXI','Mapa de la ciudad de Huercal en el siglo XXI','Huercal',2019,'Huercal2019.png','MiniatureHuercal2019.png',2,1080,720,90.00,110.00,'2020-01-25 19:01:00','2020-01-25 19:01:00'),(3,'Almería XX','Mapa de la ciudad de Almeria en el siglo XX','Almería',1990,'Almeria1990.png','MiniatureAlmeria1990.png',3,400,200,56.00,100.00,'2020-01-25 19:01:00','2020-01-25 19:01:00'),(4,'Aguadulce XXI','Mapa de la ciudad de Aguadulce en el siglo XXI','Aguadulce',2000,'Aguadulce2000.png','MiniatureAguadulce2000.png',4,1080,720,90.00,10.00,'2020-01-25 19:01:00','2020-01-25 19:01:00'),(5,'Tabernas XXI','Mapa de la ciudad de Tabernas en el siglo XXI','Tabernas',2001,'Tabernas2001.png','MiniatureTabernas2001.png',5,1080,720,90.00,10.00,'2020-01-25 19:01:00','2020-01-25 19:01:00');
/*!40000 ALTER TABLE `maps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maps_streets`
--

DROP TABLE IF EXISTS `maps_streets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maps_streets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `street_id` int(10) unsigned NOT NULL,
  `map_id` int(10) unsigned NOT NULL,
  `alternative_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maps_streets`
--

LOCK TABLES `maps_streets` WRITE;
/*!40000 ALTER TABLE `maps_streets` DISABLE KEYS */;
INSERT INTO `maps_streets` VALUES (1,2,1,NULL,'2020-01-25 19:01:02','2020-01-25 19:01:02'),(2,3,1,NULL,'2020-01-25 19:01:02','2020-01-25 19:01:02'),(3,3,3,NULL,'2020-01-25 19:01:02','2020-01-25 19:01:02'),(4,4,4,NULL,'2020-01-25 19:01:02','2020-01-25 19:01:02'),(5,1,5,NULL,'2020-01-25 19:01:02','2020-01-25 19:01:02');
/*!40000 ALTER TABLE `maps_streets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2019_12_11_080229_create_maps_table',1),(3,'2019_12_11_090929_create_maps_streets_table',1),(4,'2019_12_11_091012_create_streets_table',1),(5,'2019_12_11_111906_create_hotspots_table',1),(6,'2019_12_17_101423_create_images_table',1),(7,'2019_12_17_122414_create_hotspots_images_table',1),(8,'2019_12_17_123323_create_street_types_table',1),(9,'2020_01_09_123137_create_hotspots_maps_table',1),(10,'2020_01_22_201643_create_points_streets_table',1),(11,'2020_01_22_201803_create_points_table',1),(12,'2020_01_23_174116_create_backup_databases_table',1),(13,'2020_01_23_180934_create_backups_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `points`
--

DROP TABLE IF EXISTS `points`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `points` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `point_x` int(10) unsigned NOT NULL,
  `point_y` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `points`
--

LOCK TABLES `points` WRITE;
/*!40000 ALTER TABLE `points` DISABLE KEYS */;
INSERT INTO `points` VALUES (1,100,100,'2020-01-25 19:01:01','2020-01-25 19:01:01'),(2,200,200,'2020-01-25 19:01:01','2020-01-25 19:01:01'),(3,300,300,'2020-01-25 19:01:01','2020-01-25 19:01:01');
/*!40000 ALTER TABLE `points` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `points_streets`
--

DROP TABLE IF EXISTS `points_streets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `points_streets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `street_id` int(10) unsigned NOT NULL,
  `point_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `points_streets`
--

LOCK TABLES `points_streets` WRITE;
/*!40000 ALTER TABLE `points_streets` DISABLE KEYS */;
INSERT INTO `points_streets` VALUES (1,1,1,'2020-01-25 19:01:02','2020-01-25 19:01:02'),(2,2,2,'2020-01-25 19:01:02','2020-01-25 19:01:02'),(3,3,3,'2020-01-25 19:01:02','2020-01-25 19:01:02');
/*!40000 ALTER TABLE `points_streets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `street_types`
--

DROP TABLE IF EXISTS `street_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `street_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `abbreviation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `street_types`
--

LOCK TABLES `street_types` WRITE;
/*!40000 ALTER TABLE `street_types` DISABLE KEYS */;
INSERT INTO `street_types` VALUES (1,'Avenida','AVD. ','2020-01-25 19:01:01','2020-01-25 19:01:01'),(2,'Calle','C/','2020-01-25 19:01:01','2020-01-25 19:01:01'),(3,'Plaza','PZ. ','2020-01-25 19:01:01','2020-01-25 19:01:01'),(4,'Arboleda','ARB. ','2020-01-25 19:01:01','2020-01-25 19:01:01'),(5,'Finca','FN. ','2020-01-25 19:01:01','2020-01-25 19:01:01'),(6,'Conjunto monumental','CM. ','2020-01-25 19:01:01','2020-01-25 19:01:01'),(7,'Paseo','P. ','2020-01-25 19:01:01','2020-01-25 19:01:01');
/*!40000 ALTER TABLE `street_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `streets`
--

DROP TABLE IF EXISTS `streets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `streets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `streets`
--

LOCK TABLES `streets` WRITE;
/*!40000 ALTER TABLE `streets` DISABLE KEYS */;
INSERT INTO `streets` VALUES (1,1,'García Lorca','2020-01-25 19:01:00','2020-01-25 19:01:00'),(2,2,'Mediterráneo','2020-01-25 19:01:00','2020-01-25 19:01:00'),(3,3,'Cabo de Gata','2020-01-25 19:01:00','2020-01-25 19:01:00'),(4,2,'Carrera del Perú','2020-01-25 19:01:00','2020-01-25 19:01:00');
/*!40000 ALTER TABLE `streets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'carmen','$2y$10$x5BLyppmLy2LNzcOcWtvmusVaKcX.1rF71I.cQECsL2YCpQ9QYvIO','carmen@mail.com',1,NULL,NULL,'2020-01-25 19:01:00','2020-01-25 19:01:00'),(2,'paula','$2y$10$evXuQeE3eUdQKMYSohTed.6Dltt8tJZt22UGH.9WcM3e8UkeOVBra','paula@mail.com',1,NULL,NULL,'2020-01-25 19:01:00','2020-01-25 19:01:00'),(3,'sergio','$2y$10$sMyZwzX3G4YSeKeUGDl9teE.1TCbCSIJpsdz89ulLGRBkthdT/s4i','csergio@mail.com',1,NULL,NULL,'2020-01-25 19:01:00','2020-01-25 19:01:00'),(4,'luis','$2y$10$d0fYh.FIBzTk3nADTULHiu3eq9UWhleyHEbqcbelN0kgycR/D.32O','luis@mail.com',1,NULL,NULL,'2020-01-25 19:01:00','2020-01-25 19:01:00');
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

-- Dump completed on 2020-01-25 21:25:37
