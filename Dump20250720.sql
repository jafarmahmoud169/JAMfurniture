CREATE DATABASE IF NOT EXISTS `jamfurniture`
/*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */
/*!80016 DEFAULT ENCRYPTION='N' */
;
USE `jamfurniture`;
-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: jamfurniture
-- ------------------------------------------------------
-- Server version	8.0.34
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!50503 SET NAMES utf8 */
;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */
;
/*!40103 SET TIME_ZONE='+00:00' */
;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */
;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */
;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */
;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */
;
--
-- Table structure for table `categories`
--
DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 29 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `categories`
--
LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */
;
INSERT INTO `categories`
VALUES (
    8,
    'Bedroom',
    '2024-05-06 08:35:47',
    '2024-05-06 08:35:47'
  ),
(
    9,
    'Dining',
    '2024-05-06 08:36:25',
    '2024-05-06 08:36:25'
  ),
(
    10,
    'Kitchen',
    '2024-05-06 08:36:57',
    '2024-05-06 08:36:57'
  ),
(
    11,
    'Outdoor',
    '2024-05-06 08:37:22',
    '2024-05-06 08:37:22'
  ),
(
    12,
    'Bathroom',
    '2024-05-06 08:37:46',
    '2024-05-06 08:37:46'
  ),
(
    13,
    'Living Room',
    '2024-05-06 08:38:12',
    '2024-05-06 08:38:12'
  ),
(
    14,
    'Chilldren Room',
    '2024-05-06 08:39:03',
    '2024-05-06 08:39:03'
  ),
(
    15,
    'Study Room',
    '2024-05-06 08:39:32',
    '2024-05-06 08:39:32'
  ),
(
    16,
    'Hallway',
    '2024-05-06 08:40:26',
    '2024-05-06 08:40:26'
  );
/*!40000 ALTER TABLE `categories` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `email_verification_codes`
--
DROP TABLE IF EXISTS `email_verification_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `email_verification_codes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expired_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 66 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `email_verification_codes`
--
LOCK TABLES `email_verification_codes` WRITE;
/*!40000 ALTER TABLE `email_verification_codes` DISABLE KEYS */
;
INSERT INTO `email_verification_codes`
VALUES (
    43,
    'jafarmahmoud535@gmassil.com',
    '468083',
    '2025-06-25 12:41:26',
    '2025-06-25 11:41:26',
    '2025-06-25 11:41:26'
  ),
(
    44,
    'jafarmahmoud535@gmhjkail.com',
    '111111',
    '2025-06-25 13:25:30',
    '2025-06-25 12:25:30',
    '2025-06-25 12:25:30'
  ),
(
    48,
    'jafarmahmoud535@gmtestail.com',
    '111111',
    '2025-06-26 09:04:13',
    '2025-06-26 08:04:13',
    '2025-06-26 08:04:13'
  ),
(
    49,
    'jafarmahmoud535@gmtesssstail.com',
    '111111',
    '2025-06-26 09:06:39',
    '2025-06-26 08:06:39',
    '2025-06-26 08:06:39'
  ),
(
    51,
    'jaafarmahmood4419@gmail.com',
    '111111',
    '2025-06-26 10:01:57',
    '2025-06-26 09:01:57',
    '2025-06-26 09:01:57'
  ),
(
    52,
    'jafarmahmoud535@gllmail.com',
    '111111',
    '2025-06-26 10:08:43',
    '2025-06-26 09:08:43',
    '2025-06-26 09:08:43'
  ),
(
    57,
    'jafarmahmoud532345678905@gmail.com',
    '111111',
    '2025-06-27 12:08:09',
    '2025-06-27 11:08:09',
    '2025-06-27 11:08:09'
  ),
(
    61,
    'hardlocas@gm1234567890ail.com',
    '111111',
    '2025-06-27 12:22:43',
    '2025-06-27 11:22:43',
    '2025-06-27 11:22:43'
  ),
