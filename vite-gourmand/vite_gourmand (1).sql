-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 26 fév. 2026 à 18:08
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `vite_gourmand`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `date_commande` datetime DEFAULT current_timestamp(),
  `date_livraison` datetime NOT NULL,
  `lieu_livraison` varchar(255) NOT NULL,
  `nb_personnes` int(11) NOT NULL,
  `prix_total` decimal(10,2) NOT NULL,
  `statut` enum('en_attente','accepte','preparation','livraison','livre','termine','annule') DEFAULT 'en_attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `utilisateur_id`, `menu_id`, `date_commande`, `date_livraison`, `lieu_livraison`, `nb_personnes`, `prix_total`, `statut`) VALUES
(1, 3, 4, '2026-02-18 17:25:57', '2026-02-19 20:25:00', 'paris (Hors-Bordeaux)', 10, 316.80, 'en_attente');

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `prix_par_personne` decimal(10,2) NOT NULL,
  `min_personnes` int(11) DEFAULT 1,
  `theme` varchar(50) DEFAULT NULL,
  `regime` varchar(50) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `stock_disponible` int(11) DEFAULT 100
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `menu`
--

INSERT INTO `menu` (`id`, `titre`, `description`, `prix_par_personne`, `min_personnes`, `theme`, `regime`, `image_url`, `stock_disponible`) VALUES
(1, 'Menu Noël', 'Dinde aux marrons et bûche glacée', 25.00, 4, 'Noel', 'Classique', 'noel.jpg', 100),
(2, 'Menu Vegan Printemps', 'Salade composée et tofu grillé', 18.50, 2, 'Printemps', 'Vegan', 'vegan.jpg', 100),
(3, 'Buffet de Printemps', 'Un buffet frais avec des produits de saison', 22.50, 5, 'Printemps', 'Classique', 'menu3.jpg', 100),
(4, 'Menu Garden Party', 'Idéal pour vos soirées en extérieur', 30.00, 10, 'Eté', 'Vegan', 'menu1.jpg', 100);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `role` enum('client','employe','admin') DEFAULT 'client',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`, `telephone`, `adresse`, `role`, `created_at`) VALUES
(1, 'Admin', 'Principal', 'admin@test.fr', '$2y$10$C8.c/wH0.2.1.2.1.2.1.2.1.2.1.2.1.', NULL, NULL, 'admin', '2026-02-16 12:57:10'),
(3, 'fariz mohamed', '', 'farizmoha91@gmail.com', '$2y$10$qqJZY5LL.ekH6CrLmNV9huCq2FmSp6DduBEGhKXyBosPCAUz6Ppum', NULL, NULL, 'client', '2026-02-18 16:12:05'),
(5, 'fariz mohamed', '', 'farizmohamed109@gmail.com', '$2y$10$DtpvA7kf6qawNPu8cpbIney/qYGlJ9SKKqFXWa.laQ47yLEOl3FRO', NULL, NULL, 'client', '2026-02-18 16:14:16'),
(8, 'moha moha ', '', 'coopfrz@gmail.com', '$2y$10$UofbKrhzwr2R24pUCCH3EewGHaSAhj2TumXAaXMv2EKFncVCrMtfS', NULL, NULL, 'client', '2026-02-19 15:08:24');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Index pour la table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
