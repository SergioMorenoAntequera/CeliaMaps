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
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1600) COLLATE utf8_unicode_ci NOT NULL,
  `lat` decimal(10,8) NOT NULL,
  `lng` decimal(11,8) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotspots`
--

LOCK TABLES `hotspots` WRITE;
/*!40000 ALTER TABLE `hotspots` DISABLE KEYS */;
INSERT INTO `hotspots` VALUES (1,'Catedral de Almeria','La Catedral-Fortaleza de la Encarnación es la sede episcopal de la diócesis de Almería. El edificio, con estructura de fortaleza, presenta una arquitectura de transición entre el Gótico tardío y el Renacimiento, así como rasgos posteriores barrocos y neoclásicos. Constituye una de las manifestaciones artísticas de carácter arquitectónico y cultural más importantes y valiosas de Andalucía y, por ende, de España, al ser la única Catedral con naturaleza de fortaleza erigida en el siglo XVI. ',36.83803605,-2.46744169,'2020-03-05 08:03:42','2020-03-05 08:03:42'),(2,'Alcazaba','Alcazaba de la ciudad de Almeria',36.84104561,-2.47158837,'2020-03-05 08:03:42','2020-03-05 08:03:42'),(3,'Mercado Central','Mercado del paseo',36.84035226,-2.46263239,'2020-03-05 08:03:42','2020-03-05 08:03:42'),(4,'Refugios de la Guerra Civil','Refugios de la segunda guerra mundial',36.84162948,-2.46463343,'2020-03-05 08:03:42','2020-03-05 08:03:42'),(5,'Plaza Vieja','La Plaza de la Constitución, popularmente conocida como Plaza Vieja, es una plaza situada en el centro histórico de la ciudad española de Almería. Durante la época musulmana se encontraba en este lugar el zoco, consolidándose su carácter de plaza en el siglo XIX. Alberga la sede del Ayuntamiento de la ciudad, construido a finales de dicho siglo, proyecto del arquitecto almeriense Trinidad Cuartara.',34.83115853,-1.90895234,'2020-03-05 08:03:42','2020-03-05 08:03:42'),(6,'Puerta Purchena','La Puerta de Purchena es una plaza situada en el centro de la ciudad de Almería. En ella se ubicó la antigua puerta de Pechina, aunque su nombre se vio alterado tras la conquista cristiana por un error de transcripción de los Reyes Católicos, quienes confundieron el nombre de los pueblos de Pechina (la antigua Bayyana) y Purchena, ambos almerienses. \r\n            La puerta homónima desapareció tras el derribo de la muralla en 1855, creándose por entonces la actual plaza. El urbanismo que la caracteriza es propio de la arquitectura burguesa del siglo XIX, representada en edificaciones como la Casa de las Mariposas. ',36.84159299,-2.46397889,'2020-03-05 08:03:42','2020-03-05 08:03:42'),(7,'Estadio de los Juegos Mediterraneos','',36.83999593,-2.43538058,'2020-03-05 08:03:42','2020-03-05 08:03:42');
/*!40000 ALTER TABLE `hotspots` ENABLE KEYS */;
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
  `hotspot_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (1,'Catedral de Almeria','','catedral-almeria-img-01.jpg','img/hotspots',1,'2020-03-05 08:03:44','2020-03-05 08:03:44'),(2,'Catedral de Almeria','','catedral-almeria-img-02.jpg','img/hotspots',1,'2020-03-05 08:03:44','2020-03-05 08:03:44'),(3,'Catedral de Almeria','','catedral-almeria-img-03.jpg','img/hotspots',1,'2020-03-05 08:03:44','2020-03-05 08:03:44'),(4,'Plaza Vieja','','plaza-vieja-img-01.jpg','img/hotspots',5,'2020-03-05 08:03:44','2020-03-05 08:03:44'),(5,'Plaza Vieja','','plaza-vieja-img-02.jpg','img/hotspots',5,'2020-03-05 08:03:44','2020-03-05 08:03:44'),(6,'Plaza Vieja','','plaza-vieja-img-03.jpg','img/hotspots',5,'2020-03-05 08:03:44','2020-03-05 08:03:44'),(7,'Puerta Purchena','','puerta-purchena-img-04-en-la-actualidad.jpg','img/hotspots',5,'2020-03-05 08:03:44','2020-03-05 08:03:44'),(8,'Puerta Purchena','','puerta-purchena-img-02.jpg','img/hotspots',6,'2020-03-05 08:03:44','2020-03-05 08:03:44'),(9,'Puerta Purchena','','puerta-purchena-img-03.jpg','img/hotspots',6,'2020-03-05 08:03:44','2020-03-05 08:03:44'),(10,'Puerta Purchena','','puerta-purchena-img-03.jpg','img/hotspots',6,'2020-03-05 08:03:44','2020-03-05 08:03:44'),(11,'Estadio de los juegos Mediterraneos','','estadio-juegos-mediterraneos-img-01.jpg','img/hotspots',7,'2020-03-05 08:03:44','2020-03-05 08:03:44'),(12,'Alcazaba','','alcazaba-almeria-img-01.jpg','img/hotspots',2,'2020-03-05 08:03:44','2020-03-05 08:03:44'),(13,'Mercado Central','','mercado-central-img-01.jpg','img/hotspots',3,'2020-03-05 08:03:44','2020-03-05 08:03:44'),(14,'Refugios de la Guerra Civil','','refugios-guerra-civil-img-01.jpg','img/hotspots',4,'2020-03-05 08:03:44','2020-03-05 08:03:44');
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
  `description` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `image` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `miniature` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(11) NOT NULL,
  `tlCornerLatitude` double(18,16) DEFAULT NULL,
  `tlCornerLongitude` double(18,16) DEFAULT NULL,
  `trCornerLatitude` double(18,16) DEFAULT NULL,
  `trCornerLongitude` double(18,16) DEFAULT NULL,
  `blCornerLatitude` double(18,16) DEFAULT NULL,
  `blCornerLongitude` double(18,16) DEFAULT NULL,
  `brCornerLatitude` double(18,16) DEFAULT NULL,
  `brCornerLongitude` double(18,16) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `maps_title_unique` (`title`),
  UNIQUE KEY `maps_level_unique` (`level`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maps`
--

LOCK TABLES `maps` WRITE;
/*!40000 ALTER TABLE `maps` DISABLE KEYS */;
INSERT INTO `maps` VALUES (1,'Almería 1917','Mapa de la ciudad de Almeria en el siglo XXI','Almería',1917,'1mapa1.png','MiniatureAlmeria2012.png',1,36.8509943512347000,-2.4849700927734380,36.8509943512347000,-2.4457776546478276,36.8282316190681300,-2.4849700927734380,36.8282316190681300,-2.4457776546478276,'2020-03-05 08:03:41','2020-03-05 08:03:41'),(2,'Perez de Rozas','Mapa de Perez de Rozas','Almeria',1864,'2mapa2.png','2map.png',2,36.8473326790705200,-2.4914395809173590,36.8473326790705200,-2.4498009681701665,36.8303742321529340,-2.4914395809173590,36.8303742321529340,-2.4498009681701665,'2020-03-05 08:03:41','2020-03-05 08:03:41'),(3,'Huercal XXI','Mapa de la ciudad de Huercal en el siglo XXI','Huercal',2019,'NoMap.png','MiniatureHuercal2019.png',3,36.8551065476929500,-2.4715805053710940,36.8529775049102400,-2.4231719970703130,36.8355995519090600,-2.4795627593994145,36.8246075036501700,-2.4444580078125004,'2020-03-05 08:03:41','2020-03-05 08:03:41'),(4,'Almería XX','Mapa de la ciudad de Almeria en el siglo XX','Almería',1990,'KindOfMap3.png','MiniatureAlmeria1990.png',4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-03-05 08:03:41','2020-03-05 08:03:41'),(5,'Aguadulce XXI','Mapa de la ciudad de Aguadulce en el siglo XXI','Aguadulce',2000,'Aguadulce2000.png','MiniatureAguadulce2000.png',5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-03-05 08:03:41','2020-03-05 08:03:41'),(6,'Tabernas XXI','Mapa de la ciudad de Tabernas en el siglo XXI','Tabernas',2001,'Tabernas2001.png','MiniatureTabernas2001.png',6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-03-05 08:03:41','2020-03-05 08:03:41');
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
INSERT INTO `maps_streets` VALUES (1,2,1,NULL,'2020-03-05 08:03:43','2020-03-05 08:03:43'),(2,3,1,NULL,'2020-03-05 08:03:43','2020-03-05 08:03:43'),(3,3,3,'nombre alternativo','2020-03-05 08:03:43','2020-03-05 08:03:43'),(4,4,4,NULL,'2020-03-05 08:03:43','2020-03-05 08:03:43'),(5,1,5,NULL,'2020-03-05 08:03:43','2020-03-05 08:03:43');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_12_11_080229_create_maps_table',1),(4,'2019_12_11_090929_create_maps_streets_table',1),(5,'2019_12_11_091012_create_streets_table',1),(6,'2019_12_11_111906_create_hotspots_table',1),(7,'2019_12_17_101423_create_images_table',1),(8,'2019_12_17_123323_create_street_types_table',1),(9,'2020_01_22_201643_create_points_streets_table',1),(10,'2020_01_22_201803_create_points_table',1),(11,'2020_01_23_174116_create_backup_databases_table',1),(12,'2020_01_23_180934_create_backups_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `points`
--

DROP TABLE IF EXISTS `points`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `points` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `lat` decimal(10,8) NOT NULL,
  `lng` decimal(11,8) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `points`
--

LOCK TABLES `points` WRITE;
/*!40000 ALTER TABLE `points` DISABLE KEYS */;
INSERT INTO `points` VALUES (1,36.85441570,-2.44742402,'2020-03-05 08:03:43','2020-03-05 08:03:43'),(2,36.83820303,-2.47978789,'2020-03-05 08:03:43','2020-03-05 08:03:43'),(3,36.82146698,-2.43938129,'2020-03-05 08:03:43','2020-03-05 08:03:43'),(4,36.83115853,-2.43895234,'2020-03-05 08:03:43','2020-03-05 08:03:43');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `points_streets`
--

LOCK TABLES `points_streets` WRITE;
/*!40000 ALTER TABLE `points_streets` DISABLE KEYS */;
INSERT INTO `points_streets` VALUES (1,1,1,'2020-03-05 08:03:43','2020-03-05 08:03:43'),(2,2,2,'2020-03-05 08:03:43','2020-03-05 08:03:43'),(3,3,3,'2020-03-05 08:03:43','2020-03-05 08:03:43'),(4,4,4,'2020-03-05 08:03:44','2020-03-05 08:03:44');
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
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
INSERT INTO `street_types` VALUES (1,'Avenida','AVD. ','2020-03-05 08:03:43','2020-03-05 08:03:43'),(2,'Calle','C/','2020-03-05 08:03:43','2020-03-05 08:03:43'),(3,'Plaza','PZ. ','2020-03-05 08:03:43','2020-03-05 08:03:43'),(4,'Arboleda','ARB. ','2020-03-05 08:03:43','2020-03-05 08:03:43'),(5,'Finca','FN. ','2020-03-05 08:03:43','2020-03-05 08:03:43'),(6,'Conjunto monumental','CM. ','2020-03-05 08:03:43','2020-03-05 08:03:43'),(7,'Paseo','P. ','2020-03-05 08:03:43','2020-03-05 08:03:43');
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
INSERT INTO `streets` VALUES (1,1,'García Lorca','2020-03-05 08:03:42','2020-03-05 08:03:42'),(2,1,'del Mediterráneo','2020-03-05 08:03:42','2020-03-05 08:03:42'),(3,3,'Cabo de Gata','2020-03-05 08:03:42','2020-03-05 08:03:42'),(4,2,'Carrera del Perú','2020-03-05 08:03:42','2020-03-05 08:03:42');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'carmen modificada','$2y$10$xTt.eKMukLCQyZdlREzICeJCijImdKuz.EhebdCI0AjuI4ctBmsWW','carmen@mail.com',1,NULL,NULL,'2020-03-05 08:03:41','2020-03-09 07:22:42'),(2,'paula','$2y$10$EFGScdQNWSoXmNZnnyXOPe.WqouUVeBOTgmZASGSPPIhEM/pCchvy','paula@mail.com',1,NULL,NULL,'2020-03-05 08:03:42','2020-03-05 08:03:42'),(3,'sergio modificado','$2y$10$rIaQoTuZC05tO/wqzGxRIeVuaFrXf3JaAp/OLQOpCLW8uohAB8yoW','csergio@mail.com',1,NULL,NULL,'2020-03-05 08:03:42','2020-03-05 09:01:47'),(4,'luis','$2y$10$q7wnUNVrT.M7O/2jnorHZOsRx8pby36HyMcxEbbF4i90ZF67zPuqC','luis@mail.com',1,NULL,NULL,'2020-03-05 08:03:42','2020-03-05 08:03:42'),(5,'añadido','$2y$10$ynAIJZ.3DEQy52UE4Att0.MTD14B0gRS7AIP6swAdee9jrgIZZSum','siete@mail.com',1,NULL,NULL,'2020-03-09 07:33:21','2020-03-09 07:33:21'),(6,'pepe','$2y$10$e5XZ4MMQv/3ciQZUG6LJku1k0EA1AjlbLsHfR0z0kVAEbdRZwzbPO','juan@mail.com',1,NULL,NULL,'2020-03-09 07:40:26','2020-03-09 07:40:26'),(7,'prueba','$2y$10$PaerUh3wXbOaCpcp7SB20OfgvxP41SjIHRXiYVNxHvhp9xYocDuVK','mail@mail.com',1,NULL,NULL,'2020-03-09 08:45:36','2020-03-09 08:45:36'),(8,'probando otra vez','$2y$10$8GufKvY0Z37js5A.cgePW.2UEduzLInuZCoNYKL3fvHvNhljENoAK','probandootravez@mail.com',1,NULL,NULL,'2020-03-09 10:18:18','2020-03-09 10:18:18');
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

-- Dump completed on 2020-03-09 13:22:15
