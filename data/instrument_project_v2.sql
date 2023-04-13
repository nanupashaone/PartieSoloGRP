-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : mar. 04 avr. 2023 à 12:09
-- Version du serveur : 10.6.5-MariaDB
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `instrument_project`
--

-- --------------------------------------------------------

--
-- Structure de la table `artiste`
--

DROP TABLE IF EXISTS `artiste`;
CREATE TABLE IF NOT EXISTS `artiste` (
  `artisteID` int(11) NOT NULL,
  `instrumentID` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  KEY `instrumentID` (`instrumentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `contactID` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`contactID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `instrument`
--

DROP TABLE IF EXISTS `instrument`;
CREATE TABLE IF NOT EXISTS `instrument` (
  `instrumentID` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`instrumentID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `instrument`
--

INSERT INTO `instrument` (`instrumentID`, `titre`, `description`, `date`) VALUES
(1, 'Flûte en bois (biseau) ', 'La flûte traversière semble être l\'un des plus anciens instruments de musique.  On trouve, dès l’ère paléolithique, de nombreuses traces de flûtes en os, percées ou non de trous. Elle est vraisemblablement apparue en chine vers 2700 avant J-C. On trouvait aussi des flûtes chez les égyptiens (droite et oblique) et chez les grecs qui jouaient surtout de la flûte dans la musique populaire, alors que les anches étaient réservées à la musique officielle et sacrée.  \r\n\r\nToutefois, l\'évolution la plus importante dans l\'histoire de la flûte moderne commence au Moyen Âge. Vers le XIIe siècle, de l’Orient (empire byzantin), par l’Europe centrale, nous arrivent les flûtes traversières et les flûtes à bec. La flûte traversière est appelée flûte allemande (car apparue d\'abord dans les terres allemandes) pour entre autre la distinguer des autres formes de flûtes comme la flûte à bec.  \r\n\r\nLa Renaissance (1500-1600) est une période au cours de laquelle les flûtes se multiplient : les premiers grands luthiers proposent un large éventail. La sonorité de la flûte est pleine, douce, et se marie admirablement avec la plupart des instruments de l’époque. Toutefois, jusqu\'au XIXe siècle, elle n\'est pas très populaire : elle joue plutôt faux ! En effet, les trous étaient placés là où ils étaient facilement accessibles par le flûtiste, et non pas là où ils rendaient le son le plus juste. De plus, il n\'y a pas beaucoup de trous et les doigtés en deviennent très compliqués.  ', '2023-04-04'),
(2, 'Basson (anche double)', 'Tout ce que vous avez toujours voulu savoir sur un instrument intriguant.  \r\n\r\nSans doute l’instrument à vent le plus singulier, de par sa configuration : quatre éléments en bois reliés à un petit tuyau de métal recourbé appelé bocal, dans lequel – grâce à une anche double – souffle le bassoniste. Formé de deux branches juxtaposées pouvant faire penser à un petit fagot – d’où le nom allemand Fagott – il mesure au total 2,50 m. Particulièrement lourd, une courroie passée autour du cou est nécessaire pour en jouer. On trouve à son origine des instruments de la Renaissance comme le dulcian et, après les améliorations d’Heckel, il se vit doté de 24 clés et 5 soupapes. ', '2023-04-04');

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `idmedias` int(11) NOT NULL AUTO_INCREMENT,
  `instrumentID` int(4) NOT NULL,
  `img-url` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  PRIMARY KEY (`idmedias`),
  KEY `instrumentID` (`instrumentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET latin1 NOT NULL,
  `user-pwd` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `artiste`
--
ALTER TABLE `artiste`
  ADD CONSTRAINT `artiste_ibfk_1` FOREIGN KEY (`instrumentID`) REFERENCES `instrument` (`instrumentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`instrumentID`) REFERENCES `instrument` (`instrumentID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
