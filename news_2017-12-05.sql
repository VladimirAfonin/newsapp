# ************************************************************
# Sequel Pro SQL dump
# Версия 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Адрес: 127.0.0.1 (MySQL 5.6.35)
# Схема: news
# Время создания: 2017-12-05 07:07:49 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Дамп таблицы news
# ------------------------------------------------------------

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;

INSERT INTO `news` (`id`, `text`)
VALUES
	(1,' текст новости 1'),
	(2,' текст новости 2'),
	(3,' текст новости 3'),
	(4,' текст новости 4'),
	(9,'triangle');

/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL,
  `login` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`, `login`)
VALUES
	(3,'Александр 3','alex@mail.com','$2y$10$4epZrEqULvuestSdUhBdSekVWdPaUJ9G9wLoL3ey00D0fdzJSACH.','user','alex'),
	(18,'The incredible Hulk','hulk@hulk.com','$2y$10$kdiqBR1og9tn9EAyd/Aua.eu.crKYzrEsbSOGa8w1WAFLTlKKYe6q','admin','Hulk'),
	(22,'Имя','mail@mail.ru','$2y$10$Pkc1/fifP3n32fFccAbPAeQHlCy932Gl8R1YdO.ZjiDhQb1X3OZo6','admin','Новый пользователь'),
	(23,'2name','name@name.com','$2y$10$DcX3ke5SmEPTNNrQOfA8welQs.2b4tFA79mqAiXt3q3lvaB2mzwNq','','Login'),
	(24,'Tim','tim@tim.com','$2y$10$6TnuqZ9mtDG9sNOfiC1pYuu5E9xUFBrmoFFQ2GNOoImYgbtnaVQci','admin','Tim');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
