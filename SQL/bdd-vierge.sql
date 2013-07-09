-- 
-- Structure de la table 'tclients'
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Structure de la table 'tinterventions'
-- 

DROP TABLE IF EXISTS `tinterventions`;
CREATE TABLE IF NOT EXISTS `tinterventions` (
  `codeIntervention` int(11) NOT NULL AUTO_INCREMENT,
  `codeClient` int(11) NOT NULL,
  `codePreInterv` int(11) NOT NULL,
  `dateInterv` char(10) NULL,
  `antivirus` varchar(15) NOT NULL,
  `malwares` varchar(15) NOT NULL,
  `spybot` varchar(15) NOT NULL,
  `logiciels` varchar(200) NOT NULL,
  `maj` varchar(200) NOT NULL,
  `virus` varchar(200) NOT NULL,
  `reinstall` varchar(200) NOT NULL,
  `ram` varchar(100) NOT NULL,
  `intervention` char(50) NOT NULL,
  `materiel` char(50) NOT NULL,
  `observations` char(200) NOT NULL,
  `technicien` char(50) NOT NULL,
  `prix` char(15) NOT NULL,
  PRIMARY KEY (`codeIntervention`),
  KEY `codeClient` (`codeClient`),
  KEY `codePreInterv` (`codePreInterv`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Structure de la table 'tlogiciels'
-- 

DROP TABLE IF EXISTS `tlogiciels`;
CREATE TABLE IF NOT EXISTS `tlogiciels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Contenu de la table 'tlogiciels'
-- 

INSERT INTO `tlogiciels` VALUES (1, 'Antivirus MSE');
INSERT INTO `tlogiciels` VALUES (2, 'Spybot');
INSERT INTO `tlogiciels` VALUES (3, 'Sumatra PDF');
INSERT INTO `tlogiciels` VALUES (4, 'Nero 7');
INSERT INTO `tlogiciels` VALUES (5, 'VLC');
INSERT INTO `tlogiciels` VALUES (6, 'Open Office');
INSERT INTO `tlogiciels` VALUES (7, 'Pack Microsoft Office');

-- 
-- Structure de la table 'ttechniciens'
-- 

DROP TABLE IF EXISTS `ttechniciens`;
CREATE TABLE IF NOT EXISTS `ttechniciens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` char(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Contenu de la table 'ttechniciens'
-- 

INSERT INTO `ttechniciens` VALUES (1, 'GILLES');
INSERT INTO `ttechniciens` VALUES (2, 'NICOLAS');
INSERT INTO `ttechniciens` VALUES (3, 'SOLENE');
INSERT INTO `ttechniciens` VALUES (4, 'JULIEN');
INSERT INTO `ttechniciens` VALUES (5, 'GILLES ET NICOLAS');
INSERT INTO `ttechniciens` VALUES (6, 'GILLES ET SOLENE');
INSERT INTO `ttechniciens` VALUES (7, 'GILLES ET JULIEN');
INSERT INTO `ttechniciens` VALUES (8, 'NICOLAS ET SOLENE');
INSERT INTO `ttechniciens` VALUES (9, 'NICOLAS ET JULIEN');
INSERT INTO `ttechniciens` VALUES (10, 'SOLENE ET JULIEN');

-- 
-- Structure de la table 'ttypeinterv'
-- 

DROP TABLE IF EXISTS `ttypeinterv`;
CREATE TABLE IF NOT EXISTS `ttypeinterv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `interv` char(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Contenu de la table 'ttypeinterv'
-- 

INSERT INTO `ttypeinterv` VALUES (1, 'NETTOYAGE');
INSERT INTO `ttypeinterv` VALUES (2, 'FORMATAGE');
INSERT INTO `ttypeinterv` VALUES (3, 'MO ATELIER');
INSERT INTO `ttypeinterv` VALUES (4, 'AUTRES');

-- 
-- Structure de la table 'ttypemateriel'
-- 

DROP TABLE IF EXISTS `ttypemateriel`;
CREATE TABLE IF NOT EXISTS `ttypemateriel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materiel` char(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Contenu de la table 'ttypemateriel'
-- 

INSERT INTO `ttypemateriel` VALUES (1, 'PC FIXE');
INSERT INTO `ttypemateriel` VALUES (2, 'PC PORTABLE');
INSERT INTO `ttypemateriel` VALUES (3, 'TABLETTE TACTILE');
INSERT INTO `ttypemateriel` VALUES (4, 'IMPRIMANTE');
INSERT INTO `ttypemateriel` VALUES (5, 'PERIPHERIQUE');
INSERT INTO `ttypemateriel` VALUES (6, 'AUTRES');

-- 
-- Contenu de la table 'tnews'
-- 

DROP TABLE IF EXISTS `tnews`;
CREATE TABLE IF NOT EXISTS `tnews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news` text CHARACTER SET latin1 NOT NULL,
  `dateNews` char(15) CHARACTER SET latin1 NOT NULL,
  `auteur` char(20) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Contenu de la table 'tnews'
-- 

INSERT INTO `tnews` VALUES (1, 'Gestion des fiches d&apos;intervention en ligne ! - Création d&apos;un système de news OK ! - Des modifications subsidiaires restent à effectuer, mais le plus gros du travail est effectué !','25/02/13','JULIEN');
INSERT INTO `tnews` VALUES (2, 'Nombreuses modifications effectuées... Partie pré-intervention & interventions OK !! Il reste à voir maintenant quelques petites options à rectifier, mais dans l&apos;ensemble, le système est stable et viable !','27/02/13','JULIEN');
-- 
-- Structure de la table 'tpreinterv'
-- 

DROP TABLE IF EXISTS `tpreinterv`;
CREATE TABLE IF NOT EXISTS `tpreinterv` (
  `codePreInterv` int(11) NOT NULL AUTO_INCREMENT,
  `codeClient` int(11) NOT NULL,
  `dateDepot` char(10) CHARACTER SET latin1 NULL,
  `dateRestitution` char(10) CHARACTER SET latin1 NULL,
  `materiel` char(25) CHARACTER SET latin1 NULL,
  `typeInterv` char(50) CHARACTER SET latin1 NULL,
  `observations` text CHARACTER SET latin1 NULL,
  `password` char(20) CHARACTER SET latin1 NULL,
  `dossierMesDocs` char(50) CHARACTER SET latin1 NULL,
  `dossierClt` char(50) CHARACTER SET latin1 NULL,
  PRIMARY KEY (`codePreInterv`),
  KEY `codeClient` (`codeClient`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

