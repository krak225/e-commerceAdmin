-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Serveur: 127.0.0.1
-- Généré le : Lun 18 Février 2019 à 11:46
-- Version du serveur: 5.5.10
-- Version de PHP: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `kpay_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_code_mobile` int(11) NOT NULL DEFAULT '0',
  `client_raison_sociale` varchar(100) DEFAULT NULL,
  `client_representant` varchar(100) DEFAULT NULL,
  `client_statut` enum('BROUILLON','VALIDE','SUPPRIME') NOT NULL DEFAULT 'BROUILLON',
  PRIMARY KEY (`client_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='enregistre les clients' AUTO_INCREMENT=4 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`client_id`, `client_code_mobile`, `client_raison_sociale`, `client_representant`, `client_statut`) VALUES
(1, 190001, 'MAQUIS CHEZ HELENE', 'KOUAME HELENE', 'BROUILLON'),
(2, 190002, 'GLACIER PICASSO', 'COULIBALY BAKARY', 'BROUILLON'),
(3, 190003, 'CYBER LA VITESSE', 'IRIE BI JEAN-CLAUDE', 'BROUILLON');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE IF NOT EXISTS `facture` (
  `facture_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `facture_libelle` varchar(100) DEFAULT NULL,
  `facture_montant_ttc` int(11) DEFAULT NULL,
  `facture_solde` int(11) DEFAULT NULL,
  `facture_statut` enum('VALIDE','GENERE','SUPPRIME') DEFAULT 'VALIDE',
  PRIMARY KEY (`facture_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `facture`
--

INSERT INTO `facture` (`facture_id`, `client_id`, `facture_libelle`, `facture_montant_ttc`, `facture_solde`, `facture_statut`) VALUES
(1, 1, 'Facture Janvier 2018', 10000, 10000, 'VALIDE'),
(2, 1, 'FÃ©vrier 2018', 10000, 10000, 'VALIDE'),
(3, 1, 'Mars 2018', 10000, 10000, 'VALIDE'),
(4, 2, 'Janvier 2018', 15000, 15000, 'VALIDE'),
(5, 2, 'FÃ©vrier 2018', 15000, 15000, 'VALIDE'),
(6, 2, 'Mars 2018', 15000, 15000, 'VALIDE'),
(7, 3, 'Janvier 2018', 5000, 5000, 'VALIDE'),
(8, 3, 'FÃ©vrier 2018', 5000, 5000, 'VALIDE'),
(9, 3, 'Mars 2018', 5000, 5000, 'VALIDE');

-- --------------------------------------------------------

--
-- Structure de la table `kw_administrateur`
--

CREATE TABLE IF NOT EXISTS `kw_administrateur` (
  `kw_administrateur_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kw_administrateur_login` varchar(255) NOT NULL,
  `kw_administrateur_pass` varchar(255) NOT NULL,
  `kw_administrateur_email` varchar(50) NOT NULL,
  `kw_administrateur_rang` int(11) NOT NULL,
  `kw_administrateur_statut` enum('ACTIVE','DESACTIVE') NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`kw_administrateur_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='enregistre les administrateurs du site' AUTO_INCREMENT=3 ;

--
-- Contenu de la table `kw_administrateur`
--

INSERT INTO `kw_administrateur` (`kw_administrateur_id`, `kw_administrateur_login`, `kw_administrateur_pass`, `kw_administrateur_email`, `kw_administrateur_rang`, `kw_administrateur_statut`) VALUES
(1, 'admin', 'fece6adde0ec8c975e2b5ec91fce57ab1852fca4', 'krak225@gmail.com', 1, 'ACTIVE'),
(2, 'admin', 'fece6adde0ec8c975e2b5ec91fce57ab1852fca4', 'krak225@gmail.com', 1, 'ACTIVE');

-- --------------------------------------------------------

--
-- Structure de la table `reglement`
--

CREATE TABLE IF NOT EXISTS `reglement` (
  `reglement_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `reglement_montant` double DEFAULT NULL,
  `reglement_nombre_facture` int(11) NOT NULL DEFAULT '0',
  `reglement_date` datetime DEFAULT NULL,
  `reglement_statut` enum('VALIDE','GENERE','CLOTURE','ANNULE') DEFAULT NULL,
  PRIMARY KEY (`reglement_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `reglement`
--

INSERT INTO `reglement` (`reglement_id`, `client_id`, `reglement_montant`, `reglement_nombre_facture`, `reglement_date`, `reglement_statut`) VALUES
(1, 1, 10000, 1, '2018-01-01 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reglement_facture`
--

CREATE TABLE IF NOT EXISTS `reglement_facture` (
  `reglement_facture_id` int(11) NOT NULL AUTO_INCREMENT,
  `reglement_id` int(11) DEFAULT NULL,
  `facture_id` int(11) DEFAULT NULL,
  `reglement_facture_montant_regle` double DEFAULT NULL,
  `reglement_facture_date` datetime DEFAULT NULL,
  `reglement_facture_statut` enum('BROUILLON','VALIDE','CLOTURE','GENERE') DEFAULT 'BROUILLON',
  PRIMARY KEY (`reglement_facture_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `reglement_facture`
--

INSERT INTO `reglement_facture` (`reglement_facture_id`, `reglement_id`, `facture_id`, `reglement_facture_montant_regle`, `reglement_facture_date`, `reglement_facture_statut`) VALUES
(1, 1, 1, 10000, '2018-01-01 00:00:00', 'BROUILLON');
