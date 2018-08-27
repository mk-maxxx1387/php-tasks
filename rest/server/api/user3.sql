-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

USE `user3`;

DROP TABLE IF EXISTS `carshop_cars`;
CREATE TABLE `carshop_cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mark` varchar(65) NOT NULL,
  `model` varchar(65) NOT NULL,
  `year` year(4) NOT NULL,
  `engine_size` decimal(3,1) NOT NULL,
  `color` varchar(65) NOT NULL,
  `max_speed` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `carshop_cars` (`id`, `mark`, `model`, `year`, `engine_size`, `color`, `max_speed`, `price`) VALUES
(1,	'audi',	'100',	'1991',	2.4,	'gray',	180,	25000.00),
(2,	'audi',	'80',	'1986',	1.8,	'black',	200,	23000.00),
(3,	'gaz',	'21',	'1960',	2.5,	'black',	150,	10000.00),
(4,	'toyota',	'supra',	'1995',	3.6,	'blue',	250,	40000.00),
(5,	'nissan',	'gtr',	'1996',	3.8,	'blue',	260,	46000.00),
(6,	'honda',	's2000',	'1998',	3.1,	'yellow',	230,	35000.00);

DROP TABLE IF EXISTS `carshop_orders`;
CREATE TABLE `carshop_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `car_id` int(11) NOT NULL,
  `first_name` varchar(65) NOT NULL,
  `last_name` varchar(65) NOT NULL,
  `pay_type` enum('cash','credit card') DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `carshop_orders` (`id`, `car_id`, `first_name`, `last_name`, `pay_type`, `user_id`) VALUES
(1,	1,	'test',	'test last name',	'cash',	1),
(2,	2,	'test',	'test last name',	'cash',	1);

DROP TABLE IF EXISTS `carshop_users`;
CREATE TABLE `carshop_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(65) NOT NULL,
  `last_name` varchar(65) NOT NULL,
  `login` varchar(65) NOT NULL,
  `password` varchar(65) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `carshop_users` (`id`, `first_name`, `last_name`, `login`, `password`) VALUES
(1,	'aaaaa',	'aaaaaa',	'test',	'test');

DROP TABLE IF EXISTS `carshop_user_tokens`;
CREATE TABLE `carshop_user_tokens` (
  `user_id` int(11) NOT NULL,
  `token` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `carshop_user_tokens` (`user_id`, `token`) VALUES
(1,	'c250be0b22575f56a74ef851f5ca196b1677077a'),
(1,	'90236631912a0e70f40b7625f7940b483f0d7fd2'),
(1,	'd238b6065314b53ba1df037d29c5e928b472caaa'),
(1,	'd238b6065314b53ba1df037d29c5e928b472caaa'),
(1,	'd238b6065314b53ba1df037d29c5e928b472caaa'),
(1,	'b1b41a42f6b32fdbb7e7e17628bc2453a0738908'),
(1,	'15ed1478ddfd842a4d46b5d9aa7c37f3c40a757d'),
(1,	'15ed1478ddfd842a4d46b5d9aa7c37f3c40a757d'),
(1,	'15ed1478ddfd842a4d46b5d9aa7c37f3c40a757d');

-- 2018-08-27 18:13:34
