-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 10, 2022 at 10:28 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mon_carnet`
--

-- --------------------------------------------------------

--
-- Table structure for table `type_vaccin`
--

CREATE TABLE `type_vaccin` (
  `nom_vaccin` varchar(50) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_vaccin`
--

INSERT INTO `type_vaccin` (`nom_vaccin`, `id`) VALUES
('Covid-19 BioNTech/Pfizer', 1),
('Covid-19 Moderna', 2),
('Covid-19 AstraZeneca', 3),
('Covid-19 Johnson&Johnson', 4),
('Coqueluche DTCaPolio', 5),
('Rougeole/Rubéole/Oreillons Priorix', 6),
('Rougeole/Rubéole/Oreillons Rvaxpro', 7),
('Pneumocoque Prevenar 13', 8),
('Pneumocoque Pneumovax', 9),
('Méningocoque C Menjugate', 10),
('Méningocoque C Neisvac', 11),
('Méningocoque C Menveo', 12),
('Haemophilus Hexyon', 13);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `prenom` varchar(30) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role` varchar(30) NOT NULL,
  `id` int(11) NOT NULL,
  `date_de_naissance` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`prenom`, `nom`, `email`, `password`, `role`, `id`, `date_de_naissance`) VALUES
('michel', 'Dupond', 'Michel@gmail.com', 'azerty', 'user', 1, NULL),
('Fabien', 'Debureau', 'f@gmail.com', 'azerty', 'admin', 2, '2003-06-19'),
('sim', 'deb', 's@gmail.com', 'azerty', 'user', 3, '2001-06-23');

-- --------------------------------------------------------

--
-- Table structure for table `vaccin`
--

CREATE TABLE `vaccin` (
  `nomvaccin` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `idvaccin` int(11) NOT NULL,
  `utilisateur_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vaccin`
--

INSERT INTO `vaccin` (`nomvaccin`, `date`, `idvaccin`, `utilisateur_id`) VALUES
('Covid-19 BioNTech/Pfizer', '1982-10-10', 31, 1),
('Coqueluche DTCaPolio', '1970-10-12', 32, 1),
('Covid-19 BioNTech/Pfizer', '1998-07-17', 40, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `type_vaccin`
--
ALTER TABLE `type_vaccin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccin`
--
ALTER TABLE `vaccin`
  ADD PRIMARY KEY (`idvaccin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `type_vaccin`
--
ALTER TABLE `type_vaccin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vaccin`
--
ALTER TABLE `vaccin`
  MODIFY `idvaccin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
