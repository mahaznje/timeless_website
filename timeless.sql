-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le : mer. 18 déc. 2024 à 14:48
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
-- Base de données : `timeless`
--

-- --------------------------------------------------------

--
-- Structure de la table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_nom` varchar(60) NOT NULL,
  `brand_img` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_nom`, `brand_img`) VALUES
(1, 'zara', 'brand (1).png'),
(2, 'pull&bear', 'brand (2).png'),
(3, 'Ralph Lauren', 'brand (3).png'),
(4, 'Calvin klien ', 'brand (4).png'),
(5, 'Guess', 'brand (5).png');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `command_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `DateCommande` datetime DEFAULT current_timestamp(),
  `StatutCommande` varchar(20) DEFAULT 'En cours',
  `MontantTotal` decimal(10,2) NOT NULL,
  `adresse_livraison` text DEFAULT NULL,
  `ville` varchar(100) DEFAULT NULL,
  `code_postal` varchar(100) DEFAULT NULL,
  `pays` varchar(100) DEFAULT NULL,
  `mode_paiement` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`command_id`, `user_id`, `DateCommande`, `StatutCommande`, `MontantTotal`, `adresse_livraison`, `ville`, `code_postal`, `pays`, `mode_paiement`) VALUES
(3, 2, '2024-07-04 22:55:07', 'En cours', 110.00, NULL, NULL, NULL, NULL, NULL),
(4, 2, '2024-07-04 22:58:12', 'En cours', 210.00, NULL, NULL, NULL, NULL, NULL),
(5, 2, '2024-07-05 15:07:37', 'En cours', 250.00, NULL, NULL, NULL, NULL, NULL),
(7, 2, '2024-07-06 17:25:21', 'En cours', 140.00, 'Chem. des lieugex 31', '0', '1860', 'suisse', 'Paiement à la livraison'),
(8, 2, '2024-07-06 17:27:12', 'En cours', 80.00, 'Chem. des lieugex 31', '0', '1860', 'suisse', 'Paiement à la livraison'),
(9, 2, '2024-07-06 17:32:50', 'En cours', 50.00, 'Chem. des lieugex 31', 'aigle suisse', '1860', 'suisse', 'Paiement à la livraison'),
(10, 2, '2024-07-06 17:38:31', 'En cours', 90.00, 'Chem. des lieugex 31', 'Aigle Vaud', '1860', 'suisse', 'Paiement à la livraison'),
(13, 2, '2024-07-06 21:18:13', 'En cours', 80.00, 'Chem. des lieugex 31', 'Aigle Vaud', '1860', 'suisse', 'Paiement à la livraison'),
(14, 2, '2024-07-06 21:20:26', 'En cours', 80.00, 'Chem. des lieugex 31', 'Aigle Vaud', '1860', 'suisse', 'Paiement à la livraison'),
(15, 2, '2024-07-06 21:22:52', 'En cours', 80.00, 'Chem. des lieugex 31', 'Aigle Vaud', '1860', 'suisse', 'Paiement à la livraison'),
(16, 2, '2024-07-06 21:24:18', 'En cours', 80.00, 'Chem. des lieugex 31', 'Aigle Vaud', '1860', 'suisse', 'Paiement à la livraison'),
(17, 2, '2024-07-06 21:26:03', 'En cours', 80.00, 'Chem. des lieugex 31', 'Aigle Vaud', '1860', 'suisse', 'Paiement à la livraison'),
(18, 2, '2024-07-06 21:28:31', 'En cours', 80.00, 'Chem. des lieugex 31', '0', '1860', 'suisse', 'Paiement à la livraison'),
(19, 2, '2024-07-06 21:29:04', 'En cours', 80.00, 'Chem. des lieugex 31', '0', '1860', 'suisse', 'Paiement à la livraison'),
(20, 2, '2024-07-06 21:31:05', 'En cours', 80.00, 'Chem. des lieugex 31', '0', '1860', 'suisse', 'Paiement à la livraison'),
(21, 2, '2024-07-06 21:45:26', 'En cours', 80.00, 'Chem. des lieugex 31', '0', '1860', 'suisse', 'Paiement à la livraison'),
(22, 2, '2024-07-06 21:51:31', 'En cours', 80.00, 'Chem. des lieugex 31', '0', '1860', 'suisse', 'Paiement à la livraison'),
(23, 2, '2024-07-06 22:12:41', 'En cours', 80.00, 'Chem. des lieugex 31', '0', '1860', 'suisse', 'Paiement à la livraison'),
(24, 2, '2024-07-06 22:20:38', 'En cours', 110.00, 'Chem. des lieugex 31', '0', '1860', 'suisse', 'Paiement à la livraison'),
(27, 2, '2024-07-06 22:37:09', 'En cours', 80.00, 'Chem. des lieugex 31', '0', '1860', 'suisse', 'Paiement à la livraison'),
(35, 2, '2024-07-06 23:30:48', 'En cours', 69.00, 'hjkh', '0', '1860', 'suisse', 'Paiement à la livraison'),
(36, 2, '2024-07-06 23:34:30', 'En cours', 69.00, 'ihzufutzdtr', '0', '1860', 'suisse', 'Paiement à la livraison'),
(38, 1, '2024-07-11 14:11:42', 'En cours', 195.00, 'chemin de lieugex', '0', '1860', 'suisse', 'Paiement à la livraison');

-- --------------------------------------------------------

--
-- Structure de la table `detailcommande`
--

CREATE TABLE `detailcommande` (
  `detail_commande_id` int(11) NOT NULL,
  `commande_id` int(11) DEFAULT NULL,
  `produit_id` int(11) DEFAULT NULL,
  `produit_nom` varchar(100) NOT NULL,
  `produit_img` varchar(30) NOT NULL,
  `produit_quantite` int(11) NOT NULL,
  `produit_montant` decimal(10,2) NOT NULL,
  `produit_size` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `detailcommande`
--

INSERT INTO `detailcommande` (`detail_commande_id`, `commande_id`, `produit_id`, `produit_nom`, `produit_img`, `produit_quantite`, `produit_montant`, `produit_size`) VALUES
(5, 3, 2, 'Sweatshirt blanc', 'pngwing.com 2.png', 1, 50.00, 'm'),
(6, 3, 1, 'T-shirt Polo vert ', 'pngwing.com 1.png', 1, 60.00, 'm'),
(7, 4, 2, 'Sweatshirt blanc', 'pngwing.com 2.png', 3, 50.00, 'm'),
(8, 4, 1, 'T-shirt Polo vert ', 'pngwing.com 1.png', 1, 60.00, 'xl'),
(9, 5, 2, 'Sweatshirt blanc', 'pngwing.com 2.png', 3, 50.00, 'm'),
(10, 5, 4, 'Pantalon Bleu', 'pngwing.com 4.png', 1, 100.00, 'm'),
(12, 7, 3, 'Pantalon Beige Élégant\r\n', 'pngwing.com 3.png', 1, 80.00, 'm'),
(13, 7, 1, 'T-shirt Polo vert ', 'pngwing.com 1.png', 1, 60.00, 'm'),
(14, 8, 3, 'Pantalon Beige Élégant\r\n', 'pngwing.com 3.png', 1, 80.00, 'l'),
(15, 9, 2, 'Sweatshirt blanc', 'pngwing.com 2.png', 1, 50.00, 'm'),
(16, 10, 10, 'Chemise Bleu', 'pngwing.com 10.png', 1, 90.00, 'm'),
(19, 22, 3, 'Pantalon Beige Élégant\r\n', 'pngwing.com 3.png', 1, 80.00, 'm'),
(20, 22, 1, 'T-shirt Polo vert ', 'pngwing.com 1.png', 1, 60.00, 's'),
(21, 23, 3, 'Pantalon Beige Élégant\r\n', 'pngwing.com 3.png', 1, 80.00, 'm'),
(22, 23, 1, 'T-shirt Polo vert ', 'pngwing.com 1.png', 1, 60.00, 's'),
(23, 36, 7, 'Polo T-shirt orange', 'pngwing.com 7.png', 1, 69.00, 'l'),
(28, 38, 3, 'Pantalon Beige Élégant\r\n', 'pngwing.com 3.png', 1, 80.00, 'm'),
(29, 38, 16, 'Sweat-Shirt Orange\r\n', 'pngwing.com 9.png', 1, 55.00, 'm'),
(30, 38, 1, 'T-shirt Polo vert ', 'pngwing.com 1.png', 1, 60.00, 'm');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `produit_id` int(11) NOT NULL,
  `produit_nom` varchar(100) NOT NULL,
  `produit_description` text DEFAULT NULL,
  `produit_montant` decimal(10,2) NOT NULL,
  `produit_img` varchar(25) NOT NULL,
  `produit_brand` varchar(50) DEFAULT NULL,
  `produit_stars` float NOT NULL,
  `DateAjout` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`produit_id`, `produit_nom`, `produit_description`, `produit_montant`, `produit_img`, `produit_brand`, `produit_stars`, `DateAjout`) VALUES
(1, 'T-shirt Polo vert ', ' Un polo classique dans une teinte verte rafraîchissante, adapté aux contextes décontractés et semi-formels.', 60.00, 'pngwing.com 1.png', 'zara', 4, '2024-06-25 15:28:57'),
(2, 'Sweatshirt blanc', 'Un sweat-shirt blanc polyvalent qui peut être facilement habillé ou décontracté, selon l\'occasion.', 50.00, 'pngwing.com 2.png', 'zara', 5, '2024-06-25 15:33:46'),
(3, 'Pantalon Beige Élégant\r\n', 'Un pantalon beige polyvalent et intemporel, parfait pour toutes les occasions. Sa coupe soignée et son tissu de qualité offrent un confort optimal tout au long de la journée. Idéal pour un look chic au bureau ou une tenue décontractée le week-end.', 80.00, 'pngwing.com 3.png', 'pull&bear', 4.5, '2024-06-25 15:44:57'),
(4, 'Pantalon Bleu', 'Un jean bleu intemporel, un incontournable de la garde-robe pour toute personne soucieuse de la mode.', 100.00, 'pngwing.com 4.png', 'Guess', 4, '2024-06-25 15:44:57'),
(5, 'Pantalon Cargo Noir', 'Un pantalon cargo noir à la fois tendance et pratique, conçu pour le confort et la polyvalence. Sa coupe décontractée et son tissu résistant offrent une liberté de mouvement optimale pour toutes vos activités. Doté de multiples poches spacieuses, ce pantalon allie fonctionnalité et style urbain. ', 75.00, 'pngwing.com 5.png', 'zara', 4.5, '2024-06-25 15:44:57'),
(6, 'Jean bleu ', ' Un jean bleu intemporel, un incontournable de la garde-robe pour toute personne soucieuse de la mode.', 55.00, 'pngwing.com 6.png', 'Bershka', 5, '2024-06-25 15:44:57'),
(7, 'Polo T-shirt orange', 'Un polo T-shirt orange vif qui apporte une touche de fraîcheur et d\'énergie à votre garde-robe. Confectionné dans un coton doux et respirant, ce polo offre un confort optimal tout au long de la journée. Sa coupe classique et élégante convient aussi bien pour une tenue décontractée que pour un look plus habillé. ', 69.00, 'pngwing.com 7.png', 'Ralph Lauren', 4, '2024-06-25 15:44:57'),
(10, 'Chemise Bleu', ' Une chemise bleu polyvalente en coton de haute qualité. Convient pour les occasions décontractées et semi-formelles. ', 90.00, 'pngwing.com 10.png', 'Guess', 4, '2024-06-25 16:06:14'),
(11, 'Sweat-Shirt noir', ' Un sweat-shirt noir élégant et polyvalent, indispensable dans toute garde-robe moderne. Confectionné dans un tissu doux et confortable, ce sweat-shirt offre une chaleur agréable tout en restant respirant.', 60.00, 'pngwing.com 11.png', 'zara', 5, '2024-06-25 16:06:14'),
(12, 'Polo T-shirt Blanc Classique', ' Un polo T-shirt blanc intemporel, véritable essentiel de toute garde-robe élégante. Confectionné dans un coton doux et respirant de haute qualité, ce polo offre un confort optimal pour toutes les occasions. ', 70.00, 'pngwing.com 12.png', 'Ralph Lauren', 4.5, '2024-06-25 16:06:14'),
(13, 'T-shirt Noir & Blanc', ' Un t-shirt monochrome classique avec un design audacieux en noir et blanc. Parfait pour un look élégant mais décontracté. ', 50.00, 'pngwing.com 13.png', 'Calvin klien ', 5, '2024-06-25 16:06:14'),
(16, 'Sweat-Shirt Orange\r\n', 'Un sweat-shirt orange vif qui ajoute une touche de couleur à n importe quelle tenue. Confortable et élégant. ', 55.00, 'pngwing.com 9.png', 'zara', 5, '2024-06-25 16:06:14');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_adresse` varchar(200) DEFAULT NULL,
  `user_tel` varchar(20) DEFAULT NULL,
  `DateInscription` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `user_nom`, `Prenom`, `user_email`, `user_password`, `user_adresse`, `user_tel`, `DateInscription`) VALUES
