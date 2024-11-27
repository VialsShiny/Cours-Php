-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 25 nov. 2024 à 08:57
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `eshop`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
                            `id_commande` int NOT NULL,
                            `id_membre` int DEFAULT NULL,
                            `montant` int NOT NULL,
                            `date_enregistrement` datetime NOT NULL,
                            `etat` enum('en cours de traitement','envoyé','livré') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `details_commande`
--

CREATE TABLE `details_commande` (
                                    `id_details_commande` int NOT NULL,
                                    `id_commande` int DEFAULT NULL,
                                    `id_produit` int DEFAULT NULL,
                                    `quantite` int NOT NULL,
                                    `prix` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
                          `id_membre` int NOT NULL,
                          `pseudo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `mdp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `civilite` enum('m','f') COLLATE utf8mb4_unicode_ci NOT NULL,
                          `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `code_postal` int(5) NOT NULL,
                          `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `statut` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `civilite`, `ville`, `code_postal`, `adresse`, `statut`) VALUES
                                                                                                                                           (15, 'Mila', 'admin', 'Gauriau', 'Mila', 'moi@moi.fr', 'f', 'PARIS', 75017, '11 avenue des Chasseurs', 1),
                                                                                                                                           (16, 'Pixel', 'Pixel', 'Gauriau', 'Pixel', 'pixel@miaou.fr', 'm', 'PARIS', 75017, '11 avenue des Chats', 0);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
                           `id_produit` int NOT NULL,
                           `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `categorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
                           `couleur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `taille` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `public` enum('m','f','mixte') COLLATE utf8mb4_unicode_ci NOT NULL,
                           `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `prix` float NOT NULL,
                           `stock` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `reference`, `categorie`, `titre`, `description`, `couleur`, `taille`, `public`, `photo`, `prix`, `stock`) VALUES
                                                                                                                                                    (4, '0001', 'pantalon', 'Jean', 'jean bleu', 'bleu', 'S', 'f', 'photo/ref0001-pantalon1.jpg', 89, 3),
                                                                                                                                                    (6, '0003', 'pull', 'pull blanc', 'pull blanc', 'blanc', 'S', 'f', 'photo/ref0003-pull1.jpg', 50, 12),
                                                                                                                                                    (8, '0005', 'robe', 'robe noire', 'pour vos soirées et cocktails', 'noir', 'S', 'f', 'photo/ref0005-robe1.jpg', 99, 54),
                                                                                                                                                    (9, '0006', 'robe', 'robe rouge', 'robe de cocktail', 'rouge', 'S', 'f', 'photo/ref0006-robe2.jpg', 79.9, 0),
                                                                                                                                                    (10, '0007', 'pull', 'pull', 'pull', 'blanc', 'L', 'm', 'photo/ref0007-pull1.jpg', 49, 11),
                                                                                                                                                    (11, '0008', 'pantalon', 'pantalon flanelle', 'pantalon homme', 'noir', 'XL', 'm', 'photo/ref0008-pull2.jpg', 39.5, 8),
                                                                                                                                                    (12, '0009', 'robe', 'robe de plage', 'robe de plage', 'bleu', 'M', 'f', 'photo/ref009-robe1.jpg', 56, 4),
                                                                                                                                                    (13, '0010', 'robe', 'robe corail', 'robe orange corail', 'corail', 'L', 'f', 'photo/ref0010-robe2.jpg', 67.8, 35),
                                                                                                                                                    (14, '0011', 'chaussure', 'tennis', 'tennis bleu et blanc', 'bleu', 'L', 'm', 'photo/ref0011-pantalon2.jpg', 49.9, 8),
                                                                                                                                                    (15, '0012', 'chaussure', 'escarpins', 'chaussures élégantes', 'noir', 'S', 'f', 'photo/ref0012-robe1.jpg', 46, 2),
                                                                                                                                                    (16, '001', 'pull', 'test', 'test', 'red', 's', 'mixte', 'photos/survol_img2.jpg', 1, 1),
                                                                                                                                                    (17, '001', 'pull', 'test', 'test', 'red', 's', 'mixte', 'photos/toureiffel.jpg', 1, 1),
                                                                                                                                                    (18, '001', 'pull', 'test', 'tst', 'red', 'L', 'mixte', 'photos/survol_img3.jpg', 100, 200);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
    ADD PRIMARY KEY (`id_commande`);

--
-- Index pour la table `details_commande`
--
ALTER TABLE `details_commande`
    ADD PRIMARY KEY (`id_details_commande`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
    ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
    ADD PRIMARY KEY (`id_produit`),
  ADD UNIQUE KEY `id_produit` (`id_produit`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
    MODIFY `id_commande` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `details_commande`
--
ALTER TABLE `details_commande`
    MODIFY `id_details_commande` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
    MODIFY `id_membre` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
    MODIFY `id_produit` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;