-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 23 nov. 2024 à 18:17
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestionhotel`
--

-- --------------------------------------------------------

--
-- Structure de la table `adminstrateur`
--

DROP TABLE IF EXISTS `adminstrateur`;
CREATE TABLE IF NOT EXISTS `adminstrateur` (
  `num_admin` int NOT NULL,
  `nom_admin` char(20) DEFAULT NULL,
  `prenom_admin` char(20) DEFAULT NULL,
  `adresse_admin` char(25) DEFAULT NULL,
  `email` char(20) DEFAULT NULL,
  `num_hotel` int DEFAULT NULL,
  PRIMARY KEY (`num_admin`),
  KEY `fk_4` (`num_hotel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `chambre`
--

DROP TABLE IF EXISTS `chambre`;
CREATE TABLE IF NOT EXISTS `chambre` (
  `num_chambre` int NOT NULL,
  `prix` float DEFAULT NULL,
  `type_chambre` char(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `num_hotel` int DEFAULT NULL,
  `statut` char(20) DEFAULT NULL,
  `num_reservation` int DEFAULT NULL,
  PRIMARY KEY (`num_chambre`),
  KEY `fk_1` (`num_reservation`),
  KEY `fk_2` (`num_hotel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `num_client` int NOT NULL,
  `nom_client` char(20) DEFAULT NULL,
  `prenom_client` char(20) DEFAULT NULL,
  `adresse_client` char(25) DEFAULT NULL,
  `tel_client` int DEFAULT NULL,
  PRIMARY KEY (`num_client`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`num_client`, `nom_client`, `prenom_client`, `adresse_client`, `tel_client`) VALUES
(2021, 'youssoufeljay', 'aden', 'Heron', 77579647),
(2022, 'Wilson', 'pierre', 'Saline ouest', 77621188),
(2030, 'Yacin', 'Aoueled', 'ASKA', 77258614),
(2023, 'TASLIM', 'Houssein', 'barwaqo', 77509236),
(2028, 'ZAMZAM', 'IGUEH', 'hayableh', 77493581),
(2522, 'Neima', 'Farah', 'barwaqo', 77490926),
(2302, 'Souad', 'issa', 'barwaqo', 77225913),
(2008, 'rabia', 'omar', 'barwaqo', 77278416),
(2032, 'soumeya', 'omar', 'Q7', 77454693),
(2089, 'ZEINAB', 'igueh', 'hayableh', 77117308),
(2097, 'Abdirahman', 'Habaneh', 'QUATRIEME', 77469885),
(2080, 'RAHMA', 'ADEN', 'HAYABLEH', 77061372);

-- --------------------------------------------------------

--
-- Structure de la table `hotel`
--

DROP TABLE IF EXISTS `hotel`;
CREATE TABLE IF NOT EXISTS `hotel` (
  `num_hotel` int NOT NULL,
  `nom_hotel` char(25) DEFAULT NULL,
  `adresse_hotel` char(25) DEFAULT NULL,
  `contact` int DEFAULT NULL,
  `description` char(80) DEFAULT NULL,
  PRIMARY KEY (`num_hotel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `hotel`
--

INSERT INTO `hotel` (`num_hotel`, `nom_hotel`, `adresse_hotel`, `contact`, `description`) VALUES
(2224, 'ESCALE INTERNATIONAL', 'Djibouti(Rue de de geneve', 21257888, 'Situe a djibouti ,l\'escale international hotel dispose d\'un jardin et d\'un bar.\n'),
(1002, 'Alia hotel', 'Djibouti(Avenu Lyautey)', 77884647, 'situe a dibouti  500 metres de la plage de la siesta ,l\'hotel alia propose resta'),
(44849, 'Golden airoport hotel', 'djibouti(ambouli Rue nels', 21349610, 'Situé à Djibouti, le Golden Airport Hotel propose des hébergements 4 étoiles, un'),
(115, 'Djibouti place kempinski', 'djibouti(plage heron)', 21325555, 'Au Djibouti Palace Kempinski Hotel, l\'excellent service et les équipements de qu'),
(55959, 'Capital hotel', 'djibouti(Rue de Athenes )', 21355353, 'Installé à Djibouti, à 1,6 km de la plage de la Siesta, le Capital Hotel Djibout'),
(15456, 'Sharton hotel', 'Djibouti(gabode 6)', 21344341, 'L\'établissement Sheraton Djibouti est situé à Djibouti. Il propose une plage pri'),
(5420, 'Acacias hotel', 'djibouti(heron)', 21327860, 'Situé à Djibouti, à 800 mètres de la plage Sud, l\'établissement Les Acacias Hote'),
(8562, 'Ayla hotel', 'djibouti(port de peche)', 21318111, 'Situé à Djibouti, le Djibouti Ayla Grand Hotel dispose d\'un jardin. Cet hôtel 5'),
(56486, 'Best Western hotel', 'Djibouti(Rue clochette)', 21331000, 'Bienvenue au Best Western Premier DJ Hotel, un superbe hôtel quatre étoiles nich'),
(5348, 'Gadileh Resort Hotel', 'Djibouti(randa)', 27424545, 'situe a djibouti ,le gadileh resort hotel possede un jardin ,un sallon commun,un');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id_reservation` int NOT NULL AUTO_INCREMENT,
  `num_client` int DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  PRIMARY KEY (`id_reservation`),
  KEY `fk_40` (`num_client`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `num_client`, `date_debut`, `date_fin`) VALUES
(1, 2022, '2023-02-15', '0000-00-00'),
(2, 2021, '2023-02-15', '0000-00-00'),
(3, 2008, '2023-02-15', '0000-00-00'),
(26, 2032, '2023-02-15', '0000-00-00'),
(27, 2032, '2023-02-15', '0000-00-00'),
(28, 2032, '0001-01-01', '0000-00-00'),
(29, 2032, '2023-12-15', '0000-00-00'),
(30, 2032, '2023-12-15', '0000-00-00'),
(31, 2008, '2001-02-10', '0000-00-00'),
(32, 2008, '2022-03-22', '2025-12-02');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