(1, 'maha znine', '', 'maha.znine@gmail.com', '5ce59bdc1d7984aa07d0e0c008ad7897', 'mourouj', '20150527', '2024-06-27 15:34:04'),
(2, 'hattab', '', 'hattab@gmail.com', 'fd61ab5e43cb252c1d720edf741c6659', 'ndcd adsbjcajs asbcn', '094737262', '2024-07-04 22:05:11');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`command_id`),
  ADD KEY `IX_Commande_UserID` (`user_id`);

--
-- Index pour la table `detailcommande`
--
ALTER TABLE `detailcommande`
  ADD PRIMARY KEY (`detail_commande_id`),
  ADD KEY `IX_DetailCommande_CommandeID` (`commande_id`),
  ADD KEY `IX_DetailCommande_ProduitID` (`produit_id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`produit_id`),
  ADD KEY `IX_Produit_Categorie` (`produit_brand`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `Email` (`user_email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `command_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `detailcommande`
--
ALTER TABLE `detailcommande`
  MODIFY `detail_commande_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `produit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Contraintes pour la table `detailcommande`
--
ALTER TABLE `detailcommande`
  ADD CONSTRAINT `detailcommande_ibfk_1` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`command_id`),
  ADD CONSTRAINT `detailcommande_ibfk_2` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`Produit_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
