-- phpMyAdmin SQL Dump
-- version 5.1.1-1.fc33
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 24 juin 2021 à 12:51
-- Version du serveur : 10.4.19-MariaDB
-- Version de PHP : 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `title`) VALUES
(28, 'Ring 1'),
(29, 'Ring 2'),
(30, 'Ring 3'),
(31, 'Ring 4'),
(32, 'Other');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `post_id_id` int(11) NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20201227103115', '2020-12-27 10:31:28', 58),
('DoctrineMigrations\\Version20201227103328', '2020-12-27 10:33:31', 59),
('DoctrineMigrations\\Version20201227103635', '2020-12-27 10:36:38', 219),
('DoctrineMigrations\\Version20201228094730', '2020-12-28 09:47:40', 50),
('DoctrineMigrations\\Version20201230105914', '2020-12-30 10:59:52', 64),
('DoctrineMigrations\\Version20201230162427', '2020-12-30 16:24:34', 191),
('DoctrineMigrations\\Version20201231143047', '2020-12-31 14:30:57', 211),
('DoctrineMigrations\\Version20210101104003', '2021-01-01 10:40:11', 55);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `is_solved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `author`, `subcategory_id`, `created_at`, `is_solved`) VALUES
(18, 'blabla', 'blablabla', 'test', 53, '2021-06-24 12:10:39', 0);

-- --------------------------------------------------------

--
-- Structure de la table `post_like`
--

CREATE TABLE `post_like` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `subcategory`
--

INSERT INTO `subcategory` (`id`, `category_id`, `title`) VALUES
(53, 28, 'Libft'),
(54, 28, 'get_next_line'),
(55, 28, 'Printf'),
(56, 28, 'Netwhat'),
(57, 29, 'Cub3D'),
(58, 29, 'ft_server'),
(59, 29, 'minirt'),
(60, 29, 'exam02'),
(61, 30, 'libasm'),
(62, 30, 'ft_services'),
(63, 30, 'minishell'),
(64, 30, 'exam03'),
(65, 31, 'philosopher'),
(66, 31, 'exam04'),
(67, 32, 'unclassified');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`) VALUES
(12, 'test@test.com', 'test', '$2y$13$TU6tMTrGP/90ntBc9M1.IOwPOIjsCE854w4GBbEx8JSWxtxADrbHy');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526CE85F12B8` (`post_id_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5A8A6C8D5DC6FE57` (`subcategory_id`);

--
-- Index pour la table `post_like`
--
ALTER TABLE `post_like`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_653627B84B89032C` (`post_id`),
  ADD KEY `IDX_653627B8A76ED395` (`user_id`);

--
-- Index pour la table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DDCA44812469DE2` (`category_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `post_like`
--
ALTER TABLE `post_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT pour la table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526CE85F12B8` FOREIGN KEY (`post_id_id`) REFERENCES `post` (`id`);

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_5A8A6C8D5DC6FE57` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`id`);

--
-- Contraintes pour la table `post_like`
--
ALTER TABLE `post_like`
  ADD CONSTRAINT `FK_653627B84B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `FK_653627B8A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `FK_DDCA44812469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
