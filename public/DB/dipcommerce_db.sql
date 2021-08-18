-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Listage de la structure de la table dipcommerce_db. autreimage
CREATE TABLE IF NOT EXISTS `autreimage` (
  `autreimage_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `produit_id` int(11) NOT NULL,
  `autreimage_photo` varchar(255) NOT NULL,
  `autreimage_date_creation` datetime NOT NULL,
  `autreimage_statut` enum('VALIDE','DESACTIVE') NOT NULL DEFAULT 'VALIDE',
  PRIMARY KEY (`autreimage_id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- Listage des données de la table dipcommerce_db.autreimage : 1 rows
/*!40000 ALTER TABLE `autreimage` DISABLE KEYS */;
INSERT INTO `autreimage` (`autreimage_id`, `user_id`, `produit_id`, `autreimage_photo`, `autreimage_date_creation`, `autreimage_statut`) VALUES
	(31, 1, 7, 'produit_7_1620917105_1_avatar.jpg', '2021-05-13 14:45:05', 'VALIDE');
/*!40000 ALTER TABLE `autreimage` ENABLE KEYS */;

-- Listage de la structure de la table dipcommerce_db. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `categorie_id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_id_parent` int(11) DEFAULT '0',
  `categorie_nom` varchar(255) NOT NULL,
  `categorie_date_creation` datetime DEFAULT NULL,
  `categorie_date_modification` datetime DEFAULT NULL,
  `categorie_date_suppression` datetime DEFAULT NULL,
  `categorie_statut` enum('BROUILLON','VALIDE','SUPPRIME') NOT NULL DEFAULT 'VALIDE',
  PRIMARY KEY (`categorie_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Listage des données de la table dipcommerce_db.categorie : 4 rows
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` (`categorie_id`, `categorie_id_parent`, `categorie_nom`, `categorie_date_creation`, `categorie_date_modification`, `categorie_date_suppression`, `categorie_statut`) VALUES
	(1, NULL, 'FRUITS', '2021-07-26 17:13:49', NULL, NULL, 'VALIDE'),
	(2, NULL, 'PLATS AFRICAINS', '2021-07-26 17:14:12', NULL, NULL, 'VALIDE'),
	(3, 2, 'PLATS IVOIRIENS', '2021-07-26 17:14:23', NULL, NULL, 'VALIDE'),
	(4, NULL, 'FRUITS', '2021-07-26 17:36:26', NULL, '2021-07-26 17:36:46', 'SUPPRIME');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;

-- Listage de la structure de la table dipcommerce_db. commande
CREATE TABLE IF NOT EXISTS `commande` (
  `commande_id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) NOT NULL,
  `commande_montant_ht` double NOT NULL,
  `commande_montant_ttc` double NOT NULL,
  `commande_date_creation` datetime NOT NULL,
  `commande_statut_livraison` enum('NON LIVREE','LIVREE') NOT NULL DEFAULT 'NON LIVREE',
  `commande_statut` enum('BROUILLON','VALIDE','SUPPRIME') NOT NULL DEFAULT 'BROUILLON',
  PRIMARY KEY (`commande_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- Listage des données de la table dipcommerce_db.commande : 1 rows
/*!40000 ALTER TABLE `commande` DISABLE KEYS */;
INSERT INTO `commande` (`commande_id`, `utilisateur_id`, `commande_montant_ht`, `commande_montant_ttc`, `commande_date_creation`, `commande_statut_livraison`, `commande_statut`) VALUES
	(30, 1, 50000, 100000, '0000-00-00 00:00:00', 'NON LIVREE', 'BROUILLON');
/*!40000 ALTER TABLE `commande` ENABLE KEYS */;

-- Listage de la structure de la table dipcommerce_db. dim_commune
CREATE TABLE IF NOT EXISTS `dim_commune` (
  `commune_id` int(11) NOT NULL AUTO_INCREMENT,
  `bureau_id` int(3) DEFAULT NULL,
  `commune_libelle` varchar(16) DEFAULT NULL,
  `commune_statut` varchar(9) DEFAULT NULL,
  PRIMARY KEY (`commune_id`)
) ENGINE=MyISAM AUTO_INCREMENT=122 DEFAULT CHARSET=utf8;

-- Listage des données de la table dipcommerce_db.dim_commune : 10 rows
/*!40000 ALTER TABLE `dim_commune` DISABLE KEYS */;
INSERT INTO `dim_commune` (`commune_id`, `bureau_id`, `commune_libelle`, `commune_statut`) VALUES
	(1, 5, 'ABOBO', 'VALIDE'),
	(2, 5, 'ADJAME', 'VALIDE'),
	(3, 5, 'ATTECOUBE', 'VALIDE'),
	(4, 3, 'COCODY', 'VALIDE'),
	(5, 1, 'MARCORY', 'VALIDE'),
	(6, 2, 'KOUMASSI', 'VALIDE'),
	(7, 1, 'TREICHVILLE', 'VALIDE'),
	(8, 3, 'PLATEAU', 'SUPPRIME'),
	(9, 2, 'PORT BOUET', 'VALIDE'),
	(10, 4, 'YOPOUGON', 'VALIDE');
/*!40000 ALTER TABLE `dim_commune` ENABLE KEYS */;

-- Listage de la structure de la table dipcommerce_db. dim_course
CREATE TABLE IF NOT EXISTS `dim_course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) DEFAULT NULL,
  `nature_course` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `telephone` varchar(25) DEFAULT NULL,
  `date_retrait` datetime DEFAULT NULL,
  `date_livraison` datetime DEFAULT NULL,
  `commune_id_retrait` int(11) DEFAULT NULL,
  `commune_id_livraison` int(11) DEFAULT NULL,
  `frais_livraison` int(11) DEFAULT NULL,
  `statut` enum('VALIDE','BROUILLON','SUPPRIME') NOT NULL DEFAULT 'BROUILLON',
  `statut_livraison` enum('LIVREE','NON LIVREE') NOT NULL DEFAULT 'NON LIVREE',
  `date_creation` datetime DEFAULT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Listage des données de la table dipcommerce_db.dim_course : 0 rows
/*!40000 ALTER TABLE `dim_course` DISABLE KEYS */;
/*!40000 ALTER TABLE `dim_course` ENABLE KEYS */;

-- Listage de la structure de la table dipcommerce_db. dim_frais_livraison
CREATE TABLE IF NOT EXISTS `dim_frais_livraison` (
  `frais_livraison_id` int(11) NOT NULL AUTO_INCREMENT,
  `commune_id_retrait` int(11) NOT NULL,
  `commune_id_livraison` int(11) NOT NULL,
  `frais_livraison_montant` int(11) NOT NULL,
  `frais_livraison_date_creation` datetime DEFAULT NULL,
  `frais_livraison_date_suppression` datetime DEFAULT NULL,
  `frais_livraison_statut` enum('VALIDE','SUPPRIME','CLOTURE') NOT NULL DEFAULT 'VALIDE',
  PRIMARY KEY (`frais_livraison_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Listage des données de la table dipcommerce_db.dim_frais_livraison : 25 rows
/*!40000 ALTER TABLE `dim_frais_livraison` DISABLE KEYS */;
INSERT INTO `dim_frais_livraison` (`frais_livraison_id`, `commune_id_retrait`, `commune_id_livraison`, `frais_livraison_montant`, `frais_livraison_date_creation`, `frais_livraison_date_suppression`, `frais_livraison_statut`) VALUES
	(1, 1, 2, 1000, '2021-07-24 22:58:12', '2021-07-25 07:32:42', 'SUPPRIME'),
	(2, 1, 3, 1500, '2021-07-24 22:58:11', NULL, 'VALIDE'),
	(3, 1, 4, 2000, '2021-07-24 22:58:10', '2021-07-25 07:32:46', 'SUPPRIME'),
	(4, 1, 5, 1000, '2021-07-24 22:58:09', '2021-07-25 07:32:18', 'SUPPRIME'),
	(5, 2, 1, 1000, '2021-07-24 22:57:56', '2021-07-25 07:32:24', 'SUPPRIME'),
	(6, 2, 3, 1000, '2021-07-24 22:57:57', '2021-07-25 07:32:27', 'SUPPRIME'),
	(7, 2, 4, 1000, '2021-07-24 22:57:59', '2021-07-25 07:32:35', 'SUPPRIME'),
	(8, 2, 5, 1000, '2021-07-24 22:58:01', '2021-07-25 07:32:31', 'SUPPRIME'),
	(9, 4, 1, 1000, '2021-07-24 22:58:00', '2021-07-25 07:31:55', 'SUPPRIME'),
	(10, 4, 2, 1000, '2021-07-24 22:57:36', '2021-07-25 07:31:59', 'SUPPRIME'),
	(11, 4, 3, 1500, '2021-07-24 22:58:04', '2021-07-25 07:32:02', 'SUPPRIME'),
	(12, 4, 5, 1500, '2021-07-24 22:58:03', '2021-07-25 07:32:05', 'SUPPRIME'),
	(13, 5, 1, 1000, '2021-07-24 22:58:06', '2021-07-25 07:30:07', 'SUPPRIME'),
	(14, 5, 2, 1000, '2021-07-24 22:58:05', '2021-07-25 07:30:13', 'SUPPRIME'),
	(15, 5, 3, 3000, '2021-07-24 22:58:07', '2021-07-25 07:31:24', 'SUPPRIME'),
	(16, 5, 4, 1000, '2021-07-24 22:58:08', '2021-07-25 07:31:27', 'SUPPRIME'),
	(17, 1, 1, 5, '2021-07-24 23:29:43', '2021-07-25 07:37:29', 'SUPPRIME'),
	(18, 2, 2, 5650000, '2021-07-24 23:30:08', '2021-07-25 07:32:38', 'SUPPRIME'),
	(19, 4, 4, 1500, '2021-07-24 23:31:00', '2021-07-25 07:32:09', 'SUPPRIME'),
	(20, 3, 5, 2500, '2021-07-25 07:37:21', '2021-07-26 18:03:47', 'SUPPRIME'),
	(21, 2, 3, 1500, '2021-07-25 15:06:39', '2021-07-26 13:30:41', 'SUPPRIME'),
	(22, 2, 4, 5, '2021-07-26 11:13:15', '2021-07-26 13:28:05', 'SUPPRIME'),
	(23, 3, 5, 1, '2021-07-26 11:27:01', '2021-07-26 13:27:50', 'SUPPRIME'),
	(24, 6, 5, 5, '2021-07-26 11:43:51', '2021-07-26 13:27:46', 'SUPPRIME'),
	(25, 3, 1, 1, '2021-07-26 11:47:03', '2021-07-26 13:27:54', 'SUPPRIME');
/*!40000 ALTER TABLE `dim_frais_livraison` ENABLE KEYS */;

-- Listage de la structure de la table dipcommerce_db. fonction
CREATE TABLE IF NOT EXISTS `fonction` (
  `fonction_id` int(11) NOT NULL,
  `fonction_nom` datetime NOT NULL,
  `fonction_date_creation` datetime NOT NULL,
  `fonction_date_modification` datetime NOT NULL,
  `fonction_date_suppression` datetime NOT NULL,
  PRIMARY KEY (`fonction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table dipcommerce_db.fonction : ~0 rows (environ)
/*!40000 ALTER TABLE `fonction` DISABLE KEYS */;
/*!40000 ALTER TABLE `fonction` ENABLE KEYS */;

-- Listage de la structure de la table dipcommerce_db. kw_administrateur
CREATE TABLE IF NOT EXISTS `kw_administrateur` (
  `kw_administrateur_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kw_administrateur_login` varchar(255) NOT NULL,
  `kw_administrateur_pass` varchar(255) NOT NULL,
  `kw_administrateur_email` varchar(50) NOT NULL,
  `kw_administrateur_rang` int(11) NOT NULL,
  `kw_administrateur_statut` enum('ACTIVE','DESACTIVE') NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`kw_administrateur_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COMMENT='enregistre les administrateurs du site';

-- Listage des données de la table dipcommerce_db.kw_administrateur : 1 rows
/*!40000 ALTER TABLE `kw_administrateur` DISABLE KEYS */;
INSERT INTO `kw_administrateur` (`kw_administrateur_id`, `kw_administrateur_login`, `kw_administrateur_pass`, `kw_administrateur_email`, `kw_administrateur_rang`, `kw_administrateur_statut`) VALUES
	(10, 'admin', 'fece6adde0ec8c975e2b5ec91fce57ab1852fca4', 'admin@gmail.com', 1, 'ACTIVE');
/*!40000 ALTER TABLE `kw_administrateur` ENABLE KEYS */;

-- Listage de la structure de la table dipcommerce_db. migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table dipcommerce_db.migrations : ~0 rows (environ)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Listage de la structure de la table dipcommerce_db. panier
CREATE TABLE IF NOT EXISTS `panier` (
  `panier_id` int(11) NOT NULL AUTO_INCREMENT,
  `commande_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `panier_produit_pu` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `panier_quantite` int(11) NOT NULL,
  `panier_statut` enum('BROUILLON','VALIDE','SUPPRIME') NOT NULL DEFAULT 'BROUILLON',
  PRIMARY KEY (`panier_id`)
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;

-- Listage des données de la table dipcommerce_db.panier : 0 rows
/*!40000 ALTER TABLE `panier` DISABLE KEYS */;
/*!40000 ALTER TABLE `panier` ENABLE KEYS */;

-- Listage de la structure de la table dipcommerce_db. produit
CREATE TABLE IF NOT EXISTS `produit` (
  `produit_id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_id` int(11) NOT NULL,
  `produit_nom` varchar(255) NOT NULL,
  `produit_photo` varchar(255) DEFAULT NULL,
  `produit_description` longtext,
  `produit_prix` int(11) NOT NULL,
  `produit_stock` int(11) DEFAULT NULL,
  `produit_date_creation` datetime DEFAULT NULL,
  `produit_date_modification` datetime DEFAULT NULL,
  `produit_date_suppression` datetime DEFAULT NULL,
  `produit_statut` enum('VALIDE','DESACTIVE','SUPPRIME') NOT NULL DEFAULT 'VALIDE',
  PRIMARY KEY (`produit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Listage des données de la table dipcommerce_db.produit : 17 rows
/*!40000 ALTER TABLE `produit` DISABLE KEYS */;
INSERT INTO `produit` (`produit_id`, `categorie_id`, `produit_nom`, `produit_photo`, `produit_description`, `produit_prix`, `produit_stock`, `produit_date_creation`, `produit_date_modification`, `produit_date_suppression`, `produit_statut`) VALUES
	(1, 3, 'Sandwitch au poulet', 'https://images.anaca3.com/wp-content/uploads/2018/01/recette-sandwich-minceur-poulet-crudites-et-sauce-blanche-maison-702x336.jpg', 'Sandwitch au poulet', 2500, NULL, '2021-01-22 22:00:00', '2021-05-13 15:28:41', '2021-06-21 16:46:15', 'SUPPRIME'),
	(2, 4, 'Poulet Yassa', 'https://img.cuisineaz.com/610x610/2016-04-28/i96651-poulet-yassa.jpg', 'POULET YASSA', 1500, NULL, '2021-01-22 22:00:00', '2021-05-13 00:09:58', '2021-06-21 16:46:05', 'SUPPRIME'),
	(3, 3, 'Tchep au poisson', 'https://static.independent.co.uk/2021/03/12/11/three-ways-with-tofu-120321.jpg?width=640&auto=webp&quality=75', 'TECHP AU POISSON', 1000, NULL, '2021-01-22 22:00:00', '2021-05-13 00:18:18', '2021-07-26 13:10:31', 'SUPPRIME'),
	(4, 3, 'Foutou banane', 'https://www.linfodrome.com/media/article/images/thumb/58208-eccefc92bbbd118902c8d382dac78b64_xl.webp', 'Foutou banane', 1000, NULL, '2021-01-22 22:00:00', '2021-05-13 00:10:25', '2021-06-23 11:06:08', 'SUPPRIME'),
	(5, 3, 'Garba', 'https://institutionci.com/wp-content/uploads/2020/08/image-8.jpeg', 'Garba Choco', 700, NULL, '2021-01-22 22:00:00', '2021-05-13 15:29:02', '2021-06-21 16:47:45', 'SUPPRIME'),
	(6, 4, 'JUS DE FRUITS', '', 'JUS DE FRUITS', 200, NULL, '2021-01-22 22:00:00', '2021-05-13 10:20:05', '2021-06-21 16:47:45', 'SUPPRIME'),
	(7, 3, 'FOUTOU BANANE', '', 'FOUTOU BANANE', 1000, NULL, '2021-01-22 22:00:00', '2021-05-13 15:04:03', NULL, 'VALIDE'),
	(13, 3, 'ATTIEKE POISSON FUME', 'produit_1620613957_1_anniversaire2021.png', 'APF', 1000, NULL, '2021-01-22 22:00:00', '2021-05-13 15:18:51', NULL, 'VALIDE'),
	(12, 3, 'PORC AU FOUR', 'produit_1620598005_1_banner-bg__.jpg', 'lkjlkj', 500, NULL, '2021-01-22 22:00:00', '2021-05-13 00:54:45', '2021-05-12 21:01:18', 'VALIDE'),
	(14, 3, 'SOUPE DE POISSON', 'produit_1620614431_1_anniversaire2021.png', 'SOUPE DE POISSON', 1000, NULL, '2021-01-22 22:00:00', '2021-05-13 10:22:50', '2021-06-28 12:43:39', 'SUPPRIME'),
	(16, 3, 'riz sauce graine', 'produit_1624290093_2_FB_IMG_1622746520606.jpg', 'c\'est un bon plat ivoirien', 100, NULL, '2021-06-21 15:41:33', NULL, '2021-06-24 16:40:23', 'SUPPRIME'),
	(17, 4, 'Nobis ratione commod', 'produit_1624446352_2_FB_IMG_1622746540730.jpg', 'Optio dolor veniam', 19, NULL, '2021-06-23 11:05:52', NULL, '2021-06-23 11:06:02', 'SUPPRIME'),
	(18, 3, 'Placeat dolore volu', 'produit_1624446871_2_FB_IMG_1622746544041.jpg', 'Qui dolorum sit ist', 36, NULL, '2021-06-23 11:14:31', '2021-06-23 13:34:22', '2021-06-28 12:43:32', 'SUPPRIME'),
	(19, 3, 'Est dolore labore po', 'produit_1624537255_2_201128710_489382722358453_2881320922932180477_n.jpg', 'Reprehenderit natus', 88, NULL, '2021-06-24 12:20:55', NULL, '2021-06-28 12:43:26', 'SUPPRIME'),
	(20, 3, 'Impedit laborum aut', 'produit_1624888259_2_balloons-1903002_1920.png', 'Natus dolore ut sed', 70, NULL, '2021-06-28 13:50:59', NULL, NULL, 'VALIDE'),
	(21, 3, 'Ut explicabo Rerum', 'produit_1625042583_2_FB_IMG_1622746520606.jpg', 'Dolores incidunt la', 83, NULL, '2021-06-30 08:43:03', NULL, NULL, 'VALIDE'),
	(22, 4, 'Est exercitation vo', 'produit_1625214462_2_FB_IMG_1622746540730.jpg', 'Fuga Est architecto', 28, NULL, '2021-07-02 08:27:42', NULL, NULL, 'VALIDE');
/*!40000 ALTER TABLE `produit` ENABLE KEYS */;

-- Listage de la structure de la table dipcommerce_db. reunion
CREATE TABLE IF NOT EXISTS `reunion` (
  `reunion_id` int(5) NOT NULL AUTO_INCREMENT,
  `reunion_ordre_jour` varchar(255) NOT NULL,
  `reunion_pv` text NOT NULL,
  `reunion_date_creation` datetime NOT NULL,
  `reunion_date_modification` datetime NOT NULL,
  `reunion_date_suppression` datetime NOT NULL,
  `reunion_statut` enum('VALIDE','DESACTIVE','SUPPRIME') NOT NULL DEFAULT 'VALIDE',
  PRIMARY KEY (`reunion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Listage des données de la table dipcommerce_db.reunion : ~0 rows (environ)
/*!40000 ALTER TABLE `reunion` DISABLE KEYS */;
INSERT INTO `reunion` (`reunion_id`, `reunion_ordre_jour`, `reunion_pv`, `reunion_date_creation`, `reunion_date_modification`, `reunion_date_suppression`, `reunion_statut`) VALUES
	(1, 'Réunion', 'Réunion', '2021-07-07 15:55:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'VALIDE');
/*!40000 ALTER TABLE `reunion` ENABLE KEYS */;

-- Listage de la structure de la table dipcommerce_db. society
CREATE TABLE IF NOT EXISTS `society` (
  `society_id` int(11) NOT NULL,
  `society_nom` varchar(255) NOT NULL,
  `society_date_creation` datetime NOT NULL,
  `society_date_modification` datetime NOT NULL,
  `society_date_suppression` datetime NOT NULL,
  PRIMARY KEY (`society_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table dipcommerce_db.society : ~0 rows (environ)
/*!40000 ALTER TABLE `society` DISABLE KEYS */;
/*!40000 ALTER TABLE `society` ENABLE KEYS */;

-- Listage de la structure de la table dipcommerce_db. tb_action
CREATE TABLE IF NOT EXISTS `tb_action` (
  `action_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_creation` int(11) NOT NULL DEFAULT '0',
  `user_id_suppression` int(11) NOT NULL DEFAULT '0',
  `action_code` varchar(50) NOT NULL DEFAULT '0',
  `action_libelle` varchar(255) DEFAULT NULL,
  `action_date_creation` datetime DEFAULT NULL,
  `action_statut` enum('VALIDE','SUPPRIME') DEFAULT 'VALIDE',
  PRIMARY KEY (`action_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Listage des données de la table dipcommerce_db.tb_action : 0 rows
/*!40000 ALTER TABLE `tb_action` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_action` ENABLE KEYS */;

-- Listage de la structure de la table dipcommerce_db. tb_autorisation
CREATE TABLE IF NOT EXISTS `tb_autorisation` (
  `autorisation_id` int(11) NOT NULL AUTO_INCREMENT,
  `profil_id` int(11) DEFAULT NULL,
  `action_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `autorisation_date_creation` datetime DEFAULT NULL,
  `autorisation_statut` enum('VALIDE','DESACTIVE') DEFAULT 'VALIDE',
  PRIMARY KEY (`autorisation_id`),
  UNIQUE KEY `Index 1` (`action_id`,`profil_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Listage des données de la table dipcommerce_db.tb_autorisation : 0 rows
/*!40000 ALTER TABLE `tb_autorisation` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_autorisation` ENABLE KEYS */;

-- Listage de la structure de la table dipcommerce_db. tb_participants
CREATE TABLE IF NOT EXISTS `tb_participants` (
  `participant_id` int(11) NOT NULL AUTO_INCREMENT,
  `participant_nom` varchar(255) NOT NULL,
  `participant_contact` int(11) NOT NULL,
  `participant_email` varchar(255) NOT NULL,
  `participant_fonction` varchar(200) NOT NULL,
  `participant_society` varchar(200) NOT NULL,
  `participant_date_creation` datetime DEFAULT NULL,
  `participant_date_modification` datetime DEFAULT NULL,
  `participant_date_suppression` datetime DEFAULT NULL,
  `participant_statut` enum('VALIDE','DESACTIVE','SUPPRIME') DEFAULT 'VALIDE',
  PRIMARY KEY (`participant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Listage des données de la table dipcommerce_db.tb_participants : ~7 rows (environ)
/*!40000 ALTER TABLE `tb_participants` DISABLE KEYS */;
INSERT INTO `tb_participants` (`participant_id`, `participant_nom`, `participant_contact`, `participant_email`, `participant_fonction`, `participant_society`, `participant_date_creation`, `participant_date_modification`, `participant_date_suppression`, `participant_statut`) VALUES
	(1, 'Boussou', 78607985, 'juste@gmail.com', 'Informaticien', 'Burida', '2021-06-29 17:48:29', '2021-06-29 17:48:30', '2021-07-02 08:30:30', 'SUPPRIME'),
	(2, 'Kouakou', 44455669, 'jahofecyna@mailinator.com', 'Tempor dolorum aliqu', 'Deleniti voluptatem', NULL, NULL, '2021-07-02 08:30:43', 'SUPPRIME'),
	(3, 'Bile', 77979797, 'xovivozyhy@mailinator.com', 'Doloremque obcaecati', 'Culpa sed consequat', NULL, NULL, '2021-07-02 08:30:47', 'SUPPRIME'),
	(4, 'Soro', 32644696, 'cufa@mailinator.com', 'Totam ad minim quaer', 'Ut ipsa repudiandae', NULL, NULL, '2021-07-02 08:30:51', 'SUPPRIME'),
	(5, 'Kouassi', 12455333, 'muki@mailinator.com', 'Rem unde veritatis f', 'Aut velit officia a', '2021-07-02 08:21:45', '2021-07-02 08:31:17', NULL, 'VALIDE'),
	(6, 'Bette', 78789655, 'mabyzymyza@mailinator.com', 'Enim et aut quis deb', 'Eligendi exercitatio', '2021-07-02 08:22:15', NULL, '2021-07-02 08:31:01', 'SUPPRIME'),
	(7, 'Bolo', 78946142, 'fyhemecaf@mailinator.com', 'Possimus aperiam in', 'In eligendi placeat', '2021-07-02 08:26:17', NULL, '2021-07-02 08:30:56', 'SUPPRIME'),
	(8, 'KONE SEYDOU', 41420214, 'krak225@gmail.com', 'DG', 'BURIDA', '2021-07-07 14:01:44', NULL, NULL, 'VALIDE'),
	(9, 'KONE SEYDOU', 0, 'krak225@gmail.com', 'DG', 'BURIDA', '2021-07-13 10:59:39', NULL, NULL, 'VALIDE');
/*!40000 ALTER TABLE `tb_participants` ENABLE KEYS */;

-- Listage de la structure de la table dipcommerce_db. tb_password_resets
CREATE TABLE IF NOT EXISTS `tb_password_resets` (
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table dipcommerce_db.tb_password_resets : 0 rows
/*!40000 ALTER TABLE `tb_password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_password_resets` ENABLE KEYS */;

-- Listage de la structure de la table dipcommerce_db. tb_profil
CREATE TABLE IF NOT EXISTS `tb_profil` (
  `profil_id` int(11) NOT NULL AUTO_INCREMENT,
  `profil_libelle` varchar(50) DEFAULT NULL,
  `profil_statut` enum('VALIDE','BROUILLON') DEFAULT 'VALIDE',
  PRIMARY KEY (`profil_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Listage des données de la table dipcommerce_db.tb_profil : 2 rows
/*!40000 ALTER TABLE `tb_profil` DISABLE KEYS */;
INSERT INTO `tb_profil` (`profil_id`, `profil_libelle`, `profil_statut`) VALUES
	(1, 'ADMINISTRATEUR', 'VALIDE'),
	(2, 'UTILISATEUR', 'VALIDE');
/*!40000 ALTER TABLE `tb_profil` ENABLE KEYS */;

-- Listage de la structure de la table dipcommerce_db. tb_request
CREATE TABLE IF NOT EXISTS `tb_request` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_url` varchar(255) DEFAULT NULL,
  `request_querystring` varchar(255) DEFAULT NULL,
  `request_statut` enum('BON','FAUX','BROUILLON') DEFAULT 'BROUILLON',
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM AUTO_INCREMENT=552 DEFAULT CHARSET=latin1;

-- Listage des données de la table dipcommerce_db.tb_request : 551 rows
/*!40000 ALTER TABLE `tb_request` DISABLE KEYS */;
INSERT INTO `tb_request` (`request_id`, `request_url`, `request_querystring`, `request_statut`) VALUES
	(1, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(2, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(3, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(4, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(5, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(6, 'http://webapp.test/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
	(7, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(8, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(9, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(10, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(11, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(12, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(13, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(14, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(15, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(16, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(17, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(18, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(19, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(20, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(21, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(22, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(23, 'http://webapp.test/password/eventually.ogg', 'password/eventually.ogg', 'BROUILLON'),
	(24, 'http://webapp.test/password/eventually.mp3', 'password/eventually.mp3', 'BROUILLON'),
	(25, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(26, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(27, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(28, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(29, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(30, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(31, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(32, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(33, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(34, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(35, 'http://webapp.test/css/select2x2.png', 'css/select2x2.png', 'BROUILLON'),
	(36, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(37, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(38, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(39, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(40, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(41, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(42, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(43, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(44, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(45, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(46, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(47, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(48, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(49, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(50, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(51, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(52, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(53, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(54, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(55, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(56, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(57, 'http://webapp.test/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
	(58, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(59, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(60, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(61, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(62, 'http://webapp.test/presence', 'presence', 'BROUILLON'),
	(63, 'http://webapp.test/presence', 'presence', 'BROUILLON'),
	(64, 'http://webapp.test/participant', 'participant', 'BROUILLON'),
	(65, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(66, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(67, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(68, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(69, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(70, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(71, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(72, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(73, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(74, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(75, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(76, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(77, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(78, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(79, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(80, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(81, 'http://webapp.test/list-participant', 'list-participant', 'BROUILLON'),
	(82, 'http://webapp.test/list-participant', 'list-participant', 'BROUILLON'),
	(83, 'http://webapp.test/participants.list-participant', 'participants.list-participant', 'BROUILLON'),
	(84, 'http://webapp.test/participants.list-participant', 'participants.list-participant', 'BROUILLON'),
	(85, 'http://webapp.test/participants.list-participant', 'participants.list-participant', 'BROUILLON'),
	(86, 'http://webapp.test/participants.list-participant', 'participants.list-participant', 'BROUILLON'),
	(87, 'http://webapp.test/participants.list-participant', 'participants.list-participant', 'BROUILLON'),
	(88, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(89, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(90, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(91, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(92, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(93, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(94, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(95, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(96, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(97, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(98, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(99, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(100, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(101, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(102, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(103, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(104, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(105, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(106, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(107, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(108, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(109, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(110, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(111, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(112, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(113, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(114, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(115, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(116, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(117, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(118, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(119, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(120, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(121, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(122, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(123, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(124, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(125, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(126, 'http://webapp.test/particpants/1', 'particpants/1', 'BROUILLON'),
	(127, 'http://webapp.test/particpants/1', 'particpants/1', 'BROUILLON'),
	(128, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(129, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(130, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(131, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(132, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(133, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(134, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(135, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(136, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(137, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(138, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(139, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(140, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(141, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(142, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(143, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(144, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(145, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(146, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(147, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(148, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(149, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(150, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(151, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(152, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(153, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(154, 'http://webapp.test/participant/1', 'participant/1', 'BROUILLON'),
	(155, 'http://webapp.test/participant/1', 'participant/1', 'BROUILLON'),
	(156, 'http://webapp.test/participant/1', 'participant/1', 'BROUILLON'),
	(157, 'http://webapp.test/participant/1', 'participant/1', 'BROUILLON'),
	(158, 'http://webapp.test/participant/1', 'participant/1', 'BROUILLON'),
	(159, 'http://webapp.test/participant/5', 'participant/5', 'BROUILLON'),
	(160, 'http://webapp.test/participant/1', 'participant/1', 'BROUILLON'),
	(161, 'http://webapp.test/participant/1', 'participant/1', 'BROUILLON'),
	(162, 'http://webapp.test/participant/1', 'participant/1', 'BROUILLON'),
	(163, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(164, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(165, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(166, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(167, 'http://webapp.test/participant.show/1', 'participant.show/1', 'BROUILLON'),
	(168, 'http://webapp.test/participant.show/1', 'participant.show/1', 'BROUILLON'),
	(169, 'http://webapp.test/participant.show/1', 'participant.show/1', 'BROUILLON'),
	(170, 'http://webapp.test/participants.index', 'participants.index', 'BROUILLON'),
	(171, 'http://webapp.test/participants.index', 'participants.index', 'BROUILLON'),
	(172, 'http://webapp.test/participants.index', 'participants.index', 'BROUILLON'),
	(173, 'http://webapp.test/participants.ListParticipant', 'participants.ListParticipant', 'BROUILLON'),
	(174, 'http://webapp.test/participants.ListParticipant', 'participants.ListParticipant', 'BROUILLON'),
	(175, 'http://webapp.test/participants.ListParticipant', 'participants.ListParticipant', 'BROUILLON'),
	(176, 'http://webapp.test/participants.ListParticipant', 'participants.ListParticipant', 'BROUILLON'),
	(177, 'http://webapp.test/participants.ListParticipant', 'participants.ListParticipant', 'BROUILLON'),
	(178, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(179, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(180, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(181, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(182, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(183, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(184, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(185, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(186, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(187, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(188, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(189, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(190, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(191, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(192, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(193, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(194, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(195, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(196, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(197, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(198, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(199, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(200, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(201, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(202, 'http://webapp.test/participants.ListParticipant', 'participants.ListParticipant', 'BROUILLON'),
	(203, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(204, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(205, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(206, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(207, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(208, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(209, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(210, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(211, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(212, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(213, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(214, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(215, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(216, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(217, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(218, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(219, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(220, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(221, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(222, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(223, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(224, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(225, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(226, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(227, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(228, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(229, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(230, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(231, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(232, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(233, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(234, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(235, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(236, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(237, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(238, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(239, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(240, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(241, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(242, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(243, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(244, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(245, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(246, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(247, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(248, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(249, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(250, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(251, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(252, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(253, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(254, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(255, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(256, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(257, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(258, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(259, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(260, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(261, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(262, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(263, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(264, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(265, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(266, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(267, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(268, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(269, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(270, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(271, 'http://webapp.test/admin', 'admin', 'BROUILLON'),
	(272, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(273, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(274, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(275, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(276, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(277, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(278, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(279, 'http://webapp.test/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
	(280, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(281, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(282, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(283, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(284, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(285, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(286, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(287, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(288, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(289, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(290, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(291, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(292, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(293, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(294, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(295, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(296, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(297, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(298, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(299, 'http://webapp.test/images/produits/produit_1620614431_1_anniversaire2021.png', 'images/produits/produit_1620614431_1_anniversaire2021.png', 'BROUILLON'),
	(300, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(301, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(302, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(303, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(304, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(305, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(306, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(307, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(308, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(309, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(310, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(311, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(312, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(313, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(314, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(315, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(316, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(317, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(318, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(319, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(320, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(321, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(322, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(323, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(324, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(325, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(326, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(327, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(328, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(329, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(330, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(331, 'http://webapp.test/participants.participants', 'participants.participants', 'BROUILLON'),
	(332, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(333, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(334, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(335, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(336, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(337, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(338, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(339, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(340, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(341, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(342, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(343, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(344, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(345, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(346, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(347, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(348, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(349, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(350, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(351, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(352, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(353, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(354, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(355, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(356, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(357, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(358, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(359, 'http://webapp.test/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
	(360, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(361, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(362, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(363, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(364, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(365, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(366, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(367, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(368, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(369, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(370, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(371, 'http://webapp.test/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(372, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(373, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(374, 'http://webapp.test/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(375, 'http://webapp.test/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(376, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(377, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(378, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(379, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(380, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(381, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(382, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(383, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(384, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(385, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(386, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(387, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(388, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(389, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(390, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(391, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(392, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(393, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(394, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(395, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(396, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(397, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(398, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(399, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(400, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(401, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(402, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(403, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(404, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(405, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(406, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(407, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(408, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(409, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(410, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(411, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(412, 'http://webapp.test/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(413, 'http://localhost/webapp', 'webapp', 'BROUILLON'),
	(414, 'http://localhost/webapp/public/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(415, 'http://localhost/webapp/public/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(416, 'http://localhost/webapp/public/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(417, 'http://localhost/webapp/public/participants.reunion', 'participants.reunion', 'BROUILLON'),
	(418, 'http://ecommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(419, 'http://ecommerce-admin.com/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(420, 'http://ecommerce-admin.com/images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'BROUILLON'),
	(421, 'http://ecommerce-admin.com/images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'BROUILLON'),
	(422, 'http://ecommerce-admin.com/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(423, 'http://ecommerce-admin.com/images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'BROUILLON'),
	(424, 'http://ecommerce-admin.com/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(425, 'http://ecommerce-admin.com/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(426, 'http://ecommerce-admin.com/images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'BROUILLON'),
	(427, 'http://ecommerce-admin.com/images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'BROUILLON'),
	(428, 'http://ecommerce-admin.com/images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'BROUILLON'),
	(429, 'http://ecommerce-admin.com/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(430, 'http://ecommerce-admin.com/images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'BROUILLON'),
	(431, 'http://ecommerce-admin.com/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(432, 'http://ecommerce-admin.com/images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'BROUILLON'),
	(433, 'http://ecommerce-admin.com/images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'BROUILLON'),
	(434, 'http://ecommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(435, 'http://ecommerce-admin.com/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(436, 'http://ecommerce-admin.com/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(437, 'http://ecommerce-admin.com/images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'BROUILLON'),
	(438, 'http://ecommerce-admin.com/images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'BROUILLON'),
	(439, 'http://ecommerce-admin.com/images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'BROUILLON'),
	(440, 'http://ecommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(441, 'http://ecommerce-admin.com/images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'BROUILLON'),
	(442, 'http://ecommerce-admin.com/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(443, 'http://ecommerce-admin.com/images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'BROUILLON'),
	(444, 'http://ecommerce-admin.com/images/produits/produit_1620613957_1_anniversaire2021.png', 'images/produits/produit_1620613957_1_anniversaire2021.png', 'BROUILLON'),
	(445, 'http://ecommerce-admin.com/images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'BROUILLON'),
	(446, 'http://localhost/dipdip.fr/ecommerce-admin/login', 'dipdip.fr/ecommerce-admin/login', 'BROUILLON'),
	(447, 'http://dipdip.fr.com/ecommerce-admin', 'ecommerce-admin', 'BROUILLON'),
	(448, 'http://dipcommerce-admin.com/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(449, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(450, 'http://dipcommerce-admin.com/images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'BROUILLON'),
	(451, 'http://dipcommerce-admin.com/images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'BROUILLON'),
	(452, 'http://dipcommerce-admin.com/images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'BROUILLON'),
	(453, 'http://dipcommerce-admin.com/images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'BROUILLON'),
	(454, 'http://dipcommerce-admin.com/images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'BROUILLON'),
	(455, 'http://dipcommerce-admin.com/images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'BROUILLON'),
	(456, 'http://dipcommerce-admin.com/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(457, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(458, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(459, 'http://dipcommerce-admin.com/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(460, 'http://dipcommerce-admin.com/images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'BROUILLON'),
	(461, 'http://dipcommerce-admin.com/images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'BROUILLON'),
	(462, 'http://dipcommerce-admin.com/images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'BROUILLON'),
	(463, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(464, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(465, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(466, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(467, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
	(468, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(469, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(470, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(471, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(472, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
	(473, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(474, 'http://dipcommerce-admin.com/setcommandelivree', 'setcommandelivree', 'BROUILLON'),
	(475, 'http://dipcommerce-admin.com/setcommandelivree', 'setcommandelivree', 'BROUILLON'),
	(476, 'http://dipcommerce-admin.com/images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'BROUILLON'),
	(477, 'http://dipcommerce-admin.com/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(478, 'http://dipcommerce-admin.com/images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'images/produits/produit_1625214462_2_FB_IMG_1622746540730.jpg', 'BROUILLON'),
	(479, 'http://dipcommerce-admin.com/images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'BROUILLON'),
	(480, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(481, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(482, 'http://dipcommerce-admin.com/setcommandelivree', 'setcommandelivree', 'BROUILLON'),
	(483, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(484, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(485, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
	(486, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(487, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(488, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
	(489, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(490, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(491, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(492, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(493, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
	(494, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(495, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(496, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(497, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
	(498, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(499, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(500, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(501, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
	(502, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(503, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(504, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(505, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(506, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(507, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(508, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
	(509, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(510, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(511, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(512, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(513, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
	(514, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(515, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(516, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(517, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
	(518, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(519, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(520, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(521, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(522, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
	(523, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(524, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(525, 'http://dipcommerce-admin.com/supprimer_categorie', 'supprimer_categorie', 'BROUILLON'),
	(526, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(527, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(528, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
	(529, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(530, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(531, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(532, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
	(533, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(534, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(535, 'http://dipcommerce-admin.com/supprimer_categorie', 'supprimer_categorie', 'BROUILLON'),
	(536, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(537, 'http://dipcommerce-admin.com/supprimer_categorie', 'supprimer_categorie', 'BROUILLON'),
	(538, 'http://dipcommerce-admin.com/supprimer_categorie', 'supprimer_categorie', 'BROUILLON'),
	(539, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(540, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(541, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(542, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(543, 'http://dipcommerce-admin.com/css/select2-spinner.gif', 'css/select2-spinner.gif', 'BROUILLON'),
	(544, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(545, 'http://dipcommerce-admin.com/images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'images/produits/produit_1624888259_2_balloons-1903002_1920.png', 'BROUILLON'),
	(546, 'http://dipcommerce-admin.com/images/produits/produit_1620598005_1_banner-bg__.jpg', 'images/produits/produit_1620598005_1_banner-bg__.jpg', 'BROUILLON'),
	(547, 'http://dipcommerce-admin.com/images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'images/produits/produit_1625042583_2_FB_IMG_1622746520606.jpg', 'BROUILLON'),
	(548, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(549, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(550, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON'),
	(551, 'http://dipcommerce-admin.com/css/select2.png', 'css/select2.png', 'BROUILLON');
/*!40000 ALTER TABLE `tb_request` ENABLE KEYS */;

-- Listage de la structure de la table dipcommerce_db. tb_reunion_participant
CREATE TABLE IF NOT EXISTS `tb_reunion_participant` (
  `reunion_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `signature_participant` longtext NOT NULL,
  KEY `reunion_id` (`reunion_id`),
  KEY `participant_id` (`participant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table dipcommerce_db.tb_reunion_participant : ~2 rows (environ)
/*!40000 ALTER TABLE `tb_reunion_participant` DISABLE KEYS */;
INSERT INTO `tb_reunion_participant` (`reunion_id`, `participant_id`, `signature_participant`) VALUES
	(1, 1, 'juste'),
	(2, 3, 'israel');
/*!40000 ALTER TABLE `tb_reunion_participant` ENABLE KEYS */;

-- Listage de la structure de la table dipcommerce_db. tb_service
CREATE TABLE IF NOT EXISTS `tb_service` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `direction_id` int(11) DEFAULT '0',
  `service_nom` varchar(255) DEFAULT NULL,
  `service_libelle_imputation` varchar(255) DEFAULT NULL,
  `service_numero_ordre_imputation_dg` int(11) DEFAULT NULL,
  `service_statut_autorisation_imputation_dg` enum('AUTORISE','NON AUTORISE') DEFAULT 'NON AUTORISE',
  `service_statut` enum('BROUILLON','VALIDE','SUPPRIME') DEFAULT 'VALIDE',
  PRIMARY KEY (`service_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Ex : Bureau urbain, antenne de san pédro, Siège, etc.';

-- Listage des données de la table dipcommerce_db.tb_service : 0 rows
/*!40000 ALTER TABLE `tb_service` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_service` ENABLE KEYS */;

-- Listage de la structure de la table dipcommerce_db. tb_users
CREATE TABLE IF NOT EXISTS `tb_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profil_id` int(11) NOT NULL DEFAULT '2',
  `service_id` int(10) unsigned NOT NULL DEFAULT '0',
  `categorie_personnel_id` int(10) unsigned NOT NULL DEFAULT '0',
  `type_personnel_id` int(10) unsigned NOT NULL DEFAULT '0',
  `equipe_id` int(10) unsigned NOT NULL DEFAULT '0',
  `bureauID` int(10) unsigned NOT NULL DEFAULT '0',
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenoms` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `civilite` enum('M.','Mme','Mlle') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `telephone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matricule` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ip_derniere_connexion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_derniere_connexion` datetime DEFAULT NULL,
  `statut_connexion` enum('CONNECTE','DECONNECTE') COLLATE utf8mb4_unicode_ci DEFAULT 'DECONNECTE',
  `statut_signature` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statut` enum('VALIDE','SUPPRIME') COLLATE utf8mb4_unicode_ci DEFAULT 'VALIDE',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table dipcommerce_db.tb_users : 2 rows
/*!40000 ALTER TABLE `tb_users` DISABLE KEYS */;
INSERT INTO `tb_users` (`id`, `profil_id`, `service_id`, `categorie_personnel_id`, `type_personnel_id`, `equipe_id`, `bureauID`, `nom`, `prenoms`, `civilite`, `date_naissance`, `telephone`, `matricule`, `photo`, `adresse_email`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `ip_derniere_connexion`, `date_derniere_connexion`, `statut_connexion`, `statut_signature`, `statut`) VALUES
	(2, 1, 1, 4, 1, 0, 0, 'BOUSSOU', 'JUSTE', 'M.', '2020-06-06', '0778607985', NULL, 'ph2_1624290376317IMG_20210607_164641.jpg', '', 'juste', '$2y$10$fZhXFwI.ut.FPElsY9Fk1eItums4OvPFpD.AqAqTD43x8ZPZQAmG2', 'iUQFOf5PPLP2PyYFgLouCVIuUEYRXJ22VXJbYaVfF24qAxkb7KSDEpAvm9xH', '2021-03-10 00:00:00', '2021-07-05 08:30:52', '127.0.0.1', '2021-07-05 08:30:52', 'CONNECTE', NULL, 'VALIDE'),
	(1, 1, 1, 1, 1, 0, 0, 'KOUASSI', 'RICHMOND', 'M.', '2020-06-06', '0708031746', NULL, 'ph1_1620901561048ph4_1615373851975135160607_10164592007005223_8140133135769055267_o.jpg', '', 'richmond', '$2y$10$fZhXFwI.ut.FPElsY9Fk1eItums4OvPFpD.AqAqTD43x8ZPZQAmG2', 'I6gM3Uc9fZPk30q2PJh6UOLTnzNaiBU6LJJyh5HBuxXJc5bZRw7rL1nAL1z7', '2021-03-10 00:00:00', '2021-07-26 17:12:12', '127.0.0.1', '2021-07-26 17:12:12', 'CONNECTE', NULL, 'VALIDE');
/*!40000 ALTER TABLE `tb_users` ENABLE KEYS */;

-- Listage de la structure de la table dipcommerce_db. utilisateur
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `utilisateur_id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_nom` varchar(50) DEFAULT NULL,
  `utilisateur_prenoms` varchar(50) DEFAULT NULL,
  `utilisateur_telephone` varchar(50) DEFAULT NULL,
  `utilisateur_login` varchar(50) DEFAULT NULL,
  `utilisateur_password` varchar(50) DEFAULT NULL,
  `utilisateur_statut` enum('BROUILLON','VALIDE','SUPPRIME') DEFAULT 'VALIDE',
  PRIMARY KEY (`utilisateur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Listage des données de la table dipcommerce_db.utilisateur : ~0 rows (environ)
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` (`utilisateur_id`, `utilisateur_nom`, `utilisateur_prenoms`, `utilisateur_telephone`, `utilisateur_login`, `utilisateur_password`, `utilisateur_statut`) VALUES
	(1, NULL, NULL, '0708031746', 'edgard', NULL, NULL);
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
