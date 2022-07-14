
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
-- Table structure for table `categoria_produtos`
--

DROP TABLE IF EXISTS `categoria_produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria_produtos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `informacao_loja_id` bigint unsigned NOT NULL,
  `titulo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria_produtos_informacao_loja_id_foreign` (`informacao_loja_id`),
  CONSTRAINT `categoria_produtos_informacao_loja_id_foreign` FOREIGN KEY (`informacao_loja_id`) REFERENCES `informacao_loja` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_produtos`
--

LOCK TABLES `categoria_produtos` WRITE;
/*!40000 ALTER TABLE `categoria_produtos` DISABLE KEYS */;
INSERT INTO `categoria_produtos` VALUES (1,1,'Hamburguer Simples','2021-03-27 19:20:17','2021-03-27 19:19:48','2021-03-27 19:20:17'),(2,1,'Hamburguer Especial','2021-03-27 19:20:18','2021-03-27 19:20:10','2021-03-27 19:20:18'),(3,1,'X-Tudo','2021-03-27 19:20:19','2021-03-27 19:20:14','2021-03-27 19:20:19'),(4,1,'Hamburguer','2021-03-28 17:25:28','2021-03-27 19:20:28','2021-03-28 17:25:28'),(5,1,'Bebidas',NULL,'2021-03-27 19:20:37','2021-03-27 19:20:37'),(6,2,'Cozinha Awareness',NULL,'2021-03-28 15:50:01','2021-03-28 15:50:01'),(7,2,'King Tabacaria',NULL,'2021-03-28 15:50:33','2021-04-24 19:18:42'),(8,1,'Choripan',NULL,'2021-03-28 17:26:01','2021-03-28 17:26:01'),(9,3,'Doces',NULL,'2021-04-10 22:46:37','2021-04-10 22:46:37'),(10,5,'Promoção','2021-04-14 18:53:51','2021-04-14 18:53:48','2021-04-14 18:53:51'),(11,5,'Prato Feito',NULL,'2021-04-14 18:54:05','2021-04-14 18:54:05'),(12,5,'Bebidas',NULL,'2021-04-14 18:54:11','2021-04-14 18:54:11'),(13,2,'Awareness Confecção',NULL,'2021-04-18 00:22:41','2021-04-18 00:22:41');
/*!40000 ALTER TABLE `categoria_produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cupom`
--

DROP TABLE IF EXISTS `cupom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cupom` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `informacao_loja_id` bigint unsigned NOT NULL,
  `codigo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datahora_inicio_validade` datetime NOT NULL,
  `datahora_fim_validade` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `valor` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cupom_informacao_loja_id_foreign` (`informacao_loja_id`),
  CONSTRAINT `cupom_informacao_loja_id_foreign` FOREIGN KEY (`informacao_loja_id`) REFERENCES `informacao_loja` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cupom`
--

LOCK TABLES `cupom` WRITE;
/*!40000 ALTER TABLE `cupom` DISABLE KEYS */;
INSERT INTO `cupom` VALUES (1,1,'zero','2021-04-01 00:00:00','2030-04-01 00:00:00','2021-03-28 19:35:30','2021-03-28 19:35:30',NULL,0);
/*!40000 ALTER TABLE `cupom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enderecos`
--

DROP TABLE IF EXISTS `enderecos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enderecos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `cep` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rua` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bairro` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complemento` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `enderecos_user_id_foreign` (`user_id`),
  CONSTRAINT `enderecos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enderecos`
--

LOCK TABLES `enderecos` WRITE;
/*!40000 ALTER TABLE `enderecos` DISABLE KEYS */;
INSERT INTO `enderecos` VALUES (1,2,'68901315','199','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','a',NULL,'2021-03-28 04:36:51','2021-03-28 04:36:51'),(2,3,'68901315','199','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','a',NULL,'2021-03-28 04:36:53','2021-03-28 04:36:53'),(3,4,'68901315','199','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','a',NULL,'2021-03-28 04:36:54','2021-03-28 04:36:54'),(4,5,'68901315','199','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','a',NULL,'2021-03-28 04:36:54','2021-03-28 04:36:54'),(5,6,'68901315','199','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','a',NULL,'2021-03-28 04:36:54','2021-03-28 04:36:54'),(6,7,'68901315','199','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','a',NULL,'2021-03-28 04:36:54','2021-03-28 04:36:54'),(7,8,'68901315','199','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','a',NULL,'2021-03-28 04:36:55','2021-03-28 04:36:55'),(8,9,'68901315','199','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','a',NULL,'2021-03-28 04:36:55','2021-03-28 04:36:55'),(9,10,'68901315','1889','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','a',NULL,'2021-03-28 04:39:03','2021-03-28 04:39:03'),(10,11,'68901315','1889','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','a',NULL,'2021-03-28 04:42:18','2021-03-28 04:42:18'),(11,12,'68901315','1889','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','a',NULL,'2021-03-28 04:43:25','2021-03-28 04:43:25'),(12,13,'68901315','1889','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','a',NULL,'2021-03-28 04:44:29','2021-03-28 04:44:29'),(13,14,'68901315','1889','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','a',NULL,'2021-03-28 04:52:32','2021-03-28 04:52:32'),(14,15,'68901315','1889','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','a',NULL,'2021-03-28 04:55:04','2021-03-28 04:55:04'),(15,16,'68901315','1889','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','a',NULL,'2021-03-28 04:59:07','2021-03-28 04:59:07'),(16,17,'68901315','1889','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','a',NULL,'2021-03-28 05:01:10','2021-03-28 05:01:10'),(17,18,'68901315','1889','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','a',NULL,'2021-03-28 05:07:26','2021-03-28 05:07:26'),(18,19,'68901315','1889','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','a',NULL,'2021-03-28 05:08:23','2021-03-28 05:08:23'),(19,20,'68901315','1889','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','a',NULL,'2021-03-28 05:08:30','2021-03-28 05:08:30'),(20,21,'68903856','689','Avenida Nona','Araxá','Macapá','AP','baiuca do sassa',NULL,'2021-03-28 14:55:58','2021-03-28 14:55:58'),(21,22,'68903856','689','Avenida Nona','Araxá','Macapá','AP','baiuca do sassa',NULL,'2021-03-28 14:56:04','2021-03-28 14:56:04'),(22,23,'68903856','689','Avenida Nona','Araxá','Macapá','AP','baiuca do sassa',NULL,'2021-03-28 14:56:20','2021-03-28 14:56:20'),(23,24,'68903856','689','Avenida Nona','Araxá','Macapá','AP','baiuca do sassa',NULL,'2021-03-28 14:56:21','2021-03-28 14:56:21'),(24,25,'68903856','689','Avenida Nona','Araxá','Macapá','AP','baiuca do sassa',NULL,'2021-03-28 14:56:31','2021-03-28 14:56:31'),(25,26,'68903856','689','Avenida Nona','Araxá','Macapá','AP','baiuca do sassa',NULL,'2021-03-28 14:56:31','2021-03-28 14:56:31'),(26,27,'68903856','689','Avenida Nona','Araxá','Macapá','AP','baiuca do sassa',NULL,'2021-03-28 14:59:24','2021-03-28 14:59:24'),(27,28,'68903856','689','Avenida Nona','Araxá','Macapá','AP','baiuca do sassa',NULL,'2021-03-28 14:59:27','2021-03-28 14:59:27'),(28,29,'68903856','689','Avenida Nona','Araxá','Macapá','AP','baiuca do sassa',NULL,'2021-03-28 14:59:28','2021-03-28 14:59:28'),(29,30,'68903856','689','Avenida Nona','Araxá','Macapá','AP','baiuca do sassa',NULL,'2021-03-28 14:59:29','2021-03-28 14:59:29'),(30,31,'68903856','689','Avenida Nona','Araxá','Macapá','AP','baiuca do sassa',NULL,'2021-03-28 15:00:25','2021-03-28 15:00:25'),(31,32,'68903856','689','Avenida Nona','Araxá','Macapá','AP','baiuca do sassa',NULL,'2021-03-28 15:00:28','2021-03-28 15:00:28'),(32,33,'68903856','689','Avenida Nona','Araxá','Macapá','AP','baiuca do sassa',NULL,'2021-03-28 15:00:28','2021-03-28 15:00:28'),(33,34,'68903856','689','Avenida Nona','Araxá','Macapá','AP','baiuca do sassa',NULL,'2021-03-28 15:00:28','2021-03-28 15:00:28'),(34,36,'68903856','689','Avenida Nona','Araxá','Macapá','AP',NULL,NULL,'2021-03-28 18:59:12','2021-03-28 18:59:12'),(35,37,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Benháli',NULL,'2021-03-28 19:09:59','2021-03-28 19:09:59'),(36,38,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Benháli',NULL,'2021-03-28 19:10:05','2021-03-28 19:10:05'),(37,39,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Benhali',NULL,'2021-03-28 19:11:48','2021-03-28 19:11:48'),(38,40,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Benhali',NULL,'2021-03-28 19:11:50','2021-03-28 19:11:50'),(39,41,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Benhali',NULL,'2021-03-28 19:11:50','2021-03-28 19:11:50'),(40,42,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Benhali',NULL,'2021-03-28 19:11:51','2021-03-28 19:11:51'),(41,43,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Benhali',NULL,'2021-03-28 19:11:51','2021-03-28 19:11:51'),(42,44,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Benhali',NULL,'2021-03-28 19:11:51','2021-03-28 19:11:51'),(43,45,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Benhali',NULL,'2021-03-28 19:11:53','2021-03-28 19:11:53'),(44,46,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Benhali',NULL,'2021-03-28 19:11:53','2021-03-28 19:11:53'),(45,47,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Benhali',NULL,'2021-03-28 19:11:53','2021-03-28 19:11:53'),(46,48,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','benhali',NULL,'2021-03-28 19:20:28','2021-03-28 19:20:28'),(47,49,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Logo ali',NULL,'2021-03-28 19:26:06','2021-03-28 19:26:06'),(48,50,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Logo ali',NULL,'2021-03-28 19:26:06','2021-03-28 19:26:06'),(49,51,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Logo ali',NULL,'2021-03-28 19:26:12','2021-03-28 19:26:12'),(50,52,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Logo ali',NULL,'2021-03-28 19:26:13','2021-03-28 19:26:13'),(51,53,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Logo ali',NULL,'2021-03-28 19:26:14','2021-03-28 19:26:14'),(52,54,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Logo ali',NULL,'2021-03-28 19:26:14','2021-03-28 19:26:14'),(53,55,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Logo ali',NULL,'2021-03-28 19:26:14','2021-03-28 19:26:14'),(54,56,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Logo ali',NULL,'2021-03-28 19:27:21','2021-03-28 19:27:21'),(55,57,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Logo ali',NULL,'2021-03-28 19:27:22','2021-03-28 19:27:22'),(56,58,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Logo ali',NULL,'2021-03-28 19:27:28','2021-03-28 19:27:28'),(57,59,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Esquina com petshop',NULL,'2021-03-28 19:31:20','2021-03-28 19:31:20'),(58,60,'68901315','1111','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','ali',NULL,'2021-03-28 19:36:56','2021-03-28 19:36:56'),(59,61,'68901315','1111','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','ali',NULL,'2021-03-28 19:37:22','2021-03-28 19:37:22'),(60,62,'68901315','1111','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','ali',NULL,'2021-03-28 19:38:12','2021-03-28 19:38:12'),(61,63,'68901315','1111','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','ali',NULL,'2021-03-28 19:38:12','2021-03-28 19:38:12'),(62,64,'68901315','1111','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','ali',NULL,'2021-03-28 19:38:12','2021-03-28 19:38:12'),(63,65,'68901315','1111','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','ali',NULL,'2021-03-28 19:38:12','2021-03-28 19:38:12'),(64,66,'68901315','1111','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','ali',NULL,'2021-03-28 19:38:12','2021-03-28 19:38:12'),(65,67,'68901315','1111','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','ali',NULL,'2021-03-28 19:38:13','2021-03-28 19:38:13'),(66,68,'68901315','1111','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','ali',NULL,'2021-03-28 19:38:14','2021-03-28 19:38:14'),(67,69,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Canto do pet shop',NULL,'2021-03-28 19:48:31','2021-03-28 19:48:31'),(68,70,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','esquina do pet shop',NULL,'2021-03-28 19:56:18','2021-03-28 19:56:18'),(69,71,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','canto do petshop',NULL,'2021-03-28 20:10:40','2021-03-28 20:10:40'),(70,72,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','canto do petshop',NULL,'2021-03-28 20:18:51','2021-03-28 20:18:51'),(71,73,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','canto do petshop',NULL,'2021-03-28 20:30:32','2021-03-28 20:30:32'),(72,74,'68901315','124','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','canto do petshop',NULL,'2021-03-29 22:40:43','2021-03-29 22:40:43'),(73,75,'68903455','691','Travessa Jerusalém','Jardim Marco Zero','Macapá','AP',NULL,NULL,'2021-03-29 22:50:41','2021-03-29 22:50:41'),(74,76,'68903455','691','Travessa Jerusalém','Jardim Marco Zero','Macapá','AP',NULL,NULL,'2021-03-29 22:50:50','2021-03-29 22:50:50'),(75,77,'68903455','691','Travessa Jerusalém','Jardim Marco Zero','Macapá','AP',NULL,NULL,'2021-03-29 22:51:02','2021-03-29 22:51:02'),(76,78,'68908360','784','Rua Guanabara','Pacoval','Macapá','AP','logo ali',NULL,'2021-03-29 23:35:25','2021-03-29 23:35:25'),(77,79,'68908360','784','Rua Guanabara','Pacoval','Macapá','AP','logo ali',NULL,'2021-03-29 23:39:54','2021-03-29 23:39:54'),(78,80,'68901315','4489','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP',NULL,NULL,'2021-03-30 04:13:35','2021-03-30 04:13:35'),(79,81,'68903856','689','Avenida Nona','Araxá','Macapá','AP',NULL,NULL,'2021-03-30 18:27:01','2021-03-30 18:27:01'),(80,84,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Canto do petshop',NULL,'2021-03-31 02:59:43','2021-03-31 02:59:43'),(81,85,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Canto do petshop',NULL,'2021-03-31 03:00:27','2021-03-31 03:00:27'),(82,86,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Canto do Petshop',NULL,'2021-03-31 03:07:08','2021-03-31 03:07:08'),(83,88,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Canto do Petshop',NULL,'2021-04-10 17:52:03','2021-04-10 17:52:03'),(84,89,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Canto do Petshop',NULL,'2021-04-10 18:08:04','2021-04-10 18:08:04'),(85,90,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Canto do Petshop',NULL,'2021-04-10 18:08:27','2021-04-10 18:08:27'),(86,91,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Canto do Petshop',NULL,'2021-04-10 18:25:03','2021-04-10 18:25:03'),(87,92,'68901315','177','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP',NULL,NULL,'2021-04-10 20:06:46','2021-04-10 20:06:46'),(88,93,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Canto do Petshop',NULL,'2021-04-10 21:59:41','2021-04-10 21:59:41'),(89,97,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Canto do Petshop',NULL,'2021-04-10 23:40:17','2021-04-10 23:40:17'),(90,98,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Canto do Petshop',NULL,'2021-04-11 00:35:36','2021-04-11 00:35:36'),(91,99,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Canto do Petshop',NULL,'2021-04-11 01:21:31','2021-04-11 01:21:31'),(92,100,'68900040','837','Avenida Professora Cora de Carvalho','Central','Macapá','AP',NULL,NULL,'2021-04-11 18:37:26','2021-04-11 18:37:26'),(93,101,'68909033','3056','Avenida Alvaro Carvalho Barbosa','Jardim Felicidade','Macapá','AP',NULL,NULL,'2021-04-12 01:54:19','2021-04-12 01:54:19'),(94,102,'36016350','5','Rua Padre Tiago','São Mateus','Juiz de Fora','MG',NULL,NULL,'2021-04-12 17:11:59','2021-04-12 17:11:59'),(95,103,'68901315','1758','Avenida Doutor Acelino de Leão','Santa Rita','Macapá','AP','Canto do Petshop',NULL,'2021-04-13 01:23:52','2021-04-13 01:23:52'),(96,106,'36016350','5','Rua Padre Tiago','São Mateus','Juiz de Fora','MG',NULL,NULL,'2021-04-14 19:01:25','2021-04-14 19:01:25'),(97,107,'68903-200','602','Rua Maria Marola Gato','Jardim Marco Zero','Macapá','AP','Fundo do corredor ao lado da casa 591',NULL,'2021-04-18 16:06:17','2021-04-18 16:06:17');
/*!40000 ALTER TABLE `enderecos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estoque`
--

DROP TABLE IF EXISTS `estoque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estoque` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `produto_id` bigint unsigned NOT NULL,
  `quantidade` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `estoque_produto_id_foreign` (`produto_id`),
  CONSTRAINT `estoque_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estoque`
--

LOCK TABLES `estoque` WRITE;
/*!40000 ALTER TABLE `estoque` DISABLE KEYS */;
/*!40000 ALTER TABLE `estoque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
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
-- Table structure for table `forma_entrega`
--

DROP TABLE IF EXISTS `forma_entrega`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forma_entrega` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `informacao_loja_id` bigint unsigned NOT NULL,
  `titulo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `forma_entrega_informacao_loja_id_foreign` (`informacao_loja_id`),
  CONSTRAINT `forma_entrega_informacao_loja_id_foreign` FOREIGN KEY (`informacao_loja_id`) REFERENCES `informacao_loja` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forma_entrega`
--

LOCK TABLES `forma_entrega` WRITE;
/*!40000 ALTER TABLE `forma_entrega` DISABLE KEYS */;
INSERT INTO `forma_entrega` VALUES (1,1,'Delivery','2021-03-27 19:26:59','2021-03-27 19:26:59',NULL),(2,1,'Retirada','2021-03-27 19:27:03','2021-03-27 19:27:03',NULL),(3,2,'Carro','2021-03-29 23:25:22','2021-03-29 23:32:44','2021-03-29 23:32:44'),(4,2,'Moto','2021-03-29 23:25:40','2021-03-29 23:32:47','2021-03-29 23:32:47'),(5,2,'Retirada','2021-03-29 23:32:54','2021-03-29 23:32:54',NULL),(6,2,'Delivery (+tx)','2021-03-29 23:37:07','2021-03-29 23:55:57',NULL),(7,2,'Presentear (Especifique o endereço da entrega na OBS)','2021-03-29 23:51:59','2021-03-29 23:54:03',NULL),(8,2,'Agendar (Especifique o horário da entrega na OBS)','2021-03-29 23:53:11','2021-03-29 23:53:11',NULL),(9,3,'Retirada','2021-04-10 23:33:48','2021-04-16 01:35:43','2021-04-16 01:35:43'),(10,3,'Delivery (+taxa)','2021-04-10 23:34:08','2021-04-10 23:34:08',NULL),(11,5,'Delivery','2021-04-14 18:56:05','2021-04-14 18:56:05',NULL),(12,5,'Retirada','2021-04-14 18:56:10','2021-04-14 18:56:10',NULL),(13,3,'Retirada','2021-04-16 01:44:37','2021-04-16 01:44:37',NULL);
/*!40000 ALTER TABLE `forma_entrega` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forma_pagamento`
--

DROP TABLE IF EXISTS `forma_pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forma_pagamento` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `informacao_loja_id` bigint unsigned NOT NULL,
  `titulo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `forma_pagamento_informacao_loja_id_foreign` (`informacao_loja_id`),
  CONSTRAINT `forma_pagamento_informacao_loja_id_foreign` FOREIGN KEY (`informacao_loja_id`) REFERENCES `informacao_loja` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forma_pagamento`
--

LOCK TABLES `forma_pagamento` WRITE;
/*!40000 ALTER TABLE `forma_pagamento` DISABLE KEYS */;
INSERT INTO `forma_pagamento` VALUES (1,1,'Dinheiro','2021-03-27 19:27:14','2021-03-27 19:27:14',NULL),(2,1,'Cartão','2021-03-27 19:27:20','2021-03-27 19:27:20',NULL),(3,2,'Cartão Debito','2021-03-29 23:33:07','2021-04-22 22:20:44','2021-04-22 22:20:44'),(4,2,'Cartão Credito (+tx)','2021-03-29 23:37:47','2021-04-22 22:20:47','2021-04-22 22:20:47'),(5,2,'Dinheiro (troco informe na OBS)','2021-03-29 23:38:26','2021-03-30 00:39:21',NULL),(6,2,'Pix (001.220.402-10)','2021-03-29 23:39:07','2021-03-29 23:39:07',NULL),(7,3,'Dinheiro','2021-04-10 23:34:51','2021-04-10 23:34:51',NULL),(8,3,'Cartão de Credito','2021-04-10 23:34:57','2021-04-10 23:34:57',NULL),(9,3,'Cartão de Débito','2021-04-10 23:35:10','2021-04-10 23:35:10',NULL),(10,3,'Pix (03363631251)','2021-04-10 23:36:00','2021-04-10 23:36:00',NULL),(11,5,'Dinheiro','2021-04-14 18:56:21','2021-04-14 18:56:21',NULL),(12,5,'Credito/Debito','2021-04-14 18:56:37','2021-04-14 18:56:37',NULL);
/*!40000 ALTER TABLE `forma_pagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `informacao_loja`
--

DROP TABLE IF EXISTS `informacao_loja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `informacao_loja` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `titulo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitulo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `contato_loja` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aberto` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `informacao_loja_user_id_foreign` (`user_id`),
  CONSTRAINT `informacao_loja_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `informacao_loja`
--

LOCK TABLES `informacao_loja` WRITE;
/*!40000 ALTER TABLE `informacao_loja` DISABLE KEYS */;
INSERT INTO `informacao_loja` VALUES (1,1,'El choripán','Sabor Argentino','Alameda Jardim 689, Araxá - Macapá/AP','2021-03-27 19:02:09','2021-04-12 01:48:38',NULL,'96984165948',0),(2,35,'Awareness21','Conveniência','Rua Maria Marola Gato, 602 - Jardim Marco Zero','2021-03-28 15:48:30','2021-04-22 22:19:27',NULL,'96991723296',1),(3,96,'Clarita Gourmet','Adoçando seu dia','Av Presidente Vargas','2021-04-10 22:43:52','2021-04-16 01:44:23',NULL,'96981031004',1),(4,104,'titulo de teste','sub titulo teste','avenida brasil','2021-04-13 02:19:57','2021-04-13 02:19:57',NULL,'96981435566',0),(5,105,'Maná Restaurante','happy day','Av. Presidente Itamar Franco, 1736','2021-04-14 18:53:23','2021-04-14 18:57:09',NULL,'03299414069',0);
/*!40000 ALTER TABLE `informacao_loja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2020_05_23_065615_endereco_table',1),(5,'2020_05_23_070844_add_campos_users',1),(6,'2020_05_23_071225_categorias__produto__table',1),(7,'2020_05_23_072017_produto__table',1),(8,'2020_05_23_142304_forma_pagamento__table',1),(9,'2020_05_23_142421_forma_entrega__table',1),(10,'2020_05_23_142504_estoque__table',1),(11,'2020_05_23_143247_cupom__table',1),(12,'2020_05_23_143431_pedido__table',1),(13,'2020_05_23_144001_pedido_produtoso__table',1),(14,'2020_05_23_144419_informacao_loja__table',1),(15,'2020_05_23_144729_atualiza_com_id_loja__tables',1),(16,'2020_05_23_150507_personaliza_loja__tables',1),(17,'2020_07_02_220737_atualizar_informacao_loja_table',1),(18,'2020_07_05_020120_atualizar_pedido_observacao',1),(19,'2020_07_05_021558_atualizar_produto_ativo_maisvendidos_promocao',1),(20,'2020_07_11_214603_atualizar_produto_image',1),(21,'2020_07_18_230656_atualizar_cupom_add_valor',1),(22,'2021_04_10_033609_acrescenta_campo_aberto_fechado',2),(23,'2021_04_16_014653_permite_inclusao_adicionais_produto',3),(24,'2021_04_16_024146_tabela_pedido_produto_adicionais',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedido` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `informacao_loja_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `endereco_id` bigint unsigned NOT NULL,
  `cupom_id` bigint unsigned NOT NULL,
  `forma_pagamento_id` bigint unsigned NOT NULL,
  `forma_entrega_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `observacao` longtext COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pedido_user_id_foreign` (`user_id`),
  KEY `pedido_endereco_id_foreign` (`endereco_id`),
  KEY `pedido_cupom_id_foreign` (`cupom_id`),
  KEY `pedido_forma_pagamento_id_foreign` (`forma_pagamento_id`),
  KEY `pedido_forma_entrega_id_foreign` (`forma_entrega_id`),
  KEY `pedido_informacao_loja_id_foreign` (`informacao_loja_id`),
  CONSTRAINT `pedido_cupom_id_foreign` FOREIGN KEY (`cupom_id`) REFERENCES `cupom` (`id`),
  CONSTRAINT `pedido_endereco_id_foreign` FOREIGN KEY (`endereco_id`) REFERENCES `enderecos` (`id`),
  CONSTRAINT `pedido_forma_entrega_id_foreign` FOREIGN KEY (`forma_entrega_id`) REFERENCES `forma_entrega` (`id`),
  CONSTRAINT `pedido_forma_pagamento_id_foreign` FOREIGN KEY (`forma_pagamento_id`) REFERENCES `forma_pagamento` (`id`),
  CONSTRAINT `pedido_informacao_loja_id_foreign` FOREIGN KEY (`informacao_loja_id`) REFERENCES `informacao_loja` (`id`),
  CONSTRAINT `pedido_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido`
--

LOCK TABLES `pedido` WRITE;
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
INSERT INTO `pedido` VALUES (27,1,88,83,1,1,2,'2021-04-10 17:52:03','2021-04-10 19:42:23',NULL,NULL,2),(28,1,89,84,1,1,2,'2021-04-10 18:08:04','2021-04-10 19:42:21',NULL,NULL,2),(29,1,90,85,1,1,2,'2021-04-10 18:08:27','2021-04-10 19:42:15',NULL,NULL,2),(30,1,91,86,1,2,2,'2021-04-10 18:25:03','2021-04-10 19:42:25',NULL,NULL,2),(31,1,92,87,1,1,1,'2021-04-10 20:06:46','2021-04-10 20:06:46',NULL,NULL,0),(32,1,93,88,1,1,1,'2021-04-10 21:59:41','2021-04-10 21:59:41',NULL,NULL,0),(33,3,97,89,1,8,10,'2021-04-10 23:40:17','2021-04-10 23:40:17',NULL,NULL,0),(34,3,98,90,1,9,10,'2021-04-11 00:35:36','2021-04-11 00:35:36',NULL,NULL,0),(35,3,99,91,1,9,10,'2021-04-11 01:21:31','2021-04-11 01:21:31',NULL,NULL,0),(36,3,100,92,1,10,9,'2021-04-11 18:37:26','2021-04-11 18:38:52',NULL,NULL,2),(37,3,101,93,1,8,10,'2021-04-12 01:54:19','2021-04-12 01:54:19',NULL,NULL,0),(38,3,102,94,1,7,9,'2021-04-12 17:11:59','2021-04-12 17:11:59',NULL,NULL,0),(39,3,103,95,1,9,10,'2021-04-13 01:23:52','2021-04-13 01:23:52',NULL,NULL,0),(40,2,106,96,1,5,5,'2021-04-14 19:01:25','2021-04-14 19:48:11',NULL,NULL,2);
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidoProdutoAdicionais`
--

DROP TABLE IF EXISTS `pedidoProdutoAdicionais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidoProdutoAdicionais` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pedido_produtos_id` bigint unsigned NOT NULL,
  `produtoAdicionais_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pedidoprodutoadicionais_pedido_produtos_id_foreign` (`pedido_produtos_id`),
  KEY `pedidoprodutoadicionais_produtoadicionais_id_foreign` (`produtoAdicionais_id`),
  CONSTRAINT `pedidoprodutoadicionais_pedido_produtos_id_foreign` FOREIGN KEY (`pedido_produtos_id`) REFERENCES `pedido_produtos` (`id`),
  CONSTRAINT `pedidoprodutoadicionais_produtoadicionais_id_foreign` FOREIGN KEY (`produtoAdicionais_id`) REFERENCES `produtoAdicionais` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidoProdutoAdicionais`
--

LOCK TABLES `pedidoProdutoAdicionais` WRITE;
/*!40000 ALTER TABLE `pedidoProdutoAdicionais` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidoProdutoAdicionais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido_produtos`
--

DROP TABLE IF EXISTS `pedido_produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedido_produtos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pedido_id` bigint unsigned NOT NULL,
  `produto_id` bigint unsigned NOT NULL,
  `quantidade` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedido_produtos_pedido_id_foreign` (`pedido_id`),
  KEY `pedido_produtos_produto_id_foreign` (`produto_id`),
  CONSTRAINT `pedido_produtos_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`),
  CONSTRAINT `pedido_produtos_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido_produtos`
--

LOCK TABLES `pedido_produtos` WRITE;
/*!40000 ALTER TABLE `pedido_produtos` DISABLE KEYS */;
INSERT INTO `pedido_produtos` VALUES (27,27,13,1,'2021-04-10 17:52:03','2021-04-10 17:52:03',NULL),(28,27,6,1,'2021-04-10 17:52:03','2021-04-10 17:52:03',NULL),(29,27,8,2,'2021-04-10 17:52:03','2021-04-10 17:52:03',NULL),(30,28,13,1,'2021-04-10 18:08:04','2021-04-10 18:08:04',NULL),(31,28,6,1,'2021-04-10 18:08:04','2021-04-10 18:08:04',NULL),(32,28,8,2,'2021-04-10 18:08:04','2021-04-10 18:08:04',NULL),(33,29,10,2,'2021-04-10 18:08:27','2021-04-10 18:08:27',NULL),(34,29,13,1,'2021-04-10 18:08:27','2021-04-10 18:08:27',NULL),(35,29,6,1,'2021-04-10 18:08:27','2021-04-10 18:08:27',NULL),(36,29,8,2,'2021-04-10 18:08:27','2021-04-10 18:08:27',NULL),(37,30,10,1,'2021-04-10 18:25:03','2021-04-10 18:25:03',NULL),(38,31,10,3,'2021-04-10 20:06:46','2021-04-10 20:06:46',NULL),(39,31,11,1,'2021-04-10 20:06:46','2021-04-10 20:06:46',NULL),(40,31,7,1,'2021-04-10 20:06:46','2021-04-10 20:06:46',NULL),(41,31,8,1,'2021-04-10 20:06:46','2021-04-10 20:06:46',NULL),(42,32,10,1,'2021-04-10 21:59:41','2021-04-10 21:59:41',NULL),(43,32,12,1,'2021-04-10 21:59:41','2021-04-10 21:59:41',NULL),(44,32,7,2,'2021-04-10 21:59:41','2021-04-10 21:59:41',NULL),(45,32,10,1,'2021-04-10 21:59:41','2021-04-10 21:59:41',NULL),(46,32,11,1,'2021-04-10 21:59:41','2021-04-10 21:59:41',NULL),(47,32,12,1,'2021-04-10 21:59:41','2021-04-10 21:59:41',NULL),(48,32,7,2,'2021-04-10 21:59:41','2021-04-10 21:59:41',NULL),(49,33,15,1,'2021-04-10 23:40:17','2021-04-10 23:40:17',NULL),(50,33,19,1,'2021-04-10 23:40:17','2021-04-10 23:40:17',NULL),(51,33,22,1,'2021-04-10 23:40:17','2021-04-10 23:40:17',NULL),(52,33,23,1,'2021-04-10 23:40:17','2021-04-10 23:40:17',NULL),(53,34,20,1,'2021-04-11 00:35:36','2021-04-11 00:35:36',NULL),(54,34,15,1,'2021-04-11 00:35:36','2021-04-11 00:35:36',NULL),(55,34,15,1,'2021-04-11 00:35:36','2021-04-11 00:35:36',NULL),(56,34,20,1,'2021-04-11 00:35:36','2021-04-11 00:35:36',NULL),(57,35,20,1,'2021-04-11 01:21:31','2021-04-11 01:21:31',NULL),(58,35,19,2,'2021-04-11 01:21:31','2021-04-11 01:21:31',NULL),(59,35,20,1,'2021-04-11 01:21:31','2021-04-11 01:21:31',NULL),(60,35,21,1,'2021-04-11 01:21:31','2021-04-11 01:21:31',NULL),(61,36,23,2,'2021-04-11 18:37:26','2021-04-11 18:37:26',NULL),(62,36,21,1,'2021-04-11 18:37:26','2021-04-11 18:37:26',NULL),(63,36,23,2,'2021-04-11 18:37:26','2021-04-11 18:37:26',NULL),(64,37,15,1,'2021-04-12 01:54:19','2021-04-12 01:54:19',NULL),(65,37,15,1,'2021-04-12 01:54:19','2021-04-12 01:54:19',NULL),(66,37,16,1,'2021-04-12 01:54:19','2021-04-12 01:54:19',NULL),(67,38,20,2,'2021-04-12 17:11:59','2021-04-12 17:11:59',NULL),(68,38,20,2,'2021-04-12 17:11:59','2021-04-12 17:11:59',NULL),(69,39,21,1,'2021-04-13 01:23:52','2021-04-13 01:23:52',NULL),(70,39,22,1,'2021-04-13 01:23:52','2021-04-13 01:23:52',NULL),(71,40,25,1,'2021-04-14 19:01:25','2021-04-14 19:01:25',NULL),(72,40,27,1,'2021-04-14 19:01:25','2021-04-14 19:01:25',NULL);
/*!40000 ALTER TABLE `pedido_produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personalizacao_loja`
--

DROP TABLE IF EXISTS `personalizacao_loja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personalizacao_loja` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `informacao_loja_id` bigint unsigned NOT NULL,
  `cor1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cor2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `personalizacao_loja_informacao_loja_id_foreign` (`informacao_loja_id`),
  CONSTRAINT `personalizacao_loja_informacao_loja_id_foreign` FOREIGN KEY (`informacao_loja_id`) REFERENCES `informacao_loja` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personalizacao_loja`
--

LOCK TABLES `personalizacao_loja` WRITE;
/*!40000 ALTER TABLE `personalizacao_loja` DISABLE KEYS */;
INSERT INTO `personalizacao_loja` VALUES (1,1,'#8c8c8c','#5b78e0','/storage/images/banner1.png','/storage/images/banner2.png','/storage/images/logo.jpg','/storage/images/capa.jpg','2021-03-27 19:02:09','2021-03-27 19:02:09',NULL),(2,2,'#911245','#154fc1','images/iwd8LnuuX5YCb4z3Qw0DjWNkER6pmkMUVAIx6QLH.jpg','/storage/images/banner2.png','images/NnvfQBtC2ogcryWUrEho0FzYALUkqVL5KhOXPk5m.jpeg','/storage/images/capa.jpg','2021-03-28 15:48:30','2021-04-17 22:54:21',NULL),(3,3,'#8c8c8c','#5b78e0','/storage/images/banner1.png','/storage/images/banner2.png','/storage/images/logo.jpg','/storage/images/capa.jpg','2021-04-10 22:43:52','2021-04-10 22:43:52',NULL),(4,4,'#8c8c8c','#5b78e0','/storage/images/banner1.png','/storage/images/banner2.png','/storage/images/logo.jpg','/storage/images/capa.jpg','2021-04-13 02:19:57','2021-04-13 02:19:57',NULL),(5,5,'#8c8c8c','#5b78e0','/storage/images/banner1.png','/storage/images/banner2.png','/storage/images/logo.jpg','/storage/images/capa.jpg','2021-04-14 18:53:23','2021-04-14 18:53:23',NULL);
/*!40000 ALTER TABLE `personalizacao_loja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtoAdicionais`
--

DROP TABLE IF EXISTS `produtoAdicionais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produtoAdicionais` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `produto_id` bigint unsigned NOT NULL,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produtoadicionais_produto_id_foreign` (`produto_id`),
  CONSTRAINT `produtoadicionais_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtoAdicionais`
--

LOCK TABLES `produtoAdicionais` WRITE;
/*!40000 ALTER TABLE `produtoAdicionais` DISABLE KEYS */;
INSERT INTO `produtoAdicionais` VALUES (1,6,'bacon','4','0',NULL,'2021-04-19 04:02:47','2021-04-19 04:02:47'),(2,6,'cheddar','3','0',NULL,'2021-04-19 04:02:47','2021-04-19 04:02:47'),(3,38,'Ovomaltine','3.00','0',NULL,'2021-04-21 12:39:28','2021-04-21 12:39:28'),(4,38,'Sensação','3.00','0',NULL,'2021-04-21 12:39:28','2021-04-21 12:39:28'),(5,38,'Chocolate Branco','3.00','0',NULL,'2021-04-21 12:39:28','2021-04-21 12:39:28'),(6,38,'Maracujá ','3.00','0',NULL,'2021-04-21 12:39:28','2021-04-21 12:39:28'),(7,9,'Ovomaltine','1.67','0','2021-04-22 01:30:52','2021-04-21 12:42:06','2021-04-22 01:30:52'),(8,9,'Sensação','1.67','0','2021-04-22 01:30:52','2021-04-21 12:42:06','2021-04-22 01:30:52'),(9,9,'Chocolate Branco','1.67','0','2021-04-22 01:30:52','2021-04-21 12:42:06','2021-04-22 01:30:52'),(10,9,'Maracujá ','1.67','0','2021-04-22 01:30:52','2021-04-21 12:42:06','2021-04-22 01:30:52'),(11,9,'Ovomaltine','0.00','0',NULL,'2021-04-22 01:30:52','2021-04-22 01:30:52'),(12,9,'Sensação ','0.00','0',NULL,'2021-04-22 01:30:52','2021-04-22 01:30:52'),(13,9,'Chocolate Branco ','0.00','0',NULL,'2021-04-22 01:30:52','2021-04-22 01:30:52'),(14,9,'Maracujá','0.00','0',NULL,'2021-04-22 01:30:52','2021-04-22 01:30:52'),(15,39,'Maracujá','0.00','0',NULL,'2021-04-25 14:48:33','2021-04-25 14:48:33'),(16,39,'Coco','0.00','0',NULL,'2021-04-25 14:48:33','2021-04-25 14:48:33');
/*!40000 ALTER TABLE `produtoAdicionais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produtos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `categoria_produtos_id` bigint unsigned NOT NULL,
  `titulo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preco` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `ativo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promocao` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mais_vendido` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produtos_categoria_produtos_id_foreign` (`categoria_produtos_id`),
  CONSTRAINT `produtos_categoria_produtos_id_foreign` FOREIGN KEY (`categoria_produtos_id`) REFERENCES `categoria_produtos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,4,'Hamburguer Especial','Hamburguer Simples','7.00','2021-03-27 19:21:11','2021-03-28 17:25:15','2021-03-28 17:25:15','on','off','off','images/mx4LvwfflCKtBWE6ciZXvjdkydXG8Uvve84UmDS0.webp'),(2,4,'X-TUDO','X-TUDO','12.00','2021-03-27 19:21:30','2021-03-28 17:25:18','2021-03-28 17:25:18','on','off','off','images/W94DfdLVAs4eVQIfdvIh1leRvUY1u1rEx6UXObiE.webp'),(3,5,'Coca Cola Lata','Coca cola lata','6.00','2021-03-28 00:47:19','2021-04-01 00:12:09','2021-04-01 00:12:09','on','off','off','images/m9375g7IYlDtelqeLZLmqIQc2PNqkPI8vIghkmrV.jpg'),(4,5,'Água','água','3.00','2021-03-28 00:49:31','2021-04-01 00:12:12','2021-04-01 00:12:12','on','off','off','images/3DUl60ETLocUZKaobhlBxy8x6OmFXyiwen0hwzTB.jpg'),(5,4,'X-Filé','X-FIlé','13.00','2021-03-28 03:03:25','2021-03-28 17:25:20','2021-03-28 17:25:20','on','off','off','images/mmRXvmuksv3fr8hoC58KksiIiYsdOouyKg8obXOg.webp'),(6,8,'El Tradicional','Pão Francês, toscana na brasa e molho chimichurri','5.00','2021-03-28 17:28:31','2021-04-10 17:47:17',NULL,'on','on','off','images/YPbL53Qn9x2PcHyojs5iBrfCGYe88ZudMflgVE07.webp'),(7,8,'El Tradicional MINI BAGUETE','Mini baguete, toscana na brasa e molho chimichurri','12.00','2021-03-28 17:31:03','2021-04-10 17:47:06',NULL,'on','off','on','images/qHzjyw9NJ3Pzm0Quxic2HVr9SWRBxyPqr7AstH1N.webp'),(8,8,'El Tradicional BAGUETE','Baguete, toscana na brasa e molho','16.00','2021-03-28 17:33:26','2021-03-28 17:40:30',NULL,'on','off','off','images/MTmGtVmJ08OBly7zxSxiDslUSMZokZpRdpKQclKs.webp'),(9,6,'Bolo de Pote','Até 3 sabores','5.00','2021-03-28 17:54:15','2021-04-22 01:27:30',NULL,'on','off','on','images/Wc0yLSrrYzm3KEt851I1fX1DrQic1qG3HlQWn5Ad.jpeg'),(10,5,'Coca-Cola em Lata','Coca-Cola em Lata','3.99','2021-04-01 00:16:05','2021-04-10 20:53:48',NULL,'on','off','on','images/MtMvAEwZ3ibX1kZ6Nbv1jFrjOgbln8TuvZE2Dzu1.jpg'),(11,5,'Fanta Laranja em Lata','Fanta Laranja em Lata','4.99','2021-04-01 00:18:06','2021-04-01 00:21:43',NULL,'on','off','off','images/Tnrlfptjmg4maZ7KiQeLCzkaRKluomrFiS6GJl1a.jpg'),(12,5,'Coca-Cola 1 Litro','Coca-Cola 1 Litro','6.99','2021-04-01 00:19:20','2021-04-10 20:54:24',NULL,'on','off','on','images/0dB1SmVKcjElDNgkI866Gg8A6oAkKnYXFGdqGz0Q.jpg'),(13,5,'Guaraná Garoto 990ml','Guaraná Garoto 990ml','4.99','2021-04-01 00:20:41','2021-04-10 20:54:08',NULL,'on','on','off','images/sk2nYtDQPkKsD3xswKMyEKBaPrVffenXe6qdJv0d.jpg'),(14,6,'Coxinha de Macaxeira 100g','Sabores: frango e peito de peru','4.00','2021-04-03 01:49:21','2021-04-12 15:54:08','2021-04-12 15:54:08','off','off','off','images/0E1m74C8y26wNeWxffh4TnqNXaiPfMT1YnpnPNPo.png'),(15,9,'Bolo no Pote Danoninho','mousse de morango com geleia de morango caseira 250ml','9.00','2021-04-10 22:48:27','2021-04-10 23:41:22',NULL,'on','on','off','images/9Y8J0IfD7evSwiCVbpAZ5EzoPUc8BuK6oNkIHqYa.jpg'),(16,9,'Bolo no pote Café Cremoso','Inédito 250ml','8.00','2021-04-10 22:51:59','2021-04-10 23:38:20',NULL,'on','off','off','images/BDhXEq6ZdB2d6B0qZ9eyZsJBquhQd71olGCyub0A.jpg'),(17,9,'Copo Mousse brownie napolitano','Copo Mousse brownie napolitano','13.00','2021-04-10 22:53:37','2021-04-10 23:08:49','2021-04-10 23:08:49','on','off','off','images/iD2L7T8pVqoGDBnmKuMC0D8n97RgTmnmZsqsH20S.jpg'),(18,9,'Bolo no pote Ninho Duplo','Inédito 250ml','10.00','2021-04-10 23:12:25','2021-04-10 23:38:38',NULL,'on','off','off','images/m4kiesGg1LySLDKprJo731G9D6SkPGgQop6AgZnf.jpg'),(19,9,'Bolo no pote Napolitano','Classico 250ml','10.00','2021-04-10 23:13:26','2021-04-10 23:38:54',NULL,'on','off','off','images/ERmXkVUN27nERXYSr84ggtmH4tJn9ZCIJasCfc1O.jpg'),(20,9,'Copo Mousse Brownie Napolitano','330ml','13.00','2021-04-10 23:28:41','2021-04-10 23:41:29',NULL,'on','off','on','images/oplCgktYiAXIHKgG6Ws5ijUIzgN7T9DFsuKFAfWH.jpg'),(21,9,'Browninho no pote','330ml','11.00','2021-04-10 23:31:37','2021-04-10 23:31:37',NULL,'on','off','off','images/RZjCLTmVIJN90deZojCwfDTiIkPIwUb8BkGpPIxy.jpg'),(22,9,'Pote da Felicidade','330ml','12.00','2021-04-10 23:32:24','2021-04-10 23:32:24',NULL,'on','off','off','images/h6ss2VHqTuIdr3yly0GQcnbsH9aQw5X4jYiaVXKi.jpg'),(23,9,'Brownie Casadinho','330ml','11.00','2021-04-10 23:33:05','2021-04-10 23:41:32',NULL,'on','off','on','images/Ddb4FdGRooruxr2t81BdiwoOxMKnUdD6ypMuHzxT.jpg'),(24,6,'Pastel não de vento 4i20 (60g)','Frango','5.00','2021-04-12 16:04:40','2021-04-21 12:33:26',NULL,'on','off','on','images/w1KyYZbba8U78lg0QuhJR7b3SkcrPT44Nu19oB8s.jpeg'),(25,6,'Suco Natural (200ml)','Laranja ou Abacaxi','3.00','2021-04-12 16:11:14','2021-04-21 12:33:51',NULL,'on','off','off','images/PWPuxkJi0TpdWTXDHjPyKFvIN0yb8P582UO567m0.jpeg'),(26,6,'QUAL QUER HORA DO DIA','1 PASTEL 1 SULCO NATURAL (200ml ABACAXI - LARANJA) 1 BOLO DE POTE','10.00','2021-04-12 21:34:21','2021-04-12 21:35:34','2021-04-12 21:35:34','on','off','off',NULL),(27,6,'Nana do Guaraná (200ml)','Refrigerante','3.00','2021-04-12 21:40:15','2021-04-21 12:34:26',NULL,'off','off','off','images/DlHPO09oKMJIdzcVnWAWyllTd6sjIHffrEuwPGmY.jpeg'),(28,11,'Filé de frango','Arroz,feijão,salada','12','2021-04-14 18:55:29','2021-04-14 18:55:35',NULL,'on','on','on','images/v2VXgyIEKWsFxm4YT9slZKzsiKTvIf6qrwE15FiK.jpg'),(29,13,'CARIMBO 4911 AUTOMÁTICO','1 TAMPA','90.00','2021-04-18 00:24:00','2021-04-18 00:25:30',NULL,'on','off','off','images/GlRVgoUF3lfur1TUygFu9hTAN8aO7lTGwn5o5VQd.png'),(30,6,'Combo Pensador Moderno','1 Pastel 1 Bolo de Pote 1 Sulco Natural','10.00','2021-04-18 16:09:39','2021-04-25 14:49:43',NULL,'off','off','off','images/cN8PnSYTzqlRdAkU0vBM8YFOlaZs0V91XqefrT0S.jpeg'),(31,13,'CARIMBO 4911 AUTOMÁTICO','Sem tampa','80.00','2021-04-18 17:43:37','2021-04-18 17:43:37',NULL,'on','off','off','images/VyFXj9pNm4ChPqTF80WDwceS6KmMdug3zMlif5jE.jpeg'),(32,13,'CARIMBO 4911 AUTOMÁTICO DE BOLSO','Não suja e cabe no bolso.','100.00','2021-04-18 17:49:09','2021-04-18 17:49:46',NULL,'on','off','off','images/Zng9HTY3z1Hta2IW4uja4IONOpsj6qBgWD6Sm8Ry.png'),(33,13,'CARIMBO SIMPLES 4X1.5','Manual, precisa de uma almofada externa para utilizar.','45.00','2021-04-18 18:02:05','2021-04-18 18:02:05',NULL,'on','off','off','images/bnOcEq5Qi0UL5bZWwJiSBtZ4uaKhqnCrbYCwZ9HZ.png'),(34,13,'ALMOFADA DE TINTA','Azul ou Preto','40.00','2021-04-18 18:19:57','2021-04-18 18:19:57',NULL,'on','off','off','images/hBvG9FPQrGAl99dP0As45imsLeJNpi4cU3dAoDp6.png'),(35,13,'CARIMBO 3911 AUTOMÁTICO','Média/Boa Qualidade (Máquina)','75.00','2021-04-18 18:33:33','2021-04-18 18:33:33',NULL,'on','off','off','images/opATBtgAIoFppo6cdyJv9mFkSLFG94LAeDapjwBH.jpeg'),(36,13,'CARIMBO SIMPLES 6,5X4','CARIMBO PARA SACOLA DE PAPEL (LOGO)','90.00','2021-04-19 04:10:11','2021-04-19 04:10:11',NULL,'on','off','off','images/vFzcE69niHGQqMa2DDVUvXAd0103BGJRhXW359nF.png'),(37,6,'Coca-Cola 200ml','Refrigerante','3.00','2021-04-21 12:35:49','2021-04-21 12:36:11',NULL,'on','off','on','images/xNByZvT0RQO1txHKo1Kn5NWLUOKun2WWHm5OBLvW.jpeg'),(38,6,'Pote de Creme','Sabor Único','0.00','2021-04-21 12:39:28','2021-04-21 12:39:28',NULL,'on','off','off','images/N2NLNGg81jdSKLxvQar8Ij96uAQkXAruCG9ieQyb.jpeg'),(39,6,'Chopp de Frutas da Dona Nira','Feito com muito carinho','3.00','2021-04-25 14:48:33','2021-04-25 14:48:33',NULL,'on','off','off','images/ciVkyoNXmgN08p5OVhP0LBnaHkYgYxXcvF9PT8A9.jpeg');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `whatsapp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `papel` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'eduardo','eduardo.worrel@gmail.com',NULL,'$2y$10$exiu9.jcCdcM9yfKvCg4/.PhbKBu75UkTCMhEje.vap6M8RgZ9mZu',NULL,'2021-03-27 19:02:09','2021-03-27 19:02:09','67992989389','02296273238','logista',NULL),(2,'eduardo worrel','eduardo worrel12675',NULL,'none',NULL,'2021-03-28 04:36:51','2021-03-28 04:36:51','969929893949','eduardo worrel','cliente',NULL),(3,'eduardo worrel','eduardo worrel14554',NULL,'none',NULL,'2021-03-28 04:36:53','2021-03-28 04:36:53','969929893949','eduardo worrel','cliente',NULL),(4,'eduardo worrel','eduardo worrel4889',NULL,'none',NULL,'2021-03-28 04:36:54','2021-03-28 04:36:54','969929893949','eduardo worrel','cliente',NULL),(5,'eduardo worrel','eduardo worrel12278',NULL,'none',NULL,'2021-03-28 04:36:54','2021-03-28 04:36:54','969929893949','eduardo worrel','cliente',NULL),(6,'eduardo worrel','eduardo worrel25343',NULL,'none',NULL,'2021-03-28 04:36:54','2021-03-28 04:36:54','969929893949','eduardo worrel','cliente',NULL),(7,'eduardo worrel','eduardo worrel16440',NULL,'none',NULL,'2021-03-28 04:36:54','2021-03-28 04:36:54','969929893949','eduardo worrel','cliente',NULL),(8,'eduardo worrel','eduardo worrel34506',NULL,'none',NULL,'2021-03-28 04:36:55','2021-03-28 04:36:55','969929893949','eduardo worrel','cliente',NULL),(9,'eduardo worrel','eduardo worrel31925',NULL,'none',NULL,'2021-03-28 04:36:55','2021-03-28 04:36:55','969929893949','eduardo worrel','cliente',NULL),(10,'eduardo worrel','eduardo worrel33160',NULL,'none',NULL,'2021-03-28 04:39:03','2021-03-28 04:39:03','67992939800','eduardo worrel','cliente',NULL),(11,'eduardo worrel','eduardo worrel18942',NULL,'none',NULL,'2021-03-28 04:42:18','2021-03-28 04:42:18','67992939800','eduardo worrel','cliente',NULL),(12,'eduardo worrel','eduardo worrel6600',NULL,'none',NULL,'2021-03-28 04:43:25','2021-03-28 04:43:25','67992939800','eduardo worrel','cliente',NULL),(13,'eduardo worrel','eduardo worrel38487',NULL,'none',NULL,'2021-03-28 04:44:29','2021-03-28 04:44:29','67992939800','eduardo worrel','cliente',NULL),(14,'eduardo worrel','eduardo worrel7838',NULL,'none',NULL,'2021-03-28 04:52:32','2021-03-28 04:52:32','67992939800','eduardo worrel','cliente',NULL),(15,'eduardo worrel','eduardo worrel8339',NULL,'none',NULL,'2021-03-28 04:55:04','2021-03-28 04:55:04','67992939800','eduardo worrel','cliente',NULL),(16,'eduardo worrel','eduardo worrel27439',NULL,'none',NULL,'2021-03-28 04:59:07','2021-03-28 04:59:07','67992939800','eduardo worrel','cliente',NULL),(17,'eduardo worrel','eduardo worrel23937',NULL,'none',NULL,'2021-03-28 05:01:10','2021-03-28 05:01:10','67992939800','eduardo worrel','cliente',NULL),(18,'eduardo worrel','eduardo worrel2209',NULL,'none',NULL,'2021-03-28 05:07:26','2021-03-28 05:07:26','67992939800','eduardo worrel','cliente',NULL),(19,'eduardo worrel','eduardo worrel2944',NULL,'none',NULL,'2021-03-28 05:08:23','2021-03-28 05:08:23','67992939800','eduardo worrel','cliente',NULL),(20,'eduardo worrel','eduardo worrel37353',NULL,'none',NULL,'2021-03-28 05:08:30','2021-03-28 05:08:30','67992939800','eduardo worrel','cliente',NULL),(21,'daniel araujo','daniel araujo37834',NULL,'none',NULL,'2021-03-28 14:55:58','2021-03-28 14:55:58','991996310','daniel araujo','cliente',NULL),(22,'daniel araujo','daniel araujo40752',NULL,'none',NULL,'2021-03-28 14:56:04','2021-03-28 14:56:04','991996310','daniel araujo','cliente',NULL),(23,'daniel araujo','daniel araujo33879',NULL,'none',NULL,'2021-03-28 14:56:20','2021-03-28 14:56:20','991996310','daniel araujo','cliente',NULL),(24,'daniel araujo','daniel araujo14128',NULL,'none',NULL,'2021-03-28 14:56:21','2021-03-28 14:56:21','991996310','daniel araujo','cliente',NULL),(25,'daniel araujo','daniel araujo2885',NULL,'none',NULL,'2021-03-28 14:56:31','2021-03-28 14:56:31','991996310','daniel araujo','cliente',NULL),(26,'daniel araujo','daniel araujo10143',NULL,'none',NULL,'2021-03-28 14:56:31','2021-03-28 14:56:31','991996310','daniel araujo','cliente',NULL),(27,'daniel araujo','daniel araujo29882',NULL,'none',NULL,'2021-03-28 14:59:24','2021-03-28 14:59:24','991996310','daniel araujo','cliente',NULL),(28,'daniel araujo','daniel araujo24148',NULL,'none',NULL,'2021-03-28 14:59:27','2021-03-28 14:59:27','991996310','daniel araujo','cliente',NULL),(29,'daniel araujo','daniel araujo20927',NULL,'none',NULL,'2021-03-28 14:59:28','2021-03-28 14:59:28','991996310','daniel araujo','cliente',NULL),(30,'daniel araujo','daniel araujo17111',NULL,'none',NULL,'2021-03-28 14:59:29','2021-03-28 14:59:29','991996310','daniel araujo','cliente',NULL),(31,'daniel araujo','daniel araujo17531',NULL,'none',NULL,'2021-03-28 15:00:25','2021-03-28 15:00:25','991996310','daniel araujo','cliente',NULL),(32,'daniel araujo','daniel araujo25293',NULL,'none',NULL,'2021-03-28 15:00:28','2021-03-28 15:00:28','991996310','daniel araujo','cliente',NULL),(33,'daniel araujo','daniel araujo17123',NULL,'none',NULL,'2021-03-28 15:00:28','2021-03-28 15:00:28','991996310','daniel araujo','cliente',NULL),(34,'daniel araujo','daniel araujo34593',NULL,'none',NULL,'2021-03-28 15:00:28','2021-03-28 15:00:28','991996310','daniel araujo','cliente',NULL),(35,'Lukas Sitta','lukassittapsi_98@outlook.com',NULL,'$2y$10$zd/q7igk1BwuAXehwvSOS.iESaDlYoPK.hhHeCGqQk6aSlL4OJete','XP6eBSJ5iEd4vWEn8xlPqZBEQju9PQ3FR1vwoeSWZRR0tjmRFXeU17FWBlCO','2021-03-28 15:48:30','2021-03-28 15:48:30','96988093034','00122040210','logista',NULL),(36,'Daniel Araújo dos santos','Daniel Araújo dos santos28758',NULL,'none',NULL,'2021-03-28 18:59:12','2021-03-28 18:59:12','96991996310','Daniel Araújo dos santos','cliente',NULL),(37,'Eduardo Worrel','Eduardo Worrel32828',NULL,'none',NULL,'2021-03-28 19:09:59','2021-03-28 19:09:59','67992989389','Eduardo Worrel','cliente',NULL),(38,'Eduardo Worrel','Eduardo Worrel29587',NULL,'none',NULL,'2021-03-28 19:10:05','2021-03-28 19:10:05','67992989389','Eduardo Worrel','cliente',NULL),(39,'Eduardo worrel','Eduardo worrel23808',NULL,'none',NULL,'2021-03-28 19:11:48','2021-03-28 19:11:48','67992989389','Eduardo worrel','cliente',NULL),(40,'Eduardo worrel','Eduardo worrel19386',NULL,'none',NULL,'2021-03-28 19:11:50','2021-03-28 19:11:50','67992989389','Eduardo worrel','cliente',NULL),(41,'Eduardo worrel','Eduardo worrel28504',NULL,'none',NULL,'2021-03-28 19:11:50','2021-03-28 19:11:50','67992989389','Eduardo worrel','cliente',NULL),(42,'Eduardo worrel','Eduardo worrel4673',NULL,'none',NULL,'2021-03-28 19:11:50','2021-03-28 19:11:50','67992989389','Eduardo worrel','cliente',NULL),(43,'Eduardo worrel','Eduardo worrel30983',NULL,'none',NULL,'2021-03-28 19:11:51','2021-03-28 19:11:51','67992989389','Eduardo worrel','cliente',NULL),(44,'Eduardo worrel','Eduardo worrel27648',NULL,'none',NULL,'2021-03-28 19:11:51','2021-03-28 19:11:51','67992989389','Eduardo worrel','cliente',NULL),(45,'Eduardo worrel','Eduardo worrel37789',NULL,'none',NULL,'2021-03-28 19:11:53','2021-03-28 19:11:53','67992989389','Eduardo worrel','cliente',NULL),(46,'Eduardo worrel','Eduardo worrel28711',NULL,'none',NULL,'2021-03-28 19:11:53','2021-03-28 19:11:53','67992989389','Eduardo worrel','cliente',NULL),(47,'Eduardo worrel','Eduardo worrel6856',NULL,'none',NULL,'2021-03-28 19:11:53','2021-03-28 19:11:53','67992989389','Eduardo worrel','cliente',NULL),(48,'eduardo','eduardo35371',NULL,'none',NULL,'2021-03-28 19:20:28','2021-03-28 19:20:28','67992989389','eduardo','cliente',NULL),(49,'eduardo worrel','eduardo worrel21625',NULL,'none',NULL,'2021-03-28 19:26:06','2021-03-28 19:26:06','67992989389','eduardo worrel','cliente',NULL),(50,'eduardo worrel','eduardo worrel41394',NULL,'none',NULL,'2021-03-28 19:26:06','2021-03-28 19:26:06','67992989389','eduardo worrel','cliente',NULL),(51,'eduardo worrel','eduardo worrel8311',NULL,'none',NULL,'2021-03-28 19:26:12','2021-03-28 19:26:12','67992989389','eduardo worrel','cliente',NULL),(52,'eduardo worrel','eduardo worrel18344',NULL,'none',NULL,'2021-03-28 19:26:13','2021-03-28 19:26:13','67992989389','eduardo worrel','cliente',NULL),(53,'eduardo worrel','eduardo worrel12481',NULL,'none',NULL,'2021-03-28 19:26:14','2021-03-28 19:26:14','67992989389','eduardo worrel','cliente',NULL),(54,'eduardo worrel','eduardo worrel2501',NULL,'none',NULL,'2021-03-28 19:26:14','2021-03-28 19:26:14','67992989389','eduardo worrel','cliente',NULL),(55,'eduardo worrel','eduardo worrel22116',NULL,'none',NULL,'2021-03-28 19:26:14','2021-03-28 19:26:14','67992989389','eduardo worrel','cliente',NULL),(56,'eduardo worrel','eduardo worrel40088',NULL,'none',NULL,'2021-03-28 19:27:21','2021-03-28 19:27:21','67992989389','eduardo worrel','cliente',NULL),(57,'eduardo worrel','eduardo worrel40135',NULL,'none',NULL,'2021-03-28 19:27:21','2021-03-28 19:27:21','67992989389','eduardo worrel','cliente',NULL),(58,'eduardo worrel','eduardo worrel22712',NULL,'none',NULL,'2021-03-28 19:27:28','2021-03-28 19:27:28','67992989389','eduardo worrel','cliente',NULL),(59,'eduardo worrel','eduardo worrel21835',NULL,'none',NULL,'2021-03-28 19:31:20','2021-03-28 19:31:20','67992989389','eduardo worrel','cliente',NULL),(60,'eduardo','eduardo38910',NULL,'none',NULL,'2021-03-28 19:36:56','2021-03-28 19:36:56','67992989389','eduardo','cliente',NULL),(61,'eduardo','eduardo24164',NULL,'none',NULL,'2021-03-28 19:37:22','2021-03-28 19:37:22','67992989389','eduardo','cliente',NULL),(62,'eduardo','eduardo30204',NULL,'none',NULL,'2021-03-28 19:38:12','2021-03-28 19:38:12','67992989389','eduardo','cliente',NULL),(63,'eduardo','eduardo29598',NULL,'none',NULL,'2021-03-28 19:38:12','2021-03-28 19:38:12','67992989389','eduardo','cliente',NULL),(64,'eduardo','eduardo32037',NULL,'none',NULL,'2021-03-28 19:38:12','2021-03-28 19:38:12','67992989389','eduardo','cliente',NULL),(65,'eduardo','eduardo15152',NULL,'none',NULL,'2021-03-28 19:38:12','2021-03-28 19:38:12','67992989389','eduardo','cliente',NULL),(66,'eduardo','eduardo16855',NULL,'none',NULL,'2021-03-28 19:38:12','2021-03-28 19:38:12','67992989389','eduardo','cliente',NULL),(67,'eduardo','eduardo29183',NULL,'none',NULL,'2021-03-28 19:38:13','2021-03-28 19:38:13','67992989389','eduardo','cliente',NULL),(68,'eduardo','eduardo14406',NULL,'none',NULL,'2021-03-28 19:38:14','2021-03-28 19:38:14','67992989389','eduardo','cliente',NULL),(69,'eduardoworrel','eduardoworrel14075',NULL,'none',NULL,'2021-03-28 19:48:31','2021-03-28 19:48:31','67992989389','eduardoworrel','cliente',NULL),(70,'eduardo worrel','eduardo worrel8256',NULL,'none',NULL,'2021-03-28 19:56:18','2021-03-28 19:56:18','67992989389','eduardo worrel','cliente',NULL),(71,'eduardo worrel','eduardo worrel27830',NULL,'none',NULL,'2021-03-28 20:10:40','2021-03-28 20:10:40','67992989389','eduardo worrel','cliente',NULL),(72,'eduardo worrel','eduardo worrel34218',NULL,'none',NULL,'2021-03-28 20:18:51','2021-03-28 20:18:51','67992989389','eduardo worrel','cliente',NULL),(73,'eduardo worrel','eduardo worrel17545',NULL,'none',NULL,'2021-03-28 20:30:32','2021-03-28 20:30:32','67992989389','eduardo worrel','cliente',NULL),(74,'eduardo worrel','eduardo worrel1612',NULL,'none',NULL,'2021-03-29 22:40:43','2021-03-29 22:40:43','67992989389','eduardo worrel','cliente',NULL),(75,'Patrícia','Patrícia29348',NULL,'none',NULL,'2021-03-29 22:50:41','2021-03-29 22:50:41','96981326062','Patrícia','cliente',NULL),(76,'Patrícia','Patrícia17034',NULL,'none',NULL,'2021-03-29 22:50:50','2021-03-29 22:50:50','96981326062','Patrícia','cliente',NULL),(77,'Patrícia','Patrícia18234',NULL,'none',NULL,'2021-03-29 22:51:02','2021-03-29 22:51:02','96981326062','Patrícia','cliente',NULL),(78,'Lukas Sitta','Lukas Sitta9539',NULL,'none',NULL,'2021-03-29 23:35:25','2021-03-29 23:35:25','96988093034','Lukas Sitta','cliente',NULL),(79,'Lukas Sitta','Lukas Sitta42142',NULL,'none',NULL,'2021-03-29 23:39:54','2021-03-29 23:39:54','96988093034','Lukas Sitta','cliente',NULL),(80,'Eduardo','Eduardo36405',NULL,'none',NULL,'2021-03-30 04:13:35','2021-03-30 04:13:35','9699999999','Eduardo','cliente',NULL),(81,'Daniel Araújo dos santos','Daniel Araújo dos santos9805',NULL,'none',NULL,'2021-03-30 18:27:01','2021-03-30 18:27:01','96991996310','Daniel Araújo dos santos','cliente',NULL),(82,'Lukas sitta','Lukas sitta9119',NULL,'none',NULL,'2021-03-30 20:40:21','2021-03-30 20:40:21','9688093034','Lukas sitta','cliente',NULL),(83,'Lukas sitta','Lukas sitta6026',NULL,'none',NULL,'2021-03-30 20:40:47','2021-03-30 20:40:47','9688093034','Lukas sitta','cliente',NULL),(84,'Eduardo Worrel','Eduardo Worrel33375',NULL,'none',NULL,'2021-03-31 02:59:43','2021-03-31 02:59:43','67992989389','Eduardo Worrel','cliente',NULL),(85,'Eduardo Worrel','Eduardo Worrel42231',NULL,'none',NULL,'2021-03-31 03:00:27','2021-03-31 03:00:27','67992989389','Eduardo Worrel','cliente',NULL),(86,'Eduardo Worrel','Eduardo Worrel7790',NULL,'none',NULL,'2021-03-31 03:07:08','2021-03-31 03:07:08','67992989389','Eduardo Worrel','cliente',NULL),(87,'Samia','Samia17463',NULL,'none',NULL,'2021-03-31 03:12:01','2021-03-31 03:12:01','96981482533','Samia','cliente',NULL),(88,'Eduardo Worrel','Eduardo Worrel37527',NULL,'none',NULL,'2021-04-10 17:52:03','2021-04-10 17:52:03','67992989389','Eduardo Worrel','cliente',NULL),(89,'Eduardo Worrel','Eduardo Worrel26224',NULL,'none',NULL,'2021-04-10 18:08:04','2021-04-10 18:08:04','67992989389','Eduardo Worrel','cliente',NULL),(90,'Eduardo Worrel','Eduardo Worrel42041',NULL,'none',NULL,'2021-04-10 18:08:27','2021-04-10 18:08:27','67992989389','Eduardo Worrel','cliente',NULL),(91,'Eduardo Worrel','Eduardo Worrel18933',NULL,'none',NULL,'2021-04-10 18:25:03','2021-04-10 18:25:03','67992989389','Eduardo Worrel','cliente',NULL),(92,'Clara','Clara35204',NULL,'none',NULL,'2021-04-10 20:06:46','2021-04-10 20:06:46','67999999999','Clara','cliente',NULL),(93,'Eduardo Worrel','Eduardo Worrel24709',NULL,'none',NULL,'2021-04-10 21:59:41','2021-04-10 21:59:41','67992989389','Eduardo Worrel','cliente',NULL),(96,'Ana Clara','anaclara@apl.com',NULL,'$2y$10$HBUEFnl/Y81JgHPmdGWIE.oGo3ZmPryuHpMP.royCkBWE3OSCqfXa',NULL,'2021-04-10 22:43:52','2021-04-10 22:43:52','11949168614','02296273238','logista',NULL),(97,'Eduardo Worrel','Eduardo Worrel9937',NULL,'none',NULL,'2021-04-10 23:40:17','2021-04-10 23:40:17','67992989389','Eduardo Worrel','cliente',NULL),(98,'Eduardo Worrel','Eduardo Worrel18714',NULL,'none',NULL,'2021-04-11 00:35:36','2021-04-11 00:35:36','67992989389','Eduardo Worrel','cliente',NULL),(99,'Eduardo Worrel','Eduardo Worrel21340',NULL,'none',NULL,'2021-04-11 01:21:31','2021-04-11 01:21:31','67992989389','Eduardo Worrel','cliente',NULL),(100,'Thiago','Thiago19566',NULL,'none',NULL,'2021-04-11 18:37:26','2021-04-11 18:37:26','96981489293','Thiago','cliente',NULL),(101,'Paulo','Paulo14115',NULL,'none',NULL,'2021-04-12 01:54:19','2021-04-12 01:54:19','096984141501','Paulo','cliente',NULL),(102,'maria eduarda tavares','maria eduarda tavares32846',NULL,'none',NULL,'2021-04-12 17:11:59','2021-04-12 17:11:59','32998054825','maria eduarda tavares','cliente',NULL),(103,'Eduardo Worrel','Eduardo Worrel5316',NULL,'none',NULL,'2021-04-13 01:23:52','2021-04-13 01:23:52','67992989389','Eduardo Worrel','cliente',NULL),(104,'maumau','mau@gmail.com',NULL,'$2y$10$ERcXbArg7LKvr/1VtLFGgOVFjeBq0r73duC7/cvt14Gzk/U83iYH6',NULL,'2021-04-13 02:19:57','2021-04-13 02:19:57','984365463','10310382050','logista',NULL),(105,'maria eduarda tavares','duardatavares@icloud.com',NULL,'$2y$10$9mHHnoAeZyQFnOf6ZmTaY.DcADFTu3/hPA3gR1pk0vrW1WLuhCNTy',NULL,'2021-04-14 18:53:23','2021-04-14 18:53:23','32998767888','02132563632','logista',NULL),(106,'maria eduarda tavares','maria eduarda tavares608',NULL,'none',NULL,'2021-04-14 19:01:25','2021-04-14 19:01:25','32998054825','maria eduarda tavares','cliente',NULL),(107,'Jacenira Sitta','Jacenira Sitta17590',NULL,'none',NULL,'2021-04-18 16:06:17','2021-04-18 16:06:17','96991123651','Jacenira Sitta','cliente',NULL);
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

-- Dump completed on 2021-04-25 20:42:06
