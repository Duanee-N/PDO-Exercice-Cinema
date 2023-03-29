-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.2.0.6576
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour cinema
CREATE DATABASE IF NOT EXISTS `cinema` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cinema`;

-- Listage de la structure de table cinema. acteur
CREATE TABLE IF NOT EXISTS `acteur` (
  `id_acteur` int NOT NULL AUTO_INCREMENT,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_acteur`),
  KEY `id_personne` (`id_personne`),
  CONSTRAINT `FK_acteur_personne` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=2147483647 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema.acteur : ~49 rows (environ)
INSERT INTO `acteur` (`id_acteur`, `id_personne`) VALUES
	(1, 2),
	(2, 3),
	(3, 4),
	(4, 5),
	(5, 6),
	(6, 7),
	(7, 8),
	(8, 9),
	(9, 10),
	(10, 11),
	(11, 12),
	(12, 13),
	(13, 14),
	(14, 15),
	(15, 16),
	(16, 17),
	(17, 18),
	(18, 19),
	(19, 20),
	(20, 21),
	(21, 22),
	(22, 23),
	(23, 24),
	(24, 25),
	(25, 27),
	(26, 28),
	(27, 29),
	(28, 30),
	(29, 31),
	(30, 32),
	(31, 33),
	(32, 34),
	(33, 36),
	(34, 37),
	(35, 38),
	(36, 39),
	(37, 40),
	(38, 41),
	(39, 42),
	(40, 43),
	(41, 44),
	(42, 45),
	(43, 46),
	(44, 47),
	(45, 48),
	(46, 49),
	(47, 50),
	(48, 51),
	(49, 52);

