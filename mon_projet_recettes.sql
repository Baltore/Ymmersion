-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 21 fév. 2025 à 05:09
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mon_projet_recettes`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `recette_id` int NOT NULL,
  `contenu` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` int NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_67F068BC89312FE9` (`recette_id`),
  KEY `IDX_67F068BCA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20250219030425', '2025-02-19 03:04:53', 2429),
('DoctrineMigrations\\Version20250219032952', '2025-02-19 03:30:01', 60),
('DoctrineMigrations\\Version20250219034817', '2025-02-19 03:48:25', 171),
('DoctrineMigrations\\Version20250219162855', '2025-02-19 16:29:01', 1825),
('DoctrineMigrations\\Version20250219165943', '2025-02-19 16:59:53', 124),
('DoctrineMigrations\\Version20250220005849', '2025-02-20 00:58:58', 2401),
('DoctrineMigrations\\Version20250220010132', '2025-02-20 01:01:38', 97),
('DoctrineMigrations\\Version20250220010436', '2025-02-20 01:04:41', 74),
('DoctrineMigrations\\Version20250220014256', '2025-02-20 01:43:05', 50);

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`id`, `nom`, `created_at`) VALUES
(1, 'steak de bœuf', '2025-02-19 23:51:51'),
(2, 'entrecôte', '2025-02-19 23:51:51'),
(3, 'faux-filet', '2025-02-19 23:53:25'),
(4, 'rumsteck', '2025-02-19 23:53:25'),
(5, 'Tomate', '2025-02-20 00:56:13'),
(6, 'Oignon', '2025-02-20 00:56:13'),
(7, 'Ail', '2025-02-20 00:56:13'),
(8, 'Pomme de terre', '2025-02-20 00:56:13'),
(9, 'Carotte', '2025-02-20 00:56:13'),
(10, 'Poivron rouge', '2025-02-20 00:56:13'),
(11, 'Courgette', '2025-02-20 00:56:13'),
(12, 'Aubergine', '2025-02-20 00:56:13'),
(13, 'Champignon', '2025-02-20 00:56:13'),
(14, 'Persil', '2025-02-20 00:56:13'),
(15, 'Basilic', '2025-02-20 00:56:13'),
(16, 'Huile d\'olive', '2025-02-20 00:56:13'),
(17, 'Beurre', '2025-02-20 00:56:13'),
(18, 'Sel', '2025-02-20 00:56:13'),
(19, 'Poivre', '2025-02-20 00:56:13'),
(20, 'Farine', '2025-02-20 00:57:46'),
(21, 'Sucre', '2025-02-20 00:57:46'),
(22, 'Lait', '2025-02-20 00:57:46'),
(23, 'Œufs', '2025-02-20 00:57:46'),
(24, 'Levure', '2025-02-20 00:57:46'),
(25, 'Chocolat', '2025-02-20 00:57:46'),
(26, 'Fromage', '2025-02-20 00:57:46'),
(27, 'Jambon', '2025-02-20 00:57:46'),
(28, 'Poulet', '2025-02-20 00:57:46'),
(29, 'Bœuf', '2025-02-20 00:57:46'),
(30, 'Poisson', '2025-02-20 00:57:46'),
(31, 'Saumon', '2025-02-20 00:57:46'),
(32, 'Thon', '2025-02-20 00:57:46'),
(33, 'Crevettes', '2025-02-20 00:57:46'),
(34, 'Calamar', '2025-02-20 00:57:46'),
(35, 'Courge', '2025-02-20 00:57:46'),
(36, 'Lentilles', '2025-02-20 00:57:46'),
(37, 'Pois chiche', '2025-02-20 00:57:46'),
(38, 'Riz', '2025-02-20 00:57:46'),
(39, 'Pâtes', '2025-02-20 00:57:46'),
(40, 'Couscous', '2025-02-20 00:57:46'),
(41, 'Quinoa', '2025-02-20 00:57:46'),
(42, 'Miel', '2025-02-20 00:57:46'),
(43, 'Noisettes', '2025-02-20 00:57:46'),
(44, 'Amandes', '2025-02-20 00:57:46'),
(45, 'Cacahuètes', '2025-02-20 00:57:46'),
(46, 'Curry', '2025-02-20 00:57:46'),
(47, 'Paprika', '2025-02-20 00:57:46'),
(48, 'Cumin', '2025-02-20 00:57:46'),
(49, 'Safran', '2025-02-20 00:57:46'),
(52, 'Bouillon de légumes', '0000-00-00 00:00:00'),
(53, 'Crème fraîche', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

DROP TABLE IF EXISTS `recette`;
CREATE TABLE IF NOT EXISTS `recette` (
  `id` int NOT NULL AUTO_INCREMENT,
  `auteur_id` int NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `temps_preparation` int NOT NULL,
  `temps_cuisson` int NOT NULL,
  `portions` int NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_49BB639060BB6FE6` (`auteur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`id`, `auteur_id`, `titre`, `description`, `temps_preparation`, `temps_cuisson`, `portions`, `created_at`, `image_name`, `updated_at`) VALUES
(1, 2, 'Soupe de carotte', 'Une soupe onctueuse à base de carottes et d\'épices douces.', 15, 30, 4, '2025-02-20 01:03:45', 'soupe_de_carotte.webp', NULL),
(2, 5, 'Steak Frites', 'Un steak grillé accompagné de frites croustillantes.', 10, 15, 2, '2025-02-20 01:03:45', 'steak_Frites.webp', NULL),
(3, 6, 'Poulet Basquaise', 'Un plat traditionnel du Pays Basque avec du poulet, des poivrons et des tomates.', 15, 50, 4, '2025-02-20 12:15:00', 'Poulet_Basquaise.webp', NULL),
(4, 7, 'Ratatouille Provençale', 'Un mélange savoureux de légumes d\'été mijotés avec de l\'huile d\'olive.', 30, 40, 6, '2025-02-20 12:30:00', 'Ratatouille.webp', NULL),
(5, 7, 'Quiche Lorraine', 'Une quiche savoureuse à base de jambon, fromage et crème fraîche.', 20, 40, 6, '2025-02-20 12:45:00', 'Quiche_Lorraine.webp', NULL),
(6, 8, 'Soupe aux Légumes', 'Une soupe réconfortante avec carottes, pommes de terre et poireaux.', 15, 30, 4, '2025-02-20 13:00:00', 'Soupe_aux_Legumes.webp', NULL),
(7, 9, 'Curry de Poulet', 'Un curry épicé de poulet avec lait de coco, curry et cumin.', 25, 45, 4, '2025-02-20 13:15:00', 'Poulet_Curry.webp', NULL),
(8, 10, 'Spaghetti Bolognaise', 'Un classique italien à base de bœuf haché et sauce tomate maison.', 20, 60, 4, '2025-02-20 13:30:00', 'Spaghetti_Bolognaise.webp', NULL),
(9, 11, 'Tarte au Chocolat', 'Une tarte gourmande avec une ganache au chocolat fondante.', 30, 0, 8, '2025-02-20 13:45:00', 'Tarte_au_Chocolat.webp', NULL),
(10, 2, 'Omelette aux Champignons', 'Une omelette légère et savoureuse aux champignons et fromage.', 10, 5, 2, '2025-02-20 14:00:00', 'Omelette_aux_Champignons.webp', NULL),
(11, 13, 'Salade César', 'Une salade fraîche avec du poulet, parmesan et sauce crémeuse.', 15, 0, 2, '2025-02-20 14:15:00', 'Salade_Cesar.webp', NULL),
(12, 2, 'Bœuf Stroganoff', 'Un délicieux plat de bœuf mijoté avec des champignons et une sauce crémeuse.', 20, 40, 4, '2025-02-20 12:00:00', 'Bœuf_Stroganoff.webp', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `recette_ingredient`
--

DROP TABLE IF EXISTS `recette_ingredient`;
CREATE TABLE IF NOT EXISTS `recette_ingredient` (
  `recette_id` int NOT NULL,
  `ingredient_id` int NOT NULL,
  `quantite` double NOT NULL,
  `unite` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `IDX_17C041A989312FE9` (`recette_id`),
  KEY `IDX_17C041A9933FE08C` (`ingredient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recette_ingredient`
--

INSERT INTO `recette_ingredient` (`recette_id`, `ingredient_id`, `quantite`, `unite`, `id`) VALUES
(1, 6, 1, '', 1),
(1, 9, 500, 'g', 2),
(1, 16, 1, 'càc', 3),
(1, 18, 1, 'pincée', 4),
(1, 19, 1, 'pincée', 5),
(1, 52, 1, 'L', 6),
(1, 53, 10, 'cl', 7),
(2, 1, 200, 'g', 8),
(2, 7, 1, 'gousse', 9),
(2, 8, 500, 'g', 10),
(2, 16, 400, 'ml', 11),
(2, 17, 20, 'g', 12),
(2, 18, 1, 'pincée', 13),
(2, 19, 1, 'pincée', 14),
(3, 28, 1, 'kg', 15),
(3, 5, 3, 'unités', 16),
(3, 6, 1, 'unité', 17),
(3, 10, 1, 'unité', 18),
(3, 17, 20, 'g', 19),
(3, 18, 1, 'c.à.c', 20),
(3, 19, 1, 'c.à.c', 21),
(4, 5, 4, 'unités', 22),
(4, 10, 1, 'unité', 23),
(4, 11, 1, 'unité', 24),
(4, 12, 1, 'unité', 25),
(4, 6, 1, 'unité', 26),
(4, 16, 3, 'c.à.s', 27),
(4, 14, 1, 'botte', 28),
(5, 26, 200, 'g', 29),
(5, 27, 200, 'g', 30),
(5, 17, 50, 'g', 31),
(5, 20, 100, 'g', 32),
(5, 22, 250, 'ml', 33),
(5, 23, 3, 'unités', 34),
(5, 18, 1, 'c.à.c', 35),
(5, 19, 1, 'c.à.c', 36),
(6, 5, 2, 'unités', 37),
(6, 9, 2, 'unités', 38),
(6, 8, 3, 'unités', 39),
(6, 6, 1, 'unité', 40),
(6, 7, 2, 'gousses', 41),
(6, 16, 2, 'c.à.s', 42),
(6, 18, 1, 'c.à.c', 43),
(6, 19, 1, 'c.à.c', 44),
(7, 28, 500, 'g', 45),
(7, 6, 1, 'unité', 46),
(7, 7, 2, 'gousses', 47),
(7, 22, 200, 'ml', 48),
(7, 46, 1, 'c.à.s', 49),
(7, 17, 30, 'g', 50),
(7, 18, 1, 'c.à.c', 51),
(7, 19, 1, 'c.à.c', 52),
(8, 39, 300, 'g', 53),
(8, 29, 400, 'g', 54),
(8, 5, 4, 'unités', 55),
(8, 6, 1, 'unité', 56),
(8, 7, 2, 'gousses', 57),
(8, 16, 2, 'c.à.s', 58),
(8, 18, 1, 'c.à.c', 59),
(8, 19, 1, 'c.à.c', 60),
(9, 20, 200, 'g', 61),
(9, 21, 100, 'g', 62),
(9, 17, 150, 'g', 63),
(9, 23, 2, 'unités', 64),
(9, 25, 200, 'g', 65),
(10, 23, 4, 'unités', 66),
(10, 13, 200, 'g', 67),
(10, 6, 1, 'unité', 68),
(10, 17, 30, 'g', 69),
(10, 18, 1, 'c.à.c', 70),
(10, 19, 1, 'c.à.c', 71),
(11, 28, 200, 'g', 72),
(11, 26, 50, 'g', 73),
(11, 16, 2, 'c.à.s', 74),
(11, 18, 1, 'c.à.c', 75),
(11, 19, 1, 'c.à.c', 76),
(12, 29, 500, 'g', 77),
(12, 6, 1, 'unité', 78),
(12, 7, 2, 'gousses', 79),
(12, 13, 150, 'g', 80),
(12, 17, 50, 'g', 81),
(12, 53, 100, 'ml', 82),
(12, 18, 1, 'c.à.c', 83),
(12, 19, 1, 'c.à.c', 84);

-- --------------------------------------------------------

--
-- Structure de la table `recette_likes`
--

DROP TABLE IF EXISTS `recette_likes`;
CREATE TABLE IF NOT EXISTS `recette_likes` (
  `recette_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`recette_id`,`user_id`),
  KEY `IDX_B53EC6EB89312FE9` (`recette_id`),
  KEY `IDX_B53EC6EBA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recette_likes`
--

INSERT INTO `recette_likes` (`recette_id`, `user_id`) VALUES
(1, 2),
(1, 5),
(1, 18),
(2, 2),
(3, 2),
(3, 21),
(4, 19),
(5, 2),
(5, 22),
(6, 10),
(7, 2),
(8, 2),
(8, 7),
(8, 17),
(9, 15),
(10, 7),
(10, 8),
(10, 9),
(10, 10),
(11, 2),
(11, 24),
(12, 2),
(12, 17),
(12, 23);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649D17F50A6` (`uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `uuid`, `roles`, `password`) VALUES
(1, 'admin', '[\"ROLE_ADMIN\"]', '$2y$13$hW91RUviX3nchQGLlt8X0efz6B681WYcGEpN7ziYMenrMsPgO2s.K'),
(2, 'qays', '[\"ROLE_USER\"]', '$2y$13$Wul8qrqWahbhamRiZAv1N.CY575nNUOLraZ5vomV9Cuz3TZ2rFKuq'),
(5, 'test', '[\"ROLE_USER\"]', '$2y$13$InyCXPeUr6mlLZBaTTzFbe9tjMboGY19WD7d4rCZ1PC1nP210sgxy'),
(6, 'Matthis', '[\"ROLE_USER\"]', '$2y$13$Ta7irC5nX96q5VbCEq3dI.L3AIzqeLgwjxKHN.zCc4e5DiDwuWa5C'),
(7, 'alice', '[\"ROLE_USER\"]', '$2y$12$abcdefghijklmnopqrstuv'),
(8, 'bob', '[\"ROLE_USER\"]', '$2y$12$abcdefghijklmnopqrstuv'),
(9, 'charlie', '[\"ROLE_USER\"]', '$2y$12$abcdefghijklmnopqrstuv'),
(10, 'david', '[\"ROLE_USER\"]', '$2y$12$abcdefghijklmnopqrstuv'),
(11, 'emma', '[\"ROLE_USER\"]', '$2y$12$abcdefghijklmnopqrstuv'),
(12, 'frank', '[\"ROLE_USER\"]', '$2y$12$abcdefghijklmnopqrstuv'),
(13, 'grace', '[\"ROLE_USER\"]', '$2y$12$abcdefghijklmnopqrstuv'),
(14, 'henry', '[\"ROLE_USER\"]', '$2y$12$abcdefghijklmnopqrstuv'),
(15, 'isabel', '[\"ROLE_USER\"]', '$2y$12$abcdefghijklmnopqrstuv'),
(16, 'jack', '[\"ROLE_USER\"]', '$2y$12$abcdefghijklmnopqrstuv'),
(17, 'kate', '[\"ROLE_USER\"]', '$2y$12$abcdefghijklmnopqrstuv'),
(18, 'liam', '[\"ROLE_USER\"]', '$2y$12$abcdefghijklmnopqrstuv'),
(19, 'mia', '[\"ROLE_USER\"]', '$2y$12$abcdefghijklmnopqrstuv'),
(20, 'noah', '[\"ROLE_USER\"]', '$2y$12$abcdefghijklmnopqrstuv'),
(21, 'olivia', '[\"ROLE_USER\"]', '$2y$12$abcdefghijklmnopqrstuv'),
(22, 'peter', '[\"ROLE_USER\"]', '$2y$12$abcdefghijklmnopqrstuv'),
(23, 'quinn', '[\"ROLE_USER\"]', '$2y$12$abcdefghijklmnopqrstuv'),
(24, 'rachel', '[\"ROLE_USER\"]', '$2y$12$abcdefghijklmnopqrstuv');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_67F068BC89312FE9` FOREIGN KEY (`recette_id`) REFERENCES `recette` (`id`),
  ADD CONSTRAINT `FK_67F068BCA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `recette`
--
ALTER TABLE `recette`
  ADD CONSTRAINT `FK_49BB639060BB6FE6` FOREIGN KEY (`auteur_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `recette_ingredient`
--
ALTER TABLE `recette_ingredient`
  ADD CONSTRAINT `FK_17C041A989312FE9` FOREIGN KEY (`recette_id`) REFERENCES `recette` (`id`),
  ADD CONSTRAINT `FK_17C041A9933FE08C` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`);

--
-- Contraintes pour la table `recette_likes`
--
ALTER TABLE `recette_likes`
  ADD CONSTRAINT `FK_B53EC6EB89312FE9` FOREIGN KEY (`recette_id`) REFERENCES `recette` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B53EC6EBA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
