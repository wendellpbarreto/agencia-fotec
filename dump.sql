-- Adminer 3.7.1 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '-03:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `apartments`;
CREATE TABLE `apartments` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `block_id` int(5) unsigned NOT NULL,
  `customer_id` int(5) unsigned NOT NULL,
  `number` int(5) NOT NULL,
  `area` int(5) NOT NULL,
  `floor` int(5) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `apartments` (`id`, `block_id`, `customer_id`, `number`, `area`, `floor`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	1,	1,	1001,	15,	1,	'2013-09-11 09:58:30',	'2013-09-11 09:58:30',	NULL),
(2,	1,	1,	1002,	15,	1,	'2013-09-11 09:58:52',	'2013-09-11 09:58:52',	NULL),
(3,	2,	1,	1001,	80,	1,	'2013-09-16 08:54:30',	'2013-09-16 08:54:30',	NULL),
(4,	2,	1,	2001,	80,	2,	'2013-09-16 08:56:51',	'2013-09-16 08:56:51',	NULL);

DROP TABLE IF EXISTS `billets`;
CREATE TABLE `billets` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `apartment_id` int(5) unsigned NOT NULL,
  `extension` varchar(5) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `blocks`;
CREATE TABLE `blocks` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `enterprise_id` int(5) unsigned NOT NULL,
  `name` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `blocks` (`id`, `enterprise_id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	1,	'A',	'2013-09-11 09:55:11',	'2013-09-11 09:55:11',	NULL),
(2,	1,	'B',	'2013-09-11 09:55:16',	'2013-09-16 15:35:40',	NULL);

DROP TABLE IF EXISTS `contracts`;
CREATE TABLE `contracts` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `apartment_id` int(5) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `phone01` varchar(20) NOT NULL,
  `phone02` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `area` varchar(50) NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `customers` (`id`, `name`, `email`, `password`, `cpf`, `rg`, `phone01`, `phone02`, `address`, `area`, `zipcode`, `city`, `state`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'Amanda Cristina Lopes dos Santos',	'mandaacls@gmail.com',	'+NgaoGx11T8nGnk9796mUJqaG3iR1v5iUIviclho0732gk0fQfbx3sdF4uuPPe6zTzCb/MwM1TtuxukZyZOtOA==',	'09299413495',	'3389278',	'(84) 3642-0104',	'',	'Rua Prof. Clementino Câmara',	'Cohabinal',	'59000-000',	'Parnamirim',	'RN',	'2013-09-11 09:57:56',	'2013-09-11 09:57:56',	NULL);

DROP TABLE IF EXISTS `enterprises`;
CREATE TABLE `enterprises` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `area` varchar(50) NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `apt_number` int(5) NOT NULL,
  `description` text NOT NULL,
  `logo` varchar(200) NOT NULL,
  `type` int(5) NOT NULL,
  `extension` varchar(5) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `enterprises` (`id`, `name`, `address`, `area`, `zipcode`, `city`, `state`, `apt_number`, `description`, `logo`, `type`, `extension`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'International Trade Center',	'Av. Salgado Filho',	'Lagoa Nova',	'59000-000',	'Natal',	'RN',	300,	'',	'0',	1,	'png',	'2013-09-03 09:49:48',	'2013-09-09 14:51:22',	NULL);

DROP TABLE IF EXISTS `enterprises_stages`;
CREATE TABLE `enterprises_stages` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `enterprise_id` int(5) unsigned NOT NULL,
  `stage_id` int(5) unsigned NOT NULL,
  `percentage` int(3) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `enterprises_stages` (`id`, `enterprise_id`, `stage_id`, `percentage`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2,	1,	1,	100,	'2013-09-03 09:57:36',	'2013-09-03 09:57:36',	NULL),
(3,	1,	2,	100,	'2013-09-09 14:51:22',	'2013-09-09 14:51:22',	NULL),
(4,	1,	3,	30,	'2013-09-09 14:51:22',	'2013-09-09 14:51:22',	NULL);

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `version` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `migrations` (`version`) VALUES
(12);

DROP TABLE IF EXISTS `newsletters`;
CREATE TABLE `newsletters` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `apartment_id` int(5) unsigned NOT NULL,
  `subject` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `read_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `pictures`;
CREATE TABLE `pictures` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `enterprise_id` int(5) unsigned NOT NULL,
  `extension` varchar(5) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `stages`;
CREATE TABLE `stages` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `stages` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'Terraplanagem',	'2013-09-03 09:57:26',	'2013-09-03 09:57:26',	NULL),
(2,	'Projeto',	'2013-09-09 14:51:09',	'2013-09-09 14:51:09',	NULL),
(3,	'Acabamento',	'2013-09-09 14:51:13',	'2013-09-09 14:51:13',	NULL);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'Lucas Ferreira',	'lucasfercunha@gmail.com',	'1Nim5l6G+8NT/iOlaDCIXtAIjmpdNDJay4ch1GxQNlGq8PvOECeYmIzZ1Gp8malbqpekoy8I+cE5gcbOr2N2Xg==',	'2013-09-03 09:46:44',	'2013-09-03 09:46:44',	NULL);

-- 2013-09-26 16:09:03