(
    65,
    'hardlocas@gmail.com',
    '111111',
    '2025-07-10 20:06:42',
    '2025-07-10 19:56:42',
    '2025-07-10 19:56:42'
  );
/*!40000 ALTER TABLE `email_verification_codes` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `locations`
--
DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `locations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `building` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `apartment_number` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `more_details` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `locations_user_id_foreign` (`user_id`),
  CONSTRAINT `locations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 16 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `locations`
--
LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */
;
INSERT INTO `locations`
VALUES (
    12,
    'banias',
    'Alquatly street',
    '5',
    '2025-06-19 20:12:20',
    '2025-06-19 20:22:22',
    65,
    '2',
    NULL,
    NULL
  ),
(
    14,
    'banias',
    '4th street',
    '5',
    '2025-06-25 12:33:33',
    '2025-06-25 12:33:33',
    65,
    '2',
    NULL,
    NULL
  );
/*!40000 ALTER TABLE `locations` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `migrations`
--
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 29 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `migrations`
--
LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */
;
INSERT INTO `migrations`
VALUES (1, '2014_10_12_000000_create_users_table', 1),
(6, '2024_04_05_191819_create_categories_table', 3),
(7, '2024_04_09_201356_create_locations_table', 3),
(8, '2024_04_12_202943_create_products_table', 3),
(
    11,
    '2024_05_04_084925_create_email_verification_codes_table',
    4
  ),
(
    12,
    '2019_12_14_000001_create_personal_access_tokens_table',
    5
  ),
(24, '2024_04_13_193743_create_orders_table', 7),
(
    25,
    '2024_04_14_225522_create_order_items_table',
    7
  ),
