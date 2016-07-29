-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 25 Mai 2016 à 10:04
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `gpe`
--

-- --------------------------------------------------------

--
-- Structure de la table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_question` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `user_choice` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_answer_question` (`id_question`),
  KEY `fk_answer_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `answers`
--

INSERT INTO `answers` (`id`, `id_question`, `id_user`, `user_choice`) VALUES
(1, 1, 1, 'Oui'),
(2, 2, 1, 'Normale'),
(3, 1, 6, 'Non'),
(4, 2, 6, 'h-''r'),
(5, 1, 6, 'Non'),
(6, 2, 6, 'h-''r'),
(7, 1, 6, 'Non'),
(8, 2, 6, 'h-''r');

-- --------------------------------------------------------

--
-- Structure de la table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `classes`
--

INSERT INTO `classes` (`id`, `label`) VALUES
(1, 'B1'),
(2, 'B2'),
(3, 'B3'),
(4, 'I4'),
(5, 'I5');

-- --------------------------------------------------------

--
-- Structure de la table `exams`
--

CREATE TABLE IF NOT EXISTS `exams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_class` int(11) NOT NULL,
  `id_subject` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `label` varchar(200) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_exam_user` (`id_user`),
  KEY `fk_exam_class` (`id_class`),
  KEY `fk_exam_subject` (`id_subject`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `exams`
--

INSERT INTO `exams` (`id`, `id_class`, `id_subject`, `id_user`, `label`, `status`) VALUES
(1, 1, 1, 4, 'Partiel sur les matrices', 1),
(2, 1, 1, 4, 'Partiel sur les suites', 0);

-- --------------------------------------------------------

--
-- Structure de la table `marks`
--

CREATE TABLE IF NOT EXISTS `marks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_exam` int(11) NOT NULL,
  `mark` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mark_user` (`id_user`),
  KEY `fk_mark_exam` (`id_exam`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `marks`
--

INSERT INTO `marks` (`id`, `id_user`, `id_exam`, `mark`) VALUES
(1, 1, 1, 12),
(2, 2, 1, 13),
(3, 6, 1, 0),
(4, 6, 1, 0),
(5, 6, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_exam` int(11) NOT NULL,
  `label` varchar(500) NOT NULL,
  `points` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `option1` varchar(250) DEFAULT NULL,
  `option2` varchar(250) DEFAULT NULL,
  `option3` varchar(250) DEFAULT NULL,
  `option4` varchar(250) DEFAULT NULL,
  `right_answer` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_question_exam` (`id_exam`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `questions`
--

INSERT INTO `questions` (`id`, `id_exam`, `label`, `points`, `type`, `option1`, `option2`, `option3`, `option4`, `right_answer`) VALUES
(1, 1, 'Les dimentions matriciel existent-elles ?', 2, 1, 'Oui', 'Non', NULL, NULL, 'Oui'),
(2, 1, 'Donner le nom d''une matice complété uniquement de 1: il s''agit d''une matrice ...', 3, 0, NULL, NULL, NULL, NULL, 'identité');

-- --------------------------------------------------------

--
-- Structure de la table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id_class` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  KEY `fk_user` (`id_user`),
  KEY `fk_class` (`id_class`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `students`
--

INSERT INTO `students` (`id_class`, `id_user`, `status`) VALUES
(1, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(250) NOT NULL,
  `id_class` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `subjects`
--

INSERT INTO `subjects` (`id`, `label`, `id_class`) VALUES
(1, 'Mathématiques', 2),
(2, 'Français DOCO', 4),
(3, 'Anglais', 4),
(4, 'test', 4);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `type` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `type`, `password`, `email`) VALUES
(1, 'Armand', 'SZYPURA', 0, 'test', 'armand.szypura@epsi.fr'),
(2, 'David', 'DOCO', 1, 'test', 'david.doco@epsi.fr'),
(3, 'Nicolas', 'LEUCCI', 0, 'test', 'nicolas.leucci@epsi.fr'),
(4, 'Prof', 'Prof', 1, 'test', 'prof@epsi.fr'),
(5, 'Elève', 'Elève', 0, 'test', 'eleve@epsi.fr'),
(6, 'Gertrude', 'bengasie', 0, 'test', 'Gertrude.bengasie@epsi.fr');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `fk_answer_question` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_answer_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `fk_exam_class` FOREIGN KEY (`id_class`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_exam_subject` FOREIGN KEY (`id_subject`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_exam_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `fk_mark_exam` FOREIGN KEY (`id_exam`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mark_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_question_exam` FOREIGN KEY (`id_exam`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_class` FOREIGN KEY (`id_class`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
