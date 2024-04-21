-- MySQL dump 10.13  Distrib 8.1.0, for macos13.3 (arm64)
--
-- Host: localhost    Database: flower
-- ------------------------------------------------------
-- Server version	8.1.0

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
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D4E6F81A76ED395` (`user_id`),
  CONSTRAINT `FK_D4E6F81A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` VALUES (5,37,'Ma maison','Florian','Dupont',NULL,'13 bis RN 1','95560','Maffliers','FR','0651033665'),(6,37,'Travail','Florian','Dupont','Renault','13 Avenue Paul Langevin','92350','Le Plessis Robinsson','FR','0651033665');
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrier`
--

DROP TABLE IF EXISTS `carrier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carrier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrier`
--

LOCK TABLES `carrier` WRITE;
/*!40000 ALTER TABLE `carrier` DISABLE KEYS */;
INSERT INTO `carrier` VALUES (1,'Colissimo','Profitez d\'une livraison chez vous avec un colis chez vous dans les 72 prochaines heures',9.9),(2,'Chronopost','Chronopost est le leader français de la livraison express de colis jusqu\'à 30 kg aux entreprises et aux particuliers.',5.9);
/*!40000 ALTER TABLE `carrier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (5,'Bulbe'),(6,'Plantes à massif'),(7,'Rosiers');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `carrier_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `carrier_price` double NOT NULL,
  `delivery` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_paid` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F5299398A76ED395` (`user_id`),
  CONSTRAINT `FK_F5299398A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (1,37,'2024-03-08 13:00:11','Colissimo',9.9,'0651033665<br/>13 bis RN 1<br/>95560 FR',0),(2,37,'2024-03-09 12:22:00','Chronopost',5.9,'0651033665<br/>13 bis RN 1<br/>95560 FR',0),(3,37,'2024-03-09 14:08:55','Colissimo',9.9,'0651033665<br/>13 bis RN 1<br/>95560 FR',0),(4,37,'2024-03-09 14:11:31','Colissimo',9.9,'0651033665<br/>13 bis RN 1<br/>95560 FR',0),(5,37,'2024-03-09 14:34:06','Chronopost',5.9,'0651033665<br/>13 bis RN 1<br/>95560 FR',0),(6,37,'2024-03-12 08:51:38','Colissimo',9.9,'0651033665<br/>Renault<br/>13 Avenue Paul Langevin<br/>92350 FR',0),(7,37,'2024-03-12 08:51:47','Colissimo',9.9,'0651033665<br/>Renault<br/>13 Avenue Paul Langevin<br/>92350 FR',0);
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `my_order_id` int NOT NULL,
  `product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `price` double NOT NULL,
  `total` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_845CA2C1BFCDF877` (`my_order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_details`
--

LOCK TABLES `order_details` WRITE;
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
INSERT INTO `order_details` VALUES (1,37,'Bulbes de bégonias',2,500,1000),(2,37,'Pour un bouquet de 6 pensées',1,600,600),(3,2,'Bulbes de bégonias',1,500,500),(4,2,'Glaïeuls',1,900,900),(5,3,'Bulbes de bégonias',1,500,500),(6,3,'Glaïeuls',1,900,900),(7,4,'Bulbes de bégonias',1,500,500),(8,4,'Glaïeuls',1,900,900),(9,5,'Bulbes de bégonias',1,500,500),(10,5,'Glaïeuls',1,900,900),(11,6,'Bulbes de bégonias',1,500,500),(12,7,'Bulbes de bégonias',1,500,500);
/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `illustration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04AD12469DE2` (`category_id`),
  CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (4,5,'Bulbes de bégonias','bulbes-de-begonias','7c4ab4b42623be369945822a9120eaa582a585e1.jpg','Bulbes de bégonias','Les bégonias tubéreux peuvent être plantés dès le mois de mars en intérieur ou en serre afin d\'avancer la période de floraison ou enterrez-les à partir de fin avril à fin mai en pleine terre lorsque les gelées ne sont plus à craindre. Ils vont fleurir dès le mois de juin si vous les avez plantés en mars. Si vous avez remisé des tubercules (bulbes) de bégonia à l’intérieur à l’automne, il est temps de penser les réveiller. En effet, on les démarre habituellement à l’intérieur à la fin de mars ou au mois d’avril afin qu’ils soient prêts à fleurir quand viendra le moment de les placer à l’extérieur pour l’été.',500),(5,5,'Bulbes de dahlias','bulbes-de-dahlias','7a15d7fb58a4cc94194996dabdb410d9e7e6037e.jpg','Bulbes de dahlias','Selon la variété, ils fleurissent de juin à octobre. Les dahlias sont de vraies champions en terme de floraison qui s\'étend de juillet aux premiéres gelées. Votre cadeau de fête des méres vous garantit donc des mois de plaisir !',1200),(6,5,'Glaïeuls','glaieuls','3026405c7c0c9c1951e09d9d8c037fc1d3e52804.jpg','Glaïeuls','Les glaïeuls, en fait des cormes, sont commercialisés au printemps et expédiés de mi-février à mai. Les glaïeuls sont peu exigeants et poussent dans toute bonne terre de jardin ordinaire, bien drainée, en plein soleil.',900),(7,6,'Lot de 3 marguerites','lot-de-3-marguerites','d073b40129b817b7c275de1433a798ad936d0c36.jpg','Marguerites','La marguerite est un modèle d\'innocence et de simplicité. Occasions : amour, anniversaire, félicitations, Fête des mères, remerciements.',500),(8,6,'Pour un bouquet de 6 pensées','pour-un-bouquet-de-6-pensees','1777913a1d88633ea09242c93049b3a95ba10ae7.jpg','Bouquet de 6 pensées','Il s\'agit d\'une marque d\'affection particulière, qui symbolise la volonté de s\'engager dans un couple. Cela peut accompagner l\'envie d\'officialiser une relation ou encore d\'emménager ensemble.',600),(9,6,'Mélange de dix plantes à massif','melange-de-dix-plantes-a-massif','614a4141329e7c2498c514035db035bd7aac83df.jpg','Le bouquet parfait composé de 10 plantes à massif','Le bouquet se présente comme un éclat de couleurs et de textures, où une sélection de 10 plantes à massif s\'entremêle avec harmonie. Les fleurs variées offrent une composition visuellement riche, reflétant la diversité et la beauté d\'un jardin en pleine floraison. Chaque plante contribue à l\'ensemble avec ses teintes uniques et ses formes distinctives, créant ainsi un spectacle naturel et captivant.',1500),(10,7,'Grande fleur','grande-fleur','f6d1094716d9a1780c7443b3bc1806956c556021.jpg','Le rosier grande fleur','Les rosiers sont si importants, si présents dans la vie des gens, qu\'ils ont donné leur nom à une famille de plantes :  les ROSACEES. Leur grande diversité en fait un des arbustes les plus emblématiques de nos jardins. En effet quel jardin ne possède pas de massif de rosiers, en allée ou en complément d\'une haie par exemple. On les retrouve en différentes tailles et particularités : parfumés, grandes fleurs, arbustifs, grimpants, en petites fleurs, en bouquets...bref il n\'y a pas d\'équivalent dans le monde du jardin, et surtout aucune excuse pour ne pas en planter.',2000),(11,7,'Rugosa Roseraie de l\'Haÿ','rugosa-roseraie-de-lhay','54e30ace28ee9c14b54d152db1a6a9450eedde0f.jpg','Le rosier au parfum exceptionnel','Ce rosier Rugosa porte de grandes fleurs semi-doubles et plates, d\'une vive couleur rouge carmin, parfois teinté de violet. Elles exhalent un intense parfum sucré. Forme un bel arbuste, très résistant et qui supporte les conditions difficiles, les gels intenses, les sols pauvres et l\'ombre.',900),(12,7,'Le rosier arbuste','le-rosier-arbuste','dcba0cff48b6b03e23408ae9826ef41bfddd9538.jpg','Le rosier arbuste','Ces rosiers à port érigé ou évasé sont véritablement couverts de fleurs de juin aux gelées. Groupées, simples ou semi-doubles,\r\nleurs fleurs rappellent par ailleurs celles des roses sauvages. Plantés en isolé, en alignement ou même en haie fleurie, ces\r\nrosiers vigoureux vous donneront rapidement un résultat du plus bel effet !\r\n\r\nCe magnifique rosier arbuste vient compléter avec bonheur notre gamme de rosiers paysagers. Sa couleur unique, violet-pourpre et son parfum d’agrumes et de framboise constituent ses principaux atouts. Ses nombreuses fleurs en quartiers rappelant les roses anciennes ajoutent encore à son attrait.',800);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (37,'florian@dupont.com','[]','$2y$13$xnsIBmxtvkgAyvxRnE9zfu/8pfgkOazRJCqxQn6AUDbBP6xGqxGSq','Florian','Dupont'),(39,'zozo@megane.com','[]','$2y$13$MiqBHOAw4wAGV4MTBhNruuDtUnQIL3LsntI3Ste.wrjpiVbkoqEmm','Zoe','Megane'),(40,'josy@delamarre.com','[]','$2y$13$mKWlZi/0W69n0VHbuFCwvuo2rx5LqnE/kg7BCwgLgJKkgE2YJ8RqW','joséphine','delamarre');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-18 13:32:07
