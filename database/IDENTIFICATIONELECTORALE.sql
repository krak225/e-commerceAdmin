-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           10.2.3-MariaDB-log - mariadb.org binary distribution
-- SE du serveur:                Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Export de la structure de la table recensement_db. bureau
CREATE TABLE IF NOT EXISTS `bureau` (
  `bureauID` int(11) NOT NULL,
  `typeDeBureauID` char(1) CHARACTER SET utf8 NOT NULL,
  `regionID` int(11) NOT NULL,
  `bureauLibelle` varchar(254) DEFAULT NULL,
  `bureauCode` varchar(254) DEFAULT NULL,
  `bureauDescription` varchar(254) DEFAULT NULL,
  `bureauStatut` enum('BROUILLON','VALIDE','SUPPRIME','CLOTURE') DEFAULT NULL,
  PRIMARY KEY (`bureauID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Export de données de la table recensement_db.bureau : ~2 rows (environ)
/*!40000 ALTER TABLE `bureau` DISABLE KEYS */;
INSERT INTO `bureau` (`bureauID`, `typeDeBureauID`, `regionID`, `bureauLibelle`, `bureauCode`, `bureauDescription`, `bureauStatut`) VALUES
	(1, '1', 1, 'CIRCONSCRIPTION YOPOUGON', NULL, NULL, NULL),
	(2, '1', 1, 'CIRCONSCRIPTION ADJAME', NULL, NULL, NULL);
/*!40000 ALTER TABLE `bureau` ENABLE KEYS */;

-- Export de la structure de la table recensement_db. commune
CREATE TABLE IF NOT EXISTS `commune` (
  `COMMUNE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `COMMUNE_LIBELLE` varchar(50) DEFAULT NULL,
  `COMMUNE_STATUT` enum('BROUILLON','VALIDE','SUPPRIME') NOT NULL DEFAULT 'VALIDE',
  PRIMARY KEY (`COMMUNE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Export de données de la table recensement_db.commune : ~4 rows (environ)
/*!40000 ALTER TABLE `commune` DISABLE KEYS */;
INSERT INTO `commune` (`COMMUNE_ID`, `COMMUNE_LIBELLE`, `COMMUNE_STATUT`) VALUES
	(1, 'YOPOUGON', 'VALIDE'),
	(2, 'COCODY', 'VALIDE'),
	(3, 'MARCORY', 'VALIDE'),
	(4, 'PLATEAU', 'VALIDE');
/*!40000 ALTER TABLE `commune` ENABLE KEYS */;

-- Export de la structure de la table recensement_db. electeur
CREATE TABLE IF NOT EXISTS `electeur` (
  `ELECTEUR_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `USER_ID` int(11) NOT NULL,
  `quartierID` int(11) DEFAULT NULL,
  `PROFESSION_ID` int(11) DEFAULT NULL,
  `ELECTEUR_NOM` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ELECTEUR_PRENOMS` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ELECTEUR_SEXE` enum('FEMME','HOMME') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ELECTEUR_DATE_NAISSANCE` date DEFAULT NULL,
  `ELECTEUR_LIEU_NAISSANCE` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ELECTEUR_NATURE_PIECE` enum('CNI','ONI','PASSP','PC','AUTRE') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ELECTEUR_NUMERO_PIECE` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ELECTEUR_NUMERO_CARTE_ELECTEUR` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ELECTEUR_EMAIL` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ELECTEUR_TELEPHONE_MOBILE` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ELECTEUR_TELEPHONE_BUREAU` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ELECTEUR_LOCALISATION` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ELECTEUR_PHOTO` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ELECTEUR_DATE_CREATION` datetime NOT NULL,
  `ELECTEUR_DATE_MODIFICATION` datetime DEFAULT NULL,
  `ELECTEUR_DATE_SUPPRESSION` datetime DEFAULT NULL,
  `ELECTEUR_STATUT` enum('BROUILLON','VALIDE','SUPPRIME') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'VALIDE',
  `ANCIEN_LIEU_VOTE_QUARTIER` int(11) DEFAULT NULL,
  `ELECTEUR_COMMENTAIRE` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ELECTEUR_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Export de données de la table recensement_db.electeur : ~14 rows (environ)
/*!40000 ALTER TABLE `electeur` DISABLE KEYS */;
INSERT INTO `electeur` (`ELECTEUR_ID`, `USER_ID`, `quartierID`, `PROFESSION_ID`, `ELECTEUR_NOM`, `ELECTEUR_PRENOMS`, `ELECTEUR_SEXE`, `ELECTEUR_DATE_NAISSANCE`, `ELECTEUR_LIEU_NAISSANCE`, `ELECTEUR_NATURE_PIECE`, `ELECTEUR_NUMERO_PIECE`, `ELECTEUR_NUMERO_CARTE_ELECTEUR`, `ELECTEUR_EMAIL`, `ELECTEUR_TELEPHONE_MOBILE`, `ELECTEUR_TELEPHONE_BUREAU`, `ELECTEUR_LOCALISATION`, `ELECTEUR_PHOTO`, `ELECTEUR_DATE_CREATION`, `ELECTEUR_DATE_MODIFICATION`, `ELECTEUR_DATE_SUPPRESSION`, `ELECTEUR_STATUT`, `ANCIEN_LIEU_VOTE_QUARTIER`, `ELECTEUR_COMMENTAIRE`) VALUES
	(1, 1, 1, 1, 'KONE', 'KINAMPINAN', 'HOMME', '2018-06-11', 'KATIOLA', NULL, 'CI0022', 'CE001', NULL, '09218813', NULL, 'YOPOUGON', NULL, '2018-06-11 11:00:29', NULL, NULL, 'VALIDE', NULL, NULL),
	(3, 1, 1, 1, 'KOUASSI', 'RICHMOND', 'HOMME', '1986-12-13', 'BOUAKE', NULL, 'CI019333', 'CE001', 'krak225@gmail.com', '08779408', NULL, NULL, 'ph_aa2bd7c70f134091893136725fa8f1fb.jpeg', '2018-06-11 11:50:46', NULL, NULL, 'VALIDE', NULL, NULL),
	(4, 1, 2, 2, 'DOVOGUIE', 'FLORA NADINE', 'FEMME', '1987-03-01', 'Gagnoa', NULL, 'C0017309211', 'CE002', 'flora.dovoguie@gmail.com', '07402891', NULL, NULL, 'ph_232242e9ac6933cece73dcc03cbd831c.jpeg', '2018-06-11 12:13:38', NULL, '2018-06-11 15:32:36', 'SUPPRIME', NULL, NULL),
	(5, 1, 2, 1, 'KOUASSI', 'KONAN MARC', 'HOMME', '2018-06-12', 'BOUAFLE', NULL, 'CI00018371', 'CE003', 'marc@gmail.com', '04351167', NULL, NULL, 'ph_c35e4b5427e9956b28609896cea6fe0f.jpeg', '2018-06-11 12:37:04', NULL, '2018-06-11 23:17:57', 'SUPPRIME', NULL, NULL),
	(6, 1, 2, 2, 'KOUAKOU', 'AMOIN LYDIA', 'FEMME', '1991-06-13', 'DALOA', NULL, 'CI000100121', 'CE004', 'lydia.kouakou@gmail.com', '07218932', NULL, NULL, 'ph_2041396726a1ee1a62698d16d193ffb3.jpeg', '2018-06-11 12:53:58', NULL, NULL, 'VALIDE', NULL, NULL),
	(7, 1, 2, 3, 'SERIGBA', 'GRACE EPIPHANIE', NULL, '2000-06-07', 'SAN-PEDRO', NULL, 'CI00180002', 'CE005', 'epiphanie@gmail.com', '07621440', NULL, NULL, 'ph_c9960b80a159d0093f7aae5173e967b4.jpeg', '2018-06-11 12:57:16', '2018-06-11 15:33:00', NULL, 'VALIDE', NULL, NULL),
	(8, 1, 2, 1, 'UN sdsd', 'sdskldj', NULL, '2000-01-01', 'SDKHK', NULL, 'SDSD', 'SDSD', 'sjdsk@sfs.fr', 'SDSDSD', NULL, NULL, 'ph_a4f9eca4ed89d03d6823808cfe3042d7.jpeg', '2018-06-11 14:00:50', '2018-06-11 15:55:15', '2018-06-11 16:54:12', 'SUPPRIME', NULL, NULL),
	(9, 1, 1, 1, 'UPDATED', 'hlh', NULL, '2018-06-07', 'sjhkhdk', NULL, 'khfdf', 'jkh', 'hksdsd@sfsf.fe', 'kjh', NULL, NULL, 'ph_0e3e0fee239d849b82b5db788ddcb8e3.jpeg', '2018-06-11 15:01:32', '2018-06-11 15:52:13', '2018-06-11 16:54:15', 'SUPPRIME', NULL, NULL),
	(10, 1, 1, 1, 'Updated by krak', 'Updated by krak', NULL, '2018-06-06', 'sdsdsd', NULL, 'sjkdhk', 'ssd', 'ksd@sdsd.ss', 'SDSD', NULL, NULL, 'ph_552b54fa96e90cd6565fb71968e9fc5a.jpeg', '2018-06-11 15:03:30', '2018-06-11 15:52:47', '2018-06-11 16:54:17', 'SUPPRIME', NULL, NULL),
	(11, 1, 2, 1, 'DOVOGUIE 2', 'FLORA NADINE 2', NULL, '1987-03-01', 'Gagnoa 2', NULL, 'C0017309211 2', 'CE002 2', 'flora.dovoguie@gmail.com2', '07402891 2', NULL, NULL, '', '2018-06-11 15:28:54', '2018-06-11 15:58:36', '2018-06-11 16:54:22', 'SUPPRIME', NULL, NULL),
	(12, 2, 1, 2, 'FOFANA', 'MARIAM', NULL, '2000-12-02', 'KORHOGO', NULL, 'CI00180003', 'CE006', 'fofana@yahoo.fr', '01010101', NULL, NULL, NULL, '2018-06-11 16:20:08', '2018-06-11 16:32:25', '2018-06-11 16:53:08', 'SUPPRIME', NULL, NULL),
	(13, 2, 1, 2, 'KOFFI', 'KONAN EDGARD', NULL, '1990-02-12', 'Yamoussoukro', NULL, 'PC0001', 'CE00012', 'edgard@gmail.com', '07070707', NULL, 'Carefour policier', NULL, '2018-06-11 21:49:56', '2018-06-11 21:53:53', NULL, 'VALIDE', NULL, NULL),
	(14, 2, 2, 2, 'DIARRASSOUBA', 'MARIAM', NULL, '1981-06-06', 'ABOBO', NULL, 'PSP0013', 'CE00013', 'mariam@gmail.com', '08754434', NULL, 'Dans la cité', NULL, '2018-06-11 22:11:09', NULL, NULL, 'VALIDE', NULL, NULL),
	(15, 1, 1, 1, 'KOUASSI', 'ARMAND', NULL, '1988-01-22', 'BOUAKE', NULL, 'ATT0013', 'CE00013', 'krak225@gmail.com', '04783689', '08779408', 'Carefour policier', NULL, '2018-06-11 23:17:46', NULL, NULL, 'VALIDE', NULL, NULL),
	(16, 1, 2, 3, 'RICHARD', 'FREDY', NULL, '2000-11-06', 'BANGKOK', NULL, 'ATT001', 'CE001', 'fredrich@yahoo.fr', '09224921', '23002102', 'En face de la station Texaco de la liberté', NULL, '2018-06-12 04:32:23', '2018-06-12 04:33:57', NULL, 'VALIDE', NULL, NULL);
/*!40000 ALTER TABLE `electeur` ENABLE KEYS */;

-- Export de la structure de la table recensement_db. groupesaisie
CREATE TABLE IF NOT EXISTS `groupesaisie` (
  `groupeSaisieID` int(11) NOT NULL,
  `groupeSaisieReference` varchar(254) DEFAULT NULL,
  `groupeSaisieNomResponsable` varchar(254) DEFAULT NULL,
  `groupeSaisiePhone1Responsable` varchar(254) DEFAULT NULL,
  `groupeSaisiePhone2Responsable` varchar(254) DEFAULT NULL,
  `groupeSaisieDateCreation` datetime DEFAULT NULL,
  `groupeSaisieDateModification` datetime DEFAULT NULL,
  `groupeSaisieDateSuppression` datetime DEFAULT NULL,
  `groupeSaisieDateSysteme` datetime DEFAULT NULL,
  `groupeSaisieStatut` enum('BROUILLON','VALIDE','SUPPRIME','CLOTURE') DEFAULT NULL,
  PRIMARY KEY (`groupeSaisieID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Export de données de la table recensement_db.groupesaisie : ~0 rows (environ)
/*!40000 ALTER TABLE `groupesaisie` DISABLE KEYS */;
/*!40000 ALTER TABLE `groupesaisie` ENABLE KEYS */;

-- Export de la structure de la table recensement_db. inscrit
CREATE TABLE IF NOT EXISTS `inscrit` (
  `inscritID` int(11) NOT NULL,
  `quartierID` int(11) DEFAULT NULL,
  `inscritNom` varchar(254) DEFAULT NULL,
  `inscritPrenoms` varchar(254) DEFAULT NULL,
  `inscritDateNaissance` datetime DEFAULT NULL,
  `inscritLieuNaissance` varchar(254) DEFAULT NULL,
  `inscritNaturePiece` enum('CNI','ONI','PASSP','PC','AUTRE') DEFAULT NULL,
  `inscritNumeroPiece` varchar(254) DEFAULT NULL,
  `inscritNumeroCarteElecteur` varchar(254) DEFAULT NULL,
  `inscritEmail` varchar(254) DEFAULT NULL,
  `inscritPhoneMobile` varchar(254) DEFAULT NULL,
  `inscritLocalisation` varchar(254) DEFAULT NULL,
  `inscritDateCreation` datetime DEFAULT NULL,
  `inscritDateModification` datetime DEFAULT NULL,
  `inscritDateSuppression` datetime DEFAULT NULL,
  `inscritDateSysteme` datetime DEFAULT NULL,
  `inscritStatut` enum('BROUILLON','VALIDE','SUPPRIME','CLOTURE') DEFAULT NULL,
  PRIMARY KEY (`inscritID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Export de données de la table recensement_db.inscrit : ~0 rows (environ)
/*!40000 ALTER TABLE `inscrit` DISABLE KEYS */;
/*!40000 ALTER TABLE `inscrit` ENABLE KEYS */;

-- Export de la structure de la table recensement_db. migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Export de données de la table recensement_db.migrations : ~4 rows (environ)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2018_09_11_000000_create_electeur_table', 2),
	(4, '2018_09_11_000000_create_profession_table', 3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Export de la structure de la table recensement_db. password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Export de données de la table recensement_db.password_resets : ~0 rows (environ)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Export de la structure de la table recensement_db. profession
CREATE TABLE IF NOT EXISTS `profession` (
  `PROFESSION_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PROFESSION_LIBELLE` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PROFESSION_STATUT` enum('BROUILLON','VALIDE','SUPPRIME') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'VALIDE',
  PRIMARY KEY (`PROFESSION_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Export de données de la table recensement_db.profession : ~4 rows (environ)
/*!40000 ALTER TABLE `profession` DISABLE KEYS */;
INSERT INTO `profession` (`PROFESSION_ID`, `PROFESSION_LIBELLE`, `PROFESSION_STATUT`) VALUES
	(1, 'Informaticien', 'VALIDE'),
	(2, 'Enseignant', 'VALIDE'),
	(3, 'Commerçant', 'VALIDE'),
	(4, 'Autre', 'VALIDE');
/*!40000 ALTER TABLE `profession` ENABLE KEYS */;

-- Export de la structure de la table recensement_db. quartier
CREATE TABLE IF NOT EXISTS `quartier` (
  `quartierID` int(11) NOT NULL,
  `bureauID` int(11) NOT NULL,
  `quartierLibelle` varchar(254) DEFAULT NULL,
  `quartierCode` varchar(254) DEFAULT NULL,
  `quartierDescription` varchar(254) DEFAULT NULL,
  `quartierStatut` enum('BROUILLON','VALIDE','SUPPRIME','CLOTURE') DEFAULT NULL,
  PRIMARY KEY (`quartierID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Export de données de la table recensement_db.quartier : ~2 rows (environ)
/*!40000 ALTER TABLE `quartier` DISABLE KEYS */;
INSERT INTO `quartier` (`quartierID`, `bureauID`, `quartierLibelle`, `quartierCode`, `quartierDescription`, `quartierStatut`) VALUES
	(1, 1, 'Niangon', 'Ng', NULL, NULL),
	(2, 2, 'Adjamé Liberté', 'Lb', NULL, NULL);
/*!40000 ALTER TABLE `quartier` ENABLE KEYS */;

-- Export de la structure de la table recensement_db. region
CREATE TABLE IF NOT EXISTS `region` (
  `regionID` int(11) NOT NULL,
  `regionNom` varchar(254) DEFAULT NULL,
  `regionDescription` varchar(254) DEFAULT NULL,
  `regionStatut` enum('BROUILLON','VALIDE','SUPPRIME','CLOTURE') DEFAULT NULL,
  PRIMARY KEY (`regionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Export de données de la table recensement_db.region : ~0 rows (environ)
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
/*!40000 ALTER TABLE `region` ENABLE KEYS */;

-- Export de la structure de la table recensement_db. typedebureau
CREATE TABLE IF NOT EXISTS `typedebureau` (
  `typeDeBureauID` char(1) CHARACTER SET utf8 NOT NULL,
  `typeDeBureauLibelle` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`typeDeBureauID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Export de données de la table recensement_db.typedebureau : ~0 rows (environ)
/*!40000 ALTER TABLE `typedebureau` DISABLE KEYS */;
/*!40000 ALTER TABLE `typedebureau` ENABLE KEYS */;

-- Export de la structure de la table recensement_db. userrevision
CREATE TABLE IF NOT EXISTS `userrevision` (
  `groupeSaisieID` int(11) DEFAULT NULL,
  `userRevisionID` int(11) DEFAULT NULL,
  `userRevisionReference` varchar(254) DEFAULT NULL,
  `userRevisionName` varchar(254) DEFAULT NULL,
  `userRevisionEmail` varchar(254) DEFAULT NULL,
  `userRevisionPassword` varchar(254) DEFAULT NULL,
  `userRevisionStatut` enum('BROUILLON','VALIDE','SUPPRIME','CLOTURE') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Export de données de la table recensement_db.userrevision : ~0 rows (environ)
/*!40000 ALTER TABLE `userrevision` DISABLE KEYS */;
/*!40000 ALTER TABLE `userrevision` ENABLE KEYS */;

-- Export de la structure de la table recensement_db. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `groupeSaisieID` int(10) unsigned NOT NULL DEFAULT 0,
  `nom` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenoms` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `profil_id` int(11) NOT NULL DEFAULT 2,
  `telephone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `statut` enum('VALIDE','SUPPRIME') COLLATE utf8mb4_unicode_ci DEFAULT 'VALIDE',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Export de données de la table recensement_db.users : ~2 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `groupeSaisieID`, `nom`, `prenoms`, `date_naissance`, `profil_id`, `telephone`, `photo`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `statut`) VALUES
	(1, 2, 'Kouassi', 'Armand', NULL, 1, '04783689', '', 'krak225@gmail.com', '$2y$10$fZhXFwI.ut.FPElsY9Fk1eItums4OvPFpD.AqAqTD43x8ZPZQAmG2', 'xXTHa3LTEjBz80DZBInhRwgv08Inb9hHDnitM4WWN4g5kk8Z59FerW2xEScg', '2018-06-10 20:48:46', '2018-06-11 23:20:54', 'VALIDE'),
	(2, 1, 'Digbé', 'Arsène', '2018-06-11', 2, '08779408', '08779408', '08779408', '$2y$10$fADoNaMb6yRZWAn6MFMX6ecs0iy.HnRxHfHfuAadxFjyKV4T6UkhC', 'RWsBSnncgZbF5lVvVxmVRTzV7CvtZwJEWfZUeVh2Ki3J2pU1hvcLgGUwmCAx', '2018-06-11 16:16:26', NULL, 'VALIDE');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
