-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 01 oct. 2022 à 08:16
-- Version du serveur : 5.7.33
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `retrotv`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `idSerie` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `actif` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `content`, `idSerie`, `users_id`, `actif`, `created_at`) VALUES
(1, 'Ceci est un test.', 73347, 1, 0, '2021-08-19 19:53:02'),
(2, 'Ceci est le test 2', 73347, 1, 0, '2021-08-19 19:55:55'),
(3, 'Test 3', 73347, 1, 1, '2021-08-19 19:59:21'),
(4, 'Test avec un autre pseudo', 73347, 6, 1, '2021-08-20 20:16:57');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `pseudo` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `roles` json DEFAULT NULL,
  `actif` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `pseudo`, `password`, `roles`, `actif`) VALUES
(1, 'will@remi.fr', 'willremi', '$argon2i$v=19$m=65536,t=4,p=1$elMyWWM4eXY1Smt4WVlQZw$ul+F2p6e1HFaHCC65xGgBUvVGJ/1TSlRi8u6EbnPQAE', '[\"ROLE_ADMIN\"]', 1),
(2, 'willremi@gmail.com', 'remi', '$argon2i$v=19$m=65536,t=4,p=1$S1VPUWY2ZzNoRGFvOHBMVA$PrOar/pQ0DecvMwwm+M/eKtHqOfUX9uZUNrwnKt5rz4', NULL, 0),
(5, 'willdomi@remi.fr', 'willdomin', '$argon2i$v=19$m=65536,t=4,p=1$VFJkQ1ZTSDAxeFQ3U1htMA$QSwe2TDlOlKTRGFzPrYz/cEhxudz1UTIGTtK3xJ3pDQ', NULL, 0),
(6, 'willremi@yahoo.fr', 'rÃ©mi', '$argon2i$v=19$m=65536,t=4,p=1$Q1NyS2c2aEVUQ2htT2diVQ$4SGg7XR+R+AdVtmi4TcwkUKtfD59ZiZqJw8smmKuJ24', NULL, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
