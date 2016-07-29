/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : gpe

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2016-05-24 11:24:15
*/

CREATE DATABASE IF NOT EXISTS gpe;
USE gpe;
SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `answers`
-- ----------------------------
DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_question` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `user_choice` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_answer_question` (`id_question`),
  KEY `fk_answer_user` (`id_user`),
  CONSTRAINT `fk_answer_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_answer_question` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of answers
-- ----------------------------
INSERT INTO `answers` VALUES ('1', '1', '1', 'Oui');
INSERT INTO `answers` VALUES ('2', '2', '1', 'Normale');

-- ----------------------------
-- Table structure for `classes`
-- ----------------------------
DROP TABLE IF EXISTS `classes`;
CREATE TABLE `classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of classes
-- ----------------------------
INSERT INTO `classes` VALUES ('1', 'B1');
INSERT INTO `classes` VALUES ('2', 'B2');
INSERT INTO `classes` VALUES ('3', 'B3');
INSERT INTO `classes` VALUES ('4', 'I4');
INSERT INTO `classes` VALUES ('5', 'I5');

-- ----------------------------
-- Table structure for `exams`
-- ----------------------------
DROP TABLE IF EXISTS `exams`;
CREATE TABLE `exams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_class` int(11) NOT NULL,
  `id_subject` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `label` varchar(200) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_exam_user` (`id_user`),
  KEY `fk_exam_class` (`id_class`),
  KEY `fk_exam_subject` (`id_subject`),
  CONSTRAINT `fk_exam_subject` FOREIGN KEY (`id_subject`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_exam_class` FOREIGN KEY (`id_class`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_exam_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of exams
-- ----------------------------
INSERT INTO `exams` VALUES ('1', '1', '1', '4', 'Partiel sur les matrices', '1');
INSERT INTO `exams` VALUES ('2', '1', '1', '4', 'Partiel sur les suites', '0');

-- ----------------------------
-- Table structure for `marks`
-- ----------------------------
DROP TABLE IF EXISTS `marks`;
CREATE TABLE `marks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_exam` int(11) NOT NULL,
  `mark` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mark_user` (`id_user`),
  KEY `fk_mark_exam` (`id_exam`),
  CONSTRAINT `fk_mark_exam` FOREIGN KEY (`id_exam`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_mark_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of marks
-- ----------------------------
INSERT INTO `marks` VALUES ('1', '1', '1', '12');
INSERT INTO `marks` VALUES ('2', '2', '1', '13');

-- ----------------------------
-- Table structure for `questions`
-- ----------------------------
DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
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
  KEY `fk_question_exam` (`id_exam`),
  CONSTRAINT `fk_question_exam` FOREIGN KEY (`id_exam`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of questions
-- ----------------------------
INSERT INTO `questions` VALUES ('1', '1', 'Les dimentions matriciel existent-elles ?', '2', '0', 'Oui', 'Non', null, null, 'Oui');
INSERT INTO `questions` VALUES ('2', '1', 'Donner le nom d\'une matice complété uniquement de 1: il s\'agit d\'une matrice ...', '3', '1', null, null, null, null, 'identité');

-- ----------------------------
-- Table structure for `students`
-- ----------------------------
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `id_class` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  KEY `fk_user` (`id_user`),
  KEY `fk_class` (`id_class`),
  CONSTRAINT `fk_class` FOREIGN KEY (`id_class`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of students
-- ----------------------------

-- ----------------------------
-- Table structure for `subjects`
-- ----------------------------
DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of subjects
-- ----------------------------
INSERT INTO `subjects` VALUES ('1', 'Mathématiques');
INSERT INTO `subjects` VALUES ('2', 'Français');
INSERT INTO `subjects` VALUES ('3', 'Anglais');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `type` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Armand', 'SZYPURA', '0', 'test', 'armand.szypura@epsi.fr');
INSERT INTO `users` VALUES ('2', 'David', 'DOCO', '1', 'test', 'david.doco@epsi.fr');
INSERT INTO `users` VALUES ('3', 'Nicolas', 'LEUCCI', '0', 'test', 'nicolas.leucci@epsi.fr');
INSERT INTO `users` VALUES ('4', 'Prof', 'Prof', '1', 'test', 'prof@epsi.fr');
INSERT INTO `users` VALUES ('5', 'Elève', 'Elève', '0', 'test', 'eleve@epsi.fr');
