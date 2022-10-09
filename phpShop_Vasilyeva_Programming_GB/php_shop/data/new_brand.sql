-- MySQL dump 10.13  Distrib 5.7.34, for osx10.12 (x86_64)
--
-- Host: localhost    Database: brand_shop
-- ------------------------------------------------------
-- Server version	5.7.34

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
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) COLLATE utf8_bin NOT NULL,
  `order_id` bigint(20) unsigned DEFAULT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL DEFAULT '1',
  `price` int(10) unsigned DEFAULT NULL,
  `subtotal` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`,`session_id`,`product_id`),
  KEY `cart_product_idx` (`product_id`),
  KEY `fk_cart_order_idx` (`order_id`),
  CONSTRAINT `cart_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cart_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=345 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (1,'111',1,1,1,3,3),(325,'9ke7bbfptl2m1an576hou9t7fh',35,1,1,52,52),(329,'9ke7bbfptl2m1an576hou9t7fh',50,2,1,52,52),(330,'9ke7bbfptl2m1an576hou9t7fh',50,3,1,52,52),(331,'9ke7bbfptl2m1an576hou9t7fh',50,4,1,52,52),(332,'9ke7bbfptl2m1an576hou9t7fh',51,1,1,52,52),(333,'9ke7bbfptl2m1an576hou9t7fh',51,3,1,52,52),(334,'7o2oc2clatd3an8vecv0v175b2',52,2,1,52,52),(335,'7o2oc2clatd3an8vecv0v175b2',52,14,1,52,52),(338,'7o2oc2clatd3an8vecv0v175b2',53,1,1,52,52),(339,'7o2oc2clatd3an8vecv0v175b2',54,2,1,52,52),(340,'7o2oc2clatd3an8vecv0v175b2',54,3,2,52,104),(341,'7o2oc2clatd3an8vecv0v175b2',54,4,1,52,52),(342,'7o2oc2clatd3an8vecv0v175b2',55,3,2,52,104),(343,'7o2oc2clatd3an8vecv0v175b2',55,5,1,52,52),(344,'7o2oc2clatd3an8vecv0v175b2',55,7,1,52,52);
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(125) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'men'),(2,'women'),(3,'kids'),(4,'accesories'),(5,'shoes');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_bin NOT NULL,
  `path_to_big` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `path_to_small` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `size` int(10) unsigned DEFAULT NULL,
  `viewed` int(10) unsigned DEFAULT '0',
  `product_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_photo_idx` (`product_id`),
  CONSTRAINT `product_photo` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (1,'card1.jpg','images/img_big/card1.jpg','img_small/card1.jpg',NULL,13,1),(2,'card2.jpg','img_big/card2.jpg','img_small/card2.jpg',NULL,4,2),(3,'card3.jpg','img_big/card3.jpg','img_small/card3.jpg',NULL,12,3),(4,'card4.jpg','img_big/card4.jpg','img_small/card4.jpg',NULL,8,4),(5,'card5.jpg','img_big/card5.jpg','img_small/card5.jpg',NULL,2,5),(6,'card6.jpg','img_big/card6.jpg','img_small/card6.jpg',NULL,6,6),(7,'card7.jpg','img_big/card7.jpg','img_small/card7.jpg',NULL,0,7),(8,'card8.jpg','img_big/card8.jpg','img_small/card8.jpg',NULL,2,8);
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `order_info`
--

