-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2019 at 03:54 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gestion_taches`
--
CREATE DATABASE IF NOT EXISTS `gestion_taches` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gestion_taches`;

-- --------------------------------------------------------

--
-- Table structure for table `adhesion`
--

CREATE TABLE IF NOT EXISTS `adhesion` (
`NUM_ADHESION` int(100) NOT NULL,
  `NUM_PROJET` int(100) NOT NULL,
  `COURRIEL` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `adhesion`
--

INSERT INTO `adhesion` (`NUM_ADHESION`, `NUM_PROJET`, `COURRIEL`) VALUES
(45, 11, 'marcos@gmail.com'),
(46, 12, 'toto@gmail.com'),
(47, 12, 'ali@gmail.com'),
(48, 12, 'titi@gmail.com'),
(51, 8, 'titi@gmail.com'),
(52, 7, 'marcos@gmail.com'),
(53, 10, 'marcos@gmail.com'),
(54, 10, 'ali@gmail.com'),
(55, 10, 'titi@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `invitationenvoyee`
--

CREATE TABLE IF NOT EXISTS `invitationenvoyee` (
`NUM_INVITATION_ENVOYEE` int(100) NOT NULL,
  `NUM_PROJET` int(100) NOT NULL,
  `COURRIEL` varchar(50) NOT NULL,
  `ETAT` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

--
-- Dumping data for table `invitationenvoyee`
--

INSERT INTO `invitationenvoyee` (`NUM_INVITATION_ENVOYEE`, `NUM_PROJET`, `COURRIEL`, `ETAT`) VALUES
(78, 10, 'marcos@gmail.com', 'accepte'),
(79, 12, 'ali@gmail.com', 'accepte'),
(81, 10, 'marcos@gmail.com', 'accepte'),
(82, 12, 'marley@gmail.com', 'accepte'),
(83, 12, 'marley@gmail.com', 'accepte'),
(84, 12, 'toto@gmail.com', 'accepte'),
(85, 12, 'toto@gmail.com', 'accepte'),
(89, 12, 'titi@gmail.com', 'accepte'),
(91, 10, 'ali@gmail.com', 'accepte'),
(93, 10, 'titi@gmail.com', 'accepte'),
(94, 10, 'toto@gmail.com', 'accepte'),
(96, 10, 'marcos@gmail.com', 'accepte'),
(98, 8, 'titi@gmail.com', 'accepte'),
(99, 7, 'marcos@gmail.com', 'accepte');

-- --------------------------------------------------------

--
-- Table structure for table `invitationrecue`
--

CREATE TABLE IF NOT EXISTS `invitationrecue` (
`NUM_INVITATION_RECUE` int(100) NOT NULL,
  `NUM_PROJET` int(100) NOT NULL,
  `COURRIEL` varchar(50) NOT NULL,
  `ETAT` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `invitationrecue`
--

INSERT INTO `invitationrecue` (`NUM_INVITATION_RECUE`, `NUM_PROJET`, `COURRIEL`, `ETAT`) VALUES
(30, 12, 'marley@gmail.com', 'accepte'),
(32, 8, 'marcos@gmail.com', 'accepte'),
(33, 11, 'marcos@gmail.com', 'accepte'),
(35, 8, 'marcos@gmail.com', 'en_attente'),
(37, 10, 'titi@gmail.com', 'accepte');

-- --------------------------------------------------------

--
-- Table structure for table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
  `COURRIEL` varchar(50) NOT NULL,
  `NOM` varchar(50) NOT NULL,
  `PRENOM` varchar(50) NOT NULL,
  `MOT_DE_PASSE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membre`
--

INSERT INTO `membre` (`COURRIEL`, `NOM`, `PRENOM`, `MOT_DE_PASSE`) VALUES
('ali@gmail.com', 'Ali', 'Muhammad', 'ali'),
('marcos@gmail.com', 'Marcos', 'Emma', 'marcos'),
('marley@gmail.com', 'Bob', 'Marley', 'marley'),
('proulx@gmail.com', 'Proulx', 'Diane', 'proulx'),
('titi@gmail.com', 'Titikaka', 'Alberto', 'titi'),
('toto@gmail.com', 'Totopulus', 'Maria', 'toto');

-- --------------------------------------------------------

--
-- Table structure for table `projet`
--

CREATE TABLE IF NOT EXISTS `projet` (
`NUM_PROJET` int(100) NOT NULL,
  `NOM_PROJET` varchar(30) NOT NULL,
  `DESCRIPTION` varchar(250) NOT NULL,
  `COURRIEL` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `projet`
--

INSERT INTO `projet` (`NUM_PROJET`, `NOM_PROJET`, `DESCRIPTION`, `COURRIEL`) VALUES
(7, 'UML', 'Description Description Description Description Description Description Description Descript', 'titi@gmail.com'),
(8, 'App C++', 'Apprendre les poiteurs', 'toto@gmail.com'),
(9, 'ali CSS', '', 'ali@gmail.com'),
(10, 'Site Web HTML', 'Site Web en HTML pure ', 'marley@gmail.com'),
(11, 'Faire des cours', 'Aller au marchÃ© Jean-Talonmm', 'toto@gmail.com'),
(12, 'APP JAVA CASINO', 'Jeu "Casino" en Java111', 'marcos@gmail.com'),
(13, 'Film "College"', '', 'proulx@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `taches`
--

CREATE TABLE IF NOT EXISTS `taches` (
`NUM_TACHES` int(100) NOT NULL,
  `NUM_PROJET` int(100) NOT NULL,
  `NOM_TACHES` varchar(50) NOT NULL,
  `ETAT` varchar(20) NOT NULL,
  `COURRIEL` varchar(50) DEFAULT NULL,
  `DONNEUR` varchar(50) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `taches`
--

INSERT INTO `taches` (`NUM_TACHES`, `NUM_PROJET`, `NOM_TACHES`, `ETAT`, `COURRIEL`, `DONNEUR`) VALUES
(16, 10, 'BODY', 'en cours', 'ali@gmail.com', 'ali@gmail.com'),
(17, 10, 'HEADER', 'en cours', 'ali@gmail.com', 'ali@gmail.com'),
(18, 8, 'Classe 1', 'en cours', 'toto@gmail.com', 'toto@gmail.com'),
(19, 8, 'Classe 2', 'non demarree', NULL, NULL),
(22, 9, 'Style 1', 'en cours', '', ''),
(23, 9, 'Style 2', 'en cours', 'ali@gmail.com', 'ali@gmail.com'),
(24, 11, 'Acheter du pain', 'en cours', 'marcos@gmail.com', 'marcos@gmail.com'),
(25, 10, 'FOOTER', 'en cours', 'marley@gmail.com', 'marley@gmail.com'),
(26, 10, 'SIDEBAR', 'en cours', 'marley@gmail.com', 'marley@gmail.com'),
(27, 12, 'Classe "Jeu"', 'en cours', 'marcos@gmail.com', 'marcos@gmail.com'),
(28, 12, 'Classe "Joeur"', 'en cours', 'ali@gmail.com', 'marcos@gmail.com'),
(30, 13, 'xx', 'non demarree', '', ''),
(31, 7, 'TACHE 1', 'non demarree', NULL, NULL),
(32, 12, 'Tache', 'en cours', 'toto@gmail.com', 'toto@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adhesion`
--
ALTER TABLE `adhesion`
 ADD PRIMARY KEY (`NUM_ADHESION`), ADD KEY `COURRIEL` (`COURRIEL`), ADD KEY `NUM_PROJET` (`NUM_PROJET`);

--
-- Indexes for table `invitationenvoyee`
--
ALTER TABLE `invitationenvoyee`
 ADD PRIMARY KEY (`NUM_INVITATION_ENVOYEE`), ADD KEY `COURRIEL` (`COURRIEL`), ADD KEY `NUM_PROJET` (`NUM_PROJET`);

--
-- Indexes for table `invitationrecue`
--
ALTER TABLE `invitationrecue`
 ADD PRIMARY KEY (`NUM_INVITATION_RECUE`), ADD KEY `COURRIEL` (`COURRIEL`), ADD KEY `NUM_PROJET` (`NUM_PROJET`);

--
-- Indexes for table `membre`
--
ALTER TABLE `membre`
 ADD PRIMARY KEY (`COURRIEL`);

--
-- Indexes for table `projet`
--
ALTER TABLE `projet`
 ADD PRIMARY KEY (`NUM_PROJET`), ADD KEY `projet_ibfk_1` (`COURRIEL`);

--
-- Indexes for table `taches`
--
ALTER TABLE `taches`
 ADD PRIMARY KEY (`NUM_TACHES`), ADD KEY `taches_ibfk_1` (`NUM_PROJET`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adhesion`
--
ALTER TABLE `adhesion`
MODIFY `NUM_ADHESION` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `invitationenvoyee`
--
ALTER TABLE `invitationenvoyee`
MODIFY `NUM_INVITATION_ENVOYEE` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `invitationrecue`
--
ALTER TABLE `invitationrecue`
MODIFY `NUM_INVITATION_RECUE` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `projet`
--
ALTER TABLE `projet`
MODIFY `NUM_PROJET` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `taches`
--
ALTER TABLE `taches`
MODIFY `NUM_TACHES` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `adhesion`
--
ALTER TABLE `adhesion`
ADD CONSTRAINT `adhesion_ibfk_1` FOREIGN KEY (`COURRIEL`) REFERENCES `membre` (`COURRIEL`),
ADD CONSTRAINT `adhesion_ibfk_2` FOREIGN KEY (`NUM_PROJET`) REFERENCES `projet` (`NUM_PROJET`);

--
-- Constraints for table `invitationenvoyee`
--
ALTER TABLE `invitationenvoyee`
ADD CONSTRAINT `invitationenvoyee_ibfk_1` FOREIGN KEY (`COURRIEL`) REFERENCES `membre` (`COURRIEL`),
ADD CONSTRAINT `invitationenvoyee_ibfk_2` FOREIGN KEY (`NUM_PROJET`) REFERENCES `projet` (`NUM_PROJET`);

--
-- Constraints for table `invitationrecue`
--
ALTER TABLE `invitationrecue`
ADD CONSTRAINT `invitationrecue_ibfk_1` FOREIGN KEY (`COURRIEL`) REFERENCES `membre` (`COURRIEL`),
ADD CONSTRAINT `invitationrecue_ibfk_2` FOREIGN KEY (`NUM_PROJET`) REFERENCES `projet` (`NUM_PROJET`);

--
-- Constraints for table `projet`
--
ALTER TABLE `projet`
ADD CONSTRAINT `projet_ibfk_1` FOREIGN KEY (`COURRIEL`) REFERENCES `membre` (`COURRIEL`);

--
-- Constraints for table `taches`
--
ALTER TABLE `taches`
ADD CONSTRAINT `taches_ibfk_1` FOREIGN KEY (`NUM_PROJET`) REFERENCES `projet` (`NUM_PROJET`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
