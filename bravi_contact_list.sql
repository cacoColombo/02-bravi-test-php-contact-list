-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 15-Maio-2018 às 05:27
-- Versão do servidor: 5.7.21
-- PHP Version: 5.6.35

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bravi_contact_list`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `contacts_fk0` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `nickname`, `user_id`, `created_at`, `updated_at`) VALUES
(6, 'Carlos Colombo', 'Caco', 1, '2018-05-15 02:25:07', '2018-05-15 02:25:07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contacts_infos`
--

DROP TABLE IF EXISTS `contacts_infos`;
CREATE TABLE IF NOT EXISTS `contacts_infos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `contacts_infos_fk0` (`contact_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `contacts_infos`
--

INSERT INTO `contacts_infos` (`id`, `contact_id`, `description`, `value`, `created_at`, `updated_at`) VALUES
(7, 1, 'Phone', '+5551998418434', '2018-05-15 02:25:36', '2018-05-15 02:25:36'),
(8, 1, 'Email', 'caco.colombo@gmail.com', '2018-05-15 02:25:58', '2018-05-15 02:25:58');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_login` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$1$Dtqyvz7/$wZSaZbfHgn0UbLlVi1HHp0', 'Admin', '2018-05-15 02:24:41', '2018-05-15 02:24:41', '2018-05-15 02:24:41');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_authentication`
--

DROP TABLE IF EXISTS `users_authentication`;
CREATE TABLE IF NOT EXISTS `users_authentication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expired_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `users_authentication_fk0` (`users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