DROP TABLE IF EXISTS `order_info`;
/*!50001 DROP VIEW IF EXISTS `order_info`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `order_info` AS SELECT 
 1 AS `id`,
 1 AS `order_id`,
 1 AS `session_id`,
 1 AS `quantity`,
 1 AS `price`,
 1 AS `subtotal`,
 1 AS `product_id`,
 1 AS `name`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `finished_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id_idx` (`user_id`),
  CONSTRAINT `fk_orders_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'111',1,'2021-12-02 22:21:12',NULL,NULL),(35,'9ke7bbfptl2m1an576hou9t7fh',1,NULL,NULL,NULL),(46,'9ke7bbfptl2m1an576hou9t7fh',1,NULL,NULL,NULL),(47,'9ke7bbfptl2m1an576hou9t7fh',1,'2022-08-22 16:34:05',NULL,NULL),(48,'9ke7bbfptl2m1an576hou9t7fh',1,'2022-08-22 16:34:44',NULL,NULL),(49,'9ke7bbfptl2m1an576hou9t7fh',1,'2022-08-22 16:35:09',NULL,NULL),(50,'9ke7bbfptl2m1an576hou9t7fh',1,'2022-08-22 16:36:25',NULL,NULL),(51,'9ke7bbfptl2m1an576hou9t7fh',23,'2022-08-22 16:39:23',NULL,NULL),(52,'7o2oc2clatd3an8vecv0v175b2',1,'2022-08-26 20:27:02',NULL,NULL),(53,'7o2oc2clatd3an8vecv0v175b2',1,'2022-08-26 20:49:44',NULL,NULL),(54,'7o2oc2clatd3an8vecv0v175b2',23,'2022-08-26 20:53:38',NULL,NULL),(55,'7o2oc2clatd3an8vecv0v175b2',23,'2022-08-30 22:48:33',NULL,NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  `price` decimal(10,2) unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_category_id_idx` (`category_id`),
  CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'MANGO PEOPLE T-SHIRT',1,52.00,'Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.'),(2,'MANGO PEOPLE Sleeveless Top',2,52.00,'Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.'),(3,'MANGO PEOPLE Jacket',1,52.00,'Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.'),(4,'MANGO PEOPLE Top',2,52.00,'Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.'),(5,'MANGO PEOPLE Sleeveless Top',2,52.00,'Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.'),(6,'MANGO PEOPLE Linen Blazer',1,52.00,'Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.'),(7,'MANGO PEOPLE Linen Pants',1,52.00,'Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.'),(8,'MANGO PEOPLE Linen Shorts',1,52.00,'Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.'),(9,'MANGO PEOPLE T-SHIRT',1,150.00,'Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.'),(10,'MANGO PEOPLE T-SHIRT',1,150.00,'Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.'),(11,'MANGO PEOPLE T-SHIRT',1,150.00,'Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.'),(12,'MANGO PEOPLE T-SHIRT',1,52.00,'Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.'),(14,'MANGO PEOPLE JACKET',1,52.00,'Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.'),(15,'MANGO PEOPLE T-SHIRT',1,150.00,'Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_bin DEFAULT 'Guest',
  `review` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,'Alex','Super! I love it so much!'),(2,'Jane','The best shop!'),(3,'Guest','Well - not bad, good quality, but I prefer something more elegant');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(255) COLLATE utf8_bin NOT NULL,
  `name` varchar(45) COLLATE utf8_bin NOT NULL,
  `surname` varchar(45) COLLATE utf8_bin NOT NULL,
  `email` varchar(120) COLLATE utf8_bin DEFAULT NULL,
  `phone` bigint(15) unsigned NOT NULL,
  `address` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `pass` varchar(255) COLLATE utf8_bin NOT NULL,
  `hash` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_UNIQUE` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'al@hotmail.com','Al','Ke','al@hotmail.com',89995551212,'UK, London, Oxford str, 15-22','123','$2y$10$rTlRp.Qbw3AUb47xxuhcrueNJqIgit3isBzbpXSv/zXARenVc3KyO'),(2,'li@gmail.com','Lisa','Ko','li@gmail.com',89995551213,NULL,'123','$2y$10$rTlRp.Qbw3AUb47xxuhcrueNJqIgit3isBzbpXSv/zXARenVc3KyO'),(5,'admin@admin.com','Serj','Lo','admin@admin.com',89875551155,NULL,'123','$2y$10$rTlRp.Qbw3AUb47xxuhcrueNJqIgit3isBzbpXSv/zXARenVc3KyO'),(23,'mkdir@gmail.com','Thomas','Kizanakis','mkdir@gmail.com',3025698745263,'Υγείας 2, Ηράκλειο 712 02, Greece','123','$2y$10$UhMBEzT1NuWFhh2X1J.Bq.BypySnvKzk010kUo67MBvRpztTWNMY.');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `order_info`
--

/*!50001 DROP VIEW IF EXISTS `order_info`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `order_info` AS select `carts`.`id` AS `id`,`carts`.`order_id` AS `order_id`,`carts`.`session_id` AS `session_id`,`carts`.`quantity` AS `quantity`,`carts`.`price` AS `price`,`carts`.`subtotal` AS `subtotal`,`products`.`id` AS `product_id`,`products`.`name` AS `name` from (`carts` join `products` on((`carts`.`product_id` = `products`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-02 15:42:12
