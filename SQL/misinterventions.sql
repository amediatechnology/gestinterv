-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 13 Février 2013 à 16:25
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `misinterventions`
--

-- --------------------------------------------------------

--
-- Structure de la table `tclients`
--
-- Création: Sam 09 Février 2013 à 09:37
--

DROP TABLE IF EXISTS `tclients`;
CREATE TABLE IF NOT EXISTS `tclients` (
  `codeClient` int(11) NOT NULL AUTO_INCREMENT,
  `nom` char(50) CHARACTER SET latin1 NOT NULL,
  `prenom` char(50) CHARACTER SET latin1 NOT NULL,
  `telFixe` char(20) CHARACTER SET latin1 NOT NULL,
  `telPort` char(20) COLLATE latin1_general_ci NOT NULL,
  `adresse` char(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`codeClient`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tpreinterv`
--

CREATE TABLE IF NOT EXISTS `tpreinterv` (
  `codePreInterv` int(11) NOT NULL AUTO_INCREMENT,
  `codeClient` int(11) NOT NULL,
  `dateDepot` char(10) CHARACTER SET latin1 DEFAULT NULL,
  `dateRestitution` char(10) CHARACTER SET latin1 DEFAULT NULL,
  `materiel` char(25) CHARACTER SET latin1 DEFAULT NULL,
  `typeInterv` char(50) CHARACTER SET latin1 DEFAULT NULL,
  `observations` text CHARACTER SET latin1,
  `password` char(20) CHARACTER SET latin1 DEFAULT NULL,
  `dossierMesDocs` char(50) CHARACTER SET latin1 DEFAULT NULL,
  `dossierClt` char(50) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`codePreInterv`),
  KEY `codeClient` (`codeClient`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;


--
-- Structure de la table `tinterventions`
--
-- Création: Sam 09 Février 2013 à 09:37
--

DROP TABLE IF EXISTS `tinterventions`;
CREATE TABLE IF NOT EXISTS `tinterventions` (
  `codeIntervention` int(11) NOT NULL AUTO_INCREMENT,
  `codeClient` int(11) NOT NULL,
  `codePreInterv` int(11) NOT NULL,
  `dateInterv` char(10) COLLATE latin1_general_ci DEFAULT NULL,
  `antivirus` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `malwares` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `spybot` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `logiciels` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `maj` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `virus` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `reinstall` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `ram` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `intervention` char(50) COLLATE latin1_general_ci NOT NULL,
  `materiel` char(50) COLLATE latin1_general_ci NOT NULL,
  `observations` char(200) COLLATE latin1_general_ci NOT NULL,
  `technicien` char(50) COLLATE latin1_general_ci NOT NULL,
  `prix` char(15) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`codeIntervention`),
  KEY `codeClient` (`codeClient`),
  KEY `codePreInterv` (`codePreInterv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------

--
-- Structure de la table `tlogiciels`
--
-- Création: Mer 13 Février 2013 à 14:01
--

DROP TABLE IF EXISTS `tlogiciels`;
CREATE TABLE IF NOT EXISTS `tlogiciels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `tlogiciels`
--

INSERT INTO `tlogiciels` (`id`, `nom`) VALUES
(1, 'Antivirus MSE'),
(2, 'Spybot'),
(3, 'Sumatra PDF'),
(4, 'Nero 7'),
(5, 'VLC'),
(6, 'Open Office 4'),
(7, 'Pack Microsoft Office 2003'),
(8, 'Pack Microsoft Office 2007'),
(9, 'Classic Shell');

-- --------------------------------------------------------

--
-- Structure de la table `ttechniciens`
--
-- Création: Sam 09 Février 2013 à 09:37
--

DROP TABLE IF EXISTS `ttechniciens`;
CREATE TABLE IF NOT EXISTS `ttechniciens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` char(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=14 ;

--
-- Contenu de la table `ttechniciens`
--

INSERT INTO `ttechniciens` (`id`, `nom`) VALUES
(1, 'GILLES'),
(2, 'NICOLAS'),
(3, 'JULIEN'),
(4, 'GILLES ET NICOLAS'),
(5, 'GILLES ET JULIEN'),
(6, 'NICOLAS ET JULIEN');

-- --------------------------------------------------------

--
-- Structure de la table `ttypeinterv`
--
-- Création: Sam 09 Février 2013 à 09:37
--

DROP TABLE IF EXISTS `ttypeinterv`;
CREATE TABLE IF NOT EXISTS `ttypeinterv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `interv` char(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=17 ;

--
-- Contenu de la table `ttypeinterv`
--

INSERT INTO `ttypeinterv` (`id`, `interv`) VALUES
(1, 'NETTOYAGE'),
(2, 'FORMATAGE'),
(3, 'MO ATELIER'),
(4, 'ACHAT PC FIXE NEUF'),
(5, 'ACHAT PC PORTABLE ASUS'),
(6, 'ACHAT PC PORTABLE ACER'),
(7, 'ACHAT PC PORTABLE SONY'),
(8, 'ACHAT PC PORTABLE TOSHIBA'),
(9, 'ACHAT TABLETTE ASUS'),
(10, 'ACHAT TABLETTE ACER'),
(11, 'ACHAT TABLETTE SAMSUNG'),
(12, 'ACHAT TABLETTE SONY'),
(13, 'ACHAT PIECES'),
(14, 'ACHAT PERIPHERIQUES'),
(15, 'ACHAT IMPRIMANTE'),
(16, 'ACHAT CARTOUCHES IMPRIMANTE');

-- --------------------------------------------------------

--
-- Structure de la table `ttypemateriel`
--
-- Création: Sam 09 Février 2013 à 09:37
--

DROP TABLE IF EXISTS `ttypemateriel`;
CREATE TABLE IF NOT EXISTS `ttypemateriel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materiel` char(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=13 ;

--
-- Contenu de la table `ttypemateriel`
--

INSERT INTO `ttypemateriel` (`id`, `materiel`) VALUES
(1, 'PC FIXE'),
(2, 'PC PORTABLE'),
(3, 'PC PORTABLE ASUS'),
(4, 'PC PORTABLE ACER'),
(5, 'PC PORTABLE SAMSUNG'),
(6, 'PC PORTABLE SONY'),
(7, 'PC PORTABLE TOSHIBA'),
(8, 'TABLETTE TACTILE'),
(9, 'TABLETTE TACTILE ASUS'),
(10, 'TABLETTE TACTILE ACER'),
(11, 'TABLETTE TACTILE SAMSUNG'),
(12, 'TABLETTE TACTILE SONY'),
(13, 'IMPRIMANTE MULTIFONCTIONS'),
(14, 'PERIPHERIQUE');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


--
-- Structure de la table `tnews`
--

CREATE TABLE IF NOT EXISTS `tnews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news` text COLLATE latin1_general_ci NOT NULL,
  `dateNews` char(15) CHARACTER SET latin1 NOT NULL,
  `auteur` char(20) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;