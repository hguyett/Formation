-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Ven 10 Mars 2017 à 21:25
-- Version du serveur :  5.7.14
-- Version de PHP :  7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `combat_minigame`
--
CREATE DATABASE IF NOT EXISTS `combat_minigame` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `combat_minigame`;

-- --------------------------------------------------------

--
-- Structure de la table `characters`
--

CREATE TABLE `characters` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `damages` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `characters`
--

INSERT INTO `characters` (`id`, `name`, `damages`) VALUES
(1, 'Dren', 0),
(2, 'Dren2', 0),
(3, 'Créer le personnage', 0),
(4, 'Dren4', 0),
(5, 'Dren5', 0),
(6, 'Dren6', 0),
(7, 'Dren7', 0),
(8, 'test', 0),
(9, 'test3', 0),
(10, 'Dren8', 0),
(11, 'Dren9', 0),
(12, 'Dren10', 0),
(13, 'Dren11', 0),
(14, 'Dren12', 0),
(15, 'Dren13', 0),
(16, 'Juju', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `characters`
--
ALTER TABLE `characters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
