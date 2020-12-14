-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 14 déc. 2020 à 12:17
-- Version du serveur :  5.7.24
-- Version de PHP : 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `livreor`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `commentaire`, `id_utilisateur`, `date`) VALUES
(1, 'un super message', 1, '2020-12-02 15:01:33'),
(2, 'Un super message', 1, '2020-12-02 15:28:44'),
(3, 'Un super message', 1, '2020-12-02 15:29:32'),
(4, 'Un super message (encore)', 1, '2020-12-02 15:29:47'),
(5, 'lorem ipsum quelque chose', 1, '2020-12-02 15:43:07'),
(6, 'lorem ipsum quelque chose', 1, '2020-12-02 15:43:45'),
(7, 'Les patates sont cuites', 1, '2020-12-02 16:21:57'),
(8, 'Test Gaspardg', 3, '2020-12-14 10:04:55'),
(9, 'test Gaspard25', 3, '2020-12-14 10:05:21'),
(10, 'Test test', 3, '2020-12-14 12:12:31'),
(11, 'Test test', 3, '2020-12-14 12:13:03'),
(12, 'Test timezone', 3, '2020-12-14 13:16:58');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`) VALUES
(1, 'Sarp', '$2y$10$SGLxAnDwED3QDR1RcVlAuem6TeXVxUArI3QL8uO3jnd/owBexpW2K'),
(2, 'Patate', '$2y$10$LmhQT0YIRkt4lARmHG/2o.xJGIDw0uvz1SCjw9Hz/Gtb6gW06A3z2'),
(3, 'Gaspardg90', '$2y$10$tHH3INmpsBTKzUwSELGvwObfnEDqgMbiu5nOLFC0NbQMUm23C84sC');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
