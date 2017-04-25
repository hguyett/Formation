-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1:3306
-- Généré le :  Mar 25 Avril 2017 à 13:30
-- Version du serveur :  5.7.14
-- Version de PHP :  7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `frontend`
--
CREATE DATABASE IF NOT EXISTS `frontend` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `frontend`;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `news` smallint(5) UNSIGNED NOT NULL,
  `author` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `news` (`news`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id`, `news`, `author`, `content`, `date`) VALUES
(6, 1, 'Justine', 'Il a l\'air super ton blog ! Continue comme ça :-)', '2017-04-09 22:02:49');

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `author` varchar(30) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `dateAdded` datetime NOT NULL,
  `dateEdited` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `news`
--

INSERT INTO `news` (`id`, `author`, `title`, `content`, `dateAdded`, `dateEdited`) VALUES
(1, 'Drenock', 'Mon premier article', 'Bonjour à tous !\r\n\r\nJe vous souhaite la bienvenue sur mon nouveau blog. Celui-ci a pour objectif de m\'entraîner au développement web. Je l\'ai conçu moi-même en PHP orienté objet ! J\'espère qu\'il vous plaira :-)\r\n\r\nJe vous tiendrai informé des évolution du blog sur cette page, alors stay tuned :-D\r\n\r\n@ bientôt !', '2017-03-23 11:09:41', '2017-03-24 16:24:45');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`news`) REFERENCES `news` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
