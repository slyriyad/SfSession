-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour sfsession
CREATE DATABASE IF NOT EXISTS `sfsession` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sfsession`;

-- Listage de la structure de table sfsession. category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsession.category : ~3 rows (environ)
INSERT INTO `category` (`id`, `name`) VALUES
	(1, 'Informatique'),
	(2, 'Comptabilité'),
	(3, 'Vente');

-- Listage de la structure de table sfsession. formation
CREATE TABLE IF NOT EXISTS `formation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsession.formation : ~5 rows (environ)
INSERT INTO `formation` (`id`, `name`) VALUES
	(1, 'Developpeur web et web mobile'),
	(2, 'Comptable Assistant'),
	(3, 'Concepteur Designer UI'),
	(4, 'Conseiller commercial'),
	(5, 'Conseiller de vente ');

-- Listage de la structure de table sfsession. intern
CREATE TABLE IF NOT EXISTS `intern` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gender` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsession.intern : ~2 rows (environ)
INSERT INTO `intern` (`id`, `gender`, `city`, `birth_date`, `email`, `phone_number`, `name`, `surname`) VALUES
	(1, 'M', 'Montbéliard', '2024-05-07', 'riyad@exemple.com', '0621212121', 'Riyad', 'Fouzi'),
	(2, 'F', 'Valentigney', '2024-05-07', 'laura@exemple.com', '0654545454', 'Laura', 'Courtbardet');

-- Listage de la structure de table sfsession. messenger_messages
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsession.messenger_messages : ~0 rows (environ)

-- Listage de la structure de table sfsession. module
CREATE TABLE IF NOT EXISTS `module` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C24262812469DE2` (`category_id`),
  CONSTRAINT `FK_C24262812469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsession.module : ~21 rows (environ)
INSERT INTO `module` (`id`, `category_id`, `name`) VALUES
	(1, 1, 'Introduction à HTML'),
	(2, 1, 'CSS pour la mise en forme'),
	(3, 1, 'Bases de JavaScript'),
	(4, 1, 'JavaScript avancé'),
	(5, 1, 'PHP pour le côté serveur'),
	(6, 1, 'Conception d\'interfaces utilisateur mobiles'),
	(7, 1, 'Utilisation de React Native ou Flutter pour le développement d\'applications mobiles'),
	(8, 2, 'Introduction à la comptabilité'),
	(9, 2, 'Tenue de livres'),
	(10, 2, 'Formation pratique sur l\'utilisation de logiciels comptables populaires comme QuickBooks ou Sage'),
	(11, 1, 'Principes de conception UI/UX'),
	(12, 1, 'Wireframing'),
	(13, 1, 'Formation pratique sur des outils comme Adobe XD, Sketch, Figma'),
	(14, 3, 'Stratégies de vente'),
	(15, 3, 'Techniques de négociation'),
	(16, 3, 'Communication efficace'),
	(17, 3, 'Gestion des plaintes clients'),
	(18, 3, 'Accueil des clients'),
	(19, 3, 'Argumentation de vente'),
	(20, 3, 'Formation sur les produits'),
	(21, 3, 'Disposition en magasin');

-- Listage de la structure de table sfsession. program
CREATE TABLE IF NOT EXISTS `program` (
  `id` int NOT NULL AUTO_INCREMENT,
  `module_id` int DEFAULT NULL,
  `session_id` int DEFAULT NULL,
  `number_of_days` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_92ED7784AFC2B591` (`module_id`),
  KEY `IDX_92ED7784613FECDF` (`session_id`),
  CONSTRAINT `FK_92ED7784613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`),
  CONSTRAINT `FK_92ED7784AFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsession.program : ~21 rows (environ)
INSERT INTO `program` (`id`, `module_id`, `session_id`, `number_of_days`) VALUES
	(1, 1, 1, 60),
	(2, 2, 1, 30),
	(3, 3, 1, 15),
	(4, 4, 2, 15),
	(5, 5, 2, 60),
	(6, 6, 3, 90),
	(7, 7, 3, 60),
	(8, 8, 4, 60),
	(9, 9, 4, 30),
	(10, 10, 5, 40),
	(11, 11, 6, 50),
	(12, 12, 6, 60),
	(13, 13, 7, 90),
	(14, 14, 8, 60),
	(15, 15, 8, 30),
	(16, 16, 9, 60),
	(17, 17, 9, 30),
	(18, 18, 10, 60),
	(19, 19, 10, 30),
	(20, 20, 11, 90),
	(21, 21, 11, 30);

-- Listage de la structure de table sfsession. session
CREATE TABLE IF NOT EXISTS `session` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `formation_id` int DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `number_of_places` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D044D5D45200282E` (`formation_id`),
  CONSTRAINT `FK_D044D5D45200282E` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsession.session : ~11 rows (environ)
INSERT INTO `session` (`id`, `name`, `formation_id`, `start_date`, `end_date`, `number_of_places`) VALUES
	(1, ' Fondamentaux du Développement Web ', 1, '2024-06-07', '2024-07-07', 15),
	(2, 'Programmation Avancée et Frameworks Web ', 1, '2024-08-07', '2024-10-07', 12),
	(3, 'Développement Web Mobile', 1, '2024-11-07', '2024-12-07', 11),
	(4, ' Principes de la Comptabilité', 2, '2024-05-07', '2024-06-07', 10),
	(5, 'Utilisation de Logiciels Comptables', 2, '2024-07-07', '2024-08-07', 14),
	(6, 'Fondamentaux de la Conception UI/UX', 3, '2024-05-07', '2024-06-07', 12),
	(7, 'Outils de Conception UI', 3, '2024-07-07', '2024-08-07', 13),
	(8, 'Techniques de Vente et Négociation', 4, '2024-05-07', '2024-06-07', 13),
	(9, 'Gestion de la Relation Client', 4, '2024-07-07', '2024-08-07', 11),
	(10, 'Techniques de Vente en Magasin', 5, '2024-05-07', '2024-06-07', 7),
	(11, ' Connaissance des Produits et Merchandising', 5, '2024-05-07', '2024-06-07', 12);

-- Listage de la structure de table sfsession. session_intern
CREATE TABLE IF NOT EXISTS `session_intern` (
  `session_id` int NOT NULL,
  `intern_id` int NOT NULL,
  PRIMARY KEY (`session_id`,`intern_id`),
  KEY `IDX_CA12556F613FECDF` (`session_id`),
  KEY `IDX_CA12556F525DD4B4` (`intern_id`),
  CONSTRAINT `FK_CA12556F525DD4B4` FOREIGN KEY (`intern_id`) REFERENCES `intern` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_CA12556F613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsession.session_intern : ~0 rows (environ)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