(26, '2024_05_16_105837_create_payments_table', 7),
(27, '2025_06_17_190052_create_ratings_table', 8),
(
    28,
    '2025_07_13_233814_add_missing_fields_to_users_table',
    9
  );
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `order_items`
--
DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `quantity` int NOT NULL,
  `price` decimal(12, 2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 59 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `order_items`
--
LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */
;
INSERT INTO `order_items`
VALUES (
    9,
    3,
    1500000.00,
    '2025-06-20 09:18:51',
    '2025-06-20 09:18:51',
    13,
    6
  ),
(
    10,
    1,
    4000000.00,
    '2025-06-20 09:18:51',
    '2025-06-20 09:18:51',
    13,
    7
  ),
(
    53,
    2,
    2900000.00,
    '2025-06-20 17:27:31',
    '2025-06-20 17:27:31',
    37,
    1
  ),
(
    54,
    2,
    1400000.00,
    '2025-06-20 17:27:31',
    '2025-06-20 17:27:31',
    37,
    2
  ),
(
    57,
    2,
    2900000.00,
    '2025-07-10 19:29:13',
    '2025-07-10 19:29:13',
    39,
    1
  ),
(
    58,
    2,
    1400000.00,
    '2025-07-10 19:29:13',
    '2025-07-10 19:29:13',
    39,
    2
  );
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `orders`
--
DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `date_of_delivery` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum(
    'Unpaid',
    'Pending',
    'Deliverd',
    'Out for delivery',
    'Canceled',
    'Accepted'
  ) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unpaid',
  `total_price` decimal(13, 2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `location_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_location_id_foreign` (`location_id`),
  CONSTRAINT `orders_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 40 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `orders`
--
LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */
;
INSERT INTO `orders`
VALUES (
    13,
    '12/3/2025 , 11:15 AM',
    'Deliverd',
    8500000.00,
    '2025-06-20 09:18:51',
    '2025-06-20 20:22:12',
    65,
    12
  ),
(
    37,
    '12/3/2025 , 11:15 AM',
    'Unpaid',
    8600000.00,
    '2025-06-20 17:27:31',
    '2025-06-20 17:27:31',
    65,
    12
  ),
(
    39,
    '12/3/2025 , 11:15 AM',
    'Pending',
    8600000.00,
    '2025-07-10 19:29:13',
    '2025-07-10 20:05:07',
    71,
    12
  );
/*!40000 ALTER TABLE `orders` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `payments`
--
DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `payment_process_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `order_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_gateway` enum('Syriatel Cash', 'MTN Cash') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_user_id_foreign` (`user_id`),
  KEY `payments_order_id_foreign` (`order_id`),
  CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `payments`
--
LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */
;
INSERT INTO `payments`
VALUES (
    1,
    '345678908765',
    '0931414419',
    65,
    13,
    '2025-06-20 09:57:54',
    '2025-06-20 09:57:54',
    'Syriatel Cash'
  ),
(
    2,
    '345678908765',
    '0931414419',
    71,
    39,
    '2025-07-10 20:05:07',
    '2025-07-10 20:05:07',
    'Syriatel Cash'
  ),
(
    3,
    '345678908765',
    '0931414419',
    71,
    39,
    '2025-07-10 20:08:16',
    '2025-07-10 20:08:16',
    'Syriatel Cash'
  );
/*!40000 ALTER TABLE `payments` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `personal_access_tokens`
--
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`, `tokenable_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `personal_access_tokens`
--
LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */
;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `products`
--
DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `material` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colors` json DEFAULT NULL,
  `dimensions` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_trendy` tinyint(1) NOT NULL DEFAULT '0',
  `is_available` tinyint(1) NOT NULL DEFAULT '1',
  `price` decimal(10, 2) NOT NULL,
  `discount` decimal(8, 2) DEFAULT NULL,
  `amount` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 42 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `products`
--
LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */
;
INSERT INTO `products`
VALUES (
    1,
    'SLATTUM bed',
    'SLATTUM bed frame has soft upholstery and a padded headboard that complete the stylish and simple lines. Easy to like – and convenient to bring home thanks to the whole frame coming in a single package.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1714996633.SLATTUMbed.webp',
    1,
    1,
    3000000.00,
    100000.00,
    4,
    '2024-05-06 08:57:13',
    '2025-07-10 19:29:13',
    8
  ),
(
    2,
    'RAMNEFJÄLL Bed',
    'This upholstered bed frame makes your bedroom feel soft and warm. The curved headboard and piped edges create a classic look – and the entire cover is removable and machine washable.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1714996955.RAMNEFJÄLLBed.webp',
    0,
    1,
    1500000.00,
    100000.00,
    4,
    '2024-05-06 09:02:35',
    '2025-07-10 19:29:13',
    8
  ),
(
    3,
    'GLADSTAD upholstered bed',
    'GLADSTAD upholstered bed frame with bed storage boxes has a clean and modern design with a padded headboard and soft cover. The storage boxes are easy to roll in under the bed – for practical storage.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1714997330.GLADSTADupholsteredbed.webp',
    0,
    1,
    5000000.00,
    200000.00,
    10,
    '2024-05-06 09:08:50',
    '2025-07-10 18:40:47',
    8
  ),
(
    4,
    'TARVA bed',
    'TARVA bed frame has a simple design in white-stained pine – a timeless look that goes nicely with many styles and furniture. Add some pillows and lean against the headboard while reading or watching TV.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1714997536.TARVAbed.webp',
    1,
    1,
    500000.00,
    100000.00,
    10,
    '2024-05-06 09:12:16',
    '2025-07-10 18:59:20',
    8
  ),
(
    6,
    'KLEPPSTAD Wardrobe',
    'Simple and smart! When all you need is a wardrobe with all the basic functions. If storage space is still not enough, why not add another wardrobe from the KLEPPSTAD series?',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715001009.KLEPPSTADwardrobe.webp',
    0,
    1,
    1500000.00,
    0.00,
    10,
    '2024-05-06 10:10:09',
    '2025-06-20 17:12:17',
    8
  ),
(
    7,
    'BRIMNES Wardrobe',
    'Small spaces need smart storage. This wardrobe has a clothes rail for shirts and dresses, shelves for folded clothes, shoes and bags – and a mirror door too so you avoid needing to mount a separate mirror.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715001220.brimnes-wardrobe.webp',
    0,
    1,
    4000000.00,
    500000.00,
    10,
    '2024-05-06 10:13:40',
    '2025-06-20 17:12:17',
    8
  ),
(
    8,
    'PAX / FORSAND Wardrobe',
    'A wardrobe fit for the one that loves folding! A lot of shelving space for most things that can be folded, rolled up or just does not fit in drawers.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715001460.pax-forsand-wardrobe.webp',
    1,
    1,
    8000000.00,
    500000.00,
    10,
    '2024-05-06 10:17:40',
    '2024-05-06 10:17:40',
    8
  ),
(
    9,
    'PAX / HASVIK Wardrobe',
    'Keep it simple. Here`s a basic solution to get you started, and space for more interiors if you want to upgrade.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715001729.pax-hasvik-wardrobe.webp',
    0,
    1,
    6000000.00,
    100000.00,
    10,
    '2024-05-06 10:22:09',
    '2025-07-10 19:20:29',
    8
  ),
(
    10,
    'HAUGA Chest of 6 drawers',
    'Use in your bedroom or throughout the home, on its own or with other furniture in the HAUGA series. This wide chest of drawers has plenty of storage space – and the top is ideal for your finest things.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715002053.hauga-chest-of-6-drawers.webp',
    1,
    1,
    2500000.00,
    0.00,
    10,
    '2024-05-06 10:27:33',
    '2024-05-06 10:27:33',
    8
  ),
(
    11,
    'MALM Chest of 3 drawers',
    'A clean expression that fits right in, in the bedroom or wherever you place it. Smooth-running drawers and in a choice of finishes – pick your favourite. Psst! Please attach to the wall.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715002255.malm-chest-of-3-drawers.webp',
    0,
    1,
    1000000.00,
    100000.00,
    10,
    '2024-05-06 10:30:55',
    '2024-07-18 18:24:46',
    8
  ),
(
    12,
    'SONGESAND Chest of 6 drawers',
    'The classic design with panelled drawer fronts never goes out of style. Psst! Please attach to the wall.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715002368.songesand-chest-of-6-drawers.webp',
    0,
    1,
    3000000.00,
    100000.00,
    10,
    '2024-05-06 10:32:48',
    '2024-08-06 16:06:30',
    8
  ),
(
    13,
    'IKORNNESStanding mirror',
    'Tired in the morning? Then hang tomorrow’s outfit behind the mirror and allow yourself with a few more minutes under the covers. The soft shapes and warm ash veneer create a cosy feeling in the room.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715010285.ikornnes-standing-mirror.webp',
    0,
    1,
    500000.00,
    0.00,
    10,
    '2024-05-06 12:44:45',
    '2024-05-06 12:44:45',
    8
  ),
(
    14,
    'LINDBYN Mirror',
    'Tired in the morning? Then hang tomorrow’s outfit behind the mirror and allow yourself with a few more minutes under the covers. The soft shapes and warm ash veneer create a cosy feeling in the room.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715010438.lindbyn-mirror.webp',
    0,
    1,
    350000.00,
    0.00,
    10,
    '2024-05-06 12:47:18',
    '2024-05-06 12:47:18',
    8
  ),
(
    15,
    'LINDBYN Mirror',
    'RÅMEBO mirror has a gold-coloured frame with beautiful ornaments in a vintage style. The ornaments can easily be removed and put back for variation – either way, the mirror is an eye-catcher in your home.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715010540.ramebo-mirror.webp',
    0,
    1,
    600000.00,
    0.00,
    10,
    '2024-05-06 12:49:00',
    '2024-07-18 18:24:46',
    8
  ),
(
    16,
    'FRIHETEN Corner sofa-bed with storage',
    'After a good night’s sleep, you can effortlessly convert your bedroom or guest room into a living room again. The built-in storage is easy to access and spacious enough to stow bedding, books and PJs.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715012402.friheten-corner-sofa-bed-with-storage.webp',
    1,
    1,
    6000000.00,
    100000.00,
    10,
    '2024-05-06 13:20:02',
    '2024-05-06 13:20:02',
    13
  ),
(
    17,
    'KIVIK 3-seat sofa',
    'Cuddle up in the comfortable KIVIK sofa. The generous size, low armrests and pocket springs with foam that adapts to the body invites you and your guests to many hours of socialising and relaxation.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715012561.kivik-3-seat-sofa-tibbleby-beige.webp',
    0,
    1,
    5500000.00,
    0.00,
    10,
    '2024-05-06 13:22:41',
    '2024-05-06 13:22:41',
    13
  ),
(
    18,
    'GLOSTAD 2-seat sofa',
    'It should be easy to get a sofa and GLOSTAD sofa is easy to buy, bring home, assemble and live with. So you can enjoy more time and space to hang out with friends and family and do other important things.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715012723.glostad-2-seat-sofa.webp',
    1,
    1,
    2000000.00,
    0.00,
    10,
    '2024-05-06 13:25:23',
    '2024-05-06 13:25:23',
    13
  ),
(
    19,
    'EKTORP 3-seat sofa',
    'Our beloved EKTORP seating has a timeless design and wonderfully thick, comfy cushions. The covers are easy to change, so buy an extra cover - or two, and change according to mood or season.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715012842.ektorp-3-seat-sofa-hakebo.webp',
    1,
    1,
    6000000.00,
    0.00,
    10,
    '2024-05-06 13:27:22',
    '2024-05-06 13:27:22',
    13
  ),
(
    20,
    'VIMLE 4-seat sofa with chaise longue',
    'The VIMLE sofa series has sections that can be combined as you like into a customised solution for you and your home – and as your life changes, you can complete the sofa and let it change with you.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715013003.vimle-4-seat-sofa-with-chaise-longue-with-wide-armr.webp',
    0,
    1,
    10000000.00,
    500000.00,
    10,
    '2024-05-06 13:30:03',
    '2024-05-06 13:30:03',
    13
  ),
(
    22,
    'STOCKHOLM TV bench',
    'A TV bench in walnut veneer with simplicity in focus. A retro-classic for modern needs. Choose to keep the doors, or rather hatches, open or closed. When folded up, they disappear under the top panel.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715013519.stockholm-tv-bench.webp',
    0,
    1,
    4000000.00,
    0.00,
    10,
    '2024-05-06 13:38:39',
    '2024-05-06 13:38:39',
    13
  ),
(
    23,
    'FJÄLLBO TV bench',
    'Since the doors allow signals to get through from your remote control, your electronic equipment will get along well with FJÄLLBO. Probably you too – the open back makes it easy to manage cables.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715013665.fjaellbo-tv-bench.webp',
    1,
    1,
    3000000.00,
    0.00,
    10,
    '2024-05-06 13:41:05',
    '2024-05-06 13:41:05',
    13
  ),
(
    24,
    'BESTÅ TV storage combination',
    'BESTÅ TV storage combinations provide a home for your TV and storage for the gadgets you need for all the activities around it. Hide the clutter and display your favourite things in one magnificent combo!',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715013900.besta-tv-storage-combination-glass-doors.webp',
    0,
    1,
    4600000.00,
    100000.00,
    10,
    '2024-05-06 13:45:00',
    '2024-05-06 13:45:00',
    13
  ),
(
    25,
    'BESTÅ BURS TV bench, high-gloss',
    'BESTÅ TV bench provides a home for your TV and storage for the gadgets that belong to it. With spacious drawers there’s plenty of space to keep TV games and accessories organised. And it looks tidy too!',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715014156.besta-burs-tv-bench.webp',
    0,
    1,
    4000000.00,
    100000.00,
    10,
    '2024-05-06 13:49:16',
    '2024-05-06 13:49:16',
    13
  ),
(
    26,
    'VITTSJÖ Coffee table',
    'The simple design of this coffee table creates an open and airy expression. Durable and honest materials make it easy to live with too – and you will always have extra storage space on the shelf.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715014370.vittsjoe-coffee-table.webp',
    1,
    1,
    400000.00,
    0.00,
    10,
    '2024-05-06 13:52:50',
    '2024-05-06 13:52:50',
    13
  ),
(
    27,
    'LACK Coffee table',
    'LACK table in black-brown is easy to match with other furnishings. The honeycomb structured paper filling construction adds strength to the table while keeping it lightweight so it´s easy to move around.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715014466.lack-coffee-table.webp',
    0,
    1,
    500000.00,
    0.00,
    10,
    '2024-05-06 13:54:26',
    '2024-05-06 13:54:26',
    13
  ),
(
    28,
    'HOLMERUD Side table',
    'HOLMERUD side table has a distinctive architectural shape and practical storage spaces. It’s designed to stand snug along the length of your sofa’s armrest – but looks just as great against a wall!',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715014559.holmerud-side-table.webp',
    0,
    1,
    500000.00,
    0.00,
    10,
    '2024-05-06 13:55:59',
    '2024-05-06 13:55:59',
    13
  ),
(
    29,
    'VITTSJÖ Laptop stand',
    'Metal and tempered glass give this laptop stand an open and airy feel. Place it next to the sofa and ta-da! You suddenly have a stylish and comfortable home office.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715014670.vittsjoe-laptop-stand.webp',
    0,
    1,
    350000.00,
    0.00,
    10,
    '2024-05-06 13:57:50',
    '2024-05-06 13:57:50',
    13
  ),
(
    30,
    'HEMNES Glass-door cabinet',
    'Sustainable beauty from sustainably-sourced solid pine, a natural and renewable material that gets more beautiful with each passing year. Like it? Combine with other products in the HEMNES series.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715014817.hemnes-glass-door-cabinet-with-3-drawers.webp',
    0,
    1,
    3000000.00,
    100000.00,
    10,
    '2024-05-06 14:00:17',
    '2024-05-06 14:00:17',
    13
  ),
(
    31,
    'PS Cabinet',
    'A lightweight, durable cabinet in white metal that fits almost anywhere – in a living room or a home office. Tall legs make cleaning easier, and behind the lockable doors you can store what you hold dear.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715014945.ikea-ps-cabinet.webp',
    0,
    1,
    800000.00,
    0.00,
    10,
    '2024-05-06 14:02:25',
    '2024-05-06 14:02:25',
    13
  ),
(
    32,
    'IDANÄS Cabinet',
    'IDANÄS series combines timeless design with modern functionality. This IDANÄS cabinet has bifolding glass-doors that adds elegance to your home. Carefully designed details in solid wood and profiled edges give the furniture a genuine feel.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715015387.idanaes-cabinet-with-bi-folded-glass-doors.webp',
    0,
    1,
    3000000.00,
    0.00,
    10,
    '2024-05-06 14:09:47',
    '2024-05-06 14:09:47',
    13
  ),
(
    33,
    'STRANDMON Wing chair',
    'Need a hug? STRANDMON wing chair has an embracing feel with a high back, round armrests, soft lines and inviting upholstery. A traditional look with modern comfort for many cosy moments.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715015579.strandmon-wing-chair.webp',
    0,
    1,
    2000000.00,
    0.00,
    10,
    '2024-05-06 14:12:59',
    '2024-05-06 14:12:59',
    13
  ),
(
    34,
    'EKERÖ Armchair',
    'Go for stylish dark tones or brighten up your home with colourful covers. EKERÖ armchair has a sleek, modern look with two side pieces that meet in the back – and lumbar support for added comfort!',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715015651.ekeroe-armchair.webp',
    0,
    1,
    2000000.00,
    0.00,
    10,
    '2024-05-06 14:14:11',
    '2024-05-06 14:14:11',
    13
  ),
(
    35,
    'OSKARSHAMNWing chair with footstool',
    'The perfect couple. OSKARSHAMN wing chair and footstool with storage together create a wonderfully embracing place to sit – where you can also lean back and rest your feet for a while.',
    'Fabric:\n100% polyester (min. 90% recycled)\nHeadboard:\n100 % polyester, Polyester wadding, Steel, Polyurethane foam 20 kg/cu.m.\nFootboard:\nSteel\nBedside:\n100 % polyester, Particleboard, Steel\nMidbeam/ Cross rail/ Leg:\nSteel, Epoxy/polyester powder coating\nLining:\n100% polypropylene',
    '{\"1\": \"black\", \"2\": \"white\", \"3\": \"brwon\"}',
    'Length: 206 cm\nWidth: 144 cm\nFootboard height: 40 cm\nHeadboard height: 85 cm\nMattress length: 200 cm\nMattress width: 140 cm',
    '/images/products/1715015754.oskarshamn-wing-chair-with-footstool.webp',
    0,
    1,
    3000000.00,
    0.00,
    10,
    '2024-05-06 14:15:54',
    '2024-05-06 14:15:54',
    13
  );
/*!40000 ALTER TABLE `products` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `ratings`
--
DROP TABLE IF EXISTS `ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `ratings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `rating` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ratings_product_id_foreign` (`product_id`),
  KEY `ratings_user_id_foreign` (`user_id`),
  CONSTRAINT `ratings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 6 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `ratings`
--
LOCK TABLES `ratings` WRITE;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */
;
INSERT INTO `ratings`
VALUES (
    1,
    1,
    65,
    3,
    '2025-06-19 19:34:33',
    '2025-06-19 19:34:33'
  );
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `users`
--
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `wants_notifications` tinyint DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE = InnoDB AUTO_INCREMENT = 99 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `users`
--
LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */
;
INSERT INTO `users`
VALUES (
    65,
    'Jafar',
    'mahmood',
    'jafarmahmoud535@gmail.com',
    '+963931414419',
    '2025-06-19 17:22:53',
    '$2y$10$5QOEEW0aW3zPR2zOD2cAIuTKzdplzK5p7NnVALI1GXO2uzy0GzwO6',
    1,
    NULL,
    '2025-06-19 17:17:10',
    '2025-06-26 09:28:28',
    1
  ),
(
    71,
    'Jaafar',
    'Mahmood',
    'jaafarmahmood4419@gmail.com',
    NULL,
    '2025-06-25 15:31:37',
    '$2y$10$mr2SIitzhkkkde0e213DeeXZBe5Nugn9MyT3G/SyCWLjrxxMAHXqC',
    0,
    NULL,
    '2025-06-25 15:26:33',
    '2025-06-25 15:31:37',
    1
  ),
(
    81,
    'Jafar',
    'Mahmoud',
    'hardlocas@gm1234567890ail.com',
    NULL,
    NULL,
    '$2y$10$NBlXMCyoxcTpYzpWypy4E.oWtRudgrV5v7EQkaSp57uwMG1bCorR2',
    0,
    NULL,
    '2025-06-27 11:22:43',
    '2025-06-27 11:22:43',
    1
  ),
(
    84,
    'hg',
    'ut',
    'hardlocas@g1mail.com',
    NULL,
    '2025-06-25 15:31:37',
    '$2y$10$K5iHI4upjAkZV2UPDrELPOsDqpRRY/7S7AIejnC6s9PBWJHC1cj9G',
    0,
    NULL,
    '2025-07-10 18:33:54',
    '2025-07-10 18:33:54',
    1
  ),
(
    85,
    'hg',
    'ut',
    'hardlocas@g2mail.com',
    NULL,
    '2025-06-25 15:31:37',
    '$2y$10$K5iHI4upjAkZV2UPDrELPOsDqpRRY/7S7AIejnC6s9PBWJHC1cj9G',
    0,
    NULL,
    '2025-07-10 18:33:54',
    '2025-07-10 18:33:54',
    1
  ),
(
    87,
    'hg',
    'ut',
    'hardlocas@g3mail.com',
    NULL,
    '2025-06-25 15:31:37',
    '$2y$10$K5iHI4upjAkZV2UPDrELPOsDqpRRY/7S7AIejnC6s9PBWJHC1cj9G',
    0,
    NULL,
    '2025-07-10 18:33:54',
    '2025-07-10 18:33:54',
    0
  ),
(
    88,
    'hg',
    'ut',
    'hardlocas@g4mail.com',
    NULL,
    '2025-06-25 15:31:37',
    '$2y$10$K5iHI4upjAkZV2UPDrELPOsDqpRRY/7S7AIejnC6s9PBWJHC1cj9G',
    0,
    NULL,
    '2025-07-10 18:33:54',
    '2025-07-10 18:33:54',
    0
  ),
(
    89,
    'hg',
    'ut',
    'hardlocas@g5mail.com',
    NULL,
    '2025-06-25 15:31:37',
    '$2y$10$K5iHI4upjAkZV2UPDrELPOsDqpRRY/7S7AIejnC6s9PBWJHC1cj9G',
    0,
    NULL,
    '2025-07-10 18:33:54',
    '2025-07-10 18:33:54',
    0
  ),
(
    90,
    'hg',
    'ut',
    'hardlocas@g6mail.com',
    NULL,
    '2025-06-25 15:31:37',
    '$2y$10$K5iHI4upjAkZV2UPDrELPOsDqpRRY/7S7AIejnC6s9PBWJHC1cj9G',
    0,
    NULL,
    '2025-07-10 18:33:54',
    '2025-07-10 18:33:54',
    0
  ),
(
    92,
    'hg',
    'ut',
    'hardlocas@g7mail.com',
    NULL,
    '2025-06-25 15:31:37',
    '$2y$10$K5iHI4upjAkZV2UPDrELPOsDqpRRY/7S7AIejnC6s9PBWJHC1cj9G',
    0,
    NULL,
    '2025-07-10 18:33:54',
    '2025-07-10 18:33:54',
    0
  ),
(
    93,
    'hg',
    'ut',
    'hardlocas@g8mail.com',
    NULL,
    '2025-06-25 15:31:37',
    '$2y$10$K5iHI4upjAkZV2UPDrELPOsDqpRRY/7S7AIejnC6s9PBWJHC1cj9G',
    0,
    NULL,
    '2025-07-10 18:33:54',
    '2025-07-10 18:33:54',
    0
  ),
(
    94,
    'hg',
    'ut',
    'hardlocas@g9mail.com',
    NULL,
    '2025-06-25 15:31:37',
    '$2y$10$K5iHI4upjAkZV2UPDrELPOsDqpRRY/7S7AIejnC6s9PBWJHC1cj9G',
    0,
    NULL,
    '2025-07-10 18:33:54',
    '2025-07-10 18:33:54',
    0
  ),
(
    95,
    'hg',
    'ut',
    'hardlocas@g9123mail.com',
    NULL,
    '2025-06-25 15:31:37',
    '$2y$10$K5iHI4upjAkZV2UPDrELPOsDqpRRY/7S7AIejnC6s9PBWJHC1cj9G',
    0,
    NULL,
    '2025-07-10 18:33:54',
    '2025-07-10 18:33:54',
    0
  ),
(
    96,
    'Jafar',
    'Mahmoud',
    'hardlocas@gmail.com',
    NULL,
    NULL,
    '$2y$10$67XcfjcCyR3WH0BrjlXvEO8y51L/4hbZP0skq6nY9PFiTq4fnAo1e',
    0,
    NULL,
    '2025-07-10 19:54:24',
    '2025-07-10 19:54:24',
    0
  ),
(
    97,
    'مدير النظام',
    'مدير النظام',
    'admin@jamfurniture.com',
    NULL,
    '2025-07-13 20:41:10',
    '$2y$10$H/tnAURx0kKU6.IQE1IYfeJhmet6vkyydDLdzv4YHWyYm7W/eBl5a',
    1,
    NULL,
    '2025-07-13 20:30:13',
    '2025-07-13 20:41:10',
    0
  );
/*!40000 ALTER TABLE `users` ENABLE KEYS */
;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */
;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */
;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */
;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */
;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */
;
-- Dump completed on 2025-07-20 13:58:27