-- Listage de la structure de table cinema. casting
CREATE TABLE IF NOT EXISTS `casting` (
  `id_film` int NOT NULL,
  `id_acteur` int NOT NULL,
  `id_role` int NOT NULL,
  KEY `id_film` (`id_film`),
  KEY `id_acteur` (`id_acteur`),
  KEY `id_role` (`id_role`),
  CONSTRAINT `FK__acteur` FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`),
  CONSTRAINT `FK__film` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `FK__role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema.casting : ~52 rows (environ)
INSERT INTO `casting` (`id_film`, `id_acteur`, `id_role`) VALUES
	(1, 1, 1),
	(1, 2, 2),
	(1, 3, 3),
	(1, 4, 4),
	(1, 5, 5),
	(1, 6, 6),
	(1, 7, 7),
	(1, 8, 8),
	(1, 9, 9),
	(1, 10, 10),
	(1, 11, 11),
	(2, 12, 12),
	(2, 13, 13),
	(2, 14, 14),
	(2, 15, 15),
	(2, 16, 16),
	(2, 17, 17),
	(2, 18, 18),
	(2, 19, 19),
	(3, 12, 20),
	(3, 20, 21),
	(3, 21, 22),
	(3, 22, 23),
	(3, 23, 24),
	(3, 24, 25),
	(4, 12, 26),
	(4, 25, 27),
	(4, 26, 28),
	(4, 27, 29),
	(4, 28, 30),
	(4, 29, 31),
	(4, 30, 32),
	(4, 31, 33),
	(4, 32, 34),
	(5, 33, 35),
	(5, 34, 36),
	(5, 35, 37),
	(5, 36, 38),
	(5, 37, 39),
	(5, 38, 40),
	(5, 39, 41),
	(5, 40, 42),
	(5, 41, 43),
	(6, 42, 44),
	(6, 43, 45),
	(6, 25, 46),
	(6, 44, 47),
	(6, 45, 48),
	(6, 46, 49),
	(6, 47, 50),
	(6, 48, 51),
	(6, 49, 52);

-- Listage de la structure de table cinema. film
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int NOT NULL AUTO_INCREMENT,
  `titre_film` varchar(50) NOT NULL,
  `annee_sortie_fr` int NOT NULL,
  `duree` int NOT NULL,
  `synopsis` text,
  `note` int DEFAULT NULL,
  `affiche` varchar(50) DEFAULT NULL,
  `id_realisateur` int NOT NULL,
  PRIMARY KEY (`id_film`),
  KEY `id_realisateur` (`id_realisateur`),
  CONSTRAINT `FK_film_realisateur` FOREIGN KEY (`id_realisateur`) REFERENCES `realisateur` (`id_realisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema.film : ~6 rows (environ)
INSERT INTO `film` (`id_film`, `titre_film`, `annee_sortie_fr`, `duree`, `synopsis`, `note`, `affiche`, `id_realisateur`) VALUES
	(1, 'Pink Floyd : The Wall', 1982, 95, NULL, NULL, NULL, 1),
	(2, 'Gran Torino', 2009, 112, NULL, NULL, NULL, 2),
	(3, 'Million Dollar Baby', 2005, 137, NULL, NULL, NULL, 2),
	(4, 'L\'Évadé d\'Alcatraz', 1979, 112, NULL, NULL, NULL, 3),
	(5, 'Joker', 2019, 122, NULL, NULL, NULL, 4),
	(6, 'Braveheart', 1995, 178, NULL, NULL, NULL, 5);

-- Listage de la structure de table cinema. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int NOT NULL AUTO_INCREMENT,
  `libelle_genre` varchar(50) NOT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema.genre : ~10 rows (environ)
INSERT INTO `genre` (`id_genre`, `libelle_genre`) VALUES
	(1, 'Aventure'),
	(2, 'Action'),
	(3, 'Comédie'),
	(4, 'Drame'),
	(5, 'Thriller'),
	(6, 'Science-fiction'),
	(7, 'Horreur'),
	(8, 'Fantastique'),
	(9, 'Historique'),
	(10, 'Musical');

-- Listage de la structure de table cinema. personne
CREATE TABLE IF NOT EXISTS `personne` (
  `id_personne` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `sexe` varchar(5) NOT NULL,
  `date_naissance` date NOT NULL,
  PRIMARY KEY (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema.personne : ~52 rows (environ)
INSERT INTO `personne` (`id_personne`, `nom`, `prenom`, `sexe`, `date_naissance`) VALUES
	(1, 'PARKER', 'Alan', 'Homme', '1944-02-14'),
	(2, 'GELDOF', 'Bob', 'Homme', '1951-10-05'),
	(3, 'BINGHAM', 'David', 'Homme', '1989-10-19'),
	(4, 'MCKEON', 'Kevin', 'Homme', '1968-04-22'),
	(5, 'HARGREAVES', 'Christine', 'Femme', '1939-03-22'),
	(6, 'LAURENSON', 'James', 'Homme', '1930-07-08'),
	(7, 'DAVID', 'Eleanor', 'Femme', '1955-11-30'),
	(8, 'HOSKINS', 'Bob', 'Homme', '1942-10-26'),
	(9, 'WRIGHT', 'Jenny', 'Femme', '1962-03-23'),
	(10, 'MCAVOY', 'Alex', 'Homme', '1928-03-10'),
	(11, 'DALE', 'Ellis', 'Homme', '1930-05-05'),
	(12, 'HAZELDINE', 'James', 'Homme', '1947-04-04'),
	(13, 'EASTWOOD', 'Clint', 'Homme', '1930-05-31'),
	(14, 'VANG', 'Bee', 'Homme', '1991-11-04'),
	(15, 'HER', 'Ahney', 'Femme', '1993-07-13'),
	(16, 'CARLEY', 'Christopher', 'Homme', '1978-05-31'),
	(17, 'MOUA', 'Doua', 'Homme', '1987-02-07'),
	(18, 'HALEY', 'Brian', 'Homme', '1963-02-12'),
	(19, 'HUGHES', 'Geraldine', 'Femme', '1970-01-01'),
	(20, 'WALKER', 'Dreama', 'Femme', '1986-06-20'),
	(21, 'SWANK', 'Hilary', 'Femme', '1974-07-30'),
	(22, 'FREEMAN', 'Morgan', 'Homme', '1937-06-01'),
	(23, 'BARUCHEL', 'Jay', 'Homme', '1982-04-09'),
	(24, 'COLTER', 'Mike', 'Homme', '1976-08-26'),
	(25, 'RIJKER', 'Lucia', 'Femme', '1967-12-06'),
	(26, 'SIEGEL', 'Don', 'Homme', '1912-10-26'),
	(27, 'MCGOOHAN', 'Patrick', 'Homme', '1928-03-19'),
	(28, 'BLOSSOM', 'Roberts', 'Homme', '1924-03-25'),
	(29, 'WARD', 'Fred', 'Homme', '1942-12-30'),
	(30, 'THIBEAU', 'Jack', 'Homme', '1946-06-12'),
	(31, 'BENJAMIN', 'Paul', 'Homme', '1938-02-04'),
	(32, 'HANKIN', 'Larry', 'Homme', '1940-08-31'),
	(33, 'FISCHER', 'Bruce', 'Homme', '1936-03-20'),
	(34, 'RONZIO', 'Frank', 'Homme', '1920-06-26'),
	(35, 'PHILLIPS', 'Todd', 'Homme', '1970-12-20'),
	(36, 'PHOENIX', 'Joaquin', 'Homme', '1974-11-28'),
	(37, 'DE NIRO', 'Robert', 'Homme', '1943-08-17'),
	(38, 'BEETZ', 'Zazie', 'Femme', '1991-06-01'),
	(39, 'CONROY', 'Frances', 'Femme', '1953-03-15'),
	(40, 'GROSS', 'Hannah', 'Femme', '1990-09-25'),
	(41, 'CULLEN', 'Brett', 'Homme', '1956-08-26'),
	(42, 'WHIGHAM', 'Shea', 'Homme', '1969-01-05'),
	(43, 'CAMP', 'Bill', 'Homme', '1961-10-13'),
	(44, 'FLESHLER', 'Glenn', 'Homme', '1968-09-05'),
	(45, 'GIBSON', 'Mel', 'Homme', '1956-01-03'),
	(46, 'MARCEAU', 'Sophie', 'Femme', '1966-11-17'),
	(47, 'MACFAYDEN', 'Angus', 'Homme', '1963-09-21'),
	(48, 'GLEESON', 'Brendan', 'Homme', '1955-03-29'),
	(49, 'HANLY', 'Peter', 'Homme', '1964-11-28'),
	(50, 'MCCORMACK', 'Catherine', 'Femme', '1972-04-03'),
	(51, 'COX', 'Brian', 'Homme', '1946-06-01'),
	(52, 'COSMO', 'James', 'Homme', '1948-05-24');

-- Listage de la structure de table cinema. posseder_genre
CREATE TABLE IF NOT EXISTS `posseder_genre` (
  `id_film` int NOT NULL,
  `id_genre` int NOT NULL,
  KEY `id_film` (`id_film`),
  KEY `id_genre` (`id_genre`),
  CONSTRAINT `FK__film_` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `FK__genre` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema.posseder_genre : ~9 rows (environ)
INSERT INTO `posseder_genre` (`id_film`, `id_genre`) VALUES
	(1, 10),
	(1, 4),
	(2, 4),
	(2, 5),
	(3, 4),
	(4, 5),
	(5, 4),
	(6, 4),
	(6, 9);

-- Listage de la structure de table cinema. realisateur
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id_realisateur` int NOT NULL AUTO_INCREMENT,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_realisateur`),
  KEY `id_personne` (`id_personne`),
  CONSTRAINT `FK_realisateur_personne` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema.realisateur : ~5 rows (environ)
INSERT INTO `realisateur` (`id_realisateur`, `id_personne`) VALUES
	(1, 1),
	(2, 13),
	(3, 26),
	(4, 35),
	(5, 45);

-- Listage de la structure de table cinema. role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `nom_role` varchar(50) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=8889 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema.role : ~52 rows (environ)
INSERT INTO `role` (`id_role`, `nom_role`) VALUES
	(1, 'Pink'),
	(2, 'Pink enfant (1)'),
	(3, 'Pink enfant (2)'),
	(4, 'Mère de Pink'),
	(5, 'Père de Pink'),
	(6, 'Femme de Pink'),
	(7, 'Imprésario'),
	(8, 'Groupie'),
	(9, 'Professeur'),
	(10, 'Médecin'),
	(11, 'Amant'),
	(12, 'Walt Kowalski'),
	(13, 'Thao (voisin de Walt)'),
	(14, 'Sue (soeur de Thao)'),
	(15, 'Père Janovich'),
	(16, 'Spider (cousin de Thao et Sue/membre du gang)'),
	(17, 'Mitch Kowalski (fils de Walt)'),
	(18, 'Karen Kowalski (femme de Mitch)'),
	(19, 'Ashley Kowalski (fille de Mitch)'),
	(20, 'Frankie Dunn'),
	(21, 'Margaret Fitzgerald (Maggie)'),
	(22, 'Eddie Dupris (Scrap-Iron)'),
	(23, 'Danger Barch'),
	(24, 'Big Willie Little'),
	(25, 'Billie (L\'Ourse bleue)'),
	(26, 'Frank Lee Morris'),
	(27, 'Directeur de la prison d\'Alcatraz'),
	(28, 'Chester Dalton (Doc)'),
	(29, 'John Anglin'),
	(30, 'Clarence Anglin'),
	(31, 'Prisonnier - bibliothécaire'),
	(32, 'Charley Butts'),
	(33, 'Wolf'),
	(34, 'Litmus'),
	(35, 'Arthur Fleck (le Joker)'),
	(36, 'Murray Franklin (présentateur de l\'émission)'),
	(37, 'Sophie Dumond (voisine d\'Arthur)'),
	(38, 'Penny Fleck (mère d\'Arthur)'),
	(39, 'Penny Fleck jeune'),
	(40, 'Thomas Wayne'),
	(41, 'Inspecteur Burke'),
	(42, 'Inspecteur Garrity'),
	(43, 'Randall (collègue d\'Arthur)'),
	(44, 'William Wallace'),
	(45, 'Princesse Isabelle'),
	(46, 'Roi Edward I (Longshanks)'),
	(47, 'Robert le Bruce'),
	(48, 'Hamish Campbell'),
	(49, 'Prince Edward'),
	(50, 'Murron MacClannough'),
	(51, 'Argyle Wallace'),
	(52, 'Campbell');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
